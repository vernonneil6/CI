<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Dispute extends CI_Controller 
{
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
  		$this->load->model('disputes');
		
		
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['title'] = $this->data['site_name'].' : Disputes ';
		$this->data['section_title'] = 'Disputes';
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
				
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
	
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
			$this->data['disputes'] = $this->disputes->get_all_disputesetting($siteid);
			
			$this->load->library('pagination');
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			//Addingg Setting Result to variable
			$this->data['dispute'] = $this->disputes->listdispute($limit,$offset);
			
			$this->paging['base_url'] = site_url("dispute/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = $this->disputes->dispute_count();
			$this->pagination->initialize($this->paging);
			
            //$this->data['dispute']=$this->disputes->listdispute();
			//Loading View File
			$this->load->view('dispute',$this->data);
	  }
	}	
	public function review($id)
	{
		if($this->session->userdata['youg_admin'])
	  {
			$data=$this->disputes->reviewdispute($id);
            $this->data['disputeid']=$data['id'];
            $this->data['dispute']=$data['dispute'];
            $this->data['companyname']=$data['companyname'];
            $this->data['companyemail']=$data['companyemail'];
            $this->data['companyid']=$data['companyid'];
            $this->data['userid']=$data['userid'];
            $this->data['username']=$data['username'];
            $this->data['useremail']=$data['useremail'];
            $this->data['status']=$data['status'];
            $this->data['issue']=$data['issuestatus'];
            $this->data['date']=$data['ondate'];
            $this->data['closedate']=$data['closeddate'];
            $this->data['companyreview']=$data['companyreview'];
			//Loading View File
			$this->load->view('disputereview',$this->data);
	  }
	}	
}
