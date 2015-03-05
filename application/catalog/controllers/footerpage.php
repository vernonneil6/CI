<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Footerpage extends CI_Controller {
	
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
		
		$this->data['topads']= $this->common->get_all_ads('top','others',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','others',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','others',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','others',$siteid);

	}
	
	public function index($intid)
	{
		$page = $this->common->get_footerlink_byintid($intid);
		
		if( count($page) > 0 )
		{
			$this->data['title'] = stripslashes($page['title']);
			$this->data['varheading'] = stripslashes($page['heading']);
			
			//Meta Keywords and Description
			$this->data['keywords'] = stripslashes($page['metakeywords']);
			$this->data['description'] = stripslashes($page['metadescription']);
				
			//Page Content
			$this->data['content'] = nl2br(($page['pagecontent']));
		
			//Load header and save in variable
			$this->data['header'] = $this->load->view('header',$this->data,true);
			$this->data['menu'] = $this->load->view('menu',$this->data,true);
			$this->data['footer'] = $this->load->view('footer',$this->data,true);
		}
		else
		{
			//Redirecting if Page not found
			redirect('','refresh');	
		}
		
		$this->load->view('footerpage',$this->data);
	}
	
	public function update()
	{
	    if($this->input->post('contactemail') != '')
		{
			$site_name = $this->common->get_setting_value(1);
			$site_url = $this->common->get_setting_value(2);
			
			
		  //Getting Sign up mail format
			$name = $this->input->post('contactname');
			$email = $this->input->post('contactemail');
			$subjectname = $this->input->post('contactsubject');
			$message = $this->input->post('contactmessage');
			
			$site_email = $this->common->get_setting_value(5);
			
			
			if( count($site_email) > 0 )
					{  
						  //Loading E-mail config file
						$this->config->load('email',TRUE);
						$this->cnfemail = $this->config->item('email');
							  
						//Loading E-mail Class
						$this->load->library('email');
						  
						$this->email->initialize($this->cnfemail);
						$site_name = $this->common->get_setting_value(1);
						$site_url = $this->common->get_setting_value(2);
						$site_email = $this->common->get_setting_value(5);
						
						//$to = $site_email;
						$from = $email;
						
						//Get Email Format for Company
						$mail = $this->common->get_email_byid(4);
						$subject = $mail[0]['subject'];
						$mailformat = $mail[0]['mailformat'];
						
						$this->email->from($from);
						$this->email->to('CustomerService@YouGotRated.com');
						$this->email->subject($subject.' : '.$subjectname);
					
						$mail_body = str_replace("%subjectname%",$subjectname,str_replace("%username%",$name,str_replace("%email%",$email,str_replace("%subject%",$subject,str_replace("%message%",$message,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%sitemail%",$site_email,stripslashes($mailformat)))))))));
					 		//echo "<pre>";
							//print_r($mail_body);
							//die();
							$this->email->message($mail_body);
						  if($this->email->send())
						  {
							
							//user mail
						$to = $email;
						$company = 'CustomerService@YouGotRated.com';
						$from = $site_email;
						
						//Get Email Format for Company
						$subject = $site_name."Thank you for contacting us";
						
						
						$this->email->from($company,$site_name);
						$this->email->to($to);
                        $this->email->cc($company); 
						$this->email->subject($subject);
					
						$mail_body = "Thanks for your feedback.<br/>
									  Regards,<br/>
									 ".$site_name."<br/>
									 -----------------------------------------------
									 <br/>
									 ".$message."<br/>";
					 				  	
							
							//echo "<pre>";
							//print_r($mail_body);
							//die();
							$this->email->message($mail_body);
						  if($this->email->send())
						  {
							
							
							
							
							$this->session->set_flashdata('success', 'Your mail has been sent. we will contact you soon');
							redirect(site_url(),'refresh');	
						  }
						  else
						  {
							 $this->session->set_flashdata('error', 'There is an error in sending e-mail, please try again!');
							 redirect(site_url(),'refresh');	
						  }
					  }else
						{
							 $this->session->set_flashdata('error', 'There is an error in sending e-mail, please try again!');
							 redirect(site_url(),'refresh');	
						  
						}
		
				}
			else
			{
			  $this->session->set_flashdata('error', 'There is an error in sending e-mail, please try again!');
			  redirect(site_url(),'refresh');	
			}
		
	}
	}
	
	
}
