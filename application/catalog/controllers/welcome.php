<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
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
			$this->data['title'] = 'Have a Complaint? Report It and Get It Resolved! - '.$site;
		}
		else if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		{
			$site = $regs['domain'];
			$this->data['title'] = 'Have a Complaint? Report It and Get It Resolved! - '.$site;
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
		
		$this->load->model('reviews');
		$this->load->model('complaints');
		$this->load->model('sliders');
		$this->load->model('users');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		$this->data['section_title'] = $this->data['site_name'];
			
		$this->data['tag_line'] = $this->common->get_homesetting_value(8);
		$this->data['video_url'] = $this->common->get_homesetting_value(9);
		$this->data['topads']= $this->common->get_all_ads('top','home',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','home',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','home',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','home',$siteid);
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = "Do you have an issue against a company? Register your complaint and we will make
sure they respond back. Submit your review and rate your experience
";
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0)
		 {
			$this->data['total'] = round($total[0]['total']);
		 }
		
		$siteid = $this->session->userdata('siteid');
		$this->data['search_keywords'] = $this->complaints->get_all_searchs($siteid);
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		
		$this->data['homesliding']=$this->sliders->homepageslider();
		
		$limit=6;
		$this->data['complaints'] = $this->reviews->get_all_reviews($limit);
		
		
		$this->data['home_categorys'] = $this->common->get_home_category();

		$this->load->view('home',$this->data);
	}




