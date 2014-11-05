<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
	
	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		
		// Your own constructor code
		if( !$this->session->userdata('youg_admin') )
	  	{
			//If no session, redirect to login page
			//echo site_url();die();
	    	redirect('adminlogin', 'refresh');
		}
		
		// LOAD HELPERS
		$this->load->helper('form');
		//Loading Model File
  		$this->load->model('seos');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : SEO Tools ';
		$this->data['section_title'] = 'SEO Tools';
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		$websites = $this->settings->get_all_urls();
		
		if( count($websites) > 0 )
				{
					$this->data['selsite']['zero'] = 'Select Site';
					$this->data['selsite']['all'] = 'All Websites';
					for($c=0;$c<count($websites);$c++)
					{
						$this->data['selsite'][stripslashes($websites[$c]['id'])] = ucwords(stripslashes($websites[$c]['title']));
					}
				}
				else
				{
					$this->data['selsite']['all'] = 'All Websites';
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
			$id=$this->session->userdata['youg_admin']['id'];
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata['siteid'];
			$this->data['seos'] = $this->seos->get_all_seosetting($id,$siteid);
			//echo "<pre>";
			//print_r($this->data['seos']);
			//die();
			
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
				$fieldname1 = $this->input->post('my');
				
				//Updating SEO Record
				if( $this->seos->update($intid,$txtvalue,$fieldname1) )
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
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
