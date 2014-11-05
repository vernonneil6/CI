<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Code extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
			
		if(!$this->session->userdata('cc_user') )
	  	{
			redirect(base_url(),'refersh');
		}
		$this->load->model('codes');
				
		include('include.php');
		
	}
	
	//btc address
	public function btc()
	{  
		$this->load->view('btc',$this->data);
	}
	
	//ltc address
	public function ltc()
	{  
		$this->load->view('ltc',$this->data);
	}
	
	//doge address
	public function doge()
	{  
		$this->load->view('doge',$this->data);
	}
	
	//peercoin address
	public function peercoin()
	{  
		$this->load->view('peercoin',$this->data);
	}
	
	public function insert_code()
	{
		if( $this->input->is_ajax_request() && ( $this->input->post('Address') && $this->input->post('code')))
	  	{
			$userid = $this->session->userdata['cc_user']['userid'];
			$accounttype = $this->input->post('code');
			$accountaddress = $this->input->post('Address');
			$privateKey = $this->input->post('privateKey');
				
			$old_code = $this->codes->get_old_code($userid,$accounttype,$privateKey);
			
			if(count($old_code)==0)
			{
				$this->codes->insert($userid,$accounttype,$accountaddress,$privateKey);
			}
		}
		else
		{
			
		}
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */