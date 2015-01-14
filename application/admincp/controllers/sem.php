<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Sem extends CI_Controller {

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
	 	$this->load->model('sems');
			
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : SEMs ';
		$this->data['section_title'] = 'SEMs';
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
			//Addingg Result to view parameter
			$siteid = $this->session->userdata('siteid');
			$this->data['sems'] = $this->sems->get_all_sem($siteid);
					
			//Loading View File
			$this->load->view('sem',$this->data);
	  }
	}
	
	public function edit($intid='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$intid)
			{
				redirect('sem', 'refresh');
			}
		
			//Addingg Result to view parameter
			$this->data['sem'] = $this->sems->get_sems_byid($intid);
			if( count($this->data['sem'])>0 )
			{
				//Loading View File
				$this->load->view('sem',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('sem', 'refresh');
			}
	  }
	}
	
	//Updating the record
	public function update()
	{
		if( $this->input->post('btnback') )
		{
			redirect('sem', 'refresh');
		}
		
		//If New Record Insert
		if( $this->session->userdata['youg_admin'] && $this->input->post('btnsubmit') )
	  	{
			//Getting value
			$vartitle = addslashes($this->input->post('txttitle'));
			$varurl = addslashes($this->input->post('txturl'));
			
			//load library
			$this->load->library('upload');
				
			//Uploading Cover Image and creating Thumb
			$config['upload_path'] = $this->config->item('main_upload_path');
			$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
			$config['max_size']	= $this->config->item('max_size');
			$config['max_width']  = $this->config->item('max_width');
			$config['max_height']  = $this->config->item('max_height');
			$config['remove_spaces'] = TRUE;
			$a = explode('.',$_FILES['logoimage']['name']);
			$ex = end($a);
			$main = str_replace('.'.$ex,'',$_FILES['logoimage']['name']);
			$config['file_name'] = $main.date('YmdHis');
			
			// Initialize the new config
			$this->upload->initialize($config);
			//Uploading Image
			$this->upload->do_upload('logoimage');
			
			//Getting Uploaded Image File Data
			$imgdata = $this->upload->data();
			$imgerror = $this->upload->display_errors();
			/*echo"<pre>";
			print_r($imgdata);
			print_r($imgerror);
			die();*/
			if( $imgerror == '' )
			{
				//Configuring Thumbnail 
				$config['image_library'] = 'gd2';
				$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
				$config['new_image'] = $this->config->item('thumb_upload_path').$imgdata['file_name'];
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = FALSE;
				$config['thumb_marker'] = '';
				$config['width'] = $this->config->item('thumb_width');
				$config['height'] = $this->config->item('thumb_height');
				
				//Loading Image Library
				$this->load->library('image_lib', $config);
						
				//Creating Thumbnail
				$this->image_lib->resize();
				$thumberror = $this->image_lib->display_errors();
			}
			else
			{
				$thumberror= '';
			}
				
			if( $imgerror != '' || $thumberror != '' )
			{
				$error[0] = $imgerror;
				$error[1] = $thumberror;
			}
			else
			{
				$error = array();
			}
			/*print_r($error);
			die();*/
			if( count($error)==0 && count($imgdata) > 0 )
			{
				//Inserting New Record
				if( $this->sems->insert($vartitle,$varurl,$imgdata['file_name']) )
				{
					$this->session->set_flashdata('success', 'SEM inserted successfully.');
					redirect('sem', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in inserting SEM. Try later!');
					redirect('sem', 'refresh');
				}
			}
			else
			{
				//Error in upload
				$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
				
				redirect('sem','refresh');
			}
			
		}
		
		//If Old Record Update
		else if( $this->session->userdata['youg_admin'] && $this->input->post('editaction') )
	  	{			
		//print_r($_REQUEST); die;
			//Getting intid
			$intid = $this->encrypt->decode($this->input->post('txtintid'));
			
			//Getting value
		  	$vartitle = addslashes($this->input->post('txttitle'));
			$varurl = addslashes($this->input->post('txturl'));
			
			//echo"<pre>";
			//print_r($_FILES);
			//die();
			
			if(count($_FILES)>0)
			{
				if(count($_FILES['logoimage'])>0)
				{
					if( $_FILES['logoimage']['name']!='' && $_FILES['logoimage']['size'] > 0 )
					{
						//load library
						$this->load->library('upload');
							
						//Uploading Cover Image and creating Thumb
						$config['upload_path'] = $this->config->item('main_upload_path');
						$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
						$config['max_size']	= $this->config->item('max_size');
						$config['max_width']  = $this->config->item('max_width');
						$config['max_height']  = $this->config->item('max_height');
						$config['remove_spaces'] = TRUE;
						$a = explode('.',$_FILES['logoimage']['name']);
						$ex = end($a);
						$main = str_replace('.'.$ex,'',$_FILES['logoimage']['name']);
						$config['file_name'] = $main.date('YmdHis');
						
						// Initialize the new config
						$this->upload->initialize($config);
						//Uploading Image
						$this->upload->do_upload('logoimage');
						
						//Getting Uploaded Image File Data
						$imgdata = $this->upload->data();
						$imgerror = $this->upload->display_errors();
						/*echo"<pre>";
						print_r($imgdata);
						print_r($imgerror);
						die();*/
						if( $imgerror == '' )
						{
							//Configuring Thumbnail 
							$config['image_library'] = 'gd2';
							$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
							$config['new_image'] = $this->config->item('thumb_upload_path').$imgdata['file_name'];
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = FALSE;
							$config['thumb_marker'] = '';
							$config['width'] = $this->config->item('thumb_width');
							$config['height'] = $this->config->item('thumb_height');
							
							//Loading Image Library
							$this->load->library('image_lib', $config);
									
							//Creating Thumbnail
							$this->image_lib->resize();
							$thumberror = $this->image_lib->display_errors();
						}
						else
						{
							$thumberror= '';
						}
							
						if( $imgerror != '' || $thumberror != '' )
						{
							$error[0] = $imgerror;
							$error[1] = $thumberror;
						}
						else
						{
							$error = array();
						}
						/*print_r($error);
						die();*/
						if( count($error)==0 && count($imgdata) > 0 )
						{
							//Unlink Old Images
							$media = $this->sems->get_sems_byid($intid);
							if( count($media)>0 )
							{
								if( $media[0]['mainimg']!='' )
								{
									if( file_exists($this->config->item('main_upload_path').$media[0]['mainimg']) )
									{
										//Deleting main file
										unlink($this->config->item('main_upload_path').$media[0]['mainimg']);
									}
								}
								if( $media[0]['thumbimg']!='' )
								{
									if( file_exists($this->config->item('thumb_upload_path').$media[0]['thumbimg']) )
									{
										//Deleting thumbnail
										unlink($this->config->item('thumb_upload_path').$media[0]['thumbimg']);
									}
								}
							}
							
							//Updating SEM Record
							if( $this->sems->update($intid,$vartitle,$varurl,$imgdata['file_name']) )
							{
								$this->session->set_flashdata('success', 'SEM updated successfully.');
								redirect('sem', 'refresh');
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in updating SEM. Try later!');
								redirect('sem', 'refresh');
							}
						}
						else
						{
							//Error in upload
							$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
							
							redirect('sem','refresh');
						}
					}
					else
					{			
						//Updating SEM Record
						if( $this->sems->update_noimage($intid,$vartitle,$varurl) )
						{
							$this->session->set_flashdata('success', 'SEM updated successfully.');
							redirect('sem', 'refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'There is error in updating SEM. Try later!');
							redirect('sem', 'refresh');
						}
					}
				}
			}
		}
		
		else
		{
			redirect('sem', 'refresh');
		}
	}
	

	//Function For Change Status to "Disable"
	public function disable($intid='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$intid)
			{
				redirect('sem', 'refresh');
			}
				
			if( $this->sems->disable_sem_byid($intid) )
			{
				$this->session->set_flashdata('success', 'SEM status disabled successfully.');
				redirect('sem', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating SEM status. Try later!');
				redirect('sem', 'refresh');
			}
	  }
	}
	
	//Function For Change Status to "Enable"
	public function enable($intid='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if(!$intid)
			{
				redirect('sem', 'refresh');
			}
						
			if( $this->sems->enable_sem_byid($intid) )
			{
				$this->session->set_flashdata('success', 'SEM status enabled successfully.');
				redirect('sem', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating SEM status. Try later!');
				redirect('sem', 'refresh');
			}
	  }
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('sem',$this->data);
	  	}
	}
	
	public function searchsem()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('sem/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('sem','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');	
		$this->data['sems'] = $this->sems->search_sem($keyword,$siteid);
		$this->load->view('sem',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
