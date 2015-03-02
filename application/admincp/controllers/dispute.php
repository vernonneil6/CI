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
		
		$this->load->library('pagination');
		
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
	
	public function index($sortby)
	{
		if($this->session->userdata['youg_admin'])
		{
			$limit = $this->paging['per_page'];
		  
			if($sortby=='company')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("dispute/index/company");
				$orderby = 'asc';
				$url = 4;
				
			}
			else if($sortby=='username')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("dispute/index/username");
				$orderby = 'asc';
				$url = 4;
			}
			else if($sortby=='dispute')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("dispute/index/dispute");
				$orderby = 'asc';
				$url = 4;
			}
			else if($sortby=='status')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("dispute/index/status");
				$orderby = 'asc';
				$url = 4;
			}
			else
			{
				$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
				$base = site_url("dispute/index");
				$orderby = 'desc';
				$url = 3;
			}
			
			
			//Addingg Setting Result to variable
			$siteid = $this->session->userdata('siteid');
			$this->data['disputes'] = $this->disputes->get_all_disputesetting($siteid);
			
			$this->load->library('pagination');
			
			

			//Addingg Setting Result to variable
			$this->data['dispute'] = $this->disputes->listdispute($limit,$offset,$sortby, $orderby);
			
			$this->paging['base_url'] = $base;
			$this->paging['uri_segment'] = $url;
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
	
	public function searchdispute()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			redirect('dispute/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('dispute','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

		$this->data['dispute'] = $this->disputes->search_elitemember($keyword,$limit,$offset);
		
		$this->paging['base_url'] = site_url("dispute/searchresult/".$keyword);
		$this->paging['uri_segment'] = 3;
		$this->paging['total_rows'] = count($this->disputes->search_elitemember($keyword));
		$this->pagination->initialize($this->paging);
	
		$this->load->view('dispute',$this->data);

	}
	
	public function csv($keyword)
    {
        if( $this->session->userdata['youg_admin'] )
        {
				if($keyword!='') 
				{
					$file = 'Report-of-search-dispute.csv';				
					$dispute = $this->disputes->search_elitemember($keyword);
				}
				else
				{
					$file = 'Report-of-all-dispute.csv';
					$dispute = $this->disputes->listdispute();
				}
				ob_start();
				echo "Company,Username,Dispute,Status,Date"."\n";
				
				   for($i=0;$i<count($dispute);$i++) { 
					
						echo stripslashes(ucwords($dispute[$i]->companyname)).',';
						echo stripslashes(ucwords($dispute[$i]->username)).',';
						echo stripslashes(ucwords($dispute[$i]->dispute)).',';
						echo stripslashes(ucwords($dispute[$i]->status)).',';
						echo date("m-d-Y",strtotime($dispute[$i]->ondate)); 
						echo "\n";							
					}
			
					$content = ob_get_contents();
					ob_end_clean();
					header("Expires: 0");
					header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
					header("Cache-Control: no-store, no-cache, must-revalidate");
					header("Cache-Control: post-check=0, pre-check=0", false);
					header("Pragma: no-cache");  header("Content-type: application/csv;charset:UTF-8");
					header('Content-length: '.strlen($content));
					header('Content-disposition: attachment; filename='.basename($file));
					echo $content;
					exit;
							
						
		}
		else
		{
			redirect('adminlogin','refresh');
		}
    }	
    
    
}