public function updates()
	{

		if(empty($id) && $this->input->post('company_id')){ 
			$id = $this->input->post('company_id');
		}
		$datas=$this->complaints->companygetid($id);
		
		if($datas)
		{
		//If New Record Insert
		if( $this->input->post('btnsubmit') || $this->input->post('detail')!='')
		{
			$detail = (strip_tags($this->input->post('detail')));
			$companyid = $datas['id'];
			$company1 = $datas['company'];
			$company = strtolower($company1);
			$companyemail=$datas['email'];
			$username =$this->input->post('username');
			$city = $datas['city'];
			$state = $datas['state'];
			$zip = $datas['zip'];
			$phone =  $datas['phone'];
			$emailid = $this->input->post('mailaddress');
			$siteurl = $datas['siteurl'];
			$category = "1";
			$reasondispute=$this->input->post('reasondispute');
			$merchantresolution=$this->input->post('merchantresolution');
			$caseid=$this->input->post('caseid');
			$transactionid=$this->input->post('transid');
			$transaction_date=$this->input->post('transdate');
			$transactionamt=$this->input->post('transamt');
			$complaintdate=$this->input->post('complaintdate');
			$streetaddress =$datas['streetaddress'];
			$userid= $this->session->userdata['youg_user']['userid'];
			$complaintdate=date("Y-m-d H:i:s");
			

			if(!$companyid)
				{


			
					$findcompany = $this->complaints->find_company($company);
					if(count($findcompany) > 0)
						{
							$companyid = $findcompany[0]['id'];
						}
						else
						{
							$findcompany1 = $this->complaints->find_company_by_email($email);
							if(count($findcompany1)>0)
							{
								$companyid = $findcompany1[0]['id'];
							}
							else
							{
								if($this->complaints->insert_company($company,$city,$state,$zip,$email,$siteurl,$phone,$category))
								{
									$companyid = $this->db->insert_id();
									$this->complaints->insert_companyseo($companyid,$company);						}
							}
						}
				}
			
			
	
			if(array_key_exists('youg_user',$this->session->userdata) )
			{
				$userid = $this->session->userdata['youg_user']['userid'];
			}
			else
			{
				$complaintarray = array(	'companyid'		=> $companyid,
										'detail'		=> $detail,
										'username'		=> $username,
										'emailid'		=> $emailid,
										'company'		=> $company,
										'company1'		=> $company1,
										'city'			=> $city,
										'state'			=> $state,
										'zip'			=> $zip,
										'phone'			=> $phone,
										'email'			=> $email,
										
									);
				
				
				$this->session->set_userdata('complaintarray',$complaintarray);
				$this->session->unset_userdata('flash');
				$this->session->set_flashdata('error', 'Please login to submit the complaint.');
				redirect('login','refresh');
				
			}
			
			$relation = $this->common->get_relation_byciduid($companyid,$userid);
			$elitemem = $this->complaints->get_eliteship_bycompanyid($companyid);
			
			if(count($elitemem)>0)
			{
				if(count($relation)>0)
				{
						if($relation[0]['status']=='Decline')
							{

							$multi_image=$this->multiuploadimg($_FILES['multipleupload']['name']);

							if($this->complaints->insert($companyid,$detail,$username,$emailid,$statusdisable='yes',$city,$state,$zip,$company,$reasondispute,$merchantresolution,$streetaddress,$phone,$caseid,$transactionid,$transaction_date,$transactionamt,$complaintdate,$userid,$companyemail,$complaintdate,$multi_image))
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

						$multi_image=$this->multiuploadimg($_FILES['multipleupload']['name']);


						if($updated = $this->complaints->insert($companyid,$detail,$username,$emailid,'yes',$city,$state,$zip,$company,$reasondispute,$merchantresolution,$streetaddress,$phone,$caseid,$transactionid,$transaction_date,$transactionamt,$complaintdate,$userid,$companyemail,$complaintdate,$multi_image))
						{	
					$com = $this->complaints->get_company_byid($companyid);
					
					if(count($com)>0)
					{
						$companyemailaddress = $com[0]['contactemail'];
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
						}
				}
				else
				{
					$multi_image=$this->multiuploadimg($_FILES['multipleupload']['name']);


					if($updated = $this->complaints->insert($companyid,$detail,$username,$emailid,$statusdisable='yes',$city,$state,$zip,$company ,$reasondispute,$merchantresolution,$streetaddress,$phone,$caseid,$transactionid,$transaction_date,$transactionamt,$complaintdate,$userid,$companyemail,$complaintdate,$multi_image))
				{	
					$com = $this->complaints->get_company_byid($companyid);
					$user = $this->common->get_user_byid($userid);
					
					$this->complaints->disable_complaint_byid($updated);
					if(count($com)>0)
					{
						$companyemailaddress = $com[0]['contactemail'];
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
								$this->session->set_flashdata('success', 'Complaintss submitted successfully.');
								
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
				$multi_image=$this->multiuploadimg($_FILES['multipleupload']['name']);

				if($updated = $this->complaints->insert($companyid,$detail,$username,$emailid,'no',$city,$state,$zip,$company,$reasondispute,$merchantresolution,$streetaddress,$phone,$caseid,$transactionid,$transaction_date,$transactionamt,$complaintdate,$userid,$companyemail,$complaintdate,$multi_image))
				{
				$com = $this->complaints->get_company_byid($companyid);
					
					if(count($com)>0)
					{
						$companyemailaddress = $com[0]['contactemail'];
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
		redirect(site_url(), 'refresh');
		}
	}


}

	public function feedback()
	{
		$this->session->set_flashdata('success', 'Thanks for your feedback.');
		redirect(site_url(), 'refresh');
	}
	
	public function confirm($companyid='',$userid='')
	{
		if($companyid!='' && $userid!='')
		{
			$companyid = base64_decode($companyid);
			$userid    = base64_decode($userid);

			$relation = $this->common->get_relation_byciduid($companyid,$userid);
			if(count($relation)==0)
			{
				if($this->common->insert_relation($companyid,$userid,'Confirm'))
				{
					$this->common->enable_all_complaints_by_ciduid($companyid,$userid);
					$this->common->enable_all_review_by_ciduid($companyid,$userid);
					
					$rev = $this->common->get_all_reviews_by_cid($companyid);
					if(count($rev)>0)
					{
						for($i=0;$i<count($rev);$i++)
						{
							
							$this->common->enable_all_comments_by_riduid($rev[$i]['id'],$userid);
						}
					}
						
						$this->session->set_flashdata('success', 'Thanks for your feedback.');
						redirect(site_url(), 'refresh');
				}
				else
				{
					redirect(site_url(), 'refresh');
				}
			}
			else
			{
				redirect(site_url(), 'refresh');
			}
		}
		else
		{
			redirect(site_url(), 'refresh');
		}
	}
	
	public function decline($companyid='',$userid='')
	{
		if($companyid!='' && $userid!='')
		{
			$companyid = base64_decode($companyid);
			$userid    = base64_decode($userid);
			
			$relation = $this->common->get_relation_byciduid($companyid,$userid);
			if(count($relation)==0)
			{
			
				if($this->common->insert_relation($companyid,$userid,'Decline'))
				{
					
					$this->common->disable_all_complaints_by_ciduid($companyid,$userid);
					$this->common->disable_all_review_by_ciduid($companyid,$userid);
					
					$rev = $this->common->get_all_reviews_by_cid($companyid);
					if(count($rev)>0)
					{
						for($i=0;$i<count($rev);$i++)
						{
							
							$this->common->disable_all_comments_by_riduid($rev[$i]['id'],$userid);
						}
					}
						
				$this->session->set_flashdata('success', 'Thanks for your feedback.');
					redirect(site_url(), 'refresh');
				}
				else
				{
					redirect(site_url(), 'refresh');
				}
			}
			else
			{
				redirect(site_url(), 'refresh');
			}
		}
		else
		{
			redirect(site_url(), 'refresh');
		}
	}
	
	public function searchcompany()
	{
		if( $this->input->is_ajax_request() && $this->input->post('company') )
	  {
			if( $this->input->post('company') )
			{
				$field = 'company';
				$fieldvalue = addslashes($this->input->post('company'));
			}
			
			if($field)
			{
				///Addingg Result to view parameter
				$result = $this->common->searchcompany($field,$fieldvalue);
								
				for($i=0;$i<count($result);$i++ )
           	 {
                //echo $key;
				//echo $val;
				$data[] = array(
                    'label' => $result[$i]['company'],
                    'value' => $result[$i]['id']);   // here i am taking name as value so it will display name in text field, you can change it as per your choice.
            }
        echo json_encode($data);
        flush();

			}
		}
		else
		{
			redirect('', 'refresh');
		}
	}


public function fblogin()
{
	$fb_appId = $this->common->get_setting_value(20);
	$fb_secret = $this->common->get_setting_value(21);
	
	$lasturl = $this->session->userdata('last_url');  
	if($lasturl == ''){
		$lasturl ='user';
	}	
	 
	
	$this->data['fbconfig'] = array(
					  'appId'  => $fb_appId,
					  'secret' => $fb_secret,
				  );
	//print_r($this->data['fbconfig']);
	 $this->load->library('facebook',$this->data['fbconfig']);
	 $user = $this->facebook->getUser();
	 //die();
		if ($user)
		{
		 try
		  {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $this->facebook->api('/me');
			
		  } 
		  	catch (FacebookApiException $e)
			 {
				//error_log($e);
				$user = null;
			}
		if (!empty($user_profile ))
		{
			$this->session->unset_userdata('last_url');
				$email = $user_profile['email'];
				$uid = $user_profile['id'];	
				//Loading model file
				$this->load->model('users');
				$userdata = $this->common->get_user_byemail($email);
				//echo "<pre>";
				//print_r($userdata);
				if( $userdata )
				{
					if($userdata[0]['fbid'] != '')
					{
						$user_array = array(
						'userid'	=> stripslashes($userdata[0]['id']),
						'useremail'     => $userdata[0]['email'],
						'name'	=> stripslashes($userdata[0]['firstname']." ".$userdata[0]['lastname']),
						'fbprofileid'	=> $uid,
					);
					}
				else
					{
					$uid = $user_profile['id'];
					$fbdate=$user_profile['updated_time'];
					$isverified=$user_profile['verified'];
					$lastid= $userdata[0]['UserID'];
		
		
		 
		   			$this->users->set_user_fbid($email,$uid,$fbdate,$isverified);	
					$user_array = array(
		'userid'	=> stripslashes($userdata[0]['id']),
		'useremail'     => $userdata[0]['email'],
		'name'	=> stripslashes($userdata[0]['firstname']." ".$userdata[0]['firstname']),
		'fbprofileid'	=> $uid,
		);
		}
		$this->session->set_userdata('youg_user', $user_array);
		redirect($lasturl,'refresh');
				}
		else
		{
		$uid = $user_profile['id'];
		$name = $user_profile['name'];
		$first_name = $user_profile['first_name'];
		$last_name = $user_profile['last_name'];
		if(!empty($user_profile['username'])){
			
			$fbusername=$user_profile['username'];
			
		} else {
			
			$fbusername=$user_profile['first_name'];
		} 
		
		$username = $fbusername;
		$email = $user_profile['email'];
		$gender = $user_profile['gender'];
		$fbdate=$user_profile['updated_time'];
		$isverified=$user_profile['verified'];
		$fbpassword = random_string('alnum',8);
		if( $result=$this->users->insertfbuser($first_name,$last_name,$gender,$username,$email,$uid,$fbpassword,$fbdate,$isverified ) )
		{
		 $site_name = $this->common->get_setting_value(1);
		 $site_url = $this->common->get_setting_value(2);
		 $site_mail = $this->common->get_setting_value(5);
		 
		 //Loading E-mail config file
		 $this->config->load('email',TRUE);
		 $this->cnfemail = $this->config->item('email');
		 
		 //Loading E-mail Class
		 $this->load->library('email');
		 
		 $this->email->initialize($this->cnfemail);
		 //E-mail From Id
		 $this->email->from($site_mail,$site_name);
		 
		 //E-mail To Id
		 $this->email->to($email);
		 
		 //E-mail Subject
		 
		 $subject = $site_name . " : Account Created";
		 $this->email->subject(stripslashes($subject));
		 
		 //E-mail Body
		 $site_logo = "<a href='".$site_url."' title='".$site_name."' ><img src='".base_url()."uploads/event_logo.png' border='0' alt='".$site_name."'></a>";
		 $this->email->message("<style>
		 span{
		 display:block;
		 }
		 </style>
		 ".$site_logo."
		 <p>
		 <span>Dear ".$first_name." ,</span> </p>
		 <p><span>You have just created your account in ".$site_name.". And information is as follows.</span>
		 </p>
		 
		 <table cellpadding='0' cellspacing='0' width='auto' border='0'>
		 <tr><td>Email </td><td style='width:5%'> : </td><td> ".$email."</td></tr>
		 <tr><td>Name </td><td style='width:5%'> : </td><td> ".$name."</td></tr>
		 <tr><td>Password </td><td style='width:5%'> : </td><td> ".$fbpassword."</td></tr>
		 <tr><td>Website </td><td style='width:5%'> : </td><td> ".$site_url."</td></tr>
		 <tr><td>Site Email </td><td style='width:5%'> : </td><td> ".$site_mail."</td></tr>
		 </table>
		 
		 
		 <p><span>Yours Sincerely,</span></p>
		 <p><span>The ".$site_name." Team.</span></p>");
		 //print_r($this->email);	 //Sending sign up mail
		 $this->email->send();
		 
		 $this->email->clear();
		 //sending mail to admin
		 //E-mail From Id
		 $this->email->from($site_mail);
		 
		 //E-mail From Id
		 $this->email->to($site_mail);
		 $subject = $site_name . " : Account Created";
		 $this->email->subject(stripslashes($subject));
		 $varbody = "";
		 $tblinfo = '<table cellpadding="0" cellspacing="0" border="0" align="left" width="100%">
		 <tr><th align="left" colspan="6">User Information</th></tr>
		 <tr>
		 <td width="23%"><b>Name</b></td>
		 <td width="2%" align="center">:</td>
		 <td width="25%">'.$name.'</td>
		 <td width="23%"><b>Email</b></td>
		 <td width="2%" align="center">:</td>
		 <td width="25%">'.$email.'</td>
		 </tr>
		 </table>';
		 
		 $varbody = '<!--<table border="0" cellpadding="0" cellspacing="0" width="100%"-->
		 <tr><td valign="top">Hello Administrator,<br> New User has created his account on site.Users name and email address is as below.</td></tr>
		 <tr><td valign="top">'.$tblinfo.'</td></tr>
		 </table>';
		 
		 $subject = $site_name . " : New Account Created";
		 $this->email->message($varbody);
		 //Sending sign up mail
		 $this->email->send();
		//<?php */
		$lastid= $result['userid'];
		
		 
		foreach($result as $key=>$val)
		{
		$sess_array[$key] = $val;
		}	
		$this->session->set_userdata('youg_user', $sess_array);
		redirect($lasturl,'refresh');
			   
		 $this->session->set_flashdata('success', 'User account created successfully.');
		 redirect($lasturl,'refresh');
		//}
		//else
		//{
		//$this->session->set_flashdata('error', 'There was an error in Log-n with Facebook.Try Later!');
		//redirect('user','refresh');
		//}
		}
		}
			}
		else
		{
		# For testing purposes, if there was an error, let's kill the script
		$this->session->set_flashdata('error', 'There was an error in Log-n with Facebook.Try Later!');
		redirect('','refresh');
		}
		}
		else
		{
			# There's no active session, let's generate one
		$login_url = $this->facebook->getLoginUrl(array('scope'=>'email'));
			redirect('','refresh');
		}
}

function multiuploadimg($files)
{
	$this->load->library('upload'); 
				
				$config['upload_path'] = './uploads/complaint/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size']	= '1000000';
				
				$multi_images_array = array();
				$i=0;
				foreach($files as $key => $image)
				{ 
					 $_FILES['multipleupload'.$key]['name']= $_FILES['multipleupload']['name'][$key];
					 $_FILES['multipleupload'.$key]['type']= $_FILES['multipleupload']['type'][$key];
					 $_FILES['multipleupload'.$key]['tmp_name']= $_FILES['multipleupload']['tmp_name'][$key];
					 $_FILES['multipleupload'.$key]['error']= $_FILES['multipleupload']['error'][$key];
					 $_FILES['multipleupload'.$key]['size']= $_FILES['multipleupload']['size'][$key];

					if(!empty($_FILES['multipleupload'.$key]['name'])) 
					{	
						
						$this->upload->initialize($config);
						if($this->upload->do_upload('multipleupload'.$key))
						{
							$imgdata = $this->upload->data();
							$multi_images_array[] = $imgdata['file_name'];
							$multi_image = implode(",",$multi_images_array);							
						}
						else
						{   
								$errors = $this->upload->display_errors();
								$multi_image ='' ;
						}
					}else{
						if( $_FILES['multipleupload'.$key]['error'] == 4){
							$i++;
							$multi_no_images = '';							
						}
					}		
				}

				if($i==4){

					return $multi_no_images; 
					
				}else{
					return $multi_image;
				}

}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
