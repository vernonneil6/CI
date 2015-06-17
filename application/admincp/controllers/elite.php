<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
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
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		
		$this->load->model('elites');
		
		if( $this->session->userdata('youg_admin'))
	  	{
		    //If no session, redirect to login page
			//echo site_url();die();
	      	if(!array_key_exists('type',$this->session->userdata['youg_admin']))
			{
				$a = site_url();
				$p = explode('/admincp',$a);
				//echo $p[0];
				//die();
				redirect($p[0].'/businessadmin', 'refresh');
			}
		}
		else
		{
			redirect('adminlogin', 'refresh');
		}
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Elite Members';
		$this->data['section_title'] = 'Elite Members';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite'] = array();
				}
		
		//Load heading and save in variable 
		$this->data['heading'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}

	
	public function index($sort_by = '', $sort_order = '', $offset = 0) {
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			$this->data['fields'] = array(
				'id' => 'Elite ID',
				'company' => 'Company',
				'contactname' => 'Name',
				'email' => 'Public E-mail',
				'contactemail' => 'Private E-mail',
				'payment_amount' => 'Payment Amount',
				'status' => 'Status',
				'registerdate' => 'Date Created',				
				'payment_date' => 'Payment Date',				
			);
			
			$this->load->model('elites');
			
			if($this->input->get('s')){				
				$decodeKeyword = urldecode($this->input->get('s'));
			}
			
			if(empty($sort_by) || empty($sort_order)){
				$offset = $sort_by;
			}
			
			$results = $this->elites->elitesSearch($decodeKeyword, $limit, $offset, $sort_by, $sort_order);
			
			$this->data['elites'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			
			
			// pagination	
			if(!empty($sort_by) && !empty($sort_order)){
				$siteURL = site_url("elite/index/$sort_by/$sort_order");
				$uriSegment = 5;
			}
			else{
				$siteURL = site_url("elite/index");
				$uriSegment = 3;
			}
						
			$this->paging['base_url'] = $siteURL;
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;
			$this->paging['uri_segment'] = $uriSegment;
			$this->pagination->initialize($this->paging);									
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('elite', $this->data);
		}
	}
	
	public function reviewUploadSecurity($sort_by = '', $sort_order = '', $offset = 0) {
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			$this->data['fields'] = array(				
				'company' => 'Company',											
				'status' => 'Status'																				
			);
			
			$this->load->model('elites');
			
			if($this->input->get('s')){				
				$decodeKeyword = urldecode($this->input->get('s'));
			}
			
			if(empty($sort_by) || empty($sort_order)){
				$offset = $sort_by;
			}
			
			$results = $this->elites->elitemembersSearch($decodeKeyword, $limit, $offset, $sort_by, $sort_order);
			
			$this->data['elite_members'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			
			
			// pagination	
			if(!empty($sort_by) && !empty($sort_order)){
				$siteURL = site_url("elite/review_upload/$sort_by/$sort_order");
				$uriSegment = 5;
			}
			else{
				$siteURL = site_url("elite/review_upload");
				$uriSegment = 3;
			}
						
			$this->paging['base_url'] = $siteURL;
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;
			$this->paging['uri_segment'] = $uriSegment;
			$this->pagination->initialize($this->paging);									
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('elite', $this->data);
		}
	}
	
	public function create($id = ''){
		
		if( $this->session->userdata['youg_admin'] )
		{
			if(!$id)
			{
				redirect('elite/reviewUploadSecurity', 'refresh');
			}
			
			//Getting detail for displaying in form
				$this->data['elitedetails'] = $this->elites->getEliteMembersDetails($id);
			
			/*echo "<pre>";
			print_r($this->data['elitedetails']);
			die();*/
			if( count($this->data['elitedetails'])>0 )
			{			
				//Loading View File
				$this->load->view('elite',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('elite/reviewUploadSecurity', 'refresh');
			}
		}
	}
	
	public function update(){
		
		if( $this->session->userdata['youg_admin'] )
		{			
			//print_r($this->input->post('id'));die;
			
			if(count($this->input->post()) > 0){
				
				$id = $this->input->post('id');
				$password = $this->input->post('password');
				
				//Getting detail for displaying in form
				$elitedata = array(
					'id' => $id,
					'password' => $password								
				);
				//print_r($elitedata);die;
			
				if( $this->elites->updateEliteMembersDetails($elitedata) )
				{			
					echo "success";					
				}
				else
				{
					echo "failure";			
				}
			}
		}
	}
	
	public function remove($id){
			
		if(!empty($id)){
			$elitedata = array(
				'id' => $id,
				'password' => ''								
			);
					//print_r($elitedata);die;
			
			if( $this->elites->updateEliteMembersDetails($elitedata) )
			{
				$this->session->set_flashdata('success', 'deleted password successfully');
				redirect('elite/reviewUploadSecurity', 'refresh');
			}
		}else{
			$this->session->set_flashdata('error', 'deleted password successfully');
			redirect('elite/reviewUploadSecurity', 'refresh');
		}
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('elite',$this->data);
	  	}
	}
	
	public function searchelitemember()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			
			$keyword = urlencode($this->input->post('keysearch'));		
			redirect('elite/index/?s='.$keyword);	
		}
		else
		{
			redirect('elite','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('+',' ', $keyword);
		$this->load->model('elites');
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		
		$this->data['elitemembers'] = $this->elites->search_elitemember($keyword,$limit,$offset);
				
		$this->paging['base_url'] = site_url("elite/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->elites->search_elitemember($keyword));
		$this->pagination->initialize($this->paging);
		
		$this->load->view('elite',$this->data);
	}
	
	public function subscriptions()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			//Loading Model File
	    			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			
			//Addingg Setting Result to variable
			$this->data['subscriptions'] = $this->settings->get_all_subscriptions($limit,$offset);
			$this->paging['base_url'] = site_url("elite/subscriptions/index");
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = count($this->settings->get_all_subscriptions());
			$this->pagination->initialize($this->paging);
			
			
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('elite',$this->data);
	  	}
	
	}

	public function view($id='')
	{
		if( $this->input->is_ajax_request() )
			{
				if( $this->session->userdata['youg_admin'] )
				{
					if(!$id)
					{
						redirect('elite', 'refresh');
					}
				
				//Getting detail for displaying in form
				$this->data['subscription'] = $this->elites->get_subscription_by_id($id);
	
				if( count($this->data['subscription'])>0 )
				{			
					//Loading View File
					$this->load->view('elite',$this->data);
				}
				else
				{
					$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
					redirect('elite', 'refresh');
				}
			}
		}
		else
		{
			redirect('elite', 'refresh');
		}
	}
	public function payview($id='')
	{
		
				if( $this->session->userdata['youg_admin'] )
				{
					if(!$id)
					{
						redirect('elite', 'refresh');
					}
				
				//Getting detail for displaying in form
				$this->data['payment'] = $this->elites->getElitePaymentDetails($id);
				
				if( count($this->data['payment'])>0 )
				{			
					//Loading View File
					$this->load->view('elite',$this->data);
				}
				else
				{
					$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
					redirect('elite', 'refresh');
				}
			}
		
		
	}
	
	function foo()
	{
		if($this->input->post('checktype'))
		{
			$type = $this->input->post('checktype');
			$foo = $this->input->post('foo');
			
			if($this->elites->multiple_function($type,$foo))
			{
				if($type='Disable')
				{
				$this->session->set_flashdata('success', 'Elite Membership status Disabled successfully.');
				}
				
				redirect('elite','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating. Try later!');
				redirect('elite','refresh');
			}
		}
		
	}
	
	public function csv($keyword)
    {
        if( $this->session->userdata['youg_admin'] )
        {
				if($keyword!='') 
				{
					$file = 'Report-of-search-elite.csv';					
					$searchKey = urldecode($keyword);
					$elites_data = $this->elites->elitesSearch($searchKey);
				}
				else
				{
					$file = 'Report-of-all-elite.csv';
					$elites_data = $this->elites->elitesSearch($searchKey = '');
				}
				ob_start();
				echo "Company,Name,Public Email,Private Email,Payment Amount,Status,Date Created,Payment Date"."\n";
				
				//print_r($elites_data);die;
				
				foreach($elites_data as $elites): 
					foreach($elites as $elite): 															
								
						echo "\"".$elite->company."\",";						
						echo "\"".$elite->contactname."\",";						
						echo "\"".$elite->email."\",";						
						echo "\"".$elite->contactemail."\",";						
						echo "\"".$elite->payment_currency.' '.$elite->payment_amount."\",";						
						echo "\"".$elite->status."\",";						
						echo date("m-d-Y",strtotime($elite->registerdate)).","; 
						echo date("m-d-Y",strtotime($elite->payment_date)); 
						echo "\n";													
					endforeach;
				endforeach;					
			
					$content = ob_get_contents();
					ob_end_clean();
					header("Expires: 0");
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
					header('Content-length: '.strlen($content));
					header('Content-disposition: attachment; filename='.basename($file));
					echo $content;
					exit;
							
						
		}
		else
		{
			redirect('adminlogin','refresh');
		}
    }
    
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
