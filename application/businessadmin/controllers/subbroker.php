<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subbroker extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
	      	redirect('adminlogin', 'refresh');
		}
		
		//Loading Helper File
	 	$this->load->helper('form');
			
		//Loading Model File
	  	
                $this->load->model('subbrokers');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Sub Broker';
		$this->data['section_title'] = 'Sub Broker';
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					$this->data['selsite']['all'] = 'All Websites';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite']['all'] = 'All Websites';
					$this->data['selsite'] = array();
				}
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$i=0;
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata('siteid');
			$brokerids=$this->subbrokers->brokersid($companyid);
			$this->data['brokerid']=$brokerids['subbrokerid'];
			$this->data['marketerview'] =$this->subbrokers->marketerview($companyid);	
			foreach($this->data['marketerview'] as $marketerid)
			{
				$this->data['agentview'][$i] = $this->subbrokers->agentview($companyid,$marketerid->id);
				$i++;
			}	
			
			$this->load->view('subbroker',$this->data);
	  	}
	}
	function add()
	{
		$companyid = $this->session->userdata['youg_admin']['id'];	
		$this->data['marketerview'] =$this->subbrokers->marketerview($companyid);	
		$this->data['remainingagentcount'] = $this->subbrokers->count_agent($companyid);
		$this->data['remainingmarketercount'] = $this->subbrokers->count_marketer($companyid);
                $datas = $this->subbrokers->get_count($companyid);
                $this->data['agentcount'] = $datas['agent'];	
                $this->data['marketercount'] = $datas['marketer'];
		$brokerids=$this->subbrokers->brokersid($companyid);
                $this->data['brokerid']=$brokerids['subbrokerid'];
		$this->data['marketerview'] =$this->subbrokers->marketerview($companyid);	
		$this->load->view('subbroker',$this->data);
	
		if($this->input->post('submitbroker'))
		{
		$name=$this->input->post('brokername');
		$type=$this->input->post('brokertype');
		if($this->input->post('marketername')!='select')
		{
		$marketername=$this->input->post('marketername');
		$id=$this->subbrokers->marketerid($marketername);
		$marketerid['marketerid']=$id['id'];
		$brokerid='';
		}
		else
		{
		$ids = $this->session->userdata['youg_admin']['id'];
		$brokerids=$this->subbrokers->brokersid($ids);
		$brokerid['brokerid']=$brokerids['id'];
		$marketername='';
		$marketerid='';
		}
		$password=$this->input->post('brokerpassword');
		$subbrokerid = $this->session->userdata['youg_admin']['id'];
		$this->subbrokers->brokeradd($name,$type,$password,$subbrokerid,$marketername,$marketerid['marketerid'],$brokerid['brokerid']);	
		redirect('subbroker','refresh');
		}
	}
}