<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Faq extends CI_Controller {
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
			
		 $site = str_replace("www.",'',$domain);
		
		 /*if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		 {			
		    $site = $regs['domain'];
		 }*/
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
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		$this->data['title'] = 'Frequently Asked Questions and Answers';
		$this->data['section_title'] = 'FAQ';
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		//Addingg Setting Result to variable
		$this->data['faqs'] = $this->common->get_all_faqs();
				
		//Loading View File
		if(count($this->data['faqs'])>0)
		{
			$this->load->view('faq',$this->data);
		}
		else
		{
			redirect('welcome', 'refresh');
		}
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
