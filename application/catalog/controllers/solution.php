<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Solution extends CI_Controller {
	
	public $data;
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
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
		$this->load->model('complaints');
		
		//Setting Page Title and Comman Variable
		$this->data['topads']= $this->common->get_all_ads('top','solution',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','solution',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','solution',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','solution',$siteid);
			
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
				
		$this->data['title'] = 'Elite Membership';
		if($this->uri->segment(2) && $this->uri->segment(2) =='claim')
		{
			$this->data['section_title'] = 'Elite Membership';
		}
		else
		{
			$this->data['section_title'] = 'Business Solution';
		}
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		//Addingg Setting Result to variable
		$this->data['solutions'] = $this->common->get_all_solutions();
		$this->data['solution'] = $this->common->get_solution();
		
		//Loading View File
		$this->load->view('solution/solution',$this->data);
		
	}
	
	public function claim($id='')
	{
		$company = $this->common->get_company_byid($id);
		
		if(count($company)==0)
		{
			redirect('solution', 'refresh');
		}	
		if($id!=0 && $id!='')
		{
				$elite = $this->complaints->get_eliteship_bycompanyid($id);
				if(count($elite)==0)
				{
					$this->data['dispercentage'] = 0;
					$this->load->view('demoview1',$this->data);
				}
				else
				{
					$this->session->set_flashdata('error', 'This business has already been claimed. Please Contact Us for assistance.');
					redirect('solution', 'refresh');
				}
			}
			else
			{
				redirect('solution', 'refresh');
			}
		
	}
	public function getdiscount()
	{
			if($this->input->post('discountcode'))
			{
				$companyid = $this->input->post('company_id');
				$discountcode = $this->input->post('discountcode');
				
				if($companyid!='' && $discountcode!='')
				{
					if($discountcode!='')
					{
						redirect('solution/claimdisc/'.$companyid.'/'.$discountcode, 'refresh');
					}
					else
					{
						redirect('solution/claim/'.$companyid, 'refresh');
					}
				}
				else
				{
					redirect('solution', 'refresh');
				}
					
			}
			else
			{
				redirect(site_url(), 'refresh');
			}
		
	}
	
	public function claimdisc($id='',$disc='')
	{
		$company = $this->common->get_company_byid($id);
		
		if(count($company)==0)
		{
			redirect('solution', 'refresh');
		}	
		
		if($id!='' && $disc!='')
		{
				$discount  = $this->common->get_discount_by_code($disc);
					
				if(count($discount)>0)
				{
						$this->data['dispercentage'] = $discount[0]['percentage'];
						
						$elite = $this->complaints->get_eliteship_bycompanyid($id);
						
								if(count($elite)==0)
								{
									$this->load->view('demoview1',$this->data);
								}
								else
								{
									$this->session->set_flashdata('error', 'This Business is already claim. Try later!');
									redirect('solution', 'refresh');	
								}
				}
				else
				{
						redirect(site_url(), 'refresh');
				}
		}
		else
				{
				$this->session->set_flashdata('error', 'Invalid Discount code. Try later!');
					redirect('solution/claim/'.$id, 'refresh');
				}
	  
	}
	function claimbusiness()
	{
		$siteid = $this->session->userdata('siteid');
	  	$this->data['categories'] = $this->common->get_all_categorys($siteid);
		$countrylist = $this->common->get_all_countrys();
		
		if( count($countrylist) > 0 )
			{
				$this->data['selcon'][''] = '--Select Country--';
				
				for($c=0;$c<count($countrylist);$c++)
				{
					$this->data['selcon'][($countrylist[$c]['country_id'])] = ucfirst($countrylist[$c]['name']);
				}
			}
			else
			{
				$this->data['selcon'][''] = '--Select Country--';
			}
		
		
		$this->load->view('solution/claimbusiness',$this->data);
	}
	public function update()
	{   		
		if($this->input->post('email'))
		{
			
			$name = $this->input->post('name');
			
			//Billing address
			$streetaddress = $this->input->post('streetaddress');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$country = $this->input->post('country');
			
			
			//company address 
			
			$streetaddress1 = $this->input->post('streetaddress1');
			$city1 = $this->input->post('city1');
			$state1 = $this->input->post('state1');
			$country1 = $this->input->post('country1');
			$zip1 = $this->input->post('zip1');
			
			//echo '<pre>';print_r($_POST);die('update_check');
			//get country name
			//$country_name =  $this->common->get_country_name($country);
			//$country = $country_name[0]['name'];
			
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
			
			if(count($company)>0)
			{ 
				/*$id = $company[0]['id'];
						
				if($discountcode!='')
				{
					redirect('solution/claimdisc/'.$id.'/'.$discountcode, 'refresh');
					
				}
				else
				{
					
					redirect('solution/claim/'.$id, 'refresh');
					
				}*/

				$this->session->set_flashdata('error','This company email address is already exists. Try later!');
				redirect('solution/claimbusiness', 'refresh');
				
			}
			else
			{ 
				 $email1 = $this->complaints->chkfield1(0,'email',$email);
				 $name1 = $this->complaints->chkfield1(0,'company',$name);
				
				if($email1=='new' && $name1=='new')
				{
						//Inserting Record
						if( $this->complaints->insert_business($name,$streetaddress,$city,$state,$country,$zip,$streetaddress1,$city1,$state1,$country1,$zip1,$phone,$email,$website,'','',$category,'' ))
						{
							
							$companyid = $this->db->insert_id();							
													
							$this->complaints->insert_contactdetails($companyid,$cname,$cphone,$cemail);
							if($this->complaints->insert_companyseo($companyid,$name))
							{
								$site_name = $this->common->get_setting_value(1);
								$site_url = $this->common->get_setting_value(2);
								$site_email = $this->common->get_setting_value(5);
					            $formpost=$_POST;
							    $this->eliteSubscribe($formpost,$companyid); // for authorise
								// user Mail
								$to = $cemail;
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
								
								$this->session->set_flashdata('success', 'Your business has successfully been registered for Elite membership!');
								///redirect('solution/claim/'.$companyid, 'refresh');
								redirect('solution', 'refresh');
								
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
								redirect('solution/claimbusiness', 'refresh');
							}
						}
						else
						{
								$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
								redirect('solution/claimbusiness', 'refresh');
						}
					
					
					
					redirect('solution/claimbusiness', 'refresh');
				}
				else
				{
					if($email1=='old')
					{
						$this->session->set_flashdata('error', 'This company email address is already exists. Try later!');
						redirect('solution/claimbusiness', 'refresh');	
					}
					if($name1=='old')
					{
						$this->session->set_flashdata('error', 'This company name is already exists. Try later!');
						redirect('solution/claimbusiness', 'refresh');
					}
				}
			}
		}
	}
	
	function detail($title='')
	{
		
		if($title=='')
		{
				redirect('solution', 'refresh');	
		}
		
		//Addingg Setting Result to variable
		$this->data['solutions'] = $this->common->get_all_solutions();
		$this->data['solution'] = $this->common->get_solution($title);
		
		if(count($this->data['solution'])>0)
		{
			//Loading View File
			$this->load->view('solution/solution',$this->data);
		}
		else
		{
			redirect('solution', 'refresh');
		}
	}
	
	
	public function getallstates()
	{
		if( $this->input->is_ajax_request() && ( $this->input->post('cid') ) )
		{
			$selcatid = (($this->input->post('cid')));
			$state = (($this->input->post('state')));
			$state = ($state!='') ? $state : 'state' ;
			if( $selcatid!='' || $selcatid!='0' )
			{
				$subcats = $this->common->get_all_states_by_cid($selcatid);
				//echo "<pre>";
				//print_r($subcats);
				if( count($subcats) > 0 )
					{
						$this->data['selstates'][''] = '--Select--';
						
						for($c=0;$c<count($subcats);$c++)
						{
						
							$this->data['selstates'][($subcats[$c]['name'])] = ucfirst($subcats[$c]['name']);
						
						}
					}
					else
					{
						$this->data['selstates'][''] = '--Select--';
					}
					
					//echo "<pre>";
					//print_r($this->data['selstates']);
					//die();
					$js="id='".$state."' class='seldrop'";
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

public function eliteSubscribe($formpost,$companyid) {
	
	
	//data.php start
	//$loginname = $this->common->get_setting_value(22);
	//$transactionkey = $this->common->get_setting_value(23);
	
	
	/*test mode*/
	  /* $loginname="2sRT3yAsr3tA";
	   $transactionkey="38UzuaL2c6y5BQ88";
	   $host = "apitest.authorize.net"; */
	
	/*sandbox test mode*/
	  $loginname="9um8JTf3W";
	   $transactionkey="9q24FTz678hQ9mAD";
	   $host = "apitest.authorize.net";
	
	
	/*live
	    $loginname="5h7G7Sbr";
		$transactionkey="94KU7Sznk72Kj3HK";
		$host = "api.authorize.net";*/
	
	
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
	$c_code=$this->complaints->get_country_by_countryid($cid);
	$country=$c_code['name'];
		
	
	$company = $this->complaints->get_company_by_emailid($email);
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
	
	if ($response)
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
			if($this->complaints->insert_subscription($companyid,$amt,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId))
			{
				$company = $this->complaints->get_company_byid($companyid);
				if( count($company)>0 )
				{
					$password = uniqid();
					
					$sem = $this->complaints->get_companysem_bycompanyid($companyid);
					$seo = $this->complaints->get_companyseo_bycompanyid($companyid);
							
					$this->complaints->set_password($companyid,$password);
					if(count($sem)==0 && count($seo)==0 ) 
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
					$transaction = $this->complaints->add_transaction($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
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
					//$this->email->send();
					
					//For sending mail to user
					$this->email->from($site_mail,$site_name);
					$this->email->to($email);	
					$this->email->subject('YouGotRated: Elite Membership Signup Confirmation.');
					$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
											  <tr>
												<td>Hello '.$company[0]['company'].',</td>
											  </tr>
											  <tr>
												<td><br/></td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"> You have successfully claimed the Business <b>'.ucwords($company[0]['company']).'</b> as part of your Elite Membership package. </td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"> You can login with the following credentials to your elite member admin account by clicking link below or paste it in the address bar. </td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"> ----------------------------------------------------<br />
												  Username : '.$company[0]['email'].'<br />
												  password : '.$password.'<br />
												  ----------------------------------------------------<br />
												  Please click this link to login your account.<br />
												  <a href="'.$site_url.'businessadmin">Elite Member Login</a></td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"></td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;padding-top: 15px;"> Your Transaction Details are as follows. </td>
											  </tr>
											  <tr>
												<td>
													<table cellpadding="0" cellspacing="0" width="70%" border="0">
														<tr>
														  <td colspan="3" style="padding-left: 20px;padding-top: 5px;">Payment Details:</td>
														</tr>
														<tr>
														  <td style="padding-left:20px;padding-top:5px">Payment Amount</td>
														  <td>:</td>
														  <td>USD '.$amount.'</td>
														</tr>
														<tr>
														  <td style="padding-left:20px;padding-top:5px">Transacion ID</td>
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
												<td style="padding-left:20px;"> Verified YouGotRated Seal </td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;padding-top:10px"> To download and use your official YouGotRated seal – simply embed this code into your email or website.  This will allow your customers to see your current ratings status and reviews with YouGotRated as a live feed. </td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;padding-top: 12px;">
												&lt;iframe src=&quot;'.site_url("widget/business/".$company[0]['id']).'&quot; style=&quot;border:none;height:375px;&quot;&gt;&lt;/iframe&gt; 
												 </td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;padding-top:12px"> <b>Business Reviews</b> </td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;padding-top:10px">You can share this link with your customers to allow them to add a review for your business:<br> <a href="'.$site_url.'review/add/'.$company[0]['id'].'">'.$site_url.'review/add/'.$company[0]['id'].'</a></td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;padding-top:20px">Using this link, your customers can view your existing reviews:</td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;padding-top:10px"><a href="'.$site_url.'company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints">'.$site_url.'company/'.$company[0]['companyseokeyword'].'/reviews/coupons/complaints</a> </td>
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
											</table>');
									
					//Sending mail user
					$this->email->send();
					$this->session->set_flashdata('success','Payment is made and your business is claimed successfully.');
					
					
					//redirect('complaint', 'refresh');
				}
				else
				{
					//redirect('authorize', 'refresh');
				}
			}
			else
			{
						$this->session->set_flashdata('error',$text);
						//redirect('authorize', 'refresh');
			}
		}
		else
		{
			$this->session->set_flashdata('error',$text);
			//redirect('authorize', 'refresh');
		}
			
	}
	else
	{
		echo "Transaction Failed. <br>";
	}

}
public function cron()
{	
	$crons=$this->complaints->elitecrondetails();
	//print_r($crons);
	foreach($crons as $con)	{
	  
	  	$subscription_id=$con['subscr_id'];
		$subscription_amount=$con['amount'];
		$alertemailid=$con['payer_id'];
		$paymentfailed_date=$con['payment_date'];
		$company_id=$con['company_id'];
		$last_transaction=$con['txn_id'];
		$nameextract =explode('@',$con['payer_id']);
        $names=$nameextract[0];
        $emailname = preg_replace('/[0-9]+/', '', $names);
        $emailcompany=$company_id;
		$cronemail=$this->complaints->get_elitesubscription_detailsbycompanyid($emailcompany);	
	   
        
        $disable_elite=$this->complaints->disable_elitemembership($company_id);
        $site_name = $this->common->get_setting_value(1);
	 	$site_renewurl=$site_name.'solution/renew/'.$company_id;
	 	$site_base_url=base_url().'solution/renew/'.$company_id;
	 	$site_url = $this->common->get_setting_value(2);
		$site_email = $this->common->get_setting_value(5);      
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
										
				//CHANGE THE RECEPTIENT AND URL LINK AFTER CHECKING
				
				
					//$this->email->initialize($this->cnfemail);
					$this->email->initialize($config);
					$this->email->from($site_mail,$site_name);
					$this->email->to($alertemailid);	
					$this->email->subject('Your EliteMembership Subscription has been Expired.Please Renew');
					$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
															<tr>
																<td>Hello '.ucfirst($cronemail['company']).',</td>
															</tr>
															<tr><td><br/></td></tr>
															<tr>
																<td style="padding-left:20px;">
																Your subscription to Elitemembership has been deactivated due to payment failure. Details are as follows.
																</td>
															</tr>
															<tr>
																<td>
																	<table cellpadding="0" cellspacing="0" width="10px" border="0">
																	<tr><td colspan="3"><h3>Payment Transaction Detail</h3></td></tr>
																	<tr>
																		<td>Subscription ID</td>
																		<td>:</td>
																		<td>'.$subscription_id.'</td>
																	</tr>
																	<tr>
																		<td>Subscription Amount</td>
																		<td>:</td>
																		<td>USD '.$subscription_amount.'</td>
																	</tr>
																	<tr>
																		<td>Transacion ID</td>
																		<td>:</td>
																		<td><b>'.$last_transaction.'</b></td>
																	</tr>
																	<tr>
																		<td>Payment Ended Date</td>
																		<td>:</td>
																		<td><b>'.$paymentfailed_date.'</b></td>
																	</tr>
																	<tr>
																		<td style="padding-top:20px;">
																		 Please Renew Your Elitemembership Subscription at Following link. <a href="'.$site_base_url.'" title="'.$site_name.'">'.$site_base_url.'</a>. <br>
																		 Till then Your Elite account will be in deactive.
																		</td>
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
												  The YouGotRated Team.<br/>
												  <a href="'.$site_base_url.'" title="'.$site_name.'">'.$site_name.'</a></td>
											   </tr>
											</table>');
											
											
					//Sending mail to admin
					$this->email->send();
					$this->adminreport();
	}
	
}
public function adminreport()
{
	///ALERT EMAIL LISTING SUCCESS AND FAILED PAYMENT  TO ADMIN USER 
					$reportfailed=$this->complaints->getexpired_payment();
					$reportsuccess=$this->complaints->getsuccess_payment();
					
			    ///Failed data retreive
				
				//echo '<pre>';print_r($reportfailed);	
					$paymentdate= '';
					$subscr_id = '';
					$Expire='';
					$status='';
					$fail='<table>
                         <tr>
                         <th>Subscription ID</th>
                         <th>Payment Date</th>
                         <th>Payment Expired Date</th>
                         <th>Transaction Status</th>
                         </tr>';
					foreach($reportfailed as $key => $val){
												
						$subscr_id = $val['subscr_id']; 
						$paymentdate =$val['payment_date']; 
						$Expire = $val['expires']; 
						$status ='Payment Failed'; 
						$fail .='<tr>
                         <td>'.$subscr_id.'</td>
                         <td>'.$paymentdate.'</td>
                         <td>'.$Expire.'</td>
                         <td>'.$status.'</td>
                         </tr>';
                         
					}
                $fail .='</table>';      
                         
                         
                    //success retreive   
                    
                    //echo '<pre>';print_r($reportsuccess); 
                    
                    $paymentdate= '';
					$subscr_id = '';
					$Expire='';
					$status='';
					$success='<table>
                         <tr>
                         <th>Subscription ID</th>
                         <th>Payment Date</th>
                         <th>Payment Expired Date</th>
                         <th>Transaction Status</th>
                         </tr>';
					foreach($reportsuccess as $key => $val){
												
						$subscr_id = $val['subscr_id']; 
						$paymentdate =$val['payment_date']; 
						$Expire = $val['expires']; 
						$status ='Payment Success'; 
						$success .='<tr>
                         <td>'.$subscr_id.'</td>
                         <td>'.$paymentdate.'</td>
                         <td>'.$Expire.'</td>
                         <td>'.$status.'</td>
                         </tr>';
                         
					}
                $success .='</table>';    
                     
                     
                     
                     $site_name = $this->common->get_setting_value(1);
					 $site_url = $this->common->get_setting_value(2);
					 $site_email = $this->common->get_setting_value(5);      
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
										
				//CHANGE THE RECEPTIENT AND URL LINK AFTER CHECKING
				
				   $this->email->initialize($config);     
                    $todaysdate=date('Y-m-d');
					$this->email->from($site_mail,$site_name);
					$this->email->to($site_email);	
					$this->email->subject('Todays Report On Success and Failed Payments On Date  '.$todaysdate.'');
					$this->email->message('<table cellpadding="0" cellspacing="10" width="100%" border="0">
															<tr>
																<td>Hello Administration,</td>
															</tr>
															<tr><td><br/></td></tr>
															<tr>
																<td style="padding-left:20px;">
																Todays Report on Success and Failed payments On following Date '.$todaysdate.' . Details are as follows.
																</td>
															</tr>
															<tr>
																<td>
																	<table cellpadding="10" cellspacing="10" width="100%" border="0">
																	<tr><td colspan="3"><h3>Payment Details</h3></td></tr>
																	<tr>
																		<td><b>Failed Transaction Payments Today</b></td><br>
																	</tr>
																	<tr>
																	   '.$fail.'
																	</tr>
																	<tr>
																		<td style="padding-top:20px;">
																		 
																		</td>
																	</tr>	
																	</table>
																</td>
															</tr>
															<tr>
																<td>
																	<table cellpadding="10" cellspacing="10" width="100%" border="0">
																	<tr>
																		<td><b>Successful Transaction Payments Today</b></td><br>
																	</tr>
																	<tr>
																	    '.$success.'
																	</tr>
																	<tr>
																		<td style="padding-top:20px;">
																		 
																		</td>
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
												  The YouGotRated Team.<br/>
												  <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a></td>
											   </tr>
											</table>');
											
											
					//Sending mail to admin
					$this->email->send();
	
	
}
public function renew($id)
{
	//echo $id;
	$this->data['renewelite']=$this->complaints->get_company_byid($id);
	$this->load->view('solution/renew',$this->data);
	
}
public function renew_update($id)
{
	//echo $id;
	//data.php start
	//$loginname = $this->common->get_setting_value(22);
	//$transactionkey = $this->common->get_setting_value(23);
	
	
	/*test mode*/
	  /* $loginname="2sRT3yAsr3tA";
	   $transactionkey="38UzuaL2c6y5BQ88";
	   $host = "apitest.authorize.net"; */
	
	/*sandbox test mode*/
	  /* $loginname="9um8JTf3W";
	   $transactionkey="9q24FTz678hQ9mAD";
	   $host = "apitest.authorize.net"; */
	
	
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
	$cardNumber =$_POST["ccnumber"];
			
	if(strlen($_POST["expirationdatem"]==1))
	{
		 $expirationDate = $_POST["expirationdatey"].'-0'.$_POST["expirationdatem"];
	}
	else
	{
		 $expirationDate = $_POST["expirationdatey"].'-'.$_POST["expirationdatem"];
	}
			
	$email = $this->input->post('email');					
	$sid=$id;
	$sub_id=$this->complaints->get_subscriptionid($sid);
	$subscriptionId=$sub_id['subscr_id'];	
		"Results <br><br>";

	//build xml to post
	$content =
        "<?xml version=\"1.0\" encoding=\"utf-8\"?>".
        "<ARBUpdateSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
        "<merchantAuthentication>".
        "<name>" . $loginname . "</name>".
        "<transactionKey>" . $transactionkey . "</transactionKey>".
        "</merchantAuthentication>".
        "<subscriptionId>" . $subscriptionId . "</subscriptionId>".
        "<subscription>".
        "<payment>".
        "<creditCard>".
        "<cardNumber>" . $cardNumber ."</cardNumber>".
        "<expirationDate>" . $expirationDate . "</expirationDate>".
        "</creditCard>".
        "</payment>".
        "</subscription>".
        "</ARBUpdateSubscriptionRequest>";

	//send the xml via curl
	$response = send_request_via_curl($host,$path,$content);
	//if the connection and send worked $response holds the return from Authorize.net
	
	//print_r($response);die;
	if ($response)
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
		//echo $resultCode;
		
		if($resultCode=='Ok')
		{
			//update status in elite table and subscription table
			$sid=$id;
			$sub_id=$this->complaints->get_subscriptionid($sid);
			$subscriptionId=$sub_id['subscr_id'];
			$sig=$sub_id['sign'];
			$tx  = $transactionkey;
			$amt = $amount;
			$companyid  = $sid;
			$time = $this->common->get_setting_value(18);
			$expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
			$payer_id=$email;
			$paymentmethod = 'authorize';
			$emailflag='1';
			
			
			$update_subscription=$this->complaints->update_subscription($subscriptionId,$companyid,$amt,$tx,$sig,$time,$expires,$payer_id,$paymentmethod,$emailflag);
			//echo '<pre>';print_r($update_subscription);	  
			if($update_subscription)
			{
			  $update_elite= $this->complaints->update_elite($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
				    //echo '<pre>';print_r($update_elite);
				    
				   
			$site_name = $this->common->get_setting_value(1);
			$site_url = $this->common->get_setting_value(2);
			$site_mail = $this->common->get_setting_value(5);
			$emailcompany=$id;
			$cronemail=$this->complaints->get_elitesubscription_detailsbycompanyid($emailcompany);	
		
		//CHANGE THE RECEPTIENT AND URL LINK AFTER CHECKING
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
					$this->email->from($cronemail['payer_id'],$cronemail['company']);
					$this->email->to($site_mail);	
					$this->email->subject('Payment Received for Elitemembership Renewal.');
					$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
															<tr>
																<td>Hello administration,</td>
															</tr>
															<tr><td><br/></td></tr>
															<tr>
																<td style="padding-left:20px;">
																Following User has Renewed the Elitemembership subscription <b>'.ucfirst($cronemail['company']).'</b>. Transaction Details are as follows.
																</td>
															</tr>
															<tr>
																<td>
																	<table cellpadding="0" cellspacing="0" width="50%" border="0">
																	<tr><td colspan="3"><h3>Renewal Payment Detail</h3></td></tr>
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
					$this->email->to($email);	
					$this->email->subject('Elitemembership has been Renewed successfully.');
					$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
											  <tr>
												<td>Hello <b>'.ucfirst($cronemail['company']).'</b>,</td>
											  </tr>
											  <tr>
												<td><br/></td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"> You have successfully Renewed Your Elitemembership Subscription <b>'.ucfirst($cronemail['company']).'</b>. </td>
											  </tr>
											 <tr>
												<td style="padding-left:20px;">Continue Enjoying your Elitemembership login at  <a href="'.$site_url.'businessadmin/'.'" title="'.$site_name.'">'.$site_name.'</a>  With login details You already Provided.</td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"> Your Transaction Details are as follows. </td>
											  </tr>
											  <tr>
												<td><table cellpadding="0" cellspacing="0" width="50%" border="0">
													<tr>
													  <td colspan="3"><h3>Renewal Payment Detail</h3></td>
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
													<td colspan="3">&nbsp;</td>
													</tr>
													<tr>
													  <td colspan="3">&nbsp;</td>
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
					$this->session->set_flashdata('success','Payment is made and your Elitemembership subscription is Renewed successfully.');
					redirect('solution', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error','Payment is Failed.');
				//redirect('authorize', 'refresh');
			}
		}
		else
		{
			
			$this->session->set_flashdata('error',$text);
			redirect('solution', 'refresh');
		}
			
	}
	
			
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
}
