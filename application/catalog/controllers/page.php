<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Page extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		
		if($this->uri->segment(2)!='')
		{
			$uniquename = $this->uri->segment(2);
			if($uniquename!='')
			{
				$page = $this->common->get_page_by_uniquename($uniquename);
			}
		else
		{
			redirect(site_url(),'refresh');	
		}
		
		if( count($page) > 0 )
		{
			$this->data['title'] = ($page[0]['title']);
		}
		}
		include('include.php');
	}
	
	public function index($uniquename='')
	{  
		if($uniquename!='')
		{
			$page = $this->common->get_page_by_uniquename($uniquename);
		}
		else
		{
			redirect(site_url(),'refresh');	
		}
		
		if( count($page) > 0 )
		{
			$this->data['title'] = ($page[0]['title']);
			$this->data['heading'] = ($page[0]['heading']);
			
			//Meta Keywords and Description
			$this->data['keywords'] = ($page[0]['metakeywords']);
			$this->data['description'] = ($page[0]['metadescription']);			
			$this->load->view('header',$this->data);
			//Page Content
			$this->data['shortdescription'] = nl2br(($page[0]['shortdesc']));
			$this->data['content'] = nl2br(($page[0]['pagecontent']));
		}
		else
		{
			//Redirecting if Page not found
			redirect(site_url(),'refresh');	
		}

		$this->load->view('page',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */