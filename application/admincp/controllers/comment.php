<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Comment extends CI_Controller {

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
		// Your own constructor code
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
  		$this->load->model('comments');		
		$this->load->model('reviews');		
		$this->load->model('users');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['title'] = $this->settings->get_setting_value(1).' : Comments on Reviews';
		$this->data['section_title'] = 'Comments on Reviews';
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
	
	public function index($sort_by = 'commentby', $sort_order = 'asc', $offset = 0) {
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			$this->data['fields'] = array(
				'id' => 'Comment ID',
				'comment' => 'Title',
				'commentby' => 'Submitted By',								
				'commentdate' => 'Date',
				'status' => 'Status'
			);
			
			$this->load->model('comments');
			
			$results = $this->comments->commentsSearch($limit, $offset, $sort_by, $sort_order);
			
			$this->data['comments'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			//echo $this->data['num_results'];die;
			
			// pagination				
			$this->paging['base_url'] = site_url("comment/index/$sort_by/$sort_order");
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;
			$this->paging['uri_segment'] = 5;
			$this->pagination->initialize($this->paging);									
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('comment', $this->data);
		}
	}
	
	
	public function view($id='')
	{
		if( $this->input->is_ajax_request() )
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
				if($id!='' && $id!=0) 
				{
					//Getting detail for displaying in form
					$this->data['comment'] = $this->comments->get_comment_byid($id);
					/*echo "<pre>";
					print_r($this->data['comment']);
					die();*/
					if( count($this->data['comment'])>0 )
					{		
						//Loading View File
						$this->load->view('comment',$this->data);
					}
					else
					{
						$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
						redirect('comment', 'refresh');
					}
			}
					else
					{
							redirect('comment', 'refresh');
					}
	  		}
			}
		else
		{
			redirect('comment','refresh');
		}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
					if( $this->comments->disable_comment_byid($id) )
					{
							$this->session->set_flashdata('success', 'Comment status disabled successfully.');
							redirect('comment', 'refresh');
					}
				else
					{
						$this->session->set_flashdata('error', 'There is error in updating Complaint status. Try later!');
						redirect('comment', 'refresh');
					}
			}
		else
			{
				redirect('comment', 'refresh');
			}
 		}
}
	
	//Function For Change Status to "Enable"
	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if($id!='' && $id!=0)
			{
				if( $this->comments->enable_comment_byid($id) )
				{
					$this->session->set_flashdata('success', 'Comment status enabled successfully.');
					redirect('comment', 'refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'There is error in updating Complaint status. Try later!');
					redirect('comment', 'refresh');
				}
			}
			else
			{
				redirect('comment', 'refresh');
			}
	  }
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('comment',$this->data);
	  	}
	}
	
	public function searchcomment()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = urlencode($this->input->post('keysearch'));				
			//echo $keyword;die;
			redirect('comment/searchresult/?s='.$keyword);
				
		}
		else
		{
			redirect('comment','refresh');
		}
		
		
	}
	
	
	public function searchresult($sort_by = 'commentby', $sort_order = 'asc', $offset = 0) 
	{
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			$this->data['fields'] = array(
				'id' => 'Comment ID',
				'comment' => 'Title',
				'commentby' => 'Submitted By',								
				'commentdate' => 'Date',
				'status' => 'Status'
			);
			
			$this->load->model('comments');
			
			
			if($this->input->get('s')){				
				$decodeKeyword = urldecode($this->input->get('s'));
			}
			//echo $decodeKeyword;die;
			
			$results = $this->comments->commentsSearchResults($decodeKeyword, $limit, $offset, $sort_by, $sort_order);
			
			$this->data['comments'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			//echo $this->data['num_results'];die;
			
			// pagination				
			$this->paging['base_url'] = site_url("comment/searchresult/$sort_by/$sort_order");
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;
			$this->paging['uri_segment'] = 5;
			$this->pagination->initialize($this->paging);									
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('comment', $this->data);
		}
		
	}
	
	public function csv($keyword)
    {
        if( $this->session->userdata['youg_admin'] )
        {
				if($keyword!='') 
				{
					$file = 'Report-of-search-comments.csv';
					$searchKey = urldecode($keyword);
					
					$comments = $this->comments->commentsSearchResults($searchKey);				
				}
				else
				{
					$file = 'Report-of-all-comments.csv';
					$comments = $this->comments->commentsSearchResults();
				}
				ob_start();
				echo "User,Comment date,Comment,Email";
				echo "\n";			    		
				    		
				foreach($comments as $comment1): 
					foreach($comment1 as $comment): 	
														
						echo $comment->firstname.' '.$comment->lastname;
						echo ",";
						echo date('m-d-Y', strtotime($comment->commentdate));
						echo ",";
						echo "\"".$comment->comment."\"";
						echo ",";
						echo $comment->email;
						echo "\n";									
					endforeach;
				endforeach;
							
							
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

	function foo()
	{
		if($this->input->post('checktype'))
		{
			$type = $this->input->post('checktype');
			$foo = $this->input->post('foo');
			
			if($this->comments->multiple_function($type,$foo))
			{
				if($type='Delete')
				{
				$this->session->set_flashdata('success', 'Comments Deleted successfully.');
				}
				if($type='Disable')
				{
				$this->session->set_flashdata('success', 'Comments Disabled successfully.');
				}
				if($type='Enable')
				{
				$this->session->set_flashdata('success', 'Comments Enabled successfully.');
				}
				redirect('comment','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating. Try later!');
				redirect('comment','refresh');
			}
		}
		
	}
	
	
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
