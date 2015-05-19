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
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Manage Complaints';
		$this->data['section_title'] = 'Manage Complaints';
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
	
	public function index($sortby,$orderby='asc')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata('siteid');
			
			$this->load->library('pagination');
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			//Addingg Setting Result to variable
			$this->data['companydispute'] = $this->businessdisputes->listdispute($limit,$offset,$sortby,$orderby='asc');
			
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
				$mail = $this->settings->get_email_byid(41);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];
				
				
				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
                                $this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",$disputeid,str_replace("%username%",$username,str_replace("%companyname%",$companyname,str_replace("%carrier%",$carrier,str_replace("%tracking%",$tracking,str_replace("%dateshipped%",$dateshipped,str_replace("%site_url%",$site_url,str_replace("%msglink%",$msglink,stripslashes($mailformat)))))))));
				
				$this->email->message($mail_body);
				$this->email->send(); 
				
			}
			
			if(trim($dispute) =='Item Not as Described')  
			{
				
				$mail = $this->settings->get_email_byid(42);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];
				
				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
				$this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",$disputeid,str_replace("%username%",$username,str_replace("%companyname%",$companyname,str_replace("%merchant%",$merchant,str_replace("%address%",$address,str_replace("%city%",$city,str_replace("%state%",$state,str_replace("%zipcode%",$zipcode,stripslashes($mailformat)))))))));
				
				$this->email->message($mail_body);
				$this->email->send(); 
			}
			
			if(trim($dispute) =='Item Received Damaged' and trim($resolution_expect) =='Would like a Full Refund')  
			{
				
				$mail = $this->settings->get_email_byid(43);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];
				
				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
                              	$this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",$disputeid,str_replace("%username%",$username,str_replace("%companyname%",$companyname,str_replace("%merchant%",$merchant,str_replace("%address%",$address,str_replace("%city%",$city,str_replace("%state%",$state,str_replace("%zipcode%",$zipcode,stripslashes($mailformat)))))))));
			   			   
				$this->email->message($mail_body);
				$this->email->send();
				
				
				
			} 
			if(trim($dispute)=='Item Received Damaged' and trim($resolution_expect) =='Would like a Replacement item')  
			{
				
				$mail = $this->settings->get_email_byid(44);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];
				
				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
				$this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",$disputeid,str_replace("%username%",$username,str_replace("%companyname%",$companyname,str_replace("%merchant%",$merchant,str_replace("%address%",$address,str_replace("%city%",$city,str_replace("%state%",$state,str_replace("%zipcode%",$zipcode,str_replace("%site_url%",$site_url,str_replace("%msglink%",$msglink,stripslashes($mailformat)))))))))));
				
				$this->email->message($mail_body);
				$this->email->send(); 
							
			} 
			if(trim($dispute) =='Items Missing from the Order' and trim($resolution_expect) =='Would like the missing items to be shipped immediately')  
			{
				
				$mail = $this->settings->get_email_byid(45);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];
			   
				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
				$this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",$disputeid,str_replace("%username%",$username,str_replace("%companyname%",$companyname,stripslashes($mailformat))));
			   
				$this->email->message($mail_body);
				$this->email->send();

			} 
			if(trim($dispute) =='Items Missing from the Order' and trim($resolution_expect) =='Would like a Partial Refund for the missing items')  
			{
								
				$mail = $this->settings->get_email_byid(46);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];

				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
                                $this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",$disputeid,str_replace("%username%",$username,str_replace("%companyname%",$companyname,stripslashes($mailformat))));
				
				$this->email->message($mail_body);
				$this->email->send();
				
			} 
			if(trim($dispute) =='Not Satisfied with Purchase would like a Refund')  
			{
				
				$mail = $this->settings->get_email_byid(47);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];
				
				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
                               	$this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",$disputeid,str_replace("%username%",$username,str_replace("%companyname%",$companyname,str_replace("%merchant%",$merchant,str_replace("%address%",$address,str_replace("%city%",$city,str_replace("%state%",$state,str_replace("%zipcode%",$zipcode,stripslashes($mailformat)))))))));
				
				$this->email->message($mail_body);
				$this->email->send(); 	
			} 
			if(trim($dispute)=='Seller Not Willing to Honor the Return Policy')  
			{
				$mail = $this->settings->get_email_byid(48);
				$subject = str_replace("%disputeid%", $disputeid, stripslashes($mail[0]['subject']));
				$mailformat = $mail[0]['mailformat'];
			
				$this->email->from($site_email,$site_name);
				$this->email->to($useremail);
                                $this->email->subject($subject);
				$mail_body = str_replace("%disputeid%",ucfirst($disputeid),str_replace("%username%",$username,str_replace("%companyname%",$companyname,str_replace("%merchant%",$merchant,str_replace("%address%",$address,str_replace("%city%",$city,str_replace("%state%",$state,str_replace("%zipcode%",$zipcode,stripslashes($mailformat)))))))));
				
				$this->email->message($mail_body);
				$this->email->send(); 	

			} 
			  
	    }  redirect('businessdispute/resolution/'.$disputeid,'refresh');
	
	}
	
	
	 /////////////////////////////////////////////item not received//////////////////////////////////
	
	//->-If the Merchant fails to upload the shipping information within 5 days, an alert email is sent and email flag=0;
	
	public function alertingemail()
	{
             $this->load->library('email');  
		if($this->session->userdata['youg_admin'])
		{
		   //five days
		   $data=$this->businessdisputes->emailflag();
		   	$site_name = $this->settings->get_setting_value(1);
			$site_url = $this->settings->get_setting_value(2);
			$site_email = $this->settings->get_setting_value(5);	   
			foreach($data['five'] as $alerts)
		    {
                       
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
		 		            
		$mail = $this->settings->get_email_byid(49);
		$subject = str_replace("%disputeid1%", $disputeid1, stripslashes($mail[0]['subject']));
		$mailformat = $mail[0]['mailformat'];
		
		$this->email->from($site_email,$site_name);
		$this->email->to($companyemail1);
		$this->email->subject($subject);
		$mail_body = str_replace("%disputeid1%",$disputeid1,str_replace("%companyname1%",$companyname1,str_replace("%site_url%",$site_url,stripslashes($mailformat))));
		
		$this->email->message($mail_body);
        $this->email->send(); 				  
		
	}
    public function alert1_1($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email)
	{
                
		$mail = $this->settings->get_email_byid(50);
		$subject = str_replace("%disputeid1%", $disputeid1, stripslashes($mail[0]['subject']));
		$mailformat = $mail[0]['mailformat'];
				
		$this->email->from($site_email,$site_name);
		$this->email->to($companyemail1);
		$this->email->subject($subject);
		$mail_body = str_replace("%disputeid1%",$disputeid1,str_replace("%companyname1%",$companyname1,str_replace("%site_url%",$site_url,stripslashes($mailformat))));
		
		$this->email->message($mail_body);
		$this->email->send(); 				  
	}
    public function alert1_2($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$site_name,$site_url,$site_email)
	{
		$this->load->library('email'); 
		$mail = $this->settings->get_email_byid(51);
		$subject = str_replace("%disputeid1%", $disputeid1, stripslashes($mail[0]['subject']));
		$mailformat = $mail[0]['mailformat'];   
				           
		$this->email->from($site_email,$site_name);
		$this->email->to($useremail1);
		$this->email->subject($subject);
		$mail_body = str_replace("%disputeid1%",$disputeid1,str_replace("%username1%",$username1,str_replace("%companyname1%",$companyname1,stripslashes($mailformat))));
		
		$this->email->message($mail_body);
        $this->email->send(); 
	}
	
	//->-If the merchant does not upload the information within 2 days of the second email, the negative complaint should automatically be posted online in their profile
	public function alert2($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
	{
		        $mail = $this->settings->get_email_byid(52);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat']; 
		                        
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%username3%",$username3,str_replace("%companyname3%",$companyname3,stripslashes($mailformat))));
			
			$this->email->message($mail_body);
			$this->email->send(); 
	
	}
             ///////////////////////////ITEM NOT AS DESCRIBED///////////////////////////////////////////
	
	       //->If the buyer does not upload the shipping information within 7 days, the case should be automatically closed in the Merchant's favor.
	       //->-If the buyer uploads the shipping information within 7 days then another email should go out to the Merchant with the following information:
	    public function alert3($useremail2,$username2,$companyname2,$companyemail2,$disputeid2,$carrier2,$tracking2,$dateshipped2,$site_name,$site_url,$site_email)
	    {
			$mail = $this->settings->get_email_byid(53);
			$subject = str_replace("%disputeid2%", $disputeid2, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat']; 
			
			$this->email->from($site_email,$site_name);
			$this->email->to($companyemail2);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid2%",$disputeid2,str_replace("%companyname2%",$companyname2,str_replace("%username2%",$username2,str_replace("%carrier2%",$carrier2,str_replace("%tracking2%",$tracking2,str_replace("%dateshipped2%",$dateshipped2,str_replace("%site_url%",$site_url,stripslashes($mailformat))))))));
			
			$this->email->message($mail_body);
			$this->email->send(); 
			
		}
	       //->-If the buyer uploads the shipping information within 7 days then another email should go out to the Merchant with the following information:
	    public function alert3_1($useremail2,$username2,$companyname2,$companyemail2,$disputeid2,$carrier2,$tracking2,$dateshipped2,$site_name,$site_url,$site_email)
	    {
			
			$mail = $this->settings->get_email_byid(54);
			$subject = str_replace("%disputeid2%", $disputeid2, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];
			
				
			$this->email->from($site_email,$site_name);
			$this->email->to($companyemail2);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid2%",$disputeid2,str_replace("%companyname2%",$companyname2,str_replace("%username2%",$username2,str_replace("%carrier2%",$carrier2,str_replace("%tracking2%",$tracking2,str_replace("%dateshipped2%",$dateshipped2,str_replace("%site_url%",$site_url,stripslashes($mailformat))))))));
			
			$this->email->message($mail_body);
			$this->email->send(); 	
			
		}
		
		//-->-Once the merchant receives the merchandise and returns to the resolution center to upload the Proof of Refund,
	    public function alert4($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
	    {
			
			$mail = $this->settings->get_email_byid(55);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];
			                    
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%username3%",$username3,stripslashes($mailformat))));
			
			$this->email->message($mail_body);
		        $this->email->send(); 
			
		}
		
		 //->If the Merchant fails to upload the Proof of Refund within 15 days, an alert email is sent to the merchant with the following text:
		public function alert5($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			$mail = $this->settings->get_email_byid(56);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];
			                               
			$this->email->from($site_email,$site_name);
			$this->email->to($companyemail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%site_url%",$site_url,stripslashes($mailformat))));
						 
			$this->email->message($mail_body);
                        $this->email->send(); 
			
		}
		//->-If the merchant does not upload the Proof of Refund within 2 days of the second email, the negative complaint should automatically
	    public function alert6($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
	    {
			$mail = $this->settings->get_email_byid(57);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];
			                               
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,stripslashes($mailformat)));
						 
			$this->email->message($mail_body);
			$this->email->send(); 
			
		}
		 ////////////////////////////->Items Missing from the Order/////////////////////
		/////////-Once the merchant uploads the tracking information for the missing items, then the following email is sent to the Buyer:
		public function alert7($useremail1,$username1,$companyname1,$companyemail1,$disputeid1,$carrier1,$tracking1,$dateshipped1,$site_name,$site_url,$site_email)
		{
			$mail = $this->settings->get_email_byid(58);
			$subject = str_replace("%disputeid1%", $disputeid1, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];                   
								
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail1);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid1%",$disputeid1,str_replace("%username1%",$username1,str_replace("%companyname1%",$companyname1,str_replace("%carrier1%",$carrier1,str_replace("%tracking1%",$tracking1,str_replace("%dateshipped1%",$dateshipped1,str_replace("%site_url%",$site_url,stripslashes($mailformat))))))));
			
			$this->email->message($mail_body);
			$this->email->send(); 
		}
		//->-If the Merchant fails to upload the Shipping Information for the Missing Items within 15 days, an alert email is sent to the merchant with the following text:
		public function alert8($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			$mail = $this->settings->get_email_byid(59);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];  
			
			                            
			$this->email->from($site_email,$site_name);
			$this->email->to($companyemail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%site_url%",$site_url,stripslashes($mailformat))));
						
			$this->email->message($mail_body);
     		        $this->email->send(); 
		}
		//->-If the merchant does not upload the Shipping Information within 2 days of the second email, the negative complaint should automatically be posted online in their profile and another email should go out to the buyer with the following instructions:
         public function alert9($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
         {
			$mail = $this->settings->get_email_byid(60);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];     
							  
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%username3%",$username3,stripslashes($mailformat))));
			
			$this->email->message($mail_body);
			$this->email->send(); 
		}
		//->-If the choice was to get a Partial Refund for the missing items, then the following email is sent to the Buyer:15 days
		public function alert10($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			$mail = $this->settings->get_email_byid(61);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];    
						 
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%username3%",$username3,stripslashes($mailformat))));
			$this->email->message($mail_body);
			$this->email->send();
			
		}
		//->-If the Merchant fails to upload the Proof of Refund within 15 days, an alert email is sent to the merchant with the following text:
        public function alert11($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
        {                                  
			$mail = $this->settings->get_email_byid(62);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat']; 
			
			
			$this->email->from($site_email,$site_name);
			$this->email->to($companyemail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%site_url%",$site_url,stripslashes($mailformat))));
			
			$this->email->message($mail_body);
			$this->email->send(); 			
		}  
		//->If the merchant does not upload the Proof of Refund within 2 days of the second email, the negative complaint should
		public function alert12($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			
			$mail = $this->settings->get_email_byid(63);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];   
										
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%username3%",$username3,stripslashes($mailformat))));
					 
			$this->email->message($mail_body);
			$this->email->send(); 
			
		}
		public function alert12_1($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			$mail = $this->settings->get_email_byid(64);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];
			                                
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%username3%",$username3,stripslashes($mailformat))));
			
			$this->email->message($mail_body);
			$this->email->send(); 
			
		}
		public function alert12_2($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			$mail = $this->settings->get_email_byid(65);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];
								   
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%username3%",$username3,stripslashes($mailformat))));
			
			$this->email->message($mail_body);
			$this->email->send(); 
			
		}
		public function alert12_3($useremail3,$username3,$companyname3,$companyemail3,$disputeid3,$site_name,$site_url,$site_email)
		{
			$mail = $this->settings->get_email_byid(66);
			$subject = str_replace("%disputeid3%", $disputeid3, stripslashes($mail[0]['subject']));
			$mailformat = $mail[0]['mailformat'];
			                                
			$this->email->from($site_email,$site_name);
			$this->email->to($useremail3);
			$this->email->subject($subject);
			$mail_body = str_replace("%disputeid3%",$disputeid3,str_replace("%companyname3%",$companyname3,str_replace("%username3%",$username3,stripslashes($mailformat))));
			
			$this->email->message($mail_body);
			$this->email->send();
		}


}

