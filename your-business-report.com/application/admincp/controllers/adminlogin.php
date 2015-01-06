<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class AdminLogin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	
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
			else
			{
				redirect('dashboard', 'refresh');	
			}
		}
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = 'Administrator Log-in';
		$this->data['section_title'] = 'Administrator Log-in';
		
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		// LOAD LIBRARIES
    	$this->load->library(array('encrypt', 'form_validation', 'session'));
		
		// LOAD HELPERS
		$this->load->helper('form');
			
		// SET VALIDATION RULES
		$this->form_validation->set_rules('user_name', 'username', 'required');
		$this->form_validation->set_rules('user_pass', 'password', 'required');
		//$this->form_validation->set_error_delimiters('<em>','</em>');
						
		// has the form been submitted and with valid form info (not empty values)
		if( $this->input->post('user_name') &&  $this->input->post('user_pass'))
		{
			if($this->form_validation->run())
			{
				$user_name = $this->input->post('user_name');
				$user_pass = $this->input->post('user_pass');
				
				//Loads Adminlogin Model file
				$this->load->model('login');
				
				//query the database
				$result = $this->login->logincheck($user_name, $user_pass);
				//print_r($result);die();
				if($result)
				{
					//$sess_array = array();
					foreach($result as $key=>$val)
					{
						$sess_array[$key] = $val;
					}
					//print_r($sess_array);die();
					$this->session->set_userdata('youg_admin', $sess_array);
					$this->session->set_userdata('siteid', 1);
					
					// user has been logged in
					redirect('dashboard', 'refresh');
				}
				
				else
				{
					$this->session->set_flashdata('error', 'Invalid username or password');
					redirect('adminlogin', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect('adminlogin', 'refresh');
			}
		}
		
		//Loads the Admin Login view
		$this->load->view('adminlogin',$this->data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */