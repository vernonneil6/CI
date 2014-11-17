<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Widget extends CI_Controller {

	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/widget
	*	- or -  
	* 		http://example.com/index.php/widget/index
	*	- or -
	* Since this controller is set as the default controller in 
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/widget/<method_name>
	* @see http://codeigniter.com/businessdirectory_guide/general/urls.html
	*/
	public $data;
	
	public function __construct()
  {
  	parent::__construct();
		
		$this->data['site_name'] = $this->common->get_setting_value(1);
		$this->data['site_url'] = $this->common->get_setting_value(2);
		$this->data['searchword']='';
	}
	
	public function index()
	{
		redirect(site_url(),'refresh');
	}
	
	public function business($companyid='')
	{
		//Loading model file
		$this->load->model('widgets');
		$this->load->model('complaints');
		
		$this->data['sites'] = $this->widgets->get_all_websites();
		$company = $this->widgets->get_company_byid($companyid);
		$rating = $this->widgets->get_average_review($companyid);
		
		$elite = $this->complaints->get_eliteship_bycompanyid($companyid);
		
		if( count($elite)>0 ) {
		if ( count($company) > 0 )
		{
			$this->data['name'] = stripslashes($company[0]['company']);
			$this->data['companyseo'] = stripslashes($company[0]['companyseokeyword']);
			$this->data['url'] = site_url('complaint/viewcompany/'.$company[0]['companyseokeyword']);
			$this->data['rating'] = ceil($rating);
			$this->data['total'] = $this->widgets->get_total_review($companyid);
			$this->data['verifiedlogo'] = $this->common->get_setting_value(17);
		}
		else
		{
			$this->data['name'] = '';
			$this->data['url'] = site_url();
			$this->data['rating'] = 0;
			$this->data['total'] = 0;
		}
		//Loading View File
		$this->load->view('widgetv',$this->data);
				}
				else
				{
					redirect(site_url(),'refresh');
				}
	}
}

/* End of file widget.php */
/* Location: ./application/controllers/widget.php */
