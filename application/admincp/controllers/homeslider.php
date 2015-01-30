<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Homeslider extends CI_Controller 
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
  		$this->load->model('homesliders');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Home Page Slider ';
		$this->data['section_title'] = 'Home Page Slider';
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
			$this->data['homesliders'] = $this->homesliders->get_all_slidersetting($siteid);
			
			$this->data['sliderimage']=$this->homesliders->slider();

			$this->load->view('homeslider',$this->data);
		}
	}	
	public function add()
	{		
		$this->load->view('homeslider');
		
		if($this->input->post('submitimage'))
		{
		$config['upload_path'] = '../uploads/slider/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '1000000';
		$config['max_width']  = '1024000';
		$config['max_height']  = '768000';
		$this->load->library('upload', $config);
		
			if($this->upload->do_upload('images'))
			{
				$title =$this->input->post('title') ;	
				$imgdata = $this->upload->data();
				$this->homesliders->addimage($title,$imgdata['file_name']);
				redirect('homeslider', 'refresh');
		
			}
		}
	
	}
    
    public function edit($id)
	{
		$row = $this->homesliders->updatefield($id);
		$data['title']=$row['title'];
		$data['image']=$row['image'];
		$data['id']=$row['id'];
		$this->load->view('homeslider',$data);
        
        if($this->input->post('submitimage'))
		{
		$config['upload_path'] = '../uploads/slider/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '10000';
		$config['max_width']  = '1050';
		$config['max_height']  = '309';
		$this->load->library('upload', $config);
		
			if($this->upload->do_upload('images'))
			{
				$title =$this->input->post('title') ;	
				$imgdata = $this->upload->data();
					$this->homesliders->updateslider($id,$title,$imgdata['file_name']);
				redirect('homeslider', 'refresh');
			}
			else
			{
				$title =$this->input->post('title') ;
				$image =$this->input->post('hiddenimage') ;
				$this->homesliders->updateslider($id,$title,$image);
				redirect('homeslider', 'refresh');
			}
		}
    }
    
	function delete($id)
	{
		$this->homesliders->deleteslider($id);
		redirect('homeslider', 'refresh');
	}

	
}
