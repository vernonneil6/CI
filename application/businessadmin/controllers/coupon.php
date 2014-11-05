<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Coupon extends CI_Controller {
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
	  	$this->load->model('coupons');
				
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : CouponsDeals & Steals';
		$this->data['section_title'] = 'CouponsDeals & Steals';
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
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			$siteid = $this->session->userdata('siteid');
			//Addingg Setting Result to variable
			$this->data['coupons'] = $this->coupons->get_all_coupons($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['coupons']);
			die();*/
			
			$this->paging['base_url'] = site_url("coupon/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->coupons->get_all_coupons($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();

			//Loading View File
			$this->load->view('coupon',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
				$siteid = $this->session->userdata('siteid');
				
				$allcats = $this->coupons->get_all_categorys($siteid);
				
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
				$this->load->view('coupon',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('coupon', 'refresh');
			}
				$siteid = $this->session->userdata('siteid');
				
				$allcats = $this->coupons->get_all_categorys($siteid);
			
				
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
			$this->data['coupon'] = $this->coupons->get_coupon_byid($id);
			/*echo "<pre>";
			print_r($this->data['coupon']);
			die();*/
			if( count($this->data['coupon'])>0 )
			{			
				//Loading View File
				$this->load->view('coupon',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('coupon', 'refresh');
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
				redirect('coupon', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['coupon'] = $this->coupons->get_coupon_byid($id);
			/*echo "<pre>";
			print_r($this->data['coupon']);
			die();*/
			if( count($this->data['coupon'])>0 )
			{			
				//Loading View File
				$this->load->view('coupon',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('coupon', 'refresh');
			}
	  	}
		}
		else
		{
			redirect('coupon', 'refresh');
		}
	}
	
	//Updating the Record
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			
			 if( isset($_FILES['image']) && $_FILES['image']['size'] != 0 && trim($_FILES['image']['name']) != '' )
					{
							//load library
							$this->load->library('upload');
			
							//Uploading Cover Image and creating Thumb
							$config['upload_path'] = $this->config->item('coupon_main_upload_path');
			  		 		$config['allowed_types'] = 'jpg|jpeg|png|bmp';
							$config['max_size']	= $this->config->item('coupon_main_max_size');
							$config['max_width']  = $this->config->item('coupon_main_max_width');
							$config['max_height']  = $this->config->item('coupon_main_max_height');
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
								$myconfig['image_library'] = 'gd2';
								$myconfig['source_image'] = $config['upload_path'].$imgdata['file_name'];
								$myconfig['new_image'] = $this->config->item('coupon_thumb_upload_path').$imgdata['file_name'];
								$myconfig['create_thumb'] = TRUE;
								$myconfig['maintain_ratio'] = TRUE;
								$myconfig['thumb_marker'] = '';
								$myconfig['width'] = $this->config->item('coupon_thumb_width');
								$myconfig['height'] = $this->config->item('_thumb_height');
								
								$this->load->library('image_lib', $myconfig);
										
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
									 if($this->input->post('id'))
					{
									 	$media = $this->input->post('couponhiddenimage');
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
									$couponimage=$imgdata['file_name'];
								}
						 		else
						 		{
									 $this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type (bmp/jpg/png)'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
									redirect('coupon', 'refresh');
								 }
				}
					else
					{
						if($this->input->post('id'))
						{	
							$couponimage=$this->input->post('couponhiddenimage');
						}
						else
						{
							$couponimage="";
						}
				}
		
		if($this->input->post('id'))
		{		
				$id=$this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$title = addslashes($this->input->post('title'));
				$couponcode = addslashes($this->input->post('couponcode'));
				
				$enddate = $this->input->post('enddate');
				$categoryid = addslashes($this->input->post('categoryid'));
				$url = addslashes($this->input->post('url'));
				if($this->coupons->update($id,$title,$enddate,$couponimage,$categoryid,$couponcode,$url))
				{
					$this->session->set_flashdata('success','coupon updated successfull!');
					redirect('coupon','refresh');	
				}
				else
				{
				$this->session->set_flashdata('error','coupon updated failed.Try later!'); 
					redirect('coupon','refresh');	
				}
			}
		
		else
		{
			 	
				$title = addslashes($this->input->post('title'));
				$couponcode = addslashes($this->input->post('couponcode'));
				$enddate = $this->input->post('enddate');
				$categoryid = addslashes($this->input->post('categoryid'));
				$url = addslashes($this->input->post('url'));
				if($this->coupons->insert($title,$enddate,$couponimage,$categoryid,$couponcode,$url))
				{
					$this->session->set_flashdata('success','coupon inserted successfull!');
					redirect('coupon','refresh');
				}
				else
				{
				$this->session->set_flashdata('error','coupon insert faild.Try later!');
					redirect('coupon','refresh');	
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
				redirect('coupon', 'refresh');
			}
			
			//Unlink Old Images
			$media = $this->coupons->get_coupon_byid($id);
			if( count($media)>0 )
			{
				if( $media[0]['image']!='' )
				{
					//Deleting main file
					if( file_exists($this->config->item('coupon_main_upload_path').$media[0]['image']) )
					{											
						unlink($this->config->item('coupon_main_upload_path').$media[0]['image']);
					}
					//Deleting thumbnail
					if( file_exists($this->config->item('coupon_thumb_upload_path').$media[0]['image']) )
					{											
						unlink($this->config->item('coupon_thumb_upload_path').$media[0]['image']);
					}
				}
			}
			
			//Deleting Record
			if( $this->coupons->delete_coupon_byid($id) )
			{
				$this->session->set_flashdata('success', 'coupon deleted successfully.');
				redirect('coupon', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting coupon. Try later!');
				redirect('coupon', 'refresh');
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
				redirect('coupon', 'refresh');
			}
					
			$coupon = $this->coupons->get_coupon_byid($id);
			if(count($coupon)>0) {
			if( $this->coupons->disable_coupon_byid($id) )
			{
				$this->session->set_flashdata('success', 'Coupon status disabled successfully.');
				redirect('coupon', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Coupon status. Try later!');
				redirect('coupon', 'refresh');
			} }
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Coupon status. Try later!');
				redirect('coupon', 'refresh');
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
				redirect('coupon', 'refresh');
			}
			
			$coupon = $this->coupons->get_coupon_byid($id);
			if(count($coupon)>0) {
			if( $this->coupons->enable_coupon_byid($id) )
			{
				$this->session->set_flashdata('success', 'Coupon status enabled successfully.');
				redirect('coupon', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Coupon status. Try later!');
				redirect('coupon', 'refresh');
			}}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Coupon status. Try later!');
				redirect('coupon', 'refresh');
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
			$this->data['coupons'] = $this->coupons->search_coupon($keysearch,$limit,$offset);
			$uri=	$keysearch;
			//echo $uri;
			$uri= base64_encode($uri);
			$this->paging['base_url'] = site_url("coupon/searchresult/".$uri);
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = count($this->coupons->search_coupon($keysearch));
			$this->pagination->initialize($this->paging);
			
			$this->load->view('coupon',$this->data);
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
				$result = $this->coupons->chkfield($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('coupon', 'refresh');
		}
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */