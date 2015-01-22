<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Badge extends CI_Controller {

	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		
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
		
	  	$this->load->model('badges');

		
		if( array_key_exists('youg_user',$this->session->userdata) )
		{
				$this->data['title'] =  'Badge';
		}
		else
		{
				$this->data['title'] =  'Badge';
		}
		$this->data['section_title'] = 'Badge';
		
		
		//Meta Keywords and Description
		$this->data['keywords'] = $this->common->get_seosetting_value(4);
		$this->data['description'] = $this->common->get_seosetting_value(5);
		$total= $this->common->get_all_complaints_totaldamage($siteid);
		
		if(count($total)>0) {
		$this->data['total'] = round($total[0]['total']);
		}
		
		//Load header and save in variable
		$this->data['header'] = $this->load->view('header',$this->data,true);
		$this->data['menu'] = $this->load->view('menu',$this->data,true);
		$this->data['footer'] = $this->load->view('footer',$this->data,true);
	}
	
	public function index()
	{  
                
		$this->load->view('badge',$this->data);

	}
	public function rating($id)
	{  
                $datas=$this->badges->badgeid($id);
                $this->data['id']=$datas['id'];
				$this->data['badgedetail']=$this->badges->badgedetail($id);

                if($this->input->post('submit'))
               {
                   $rating=$this->input->post('rate');
                   $titles=$this->input->post('titles');
                   $review=$this->input->post('review');
                   $toid=$this->input->post('toid');
                   if($this->session->userdata('youg_user'))
                   {
                   $data=$this->session->userdata('youg_user');
				   $fromid=$data['userid'];
				   $name=$data['name'];
                   }
                   else
                   {
                   $fromid='';
				   $name='';
                   }
                   $this->badges->badgeadd($name,$rating,$titles,$review,$fromid,$toid);
               }
               $this->load->view('badge',$this->data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
