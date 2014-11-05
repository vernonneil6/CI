<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agentdashboard extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('agent_data'))
	  	{
	      	redirect('marketerlogin', 'refresh');
		}
	 	$this->load->helper('form');
                $this->load->model('agentdashboards');


		$this->data['header'] = $this->load->view('agentheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$subbrokerid = $this->session->userdata['agent_data'][0]->subbrokerid;
			$this->data['agentall']=$this->agentdashboards->get_agent($subbrokerid);
			$this->load->view('agentdashboard',$this->data);
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