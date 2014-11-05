<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Ad extends CI_Controller {
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
	 	$this->load->model('ads');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Google Ads';
		$this->data['section_title'] = 'Google Ads';
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
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			$siteid = $this->session->userdata('siteid');
			//Addingg Setting Result to variable
			$this->data['ads'] = $this->ads->get_all_ads($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['ads']);
			die();*/
			
			$this->paging['base_url'] = site_url("ad/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->ads->get_all_ads($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();

			//Loading View File
			$this->load->view('ad',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$siteid = $this->session->userdata('siteid');
			$allcats = $this->ads->get_all_categorys($siteid);
			
			if( count($allcats) > 0 )
				{
					$this->data['selcat'][''] = 'Select';
				
				for($m=0;$m<count($allcats);$m++)
				{
					$this->data['selcat'][stripslashes($allcats[$m]['id'])] = ucfirst($allcats[$m]['category']);
				
				}
		}
			else
			{
				$this->data['selcat'][''] = 'Select';
			}
			
			$this->load->view('ad',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('ad', 'refresh');
			}
				
			//Getting detail for displaying in form
			$this->data['ad'] = $this->ads->get_ad_byid($id);
			/*echo "<pre>";
			print_r($this->data['ad']);
			die();*/
			if( count($this->data['ad'])>0 )
			{			
				$siteid = $this->session->userdata('siteid');
				$allcats = $this->ads->get_all_categorys($siteid);
			
			if( count($allcats) > 0 )
				{
					$this->data['selcat'][''] = 'Select';
				
				for($m=0;$m<count($allcats);$m++)
				{
					$this->data['selcat'][stripslashes($allcats[$m]['id'])] = ucfirst($allcats[$m]['category']);
				
				}
		}
			else
			{
				$this->data['selcat'][''] = 'Select';
			}
				//Loading View File
				$this->load->view('ad',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('ad', 'refresh');
			}
	  }
	}
	
	public function view($id='')
	{
		if( $this->input->is_ajax_request() )
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('ad', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['ad'] = $this->ads->get_ad_byid($id);
			/*echo "<pre>";
			print_r($this->data['ad']);
			die();*/
			if( count($this->data['ad'])>0 )
			{			
				//Loading View File
				$this->load->view('ad',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('ad', 'refresh');
			}
	  	}
		}
		else
		{
			redirect('ad', 'refresh');
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
				$zone = addslashes($this->input->post('zone'));
				$page = addslashes($this->input->post('page'));
				$categoryid = addslashes($this->input->post('categoryid'));
				$url = addslashes($this->input->post('url'));
								
				if(count($_FILES)>0)
				{
					if(count($_FILES['image'])>0)
					{
						if( $_FILES['image']['name']!='' && $_FILES['image']['size'] > 0 )
						{
							//load library
							$this->load->library('upload');
			
							//Uploading Cover Image and creating Thumb
							$config['upload_path'] = $this->config->item('ad_main_upload_path');
							$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
							$config['max_size']	= $this->config->item('ad_max_size');
							$config['max_width']  = $this->config->item('ad_max_width');
							$config['max_height']  = $this->config->item('ad_max_height');
							$config['remove_spaces'] = TRUE;
							$a = explode('.',$_FILES['image']['name']);
							$ex = end($a);
							$main = str_replace('.'.$ex,'',$_FILES['image']['name']);
							$config['file_name'] = $main.date('YmdHis');
							
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
								$config['new_image'] = $this->config->item('ad_thumb_upload_path').$imgdata['file_name'];
								$config['create_thumb'] = TRUE;
								$config['maintain_ratio'] = FALSE;
								$config['thumb_marker'] = '';
								$config['width'] = $this->config->item('ad_thumb_width');
								$config['height'] = $this->config->item('ad_thumb_height');
								
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
								$media = $this->ads->get_ad_byid($id);
								if( count($media)>0 )
								{
									if( $media[0]['image']!='' )
									{
										//Deleting main file
										if( file_exists($this->config->item('ad_main_upload_path').$media[0]['image']) )
										{											
											unlink($this->config->item('ad_main_upload_path').$media[0]['image']);
										}
										//Deleting thumbnail
										if( file_exists($this->config->item('ad_thumb_upload_path').$media[0]['image']) )
										{											
											unlink($this->config->item('ad_thumb_upload_path').$media[0]['image']);
										}
									}
								}
							
								//Updating Record With Image
								if( $this->ads->update($id,$zone,$url,$imgdata['file_name'],$page,$categoryid ))
								{
									$this->session->set_flashdata('success', 'Ad updated successfully.');
									redirect('ad', 'refresh');;
								}
								else
								{
				
									$this->session->set_flashdata('error', 'There is error in updating coupon. Try later!');
									redirect('ad', 'refresh');
								}
							}
							else
							{
								//Error in upload
								$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
								
								redirect('ad','refresh');
							}
						}
						else
						{
							//Updating Record Without Image
							if( $this->ads->update_noimage($id,$zone,$url,$page,$categoryid) )
							{
								$this->session->set_flashdata('success', 'coupon updated successfully.');
								redirect('ad', 'refresh');
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in updating coupon. Try later!');
								redirect('coupon', 'refresh');
							}
						}
					}
				}
			}
			
			//If New Record Insert
			else
			{
				$zone = addslashes($this->input->post('zone'));
				$page = addslashes($this->input->post('page'));
				$categoryid = addslashes($this->input->post('categoryid'));
				$url = addslashes($this->input->post('url'));
				
				//load library
				$this->load->library('upload');

				//Uploading Cover Image and creating Thumb
				$config['upload_path'] = $this->config->item('ad_main_upload_path');
				$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
				$config['max_size']	= $this->config->item('ad_main_max_size');
				$config['max_width']  = $this->config->item('ad_main_max_width');
				$config['max_height']  = $this->config->item('ad_main_max_height');
				$config['remove_spaces'] = TRUE;
				$a = explode('.',$_FILES['image']['name']);
				$ex = end($a);
				$main = str_replace('.'.$ex,'',$_FILES['image']['name']);
				$config['file_name'] = $main.date('YmdHis');
				
				// Initialize the new config
				$this->upload->initialize($config);
				//Uploading Image
				$this->upload->do_upload('image');
				
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
					$config['new_image'] = $this->config->item('ad_thumb_upload_path').$imgdata['file_name'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = FALSE;
					$config['thumb_marker'] = '';
					$config['width'] = $this->config->item('ad_thumb_width');
					$config['height'] = $this->config->item('ad_thumb_height');
					
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
					$siteid = $this->session->userdata('siteid');
					//Inserting Record
					if( $this->ads->insert($zone,$url,$imgdata['file_name'],$siteid,$page,$categoryid ))
					{
						$this->session->set_flashdata('success', 'Ad inserted successfully.');
						redirect('ad', 'refresh');
					}
					else
					{
	
						$this->session->set_flashdata('error', 'There is error in inserting Ad. Try later!');
						redirect('ad', 'refresh');
					}
				}
				else
				{
					//Error in upload
					$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
					
					redirect('ad','refresh');
				}
			}	
		}
			else
				{
							redirect('adminlogin', 'refresh');
				}
			}

	//Function For Deleting Record
	public function delete($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('ad', 'refresh');
			}
			
			$ad = $this->ads->get_ad_byid($id);
			if(count($ad)>0) {
			//Deleting Record
			//Unlink Old Images
									if( $ad[0]['image']!='' )
									{
										//Deleting main file
										if( file_exists($this->config->item('ad_main_upload_path').$ad[0]['image']) )
										{											
											unlink($this->config->item('ad_main_upload_path').$ad[0]['image']);
										}
										//Deleting thumbnail
										if( file_exists($this->config->item('ad_thumb_upload_path').$ad[0]['image']) )
										{											
											unlink($this->config->item('ad_thumb_upload_path').$ad[0]['image']);
										}
									}
			if( $this->ads->delete_ad_byid($id) )
			{
				$this->session->set_flashdata('success', 'Ads deleted successfully.');
				redirect('ad', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting Ads. Try later!');
				redirect('ad', 'refresh');
			} 
		}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting Ads. Try later!');
				redirect('ad', 'refresh');
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
				redirect('ad', 'refresh');
			}
				
			
			$ad = $this->ads->get_ad_byid($id);
			if(count($ad)>0) {
			if( $this->ads->disable_ad_byid($id) )
			{
				$this->session->set_flashdata('success', 'Ads status disabled successfully.');
				redirect('ad', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Ads status. Try later!');
				redirect('ad', 'refresh');
			} }
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Ads status. Try later!');
				redirect('ad', 'refresh');
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
				redirect('ad', 'refresh');
			}
		
			$ad = $this->ads->get_ad_byid($id);
			if(count($ad)>0) {
			if( $this->ads->enable_ad_byid($id) )
			{
				$this->session->set_flashdata('success', 'Ads status enabled successfully.');
				redirect('ad', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Ads status. Try later!');
				redirect('ad', 'refresh');
			}}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Ads status. Try later!');
				redirect('ad', 'refresh');
			}
	  }
	}
	
	public function searchad()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('ad/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('ad','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');	
		$this->data['ads'] = $this->ads->search_ad($keyword,$siteid);
		$this->load->view('ad',$this->data);
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */