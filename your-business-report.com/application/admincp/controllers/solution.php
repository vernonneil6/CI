<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Solution extends CI_Controller {

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
	* @see http://codeigniter.com/solution_guide/general/urls.html
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
	  	$this->load->model('solutions');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		if(  $this->uri->segment(2) && ( $this->uri->segment(2)=='searchresult' || $this->uri->segment(2)=='search' ))
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Search Business Solutions';
			$this->data['section_title'] = 'Search';
		}
		else
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Business Solutions';
			$this->data['section_title'] = 'Business Solutions';
		}
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
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$siteid = $this->session->userdata('siteid');
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			
			//Addingg Setting Result to variable
			$this->data['solutions'] = $this->solutions->get_all_solutions($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['solutions']);
			die();*/
			
			$this->paging['base_url'] = site_url("solution/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->solutions->get_all_solutions($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('solution',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			$this->load->helper('ckeditor');
			$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id'	=>	'detail',
			'path'  =>  '../../ckeditor',
			//Optionnal values
			'config' => array(
								'toolbar'	=>	"Full",     //Using the Full toolbar
								'width'   =>  "auto",    //a custom width
								'height'  =>  "300px",    //a custom height
							),
					);

			//Loading View File
			$this->load->view('solution',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('solution', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['solution'] = $this->solutions->get_solution_byid($id);

			if( count($this->data['solution'])>0 )
			{
				$this->load->helper('ckeditor');
				$this->data['ckeditor'] = array(
				//ID of the textarea that will be replaced
            	'id'	=>	'detail',
            	'path'  =>  '../../ckeditor',
				//Optionnal values
				'config' => array(
									'toolbar'	=>	"Full",     //Using the Full toolbar
									'width'   =>  "auto",    //a custom width
									'height'  =>  "300px",    //a custom height
								),
						);
				
				//Loading View File
				$this->load->view('solution',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('solution', 'refresh');
			}
	  }
	}
	
	public function view($id='')
	{
		if($this->input->is_ajax_request())
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('solution', 'refresh');
			}
			//Getting detail for displaying in form
			$this->data['solution'] = $this->solutions->get_solution_byid($id);
			/*echo "<pre>";
			print_r($this->data['solution']);
			die();*/
			if( count($this->data['solution'])>0 )
			{			
				//Loading View File
				$this->load->view('solution',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('solution', 'refresh');
			}
	  	}
		}
		else
		{
				redirect('solution', 'refresh');
		}
	}
	
	//Updating the Record
	public function update()
	{
		//echo '<pre>';print_r($_REQUEST['detail']); die();
		if( $this->session->userdata['youg_admin'] )
	  	{
			//If Old Record Update
			if( $this->input->post('id') )
	  		{
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$title = addslashes($this->input->post('title'));
				$detail = $_REQUEST['detail'];
				
				//Updating Record With Image
				if( $this->solutions->update($id,$title,$detail))
				{
					$this->session->set_flashdata('success', 'business solution updated successfully.');
					redirect('solution', 'refresh');;
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating business solution. Try later!');
					redirect('solution', 'refresh');
				}
			}
			
			//If New Record Insert
			else
			{
				//Getting value
				$title = addslashes($this->input->post('title'));
				$detail = $_REQUEST['detail'];
				$siteid = $this->session->userdata('siteid');
						//Inserting Record
					if( $this->solutions->insert($title,$detail,$siteid) )
					{
						$this->session->set_flashdata('success', 'business solution inserted successfully.');
						redirect('solution', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in inserting business solution. Try later!');
						redirect('solution', 'refresh');
					}
			}
		}
	}
	
	//Function For Deleting Record
	public function delete($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('solution', 'refresh');
			}
			
			//Deleting Record
			if( $this->solutions->delete_solution_byid($id) )
			{
				$this->session->set_flashdata('success', 'business solution deleted successfully.');
				redirect('solution', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting business solution. Try later!');
				redirect('solution', 'refresh');
			}
	  	}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('solution', 'refresh');
			}
				
			if( $this->solutions->disable_solution_byid($id) )
			{
				$this->session->set_flashdata('success', 'business solution status disabled successfully.');
				redirect('solution', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating business solution status. Try later!');
				redirect('solution', 'refresh');
			}
	  }
	}
	
	//Function For Change Status to "Enable"
	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if(!$id)
			{
				redirect('solution', 'refresh');
			}
				
			if( $this->solutions->enable_solution_byid($id) )
			{
				$this->session->set_flashdata('success', 'business solution status enabled successfully.');
				redirect('solution', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating business solution status. Try later!');
				redirect('solution', 'refresh');
			}
	  }
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('solution',$this->data);
	  	}
	}
	
	public function searchsolution()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('solution/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('solution','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');				
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			
		//Addingg Setting Result to variable
		$this->data['solutions'] = $this->solutions->search_solution($keyword,$siteid,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['solutions']);
		//die();
			
		$this->paging['base_url'] = site_url("solution/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->solutions->search_solution($keyword,$siteid));
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		$this->load->view('solution',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */