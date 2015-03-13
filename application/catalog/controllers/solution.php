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
		$upgradefn=$this->uri->segment(3);
		$upgradeid=$this->uri->segment(4); 
		
 		if(!empty($upgradeid) && ($upgradefn=='elitemem')){
		    $eid=$upgradeid;
		}else{
		    $eid="";
		}
		
		if($eid)
		{
			$this->data['company_avail']=$this->complaints->company_available_by_id($eid);
			//print_r($this->data['company_avail']);
		}

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
	
	public function register_data()
	{
		//print_r($this->input->post());die;
		if($this->input->post('cat')!='')
		{
			$category=implode(',',$this->input->post('cat'));
		}
		else
		{
			$category='1';
		}
		
		$data = array(
					'name' => $this->input->post('name'),
                    'elitemem'=>$this->input->post('elitemem'),
                    'renewid'=>$this->input->post('renewid'), 
					'website' => $this->input->post('website'),
					'category' => $category,
					'categorylist' => $this->input->post('categorylist'),
					'email' => $this->input->post('email'),
					'streetaddress1' => $this->input->post('streetaddress1'),
					'country1' => $this->input->post('countryname1'),
					'state1' => $this->input->post('state1'),
					'city1' => $this->input->post('city1'),
					'zip1' => $this->input->post('zip1'),
					'phone' => $this->input->post('phone'),
					'cname' => $this->input->post('cname'),
					'cphone' => $this->input->post('cphone'),
					'cemail' => $this->input->post('cemail'),
					'fname' => $this->input->post('fname'),
					'lname' => $this->input->post('lname'),
					'streetaddress' => $this->input->post('streetaddress'),
					'country' => $this->input->post('countryname'),
					'state' => $this->input->post('state'),
					'city' => $this->input->post('city'),
					'zip' => $this->input->post('zip'),
					'ccnumber' => $this->input->post('ccnumber'),
					'cvv' => $this->input->post('cvv'),
					'expirationdatem' => $this->input->post('expirationdatem'),
					'expirationdatey' => $this->input->post('expirationdatey'),
					'discountcode' => $this->input->post('discountcode'),
					'discount-code-type' => $this->input->post('discount-code-type'),
					'discounted-price' => $this->input->post('discounted-price'),
					'subscriptionprice' => $this->input->post('subscriptionprice'),
                                        'transactionid'=>$this->input->post('transactionid'),
                                        'auth_type'=>$this->input->post('auth_type')
		);
		return $data;
		
	}
	
	public function receipt()
	{
		if(isset($_GET['elitemem'])){
		    $eid=$_GET['elitemem'];
		}else{
		    $eid="";
		}
		
		if($eid)
		{
			$this->data['company_avail']=$this->complaints->company_available_by_id($eid);
		}
		
		if($this->input->post('cat')!='')
		{
			$category=implode(',',$this->input->post('cat'));
		}
		else
		{
			$category='1';
		}
	    $brokerid = $this->input->post('affiliatedId');
	    if($brokerid!=''){
			$this->data['broker_info']=$this->complaints->get_broker_by_id($brokerid);
		}
		$this->data['register_data'] = $this->register_data();
		$this->load->view('solution/receipt', $this->data);
	}
	
		
	public function update()
	{   
            if($this->input->post('email'))
		{
			
            $renewid= $this->input->post('renewid');		
			$elitemem = $this->input->post('elitemem');
			$name = $this->input->post('name');
			
			//Billing address
			$streetaddress = $this->input->post('streetaddress');
			$city = $this->input->post('city');
			$state = $this->input->post('state');
			$country = $this->input->post('countryname');
			$catlist = $this->input->post('categorylist');
			
			//company address 
			
			$streetaddress1 = $this->input->post('streetaddress1');
			$city1 = $this->input->post('city1');
			$state1 = $this->input->post('state1');
			$country1 = $this->input->post('countryname1');
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
			$ctitle=$this->input->post('ctitle');
			$discountcode = $this->input->post('discountcode');
			$affid = $this->input->post('affiliatedId');
			
			   
			$brokerid = '';
			$mainbrokerid = '';
			$subbrokerid = '';
			$marketerid = '';
			$brokertype = '';
			
		    if($affid != null)
		    {
			  $broker_avail = $this->complaints->get_broker_by_id($affid);
			  if($broker_avail['type']=='broker')
					{	
						$brokerid = $broker_avail['id'];
						$mainbrokerid =$broker_avail['id'];
						$subbrokerid = '';
						$marketerid = '';
						$brokertype = $broker_avail['type'];
				    } 
				    else if($broker_avail['type']=='subbroker')
					{
						$brokerid = $broker_avail['id'];
						$mainbrokerid =$broker_avail['mainbrokerid'];
						$subbrokerid = '';
						$marketerid = '';
						$brokertype = $broker_avail['type'];  
												  
					}
				    else if($broker_avail['type']=='marketer')
					{
						$brokerid = $broker_avail['id'];
						$mainbrokerid =$broker_avail['mainbrokerid'];
						$subbrokerid = $broker_avail['subbrokerid'];
						$marketerid ='';
						$brokertype = $broker_avail['type'];  
												  
					}
					else if($broker_avail['type']=='agent')
					{
						$brokerid = $broker_avail['id'];
						$mainbrokerid =$broker_avail['mainbrokerid'];
						$subbrokerid = $broker_avail['subbrokerid'];
						$marketerid =$broker_avail['marketerid'];
						$brokertype = $broker_avail['type']; 
					
					}				   
				
		     }
			  
				
				
				
					

			//$company=$this->complaints->get_companyelite_by_emailid($email);
			$names=$this->complaints->find_company_for_check($name);	
                       
            if(count($names)==0)
			{ 
			    $email1 = $this->complaints->chkfield1(0,'email',$email);
			    $name1 = $this->complaints->chkfield1(0,'company',$name);
			
			//Inserting Record
                if($this->complaints->insert_business($name,$streetaddress,$city,$state,$country,$zip,$streetaddress1,$city1,$state1,$country1,$zip1,$phone,$email,$website,'','',$category,'',$brokerid,$mainbrokerid,$subbrokerid,$marketerid,$brokertype))
        		{
							
								$companyid = $this->db->insert_id();							
														
								$this->complaints->insert_contactdetails($companyid,$cname,$cphone,$cemail,$ctitle);
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
									$this->email->from('sales@yougotrated.com',$site_name);
									$this->email->to($to);
									$this->email->cc('sales@yougotrated.com');
                                    $this->email->subject($subject);
								
									$mail_body = str_replace("%name%",ucfirst($name),str_replace("%email%",$email,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat))))));
									
									$this->email->message($mail_body);
									$this->email->send();
																		
									$this->session->set_flashdata('success', 'Your business has successfully been registered');
									///redirect('solution/claim/'.$companyid, 'refresh');
									redirect('solution/claimbusiness', 'refresh');
									
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
				if(count($names)>0){
                                       
                                        $companyid=$names['id'];
                                       $update_businessadata=$this->complaints->update_business($companyid,$name,$streetaddress,$city,$state,$country,$zip,$streetaddress1,$city1,$state1,$country1,$zip1,$phone,$email,$website,'','',$category,'',$brokerid,$mainbrokerid,$subbrokerid,$marketerid,$brokertype); 
                                       if($update_businessadata){
                                        $contact_details=$this->complaints->insert_contactdetails($companyid,$cname,$cphone,$cemail,$ctitle);
                                        $companyseo=$this->complaints->insert_companyseo($companyid,$name);  
                                       }
					$formpost=$_POST;
					$this->eliteSubscribe($formpost,$companyid); // for authorise
				}
                          	
		}
	}
	public function businessadd()
	{   
		
		//Load REcaptcha again.
		$this->load->library('recaptcha');		
		//echo "<pre>";
		 //print_r($_POST);
		if($this->input->post('email'))
		{
			
			 //Call to recaptcha to get the data validation set within the class. 
             $this->recaptcha->recaptcha_check_answer();
			
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
			
			
			
            
            
           //var_dump($this->recaptcha->getIsValid());
			
			
			if($this->recaptcha->getIsValid() == true){
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
					redirect('solution', 'refresh');
					
				}
				else
				{ 
					 $email1 = $this->complaints->chkfield1(0,'email',$email);
					 $name1 = $this->complaints->chkfield1(0,'company',$name);
					
					if($email1=='new' && $name1=='new')
					{
							//Inserting Record
							if( $this->complaints->insert_businesses($name,$streetaddress,$city,$state,$country,$zip,$phone,$email,$website,'','',$category,'' ))
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
									$this->email->from('sales@yougotrated.com',$site_name);
									$this->email->to($to);
									$this->email->cc('sales@yougotrated.com');
									$this->email->subject($subject);
								
									$mail_body = str_replace("%name%",ucfirst($name),str_replace("%email%",$email,str_replace("%sitename%",$site_name,str_replace("%siteurl%",$site_url,str_replace("%siteemail%",$site_email,stripslashes($mailformat))))));
									
									$this->email->message($mail_body);
									$this->email->send();
									
									$this->session->set_flashdata('success', 'Your business has successfully been registered.');
									///redirect('solution/claim/'.$companyid, 'refresh');
									redirect('solution', 'refresh');
									
								}
								else
								{
									$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
									redirect('solution', 'refresh');
								}
							}
							else
							{
									$this->session->set_flashdata('error', 'There is error in adding Business. Try later!');
									redirect('solution', 'refresh');
							}
						
						
						
						redirect('solution', 'refresh');
					}
					else
					{
						if($email1=='old')
						{
							$this->session->set_flashdata('error', 'This company email address is already exists. Try later!');
							redirect('solution', 'refresh');	
						}
						if($name1=='old')
						{
							$this->session->set_flashdata('error', 'This company name is already exists. Try later!');
							redirect('solution', 'refresh');
						}
					}
				}
			}else{
				
                $this->session->set_flashdata('error','incorrect captcha');
                 redirect('businessdirectory/add', 'refresh');
                
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
	

public function eliteSubscribe($formpost,$companyid) {
	
	//data.php start
	//$loginname = $this->common->get_setting_value(22);
	//$transactionkey = $this->common->get_setting_value(23);
	
	/*test mode*/
	  /* $loginname="2sRT3yAsr3tA";
	   $transactionkey="38UzuaL2c6y5BQ88";
	   $host = "apitest.authorize.net"; */
	
	/*sandbox test mode*/
	
	  $loginname="83EK7S4R8qy3";
	   $transactionkey="5Rx8Mn8PAS5s77gr";
	   $host = "apitest.authorize.net";
	
	/*live
	    $loginname="5h7G7Sbr";
		$transactionkey="94KU7Sznk72Kj3HK";
		$host = "api.authorize.net";*/
	
	
	$path = "/xml/v1/request.api";
	//data.php end
	
	include('authorize/authnetfunction.php');
	$subscriptionprice = $this->common->get_setting_value(19);
	
	
	$disccode_user=$this->input->post('discountcode');
	$discountmethod=$this->complaints->get_discount_method($disccode_user);
	//$startDate = date("Y-m-d");
	$startDate=date('Y-m-d', strtotime("+30 days"));
        $auth_type=$_POST["auth_type"];
        $auth_transaction_id=$_POST["transactionid"];
        $amount = $subscriptionprice;
	$discid="";
	$disc="";
	$disccode_type="";
	$disccode_price="";
	$disccode_use="";
	
	if(count($discountmethod) > 0){
		
		    if($discountmethod['discountcodetype']=="30-days-free-trial"){
			        
			        $startDate=date('Y-m-d', strtotime("+60 days"));
					$discid=$discountmethod['id'];
					$disc=$discountmethod['code'];
					$disccode_type=$discountmethod['discountcodetype']; 
					$disccode_price=$discountmethod['discountprice']; 
					$disccode_use=1; 
	                $amount=$discountmethod['discountprice'];
			}
			else if($discountmethod['discountcodetype']=="normal-discount"){

                                 
				$discid=$discountmethod['id'];
				$disc=$discountmethod['code'];
				$disccode_type=$discountmethod['discountcodetype']; 
				$disccode_price=$discountmethod['discountprice']; 
				$disccode_use=1; 
				$amount=$discountmethod['discountprice'];
			}  
    }
	$refId = uniqid();
	$name = "YouGotRated Membership";
	$Description="YouGotRated Membership";
	$length = 1;
	$unit = "months";
	//$totalOccurrences = 999;
	$totalOccurrences = 9999;
	$trialOccurrences = 0;
	$trialAmount = 0;
	$cardNumber = $_POST["ccnumber"];
	$cvv=$this->input->post('cvv');	
			
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
	$cemail=$_POST["cemail"];				
	$address=$_POST["streetaddress"];
	$city=$_POST["city"];	
	$state=$_POST["state"];
	$zip=$_POST["zip"];
	$cid=$_POST["country"];
	$c_code=$this->complaints->get_country_by_countryid($cid);
	$country=$_POST["countryname"];
		
	
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
			"<cardCode>". $cvv . "</cardCode>".
			"</creditCard>".
			"</payment>".
			"<order>".
			"<description>" . $Description. "</description>".
			"</order>". 
			"<customer>".
			"<email>".$cemail."</email>".
			"</customer>".
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
			$payer_id=$cemail;
			$paymentmethod = 'authorize';
			$ccnumber=$_POST['ccnumber'];
			$cardexpire=$expirationDate;
			$fname=$firstName;
			$lname=$lastName;
			//if($this->complaints->insert_subscription($companyid,$amt,$ccnumber,$cardexpire,$fname,$lname,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId))
			if($this->complaints->insert_subscription($companyid,$amt,$ccnumber,$cvv,$cardexpire,$fname,$lname,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId,$auth_transaction_id,$auth_type,$disc,$disccode_type,$disccode_price,$disccode_use))
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
						$this->complaints->set_sem($companyid,"amazon","http://www.amazon.in","","","1",'a');
						$this->complaints->set_sem($companyid,"ebay","http://www.ebay.in","","","1",'e');
						$this->complaints->set_sem($companyid,"youtube","http://www.youtube.com","","","1",'y');
												
						$this->complaints->set_seo($companyid,"Google Analytic","Google Analytic","1");
						$this->complaints->set_seo($companyid,"Google Webmaster","Google Webmaster","1");
						$this->complaints->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords","1");
						$this->complaints->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description","1");
	
					}
							
					//Inserting Elite Membership Transaction Details for Company
					$transaction = $this->complaints->add_transaction($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
					$websites = $this->complaints->get_all_websites();
					
					//update to elite
					$this->complaints->insert_discountcode($companyid,$disc,$disccode_type,$disccode_price,$disccode_use);
					$this->complaints->update_discount_used($discid);							
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
					$email = $company[0]['contactemail'];
									
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
					$this->email->from($cemail,$company[0]['company']);
					$this->email->to('sales@yougotrated.com');	
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
                                        
					$mail = $this->common->get_email_byid(67);
					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['mailformat'];
					
					$this->email->from('sales@yougotrated.com',$site_name);
					$this->email->to($cemail);	
					$this->email->cc('sales@yougotrated.com'); 
                                        $this->email->subject($subject);
					$companyname=$company[0]['company'];
					$eliteemail=$cemail;
					$companyid=$company[0]['id'];
					$companyseo=$company[0]['companyseokeyword'];
					$url=site_url("widget/business/".$companyid);
					
					$mail_body = str_replace("%companyname%",ucfirst($companyname),
					             str_replace("%eliteemail%",$eliteemail,
					             str_replace("%password%",$password,
					             str_replace("%site_url%",$site_url,
					             str_replace("%amount%",$amount,
					             str_replace("%transactionkey%",$transactionkey,
					             str_replace("%url%",$url,
					             str_replace("%companyid%",$companyid,
					             str_replace("%companyseo%",$companyseo,
					             str_replace("%site_name%",$site_name,
								 stripslashes($mailformat)))))))))));
					$this->email->message($mail_body);
									
					//Sending mail user
					$this->email->send();
					$this->session->set_flashdata('success','Your payment has successfully been processed and your business has been claimed.');
					redirect('solution/success/'.$companyid,'refresh');
					
					
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
public function success($companyid)
{
	$this->data['company'] = $this->complaints->get_company_bysingleid($companyid);
	$this->data['subscription'] = $this->complaints->get_company_bysubscriptionid($companyid);
	$this->load->view('solution/success', $this->data);
}
function expires()
{
	$expirecron = $this->complaints->expirecrons();
	foreach($expirecron as $expire)
	{
		
		$company_id=$expire['company_id'];	
		$subscriptionId=$expire['subscr_id'];
		$subscription_amount=$expire['amount'];
		$paymentfailed_date=$expire['expires'];	
		$last_transaction=$expire['txn_id'];
		$cronemail=$this->complaints->get_elitesubscription_detailsbycompanyid($company_id);	
  
	    
	    
		$site_name = $this->common->get_setting_value(1);
	 	$site_url = $this->common->get_setting_value(2);
		$site_mail = $this->common->get_setting_value(5);      

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
						$this->config->load('email',TRUE);
						$this->cnfemail = $this->config->item('email');
										
						$this->email->initialize($config);
						$this->email->from('terminations@yougotrated.com',$site_name);
						$this->email->to($cronemail['contactemail']);
						$this->email->cc('terminations@yougotrated.com');
						$this->email->subject('Your Elite Membership has expired. Please renew');
						$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
																<tr>
																	<td>Hello '.ucfirst($cronemail['company']).',</td>
																</tr>
																<tr><td><br/></td></tr>
																<tr>
																	<td style="padding-left:20px;">
																	 Your credit card payment is failed. Your account will be active for 24 hours and you can update your credit card information in your elite admin.
																	</td>
																</tr>
																<tr>
																	<table cellpadding="0" cellspacing="0" width="50%" border="0">
																		<tr><td colspan="3"><h3>Payment Transaction Detail</h3></td></tr>
																		<tr>
																			<td>Subscription ID</td>
																			<td>:</td>
																			<td>'.$subscriptionId.'</td>
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
																			<td>Payment Failed Date</td>
																			<td>:</td>
																			<td><b>'.$paymentfailed_date.'</b></td>
																		</tr>
																		</table>
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
												</table>');
											
											
						//Sending mail to admin
						if($this->email->send())
						{
							$this->complaints->expirecronupdate($expire['company_id']);
						}
	}
}

public function cron()
{	
	$crons=$this->complaints->elitecrondetails();
	
	 /*sandbox test mode
      $loginname="83EK7S4R8qy3";
      $transactionkey="5Rx8Mn8PAS5s77gr";
      $host = "apitest.authorize.net";*/
   
	   /*live*/
		$loginname="5h7G7Sbr";
		$transactionkey="94KU7Sznk72Kj3HK";
		$host = "api.authorize.net";
		   
	    $path = "/xml/v1/request.api";
	    include('authorize/authnetfunction.php');
    
         foreach($crons as $con){
	  
	  	$subscriptionId=$con['subscr_id'];
		$subscription_amount=$con['amount'];
		$paymentfailed_date=$con['expires'];
		$company_id=$con['company_id'];
		$last_transaction=$con['txn_id'];
		$emailcompany=$company_id;
		$cronemail=$this->complaints->get_elitesubscription_detailsbycompanyid($emailcompany);	
	    $transactionresponse=$con['transactionresponse'];   
       
        $disable_elite=$this->complaints->disable_elitemembership($company_id);
        
        $site_name = $this->common->get_setting_value(1);
	 	$site_renewurl=$site_name.'solution/renew/'.$company_id;
	 	$site_base_url=base_url().'solution/renew/'.$company_id;
	 	$site_urls = $this->common->get_setting_value(2).'solution/renew/'.$company_id;
	 	$site_url = $this->common->get_setting_value(2);
		
		$secureurl=str_replace('http://', 'https://',$site_urls);
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
		
			if($code=='Ok')
			{
			   $site_mail = $this->common->get_setting_value(5);      
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
				
					   if($transactionresponse!=""){ $authresponse="or&nbsp;".$transactionresponse;} else { $authresponse=""; }
					 
						//$this->email->initialize($this->cnfemail);
						$this->email->initialize($config);
						$this->email->from('terminations@yougotrated.com',$site_name);
						$this->email->to($cronemail['contactemail']);
						$this->email->cc('terminations@yougotrated.com');
						$this->email->subject('Your Elite Membership has expired. Please renew');
						$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
																<tr>
																	<td>Hello '.ucfirst($cronemail['company']).',</td>
																</tr>
																<tr><td><br/></td></tr>
																<tr>
																	<td style="padding-left:20px;">
																	 Your subscription for an Elitemembership with YouGotRated has been deactivated due to credit card payment failure '.$authresponse.'.
																	</td>
																</tr>
																<tr>
																	<table cellpadding="0" cellspacing="0" width="50%" border="0">
																		<tr><td colspan="3"><h3>Payment Transaction Detail</h3></td></tr>
																		<tr>
																			<td>Subscription ID</td>
																			<td>:</td>
																			<td>'.$con['subscr_id'].'</td>
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
																			<td>Payment Failed Date</td>
																			<td>:</td>
																			<td><b>'.$paymentfailed_date.'</b></td>
																		</tr>
																		<tr>
																			<td style="padding-top:20px;">
																			 To renew, and reactivate your Elitemembership Subscription- Please click the following link:
																			 <a href="'.$site_urls.'" title="'.$site_name.'">'.$site_urls.'</a>. <br>
																			</td>
																		</tr>	
																		</table>
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
												</table>');
												
						//Sending mail to admin
						$this->email->send();
						
			}
 
           }			
		$this->adminreport();
		$this->cc_alerted();			
		
	}
	
}
public function cc_alerted()
{
   $ccalert=$this->complaints->ccexpire_email();
  
   $site_mail = $this->common->get_setting_value(5);
   $site_name = $this->common->get_setting_value(1);
   $site_url = $this->common->get_setting_value(2);
   $site_urls = $this->common->get_setting_value(2).'businessadmin/';
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
				
        if(count($ccalert) > 0) {
	        foreach($ccalert as $ccalerter){
				    
            	        $company_id=$ccalerter['company_id'];
				        $companydetails=$this->complaints->get_company_byid($company_id); 
			           	$this->email->clear();
						$this->email->from('memberships@yougotrated.com',$site_name);
						$this->email->to($companydetails[0]['contactemail']);	
						$this->email->cc('memberships@yougotrated.com');
						$this->email->subject('Your EliteMembership Subscription credit card will expire in 15 days.');
						$this->email->message('<table cellpadding="0" cellspacing="0" width="100%" border="0">
															<tr>
																<td>Hello '.$companydetails[0]['company'].',</td>
															</tr>
															<tr><td><br/></td></tr>
															<tr>
																<td style="padding-left:20px;">
																Your subscription to Elitemembership with YouGotRated will expire in 15 days due to your credit card expiration date. To avoid account
																cancellation, please log into your elite admin area to update your credit expiration date:
																'.$site_urls.'
																</td>
															</tr>
															<tr>
																<table cellpadding="0" cellspacing="0" width="50%" border="0">
																	<tr><td colspan="3"><h3>Payment Transaction Detail</h3></td></tr>
																	<tr>
																		<td>Subscription ID</td>
																		<td>:</td>
																		<td>'.$ccalerter['subscr_id'].'</td>
																		
																	</tr>
																	<tr>
																		<td>Subscription Amount</td>
																		<td>:</td>
																		<td>'.$ccalerter['amount'].'</td>
																		
																	</tr>
																	<tr>
																		<td>Transacion ID</td>
																		<td>:</td>
																		<td>'.$ccalerter['txn_id'].'</td>
																		
																	</tr>
																	<tr>
																		<td>Last Payment Made</td>
																		<td>:</td>
																		<td>'.$ccalerter['payment_date'].'</td>
																	
																	</tr>
																	</table>
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
											</table>');
											
					
						//Sending mail to admin
						$this->email->send();
								
					}					
						
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
					if(count($reportfailed) > 0){
						$fail='<table style="padding-left: 16px;margin-top: -20px;">
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
							 
					}
					else
					{
						
						$fail='<table>
								 <tr>
								 </tr>';
							
							$fail .='<tr>
									 <td style="padding-left: 20px;">No Failed Transactions</td>
									</tr>';
							$fail .='</table>';
						
					}         
                    //success retreive   
                    
                    //echo '<pre>';print_r($reportsuccess); 
                    
                    $paymentdate= '';
					$subscr_id = '';
					$Expire='';
					$status='';
					
					if(count($reportsuccess) > 0){
							$success='<table style="padding-left: 16px;margin-top: -20px;">
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
                    }
					 else
					 {
						$success='<table>
									 <tr>
								     </tr>';
						$success .='<tr>
									 <td style="padding-left: 20px;">No successful Transactions</td>
									</tr>';
						$success .='</table>'; 	
						
					 }    
                     
                     
                     $site_name = $this->common->get_setting_value(1);
					 $site_url = $this->common->get_setting_value(2);
					 $site_mail = $this->common->get_setting_value(5);      
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
					$this->email->to('memberships@yougotrated.com');	
					$this->email->subject('Todays Report On Success and Failed Payments On Date  '.$todaysdate.'');
					$this->email->message('<table cellpadding="0" cellspacing="10" width="100%" border="0">
															<tr>
																<td>Hello Administration,</td>
															</tr>
															<tr></tr>
															<tr>
																<td style="padding-left:20px;">
																Todays Report on Success and Failed payments On following Date '.$todaysdate.' . Details are as follows.
																</td>
															</tr>
															<tr>
																<td>
																	<table cellpadding="10" cellspacing="10" width="100%" border="0">
																	<tr><td colspan="3"><h4 style="text-transform: uppercase;">Payment Details</h4></td></tr>
																	<tr>
																		<td><b><u>Failed Transaction Payments Today</u></b></td><br>
																	</tr>
																	<tr style="padding-top:20px;">
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
																		<td><b><u>Successful Transaction Payments Today</u></b></td><br>
																	</tr>
																	<tr style="padding-top:20px;">
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
												  The '.$site_name.' Team.<br/>
												  <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a></td>
											   </tr>
											</table>');
											
											
					//Sending mail to admin
					$this->email->send();
	
	
}
public function renew($id)
{
	//echo $id;
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
	
	/*sandbox test mode
	  $loginname="9um8JTf3W";
	   $transactionkey="9q24FTz678hQ9mAD";
	   $host = "apitest.authorize.net"; */
	
	
	/*live*/
	$loginname="5h7G7Sbr";
	$transactionkey="94KU7Sznk72Kj3HK";
	$host = "api.authorize.net";
	
	
	$path = "/xml/v1/request.api";
	//data.php end
	//echo '<pre>';print_r($_POST);
	
	$firstName = $_POST["fname"];
	$lastName = $_POST["lname"];	
	$email = $this->input->post('email');					
	$address=$_POST["streetaddress"];
	$city=$_POST["city"];	
	$state=$_POST["state"];
	$zip=$_POST["zip"];
	$country=$_POST["countryname"]; 
	$cvv=$this->input->post('cvv');
	$customeremail=$_POST["cemail"];
	include('authorize/authnetfunction.php');
	$subscriptionprice = $this->common->get_setting_value(19);
	
	//check previously paid amount for elitemembership//
	
	$amount = $subscriptionprice;
	$previouspayment=$this->complaints->get_companyelite_byid($id);
	if(!empty($previouspayment['payment_amount']))	{
		
		$amount = $previouspayment['payment_amount'];
		
	 } 	
	//define variables to send
	
	$refId = uniqid();
	$name = "YouGotRated Membership";
	$Description="YouGotRated Membership";
	$length = 1;
	$unit = "months";
	$startDate = date("Y-m-d");
	//$totalOccurrences = 999;
	$totalOccurrences = 9999;
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
			"<cardCode>". $cvv . "</cardCode>".
			"</creditCard>".
			"</payment>".
			"<customer>".
			"<email>".$customeremail."</email>".
			"</customer>".
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
		//echo $resultCode;
		
		if($resultCode=='Ok')
		{
			//update status in elite table and subscription table
			
			
			$sig=$refId;
			$tx  = $transactionkey;
			$amt = $amount;
			$companyid  = $id;
			$time = $this->common->get_setting_value(18);
			$expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
			$payer_id=$email;
			$paymentmethod = 'authorize';
			$emailflag='1';
			
			$ccnumber=$_POST['ccnumber'];
			$cardexpire=$expirationDate;
			$fname=$firstName;
			$lname=$lastName;
			
			
                      
                         $update_subscription=$this->complaints->update_subscription($subscriptionId,$companyid,$amt,$ccnumber,$cvv,$cardexpire,$fname,$lname,$tx,$sig,$time,$expires,$payer_id,$paymentmethod,$emailflag);
                         
			if($update_subscription)
			{

			  $update_companytable=$this->complaints->update_company($address,$city,$state,$country,$zip,$companyid);	
			  $update_elite= $this->complaints->update_elite($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
			
				    
				   
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
					$this->email->from($cronemail['contactemail'],$cronemail['company']);
					$this->email->to('memberships@yougotrated.com');	
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
					$emailto=$cronemail['contactemail'];
					$this->email->from('memberships@yougotrated.com',$site_name);
					$this->email->to($emailto);
					$this->email->cc('memberships@yougotrated.com');	
					$this->email->subject('Your Elite Membership has been renewed.');
					$this->email->message( '<table cellpadding="0" cellspacing="0" width="100%" border="0">
											  <tr>
												<td>Hello <b>'.ucfirst($cronemail['company']).'</b>,</td>
											  </tr>
											  <tr>
												<td><br/></td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"> You have successfully renewed your Elite Membership </td>
											  </tr>
											 <tr>
												<td style="padding-left:20px;">To Continue Enjoying your Elitemembership login at  <a href="'.$site_url.'businessadmin/'.'" title="'.$site_name.'">'.$site_name.'</a>  using your existing username and password details.</td>
											  </tr>
											  <tr>
												<td style="padding-left:20px;"> The details of your renewal are as follows. </td>
											  </tr>
											  <tr>
												<td><table cellpadding="0" cellspacing="0" width="50%" border="0">
													<tr>
													  <td colspan="3"><h3>Renewal Payment Transaction Detail</h3></td>
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
												  The '.$site_name.' Staff.<br/>
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

public function upgrades($companyid)
{
	//data.php start
	//$loginname = $this->common->get_setting_value(22);
	//$transactionkey = $this->common->get_setting_value(23);
	
	
	/*test mode*/
	  /* $loginname="2sRT3yAsr3tA";
	   $transactionkey="38UzuaL2c6y5BQ88";
	   $host = "apitest.authorize.net"; */
	
	/*sandbox test mode
	
	  $loginname="83EK7S4R8qy3";
	   $transactionkey="5Rx8Mn8PAS5s77gr";
	   $host = "apitest.authorize.net";*/
	
	
	/*live*/
	    $loginname="5h7G7Sbr";
	    $transactionkey="94KU7Sznk72Kj3HK";
            $host = "api.authorize.net";
	
	
	$path = "/xml/v1/request.api";
	//data.php end
	
	include('authorize/authnetfunction.php');
	$subscriptionprice = $this->common->get_setting_value(19);
	$disccode_user=$this->input->post('discountcode');
	$discountmethod=$this->complaints->get_discount_method($disccode_user);
	$startDate = date("Y-m-d");
	$amount = $subscriptionprice;
	$discid="";
	$disc="";
	$disccode_type="";
	$disccode_price="";
	$disccode_use="";
	
	if(count($discountmethod) > 0){
		
		    if($discountmethod['discountcodetype']=="30-days-free-trial"){
			        
			        $startDate=date('Y-m-d', strtotime("+30 days"));
					$discid=$discountmethod['id'];
					$disc=$discountmethod['code'];
					$disccode_type=$discountmethod['discountcodetype']; 
					$disccode_price=$discountmethod['discountprice']; 
					$disccode_use=1; 
	                $amount=$discountmethod['discountprice'];
			}
			else if($discountmethod['discountcodetype']=="normal-discount"){

                                 
				$discid=$discountmethod['id'];
				$disc=$discountmethod['code'];
				$disccode_type=$discountmethod['discountcodetype']; 
				$disccode_price=$discountmethod['discountprice']; 
				$disccode_use=1; 
				$amount=$discountmethod['discountprice'];
			}  
    }	   
	//define variables to send
	$refId = uniqid();
	$names = "YouGotRated Membership";
	$Description="YouGotRated Membership";
	$length = 1;
	$unit = "months";
	$startDate = date("Y-m-d");
	//$totalOccurrences = 999;
	$totalOccurrences = 9999;
	$trialOccurrences = 0;
	$trialAmount = 0;
	$cardNumber = $_POST["ccnumber"];
	$cvv=$this->input->post('cvv');
	$auth_type=$_POST["auth_type"];
        $auth_transaction_id=$_POST["transactionid"];
	
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
			
	//companyinformation
	$name=$_POST["name"];
	$phone=$_POST["phone"];
	$website=$_POST["website"];
	$cat = $this->input->post('cat');
					if($cat!='')
					{
						$category1=implode(',',$cat);
					}
					else
					{
						$category1='1';
					}
	$category=$category1;				
	$email = $this->input->post('email');		
	
	//contact information
	$cname=$_POST["cname"];
	$cemail=$_POST["cemail"];
	$cphone=$_POST["cphone"];
	$ctitle=$_POST["ctitle"];
	
	//billing address
	$address=$_POST["streetaddress"];
    $city=$_POST["city"];	
	$state=$_POST["state"];
    $zip=$_POST["zip"];
  	$country=$_POST["countryname"];
	
	//business address	
	$address1=$_POST["streetaddress1"];
    $city1=$_POST["city1"];	
	$state1=$_POST["state1"];
    $zip1=$_POST["zip1"];
  	$country1=$_POST["countryname1"];
	
	
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
			"<name>" . $names . "</name>".
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
            "<cardCode>". $cvv . "</cardCode>". 
			"</creditCard>".
			"</payment>".
			"<customer>".
			"<email>".$cemail."</email>".
			"</customer>".
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
			$ccnumber=$_POST['ccnumber'];
			$cardexpire=$expirationDate;
			$fname=$firstName;
			$lname=$lastName;
			//if($this->complaints->insert_subscription($companyid,$amt,$ccnumber,$cardexpire,$fname,$lname,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId))
			if($this->complaints->insert_subscription($companyid,$amt,$ccnumber,$cvv,$cardexpire,$fname,$lname,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscriptionId,$auth_transaction_id,$auth_type,$disc,$disccode_type,$disccode_price,$disccode_use))
                            {
				$company = $this->complaints->get_company_byid($companyid);
                
                ///update company details here 
                //$this->complaints->insert_business($name,$streetaddress,$city,$state,$country,$zip,$streetaddress1,$city1,$state1,$country1,$zip1,$phone,$email,$website,'','',$category,'',$brokerid,$mainbrokerid,$subbrokerid,$marketerid,$brokertype ))
                
                
                $update_business=$this->complaints->update_businessdetails($companyid,$name, $address,$city,$state,$country,$zip,
									 $address1,$city1,$state1,$country1,$zip1,$phone,$email,
									 $website,$category);                           
                $this->complaints->insert_contactdetails($companyid,$cname,$cphone,$cemail,$ctitle);                
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
						$this->complaints->set_sem($companyid,"amazon","http://www.amazon.in","","","1",'a');
						$this->complaints->set_sem($companyid,"ebay","http://www.ebay.in","","","1",'e');
						$this->complaints->set_sem($companyid,"youtube","http://www.youtube.com","","","1",'y');
												
						$this->complaints->set_seo($companyid,"Google Analytic","Google Analytic","1");
						$this->complaints->set_seo($companyid,"Google Webmaster","Google Webmaster","1");
						$this->complaints->set_seo($companyid,"General Meta Tag Keywords","General Meta Tag Keywords","1");
						$this->complaints->set_seo($companyid,"General Meta Tag Description","General Meta Tag Description","1");
	
					}
							
					//Inserting Elite Membership Transaction Details for Company
					$transaction = $this->complaints->add_transaction($companyid,$amount,'USD',$transactionkey,date('Y-m-d H:i:s'));
					$websites = $this->complaints->get_all_websites();
												

                                        $this->complaints->insert_discountcode($companyid,$disc,$disccode_type,$disccode_price,$disccode_use);
					$this->complaints->update_discount_used($discid);
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
					$email = $company[0]['contactemail'];
									
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
					$this->email->from($cemail,$company[0]['company']);
					$this->email->to('sales@yougotrated.com');	
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
                                        $mail = $this->common->get_email_byid(67);
					$subject = $mail[0]['subject'];
					$mailformat = $mail[0]['mailformat'];
					
					$this->email->from('sales@yougotrated.com',$site_name);
					$this->email->to($cemail);
					$this->email->cc('sales@yougotrated.com');	
					$this->email->subject($subject);
					$companyname=$company[0]['company'];
					$eliteemail=$cemail;
					$companyid=$company[0]['id'];
					$companyseo=$company[0]['companyseokeyword'];
					$url=site_url("widget/business/".$companyid);
					
					$mail_body = str_replace("%companyname%",ucfirst($companyname),
					             str_replace("%eliteemail%",$eliteemail,
					             str_replace("%password%",$password,
					             str_replace("%site_url%",$site_url,
					             str_replace("%amount%",$amount,
					             str_replace("%transactionkey%",$transactionkey,
					             str_replace("%url%",$url,
					             str_replace("%companyid%",$companyid,
					             str_replace("%companyseo%",$companyseo,
					             str_replace("%site_name%",$site_name,
								 stripslashes($mailformat)))))))))));
					$this->email->message($mail_body);
									
					//Sending mail user
					$this->email->send();
					$this->session->set_flashdata('success','Your payment has successfully been processed and your business has been claimed.');
					redirect('solution/success/'.$companyid,'refresh');
					
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
		
	  /*get Discount Code*/
	  
	  if($this->input->post('type')=='checkDiscountCode')  {	
		  
		  if( $this->input->is_ajax_request() && ( $this->input->post('discountcode') ) ){
				$discountcode=$this->input->post('discountcode');
				$discountusage=$this->complaints->get_discount_enabled($discountcode);
				$defaultprice=$this->common->get_setting_value(19);
				if(empty($discountusage)){ 
					
					$discountusage['discstatus']='failure';
					$discountusage['subscriptionprice']='$'.$defaultprice;
					echo json_encode($discountusage);
								
				} else { 
					
					if($discountusage['percentage']==0 && $discountusage['discountcodetype']=='30-days-free-trial'){						
						$discountusage['monthlycost']='1st mo free then $'.$discountusage['discountprice'].'/mo';
						$discountusage['monthlyprice']=$discountusage['discountprice'];
						$discountusage['subscriptionprice']='$'.$defaultprice;
					}
					else if($discountusage['percentage']!="" && $discountusage['discountcodetype']=='30-days-free-trial'){
						
						$discountusage['monthlycost']='1st mo free then $'.$discountusage['discountprice'].'/mo';
						$discountusage['monthlyprice']=$discountusage['discountprice'];
						$discountusage['subscriptionprice']='$'.$defaultprice; 
					}
					else if($discountusage['percentage']!="" && $discountusage['discountcodetype']=='normal-discount'){
						
						$discountusage['monthlycost']='$'.$discountusage['discountprice'];
						$discountusage['monthlyprice']=$discountusage['discountprice'];
						$discountusage['subscriptionprice']='$'.$defaultprice;
					}
					$discountusage['discstatus']='success';
					echo json_encode($discountusage);
					
				}
			}
		}
		
		/*check Email*/
		if($this->input->post('type')=='checkEmail'){
			if( $this->input->is_ajax_request() && ( $this->input->post('email') ) ){
				$email=$this->input->post('email');
				$emailStatus = array();
				$company = $this->complaints->get_companyelite_by_emailid($email);
				if(count($company)>0)
				{
					$emailStatus['status'] = "error";
					$emailStatus['emailError'] = "This company email address is already exists. Try later!";
					$emailStatus['checkvalue']="0";
                                        echo json_encode($emailStatus);
				}else{
					$emailStatus['status'] = "success";
                                        $emailStatus['checkvalue']="1"; 
					echo json_encode($emailStatus);					
				}
			}				
		}		
		/*check checkCompanyname*/
		if($this->input->post('type')=='checkCompanyname'){
			if( $this->input->is_ajax_request() && ( $this->input->post('name'))){
				$company=$this->input->post('name');
				$nameStatus = array();
				$companyname = $this->complaints->find_elitecompany_for_check($company);
				if(count($companyname)>0)
				{
					$nameStatus['status'] = "error";
					$nameStatus['nameError'] = "This company Name already exists. Try later!";
					$nameStatus['checkname']="0";
                                        echo json_encode($nameStatus);
				}else{
					$nameStatus['status'] = "success";
                                        $nameStatus['checkname']="1"; 
					echo json_encode($nameStatus);
					return true;
				}
			}				
		}		
		
		
	}
	
	function companystreetcheck()
	{
		if($this->input->post('streetaddress'))
		{
			$data = $this->complaints->companystreetvalid($this->input->post('company'),$this->input->post('streetaddress'));
		}
		else if($this->input->post('streetaddress1'))
		{
			$data = $this->complaints->companystreetvalid1($this->input->post('company'),$this->input->post('streetaddress1'));
		}
		$comstr = array();
		if($data == 1)
		{
			$comstr['status'] = "1";
			$comstr['vals'] = "1";
			$comstr['txt'] = "It appears there is already an elite account with this business name and address. Please contact us if you believe this is incorrect.";
            
		}
		else
		{
			$comstr['status'] = "0";
			$comstr['vals'] = "0";
			
		}
		echo json_encode($comstr);
	}
	
	


/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
}

