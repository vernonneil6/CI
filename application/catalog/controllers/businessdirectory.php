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
		
		
		if (preg_match("/\writerbin\b/i", $domain, $regs)) 
		{
			$site = 'yougotrated.writerbin.com';
		}
		else if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
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
		
		//Loading Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		if( $this->uri->segment(1) == 'businessdirectory' && ( $this->uri->segment(2) == 'search' || $this->uri->segment(2) == 'searchkey' ) )
		{
			$this->data['title'] = 'Search Companies';
			$this->data['keywords'] = 'Your search Result,Search Business In Yougotrated Directory';
			$this->data['description'] = 'Search Business In Yougotrated Directory';
		}
		elseif($this->uri->segment(1) == 'businessdirectory' &&  $this->uri->segment(2) == 'add' )
		{
			
			$this->data['title'] = 'Add A New Business';
			$this->data['keywords'] = 'ADD BUSINESS In YGR';
			$this->data['description'] = 'Becoming a YGR Elite member gives you benefit';
		}
		elseif($this->uri->segment(1) == 'businessdirectory' &&  $this->uri->segment(2) == 'category' )
		{
			
				$this->data['title'] = 'Business Directory';
			$this->data['keywords'] = 'SEARCH RESULTS FOR '.$this->uri->segment(3).' Categories In YGR';
			$this->data['description'] = $this->uri->segment(3).' Bussiness Directory List In YGR';
		}
		else
		{
			$this->data['title'] = 'Business Directory';
			$this->data['keywords'] = 'Add Business In YGR,Search Business In YGR,Submit a new Business,Business Directory';
			$this->data['description'] = 'Add new Bussiness and Search a Existing Bussiness In YGR Directory';
		}
		
		$this->data['section_title'] = 'Business Directory';

		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		  //Loading View File
		  $this->load->view('businessdirectory/index',$this->data);
	}
	
	public function add()
	{

		if($this->input->post('email'))
		{
				$name = $this->input->post('name');			
				$streetaddress = $this->input->post('streetaddress');
				$city = $this->input->post('city');
				$state = $this->input->post('state');
				$country = $this->input->post('country');								
				$streetaddress1 = $this->input->post('streetaddress1');
				$city1 = $this->input->post('city1');
				$state1 = $this->input->post('state1');
				$country1 = $this->input->post('country1');
				$zip1 = $this->input->post('zip1');								
				$zip = $this->input->post('zip');
				$phone = $this->input->post('phone');
				$email = $this->input->post('email');
				$website = $this->input->post('website');
				$cat = $this->input->post('cat');
				if($cat!='')
				{
					$category=implode(',',$cat);
				}
				else
				{
					$category='1';
				}
				$cname = $this->input->post('cname');
				$cphone = $this->input->post('cphone');
				$cemail = $this->input->post('cemail');
				$discountcode = $this->input->post('discountcode');
				$company = $this->complaints->get_company_by_emailid($email);
				if(count($company)>0){
					$this->session->set_flashdata('error','This company email address is already exists. Try later!');
					redirect('businessdirectory/add', 'refresh');
				}else{
					$email1 = $this->complaints->chkfield1(0,'email',$email);
					$name1 = $this->complaints->chkfield1(0,'company',$name);
					if($email1=='new' && $name1=='new'){
							if( $this->complaints->insert_businesses($name,$streetaddress,$city,$state,$country,$zip,$phone,$email,$website,'','',$category,'' ))
							{
								
								$companyid = $this->db->insert_id();							
														
								//$this->complaints->insert_contactdetails($companyid,$cname,$cphone,$cemail);
								$this->db->where('id', $companyid);
								$this->db->update('company',array('contactname' 		=> $cname,
																	  'contactphonenumber' 	=> $cphone,
																	  'contactemail' 		=> $cemail));
								
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
									$this->email->from('sales@yougotrated.com',$site_name);
									$this->email->to($to);
									$this->email->cc('sales@yougotrated.com');
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
									
									echo '<script>window.location = "http://business.yougotrated.com/"</script>';
									
								}else{
									$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
									redirect('businessdirectory/add', 'refresh');
								}
							}else{
									$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
									redirect('businessdirectory/add', 'refresh');
							}						
							redirect('businessdirectory/add', 'refresh');
					}else{
						if($email1=='old'){
							$this->session->set_flashdata('error', 'This company email address is already exists. Try later!');
							redirect('businessdirectory/add', 'refresh');	
						}
						if($name1=='old'){
							$this->session->set_flashdata('error', 'This company name is already exists. Try later!');
							redirect('businessdirectory/add', 'refresh');
						}
					}
				} 
			
		}
		
		$countrylist = $this->common->get_all_countrys();
		
		if( count($countrylist) > 0 ){
			$this->data['selcon'][''] = '--Select Country--';			
			for($c=0;$c<count($countrylist);$c++){
				$this->data['selcon'][($countrylist[$c]['country_id'])] = ucfirst($countrylist[$c]['name']);
			}
		}else{
			$this->data['selcon'][''] = '--Select Country--';
		}
		
		$siteid = $this->session->userdata('siteid');
		$this->data['categories'] = $this->common->get_all_categorys($siteid);
		$this->load->view('businessdirectory/add',$this->data);
		
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
			
			//$this->load->view('businessdirectory',$this->data);
			$this->load->view('businessdirectory/search_result',$this->data);
				
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
				$email = strtolower(($this->input->post('email')));
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
				$a = explode('.',$_FILES['logo']['name']);
				$ex = end($a);
				$main = str_replace('.'.$ex,'',$_FILES['logo']['name']);
				$config['file_name'] = $main.date('YmdHis');
					
				// Initialize the new config
				$this->upload->initialize($config);
				//Uploading Image
				$this->upload->do_upload('logo');
					
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
	
	public function category($catname='',$catid='')
	{
			$this->data['catname']=$catname;
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			//Addingg Setting Result to variable
			$this->data['companies'] = $this->common->search_company_catid($catid,$limit,$offset);
			$this->paging['base_url'] = site_url("businessdirectory/category/".$catname.'/'.$catid);
			$this->paging['uri_segment'] = 5;
			$this->paging['total_rows'] = $this->common->search_company_catid_count($catid);
			$this->pagination->initialize($this->paging);
			
			//$this->load->view('businessdirectory',$this->data);
			$this->load->view('businessdirectory/search_result_cat',$this->data);
				
		}
		
	public function map($address='')
	{
			$this->data['address']=$address;
			$this->load->view('businessdirectory/map',$this->data);
			
	}
	
	function emailcheck()
	{
		$data = $this->complaints->emailvalid($this->input->post('email'));
		$email = array();
		if($data == 1)
		{
			$email['status'] = "1";
			$email['email'] = "This company email address is already exists.";
            
		}
		else
		{
			$email['status'] = "0";
		}
		echo json_encode($email);
	}
	
	function namecheck()
	{
		$data = $this->complaints->namevalid($this->input->post('name'));
		$name = array();
		if($data == 1)
		{
			$name['status'] = "1";
			$name['name'] = "This company name is already exists.";
            
		}
		else
		{
			$name['status'] = "0";
		}
		echo json_encode($name);
	}
	
	function ajaxRequest(){
		
		/*get All States*/
		
		if($this->input->post('type')=='getAllStates')  {
		
			if( $this->input->is_ajax_request() && ( $this->input->post('cid') ) )
			{
				$selcatid = (($this->input->post('cid')));
				$state = (($this->input->post('state')));
				$stateval = (($this->input->post('stateval')));
				$state = ($state!='') ? $state : 'state' ;
				if( $selcatid!='' || $selcatid!='0' )
				{
					$subcats = $this->common->get_all_states_by_cid($selcatid);
					//echo "<pre>";
					//print_r($subcats);
					if( count($subcats) > 0 )
						{
						
								if($stateval=='')
								{
									$this->data['selstates'][''] = '--Select--';
								
									for($c=0;$c<count($subcats);$c++)
									{
									
										$this->data['selstates'][($subcats[$c]['name'])] = ucfirst($subcats[$c]['name']);
									
									}
								}
								else
								{
									for($c=0;$c<count($subcats);$c++)
									{
										if($stateval==$subcats[$c]['name'])
										{
											echo "<script>dropcheck('".$subcats[$c]['name']."')</script>";
										}
										
										$this->data['selstates'][''] = '--Select--';
										$this->data['selstates'][($subcats[$c]['name'])] = ucfirst($subcats[$c]['name']);
									
									}
								}
								
							
							
						}
						else
						{
							$this->data['selstates'][''] = '--Select--';
						}
						
						//echo "<pre>";
						//print_r($this->data['selstates']);
						//die();
						$js="onchange='dropdownss()' id='".$state."' class='seldrop'";
						$data='';
						$data="";
						echo form_dropdown($state,$this->data['selstates'],'',$js);
						$data="";
						echo $data;   
						return $data;
				}
			}
			else
			{ 
				redirect('solution', 'refresh');
			}
		}		
	}
	
	function google_recapcha(){
		$captcha = $_REQUEST['response'];
		$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lcj5QETAAAAAPty66XTLlKG1ERLbMkLkMI-Yguf&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		$res = json_decode($response, TRUE);
		if(isset($res['success'])){
			echo '1';
		} else {
			echo '0';
		}
		die;
		//return $response;		
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
