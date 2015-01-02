<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Search extends CI_Controller {

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
	* @see http://codeigniter.com/search_guide/general/urls.html
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
	 	$this->load->model('searchs');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Trending Searches';
		$this->data['section_title'] = 'Trending Searches';
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
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			$siteid = $this->session->userdata('siteid');
			//Addingg Setting Result to variable
			$this->data['searchs'] = $this->searchs->get_all_searchs($siteid,$limit,$offset);
					
			$this->paging['base_url'] = site_url("search/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->searchs->get_all_searchs($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('search',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('search',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('search', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['search'] = $this->searchs->get_search_byid($id);
			/*echo "<pre>";
			print_r($this->data['search']);
			die();*/
			if( count($this->data['search'])>0 )
			{			
				//Loading View File
				$this->load->view('search',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('search', 'refresh');
			}
	  }
	}
	
		//Updating the Record
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			//If Old Record Update
			if( $this->input->post('id') )
	  		{
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$keyword = addslashes($this->input->post('keyword'));
				
				//Updating Record With Image
				if( $this->searchs->update($id,$keyword))
				{
					$this->session->set_flashdata('success', 'search keyword updated successfully.');
					redirect('search', 'refresh');;
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating search. Try later!');
					redirect('search', 'refresh');
				}
			}			
			//If New Record Insert
			else
			{
				//Getting value
				$keyword = addslashes($this->input->post('keyword'));
				$siteid = $this->session->userdata('siteid');
				
				//Inserting Record
				if( $this->searchs->insert($keyword) )
				{
					$this->session->set_flashdata('success', 'search keyword inserted successfully.');
					redirect('search', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in inserting search keyword. Try later!');
					redirect('search', 'refresh');
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
				redirect('search', 'refresh');
			}
			
			//Unlink Old Images
			$media = $this->searchs->get_search_byid($id);
			
			//Deleting Record
			if( $this->searchs->delete_search_byid($id) )
			{
				$this->session->set_flashdata('success', 'search deleted successfully.');
				redirect('search', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting search. Try later!');
				redirect('search', 'refresh');
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
				redirect('search', 'refresh');
			}
				
			if( $this->searchs->disable_search_byid($id) )
			{
				$this->session->set_flashdata('success', 'search status disabled successfully.');
				redirect('search', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating search status. Try later!');
				redirect('search', 'refresh');
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
				redirect('search', 'refresh');
			}
			
			if( $this->searchs->enable_search_byid($id) )
			{
				$this->session->set_flashdata('success', 'search status enabled successfully.');
				redirect('search', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating search status. Try later!');
				redirect('search', 'refresh');
			}
	  }
	}
	
	public function searchsearch()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('search/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('search','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');	
		$this->data['searchs'] = $this->searchs->search_search($keyword,$siteid);
		$this->load->view('search',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */