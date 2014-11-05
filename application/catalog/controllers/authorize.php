<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Authorize extends CI_Controller {
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
		
		$this->data['title'] = 'Business Solution';
		
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
		$siteid = $this->session->userdata('siteid');
		  $this->data['categories'] = $this->common->get_all_categorys($siteid);
		$this->load->view('authorize',$this->data);
	}
	
	public function update()
	{
		//include('authorize/data.php');
		
		//data.php start
		$loginname = $this->common->get_setting_value(22);
		$transactionkey = $this->common->get_setting_value(23);
		//$loginname="2sRT3yAsr3tA";
		//$transactionkey="38UzuaL2c6y5BQ88";
		/*test mode*/
		//$host = "apitest.authorize.net";
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
		$totalOccurrences = 999;
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
		
		if($this->input->post('email'))
		{
			$name = $this->input->post('name');
			$streetaddress = $this->input->post('streetaddress');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$country = $this->input->post('country');
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
				$id = $company[0]['id'];
				$company = $this->complaints->get_company_by_emailid($email);
				
			}
			else
			{
				$email1 = $this->complaints->chkfield1(0,'email',$email);
				$name1 = $this->complaints->chkfield1(0,'company',$name);
				
				if($email1=='new' && $name1=='new')
				{
						//Inserting Record
						if( $this->complaints->insert_business($name,$streetaddress,$city,$state,$country,$zip,$phone,$email,$website,'','',$category,'' ))
						{
							$companyid = $this->db->insert_id();
							$this->complaints->insert_contactdetails($companyid,$cname,$cphone,$cemail);
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
$link = "<a href='".site_url('company/'.$com[0]['companyseokeyword']).'/reviews/coupons/complaints'."' title='visit business page' target='_blank'>".site_url('company/'.$com[0]['companyseokeyword'])."</a>";
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
								
								$this->session->set_flashdata('success', 'Business added successfully. claim your business here');

							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
							}
						}
						else
						{
								$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
						}
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
   $HTTP_POST_VARS[amount];
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
							$transaction = $this->complaints->add_transaction($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
							$websites = $this->complaints->get_all_websites();
							$this->complaints->insert_discountcode($companyid,'ACE-Call-Center');
								
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
          <td>USD '.$amount.'</td>
        </tr>
        <tr>
          <td>Transacion ID</td>
          <td>:</td>
          <td><b>'.$transactionkey.'</b></td>
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
						redirect('authorize', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error',"There was error during payment. Please try later!");
					redirect('authorize', 'refresh');
				}
	}
	else
	{
		$this->session->set_flashdata('success', $text);
		redirect('authorize', 'refresh');
	}
		
}
else
{
	echo "Transaction Failed. <br>";
}



		
	}
	
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */