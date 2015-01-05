<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class User extends CI_Controller {

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
		//$this->load->library('recaptchalib');
		//Loading Model File
	  	$this->load->model('users');
		require('recaptchalib.php');
		
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
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'register' )
		{
   			$this->data['title'] = 'User Registration';
				$this->data['section_title'] = 'User Registration';
		}
		else if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'edit' )
		{
   			$this->data['title'] = 'Edit Account';
				$this->data['section_title'] = 'Edit Account';
		}
		else if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'changepassword' )
		{
   			$this->data['title'] = 'Change Password';
				$this->data['section_title'] = 'Change Password';
		}
		else if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'complaints' )
		{
   			$this->data['title'] = 'Complaints';
				$this->data['section_title'] = 'Complaints';
		}
		else if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'comments' )
		{
   			$this->data['title'] = 'Comments';
				$this->data['section_title'] = 'Comments';
		}
		else
		{
			$this->data['title'] = 'Users';
			$this->data['section_title'] = 'Users';
		}
		
		//Load header and save in variable
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('welcome', 'refresh');
		}
		else
		{
			$id = $this->session->userdata['youg_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
		
			$id = $this->session->userdata['youg_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
			$this->data['complaints']=$this->users->get_all_complaintsby_userid($id);
			$this->data['comments']=$this->users->get_all_commentsby_userid($id);
			
			//Loading View File
			$this->load->view('user',$this->data);
		}
	}
	
	public function register()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
	  {
		//Loading View File
		$this->load->view('user/register',$this->data);
		}
		else
		{
			redirect('user','refresh');
		}
	}
	
	public function edit()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login', 'refresh');
		}
		else if($this->session->userdata['youg_user'])
	  	{
			$id = $this->session->userdata['youg_user']['userid'];
			if(!$id)
			{
				redirect('login', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if( count($this->data['user'])>0 )
			{			
				//Loading View File
				$this->load->view('user/edit',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
			}
		}
	}
	
	public function changepassword()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login', 'refresh');
		}
		else if($this->session->userdata['youg_user'])
	  	{
			$id = $this->session->userdata['youg_user']['userid'];
			if(!$id)
			{
				redirect('login', 'refresh');
			}
					
			//Getting detail for displaying in form
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if( count($this->data['user'])>0 )
			{			
				//Loading View File
				$this->load->view('user/changepassword',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
			}
		}
	}
	
	//Updating the Record
	public function update()
	{
		
		//If Old Record Update
		if( $this->input->post('id') && $this->input->post('firstname'))
		{
			//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$firstname = addslashes($this->input->post('firstname'));
				$lastname = addslashes($this->input->post('lastname'));
				$email = ($this->input->post('email'));
				$password = addslashes($this->input->post('password'));
				$gender = addslashes($this->input->post('gender'));
				$street = $this->input->post('street');
				$phoneno = $this->input->post('phoneno');
				$city = addslashes($this->input->post('city'));
				$state = addslashes($this->input->post('state'));
				$zipcode = addslashes($this->input->post('zipcode'));
				
				$username = addslashes($this->input->post('username'));
				
				if(count($_FILES)>0)
				{
					if(count($_FILES['avatarbig'])>0)
					{
						if( $_FILES['avatarbig']['name']!='' && $_FILES['avatarbig']['size'] > 0 )
						{
							//load library
							$this->load->library('upload');
			
							//Uploading Cover Image and creating Thumb
							$config['upload_path'] = $this->config->item('user_main_upload_path');
							$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
							$config['max_size']	= $this->config->item('user_main_max_size');
							$config['max_width']  = $this->config->item('user_main_max_width');
							$config['max_height']  = $this->config->item('user_main_max_height');
							$config['remove_spaces'] = TRUE;
							$a = explode('.',$_FILES['avatarbig']['name']);
							$ex = end($a);
							$main = str_replace('.'.$ex,'',$_FILES['avatarbig']['name']);
							$config['file_name'] = $main.date('YmdHis');
							
							// Initialize the new config
							$this->upload->initialize($config);
							//Uploading Image
							$this->upload->do_upload('avatarbig');
							
							//Getting Uploaded Image File Data
							$imgdata = $this->upload->data();
							$imgerror = $this->upload->display_errors();

							if( $imgerror == '' )
							{
								//Configuring Thumbnail 
								$config['image_library'] = 'gd2';
								$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
								$config['new_image'] = $this->config->item('user_thumb_upload_path').$imgdata['file_name'];
								$config['create_thumb'] = TRUE;
								$config['maintain_ratio'] = FALSE;
								$config['thumb_marker'] = '';
								$config['width'] = $this->config->item('user_thumb_width');
								$config['height'] = $this->config->item('user_thumb_height');
								
								//Loading Image Library
								$this->load->library('image_lib', $config);
										
								//Creating Thumbnail
								$this->image_lib->resize();
								$thumberror = $this->image_lib->display_errors();
							}
							else
							{
								$thumberror= '';
							}
								
							if( $imgerror != '' || $thumberror != '' )
							{
								$error[0] = $imgerror;
								$error[1] = $thumberror;
							}
							else
							{
								$error = array();
							}
							
							if( count($error)==0 && count($imgdata) > 0 )
							{
								//Unlink Old Images
								$media = $this->users->get_user_byid($id);
								if( count($media)>0 )
								{
									if( $media[0]['avatarbig']!='' )
									{
										//Deleting main file
										if( file_exists($this->config->item('user_main_upload_path').$media[0]['avatarbig']) )
										{											
											unlink($this->config->item('user_main_upload_path').$media[0]['avatarbig']);
										}
										//Deleting thumbnail
										if( file_exists($this->config->item('user_thumb_upload_path').$media[0]['avatarbig']) )
										{											
											unlink($this->config->item('user_thumb_upload_path').$media[0]['avatarbig']);
										}
									}
								}
							
								//Updating Record With Image
								if( $this->users->update($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$imgdata['file_name'],$imgdata['file_name'],$username) )
								{
									$this->session->set_flashdata('success', 'user details updated successfully.');
									redirect('user', 'refresh');;
								}
								else
								{
				
									$this->session->set_flashdata('error', 'There is error in updating user. Try later!');
									redirect('user', 'refresh');
								}
							}
							else
							{
								//Error in upload
								$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
								
								redirect('user','refresh');
							}
						}
						else
						{
							//Updating Record Without Image
							if( $this->users->update_noimage($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$username) )
							{
								$this->session->set_flashdata('success', 'user updated successfully.');
								redirect('user', 'refresh');
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in updating user. Try later!');
								redirect('user', 'refresh');
							}
						}
				}
			}
		}

		//If New Record Insert
		else if( $this->input->post('terms') )
		{
			$this->session->unset_userdata('olddata');
			$email = addslashes($this->input->post('email'));
			$result = $this->users->chkfield(0,'email',$email);
			if($result=='old')
			{
					$this->session->set_flashdata('error', 'This email address is already registered. Try later!');
					redirect('go/register', 'refresh');
			}
			
			
			//Getting value
			$uniqueid = uniqid();
			
			$username = addslashes($this->input->post('username'));
			$firstname = addslashes($this->input->post('firstname'));
			$lastname = addslashes($this->input->post('lastname'));
			//$email = addslashes($this->input->post('email'));
			$password = addslashes($this->input->post('password'));
			$gender = addslashes($this->input->post('gender'));
			
			$city = addslashes($this->input->post('city'));
			$state = addslashes($this->input->post('state'));
			$zipcode = addslashes($this->input->post('zipcode'));
			
			$terms = addslashes($this->input->post('terms'));
			$street = implode(',',$this->input->post('street'));
			$phoneno = implode('',$this->input->post('phoneno'));			

			$publickey = "6LervvQSAAAAAN853Cz4_bSGZw_RecoxnWudpVfA";
			$privatekey = "6LervvQSAAAAACoH9Voy49fMfMWyHgwbhO7qo6PW";
			
			if( array_key_exists('recaptcha_challenge_field',$_POST) ) {
			
			if ( array_key_exists('recaptcha_response_field',$_POST) ) {

        	$resp = recaptcha_check_answer ($privatekey,

                                        $_SERVER["REMOTE_ADDR"],

                                        $_POST["recaptcha_challenge_field"],

                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {$this->session->unset_userdata('olddata');}
		else {
        		//$error = $resp->error;
				
				
				$olddata = array('email'			=> $email,
										'firstname'		=> $firstname,
										'lastname'		=> $lastname,
										'street'		=> $this->input->post('street'),
										'city'			=> $city,
										'state'			=> $state,
										'username'		=> $username,
										'zipcode'		=> $zipcode,
										'phoneno'		=> $this->input->post('phoneno'),
										'username'		=> $username,
										'password'		=> $password);
				
				
				$this->session->set_userdata('olddata',$olddata);
				
			 $this->session->set_flashdata('error', 'Wrong Captcha entered try again.');
					redirect('go/register', 'refresh');
			 }
			 
			}
			}

			
			
			if(count($_FILES)>0)
				{
					if(count($_FILES['avatarbig'])>0)
					{
						
						if( $_FILES['avatarbig']['name']!='' && $_FILES['avatarbig']['size'] > 0 )
						{
							
			//load library
			$this->load->library('upload');

			//Uploading Cover Image and creating Thumb
			$config['upload_path'] = $this->config->item('user_main_upload_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
			$config['max_size']	= $this->config->item('user_main_max_size');
			$config['max_width']  = $this->config->item('user_main_max_width');
			$config['max_height']  = $this->config->item('user_main_max_height');
			$config['remove_spaces'] = TRUE;
			$a = explode('.',$_FILES['avatarbig']['name']);
			$ex = end($a);
			$main = str_replace('.'.$ex,'',$_FILES['avatarbig']['name']);
			$config['file_name'] = $main.date('YmdHis');
			
			// Initialize the new config
			$this->upload->initialize($config);
			//Uploading Image
			$this->upload->do_upload('avatarbig');
			
			//Getting Uploaded Image File Data
			$imgdata = $this->upload->data();
			$imgerror = $this->upload->display_errors();

			if( $imgerror == '' )
			{
				//Configuring Thumbnail 
				$config['image_library'] = 'gd2';
				$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
				$config['new_image'] = $this->config->item('user_thumb_upload_path').$imgdata['file_name'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = FALSE;
				$config['thumb_marker'] = '';
				$config['width'] = $this->config->item('user_thumb_width');
				$config['height'] = $this->config->item('user_thumb_height');
				
				//Loading Image Library
				$this->load->library('image_lib', $config);
						
				//Creating Thumbnail
				$this->image_lib->resize();
				$thumberror = $this->image_lib->display_errors();
			}
			else
			{
				$thumberror= '';
			}
				
			if( $imgerror != '' || $thumberror != '' )
			{
				$error[0] = $imgerror;
				$error[1] = $thumberror;
			}
			else
			{
				$error = array();
			}
			/*print_r($error);
			*/
			//die();
			if( count($error)==0 && count($imgdata) > 0 )
			{
				//Inserting Record
				if( $updated = $this->users->insert($uniqueid,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$imgdata['file_name'],$imgdata['file_name'],$terms,$username) )
				{
					$this->session->unset_userdata('olddata');
					$newuniqueid = $uniqueid;
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_email = $this->common->get_setting_value(5);
					
					// user Mail
					$to = $email;
					$mail = $this->common->get_email_byid(1);

					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['mailformat'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
				
					$activationlink = "<a href='".site_url('user/enable/'.$newuniqueid)."' title='Activate your Account' target='_blank'>".site_url('user/enable/'.$newuniqueid)."</a>";
            	
					$mail_body = str_replace("%firstname%",ucfirst($firstname),str_replace("%lastname%",ucfirst($lastname),str_replace("%email%",$email,str_replace("%password%",$password,str_replace("%link%",$activationlink,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))))));
					
					$this->email->message($mail_body);
					$this->email->send();
							
					// Admin Mail
					$to = $site_email;
					$mail = $this->common->get_email_byid(3);
			
					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['mailformat'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
					
					$mail_body = str_replace("%firstname%",$firstname,str_replace("%lastname%",$lastname,str_replace("%email%",$email,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))));
					
					$this->email->message($mail_body);
					$this->email->send();
					
					$this->session->set_flashdata('success', 'Registration Successful. Activation link has been sent to your email. Activate your account to log in.');
					redirect('login', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in inserting user. Try later!');
					redirect('user', 'refresh');
				}
			}
			else
			{
				//Error in upload
				$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
				redirect('user','refresh');
			}
		}
						else
						{
					//Inserting Record
					if( $updated = $this->users->insert_noimage($uniqueid,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$terms,$username) )
					{
					$newuniqueid = $uniqueid;
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_email = $this->common->get_setting_value(5);
					
					// user Mail
					$to = $email;
					$mail = $this->common->get_email_byid(1);

					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['mailformat'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
				
					$activationlink = "<a href='".site_url('user/enable/'.$newuniqueid)."' title='Activate your Account' target='_blank'>".site_url('user/enable/'.$newuniqueid)."</a>";
            	
					$mail_body = str_replace("%firstname%",ucfirst($firstname),str_replace("%lastname%",ucfirst($lastname),str_replace("%email%",$email,str_replace("%password%",$password,str_replace("%link%",$activationlink,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))))));
					
					$this->email->message($mail_body);
					$this->email->send();
							
					// Admin Mail
					$to = $site_email;
					$mail = $this->common->get_email_byid(3);
			
					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['mailformat'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
					
					$mail_body = str_replace("%firstname%",$firstname,str_replace("%lastname%",$lastname,str_replace("%email%",$email,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))));
					
					$this->email->message($mail_body);
					$this->email->send();
					
					$this->session->set_flashdata('success', 'Registration Successful. Activation link has been sent to your email. Activate your account to log in.');
					redirect('login', 'refresh');
				}
					else
					{
					$this->session->set_flashdata('error', 'There is error in inserting user. Try later!');
					redirect('user', 'refresh');
				}
				}
					}
				}
		}
		//If Old Record Update
		else if( $this->input->post('userpassid') )
	  	{			
			//Getting intid
			$id = $this->encrypt->decode($this->input->post('userpassid'));
			
			//Getting value
			$oldpassword = ($this->input->post('oldpassword'));			
			$newpassword = ($this->input->post('newpassword'));
			
			//Getting detail for displaying in form
			$user = $this->users->get_user_byid($id);
		
			if(count($user)>0)
			{
				$useroldpassword = $user[0]['password'];
				
				if( $oldpassword == $useroldpassword )
				{
					//Addingg Result to view parameter
					if( $this->users->update_password($id,$newpassword) )
					{					
						//Loading View File
						$this->session->set_flashdata('success', 'Password has been Updated Successfully.');
						redirect('user', 'refresh');
					}
					else
					{
						//Loading View File
						$this->session->set_flashdata('error', 'Password not updated. Try later.');
						redirect('user/changepassword', 'refresh');
					}
				}
				else
				{
					//Loading View File
					$this->session->set_flashdata('error', 'Old password you gave is incorrect.');
					redirect('user/changepassword', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
			}
		}
		else
		{
			redirect('user', 'refresh');
		}

	}
	
	//Function For Change Status to "Enable"
	public function enable($newuniqueid)
	{
		if(!$newuniqueid)
		{
			redirect('user', 'refresh');
		}
					
		if( $this->users->enable_user_byuniqueid($newuniqueid) )
		{
			$this->session->set_flashdata('success', 'Your account has been activated successfully.');
			redirect('login', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'There is error in updating account status. Try later!');
			redirect('login', 'refresh');
		}
	}
	
	//Function to Check E-mail is already exists
	public function fieldcheck()
	{
		if( $this->input->is_ajax_request() && ( $this->input->post('email') || $this->input->post('username') ))
	  	{
			if( $this->input->post('id') )
			{
				$id = $this->input->post('id');
			}
			else
			{
				$id = 0;
			}
			if( $this->input->post('email') )
			{
				$field = 'email';
				$fieldvalue = addslashes($this->input->post('email'));
			}
			if( $this->input->post('username') )
			{
				$field = 'username';
				$fieldvalue = addslashes($this->input->post('username'));
			}
			
			if($field)
			{
				//Loading Model File
	  			$this->load->model('users');
				//Addingg Result to view parameter
				$result = $this->users->chkfield($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('user', 'refresh');
		}
	}
	
	//Function for Logout
	public function logout()
	{
		if( array_key_exists('youg_user',$this->session->userdata ) )
		{
			$this->session->set_flashdata('success', 'You have been successfully logged out.');
			
			$this->session->unset_userdata('youg_user');
			
			redirect('login', 'refresh');
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
	
	public function complaints()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login', 'refresh');
		}
		else
		{
			$id = $this->session->userdata['youg_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if(!$id)
			{
				redirect('user','refresh');
			}
			
			$this->data['complaints']=$this->users->get_all_complaintsby_userid($id);
			
			$this->load->view('user',$this->data);
		}
	}
	
	public function comments()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login', 'refresh');
		}
		else
		{
			$id = $this->session->userdata['youg_user']['userid'];
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if(!$id)
			{
				redirect('user','refresh');
			}
			
			$this->data['comments']=$this->users->get_all_commentsby_userid($id);
			$this->load->view('user',$this->data);
		}
	}
	public function disputes()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login', 'refresh');
		}
		else
		{
			$id = $this->session->userdata['youg_user']['userid'];
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if(!$id)
			{
				redirect('user','refresh');
			}
			
			$this->data['disputes']=$this->users->get_all_disputesby_userid($id);
			$this->load->view('user',$this->data);
		}
	}
	public function myratings()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			redirect('login', 'refresh');
		}
		else
		{
			$id = $this->session->userdata['youg_user']['userid'];
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if(!$id)
			{
				redirect('user','refresh');
			}
			
			$this->data['myratings']=$this->users->get_all_rating($id);
			$this->load->view('user',$this->data);
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
