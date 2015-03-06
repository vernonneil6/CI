<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elite extends CI_Controller {

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
	
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		
		
		//Loading Helper File
	  	$this->load->helper('form');
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Elite Membership';
		$this->data['section_title'] = 'Elite Membership Status';
		
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
		if( $this->session->userdata['youg_admin'] )
	  	{
			$id = $this->session->userdata['youg_admin']['id'];
			$this->data['elite'] = $this->settings->get_elitecompany_byid($id);
			$this->data['elitepayment'] = $this->settings->get_elitepayment_byid($id);
						
			//echo "<pre>";
			//print_r($this->data['elite']);
			//die();
			//Loading View File
			$this->load->view('elite',$this->data);
	  	}
	}

	//Function For Change Status to "Disable"
	public function disable($id='',$companyid='')
	{
	  if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0 && $companyid!='' && $companyid!=0)
			{
					if( $this->settings->cancel_elitemembership_bycompnayid($id,$companyid) )
					{
							$this->session->set_flashdata('success', 'Your account has been Disabled Successfully.');						
							redirect('elite', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in updating Membership status. Try later!');
						redirect('elite', 'refresh');
					}
			}
		else
			{
				redirect('elite', 'refresh');
			}
 		}
	}
	
	function enable($id='',$companyid='')
	{
	  if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0 && $companyid!='' && $companyid!=0)
			{
					if( $this->settings->enable_elitemembership_bycompanyid($id,$companyid) )
					{
							$this->session->set_flashdata('success', 'Your account has been Enabled Successfully.');						
							redirect('elite', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in updating Membership status. Try later!');
						redirect('elite', 'refresh');
					}
			}
		else
			{
				redirect('elite', 'refresh');
			}
 		}
	}
		
	function elite_subscribe_cron()
	{
		$result = $this->settings->get_all_company();
		foreach($result as $subscribe)
		{
			$this->cancel_elite_subscribe($subscribe['company_id']);
		}
		die;
	}
	
	public function cancel_subscribtion()
	{
		$this->load->model('settings');
	  if( $this->session->userdata['youg_admin'] )
	  	{
			$id = $this->session->userdata['youg_admin']['id'];
			$this->data['elite'] = $this->settings->get_subscribtion_bycompanyid($id);
			
			//Loading View File
			$this->load->view('elite',$this->data);
	  	}
	}
	
		//Function For Change Status to "Disable"
	public function cancel($subscribtionid='',$companyid='')
	{
		
		$elite_email=$this->settings->get_elitecancel_email_byid($companyid);
		                       
	   $site_name = $this->settings->get_setting_value(1);
	   $site_url = $this->settings->get_setting_value(2);
	   $site_email = $this->settings->get_setting_value(5);
				
		 
	  if($this->session->userdata['youg_admin'])
	  {
			if($subscribtionid!='' && $companyid!='')
			{
				
				
				
			   /*sandbox test mode*/
			   $loginname="9um8JTf3W";
			   $transactionkey="9q24FTz678hQ9mAD";
			   $host = "apitest.authorize.net";
			   
			   /*live
				$loginname="5h7G7Sbr";
				$transactionkey="94KU7Sznk72Kj3HK";
				$host = "api.authorize.net";*/
				   
			   $path = "/xml/v1/request.api";
			   include('authorize/authnetfunction.php');
		
				$subscriptionId = $subscribtionid;
				//build xml to post
					$content =
							"<?xml version=\"1.0\" encoding=\"utf-8\"?>".
							"<ARBCancelSubscriptionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">".
							"<merchantAuthentication>".
							"<name>" . $loginname . "</name>".
							"<transactionKey>" . $transactionkey . "</transactionKey>".
							"</merchantAuthentication>" .
							"<subscriptionId>" . $subscriptionId . "</subscriptionId>".
							"</ARBCancelSubscriptionRequest>";

					//send the xml via curl
					$response = send_request_via_curl($host,$path,$content);
					//if the connection and send worked $response holds the return from Authorize.net
					if ($response)
					{ 
						list ($resultCode, $code, $text, $subscriptionId) =parse_return($response);
					
					 " Response Code: $resultCode <br>";
					 " Response Reason Code: $code<br>";
					 " Response Text: $text<br>";
					 " Subscription Id: $subscriptionId <br><br>";
					
					}
					else
					{ 
						$this->session->set_flashdata('success', $subscriptionId);
						redirect('elite/cancel_subscribtion', 'refresh');
					}
						
						if($text!='I00001')
						{  
							$this->session->set_flashdata('success', $subscriptionId);
							redirect('elite/cancel_subscribtion', 'refresh');
						}
						else
						{
							
					        $cancelled=$this->settings->cancel_elitemembership_bycompnayid1($companyid);
					       	if($cancelled)
							{
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
									$this->email->from('terminations@yougotrated.com',$site_name);
									$this->email->to($elite_email['contactemail']);
									$this->email->bcc('terminations@yougotrated.com');	
									$this->email->subject('YGR Account Cancellation');
												$this->email->message('<table cellpadding="0" cellspacing="0" width="100%" border="0">
																				<tr>
																					<td>Hello '.$elite_email['company'].',</td>
																				</tr>
																				<tr><td><br/></td></tr>
																				<tr>
																					<td style="padding-left:20px;">
																						Your Elite Member account has been cancelled with YouGotRated. Please visit us at <a href="'.$site_url.'solution'.'" title="'.$site_name.'">'.$site_url.'solution'.'</a> to review our services, and contact us if you would like to re-establish your account!
																					</td>
																				</tr>
																		 </table>
																				<tr>
																					<td><br/>
																					  <br/></td>
																				</tr>
																				  <tr>
																					<td> Regards,<br/>
																					  The '.$site_name.' Team.<br/>
																					</td>
																				  </tr>
																					</td>
																				</tr>
																				</table>');
									//Sending mail to admin
									$this->email->send();
															    
								$this->session->set_flashdata('success', 'Membership status disabled successfully.');
								redirect('dashboard/logout', 'refresh');
							}
							else
							{
								
								$this->session->set_flashdata('error', 'There is error in updating Membership status. Try later!');
								redirect('elite', 'refresh');
							}
						}
			}
		else
			{  
				redirect('elite', 'refresh');
			}
		}
	}
			
			
		public function update()
		{
			if( $this->session->userdata['youg_admin'] )
			{
				
				$siteid = $this->session->userdata('siteid');
				$countrylist = $this->settings->get_all_countrys();
				
				if(count($countrylist) > 0 )
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
						$this->load->model('settings');
						$id = $this->session->userdata['youg_admin']['id'];
						$this->data['elite'] = $this->settings->get_company_byid($id);
						$this->data['subscription'] = $this->settings->get_subscribtion_bycompanyid($id);
						$this->load->view('eliteupdate',$this->data);
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
					$subcats = $this->settings->get_all_states_by_cid($selcatid);
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
				redirect('eliteupdate', 'refresh');
			}
	}
	public function renew($id)
	{
		 if( $this->session->userdata['youg_admin'] )
	  	{
			//data.php start
			
			
		/*test mode
		  $loginname="2sRT3yAsr3tA";
		  $transactionkey="38UzuaL2c6y5BQ88";
		  $host = "apitest.authorize.net";*/ 
		
		/*sandbox test mode
		   $loginname="9um8JTf3W";
		   $transactionkey="9q24FTz678hQ9mAD";
		   $host = "apitest.authorize.net";*/
			
			
			/*live*/
			$loginname="5h7G7Sbr";
			$transactionkey="94KU7Sznk72Kj3HK";
			$host = "api.authorize.net";
			
			$firstName=$this->input->post('fname');				
			$lastName=$this->input->post('lname');
			$cvv=$this->input->post('cvv');				
			$address=$this->input->post('streetaddress');				
			$city=$this->input->post('city');				
			$state=$this->input->post('state');				
			$zip=$this->input->post('zip');				
			$cid=$this->input->post('country');
			$c_code=$this->settings->get_country_by_countryid($cid);
			$country=$c_code['name'];	
			$cemail=$_POST["cemail"]; 
						
			$path = "/xml/v1/request.api";
			
			//data.php end
			
			include('authorize/authnetfunction.php'); 
			  
			$subscriptionprice = $this->settings->get_setting_value(19);
				
			//define variables to send
			$amount = $subscriptionprice;
			$previouspayment=$this->settings->get_companyelite_byid($id);
			if(!empty($previouspayment['payment_amount']))	{
				
				$amount = $previouspayment['payment_amount'];
				
			 } 
			$refId = uniqid();
			$name = "Elite membership";
			$length = 1;
			$unit = "months";
			$startDate = date("Y-m-d");
			$totalOccurrences = 9999;
			$trialOccurrences = 0;
			$trialAmount = 0;
			$cardNumber =$_POST["ccnumber"];
			
			if(strlen($_POST["expirationdatem"])==1)
			{
				$expirationDate = $_POST["expirationdatey"].'-0'.$_POST["expirationdatem"];
			}
			else
			{
				$expirationDate = $_POST["expirationdatey"].'-'.$_POST["expirationdatem"];
			}
                       			
		
			$email = $this->input->post('email');
			$sid=$id;
		    $sub_id=$this->settings->get_subscriptionid($sid);
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
				"<cardCode>". $cvv . "</cardCode>".
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
				"</ARBUpdateSubscriptionRequest>";

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
				//echo $resultCode;
				
				if($resultCode=='Ok')
				{
					//update status in elite table and subscription table
					$sid=$id;
					$sub_id=$this->settings->get_subscriptionid($sid);
					$subscriptionId=$sub_id['subscr_id'];
					$sig=$sub_id['sign'];
					
					$ccnumber=$_POST['ccnumber'];
					$cvv=$_POST['cvv'];
					$cardexpire=$expirationDate;
					$fname=$firstName;
					$lname=$lastName;
					
					$tx  = $transactionkey;
					$amt = $amount;
					$companyid  = $sid;
					 $time = '1';
					$expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
					$payer_id=$email;
					$paymentmethod = 'authorize';
					$emailflag='1';
				
				   	$Billingaddress=$this->settings->update_billingaddress($address,$city,$state,$country,$zip,$id);
					$update_subscription=$this->settings->update_subscription($subscriptionId,$companyid,$amt,$ccnumber,$cvv,$cardexpire,$fname,$lname,$tx,$sig,$time,$expires,$payer_id,$paymentmethod,$emailflag);
					
					if($update_subscription)
					{
					  $update_elite= $this->settings->update_elite($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
												
									   
						$site_name = $this->settings->get_setting_value(1);
						$site_url = $this->settings->get_setting_value(2);
						$site_email = $this->settings->get_setting_value(5);
						$emailcompany=$id;
						$cronemail=$this->settings->get_elitesubscription_detailsbycompanyid($emailcompany);	
						
					
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
												
							
							$this->email->initialize($config);
							$this->email->from('memberships@yougotrated.com',$site_name);
							$this->email->to('memberships@yougotrated.com');	
							$this->email->subject('Elitemembership Subscription For User '.ucfirst($cronemail['company']).' Updated With  New credit card Details.');
							$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
																	<tr>
																		<td>Hello administration,</td>
																	</tr>
																	<tr><td><br/></td></tr>
																	<tr>
																		<td style="padding-left:20px;">
																		Following User has Updated the Elitemembership subscription by New credit card<b>'.ucfirst($cronemail['company']).'</b>. Transaction Details are as follows.
																		</td>
																	</tr>
																	<tr>
																		<td>
																			<table cellpadding="0" cellspacing="10" width="50%" border="0">
																			<tr><td colspan="3"><h3>Elitemembership Subscription Detail</h3></td></tr>
																			<tr>
																				<td>Subscription ID</td>
																				<td>:</td>
																				<td>'.$subscriptionId.'</td>
																			</tr>
                                                                        <tr>
																			<td>Transacion ID</td>
																			<td>:</td>
																			<td><b>'.$transactionkey.'</b></td>
																	    </tr>
																	    
																		</table>
																		<tr>
																		<td><br/>
																		  <br/></td>
																	  </tr>
																	  <tr>
																		<td> Regards,<br/>
																		  The '.$site_name.' Team.<br/>
																		</td>
																	  </tr>
																		</td>
																	</tr>
																	</table>');
							//Sending mail to admin
							$this->email->send();
											
							//For sending mail to user
							$this->email->from('memberships@yougotrated.com',$site_name);
							$this->email->to($cemail);
							$this->email->bcc('memberships@yougotrated.com');	
							$this->email->subject('Your Elite Membership credit card has been updated.');
							$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
													  <tr>
														<td>Hello <b>'.ucfirst($cronemail['company']).'</b>,</td>
													  </tr>
													  <tr>
														<td><br/></td>
													  </tr>
													  <tr>
														<td style="padding-left:20px;"> You have successfully updated your credit card associated with your Elite Membership at YouGotRated.com. </td>
													  </tr>
													 <tr>
														<td style="padding-left:20px;">To continue enjoying your membership, you may log in at <a href="'.$site_url.'businessadmin/'.'" title="'.$site_name.'">'.$site_name.'</a>  using your existing username and password details.</td>
													  </tr>
													  
													  <tr>
														<td><table cellpadding="0" cellspacing="10" width="50%" border="0">
															<tr>
															  <td colspan="3"><h3>Renewal Payment Transaction Detail: </h3></td>
															</tr>
															<tr>
															  <td>Subscription ID</td>
																<td>:</td>
															<td>'.$subscriptionId.'</td>
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
														  The '.$site_name.' Staff.<br/>
														  <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a></td>
													  </tr>
													</table>
													');
											
							//Sending mail user
							$this->email->send();
							$this->session->set_flashdata('success','Your Elitemembership subscription Details is Updated with New Credit card successfully.');
							redirect('elite/update', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error','New credit card Updation Failed. Please Try later !.');
						redirect('elite/update', 'refresh');
					}
				}
				else
				{
				
					$this->session->set_flashdata('success_msg',$text);
					redirect('elite/update', 'refresh');
					
				}
					
			}
			
					
			
			
		}			
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
