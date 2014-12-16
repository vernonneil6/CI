<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Mainbroker extends CI_Controller 
{
	public $paging;
	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		
		if( $this->session->userdata('youg_admin'))
	  	{
		    //If no session, redirect to login page
			//echo site_url();die();
	      	if(!array_key_exists('type',$this->session->userdata['youg_admin']))
			{
				$a = site_url();
				$p = explode('/admincp',$a);
				//echo $p[0];
				//die();
				redirect($p[0].'/businessadmin', 'refresh');
			}
		}
		else
		{
			redirect('adminlogin', 'refresh');
		}
		//Loading Model File
  		$this->load->model('mainbrokers');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Main Broker ';
		$this->data['section_title'] = 'Main Broker';
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite'] = array();
				}
	
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
	  if($this->session->userdata['youg_admin'])
	  {
			/*$siteid = $this->session->userdata('siteid');
			$this->data['mainbrokers'] = $this->mainbrokers->get_all_brokersetting($siteid);
			$this->data['brokerview'] = $this->mainbrokers->brokerview();
			$i=0;
			
			foreach($this->data['brokerview'] as $subbroker)
			{
				$this->data['marketerview'][$i] = $this->mainbrokers->marketerview($subbroker->id);
				$i++;
			}
			foreach($this->data['brokerview'] as $marketerid)
			{
				$this->data['agentview'][$i] = $this->mainbrokers->agentview($marketerid->id);
				$i++;
			}	*/
			
			$this->data['subbroker'] = $this->mainbrokers->subbroker();
				
			$this->load->view('mainbroker',$this->data);
	  }
	}	
	function add()
	{
		
		if($this->input->post('submitbroker'))
		{
		$request=$this->input;
		
		$data=array(
		'type'=> 'subbroker',
		'name'=>$request->post('username'),
		'password'=>$request->post('password'),
		'marketer'=>$request->post('marketer'),
		'agent'=>$request->post('agent'),
		'signup'=>date("Y-m-d H:i:s")
		);
		
		$this->mainbrokers->allbroker($data);
		}
		$this->load->view('mainbroker');
	}
	
	function elitemember()
	{
		$subbrokers = array();
		$this->data['subbroker'] = $this->mainbrokers->elitemembers();
		foreach($this->data['subbroker'] as $subbroker)
		{
			$id = $subbroker['id'];
			$subbrokers = $this->mainbrokers->elite_company($id);
		}
		$this->data['subbrokers'] = $subbrokers;
		$this->load->view('mainbroker', $this->data);
	}
	function marketer()
	{
		
		$this->data['marketers']=$this->mainbrokers->marketers();
		$this->load->view('mainbroker', $this->data);
			
	}
	function agent()
	{
		$this->data['agents']=$this->mainbrokers->agents();
		$this->load->view('mainbroker', $this->data);
	
	}
	function view($id='')
	{
		if( $this->session->userdata['youg_admin'] )
		{
					if(!$id)
					{
						redirect('mainbroker', 'refresh');
					}
					$this->data['views']=$this->mainbrokers->view_details($id);
					
					//print_r($this->data['views']);
			       					
					if(count($this->data['views']) > 0)
					{			
						//Loading View File
						$this->load->view('mainbrokerview',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('mainbroker', 'refresh');
					}
		}
		
		
	}
	function mview($id='')
	{
		if( $this->session->userdata['youg_admin'] )
		{
					if(!$id)
					{
						redirect('mainbroker', 'refresh');
					}
					$this->data['views']=$this->mainbrokers->view_details($id);
					
					//print_r($this->data['views']);
			       					
					if(count($this->data['views']) > 0)
					{			
						//Loading View File
						$this->load->view('mainbrokerview',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('mainbroker/marketer', 'refresh');
					}
		}
		
		
	}
	function aview($id='')
	{
		if( $this->session->userdata['youg_admin'] )
		{
					if(!$id)
					{
						redirect('mainbroker', 'refresh');
					}
					$this->data['views']=$this->mainbrokers->view_details($id);
					
					//print_r($this->data['views']);
			       					
					if(count($this->data['views']) > 0)
					{			
						//Loading View File
						$this->load->view('mainbrokerview',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('mainbroker/agent', 'refresh');
					}
		}
		
		
	}
	
}
?>
