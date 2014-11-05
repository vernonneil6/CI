<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Setting extends CI_Controller {

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
			
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : General Setting';
		$this->data['section_title'] = 'Settings';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
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
		if( $this->session->userdata['youg_admin'] )
	  	{
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['settings'] = $this->settings->get_all_setting($siteid);
			
			
			//Loading View File
			$this->load->view('setting',$this->data);
	  	}
	}
	
	public function edit($intid='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$intid)
			{
				redirect('setting', 'refresh');
			}
			$siteid = $this->session->userdata('siteid');
			//Setting updated variable to display appropriate message
			$this->data['settings'] = $this->settings->get_setting_byid($intid,$siteid);
			/*echo "<pre>";
			print_r($this->data['settings']);
			die();*/
			if( count($this->data['settings'])>0 )
			{			
				//Loading View File
				$this->load->view('setting',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('setting', 'refresh');
			}
	  }
	}
	
	//Updating the record
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if( $this->input->post('txtintid') )
	  		{
				//Getting intid
				$intid = $this->encrypt->decode($this->input->post('txtintid'));
				$a = $this->encrypt->decode($this->input->post('intid'));
								
				if($a!=17)
				{
					
				//Getting value
				$txtvalue = addslashes($this->input->post('txtvalue'));
				
				//updating site general setting
				if( $this->settings->update($intid,$txtvalue) )
				{
					$this->session->set_flashdata('success', $this->settings->get_setting_fieldname($a).' updated successfully.');
					redirect('setting', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating '.$this->settings->get_setting_fieldname($a).'. Try later!');
					redirect('setting', 'refresh');
				}
			 }
			 else
				{
					if(count($_FILES)>0)
					{
						if(count($_FILES['txtvalue'])>0)
						{
							if( $_FILES['txtvalue']['name']!='' && $_FILES['txtvalue']['size'] > 0 )
							{
								//load library
								$this->load->library('upload');
				
								//Uploading Cover Image and creating Thumb
								$config['upload_path'] = $this->config->item('verifiedlogo_main_upload_path');
								$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
								$config['max_size']	= $this->config->item('verifiedlogo_main_max_size');
								$config['max_width']  = $this->config->item('verifiedlogo_main_max_width');
								$config['max_height']  = $this->config->item('verifiedlogo_main_max_height');
								$config['remove_spaces'] = TRUE;
								$a = explode('.',$_FILES['txtvalue']['name']);
								$ex = end($a);
								$main = str_replace('.'.$ex,'',$_FILES['txtvalue']['name']);
								$config['file_name'] = $main.date('YmdHis');
								
								// Initialize the new config
								$this->upload->initialize($config);
								//Uploading Image
								$this->upload->do_upload('txtvalue');
								
								//Getting Uploaded Image File Data
								$imgdata = $this->upload->data();
								$imgerror = $this->upload->display_errors();
								if( $imgerror == '' )
								{
								
									//Configuring Thumbnail 
									$config['image_library'] = 'gd2';
									$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
									$config['new_image'] = $this->config->item('verifiedlogo_thumb_upload_path').$imgdata['file_name'];
									$config['create_thumb'] = TRUE;
									$config['maintain_ratio'] = FALSE;
									$config['thumb_marker'] = '';
									$config['width'] = $this->config->item('verifiedlogo_thumb_width');
									$config['height'] = $this->config->item('verifiedlogo_thumb_height');
									
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
								
								if( count($error)==0 && count($imgdata) > 0 )
								{
									//Unlink Old Images
									$media = $this->settings->get_setting_value($intid);
									if( count($media)>0 )
									{
										if( $media!='' )
										{
											//Deleting main file
											if( file_exists($this->config->item('verifiedlogo_main_upload_path').$media ) )
											{											
												unlink($this->config->item('verifiedlogo_main_upload_path').$media );
											}
											//Deleting thumbnail
											if( file_exists($this->config->item('verifiedlogo_thumb_upload_path').$media ) )
											{											
												unlink($this->config->item('verifiedlogo_thumb_upload_path').$media );
											}
										}
									}
								
									//Updating Record With Image
								if( $this->settings->update($intid,$imgdata['file_name']) )
									{
										$this->session->set_flashdata('success', 'Verified Logo updated successfully.');
										redirect('setting', 'refresh');;
									}
									else
									{
					
										$this->session->set_flashdata('error', 'There is error in updating Verified Logo. Try later!');
										redirect('setting', 'refresh');
									}
								}
								else
								{
									//Error in upload
									$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
									
									redirect('setting','refresh');
								}
							}
							else
							{
							redirect('setting','refresh');
							}
						}
					}
					else
					{
						redirect('setting', 'refresh');	
					}
				}
			}
			else
			{
				redirect('setting', 'refresh');
			}
		}
	}
	
	public function searchsetting()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('setting/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('setting','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');	
		$this->data['settings'] = $this->settings->search_setting($keyword,$siteid);
		$this->load->view('setting',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */