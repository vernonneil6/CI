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
		
		$page = $this->common->get_footerlink_byintid($intid);
		
		if( count($page) > 0 )
		{
			$this->data['title'] = stripslashes($page[0]['title']);
			$this->data['varheading'] = stripslashes($page[0]['heading']);
			
			//Meta Keywords and Description
			$this->data['keywords'] = stripslashes($page[0]['metakeywords']);
			$this->data['description'] = stripslashes($page[0]['metadescription']);
			$total= $this->common->get_all_complaints_totaldamage($siteid);
		
			if(count($total)>0) {
			$this->data['total'] = round($total[0]['total']);
			}
				
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
			redirect('','refresh');	
		}
		
	}
	
	public function index()
	{
		$this->load->view('footerpage',$this->data);
	}
	
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
