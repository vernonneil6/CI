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
				
		$this->data['title'] = 'Business Solution : '.$this->data['site_name'];
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
		
		//Loading View File
		$this->load->view('solution',$this->data);
		
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
					$this->session->set_flashdata('error', 'This Business is already claim. Try later!');
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
	public function claimbusiness()
	{
		$siteid = $this->session->userdata('siteid');
		  $this->data['categories'] = $this->common->get_all_categorys($siteid);
		$this->load->view('solution',$this->data);
	}
	public function update()
	{
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
				if($discountcode!='')
				{
					redirect('solution/claimdisc/'.$id.'/'.$discountcode, 'refresh');
					
				}
				else
				{
					redirect('solution/claim/'.$id, 'refresh');
				}
				
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
								
								$this->session->set_flashdata('success', 'Business added successfully. claim your business here');
								redirect('solution/claim/'.$companyid, 'refresh');
								
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
					
					
					
					$this->session->set_flashdata('error', 'Invalid company details. Try later!');
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
	
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */