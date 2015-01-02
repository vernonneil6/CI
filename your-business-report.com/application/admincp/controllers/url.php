<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url extends CI_Controller {

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
	* @see http://codeigniter.com/url_guide/general/urls.html
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
		//Loading Model File
	  	$this->load->model('urls');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Web Sites';
		$this->data['section_title'] = 'Web Sites';
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
			$companyid = $this->session->userdata['youg_admin']['id'];
			//Addingg Setting Result to variable
			$this->data['urls'] = $this->urls->get_all_urls();
			/*echo "<pre>";
			print_r($this->data['urls']);
			die();*/
			
			//Loading View File
			$this->load->view('url',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			$urls = $this->urls->get_all_urls();
			if(count($urls)>14)
			{
				$this->session->set_flashdata('error', 'You have already added 15 websites');
				redirect('url', 'refresh');
			}
			//Loading View File
			$this->load->view('url',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('url', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['url'] = $this->urls->get_url_byid($id);

			if( count($this->data['url'])>0 )
			{
				//Loading View File
				$this->load->view('url',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('url', 'refresh');
			}
	  }
	}
	
	//Updating the Record
	public function update()
	{
		//echo '<pre>';print_r($_REQUEST['detail']); die();
		if( $this->session->userdata['youg_admin'] )
	  	{
			//If Old Record Update
			if( $this->input->post('id') )
	  		{
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				$title = addslashes($this->input->post('title'));
				$url = addslashes($this->input->post('url'));
				$siteurl = addslashes($this->input->post('siteurl'));
								
				//Updating Record 
				if( $this->urls->update($id,$title,$url,$siteurl))
				{
					$this->session->set_flashdata('success', 'Website updated successfully.');
					redirect('url', 'refresh');
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating  Website. Try later!');
					redirect('url', 'refresh');
				}
			}
		}
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */