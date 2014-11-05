<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Errors extends CI_Controller {

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
	
	public $paging;
	public $data;
	
	public function __construct()
  {
  	parent::__construct();
		
		//Loading Helper File
		$this->load->helper('form');
		// Your own constructor code
		if( $this->session->userdata('youg_admin'))
	  	{
		    //If no session, redirect to login page
			//echo site_url();die();
	      	if(!array_key_exists('type',$this->session->userdata['youg_admin']))
			{
				$a = site_url();
				$p = explode('/admincp',$a);
				//echo $p[0];
				//die();
				redirect($p[0].'/businessadmin', 'refresh');
			}
		}
		else
		{
			redirect('adminlogin', 'refresh');
		}
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Error Logs';
		$this->data['section_title'] = 'Error Logs';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		$this->data['updated'] = false;
		
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
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
		
			$file = $this->config->item('log_path')."logs.txt";
			
			if (file_exists($file)) {
				$this->data['log'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
			} else {
				$this->data['log'] = '';
			}
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('errors',$this->data);
	  }
	}
	
	//Clear Error log file
	public function clear() {
		
		$file = $this->config->item('log_path')."logs.txt";
		
		if (file_exists($file)) {
			$handle = fopen($file, 'w+'); 
				
			fclose($handle);
		}
		
		$this->session->set_flashdata('success', 'Success: You have successfully cleared your error log!');
		redirect('errors', 'refresh');		
		
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */