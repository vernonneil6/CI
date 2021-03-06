<?php ob_start();?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pressrelease extends CI_Controller {

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
	* @see http://codeigniter.com/pressrelease_guide/general/urls.html
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
	  	$this->load->model('pressreleases');
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Press Releases';
		$this->data['section_title'] = 'Press Releases';
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
	
	/*public function index($sortby,$orderby='asc')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$companyid = $this->session->userdata['youg_admin']['id'];
			$siteid = $this->session->userdata['siteid'];
			$limit = $this->paging['per_page'];
			
			/*if($sortby=='sitename')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("pressrelease/index/sitename");
				$orderby = 'asc';
				$url = 4;
				
			}
			else if($sortby=='subtitle')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("pressrelease/index/subtitle");
				$orderby = 'asc';
				$url = 4;
			}
			else if($sortby=='title')
			{
				$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
				$base = site_url("pressrelease/index/date");
				$orderby = 'asc';
				$url = 4;
			}
			else
			{
				$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
				$base = site_url("pressrelease/index");
				$orderby = 'asc';
				$url = 3;
			}
			
			
			//Addingg Setting Result to variable
			$this->data['pressreleases'] = $this->pressreleases->get_all_pressreleases($companyid,$siteid,$limit,$offset,$sortby,$orderby);
			$this->paging['base_url'] = $base;
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->pressreleases->get_all_pressreleases($companyid,$siteid));
			$this->pagination->initialize($this->paging);
						
			//Loading View File
			$this->load->view('pressrelease',$this->data);
	  	}
	}*/
	
	
	public function index($sort_by = '', $sort_order = '', $offset = 0) {
		
		if( !$this->session->userdata('youg_admin'))
	  	{
	  	  	redirect('adminlogin', 'refresh');
		}
		
		if( $this->session->userdata['youg_admin'] )
	  	{
			$limit = 15;
			$this->data['fields'] = array(
				'site' => 'Site Name',
				'title' => 'Title',
				'subtitle' => 'Sub Title',
				'release' => 'Release Date',				
				'status' => 'Status'
			);
			
			$this->load->model('pressreleases');
			
			if($this->input->get('s')){				
				$decodeKeyword = urldecode($this->input->get('s'));
			}
			
			$companyid = $this->session->userdata['youg_admin']['id'];
			
			$siteid = $this->session->userdata['siteid'];
			
			if(empty($sort_by) || empty($sort_order)){
				$offset = $sort_by;
			}
			
			$results = $this->pressreleases->pressSearch($decodeKeyword, $companyid, $siteid, $limit, $offset, $sort_by, $sort_order);
			
			$this->data['pressreleases'] = $results['rows'];
			$this->data['num_results'] = $results['num_rows'];
			//echo $this->data['num_results'];die;
			
			// pagination				
			if(!empty($sort_by) && !empty($sort_order)){
				$siteURL = site_url("pressrelease/index/$sort_by/$sort_order");
				$uriSegment = 5;
			}
			else{
				$siteURL = site_url("pressrelease/index");
				$uriSegment = 3;
			}
			
			$this->paging['base_url'] = $siteURL;
			
			$this->paging['total_rows'] = $this->data['num_results'];
			$this->paging['per_page'] = $limit;
			$this->paging['uri_segment'] = 5;
			
			if(!empty($_GET)){
				$this->paging['suffix'] = '?'.http_build_query($_GET, '', "&");
				$this->paging['first_url'] = $this->paging['base_url'] . $this->paging['suffix'];
			}
						
			$this->pagination->initialize($this->paging);									
			
			$this->data['sort_by'] = $sort_by;
			$this->data['sort_order'] = $sort_order;
			
			$this->load->view('pressrelease', $this->data);
			
		}
	}
	
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			$this->load->helper('ckeditor');
				$this->data['ckeditor'] = array(
				//ID of the textarea that will be replaced
            	'id'	=>	'presscontent',
            	'path'  =>  '../../ckeditor',
				//Optionnal values
				'config' => array(
									'toolbar'	=>	"Full",     //Using the Full toolbar
									'width'   =>  "auto",    //a custom width
									'height'  =>  "300px",    //a custom height
									'filebrowserImageBrowseUrl' => '',
									'filebrowserBrowseUrl' => '',
									'filebrowserFlashBrowseUrl' => '',
									'filebrowserBrowseUrl'      => '../../ckeditor/ckfinder/ckfinder.html',
									'filebrowserImageBrowseUrl' => '../../ckeditor/ckfinder/ckfinder.html?Type=Images',
									'filebrowserFlashBrowseUrl' => '../../ckeditor/ckfinder/ckfinder.html?Type=Flash',
									'filebrowserUploadUrl'      => '../../ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
									'filebrowserImageUploadUrl' => '../../ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
									'filebrowserFlashUploadUrl' => '../../ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
									
								),
						);
			//Loading View File
			$this->load->view('pressrelease',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('pressrelease', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['pressrelease'] = $this->pressreleases->get_pressrelease_byid($id);

			if( count($this->data['pressrelease'])>0 )
			{
				$this->load->helper('ckeditor');
				$this->data['ckeditor'] = array(
				//ID of the textarea that will be replaced
            	'id'	=>	'presscontent',
            	'path'  =>  '../../ckeditor',
				//Optionnal values
				'config' => array(
									'toolbar'	=>	"Full",     //Using the Full toolbar
									'width'   =>  "auto",    //a custom width
									'height'  =>  "300px",    //a custom height
									'filebrowserImageBrowseUrl' => '',
									'filebrowserBrowseUrl' => '',
									'filebrowserFlashBrowseUrl' => '',
									'filebrowserBrowseUrl'      => '../../ckeditor/ckfinder/ckfinder.html',
									'filebrowserImageBrowseUrl' => '../../ckeditor/ckfinder/ckfinder.html?Type=Images',
									'filebrowserFlashBrowseUrl' => '../../ckeditor/ckfinder/ckfinder.html?Type=Flash',
									'filebrowserUploadUrl'      => '../../ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
									'filebrowserImageUploadUrl' => '../../ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
									'filebrowserFlashUploadUrl' => '../../ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
									
								),
						);
						
				//Loading View File
				$this->load->view('pressrelease',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('pressrelease', 'refresh');
			}
	  }
	}
	
	//Updating the Record
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			
			if( $this->input->post('btnsubmit') || $this->input->post('addpress')=='addpress')
			{
					$title = addslashes($this->input->post('title'));
					$subtitle = addslashes($this->input->post('subtitle'));
					$sortdesc = addslashes($this->input->post('sortdesc'));
					$metakeywords = addslashes($this->input->post('metakeywords'));
					$metadescription = addslashes($this->input->post('metadescription'));
					$presscontent = $this->input->post('presscontent');
						$rawcontent = addslashes($this->input->post('presscontent'));
					$rawcontent = strtolower($rawcontent);
					$rawcontent = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($rawcontent));
					//make alphaunermic
					$rawcontent = preg_replace("/&#?[a-z0-9]+;/i", "", $rawcontent);
					//Clean multiple dashes or whitespaces
					$rawcontent = preg_replace("/[\s-]+/", "", $rawcontent);
					//Convert whitespaces to dash
					$rawcontent = preg_replace("/[\s]/", "", $rawcontent);
					$rawcontent = preg_replace("/[';:,.()!]/", "", $rawcontent);
					$rawcontent = preg_replace('/["]/', "", $rawcontent);
					$rawcontent =trim(html_entity_decode($rawcontent));
					
					$companyid = $this->session->userdata['youg_admin']['id'];
					$siteid = $this->input->post('siteid');
					$inputs=$this->input->post();
			
					if( $presscontent!='')
						{
							/*$check_status = $this->pressreleases->check_pressrelease($companyid,$title,$subtitle,$sortdesc,$metakeywords,$metadescription,$presscontent,$siteid);
							if($check_status == 'fail'){
								$this->session->set_flashdata('error', 'The same pressrelease content cannot be posted to more than one site!');
								redirect('pressrelease/add', 'refresh');
							}*/
							$field='rawcontent';
							$id='0';
							$result = $this->pressreleases->presschkfield($id,$field,$rawcontent);	
						if($result!='old')				
						{
							//Inserting Record
							if( $this->pressreleases->insert($companyid,$title,$subtitle,$sortdesc,$metakeywords,$metadescription,$presscontent,$rawcontent,$siteid))
									{
										$intid = $this->db->insert_id();
										$title = strtolower($title);
										//make alphaunermic
										$title = preg_replace("/[^a-z0-9\s-]/", "", $title);
										//Clean multiple dashes or whitespaces
										$title = preg_replace("/[\s-]+/", " ", $title);
										//Convert whitespaces to dash
										$title = preg_replace("/[\s]/", "-", $title);
										$company = $this->pressreleases->get_company_byid($companyid);
										if(count($company)>0)
										{
											$companyname = $company[0]['company'];
											$companyname = strtolower($companyname);
											//make alphaunermic
											$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
											//Clean multiple dashes or whitespaces
											$companyname = preg_replace("/[\s-]+/", " ", $companyname);
											//Convert whitespaces to dash
											$companyname = preg_replace("/[\s]/", "-", $companyname);
											$seokeyword = $title.'-'.$companyname.'-'.$intid;
										}
										else
										{
											$seokeyword = $title.'-'.$intid;	
										}
										
										$this->pressreleases->update_seokeyword($intid,$seokeyword);
										
										$this->session->set_flashdata('success', 'Press Release inserted successfully.');
										redirect('pressrelease', 'refresh');
									}
									else
									{
					
										$this->session->set_flashdata('error', 'There is error in inserting Press Release. Try later!');
										redirect('pressrelease/add', 'refresh');
									}
									
								}else
								{
									$this->session->set_flashdata('error', 'The same pressrelease content cannot be posted to more than one site!');
									redirect('pressrelease/add', 'refresh');
								}
								}
								else
								{
									//Error in upload
									$this->session->set_flashdata('error', "Presscontent should not be empty");
									redirect('pressrelease/add','refresh');
								}
								
						}
						
			//If Old Record Update
			else if( $this->input->post('id') )
	  		{
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				$title = addslashes($this->input->post('title'));
				$subtitle = addslashes($this->input->post('subtitle'));
				$sortdesc = addslashes($this->input->post('sortdesc'));
				$metakeywords = addslashes($this->input->post('metakeywords'));
				$metadescription = addslashes($this->input->post('metadescription'));
				$presscontent = addslashes($this->input->post('presscontent'));
					$rawcontent = addslashes($this->input->post('presscontent'));
					$rawcontent = strtolower($rawcontent);
					$rawcontent = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($rawcontent));
					//make alphaunermic
					$rawcontent = preg_replace("/&#?[a-z0-9]+;/i", "", $rawcontent);
					//Clean multiple dashes or whitespaces
					$rawcontent = preg_replace("/[\s-]+/", "", $rawcontent);
					//Convert whitespaces to dash
					$rawcontent = preg_replace("/[\s]/", "", $rawcontent);
					$rawcontent = preg_replace("/[';:,.()!]/", "", $rawcontent);
					$rawcontent = preg_replace('/["]/', "", $rawcontent);
					$rawcontent =trim(html_entity_decode($rawcontent));
					
					
				$siteid = addslashes($this->input->post('siteid'));
				$companyid = $this->session->userdata['youg_admin']['id'];
				
				if( $presscontent !='')
						{
				
										$title = strtolower($title);
										//make alphaunermic
										$title = preg_replace("/[^a-z0-9\s-]/", "", $title);
										//Clean multiple dashes or whitespaces
										$title = preg_replace("/[\s-]+/", " ", $title);
										//Convert whitespaces to dash
										$title = preg_replace("/[\s]/", "-", $title);
										
										$company = $this->pressreleases->get_company_byid($companyid);
										if(count($company)>0)
										{
											$companyname = $company[0]['company'];
											$companyname = strtolower($companyname);
											//make alphaunermic
											$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
											//Clean multiple dashes or whitespaces
											$companyname = preg_replace("/[\s-]+/", " ", $companyname);
											//Convert whitespaces to dash
											$companyname = preg_replace("/[\s]/", "-", $companyname);
											$seokeyword = $title.'-'.$companyname.'-'.$id;
										}
										else
										{
											$seokeyword = $title.'-'.$id;	
										}
									
			$field='rawcontent';
			$result = $this->pressreleases->presschkfield($id,$field,$rawcontent);	
			if($result!='old')				
			{				
				//Updating Record 
				if( $this->pressreleases->update($id,$companyid,$title,$subtitle,$sortdesc,$metakeywords,$metadescription,$presscontent,$rawcontent,$seokeyword,$siteid))
				{
					$this->session->set_flashdata('success', 'Press Release updated successfully.');
					redirect('pressrelease', 'refresh');
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating  pressrelease. Try later!');
					redirect('pressrelease', 'refresh');
				}
			}
			else
			{
					$this->session->set_flashdata('error', 'The same pressrelease content cannot be posted to more than one site!');
					redirect('pressrelease/edit/'.$id, 'refresh');
				
			}
			}
				else
						{
							//Error in upload
							$this->session->set_flashdata('error', "Presscontent should not be empty");
							redirect('pressrelease/edit/'.$id,'refresh');
						}
			
		}
		}
	}
	
	//Function For Deleting Record
	public function delete($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('pressrelease', 'refresh');
			}
			
			//Deleting Record
			if( $this->pressreleases->delete_pressrelease_byid($id) )
			{
				$this->session->set_flashdata('success', 'Press Release deleted successfully.');
				redirect('pressrelease', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting  Press Release. Try later!');
				redirect('pressrelease', 'refresh');
			}
	  	}
	}
	
	//Function For Change Status to "Disable"
	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('pressrelease', 'refresh');
			}
				
			if( $this->pressreleases->disable_pressrelease_byid($id) )
			{
				$this->session->set_flashdata('success', 'Press Release status disabled successfully.');
				redirect('pressrelease', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Press Release status. Try later!');
				redirect('pressrelease', 'refresh');
			}
	  }
	}
	
	//Function For Change Status to "Enable"
	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if(!$id)
			{
				redirect('pressrelease', 'refresh');
			}
			
			if( $this->pressreleases->enable_pressrelease_byid($id) )
			{
				$this->session->set_flashdata('success', 'Press Release status enabled successfully.');
				redirect('pressrelease', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Press Release status. Try later!');
				redirect('pressrelease', 'refresh');
			}
	  }
	}
	public function view($id='')
	{
		if( $this->input->is_ajax_request() )
		{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('pressrelease', 'refresh');
			}
			//Loading Model File
	  		
			//Getting detail for displaying in form
			$this->data['pressrelease'] = $this->pressreleases->get_pressrelease_byid($id);
			/*echo "<pre>";
			print_r($this->data['pressrelease']);
			die();*/
			if( count($this->data['pressrelease'])>0 )
			{
				//Loading View File
				$this->load->view('pressrelease',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('pressrelease', 'refresh');
			}
	  	}
		}
		else
		{
				redirect('pressrelease', 'refresh');
		}
	
	}
	
	public function pressfieldcheck()
	{
		
		//$inputs=$this->input->post();
		//print_r($inputs);
		//console.log($inputs);
		//die();
		if($this->session->userdata['youg_admin'] && $this->input->is_ajax_request() &&  $this->input->post('rawcontent') )
		{
			
			if( $this->input->post('id') )
			{
				$id = $this->input->post('id');
			}
			else
			{
				$id = 0;
			}
			
			if( $this->input->post('rawcontent') )
			{
				$field = 'rawcontent';
				$fieldvalue = $this->input->post('rawcontent');
					
			}
			
			if($field)
			{
				//Loading Model File
	  			$this->load->model('pressreleases');
	  			die();
				//Addingg Result to view parameter
				$result = $this->pressreleases->presschkfield($id,$field,$fieldvalue);
		
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			//redirect('pressrelease', 'refresh');
		}
	}
	
	
	public function fieldcheck()
	{
		
		if($this->session->userdata['youg_admin'] && $this->input->is_ajax_request() && ( $this->input->post('title') || $this->input->post('presscontent') || $this->input->post('subtitle')  ) )
		{
			$inputs=$this->input->post();
		//print_r($inputs);
		//console.log($inputs);
		//die();
			if( $this->input->post('id') )
			{
				$id = $this->input->post('id');
			}
			else
			{
				$id = 0;
			}
			if( $this->input->post('title') )
			{
				$field = 'title';
				$fieldvalue = addslashes($this->input->post('title'));
			}
			if( $this->input->post('subtitle') )
			{
				$field = 'subtitle';
				$fieldvalue = addslashes($this->input->post('subtitle'));
			}
			if( $this->input->post('presscontent') )
			{
				$field = 'rawcontent';
				$fieldvalue = addslashes($this->input->post('presscontent'));
					
			}
			
			if($field)
			{
				//Loading Model File
	  			$this->load->model('pressreleases');
				//Addingg Result to view parameter
				$result = $this->pressreleases->chkfield($id,$field,$fieldvalue);
				echo json_encode( array('result' => $result ) );
			}
		}
		else
		{
			redirect('pressrelease', 'refresh');
		}
	}
	
	function searchpressrelease()
	{
		if($this->input->post('btnsearch'))
		{
			
			$keyword = urlencode($this->input->post('keysearch'));				
			redirect('pressrelease/index/?s='.$keyword);							
		}
		else
		{
			redirect('pressrelease','refresh');
		}
	}
	
	function searchresult($keyword)
	{
		$companyid = $this->session->userdata['youg_admin']['id'];
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;

		$this->data['pressreleases'] = $this->pressreleases->searchpr($keyword,$companyid,$limit,$offset);
		$this->paging['base_url'] = site_url("pressrelease/searchresult/".$keyword);
		$this->paging['uri_segment'] = 3;
		$this->paging['total_rows'] = count($this->pressreleases->searchpr($keyword,$companyid));
		$this->pagination->initialize($this->paging);

		$this->load->view('pressrelease',$this->data);
	}
	
	public function export_csv($keyword)
    {		
        if( $this->session->userdata['youg_admin'] )
        {				
				$companyid = $this->session->userdata['youg_admin']['id'];
				
				$siteid = $this->session->userdata['siteid'];
				
				if($keyword!='') 
				{					
					$searchKey = urldecode($keyword);
					$file = 'Report-of-search-pressreleases.csv';					
					$press_results = $this->pressreleases->pressSearch($searchKey, $companyid, $siteid);
					
				}
				else
				{					
					$file = 'Report-of-all-pressreleases.csv';
					$press_results = $this->pressreleases->pressSearch($searchKey,$companyid,$siteid);
				}
				
				ob_start();
				echo "Site Name,Title,Sub Title,Release Date,Status"."\n";
				
				//print_r($review);die;
				
				foreach($press_results as $press_result): 
					foreach($press_result as $press): 	
					
						echo "\"".str_replace('"',"'",$press->site)."\",";											
						echo "\"".str_replace('"',"'",$press->title)."\",";
						echo "\"".str_replace('"',"'",$press->subtitle)."\",";											
						echo date('m-d-Y', strtotime($press->insertdate)).",";						
						echo $press->status;
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
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
