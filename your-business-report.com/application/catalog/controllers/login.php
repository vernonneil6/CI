<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Login extends CI_Controller {

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
	* @see http://codeigniter.com/user_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
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
		
		if( $this->session->userdata('youg_user') )
	  	{
				redirect('user','refresh');
		}
		
	  	$this->load->model('logins');
		$this->load->model('complaints');
		

		if($this->uri->segment(1) == 'login' && $this->uri->segment(2) == '')
		{
   		$this->data['title'] =  $this->common->get_setting_value(1).' : Log In';
		}
		else if( $this->uri->segment(2) == 'forgot' )
		{
   		$this->data['title'] =  $this->common->get_setting_value(1).' : Forgot Password';
		}
		else
		{
			if( !array_key_exists('youg_user',$this->session->userdata) )
			{
				$this->data['title'] =  $this->common->get_setting_value(1).' : Log In';
			}
		}
		$this->data['section_title'] = 'Login';
		
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		//echo "<pre>";
		//print_r( $this->data['total'] );
		//die();
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{  
	  if(!$this->session->userdata('youg_user') )
	  { 
		  if( $this->input->post('email') && $this->input->post('password') )
		  {
			$lasturl = $this->encrypt->decode($this->input->post('last_url'));  
			
			$user_email = $this->input->post('email');
			$user_pass = $this->input->post('password');

			//query the database
			$result = $this->logins->logincheck($user_email, $user_pass);
			
			if( $result == 'noallow' )
			{
				$this->session->set_flashdata('error', 'You are not allowed to login.');
				redirect('login', 'refresh');
			}
			
			if($result != 'notfound')
			{     
				  foreach($result as $key=>$val)
				  {
					  $sess_array[$key] = $val;
				  }
				  $this->session->set_userdata('youg_user', $sess_array);
                  if($lasturl != '')
				  {
					  redirect($lasturl, 'refresh');
				  }
				  else
				  {
					
					if( array_key_exists('complaintarray',$this->session->userdata))
					{
						//echo "<pre>";
						//print_r($this->session->userdata);
						//die();
						
						$userid = $this->session->userdata['youg_user']['userid'];
						$type = $this->session->userdata['complaintarray']['type'];
						$companyid = $this->session->userdata['complaintarray']['companyid'];
						$damagesinamt = $this->session->userdata['complaintarray']['damagesinamt'];
						$whendate = $this->session->userdata['complaintarray']['whendate'];
						$location = $this->session->userdata['complaintarray']['location'];
						$detail = $this->session->userdata['complaintarray']['detail'];
						$username = $this->session->userdata['complaintarray']['username'];
						$emailid = $this->session->userdata['complaintarray']['emailid'];
						$company = $this->session->userdata['complaintarray']['company'];
						$company1 = $this->session->userdata['complaintarray']['company1'];
						$city = $this->session->userdata['complaintarray']['city'];
						$state = $this->session->userdata['complaintarray']['state'];
						$zip = $this->session->userdata['complaintarray']['zip'];
						$phone = $this->session->userdata['complaintarray']['phone'];
						$email = $this->session->userdata['complaintarray']['email'];
						$siteurl = $this->session->userdata['complaintarray']['siteurl']; 
								
						
						$relation = $this->common->get_relation_byciduid($companyid,$userid);
						$elitemem = $this->complaints->get_eliteship_bycompanyid($companyid);
						if(count($elitemem)>0)
						{
							if(count($relation)>0)
							{
								if($relation[0]['status']=='Decline')
								{
									if($this->complaints->insert($type,$companyid,$userid,$damagesinamt,$whendate,$location,$detail,$username,$emailid,$statusdisable='yes'))
									{
										$this->session->set_flashdata('success', 'Complaint submitted successfully.');
										redirect('user', 'refresh');
									}
									else
									{
										$this->session->set_flashdata('error', 'There is error in submitting complaint. Try later!');
										redirect('user', 'refresh');
									}
								}
								else
								{
								
									if( $updated = $this->complaints->insert($type,$companyid,$userid,$damagesinamt,$whendate,$location,$detail,$username,$emailid,'yes'))
								{	
								$com = $this->complaints->get_company_byid($companyid);
						
							if(count($com)>0)
							{
								$companyemailaddress = $com[0]['email'];
							}
							
							$site_name = $this->common->get_setting_value(1);
							$site_url = $this->common->get_setting_value(2);
							$site_email = $this->common->get_setting_value(5);
					
							// Company Mail
							$to = $companyemailaddress;
							$mail = $this->common->get_email_byid(5);
		
							$subject = $mail[0]['subject'];
							$mailformat = $mail[0]['mailformat'];
							
							$this->load->library('email');
							$this->email->from($site_email,$site_name);
							$this->email->to($to);
							$this->email->subject($subject);
						
							$link = "<a href='".site_url('complaint/browse/'.$updated)."' title='see complaint' target='_blank'>".site_url('complaint/browse/'.$updated)."</a>";
						
							$mail_body = str_replace("%company%",ucfirst($company1),str_replace("%emailid%",$emailid,str_replace("%link%",$link,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))));
							
							$this->email->message($mail_body);
							//$this->email->send();
							//echo "<pre>";
							//print_r($mail_body);
							//die();
							
							unset($this->session->userdata['complaintarray']);
							if($this->email->send())
							{
								$this->session->set_flashdata('success', 'Complaint submitted successfully.');
								//$this->session->set_flashdata('success', 'You have logged in successfully.');
								redirect('user', 'refresh');
							}
							else
							{
								redirect('user', 'refresh');
							}
						}
								}
							}
							else{
						
					if($updated = $this->complaints->insert($type,$companyid,$userid,$damagesinamt,$whendate,$location,$detail,$username,$emailid,$statusdisable='yes'))
				{	
					$com = $this->complaints->get_company_byid($companyid);
					$user = $this->common->get_user_byid($userid);
					
					$this->complaints->disable_complaint_byid($updated);
					if(count($com)>0)
					{
						$companyemailaddress = $com[0]['email'];
						$companyname = $com[0]['company'];
					}
					
					if(count($user)>0)
					{
						$fname = $user[0]['firstname'];
						$lname = $user[0]['lastname'];
						$uemail= $user[0]['email'];
					}
					
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_email = $this->common->get_setting_value(5);
					
					// Company Mail
					$to = $companyemailaddress;
					$mail = $this->common->get_email_byid(6);
					
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
            	
					$mail_body = str_replace("%username%",ucfirst($fname.' '.$lname),str_replace("%company%",ucfirst($companyname),str_replace("%useremail%",$uemail,str_replace("%link1%",$link1,str_replace("%link2%",$link2,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))))));
					
					$this->email->message($mail_body);
					
							if($this->email->send())
							{
								$this->session->set_flashdata('success', 'Complaint submitted successfully.');
								redirect(site_url(), 'refresh');
							}
							else
							{
								redirect(site_url(), 'refresh');
							}
			}
				else
				{
					$this->session->set_flashdata('error', 'There is error in inserting complaint. Try later!');
					redirect(site_url(), 'refresh');
				}
			
						}
						}
						else
						{
							
							if( $updated = $this->complaints->insert($type,$companyid,$userid,$damagesinamt,$whendate,$location,$detail,$username,$emailid,'no'))
						{	
							$com = $this->complaints->get_company_byid($companyid);
					
							if(count($com)>0)
							{
								$companyemailaddress = $com[0]['email'];
							}
							
							$site_name = $this->common->get_setting_value(1);
							$site_url = $this->common->get_setting_value(2);
							$site_email = $this->common->get_setting_value(5);
					
							// Company Mail
							$to = $companyemailaddress;
							$mail = $this->common->get_email_byid(5);
		
							$subject = $mail[0]['subject'];
							$mailformat = $mail[0]['mailformat'];
							
							$this->load->library('email');
							$this->email->from($site_email,$site_name);
							$this->email->to($to);
							$this->email->subject($subject);
						
							$link = "<a href='".site_url('complaint/browse/'.$updated)."' title='see complaint' target='_blank'>".site_url('complaint/browse/'.$updated)."</a>";
						
							$mail_body = str_replace("%company%",ucfirst($company1),str_replace("%emailid%",$emailid,str_replace("%link%",$link,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))));
							
							$this->email->message($mail_body);
							//$this->email->send();
							//echo "<pre>";
							//print_r($mail_body);
							//die();
							
							unset($this->session->userdata['complaintarray']);
							if($this->email->send())
							{
								$this->session->set_flashdata('success', 'Complaint submitted successfully.');
								//$this->session->set_flashdata('success', 'You have logged in successfully.');
								redirect('user', 'refresh');
							}
							else
							{
								redirect('user', 'refresh');
							}
						}
						
						}
					}
					else
					{	
						$this->session->set_flashdata('success', 'You have logged in successfully.');
						redirect('user', 'refresh');
					}
				  }
			}
					
			else if($result == 'notfound')
			{  
				$this->session->set_flashdata('error', 'Invalid email id or password.');
				redirect('login', 'refresh');
			}

		}
		$this->load->view('login',$this->data);

	  }
	  else
	  {
		redirect('user','refresh');
	  }
	}
	
	public function update()
	{
	    if($this->input->post('email') != '')
		{
			$site_name = $this->common->get_setting_value(1);
			$site_url = $this->common->get_setting_value(2);
			$site_mail = $this->common->get_setting_value(5);
			
		    //Getting Sign up mail format
		    $mail = $this->common->get_email_byid(2);
			
			$emailid = $this->input->post('email');
			$user = $this->logins->get_user_byemail($emailid);
			
			if(count($user) > 0)
			{
				$firstname = ucfirst($user[0]['firstname']);
			    $lastname = ucfirst($user[0]['lastname']);
				
				//Loading String helper
				$this->load->helper('string');
	
				//Generating activaioncode
				$varpassword = random_string('alnum', 16);
				$updated = $this->logins->set_user_password($emailid,$varpassword);
				
				if( $updated == 'updated' )
				{
					if( count($mail) > 0 )
					{  
						  //Loading E-mail config file
						  $this->config->load('email',TRUE);
						  $this->cnfemail = $this->config->item('email');
							  
						  //Loading E-mail Class
						  $this->load->library('email');
						  
						  $this->email->initialize($this->cnfemail);
						  //E-mail From Id
						  $this->email->from($site_mail,$site_name);
						  
						  //E-mail To Id
						  $this->email->to($emailid);
						  
						  //E-mail To admin
						  $this->email->cc($site_mail); 
						  
						  //E-mail Subject
						  $this->email->subject(stripslashes($mail[0]['subject']));
						  $mail_body = str_replace("%firstname%",$firstname,str_replace("%lastname%",$lastname,str_replace("%email%",$emailid,str_replace("%siteurl%",$site_url,str_replace("%sitename%",$site_name,str_replace("%password%",$varpassword,stripslashes($mail[0]['mailformat'])))))));
						  
	/*					  $site_logo = "<a href='".$site_url."' title='".$site_name."'><img src='".base_url()."images/logo.png' border='0' width='241' height='83' border='0' alt='".$site_name."'></a>";*/
						  $this->email->message("<table cellpadding='0' cellspacing='0'><tr><td>".$mail_body."</td></tr></table>");
	
						  if($this->email->send())
						  {
							$this->session->set_flashdata('forgotsuccess', 'A new password has been sent to your e-mail address.');
							redirect('login/forgot', 'refresh');
						  }
						  else
						  {
							 $this->session->set_flashdata('forgoterror', 'There is an error in sending e-mail, please try again!');
							 redirect('login/forgot', 'refresh');
						  }
	 
					  }
				}
			}
			else
			{
			  $this->session->set_flashdata('forgoterror', 'The e-mail address was not found in our records, please try again!');
			  redirect('login/forgot', 'refresh');
			}
		
		    //Loading View File
			//$this->load->view('login',$this->data);
	
		}
		$this->load->view('login',$this->data);
	}
	
	public function forgot()
	{
		$this->load->view('login',$this->data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */