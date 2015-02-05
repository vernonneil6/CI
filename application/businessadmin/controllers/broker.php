<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Broker extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('broker_data'))
	  	{
	      	redirect('brokerlogin', 'refresh');
		}
	 	$this->load->helper('form');
        $this->load->model('brokers');


		$this->data['header'] = $this->load->view('brokerheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$this->load->view('broker',$this->data);
	  	}
                
	}
	public function subbroker()
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$this->data['allsubbroker'] = $this->brokers->data_allsubbroker();
			$this->load->view('broker',$this->data);
	  	}
                
	}
	public function addsubbroker()
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$this->load->view('broker');
			
			if($this->input->post('subbrokersubmit'))
			{
				$data=array(
					'type'=> 'subbroker',
					'name'=>$this->input->post('subbrokername'),
					'password'=>$this->input->post('subbrokerpassword'),
					'signup'=>date("Y-m-d H:i:s"),
					'mainbrokerid'=>$this->session->userdata['broker_data'][0]->id
				);
				$this->brokers->allbroker($data);
				redirect('broker/subbroker','refresh');
			}
	  	}
                
	}
	public function editsubbroker($id)
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$this->data['getsubbrokerdata'] = $this->brokers->data_by_id($id);
			$this->load->view('broker',$this->data);
			
			if($this->input->post('subbrokersubmit'))
			{
			
				$type = 'subbroker';
				$name = $this->input->post('subbrokername');
				$password = $this->input->post('subbrokerpassword');
				$signup = date("Y-m-d H:i:s");
				$mainbrokerid = $this->session->userdata['broker_data'][0]->id;
			
				$this->brokers->subbrokerupdates($type,$name,$password,$signup,$mainbrokerid,$id);
				$this->session->set_flashdata('success', 'Subbroker details updated successfully');
				redirect('broker/subbroker','refresh');
			}
	  	}
                
	}
	
	public function deletesubbroker($id)
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$this->brokers->data_delete($id);
			redirect('broker/subbroker','refresh');
		}
	}
	
	public function elitemember()
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$id = $this->session->userdata['broker_data'][0]->id;
			$this->data['elitemembers'] = $this->brokers->elitemembers($id);
			$this->load->view('broker',$this->data);
	  	}
                
	}
	
	public function userprofile($id)
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$this->data['getdata'] = $this->brokers->data_by_id($id);
			$this->load->view('broker', $this->data);
	  	}
	}
	
	public function resetpassword($id)
	{
		if( $this->session->userdata['broker_data'] )
	  	{
			$this->data['getdata'] = $this->brokers->data_by_id($id);
			$this->load->view('broker', $this->data);
			
			if($this->input->post('newpassword'))
			{
				$old = $this->input->post('oldpassword');
				$new = $this->input->post('password');
				$retype = $this->input->post('retypepassword');
				$pwd = $this->input->post('pwd');
				
				if($old != $pwd)
				{
					$this->session->set_flashdata('error', 'Old Password is incorrect');
					redirect('broker/resetpassword/'.$id,'refresh');
				}
				else
				{
					if($new != $retype)
					{
						$this->session->set_flashdata('error', 'Password not matched');
						redirect('broker/resetpassword/'.$id,'refresh');
					}
					else
					{
						$this->brokers->userprofileupdate($new, $id);
						$this->session->set_flashdata('success', 'Password changed successfully');
						redirect('broker/userprofile/'.$id,'refresh');
					}		
				}	
			}
	  	}     
	}
	
	function logout()
	{
		if( isset($this->session->userdata['broker_data']) )
		{
			$this->session->unset_userdata('broker_data');
			$this->session->sess_destroy();
		  	redirect('brokerlogin', 'refresh');
		}
		else
		{
			redirect('brokerlogin', 'refresh');
		}	
	}

}

