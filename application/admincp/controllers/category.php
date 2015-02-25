<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Category extends CI_Controller {

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
	* @see http://codeigniter.com/category_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
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
	  	$this->load->model('categorys');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		if(  $this->uri->segment(2) && ( $this->uri->segment(2)=='searchresult' || $this->uri->segment(2)=='search' ))
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Search Business Categories';
			$this->data['section_title'] = 'Search';
		}
		else
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Business Categories';
			$this->data['section_title'] = 'Business Categories';
		}
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
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			$siteid = $this->session->userdata('siteid');
			//Addingg Setting Result to variable
			$this->data['categorys'] = $this->categorys->get_all_categorys($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['categorys']);
			die();*/
			
			$this->paging['base_url'] = site_url("category/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->categorys->get_all_categorys($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('category',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('category',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('category', 'refresh');
			}
						
			//Getting detail for displaying in form
			$this->data['category'] = $this->categorys->get_category_byid($id);

			if( count($this->data['category'])>0 )
			{
				//Loading View File
				$this->load->view('category',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('category', 'refresh');
			}
	  }
	}
	
	//Updating the Record
	public function update()
	{
		//echo '<pre>';print_r($_REQUEST['detail']); die();
		if( $this->session->userdata['youg_admin'] )
	  	{
			if($_FILES['image']['name']!='')
				{
					if(count($_FILES['image'])>0)
					{
						if( $_FILES['image']['name']!='' && $_FILES['image']['size'] > 0 )
						{
							//load library
							$this->load->library('upload');
			
							//Uploading Cover Image and creating Thumb
							$config['upload_path'] = $this->config->item('buscat_main_upload_path');
							$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
							$config['max_size']	= $this->config->item('buscat_main_max_size');
							$config['max_width']  = $this->config->item('buscat_main_max_width');
							$config['max_height']  = $this->config->item('buscat_main_max_height');
							$config['remove_spaces'] = TRUE;
							$a = explode('.',$_FILES['image']['name']);
							$ex = end($a);
							$main = str_replace('.'.$ex,'',$_FILES['image']['name']);

							$config['file_name'] = $main.date("YmdHis");							
							// Initialize the new config
							$this->upload->initialize($config);
							//Uploading Image
							$this->upload->do_upload('image');
							
							//Getting Uploaded Image File Data
							$imgdata = $this->upload->data();
							$imgerror = $this->upload->display_errors();
							
							if( $imgerror == '' )
							{
								//Configuring Thumbnail 
								$config['image_library'] = 'gd2';
								$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
								$config['new_image'] = $this->config->item('buscat_thumb_upload_path').$imgdata['file_name'];
								$config['create_thumb'] = TRUE;
								$config['maintain_ratio'] = FALSE;
								$config['thumb_marker'] = '';
								$config['width'] = $this->config->item('buscat_thumb_width');
								$config['height'] = $this->config->item('buscat_thumb_height');
								
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
								if( $this->input->post('id') ) {
								$media = $this->input->post('hiddenimage');
							
								if( $media!='' )
								{
										//Deleting main file
							if( file_exists($this->config->item('buscat_main_upload_path').$media) )
								{											
									unlink($this->config->item('buscat_main_upload_path').$media);
								}
								//Deleting thumbnail
							if( file_exists($this->config->item('buscat_thumb_upload_path').$media) )
								{											
									unlink($this->config->item('buscat_thumb_upload_path').$media);
								}
									}
									
									$image = $imgdata['file_name'];
								}
								else
								{
									$image = $imgdata['file_name'];
									//die();
								}
							}
							else
							{
							//Error in upload
							$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
								
							redirect('category','refresh');
							}
								
							}
						else
						{
							//Error in upload
							$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
								
							redirect('category','refresh');
						}
					
					}
				}
				else
				{
					if( $this->input->post('id') )
					{
						$image = $this->input->post('hiddenimage');
					}
					else
					{
						$image = '';
					}
				}
			
			//If Old Record Update
			if( $this->input->post('id') )
	  		{
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$category = addslashes($this->input->post('category'));
						
				//Updating Record With Image
				if( $this->categorys->update($id,$category,$image))
				{
					$this->session->set_flashdata('success', 'business category updated successfully.');
					redirect('category', 'refresh');;
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating business category. Try later!');
					redirect('category', 'refresh');
				}
			}
			
			//If New Record Insert
			else
			{
				//Getting value
				$category = addslashes($this->input->post('category'));
				$siteid = $this->session->userdata('siteid');
				//Inserting Record
					if( $this->categorys->insert($category,$siteid,$image) )
					{
						$this->session->set_flashdata('success', 'business category inserted successfully.');
						redirect('category', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in inserting business category. Try later!');
						redirect('category', 'refresh');
					}
			}
		}
	}
	
	//Function For Deleting Record
	public function delete($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('category', 'refresh');
			}
			
			if($id==1)
			{
				redirect('category', 'refresh');
			}
			
			//Deleting Record
			if( $this->categorys->delete_category_byid($id) )
			{
				$this->session->set_flashdata('success', 'business category deleted successfully.');
				redirect('category', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting business category. Try later!');
				redirect('category', 'refresh');
			}
	  	}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('category', 'refresh');
			}
			
			if($id==1)
			{
				redirect('category', 'refresh');
			}
					
			if( $this->categorys->disable_category_byid($id) )
			{
				$this->session->set_flashdata('success', 'business category status disabled successfully.');
				redirect('category', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating business category status. Try later!');
				redirect('category', 'refresh');
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
				redirect('category', 'refresh');
			}
			
			if($id==1)
			{
				redirect('category', 'refresh');
			}
			
			if( $this->categorys->enable_category_byid($id) )
			{
				$this->session->set_flashdata('success', 'business category status enabled successfully.');
				redirect('category', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating business category status. Try later!');
				redirect('category', 'refresh');
			}
	  }
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('category',$this->data);
	  	}
	}
	
	public function searchcategory()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('category/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('category','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			
		//Addingg Setting Result to variable
		$siteid = $this->session->userdata('siteid');
		$this->data['categorys'] = $this->categorys->search_category($keyword,$siteid,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['categorys']);
		//die();
			
		$this->paging['base_url'] = site_url("category/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->categorys->search_category($keyword,$siteid));
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		$this->load->view('category',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
