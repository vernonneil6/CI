<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Reviewpromo extends CI_Controller {
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
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		//Loading Model File
	  	$this->load->model('reviewpromos');
				
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : reviewpromos';
		$this->data['section_title'] = 'reviewpromos';
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
	
	public function index($sortby,$orderby='asc')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			$siteid = $this->session->userdata('siteid');
			//Addingg Setting Result to variable
			$this->data['reviewpromos'] = $this->reviewpromos->get_all_reviewpromos($siteid,$limit,$offset,$sortby,$orderby);
			/*echo "<pre>";
			print_r($this->data['reviewpromos']);
			die();*/
			
			$this->paging['base_url'] = site_url("reviewpromo/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->reviewpromos->get_all_reviewpromos($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();

			//Loading View File
			$this->load->view('reviewpromo',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
				$siteid = $this->session->userdata('siteid');
				
				$allcats = $this->reviewpromos->get_all_categorys($siteid);
				
				if( count($allcats) > 0 )
				{
					$this->data['selcat'][''] = '--Select--';
				
				for($m=0;$m<count($allcats);$m++)
				{
					$this->data['selcat'][stripslashes($allcats[$m]['id'])] = ucfirst($allcats[$m]['category']);
				
				}
		}
			else
			{
				$this->data['selcat'][''] = '--Select--';
			}
				//Loading View File
				$this->load->view('reviewpromo',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('reviewpromo', 'refresh');
			}
				$siteid = $this->session->userdata('siteid');
				
				$allcats = $this->reviewpromos->get_all_categorys($siteid);
			
				
			if( count($allcats) > 0 )
				{
					$this->data['selcat'][''] = '--Select--';
				
				for($m=0;$m<count($allcats);$m++)
				{
					$this->data['selcat'][stripslashes($allcats[$m]['id'])] = ucfirst($allcats[$m]['category']);
				
				}
		}
			else
			{
				$this->data['selcat'][''] = '--Select--';
			}
			//Getting detail for displaying in form
			$this->data['reviewpromo'] = $this->reviewpromos->get_reviewpromo_byid($id);
			/*echo "<pre>";
			print_r($this->data['reviewpromo']);
			die();*/
			if( count($this->data['reviewpromo'])>0 )
			{			
				//Loading View File
				$this->load->view('reviewpromo',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('reviewpromo', 'refresh');
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
				redirect('reviewpromo', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['reviewpromo'] = $this->reviewpromos->get_reviewpromo_byid($id);
			/*echo "<pre>";
			print_r($this->data['reviewpromo']);
			die();*/
			if( count($this->data['reviewpromo'])>0 )
			{			
				//Loading View File
				$this->load->view('reviewpromo',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('reviewpromo', 'refresh');
			}
	  	}
		}
		else
		{
			redirect('reviewpromo', 'refresh');
		}
	}
	
	//Updating the Record
	public function update()
	{
		/*echo '<pre>';print_r($_POST);
		echo print_r($_FILES['image']);
		die('234');*/
		if( $this->session->userdata['youg_admin'] )
	  	{
		  									
			if( isset($_FILES['image']) && $_FILES['image']['size'] != 0 && trim($_FILES['image']['name']) != '' )
					{
							//load library
							$this->load->library('upload');
			
							//Uploading Cover Image and creating Thumb
							$config['upload_path'] = $this->config->item('coupon_main_upload_path');
			  		 		$config['allowed_types'] = 'jpeg|bmp|gif|jpg|png|pdf';
							$config['max_size']	= '2048000';
							$config['max_width']  = '1024000';
							$config['max_height']  = '768000';
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
							
							/*if( $imgerror == '' )
							{
								//Configuring Thumbnail 
								$myconfig['image_library'] = 'gd2';
								$myconfig['source_image'] = $config['upload_path'].$imgdata['file_name'];
								$myconfig['new_image'] = $this->config->item('coupon_thumb_upload_path').$imgdata['file_name'];
								$myconfig['create_thumb'] = TRUE;
								$myconfig['maintain_ratio'] = TRUE;
								$myconfig['thumb_marker'] = '';
								$myconfig['width'] = '48';
								$myconfig['height'] = '48';
								
								$this->load->library('image_lib', $myconfig);
										
								//Creating Thumbnail
								$this->image_lib->resize();
								$thumberror = $this->image_lib->display_errors();
							}
							else
							{
								$thumberror= '';
							}*/
								
							if( $imgerror != '')
							{
								$error[0] = $imgerror;
								//$error[1] = $thumberror;
							}
							else
							{
								$error = array();
							}
							    if( count($error)==0 && count($imgdata) > 0 )
								 {
									 if($this->input->post('id'))
					{
									 	$media = $this->input->post('reviewpromohiddenimage');
										 if( $media!='' )
										 {
										//Deleting main file
										if( file_exists($this->config->item('coupon_main_upload_path').$media) )
												{											
													unlink($this->config->item('coupon_main_upload_path').$media);
												}
												//Deleting thumbnail
												if( file_exists($this->config->item('coupon_thumb_upload_path').$media) )
												{											
													unlink($this->config->item('coupon_thumb_upload_path').$media);
												}
											}
					}
									$reviewpromoimage=$imgdata['file_name'];
								}
						 		else
						 		{
									 $this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type (bmp/jpg/png)'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
									redirect('reviewpromo', 'refresh');
								 }
				}
				else
				{
						if($this->input->post('id'))
						{	
							$reviewpromoimage=$this->input->post('reviewpromohiddenimage');
						}
						else
						{
							$reviewpromoimage="";
						}
				}
		
		if($this->input->post('id'))
		{		
				$id=$this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$title = addslashes($this->input->post('title'));
				$reviewpromocode = addslashes($this->input->post('reviewpromocode'));
				
				$datecreated = $this->input->post('datecreated');
				$status = addslashes($this->input->post('status'));
				$summary = addslashes($this->input->post('summary'));
				if($this->reviewpromos->update($id,$title,$datecreated,$reviewpromoimage,$status,$reviewpromocode,$summary))
				{
					$this->session->set_flashdata('success','reviewpromo updated successfull!');
					redirect('reviewpromo','refresh');	
				}
				else
				{
				$this->session->set_flashdata('error','reviewpromo updated failed.Try later!'); 
					redirect('reviewpromo','refresh');	
				}
			}
		
		else
		{
			 	
				$title = addslashes($this->input->post('title'));
				$reviewpromocode = addslashes($this->input->post('reviewpromocode'));
				$datecreated = $this->input->post('datecreated');
				$status = addslashes($this->input->post('status'));
				$summary = addslashes($this->input->post('summary'));
				if($this->reviewpromos->insert($title,$datecreated,$reviewpromoimage,$status,$reviewpromocode,$summary))
				{
					$this->session->set_flashdata('success','reviewpromo inserted successfull!');
					redirect('reviewpromo','refresh');
				}
				else
				{
				$this->session->set_flashdata('error','reviewpromo insert faild.Try later!');
					redirect('reviewpromo','refresh');	
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
				redirect('reviewpromo', 'refresh');
			}
			
			//Unlink Old Images
			$media = $this->reviewpromos->get_reviewpromo_byid($id);
			if( count($media)>0 )
			{
				if( $media[0]['image']!='' )
				{
					//Deleting main file
					if( file_exists($this->config->item('reviewpromo_main_upload_path').$media[0]['image']) )
					{											
						unlink($this->config->item('reviewpromo_main_upload_path').$media[0]['image']);
					}
					//Deleting thumbnail
					if( file_exists($this->config->item('reviewpromo_thumb_upload_path').$media[0]['image']) )
					{											
						unlink($this->config->item('reviewpromo_thumb_upload_path').$media[0]['image']);
					}
				}
			}
			
			//Deleting Record
			if( $this->reviewpromos->delete_reviewpromo_byid($id) )
			{
				$this->session->set_flashdata('success', 'reviewpromo deleted successfully.');
				redirect('reviewpromo', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting reviewpromo. Try later!');
				redirect('reviewpromo', 'refresh');
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
				redirect('reviewpromo', 'refresh');
			}
					
			$reviewpromo = $this->reviewpromos->get_reviewpromo_byid($id);
			if(count($reviewpromo)>0) {
			if( $this->reviewpromos->disable_reviewpromo_byid($id) )
			{
				$this->session->set_flashdata('success', 'reviewpromo status disabled successfully.');
				redirect('reviewpromo', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating reviewpromo status. Try later!');
				redirect('reviewpromo', 'refresh');
			} }
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating reviewpromo status. Try later!');
				redirect('reviewpromo', 'refresh');
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
				redirect('reviewpromo', 'refresh');
			}
			
			$reviewpromo = $this->reviewpromos->get_reviewpromo_byid($id);
			if(count($reviewpromo)>0) {
			if( $this->reviewpromos->enable_reviewpromo_byid($id) )
			{
				$this->session->set_flashdata('success', 'reviewpromo status enabled successfully.');
				redirect('reviewpromo', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating reviewpromo status. Try later!');
				redirect('reviewpromo', 'refresh');
			}}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating reviewpromo status. Try later!');
				redirect('reviewpromo', 'refresh');
			}
	  }
	}
	
	public function searchresult()
	{
		if( $this->session->userdata['youg_admin'] )
 		{
			if(!$this->uri->segment(3))
			{
				$keysearch=trim($this->input->post('keysearch'));
			}
			else
			{
				$searchuri = $this->uri->segment(3);
				$uri= base64_decode($searchuri);
				($keysearch=$uri);
			}
			
			$this->data['keysearch']=$keysearch;
						
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			
			//Addingg Setting Result to variable
			$this->data['reviewpromos'] = $this->reviewpromos->search_reviewpromo($keysearch,$limit,$offset);
			$uri=	$keysearch;
			//echo $uri;
			$uri= base64_encode($uri);
			$this->paging['base_url'] = site_url("reviewpromo/searchresult/".$uri);
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = count($this->reviewpromos->search_reviewpromo($keysearch));
			$this->pagination->initialize($this->paging);
			
			$this->load->view('reviewpromo',$this->data);
			//echo json_encode( array('result' => $this->data['search_results'] ) );
			//die();
			}
			else
			{
				redirect('adminlogin','refresh');
			}
	}
	
	public function fieldcheck()
	{
		if($this->session->userdata['youg_admin'] && $this->input->is_ajax_request() && ( $this->input->post('promocode') ) )
	  {
			if( $this->input->post('id') )
			{
				$id = $this->input->post('id');
			}
			else
			{
				$id = 0;
			}
			if( $this->input->post('promocode') )
			{
				$field = 'promocode';
				$fieldvalue = addslashes($this->input->post('promocode'));
			}
			
			if($field)
			{
				///Addingg Result to view parameter
				$result = $this->reviewpromos->chkfield($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('reviewpromo', 'refresh');
		}
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
