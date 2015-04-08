<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Tutorial extends CI_Controller 
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
  		$this->load->model('tutorials');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Tutorial ';
		$this->data['section_title'] = 'Tutorial';
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
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['tutorials'] = $this->tutorials->get_all_tutorialsetting($siteid);
			
			//$this->data['sliderimage']=$this->tutorials->slider();
			$this->data['tutorial']=$this->tutorials->tutorial();

			//Loading View File
			$this->load->view('tutorial',$this->data);
	  }
	}	
	public function add()
	{
		
		$this->load->view('tutorial');
		
		

		if($this->input->post('submitimage'))
		{
			
			$config['upload_path'] = '../uploads/tutorial/';
			$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
			$config['max_size']	= '1000000';
			$config['max_width']  = '1024000';
			$config['max_height']  = '768000';
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('images'))
			{
				$title =$this->input->post('title');	
				$type =$this->input->post('filetype');	
				$imgdata = $this->upload->data();
				$this->tutorials->addtutorial($title,$type,$imgdata['file_name']);
				redirect('tutorial', 'refresh');
		
			}
			else
			{
			   $title =$this->input->post('title');	
			   $type =$this->input->post('filetype');		
			   $video =$this->input->post('videourl');
			   $this->tutorials->addvideotutorial($title,$type,$video);
			   redirect('tutorial', 'refresh');		
			}
		}
			
	}
    public function edit($id)
	{
		$row=$this->tutorials->updatefield($id);
                $data['title']=$row['title'];
                $data['image']=$row['image'];
                $data['type']=$row['type'];
                $data['file']=$row['file'];
                $data['id']=$row['id'];
		$this->load->view('tutorial',$data);
        if($this->input->post('submitimage'))
		{
			
			if($this->input->post('videourl'))
			{
			   $title =$this->input->post('title');	
			   $type =$this->input->post('filetype');		
			   $video =$this->input->post('videourl');
			   $this->tutorials->updatevideotutorial($id,$title,$type,$video);
			   redirect('tutorial', 'refresh');	
			}
			
		
			$config['upload_path'] = '../uploads/tutorial/';
			$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
			$config['max_size']	= '1000000';
			$config['max_width']  = '1024000';
			$config['max_height']  = '768000';
			$this->load->library('upload', $config);
		
			if($this->upload->do_upload('images'))
			{
				//echo '<pre>';print_r($_POST);die('1');
				$title =$this->input->post('title');	
				$type =$this->input->post('filetype');	
				$imgdata =str_replace('','-',$this->upload->data());
					$this->tutorials->updatetutorial($id,$title,$type,$imgdata['file_name']);
				redirect('tutorial', 'refresh');
			}
			else
			{
				$title =$this->input->post('title') ;
				$type =$this->input->post('filetype');
				$image =$this->input->post('hiddenimage') ;
				$this->tutorials->updatetutorial($id,$title,$type,$image);
				redirect('tutorial', 'refresh');
			
			}
			
			
		}
        }
	function delete($id)
	{
		$this->tutorials->deletetutorial($id);
		redirect('tutorial', 'refresh');
	}
	//Function For Change Status to "Disable"
	function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('tutorial', 'refresh');
			}
				
			if( $this->settings->disable_tutorial_byid($id) )
			{
				$this->session->set_flashdata('success', 'Tutorial status disabled successfully.');
				redirect('tutorial', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Tutorial status. Try later!');
				redirect('tutorial', 'refresh');
			}
	  }
	}
	
	//Function For Change Status to "Enable"
	function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if(!$id)
			{
				redirect('tutorial', 'refresh');
			}
			
			if( $this->settings->enable_tutorial_byid($id) )
			{
				$this->session->set_flashdata('success', 'Tutorial status enabled successfully.');
				redirect('tutorial', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Tutorial status. Try later!');
				redirect('tutorial', 'refresh');
			}
	  }
	}
	function setdefault($id,$title)
	{
		$alreadysetdefault=$this->tutorials->check_setdefault();
		
		if($id !=$alreadysetdefault['id'])
		{
		 $setdefault=$this->tutorials->setdefault_welcomevideo($id);
		 $unsetdefault=$this->tutorials->unset_othervideos($id);
		}
		//Loading View File
		redirect('tutorial', 'refresh');		
	}
	

	
}
