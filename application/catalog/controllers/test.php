<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Test extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
			
		
		$this->load->model('codes');
				
		include('include.php');
		$this->data['site_url'] = $this->common->get_setting_value(2);
		
	}
	
	//btc address
	public function index()
	{  
		$this->load->view('test/index',$this->data);
	}
	
	public function transaction()
	{  
		$this->load->view('test/transaction',$this->data);
	}
	
	public function transaction_without_ac()
	{  
		$this->load->view('test/transaction_without_ac',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */