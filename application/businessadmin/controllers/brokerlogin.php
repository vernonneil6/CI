<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brokerlogin extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();

        //Setting Page Title and Comman Variable
		$this->data['title'] = 'Administrator Log-in';
		$this->data['section_title'] = 'Administrator Log-in';
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);  
		if( $this->session->userdata('broker_data') )
	  	{
	        redirect('broker', 'refresh');
		}
	}
	
	public function index()
	{
		
    	$this->load->library(array('encrypt', 'form_validation', 'session'));
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
				$this->load->model('brokerlogins');
				
				//query the database
				$result = $this->brokerlogins->logincheck($user_name, $user_pass);
				//print_r($result);die();
				if($result)
				{
					//$sess_array = array();
					foreach($result as $key=>$val)
					{
						$sess_array[$key] = $val;
					}
					//print_r($sess_array);die();
					$this->session->set_userdata('broker_data', $sess_array);
					
					// user has been logged in
					redirect('broker', 'refresh');
				}
				
				else
				{
					$this->session->set_flashdata('error', 'Invalid username or password');
					redirect('brokerlogin', 'refresh');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Invalid username or password');
				redirect('brokerlogin', 'refresh');
			}
		}
		
		//Loads the Admin Login view
		$this->load->view('brokerlogin',$this->data);
		
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
