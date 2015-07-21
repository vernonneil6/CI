<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Homebannertext extends CI_Controller 
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
  		$this->load->model('homebannertexts');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Home Page Banner Text ';
		$this->data['section_title'] = 'Home Page Banner Text';
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
			$siteid = $this->session->userdata('siteid');
			//$this->data['homebannertext'] = $this->homebannertexts->get_allbannertext($siteid);
			
			$this->data['bannertext']=$this->homebannertexts->get_allbannertext();

			$this->load->view('homebannertext',$this->data);
		}
	}	
	
	public function add()
	{	
		$this->load->view('homebannertext');
		if($this->input->post('submitbannertext'))
		{
				$position =$this->input->post('position') ;	
				$text =$this->input->post('title') ;
				$this->homebannertexts->addtext($position,$text);
				redirect('homebannertext', 'refresh');
		
		}
	}
	
	public function edit($id)
	{	
		
		$row = $this->homebannertexts->updatefield($id);
		$data['position']=$row['position'];
		$data['title']=$row['text'];
		$data['id']=$row['id'];
		$this->load->view('homebannertext',$data);
		if($this->input->post('updatebannertext'))
		{
				$post=$this->input->post();
				
				$position =$this->input->post('position') ;	
				$text =$this->input->post('title') ;
				$this->homebannertexts->updatetext($id,$position,$text);
				redirect('homebannertext', 'refresh');
		
		}
	}
	function delete($id)
	{
		$this->homebannertexts->deletetext($id);
		redirect('homebannertext', 'refresh');
	}

	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('homebannertext', 'refresh');
			}
				
			
			$ad = $this->homebannertexts->get_homebannertexts_byid($id);
			if(count($ad)>0) 
			{
			
				if( $this->homebannertexts->disable_homebannertexts_byid($id) )
				{
					$this->session->set_flashdata('success', 'Home Banner Text status disabled successfully.');
					redirect('homebannertext', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating Home Banner Text status. Try later!');
					redirect('homebannertext', 'refresh');
				} 
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Home Banner Text status. Try later!');
				redirect('homebannertext', 'refresh');
			}
	  }
	}
	
	//Function For Change Status to "Enable"
	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	    {
			if(!$id)
			{
				redirect('homebannertext', 'refresh');
			}
		
			$ad = $this->homebannertexts->get_homebannertexts_byid($id);
			if(count($ad)>0) 
			{
				if( $this->homebannertexts->enable_homebannertexts_byid($id) )
				{
					$this->session->set_flashdata('success', 'Home Banner Text status enabled successfully.');
					redirect('homebannertext', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating Home Banner Text status. Try later!');
					redirect('homebannertext', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Home Banner Text status. Try later!');
				redirect('homebannertext', 'refresh');
			}
	    }
	}
}
