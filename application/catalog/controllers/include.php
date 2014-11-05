<?php
$this->load->model('common');
//common
$this->data['site_name'] = $this->common->get_setting_value(1);
$this->data['site_url'] = $this->common->get_setting_value(2);
$this->load->model('homes1');
	
	   if( array_key_exists('cc_user',$this->session->userdata) )
	  {
		 $this->data['messages'] = $this->common->get_count_message();
		 $id = $this->session->userdata['cc_user']['userid'];
		 $this->data['logged_user'] = $this->common->get_logged_user_byid($id);
		 if(count($this->data['logged_user'])==0)
		 {
			redirect('login','refresh');	
		 }
	  }
	  
	   $trans = array( "www." => "", "http://" => "", "https://" => "");
       $url=strtr($_SERVER['HTTP_HOST'], $trans); 
		$subdomain =(explode(".", $url));
		
		if($_SERVER['HTTP_HOST']!='localhost')

		{		
		if(array_key_exists('0',$subdomain)){
		
	
		 if($subdomain[0]=='coingaia'){
			$this->session->set_userdata('interfaceid',0);	
		 }
		 else
		 {
			$checkdomain=$this->homes1->validatesubdomain($subdomain[0]); 
		 
		if($checkdomain!='no')
		{
			 $this->session->set_userdata('interfaceid',$checkdomain[0]['userid']);
			
		}
		else
		{
			echo "<h1>INVALID SUBDOMAIN  ACCESS DENIED<h1>";
			exit();
			//redirect('coingaia.com','refresh');
		}
	   }
	 }
	 
	  
	}
		else
		{
		$this->session->set_userdata('interfaceid',0);
		}
	  	
	 		//get logo
			if($this->session->userdata('interfaceid')!='')
			{
			$logo=$this->common->get_logo($this->session->userdata('interfaceid'));
			}
			else
			{
				$logo=$this->common->get_logo(5);	
			}
			if(count($logo)>0)
			{
				$this->data['logoimage'] = base_url().$this->config->item('interfacelogo_upload_path').$logo[0]['interfacelogo'];
				if(strlen($logo[0]['interfacelogo']<4))
				{
					$this->data['logoimage'] = base_url().$this->config->item('interfacelogo_upload_path').$logo[0]['interfacelogo'];
				}
			}
			else
			{
				//$this->data['logoimage'] = base_url().'images/logo.jpg';
				
			}
	
	
	//sem
	$this->data['fb'] = $this->common->get_sem_value(1);
	$this->data['tw'] = $this->common->get_sem_value(2);
	$this->data['li'] = $this->common->get_sem_value(3);
	$this->data['go'] = $this->common->get_sem_value(4);
	 /*if( array_key_exists('cc_user',$this->session->userdata) )
	  {
		  $this->load->model('users');
    $this->data['messages']=$this->users->get_all_messages();
	  }*/
	$this->data['keywords'] = '';
	$this->data['description'] = '';
	$this->data['header'] = $this->load->view('header',$this->data,true);
	$this->data['menu'] = $this->load->view('menu',$this->data,true);	    $this->data['footer'] = $this->load->view('footer',$this->data,true);	   
?>