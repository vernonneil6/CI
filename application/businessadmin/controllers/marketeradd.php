<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketeradd extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		if( !$this->session->userdata('marketer_data'))
	  	{
	      	redirect('marketerlogin', 'refresh');
		}
	 	$this->load->helper('form');
                $this->load->model('marketeradds');


		$this->data['header'] = $this->load->view('marketerheader',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['marketer_data'] )
	  	{
			$marketerid = $this->session->userdata['marketer_data'][0]->subbrokerid;
			$siteid = $this->session->userdata('siteid');
			$this->data['remainingcount'] = $this->marketeradds->count_marketer($marketerid);
                     	$datas = $this->marketeradds->get_marketercount($marketerid);
                     	$this->data['marketercount'] = $datas['agent'];
                 	$this->load->view('marketeradd',$this->data);
	  	}
                
	}
	public function add()
	{
		if( $this->session->userdata['marketer_data'] )
	  	{
	  		if( $this->input->post('submitbroker') )
	  		{
			$data=array(
				'username'=>$this->input->post('brokername'),
				'password'=>$this->input->post('brokerpassword'),
				'marketername'=>$this->session->userdata['marketer_data'][0]->username,
				'marketerid'=>$this->session->userdata['marketer_data'][0]->id,
				'subbrokerid'=>$this->session->userdata['marketer_data'][0]->subbrokerid,
				'type'=>'agentaccount'
				);
			$this->marketeradds->agentadd($data);
                 	redirect('marketeradd','refresh');
                 	}
	  	}
                
	}
}