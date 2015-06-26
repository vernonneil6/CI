<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Fbtest extends CI_Controller {

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
		
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
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
	print_r($this->data['fbconfig']);
	 $this->load->library('facebook',$this->data['fbconfig']);
	 $user = $this->facebook->getUser();
	 echo "<pre>"; print_r($user); echo "<br>aldfskladfkladfsk<br>";
	 //die();
		if ($user)
		{
		 try
		  {
			  echo 'coming into try';
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $this->facebook->api('/me');
			echo "<pre>"; print_r($user_profile); 
			
		  } 
		  	catch (FacebookApiException $e)
			 {
				//error_log($e);
				print_r($e);
			}
		}
		die;
	}
	
	public function fblogin_view(){
		$this->load->view('fblogin_view');
}
}
		
