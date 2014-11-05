<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timing extends CI_Controller {
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
		if( !$this->session->userdata('youg_admin'))
	  	{
		    //If no session, redirect to login page
			//echo site_url();die();
	      	redirect('adminlogin', 'refresh');
		}
		
		//Loading Helper File
	  	$this->load->helper('form');
			
		//Loading Model File
	 	$this->load->model('timings');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Hours';
		$this->data['section_title'] = 'Hours';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
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
		if( $this->session->userdata['youg_admin'] )
	  	{
			$id=$this->session->userdata['youg_admin']['id'];
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['timings'] = $this->timings->get_all_timings($id,$siteid);
			//Loading View File
			$this->load->view('timing',$this->data);
	  	}
	}
	
	public function edit()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$id=$this->session->userdata['youg_admin']['id'];
				
			//Getting detail for displaying in form
			$this->data['timings'] = $this->timings->get_all_timings($id,1);
			
			if( count($this->data['timings'])>0 )
			{			
				//Loading View File
				$this->load->view('timing',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('timing', 'refresh');
			}
	  }
	}
	
	//Updating the Record
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			
			$companyid=$this->session->userdata['youg_admin']['id'];
			//If Old Record Update
			if( $this->input->post('start0') )
	  		{
				for($i=0;$i<7;$i++) {
				//Getting value
				$day = ($this->input->post('day'.$i));
				$end = ($this->input->post('end'.$i));
				$start = ($this->input->post('start'.$i));
				$off = ($this->input->post('off'.$i));
						
				//Updating Record 
				$this->timings->update($companyid,$day,$off,$start,$end);
				
			}
				$this->session->set_flashdata('success', 'timing updated successfully.');
				redirect('timing', 'refresh');
				
			}
		}
		else
		{
							redirect('adminlogin', 'refresh');
		}
	}
	
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
