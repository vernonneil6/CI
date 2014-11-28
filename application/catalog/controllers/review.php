<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Review extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/dashboard
	*	- or -  
	* 		http://example.com/index.php/dashboard/index
	*	- or -
	* Since this controller is set as the default controller in 
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/dashboard/<method_name>
	* @see http://codeigniter.com/review_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  {
  	parent::__construct();
				
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		 {
		    $site = $regs['domain'];
		 }
		 
		 $website = $this->common->get_site_by_domain_name('yougotrated.writerbin.com');
		 
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
	
	//Updating the Record
	public function update()
	{
			if($this->input->post('id')!='')
			{
				//If Old Record Update
				if( $this->input->post('btnupdate') || $this->input->post('review')!='')
				{
			//Getting id
			$id = $this->encrypt->decode($this->input->post('id'));
			//Getting value
			$companyid = $this->encrypt->decode($this->input->post('companyid'));
			$userid = $this->session->userdata['youg_user']['userid'];
			$rating = ($this->input->post('score'));
			$review = (strip_tags($this->input->post('review')));
			$reviewtitle = ($this->input->post('reviewtitle'));	
			if($rating!='' || $rating!=0)
			{
					//Updating Record With Image
					$updated = $this->reviews->update($id,$companyid,$userid,$rating,$review,$reviewtitle);
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
				//If New Record Insert
			if( $this->input->post('btnsubmit') || $this->input->post('review')!='')
			{
			//Getting value
			$companyid = $this->encrypt->decode($this->input->post('companyid'));
			$userid = $this->session->userdata['youg_user']['userid'];
			$rating = ($this->input->post('score'));
			$review = (strip_tags($this->input->post('review')));
			$reviewtitle = ($this->input->post('reviewtitle'));
			$company=$this->reviews->get_company_byid($companyid);
			$user=$this->users->get_user_byid($userid);
			
				if($rating!='' && $rating!=0)
				 {
					$elite=$this->reviews->elitemship($companyid);
				
					if(count($elite)>0)
					{
							$relation = $this->common->get_relation_byciduid($companyid,$userid);
							if(count($relation)>0)
							{
								if( $lastid = $this->reviews->insert_elite_review($companyid,$userid,$rating,$review,$reviewtitle))
								{
								
								//Loading E-mail library
								$this->load->library('email');
								
								//Loading E-mail config file
								$this->config->load('email',TRUE);
								$mail = $this->common->get_email_byid(7);
								$subject = $mail[0]['subject'];
								$mailformat = $mail[0]['mailformat'];
								
								$site_url = $this->common->get_setting_value(2);
								$site_mail = $this->common->get_setting_value(5);
								$site_name = $this->common->get_setting_value(1);
								//Payment mail for Company
								//$from = $site_mail;
								$to = $company[0]['email'];
								
								$this->load->library('email');
								$this->email->from($site_mail,$site_name);
								$this->email->to($to);
								$this->email->subject($subject);
								$review123 = $this->reviews->get_review1_byid($lastid);
								$seo = $review123[0]['seokeyword'];
								$link = "<a href='".site_url('review/browse/'.$seo)."' title='see review' target='_blank'>".site_url('review/browse/'.$seo)."</a>";
							
								$mail_body = str_replace("%company%",ucfirst($company[0]['company']),str_replace("%emailid%",$to,str_replace("%link%",$link,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_mail,stripslashes($mailformat)))))));
							
								$this->email->message($mail_body);
								
								//Sending mail to admin
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
								if($this->reviews->insert1($companyid,$userid,$rating,$review,$reviewtitle))
								{
									if(count($company)>0)
									{
									$companyemailaddress = $company[0]['email'];
								}
					
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_email = $this->common->get_setting_value(5);
					
					// Company Mail
					$to = $companyemailaddress;
					//$mail = $this->common->get_email_byid(9);
					
					//$subject = $mail[0]['subject'];
					//$mailformat = $mail[0]['mailformat'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject('A Review about you company has been posted on YouGotRated.');
					
					
				/*	$link1 = "<a href='".base_url('welcome/confirm/'.base64_encode($companyid).'/'.base64_encode($userid))."' title='Confirm Customer' class='mailbutton' style='background-image:url(".$site_url."images/type_btn.png);border: 1px solid #CCCCCC;
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
					
					$this->email->message($mail_body);*/
					
					$this->email->message("
					<table>
						
						<label style='color: #B32317; font-size: 23px; padding: 15px 0;'> 
								 One of your customers has posted a </br>
								 Review / Complaint about you 
						</label>
						
						<tr>
							<td>
								<ul style='font-size: 13px; list-style: none; padding : 0;'>
								
									<li style='margin: 20px 0;  padding : 0;'>Hello ".$company[0]['company'].",</li>
									
									<li style='margin: 8px 0; padding : 0 0 0 15px;'>One of your customers has recently posted a review on YouGot Rated.</li>
									
									<li style='margin: 8px 0; padding : 0 0 0 15px;'>If you received a positive review, congratulations for a job well done.</li>
									
									<li style='margin: 8px 0; padding : 0 0 0 15px;'>If you received a Negative Review, please remember that you can have it removed if you agree to work with your customer to provide them with a solution to their complaint.</li>
									
									<li style='margin: 11px 0; padding : 0 0 0 15px;'>• By being pro-active and working with your customer you can avoid having a bad reputation online which can affect your business</li>
									
									<li style='margin: 8px 0; padding : 0 0 0 15px;'>• Customers are more likely to arrive at a mutually beneficial solution when contacted immediately</li>
									
									<li style='margin: 8px 0; padding : 0 0 0 15px;'>• You will save time, money and most importantly, you will continue to enjoy a good online reputation</li>
									
								</ul>
							</td>
							<td>
								<ul style='font-size : 13px; list-style : none; padding : 0; margin : 0;'>
								
									<li style = 'margin : 0;'><img src='".$site_url."images/email.jpg'></li>
								</ul>
								<ul style='font-size : 13px; list-style : none; margin : 0; background-color : #E7E5D3; width: 198px; padding : 6px 0; border-radius : 0 0 7px 7px; '>
									<li style = 'font-size : 18px; color : #B32317; margin : 5px 0 10px; padding : 0  0 0 15px;'>Expert Tips</li>								
									<li style = 'margin: 7px 0; padding : 0  0 0 15px; '>Address your current dispute</li>								
									<li style = 'margin: 7px 0; padding : 0  0 0 15px; '>Help avoid future transaction issues</li>
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
									
									<li>Most of the time, customers disputes can be resolved quickly and amicably </li>
									<li>by communicating with the buyer through YouGotRated. </li>
									
									<li style='font-size : 13px; margin : 15px 0 0 15px;'>We encourage you to respond to the buyer as soon as possible. A buyer who feels that you are working</li> 
									<li style='font-size : 13px'>with them to resolve a problem is more likely to agree to a settlement.</li> 
									
									
									
									<li style='font-size : 18px; padding : 15px 0; font-weight : bold;'>Your Benefit</li>
									
									<li>If you choose to have the review removed from your profile, YouGotRated will </li>
									<li>temporarily disable and hide the review from public view until you reach a resolution </li>
									<li>with your customer. We believe that as a merchant you deserve the opportunity to keep </li> 
									<li>a good online reputation.</li>
									
									<li style='font-size : 13px; margin : 15px 0 0 15px;'>Please remember that even though you may select the review to be removed from the site, you must </li>
									<li style='font-size : 13px'>comply with the YouGotRated User Agreement and provide your customer with a solution to their </li>
									<li style='font-size : 13px'>complaint. Failure to do so, will result in having the review permanently posted online.</li>
									<li style='font-size : 13px'>To review the YouGotRated User Agreement, visit the YouGotRated and click the</li>
									<li style='font-size : 13px'>Legal Agreements link on the bottom of any page.</li>
									
									<li style='font-size : 13px; margin : 20px 0 5px 15px;'>Sincerely,</li>

									<li style='font-size : 13px; margin : 0 0 20px 15px;'>YouGotRated</li>

									<li style='font-size : 13px; color : #347C91; margin : 15px 0 15px 15px;'>Please follow this link to view your Review.</li>
									
									<li><a href='".base_url('businessadmin/review/reviews')."'><img src='".$site_url."images/go.gif'></a></li>
									
  								</ul>
							</td>
						</tr>
						
					</table>
					
					
					");
					
					
										
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
					$updated = $this->reviews->insert($companyid,$userid,$rating,$review,$reviewtitle);
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
					$id = $this->encrypt->decode($this->input->post('id'));
					//Getting value
					echo $reviewid = $this->encrypt->decode($this->input->post('reviewid'));
					$userid = $this->session->userdata['youg_user']['userid'];
					$comment = (strip_tags($this->input->post('comment')));
														
					//Updating Record With Image
					$updated = $this->reviews->update_comment($id,$reviewid,$userid,$comment);
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
							
							$review = $this->reviews->get_review1_byid($reviewid);
							if(count($review)>0)
							{
								$companyid = $review[0]['companyid'];
							}
							
							$elite=$this->reviews->elitemship($companyid);
				
							if(count($elite)>0)
							{
								$relation = $this->common->get_relation_byciduid($companyid,$userid);
								if(count($relation)>0)
								{
									
									if($relation[0]['status']=='Decline')
									{
										$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'yes');
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
										$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'no');
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
									$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'yes');
									
									if( $updated = 'added')
									{
										if(count($review)>0)
										{
											$company = $this->complaints->get_company_byid($review[0]['companyid']);
											$user    = $this->common->get_user_byid($userid);
											if(count($company)>0)
											{
												$companyemailaddress = $company[0]['email'];
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
								$updated = $this->reviews->insert_comment($reviewid,$userid,$comment,'no');
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

