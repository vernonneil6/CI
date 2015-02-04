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
		$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($companyid);	    
		$this->load->view('widgetv',$this->data);
	}
}
