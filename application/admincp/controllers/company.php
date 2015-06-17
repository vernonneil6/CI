<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Company extends CI_Controller {

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
	* @see http://codeigniter.com/company_guide/general/urls.html
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
		
		
		//Loading Model File
		$this->load->model('companys');
		$this->load->model('categorys');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Companies';
		$this->data['section_title'] = 'Companies';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	/*public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			
			$this->load->library('pagination');
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			//Addingg Setting Result to variable
			$this->data['companys'] = $this->companys->get_all_companys($limit,$offset);
			
			$this->paging['base_url'] = site_url("company/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = $this->companys->get_all_companys_count();
			$this->pagination->initialize($this->paging);
			
			//echo '<pre>';print_r($this->paging); die;
			
			//Loading View File
			$this->load->view('company',$this->data);
	  	}
	}*/
	
	public function index($sort_by = '', $sort_order = '', $offset = 0) {
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			
			$this->data['fields'] = array(
				'company' => 'Company Name',				
				'email' => 'Email',
				'status' => 'Status'
			);
			
			$this->load->model('companys');
			if($this->input->get('s')){				
				$decodeKeyword = urldecode($this->input->get('s'));
			}
			if(empty($sort_by) || empty($sort_order)){
				$offset = $sort_by;
			}
						
			$results = $this->companys->companiesSearch($decodeKeyword, $limit, $offset, $sort_by, $sort_order);
			
			$this->data['companies'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			
			// pagination				
			if(!empty($sort_by) && !empty($sort_order)){
				$siteURL = site_url("company/index/$sort_by/$sort_order");
				$uriSegment = 5;
			}
			else{
				$siteURL = site_url("company/index");
				$uriSegment = 3;
			}
			
			$this->paging['base_url'] = $siteURL;			
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;			
			$this->paging['uri_segment'] = $uriSegment;		
			$this->pagination->initialize($this->paging);
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('company', $this->data);
		}
	}
	
	
	
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			$siteid = $this->session->userdata('siteid');
			$this->data['categories'] = $this->categorys->get_all_categorys($siteid);
			
			//Loading View File
			$this->load->view('company',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('company', 'refresh');
			}

			$siteid = $this->session->userdata('siteid');
			$this->data['categories'] = $this->categorys->get_all_categorys($siteid);
			
			//Getting detail for displaying in form
			$this->data['company'] = $this->companys->get_company_byid($id);
			
			$cat = $this->data['company'][0]['categoryid'];
			$varcatid = explode(",",$cat);
			$newcat = array_flip($varcatid);
			$this->data['buscategories'] = $newcat;
		
			if( count($this->data['company'])>0 )
			{			
				//Loading View File
				$this->load->view('company',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('company', 'refresh');
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
						redirect('company', 'refresh');
					}
				
				//Getting detail for displaying in form
				$this->data['company'] = $this->companys->get_company_byid($id);
	
				if( count($this->data['company'])>0 )
				{			
					//Loading View File
					$this->load->view('company',$this->data);
				}
				else
				{
					$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
					redirect('company', 'refresh');
				}
			}
		}
		else
		{
			redirect('company', 'refresh');
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
					$company = addslashes($this->input->post('company'));
					$streetaddress = addslashes($this->input->post('streetaddress'));
					$city = addslashes($this->input->post('city'));
					$state = addslashes($this->input->post('state'));
					$country = addslashes($this->input->post('country'));
					$zip = trim($this->input->post('zip'));
					$email = addslashes($this->input->post('email'));
					$siteurl = addslashes($this->input->post('siteurl'));
					$paypalid = addslashes($this->input->post('paypalid'));
					$phone = addslashes($this->input->post('phone'));
					$companyseokeyword = addslashes($this->input->post('companyseokeyword'));
					$about = addslashes($this->input->post('about'));
					$cat = $this->input->post('cat');
					$price_range = $this->input->post('price_range');
					$accept_credit_cards = $this->input->post('accept_credit_cards');
					$accept_paypal = $this->input->post('accept_paypal');
				
					if($cat!='')
					{
						$category=implode(',',$cat);
					}
					else
					{
						$category='1';
					}
				
					//Loading Model File
					$this->load->model('companys');
					
					if(count($_FILES)>0)
					{
						if(count($_FILES['companylogo'])>0)
						{
							if( $_FILES['companylogo']['name']!='' && $_FILES['companylogo']['size'] > 0 )
							{
								//load library
								$this->load->library('upload');
				
								//Uploading Cover Image and creating Thumb
								$config['upload_path'] = $this->config->item('company_main_upload_path');
								$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
								$config['max_size']	= $this->config->item('company_main_max_size');
								$config['max_width']  = $this->config->item('company_main_max_width');
								$config['max_height']  = $this->config->item('company_main_max_height');
								$config['remove_spaces'] = TRUE;
								$a = explode('.',$_FILES['companylogo']['name']);
								$ex = end($a);
								$main = str_replace('.'.$ex,'',$_FILES['companylogo']['name']);
								$config['file_name'] = $main.date('YmdHis');
								
								// Initialize the new config
								$this->upload->initialize($config);
								//Uploading Image
								$this->upload->do_upload('companylogo');
								
								//Getting Uploaded Image File Data
								$imgdata = $this->upload->data();
								$imgerror = $this->upload->display_errors();
								
	
								if( $imgerror == '' )
								{
									//Configuring Thumbnail 
									$config['image_library'] = 'gd2';
									$config['source_image'] = $config['upload_path'].$imgdata['file_name'];
									$config['new_image'] = $this->config->item('company_thumb_upload_path').$imgdata['file_name'];
									$config['create_thumb'] = TRUE;
									$config['maintain_ratio'] = FALSE;
									$config['thumb_marker'] = '';
									$config['width'] = $this->config->item('company_thumb_width');
									$config['height'] = $this->config->item('company_thumb_height');
									
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
									$media = $this->companys->get_company_byid($id);
									if( count($media)>0 )
									{
										if( $media[0]['logo']!='' )
										{
											//Deleting main file
											if( file_exists($this->config->item('company_main_upload_path').$media[0]['logo']) )
											{											
												unlink($this->config->item('company_main_upload_path').$media[0]['logo']);
											}
											//Deleting thumbnail
											if( file_exists($this->config->item('company_thumb_upload_path').$media[0]['logo']) )
											{											
												unlink($this->config->item('company_thumb_upload_path').$media[0]['logo']);
											}
										}
									}
								
									//Updating Record With Image
									if( $this->companys->update($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$paypalid,$imgdata['file_name'],$phone,$companyseokeyword,$about,$category,$price_range,$accept_credit_cards,$accept_paypal) )
									{
										$this->session->set_flashdata('success', 'company updated successfully.');
										redirect('company', 'refresh');
									}
									else
									{
					
										$this->session->set_flashdata('error', 'There is error in updating company. Try later!');
										redirect('company', 'refresh');
									}
								}
								else
								{
									//Error in upload
									$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
									redirect('company','refresh');
								}
							}
							else
							{
								//Updating Record Without Image
								if( $this->companys->update_noimage($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$phone,$companyseokeyword,$about,$category,$price_range,$accept_credit_cards,$accept_paypal) )
								{
									$this->session->set_flashdata('success', 'company updated successfully.');
									redirect('company', 'refresh');
								}
								else
								{
									$this->session->set_flashdata('error', 'There is error in updating company. Try later!');
									redirect('company', 'refresh');
								}
							}
						}
					}
	
				}
			
			//If New Record Insert
			else
				{
					//Getting value
					$company = addslashes($this->input->post('company'));
					$streetaddress = addslashes($this->input->post('streetaddress'));
					$city = addslashes($this->input->post('city'));
					$state = addslashes($this->input->post('state'));
					$country = addslashes($this->input->post('country'));
					$zip = trim($this->input->post('zip'));
					$email = addslashes($this->input->post('email'));
					$siteurl = addslashes($this->input->post('siteurl'));
					$paypalid = addslashes($this->input->post('paypalid'));
					$phone = addslashes($this->input->post('phone'));
					$companyseokeyword = addslashes($this->input->post('companyseokeyword'));
					$about = addslashes($this->input->post('about'));
					$cat = $this->input->post('cat');
					$price_range = $this->input->post('price_range');
					$accept_credit_cards = $this->input->post('accept_credit_cards');
					$accept_paypal = $this->input->post('accept_paypal');
					
					if($cat!='')
					{
						$category=implode(',',$cat);
					}
					else
					{
						$category='1';
					}
					
					//load library
					$this->load->library('upload');
	
					//Uploading Cover Image and creating Thumb
					$config['upload_path'] = $this->config->item('company_main_upload_path');
					$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
					$config['max_size']	= $this->config->item('company_main_max_size');
					$config['max_width']  = $this->config->item('company_main_max_width');
					$config['max_height']  = $this->config->item('company_main_max_height');
					$config['remove_spaces'] = TRUE;
					$a = explode('.',$_FILES['companylogo']['name']);
					$ex = end($a);
					$main = str_replace('.'.$ex,'',$_FILES['companylogo']['name']);
					$config['file_name'] = $main.date('YmdHis');
					
					// Initialize the new config
					$this->upload->initialize($config);
					//Uploading Image
					$this->upload->do_upload('companylogo');
					
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
						$config['new_image'] = $this->config->item('company_thumb_upload_path').$imgdata['file_name'];
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = FALSE;
						$config['thumb_marker'] = '';
						$config['width'] = $this->config->item('company_thumb_width');
						$config['height'] = $this->config->item('company_thumb_height');
						
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
						if( $this->companys->insert($company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$paypalid,$imgdata['file_name'],$phone,$companyseokeyword,$about,$category,$price_range,$accept_credit_cards,$accept_paypal) )
						{
							$this->session->set_flashdata('success', 'company inserted successfully.');
							redirect('company', 'refresh');
						}
						else
						{
		
							$this->session->set_flashdata('error', 'There is error in inserting company. Try later!');
							redirect('company', 'refresh');
						}
					}
					else
					{
						//Error in upload
						$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
						redirect('company','refresh');
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
					redirect('company', 'refresh');
				}
			
			//Unlink Old Images
			$media = $this->companys->get_company_byid($id);
			if( count($media)>0 )
			{
				if( $media[0]['logo']!='' )
				{
					//Deleting main file
					if( file_exists($this->config->item('company_main_upload_path').$media[0]['logo']) )
					{											
						unlink($this->config->item('company_main_upload_path').$media[0]['logo']);
					}
					//Deleting thumbnail
					if( file_exists($this->config->item('company_thumb_upload_path').$media[0]['logo']) )
					{											
						unlink($this->config->item('company_thumb_upload_path').$media[0]['logo']);
					}
				}
			}
			
			//Deleting Record
			if( $this->companys->delete_company_byid($id) )
			{
				$this->session->set_flashdata('success', 'company deleted successfully.');
				redirect('company', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting company. Try later!');
				redirect('company', 'refresh');
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
				redirect('company', 'refresh');
			}
				
			if( $this->companys->disable_company_byid($id) )
			{
				$this->session->set_flashdata('success', 'company status disabled successfully.');
				redirect('company', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating company status. Try later!');
				redirect('company', 'refresh');
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
				redirect('company', 'refresh');
			}
			
			if( $this->companys->enable_company_byid($id) )
			{
				$this->session->set_flashdata('success', 'company status enabled successfully.');
				redirect('company', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating company status. Try later!');
				redirect('company', 'refresh');
			}
	  }
	}
	
	//Function to Check E-mail or company name is already exists
	public function fieldcheck()
	{
		if($this->session->userdata['youg_admin'] && $this->input->is_ajax_request() && ( $this->input->post('email') || $this->input->post('company')  || $this->input->post('companyseokeyword')) )
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
			if( $this->input->post('company') )
			{
				$field = 'company';
				$fieldvalue = addslashes($this->input->post('company'));
			}
			if( $this->input->post('companyseokeyword') )
			{
				$field = 'companyseokeyword';
				$fieldvalue = addslashes($this->input->post('companyseokeyword'));
			}
			if($field)
			{
				//Loading Model File
	  			$this->load->model('companys');
				//Addingg Result to view parameter
				$result = $this->companys->chkfield($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('company', 'refresh');
		}
	}
	
	/*public function import_csv()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if($this->input->post('btnupload'))
			{
				$config['upload_path'] = '../uploads/csv/';
				$config['allowed_types'] = 'csv|CSV';
				$config['max_size'] = '25000';
							
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('csvfile')) 
				{
					//Error in upload
					$this->session->set_flashdata('error', "Error while uploading file. 'Valid File Type ( csv )");
					redirect('company','refresh');
				}
				else
				{
						$file_info = $this->upload->data();
						$filePath = "../uploads/csv/";
						$file = $filePath.$file_info['file_name'];
						$row = 0;
						$companies = array();
						$handle = fopen($file, "r");
			
						$fcontents = file('../uploads/csv/'.$file_info['file_name']);
						/*echo "<pre>";
						print_r($fcontents);
						die();
					
								unset($fcontents[0]);
								//echo "<pre>";
								//print_r($fcontents);
								//die();
								
								if(count($fcontents)>0)
								 {
									for($i=1;$i<(sizeof($fcontents)+1); $i++)
									{
										$line = trim($fcontents[$i]);
										$arr = explode(",",$line);
										
										$company = $arr[0];
										$siteurl = $arr[1];
										$streetaddress = $arr[3];
										$email = $arr[4];
										$phone = $arr[5];
										$custsupport = $arr[6];
										$bush = $arr[7];
										$fax = $arr[8];
										$id = 0;
										$check = 'company';
										$fieldvalue = $arr[0];
										$result = $this->companys->chkfield($id,$check,$fieldvalue);
										$result1 = $this->companys->chkfield($id,'email',$email);
											
											if($result == 'old')
											{
												$this->session->set_flashdata('error', 'This Company Name is already taken!');
											}
											if($result1 == 'old')
											{
												$this->session->set_flashdata('error', 'This Company Email is already exists!');
											}										
											else
											{ 
												//Inserting Record
												if( $this->companys->insert1($company,$siteurl,$streetaddress,$email,$phone,$custsupport,$bush,$fax,strtolower($company).$i) )
												{
													$this->session->set_flashdata('success', 'company inserted successfully.');
												 }
												else
												{
													$this->session->set_flashdata('error', 'There is error in inserting company. Try later!');
												 }
											}
											}
											redirect('company','refresh');
											
								 }
								 else
								 {
								 	redirect('company','refresh');
								 }
								
						}
				
			}
			else
			{
				redirect('company','refresh');
			}
		}
		else
		{
			redirect('company','refresh');
		}
	}*/
	
	public function import_csv()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if($this->input->post('btnupload'))
			{
				$config['upload_path'] = '../uploads/csv/';
				$config['allowed_types'] = 'csv|CSV';
				//$config['max_size'] = '250000';
							
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('csvfile')) 
				{
					//Error in upload
					$this->session->set_flashdata('error', "Error while uploading file. 'Valid File Type ( csv )");
					redirect('company','refresh');
				}
				else
				{
						$file_info = $this->upload->data();
						$filePath = "../uploads/csv/";
						$file = $filePath.$file_info['file_name'];
						$row = 0;
						$companies = array();
						$handle = fopen($file, "r");
			
						$fcontents = file('../uploads/csv/'.$file_info['file_name']);
						
					
								unset($fcontents[0]);
								
								
								if(count($fcontents)>0)
								 {
									for($i=1;$i<(sizeof($fcontents)+1); $i++)
									{
										$line = trim($fcontents[$i]);
										$arr = explode(",",$line);
										
										//echo '<pre>';print_r($arr);die;
										/*Code added for tesing */
										$company = $arr[0];
										$email = $arr[1];
										$streetaddress = $arr[2];
										$city = $arr[3];
										$state = $arr[4];
										$zip = $arr[5];
										$country = $arr[6];
										$phone = $arr[7];
										$siteurl = $arr[8];
										$aboutus = $arr[9];
									
										/*
										 * Code added by old team 
										 * $company = $arr[0];
										$email = $arr[1];
										$contactname = $arr[5];
										$streetaddress = $arr[9];
										$city = $arr[11];
										$state = $arr[12];
										$zip = $arr[13];
										$country = $arr[14];
										$phone = $arr[15];
										$fax = $arr[16];
										$siteurl = $arr[17];
										$aboutus = $arr[21];*/
										$id = 0;
										$check = 'company';
										$fieldvalue = $arr[0];
										$result = $this->companys->chkfield($id,$check,$fieldvalue);
										$result1 = $this->companys->chkfield($id,'email',$email);
											
											if($result == 'old')
											{
												$this->session->set_flashdata('error', 'This Company Name is already taken!');
											}
											if($result1 == 'old')
											{
												$this->session->set_flashdata('error', 'This Company Email is already exists!');
											}										
											else
											{ 
												//Inserting Record
												/*code added by oldteam
												 * $this->companys->insert2($company,$email,$contactname,$streetaddress,$city,$state,$zip,$country,$phone,$fax,$siteurl,$aboutus,strtolower($company).$i) 
												 * 
												 * 
												 * 
												 * */
												if($this->companys->insert2($company,$email,$streetaddress,$city,$state,$zip,$country,$phone,$siteurl,$aboutus,strtolower($company).$i))
												{
													$this->session->set_flashdata('success', 'company inserted successfully.');
												 }
												else
												{
													$this->session->set_flashdata('error', 'There is error in inserting company. Try later!');
												 }
											}
											}
											redirect('company','refresh');
											
								 }
								 else
								 {
								 	redirect('company','refresh');
								 }
								
						}
				
			}
			else
			{
				redirect('company','refresh');
			}
		}
		else
		{
			redirect('company','refresh');
		}
	}
	
	
	
	public function download()
	{
		$this->load->helper('download');
			
		$site = site_url();			
		$url = explode("/admincp",$site);
		$path = $url[0];
		
		/*
		 * code added by old team
		 * $file = file_get_contents($path.'/companyinfo.csv');
		$name = 'example.csv';*/
		$file = file_get_contents($path.'/New_sample_companyinfo.csv');
		$name = 'sample.csv';

		force_download($name, $file); 
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('company',$this->data);
	  	}
	}
	
	public function searchcompany()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = urlencode($this->input->post('keysearch'));				
			redirect('company/index/?s='.$keyword);		
		}
		else
		{
			redirect('company','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		
		$this->data['companys'] = $this->companys->search_company($keyword,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['companys']);
		//die();
		
		$this->paging['base_url'] = site_url("company/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = $this->companys->search_company_count($keyword);
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		$this->load->view('company',$this->data);
	}
	
	public function makeelite($companyid='')
	{
		if($companyid=='')
		{
			redirect('company','refresh');
		}
		
		$companyid = base64_decode($companyid);
		$company = $this->settings->get_company_byid($companyid);
		
		if( count($company)==0 )
		{
			redirect('company','refresh');
		}
		
		if($companyid)
		{
				$tx  = rand();
				$amt = $this->settings->get_setting_value(9);
				$companyid  = $companyid;
				$sig = rand();
				$subscriptionId = rand();
				$payer_id = rand();
				
				$time = $this->settings->get_setting_value(18);
				$expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
				$paymentmethod = 'paypal';
				if( $this->settings->insert_subscription($companyid,$amt,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId))
				{
					$company = $this->settings->get_company_byid($companyid);
					if( count($company)>0 )
					{
						$password = uniqid();
						
						$sem = $this->settings->get_companysem_bycompanyid($companyid);
						$seo = $this->settings->get_companyseo_bycompanyid($companyid);

						$this->settings->set_password($companyid,$password);
						if(count($sem)==0 && count($seo)==0 ) 
						{
							
							$this->settings->set_sem($companyid,"Facebook","http://www.facebook.com","ade2c15ab85aef450fb2f6e53e8cb825.png","ade2c15ab85aef450fb2f6e53e8cb825.png","1","f");
							$this->settings->set_sem($companyid,"twitter","http://www.twitter.com","51e28dd5af6d2bb51b518b47ae717f1a.png","51e28dd5af6d2bb51b518b47ae717f1a.png","1","t");
							$this->settings->set_sem($companyid,"Linkedin","http://www.linkedin.com","ab5b4de4c8fa16f822635c942aafdfb5.jpg","ab5b4de4c8fa16f822635c942aafdfb5.jpg","1","l");
							$this->settings->set_sem($companyid,"Google","http://www.google.com","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg","1","g");
							$this->settings->set_sem($companyid,"pintrest","http://www.pintrest.com","1519f4062fa76260346bfc61665e579d.jpeg","1519f4062fa76260346bfc61665e579d.jpeg","1","p");
							$this->settings->set_sem($companyid,"amazon","http://www.amazon.in","","","1",'a');
							$this->settings->set_sem($companyid,"ebay","http://www.ebay.in","","","1",'e');
							$this->settings->set_sem($companyid,"youtube","http://www.youtube.com","","","1",'y');

							$this->settings->set_seo($companyid,"Google Analytic","Google Analytic","1");
							$this->settings->set_seo($companyid,"Google Webmaster","Google Webmaster","1");
							$this->settings->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords","1");
							$this->settings->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description","1");

						}
						
												
								
							//Inserting Elite Membership Transaction Details for Company
							$length = 20;

							$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
							$randomStringmy = $randomString;


							
							$transaction = $this->settings->add_transaction($companyid,$this->settings->get_setting_value(9),'USD',$randomString,date('Y-m-d H:i:s'));
							$websites = $this->settings->get_all_websites();
								
							$siteid = $this->session->userdata('siteid');
							$page = $this->settings->get_pages_by_id(12,$siteid);
		
							if( count($page) > 0 )
							{
								$institle = stripslashes($page[0]['title']);
								$inssteps = nl2br(($page[0]['pagecontent']));
							}
							
							$site_name = $this->settings->get_setting_value(1);
							$site_url = $this->settings->get_setting_value(2);
							$site_mail = $this->settings->get_setting_value(5);
								
							//Company Email Address
							$email = $company[0]['email'];
								
							//Loading E-mail library
							$this->load->library('email');
								
							//Loading E-mail config file
							$this->config->load('email',TRUE);
							$this->cnfemail = $this->config->item('email');
										
							$this->email->initialize($this->cnfemail);
							$this->email->from($email,$company[0]['company']);
							$this->email->to($site_mail);	
							$this->email->subject('Payment Received for Business Claim.');
							$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
														<tr>
															<td>Hello administration,</td>
														</tr>
														<tr><td><br/></td></tr>
														<tr>
															<td style="padding-left:20px;">
															Following User has claimed the business <b>'.ucwords($company[0]['company']).'</b>. Transaction Details are as follows.
															</td>
														</tr>
														<tr>
															<td>
																<table cellpadding="0" cellspacing="0" width="100%" border="0">
																<tr><td colspan="3"><h3>Payment Detail</h3></td></tr>
																<tr>
																	<td>Payment Amount</td>
																	<td>:</td>
																	<td>USD '.$this->settings->get_setting_value(9).'</td>
																</tr>
																<tr>
																	<td>Transacion ID</td>
																	<td>:</td>
																	<td><b>'.$randomStringmy.'</b></td>
																</tr>
																</table>
															</td>
														</tr>
														</table>');
								//Sending mail to admin
								$this->email->send();
								//echo $site_mail;
								//echo $email;die();
								//For sending mail to user
								$this->email->from($site_mail,$site_name);
								$this->email->to($email);	
								$this->email->subject('Business has been claimed successfully.');
								$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td>Hello '.$company[0]['company'].',</td>
  </tr>
  <tr>
    <td><br/></td>
  </tr>
  <tr>
    <td style="padding-left:20px;"> You have successfully claimed the Business <b>'.ucwords($company[0]['company']).'</b>. </td>
  </tr>
  <tr>
    <td style="padding-left:20px;"> You can login with the following credentials to your elite member admin account by clicking link below or paste it in the address bar. </td>
  </tr>
  <tr>
    <td style="padding-left:20px;"> ----------------------------------------------------<br />
      Username = Your email address<br />
      password = '.$password.'<br />
      ----------------------------------------------------<br />
      Please click this link to login your account.<br />
      <a href="'.$site_url.'businessadmin">Elite Member Login</a></td>
  </tr>
  <tr>
    <td style="padding-left:20px;"></td>
  </tr>
  <tr>
    <td style="padding-left:20px;"> Your Transaction Details are as follows. </td>
  </tr>
  <tr>
    <td><table cellpadding="0" cellspacing="0" width="100%" border="0">
        <tr>
          <td colspan="3"><h3>Payment Detail</h3></td>
        </tr>
        <tr>
          <td>Payment Amount</td>
          <td>:</td>
          <td>USD '.$this->settings->get_setting_value(9).'</td>
        </tr>
        <tr>
          <td>Transacion ID</td>
          <td>:</td>
          <td><b>'.$randomStringmy.'</b></td>
        </tr>
        <tr>
          <td colspan="3"><h3>Widget</h3></td>
        </tr>
        <tr>
          <td colspan="3">&lt;iframe src=&quot;'.site_url("widget/business/".$companyid).'&quot; style=&quot;border:none;&quot;&gt;&lt;/iframe&gt;
		  				<br/>
					&lt;div style=&quot;display:none;&quot;&gt;
					&lt;a href=&quot;'.$websites[0]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[1]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[2]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[3]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[4]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[5]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[6]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[7]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[8]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[9]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[10]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[11]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[12]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[13]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[14]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;a href=&quot;'.$websites[15]['url'].("/company/".$company[0]['companyseokeyword']."/reviews/coupons/complaints").'&quot; &gt;
					&lt;/a&gt;
					&lt;/div&gt;
					</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><h3>'.$institle.'</h3></td>
        </tr>
        <tr>
          <td colspan="3">'.$inssteps.' </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><br/>
      <br/></td>
  </tr>
  <tr>
    <td> Regards,<br/>
      The '.$site_name.' Team.<br/>
      <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a></td>
  </tr>
</table>
');
								
								//Sending mail user
								$this->email->send();
								$this->session->set_flashdata('success','this business is added to elite members.');
								redirect('company', 'refresh');
							}
					else
					{
						redirect('company', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error',"There was error. Please try later!");
					redirect('company', 'refresh');
				}
			
			
		}
		else
			{
				$this->session->set_flashdata('error', 'Something went wrong try later');
				redirect('company', 'refresh');
			}
		
	
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
