<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pdf extends CI_Controller {

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
		
		//Loading Model File
	  	$this->load->model('pdfs');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Pdfs';
		$this->data['section_title'] = 'Pdfs';
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
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			
			//Addingg Setting Result to variable
			$this->data['pdfs'] = $this->pdfs->get_all_pdfs($companyid,$siteid,$limit,$offset);
			$this->paging['base_url'] = site_url("pdf/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->pdfs->get_all_pdfs($companyid,$siteid));
			$this->pagination->initialize($this->paging);
			
			//Loading View File
			$this->load->view('pdf',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('pdf',$this->data);
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
								$title = addslashes($this->input->post('title'));
								$siteid = $this->session->userdata('siteid');
								$companyid = $this->session->userdata['youg_admin']['id'];
					if(count($_FILES)>0)
					{
						if(count($_FILES['pdf'])>0)
						{
							if( $_FILES['pdf']['name']!='' && $_FILES['pdf']['size'] > 0 )
							{
								
								
								//load library
								$this->load->library('upload');
				
								//Uploading Cover Image and creating Thumb
								$config['upload_path'] = $this->config->item('pdf_main_upload_path');
								$config['allowed_types'] = 'pdf';
								$config['max_size']	= $this->config->item('pdf_main_max_size');
								$config['remove_spaces'] = TRUE;
								$config['encrypt_name'] = TRUE;
								
								// Initialize the new config
								$this->upload->initialize($config);
								//Uploading Image
								$this->upload->do_upload('pdf');
								
								//Getting Uploaded Image File Data
								$pdfdata = $this->upload->data();
								$pdferror = $this->upload->display_errors();
								
								if( count($error)==0 && count($pdfdata) > 0 )
								{
									//Unlink Old Images
									$media = $this->pdfs->get_pdf_byid($id);
									if( count($media)>0 )
									{
										if( $media[0]['pdf']!='' )
										{
											//Deleting main file
											if( file_exists($this->config->item('pdf_main_upload_path').$media[0]['pdf']) )
											{											
												unlink($this->config->item('pdf_main_upload_path').$media[0]['pdf']);
											}
										}
									}
								
									//Updating Record With Image
									if( $this->pdfs->update($id,$title,$pdfdata['file_name']) )
									{
										$this->session->set_flashdata('success', 'pdf updated successfully.');
										redirect('pdf', 'refresh');
									}
									else
									{
					
										$this->session->set_flashdata('error', 'There is error in updating pdf. Try later!');
										redirect('pdf', 'refresh');
									}
								}
								else
								{
									//Error in upload
									$this->session->set_flashdata('error', "Error while uploading pdf.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( pdf )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;''</b>");
									redirect('pdf','refresh');
								}
							}
							else
							{
								//Updating Record Without Image
								if( $this->pdfs->update_nopdf($id,$title) )
								{
									$this->session->set_flashdata('success', 'pdf updated successfully.');
									redirect('pdf', 'refresh');
								}
								else
								{
									$this->session->set_flashdata('error', 'There is error in updating pdf. Try later!');
									redirect('pdf', 'refresh');
								}
							}
						}
					}
	
				}
			
				//If New Record Insert
				else
				{
					//Getting value
					$title = addslashes($this->input->post('title'));
					$siteid = $this->session->userdata('siteid');
					$companyid = $this->session->userdata['youg_admin']['id'];
					//load library
					$this->load->library('upload');
	
					//Uploading Cover Image and creating Thumb
					$config['upload_path'] = $this->config->item('pdf_main_upload_path');
					$config['allowed_types'] = 'pdf';
					$config['max_size']	= $this->config->item('pdf_main_max_size');
					$config['remove_spaces'] = TRUE;
					$config['encrypt_name'] = TRUE;
					
					// Initialize the new config
					$this->upload->initialize($config);
					//Uploading Image
					$this->upload->do_upload('pdf');
					
					//Getting Uploaded Image File Data
					
					$pdfdata = $this->upload->data();
					$pdferror = $this->upload->display_errors();
					
					if( $pdferror=='' && count($pdfdata) > 0 )
					{
						
						//Inserting Record
						if( $this->pdfs->insert($companyid,$title,$pdfdata['file_name'],$siteid) )
						{
							$this->session->set_flashdata('success', 'Pdf inserted successfully.');
							redirect('pdf', 'refresh');
						}
						else
						{
		
							$this->session->set_flashdata('error', 'There is error in inserting pdf. Try later!');
							redirect('pdf', 'refresh');
						}
					}
					else
					{
						
						//Error in upload
						$this->session->set_flashdata('error', "Error while uploading pdf.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( pdf )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;''</b>");
						redirect('pdf','refresh');
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
				redirect('pdf', 'refresh');
			}
			
			//Deleting Record
			if( $this->pdfs->delete_pdf_byid($id) )
			{
				$this->session->set_flashdata('success', 'pdf deleted successfully.');
				redirect('pdf', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting pdf. Try later!');
				redirect('pdf', 'refresh');
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
				redirect('pdf', 'refresh');
			}
				
			if( $this->pdfs->disable_pdf_byid($id) )
			{
				$this->session->set_flashdata('success', 'pdf status disabled successfully.');
				redirect('pdf', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating pdf status. Try later!');
				redirect('pdf', 'refresh');
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
				redirect('pdf', 'refresh');
			}
			
			if( $this->pdf->enable_pdf_byid($id) )
			{
				$this->session->set_flashdata('success', 'pdf status enabled successfully.');
				redirect('pdf', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating pdf status. Try later!');
				redirect('pdf', 'refresh');
			}
	  }
	}
	
	public function view($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('pdf', 'refresh');
			}
			
			//Getting detail for displaying in form
			
			$this->data['pdf'] = $this->pdfs->get_pdf_byid($id);
			
			if( count($this->data['pdf'])>0 )
			{
				//Loading View File
				$this->load->view('pdf',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('pdf', 'refresh');
			}
	  }
	}
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('pdf', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['pdf'] = $this->pdfs->get_pdf_byid($id);

			if( count($this->data['pdf'])>0 )
			{
				//Loading View File
				$this->load->view('pdf',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('pdf', 'refresh');
			}
	  }
	}
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */