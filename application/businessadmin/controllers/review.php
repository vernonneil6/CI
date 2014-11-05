<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller {

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
		
		//Loading Helper File
	  	$this->load->helper('form');
			
		//Loading Model File
	 	$this->load->model('reviews');
		$this->load->model('companys');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Business Reviews';
		$this->data['section_title'] = 'Business Reviews';
		
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
		
		//Load heading and save in variable
		$this->data['heading'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata['siteid'];
			//Addingg Setting Result to variable
			$this->data['reviews'] = $this->reviews->get_all_reviews($companyid,$siteid,$limit,$offset);
			//echo "<pre>";
			//print_r($this->data['reviews']);
			//die();
			
			$this->paging['base_url'] = site_url("review/index/");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = $this->reviews->get_all_reviews_count($companyid,$siteid);
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('review',$this->data);
	  	}
	}

	public function import_csv()
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		if( $this->session->userdata['youg_admin'] )
	  	{
			if($this->input->post('btnupload'))
			{
				//Loading Model File
	  	  		$config['upload_path'] = '../uploads/reviewcsv/';
				$config['allowed_types'] = 'csv';
				//$config['max_size'] = '5000';
				//$config['file_name'] = $_FILES['csvfile']['name'];
			
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('csvfile')) 
				{
					//Error in upload
					$this->session->set_flashdata('error', "Error while uploading file. 'Valid File Type ( csv )");
					redirect('review','refresh');
				}
				else
				 {
								$file_info = $this->upload->data();
								$filePath = "../uploads/reviewcsv/";
								$file = $filePath.$file_info['file_name'];
								$row = 0;
								$reviews = array();
								$handle = fopen($file, "r");
			
								$fcontents = file('../uploads/reviewcsv/'.$file_info['file_name']);
								//echo "<pre>";
								//print_r($fcontents);
								//die();
								$companyid = $this->session->userdata['youg_admin']['id'];
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

														$title = $arr[0];
														$username = $arr[1];
														$rating = $arr[2];
														$review = $arr[3];
														$date = $arr[4];
														
							$siteid = $this->session->userdata('siteid');	
							if($title!='' && $username!='' && $rating!='' && $review!='' && $date!=''){
							if( $this->reviews->insert($companyid,$username,$rating,$review,$date,$siteid,$title) )
												{
													if(file_exists($file))
													{
														unlink($file);
													}
													$this->session->set_flashdata('success', 'reviews inserted successfully.');
												 }
												else
												{
													$this->session->set_flashdata('error', 'There is error in inserting reviews. Try later!');
												 }
											}
									}
									$this->session->set_flashdata('success', 'reviews inserted successfully.');
									redirect('review','refresh');
											

											
								 }
								else
								{
								redirect('review','refresh');
								}
						}
				}
			else
			{
				redirect('review','refresh');
			}
		}
	}

	public function download()
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		$this->load->helper('download');
		$site = site_url();			
		$url = explode("/businessadmin",$site);
		$path = $url[0];
		$file = file_get_contents($path.'/review.csv');
		$name = 'reviewexample.csv';
		force_download($name, $file); 
	}
	
	public function reviews()
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	redirect('adminlogin', 'refresh');
		}
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata('siteid');	
			//Addingg Setting Result to variable
			$this->data['reviews'] = $this->reviews->get_all_mainreviews($companyid,$siteid,$limit,$offset);
			//echo "<pre>";
			//print_r($this->data['reviews']);
			//die();
			
			$this->paging['base_url'] = site_url("review/reviews/index");
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = count($this->reviews->get_all_mainreviews($companyid,$siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('review',$this->data);
	  	}
	}
	
	
	public function request($reviewid='',$userid='')
	{
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
		   	//If no session, redirect to login page
			//echo site_url();die();
	  	  	redirect('adminlogin', 'refresh');
		}
		
		if($reviewid!='' && $reviewid!=0 && $userid!='' && $userid!=0)
		 {
			if( $this->session->userdata['youg_admin'] )
	  		 {
					$rid = base64_encode($reviewid);
									
					$companyid = $this->session->userdata['youg_admin']['id'];
				
					$company=$this->companys->get_company_byid($companyid);
					$user=$this->settings->get_user_byid($userid);
					$review=$this->reviews->get_mainreview_byid($reviewid);
					
					$site_name = $this->settings->get_setting_value(1);
					$site_url  = $this->settings->get_setting_value(2);
					$site_mail = $this->settings->get_setting_value(5);
					
					//Loading E-mail library
					$this->load->library('email');
					
					//Loading E-mail config file
					$this->config->load('email',TRUE);
					
					//Payment mail for Admin
					$from = $company[0]['email'];
					$subject = 'Review Removal Request for ' .$reviewid;
					$to = $user[0]['email'];
					
					$this->email->from($site_mail,$site_name);
					$this->email->to($to);
					$this->email->subject($subject);
				
					$mailbody = 
						'<html>
							<body>
							<table cellpadding="0" cellspacing="0" width="100%" border="0">
							<tr>
								<td>Hello '.ucwords($user[0]['firstname'].' '.$user[0]['lastname']).',</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td style="padding-left:50px;">
								You wrote a review about '.ucfirst($company[0]['company']).' on <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a>,<br/>
								'.ucfirst($company[0]['company']).' sent a request for Removing review ID ' .$reviewid.' Below are Details.
								</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td>
									<table cellpadding="0" cellspacing="0" width="100%" border="0">
									<tr><td colspan="3"><h4>Review Details</h4></td></tr>
									<tr>
										<td width="200">Review ID</td>
										<td>:</td>
										<td>'.$reviewid.'</td>
									</tr>
                                    <tr><td colspan="3">&nbsp;</td></tr>
                                    <tr>
										<td width="200">Review</td>
										<td>:</td>
										<td>'.$review[0]['comment'].'</td>
									</tr>
                                    <tr><td colspan="3">&nbsp;</td></tr>
                                    <tr>
										<td width="200">reviewdate</td>
										<td>:</td>
										<td>'.date('M d Y H:i:s',strtotime($review[0]['reviewdate'])).'</td>
									</tr>
									<tr><td colspan="3">&nbsp;</td></tr>
									</table>
                                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
									<tr><td colspan="3"><h4>Please give your feedback by clicking below option</h4></td></tr>
                                    <tr><td colspan="3">&nbsp;</td></tr>
                                    <tr><td colspan="3"><a href="'.site_url('review/feedback/'.$rid.'/'.$userid.'/'.'agree').'" title="I AGREE TO THE REMOVAL REQUEST">I AGREE TO THE REMOVAL REQUEST</a>&nbsp;
                                        <a href="'.site_url('review/feedback/'.$rid.'/'.$userid.'/'.'disagree').'" title="I DECLINE THE REMOVAL REQUEST">I DECLINE THE REMOVAL REQUEST</a>
                                        </td>
									</tr>
									</table>
								</td>
							</tr>
							<tr><td><br/><br/></td></tr>
							<tr>
								<td>
									Kind Regards,<br/>
									'.$site_name.'
								</td>
							</tr>
							</table>
							</body>
						</html>';
					 
					/*echo"<pre>";
					print_r($mailbody);
					die();*/
				
					$this->email->message($mailbody);
					
					//Sending mail to Admin
					if($this->email->send())
			 		{
						$this->session->set_flashdata('success', 'Request for review removal has been sent successfully to user.');
						if($this->reviews->insert_review_status($companyid,$reviewid))
						{
							$id = $this->db->insert_id();
							if($this->reviews->update_checkdate($id,$companyid,$reviewid))
							{
								redirect('review/reviews', 'refresh');
							}
							else
							{
								//$this->session->set_flashdata('error', 'There is error in sending request. Try later!');
								redirect('review/reviews', 'refresh');				
							}
						}
						else
						{
								//$this->session->set_flashdata('error', 'There is error in sending request. Try later!');
								redirect('review/reviews', 'refresh');
						}
					}
					else
					{
								$this->session->set_flashdata('error', 'There is error in sending request. Try later!');
								redirect('review/reviews', 'refresh');
					}
					
					//Loading View File
				$this->load->view('review',$this->data);
	     	 }
			else
			{
				redirect('adminlogin','refresh');
			}
	     }
		 else
		 {
				redirect('review/reviews','refresh');
		 }
	}
		
		public function feedback($reviewid='',$userid='',$status='')
		{
			$rid = base64_decode($reviewid);
			$site_url  = $this->settings->get_setting_value(2);
			$clickstatus = $this->reviews->get_reviewstatus_by_reviewid($rid);
			
			if($reviewid!='' &&  $userid!='')
		 	{
				$date1 = date("Y-m-d H:i:s");
				$date2 = $clickstatus[0]['checkdate'];
				$diff = abs(strtotime($date2) - strtotime($date1));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						
				if($days <=5)			
				{
					if($clickstatus[0]['click']=="No")
					{
		 					if($status=='agree')
							{
								if($this->reviews->disable_review_byid($rid))
								{
									redirect($site_url.'welcome/feedback', 'refresh');
								}
							}
							if($status=='disagree')
							{
	
								if($this->reviews->enable_review_byid($rid))
								{
									redirect($site_url.'welcome/feedback', 'refresh');
								}
							}
					}
					else
					{
						redirect($site_url, 'refresh');
					}
				}
				else
				{
					redirect($site_url, 'refresh');
				}
			
			}
			else
			{
				redirect($site_url,'refresh');
			}
		}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */