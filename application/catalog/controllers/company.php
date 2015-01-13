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
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		//Loading Model File
	 	$this->load->model('complaints');
		$this->load->model('users');
		$this->load->model('reviews');
		$this->load->model('coupons');
		
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
		
		$company = $this->complaints->get_company_byseokeyword($this->uri->segment(2));
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
						$company= $this->complaints->get_company_byseokeyword($this->uri->segment(2));
			 	  	if(count($company)>0)
						{
								$this->data['title'] = $company[0]['company'].' : '.$this->data['site_name'];
								$this->data['keywords'] = $this->uri->segment(2);
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
		else
		{			
			$this->data['keywords'] = $this->common->get_seosetting_value(4);
			$this->data['description'] = $this->common->get_seosetting_value(5);
		}
		
		if( $this->uri->segment(1)=='company' && $this->uri->segment(2)=='reviews')
		{
			$company = $this->complaints->get_company_byseokeyword($this->uri->segment(2)); 
			if(count($company)>0)
			{
				$this->data['title'] = ucfirst($company[0]['company']).' reviews : '.$this->data['site_name']; 
			}
			else
			{
				$this->data['title'] = 'company : '. $this->data['site_name']; 
			}
		}
		elseif( $this->uri->segment(1)=='company' && $this->uri->segment(2)=='coupons')
		{
			$company = $this->complaints->get_company_byseokeyword($this->uri->segment(2)); 
			if(count($company)>0)
			{
				$this->data['title'] = ucfirst($company[0]['company']).' coupons : '.$this->data['site_name']; 
			}
			else
			{
				$this->data['title'] = 'company : '. $this->data['site_name']; 
			}
		}
		elseif( $this->uri->segment(1)=='company' && $this->uri->segment(2)=='complaints')
		{
			
			$company = $this->complaints->get_company_byseokeyword($this->uri->segment(2)); 
			if(count($company)>0)
			{
				$this->data['title'] = ucfirst($company[0]['company']).' complaints : '.$this->data['site_name']; 
			}
			else
			{
				$this->data['title'] = 'company : '. $this->data['site_name']; 
			}
		}
		
		elseif( $this->uri->segment(1)=='company' && $this->uri->segment(2)!='reviews' )
		{
			$company = $this->complaints->get_company_byseokeyword($this->uri->segment(2)); 
			if(count($company)>0)
			{
				$this->data['title'] = ucfirst($company[0]['company']).' Reviews : '.$this->data['site_name']; 
			}
			else
			{
				$this->data['title'] = 'company : '. $this->data['site_name']; 
			}
		}
		else
		{
			$this->data['title'] = $this->data['site_name']; 
		}
		
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
		public function index($word='',$text1='',$text2='',$text3='')
		{
		  	if($word!='' && $text1!='' && $text2!='' && $text3!='')
			{
		  	if( $word!='')
			{
				$this->data['company'] = $this->complaints->get_company_byseokeyword(urldecode($word)); 
				if(count($this->data['company'])>0) {
				
		  		$this->data['complaints'] = $this->complaints->get_complaint_bycompanyid($this->data['company'][0]['id']);
				$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($this->data['company'][0]['id']);
				$this->data['coupons'] = $this->complaints->get_coupon_bycompanyid($this->data['company'][0]['id']);
				$this->data['gallerys'] = $this->complaints->get_gallery_bycompanyid($this->data['company'][0]['id']);
				$this->data['videos'] = $this->complaints->get_videos_bycompanyid($this->data['company'][0]['id']);
				$this->data['companysems'] = $this->complaints->get_companysem_bycompanyid($this->data['company'][0]['id']);
				$this->data['companyreviews'] = $this->complaints->get_companyreviews_bycompanyid($this->data['company'][0]['id']);
				$this->data['companypdfs'] = $this->complaints->get_companypdfs_bycompanyid($this->data['company'][0]['id']);
				$this->data['companypressreleases'] = $this->complaints->get_companypressreleases_bycompanyid($this->data['company'][0]['id']);
				
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						//get total REVIEWS
						//get total COMPLAINTS
						//get total DAMAGES
						
						$this->data['to_reviews'] = $this->complaints->get_to_reviews_cid($this->data['company'][0]['id']);
						$this->data['to_complaints'] = $this->complaints->get_to_complaints_cid($this->data['company'][0]['id']);
						$this->data['to_damages'] = $this->complaints->get_to_damages_cid($this->data['company'][0]['id']);
						$this->data['company_timings'] = $this->complaints->get_company_onetimings($this->data['company'][0]['id']);
						
						$this->load->view('company/index',$this->data);
					}
				else
					{
						redirect(base_url(), 'refresh');
					}
				}
				else
				{
				redirect(base_url(), 'refresh');
			}
			}
		else
			{
					redirect(base_url(), 'refresh');
			}
		}
			else
			{
					redirect(base_url(), 'refresh');
			}
		
		}
		
		public function reviews($word='')
		{
		  	if( $word!='')
			{
				$this->data['company'] = $this->complaints->get_company_byseokeyword($word); 
						if(count($this->data['company'])>0) {
							
							
				$this->load->library('pagination');
		
				$limit = $this->paging['per_page'];
  				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
		
				$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($this->data['company'][0]['id'],$limit,$offset);
				
				$this->paging['base_url'] = site_url("company/reviews/".$word.'/');
				$this->paging['uri_segment'] = 4;
				$this->paging['total_rows'] = $this->reviews->get_reviews_bycompanyid_count($this->data['company'][0]['id']);
				$this->pagination->initialize($this->paging);			
		  		
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						$this->load->view('companyreviews1',$this->data);
					}
				else
					{
						redirect(base_url(), 'refresh');
					}
				}
				else
				{
				redirect(base_url(), 'refresh');
			}
			}
		else
			{
					redirect('', 'refresh');
			}
		
		}
		
		public function complaints($word='')
		{
		  	if( $word!='')
			{
				$this->data['company'] = $this->complaints->get_company_byseokeyword($word); 
				if(count($this->data['company'])>0) {
				
		  		
				$this->load->library('pagination');
		  		$siteid = $this->session->userdata('siteid');
		 			
				$limit = $this->paging['per_page'];
				$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
		  
		  		//Addingg Setting Result to variable
		  		$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  
		  		
				$this->data['complaints'] = $this->complaints->get_complaint_bycompanyid($this->data['company'][0]['id']);
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						$this->load->view('companycomplaints',$this->data);
					}
				else
					{
						redirect('', 'refresh');
					}
				}
				else
				{
				redirect('', 'refresh');
			}
			}
		else
			{
					redirect('', 'refresh');
			}
		
		}
		
		public function coupons($word='')
		{
		  	if( $word!='')
			{
				$this->data['company'] = $this->complaints->get_company_byseokeyword($word); 
				if(count($this->data['company'])>0) {
					
				$this->load->library('pagination');
		  		$siteid = $this->session->userdata('siteid');
		 			
				$limit = $this->paging['per_page'];
				$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
		  
		  		//Addingg Setting Result to variable
		  		$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
		  	
				
				$this->data['coupons'] = $this->complaints->get_coupon_bycompanyid($this->data['company'][0]['id']);
				//echo "<pre>";
				//print_r($this->data['coupons']);
				//die();
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						$this->load->view('companycoupons',$this->data);
					}
				else
					{
						redirect('', 'refresh');
					}
				}
				else
				{
				redirect('', 'refresh');
			}
			}
		else
			{
					redirect('', 'refresh');
			}
		
		}
		
		public function pressreleases($word='')
		{
		  	if( $word!='')
			{
				$this->data['keyword'] = '';
				
				$this->data['company'] = $this->complaints->get_company_byseokeyword($word); 
				if(count($this->data['company'])>0) {
					
				$this->load->library('pagination');
		  		$siteid = $this->session->userdata('siteid');
		 			
				$limit = $this->paging['per_page'];
				$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
		  
		  		//Addingg Setting Result to variable
		  		$this->data['keywords'] = $this->complaints->get_all_searchs($siteid);
				
				$this->data['pressreleases'] = $this->complaints->get_pressreleases_bycompanyid($this->data['company'][0]['id']);
							
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						$this->load->view('companypressreleases',$this->data);
					}
				else
					{
						redirect(base_url(), 'refresh');
					}
				}
				else
				{
				redirect('', 'refresh');
			}
			}
			else
				{
						redirect('', 'refresh');
				}
		
		}
		public function upgrade_elite($id='')
		{
			//echo $id;
			$this->data['makeelite']=$this->common->get_company_byid($id);
			$this->load->view('company/upgrade',$this->data);
			
			
		}
		public function makeelite()
		{ 
			//data.php start
				//$loginname = $this->common->get_setting_value(22);
				//$transactionkey = $this->common->get_setting_value(23);
				
				
				/*test mode*/
				  /* $loginname="2sRT3yAsr3tA";
				   $transactionkey="38UzuaL2c6y5BQ88";
				   $host = "apitest.authorize.net"; */
				
				/*sandbox test mode*/
				  /*$loginname="9um8JTf3W";
				  $transactionkey="9q24FTz678hQ9mAD";
				  $host = "apitest.authorize.net";*/
				
				
				/*live*/
				 $loginname="5h7G7Sbr";
				$transactionkey="94KU7Sznk72Kj3HK";
				$host = "api.authorize.net";
				
				
				$path = "/xml/v1/request.api";
				//data.php end
				
				include('authorize/authnetfunction.php');
				$subscriptionprice = $this->common->get_setting_value(19);
					   
				//define variables to send
				$amount = $subscriptionprice;
				$refId = uniqid();
				$name = "elite membership";
				$length = 10;
				$unit = "months";
				$startDate = date("Y-m-d");
				//$totalOccurrences = 999;
				$totalOccurrences = 12;
				$trialOccurrences = 0;
				$trialAmount = 0;
				$cardNumber = $_POST["ccnumber"];
						
				if(strlen($_POST["expirationdatem"])==1)
				{
					$expirationDate = $_POST["expirationdatey"].'-0'.$_POST["expirationdatem"];
				}
				else
				{
					$expirationDate = $_POST["expirationdatey"].'-'.$_POST["expirationdatem"];
				}
						
				$firstName = $_POST["fname"];
				$lastName = $_POST["lname"];	
				$email = $this->input->post('email');					
				$address=$_POST["streetaddress"];
				$city=$_POST["city"];	
				$state=$_POST["state"];
				$zip=$_POST["zip"];
				$cid=$_POST["country"];
				$c_code=$this->common->get_country_by_countryid($cid);
				$country=$c_code['name'];
					
				
				$company = $this->common->get_company_by_emailid($email);
				//print_r($company[0]);
				if(count($company)>0)
				{
					$companyid = $company[0]['id'];
				}

				"Results <br><br>";

				//build xml to post
				$content =
						"<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
						"<ARBCreateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
						"<merchantAuthentication>".
						"<name>" . $loginname . "</name>".
						"<transactionKey>" . $transactionkey . "</transactionKey>".
						"</merchantAuthentication>".
						"<refId>" . $refId . "</refId>".
						"<subscription>".
						"<name>" . $name . "</name>".
						"<paymentSchedule>".
						"<interval>".
						"<length>". $length ."</length>".
						"<unit>". $unit ."</unit>".
						"</interval>".
						"<startDate>" . $startDate . "</startDate>".
						"<totalOccurrences>". $totalOccurrences . "</totalOccurrences>".
						"<trialOccurrences>". $trialOccurrences . "</trialOccurrences>".
						"</paymentSchedule>".
						"<amount>". $amount ."</amount>".
						"<trialAmount>" . $trialAmount . "</trialAmount>".
						"<payment>".
						"<creditCard>".
						"<cardNumber>" . $cardNumber . "</cardNumber>".
						"<expirationDate>" . $expirationDate . "</expirationDate>".
						"</creditCard>".
						"</payment>".
						"<billTo>".
						"<firstName>". $firstName . "</firstName>".
						"<lastName>" . $lastName . "</lastName>".
						"<address>" . $address . "</address>".
						"<city>" . $city . "</city>".
						"<state>" . $state . "</state>".
						"<zip>" . $zip . "</zip>".
						"<country>" . $country . "</country>".
						"</billTo>".
						"</subscription>".
						"</ARBCreateSubscriptionRequest>";


				//send the xml via curl
				$response = send_request_via_curl($host,$path,$content);
				//if the connection and send worked $response holds the return from Authorize.net
				//print_r($response);die;
				if($response)
				{
					list ($refId, $resultCode, $code, $text, $subscriptionId) =parse_return($response);
					 " Response Code: $resultCode <br>";
					 " Response Reason Code: $code<br>";
					 " Response Text: $text<br>";
					 " Reference Id: $refId<br>";
					 " Subscription Id: $subscriptionId <br><br>";
					 " Data has been written to data.log<br><br>";
					 $loginname;
					 "<br />";
					 $transactionkey;
					 "<br />";
				  
					"amount:";
					$amount;
					"<br \>";
				  
					"refId:";
					$refId;
					"<br \>";
				  
					"name:";
					$name;
					"<br \>";
				  
					"amount: ";
					$amount;
					"<br \>";
					"<br \>";
					$content;
					"<br \>";
					"<br \>";
					if($resultCode=='Ok')
					{
						$tx  = $transactionkey;
						$amt = $amount;
						$companyid  = $companyid;
						$sig = $refId;
						$time = $this->common->get_setting_value(18);
						$expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
						$payer_id=$email;
						$paymentmethod = 'authorize';
						if($this->common->insert_subscription($companyid,$amt,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId))
						{
							$company = $this->common->get_company_byid($companyid);
							$redirectto=$company[0]['companyseokeyword'];
							if( count($company)>0 )
							{
								$password = uniqid();
								
								$sem = $this->common->get_companysem_bycompanyid($companyid);
								$seo = $this->common->get_companyseo_bycompanyid($companyid);
										
								$this->common->set_password($companyid,$password);
								if(count($video)==0 && count($sem)==0 && count($seo)==0 ) 
								{
									
									$this->complaints->set_sem($companyid,"Facebook","http://www.facebook.com","ade2c15ab85aef450fb2f6e53e8cb825.png","ade2c15ab85aef450fb2f6e53e8cb825.png","1","f");
									$this->complaints->set_sem($companyid,"twitter","http://www.twitter.com","51e28dd5af6d2bb51b518b47ae717f1a.png","51e28dd5af6d2bb51b518b47ae717f1a.png","1","t");
									$this->complaints->set_sem($companyid,"Linkedin","http://www.linkedin.com","ab5b4de4c8fa16f822635c942aafdfb5.jpg","ab5b4de4c8fa16f822635c942aafdfb5.jpg","1","l");
									$this->complaints->set_sem($companyid,"Google","http://www.google.com","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg","a7f9c768874a247ae8c6ba3c4e3f5d7e.jpg","1","g");
									$this->complaints->set_sem($companyid,"pintrest","http://www.pintrest.com","1519f4062fa76260346bfc61665e579d.jpeg","1519f4062fa76260346bfc61665e579d.jpeg","1","p");
															
									$this->complaints->set_seo($companyid,"Google Analytic","Google Analytic","1");
									$this->complaints->set_seo($companyid,"Google Webmaster","Google Webmaster","1");
									$this->complaints->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords","1");
									$this->complaints->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description","1");

								}
																				
								//Inserting Elite Membership Transaction Details for Company
								$transaction = $this->common->add_transaction($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
								$websites = $this->common->get_all_websites();
								$this->common->insert_discountcode($companyid,'ACE-Call-Center');
												
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
								$config = Array(
								'protocol' => 'smtp',
								'smtp_host' => 'smtp.mandrillapp.com',
								'smtp_port' => 587,
								'smtp_user' => 'alankenn@grossmaninteractive.com',
								'smtp_pass' => 'vPVq6nWolBWIKNp1LaWNFw',
								'mailtype'  => 'html', 
								'charset'   => 'iso-8859-1'
							);	
								$this->load->library('email');
								$this->email->set_newline("\r\n");				
								//Loading E-mail config file
								$this->config->load('email',TRUE);
								$this->cnfemail = $this->config->item('email');
													
								//$this->email->initialize($this->cnfemail);
								$this->email->initialize($config);
								$this->email->from($email,$company[0]['company']);
								//$this->email->to($site_mail,'alankenn@grossmaninteractive.com');	
								$this->email->to('alankenn@grossmaninteractive.com');	
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
																					<td>USD '.$amount.'</td>
																				</tr>
																				<tr>
																					<td>Transacion ID</td>
																					<td>:</td>
																					<td><b>'.$transactionkey.'</b></td>
																				</tr>
																				</table>
																			</td>
																		</tr>
																		</table>');
								//Sending mail to admin
								$this->email->send();
												
								//For sending mail to user
								$this->email->from($site_mail,$site_name);
								//$this->email->to($email,'alankenn@grossmaninteractive.com');	
								$this->email->to('alankenn@grossmaninteractive.com');	
								$this->email->subject('YouGotRated: Your business has been claimed successfully.');
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
																  <td colspan="3"><h3>Payment Transaction Details:</h3></td>
																</tr>
																<tr>
																  <td>Payment Amount</td>
																  <td>:</td>
																  <td>USD '.$amount.'</td>
																</tr>
																<tr>
																  <td>Transacion ID</td>
																  <td>:</td>
																  <td><b>'.$transactionkey.'</b></td>
																</tr>
																<tr>
																  <td colspan="3">&nbsp;</td>
																</tr>
															</table>
															</td>
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
								//redirect('complaint', 'refresh');
								redirect(site_url('company/'.$redirectto.'/reviews/coupons/complaints'), 'refresh');
							}
							else
							{
								//redirect('authorize', 'refresh');
							}
						}
						else
						{
									$this->session->set_flashdata('error',"There was error during payment. Please try later!");
									//redirect('authorize', 'refresh');
						}
					}
					else
					{
						$this->session->set_flashdata('error', $text);
						//redirect('authorize', 'refresh');
					}
						
				}
				else
				{
					echo "Transaction Failed. <br>";
				}

		}
	}
	
 //echo site_url('company/'.$companies[$i]['companyseokeyword'].'/reviews/coupons/complaints');
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
