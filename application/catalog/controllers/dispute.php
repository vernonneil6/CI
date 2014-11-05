<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Dispute extends CI_Controller {

	public $paging;
	public $data;
	
	public function __construct()
  	{
  	parent::__construct();
		// Your own constructor code
		
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
		
	  	$this->load->model('disputes');

		
		if( array_key_exists('youg_user',$this->session->userdata) )
		{
				$this->data['title'] =  'Businessdisputes';
		}
		else
		{
				$this->data['title'] =  'Businessdisputes';
		}
		$this->data['section_title'] = 'Businessdisputes';
		
		
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
	
	public function message($disputeid)
	{   
			$data=$this->disputes->get_details($disputeid);  
			$this->data['username']=$data['username'];
			$this->data['dispute']=$data['dispute'];
			$this->data['company']=$data['companyname'];
			$this->data['cmpid']=$data['companyid'];
			$this->data['casestatus']=$data['status'];
			$this->data['msglink']=$data['msglink'];
			$this->data['id']=$data['id'];
			$this->data['messages']=$this->disputes->get_messages($disputeid);  
		      
		       $this->load->view('message',$this->data);
	}
	public function message_insert()
	{   
		if($this->input->post('mysubmit'))
	    {
			$config['upload_path'] = './uploads/message/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000000';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$this->load->library('upload', $config);
			
			$companyname =$this->input->post('companyname');	
			$companyid =$this->input->post('companyid');	
			$toid =$this->input->post('toid');	
			$fromid =$this->input->post('fromid');	
			$username =$this->input->post('username');	
			$userid =$this->input->post('userid');	
			$dispute =$this->input->post('dispute');	
			$disputeid =$this->input->post('disputeid');
			$messages =$this->input->post('messages');	
			$status =$this->input->post('status');	
			$date =$this->input->post('ondate');	
			$msglink =$this->input->post('msglink');
					
		   
		  if($this->upload->do_upload('img'))
		  {
		       
		    $fileupload =$this->upload->data();
			$this->disputes->insert_message($companyname,$companyid,$toid,$fromid,$username,$userid,$dispute,$disputeid,$messages,$status,$date,$msglink,$fileupload['file_name']);
			redirect('dispute/message/'.$msglink,'refresh');
		  }
		  else
		  {
			$fileupload ='nofile';
			$this->disputes->insert_message($companyname,$companyid,$toid,$fromid,$username,$userid,$dispute,$disputeid,$messages,$status,$date,$msglink,$fileupload);		  
		    redirect('dispute/message/'.$msglink,'refresh');
		  }
	    }
	  
	    
	}
	

	
	
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */
