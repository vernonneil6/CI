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
		//echo "<pre>";
		//print_r( $this->data['total'] );
		//die();
			
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
				$this->data['company'] = $this->complaints->get_company_byseokeyword($word); 
				if(count($this->data['company'])>0) {
				
		  		$this->data['complaints'] = $this->complaints->get_complaint_bycompanyid($this->data['company'][0]['id']);
				$this->data['reviews'] = $this->reviews->get_reviews_bycompanyid($this->data['company'][0]['id']);
				$this->data['coupons'] = $this->complaints->get_coupon_bycompanyid($this->data['company'][0]['id']);
				$this->data['gallerys'] = $this->complaints->get_gallery_bycompanyid($this->data['company'][0]['id']);
				$this->data['videos'] = $this->complaints->get_videos_bycompanyid($this->data['company'][0]['id']);
				$this->data['companysems'] = $this->complaints->get_companysem_bycompanyid($this->data['company'][0]['id']);
				$this->data['companyreviews'] = $this->complaints->get_companyreviews_bycompanyid($this->data['company'][0]['id']);
				
				$this->data['companypdfs'] = $this->complaints->get_companypdfs_bycompanyid($this->data['company'][0]['id']);
				
				 //echo "<pre>";
				 //print_r($this->data['reviews']);
				 //print_r($this->data['companyreviews']);
				 //die();
		    	
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						$this->load->view('company',$this->data);
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
			else
			{
					redirect('', 'refresh');
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
				$this->paging['total_rows'] = $this->reviews->get_reviews_bycompanyid_count();
				$this->pagination->initialize($this->paging);			
				
				
		  		
				//Loading View File
		 		 if(count($this->data['company'])>0)
					{
						$this->load->view('companyreviews',$this->data);
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
	}
	

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */