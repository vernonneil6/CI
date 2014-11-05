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
			$subbrokerid = $this->session->userdata['marketer_data'][0]->subbrokerid;
			$marketerid = $this->session->userdata['marketer_data'][0]->id;
			$this->data['marketerall']=$this->marketers->get_marketer($subbrokerid,$marketerid);
			$this->load->view('marketer',$this->data);
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