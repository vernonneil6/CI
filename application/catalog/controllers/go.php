<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Go extends CI_Controller {

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
		
		//Loading Model File
	  	$this->load->model('users');
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
				
		if( $this->uri->segment(1) == 'go' && $this->uri->segment(2) == 'register' )
		{
   			$this->data['title'] = 'Registration';
			$this->data['section_title'] = 'User Registration';
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
			redirect('user', 'refresh');
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
	
	public function account()
	{
		$this->load->view('user/account',$this->data);
	}
	
	public function update()
	{
		$uniqueid = uniqid();
		$firstname = addslashes($this->input->post('firstname'));
		$lastname = addslashes($this->input->post('lastname'));
		$email = addslashes($this->input->post('email'));
		$password = addslashes($this->input->post('password'));
		$username = addslashes($this->input->post('username'));
		
		if($this->users->insert_register($firstname,$lastname,$email,$password,$username,$uniqueid))
		{
			$this->load->library('email');
			
			$site_name = $this->common->get_setting_value(1);
			$site_url = $this->common->get_setting_value(2);
			$site_email = $this->common->get_setting_value(5);			
			
			$mail = $this->common->get_email_byid(1);
			$subject = $mail[0]['subject'];
			$mailformat = $mail[0]['mailformat'];		
			$newuniqueid = $uniqueid;
			$to = $email;
						
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
			redirect('login', 'refresh');
		}
	}
}

	
