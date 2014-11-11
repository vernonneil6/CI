<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('agent_data'))
	  	{
	      	redirect('marketerlogin', 'refresh');
		}
	 	$this->load->helper('form');
        $this->load->model('agents');


		$this->data['header'] = $this->load->view('agentheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->load->view('agent',$this->data);
	  	}
                
	}
	function get_companyname()
	{
	   if (isset($_GET['term']))
	   {
	      $name = strtolower($_GET['term']);
	      $this->agents->get_companynames($name);
	   }
	}
	function logout()
	{
			if( isset($this->session->userdata['agent_data']) )
			{
				$this->session->unset_userdata('agent_data');
				$this->session->sess_destroy();
				redirect('agentlogin', 'refresh');
			}
			else
			{
				redirect('agentlogin', 'refresh');
			}	
	}

}
