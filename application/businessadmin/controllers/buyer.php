<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class buyer extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
	      	redirect('adminlogin', 'refresh');
		}
		
		//Loading Helper File
	 	$this->load->helper('form');
			
		//Loading Model File
	  	
                $this->load->model('buyers');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Buyer&#39;s Protection program';
		$this->data['section_title'] = 'Buyer&#39;s Protection program';
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					$this->data['selsite']['all'] = 'All Websites';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite']['all'] = 'All Websites';
					$this->data['selsite'] = array();
				}
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata('siteid');
                      
			$this->load->view('buyer',$this->data);
	  	}
                
	}
}
