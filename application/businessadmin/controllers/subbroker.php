<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subbroker extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('subbroker_data'))
	  	{
	      	redirect('subbrokerlogin', 'refresh');
		}
	 	$this->load->helper('form');
        $this->load->model('subbrokers');


		$this->data['header'] = $this->load->view('subbrokerheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->load->view('subbroker',$this->data);
	  	}
                
	}
	public function marketer()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['allmarketer'] = $this->subbrokers->data_allmarketer();
			$this->load->view('subbroker',$this->data);
	  	}
                
	}
	public function addmarketer()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->load->view('subbroker');
			
			if($this->input->post('marketersubmit'))
			{
				$data=array(
					'type'=> 'marketer',
					'name'=>$this->input->post('marketername'),
					'password'=>$this->input->post('marketerpassword'),
					'signup'=>date("Y-m-d H:i:s"),
					'subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id
				);
				$this->subbrokers->data_marketer($data);
				$this->subbrokers->allbroker($data);
			}
	  	}
                
	}
	public function agent()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['allagent'] = $this->subbrokers->data_allagent();
			$this->load->view('subbroker',$this->data);
	  	}
                
	}
	public function addagent()
	{
		if( $this->session->userdata['subbroker_data'] )
	  	{
			$this->data['marketername'] = $this->subbrokers->data_allmarketer();
			$this->load->view('subbroker',$this->data);
			if($this->input->post('agentsubmit'))
			{
				$data=array(
					'type'=> 'agent',
					'name'=>$this->input->post('agentname'),
					'password'=>$this->input->post('agentpassword'),
					'signup'=>date("Y-m-d H:i:s"),
					'marketerid'=>$this->input->post('agentmarketer'),
					'subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id
				);
				$this->subbrokers->data_agent($data);
				$this->subbrokers->allbroker($data);
			}
	  	}
                
	}
	function logout()
	{
		if( isset($this->session->userdata['subbroker_data']) )
		{
			$this->session->unset_userdata('subbroker_data');
			$this->session->sess_destroy();
		  	redirect('subbrokerlogin', 'refresh');
		}
		else
		{
			redirect('subbrokerlogin', 'refresh');
		}	
	}

}
