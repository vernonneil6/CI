<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home1 extends CI_Controller {

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
	
		//Loading Model File
		$this->load->model('homes1');
		
		
	
		$trans = array( "www." => "", "http://" => "", "https://" => "");
       $url=strtr($_SERVER['HTTP_HOST'], $trans); 
		echo $url;
		
		$subdomain =(explode(".", $url));
		
		if(array_key_exists('0',$subdomain)){
			 print_r( $subdomain);
	
		 if($subdomain[0]=='coingaia'){
		
			return true;
		 }
		 else
		 {
				$checkdomain=$this->homes1->validatesubdomain($subdomain[0]); 
		 
	
	
		if($checkdomain=='yes')
		{
			 return true;
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
	//checks domain


//Now to use the function

	public function index($intid='')
	{
	//checks sub domain;
	
	 
		if($intid!='')
		{
		
		$exchnage=$this->homes1->get_exchange_price($intid);	
		//$this->data['exchangedata']=$exchnage;
		
		}
		else
		{
		$exchnage=$this->homes1->get_first_exchanges();
			//sets interfaceid
			if(!empty($exchnage))
			{
			$intid=$exchnage[0]['interfaceexid'];
			}
		}
		$this->data['lowprice']=$this->homes1->get_low_price($intid);
		$this->data['highprice']=$this->homes1->get_high_price($intid);
		//$this->data['dailychange']=$this->homes1->get_dailychange($intid);
	//	$this->data['range']=$this->homes1->get_range($intid);
		$this->data['dailyvolume']=$this->homes1->get_dailyvolume($intid);
		 $this->data['avg_sell']=$this->homes1->set_price_sell($intid);
		 $this->data['avg_buy']=$this->homes1->set_price_buy($intid);
		
		
		$this->data['exchangedata']=$exchnage;
		$this->data['exchanges']=$this->homes1->get_exchanges();
	    $this->data['menu']=$this->load->view('menu',$this->data,true);
		$this->data['header']=$this->load->view('header',$this->data,true);
		//gets list of the buy orders
		$this->data['buyorderlist']=$this->homes1->get_buyorders($intid);
		  $this->db->last_query();
		$this->data['totalbuy']=$this->homes1->get_totalbuy($intid);
		$this->data['totalsell']=$this->homes1->get_totalsell($intid);
		$this->data['sellorderlist']=$this->homes1->get_sellorders($intid);
		$this->data['footer']=$this->load->view('footer',$this->data,true);
		$this->load->view('home',$this->data);
		
		//echo "<h1>Comming Soon <h1>";
	}

	public function buycurrency()
	{
		
		 if( $this->input->is_ajax_request())
		 {
				   $base_price=$this->input->post('buybasecurrency');
				  $buyamount=$this->input->post('buyamount');
				 $buytotaltext=$this->input->post('buytotaltext');
				 $feescalculationtext=$this->input->post('feescalculationtext');
				  $buybasecurrency=$this->input->post('buybasecurrency');
				  $interfaceexid=$this->input->post('interfaceexid');
								$main_price=$this->set_main_price($interfaceexid);
				
				if($this->homes1->buycurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid))
				{
					
					$main_price=$this->homes1->set_main_price($interfaceexid);	
				    $this->homes1->update_price($interfaceexid,$main_price);
					//$this->session->set_flashdata('success', 'Successfully Placed your order');
					//redirect('home', 'refresh');
					echo "yes";
				}
				else
				{
					echo "no";
					//$this->session->set_flashdata('error', 'Error while Placing your order');
					//redirect('home', 'refresh');
					
				}
		 }
	}
	
	public function sellcurrency()
	{
		 $interfaceexid=$this->input->post('interfaceexid');
		 
		 if($interfaceexid!='')
		 {
				   $base_price=$this->input->post('sellbasecurrency');
				   $buyamount=$this->input->post('sellamount');
				  $buytotaltext=$this->input->post('selltotaltext');
				  $feescalculationtext=$this->input->post('feescalculationselltext');
				   $buybasecurrency=$this->input->post('sellbasecurrency');
			
				if($this->homes1->sellcurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid))
				{
						$main_price=$this->homes1->set_main_price($interfaceexid);	
						
						$this->homes1->update_price($interfaceexid,$main_price);
						
					//$this->session->set_flashdata('success', 'Successfully Placed your order');
					//redirect('home', 'refresh');
					echo "yes";
				}
				else
				{
					echo "no";
					//$this->session->set_flashdata('error', 'Error while Placing your order');
					//redirect('home', 'refresh');
					
				}
		 }
	}

public function set_price_buy($interfaceid)
{
	$this->homes1->set_price_buy($interfaceid);
	
}

public function set_price_sell($interfaceid)
{
	$this->homes1->set_price_sell($interfaceid);	
	
}
public function set_main_price($interfaceid)
{
	$this->homes1->set_main_price($interfaceid);	
	
}

	
}

/* End of file page.php */
/* Location: ./application/controllers/page.php */