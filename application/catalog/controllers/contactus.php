<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Contactus extends CI_Controller {

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
	
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
			
		//Loading Model File
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
		
		$this->data['topads']= $this->common->get_all_ads('top','others',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','others',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','others',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','others',$siteid);
	  

		if($this->uri->segment(1) == 'contactus' && $this->uri->segment(2) == '')
		{
   		$this->data['title'] =  'Contact us';
		}
		
		$this->data['section_title'] = 'Contact Us';
		
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		$page = $this->common->get_pages_by_id(6,$siteid);
		
		if( count($page) > 0 )
		{
			$this->data['title'] = stripslashes($page[0]['title']).' : '.$this->data['site_name'];
			$this->data['varheading'] = stripslashes($page[0]['heading']);
			
			//Meta Keywords and Description
			$this->data['keywords'] = stripslashes($page[0]['metakeywords']);
			$this->data['description'] = stripslashes($page[0]['metadescription']);			
			
			//Page Content
			$this->data['content'] = nl2br(($page[0]['pagecontent']));
		
			//Load header and save in variable
			$this->data['header'] = $this->load->view('header',$this->data,true);
			$this->data['menu'] = $this->load->view('menu',$this->data,true);
			$this->data['footer'] = $this->load->view('footer',$this->data,true);
		}
		else
		{
			//Redirecting if Page not found
			redirect(site_url(),'refresh');	
		}
		
	}
	
	public function index()
	{  
	  $this->load->view('page',$this->data);
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
						
						$to = $site_email;
						$from = $email;
						
						//Get Email Format for Company
						$mail = $this->common->get_email_byid(4);
						$subject = $mail[0]['subject'];
						$mailformat = $mail[0]['mailformat'];
						
						$this->email->from($from);
						$this->email->to('customerservice@yougotrated.com');
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
						$from = 'customerservice@yougotrated.com';
						
						//Get Email Format for Company
						$subject = $site_name."Thank you for contacting us";
						
						
						$this->email->from($from,$site_name);
						$this->email->to($to);
						$this->email->bcc($from);
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
							redirect(base_url(), 'refresh');
						  }
						  else
						  {
							 $this->session->set_flashdata('error', 'There is an error in sending e-mail, please try again!');
							 redirect('contactus', 'refresh');
						  }
					  }else
						{
							 $this->session->set_flashdata('error', 'There is an error in sending e-mail, please try again!');
							 redirect('contactus', 'refresh');
						  
						}
		
				}
			else
			{
			  $this->session->set_flashdata('error', 'There is an error in sending e-mail, please try again!');
							 redirect('contactus', 'refresh');
			}
		
	}
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
