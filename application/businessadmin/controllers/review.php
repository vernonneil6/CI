<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller {

	/**
	 * You wrote a review about '.ucfirst($company[0]['company']).' on <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a>,<br/>
								'.ucfirst($company[0]['company']).' sent a request for Removing review ID ' .$reviewid.' Below are Details.
								* 
								* <a href="'.site_url('review/feedback/'.$rid.'/'.$userid.'/'.'agree').'"
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
	* @see http://codeigniter.com/user_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		
		//Loading Helper File
	  	$this->load->helper('form');
			
		//Loading Model File
	 	$this->load->model('reviews');
		$this->load->model('companys');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Business Reviews';
		$this->data['section_title'] = 'Business Reviews';
		
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					$this->data['selsite']['all'] = 'All Websites';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite']['all'] = 'All Websites';
					$this->data['selsite'] = array();
				}
		
		//Load heading and save in variable
		$this->data['heading'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata['siteid'];
			//Addingg Setting Result to variable
			$this->data['reviews'] = $this->reviews->get_all_reviews($companyid,$siteid,$limit,$offset);
			//echo "<pre>";
			//print_r($this->data['reviews']);
			//die();
			
			$this->paging['base_url'] = site_url("review/index/");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = $this->reviews->get_all_reviews_count($companyid,$siteid);
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('review',$this->data);
	  	}
	}

	public function import_csv()
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		if( $this->session->userdata['youg_admin'] )
	  	{
			if($this->input->post('btnupload'))
			{
				//Loading Model File
	  	  		$config['upload_path'] = '../uploads/reviewcsv/';
				$config['allowed_types'] = 'csv';
				//$config['max_size'] = '5000';
				//$config['file_name'] = $_FILES['csvfile']['name'];
			
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('csvfile')) 
				{
					//Error in upload
					$this->session->set_flashdata('error', "Error while uploading file. 'Valid File Type ( csv )");
					redirect('review','refresh');
				}
				else
				 {
								$file_info = $this->upload->data();
								$filePath = "../uploads/reviewcsv/";
								$file = $filePath.$file_info['file_name'];
								$row = 0;
								$reviews = array();
								$handle = fopen($file, "r");
			
								$fcontents = file('../uploads/reviewcsv/'.$file_info['file_name']);
								//echo "<pre>";
								//print_r($fcontents);
								//die();
								$companyid = $this->session->userdata['youg_admin']['id'];
								unset($fcontents[0]);
								//echo "<pre>";
								//print_r($fcontents);
								//die();
								if(count($fcontents)>0)
								 {
									for($i=1;$i<(sizeof($fcontents)+1); $i++)
									{
												$line = trim($fcontents[$i]);
												$arr = explode(",",$line);

														$title = $arr[0];
														$username = $arr[1];
														$rating = $arr[2];
														$review = $arr[3];
														$date = $arr[4];
														
							$siteid = $this->session->userdata('siteid');	
							if($title!='' && $username!='' && $rating!='' && $review!='' && $date!=''){
							if( $this->reviews->insert($companyid,$username,$rating,$review,$date,$siteid,$title) )
												{
													if(file_exists($file))
													{
														unlink($file);
													}
													$this->session->set_flashdata('success', 'reviews inserted successfully.');
												 }
												else
												{
													$this->session->set_flashdata('error', 'There is error in inserting reviews. Try later!');
												 }
											}
									}
									$this->session->set_flashdata('success', 'reviews inserted successfully.');
									redirect('review','refresh');
											

											
								 }
								else
								{
								redirect('review','refresh');
								}
						}
				}
			else
			{
				redirect('review','refresh');
			}
		}
	}

	public function download()
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		$this->load->helper('download');
		$site = site_url();			
		$url = explode("/businessadmin",$site);
		$path = $url[0];
		$file = file_get_contents($path.'/review.csv');
		$name = 'reviewexample.csv';
		force_download($name, $file); 
	}
	
	public function reviews()
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		}
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata('siteid');	
			//Addingg Setting Result to variable
			$this->data['reviews'] = $this->reviews->get_all_mainreviews($companyid,$siteid,$limit,$offset);
			//echo "<pre>";
			//print_r($this->data['reviews']);
			//die();
			
			$this->paging['base_url'] = site_url("review/reviews/index");
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = count($this->reviews->get_all_mainreviews($companyid,$siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('review',$this->data);
	  	}
	}
	
	public function removalrequest()
	{
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		}
		
		$companyid = $this->session->userdata['youg_admin']['id'];
		$company = $this->companys->get_company_byid($companyid);
		$this->data['companyname'] = $company[0]['company'];
		$this->load->view('removalreview',$this->data);
	}
	
	public function resolution($reviewid)
	{
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		   	$this->session->set_userdata('last_url','review/resolution/'.$reviewid);
		}
		
		$companyid = $this->session->userdata['youg_admin']['id'];

		$this->data['review'] = $this->reviews->review_mail($reviewid, $companyid);
		$this->load->view('review', $this->data);
	}
	
	function mail($site_name,$site_email,$site_url,$to,$subject,$mail)
	{
			$this->email->from($site_email,$site_name);
			$this->email->to($to);
			$this->email->subject($subject);	
			$this->email->message($mail);		
	}
	
	public function review_refund()
	{
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		}
		
		if($this->input->post('submit'))
		{
			
			$config['upload_path'] = '../uploads/proof/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000000';
			$config['max_width']  = '1024000';
			$config['max_height']  = '768000';
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('refundproof'))
			{
				$title = $this->input->post('refundproof') ;	
				$imgdata = $this->upload->data();
				
				$data = array(
					'proof' => $imgdata['file_name'],
					'status' 		=> '2',
					'checkdate' => date('Y-m-d')
					);	
		
			$id = $this->input->post('id');
			$userid = $this->input->post('userid');
			$companyid = $this->input->post('companyid');
			$reviewid = $this->input->post('reviewid');
			
			$this->reviews->reviewmail_update($data, $id);
			
			$this->load->library('email');	
			
			$user 		= $this->settings->get_user_byid($userid);
			$company 	= $this->settings->get_company_byid($companyid);
			
			$site_name  = $this->settings->get_setting_value(1);
			$site_email = $this->settings->get_setting_value(5);
			$site_url   = $this->settings->get_setting_value(2);
		
			
			$mail_msg = $this->settings->get_email_byid(30);
			$subject  = str_replace("%reviewid%", $reviewid, stripslashes($mail_msg[0]['subject']));
			$mail     = str_replace("%url%", site_url('../review/proof/'.$reviewid), str_replace("%reviewid%", $reviewid, str_replace("%siteurl%", $site_url, str_replace("%company%", ucfirst($company[0]['company']), str_replace("%name%", ucfirst($user[0]['firstname']." ".$user[0]['lastname']), stripslashes($mail_msg[0]['mailformat']))))));			
			$to 	  = $user[0]['email'];
						
			$this->mail($site_name, $site_email, $site_url, $to, $subject, $mail);
			$this->email->send();
			
			redirect("review/reviews","refresh");
			
			}
		}
	}
	
	public function review_gift()
	{
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		}
		
		if($this->input->post('submit'))
		{
			
			$config['upload_path'] = '../uploads/proof/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000000';
			$config['max_width']  = '1024000';
			$config['max_height']  = '768000';
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('refundproof'))
			{
				$title = $this->input->post('refundproof') ;	
				$imgdata = $this->upload->data();
				
				$data = array(
					'proof' => $imgdata['file_name'],
					'status' 		=> '2',
					'checkdate' => date('Y-m-d')
					);	
		
			$id = $this->input->post('id');
			$userid = $this->input->post('userid');
			$companyid = $this->input->post('companyid');
			$reviewid = $this->input->post('reviewid');
			
			$this->reviews->reviewmail_update($data, $id);
			
			$this->load->library('email');	
			
			$user 		= $this->settings->get_user_byid($userid);
			$company 	= $this->settings->get_company_byid($companyid);
			
			$site_name  = $this->settings->get_setting_value(1);
			$site_email = $this->settings->get_setting_value(5);
			$site_url   = $this->settings->get_setting_value(2);
		
			
			$mail_msg = $this->settings->get_email_byid(39);
			$subject  = str_replace("%reviewid%", $reviewid, stripslashes($mail_msg[0]['subject']));
			$mail     = str_replace("%url%", site_url('../review/proof/'.$reviewid), str_replace("%reviewid%", $reviewid, str_replace("%siteurl%", $site_url, str_replace("%company%", ucfirst($company[0]['company']), str_replace("%name%", ucfirst($user[0]['firstname']." ".$user[0]['lastname']), stripslashes($mail_msg[0]['mailformat']))))));			
			$to 	  = $user[0]['email'];
						
			$this->mail($site_name, $site_email, $site_url, $to, $subject, $mail);
			$this->email->send();
			
			redirect("review/reviews","refresh");
			
			}
		}
	}
	
	public function	review_updates()
	{
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		}
		
		if($this->input->post('submit'))
		{
			$data = array(
			'carrier'	 	=> $this->input->post('carrier'),
			'trackingno' 	=> $this->input->post('trackingno'),
			'dateshipped' 	=> $this->input->post('dateshipped'),
			'status' 		=> '2',
			'checkdate' 	=> date('Y-m-d')
			);
			
			$id = $this->input->post('id');
			$userid = $this->input->post('userid');
			$companyid = $this->input->post('companyid');
			$reviewid = $this->input->post('reviewid');
			
			$this->reviews->reviewmail_update($data, $id);
			$reviewmail = $this->reviews->get_reviewmail_byreviewid($reviewid);
			$option = $reviewmail['resolution'];
			$this->load->library('email');	
			
			$user 		= $this->settings->get_user_byid($userid);
			$company 	= $this->settings->get_company_byid($companyid);
			
			$site_name  = $this->settings->get_setting_value(1);
			$site_email = $this->settings->get_setting_value(5);
			$site_url   = $this->settings->get_setting_value(2);
		
			if($option == 'Ship the Item and/or Provide Proof of Shipping')
			{
			$mail_msg = $this->settings->get_email_byid(23);
			$subject  = str_replace("%reviewid%", $reviewid, stripslashes($mail_msg[0]['subject']));
			$mail     = str_replace("%carrier%", $this->input->post('carrier'), str_replace("%trackingno%", $this->input->post('trackingno'), str_replace("%dateshipped%", $this->input->post('dateshipped'),str_replace("%reviewid%", $reviewid, str_replace("%siteurl%", $site_url, str_replace("%company%", ucfirst($company[0]['company']), str_replace("%name%", ucfirst($user[0]['firstname']." ".$user[0]['lastname']), stripslashes($mail_msg[0]['mailformat']))))))));			
			$to 	  = $user[0]['email'];
						
			$this->mail($site_name, $site_email, $site_url, $to, $subject, $mail);
			if($this->email->send())
			{
				$this->reviews->delete_review_byid($reviewid);
				$this->reviews->delete_comment($reviewid);
				$this->reviews->delete_reviewmail($reviewid);
			}
			}
			if($option == 'Would like the missing items to be shipped immediately')
			{
			$mail_msg = $this->settings->get_email_byid(37);
			$subject  = str_replace("%reviewid%", $reviewid, stripslashes($mail_msg[0]['subject']));
			$mail     = str_replace("%url%", site_url('../review/replacement/'.$reviewid), str_replace("%carrier%", $this->input->post('carrier'), str_replace("%trackingno%", $this->input->post('trackingno'), str_replace("%dateshipped%", $this->input->post('dateshipped'),str_replace("%reviewid%", $reviewid, str_replace("%siteurl%", $site_url, str_replace("%company%", ucfirst($company[0]['company']), str_replace("%name%", ucfirst($user[0]['firstname']." ".$user[0]['lastname']), stripslashes($mail_msg[0]['mailformat'])))))))));			
			$to 	  = $user[0]['email'];
						
			$this->mail($site_name, $site_email, $site_url, $to, $subject, $mail);
			$this->email->send();
			}
			redirect("review/reviews","refresh");
		}
	}
	
	public function	review_replacement()
	{
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		}
		
		if($this->input->post('submit'))
		{
			$data = array(
			'new_carrier'	 	=> $this->input->post('carrier'),
			'new_trackingno' 	=> $this->input->post('trackingno'),
			'new_dateshipped' 	=> $this->input->post('dateshipped'),
			'status' 			=> '2',
			'checkdate' 		=> date('Y-m-d')
			);
			
			$id = $this->input->post('id');
			$userid = $this->input->post('userid');
			$companyid = $this->input->post('companyid');
			$reviewid = $this->input->post('reviewid');
			
			$this->reviews->reviewmail_update($data, $id);
			
			$this->load->library('email');	
			
			$user 		= $this->settings->get_user_byid($userid);
			$company 	= $this->settings->get_company_byid($companyid);
			
			$site_name  = $this->settings->get_setting_value(1);
			$site_email = $this->settings->get_setting_value(5);
			$site_url   = $this->settings->get_setting_value(2);
		
			
			$mail_msg = $this->settings->get_email_byid(34);
			$subject  = str_replace("%reviewid%", $reviewid, stripslashes($mail_msg[0]['subject']));
			$mail     = str_replace("%url%", site_url('../review/replacement/'.$reviewid), str_replace("%carrier%", $this->input->post('carrier'), str_replace("%trackingno%", $this->input->post('trackingno'), str_replace("%dateshipped%", $this->input->post('dateshipped'),str_replace("%reviewid%", $reviewid, str_replace("%siteurl%", $site_url, str_replace("%company%", ucfirst($company[0]['company']), str_replace("%name%", ucfirst($user[0]['firstname']." ".$user[0]['lastname']), stripslashes($mail_msg[0]['mailformat'])))))))));			
			$to 	  = $user[0]['email'];
						
			$this->mail($site_name, $site_email, $site_url, $to, $subject, $mail);
			$this->email->send();
	
			redirect("review/reviews","refresh");
		}
	}
	
	public function request($reviewid='',$userid='')
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		if($reviewid!='' && $reviewid!=0 && $userid!='' && $userid!=0)
		 {
			if( $this->session->userdata['youg_admin'] )
	  		 {
					$rid = base64_encode($reviewid);
									
					$companyid = $this->session->userdata['youg_admin']['id'];
				
					$company=$this->companys->get_company_byid($companyid);
					$user=$this->settings->get_user_byid($userid);
					$review=$this->reviews->get_mainreview_byid($reviewid);
					
					$site_name = $this->settings->get_setting_value(1);
					$site_url  = $this->settings->get_setting_value(2);
					$site_mail = $this->settings->get_setting_value(5);
					
					
					//Loading E-mail library
					$this->load->library('email');
					
					//Loading E-mail config file
					$this->config->load('email',TRUE);
					
					//Payment mail for Admin
					$from = $company[0]['email'];
					$subject = 'Request for Information About Your Review:  Case #YGR-'.$reviewid;
					$to = $user[0]['email'];
				
					$this->email->from($site_mail,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
				
					$mailbody = 
					"<table>
						
						<label style='color: #B32317; font-size: 23px; padding: 15px 0;'> 
								You filed a Negative Review and the Merchant would like to have it removed. 
						</label>
						
						<tr>
							<td>
								<ul style='font-size : 16px; list-style : none; padding : 10px 0; margin : 0;'>
								
									<li style='font-size : 13px; margin: 20px 0;  padding : 0;'>Hello ".ucwords($user[0]['firstname'].' '.$user[0]['lastname']).",</li>
									
									<li style='margin: 8px 0 4px; padding : 0 0 0 15px;'> Your merchant has received your Negative </li>								
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> Review and would like to work out a </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> solution with you. </li>
									
									<li style='margin: 30px 0 4px; padding : 0 0 0 15px;'> By communicating directly with the </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> merchant through YouGotRated you can </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> reach a satisfactory resolution to your </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> complaint that can be mutually beneficial. </li>
									
									<li style='margin: 30px 0 4px; padding : 0 0 0 15px;'> Please note that the reason you are </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> receiving this email is because the </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> Merchant is already aware of your </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> complaint and has pledged his willingness </li>
									<li style='margin: 4px 0; padding : 0 0 0 15px;'> to assist you.  </li>
									
									
									<li style='font-size : 13px; margin: 30px 0 4px; padding : 0 0 0 15px;'>In the next page you will have several options that you </li>
									<li style='font-size : 13px; margin: 4px 0; padding : 0 0 0 15px;'>can choose from that will be emailed to the Merchant on </li>
									<li style='font-size : 13px; margin: 4px 0; padding : 0 0 0 15px;'>your behalf in order to resolve your complaint. </li>
									
									
									<li style='font-size : 13px; margin: 30px 0 4px; color : #347C91; padding : 0 0 0 15px; font-weight : bold;'> Please Reply to this email here with your selection. </li>
																		
  									<li style='margin: 4px 0; padding : 0 0 0 15px;'><a href='".'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].('/review/buyerreview/'.$user[0]['id'].'/'.$company[0]['id'])."'><img src='".$site_url."images/go.gif'></a></li>

									<li style='font-size : 13px; margin: 25px 0 8px; padding : 0 0 0 15px;'> Sincerely, </li>

									<li style='font-size : 13px; margin: 8px 0; padding : 0 0 0 15px;'>YouGotRated </li>

									<li style='font-size : 13px; margin: 8px 0; padding : 0 0 0 15px;'> BC:  YGR-".$reviewid." </li>
									
								</ul>
							</td>
							<td style = 'display : block;'>
								<ul style = 'list-style : none;'>
									<li><img src='".$site_url."images/email.jpg'></li>
								</ul>
							</td>
						</tr>
					</table>
					";
				
					$this->email->message($mailbody);
					
					//Sending mail to Admin
					if($this->email->send())
			 		{
						$this->session->set_flashdata('success', 'Request for review removal has been sent successfully to user.');
						if($this->reviews->insert_review_status($companyid,$reviewid))
						{
							$id = $this->db->insert_id();
							if($this->reviews->update_checkdate($id,$companyid,$reviewid))
							{
								redirect('review/removalrequest', 'refresh');
							}
							else
							{
								//$this->session->set_flashdata('error', 'There is error in sending request. Try later!');
								redirect('review/reviews', 'refresh');				
							}
						}
						else
						{
								//$this->session->set_flashdata('error', 'There is error in sending request. Try later!');
								redirect('review/reviews', 'refresh');
						}
					}
					else
					{
								$this->session->set_flashdata('error', 'There is error in sending request. Try later!');
								redirect('review/reviews', 'refresh');
					}
					
					//Loading View File
				$this->load->view('review',$this->data);
	     	 }
			else
			{
				redirect('adminlogin','refresh');
			}
	     }
		 else
		 {
				redirect('review/reviews','refresh');
		 }
	}
		
		public function feedback($reviewid='',$userid='',$status='')
		{
			$rid = base64_decode($reviewid);
			$site_url  = $this->settings->get_setting_value(2);
			$clickstatus = $this->reviews->get_reviewstatus_by_reviewid($rid);
			
			if($reviewid!='' &&  $userid!='')
		 	{
				$date1 = date("Y-m-d H:i:s");
				$date2 = $clickstatus[0]['checkdate'];
				$diff = abs(strtotime($date2) - strtotime($date1));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						
				if($days <=5)			
				{
					if($clickstatus[0]['click']=="No")
					{
		 					if($status=='agree')
							{
								if($this->reviews->disable_review_byid($rid))
								{
									redirect($site_url.'welcome/feedback', 'refresh');
								}
							}
							if($status=='disagree')
							{
	
								if($this->reviews->enable_review_byid($rid))
								{
									redirect($site_url.'welcome/feedback', 'refresh');
								}
							}
					}
					else
					{
						redirect($site_url, 'refresh');
					}
				}
				else
				{
					redirect($site_url, 'refresh');
				}
			
			}
			else
			{
				redirect($site_url,'refresh');
			}
		}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
