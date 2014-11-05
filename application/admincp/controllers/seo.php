<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Seo extends CI_Controller {

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
  		$this->load->model('seos');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : SEOs ';
		$this->data['section_title'] = 'SEOs';
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
		if($this->session->userdata['youg_admin'])
	  {
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['seos'] = $this->seos->get_all_seosetting($siteid);
			
			//Loading View File
			$this->load->view('seo',$this->data);
	  }
	}
	
	public function edit($intid='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if(!$intid)
			{
				redirect('seo', 'refresh');
			}
			//Addingg Result to view parameter
			$this->data['seo'] = $this->seos->get_seosetting_byid($intid);
			/*echo "<pre>";
			print_r($this->data['seo']);
			die();*/
			if( count($this->data['seo'])>0 )
			{
				//Loading View File
				$this->load->view('seo',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('seo', 'refresh');
			}
	  }
	}
	
	//Updating the record
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if( $this->input->post('txtintid') )
	  		{
				//Getting intid
				$intid = $this->encrypt->decode($this->input->post('txtintid'));
				
				//Getting value
				$txtvalue = addslashes($this->input->post('txtvalue'));
							
				//Updating SEO Record
				if( $this->seos->update($intid,$txtvalue) )
				{
					$this->session->set_flashdata('success', 'SEO updated successfully.');
					redirect('seo', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating SEO. Try later!');
					redirect('seo', 'refresh');
				}
			}
			else
			{
				redirect('seo', 'refresh');
			}
		}
	}
	
	public function searchseo()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('seo/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('seo','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');	
		$this->data['seos'] = $this->seos->search_seo($keyword,$siteid);
		$this->load->view('seo',$this->data);
	}
	
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */