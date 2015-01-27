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
		
		$this->load->model('widgets');
		
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
	}
	
	public function index()
	{
		redirect(site_url(),'refresh');
	}
	
	public function business($companyid='')
	{
		$this->load->library('pagination');
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

		$this->data['reviews'] = $this->widgets->get_reviews_bycompanyid($companyid,$limit,$offset);
				
		$this->paging['base_url'] = site_url("widget/business/".$companyid);
		$this->paging['uri_segment'] = 3;
		$this->paging['total_rows'] = count($this->widgets->get_reviews_bycompanyid($companyid));
		$this->pagination->initialize($this->paging);
			    
		$this->load->view('widgetv',$this->data);
	}
}
