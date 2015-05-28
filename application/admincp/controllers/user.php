<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class User extends CI_Controller {

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
			/*last url status - start*/
			$currenturl = $this->uri->uri_string;		
			$this->session->set_userdata('last_url',$this->session->userdata('current_url'));
			$this->session->set_userdata('current_url',$currenturl);		
			$this->load->model('reviews');
			$this->load->model('companys');
			/*last url status - end*/
			
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
	 	$this->load->model('users');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		if(  $this->uri->segment(2) && ( $this->uri->segment(2)=='searchresult' || $this->uri->segment(2)=='search' ))
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Search Users';
			$this->data['section_title'] = 'Search';
		}
		else
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Users';
			$this->data['section_title'] = 'Users';
		}
		
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
	
	
	
	public function index($sort_by = 'firstname', $sort_order = 'asc', $offset = 0) {
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			$this->data['fields'] = array(
				'firstname' => 'Name',
				'email' => 'Email',
				'registerdate' => 'Date Created',
				'status' => 'Status'
			);
			
			$this->load->model('users');
			if($this->input->get('s')){				
				$decodeKeyword = urldecode($this->input->get('s'));
			}
			$results = $this->users->usersSearch($decodeKeyword, $limit, $offset, $sort_by, $sort_order);
			
			$this->data['users'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			
			// pagination				
			$this->paging['base_url'] = site_url("user/index/$sort_by/$sort_order");
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;
			$this->paging['uri_segment'] = 5;
			$this->pagination->initialize($this->paging);									
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('user', $this->data);
		}
	}
	
	public function searchuser()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = urlencode($this->input->post('keysearch'));				
			redirect('user/index/?s='.$keyword);	
		}
		else
		{
			redirect('user','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
				
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
					
		$this->data['users'] = $this->users->search_user($keyword,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['users']);
		//die();
		$this->paging['base_url'] = site_url("user/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->users->search_user($keyword));
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		$this->load->view('user',$this->data);
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('user',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('user', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['user'] = $this->users->get_user_byid($id);
			/*echo "<pre>";
			print_r($this->data['user']);
			die();*/
			if( count($this->data['user'])>0 )
			{			
				//Loading View File
				$this->load->view('user',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('user', 'refresh');
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
				redirect('user', 'refresh');
			}
			//Getting detail for displaying in form
			$this->data['user'] = $this->users->get_user_byid($id);
			/*echo "<pre>";
			print_r($this->data['user']);
			die();*/
				if( count($this->data['user'])>0 )
				{			
					//Loading View File
					$this->load->view('user',$this->data);
				}
				else
				{
					$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
					redirect('user', 'refresh');
				}
		  }
		}
		else
		{
					redirect('user', 'refresh');
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
				$firstname = addslashes($this->input->post('firstname'));
				$lastname = addslashes($this->input->post('lastname'));
				$email = addslashes($this->input->post('email'));
				$password = addslashes($this->input->post('password'));
				$gender = addslashes($this->input->post('gender'));
				$street = addslashes($this->input->post('street'));
				$city = addslashes($this->input->post('city'));
				$state = addslashes($this->input->post('state'));
				$zipcode = addslashes($this->input->post('zipcode'));
				$phoneno = addslashes($this->input->post('phoneno'));
				
				if(count($_FILES)>0)
				{
					if(count($_FILES['avatarbig'])>0)
					{
						if( $_FILES['avatarbig']['name']!='' && $_FILES['avatarbig']['size'] > 0 )
						{
							//load library
							$this->load->library('upload');
			
							//Uploading Cover Image and creating Thumb
							$config['upload_path'] = $this->config->item('user_main_upload_path');
							$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
							$config['max_size']	= $this->config->item('user_main_max_size');
							$config['max_width']  = $this->config->item('user_main_max_width');
							$config['max_height']  = $this->config->item('user_main_max_height');
							$config['remove_spaces'] = TRUE;
							$a = explode('.',$_FILES['avatarbig']['name']);
							$ex = end($a);
							$main = str_replace('.'.$ex,'',$_FILES['avatarbig']['name']);
							$config['file_name'] = $main.date('YmdHis');
							
							// Initialize the new config
							$this->upload->initialize($config);
							//Uploading Image
							$this->upload->do_upload('avatarbig');
							
							//Getting Uploaded Image File Data
							$imgdata = $this->upload->data();
							$imgerror = $this->upload->display_errors();

							if( $imgerror == '' )
							{
								//Configuring Thumbnail 
								$config['image_library'] = 'gd2';
								$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
								$config['new_image'] = $this->config->item('user_thumb_upload_path').$imgdata['file_name'];
								$config['create_thumb'] = TRUE;
								$config['maintain_ratio'] = FALSE;
								$config['thumb_marker'] = '';
								$config['width'] = $this->config->item('user_thumb_width');
								$config['height'] = $this->config->item('user_thumb_height');
								
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
								$media = $this->users->get_user_byid($id);
								if( count($media)>0 )
								{
									if( $media[0]['avatarbig']!='' )
									{
										//Deleting main file
										if( file_exists($this->config->item('user_main_upload_path').$media[0]['avatarbig']) )
										{											
											unlink($this->config->item('user_main_upload_path').$media[0]['avatarbig']);
										}
										//Deleting thumbnail
										if( file_exists($this->config->item('user_thumb_upload_path').$media[0]['avatarbig']) )
										{											
											unlink($this->config->item('user_thumb_upload_path').$media[0]['avatarbig']);
										}
									}
								}
							
								//Updating Record With Image
								if( $this->users->update($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$imgdata['file_name'],$imgdata['file_name']) )
								{
									$this->session->set_flashdata('success', 'user updated successfully.');
									redirect('user', 'refresh');;
								}
								else
								{
				
									$this->session->set_flashdata('error', 'There is error in updating user. Try later!');
									redirect('user', 'refresh');
								}
							}
							else
							{
								//Error in upload
								$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
								
								redirect('user','refresh');
							}
						}
						else
						{
							//Updating Record Without Image
							if( $this->users->update_noimage($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno) )
							{
								$this->session->set_flashdata('success', 'user updated successfully.');
								redirect('user', 'refresh');
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in updating user. Try later!');
								redirect('user', 'refresh');
							}
						}
					}
				}
			}
			
			//If New Record Insert
			else
			{
				//Getting value
				$firstname = addslashes($this->input->post('firstname'));
				$lastname = addslashes($this->input->post('lastname'));
				$email = addslashes($this->input->post('email'));
				$password = addslashes($this->input->post('password'));
				$gender = addslashes($this->input->post('gender'));
				$street = addslashes($this->input->post('street'));
				$city = addslashes($this->input->post('city'));
				$state = addslashes($this->input->post('state'));
				$zipcode = addslashes($this->input->post('zipcode'));
				$phoneno = addslashes($this->input->post('phoneno'));
				
				//load library
				$this->load->library('upload');

				//Uploading Cover Image and creating Thumb
				$config['upload_path'] = $this->config->item('user_main_upload_path');
				$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
				$config['max_size']	= $this->config->item('user_main_max_size');
				$config['max_width']  = $this->config->item('user_main_max_width');
				$config['max_height']  = $this->config->item('user_main_max_height');
				$config['remove_spaces'] = TRUE;
				$a = explode('.',$_FILES['avatarbig']['name']);
				$ex = end($a);
				$main = str_replace('.'.$ex,'',$_FILES['avatarbig']['name']);
				$config['file_name'] = $main.date('YmdHis');
				
				// Initialize the new config
				$this->upload->initialize($config);
				//Uploading Image
				$this->upload->do_upload('avatarbig');
				
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
					$config['new_image'] = $this->config->item('user_thumb_upload_path').$imgdata['file_name'];
					$config['create_thumb'] = TRUE;
					$config['maintain_ratio'] = FALSE;
					$config['thumb_marker'] = '';
					$config['width'] = $this->config->item('user_thumb_width');
					$config['height'] = $this->config->item('user_thumb_height');
					
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
					//Inserting Record
					if( $this->users->insert($firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$imgdata['file_name'],$imgdata['file_name']) )
					{
						$this->session->set_flashdata('success', 'user inserted successfully.');
						redirect('user', 'refresh');
					}
					else
					{
	
						$this->session->set_flashdata('error', 'There is error in inserting user. Try later!');
						redirect('user', 'refresh');
					}
				}
				else
				{
					//Error in upload
					$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
					
					redirect('user','refresh');
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
				//redirect('user', 'refresh');
			}else{
			
				//Unlink Old Images
				$media = $this->users->get_user_byid($id);
				if( count($media)>0 )
				{
					if( $media[0]['avatarbig']!='' )
					{
						//Deleting main file
						if( file_exists($this->config->item('user_main_upload_path').$media[0]['avatarbig']) )
						{											
							unlink($this->config->item('user_main_upload_path').$media[0]['avatarbig']);
						}
						//Deleting thumbnail
						if( file_exists($this->config->item('user_thumb_upload_path').$media[0]['avatarbig']) )
						{											
							unlink($this->config->item('user_thumb_upload_path').$media[0]['avatarbig']);
						}
					}
				}
				
				//Deleting Record
				if( $this->users->delete_user_byid($id) )
				{
					$this->session->set_flashdata('success', 'user deleted successfully.');
					//redirect('user', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in deleting user. Try later!');
					//redirect('user', 'refresh');
				}
			}
	  	}
	  	
	  	if($this->session->userdata('last_url')){
			redirect($this->session->userdata('last_url'),'refresh');
		}else{
			redirect('user','refresh');
		}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				//redirect('user', 'refresh');
			}
				
			if( $this->users->disable_user_byid($id) )
			{
				$this->session->set_flashdata('success', 'user status disabled successfully.');
				//redirect('user', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating user status. Try later!');
				//redirect('user', 'refresh');
			}
			
			if($this->session->userdata('last_url')){
				redirect($this->session->userdata('last_url'),'refresh');
			}else{
				redirect('user','refresh');
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
				//redirect('user', 'refresh');
			}
			
			if( $this->users->enable_user_byid($id) )
			{
				$this->session->set_flashdata('success', 'user status enabled successfully.');
				//redirect('user', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating user status. Try later!');
				//redirect('user', 'refresh');
			}
			
			if($this->session->userdata('last_url')){
				redirect($this->session->userdata('last_url'),'refresh');
			}else{
				redirect('user','refresh');
			}
	  }
	}
	
	//Function to Check E-mail or User name is already exists
	public function fieldcheck()
	{
		if($this->session->userdata['youg_admin'] && $this->input->is_ajax_request() && ( $this->input->post('email') || $this->input->post('username')  ) )
	  {
			if( $this->input->post('id') )
			{
				$id = $this->input->post('id');
			}
			else
			{
				$id = 0;
			}
			if( $this->input->post('email') )
			{
				$field = 'email';
				$fieldvalue = addslashes($this->input->post('email'));
			}
			if( $this->input->post('username') )
			{
				$field = 'username';
				$fieldvalue = addslashes($this->input->post('username'));
			}
			if($field)
			{
				//Addingg Result to view parameter
				$result = $this->users->chkfield($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('user', 'refresh');
		}
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('user',$this->data);
	  	}
	}
	
	

	
	public function csv($keyword)
    {
        if( $this->session->userdata['youg_admin'] )
        {
				if($keyword!='') 
				{
					$file = 'Report-of-search-user.csv';
					$searchKey = urldecode($keyword);
					$users = $this->users->search_user($searchKey);
					
				}
				else
				{
					$file = 'Report-of-all-user.csv';
					$users = $this->users->get_all_users();
				}
				ob_start();
				echo "User,Join date,Email";
				echo "\n";
							
					
				    		for($i=0;$i<count($users);$i++) { 
							
								echo stripslashes(ucwords($users[$i]['firstname'].' '.$users[$i]['lastname']));
								echo ",";
								echo date("M d Y",strtotime($users[$i]['registerdate'])); 
								echo ",";
								echo stripslashes($users[$i]['email']);
								echo "\n";
							
							}
					
							$content = ob_get_contents();
							ob_end_clean();
							header("Expires: 0");
							header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
							header("Cache-Control: no-store, no-cache, must-revalidate");
							header("Cache-Control: post-check=0, pre-check=0", false);
							header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
							header('Content-length: '.strlen($content));
							header('Content-disposition: attachment; filename='.basename($file));
							echo $content;
							exit;
							
						
		}
		else
		{
			redirect('adminlogin','refresh');
		}
    }

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
