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
		//Loading Model File
	 	$this->load->model('complaints');
		$this->load->model('users');
		$this->load->model('reviews');
		
		$this->data['topads']= $this->common->get_all_ads('top','complaint',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','complaint',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','complaint',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','complaint',$siteid);
		
		
		
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
		
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);

		//$this->data['title'] = $this->data['site_name'].' : Complaints';
		
		if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'weektrending' )
		{
   		$this->data['title'] = 'Week trending complaints: '.$this->data['site_name'];
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'viewcomment' )
		{
   		$this->data['title'] = 'Comments: '.$this->data['site_name'];
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'keysearchresult' || $this->uri->segment(2) == 'search' )
		{
   		$this->data['title'] = 'Search: '.$this->data['site_name'];
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'viewuser' )
		{
   		$this->data['title'] = 'View User: '.$this->data['site_name'];
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'claimbusiness' )
		{
   		$this->data['title'] = 'Claim Business: '.$this->data['site_name'];
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'advfilter' )
		{
   		$this->data['title'] = 'Advance Filter: '.$this->data['site_name'];
		}
		else if( $this->uri->segment(1) == 'complaint' && $this->uri->segment(2) == 'filter' )
		{
   		$this->data['title'] = 'Filter: '.$this->data['site_name'];
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
						$this->data['title'] = $company[0]['company'].' '.$this->data['site_name'];
						
						
						}
						else
								
						{
						$company= $this->complaints->get_company_byseokeyword($this->uri->segment(3));
			 	  	if(count($company)>0)
						{
								$this->data['title'] = $company[0]['company'].' : '.$this->data['site_name'];
								$this->data['keywords'] = $this->uri->segment(3);
								$this->data['description'] = $company[0]['aboutus'];
						}
						else
						{
								$this->data['keywords'] = $this->common->get_seosetting_value(4);
								$this->data['description'] = $this->common->get_seosetting_value(5);
								$this->data['title'] = $this->data['site_name'].' : Complaints';
						}
					}
					}
				
					
			}
		else if( $this->uri->segment(2)=='browse'  && $this->uri->segment(3))	
			{
						$complaint= $this->complaints->get_complaint_byseokeyword($this->uri->segment(3));
					 	  		if(count($complaint)>0)
								{
									$this->data['title'] = $complaint[0]['company'].' Complaint : '.$this->data['site_name'];
									$this->data['keywords'] = $this->uri->segment(3);
									$this->data['description'] = $complaint[0]['detail'];
								}
								else
								{
									$this->data['keywords'] = $this->common->get_seosetting_value(4);
									$this->data['description'] = $this->common->get_seosetting_value(5);
									$this->data['title'] = $this->data['site_name'].' : Complaints';
								}
				
			}
		
		else
		{
			//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$this->data['title'] = $this->data['site_name'].' : Complaints';
		}
		$this->data['section_title'] = 'Complaints';

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
		  $this->load->view('complaint',$this->data);
	}
	
	public function weektrending()
	{
		  $this->load->library('pagination');
		    			
		  $limit = $this->paging['per_page'];
		  $offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
		  
		  	//Addingg Setting Result to variable
			$this->data['lastweekcomplaints'] = $this->complaints->get_all_last_weekcomplaints($limit,$offset);
		  	//echo "<pre>";
			//print_r($this->data['lastweekcomplaints']);
			//die();
			$siteid = $this->session->userdata('siteid');
			$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  
		  $this->paging['base_url'] = site_url("complaint/weektrending/index");
		  $this->paging['uri_segment'] = 4;
		  $this->paging['total_rows'] = count($this->complaints->get_all_last_weekcomplaints_count());
		  $this->pagination->initialize($this->paging);
          
		 //echo $limit;
		 //echo '<pre>';print_r($this->paging); die();
		  
		 //Loading View File
		 $this->load->view('complaint',$this->data);
	
	}
	public function browse($seokeyword='')
	{
			if( $seokeyword!='')
			{
			  	$this->data['complaints'] = $this->complaints->get_complaint_byseokeyword($seokeyword); 	  	
				if(count($this->data['complaints'])>0)
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
	
	public function viewcomment($commentid='')
	{
		 	if( $commentid!='' && $commentid!=0 )
			{
				$this->data['comments'] = $this->reviews->get_review_byid($commentid); 	  	
				//echo "<pre>";
				//print_r($this->data['comments']);
				//die();
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
					//echo $keyword;
					//die();
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
				$keyword = preg_replace('/[^a-zA-Z0-9\']/', '-',$keyword);
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
		  $this->load->view('complaint',$this->data);
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
				
				 /*echo "<pre>";
				 print_r($this->data['reviews']);
				 die();*/
		    	
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
				/*echo "<pre>";
				print_r($this->data['complaintbyuser']);
				die();*/
		
				$this->data['commentbyuser'] = $this->reviews->get_reviews_byciduid($companyid,$userid);
				/*echo "<pre>";
				print_r($this->data['commentbyuser']);
				die();*/
			
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
				//echo"<pre>";
				//print_r($elite);
				//die();
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
					
					//echo "<pre>";
					//print_r($this->data['selcountry']);
					//print_r($this->data['selcardtype']);
					//print_r($this->data['selexpmonth']);
					//print_r($this->data['selexpyear']);
					//die();
					
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
						$this->complaints->set_sem($companyid,"Facebook","http://www.facebook.com","ade2c15ab85aef450fb2f6e53e8cb825.png","ade2c15ab85aef450fb2f6e53e8cb825.png",$i);
$this->complaints->set_sem($companyid,"twitter","http://www.twitter.com","51e28dd5af6d2bb51b518b47ae717f1a.png","51e28dd5af6d2bb51b518b47ae717f1a.png",$i);
$this->complaints->set_sem($companyid,"Linkedin","http://www.linkedin.com","ab5b4de4c8fa16f822635c942aafdfb5.jpg","ab5b4de4c8fa16f822635c942aafdfb5.jpg",$i);
$this->complaints->set_sem($companyid,"Google","http://www.google.com","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg",$i);
$this->complaints->set_sem($companyid,"pintrest","http://www.pintrest.com","1519f4062fa76260346bfc61665e579d.jpeg","1519f4062fa76260346bfc61665e579d.jpeg",$i);
						


$this->complaints->set_seo($companyid,"Google Analytic","Google Analytic",$i);
$this->complaints->set_seo($companyid,"Google Webmaster","Google Webmaster",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description",$i);


$this->complaints->set_video($companyid,"video1","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i);
$this->complaints->set_video($companyid,"video2","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i);

						}}
								
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
		  	$this->load->view('complaint',$this->data);
	}
	
	public function filter()
	{
		//echo "<pre>";
		//print_r($_POST);
		//die();
		if($this->input->post('btnfiltersubmit'))
		  {
				$type = $this->input->post('type');
				
				$frmsubdate = trim($this->input->post('fsubdate'));
				$tosubdate 	= trim($this->input->post('tsubdate'));
				$frmoccdate = trim($this->input->post('foccdate'));
				$tooccdate 	= trim($this->input->post('toccdate'));
			
			 $this->data['filtercomplaints']=$this->complaints->search_filter($type,$frmsubdate,$tosubdate,$frmoccdate,$tooccdate);
		
			$siteid = $this->session->userdata('siteid');
			$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  
			//echo "<pre>";
			//print_r($this->data['filtercomplaints']);
			//die();
			//Loading View File
			$this->load->view('complaint',$this->data);
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
						


$this->complaints->set_seo($companyid,"Google Analytic","Google Analytic",$i);
$this->complaints->set_seo($companyid,"Google Webmaster","Google Webmaster",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords",$i);
$this->complaints->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description",$i);


$this->complaints->set_video($companyid,"video1","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i,'video1');
$this->complaints->set_video($companyid,"video2","http://www.youtube.com/watch?v=wPNZz1oeKaI",$i,'video2');

						}}
								
								//Inserting Elite Membership Transaction Details for Company
							$transaction = $this->complaints->add_transaction($companyid,$_REQUEST['amount3'],$_REQUEST['mc_currency'],$_REQUEST['auth'],date('Y-m-d H:i:s'));
							$websites = $this->complaints->get_all_websites();
								
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

}
			

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */