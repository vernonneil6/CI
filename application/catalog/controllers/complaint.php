<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Complaint extends CI_Controller {

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
	* @see http://codeigniter.com/complaint_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
				
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
		
		//Loading Model File
	 	$this->load->model('complaints');
		$this->load->model('users');
		$this->load->model('reviews');
		
		$this->data['tag_line'] = $this->common->get_homesetting_value(8);
		$this->data['search_keywords'] = $this->complaints->get_all_searchs($siteid);
		$this->data['home_categorys'] = $this->common->get_home_category();
		
		
		$this->data['site_name'] = $this->common->get_sitename_byid($siteid);
		$this->data['site_url'] = $this->common->get_siteurl_byid($siteid);
		$this->data['searchword']='';	
		
		
		$this->data['topads']= $this->common->get_all_ads('top','complaint',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','complaint',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','complaint',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','complaint',$siteid);
		
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
			
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);

		if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'weektrending' )
		{
   		$this->data['title'] = 'Week trending complaints';
   		$this->data['keywords'] ='';
   		$this->data['description'] = '';
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'viewcomment' )
		{
   		$this->data['title'] = 'Comments on complaints';
   		$this->data['keywords'] ='';
   		$this->data['description'] = '';
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'keysearchresult' || $this->uri->segment(2) == 'search' )
		{
   		$this->data['title'] = 'Search complaints';
   		$this->data['keywords'] ='';
   		$this->data['description'] = '';
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'viewuser' )
		{
   		
   		$companyid=$this->uri->segment(3);
   		$userid=$this->uri->segment(4);
   		$valuesss= $this->users->get_user_byid($userid);
   		$this->data['title'] = $valuesss[0]['username']." user's Profile";
   		$this->data['keywords'] = "User Profile In YGR";
   		$this->data['description'] = $valuesss[0]['username']." User Complaints";
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'claimbusiness' )
		{
   		$this->data['title'] = 'Claim Business';
   		$this->data['keywords'] ='';
   		$this->data['description'] = '';
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'add' )
		{
   		$this->data['keywords'] = 'Bussiness Dispute In YGR';
		$this->data['description'] = 'Provide Details For Dispute';
		$this->data['title'] = 'Complaints';
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'advfilter' )
		{
   		$this->data['title'] = 'Advance Filter to search complaints';
   		$this->data['keywords'] ='Filter Complaints In YGR , Search Complaints In YGR';
   		$this->data['description'] = 'Filter Complaints From date range & Type';
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'filter' )
		{
   		$this->data['title'] = 'Advance Filter to search complaints';
   		$this->data['keywords'] ='Filter Complaints,search Complaints';
   		$this->data['description'] = 'Filter Complaints From date range & Type';
		}
		else if( $this->uri->segment(2)=='viewcompany'  && $this->uri->segment(3))
			{
					$company = $this->complaints->get_company_byseokeyword($this->uri->segment(3));
					if(count($company)>0)
					{
						$elitecompany = $this->complaints->get_eliteship_bycompanyid($company[0]['id']);
						
						if(	count($elitecompany)>0)
						{
						$this->data['keywords'] = $this->common->get_companyseosetting_value($company[0]['id'],"General Meta Tag Keywords");
						$this->data['description'] = $this->common->get_companyseosetting_value($company[0]['id'],"General Meta Tag Description");
						$this->data['title'] = $company[0]['company'].' '.implode(' ', array_slice(explode(' ', $company[0]['aboutus']), 0, 10));
						
						
						}
						else
								
						{
						$company= $this->complaints->get_company_byseokeyword($this->uri->segment(3));
			 	  	if(count($company)>0)
						{
								$this->data['title'] = $company[0]['company'].' '.'Complaints:YOUGOTRATED';
								$this->data['keywords'] = $this->uri->segment(3);
								$this->data['description'] = $company[0]['aboutus'];
						}
						else
						{
								$this->data['keywords'] = $this->common->get_seosetting_value(4);
								$this->data['description'] = $this->common->get_seosetting_value(5);
								$this->data['title'] = 'Complaints : YOUGOTRATED';
						}
					}
					}
				
					
			}
		else if( $this->uri->segment(2)=='browse'  && $this->uri->segment(3))	
			{
						$complaint= $this->complaints->get_complaint_byseokeyword($this->uri->segment(3));
						$companyid="";
						if(count($complaint) > 0) { $companyid=$complaint[0]['companyid']; }
						$companyname = $this->users->get_company_bysingleid($companyid);
						
					 	  		if(count($complaint)>0)
								{
									$this->data['title'] = $companyname['company'].' '.'Complaints:YOUGOTRATED';
									$this->data['keywords'] = $companyname['company'];
									$inputstring=$complaint[0]['detail'];
									$pieces = explode(" ", $inputstring);
									$first_part = implode(" ", array_splice($pieces, 0, 5));
									$other_part = implode(" ", array_splice($pieces, 5));
									
									$this->data['description'] = $first_part;
								}
								else
								{
									$this->data['keywords'] = 'Bussiness Dispute';
									$this->data['description'] = 'Provide Details For Dispute';
									$this->data['title'] = 'Complaints';
								}
				
			}
		
		else
		{
			//Meta Keywords and Description
		$this->data['keywords'] = 'Latest Complaints In YGR,Recent Complaints IN YGR';
		$this->data['description'] = 'Complaints about bussiness';
		$this->data['title'] = 'Complaints : YOUGOTRATED';
		}
		$this->data['section_title'] = 'Complaints : YOUGOTRATED';

		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		  $this->load->library('pagination');
		  $siteid = $this->session->userdata('siteid');
		    			
		  $limit = $this->paging['per_page'];
		  $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
		  
		  //Addingg Setting Result to variable
		  $this->data['complaints'] = $this->complaints->get_all_complaints($limit,$offset);
		  $this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  
		  $this->paging['base_url'] = site_url("complaint/index");
		  $this->paging['uri_segment'] = 3;
		  $this->paging['total_rows'] = count($this->complaints->get_all_complaints());
		  $this->pagination->initialize($this->paging);
          
		  //Loading View File
		  $this->load->view('complaint/index',$this->data);
	}
	
	public function weektrending()
	{
		  $this->load->library('pagination');
		    			
		  $limit = $this->paging['per_page'];
		  $offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
		  
		  	//Adding Setting Result to variable
			$this->data['complaints'] = $this->complaints->get_all_last_weekcomplaints($limit,$offset);
		  	
			$siteid = $this->session->userdata('siteid');
			$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  
		  $this->paging['base_url'] = site_url("complaint/weektrending/index");
		  $this->paging['uri_segment'] = 4;
		  $this->paging['total_rows'] = count($this->complaints->get_all_last_weekcomplaints_count());
		  $this->pagination->initialize($this->paging);
          
		 //Loading View File
		 $this->load->view('complaint/weektrending',$this->data);
	
	}
	
	public function browse($seokeyword='')
	{
			if( $seokeyword!='')
			{
			  	$this->data['complaints'] = $this->complaints->get_complaint_byseokeyword($seokeyword); 	  	
				if(count($this->data['complaints'])>0)
				{
					//get other complaints same for that company
					
					$this->data['othercomplaints'] = $this->complaints->get_complaint_bycompanyid($this->data['complaints'][0]['companyid'],$this->data['complaints'][0]['id']); 
					
					//Loading View File
					$this->load->view('complaint/browse',$this->data);
				}
				else
				{
					redirect('complaint','refresh');
				}
			}
				else
				{
					redirect('complaint','refresh');
				}
	}
	
	public function viewcomment($commentid='')
	{
		 	if( $commentid!='' && $commentid!=0 )
			{
				$this->data['comments'] = $this->reviews->get_review_byid($commentid); 	  	
				if(count($this->data['comments'])>0)
				{
					//Loading View File
		  		$this->load->view('complaint',$this->data);
				}
				else
				{
					redirect('complaint','refresh');
				}
			}
			else
				{
					redirect('complaint','refresh');
				}
	}

	public function keysearch($keyword='')
	{
		 if($keyword!='' || $keyword!=0)
		 {
		 		  $keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
				  $keyword = str_replace(' ','-',$keyword);
		  		//Loading View File
		  		redirect('complaint/keysearchresult/'.$keyword,'refresh');
			}
			else
			{	
					redirect('complaint','refresh');
			}
	}
	
	public function searchresult()
	{
			if($this->input->post('search'))
			{
				$keyword = $this->input->post('search');
				//$keyword = preg_replace('/[^a-zA-Z0-9\']/', '-',$keyword);
				$keyword = base64_encode($keyword);	
				//Loading View File
				redirect('complaint/search/'.$keyword,'refresh');
			}
			else
			{
				redirect('complaint','refresh');
			}
	}
	
	public function search($keyword='')
	{
	  	
		if($keyword!='') {
		
		$this->data['keywords1'] = $this->complaints->get_all_searchs($siteid);
		$this->data['keyword'] = base64_decode($keyword);
		
		$this->load->library('pagination');
		$siteid = $this->session->userdata('siteid');
		    			
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
    	$this->data['complaints'] = $this->complaints->search_complaint1($keyword,$limit,$offset); 	
		$this->paging['base_url'] = site_url("complaint/search/".$keyword);
		$this->paging['uri_segment'] = 4;
		$this->paging['total_rows'] = $this->complaints->search_complaint1_count($keyword);
		$this->pagination->initialize($this->paging);
		
		$this->load->view('topsearch',$this->data);
		
		}
		else
		{
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
			
		  
	}
	
	public function keysearchresult($keyword='')
	{
	  	$this->load->library('pagination');
			
		if($keyword!='') {
			
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		  
		$this->paging['base_url'] = site_url("complaint/keysearchresult/".$keyword."/index");
			
		$this->paging['uri_segment'] = 5;
		$keyword= str_replace('-', ' ', $keyword);
		$this->data['complaints'] = $this->complaints->search_complaint($keyword,$limit,$offset); 	
		$this->paging['total_rows'] = count($this->complaints->search_complaint($keyword));
		$this->pagination->initialize($this->paging);
		}
		else
		{
			$keyword= str_replace('-', ' ', $keyword);
			$this->data['complaints'] = $this->complaints->search_complaint($keyword); 	
		}
			$siteid = $this->session->userdata('siteid');
			$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
			$this->data['keyword'] = $keyword;

		  //Loading View File
		  $this->load->view('complaint/index',$this->data);
	}
		
	public function viewcompany($word='')
	{
			if($word!='')
			{
				redirect('company/'.$word.'/reviews/coupons/complaints','refresh');
			}
			else
			{
				redirect('complaint','refresh');
			}
			
			if( $word!='')
			{
				$this->data['company'] = $this->complaints->get_company_byseokeyword($word); 
				if(count($this->data['company'])>0) {
						
				//$this->data['company'] = $this->complaints->get_company_byid($companyid); 
		  		$this->data['complaints'] = $this->complaints->get_complaint_bycompanyid($this->data['company'][0]['id']);
				$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($this->data['company'][0]['id']);
				$this->data['coupons'] = $this->complaints->get_coupon_bycompanyid($this->data['company'][0]['id']);
				$this->data['gallerys'] = $this->complaints->get_gallery_bycompanyid($this->data['company'][0]['id']);
				$this->data['videos'] = $this->complaints->get_videos_bycompanyid($this->data['company'][0]['id']);
				$this->data['companysems'] = $this->complaints->get_companysem_bycompanyid($this->data['company'][0]['id']);
				$this->data['companyreviews'] = $this->complaints->get_companyreviews_bycompanyid($this->data['company'][0]['id']);
				
				$this->data['companypdfs'] = $this->complaints->get_companypdfs_bycompanyid($this->data['company'][0]['id']);
				
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						$this->load->view('complaint',$this->data);
					}
				else
					{
						redirect('complaint', 'refresh');
					}
				}
				else
				{
				redirect('complaint', 'refresh');
			}
			}
		else
			{
					redirect('complaint', 'refresh');
			}
	}

	public function viewuser($companyid='',$userid='')
	{
		 if( $companyid!='' && $userid!=0 )
			{
				$this->data['user'] = $this->users->get_user_byid($userid);
				$this->data['complaintbyuser'] = $this->complaints->get_complaint_byciduid($companyid,$userid);
				$this->data['company'] = $this->complaints->get_company_byid($companyid);
				
				$this->data['commentbyuser'] = $this->reviews->get_reviews_byciduid($companyid,$userid);
			
				//Loading View File
				if(count($this->data['user'])>0)
				{
						$this->load->view('complaint',$this->data);
				}
				else
				{
						redirect('complaint', 'refresh');
				}
			}
			else
			{
				redirect('complaint', 'refresh');
			}
	}

	public function claimbusiness($companyid='')
	{
		if( $companyid!='' && $companyid!=0 )
		{
			$this->data['company'] = $this->complaints->get_company_byid($companyid);
			
			//Loading View File
			if( count($this->data['company'])>0 )
			{
				$elite = $this->complaints->get_eliteship_bycompanyid($this->data['company'][0]['id']);
				
				if( count($elite)==0 )
				{
					$this->data['selcountry'] = array(
														''=>'---Select---',
														'US'=>'United States of America',
														'UK'=>'United Kingdom'
													);
					
					$this->data['selcardtype'] = array(
														''=>'---Select---',
														'American Express'=>'American Express',
														'Discover'=>'Discover',
														'MasterCard'=>'MasterCard',
														'Visa'=>'Visa'
													);
													
					$this->data['selexpmonth'][''] = '---Select---';
					for($i=1;$i<13;$i++)
					{
						$this->data['selexpmonth'][$i] = $i;
					}
					
					$this->data['selexpyear'][''] = '---Select---';
					for($j=date('Y');$j<(date('Y')+21);$j++)
					{
						$this->data['selexpyear'][$j] = $j;
					}
					
					$this->load->view('complaint',$this->data);
				}
				else
				{
					$this->session->set_flashdata('error', 'This business <b>'.$this->data['company'][0]['company'].'</b> is already claimed.');
					redirect('complaint', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'No Company Detail found. Try later!');
				redirect('complaint', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'No Company Detail found. Try later!');
			redirect('complaint', 'refresh');
		}
	}
	
	public function update_claim($disc='')
	{
		if($_GET)
		{
			if($_GET['st']=='Completed')
			{
				$tx  = $_GET['tx'];
				$amt = $_GET['amt'];
				$companyid  = $_GET['item_number'];
				$sig = $_GET['sig'];
				$time = $this->common->get_setting_value(18);
				$expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
				if( $this->complaints->insert_subscription($companyid,$amt,$tx,$expires,$sig))
				{
					$company = $this->complaints->get_company_byid($companyid);
					if( count($company)>0 )
					{
						$password = uniqid();
						
						$video = $this->complaints->get_videos_bycompanyid($companyid);
						$sem = $this->complaints->get_companysem_bycompanyid($companyid);
						$seo = $this->complaints->get_companyseo_bycompanyid($companyid);
						
						$this->complaints->set_password($companyid,$password);
						if(count($video)==0 && count($sem)==0 && count($seo)==0 ) {
							for($i=1;$i<17;$i++) {
$this->complaints->set_sem($companyid,"Facebook","http://www.facebook.com","ade2c15ab85aef450fb2f6e53e8cb825.png","ade2c15ab85aef450fb2f6e53e8cb825.png",$i,'f');
$this->complaints->set_sem($companyid,"twitter","http://www.twitter.com","51e28dd5af6d2bb51b518b47ae717f1a.png","51e28dd5af6d2bb51b518b47ae717f1a.png",$i,'t');
$this->complaints->set_sem($companyid,"Linkedin","http://www.linkedin.com","ab5b4de4c8fa16f822635c942aafdfb5.jpg","ab5b4de4c8fa16f822635c942aafdfb5.jpg",$i,'l');
$this->complaints->set_sem($companyid,"Google","http://www.google.com","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg",$i,'g');
$this->complaints->set_sem($companyid,"pintrest","http://www.pintrest.com","1519f4062fa76260346bfc61665e579d.jpeg","1519f4062fa76260346bfc61665e579d.jpeg",$i,'p');
$this->complaints->set_sem($companyid,"amazon","http://www.amazon.in","","",$i,'a');
$this->complaints->set_sem($companyid,"ebay","http://www.ebay.in","","",$i,'e');
$this->complaints->set_sem($companyid,"youtube","http://www.youtube.com","","",$i,'y');

						


$this->complaints->set_seo($companyid,"Google Analytic","Google Analytic",$i);
$this->complaints->set_seo($companyid,"Google Webmaster","Google Webmaster",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description",$i);


$this->complaints->set_video($companyid,"video1","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i,'video1');
$this->complaints->set_video($companyid,"video2","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i,'video2');

						}}
						
						
						$timings = $this->complaints->get_company_timings($companyid);
						if(count($timings)==0) {
						$this->complaints->set_timing(1,$companyid,"monday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"tuesday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"wednesday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"thursday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"friday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"saturday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"sunday","No","09:00:00","21:00:00");
						}
								
								//Inserting Elite Membership Transaction Details for Company
							$transaction = $this->complaints->add_transaction($companyid,$_GET['amt'],$_GET['cc'],$_GET['tx'],date('Y-m-d H:i:s'));
							if($disc!='')
					{
						$this->complaints->insert_discountcode($companyid,$disc);
					}
								
							$siteid = $this->session->userdata('siteid');
							$page = $this->common->get_pages_by_id(12,$siteid);
		
							if( count($page) > 0 )
							{
								$institle = stripslashes($page[0]['title']);
								$inssteps = nl2br(stripslashes($page[0]['pagecontent']));
							}
							
							$site_name = $this->common->get_setting_value(1);
							$site_url = $this->common->get_setting_value(2);
							$site_mail = $this->common->get_setting_value(5);
								
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
																	<td>'.$_GET['cc'].' '.$_GET['amt'].'</td>
																</tr>
																<tr>
																	<td>Transacion ID</td>
																	<td>:</td>
																	<td><b>'.$_GET['tx'].'</b></td>
																</tr>
																</table>
															</td>
														</tr>
														</table>');
								//Sending mail to admin
								$this->email->send();
								
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
          <td>'.$_GET['cc'].' '.$_GET['amt'].'</td>
        </tr>
        <tr>
          <td>Transacion ID</td>
          <td>:</td>
          <td><b>'.$_GET["tx"].'</b></td>
        </tr>
        <tr>
          <td colspan="3"><h3>Widget</h3></td>
        </tr>
        <tr>
          <td colspan="3">&lt;iframe src=&quot;'.site_url("widget/business/".$companyid).'&quot; style=&quot;border:none;&quot;&gt;&lt;/iframe&gt; </td>
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
								$this->session->set_flashdata('success','Payment is made and your business is claimed successfully.');
								redirect('complaint', 'refresh');
							}
					else
					{
						redirect('complaint', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error',"There was error during payment. Please try later!");
					redirect('complaint', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'You have not completed payment process');
				redirect('complaint', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('error', 'No Company Detail found. Try later!');
			redirect('complaint', 'refresh');
		}
	}
	
	public function advfilter()
	{
			$siteid = $this->session->userdata('siteid');
			$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  	//Loading View File
		  	$this->load->view('complaint/advfilter',$this->data);
	}
	
	public function filter()
	{
		
		if($this->input->post('fsubdate'))
		  {
				$type = $this->input->post('type');
				
				$frmsubdate = trim($this->input->post('fsubdate'));
				$tosubdate 	= trim($this->input->post('tsubdate'));
				$frmoccdate = trim($this->input->post('foccdate'));
				$tooccdate 	= trim($this->input->post('toccdate'));
			
			 	$this->data['complaints']=$this->complaints->search_filter($type,$frmsubdate,$tosubdate,$frmoccdate,$tooccdate);
		
				//echo "<pre>";
				//print_r($this->data['complaints']);
				//die();
				$siteid = $this->session->userdata('siteid');
				$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  
					//Loading View File
			$this->load->view('complaint/advfilter',$this->data);
			}
			else
			{
				redirect('complaint/advfilter','refresh');
			}
		}	
		public function directions($destination)
		{
			if($destination!='')
			{
				$this->data['destination'] = $destination;
				$this->load->view('map',$this->data);
			}
			else
			{
				redirect('complaint','refresh');
			}
		}
	
	
	public function update_claimnew()
	{
		if($_REQUEST)
		{
				$tx  = $_REQUEST['auth'];
				$amt = $_REQUEST['amount3'];
				$companyid  = $_REQUEST['item_number'];
				$sig = $_REQUEST['subscr_id'];
				$subscriptionId = $_REQUEST['subscr_id'];
				$payer_id = $_REQUEST['payer_id'];
				
				$time = $this->common->get_setting_value(18);
				$expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
				$paymentmethod = 'paypal';
				if( $this->complaints->insert_subscription($companyid,$amt,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId))
				{
					$company = $this->complaints->get_company_byid($companyid);
					if( count($company)>0 )
					{
						$password = uniqid();
						
						$video = $this->complaints->get_videos_bycompanyid($companyid);
						$sem = $this->complaints->get_companysem_bycompanyid($companyid);
						$seo = $this->complaints->get_companyseo_bycompanyid($companyid);
						
						
						$this->complaints->set_password($companyid,$password);
						if(count($video)==0 && count($sem)==0 && count($seo)==0 ) {
							for($i=1;$i<17;$i++) {
$this->complaints->set_sem($companyid,"Facebook","http://www.facebook.com","ade2c15ab85aef450fb2f6e53e8cb825.png","ade2c15ab85aef450fb2f6e53e8cb825.png",$i,'f');
$this->complaints->set_sem($companyid,"twitter","http://www.twitter.com","51e28dd5af6d2bb51b518b47ae717f1a.png","51e28dd5af6d2bb51b518b47ae717f1a.png",$i,'t');
$this->complaints->set_sem($companyid,"Linkedin","http://www.linkedin.com","ab5b4de4c8fa16f822635c942aafdfb5.jpg","ab5b4de4c8fa16f822635c942aafdfb5.jpg",$i,'l');
$this->complaints->set_sem($companyid,"Google","http://www.google.com","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg",$i,'g');
$this->complaints->set_sem($companyid,"pintrest","http://www.pintrest.com","1519f4062fa76260346bfc61665e579d.jpeg","1519f4062fa76260346bfc61665e579d.jpeg",$i,'p');
$this->complaints->set_sem($companyid,"amazon","http://www.amazon.in","","",$i,'a');
$this->complaints->set_sem($companyid,"ebay","http://www.ebay.in","","",$i,'e');
$this->complaints->set_sem($companyid,"youtube","http://www.youtube.com","","",$i,'y');
						


$this->complaints->set_seo($companyid,"Google Analytic","Google Analytic",$i);
$this->complaints->set_seo($companyid,"Google Webmaster","Google Webmaster",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description",$i);


$this->complaints->set_video($companyid,"video1","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i,'video1');
$this->complaints->set_video($companyid,"video2","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i,'video2');

						}}
						
						$timings = $this->complaints->get_company_timings($companyid);
						if(count($timings)==0) {
						$this->complaints->set_timing(1,$companyid,"monday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"tuesday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"wednesday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"thursday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"friday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"saturday","No","09:00:00","21:00:00");
						$this->complaints->set_timing(1,$companyid,"sunday","No","09:00:00","21:00:00");
						}
						
								
								//Inserting Elite Membership Transaction Details for Company
							$transaction = $this->complaints->add_transaction($companyid,$_REQUEST['amount3'],$_REQUEST['mc_currency'],$_REQUEST['auth'],date('Y-m-d H:i:s'));
							$websites = $this->complaints->get_all_websites();
								
							$siteid = $this->session->userdata('siteid');
							$page = $this->common->get_pages_by_id(12,$siteid);
		
							if( count($page) > 0 )
							{
								$institle = stripslashes($page[0]['title']);
								$inssteps = nl2br(($page[0]['pagecontent']));
							}
							
							$site_name = $this->common->get_setting_value(1);
							$site_url = $this->common->get_setting_value(2);
							$site_mail = $this->common->get_setting_value(5);
								
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
																	<td>'.$_REQUEST['mc_currency'].' '.$_REQUEST['amount3'].'</td>
																</tr>
																<tr>
																	<td>Transacion ID</td>
																	<td>:</td>
																	<td><b>'.$_REQUEST['auth'].'</b></td>
																</tr>
																</table>
															</td>
														</tr>
														</table>');
								//Sending mail to admin
								$this->email->send();
								
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
          <td>'.$_REQUEST['mc_currency'].' '.$_REQUEST['amount3'].'</td>
        </tr>
        <tr>
          <td>Transacion ID</td>
          <td>:</td>
          <td><b>'.$_REQUEST["auth"].'</b></td>
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
								$this->session->set_flashdata('success','Payment is made and your business is claimed successfully.');
								redirect('complaint', 'refresh');
							}
					else
					{
						redirect('complaint', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error',"There was error during payment. Please try later!");
					redirect('complaint', 'refresh');
				}
			
			
		}
		else
			{
				$this->session->set_flashdata('error', 'You have not completed payment process');
				redirect('complaint', 'refresh');
			}
		
	
	}

	public function unsubscribe()
	{
		if($_REQUEST)
		{
			$this->complaints->insert_test($_REQUEST['txn_type']);
			
			if($_REQUEST['txn_type']=='subscr_cancel')
			{
				$this->complaints->disable_elitemeber_byid($_REQUEST['item_number']);
				$this->complaints->insert_test($_REQUEST['txn_type']);
			}
		}
		
	}

	public function get_company_names(){		
		if($_POST['keyword']){
			$company_names = $this->common->get_company_list($_POST['keyword']);	
			foreach ($company_names as $company_name) {				
			   $comp_name =  str_replace('"','',$company_name['company']);
			    $comp_name =  str_replace("'",'',$comp_name);
			    echo '<li onclick="set_item(\''.str_replace("'", "\'", $comp_name).'\',\''.$company_name['id'].'\')")">'.$comp_name.'</li>';
			}
		}
	}
	public function add($id = '')
	{
		
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$this->session->set_flashdata('error', 'Please login to continue!');
			$this->session->set_userdata('last_url','complaint/add/'.$id);
			redirect('login','refresh');
		}
			
		$elitemem_status = $this->common->get_eliteship_bycompanyid($id);
		
		if(count($elitemem_status)==0)
		{
			$this->data['cmpyid']=$id;
			$this->load->view('addcomplaint_new',$this->data);
		}
		else
		{
			$check=$this->dispute_loadcmpnydata($id);	
			return $check;
		}
	}
	public function dispute()
	{
		
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$cmid=$this->uri->segment(3, 0);
			$this->session->set_flashdata('error', 'Please login to continue!');
		 	$this->session->set_userdata('last_url','complaint/dispute/'.$cmid);
		    
		}
		$cmid=$this->uri->segment(3, 0);
		$check=$this->dispute_loadcmpnydata($cmid);	
		return $check;
		
	}
	
	public function dispute_loadcmpnydata($cmid)
	{
	   
        $datas= $this->complaints->retrieve_company($cmid);
        $this->data['companyid']=$cmid;
        $this->data['companys']=$datas['company'];
        $this->data['emails']=$datas['contactemail'];
        
	   
	$this->load->view('complaint_dispute',$this->data); 
	}
	
	public function dispute_insert()
	{
		 
		if($this->input->post('mysubmit'))
	    {   
			$site_name = $this->common->get_setting_value(1);
			$site_url = $this->common->get_setting_value(2);
			$site_mail = $this->common->get_setting_value(5);
			
			$companyname=$this->input->post('companyname');
			$companyid=$this->input->post('companyid');
			$companyemail=$this->input->post('companyemail');
			
			$userid=$this->input->post('userid');
			$username=$this->input->post('username');
			$useremail=$this->input->post('useremail');
			
			$dispute=$this->input->post('dispute'); 
			$status=$this->input->post('status'); 
			$ondate=$this->input->post('ondate'); 
			$msglink=$this->input->post('msglink'); 
			$transactionid=$this->input->post('transactionid');
			$transactionamt=$this->input->post('transactionamt');
			$transactiondate=$this->input->post('transactiondate');
			$reasondispute=$this->input->post('reasondispute');
			$merchantresolution=$this->input->post('merchantresolution');
			
			
	       $lastid=$this->complaints->insert_dispute($companyname,$companyid,$companyemail,$userid,$username,$useremail,$status,$ondate,$msglink,$transactionid,$transactionamt,$transactiondate,$reasondispute,$merchantresolution);
	                    
	         $disputecaseid=$lastid; //get lastinsert id here for caseID 
	         $this->load->library('email');
              //send email to user 
            					$this->email->from($site_mail,$site_name);
								$this->email->to($useremail);
								$this->email->subject('Your Dispute has been successfully Filed.');
								$this->email->message('<table cellpadding="0" cellspacing="0" width="100%" border="0">
  <tr>
    <td>Hello '.$username.',</td>
  </tr>
  <tr>
    <td><br/></td>
  </tr>
  <tr>
    <td style="padding-left:20px;"> Your dispute has been successfully filed against the Company <b>'.ucwords($companyname).'</b>. </td>
  </tr>
  <tr>
    <td style="padding-left:20px;"> You can login into your User account to check the status of your dispute(CASEID-#'.$disputecaseid.') and communicate with customer support at. </td>
  </tr>
  <tr>
    <td style="padding-left:20px;">Following link for communication <a href="'.$site_url.'user/disputes">'.$site_url.'user/disputes</a></td>
  </tr>
    <tr>
    <td><br/>
      <br/></td>
  </tr>
  <tr>
    <td> Regards,<br/>
     YouGotRated.<br/>
     Buyer Protection Program.<br/>
      </td>
  </tr>
</table>
');
			  $this->email->send(); // send email to admin
	          $this->load->library('email');
              //send email to Merchant 
            					$this->email->from($site_mail,$site_name);
								$this->email->to($companyemail);
								$this->email->subject('Request for Information About Buyer Claim: Case #'.$disputecaseid.'');
								$this->email->message('<table cellspacing="20" width="100%">
<tr> 
  	<td>A Transaction Dispute has been filed against you.</td>
</tr>

<tr>
	<td>Merchant ID: '.$companyid.'</td>
</tr>

<tr>
	<td>Hello '.$companyname.',</td>
</tr>

<tr>
	<td>One of your customers has filed a transaction dispute. Details of the dispute are listed below. 
            You can also view the details in   the Resolution Center.
	</td>
</tr>

<tr>
    <td>By addressing the dispute directly in the Resolution Center:
	<ul>
	    <li>You may be covered against future claims and chargebacks on this transaction if you are eligible for Seller Protection.</li>
	    <li>You are more likely to arrive at a mutually beneficial solution.</li>
	    <li> You will save time, and possibly money.</li>
       </ul>
    </td>
</tr>

<tr>
<td>Transaction Details <br><br>
   
	Buyers name: '.$username.' <br>
	Buyers email: <a href="mailto:'.$useremail.'">'.$useremail.'</a><br>
    Transaction date: '.$transactiondate.' <br>
	Transaction amount: '.$transactionamt.' <br>
	Your transaction ID: '.$transactionid.' <br>
	Case number: '.$disputecaseid.' <br>
</td><br> 
</tr>

<tr>
<td>By opening this dispute, '.$username.' is asking for your help to resolve this issue.</td></tr>

<tr><td>This is your best opportunity to resolve this problem before the buyer posts any negative reviews online against you and files a chargeback with their card issuer.</td></tr>

<tr><td>What To Do Next</td></tr>

<tr>
<td>Most of the time, disputes can be resolved quickly and amicably by communicating with the buyer in the Resolution Center. 
    Here, you will be able to review the dispute details and send messages to the buyer.</td></tr>

<tr><td>If you have already refunded the buyer, please provide the following information within five calendar days of the date of this email:<br>

REFUNDDATE<br>
REFUNDAMOUNT
</td></tr>

<tr>
<td>
Due Dates<br>

You have 5 calendar days to respond to this case.<br>

If we do not receive your response, this dispute will be automatically escalated to a chargeback.
In addition, the negative complaint will be posted online and your services may be terminated.<br>

We encourage you to respond to the buyer as soon as possible. 
A buyer who feels that you are working with them to resolve a problem is less likely to escalate a dispute.<br><br>

Other details<br>

Please be aware that until we complete our investigation, we may place your account services on hold. 
To review the YouGotRated User Agreement, visit the YouGotRated and click the "Legal Agreements" link on the bottom of any page.<br>

We are working to resolve this matter as quickly and fairly as possible, and your cooperation is greatly appreciated to resolve this claim.<br><br>

Thank you for your patience and cooperation.<br>

Follow this LINK (<a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputecaseid.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputecaseid.'</a>) to visit the Resolution Center.<br>
</td></tr><br>
<tr>
<td>
Sincerely,<br>

YouGotRated<br>
Buyer Protection Program<br>
</td></tr>
</table>

');
			$this->email->send(); // send email to admin
          
			
			redirect('user/disputes', 'refresh');
	    }  
	      
			
	}
		
	public function add1()
	{
		if( !array_key_exists('youg_user',$this->session->userdata) )
		{
			$this->session->set_flashdata('error', 'Please login to continue!');
			$this->session->set_userdata('last_url','complaint/add/');
			redirect('login','refresh');
		}
		
		$this->load->view('addcomplaint_new',$this->data);
	}
	function success()
	{
		$this->load->view('complaint/success',$this->data);
	}
}
			

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
