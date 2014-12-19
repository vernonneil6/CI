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
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			//Loading Model File
	    			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			
			//Addingg Setting Result to variable
			$this->data['elitemembers'] = $this->settings->get_all_elitemembers($limit,$offset);
			/*echo "<pre>";
			print_r($this->data['complaints']);
			die();*/
			
			$this->paging['base_url'] = site_url("elite/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->settings->get_all_elitemembers());
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('elite',$this->data);
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
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('elite/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('elite','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$this->load->model('elites');
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		
		$this->data['elitemembers'] = $this->elites->search_elitemember($keyword,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['elitemembers']);
		//die();
				
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
				$this->data['payment'] = $this->elites->get_elitepayment_byid($id);
	
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
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
