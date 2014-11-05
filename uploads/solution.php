<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Solution extends CI_Controller {

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
	* @see http://codeigniter.com/solution_guide/general/urls.html
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
	  	$this->load->model('solutions');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		if(  $this->uri->segment(2) && ( $this->uri->segment(2)=='searchresult' || $this->uri->segment(2)=='search' ))
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Search Business Solutions';
			$this->data['section_title'] = 'Search';
		}
		else
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Business Solutions';
			$this->data['section_title'] = 'Business Solutions';
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
			$siteid = $this->session->userdata('siteid');
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			
			//Addingg Setting Result to variable
			$this->data['solutions'] = $this->solutions->get_all_solutions($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['solutions']);
			die();*/
			
			$this->paging['base_url'] = site_url("solution/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->solutions->get_all_solutions($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('solution',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			$this->load->helper('ckeditor');
			$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id'	=>	'detail',
			'path'  =>  '../../ckeditor',
			//Optionnal values
			'config' => array(
								'toolbar'	=>	"Full",     //Using the Full toolbar
								'width'   =>  "auto",    //a custom width
								'height'  =>  "300px",    //a custom height
							),
					);

			//Loading View File
			$this->load->view('solution',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('solution', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['solution'] = $this->solutions->get_solution_byid($id);

			if( count($this->data['solution'])>0 )
			{
				$this->load->helper('ckeditor');
				$this->data['ckeditor'] = array(
				//ID of the textarea that will be replaced
            	'id'	=>	'detail',
            	'path'  =>  '../../ckeditor',
				//Optionnal values
				'config' => array(
									'toolbar'	=>	"Full",     //Using the Full toolbar
									'width'   =>  "auto",    //a custom width
									'height'  =>  "300px",    //a custom height
								),
						);
				
				//Loading View File
				$this->load->view('solution',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('solution', 'refresh');
			}
	  }
	}
	
	public function view($id='')
	{
		if($this->input->is_ajax_request())
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('solution', 'refresh');
			}
			//Getting detail for displaying in form
			$this->data['solution'] = $this->solutions->get_solution_byid($id);
			/*echo "<pre>";
			print_r($this->data['solution']);
			die();*/
			if( count($this->data['solution'])>0 )
			{			
				//Loading View File
				$this->load->view('solution',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('solution', 'refresh');
			}
	  	}
		}
		else
		{
				redirect('solution', 'refresh');
		}
	}
	
	//Updating the Record
	public function update()
	{
		//echo '<pre>';print_r($_REQUEST['detail']); die();
		if( $this->session->userdata['youg_admin'] )
	  	{
			$this->load->library('upload');
			
			$config['upload_path'] = '../uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '100';
            
 
            
            //print_r($_FILES['solutionsfile']);
            echo implode(",",$_FILES['solutionsfile']['name']);die;
            foreach ($_FILES['solutionsfile']['name'] as $key => $image) {
				
            $_FILES['solutionsfile'.$key]['name']= $_FILES['solutionsfile']['name'][$key];
            $_FILES['solutionsfile'.$key]['type']= $_FILES['solutionsfile']['type'][$key];
            $_FILES['solutionsfile'.$key]['tmp_name']= $_FILES['solutionsfile']['tmp_name'][$key];
            $_FILES['solutionsfile'.$key]['error']= $_FILES['solutionsfile']['error'][$key];
            $_FILES['solutionsfile'.$key]['size']= $_FILES['solutionsfile']['size'][$key];
			
			print_r($_FILES);
           
			$this->upload->initialize($config);
			
            if ($this->upload->do_upload('solutionsfile'.$key)) {
                $this->upload->data();
                print_r($data);
            } else {
				$errors = $this->upload->display_errors();
                        print_r($errors);
				die('2');
                
            }
        }
            
			/*
			foreach($_FILES as $field => $file)
            {
                // No problems with the file
                if($file['error'] == 0)
                {
                    // So lets upload
                    print_r($field);die;
                    if ($this->upload->do_upload($field))
                    {
                        $data = $this->upload->data();
                        print_r($data);
                    }
                    else
                    {
                        $errors = $this->upload->display_errors();
                        print_r($errors);
                        die('2');
                    }
                }
            }*/
							die('12');
					if( isset($_FILES['image']) && $_FILES['image']['size'] != 0 && trim($_FILES['image']['name']) != '' )
					{
						die('11');
							//load library
							$this->load->library('upload');
							
							if($this->upload->do_multi_upload("solutionsfile"))
							{
								die('1');
							}
							else{
								die('2');
							}
							
							//Uploading Cover Image and creating Thumb
							$config['upload_path'] = $this->config->item('solution_main_upload_path');
			  		 		$config['allowed_types'] = 'jpg|jpeg|png|bmp';
							$config['max_size']	= $this->config->item('solution_main_max_size');
							$config['max_width']  = $this->config->item('solution_main_max_width');
							$config['max_height']  = $this->config->item('solution_main_max_height');
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
								$myconfig['new_image'] = $this->config->item('solution_thumb_upload_path').$imgdata['file_name'];
								$myconfig['create_thumb'] = TRUE;
								$myconfig['maintain_ratio'] = TRUE;
								$myconfig['thumb_marker'] = '';
								$myconfig['width'] = $this->config->item('solution_thumb_width');
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
									 	$media = $this->input->post('solutionhiddenimage');
										 if( $media!='' )
										 {
										//Deleting main file
										if( file_exists($this->config->item('solution_main_upload_path').$media) )
												{											
													unlink($this->config->item('solution_main_upload_path').$media);
												}
												//Deleting thumbnail
												if( file_exists($this->config->item('solution_thumb_upload_path').$media) )
												{											
													unlink($this->config->item('solution_thumb_upload_path').$media);
												}
											}
					}
									$solutionimage=$imgdata['file_name'];
								}
						 		else
						 		{
									 $this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type (bmp/jpg/png)'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
									redirect('solution', 'refresh');
								 }
				}
					else
					{
						if($this->input->post('id'))
						{	
							$solutionimage=$this->input->post('solutionhiddenimage');
						}
						else
						{
							$solutionimage="";
						}
				}
			
			//If Old Record Update
			if( $this->input->post('id') )
	  		{
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$title = addslashes($this->input->post('title'));
				$detail = $_REQUEST['detail'];
				
				//Updating Record With Image
				if( $this->solutions->update($id,$title,$detail,$solutionimage))
				{
					$this->session->set_flashdata('success', 'business solution updated successfully.');
					redirect('solution', 'refresh');;
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating business solution. Try later!');
					redirect('solution', 'refresh');
				}
			}
			
			//If New Record Insert
			else
			{
				//Getting value
				$title = addslashes($this->input->post('title'));
				$detail = $_REQUEST['detail'];
				$siteid = $this->session->userdata('siteid');
						//Inserting Record
					if( $this->solutions->insert($title,$detail,$siteid,$solutionimage) )
					{
						$this->session->set_flashdata('success', 'business solution inserted successfully.');
						redirect('solution', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in inserting business solution. Try later!');
						redirect('solution', 'refresh');
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
				redirect('solution', 'refresh');
			}
			
			//Deleting Record
			if( $this->solutions->delete_solution_byid($id) )
			{
				$this->session->set_flashdata('success', 'business solution deleted successfully.');
				redirect('solution', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting business solution. Try later!');
				redirect('solution', 'refresh');
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
				redirect('solution', 'refresh');
			}
				
			if( $this->solutions->disable_solution_byid($id) )
			{
				$this->session->set_flashdata('success', 'business solution status disabled successfully.');
				redirect('solution', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating business solution status. Try later!');
				redirect('solution', 'refresh');
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
				redirect('solution', 'refresh');
			}
				
			if( $this->solutions->enable_solution_byid($id) )
			{
				$this->session->set_flashdata('success', 'business solution status enabled successfully.');
				redirect('solution', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating business solution status. Try later!');
				redirect('solution', 'refresh');
			}
	  }
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('solution',$this->data);
	  	}
	}
	
	public function searchsolution()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('solution/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('solution','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');				
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			
		//Addingg Setting Result to variable
		$this->data['solutions'] = $this->solutions->search_solution($keyword,$siteid,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['solutions']);
		//die();
			
		$this->paging['base_url'] = site_url("solution/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->solutions->search_solution($keyword,$siteid));
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		$this->load->view('solution',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
