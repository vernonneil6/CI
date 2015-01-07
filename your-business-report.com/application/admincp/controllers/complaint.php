<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Complaint extends CI_Controller {

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
  		$this->load->model('complaints');
		$this->load->model('companys');
		$this->load->model('users');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Complaints';
		$this->data['section_title'] = 'Complaints';
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
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			$siteid = $this->session->userdata('siteid');
			//Addingg Setting Result to variable
			$this->data['complaints'] = $this->complaints->get_all_complaints($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['complaints']);
			die();*/
			
			$this->paging['base_url'] = site_url("complaint/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->complaints->get_all_complaints($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			//Loading View File
			$this->load->view('complaint',$this->data);
	  	}
	}

	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('complaint', 'refresh');
			}
			//Getting detail for displaying in form
			$this->data['complaint'] = $this->complaints->get_complaint_byid($id);
			/*echo "<pre>";
			print_r($this->data['complaint']);
			die();*/
			if( count($this->data['complaint'])>0 )
			{			
				//Loading View File
				$this->load->view('complaint',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('complaint', 'refresh');
			}
	  }
	}
	
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			//If Old Record Update
			if( $this->input->post('txtintid') )
	  		{
				//Getting intid
				$intid = $this->encrypt->decode($this->input->post('txtintid'));
				
				//Getting value
				$complainttype = addslashes($this->input->post('complainttype'));
				$damagesinamt = addslashes($this->input->post('damagesinamt'));
				$whendate = date("Y-m-d",strtotime($this->input->post('whendate')));
				$location = addslashes($this->input->post('location'));
				$detail = addslashes($this->input->post('detail'));
				$comseokeyword = addslashes($this->input->post('comseokeyword'));
				
				if( $detail!='' )
				{				
					//Updating Record
					if( $this->complaints->update($intid,$complainttype,$damagesinamt,$whendate,$location,$detail,$comseokeyword) )
					{
						$this->session->set_flashdata('success', 'Complaint details updated successfully.');
						redirect('complaint', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in updating complaint details. Try later!');
						redirect('complaint', 'refresh');
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Detail field is required.');
					redirect('complaint', 'refresh');
				}
			}
		}
	}
	
	public function delete($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('complaint', 'refresh');
			}
			
			//Deleting Record
			if( $this->complaints->delete_complaint_byid($id) )
			{
				$this->session->set_flashdata('success', 'Complaint deleted successfully.');
				redirect('complaint', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting Complaint. Try later!');
				redirect('complaint', 'refresh');
			}
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
					$this->data['complaint'] = $this->complaints->get_complaint_byid($id);
					/*echo "<pre>";
					print_r($this->data['complaint']);
					die();*/
					if( count($this->data['complaint'])>0 )
					{		
						//Loading View File
						$this->load->view('complaint',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('complaint', 'refresh');
					}
			}
					else
					{
							redirect('complaint', 'refresh');
					}
	  		}
			}
		else
		{
			redirect('complaint','refresh');
		}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
					if( $this->complaints->disable_complaint_byid($id) )
					{
							$this->session->set_flashdata('success', 'Complaint status disabled successfully.');
							redirect('complaint', 'refresh');
					}
				else
					{
						$this->session->set_flashdata('error', 'There is error in updating Complaint status. Try later!');
						redirect('complaint', 'refresh');
					}
			}
		else
			{
				redirect('complaint', 'refresh');
			}
 		}}
	
	//Function For Change Status to "Enable"
	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
				if( $this->complaints->enable_complaint_byid($id) )
				{
					$this->session->set_flashdata('success', 'Complaint status enabled successfully.');
					redirect('complaint', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating Complaint status. Try later!');
					redirect('complaint', 'refresh');
				}
			}
			else
			{
				redirect('complaint', 'refresh');
			}
	  }
	}
	
	//Function to Check Seokeyword is already exists
	public function fieldcheck()
	{
		if($this->session->userdata['youg_admin'] && $this->input->is_ajax_request() && ( $this->input->post('comseokeyword') ) )
	  {
			if( $this->input->post('id') )
			{
				$id = $this->input->post('id');
			}
			else
			{
				$id = 0;
			}
			if( $this->input->post('comseokeyword') )
			{
				$field = 'comseokeyword';
				$fieldvalue = addslashes($this->input->post('comseokeyword'));
			}
			if($field)
			{
				//Addingg Result to view parameter
				$result = $this->complaints->chkfield($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('complaint', 'refresh');
		}
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('complaint',$this->data);
	  	}
	}
	
	public function searchcomplaint()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('complaint/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('complaint','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
	
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		$siteid = $this->session->userdata('siteid');
		$this->data['complaints'] = $this->complaints->search_complaint($keyword,$siteid,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['complaints']);
		//die();
		//Addingg Setting Result to variable
					
		$this->paging['base_url'] = site_url("complaint/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->complaints->search_complaint($keyword,$siteid));
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		
		$this->load->view('complaint',$this->data);
	}
	public function removed()
	{
	
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			$siteid = $this->session->userdata('siteid');
			//Addingg Setting Result to variable
			$this->data['removedcomplaints'] = $this->complaints->get_all_removedcomplaints($siteid,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['removedcomplaints']);
			die();*/
			
			$this->paging['base_url'] = site_url("complaint/removed/index");
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = count($this->complaints->get_all_removedcomplaints($siteid));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			//Loading View File
			$this->load->view('complaint',$this->data);
	  	}
	
	}
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */