<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Remove extends CI_Controller {

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
		
		$this->data['topads']= $this->common->get_all_ads('top','others',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','others',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','others',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','others',$siteid);
		
		$this->load->model('complaints');
		
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		$page = $this->common->get_pages_by_id(7,$siteid);
		
		if( count($page) > 0 )
		{
			$this->data['title'] = stripslashes($page[0]['title']);
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
	
	public function complaint($complaintid='',$companyid='')
	{
		if($complaintid!=0 && $complaintid!='' && $companyid!=0 && $companyid!='')
		{
				$complaint = $this->complaints->get_complaint_byid($complaintid);
				
				if(count($complaint)>0)
				{
					if( $companyid == $complaint[0]['companyid'] )
					{
						$this->load->view('page',$this->data);	
					}
					else
					{
						redirect(site_url(),'refresh');		
					}
				}
				else
				{
					redirect(site_url(),'refresh');		
				}
		}
		else
		{
			redirect(site_url(),'refresh');
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */