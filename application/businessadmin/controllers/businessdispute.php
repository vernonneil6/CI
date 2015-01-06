<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Businessdispute extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		if( !$this->session->userdata('youg_admin'))
	  	{
	      	redirect('adminlogin', 'refresh');
		}
		
		//Loading Helper File
	 	$this->load->helper('form');
			
		//Loading Model File
	  	
        $this->load->model('businessdisputes');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Business Disputes';
		$this->data['section_title'] = 'Business Disputes';
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
				
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata('siteid');
			
			$this->load->library('pagination');
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			//Addingg Setting Result to variable
			$this->data['companydispute'] = $this->businessdisputes->listdispute($limit,$offset);
			
			$this->paging['base_url'] = site_url("businessdispute/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = $this->businessdisputes->dispute_count();
			$this->pagination->initialize($this->paging);
			
			
            //$this->data['companydispute']=$this->businessdisputes->disputedetail();
			$this->load->view('businessdispute',$this->data);
	  	}
                
	}
	public function update($id)
	{
	
			if($this->input->post('mysubmit'))
			{
				  $this->businessdisputes->updateissue($id);
			}   
			redirect('businessdispute','refresh');
			
                
	}
	public function review($id)
	{
		if($this->session->userdata['youg_admin'])
	  {
			$data=$this->businessdisputes->reviewbusinessdispute($id);
            $this->data['disputeid']=$data['id'];
            $this->data['dispute']=$data['dispute'];
            $this->data['companyname']=$data['companyname'];
            $this->data['companyemail']=$data['companyemail'];
            $this->data['companyid']=$data['companyid'];
            $this->data['userid']=$data['userid'];
            $this->data['username']=$data['username'];
            $this->data['useremail']=$data['useremail'];
            $this->data['status']=$data['status'];
            $this->data['issue']=$data['issuestatus'];
            $this->data['date']=$data['ondate'];
            $this->data['closedate']=$data['closeddate'];
			//Loading View File
			$this->load->view('businessdisputereview',$this->data);
	  }
	}
	
	public function messages($msglink)
	{
		if($this->session->userdata['youg_admin'])
	  {
		$data=$this->businessdisputes->getdetails($msglink);
		$this->data['companyname']=$data['companyname'];
		$this->data['companyid']=$data['companyid'];
		$this->data['username']=$data['username'];
		$this->data['userid']=$data['userid'];
		$this->data['dispute']=$data['dispute'];
		$this->data['status']=$data['status'];
		$this->data['disputeid']=$data['id'];
		$this->data['msglink']=$data['msglink'];
		
		
		$this->data['showmessage']=$this->businessdisputes->getmessages($msglink);
		$this->load->view('businessmessage',$this->data);
		
	  }
	} 
	
	public function message_insert()
	{
		if($this->input->post('postmessage'))
	   	{  
			$config['upload_path'] = './uploads/message/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '10000';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$this->load->library('upload', $config);
			
			$companyname =$this->input->post('companyname');	
			$companyid =$this->input->post('companyid');	
			$toid =$this->input->post('toid');	
			$fromid =$this->input->post('fromid');	
			$username =$this->input->post('username');	
			$userid =$this->input->post('userid');	
			$dispute =$this->input->post('dispute');	
			$disputeid =$this->input->post('disputeid');
			$messages =$this->input->post('messages');	
			$status =$this->input->post('status');	
			$date =$this->input->post('date');	
			$msglink =$this->input->post('msglink');
			$imageupload ='nofile';
		    $this->businessdisputes->message_insert($companyname,$companyid,$toid,$fromid,$username,$userid,$dispute,$disputeid,$messages,$status,$date,$msglink,$imageupload);		  
		    redirect('businessdispute/messages/'.$msglink,'refresh');
		  
	
					
		}
	  
	}
	public function resolution($disputeid)
	{
		if($this->session->userdata['youg_admin'])
		  {
			$data=$this->businessdisputes->resolution_details($disputeid);
			$this->data['companyname']=$data['companyname'];
			$this->data['companyid']=$data['companyid'];
			$this->data['companyemail']=$data['companyemail'];
			$this->data['username']=$data['username'];
			$this->data['userid']=$data['userid'];
			$this->data['useremail']=$data['useremail'];
			$this->data['dispute']=$data['dispute'];
			$this->data['status']=$data['status'];
			$this->data['disputeid']=$data['id'];
			$this->data['msglink']=$data['msglink'];
			$this->data['uploads']=$data['resolution_upload'];
			$this->data['resolutionexpect']=$data['resolutionexpect'];
			$this->data['carrier']=$data['carrier'];
			$this->data['tracking']=$data['tracking'];
			$this->data['dateshipped']=$data['dateshipped'];
			
			$id=$this->session->userdata['youg_admin']['id'];
			$data=$this->businessdisputes->get_merchant($id);  
			$this->data['m_company']=$data['company'];  
			$this->data['m_streetaddress']=$data['streetaddress'];  
			$this->data['m_city']=$data['city'];  
			$this->data['m_state']=$data['state'];  
			$this->data['m_zip']=$data['zip']; 
				
			
			
			//email flag check for alert mail
			$data=$this->businessdisputes->emailflag($disputeid); 
			$this->data['emailflag']=$data['emailcheck'];
			$this->data['alertdate']=$dates;
			$this->load->view('disputeresolution',$this->data);
		  }
			
	}
	
	public function resolution_update($disputeid)
	{   
		 
		       
			 if($this->input->post('mysubmit'))
			{   
					
					$this->load->library('upload'); 
					
					$config['upload_path'] = '../uploads/message/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size']	= '1000000';
					$resolutionoption=$this->input->post('resolutionopt');
					$notes=$this->input->post('notes');
					$resolutiondate=$this->input->post('resolutiondate');
					$emailflag=$this->input->post('emailflag');
					$multi_images_array = array();
					$carrier=$this->input->post('carrier');
			        $tracking=$this->input->post('tracking');
			        $dateshipped=$this->input->post('dateshipped');
					
					foreach($_FILES['images']['name'] as $key => $image)
					{ 
						 $_FILES['images'.$key]['name']= $_FILES['images']['name'][$key];
						 $_FILES['images'.$key]['type']= $_FILES['images']['type'][$key];
						 $_FILES['images'.$key]['tmp_name']= $_FILES['images']['tmp_name'][$key];
						 $_FILES['images'.$key]['error']= $_FILES['images']['error'][$key];
						 $_FILES['images'.$key]['size']= $_FILES['images']['size'][$key];
						
						if(!empty($_FILES['images'.$key]['name'])) 
						{	
							
							$this->upload->initialize($config);
							if($this->upload->do_upload('images'.$key))
							{
								
								$imgdata = $this->upload->data();
								$multi_images_array[] = $imgdata['file_name'];
								$imgdata = implode(",",$multi_images_array);							
								$this->businessdisputes->resolutionupdate($disputeid,$imgdata,$resolutionoption,$notes,$resolutiondate,$emailflag,$carrier,$tracking,$dateshipped);
								
									 
					
							}
						}
							else
							{   
								$emailflag=$this->input->post('emailflag');
								$errors = $this->upload->display_errors();
								$imgdata ='';
								$this->businessdisputes->resolutionupdate($disputeid,$imgdata,$resolutionoption,$notes,$resolutiondate,$emailflag,$carrier,$tracking,$dateshipped);
								
					
							}
						
					}
				  
				  
			 
			            //Upload Shipping Information option//
	                    //values passed for email
	                    $companyname=$this->input->post('companyname');
     					$companyemail=$this->input->post('companyemail');
						$companyid=$this->input->post('companyid');
					    $username=$this->input->post('username'); 
						$useremail=$this->input->post('useremail');
						$userid=$this->input->post('userid');
			            $dispute=$this->input->post('dispute');
			            $resolution_expect=$this->input->post('resolutionexpect'); 
			            $msglink=$this->input->post('msglink');   
			           			           
			            $merchant=$this->input->post('merchantname');
			            $address=$this->input->post('address');
			            $city=$this->input->post('city');
			            $state=$this->input->post('state');
			            $zipcode=$this->input->post('zipcode');
			            
			            $site_name = $this->settings->get_setting_value(1);
						$site_url = $this->settings->get_setting_value(2);
						$site_email = $this->settings->get_setting_value(5); 
			            
			            $this->load->library('email'); 
			            if(trim($dispute) == 'Item Not Received')
			            {
							
							        
									$this->email->from($site_email,$site_name);
								    $this->email->to($useremail);
								    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
									$this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
								  <tr>
								  <td>Hello '.$username.',</td>
								  </tr>
									<tr>
										<td> '.$companyname.' has indicated that your order has been shipped. Here is the Information:
											<ul>
											<li>Carrier:'.$carrier.'</li>
											<li>Tracking Number:'.$tracking.'</li>
											<li>Date Shipped:'. $dateshipped.'</li>
											</ul>
										</td>
									</tr>
									<tr>
									  <td>Please allow sufficient time for the items to reach you.</td>
									<tr>

									<tr> 
									  <td>Once you receive the item and you are satisfied with your purchase, please follow the link below to close this case.</td>
									</tr>

									<tr>
									<td>Damage Policy:
									<ul>
									<li>All items are shipped to you in the best possible packaging to ensure that you receive your purchase in perfect condition. Upon receipt, please inspect your package closely.</li>
									<li>If you receive a damaged item, we will assist you in receiving a replacement or refund as quickly as possible - at no cost to you.</li>
									<li>Should you observe significant damage to the outer packaging, please reject the shipment and have the carrier return it.</li>
									<li>If there is minor damage to the packaging, please indicate as such when you sign for the shipment.</li>
									<li>In the unlikely event that you find your product to be damaged upon opening it please return to the Resolution Center within 5 days of receipt and change the nature of your dispute so we can continue to assist you.</li>
									<ul>
									</td>
									</tr>
									<tr>
									  <td>Please follow this link to the Resolution Center <a href="'.$site_url.'dispute/message/'.$msglink.'">'.$site_url.'dispute/message/'.$msglink.'</a></td>
									</tr>

									<tr>
									  <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
									</tr>

									<tr>
									  <td>Sincerely,</td>
									</tr>

									<tr>
									  <td>YouGotRated</td>
									</tr>
									<tr>
									  <td>Buyer Protection Program</td>
									</tr>

									<tr>
									 <td>BC: PP-003-442-048-286</td>
									</tr>
									<tr>
									<td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td></tr>

									<tr>
									  <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
									</tr>
								</table>');
									$this->email->send(); // send email to admin
							
						}
						
						if(trim($dispute) =='Item Not as Described')  
						{
							
					 	        
								$this->email->from($site_email,$site_name);
								$this->email->to($useremail);
          						$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
					            $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					                 
					                 <tr>
							 <td>Hello '.$username.',</td>
							</tr>
							<tr>
							 <td>'.$companyname.' has agreed to offer you a full refund.</td>
							</tr>
							<tr>
							 <td>You must first return the damaged merchandise to the following address provided by the Merchant within 7 days of this email:
								 <ul>
									 <li>Merchants Name:'.$merchant.'</li>
									 <li>Address:'.$address.'</li>
									 <li>City:'.$city.'</li>
									 <li>State:'.$state.'</li> 
									 <li>Zip Code:'.$zipcode.'</li>
								 </ul>
							 </td>
							</tr>
							<tr>
							 <td>For your protection, please ensure that the items are properly packaged and that you send them Fully Insured and with Signature Required.<br>

								Once you have shipped the items, you must returned to this page to upload the Tracking Information within 7 days or this case will be automatically closed.

								The Merchant will issue your refund within 5 business days of receipt and inspection of the returned merchandise.
							</td>
							</tr>
							
							<tr>
							 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>
							<tr>
							 <td>Sincerely,</td>
							</tr>
							<tr>
							 <td>YouGotRated</td>
							</tr>
							<tr>
							 <td>Buyer Protection Program</td>
							</tr>
							<tr>
							 <td>BC: PP-003-442-048-286</td>
							</tr>
							<tr>
							 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center</td>
							</tr>
							<tr>
							 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
				    
					        </table>');
					  
									  
						$this->email->send(); // send email to admin	
						
					    }
					    
					    if(trim($dispute) =='Item Received Damaged' and trim($resolution_expect) =='Would like a Full Refund')  
						{
							
							
					 	        
								$this->email->from($site_email,$site_name);
								$this->email->to($useremail);
								$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
					            $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					                 
					                 <tr>
							 <td>Hello '.$username.',</td>
							</tr>
							<tr>
							 <td>'.$companyname.' has agreed to offer you a full refund.</td>
							</tr>
							<tr>
							 <td>You must first return the damaged merchandise to the following address provided by the Merchant within 7 days of this email:
								 <ul>
									 <li>Merchants Name:'.$merchant.'</li>
									 <li>Address:'.$address.'</li>
									 <li>City:'.$city.'</li>
									 <li>State:'.$state.'</li> 
									 <li>Zip Code:'.$zipcode.'</li>
								 </ul>
							 </td>
							</tr>
							<tr>
							 <td>For your protection, please ensure that the items are properly packaged and that you send them Fully Insured and with Signature Required.<br>

								Once you have shipped the items, you must returned to this page to upload the Tracking Information within 7 days or this case will be automatically closed.

								The Merchant will issue your refund within 5 business days of receipt and inspection of the returned merchandise.
							</td>
							</tr>
							<tr>
							 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>
							<tr>
							 <td>Sincerely,</td>
							</tr>
							<tr>
							 <td>YouGotRated</td>
							</tr>
							<tr>
							 <td>Buyer Protection Program</td>
							</tr>
							<tr>
							 <td>BC: PP-003-442-048-286</td>
							</tr>
							<tr>
							 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center</td>
							</tr>
							<tr>
							 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
				    
					        </table>');
					  
									  
						$this->email->send(); // send email to admin	
							
							
							
						} 
					    if(trim($dispute)=='Item Received Damaged' and trim($resolution_expect) =='Would like a Replacement item')  
						{
							
							
							$this->email->from($site_email,$site_name);
							$this->email->to($useremail);
							$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
					        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					                 
					         <tr>
							 <td> Hello '.$username.',</td>
							</tr>
							<tr>
							 <td> '.$companyname.' has agreed to ship you a replacement item.</td>
							</tr>
							<tr>
							 <td>You must first return the damaged merchandise to the following address provided by the Merchant within 7 days of this email:
								 <ul>
									<li>Merchants Name:'.$merchant.'</li>
									 <li>Address:'.$address.'</li>
									 <li>City:'.$city.'</li>
									 <li>State:'.$state.'</li> 
									 <li>Zip Code:'.$zipcode.'</li>
								 </ul>
							 </td>
							</tr>
							<tr>
							 <td>The merchant will be providing you with a Pre-Paid shipping label and the shipping will be paid by the merchant.</td>
							</tr>
							<tr>
							 <td>Once you have shipped the items, please returned to this page to upload the Tracking Information. As soon as the merchant receives the original item, a replacement will be expedited back to you.</td>
							</tr>
							<tr>
							 <td>Please follow this link to upload your shipping information  <a href="'.$site_url.'dispute/message/'.$msglink.'">'.$site_url.'dispute/message/'.$msglink.'</a>.</td>
							</tr>
							<tr>
							 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>
							<tr>
							 <td>Sincerely,</td>
							</tr>
							<tr>
							 <td>YouGotRated</td>
							</tr>
							<tr>
							 <td>Buyer Protection Program</td>
							</tr>
							<tr>
							 <td>BC: PP-003-442-048-286</td>
							</tr>
							<tr>
							 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center</td>
							</tr>
							<tr>
							 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
							
							 </table>');
					  
									  
							$this->email->send(); // send email to admin
							
							
							
							
							
						} 
					    if(trim($dispute) =='Items Missing from the Order' and trim($resolution_expect) =='Would like the missing items to be shipped immediately')  
						{
							
							               
									  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail);
										    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
							
							<tr><td>Hello '.$username.',</td></tr>

							<tr>
							  <td> '.$companyname.' has agreed to ship your missing items within 7 calendar days and will provide you with the new shipping and tracking information.
             						Until then, this case will remain open. Once we receive the new shipping information we will email you immediately.
                              </td>
                           </tr>
							<tr><td>Thank you for using the YouGotRated Buyer Protection Program.</td></tr>

							<tr><td>Sincerely,</td></tr>

							<tr><td>YouGotRated</td></tr>
							<tr><td>Buyer Protection Program</td></tr>

							<tr><td>BC: PP-003-442-048-286</td></tr>

							<tr><td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td></tr>

							<tr><td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td></tr>
							
							</table>');
					  
									  
							$this->email->send(); // send email to admin
							
						} 
					    if(trim($dispute) =='Items Missing from the Order' and trim($resolution_expect) =='Would like a Partial Refund for the missing items')  
						{
							
							
									  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail);
										    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
							
							<tr><td>Hello '.$username.',</td></tr>

							<tr>
							  <td> '.$companyname.' has agreed to offer you a partial refund for the missing items.Please remember that depending on your card issuer, it can take up to 7-10 business days to see the credit posted in your account statement.
                                   This case will remain open for another 15 days and you will have an opportunity to return to this page to close your case.
                              </td>
                           </tr>
							<tr><td>Thank you for using the YouGotRated Buyer Protection Program.</td></tr>

							<tr><td>Sincerely,</td></tr>

							<tr><td>YouGotRated</td></tr>
							<tr><td>Buyer Protection Program</td></tr>

							<tr><td>BC: PP-003-442-048-286</td></tr>

							<tr><td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td></tr>

							<tr><td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td></tr>
							
							</table>');
					  
							 	  
							$this->email->send(); // send email to admin
							
							
							
						} 
					    if(trim($dispute) =='Not Satisfied with Purchase would like a Refund')  
						{
							
							    
								$this->email->from($site_email,$site_name);
								$this->email->to($useremail);
								$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
					            $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					                 
					                 <tr>
							 <td>Hello '.$username.',</td>
							</tr>
							<tr>
							 <td>'.$companyname.' has agreed to offer you a full refund.</td>
							</tr>
							<tr>
							 <td>You must first return the damaged merchandise to the following address provided by the Merchant within 7 days of this email:
								 <ul>
									 <li>Merchants Name:'.$merchant.'</li>
									 <li>Address:'.$address.'</li>
									 <li>City:'.$city.'</li>
									 <li>State:'.$state.'</li> 
									 <li>Zip Code:'.$zipcode.'</li>
								 </ul>
							 </td>
							</tr>
							<tr>
							 <td>For your protection, please ensure that the items are properly packaged and that you send them Fully Insured and with Signature Required.<br>

								Once you have shipped the items, you must returned to this page to upload the Tracking Information within 7 days or this case will be automatically closed.

								The Merchant will issue your refund within 5 business days of receipt and inspection of the returned merchandise.
							</td>
							</tr>
							<tr>
							 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>
							<tr>
							 <td>Sincerely,</td>
							</tr>
							<tr>
							 <td>YouGotRated</td>
							</tr>
							<tr>
							 <td>Buyer Protection Program</td>
							</tr>
							<tr>
							 <td>BC: PP-003-442-048-286</td>
							</tr>
							<tr>
							 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center</td>
							</tr>
							<tr>
							 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
				    
					        </table>');
					  
									  
						$this->email->send(); // send email to admin	
							
							
							
						} 
					    if(trim($dispute)=='Seller Not Willing to Honor the Return Policy')  
						{
							
							
								$this->email->from($site_email,$site_name);
								$this->email->to($useremail);
								$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid.'');
					            $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					                 
					                 <tr>
							 <td>Hello '.$username.',</td>
							</tr>
							<tr>
							 <td>'.$companyname.' has agreed to offer you a full refund.</td>
							</tr>
							<tr>
							 <td>You must first return the damaged merchandise to the following address provided by the Merchant within 7 days of this email:
								 <ul>
									 <li>Merchants Name:'.$merchant.'</li>
									 <li>Address:'.$address.'</li>
									 <li>City:'.$city.'</li>
									 <li>State:'.$state.'</li> 
									 <li>Zip Code:'.$zipcode.'</li>
								 </ul>
							 </td>
							</tr>
							<td>For your protection, please ensure that the items are properly packaged and that you send them Fully Insured and with Signature Required.<br>

								Once you have shipped the items, you must returned to this page to upload the Tracking Information within 7 days or this case will be automatically closed.

								The Merchant will issue your refund within 5 business days of receipt and inspection of the returned merchandise.
							</td>
							</tr>
							<tr>
							 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>
							<tr>
							 <td>Sincerely,</td>
							</tr>
							<tr>
							 <td>YouGotRated</td>
							</tr>
							<tr>
							 <td>Buyer Protection Program</td>
							</tr>
							<tr>
							 <td>BC: PP-003-442-048-286</td>
							</tr>
							<tr>
							 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center</td>
							</tr>
							<tr>
							 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
				    
					        </table>');
					  
									  
						$this->email->send(); // send email to admin	
							
							
						} 
				  
			}  redirect('businessdispute/resolution/'.$disputeid,'refresh');
				  
		 			
	}
	
	
	 /////////////////////////////////////////////item not received//////////////////////////////////
	
	//->-If the Merchant fails to upload the shipping information within 5 days, an alert email is sent and email flag=0;
	
	public function alertingemail()
	{
		if($this->session->userdata['youg_admin'])
		   {
				   //five days
				   $data=$this->businessdisputes->emailflag();
				   //print_r($data['fifteen']);
				   
				    foreach($data['five'] as $alerts)
				   {
						$site_name = $this->settings->get_setting_value(1);
						$site_url = $this->settings->get_setting_value(2);
						$site_email = $this->settings->get_setting_value(5);
						  
						   $useremail1=$alerts->useremail;
						   $username1=$alerts->username;
						   $companyname1=$alerts->companyname;
						   $companyemail1=$alerts->companyemail;
						   $disputeid1=$alerts->id;
						   $carrier1=$alerts->carrier;
						   $tracking1=$alerts->tracking;
						   $dateshipped1=$alerts->dateshipped; 
						   
						  $this->alert1($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email);
						  $this->alert1_1($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email);
						  $this->alert1_2($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email);
						  $this->alert7($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$carrier1,$tracking1,$dateshipped1,$site_name,$site_url,$site_email);
						 
					}
					
					//seven days 
					foreach($data['seven'] as $merchantfavour)
					{
						 $site_name = $this->settings->get_setting_value(1);
						$site_url = $this->settings->get_setting_value(2);
						$site_email = $this->settings->get_setting_value(5);
						 
						   $useremail2=$merchantfavour->useremail;
						   $username2=$merchantfavour->username;
						   $companyname2=$merchantfavour->companyname;
						   $companyemail2=$merchantfavour->companyemail;
						   $disputeid2=$merchantfavour->id;
						   $carrier2=$alerts->carrier;
						   $tracking2=$alerts->tracking;
						   $dateshipped2=$alerts->dateshipped; 
						  
							$this->alert3($useremail2,$username2,$companyname2,$companyemail2,$disputeid2,$carrier2,$tracking2,$dateshipped2,$site_name,$site_url,$site_email);
							$this->alert3_1($useremail2,$username2,$companyname2,$companyemail2,$disputeid2,$carrier2,$tracking2,$dateshipped2,$site_name,$site_url,$site_email);
						
						  
						
					}
					
					//fifteendays && alerts(2 days after)
					foreach($data['fifteen'] as $finalwarning)
					{
						$site_name = $this->settings->get_setting_value(1);
						$site_url = $this->settings->get_setting_value(2);
						$site_email = $this->settings->get_setting_value(5);
						
						 
						   $useremail3=$finalwarning->useremail;
						   $username3=$finalwarning->username;
						   $companyname3=$finalwarning->companyname;
						   $companyemail3=$finalwarning->companyemail;
						   $disputeid3=$finalwarning->id;
						
						   $this->alert2($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert4($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert5($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert6($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert8($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert9($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert10($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert11($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert12($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert12_1($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert12_2($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   $this->alert12_3($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email);
						   
					}
					
		   
			}
	}
	
public function alert1($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email)
	{
		
				            
							$this->email->from($site_email,$site_name);
						    $this->email->to($companyemail1);
     						$this->email->subject('ALERT- Buyer Complaint Case #'.$disputeid1.'');
					        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					  
							<tr>
							 <td>Dear '.ucfirst($companyname1).', </td>
							</tr>
							<tr>
							<td>
							It has been 5 days from the time the buyer open this case against you but you have failed to provide the requested shipping information in the Resolution Center.<br>

							Please follow this link to upload the shipping information so we can close this case in your favor.<br>

							You must reply within 2 days of this email or this dispute will be escalated to a chargeback and the buyers Complaint will be posted online.<br>

							We encourage you to respond as soon as possible to protect your online reputation.<br>

							Please follow this link to the Resolution Center(<a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid1.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid1.'</a>.
							</td>
							</tr>
							<tr>
							<td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>

							<tr><td>Sincerely,</td></tr>

							<tr><td>YouGotRated</td></tr>
							<tr><td>Buyer Protection Program</td></tr>
							<tr><td>BC: PP-003-442-048-286</td></tr>

							<tr>
								<td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
							</tr>
							<tr>
							  <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
					  
					  </table>');
					  $this->email->send(); // send email to admin
				  

		
	}
public function alert1_1($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email)
	{
		
				            
							$this->email->from($site_email,$site_name);
						    $this->email->to($companyemail1);
							$this->email->subject('ALERT- Buyer Complaint Case #'.$disputeid1.'');
					        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					  
							<tr>
							 <td>Dear '.ucfirst($companyname1).', </td>
							</tr>
							<tr>
							<td>
							It has been 15 days from the time the buyer open this case against you but you have failed to provide the requested shipping information in the Resolution Center.<br>

							Please follow this link to upload the shipping information so we can close this case in your favor.<br>

							You must reply within 2 days of this email or this dispute will be escalated to a chargeback and the buyers Complaint will be posted online.<br>

							We encourage you to respond as soon as possible to protect your online reputation.<br>

							Please follow this link to the Resolution Center(<a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid1.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid1.'</a>.
							</td>
							</tr>
							<tr>
							<td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>

							<tr><td>Sincerely,</td></tr>

							<tr><td>YouGotRated</td></tr>
							<tr><td>Buyer Protection Program</td></tr>
							<tr><td>BC: PP-003-442-048-286</td></tr>

							<tr>
								<td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
							</tr>
							<tr>
							  <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
					  
					  </table>');
					  $this->email->send(); // send email to admin
				  

		
	}
public function alert1_2($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email)
	{
		
				           
							$this->email->from($site_email,$site_name);
						    $this->email->to($useremail1);
						    $this->email->subject('ALERT- Buyer Complaint Case #'.$disputeid1.'');
					        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					  
							<tr>
							 <td>Hello '.ucfirst($username1).', </td>
							</tr>
							<tr>

								<td> '.ucfirst($companyname1).' has failed to provide the requested shipping and tracking information for your purchase.</td>

					        </tr>
							<tr>

							   <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>

							</tr>
					<tr>

					   <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>

					</tr>
					<tr>

					   <td>Step 2) You must specify that the reason for the chargeback is that "The merchant did not shipped the item you purchased - Item not Received".</td>

					</tr>

					<tr>

					 <td>Step 3) Request a full refund of the charge based on the Merchants failure to fulfill the transaction</td>

					</tr>
					<tr>

					 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>

					</tr>
					<tr>

					 <td>Please note that this case will remain open for 90 days.</td>

					</tr>
					<tr>

					 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>

					</tr>
					<tr>

					 <td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>

					</tr>
					<tr>
					<td>Thank you for using YouGotRateds Buyer Protection Program.</td>
					</tr>

					<tr><td>Sincerely,</td></tr>

					<tr><td>YouGotRated</td></tr>
					<tr><td>Buyer Protection Program</td></tr>
					<tr><td>BC: PP-003-442-048-286</td></tr>

					<tr>
						<td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
					</tr>
					<tr>
					  <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
					</tr>
			  
					  </table>');
					  $this->email->send(); // send email to admin
				  

		
	}
	
	//->-If the merchant does not upload the information within 2 days of the second email, the negative complaint should automatically be posted online in their profile
	public function alert2($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
	{
		                        
								$this->email->from($site_email,$site_name);
								$this->email->to($useremail3);
								$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid3.'');
					            $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
						<tr>
						<td>Hello '.ucfirst($username3).',</td>
					</tr>
					<tr>

					   <td> '.ucfirst($companyname3).' has failed to provide Proof of Refund for your purchase.</td>

					</tr>
					<tr>

					   <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>

					</tr>
					<tr>

					   <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>

					</tr>
					<tr>

					   <td>Step 2) You must specify that the reason for the chargeback is that "The merchant did not shipped the item you purchased - Item not Received".</td>

					</tr>

					<tr>

					 <td>Step 3) Request a full refund of the charge based on the Merchants failure to fulfill the transaction</td>

					</tr>
					<tr>

					 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>

					</tr>
					<tr>

					 <td>Please note that this case will remain open for 90 days.</td>

					</tr>
					<tr>

					 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>

					</tr>
					<tr>

					 <td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>

					</tr>
					<tr>

					 <td>Thank you for using YouGotRateds Buyer Protection Program. </td>

					</tr>
					<tr>

					 <td> Sincerely,</td>

					</tr>
					<tr>

					 <td>YouGotRated </td>

					</tr>
					<tr>

					 <td>Buyer Protection Program</td>

					</tr>
					<tr>

					 <td>BC: PP-003-442-048-286</td>

					</tr>

					<tr>

					 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>

					</tr>
					<tr>

					 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624. </td>

					</tr> 
				
				</table>');
					
					       $this->email->send(); // send email to admin
		
		
	}
	          ///////////////////////////ITEM NOT AS DESCRIBED///////////////////////////////////////////
	
	       //->If the buyer does not upload the shipping information within 7 days, the case should be automatically closed in the Merchant's favor.
	       //->-If the buyer uploads the shipping information within 7 days then another email should go out to the Merchant with the following information:
	    public function alert3($useremail2,$username2,$companyname2,$companyemail2,$disputeid2,$carrier2,$tracking2,$dateshipped2,$site_name,$site_url,$site_email)
	    {
			
				
				$this->email->from($site_email,$site_name);
				$this->email->to($companyemail2);
				$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid2.'');
				$this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
									  
			  <tr>
			 <td> Hello '.ucfirst($companyname2).',</td>
			</tr>	
			<tr>
			 <td> '.ucfirst($username2).' has shipped the item with the following shipping information:
				 <ul>
					 <li>Carrier:'.$carrier2.'</li>
					 <li>Tracking Number:'.$tracking2.'</li>
					 <li>Date Shipped:'.$dateshipped2.'</li>
				 </ul>
			 </td>
			</tr>	
			<tr>
			 <td>Once you receive the item please issue the Buyer a Full Refund and follow the link below to upload Proof of Refund so we can close this case in your favor.</td>
			</tr>	
			<tr>
			 <td>Please follow this link to the Resolution Center(<a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid2.'">'.$site_url.'/businessadmin/businessdispute/resolution/'.$disputeid2.'</a>)</td>
			</tr>	
			<tr>
			 <td>Thank you for using the YouGotRated Buyer Protection Program.</td>
			</tr>	
			<tr>
			 <td>Sincerely,</td>
			</tr>	
			<tr>
			 <td>YouGotRated</td>
			</tr>	
			<tr>
			 <td>Buyer Protection Program</td>
			</tr>	
			<tr>
			 <td>BC: PP-003-442-048-286</td>
			</tr>	
			<tr>
			 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
			</tr>	
			<tr>
			 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
			</tr>	
					  
					  
					  </table>');
					 $this->email->send(); // send email to admin	
			
		}
	       //->-If the buyer uploads the shipping information within 7 days then another email should go out to the Merchant with the following information:
	    public function alert3_1($useremail2,$username2,$companyname2,$companyemail2,$disputeid2,$carrier2,$tracking2,$dateshipped2,$site_name,$site_url,$site_email)
	    {
			
				
				$this->email->from($site_email,$site_name);
				$this->email->to($companyemail2);
			    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid2.'');
				$this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
									  
			  <tr>
			 <td> Hello '.ucfirst($companyname2).',</td>
			</tr>	
			<tr>
			 <td> '.ucfirst($username2).' has shipped the damaged or defective back to you.
				 <ul>
					 <li>Carrier:'.$carrier2.'</li>
					 <li>Tracking Number:'.$tracking2.'</li>
					 <li>Date Shipped:'.$dateshipped2.'</li>
				 </ul>
			 </td>
			</tr>	
			<tr>
			 <td>Once you receive the item please expedite the Buyer a Replacement Item and follow the link below to upload the new Shipping Information so we can close this case in your favor.</td>
			</tr>	
			<tr>
			 <td>Please follow this link to the Resolution Center(<a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid2.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid2.'</a>)</td>
			</tr>	
			<tr>
			 <td>Thank you for using the YouGotRated Buyer Protection Program.</td>
			</tr>	
			<tr>
			 <td>Sincerely,</td>
			</tr>	
			<tr>
			 <td>YouGotRated</td>
			</tr>	
			<tr>
			 <td>Buyer Protection Program</td>
			</tr>	
			<tr>
			 <td>BC: PP-003-442-048-286</td>
			</tr>	
			<tr>
			 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
			</tr>	
			<tr>
			 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
			</tr>	
					  
					  
					  </table>');
					 $this->email->send(); // send email to admin	
			
		}
		
		//-->-Once the merchant receives the merchandise and returns to the resolution center to upload the Proof of Refund,
	    public function alert4($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
	    {
			
			                    
								$this->email->from($site_email,$site_name);
								$this->email->to($useremail3);
								$this->email->subject('Resolution of Buyer Complaint Case  #'.$disputeid3.'');
					            $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
		
						<tr><td>Hello '.ucfirst($username3).',</td></tr>

						<tr><td>'.ucfirst($companyname3).' has issued you a full refund on this transaction.

						Please remember that depending on your card issuer, it can take up to 7-10 business days to see the credit posted in your account statement.

						This case will remain open for another 15 days and you will have an opportunity to return to this page to close your case.</td>
                        </tr>
                        
						<tr><td>Please follow this link to the Resolution Center to close your case.</td></tr>

						<tr><td>Thank you for using the YouGotRated Buyer Protection Program.</td></tr>

						<tr><td>Sincerely,</td></tr>

						<tr><td>YouGotRated </td></tr>
						<tr><td>Buyer Protection Program </td></tr>

						<tr><td>BC: PP-003-442-048-286 </td></tr>

						<tr><td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td></tr>

						<tr><td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td></tr>
									
			
					  </table>');
					  $this->email->send(); // send email to admin	
			
		}
		
		 //->If the Merchant fails to upload the Proof of Refund within 15 days, an alert email is sent to the merchant with the following text:
		public function alert5($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			                               
									  		$this->email->from($site_email,$site_name);
										    $this->email->to($companyemail3);
										    $this->email->subject('ALERT- Buyer Complaint Case  #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					  
					         <tr>
						 <td>Dear '.ucfirst($companyname3).',</td>
						</tr>
						<tr>
						 <td>It has been 15 days from the time the buyer returned the merchandise, but you have failed to provide the requested Proof of Refund in the Resolution Center.</td>
						</tr>
						<tr>
						 <td>Please follow this link to upload the Proof of Refund so we can close this case in your favor.</td>
						</tr>
						<tr>
						 <td>You must reply within 2 days of this email or this dispute will be escalated to a chargeback and the buyers Complaint will be posted online.</td>
						</tr>
						<tr>
						 <td>We encourage you to respond as soon as possible to protect your online reputation.</td>
						</tr>
						<tr>
						 <td>Please follow this link to the Resolution Center(<a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid3.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid3.'</a></td>
						</tr>
						<tr>
						 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
						</tr>
						<tr>
						 <td>Sincerely,</td>
						</tr>
						<tr>
						 <td>YouGotRated</td>
						</tr>
						<tr>
						 <td>Buyer Protection Program</td>
						</tr>
						<tr>
						 <td>BC: PP-003-442-048-286</td>
						</tr>
						<tr>
						 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
						</tr>
						<tr>
						  <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
						</tr>
											  
					  
					   </table>');
					  $this->email->send(); // send email to admin
			
		}
		//->-If the merchant does not upload the Proof of Refund within 2 days of the second email, the negative complaint should automatically
	    public function alert6($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
	    {
			
			                               
			 						  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail3);
										    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					           <tr>
						 <td>Hello '.ucfirst($username3).',</td>
						</tr>
						<tr>
						 <td>'.ucfirst($companyname3).' has failed to provide Proof of Refund for the missing items you purchased.</td>
						</tr>
						<tr>
						 <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>
						</tr>
						<tr>
						 <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>
						</tr>
						<tr>
						 <td>Step 2) You must specify that the reason for the chargeback is that you "Received an Incomplete order and the merchant has failed to issue you a Partial Refund for the missing items you purchased.</td>
						</tr>
						<tr>
						 <td>Step 3) Request a partial refund of the charge based on the Merchants failure to fulfill the transaction</td>
						</tr>
						<tr>
						 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>
						</tr>
						<tr>
						 <td>Please note that this case will remain open for 90 days.</td>
						</tr>
						<tr>
						 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>
						</tr>
						<tr>
						 <td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>
						</tr>
						<tr>
						 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
						</tr>
						<tr>
						 <td>Sincerely,</td>
						</tr>
						<tr>
						 <td>YouGotRated</td>
						</tr>
						<tr>
						 <td>Buyer Protection Program</td>
						</tr>
						<tr>
						 <td>BC: PP-003-442-048-286</td>
						</tr>
						<tr>
						 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
						</tr>
						<tr>
						 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
						</tr>
						
					   </table>');
					 $this->email->send(); // send email to admin
			
		}
		 ////////////////////////////->Items Missing from the Order/////////////////////
		/////////-Once the merchant uploads the tracking information for the missing items, then the following email is sent to the Buyer:
		public function alert7($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$carrier1,$tracking1,$dateshipped1,$site_name,$site_url,$site_email)
		{
			                           
									  	$this->email->from($site_email,$site_name);
										$this->email->to($useremail1);
										$this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid1.'');
					                    $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					        
					        <tr><td> Hello '.ucfirst($username1).',</td></tr>
							<tr>
							  <td> '.ucfirst($companyname1).' has indicated that a new replacement item has been shipped.Here is the Information:
								  <ul>
									 <li>Carrier:'.$carrier1.'</li>
									 <li>Tracking Number:'.$tracking1.'</li>
									 <li>Date Shipped:'.$dateshipped1.'</li>
								  </ul>
							  </td>
							</tr>
							<tr>
							  <td>Please allow sufficient time for the items to reach you. </td>
							</tr>
							<tr>
							  <td>Once you receive them, please inspect them for any damage.</td>
							</tr>
							<tr>
							  <td>Damage Policy:
									  <ul>
										  <li>All items are shipped to you in the best possible packaging to ensure that you receive your purchase in perfect condition. Upon receipt, please inspect your package closely.</li>
										  <li>If you receive a damaged item, we will assist you in receiving a replacement or refund as quickly as possible - at no cost to you.</li>
										  <li> Should you observe significant damage to the outer packaging, please reject the shipment and have the carrier return it.</li>
										  <li>If there is minor damage to the packaging, please indicate as such when you sign for the shipment.</li>
										  <li>In the unlikely event that you find your product to be damaged upon opening it please return to the Resolution Center within 5 days of receipt and change the nature of your dispute so we can continue to assist you.</li>
									  </ul>
							  </td>
							</tr>
							<tr>
							  <td>If you are satisfied with your purchase, please return to this page to close this case</td>
							</tr>
							<tr>
							  <td>Please follow this link to the Resolution Center <a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid1.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid1.'</a>.</td>
							</tr>
							<tr>
							  <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
							</tr>
							<tr>
							  <td>Sincerely,</td>
							</tr>
							<tr>
							  <td>YouGotRated</td>
							</tr>
							<tr>
							  <td>Buyer Protection Program</td>
							</tr>
							
							<tr>
							  <td>BC: PP-003-442-048-286</td>
							</tr>
							
							<tr>
							  <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,

					</td>
							</tr>
							
							<tr>
							  <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
							</tr>
							
							     
					                        </table>');
									  
									  
					 $this->email->send(); // send email to admin
					
		}
		
		//->-If the Merchant fails to upload the Shipping Information for the Missing Items within 15 days, an alert email is sent to the merchant with the following text:
		public function alert8($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			
			                            
									  	$this->email->from($site_email,$site_name);
										$this->email->to($companyemail3);
										$this->email->subject('ALERT- Buyer Complaint Case #'.$disputeid3.'');
					                    $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
			

							    <tr><td>Dear '.ucfirst($companyname3).',</td></tr>

								<tr><td>It has been 15 days from the time the buyer filed this case and requested that you ship the missing items in the order, but you have failed to provide the new Shipping Information in the Resolution Center.

								Please follow this link to upload the Shipping Information so we can close this case in your favor.

								You must reply within 2 days of this email or this dispute will be escalated to a chargeback and the buyers Complaint will be posted online.

								We encourage you to respond as soon as possible to protect your online reputation.
								</td></tr>

								<tr><td>Please follow this link to the Resolution Center <a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid3.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid3.'</a>.</td></tr>

								<tr><td>Thank you for using YouGotRateds Buyer Protection Program.</td></tr>

								<tr><td>Sincerely,</td></tr>

								<tr><td>YouGotRated</td></tr>
								<tr><td>Buyer Protection Program</td></tr>

								<tr><td>BC: PP-003-442-048-286</td></tr>

								<tr><td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td></tr>

								<tr><td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td></tr>
											
								 </table>');
									  
									  
					 $this->email->send(); // send email to admin
					
		}
		
		//->-If the merchant does not upload the Shipping Information within 2 days of the second email, the negative complaint should automatically be posted online in their profile and another email should go out to the buyer with the following instructions:
         public function alert9($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
         {
			                              
									  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail3);
										    $this->email->subject('ALERT- Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
																		   <tr>
										 <td> Hello '.ucfirst($username3).',</td>
										</tr>
										<tr>
										 <td>'.ucfirst($companyname3).' has failed to provide Proof of Refund for the missing items you purchased.</td>
										</tr>
										<tr>
										 <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>
										</tr>
										<tr>
										 <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>
										</tr>
										<tr>
										 <td>Step 2) You must specify that the reason for the chargeback is that you "Received an Incomplete order and the merchant has failed to issue you a Partial Refund for the missing items you purchased.
									</td>
										</tr>
										<tr>
										 <td>Step 3) Request a partial refund of the charge based on the Merchants failure to fulfill the transaction</td>
										</tr>
										<tr>
										 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>
										</tr>
										<tr>
										 <td>Please note that this case will remain open for 90 days.</td>
										</tr>
										<tr>
										 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>
										</tr>
										<tr>
										<td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>
										</tr>
										<tr>
										<td>Thank you for using YouGotRateds Buyer Protection Program.</td>
										</tr>
										<tr>
										<td>Sincerely,</td>
										</tr>
										<tr>
										<td>YouGotRated</td>
										</tr>
										<tr>
										<td>Buyer Protection Program</td>
										</tr>
										<tr>
										<td>BC: PP-003-442-048-286</td>
										</tr>
										<tr>
										<td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
										</tr>
										<tr>
										<td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
										</tr>
									   </table>');
									   
									   
									  $this->email->send(); // send email to admin
		}
		
		//->-If the choice was to get a Partial Refund for the missing items, then the following email is sent to the Buyer:15 days
		public function alert10($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			                                
									  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail);
										    $this->email->subject('ALERT- Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
			
						<tr><td>Hello '.ucfirst($username3).',</td></tr>

						<tr><td> '.ucfirst($companyname3).' has agreed to offer you a partial refund for the missing items.

						Please remember that depending on your card issuer, it can take up to 7-10 business days to see the credit posted in your account statement.

						This case will remain open for another 15 days and you will have an opportunity to return to this page to close your case.</td></tr>


						<tr><td>Please follow this link to the Resolution Center.</td></tr>

						<tr><td>Thank you for using the YouGotRated Buyer Protection Program.</td></tr>

						<tr><td>Sincerely,</td></tr>

						<tr><td>YouGotRated</td></tr>
						<tr><td>Buyer Protection Program</td></tr>

						<tr><td>BC: PP-003-442-048-286</td></tr>

						<tr><td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td></tr>

						<tr><td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td></tr>
									</table>');
									   
									   
									  $this->email->send(); // send email to admin
			
		}
		
		//->-If the Merchant fails to upload the Proof of Refund within 15 days, an alert email is sent to the merchant with the following text:
        public function alert11($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
        {                                  
									  		$this->email->from($site_email,$site_name);
										    $this->email->to($companyemail3);
										    $this->email->subject('ALERT- Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
			
						<tr><td>Dear '.ucfirst($companyname3).',</td></tr>

						<tr><td>It has been 15 days from the time the buyer requested a partial refund for the missing items, but you have failed to provide the requested Proof of Refund in the Resolution Center.

						Please follow this link to upload the Proof of Refund so we can close this case in your favor.

						You must reply within 2 days of this email or this dispute will be escalated to a chargeback and the buyers Complaint will be posted online.

						We encourage you to respond as soon as possible to protect your online reputation.</td></tr>

						<tr><td>Please follow this link to the Resolution Center<a href="'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid3.'">'.$site_url.'businessadmin/businessdispute/resolution/'.$disputeid3.'</a></td></tr>

						<tr><td>Thank you for using YouGotRateds Buyer Protection Program.</td></tr>

						<tr><td>Sincerely,</td></tr>

						<tr><td>YouGotRated</td></tr>
						<tr><td>Buyer Protection Program</td></tr>

						<tr><td>BC: PP-003-442-048-286</td></tr>

						<tr><td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td></tr>

						<tr><td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td></tr>
									</table>');
									   
									   
									   $this->email->send(); // send email to admin
			
		}  
		
		//->If the merchant does not upload the Proof of Refund within 2 days of the second email, the negative complaint should
		public function alert12($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			
			                                
			 						  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail3);
										    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					           <tr>
						 <td>Hello '.ucfirst($username3).',</td>
						</tr>
						<tr>
						 <td>'.ucfirst($companyname3).' has failed to provide Proof of Refund for the missing items you purchased.</td>
						</tr>
						<tr>
						 <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>
						</tr>
						<tr>
						 <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>
						</tr>
						<tr>
						 <td>Step 2) You must specify that the reason for the chargeback is that you "Received an Incomplete order and the merchant has failed to issue you a Partial Refund for the missing items you purchased.</td>
						</tr>
						<tr>
						 <td>Step 3) Request a partial refund of the charge based on the Merchants failure to fulfill the transaction</td>
						</tr>
						<tr>
						 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>
						</tr>
						<tr>
						 <td>Please note that this case will remain open for 90 days.</td>
						</tr>
						<tr>
						 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>
						</tr>
						<tr>
						 <td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>
						</tr>
						<tr>
						 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
						</tr>
						<tr>
						 <td>Sincerely,</td>
						</tr>
						<tr>
						 <td>YouGotRated</td>
						</tr>
						<tr>
						 <td>Buyer Protection Program</td>
						</tr>
						<tr>
						 <td>BC: PP-003-442-048-286</td>
						</tr>
						<tr>
						 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
						</tr>
						<tr>
						 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
						</tr>
						
					   </table>');
					 $this->email->send(); // send email to admin
			
						
		}
		public function alert12_1($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			
			                                
			 						  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail3);
										    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					           <tr>
						 <td>Hello '.ucfirst($username3).',</td>
						</tr>
						<tr>
						 <td>'.ucfirst($companyname3).' has failed to provide has failed to provide Proof of Shipping for your purchase.</td>
						</tr>
						<tr>
						 <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>
						</tr>
						<tr>
						 <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>
						</tr>
						<tr>
						 <td>Step 2) You must specify that the reason for the chargeback is that you "Received an Incomplete order and the merchant has failed to issue you a Partial Refund for the missing items you purchased.</td>
						</tr>
						<tr>
						 <td>Step 3) Request a partial refund of the charge based on the Merchants failure to fulfill the transaction</td>
						</tr>
						<tr>
						 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>
						</tr>
						<tr>
						 <td>Please note that this case will remain open for 90 days.</td>
						</tr>
						<tr>
						 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>
						</tr>
						<tr>
						 <td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>
						</tr>
						<tr>
						 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
						</tr>
						<tr>
						 <td>Sincerely,</td>
						</tr>
						<tr>
						 <td>YouGotRated</td>
						</tr>
						<tr>
						 <td>Buyer Protection Program</td>
						</tr>
						<tr>
						 <td>BC: PP-003-442-048-286</td>
						</tr>
						<tr>
						 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
						</tr>
						<tr>
						 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
						</tr>
						
					   </table>');
					 $this->email->send(); // send email to admin
			
						
		}
		public function alert12_2($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			
			                               
			 						  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail3);
										    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					           <tr>
						 <td>Hello '.ucfirst($username3).',</td>
						</tr>
						<tr>
						 <td>'.ucfirst($companyname3).' has failed to provide Proof of Shipping for your Replacement Item.</td>
						</tr>
						<tr>
						 <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>
						</tr>
						<tr>
						 <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>
						</tr>
						<tr>
						 <td>Step 2) You must specify that the reason for the chargeback is that you "Received an Incomplete order and the merchant has failed to issue you a Partial Refund for the missing items you purchased.</td>
						</tr>
						<tr>
						 <td>Step 3) Request a partial refund of the charge based on the Merchants failure to fulfill the transaction</td>
						</tr>
						<tr>
						 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>
						</tr>
						<tr>
						 <td>Please note that this case will remain open for 90 days.</td>
						</tr>
						<tr>
						 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>
						</tr>
						<tr>
						 <td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>
						</tr>
						<tr>
						 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
						</tr>
						<tr>
						 <td>Sincerely,</td>
						</tr>
						<tr>
						 <td>YouGotRated</td>
						</tr>
						<tr>
						 <td>Buyer Protection Program</td>
						</tr>
						<tr>
						 <td>BC: PP-003-442-048-286</td>
						</tr>
						<tr>
						 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
						</tr>
						<tr>
						 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
						</tr>
						
					   </table>');
					 $this->email->send(); // send email to admin
			
						
		}
		public function alert12_3($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			
			                                
			 						  		$this->email->from($site_email,$site_name);
										    $this->email->to($useremail3);
										    $this->email->subject('Resolution of Buyer Complaint Case #'.$disputeid3.'');
					                        $this->email->message('<table cellpadding="0" cellspacing="20" width="100%" border="0">
					           <tr>
						 <td>Hello '.ucfirst($username3).',</td>
						</tr>
						<tr>
						 <td>'.ucfirst($companyname3).' has failed to provide Proof of Shipping for your missing items.</td>
						</tr>
						<tr>
						 <td>Please follow the instructions outlined below in order to continue to be protected by the Buyer Protection Program:</td>
						</tr>
						<tr>
						 <td>Step 1) You must contact your card issuer and file a Chargeback for this transaction.</td>
						</tr>
						<tr>
						 <td>Step 2) You must specify that the reason for the chargeback is that you "Received an Incomplete order and the merchant has failed to issue you a Partial Refund for the missing items you purchased.</td>
						</tr>
						<tr>
						 <td>Step 3) Request a partial refund of the charge based on the Merchants failure to fulfill the transaction</td>
						</tr>
						<tr>
						 <td>Your card issuer will be very helpful in assisting you in filing the chargeback.</td>
						</tr>
						<tr>
						 <td>Please note that this case will remain open for 90 days.</td>
						</tr>
						<tr>
						 <td>You will have the opportunity to close the case at any time because you received a refund from the card issuer or to upload the paperwork from your card issuer in the event they denied your chargeback claim.</td>
						</tr>
						<tr>
						 <td>In such event, once we receive the denial from the Card Issuer, YouGotRated will reimburse you for the full purchase price of the merchandise up to $1,500.00 providing you complied with all the instructions as outlined in the Resolution Center. Please note that it can take up to 30 days for a reimbursement to be issued after we receive the necessary paperwork.</td>
						</tr>
						<tr>
						 <td>Thank you for using YouGotRateds Buyer Protection Program.</td>
						</tr>
						<tr>
						 <td>Sincerely,</td>
						</tr>
						<tr>
						 <td>YouGotRated</td>
						</tr>
						<tr>
						 <td>Buyer Protection Program</td>
						</tr>
						<tr>
						 <td>BC: PP-003-442-048-286</td>
						</tr>
						<tr>
						 <td>Please do not reply to this email. This mailbox is not monitored and we are unable to respond to inquiries sent to this address. For further assistance, please communicate with the Merchant through the Resolution Center,</td>
						</tr>
						<tr>
						 <td>Copyright © 2014 YouGotRated, LLC. All rights reserved. YouGotRated, Tampa, FL 33624.</td>
						</tr>
						
					   </table>');
					 $this->email->send(); // send email to admin
			
						
		}
		

}
