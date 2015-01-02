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
	public function elitemember()
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->data['elitemembers'] = $this->agents->elitemembers();
			$this->load->view('agent',$this->data);
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
	
	public function userprofile($id)
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->data['getdata'] = $this->agents->data_by_id($id);
			$this->load->view('agent', $this->data);
	  	}
	}
	
	public function resetpassword($id)
	{
		if( $this->session->userdata['agent_data'] )
	  	{
			$this->data['getdata'] = $this->agents->data_by_id($id);
			$this->load->view('agent', $this->data);
			
			if($this->input->post('newpassword'))
			{
				$old = $this->input->post('oldpassword');
				$new = $this->input->post('password');
				$retype = $this->input->post('retypepassword');
				$pwd = $this->input->post('pwd');
				
				if($old != $pwd)
				{
					$this->session->set_flashdata('error', 'Old Password is incorrect');
					redirect('agent/resetpassword/'.$id,'refresh');
				}
				else
				{
					if($new != $retype)
					{
						$this->session->set_flashdata('error', 'Password not matched');
						redirect('agent/resetpassword/'.$id,'refresh');
					}
					else
					{
						$this->agents->userprofileupdate($new, $id);
						$this->session->set_flashdata('success', 'Password changed successfully');
						redirect('agent/userprofile/'.$id,'refresh');
					}		
				}	
			}
	  	}     
	}

}
