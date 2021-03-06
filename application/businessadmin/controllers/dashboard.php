<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller {

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
	    	redirect('adminlogin', 'refresh');
		}
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = 'Administrator Dashboard';
		$this->data['section_title'] = 'Dashboard';
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
		$session_data = $this->session->userdata['youg_admin'];
		$this->data['username'] = ucfirst($session_data['username']);
		$id=$session_data = $this->session->userdata['youg_admin']['id'];
		$this->data['checksem'] = $this->settings->get_social_status_by_id($id);
			
		$this->load->view('dashboard',$this->data);	  
	}
	
	function logout()
	{
		if( isset($this->session->userdata['youg_admin']) )
		{
			$this->session->unset_userdata('youg_admin');
			$this->session->sess_destroy();
		  	redirect('adminlogin', 'refresh');
		}
		else
		{
			redirect('adminlogin', 'refresh');
		}	
	}
	//Function to Check E-mail or User name is already exists
	public function setsite()
	{
		if($this->session->userdata['youg_admin'] && $this->input->is_ajax_request() && ( $this->input->post('siteid') ) )
	  {
			if( $this->input->post('siteid') )
			{
				$id = $this->input->post('siteid');
			}
			
			if( $id!='zero')
			{
				$this->session->set_userdata('siteid', $id);
			}
			elseif($id!='all')
			{
				$this->session->set_userdata('siteid', 'all');
			}
			else
			{
				$this->session->set_userdata('siteid', 1);
			}
			
		}
		else
		{
			redirect('user', 'refresh');
		}
	}
	function popupclicked()
	{
		$this->data['show_welcome_video']=$this->settings->show_welcome_video();
		$this->load->view('dashboard',$this->data);   
	}
	function get_loginstatus()
	{
		$wid=$this->session->userdata['youg_admin']['id'];
		$this->data['get_loginstatus']=$this->settings->get_login_welcome_status($wid);
		$this->load->view('dashboard',$this->data);
		
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
