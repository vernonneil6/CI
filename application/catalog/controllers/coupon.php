<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Coupon extends CI_Controller {

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
	* @see http://codeigniter.com/coupon_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		//Loading Model File
	 	$this->load->model('coupons');
		$this->load->model('users');
		
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		 {
		    $site = $regs['domain'];
		 }
		  $website = $this->common->get_site_by_domain_name('yougotrated.writerbin.com');
		 
		 if(count($website)>0)
		 {
		 	$siteid = $website[0]['id'];
		 }
		 $this->session->set_userdata('siteid',$siteid);
		 
		 $siteid = $this->session->userdata('siteid');
		
		$this->data['site_name'] = $this->common->get_sitename_byid($siteid);
		$this->data['site_url'] = $this->common->get_siteurl_byid($siteid);
		$this->data['searchword']='';
		
		$this->data['topads']= $this->common->get_all_ads('top','coupon',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','coupon',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','coupon',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','coupon',$siteid);
		
		
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		if( $this->uri->segment(1) == 'coupon' && ( $this->uri->segment(2) == 'comments' || $this->uri->segment(2) == 'editcomment' ) )
		{
   		$this->data['title'] = 'Comments On Coupons';
		}
		else
		{
			$this->data['title'] = 'Coupons and Deals';
		}
	
		//Loadin Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);

		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$this->data['title'] = 'Coupons';
		
		$this->data['section_title'] = 'Coupons';

		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{
		  $this->load->library('pagination');
		    			
		  $limit = $this->paging['per_page'];
		  $offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
		  
		  //Addingg Setting Result to variable
		  $this->data['coupons'] = $this->coupons->get_all_coupons($limit,$offset);
		  $siteid = $this->session->userdata('siteid');
		  $this->data['keywords'] = $this->coupons->get_all_searchs($siteid);
		  
		  $this->paging['base_url'] = site_url("coupon/index");
		  $this->paging['uri_segment'] = 3;
		  $this->paging['total_rows'] = count($this->coupons->get_all_coupons());
		  $this->pagination->initialize($this->paging);

		//$this->data['userimgs']=$this->coupons->user_image();
          
		  //Loading View File
		  $this->load->view('coupon/index',$this->data);
	}
	
	
	public function browse($word='')
	{
			if( $word!='')
			{
				
		  		$couponseo = $this->coupons->get_coupon_byseokeyword($word);
				if(count($couponseo))
				{
					$this->data['coupons'] = $this->coupons->get_coupon_byid($couponseo[0]['id']);
		  			$this->data['couponcomments'] = $this->coupons->get_comments_bycouponid($couponseo[0]['id']);
			
				if(count($this->data['coupons'])>0)
				{
					//get other coupons same for that company
					
					$this->data['othercoupons'] = $this->coupons->get_coupon_bycompanyid($this->data['coupons'][0]['companyid'],$this->data['coupons'][0]['id']); 
					
					//Loading View File
					$this->load->view('coupon/browse',$this->data);
				}
				else
				{
					redirect('coupon','refresh');
				}
				}
				else
				{
					redirect('coupon','refresh');
				}
			}
				else
				{
					redirect('coupon','refresh');
				}
	}
	
	
	 public function editcomment($id='')
	  {
			if( !array_key_exists('youg_user',$this->session->userdata) )
			{
				redirect('login', 'refresh');
			}
				if($id!='' || $id!=0)
				{
					//Getting detail for displaying in form
					$this->data['couponcommentbyid'] = $this->coupons->get_comment_byid($id);
				
					if( count($this->data['couponcommentbyid'] )>0 )
					{
						$this->data['coupons'] = $this->coupons->get_coupon_byid($this->data['couponcommentbyid'][0]['couponid']);
					  	$this->data['couponcomments'] = $this->coupons->get_comments_bycouponid($this->data['couponcommentbyid'][0]['couponid']);
										
						if( count($this->data['couponcommentbyid'])>0 )
						{			
							//Loading View File
							$this->load->view('coupon',$this->data);
						}
					else
					{
							$this->session->set_flashdata('error', 'Record not found with specified id. Try later!');
							redirect('coupon', 'refresh');
					}
				}
					else
					{
						redirect('coupon','refresh');
					}
				}
				else
				{
						redirect('coupon','refresh');
				}
	}
	
   	public function deletecomment($id='')
	  {
			if( !array_key_exists('youg_user',$this->session->userdata) )
			{
				redirect('login', 'refresh');
			}
			
			if($id!='' || $id!=0)
			{
				//Loading Model File
				$comment = $this->coupons->get_comment_byid($id);
				
				if(count($comment)>0)
				 {
				if(($comment[0]['commentby']==$this->session->userdata['youg_user']['userid']))
				 { 
					if($this->coupons->delete_comment($id))
		  	  {			
						$this->session->set_flashdata('success', 'Comment deleted successfully.');
						$coupon = $this->coupons->get_coupon_byid($comment[0]['couponid']);
						redirect('coupon/browse/'.$coupon[0]['seokeyword'], 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in deleting comment. Try later!');
					redirect('comment', 'refresh');
					}
			}
				else
				{	redirect('comment','refresh');	}
				}
				else
				{
					redirect('comment','refresh');
				}
			}
			else
			{
				redirect('review','refresh');
			}
		}
	
	 //Updating the Record
	 public function upcomment()
	 {
   		if($this->input->post('id')!='') 
				{
						//If Old Record Update
					if( $this->input->post('btncommentupdate') || $this->input->post('comment')!='')
					{
					//Getting id
					$id = $this->encrypt->decode($this->input->post('id'));
					
					$couponid = $this->encrypt->decode($this->input->post('couponid'));
					$coupon123 = $this->coupons->get_coupon_byid($couponid); 
					//Getting value
					$comment = addslashes(strip_tags($this->input->post('comment')));
						
					//Updating Record With Image
					$updated = $this->coupons->update_comment($id,$comment);

					if( $updated == 'updated')
					{
						$this->session->set_flashdata('success', 'comment updated successfully.');
						//$coupon = $this->coupons->get_coupon_byid($couponid);
						redirect('coupon/browse/'.$coupon123[0]['seokeyword'], 'refresh');
					}
					else
					{
						$this->session->set_flashdata('error', 'There is error in updating comment. Try later!');
						redirect('coupon', 'refresh');
					}
				}
			}
			else
			{
		 			//If New Record Insert
						if( $this->input->post('btncommentsubmit') || $this->input->post('comment')!='')
						{
							//Getting value
							$couponid = $this->encrypt->decode($this->input->post('couponid'));
							$coupon123 = $this->coupons->get_coupon_byseokeyword($couponid); 
							$userid = $this->session->userdata['youg_user']['userid'];
							$comment = addslashes(strip_tags($this->input->post('comment')));
							
							$updated = $this->coupons->insert_comment($coupon123[0]['id'],$userid,$comment);
							
							if( $updated = 'added')
							{	
									$this->session->set_flashdata('success', 'comment posted successfully.');
									$coupon = $this->coupons->get_coupon_byid($couponid);
									redirect('coupon/browse/'.$couponid, 'refresh');
							}
							else
							{
								$this->session->set_flashdata('error', 'There is error in posting comment. Try later!');
								redirect('coupon', 'refresh');
							}	
					}
				}
		}
	}
	
	

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */