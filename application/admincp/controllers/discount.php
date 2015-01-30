<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Discount extends CI_Controller {

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
	* @see http://codeigniter.com/category_guide/general/urls.html
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
	  	$this->load->model('discounts');
		
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Setting Page Title and Comman Variable
		$this->data['site_name'] = $this->settings->get_setting_value(1);
		$this->data['site_url'] = $this->settings->get_setting_value(2);
		
		if(  $this->uri->segment(2) && ( $this->uri->segment(2)=='searchresult' || $this->uri->segment(2)=='search' ))
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Search Discount';
			$this->data['section_title'] = 'Search';
		}
		else
		{
			$this->data['title'] = $this->settings->get_setting_value(1).' : Discount';
			$this->data['section_title'] = 'Discount';
		}
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
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
			
			//Addingg Setting Result to variable
			$this->data['discounts'] = $this->discounts->get_all_discounts($limit,$offset);
			/*echo "<pre>";
			print_r($this->data['discounts']);
			die();*/
			
			$this->paging['base_url'] = site_url("discount/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->discounts->get_all_discounts());
			$this->pagination->initialize($this->paging);
			//echo "<pre>";
			//print_r($this->paging);
			//die();
			
			//Loading View File
			$this->load->view('discount',$this->data);
	  	}
	}
	
	public function add()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('discount',$this->data);
	  	}
	}
	
	public function edit($id='')
	{
		if( $this->session->userdata['youg_admin'] )
	  	{
			if(!$id)
			{
				redirect('discount', 'refresh');
			}
			
			//Getting detail for displaying in form
			$this->data['discount'] = $this->discounts->get_discount_byid($id);

			if( count($this->data['discount'])>0 )
			{
				//Loading View File
				$this->load->view('discount',$this->data);
			}
			else
			{
				$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
				redirect('discount', 'refresh');
			}
	  }
	}
	
	//Updating the Record
	public function update()
	{
		
		if($this->session->userdata['youg_admin'] )
	  	{
			$elitemembershipprice=$this->settings->update_get_eliteprice_by_settingid(19);
			//If Old Record Update
			if( $this->input->post('id') )
	  		{
				if($_POST['percentage']=='101' || $_POST['percentage']=='102')
				{
							if($_POST['percentage']=='101'){							
								$discounttype="30days-FT";
								$discountprice=$elitemembershipprice['value'];
							  } else {
									$lowprice=$elitemembershipprice['value']-99;	 
									$discounttype="30days-FT+LP";	
									$discountprice=$lowprice;	
							 }		
				   } else {
						$discounttype="Normal";
						$discountprice=$elitemembershipprice['value'];
				 
			   }
				//die();
				//Getting id
				$id = $this->encrypt->decode($this->input->post('id'));
				
				//Getting value
				$title = addslashes($this->input->post('title'));
				$percentage = addslashes($this->input->post('percentage'));
						
				//Updating Record With Image
				if( $this->discounts->update($id,$title,$percentage,$discounttype,$discountprice))
				{
					$this->session->set_flashdata('success', 'discount updated successfully.');
					redirect('discount', 'refresh');;
				}
				else
				{

					$this->session->set_flashdata('error', 'There is error in updating discount. Try later!');
					redirect('discount', 'refresh');
				}
			}
			
			//If New Record Insert
			else
			{
			   	  
			  if($_POST['percentage']=='101' || $_POST['percentage']=='102')
			   {
						if($_POST['percentage']=='101'){
							
							$discounttype="30days-FT";  
							$discountprice=$elitemembershipprice['value'];  
							} else {
							
							$lowprice=$elitemembershipprice['value']-99;	 
							$discounttype="30days-FT+LP";	
							$discountprice=$lowprice;	
						}		
			   } else {
				 	$discounttype="Normal";
				 	$discountprice=$elitemembershipprice['value'];
			   }
	    		//Getting value
				$title = addslashes($this->input->post('title'));
				$percentage = addslashes($this->input->post('percentage'));
				
				
				//Inserting Record
					if( $this->discounts->insert($title,$percentage,$discounttype,$discountprice))
					{
						$this->session->set_flashdata('success', 'discount inserted successfully.');
						redirect('discount', 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in inserting discount. Try later!');
						redirect('discount', 'refresh');
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
				redirect('discount', 'refresh');
			}
			
			//Deleting Record
			if( $this->discounts->delete_discount_byid($id) )
			{
				$this->session->set_flashdata('success', 'discount deleted successfully.');
				redirect('discount', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in deleting discount. Try later!');
				redirect('discount', 'refresh');
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
				redirect('discount', 'refresh');
			}
			
			if( $this->discounts->disable_discount_byid($id) )
			{
				$this->session->set_flashdata('success', 'discount status disabled successfully.');
				redirect('discount', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating discount status. Try later!');
				redirect('discount', 'refresh');
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
				redirect('discount', 'refresh');
			}
			
			if( $this->discounts->enable_discount_byid($id) )
			{
				$this->session->set_flashdata('success', 'discount status enabled successfully.');
				redirect('discount', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'There is error in updating discount status. Try later!');
				redirect('discount', 'refresh');
			}
	  }
	}
	
	public function search()
	{
		if( $this->session->userdata['youg_admin'] )
	  	{			
			//Loading View File
			$this->load->view('discount',$this->data);
	  	}
	}
	
	public function searchdiscount()
	{
		if($this->input->post('btnsearch')|| $this->input->post('keysearch'))
		{
			$keyword = addslashes($this->input->post('keysearch'));
			$keyword = htmlspecialchars(str_replace('%20', ' ', $keyword));
			$keyword = preg_replace('/[^a-zA-Z0-9\']/', '',$keyword);
			$keyword = str_replace(' ','-', $keyword);
		
			redirect('discount/searchresult/'.$keyword,'refresh');	
		}
		else
		{
			redirect('discount','refresh');
		}
	}
	
	public function searchresult($keyword='')
	{
		$keyword = str_replace('-',' ', $keyword);
					
		$limit = $this->paging['per_page'];
		$offset = ($this->uri->segment(5) != '') ? $this->uri->segment(5) : 0;
			
		//Addingg Setting Result to variable
		$this->data['discounts'] = $this->discounts->search_discount($keyword,$limit,$offset);
		
		$this->paging['base_url'] = site_url("discount/searchresult/".$keyword."/index");
		$this->paging['uri_segment'] = 5;
		$this->paging['total_rows'] = count($this->discounts->search_discount($keyword));
		$this->pagination->initialize($this->paging);
		//echo "<pre>";
		//print_r($this->paging);
		//die();
		$this->load->view('discount',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
