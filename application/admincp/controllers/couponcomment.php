<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Couponcomment extends CI_Controller {

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
			
		//Loading Model File
		$this->load->model('couponcomments');		
		$this->load->model('coupons');
		$this->load->model('users');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Comments on Coupons';
		$this->data['section_title'] = 'Comments';
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
	
	public function index($sort_by = 'commentdate', $sort_order = 'asc', $offset = 0) {
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			
			$this->data['fields'] = array(
				'id' => 'CouponComment ID',								
				'comment' => 'Title',
				'couponid' => 'Coupon',
				'commentby' => 'Submitted By',				
				'commentdate' => 'Comment Date',
				'status' => 'Status'			
			);
			
			$this->load->model('couponcomments');
			
			if(empty($sort_by) || empty($sort_order)){
				$offset = $sort_by;
			}
			
			$results = $this->couponcomments->couponcommentsSearch($limit, $offset, $sort_by, $sort_order);
			
			$this->data['couponcomments'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			
			
			// pagination
			if(!empty($sort_by) && !empty($sort_order)){
				$siteURL = site_url("couponcomment/index/$sort_by/$sort_order");
				$uriSegment = 5;
			}
			else{
				$siteURL = site_url("couponcomment/index");
				$uriSegment = 3;
			}					
			$this->paging['base_url'] = $siteURL;				
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;
			$this->paging['uri_segment'] = $uriSegment;
			$this->pagination->initialize($this->paging);									
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('couponcomment', $this->data);
		}
	}
	
	
	public function view($id='')
	{
		if( $this->input->is_ajax_request() )
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
				if($id!='' && $id!=0) 
				{
					//Getting detail for displaying in form
					$this->data['couponcomment'] = $this->couponcomments->get_couponcomment_byid($id);
					/*echo "<pre>";
					print_r($this->data['comment']);
					die();*/
					if( count($this->data['couponcomment'])>0 )
					{		
						//Loading View File
						$this->load->view('couponcomment',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('couponcomment', 'refresh');
					}
			}
					else
					{
							redirect('couponcomment', 'refresh');
					}
	  		}
			}
		else
		{
			redirect('couponcomment','refresh');
		}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
					if( $this->couponcomments->disable_couponcomment_byid($id) )
					{
							$this->session->set_flashdata('success', 'Comment status disabled successfully.');
							redirect('couponcomment', 'refresh');
					}
				else
					{
						$this->session->set_flashdata('error', 'There is error in updating Complaint status. Try later!');
						redirect('couponcomment', 'refresh');
					}
			}
		else
			{
				redirect('couponcomment', 'refresh');
			}
 		}
}
	
	//Function For Change Status to "Enable"
	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
				if( $this->couponcomments->enable_couponcomment_byid($id) )
				{
					$this->session->set_flashdata('success', 'Comment status enabled successfully.');
					redirect('couponcomment', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating Complaint status. Try later!');
					redirect('couponcomment', 'refresh');
				}
			}
			else
			{
				redirect('comment', 'refresh');
			}
	  }
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('couponcomment',$this->data);
	  	}
	}
	
	public function searchcomment()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('couponcomment/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('couponcomment','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			
		//Addingg Setting Result to variable
		$this->data['couponcomments'] = $this->couponcomments->search_couponcomment($keyword,$limit,$offset);
			
		$this->paging['base_url'] = site_url("couponcomment/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->couponcomments->search_couponcomment($keyword));
		$this->pagination->initialize($this->paging);
		
		$this->load->view('couponcomment',$this->data);
	}
	
	function foo()
	{
		if($this->input->post('checktype'))
		{
			$type = $this->input->post('checktype');
			$foo = $this->input->post('foo');
			
			if($this->couponcomments->multiple_function($type,$foo))
			{
				if($type='Delete')
				{
				$this->session->set_flashdata('success', 'Comments Deleted successfully.');
				}
				if($type='Disable')
				{
				$this->session->set_flashdata('success', 'Comments Disabled successfully.');
				}
				if($type='Enable')
				{
				$this->session->set_flashdata('success', 'Comments Enabled successfully.');
				}
				redirect('couponcomment','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating. Try later!');
				redirect('couponcomment','refresh');
			}
		}
		
	}
	
	function edit($id)
	{
		$this->data['edit'] = $this->couponcomments->get_couponcomment_byid($id);
		$this->data['id'] = $id;
		$this->load->view('couponcomment',$this->data);
	}
	
	function update()
	{
		$title = $this->input->post('title');
		$id = $this->input->post('id');
		if($this->couponcomments->updatecomment($title, $id))
		{
			$this->session->set_flashdata('success', 'Title is updated successfully');
			redirect('couponcomment','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'There is error in updating');
			redirect('couponcomment','refresh');
		}
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
