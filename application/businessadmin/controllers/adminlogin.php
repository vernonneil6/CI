<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		// Your own constructor code
		if( $this->session->userdata('youg_admin') )
	  	{
		    //If session, redirect to dashboard page
			//echo site_url();die();
	        redirect('dashboard', 'refresh');
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
				$result1 = $this->login->disablelogincheck($user_name, $user_pass);
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
				if($result1)
				{
					$id = $result1['id'];
					$this->session->set_flashdata('error', 'Subscription expired.Please renew your account here.');
					$url =  'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/solution/renew/'.$id;
					redirect($url,'refresh');
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
	function forgotpassword()
	{
		$this->load->view('forgot',$this->data);
	}
	function forgotusername()
	{
		$this->load->view('forgot',$this->data);
	}
	
	function update()
	{
		if( $this->input->post('email'))
		{
			if($this->input->post('email'))
			{
				$user_name = $this->input->post('email');
				$forgottype = $this->input->post('forgottype');
								
				//Loads Adminlogin Model file
				$this->load->model('login');
				
				$site_name = $this->settings->get_setting_value(1);
				$site_url = $this->settings->get_setting_value(2);
				$site_mail = $this->settings->get_setting_value(5);
				
				//query the database
				$result = $this->login->get_eliteuser($user_name);
				
				if(!empty($result))
				{
					
					$username = $result['username'];
					$password = $result['password'];
										
					$name = ucfirst($result['company']);
			    
					 //Loading E-mail config file
					 $this->config->load('email',TRUE);
					 $this->cnfemail = $this->config->item('email');
							  
						  //Loading E-mail Class
						  $this->load->library('email');
						  
						  $this->email->initialize($this->cnfemail);
						  //E-mail From Id
						  $this->email->from($site_mail,$site_name);
						  
						  //E-mail To Id
						  $this->email->to($user_name);
						  
						   //E-mail Subject
						  $this->email->subject($site_name ." : Account Details" );
						  $mail_body = '<p>
	Dear&nbsp; '.$name.',</p>
<p>
	Your Account Details are as below.</p>
<p>
	<strong>Login Details : </strong></p>
<table border="0" cellpadding="1" cellspacing="1">
	<tbody>
		<tr>
			<td>
				Username</td>
			<td>
				<strong>:</strong></td>
			<td>
				'.$user_name.'</td>
		</tr>
		<tr>
			<td>
				Email</td>
			<td>
				<strong>:</strong></td>
			<td>
				'.$user_name.'</td>
		</tr>
		<tr>
			<td>
				Password</td>
			<td>
				<strong>:</strong></td>
			<td>
				'.$password.'</td>
		</tr>
		
	</tbody>
</table>
<p>
	Regards,<br />
	The '.$site_name.' Team.</p>
';
						  $this->email->message("<table cellpadding='0' cellspacing='0'><tr><td>".$mail_body."</td></tr></table>");
							
						   if($this->email->send())
						  {
							$this->session->set_flashdata('success', 'Your account details has been sent to your registered email address.');
							redirect('adminlogin', 'refresh');
						  }
						  else
						  {
							 $this->session->set_flashdata('error', 'There is an error in sending e-mail, please try again!');
							 redirect('adminlogin/'.$forgottype, 'refresh');
						  }
	 
					  }
			else
			{
				$this->session->set_flashdata('error', 'This email is does not exists in our database.');
				redirect('adminlogin', 'refresh');
			}
		}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
