<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	/**
	* Index Page for this controller.
	*
	* Maps to the following URL
	* 		http://example.com/index.php/dashboard
	*	- or -  
	* 		http://example.com/index.php/dashboard/index
	*	- or -
	* Since this controller is set as the default controller in 
	* config/routes.php, it's displayed at http://example.com/
	*
	* So any other public methods not prefixed with an underscore will
	* map to /index.php/dashboard/<method_name>
	* @see http://codeigniter.com/user_guide/general/urls.html
	*/
	
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		    //If no session, redirect to login page
			//echo site_url();die();
	      	redirect('adminlogin', 'refresh');
		}
		
		//Loading Helper File
	  	$this->load->helper('form');
			
		//Loading Model File
	 	$this->load->model('videos');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Videos';
		$this->data['section_title'] = 'Videos';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
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
			$id=$this->session->userdata['youg_admin']['id'];
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['videos'] = $this->videos->get_all_videos($id,$siteid);
			//Loading View File
			$this->load->view('video',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('video', 'refresh');
			}
				
			//Getting detail for displaying in form
			$this->data['video'] = $this->videos->get_video_byid($id);
			
			if( count($this->data['video'])>0 )
			{			
				//Loading View File
				$this->load->view('video',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('video', 'refresh');
			}
	  }
	}
	
	//Updating the Record
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			//If Old Record Update
			if( $this->input->post('id') )
	  		{
						//Getting id
						$id = $this->encrypt->decode($this->input->post('id'));
				
						//Getting value
						$title = addslashes($this->input->post('title'));
					  	$videourl = addslashes($this->input->post('videourl'));
						$videono = addslashes($this->input->post('videono'));
						
						//Updating Record With Image
						if($this->videos->update($id,$title,$videourl,$videono))
						{
							$this->session->set_flashdata('success', 'video updated successfully.');
							redirect('video', 'refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'There is error in updating video. Try later!');
							redirect('video', 'refresh');
						}
				}
				else{		redirect('video', 'refresh'); }
		}
			else
				{
							redirect('adminlogin', 'refresh');
				}
			}


	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('video', 'refresh');
			}
				
			$video = $this->videos->get_video_byid($id);
			if(count($video)>0) {
			if( $this->videos->disable_video_byid($id) )
			{
				$this->session->set_flashdata('success', 'video status disabled successfully.');
				redirect('video', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating video status. Try later!');
				redirect('video', 'refresh');
			} }
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating video status. Try later!');
				redirect('video', 'refresh');
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
				redirect('video', 'refresh');
			}
			
			$video = $this->videos->get_video_byid($id);
			if(count($video)>0) {
			if( $this->videos->enable_video_byid($id) )
			{
				$this->session->set_flashdata('success', 'video status enabled successfully.');
				redirect('video', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating video status. Try later!');
				redirect('video', 'refresh');
			}}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating video status. Try later!');
				redirect('video', 'refresh');
			}
	  }
	}
	public function addvideo()
	{
		$this->load->view('video');
		if($this->input->post('addbtn'))
		{
	  	$id=$this->session->userdata['youg_admin']['id'];
		$siteid = $this->session->userdata('siteid');
		$title=$this->input->post('addtitle');
		$videourl=$this->input->post('addvideourl');
		$this->videos->addurl($title,$videourl,$id,$siteid);
		}
		
		
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */