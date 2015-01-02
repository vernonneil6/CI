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
		//echo "<pre>";
		//print_r( $this->data['total'] );
		//die();
		
		if( $this->uri->segment(1) == 'go' && $this->uri->segment(2) == 'register' )
		{
   			$this->data['title'] = $this->data['site_name'].' : User Registration';
			$this->data['section_title'] = 'User Registration';
		}
		else
		{
			$this->data['title'] = $this->data['site_name'].' : Users';
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
			//Loading Helper File
    		$this->load->helper('form');
		
			//Loading View File
			$this->load->view('user',$this->data);
		}
		else
		{
			redirect('user','refresh');
		}
	}
}

	