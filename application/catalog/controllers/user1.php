<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class User extends CI_Controller {

	public $data;
	public $data1;
	
	public function __construct()
 	 {
  	parent::__construct();
		// Your own constructor code
		
		//Loading Model File
	  	$this->load->model('users');
		
		include('include.php');
		
		if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'register' )
		{
   			$this->data['title'] = 'User Registration';

		}
		else if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'edit' )
		{
   			$this->data['title'] = 'Edit Account';

		}
		else if( $this->uri->segment(1) == 'user' && $this->uri->segment(2) == 'changepassword' )
		{
   			$this->data['title'] = 'Change Password';

		}
		else
		{
			$this->data['title'] = 'Dashboard';
		}
		
		$this->data['header'] = $this->load->view('user/headerdashboard',$this->data,true);
	}
	
	public function index()
	{
		if( array_key_exists('cc_user',$this->session->userdata) )
	  {
		 
			$id = $this->session->userdata['cc_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
		
			if(count($this->data['user'])>0)
			{
					$this->data['messages']=$this->users->get_all_messages();
					$this->data['balance']=$this->users->user_getbalance();
					$this->data['orders']=$this->users->user_orders();
					$this->data['ordersbuy']=$this->users->user_ordersbuy();
					$this->data['orderssell']=$this->users->user_orderssell();
					$this->data['ordersactive']=$this->users->user_ordersactive();
					$this->data['ordersdeposit']=$this->users->user_deposits();
					$this->data['orderswithdrawal']=$this->users->user_withdrawal();
					$this->load->view('user/dashboard',$this->data);
			}
			else
			{
				redirect('', 'refresh');
			}
		}
		else
		{
			//$this->session->set_userdata('last_url',$_SERVER['HTTP_REFERER']);
			//$this->session->set_flashdata('error', 'Please login to contiune.');
			redirect('', 'refresh');
		}
	}
	//gets finance data
	
	public function finance()
	{
		
	
		if( array_key_exists('cc_user',$this->session->userdata) )
	  {
		 
			$id = $this->session->userdata['cc_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
		
			if(count($this->data['user'])>0)
			{
					$this->data['messages']=$this->users->get_all_messages();
					$this->data['balance']=$this->users->user_getbalance();
					$this->data['orders']=$this->users->user_orders();
					$this->data['ordersbuy']=$this->users->user_ordersbuy();
					$this->data['orderssell']=$this->users->user_orderssell();
					$this->data['ordersactive']=$this->users->user_ordersactive();
					$this->data['ordersdeposit']=$this->users->user_deposits();
					$this->data['orderswithdrawal']=$this->users->user_withdrawal();
					$this->load->view('user/finance',$this->data);
			}
			else
			{
				redirect('', 'refresh');
			}
		}
		else
		{
			//$this->session->set_userdata('last_url',$_SERVER['HTTP_REFERER']);
			//$this->session->set_flashdata('error', 'Please login to contiune.');
			redirect('', 'refresh');
		}
	
	}
	//upload doc to verify
	public function upload()
	{
		if( array_key_exists('cc_user',$this->session->userdata) )
	  {
		 
			$id = $this->session->userdata['cc_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
		
			if(count($this->data['user'])>0)
			{
				
				$docs = $this->users->get_userdocuments_byuserid($id);
				if(count($docs)>2)
					{
						$this->session->set_flashdata('error', 'You have already uploaded maximum number of documents.');
						redirect('user/document','referesh');
						
					}
					

					//Loading View File
					$this->load->view('user/upload',$this->data);
			}
			else
			{
				redirect(base_url(), 'refresh');
			}
		}
		else
		{
			$this->session->set_userdata('last_url',$_SERVER['HTTP_REFERER']);
			$this->session->set_flashdata('error', 'Please login to contiune.');
			redirect(base_url(), 'refresh');
		}
	}
	
	//view all docs 
	public function document($userid='',$docid='')
	{
		if($docid=='' && $userid=='' )
		{
			if( array_key_exists('cc_user',$this->session->userdata) )
	  		{
		 		$id = $this->session->userdata['cc_user']['userid'];
		        			
			 	 $this->data['user'] = $this->users->get_user_byid($id);
		 
			$this->data['docs'] = $this->users->get_userdocuments_byuserid($id);
			//Loading View File
			if(count($this->data['user'])>0)
			{
			$this->load->view('user/docs',$this->data);
			}
			else
			{
			$this->session->set_flashdata('error', 'Someting Went Wrong.');
			redirect(base_url(), 'refresh');	
			}
			
		}
			else
			{
			$this->session->set_userdata('last_url',$_SERVER['HTTP_REFERER']);
			$this->session->set_flashdata('error', 'Please login to contiune.');
			redirect(base_url(), 'refresh');
		}
		}
		else
		{
			
			//echo $file[0]['doctype'];
			$docid = base64_decode($docid);
			$userid = base64_decode($userid);
			$file = $this->users->get_doc_byid($userid,$docid);
			//echo $file[0]['doctype'];
			//echo base64_encode($file[0]['userdocumentfiletitle']);
			//die();
			
			if(count($file)>0){ 
			$file_name = $file[0]['title'].'.'.$file[0]['doctype'];
			
				header("Content-Length: " . strlen($file[0]['userdocumentfiletitle']) );
				header("Content-Type: application/octet-stream");
				header('Content-Disposition: attachment; filename="'.$file_name.'"');
				header("Content-Transfer-Encoding: binary\n");
				echo $file[0]['userdocumentfiletitle'];
			}
		}
	
	}
	
	
	
	public function register($referalcode='')
	{
		if( !array_key_exists('cc_user',$this->session->userdata) )
	  {
			//Loading View File
			$referalcode=$this->uri->segment(3);
			
		
			$checkreferalcode=$this->common->check_referalcode($referalcode);
			if($checkreferalcode!='no') 
			{
			$this->load->view('user/register',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Invalid Coupon Code');
				redirect('home','referesh');
				//die();
			}
			
			
		}
		else
		{
			redirect('user','refresh');
		}
	}
	
	public function edit()
	{
		if( !array_key_exists('cc_user',$this->session->userdata) )
		{
			redirect(base_url(), 'refresh');
		}
		else if($this->session->userdata['cc_user'])
	  	{
			$id = $this->session->userdata['cc_user']['userid'];
			if(!$id)
			{
				redirect(base_url(), 'refresh');
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
		if( !array_key_exists('cc_user',$this->session->userdata) )
		{
			redirect(base_url(), 'refresh');
		}
		else if($this->session->userdata['cc_user'])
	  	{
			$id = $this->session->userdata['cc_user']['userid'];
			if(!$id)
			{
				redirect(base_url(), 'refresh');
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
	public function update($referalncode='')
	{
		//echo "<pre>"; print_r($_POST); die();
		//echo "<pre>"; print_r($_FILES); 
		//If Old Record Update
		if( $this->input->post('edituser'))
		{
				/*echo "<pre>";
				print_r($_POST);
				die();*/
				$id = $this->session->userdata['cc_user']['userid'];
				//Getting value
				$firstname = ($this->input->post('firstname'));
				$lastname = ($this->input->post('lastname'));
				$email = ($this->input->post('email'));
				$alternateemail = ($this->input->post('alternateemail'));
				$dob = date("Y-m-d",strtotime($this->input->post('dob')));
				$address = ($this->input->post('address'));
				$country = ($this->input->post('country'));
				$state = ($this->input->post('state'));
				$city = ($this->input->post('city'));
				$zipcode = ($this->input->post('zipcode'));
				$gender = ($this->input->post('gender'));
				
				$contactnumber = ($this->input->post('contactnumber'));
				$hidmobnumber = ($this->input->post('hidmobnumber'));
				$companyname = ($this->input->post('companyname'));
				
				if($contactnumber!='')
				{
					if($contactnumber!=$hidmobnumber)
					{
						$code=rand();
						$keystatus=$this->users->setoptcode($id,$code);
			
			if($keystatus==1)
			{
				$site_name = $this->common->get_setting_value(1);
				$site_url = $this->common->get_setting_value(2);
				$site_mail = $this->common->get_setting_value(5);
								
				$sms_user = $this->common->get_setting_value(12);
				$sms_password = $this->common->get_setting_value(13);
				$sms_api_id = $this->common->get_setting_value(14);
				$baseurl ="http://api.clickatell.com";
		 
				$sms_text = urlencode("Dear User,Please use following OTP code.CODE is $code.Regards The '$site_name' Team");
				//$sms_to = $user[0]['contactno'];
				$sms_to = $contactnumber;
				// auth call
				$url = "$baseurl/http/auth?user=$sms_user&password=$sms_password&api_id=$sms_api_id";
				// do auth call
				$ret = file($url);
				// explode our response. return string is on first line of the data returned
				$sess = explode(":",$ret[0]);
				if ($sess[0] == "OK") {
		 
				$sess_id = trim($sess[1]); // remove any whitespace
				$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$sms_to&text=$sms_text";
		 
				// do sendmsg call
				$ret = file($url);
				$send = explode(":",$ret[0]);
		 
				if ($send[0] == "ID") {
				  return true;
				} else {
					return false;
				}
			} else {
				echo "Authentication failure: ". $ret[0];
			}
		  }
					}
				}
			
			$avatar = '';
				// Load the library - no config specified here
				$this->load->library('upload');
				
				if( isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0)
				{
					//Uploading blogposts Image
					$mconfig['upload_path'] = $this->config->item('avatar_upload_path');
					$mconfig['allowed_types'] = 'gif|jpeg|jpg|png|bmp';
					$mconfig['is_image'] = 1;
					$mconfig['max_size'] = $this->config->item('avatar_max_size');
					$mconfig['max_width']  = $this->config->item('avatar_max_width');
					$mconfig['max_height']  = $this->config->item('avatar_max_height');
					$mconfig['remove_spaces'] = TRUE;
					$mconfig['encrypt_name'] = TRUE;
					//$mconfig['file_name']=$username;
					// Initialize the new config
					$this->upload->initialize($mconfig);
					//Uploading Image
					$this->upload->do_upload('avatar');
					
					//Getting Uploaded File Data
					$mainimgdata = $this->upload->data();
					/*echo "<pre>";
					print_r($mainimgdata);*/
					
					$mainimgerror = $this->upload->display_errors();
					
					if( !empty($mainimgerror) )
					{
						$this->session->set_flashdata('error', $mainimgerror);
						redirect('user', 'refresh');
					}
					else
					{
						 $avatar = $mainimgdata['file_name'];
					}
					
				$avatarimg =$this->users->get_user_byid($id);
				
				if( count($avatarimg) > 0 )
				{
					if( $avatarimg[0]['avatar'] != '' && !empty($avatarimg) && $avatarimg != '' )
					{
						if( file_exists( $this->config->item('avatar_upload_path').stripslashes($avatarimg[0]['avatar']) ) )
						{
							unlink( $this->config->item('avatar_upload_path').stripslashes($avatarimg[0]['avatar']) );
						}
					}
					
				
				}
				}
				//Updating Record
				if($contactnumber!=$hidmobnumber)
					{
						$ver='No';
					}
					else
					{
						$id = $this->session->userdata['cc_user']['userid'];
						$user = $this->users->get_user_byid($id);
						if(count($user)>0)
						{
							 if($user[0]['mobnumverified']=='No')
							 {
								 $ver='No';
							 }
							 else
							 {
								 $ver='Yes';
							 }
						}
					}
				if( $this->users->update($id,$firstname,$lastname,$email,$alternateemail,$dob,$address,$country,$state,$city,$zipcode,$gender,$companyname,$contactnumber,$avatar,$ver) )
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
		
		//If New Record Insert
		else if( $this->input->post('newuser') )
		{
			/*echo $this->db->last_query();
			die();*/
			
			$username = ($this->input->post('username'));
			$email = ($this->input->post('email'));
			$password = ($this->input->post('password'));
			$dob = date("Y-m-d",strtotime($this->input->post('dob')));
			$state = ($this->input->post('state'));
			$gender = ($this->input->post('gender'));
				
			$result = $this->users->chkfield(0,'email',$email);
			
			if($result=='old')
			{
					$this->session->set_flashdata('error', 'This email address is already registered. Try later!');
					redirect('user/register', 'refresh');
			}
			
			$result1 = $this->users->chkfield(0,'username',$username);
			
			if($result1=='old')
			{
					$this->session->set_flashdata('error', 'This username is already in use. Try later!');
					redirect('user/register', 'refresh');
			}
			//Getting value
			$uniqueid = uniqid();
			$referalcode=substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 10);
			//Inserting Record
			if( $updated = $this->users->insert($uniqueid,$username,$email,$password,$dob,$state,$gender,$referalcode) )
				{
			$user=$this->db->insert_id();
			$registerid=$this->users->get_userid($user);
			
			if($referalncode!='')
			{
			$checkreferalcode=$this->common->check_referalcode($referalncode);
			
					if($checkreferalcode!='no' && !empty($checkreferalcode)) 
					{
						$user_refid=$checkreferalcode[0]['userid'];
						$refcode=$checkreferalcode[0]['referalcode'];
						$commissionfees=$this->common->get_setting_value(8);
						
				$this->users->insert_referals($user_refid,$registerid,$referalncode,$commissionfees);
				
					}
			}
			$get_currency=$this->users->get_currency();
			if(count($get_currency)>0)
			{
				for($i=0;$i<count($get_currency);$i++)
				{
				$currencyid=$get_currency[$i]['currencyid'];
				$currencycode=$get_currency[$i]['currencycode'];
				$this->users->insert_currency_balance($registerid,$currencyid,$currencycode);
				}
			}
					$newuniqueid = $uniqueid;
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_email = $this->common->get_setting_value(5);
					$commission= $this->common->get_setting_value(8);
					// user Mail
					$to = $email;
					$mail = $this->common->get_email_byid(2);

					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['emailbody'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
					
				   $referalurl="<a href='".site_url('user/register/'.$referalcode)."' title='Referal Code' target='_blank'>".site_url('user/register/'.$referalcode)."</a>";
					$activationlink = "<a href='".site_url('user/enable/'.$newuniqueid)."' title='Activate your Account' target='_blank'>".site_url('user/enable/'.$newuniqueid)."</a>";
            	
					$mail_body = str_replace("%username%",($username),str_replace("%email%",$email,str_replace("%password%",$password,str_replace("%link%",$activationlink,str_replace("%sitename%",$site_name,str_replace("%referalurl%",$referalurl,str_replace("%commission%",$commission,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,($mailformat))))))))));
					
					//echo "<pre>"; 
					//print_r($mail_body);
					$this->email->message($mail_body);
					$this->email->send();
							
					// Admin Mail
					$to = $site_email;
					$mail = $this->common->get_email_byid(3);
			
					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['emailbody'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
					
					$mail_body = str_replace("%username%",$username,str_replace("%email%",$email,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,($mailformat))))));
					
					//echo "<pre>"; 
					//print_r($mail_body);
					//die();
					$this->email->message($mail_body);
					$this->email->send();
					
					$this->session->set_flashdata('success', 'Registration Successful. Activation link has been sent to your email. Activate your account to log in.');
					redirect(base_url(), 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in inserting user. Try later!');
					redirect(base_url(), 'refresh');
				}
			}
		
		else if( $this->input->post('changepassword') )
	  	{			
			//Getting intid
			$id = $this->session->userdata['cc_user']['userid'];
			
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
						redirect('user/edit', 'refresh');
					}
				}
				else
				{
					//Loading View File
					$this->session->set_flashdata('error', 'Old password you gave is incorrect.');
					redirect('user/edit', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
			}
		}
		
		else if( $this->input->post('uploaddoc') )
	  	{			
			$title  = $_POST['title']; // file name
			//echo "<pre>"; print_r($_FILES); die();
			$userid = $this->session->userdata['cc_user']['userid'];
			$interfaceid = $this->session->userdata['interfaceid'];
			
			$oldtype=$this->users->checkdocument_exist($userid,$title);
			if(count($oldtype)>0)
			{
				$this->session->set_flashdata('error', 'This type of document is already uploaded');
				redirect('user/upload', 'refresh');
			}
					if(count($_FILES)>0)
					{
						if(count($_FILES['document'])>0)
						{
							if( $_FILES['document']['name']!='' && $_FILES['document']['size'] > 0 ){
							
							if( $_FILES['document']['size'] < 5242880 )
							{
							
							
							{
								
		$allowedtypes=array('"application/pdf"',"image/jpeg","image/gif","image/bmp","image/png",'application/pdf');
		if(in_array($_FILES['document']['type'],$allowedtypes))
								{
								
								
			$fileName  = $_FILES['document']['name']; // file name
			$tmpName   = $_FILES['document']['tmp_name']; // name of the temporary stored file name
			$fileSize  = $_FILES['document']['size']; // size of the uploaded file
			$fileType  = $_FILES['document']['type']; // file type
			$fp        = fopen($tmpName, 'rb'); // open a file handle of the temporary file
			$doccontent  = fread($fp, filesize($tmpName)); // read the temp file
			fclose($fp); // close the file handle

			//document type
			$doctype = explode("/",$fileType);
			$doctype = str_replace('"','',$doctype[1]);
			$doctype = str_replace('"','',$doctype);
			
			if($this->users->user_documents($userid,$title,$doccontent,$interfaceid,$doctype))
			{
				$this->session->set_flashdata('success', 'Document added successfully.');
				redirect('user/document', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error in uploading document.try later.');
				redirect('user/upload', 'refresh');
			}
								}
								else
								{
									$this->session->set_flashdata('error', 'Allowed Types are .pdf,.jpeg,.gif,.bmp,.png and max Allowed Size is 5MB');
									redirect('user/upload', 'refresh');
								}
							}
						}
							else
							{
							
									$this->session->set_flashdata('error', 'Allowed Types are .pdf,.jpeg,.gif,.bmp,.png and max Allowed Size is 5MB');
									redirect('user/upload', 'refresh');
								
							}
							}
							
							else
							{
							
					
									$this->session->set_flashdata('error', 'Allowed Types are .pdf,.jpeg,.gif,.bmp,.png and max Allowed Size is 5MB');
									redirect('user/upload', 'refresh');
								
					
							}
						}
						else
						{
							
									$this->session->set_flashdata('error', 'Allowed Types are .pdf,.jpeg,.gif,.bmp,.png and max Allowed Size is 5MB');
									redirect('user/upload', 'refresh');
								
							}
					}
					else
					{
					
									$this->session->set_flashdata('error', 'Allowed Types are .pdf,.jpeg,.gif,.bmp,.png and max Allowed Size is 5MB');
									redirect('user/upload', 'refresh');
								
					}
							
				}
		
		//check passowrd
		else if( $this->input->post('checkuserpass'))
		{
			$id = $this->session->userdata['cc_user']['userid'];
			$userpassword = $this->input->post('password');
			
			if(!$id)
			{
				redirect(base_url(), 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if( count($this->data['user'])>0 )
			{			
				$password = $this->data['user'][0]['password'];
				$password = base64_decode(strrev($password));
				
				if($password==$userpassword)
				{
					$this->load->view('user/selotp',$this->data);
				}
				else
				{	
					$this->session->set_flashdata('error', 'Current password is wrong . Try later!');
					redirect('user/edit','refresh');
				
				}
			}
			else
			{
				redirect(base_url(), 'refresh');
			}
		}
	
		else if( $this->input->post('otptype') )
	  	{			
			
			$otptype  = $_POST['otptype'];
			$code=rand();
			 $this->data['otpcode']=$code;
			$id = $this->session->userdata['cc_user']['userid'];
			 $user = $this->users->get_user_byid($id);
			
			if($otptype=='SMS')
			{
				
				if(count($user)>0)
				{
					$email=$user[0]['email'];
					$username=$user[0]['username'];
					$password=$user[0]['password'];
					$loginsecretkey=$user[0]['loginsecretkey'];
					$phonenum=$user[0]['contactno'];
				}
			
			if($keystatus=$this->users->setoptcode($id,$code))
			{
				$site_name = $this->common->get_setting_value(1);
				$site_url = $this->common->get_setting_value(2);
				$site_mail = $this->common->get_setting_value(5);
								
				$sms_user = $this->common->get_setting_value(12);
				$sms_password = $this->common->get_setting_value(13);
				$sms_api_id = $this->common->get_setting_value(14);
				$baseurl ="http://api.clickatell.com";
		 
				$sms_text = urlencode("Dear User,Please use following OTP code.CODE is $code.Regards The '$site_name' Team");
				//$sms_to = $user[0]['contactno'];
				if(count($user)>0)
					{
						$sms_to = $user[0]['contactno'];
					}
					else
					{
						$sms_to = "";
					}
	
				// auth call
				$url = "$baseurl/http/auth?user=$sms_user&password=$sms_password&api_id=$sms_api_id";
		 
				// do auth call
				$ret = file($url);
		 
				// explode our response. return string is on first line of the data returned
				$sess = explode(":",$ret[0]);
				if ($sess[0] == "OK") {
		 
				$sess_id = trim($sess[1]); // remove any whitespace
				$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$sms_to&text=$sms_text";
		 
				// do sendmsg call
				$ret = file($url);
				$send = explode(":",$ret[0]);
		 
				if ($send[0] == "ID") {
				  //return true;
				} else {
					//return false;
				}
			} else {
				//echo "Authentication failure: ". $ret[0];
			}
		  }
			
			
			$this->data['msgflashdata']='We have send you an OTP code to your registered mobile number *****'.substr($sms_to,9,12).'Enter OTP code here';
			//echo "hi";
			$this->load->view('user/changepas',$this->data);
			//echo "hioko";
			}
			elseif($otptype=='EMAIL')
			{
				
			 
			
			if(count($user)>0)
			{
				$email=$user[0]['email'];
				$username=$user[0]['username'];
				$password=$user[0]['password'];
				$loginsecretkey=$user[0]['loginsecretkey'];
			}
			
			if($keystatus=$this->users->setoptcode($id,$code))
			{
				
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_mail = $this->common->get_setting_value(5);
								
							//Loading E-mail library
							$this->load->library('email');
								
							//Loading E-mail config file
							$this->config->load('email',TRUE);
							$this->cnfemail = $this->config->item('email');
										
							$this->email->initialize($this->cnfemail);
							$this->email->from($site_mail,$site_name);
							$this->email->to($email);	
							$this->email->subject('Password Change OTP CODE');
							$site_logo = "<a href='".$site_url." ' title='".$site_name."' ><img src='".base_url()."images/logo.png' border='0' alt='".$site_name."'></a>";
					
												$mail_body=( '<p>
	Dear&nbsp; '.$username.',</p>
<p>
	Please use following OTP code for changing password <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a> .</p>
<p>
	-------------------------------------------------------------------</p>
<p>
	CODE ID&nbsp; &nbsp;&nbsp; :&nbsp; '.$code.'</p>
<p>
	
<p>
	-------------------------------------------------------------------</p>
<p>
	<a href="'.$site_url.'" title="'.$site_name.'">'.$site_url.'</a></p>
<br />
<p>
	Regards,<br />
	The '.$site_name.' Team.</p>
');
							$this->email->message("<table cellpadding='0' cellspacing='0'><tr><td>".$site_logo."</td></tr><tr><td>".$mail_body."</td></tr></table>");
							
								//Sending mail to user
								if($this->email->send())
								{
								//	$this->session->set_flashdata('success', 'We have send you an OTP code to your email.Enter OTP code and new password here');
									$part1 = substr($email, strpos($email, "@") + 1);    
			$part2 = str_replace('@'.$part1,'',$email);
								
			$emailid = $part2."*********";
			
			$this->data['msgflashdata']='We have send you an OTP code to your email '.$emailid.'Enter OTP code here';
									$this->load->view('user/changepas',$this->data);
								}
								else
								{
									$this->session->set_flashdata('error', 'something went wrong . Try later!');
									redirect('user/changepassword','refresh');
								}
					
				
		}
	  
			}
			else
			{
				redirect('user','refresh');
			}
		}
		
		else if( $this->input->post('newpassfrm') )
	  	{			
			//Getting intid
			$id = $this->session->userdata['cc_user']['userid'];
			
			$newpassword = ($this->input->post('password'));
			
			$password = strrev(base64_encode($newpassword));
			//Getting detail for displaying in form
			$user = $this->users->get_user_byid($id);
		
			if(count($user)>0)
			{
				//Addingg Result to view parameter
					if( $this->users->update_password($id,$password) )
					{					
						$username = $user[0]['username'];
						$email = $user[0]['email'];
						
						//change password mail to user
				
						$site_name = $this->common->get_setting_value(1);
						$site_url = $this->common->get_setting_value(2);
						$site_mail = $this->common->get_setting_value(5);
								
						//Loading E-mail library
						$this->load->library('email');
								
						//Loading E-mail config file
						$this->config->load('email',TRUE);
						$this->cnfemail = $this->config->item('email');
									
						$this->email->initialize($this->cnfemail);
						$this->email->from($site_mail,$site_name);
						$this->email->to($email);	
						$this->email->subject('Password changed successfully');
						$site_logo = "<a href='".$site_url." ' title='".$site_name."' ><img src='".base_url()."images/logo.png' border='0' alt='".$site_name."'></a>";
					
						$mail_body=( '<p>
	Dear&nbsp; '.$username.',</p>
<p>	Your login password has been changed successfully .</p>
<p>	-------------------------------------------------------------------</p>
<p>
	<a href="'.$site_url.'" title="'.$site_name.'">'.$site_url.'</a></p>
<br />
<p>
	Regards,<br />
	The '.$site_name.' Team.</p>
');
							$this->email->message("<table cellpadding='0' cellspacing='0'><tr><td>".$site_logo."</td></tr><tr><td>".$mail_body."</td></tr></table>");
							
								//Sending mail to user
								$this->email->send();

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
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
			}
		}
		
		else if( $this->input->post('Verifybtn') )
	  	{			
			//Getting intid
			$id = $this->session->userdata['cc_user']['userid'];
			
			$otpcode = ($this->input->post('otpcode'));
			
			$user = $this->users->get_user_byid($id);
		
			if(count($user)>0)
			{
				$user = $this->users->get_user_byid($id);
				$otp = $this->users->get_lastest_otp_code();
				
				if(count($otp)>0)
				{
					$oldotp = $otp[0]['otpcode'];
					if($oldotp!=$otpcode)
					{
						$this->session->set_flashdata('error', 'You Have entered wrong otp code try again.');
						redirect('user/mobverify', 'refresh');
					}
				}
				else
				{
						$this->session->set_flashdata('success', 'Something went try later.');
						redirect('user/mobverify', 'refresh');
				}
				
				//Addingg Result to view parameter
					if( $this->users->update_verify_mobtstatus($id) )
					{					
						$this->session->set_flashdata('success', 'Mobile verification is done.');
						redirect('user/document', 'refresh');
					}
					else
					{
						//Loading View File
						$this->session->set_flashdata('error', 'Something went wrong. Try later.');
						redirect('user/mobverify', 'refresh');
					}
				}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
			}
		}
		
		else if( $this->input->post('addcard') )
	  	{			
			//Getting intid
			$id = $this->session->userdata['cc_user']['userid'];
			
			$card_name = ($this->input->post('card_name'));
			$card_type = ($this->input->post('card_type'));
			$card_number = ($this->input->post('card_number'));
			$expdate = $this->input->post('date1').'-'.$this->input->post('date2');
			$user = $this->users->get_user_byid($id);
		
			if($this->users->insert_card($id,$card_name,$card_type,$card_number,$expdate))
			{
				$this->session->set_flashdata('success', 'Your card details has been added successfully');
				redirect('user/creditcards', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Something went try later.');
				redirect('user/add_card', 'refresh');
			}
		}
		
		else if( $this->input->post('cardid') )
	  	{			
			//Getting intid
			$id = $this->session->userdata['cc_user']['userid'];
			
			$cardid = base64_decode($this->input->post('cardid'));
			
			if($this->users->update_card_status($cardid))
			{
				$this->session->set_flashdata('success', 'Your card details has been updated successfully');
				redirect('user/creditcards', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Something went try later.');
				redirect('user/creditcards', 'refresh');
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
			redirect(base_url(), 'refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'There is error in updating account status. Try later!');
			redirect(base_url(), 'refresh');
		}
	}
	
	//Function to Check E-mail is already exists
	public function fieldcheck()
	{
		if( $this->input->is_ajax_request() && ( $this->input->post('email') || $this->input->post('username')))
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
				$fieldvalue = ($this->input->post('email'));
			}
			
			if( $this->input->post('username') )
			{
				$field = 'username';
				$fieldvalue = ($this->input->post('username'));
			}
			
			if($field)
			{
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
		if( array_key_exists('cc_user',$this->session->userdata ) )
		{
			$this->session->set_flashdata('success', 'You have been successfully logged out.');
			
			$log_id = $this->session->userdata['cc_user']['log_id'];
			$this->common->update_log($log_id);
			$this->session->unset_userdata('cc_user');
			$this->session->unset_userdata('last_url');
			
			redirect(base_url(), 'refresh');
		}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
		public function referrals()
	{
		if( array_key_exists('cc_user',$this->session->userdata ) )
		{
			$this->data['referals']=$this->users->get_referrals();
		
			$this->load->view('user/referrals',$this->data);
		
			
			}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	public function get_transactions()
	{
		if( array_key_exists('cc_user',$this->session->userdata ) )
		{
			$this->data['orders']=$this->users->user_orders();
		
			$this->load->view('user/dashboard',$this->data);
		
			
			}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	
		public function get_balances()
	{
		if( array_key_exists('cc_user',$this->session->userdata ) )
		{
			$this->data['balance']=$this->users->user_getbalance();
		
			$this->load->view('user/dashboard',$this->data);
		
			
			}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	
	//function for withdrawal
	function withdrawalfunds()
	{
	if( array_key_exists('cc_user',$this->session->userdata ) )
		{
				 $amount=$this->input->post('amountw');
				 $availablefunds=$this->input->post('availablefunds');
				 $balanceid=$this->input->post('balanceid');
				 $currencyid=$this->input->post('currencyid');
				 $eaddress=$this->input->post('eaddress');
				 $currency=$this->input->post('currencycode');
				
				$checkbalancestatus=$this->users->check_balance_status($balanceid);	
				if(count($checkbalancestatus)>0)
				{
					$this->session->set_flashdata('error', 'Please Wait untiil Your First Withdrawal Request is completed');
					redirect('user/finance','referesh');
					die();
					
				}
					if($amount<$availablefunds)
					{
					 	$total_avail=$availablefunds-$amount;
					
						if($this->users->withdrawal($balanceid,$amount,'Withdrawal'))
						{
						$user = $this->users->get_user_byid(($this->session->userdata['cc_user']['userid']));		
						$site_name = $this->common->get_setting_value(1);
						$site_url = $this->common->get_setting_value(2);
						$site_email = $this->common->get_setting_value(5);
						$commission= $this->common->get_setting_value(8);
					// user Mail
					$to = $user[0]['email'];
					$username=$user[0]['username'];
					
					$mail = $this->common->get_email_byid(9);

					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['emailbody'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
					
					$mail_body = str_replace("%username%",($username),str_replace("%amount%",$amount,str_replace("%currency%",$currency,($mailformat))));
					
					//echo "<pre>"; 
					//print_r($mail_body);
					$this->email->message($mail_body);
					$this->email->send();
						//$this->users->withdrawal_history($balanceid,$total_avail,$eaddress);
						$this->session->set_flashdata('success', 'Your Withdrawal Success');
						redirect('user/finance','referesh');
						}
					}
					else
					{
						$this->session->set_flashdata('error', 'You Dont Have Enough Balance to Withdrawal amount ');
						redirect('user/finance','referesh');
					}
				
		
			
			}
		else
		{
			redirect(base_url(), 'refresh');
		}	
	}
	
	function sendmessage()
	{
		if( array_key_exists('cc_user',$this->session->userdata ) )
		{
			$msgbody=$this->input->post('messagebody');
			if($msgbody!='')
			{
			
				if($this->users->send_message($msgbody,0))
				{
					
					echo 1;				
				}
				else
				{
					echo 0;
				}
			}
			
		
			
			}
		else
		{
			redirect(base_url(), 'refresh');
		}
	}
	function depositamt()
	{
		if( array_key_exists('cc_user',$this->session->userdata ) )
		{
		 	 $userid=($this->session->userdata['cc_user']['userid']);
			
			$currency=$this->input->post('currencycode');
			$depamnt=$this->input->post('depamnt');
			 $balid=$this->input->post('balid');
			$cardno=$this->input->post('cardno');
			$availbal=$this->input->post('availbal');
			$deposittype=$this->input->post('deposittype');
			$maxamount=$this->common->get_setting_value(24);
			$checkcardstatus=$this->users->check_creditcardstatus($cardno);	
			$checkbalancestatus=$this->users->check_balance_status($balid);	
			if(count($checkbalancestatus)>0)
			{
				echo 3;
				die();
				
			}
				
			if($depamnt!='')
			{
				if($checkcardstatus=='Yes')
				{
					if($depamnt>$maxamount)
					{
						echo 2;
						die();
					}
					else
					{
					if($this->users->adddeposit($depamnt,$balid,$availbal,$currency,'Deposit',$cardno,$deposittype))
					{
							
							$user = $this->users->get_user_byid($userid);		
							
							$site_name = $this->common->get_setting_value(1);
							$site_url = $this->common->get_setting_value(2);
							$site_email = $this->common->get_setting_value(5);
							$commission= $this->common->get_setting_value(8);
						// user Mail
						$to = $user[0]['email'];
						$username=$user[0]['username'];
						
						$mail = $this->common->get_email_byid(8);
	
						$subject = $mail[0]['subject'];
						$mailformat = $mail[0]['emailbody'];
						
						$this->load->library('email');
						$this->email->from($site_email,$site_name);
						$this->email->to($to);
						$this->email->subject($subject);
						
						$mail_body = str_replace("%username%",($username),str_replace("%amount%",$depamnt,str_replace("%currency%",$currency,($mailformat))));
						
						/*echo "<pre>"; 
						print_r($mail_body);*/
						$this->email->message($mail_body);
						$this->email->send();
						echo 1;				
					}
					else
					{
						echo 0;
					}
					}
				}
				else
				{
				if($this->users->adddeposit($depamnt,$balid,$availbal,$currency,'Deposit',$cardno))
				{
					    
						$user = $this->users->get_user_byid($userid);		
						
						$site_name = $this->common->get_setting_value(1);
						$site_url = $this->common->get_setting_value(2);
						$site_email = $this->common->get_setting_value(5);
						$commission= $this->common->get_setting_value(8);
					// user Mail
					$to = $user[0]['email'];
					$username=$user[0]['username'];
					
					$mail = $this->common->get_email_byid(8);

					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['emailbody'];
					
					$this->load->library('email');
					$this->email->from($site_email,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
					
					$mail_body = str_replace("%username%",($username),str_replace("%amount%",$depamnt,str_replace("%currency%",$currency,($mailformat))));
					
					/*echo "<pre>"; 
					print_r($mail_body);*/
					$this->email->message($mail_body);
					$this->email->send();
					echo 1;				
				}
				else
				{
					echo 0;
				}
				}
			}
			
			
			}
	}

	function sendermind($userid='',$docid='')
	{
		
		if( array_key_exists('cc_user',$this->session->userdata ) )
		{
			if($userid!='' && $docid)
			{
				if(base64_decode($userid)!=$this->session->userdata['cc_user']['userid'])
				{
					redirect('user/document', 'refresh');
				}
			
				//Getting detail for displaying in form
				$user = $this->users->get_user_byid(base64_decode($userid));
				$doc = $this->users->get_doc_byid(base64_decode($userid),base64_decode($docid));
				
				if(count($user)>0 && count($doc)>0)
				{
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_mail = $this->common->get_setting_value(5);
								
					//Loading E-mail library
					$this->load->library('email');
								
					//Loading E-mail config file
					$this->config->load('email',TRUE);
					$this->cnfemail = $this->config->item('email');
										
					$this->email->initialize($this->cnfemail);
					$this->email->from($site_mail,$site_name);
					$this->email->to($site_mail);	
					$this->email->subject('Reminder for document verification');
					$site_logo = "<a href='".$site_url." ' title='".$site_name."' ><img src='".base_url()."images/logo.png' border='0' alt='".$site_name."'></a>";
					
					$mail_body=( '<p>
	Dear&nbsp; Admin,</p>
<p>
	Following user has sent a request for document verification.Details are as follow.</p>
<p>
	-------------------------------------------------------------------</p>
<p> Username :&nbsp; '.$user[0]['username'].'</p>
<p> Email :&nbsp; '.$user[0]['email'].'</p>
<p> Document Title :&nbsp;  '.$doc[0]['title'].'</p>
<p> Document Uploaded on :&nbsp;  '.date("M d Y H:i A",strtotime($doc[0]['createddate'])).'</p>
<p>

	
<p>
	-------------------------------------------------------------------</p>
<p>
	<a href="'.$site_url.'" title="'.$site_name.'">'.$site_url.'</a></p>
<br />
<p>
	Regards,<br />
	The '.$site_name.' Team.</p>
');
							$this->email->message("<table cellpadding='0' cellspacing='0'><tr><td>".$site_logo."</td></tr><tr><td>".$mail_body."</td></tr></table>");
							
							//Sending mail to user
							if($this->email->send())
							{
								$this->session->set_flashdata('success', 'Verification reminder has been send successfully.');
								$this->users->update_doc(base64_decode($docid));	
							}
							else
							{
							$this->session->set_flashdata('error', 'There is error in sending Verification reminder. Try later!');
			
							}
							redirect('user/document', 'refresh');
							
										
				
		
				}
				
			}
			
			
			}
	}
	
	public function mobverify()
	{
		if( array_key_exists('cc_user',$this->session->userdata) )
	  {
		 
			$id = $this->session->userdata['cc_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
		
			if(count($this->data['user'])>0)
			{
				if($this->data['user'][0]['mobnumverified']=='Yes')
				{
					$this->session->set_flashdata('success', 'Mobile Verification is already done.');
					redirect('user', 'refresh');
				}
				//Loading View File
				$this->load->view('user/mobverify',$this->data);
			}
			else
			{
				redirect(base_url(), 'refresh');
			}
		}
		else
		{
			$this->session->set_userdata('last_url',$_SERVER['HTTP_REFERER']);
			$this->session->set_flashdata('error', 'Please login to contiune.');
			redirect(base_url(), 'refresh');
		}
	}
	
	
	function send()
	{
		$id = $this->session->userdata['cc_user']['userid'];
		$user = $this->users->get_user_byid($id);
		$code=rand();
		$keystatus=$this->users->setoptcode($id,$code);
			
		if($keystatus==1)
		{
				$site_name = $this->common->get_setting_value(1);
				$site_url = $this->common->get_setting_value(2);
				$site_mail = $this->common->get_setting_value(5);
								
				$sms_user = $this->common->get_setting_value(12);
				$sms_password = $this->common->get_setting_value(13);
				$sms_api_id = $this->common->get_setting_value(14);
				$baseurl ="http://api.clickatell.com";
		 
				$sms_text = urlencode("Dear User,Please use following OTP code.CODE is $code.Regards The '$site_name' Team");
				//$sms_to = $user[0]['contactno'];
				$sms_to = $user[0]['contactno'];
				// auth call
				$url = "$baseurl/http/auth?user=$sms_user&password=$sms_password&api_id=$sms_api_id";
				// do auth call
				$ret = file($url);
				// explode our response. return string is on first line of the data returned
				$sess = explode(":",$ret[0]);
				if ($sess[0] == "OK") {
		 
				$sess_id = trim($sess[1]); // remove any whitespace
				$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$sms_to&text=$sms_text";
		 
				// do sendmsg call
				$ret = file($url);
				$send = explode(":",$ret[0]);
		 
				/*if ($send[0] == "ID") {
				  //return "Y";
				} else {
					//return "N";
				}*/
			} else {
				echo "Authentication failure: ". $ret[0];
			}
		  }
		  
		echo substr($sms_to,7,12);  
				
	}
	
	function send1()
	{
		$id = $this->session->userdata['cc_user']['userid'];
		$user = $this->users->get_user_byid($id);
		$code=rand();
		$keystatus=$this->users->setoptcode($id,$code);
			
		if($keystatus==1)
		{
				$site_name = $this->common->get_setting_value(1);
				$site_url = $this->common->get_setting_value(2);
				$site_mail = $this->common->get_setting_value(5);
								
				$sms_user = $this->common->get_setting_value(12);
				$sms_password = $this->common->get_setting_value(13);
				
				$sms_api_id = $this->common->get_setting_value(14);
				$baseurl ="http://api.clickatell.com";
		 
				$sms_text = urlencode("Dear User,Please use following OTP code.CODE is $code.Regards The '$site_name' Team");
				//$sms_to = $user[0]['contactno'];
				$sms_to = $user[0]['contactno'];
				// auth call
				$url = "$baseurl/http/auth?user=$sms_user&password=$sms_password&api_id=$sms_api_id";
				// do auth call
				$ret = file($url);
				// explode our response. return string is on first line of the data returned
				$sess = explode(":",$ret[0]);
				if ($sess[0] == "OK") {
		 
				$sess_id = trim($sess[1]); // remove any whitespace
				$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$sms_to&text=$sms_text";
		 
				// do sendmsg call
				$ret = file($url);
				$send = explode(":",$ret[0]);
		 
				/*if ($send[0] == "ID") {
				  //return "Y";
				} else {
					//return "N";
				}*/
			} else {
				//echo "Authentication failure: ". $ret[0];
			}
		  }
		  
		$this->data1['msgnumber'] = substr($sms_to,7,12);
		$this->data1['msgcode'] = $code;
		echo json_encode($this->data1);die();
 				
	}
	
	public function creditcards()
	{
		if( !array_key_exists('cc_user',$this->session->userdata) )
		{
			redirect(base_url(), 'refresh');
		}
		else if($this->session->userdata['cc_user'])
	  	{
			$id = $this->session->userdata['cc_user']['userid'];
			if(!$id)
			{
				redirect(base_url(), 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['user'] = $this->users->get_user_byid($id);
			
			if( count($this->data['user'])>0 )
			{			
				//Loading View File
				$this->data['creditcards'] = $this->users->get_creditcards_byuserid($id);
				$this->load->view('user/creditcards',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
			}
		}
	}
	
	public function add_card()
	{
		if( array_key_exists('cc_user',$this->session->userdata) )
	  {
		 
			$id = $this->session->userdata['cc_user']['userid'];
			
			$this->data['user'] = $this->users->get_user_byid($id);
		
			if(count($this->data['user'])>0)
			{
				
				//Loading View File
				$this->load->view('user/add_card',$this->data);
			}
			else
			{
				redirect(base_url(), 'refresh');
			}
		}
		else
		{
			$this->session->set_userdata('last_url',$_SERVER['HTTP_REFERER']);
			$this->session->set_flashdata('error', 'Please login to contiune.');
			redirect(base_url(), 'refresh');
		}
	}
	
	public function deletecard($cid='',$uid='')
	{
		if( !array_key_exists('cc_user',$this->session->userdata) )
		{
			redirect(base_url(), 'refresh');
		}
		else if($this->session->userdata['cc_user'])
	  	{
			$id = $this->session->userdata['cc_user']['userid'];
			$uid = base64_decode($uid);
			$cid = base64_decode($cid);
			
			if(!$id)
			{
				redirect(base_url(), 'refresh');
			}
			
			if($id!=$uid )
			{
				redirect('user/creditcards', 'refresh');
			}
			
			if($cid=='' && $uid=='' )
			{
				redirect('user/creditcards', 'refresh');
			}
			
			
			if($this->users->delete_card($cid,$uid))
			{
				$this->session->set_flashdata('success', 'card has been deleted successfully');
			}
			else
			{
				$this->session->set_flashdata('error', 'Something went wrong try later.');
			}
			
			redirect('user/creditcards', 'refresh');
			
		}
	}
	
	public function changestatus($cid='',$uid='',$status='')
	{
		if( !array_key_exists('cc_user',$this->session->userdata) )
		{
			redirect(base_url(), 'refresh');
		}
		else if($this->session->userdata['cc_user'])
	  	{
			$id = $this->session->userdata['cc_user']['userid'];
			$uid = base64_decode($uid);
			$cid = base64_decode($cid);
			$status = base64_decode($status);
			
			if(!$id)
			{
				redirect(base_url(), 'refresh');
			}
			
			if($id!=$uid )
			{
				redirect('user/creditcards', 'refresh');
			}
			
			if($cid=='' && $uid=='' && $status=='')
			{
				redirect('user/creditcards', 'refresh');
			}
			
			
			if($this->users->update_card_active_status($uid,$cid,$status))
			{
				if($status=='No')
				{
					$this->session->set_flashdata('success', 'card has been deactived successfully.');
				}
				else
				{
					$this->session->set_flashdata('success', 'card has been actived successfully.');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Something went wrong try later.');
			}
			
			redirect('user/creditcards', 'refresh');
			
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */