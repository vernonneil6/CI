<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

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
	* @see http://codeigniter.com/gallery_guide/general/urls.html
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
	  	$this->load->model('gallerys');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Business Gallerys';
		$this->data['section_title'] = 'Business Galleries';
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
			$companyid = $this->session->userdata['youg_admin']['id'];
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['gallerys'] = $this->gallerys->get_all_gallerys($companyid,$siteid);
			/*echo "<pre>";
			print_r($this->data['gallerys']);
			die();*/
			
			//Loading View File
			$this->load->view('gallery',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('gallery',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('gallery', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['gallery'] = $this->gallerys->get_gallery_byid($id);

			if( count($this->data['gallery'])>0 )
			{
				//Loading View File
				$this->load->view('gallery',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('gallery', 'refresh');
			}
	  }
	}
	
	public function image_resize($source_image_path, $thumbnail_image_path){
		define('THUMBNAIL_IMAGE_MAX_WIDTH', 520);
		define('THUMBNAIL_IMAGE_MAX_HEIGHT', 520);		
		list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);
		switch ($source_image_type) {
			case IMAGETYPE_GIF:
				$source_gd_image = imagecreatefromgif($source_image_path);
				break;
			case IMAGETYPE_JPEG:
				$source_gd_image = imagecreatefromjpeg($source_image_path);
				break;
			case IMAGETYPE_PNG:
				$source_gd_image = imagecreatefrompng($source_image_path);
				break;
		}
		if ($source_gd_image === false) {
			return false;
		}
		$source_aspect_ratio = $source_image_width / $source_image_height;
		$thumbnail_aspect_ratio = THUMBNAIL_IMAGE_MAX_WIDTH / THUMBNAIL_IMAGE_MAX_HEIGHT;
		 if ($source_image_width <= THUMBNAIL_IMAGE_MAX_WIDTH && $source_image_height <= THUMBNAIL_IMAGE_MAX_HEIGHT) {
			$thumbnail_image_width = $source_image_width;
			$thumbnail_image_height = $source_image_height;
		} elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
			$thumbnail_image_width = (int) (THUMBNAIL_IMAGE_MAX_HEIGHT * $source_aspect_ratio);
			$thumbnail_image_height = THUMBNAIL_IMAGE_MAX_HEIGHT;
		} else {
			$thumbnail_image_width = THUMBNAIL_IMAGE_MAX_WIDTH;
			$thumbnail_image_height = (int) (THUMBNAIL_IMAGE_MAX_WIDTH / $source_aspect_ratio);
		} 
		$thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);
		imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
		$img_disp = imagecreatetruecolor(THUMBNAIL_IMAGE_MAX_WIDTH,THUMBNAIL_IMAGE_MAX_WIDTH);		
		$backcolor =imagecolorallocate($img_disp,255,255,255);      
		imagefill($img_disp,0,0,$backcolor);
		imagecopy($img_disp, $thumbnail_gd_image, (imagesx($img_disp)/2)-(imagesx($thumbnail_gd_image)/2), (imagesy($img_disp)/2)-(imagesy($thumbnail_gd_image)/2), 0, 0, imagesx($thumbnail_gd_image), imagesy($thumbnail_gd_image));
		imagejpeg($img_disp, $thumbnail_image_path, 90);
		imagedestroy($source_gd_image);
		imagedestroy($thumbnail_gd_image);
		imagedestroy($img_disp);
		return true;		
	}
	
	//Updating the Record
	public function update()
	{
		//echo '<pre>';print_r($_REQUEST['detail']); die();
		if( $this->session->userdata['youg_admin'] )
	  	{
			if($this->input->post('btnupload') || count($_FILES)>0)
			{
					if(count($_FILES)>0)
					{
						
						//Getting id
						$id = $this->encrypt->decode($this->input->post('galleryid'));
						//load library
						$this->load->library('upload');
	
						//Uploading Cover Image and creating Thumb
						$config['upload_path'] = $this->config->item('gallery_main_upload_path');
						$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
						$config['max_size']	= $this->config->item('gallery_main_max_size');
						//$config['max_width']  = $this->config->item('gallery_main_max_width');
						//$config['max_height']  = $this->config->item('gallery_main_max_height');
						$config['remove_spaces'] = TRUE;
						$config['encrypt_name'] = TRUE;
						
						// Initialize the new config
						$this->upload->initialize($config);
						$files = $_FILES;
						$cpt = count($_FILES['userfile']['name']);
						for($i=0; $i<$cpt; $i++)
						{
								$_FILES['userfile']['name']= $files['userfile']['name'][$i];
								$_FILES['userfile']['type']= $files['userfile']['type'][$i];
								$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
								$_FILES['userfile']['error']= $files['userfile']['error'][$i];
								$_FILES['userfile']['size']= $files['userfile']['size'][$i];    
			
								$this->upload->do_upload();
								
								//Getting Uploaded Image File Data
								$imgdata = $this->upload->data();
								$imgerror = $this->upload->display_errors();
								//echo"<pre>";
								//print_r($imgdata);
								//print_r($imgerror);
								//die();
								
								if( count($imgdata) > 0  && $imgerror =='')
								{
									//Inserting Record
									if( $this->gallerys->insertphoto($id,$imgdata['file_name']) )
									{										
										$this->image_resize($imgdata['full_path'],$imgdata['full_path']);									
										$this->session->set_flashdata('success', 'photo inserted successfully.');
									//	redirect('gallery', 'refresh');
									}
									else
									{					
										$this->session->set_flashdata('error', 'There is error in inserting photo. Try later!');
									//	redirect('gallery', 'refresh');
									}
								}
								else
								{
									//Error in upload
									$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'");
									redirect('gallery','refresh');
								}
								
						}
						
						$this->session->set_flashdata('success', ' Photos Added successfully.');
						redirect('gallery', 'refresh');
						
					}
			}
			//If Old Record Update
			else if( $this->input->post('id') || $this->input->post('editgallery')=='editgallery' )
	  		{
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$companyid = $this->session->userdata['youg_admin']['id'];
				$title = addslashes($this->input->post('title'));
				//Loading Model File
				$this->load->model('gallerys');

							
				//Updating Record With Image
				if( $this->gallerys->update($id,$title))
				{
					$this->session->set_flashdata('success', ' gallery updated successfully.');
					redirect('gallery', 'refresh');
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating  gallery. Try later!');
					redirect('gallery', 'refresh');
				}
			}
			
			//If New Record Insert
			else
			{
				if( $this->input->post('btnsubmit') || $this->input->post('addgallery') == 'addgallery' )
				{
				
				//Getting value
				$siteid = $this->session->userdata('siteid');
				$companyid = $this->session->userdata['youg_admin']['id'];
				$title = addslashes($this->input->post('title'));
						
				//Loading Model File
				$this->load->model('gallerys');

					//Inserting Record
					if( $this->gallerys->insert($companyid,$title,$siteid) )
					{
						$this->session->set_flashdata('success', ' gallery inserted successfully.');
						redirect('gallery', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in inserting  gallery. Try later!');
						redirect('gallery', 'refresh');
					}
			}
				else
				{
					redirect('gallery', 'refresh');
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
				redirect('gallery', 'refresh');
			}
			
			//Deleting Record
			if( $this->gallerys->delete_gallery_byid($id) )
			{
				$this->session->set_flashdata('success', ' gallery deleted successfully.');
				redirect('gallery', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting  gallery. Try later!');
				redirect('gallery', 'refresh');
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
				redirect('gallery', 'refresh');
			}
				
			if( $this->gallerys->disable_gallery_byid($id) )
			{
				$this->session->set_flashdata('success', ' gallery status disabled successfully.');
				redirect('gallery', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating  gallery status. Try later!');
				redirect('gallery', 'refresh');
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
				redirect('gallery', 'refresh');
			}
			
			if( $this->gallerys->enable_gallery_byid($id) )
			{
				$this->session->set_flashdata('success', ' gallery status enabled successfully.');
				redirect('gallery', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating  gallery status. Try later!');
				redirect('gallery', 'refresh');
			}
	  }
	}
	public function addphotos($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('gallery', 'refresh');
			}
			
			//Loading Helper File
	  		$this->load->helper('form');
			
			//Loading Model File
	  		 $this->load->model('gallerys');
			
			//Getting detail for displaying in form
			$this->data['gallery'] = $this->gallerys->get_gallery_byid($id);

			if( count($this->data['gallery'])>0 )
			{
				//Loading View File
				$this->load->view('gallery',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('gallery', 'refresh');
			}
	  }
	}
	
	public function viewphotos($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('gallery', 'refresh');
			}
			
			//Getting detail for displaying in form
			
			$this->data['photo'] = $this->gallerys->get_photo_bygalleryid($id);
			$gallery= $this->gallerys->get_gallery_byid($id);
			if(count($gallery)>0){
				$this->data['section_title'] = ucfirst($gallery[0]['title']);
			}
			else
			{
				$this->data['section_title']='';
			}

			if( count($this->data['photo'])>0 )
			{
				//Loading View File
				$this->load->view('gallery',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('gallery', 'refresh');
			}
	  }
	}
	
	public function deletephoto($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('gallery', 'refresh');
			}
			
			//Getting detail for displaying in form
			$media = $this->gallerys->get_photo_byid($id);

			if( count($media)>0 )
									{
										if( $media[0]['photo']!='' )
										{
											//Deleting main file
											if( file_exists($this->config->item('gallery_main_upload_path').$media[0]['photo']) )
											{											
												unlink($this->config->item('gallery_main_upload_path').$media[0]['photo']);
											}
											
										}
									}
			
			//Deleting Record
			if( $this->gallerys->delete_photo_byid($id) )
			{
				$this->session->set_flashdata('success', ' photo deleted successfully.');
				redirect('gallery', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting  photo. Try later!');
				redirect('gallery', 'refresh');
			}
	  }
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
