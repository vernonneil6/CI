<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Businessdirectory extends CI_Controller {

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
	* @see http://codeigniter.com/businessdirectory_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
					
		//Loading Model File
  		$this->load->model('reviews');
		$this->load->model('complaints');
		
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		 {
		    $site = $regs['domain'];
		 }
		 
		 $website = $this->common->get_site_by_domain_name($site);
		 
		 if(count($website)>0)
		 {
		 	$siteid = $website[0]['id'];
		 }
		$this->session->set_userdata('siteid',$siteid);
		
		$siteid = $this->session->userdata('siteid');
		
		$this->data['site_name'] = $this->common->get_sitename_byid($siteid);
		$this->data['site_url'] = $this->common->get_siteurl_byid($siteid);
		$this->data['searchword']='';
		
		$this->data['topads']= $this->common->get_all_ads('top','directory',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','directory',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','directory',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','directory',$siteid);
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		//echo "<pre>";
		//print_r( $this->data['total'] );
		//die();
			
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		if( $this->uri->segment(1) == 'businessdirectory' && ( $this->uri->segment(2) == 'search' || $this->uri->segment(2) == 'searchkey' ) )
		{
			$this->data['title'] = 'Search Companies : '.$this->data['site_name'];
		}
		else
		{
			$this->data['title'] = $this->data['site_name'].' : Businessdirectory';
		}
		$this->data['section_title'] = 'Businessdirectory';

		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		  //Loading View File
		  $this->load->view('businessdirectory',$this->data);
	}
	
	public function add()
	{
		  $siteid = $this->session->userdata('siteid');
		  $this->data['categories'] = $this->common->get_all_categorys($siteid);
		  //Loading View File
		  $this->load->view('businessdirectory',$this->data);
		
	}
	
	public function search()
	{
			if(!$this->uri->segment(3))
			{
				$searchcomp=trim($this->input->post('searchcomp'));
			}
			else
			{
				$searchuri = $this->uri->segment(3);
				$uri= base64_decode($searchuri);
				$uri= explode('/',$uri);
				$searchcomp=$uri[0];
			}
			
			$this->data['keyword']=$searchcomp;
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			
			//Addingg Setting Result to variable
			$this->data['companies'] = $this->reviews->search_company($searchcomp,$limit,$offset);
			$uri=	$searchcomp;
			//echo $uri;
			$uri= base64_encode($uri);
			$this->paging['base_url'] = site_url("businessdirectory/search/".$uri);
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = $this->reviews->search_company_count($searchcomp);
			$this->pagination->initialize($this->paging);
			
			$this->load->view('businessdirectory',$this->data);
				
		}
		
	//Updating the Record
	public function update()
	{
		if( $this->input->post('btnaddcompany') || $this->input->post('email'))
		{
				//Getting value
				$name = strtolower(addslashes($this->input->post('name')));
				$streetaddress = addslashes($this->input->post('streetaddress'));
				$city = addslashes($this->input->post('city'));
				$state = addslashes($this->input->post('state'));
				$country = addslashes($this->input->post('country'));
				$zip = addslashes($this->input->post('zip'));
				$phone = trim($this->input->post('phone'));
				$email = strtolower(addslashes($this->input->post('email')));
				$website = addslashes($this->input->post('website'));
				$paypalid = addslashes($this->input->post('paypalid'));
				$cat = $this->input->post('cat');
					if($cat!='')
					{
						$category=implode(',',$cat);
					}
					else
					{
						$category='1';
					}
				$aboutcompany = $this->input->post('aboutcompany');
				
				//load library
				$this->load->library('upload');
	
				//Uploading Cover Image and creating Thumb
				$config['upload_path'] = $this->config->item('company_main_upload_path');
				$config['allowed_types'] = 'gif|jpg|jpeg|png|bmp';
				$config['max_size']	= $this->config->item('company_main_max_size');
				$config['max_width']  = $this->config->item('company_main_max_width');
				$config['max_height']  = $this->config->item('company_main_max_height');
				$config['remove_spaces'] = TRUE;
				$config['encrypt_name'] = TRUE;
					
				// Initialize the new config
				$this->upload->initialize($config);
				//Uploading Image
				$this->upload->do_upload('logo');
					
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
						if( $this->complaints->insert_business($name,$streetaddress,$city,$state,$country,$zip,$phone,$email,$website,$paypalid,$imgdata['file_name'],$category,$aboutcompany) )
						{
							$companyid = $this->db->insert_id();
							
							if($this->complaints->insert_companyseo($companyid,$name))
							{
								
								$site_name = $this->common->get_setting_value(1);
								$site_url = $this->common->get_setting_value(2);
								$site_email = $this->common->get_setting_value(5);
					
								// user Mail
								$to = $email;
								$mail = $this->common->get_email_byid(11);
			
								$subject = $mail[0]['subject'];
								$mailformat = $mail[0]['mailformat'];
								
								$this->load->library('email');
								$this->email->from($site_email,$site_name);
								$this->email->to($to);
								$this->email->subject($subject);
								
								$com = $this->complaints->get_company_byid($companyid);
								if(count($com)>0)
								{
									$link = "<a href='".site_url('complaint/viewcompany/'.$com[0]['companyseokeyword'])."' title='visit business page' target='_blank'>".site_url('complaint/viewcompany/'.$com[0]['companyseokeyword'])."</a>";
								}
								else
								{
									$link = "";
								}
								$mail_body = str_replace("%link%",ucfirst($link),str_replace("%companyname%",ucfirst($name),str_replace("%email%",$email,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat)))))));
								
								$this->email->message($mail_body);
								$this->email->send();
								
								//$this->session->set_flashdata('success', 'Business added successfully. enter details to claim your business');
							
								
								$site_name = $this->common->get_setting_value(1);
								$site_url = $this->common->get_setting_value(2);
								$site_email = $this->common->get_setting_value(5);
					
								// Admin Mail
								$to = $site_email;
								$mail = $this->common->get_email_byid(10);
			
								$subject = $mail[0]['subject'];
								$mailformat = $mail[0]['mailformat'];
								
								$this->load->library('email');
								$this->email->from($site_email,$site_name);
								$this->email->to($to);
								$this->email->subject($subject);
							
								$mail_body = str_replace("%name%",ucfirst($name),str_replace("%email%",$email,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat))))));
								
								$this->email->message($mail_body);
								$this->email->send();
								
								$this->session->set_flashdata('success', 'Business added successfully. enter details to claim your business');
								redirect('solution/claim/'.$companyid, 'refresh');
								//redirect('businessdirectory', 'refresh');
							
							
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
								redirect('businessdirectory/add', 'refresh');
							}
						}
						else
						{
								$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
								redirect('businessdirectory/add', 'refresh');
						}
					}
					else
					{	//Error in upload
						$this->session->set_flashdata('error', "Error while uploading Image.<br/>&nbsp;&nbsp;&nbsp;<b>'Valid File Type ( gif, jpg, jpeg, png, bmp )'&nbsp;&nbsp;&nbsp;'Max Size : ".$config['max_size']." KB'&nbsp;&nbsp;&nbsp;'Max Width : ".$config['max_width']."'&nbsp;&nbsp;&nbsp;'Max Height : ".$config['max_height']."'</b>");
						redirect('businessdirectory/add','refresh');
					}
				
			

	}
		else
		{
			rediret('businessdirectory/add','refresh');
		}	
	}
	
	//Function to Check E-mail is already exists
	public function fieldcheck()
	{
		if( $this->input->is_ajax_request() && ( $this->input->post('email') || $this->input->post('companyname') ))
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
			
			if( $this->input->post('companyname') )
			{
				$field = 'company';
				$fieldvalue = strtolower(addslashes($this->input->post('companyname')));
			}
			
			if($field)
			{
				//Loading Model File
	  			$this->load->model('complaints');
				//Addingg Result to view parameter
				$result = $this->complaints->chkfield1($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('businessdirectory', 'refresh');
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */