<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Page extends CI_Controller {
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		if( $this->session->userdata('youg_admin'))
	  	{
	      	if(!array_key_exists('type',$this->session->userdata['youg_admin']))
			{
				$a = site_url();
				$p = explode('/admincp',$a);
				redirect($p[0].'/businessadmin', 'refresh');
			}
		}
		else
		{
			redirect('adminlogin', 'refresh');
		}
		
	 	$this->load->model('pages');
		
		$this->data['title'] = $this->settings->get_setting_value(1).' : Pages';
		$this->data['section_title'] = 'Pages';
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
		
		$this->data['heading'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			$siteid = $this->session->userdata('siteid');
			$this->data['pages'] = $this->pages->get_all_pages($siteid);
						
			$this->load->view('page',$this->data);
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
				redirect('page', 'refresh');
			}
				
			$this->data['page'] = $this->pages->get_page_byid($id);

			if( count($this->data['page'])>0 )
			{
				$this->load->view('page',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('page', 'refresh');
			}
	  	}
		}
		else
		{
				redirect('page', 'refresh');
		}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('page', 'refresh');
			}
					
			$this->data['page'] = $this->pages->get_page_byid($id);

			if( count($this->data['page'])>0 )
			{			
				$this->load->view('page',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('page', 'refresh');
			}
	  }
	}
	
	public function update()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if( $this->input->post('txtintid') )
	  		{
				$intid = $this->encrypt->decode($this->input->post('txtintid'));
				
				$vartitle = addslashes($this->input->post('title'));
				$varheading = addslashes($this->input->post('heading'));
				$varmetakey = addslashes($this->input->post('metakeywords'));
				$varmetades = addslashes($this->input->post('metadescription'));
				$varpagecont = addslashes($this->input->post('pagecontent'));
				$footercategory = addslashes($this->input->post('footercategory'));
				$footerposition = addslashes($this->input->post('footerposition'));
				
				
				
				if( $varpagecont!='' )
				{			
					if($this->pages->get_page_bycategory($footercategory, $footerposition))
					{
						$this->session->set_flashdata('error', 'Position in that category is already taken!');
						redirect('page', 'refresh');
					}	
					else
					{
						if( $this->pages->update($intid,$vartitle,$varheading,$varmetakey,$varmetades,$varpagecont,$footercategory,$footerposition) )
						{
							$this->session->set_flashdata('success', 'Page details updated successfully.');
							redirect('page', 'refresh');
						}
						else
						{
							$this->session->set_flashdata('error', 'There is error in updating Page details. Try later!');
							redirect('page', 'refresh');
						}
					}
				}
				else
				{
					$this->session->set_flashdata('error', 'Page Content field is required.');
					redirect('page', 'refresh');
				}
			}
		}
	}

	public function disable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  	{
			if(!$id)
			{
				redirect('page', 'refresh');
			}
				
			if( $this->pages->disable_page_byid($id) )
			{
				$this->session->set_flashdata('success', 'Page status disabled successfully.');
				redirect('page', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Page status. Try later!');
				redirect('page', 'refresh');
			}
	  }
	}

	public function enable($id='')
	{
		if($this->session->userdata['youg_admin'])
	  {
			if(!$id)
			{
				redirect('page', 'refresh');
			}
			
			if( $this->pages->enable_page_byid($id) )
			{
				$this->session->set_flashdata('success', 'Page status enabled successfully.');
				redirect('page', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating Page status. Try later!');
				redirect('page', 'refresh');
			}
	  }
	}

	public function searchpage()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('page/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('page','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
		$siteid = $this->session->userdata('siteid');	
		$this->data['pages'] = $this->pages->search_page($keyword,$siteid);
		$this->load->view('page',$this->data);
	}
	
	public function add()
	{
		
		$request = $this->input;
				
		if($request->post('btnupdate'))
		{
			
			
				$data = array(	
				'id' => $request->post('footercategory'),
				'websiteid' => '1',
				'title' => $request->post('title'),
				'heading' => $request->post('heading'),
				'metakeywords' => $request->post('metakeywords'),
				'metadescription' => $request->post('metadescription'),
				'pagecontent' => $request->post('pagecontent'),
				'position' => $request->post('footerposition'),
				'deviceip' => $_SERVER['REMOTE_ADDR'],
				'editdate' => date('Y-m-d H:i:s'),
				'status' => 'Enable'		
				);
				$this->pages->pageadd($data);
				redirect('page', 'refresh');
			
		}
		$this->load->view('page', $this->data);
	}
	
	
	
}
