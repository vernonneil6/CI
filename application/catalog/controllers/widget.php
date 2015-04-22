<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Widget extends CI_Controller {

	public $data;
	
	public function __construct()
	{
  	parent::__construct();
		
		$this->data['site_name'] = $this->common->get_setting_value(1);
		$this->data['site_url'] = $this->common->get_setting_value(2);
		$this->data['searchword']='';
		
		$this->load->model('complaints');
		$this->load->model('users');
		$this->load->model('reviews');
		$this->load->model('reviews');
		$this->load->model('widgets');
		
		$this->load->library("pagination");

	}
	
	public function index()
	{
		redirect(site_url(),'refresh');
	}
	
	public function business($companyid='')
	{

		$company = $this->widgets->get_company_byid($companyid);
		$elite = $this->complaints->get_eliteship_bycompanyid($companyid);
		
		if( count($elite)>0 ) 
		{
			if ( count($company) > 0 )
			{
				
				$this->data['total'] = $this->widgets->get_total_review($companyid);
				$this->data['averagerating'] = $this->widgets->get_average_review($companyid);
			}
			else
			{
				$this->data['total'] = 0;
			}
		}
		
		$this->data['companyid'] = $companyid;
		$this->data['companyname'] = $company[0]['company'];
		$this->data['companyseo'] = $company[0]['companyseokeyword'];
		$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($companyid);	    
		$this->load->view('widget/widget',$this->data);
	}
	
	public function content($companyid='')
	{

		$company = $this->widgets->get_company_byid($companyid);
		$elite = $this->complaints->get_eliteship_bycompanyid($companyid);
		
		if( count($elite)>0 ) 
		{
			if ( count($company) > 0 )
			{
				
				$this->data['total'] = $this->widgets->get_total_review($companyid);
				$this->data['averagerating'] = $this->common->get_avg_ratings_bycmid($companyid); //$this->widgets->get_average_review($companyid);
			}
			else
			{
				$this->data['total'] = 0;
				$this->data['averagerating'] = '0.0';
			}
		}

		
		$config = array();
        $config["base_url"] = base_url() . "widget/content/". $companyid;
        $config["total_rows"] =$this->reviews->get_reviews_bycompanyid_count($companyid);
        $config["per_page"] = 5;
        $config["uri_segment"] = 4;
		$config['first_link'] = '';
		$config['last_link'] = '';

        $this->pagination->initialize($config);
 
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
      
		
		$this->data['companyid'] = $companyid;
		$this->data['companyname'] = $company[0]['company'];
		$this->data['companyseo'] = $company[0]['companyseokeyword'];
		$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($companyid,$config["per_page"], $page);	    
		$this->load->view('widget/widget_content',$this->data);
	}
}
