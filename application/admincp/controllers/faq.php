<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Faq extends CI_Controller {
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
	  	$this->load->model('faqs');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : FAQs';
		$this->data['section_title'] = 'FAQs';
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
			
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['faqs'] = $this->faqs->get_all_faqs($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['faqs']);
			die();*/
			
			$this->paging['base_url'] = site_url("faq/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->faqs->get_all_faqs($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();

			//Loading View File
			$this->load->view('faq',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('faq',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('faq', 'refresh');
			}
						
			//Getting detail for displaying in form
			$this->data['faq'] = $this->faqs->get_faq_byid($id);
			/*echo "<pre>";
			print_r($this->data['faq']);
			die();*/
			if( count($this->data['faq'])>0 )
			{			
				//Loading View File
				$this->load->view('faq',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('faq', 'refresh');
			}
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
				redirect('faq', 'refresh');
			}
			//Getting detail for displaying in form
			$this->data['faq'] = $this->faqs->get_faq_byid($id);
			/*echo "<pre>";
			print_r($this->data['faq']);
			die();*/
			if( count($this->data['faq'])>0 )
			{			
				//Loading View File
				$this->load->view('faq',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('faq', 'refresh');
			}
	  	}
		}
		else
		{
			redirect('faq', 'refresh');
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
						$question = addslashes($this->input->post('question'));
					    $answer = addslashes($this->input->post('answer'));
						
						//Updating Record With Image
						if($this->faqs->update($id,$question,$answer))
						{
							$this->session->set_flashdata('success', 'FAQ updated successfully.');
							redirect('faq', 'refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'There is error in updating FAQ. Try later!');
							redirect('faq', 'refresh');
						}
				}
			//If New Record Insert
			else
				{
					//Getting value
					$question = addslashes($this->input->post('question'));
					$answer = addslashes($this->input->post('answer'));
					$siteid = $this->session->userdata('siteid');
								
					//Inserting Record
					if( $this->faqs->insert($question,$answer,$siteid) )
					{
							$this->session->set_flashdata('success', 'FAQ inserted successfully.');
							redirect('faq', 'refresh');
					}
					else
					{
							$this->session->set_flashdata('error', 'There is error in inserting FAQ. Try later!');
							redirect('faq', 'refresh');
					}
				}
			}
			else
				{
							redirect('adminlogin', 'refresh');
				}
			}

	//Function For Deleting Record
	public function delete($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('faq', 'refresh');
			}
			
			$faq = $this->faqs->get_faq_byid($id);
			if(count($faq)>0) {
			//Deleting Record
			if( $this->faqs->delete_faq_byid($id) )
			{
				$this->session->set_flashdata('success', 'FAQ deleted successfully.');
				redirect('faq', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting FAQ. Try later!');
				redirect('faq', 'refresh');
			} }
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting FAQ. Try later!');
				redirect('faq', 'refresh');
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
				redirect('faq', 'refresh');
			}
				
			$faq = $this->faqs->get_faq_byid($id);
			if(count($faq)>0) {
			if( $this->faqs->disable_faq_byid($id) )
			{
				$this->session->set_flashdata('success', 'FAQ status disabled successfully.');
				redirect('faq', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating FAQ status. Try later!');
				redirect('faq', 'refresh');
			} }
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating FAQ status. Try later!');
				redirect('faq', 'refresh');
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
				redirect('faq', 'refresh');
			}
			
			$faq = $this->faqs->get_faq_byid($id);
			if(count($faq)>0) {
			if( $this->faqs->enable_faq_byid($id) )
			{
				$this->session->set_flashdata('success', 'FAQ status enabled successfully.');
				redirect('faq', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating FAQ status. Try later!');
				redirect('faq', 'refresh');
			}}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating FAQ status. Try later!');
				redirect('faq', 'refresh');
			}
	  }
	}
	
	public function searchfaq()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('faq/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('faq','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');	
		$this->data['faqs'] = $this->faqs->search_faq($keyword,$siteid);
		$this->load->view('faq',$this->data);
	}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */