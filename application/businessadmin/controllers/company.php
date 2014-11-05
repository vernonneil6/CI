<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		if( !$this->session->userdata('youg_admin'))
	  	{
		    //If no session, redirect to login page
			//echo site_url();die();
	      	redirect('adminlogin', 'refresh');
			}
		
		//Loading Helper File
	  	$this->load->helper('form');
		$this->load->helper('download');
			
		//Loading Model File
		$this->load->model('companys');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Company';
		$this->data['section_title'] = 'Company';
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
			//Loading Model File
	  		$this->load->model('companys');
			$id = $this->session->userdata['youg_admin']['id'];
			
			//Addingg Setting Result to variable
			$this->data['company'] = $this->companys->get_company_byid($id);
			
			//Loading View File
			$this->load->view('company',$this->data);
	  	}
	}
	
	public function edit()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$id = $this->session->userdata['youg_admin']['id'];
			//Loading Helper File
	  		$this->load->helper('form');
			
			//Loading Model File
	  		$this->load->model('companys');
			$siteid = $this->session->userdata('siteid');
			$this->data['categories'] = $this->companys->get_all_categorys($siteid);
			
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
					$about = addslashes($this->input->post('about'));
					$cat = $this->input->post('cat');
					if($cat!='')
					{
						$category=implode(',',$cat);
					}
					else
					{
						$category='1';
					}
					$creditcard1 = ($this->input->post('creditcard1'));
					$creditcard2 = ($this->input->post('creditcard2'));
					
					$price_range = ($this->input->post('price_range'));
					$accept_credit_cards = ($this->input->post('accept_credit_cards'));
					$accept_paypal = ($this->input->post('accept_paypal'));
					
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
									if( $this->companys->update($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$paypalid,$imgdata['file_name'],$phone,$about,$category,$creditcard1,$creditcard2,$price_range,$accept_credit_cards,$accept_paypal) )
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
								if( $this->companys->update_noimage($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$phone,$about,$category,$creditcard1,$creditcard2,$price_range,$accept_credit_cards,$accept_paypal) )
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
				else if( $this->input->post('btnpassupdate') )
			  	{			
					//Getting intid
					$id = $this->session->userdata['youg_admin']['id'];
			
					//Getting value
					$oldpassword = $this->input->post('oldpassword');			
					
					$newpassword = $this->input->post('newpassword');
					
			
					
					//Getting detail for displaying in form
					$company = $this->companys->get_company_byid($id);
					
			if(count($company)>0)
			{
				$companyoldpassword = $company[0]['password'];
				
				if( $oldpassword == $companyoldpassword )
				{
					//Addingg Result to view parameter
					if( $this->companys->update_password($id,$newpassword) )
					{					
						//Loading View File
						$this->session->set_flashdata('success', 'Password has been Updated Successfully.');
						redirect('company', 'refresh');
					}
					else
					{
						//Loading View File
						$this->session->set_flashdata('error', 'Password not updated. Try later.');
						redirect('company', 'refresh');
					}
				}
				else
				{
					//Loading View File
					$this->session->set_flashdata('error', 'Old password you gave is incorrect.');
					redirect('company', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('company', 'refresh');
			}
		}
				else
				{
				redirect('company', 'refresh');
				}
			}
			else
				{
				redirect('company', 'refresh');
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
	
	public function changepassword()
	{
		if( !$this->session->userdata['youg_admin'] )
	  	{
			redirect('adminlogin', 'refresh');
		}
		else if($this->session->userdata['youg_admin'])
	  	{
			$id = $this->session->userdata['youg_admin']['id'];
			if(!$id)
			{
				redirect('adminlogin', 'refresh');
			}
					
			//Getting detail for displaying in form
			$this->data['company'] = $this->companys->get_company_byid($id);
			$this->data['section_title'] = 'change password';
			/*echo "<pre>";
			print_r($this->data['company']);
			die();*/
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
	
	
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */