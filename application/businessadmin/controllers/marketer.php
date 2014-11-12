<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketer extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('marketer_data'))
	  	{
	      	redirect('marketerlogin', 'refresh');
		}
	 	$this->load->helper('form');
        $this->load->model('marketers');


		$this->data['header'] = $this->load->view('marketerheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['marketer_data'] )
	  	{
			$this->load->view('marketer',$this->data);
	  	}
                
	}
	
	public function agent()
	{
		if( $this->session->userdata['marketer_data'] )
	  	{
			$this->data['allagent'] = $this->marketers->data_allagent();
			$this->load->view('marketer',$this->data);
	  	}
                
	}
	public function addagent()
	{
		if( $this->session->userdata['marketer_data'] )
	  	{
			$this->load->view('marketer',$this->data);
			if($this->input->post('agentsubmit'))
			{
				$data=array(
					'url'=> base_url().'index.php',
					'name'=>$this->input->post('agentname'),
					'password'=>$this->input->post('agentpassword'),
					'signup'=>date("Y-m-d H:i:s"),
					'marketerid'=>$this->session->userdata['marketer_data'][0]->id,
					'subbrokerid'=>$this->session->userdata['marketer_data'][0]->subbrokerid
				);
				$this->marketers->data_agent($data);
				$this->marketers->allbroker($data);
			}
	  	}
                
	}
	
	function get_companyname()
	{
	   if (isset($_GET['term']))
	   {
	      $name = strtolower($_GET['term']);
	      $this->marketers->get_companynames($name);
	   }
	}
	function logout()
	{
		if( isset($this->session->userdata['marketer_data']) )
		{
			$this->session->unset_userdata('marketer_data');
			$this->session->sess_destroy();
		  	redirect('marketerlogin', 'refresh');
		}
		else
		{
			redirect('marketerlogin', 'refresh');
		}	
	}

}
