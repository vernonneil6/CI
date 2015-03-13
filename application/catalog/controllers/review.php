<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Review extends CI_Controller 
{
	public $paging;
	public $data;
	
	public function __construct()
  {
  	parent::__construct();
				
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match("/\writerbin\b/i", $domain, $regs)) 
		{
			$site = 'yougotrated.writerbin.com';
		}
		else if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		{
			$site = $regs['domain'];
		}
		 
		 $website = $this->common->get_site_by_domain_name($site);
		 
		 if(count($website)>0)
		 {
		 	$siteid = $website[0]['id'];
		 }
		 $this->session->set_userdata('siteid',$siteid);
		 
		 $siteid = $this->session->userdata('siteid');
		
		$this->data['site_name'] = $this->common->get_sitename_byid($siteid);
		$this->data['site_url'] = $this->common->get_siteurl_byid($siteid);
		$this->data['searchword']='';	
		//Loading Model File
  		$this->load->model('reviews');
		$this->load->model('complaints');
		$this->load->model('users');
		$this->data['topads']= $this->common->get_all_ads('top','review',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','review',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','review',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','review',$siteid);
	
		//Loading Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		if( $this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'add' )
		{
   		$this->data['title'] = 'Add your Review';
		}
		
		else if( $this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'edit' )
		{
   		$this->data['title'] = 'Edit Review';
		}
		
		else if( $this->uri->segment(1) == 'review' && ( $this->uri->segment(2) == 'comments' || $this->uri->segment(2) == 'editcomment' ) )
		{
   		$this->data['title'] = 'Comments On Review';
		}
		else
		{
			$this->data['title'] = 'Business Reviews';
		}
			$this->data['section_title'] = 'Reviews';

		//Load header and save in variable
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		$this->load->library('pagination');
		
		$limit = $this->paging['per_page'];
  		$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
		
	    $this->data['reviews'] = $this->reviews->get_all_reviews($limit,$offset);
		
	  $this->paging['base_url'] = site_url("review/index");
  	  $this->paging['uri_segment'] = 3;
	  $this->paging['total_rows'] = count($this->reviews->get_all_reviews());
	  $this->pagination->initialize($this->paging);
		
		//Loading View File
		$this->load->view('review/index',$this->data);
	}
	
	public function add($companyid='')
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$this->session->set_flashdata('error', 'Please login to continue!');
			$this->session->set_userdata('last_url','review/add/'.$companyid);
			redirect('login','refresh');
		}
		
		$userid = $this->session->userdata['youg_user']['userid'];
		$givenreview=$this->reviews->get_reviews1_byciduid($companyid,$userid);
		
		if(count($givenreview)>0)
		{
				$this->session->set_flashdata('error', 'You have already reviewed this  company.!');
				redirect('review', 'refresh');
		}
		
		if($companyid!='' || $companyid!=0)
		{
			$this->data['companyid'] = $companyid;

			$this->data['company'] = $this->reviews->get_company_byid($companyid);
			
			if(count($this->data['company'])>0){
			//Loading View File
			$this->load->view('review/add',$this->data);
			}
			else
			{
				redirect('review','refresh');
			}
		}
		else
		{
			redirect('review','refresh');
		}
	}
	
	public function edit($id='')
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login', 'refresh');
		}
			if($id!='' || $id!=0)
			{
				//Getting detail for displaying in form
				$this->data['review'] = $this->reviews->get_review_byid($id);
				$this->data['companyid'] = $this->data['review'][0]['companyid'];
				if(($this->data['review'][0]['reviewby']==$this->session->userdata['youg_user']['userid'])) { 

					if( count($this->data['review'])>0 )
		    		{			
						//Loading View File
						$this->load->view('review/edit',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('review', 'refresh');
					}
				}
			else
				{
				redirect('review', 'refresh');
			}
		 }
		else
		{
			redirect('review', 'refresh');
		}
	}

		
	public function update()
	{
		$id = $this->encrypt->decode($this->input->post('id'));
		$companyid = $this->encrypt->decode($this->input->post('companyid'));
		$userid = $this->session->userdata['youg_user']['userid'];
		$rating = $this->input->post('score');
		$review = strip_tags($this->input->post('review'));
		$reviewtitle = $this->input->post('reviewtitle');
		$autopost = $this->input->post('autopost');		

		if($this->input->post('id')!='')
		{
			if( $this->input->post('btnupdate') || $review!='')
			{
				if($rating!='' || $rating!=0)
				{
					$updated = $this->reviews->update($id,$companyid,$userid,$rating,$review,$reviewtitle,$autopost);
					if( $updated == 'updated')
					{
						$this->session->set_flashdata('success', 'review updated successfully.');
						redirect('review', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in updating review. Try later!');
						redirect('review', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Rating must not be empty. Try later!');
					redirect('review/edit/'.$id, 'refresh');
				}
			}
		}
		else
		{

			if( $this->input->post('btnsubmit') || $review!='')
			{

				$company=$this->reviews->get_company_byid($companyid);
				$user=$this->users->get_user_byid($userid);

				if($rating!='' && $rating!=0)
				{
					$elite=$this->reviews->elitemship($companyid);

					if(count($elite)>0)
					{
						$relation = $this->common->get_relation_byciduid($companyid,$userid);

						$site_name = $this->common->get_setting_value(1);
						$site_url = $this->common->get_setting_value(2);
						$site_mail = $this->common->get_setting_value(5);

						if(count($relation)>0)
						{
							if( $lastid = $this->reviews->insert_elite_review($companyid,$userid,$rating,$review,$reviewtitle,$autopost))
							{
								$this->load->library('email');
								$this->config->load('email',TRUE);

								$mail = $this->common->get_email_byid(7);
								$subject = $mail[0]['subject'];
								$mailformat = $mail[0]['mailformat'];
								$to = $company[0]['contactemail'];

								$this->email->from($site_mail,$site_name);
								$this->email->to($to);
								$this->email->subject($subject);
								$review123 = $this->reviews->get_review1_byid($lastid);
								$seo = $review123[0]['seokeyword'];

								$link = "<a href='".site_url('review/browse/'.$seo)."' title='see review' target='_blank'>".site_url('review/browse/'.$seo)."</a>";							
								$mail_body = str_replace("%company%",ucfirst($company[0]['company']),str_replace("%emailid%",$to,str_replace("%link%",$link,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_mail,stripslashes($mailformat)))))));

								$this->email->message($mail_body);
								$this->email->send();

								$this->session->set_flashdata('success', 'Review submitted successfully!');
								redirect('review', 'refresh');
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in inserting review. Try later!');
								redirect('review', 'refresh');
							}
						}
						else
						{
							if($this->reviews->insert1($companyid,$userid,$rating,$review,$reviewtitle,$autopost))
							{
								if(count($company)>0)
								{
									$companyemailaddress = $company[0]['contactemail'];
								}

								$to = $companyemailaddress;

								$this->load->library('email');
								$this->email->from($site_mail,$site_name);
								$this->email->to($to);
								
								if($autopost == 1)
								{
									$this->email->subject('A Positive Review about you company has been posted on YouGotRated.');

									$this->email->message("
									<table>
										<tr>
											<td>
												<ul style='font-size: 13px; list-style: none; padding : 0;'>
													<li style='margin: 20px 0;  padding : 0;'>Hello ".$company[0]['company'].",</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>One of your customers has posted a review about your business.</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• If you received a positive review, congratulations for a job well done.</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• If you received a Negative Review, please remember that you can have it removed if you agree to work with your customer to provide them with a solution to their complaint.</li>
													<li style='margin: 11px 0; padding : 0 0 0 15px;'>• By being pro-active and working with your customer you can avoid having a bad reputation online which can affect your business</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• Customers are more likely to arrive at a mutually beneficial solution when contacted immediately</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• You will save time, money and most importantly, you will continue to enjoy a good online reputation</li>
												</ul>
											</td>
										
											<td>
												<ul style='font-size : 13px; list-style : none; padding : 0; margin : 0;'>
													<li style = 'margin : 0;'><img src='".$site_url."images/reviewemail.jpg'></li>
												</ul>
												<ul style='font-size : 13px; list-style : none; margin : 0; background-color : #E7E5D3; width: 198px; padding : 6px 0; border-radius : 0 0 7px 7px; '>
													<li style = 'font-size : 18px; color : #B32317; margin : 5px 0 10px; padding : 0  0 0 15px;'>Expert Tips</li>								
													<li style = 'margin: 7px 0; padding : 0  0 0 15px; '>Respond to negative reviews.</li>								
													<li style = 'margin: 7px 0; padding : 0  0 0 15px; '>Encourage customers to post reviews.</li>
												</ul>	
											</td>
										</tr>

										<tr>
											<td>
												<ul style='font-size : 15px; list-style : none; padding : 10px 0; margin : 0;'>
													<li style='font-size : 18px; padding : 15px 0; font-weight : bold;'>Here are the Transaction Details</li>
													<li style='font-size : 13px'>Buyer's name: ".ucfirst($user[0]['firstname']." ".$user[0]['lastname'])."</li>
													<li style='font-size : 13px'>Buyer's email: ".$user[0]['email']."</li>					
													<li style='font-size : 13px'>Buyer's Phone Number: ".$user[0]['phoneno']."</li>
													<li style='font-size : 18px; padding : 15px 0; font-weight : bold;'>What To Do Next</li>									
													<li>To view the posted review <a href='".base_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints')."'>CLICK HERE</a></li>
													<li>You also have the ability to remove a negative or any review if you so choose using our </li>
													<li>Negative Review removal tool that you can initiate by clicking the link when logged into your account.</li>
													<li style='font-size : 13px; margin : 20px 0 5px 15px;'>Sincerely,</li>
													<li style='font-size : 13px; margin : 0 0 20px 15px;'>YouGotRated</li>
											  	</ul>
											</td>
										</tr>
									</table>
									");
								}
								else
								{
									$this->email->subject('A Negative Review about you company has been posted on YouGotRated.');

									$this->email->message("
									<table>
										<tr>
											<td>
												<ul style='font-size: 13px; list-style: none; padding : 0;'>
													<li style='margin: 20px 0;  padding : 0;'>Hello ".$company[0]['company'].",</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>One of your customers has posted a review about your business.</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• If you received a positive review, congratulations for a job well done.</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• If you received a Negative Review, please remember that you can have it removed if you agree to work with your customer to provide them with a solution to their complaint.</li>
													<li style='margin: 11px 0; padding : 0 0 0 15px;'>• By being pro-active and working with your customer you can avoid having a bad reputation online which can affect your business</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• Customers are more likely to arrive at a mutually beneficial solution when contacted immediately</li>
													<li style='margin: 8px 0; padding : 0 0 0 15px;'>• You will save time, money and most importantly, you will continue to enjoy a good online reputation</li>
												</ul>
											</td>
										
											<td>
												<ul style='font-size : 13px; list-style : none; padding : 0; margin : 0;'>
													<li style = 'margin : 0;'><img src='".$site_url."images/reviewemail.jpg'></li>
												</ul>
												<ul style='font-size : 13px; list-style : none; margin : 0; background-color : #E7E5D3; width: 198px; padding : 6px 0; border-radius : 0 0 7px 7px; '>
													<li style = 'font-size : 18px; color : #B32317; margin : 5px 0 10px; padding : 0  0 0 15px;'>Expert Tips</li>								
													<li style = 'margin: 7px 0; padding : 0  0 0 15px; '>Respond to negative reviews.</li>								
													<li style = 'margin: 7px 0; padding : 0  0 0 15px; '>Encourage customers to post reviews.</li>
												</ul>	
											</td>
										</tr>

										<tr>
											<td>
												<ul style='font-size : 15px; list-style : none; padding : 10px 0; margin : 0;'>
													<li style='font-size : 18px; padding : 15px 0; font-weight : bold;'>Here are the Transaction Details</li>
													<li style='font-size : 13px'>Buyer's name: ".ucfirst($user[0]['firstname']." ".$user[0]['lastname'])."</li>
													<li style='font-size : 13px'>Buyer's email: ".$user[0]['email']."</li>					
													<li style='font-size : 13px'>Buyer's Phone Number: ".$user[0]['phoneno']."</li>
													<li style='font-size : 18px; padding : 15px 0; font-weight : bold;'>What To Do Next</li>									
													<li>To view the posted review <a href='".base_url('company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints')."'>CLICK HERE</a></li>
													<li>You also have the ability to remove a negative or any review if you so choose using our </li>
													<li>Negative Review removal tool that you can initiate by clicking the link when logged into your account.</li>
													<li style='font-size : 13px; margin : 20px 0 5px 15px;'>Sincerely,</li>
													<li style='font-size : 13px; margin : 0 0 20px 15px;'>YouGotRated</li>
											  	</ul>
											</td>
										</tr>
									</table>
									");
								}

								if($this->email->send())
								{
									$this->session->set_flashdata('success', 'Review submitted successfully!');
									redirect(site_url('review'), 'refresh');
								}
								else
								{
									redirect(site_url('review'), 'refresh');
								}
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in inserting review. Try later!');	
								redirect('review', 'refresh');
							}
						}
					}
					else
					{	
						$updated = $this->reviews->insert($companyid,$userid,$rating,$review,$reviewtitle,$autopost);
						if( $updated = 'added')
						{	
							$id = $this->db->insert_id();
							$this->session->set_flashdata('success', 'Review submitted successfully!');
							redirect('review', 'refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'There is error in inserting review. Try later!');
							redirect('review', 'refresh');
						}	
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Rating must not be empty. Try later!');
					redirect('review/add/'.$companyid, 'refresh');
				}
			}
			else
			{
				redirect('review', 'refresh');
			}
		}
	}
	
	public function resolution_options($reviewid)
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$this->session->set_flashdata('error', 'Please login to continue!');
			$this->session->set_userdata('last_url','review/resolution_options/'.$reviewid);
			redirect('login','refresh');
		}
		
		$review  = $this->reviews->get_review_bysingleid($reviewid);
		$user    = $this->users->get_user_bysingleid($review['reviewby']);
		
		$this->data['reviewid'] = $reviewid;
		$this->data['name'] = ucfirst($user['firstname']." ".$user['lastname']);
		
		$this->load->view('review/option',$this->data);
	}
		
	public function review_mail($reviewid, $emailid, $url, $to)
	{
		$review 	= $this->reviews->get_review_bysingleid($reviewid);	
		$user 		= $this->users->get_user_bysingleid($review['reviewby']);
		$company 	= $this->users->get_company_bysingleid($review['companyid']);
		$reviewmail = $this->reviews->get_reviewmail_bysinglereviewid($review['id']);
		
		$site_name  = $this->common->get_setting_value(1);
		$site_email = $this->common->get_setting_value(5);
		$site_url   = $this->reviews->get_setting_value(2);
		
		$this->load->library('email');
		$message  = $this->common->get_email_byid($emailid);
		$subject  = str_replace("%reviewid%", $reviewid, stripslashes($message[0]['subject']));			
		$mail     = str_replace("%url%", site_url($url), str_replace("%address%", $company['streetaddress'], str_replace("%merchantname%", $company['company'], str_replace("%city%", $company['city'], str_replace("%state%", $company['state'], str_replace("%zip%", $company['zip'], str_replace("%reviewid%", $reviewid, str_replace("%siteurl%", $site_url, str_replace("%company%", ucfirst($company['company']), str_replace("%name%", ucfirst($user['firstname']." ".$user['lastname']),str_replace("%carrier%", $reviewmail['carrier'], str_replace("%trackingno%", $reviewmail['trackingno'], str_replace("%dateshipped%", $reviewmail['dateshipped'], stripslashes($message[0]['mailformat']))))))))))))));			
		
		$this->email->from($site_email,$site_name);
		$this->email->to($to);
		$this->email->subject($subject);	
		$this->email->message($mail);		
	}
		
	public function reviewmail_insert($reviewid)
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login','refresh');
		}
		
		$review  		= $this->reviews->get_review_bysingleid($reviewid);		
		$user 			= $this->users->get_user_bysingleid($review['reviewby']);
		$company 		= $this->users->get_company_bysingleid($review['companyid']);
		$buyeroption 	= $this->input->post('buyeroption');
		$textarea   	= $this->input->post('buyer_textarea');
		
		if(count($this->reviews->insert_reviewmail_check($review['companyid'], $review['reviewby'], $review['id'])) > 0)
		{
			$this->session->set_flashdata('error', 'You have already contact this company.');
			redirect('review','refresh');
		}
		
		$this->reviews->insert_reviewmail($review['companyid'], $review['reviewby'], $review['id'], $buyeroption, $textarea, '0');
		$this->reviews->review_date($review['companyid'],$review['reviewby'],$reviewid,date('Y-m-d'),'2');
		

		$this->reviews->update_reviewsflag($review['id']);
		
		$data = $this->reviews->get_reviewmail_bysinglereviewid($reviewid);
		$url = 'review/resolution/'.$data['review_id'];
				
		if ($data['resolution'] == '2')
		{
			$this->reviews->review_date($review['companyid'],$review['reviewby'],$reviewid,date('Y-m-d'),'3');
			$this->review_mail($data['review_id'], '28', $url, $user['email']);		
			$this->email->send();
		}
		if ($data['resolution'] == '3')
		{
			$this->reviews->review_date($review['companyid'],$review['reviewby'],$reviewid,date('Y-m-d'),'3');
			$this->review_mail($data['review_id'], '32', $url, $user['email']);	
			$this->email->send();
		}
		if ($data['resolution'] == '4')
		{		
			$this->reviews->review_date($review['companyid'],$review['reviewby'],$reviewid,date('Y-m-d'),'3');
			$this->review_mail($data['review_id'], '36', $url, $user['email']);	
			$this->email->send();
		}
		
		
		$this->session->set_flashdata('success', 'You have successfully send mail to Merchant.');
		redirect('review','refresh');	
		
	}
	
	
	public function resolution($reviewid)
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$this->session->set_flashdata('error', 'Please login to continue!');
			$this->session->set_userdata('last_url','review/resolution/'.$reviewid);
			redirect('login','refresh');
		}
		
		if($this->input->post('submit'))
		{
			$data = array(
				'carrier' 		=> $this->input->post('carrier'),
				'trackingno' 	=> $this->input->post('trackingno'),
				'dateshipped' 	=> $this->input->post('dateshipped'),
				'checkdate'		=> date('Y-m-d'),
				'status'		=> '1'
			);
				$this->reviews->reviewmail_update($data, $reviewid);
				
				
				$review  	= $this->reviews->get_review_bysingleid($reviewid);
				$data 		= $this->reviews->get_reviewmail_bysinglereviewid($reviewid);
				$company 	= $this->users->get_company_bysingleid($review['companyid']);
				$url 		= 'businessadmin/review/resolution/'.$data['review_id'];
				
				
				
				if($data['resolution'] == '2')
				{					
					$this->review_mail($data['review_id'], '29', $url, $company['contactemail']);								
				}
				
				if($data['resolution'] == '3')
				{
					$this->review_mail($data['review_id'], '33', $url, $company['contactemail']);			
				}
				
				if($this->email->send())
				{
					$this->reviews->review_date($review['companyid'],$review['reviewby'],$reviewid,date('Y-m-d'),'4');
					$this->session->set_flashdata('success', 'You have successfully send mail to merchant.');
					redirect('review','refresh');
				}
					
		}
		$this->data['reviewid'] = $reviewid;
		$this->load->view('review/resolution', $this->data);
	}
	
	public function proof($reviewid)
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$this->session->set_flashdata('error', 'Please login to continue!');
			$this->session->set_userdata('last_url','review/proof/'.$reviewid);
			redirect('login','refresh');
		}
		$this->data['reviewmail'] = $this->reviews->get_reviewmail_bysinglereviewid($reviewid);
		$this->load->view('review/resolution', $this->data);
	}
	
	public function replacement($reviewid)
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$this->session->set_flashdata('error', 'Please login to continue!');
			$this->session->set_userdata('last_url','review/replacement/'.$reviewid);
			redirect('login','refresh');
		}
		$this->data['reviewmail'] = $this->reviews->get_reviewmail_bysinglereviewid($reviewid);
		$this->load->view('review/resolution', $this->data);
	}	
	
	public function closecase($reviewid)
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login','refresh');
		}
		$this->reviews->delete_review_byid($reviewid);
		$this->reviews->delete_comment($reviewid);
		$this->reviews->delete_reviewmail($reviewid);
				
		$this->session->set_flashdata('success', 'You have successfully closed the case.');
		redirect('review','refresh');
	}
	
	public function cronjob()
	{
		$result = $this->reviews->get_all_reviewscron();
		foreach ( $result as $record )
		{
			$this->merchantbuyermail($record['id']);
		}
		die;
	}
	
	public function merchantbuyermail($reviewid)
	{
		if($this->reviews->get_reviewmail_bysinglereviewid($reviewid))
		{
			$data 		= $this->reviews->get_reviewmail_bysinglereviewid($reviewid);
			$user 		= $this->users->get_user_bysingleid($data['user_id']);
			$company 	= $this->users->get_company_bysingleid($data['company_id']);	
			$resolution = $data['resolution'];
			$status 	= $data['status'];
			$url 		= 'businessadmin/review/resolution/'.$reviewid;
			
			$date2 		= date("Y-m-d");
			
			$date1  	= $data['date'];
			$diff   	= abs(strtotime($date2) - strtotime($date1));
			$years  	= floor($diff / (365*60*60*24));
			$months 	= floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
			$days 		= floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
			
			$checkdate1 = $data['checkdate'];
			$diff1   	= abs(strtotime($date2) - strtotime($checkdate1));
			$years1  	= floor($diff1 / (365*60*60*24));
			$months1 	= floor(($diff1 - $years1 * 365*60*60*24) / (30*60*60*24));
			$checkdays 	= floor(($diff1 - $years1 * 365*60*60*24 - $months1*30*60*60*24)/ (60*60*24));
			
			if ($resolution == '1')
			{
				if ($days == 5 and $status == 0)
				{
					$this->review_mail($data['review_id'], '24', $url, $company['contactemail']);	
					$this->email->send();
				}
				
				else if ($days == 7 and $status == 0)
				{
					$this->review_mail($data['review_id'], '26', $url, $user['email']);	
					if($this->email->send())
					{
						$this->reviews->get_update_review_status($reviewid);
					}
				}
			}
			
			if($resolution == '2')
			{
				if ($days == 7 and $status == 0 or $checkdays == 15 and $status == 2)
				{
					$this->reviews->delete_review_byid($reviewid);
					$this->reviews->delete_comment($reviewid);
					$this->reviews->delete_reviewmail($reviewid);
				}
				
				else if ($checkdays == 10 and $status == 1)
				{
					
					$this->review_mail($data['review_id'], '31', $url, $company['contactemail']);				
					$this->email->send();
				}
				
				else if ($checkdays == 13 and $status == 1)
				{
					$this->review_mail($data['review_id'], '26', $url, $user['email']);	
					if($this->email->send())
					{
						$this->reviews->get_update_review_status($reviewid);
					}
				}			
			}
			
			if($resolution == '3')
			{
				if ($days == 7 and $status == 0)
				{
					$this->reviews->delete_review_byid($reviewid);
					$this->reviews->delete_comment($reviewid);
					$this->reviews->delete_reviewmail($reviewid);
				}
				
				else if ($checkdays == 10 and $status == 1)
				{
					$this->review_mail($data['review_id'], '35', $url, $company['contactemail']);				
					$this->email->send();
				}
				
				else if ($checkdays == 12 and $status == 1)
				{
					$this->review_mail($data['review_id'], '26', $url, $user['email']);	
					if($this->email->send())
					{
						$this->reviews->get_update_review_status($reviewid);
					}
				}
				
				else if ($checkdays == 30 and $status == 2)
				{
					$this->reviews->delete_review_byid($reviewid);
					$this->reviews->delete_comment($reviewid);
					$this->reviews->delete_reviewmail($reviewid);
				}
			}
			
			if($resolution == '4')
			{
				if ($days == 15 and $status == 0)
				{
					$this->review_mail($data['review_id'], '38', $url, $company['contactemail']);				
					$this->email->send();
				}
			
				else if ($days == 17 and $status == 0)
				{
					$this->review_mail($data['review_id'], '26', $url, $user['email']);	
					if($this->email->send())
					{
						$this->reviews->get_update_review_status($reviewid);
					}
				}
				
				else if ($checkdays == 30 and $status == 2)
				{
					$this->reviews->delete_review_byid($reviewid);
					$this->reviews->delete_comment($reviewid);
					$this->reviews->delete_reviewmail($reviewid);
				}
			}
			
			if($resolution == '5')
			{
				if ($days == 15 and $status == 0)
				{
					$this->review_mail($data['review_id'], '40', $url, $company['contactemail']);				
					$this->email->send();
				}
				
				else if ($days == 17 and $status == 0)
				{
					$this->review_mail($data['review_id'], '26', $url, $user['email']);	
					if($this->email->send())
					{
						$this->reviews->get_update_review_status($reviewid);
					}
				}
				
				else if ($checkdays == 15 and $status == 2)
				{
					$this->reviews->delete_review_byid($reviewid);
					$this->reviews->delete_comment($reviewid);
					$this->reviews->delete_reviewmail($reviewid);
				}
			}
		}
	}	
		
	public function checkvote()
	{
		$ip = $this->input->post('ip');
		$reviewid = $this->input->post('reviewid');
		$vote = $this->input->post('vote');

		if( $this->input->is_ajax_request() && $reviewid != '')
		{
		    if($vote == 'agree')
		   {
			   $res = $this->reviews->delete_vote($ip,$reviewid,'disagree');
			   
		   }
		   else if($vote == 'disagree')
		   {
			   $res = $this->reviews->delete_vote($ip,$reviewid,'agree');
		   }
		   
		   $checked = $this->reviews->check_vote($ip,$reviewid,$vote);	
		   if($checked == 'false')
		   {
			   $updated = $this->reviews->insertvote($reviewid,$vote);
			   $result = array('message'=>'added');
		   }
		   else
		   {
			   $res = $this->reviews->delete_vote($ip,$reviewid,$vote);
			   $result = array('message'=>'deleted');
		   }
  
			//returning result of ajax
			echo json_encode( $result );
			die();
		}
	}
	
  	public function addvote()
	{
		$reviewid = $this->input->post('reviewid');
		$vote = $this->input->post('vote');

		if( $this->input->is_ajax_request() && $reviewid != '')
		{			
		 	     $this->input->data['updated'] = $this->reviews->insertvote($reviewid,$vote);
		 if($this->input->data['updated'] == 'added')
		 {
			  $result = array('message'=>'added');
		 }

		  //returning result of ajax
		  echo json_encode( $result );
		  die();
		}
	}
	
    public function updatevote()
	{
		$reviewid = $this->input->post('reviewid');
		$vote = $this->input->post('vote');
		$ip = $this->input->post('ip');

		if( $this->input->is_ajax_request() && $reviewid != '')
		{			
		   
		   $updated = $this->reviews->updatecount($ip,$reviewid,$vote);
		   if($updated == 'updated')
		   {
				$result = array('message'=>'updated');
		   }

		  //returning result of ajax
		  echo json_encode( $result );
		  die();
		}
	}
	
	public function countme()
	{
		$reviewid = $this->input->post('reviewid');
		$vote = $this->input->post('vote');

		if( $this->input->is_ajax_request() && $reviewid != '')
		{			
		   $total = $this->reviews->getcount($reviewid,$vote);
		   $result = array('message'=>'counted','total'=>$total);
          //returning result of ajax
		  echo json_encode( $result );
		  die();
		}
	}
	
	public function browse($reviewseokey='')
	{
		if($reviewseokey !='' || $reviewseokey!=0)
			{
			
				$reviewbyseo = $this->reviews->get_review_byseokeyword($reviewseokey);
				if(count($reviewbyseo))
				{
					$reviewid = $reviewbyseo[0]['id'];
				
				$this->load->library('pagination');
				$this->session->set_flashdata('last_url',uri_string());		    			
				$limit = $this->paging['per_page'];
		    	$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		  
		    	$this->data['review'] = $this->reviews->get_review_byid($reviewid);
				$this->data['disreview'] = $this->reviews->get_disreview_byid($reviewid);
				$this->data['reviewid'] = $reviewid;
				$this->data['comments'] = $this->reviews->get_comments_byreviewid($reviewid,$limit,$offset);
			
				$this->paging['base_url'] = site_url("review/browse/".$reviewseokey."/index");
			    $this->paging['uri_segment'] = 5;
			    $this->paging['total_rows'] = count($this->reviews->get_comments_byreviewid($reviewid));
		    	$this->pagination->initialize($this->paging);
			
			
			if(count($this->data['disreview'])>0){
			$this->data['elite'] = $this->reviews->elitemship($this->data['disreview'][0]['companyid']);
			}
			else
			{
			$this->data['elite']=array();	
			}
			
			//Loading View File
			if((count($this->data['review'])>0) || count($this->data['disreview'])>0)
			 {
				$this->load->view('review/browse',$this->data);
			 }
			else
			 {
			 	redirect('review','refresh');
			 }
		}
		else
		{
			redirect('review','refresh');
		}
	}
		else
		{
			redirect('review','refresh');
		}
	}
	
	public function editcomment($id='')
	  {
			if( !array_key_exists('youg_user',$this->session->userdata) )
			{
				redirect('login', 'refresh');
			}
				if($id!='' || $id!=0)
				{
					//Getting detail for displaying in form
					$this->data['commentbyid'] = $this->reviews->get_comment_byid($id);
				
					if( count($this->data['commentbyid'] )>0 )
					{
						$this->data['review'] = $this->reviews->get_review_byid($this->data['commentbyid'][0]['reviewid']);
						
						$this->data['reviewid'] = $this->data['commentbyid'][0]['reviewid'];
						$this->data['comments'] = $this->reviews->get_comments_byreviewid($this->data['commentbyid'][0]['reviewid']);				
						
						$this->data['disreview'] = $this->reviews->get_disreview_byid($this->data['commentbyid'][0]['reviewid']);
									
						if($this->data['commentbyid'][0]['commentby']!=$this->session->userdata['youg_user']['userid'])
						{
							redirect('review/browse/'.$this->data['commentbyid'][0]['reviewid'],'refresh');
						}
					
					if(count($this->data['disreview'])>0)
					{
							$this->data['elite'] = $this->reviews->elitemship($this->data['disreview'][0]['companyid']);
					}
					else
					{
							$this->data['elite']=array();	
					}
					
					if( count($this->data['commentbyid'])>0 )
						{			
							//Loading View File
							//echo "<pre>";
							//print_r($this->data['commentbyid']);
							//die();
							$this->load->view('review/browse',$this->data);
						}
					else
					{
							$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
							redirect('review', 'refresh');
					}
				}
					else
					{
						redirect('review','refresh');
					}
				}
				else
				{
						redirect('review','refresh');
				}
	}
	
    public function deletecomment($id='')
	  {
			if( !array_key_exists('youg_user',$this->session->userdata) )
			{
				redirect('login', 'refresh');
			}
			
			if($id!='' || $id!=0)
			{
				$reviewid = $this->reviews->get_comment_byid($id);
				
				if(count($reviewid)>0)
				 {
				if(($reviewid[0]['commentby']==$this->session->userdata['youg_user']['userid']))
				 { 
					if($this->reviews->delete_comment($id))
		  	  {			
						$this->session->set_flashdata('success', 'Comment deleted successfully.');
						
						$review = $this->reviews->get_review1_byid($reviewid[0]['reviewid']);					
						
						redirect('review/browse/'.$review[0]['seokeyword'], 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in deleting comment. Try later!');
					redirect('review', 'refresh');
					}
			}
				else
				{	redirect('review','refresh');	}
				}
				else
				{
					redirect('review','refresh');
				}
			}
			else
			{
				redirect('review','refresh');
			}
		}
	
	 //Updating the Record
	public function upcomment()
	{
   		
		if($this->input->post('id')!='') 
		{
			//If Old Record Update
			if( $this->input->post('btncommentsubmit') || $this->input->post('comment')!='')
			{

				//Getting id
				$id = $this->input->post('id');
				//Getting value
				$reviewid = $this->encrypt->decode($this->input->post('reviewid'));
				$userid = $this->session->userdata['youg_user']['userid'];
				$comment = (strip_tags($this->input->post('comment')));
				$rating = $this->input->post('score');
												
				//Updating Record With Image
				$updated = $this->reviews->update_comment($id,$reviewid,$userid,$comment,$rating);
				if( $updated == 'updated')
				{
					$this->session->set_flashdata('success', 'comment updated successfully.');
					$review = $this->reviews->get_review1_byid($reviewid);
					redirect('review/browse/'.$review[0]['seokeyword'], 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating comment. Try later!');
					redirect('review', 'refresh');
				}
			}
		}
		else
		{
		//If New Record Insert
			if( $this->input->post('btncommentsubmit') || $this->input->post('comment')!='')
			{
				//Getting value
				
				$reviewid = $this->encrypt->decode($this->input->post('reviewid'));

				$userid = $this->session->userdata['youg_user']['userid'];
				$comment = addslashes(strip_tags($this->input->post('comment')));
				$rating = $this->input->post('score');

				$review = $this->reviews->get_review1_byid($reviewid);
				if(count($review)>0)
				{
					$companyid = $review[0]['companyid'];			

					$elite=$this->reviews->elitemship($companyid);
			
					if(count($elite)>0)
					{
						
						$relation = $this->common->get_relation_byciduid($companyid,$userid);
						if(count($relation)>0)
						{
	
							if($relation[0]['status']=='Decline')
							{
								
								$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'yes',$rating);
								if( $updated = 'added')
								{	
									
									$this->session->set_flashdata('success', 'comment posted successfully.');
									$review = $this->reviews->get_review1_byid($reviewid);
									redirect('review/browse/'.$review[0]['seokeyword'], 'refresh');
								}
								else
								{
										
									$this->session->set_flashdata('error', 'There is error in posting comment. Try later!');	
									redirect('review', 'refresh');
								}	
							}
							else
							{
								
								$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'no',$rating);
								if( $updated = 'added')
								{	
									
									$this->session->set_flashdata('success', 'comment posted successfully.');
									$review = $this->reviews->get_review1_byid($reviewid);
									redirect('review/browse/'.$review[0]['seokeyword'], 'refresh');
								}
								else
								{
										
									$this->session->set_flashdata('error', 'There is error in posting comment. Try later!');	
									redirect('review', 'refresh');
								}
							}
						}
						else
						{
							$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'no',$rating);

							if( $updated = 'added')
							{
								if(count($review)>0)
								{
									
									$company = $this->complaints->get_company_byid($review[0]['companyid']);
									$user    = $this->common->get_user_byid($userid);
									if(count($company)>0)
									{
										$companyemailaddress = $company[0]['contactemail'];
									}
								}


								$site_name = $this->common->get_setting_value(1);
								$site_url = $this->common->get_setting_value(2);
								$site_email = $this->common->get_setting_value(5);

								// Company Mail
								$to = $companyemailaddress;
								$mail = $this->common->get_email_byid(8);

								$subject = $mail[0]['subject'];
								$mailformat = $mail[0]['mailformat'];

								$this->load->library('email');
								$this->email->from($site_email,$site_name);
								$this->email->to($to);
								$this->email->subject($subject);


								$link1 = "<a href='".base_url('welcome/confirm/'.base64_encode($companyid).'/'.base64_encode($userid))."' title='Confirm Customer' class='mailbutton' style='background-image:url(".$site_url."images/type_btn.png);border: 1px solid #CCCCCC;
								color: #373737;
								float: left;
								font-family: aller;
								font-size: 16px;
								height: auto;
								list-style: none outside none;
								text-shadow: 0 1px 1px #FFFFFF;
								width: auto;
								padding:7px 20px;cursor: pointer;
								text-decoration:none;'>Confirm Customer</a>";
								$link2 = "<a href='".base_url('welcome/decline/'.base64_encode($companyid).'/'.base64_encode($userid))."' title='Decline Customer' class='mailbutton' style='background-image:url(".$site_url."images/type_btn.png);border: 1px solid #CCCCCC;
								color: #373737;
								float: left;
								font-family: aller;
								font-size: 16px;
								height: auto;
								list-style: none outside none;
								text-shadow: 0 1px 1px #FFFFFF;
								width: auto;
								padding:7px 20px;cursor: pointer;
								text-decoration:none;
								margin-left:15px;
								'>Decline Customer</a>";

								$mail_body = str_replace("%username%",ucfirst($user[0]['firstname'].' '.$user[0]['lastname']),str_replace("%company%",ucfirst($company[0]['company']),str_replace("%useremail%",$user[0]['email'],str_replace("%link1%",$link1,str_replace("%link2%",$link2,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))))));

								$this->email->message($mail_body);

								if($this->email->send())
								{
										
									$this->session->set_flashdata('success', 'comment submitted successfully.');
									redirect(site_url('review'), 'refresh');
								}
								else
								{
									redirect(site_url('review'), 'refresh');
								}

							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in posting comment. Try later!');	
								redirect('review', 'refresh');
							}
						}
					}
					else
					{
						$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'no',$rating);
						if( $updated = 'added')
						{	
							$this->session->set_flashdata('success', 'comment posted successfully.');							
							redirect('review/browse/'.$review[0]['seokeyword'], 'refresh');
						}
						else
						{	
							$this->session->set_flashdata('error', 'There is error in posting comment. Try later!');	
							redirect('review', 'refresh');
						}
					}
				}
				else
				{						
						redirect('review', 'refresh');
				}
			}
		}
	}
	 //Function For Change Status to "Enable" for elite review
	public function accept($id='')
	 {
			if($id!='' && $id!=0)
		 {
			if( $this->reviews->enable_review_byid($id) )
			{
				$this->session->set_flashdata('success', 'Review has been Enabled successfully.');
				redirect('review/browse/'.$id, 'refresh');
			}
		else
			{
				$this->session->set_flashdata('error', 'There is error in Enabling Review. Try later!');
				redirect('review', 'refresh');
			}
		}
		else
		 {
		  	redirect('review', 'refresh');
	   }
	 }
	
	 //Function For delete review
 	 public function delete($id='')
	 {
			if($id!='' && $id!=0) 
			{
				if( array_key_exists('youg_user',$this->session->userdata) )
				{
						$this->data['review'] = $this->reviews->get_review_byid($id);
						
						if(($this->data['review'][0]['reviewby']==$this->session->userdata['youg_user']['userid']))
						 { 
								if( $this->reviews->delete_review_byid($id) )
								{
					$this->session->set_flashdata('success', 'Review has been Deleted successfully.');
					redirect('review', 'refresh');
				}
								else
								{
					$this->session->set_flashdata('error', 'There is error in Deleting Review. Try later!');
					redirect('review', 'refresh');
				}
							}
				  else
				  {
				   redirect('review', 'refresh');
					}
				}
				else
				{
				 redirect('review', 'refresh');
				}
			}
		else
			{
				redirect('review', 'refresh');
			}
	 }
	 
	 //Function For delete review for elite
 	 public function decline($id='')
	 {
			if($id!='' && $id!=0) 
			{
				if( $this->reviews->delete_review_byid($id) )
				{
					$this->session->set_flashdata('success', 'Review has been Deleted successfully.');
					redirect('review', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in Deleting Review. Try later!');
					redirect('review', 'refresh');
				}
			}
			else
			{
			   redirect('review', 'refresh');
			}
	 }
	 public function reviewfeedback()
	 {
		 $this->load->view('review/feedback');
	 }
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */

