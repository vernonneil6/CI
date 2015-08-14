<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
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
	* @see http://codeigniter.com/review_guide/general/urls.html
	*/
	
	public $paging;
	public $data;
	
	public function __construct()
  {
  	parent::__construct();
			
		$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match("/\writerbin\b/i", $domain, $regs)) 
		{
			$site = 'yougotrated.writerbin.com';
		}
		else if(preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
		{
		    $site = $regs['domain'];
		}
		  $website = $this->common->get_site_by_domain_name($site);
		 		 
		 if(count($website)>0)
		 {
		 	$siteid = $website[0]['id'];
		 }
		 $this->session->set_userdata('siteid',$siteid);
		 
		 $siteid = $this->session->userdata('siteid');
		
		$this->data['site_name'] = $this->common->get_sitename_byid($siteid);
		$this->data['site_url'] = $this->common->get_siteurl_byid($siteid);
		$this->data['searchword']='';
		$this->data['keyword']='';
			
		//Loading Model File
  		$this->load->model('pressreleases');
		$this->load->model('complaints');
		
		$this->data['topads']= $this->common->get_all_ads('top','pressrelease',$siteid);
		$this->data['bottomads']= $this->common->get_all_ads('bottom','pressrelease',$siteid);
		$this->data['leftads']= $this->common->get_all_ads('left','pressrelease',$siteid);
		$this->data['rightads']= $this->common->get_all_ads('right','pressrelease',$siteid);
	
		//Loading Pagination Custome Config File
		$this->config->load('paging',TRUE);
		$this->paging = $this->config->item('paging');
		
		//Meta Keywords and Description
		$this->data['title'] = "Pressreleases";
		if($this->uri->segment(2)=='browse' && $this->uri->segment(3)!='')
		{
			$id = $this->uri->segment(3);
			$pressrelease= $this->pressreleases->get_pressrelease_bytitle($id);
			if(count($pressrelease)>0)
			{
				$this->data['keywords'] = $pressrelease[0]['metakeywords'];
				$this->data['description'] = $pressrelease[0]['metadescription'];
			}
		}
		elseif($this->uri->segment(1)=='pressrelease' && $this->uri->segment(2)!='search')
		{
				 $words=ucfirst($this->uri->segment(2));
				$str = str_replace("-", " ", $words);
				$compans=preg_replace('/[0-9]+/', '', $str);
				$compan=strip_tags($compans);
				$pressrelease= $this->pressreleases->get_pressrelease_bytitle($compan);
				$this->data['title'] = $compans." Pressrelease";
			if(count($pressrelease)>0)
			{
				$this->data['keywords'] = $pressrelease[0]['metakeywords'];
				$this->data['description'] = $pressrelease[0]['metadescription'];
			}else
			{
				$words=ucfirst($this->uri->segment(2));
				$str = str_replace("-", " ", $words);
				$compans=preg_replace('/[0-9]+/', '', $str);
				$compan=strip_tags($compans);
				
				$this->data['keywords'] =$compans.' Company Pressrelease In YGR';
				$this->data['description'] ='More pressreleases from '.$compans.' Company In YGR';
				
			}
		}
		elseif($this->uri->segment(1)=='pressrelease' && $this->uri->segment(2)=='search')
		{
			if($this->input->post('searchpress'))
			{
				$press=trim(ucfirst($this->input->post('searchpress')));
			}else
			{
				$press='Search';
			}
			$this->data['keywords'] =$press.' Pressreleases in YGR';
			$this->data['description'] = 'Search for Pressrelease In YGR Directory';
		}

		else{
		
		$this->data['keywords'] ='Pressreleases,Pressrelease Content In YGR Directory,Latest pressrelease,Recent Pressrelease';// $this->common->get_seosetting_value(4);
		$this->data['description'] = 'Latest Press release In YGR Directory,Search for Pressrelease In YGR Directory';
		}
		
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		//Load header and save in variable
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index( $company_name = "",  $description = "" , $pressid = '')
	{
		$this->load->library('pagination');
		
	  	$limit = $this->paging['per_page'];
  	  	$offset = ($this->uri->segment(3) != '') ? $this->uri->segment(3) : 0;
  	  		
  	  	if($company_name != "" && $description != "" && $pressid != ''){
  	  	
  	
			$this->data['pressrelease'] = $this->pressreleases->getPressReleaseByID($pressid);
			
			if(count($this->data['pressrelease'])>0)
			{
				//echo "<pre>"; print_r($this->data['pressrelease']); die();
				//Loading View File
				$company = $this->complaints->get_company_byid($this->data['pressrelease'][0]['companyid']);
				$this->data['company'] = $this->complaints->get_company_byid($this->data['pressrelease'][0]['companyid']);
				$companyid = $this->data['pressrelease'][0]['companyid'];
				if(count($company)>0)
				{
					$this->data['companyname'] = ucfirst($company[0]['company']);
					$this->data['aboutus'] = $company[0]['aboutus'];
					$this->data['address'] = $company[0]['streetaddress'].'<br>'.$company[0]['city'].',  '.$company[0]['state'].',  '.$company[0]['country'].',  '.$company[0]['zip'];
					$this->data['phone'] = $company[0]['phone'];
					$this->data['url'] = $company[0]['siteurl'];
					$this->data['country'] = $company[0]['country'];
					$this->data['sems'] = $this->complaints->get_companysem_bycompanyid($companyid);
				}
							
				//other pressreleases
				
				$this->data['otherpressreleases'] = $this->pressreleases->get_all_pressreleases(3);
				$except=$pressid;
				$this->data['mypressreleases'] = $this->pressreleases->get_my_pressreleases($companyid,$except);
				
				$this->load->view('pressrelease/browse1',$this->data);
			}
			else
			{
				redirect('pressrelease','refresh');
			} 	  	
  	  	
		}else{
		
			$this->data['pressreleases'] = $this->pressreleases->get_all_pressreleases($limit,$offset);
		
			$this->paging['base_url'] = site_url("pressrelease/index");
			$this->paging['uri_segment'] = 3;
			$this->paging['total_rows'] = count($this->pressreleases->get_all_pressreleases());
			$this->pagination->initialize($this->paging);
		
			//Loading View File
			$this->load->view('pressrelease/index',$this->data);
		}
	}
	public function browse($id='')
	{
		$this->data['pressrelease'] = $this->pressreleases->get_pressrelease_bytitle($id);
		
	  	if(count($this->data['pressrelease'])>0)
		{
			//echo "<pre>"; print_r($this->data['pressrelease']); die();
			//Loading View File
			$company = $this->complaints->get_company_byid($this->data['pressrelease'][0]['companyid']);
			$this->data['company'] = $this->complaints->get_company_byid($this->data['pressrelease'][0]['companyid']);
			$companyid = $this->data['pressrelease'][0]['companyid'];
			if(count($company)>0)
			{
				$this->data['companyname'] = ucfirst($company[0]['company']);
				$this->data['aboutus'] = $company[0]['aboutus'];
				$this->data['address'] = $company[0]['streetaddress'].'<br>'.$company[0]['city'].',  '.$company[0]['state'].',  '.$company[0]['country'].',  '.$company[0]['zip'];
				$this->data['phone'] = $company[0]['phone'];
				$this->data['url'] = $company[0]['siteurl'];
				$this->data['country'] = $company[0]['country'];
				$this->data['sems'] = $this->complaints->get_companysem_bycompanyid($companyid);
			}
						
			//other pressreleases
			
			$this->data['otherpressreleases'] = $this->pressreleases->get_all_pressreleases(3);
			$except=$id;
			$this->data['mypressreleases'] = $this->pressreleases->get_my_pressreleases($companyid,$except);
			
	  		$this->load->view('pressrelease/browse1',$this->data);
		}
		else
		{
			redirect('pressrelease','refresh');
		}
		
	}
	
	public function search()
	{
			if(!$this->uri->segment(3))
			{
				$searchpress=trim($this->input->post('searchpress'));
			}
			else
			{
				$searchuri = $this->uri->segment(3);
				$uri= base64_decode($searchuri);
				$uri= explode('/',$uri);
				$searchpress=$uri[0];
			}
			
			$this->data['keyword']=$searchpress;
			
			$limit = $this->paging['per_page'];
			$offset = ($this->uri->segment(4) != '') ? $this->uri->segment(4) : 0;
			
			//Addingg Setting Result to variable
			$this->data['pressreleases'] = $this->pressreleases->search_pressrelease($searchpress,$limit,$offset);
			$uri=	$searchpress;
			//echo $uri;
			$uri= base64_encode($uri);
			$this->paging['base_url'] = site_url("pressrelease/search/".$uri);
			$this->paging['uri_segment'] = 4;
			$this->paging['total_rows'] = count($this->pressreleases->search_pressrelease($searchpress));
			$this->pagination->initialize($this->paging);
			
			$this->load->view('pressrelease/index',$this->data);
				
		}
}
/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
