<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Review extends CI_Controller {

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
			/*last url status - start*/
			$currenturl = $this->uri->uri_string;		
			$this->session->set_userdata('last_url',$this->session->userdata('current_url'));
			$this->session->set_userdata('current_url',$currenturl);		
			$this->load->model('reviews');
			$this->load->model('companys');
			/*last url status - end*/
			
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
	 	$this->load->model('reviews');
		$this->load->model('companys');
		$this->load->model('users');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Business Reviews';
		$this->data['section_title'] = 'Business Reviews';
		
		if($this->uri->segment(2) && ( $this->uri->segment(2) == 'viewcomments'))
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Comments';	
			$this->data['section_title'] = 'Comments';
		}
		$this->data['site_name'] = $this->settings->get_setting_value(1);
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
		
		//Load heading and save in variable
		$this->data['heading'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index($sortby)
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = $this->paging['per_page'];
			
			if($sortby=='review')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("review/index/review");
				$orderby = 'asc';
				$url = 4;
				
			}
			else if($sortby=='to')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("review/index/to");
				$orderby = 'asc';
				$url = 4;
			}
			else if($sortby=='by')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("review/index/by");
				$orderby = 'asc';
				$url = 4;
			}
			else if($sortby=='ip')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("review/index/ip");
				$orderby = 'asc';
				$url = 4;
			}
			else
			{
				$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
				$base = site_url("review/index");
				$orderby = 'asc';
				$url = 3;
			}
			
			//Addingg Setting Result to variable
			$this->data['reviews'] = $this->reviews->get_all_reviews($limit,$offset,$sortby, $orderby);
			/*echo "<pre>";
			print_r($this->data['reviews']);
			die();*/
			
			$this->paging['base_url'] = $base;
			$this->paging['uri_segment'] = $url;
			$this->paging['total_rows'] = count($this->reviews->get_all_reviews());
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('review',$this->data);
	  	}
	}
	
	
	public function view($id='')
	{
		if($this->input->is_ajax_request())
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
				if($id!='' && $id!=0) 
				{
					//Getting detail for displaying in form
					$this->data['review'] = $this->reviews->get_review_byid($id);
					/*echo "<pre>";
					print_r($this->data['review']);
					die();*/
					if( count($this->data['review'])>0 )
					{		
						//Loading View File
						$this->load->view('review',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('review', 'refresh');
					}
			}
				else
				{
						redirect('review', 'refresh');
				}
  		}
		}
		else
		{
					redirect('review', 'refresh');
		}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
					if( $this->reviews->disable_review_byid($id) )
					{
							$this->session->set_flashdata('success', 'Review status disabled successfully.');
							redirect('review', 'refresh');
					}
				else
					{
						$this->session->set_flashdata('error', 'There is error in updating Review status. Try later!');
						redirect('review', 'refresh');
					}
			}
		else
			{
				redirect('review', 'refresh');
			}
 		}}
	
	//Function For Change Status to "Enable"
	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
				if( $this->reviews->enable_review_byid($id) )
				{
					$this->session->set_flashdata('success', 'Review status enabled successfully.');
					redirect('review', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating Review status. Try later!');
					redirect('review', 'refresh');
				}
			}
			else
			{
				redirect('review', 'refresh');
			}
	  }
	}
	
	//Function For Change Status to "Disable"
	public function comdisable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
					$comment=$this->reviews->get_comment_byid($id);
					if(count($comment)>0){
					if( $this->reviews->disable_comment_byid($id) )
					{
							$this->session->set_flashdata('success', 'Comment status disabled successfully.');
							redirect('review/viewcomments/'.$comment[0]['reviewid'], 'refresh');
					}
				else
					{
						$this->session->set_flashdata('error', 'There is error in updating Comment status. Try later!');
						redirect('review', 'refresh');
					}
					}
					else
					{
						redirect('review', 'refresh');	
					}
			}
		else
			{
				redirect('review', 'refresh');
			}
 		}}
	
	//Function For Change Status to "Enable"
	public function comenable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
					$comment=$this->reviews->get_comment_byid($id);
					if(count($comment)>0){
			
				if( $this->reviews->enable_comment_byid($id) )
				{
					$this->session->set_flashdata('success', 'Comment status enabled successfully.');
					redirect('review/viewcomments/'.$comment[0]['reviewid'], 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating Comment status. Try later!');
					redirect('review', 'refresh');
				}
				}
				else
				{
					redirect('review', 'refresh');
				}
			}
			else
			{
				redirect('review', 'refresh');
			}
	  }
	}
	
	public function viewcomments($id='')
	{
		if($id!='' && $id!=0)
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$this->load->library('pagination');
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			
			//Addingg Setting Result to variable
			$this->data['comments'] = $this->reviews->get_all_comments($id,$limit,$offset);
			/*echo "<pre>";
			print_r($this->data['comments']);
			die();*/
			
			$this->paging['base_url'] = site_url("review/viewcomments/".$id.'/index');
			$this->paging['uri_segment'] = 5;
			$this->paging['total_rows'] = count($this->reviews->get_all_comments($id));
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('review',$this->data);
	  	}
		}
		else
		{
			redirect('review','refresh');
		}
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->data['keyword']='';
			$this->load->view('review',$this->data);
		}
	}
	
	public function searchreview()
	{
		if( $this->session->userdata['youg_admin'] )
 		{
			$keyword=$this->input->post('keysearch');
					
			if(!$this->uri->segment(3))
			{
				$keyword=trim($this->input->post('keysearch'));
			}
			else
			{
				$searchuri = $this->uri->segment(3);
				$uri= base64_decode($searchuri);
				$uri= explode('/',$uri);
				$keyword=$uri[0];
			}
			
			$this->data['keyword']=$keyword;
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			
			//Addingg Setting Result to variable
			$this->data['reviews'] = $this->reviews->search_review($keyword,$limit,$offset);
			
			//echo "<pre>";
			//print_r($this->data['reviews']);
			//die();
			//$uri=	$keyword;
			//echo $uri;
			$uri= base64_encode($keyword);
			$this->paging['base_url'] = site_url("review/searchreview/".$uri);
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = $this->reviews->search_review_count($keyword);
			$this->pagination->initialize($this->paging);
			
			$this->load->view('review',$this->data);
			
			}
			else
			{
				redirect('adminlogin','refresh');
			}
		}
	
	
	public function searchresult($keyword='')
	{/*
		$keyword = str_replace('_',' ', $keyword);
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
		
		$this->data['reviews'] = $this->reviews->search_review($keyword,$limit,$offset);
		//echo "<pre>";
		//print_r($this->data['reviews']);
		//die();
		
		$this->paging['base_url'] = site_url("review/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->reviews->search_review($keyword));
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		
		$this->load->view('review',$this->data);
	*/}
	
	function foo()
	{
		if($this->input->post('checktype'))
		{
			$type = $this->input->post('checktype');
			$foo = $this->input->post('foo');
			
			if($this->reviews->multiple_function($type,$foo))
			{
				if($type='Delete')
				{
				$this->session->set_flashdata('success', 'Reviews Deleted successfully.');
				}
				if($type='Disable')
				{
				$this->session->set_flashdata('success', 'Reviews Disabled successfully.');
				}
				if($type='Enable')
				{
				$this->session->set_flashdata('success', 'Reviews Enabled successfully.');
				}
				redirect('review','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating. Try later!');
				redirect('review','refresh');
			}
		}
		
	}
	
	public function csv($keyword)
    {
        if( $this->session->userdata['youg_admin'] )
        {
				if($keyword!='') 
				{
					$file = 'Report-of-search-reviews.csv';					
					$review = $this->reviews->search_review($keyword);
				}
				else
				{
					$file = 'Report-of-all-reviews.csv';
					$review = $this->reviews->get_all_reviews();
				}
				ob_start();
				echo "Review,Review to,Review by,IP,Date Reviewed,Status"."\n";
				
				   for($i=0;$i<count($review);$i++) { 
					
						echo stripslashes(ucwords($review[$i]['comment'])).',';
						echo stripslashes(ucwords($review[$i]['company'])).',';
						echo ucfirst($reviews[$i]['firstname'].' '.$reviews[$i]['lastname']).',';
						echo stripslashes(ucwords($review[$i]['reviewip'])).',';
						echo stripslashes($review[$i]['reviewdate']).',';
						echo stripslashes(ucwords($review[$i]['status'])); 
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
    
    public function removed()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
		$this->data['reviewsremoved'] = $this->reviews->removed_review();
		$this->load->view('review',$this->data);
		}
	}
	
	public function removeview($id,$companyid,$userid)
	{
		if( $this->input->is_ajax_request() )
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
					$this->data['reviewremove'] = $this->reviews->get_review_byid($id);
					$this->data['review_date'] = $this->reviews->select_review_date($companyid, $userid, $id);
					
					if( count($this->data['reviewremove'])>0 )
					{		
						$this->load->view('review',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('review', 'refresh');
					}
			
	  		}
			}
		else
		{
			redirect('review','refresh');
		}
	}
	public function printhistory($reviewid,$companyid)
	{
		$this->data['review'] = $this->reviews->review_mail($reviewid, $companyid);
		$this->data['review_status'] = $this->reviews->reviews_status($reviewid, $companyid);
		$review_id = $this->reviews->get_review_bysingleid($reviewid);
		$this->data['review_date'] = $this->reviews->select_review_date($companyid, $review_id['reviewby'], $reviewid);
		$this->load->view('review', $this->data);
	}
	
    
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
