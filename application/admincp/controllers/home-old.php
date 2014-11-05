<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$this->data['site_name'] = $this->common->get_setting_value(1);
		
		$this->data['title'] = $this->data['site_name']; 
		include('include.php');
		//Loading Model File
		$this->load->model('homes');
		
		
	}
	
	public function index($intid='',$gtype='')
	{
	//checks sub domain;
		if($gtype=='')
		{
			$this->data['gtype'] = 'today';
		}
		elseif($gtype=='w')
		{
			$this->data['gtype'] = 'week';
		}
		elseif($gtype=='m')
		{
			$this->data['gtype'] = 'month';
		}
		else
		{
			$this->data['gtype'] = 'today';
		}
		
		
		if($intid!='')
		{
			$exchnage=$this->homes->get_exchange_price($intid);	
		   //$this->data['exchangedata']=$exchnage;
		
		}
		else
		{
			$exchnage=$this->homes->get_first_exchanges();
			//sets interfaceid
			if(!empty($exchnage))
			{
				$intid=$exchnage[0]['interfaceexid'];
			}
		}
		
		$this->data['ex_id'] = $intid;
		if(count($exchnage)<=0)
		{
			redirect(base_url(),'refresh');
			die();
		}
		else
		{
			//sets default or user fees
			$this->data['fees']=$this->common->get_fees();
			if($this->data['fees']=='')
			{
				$this->data['fees']=$this->common->get_fees_default();
			}
	
		$this->data['lowprice']=$this->homes->get_low_price($intid);
		$this->data['lastprice']=$this->homes->get_last_price($intid);
		
		if( array_key_exists('cc_user',$this->session->userdata) )
	  		{
		$this->data['activeorders']=$this->homes->activeorders($intid);
			}
		else
		{
		$this->data['activeorders']=array();
		}
		if( array_key_exists('cc_user',$this->session->userdata) )
	  		{
		$this->data['orderhistory']=$this->homes->orderhistory($intid);
			}
		else
		{
		$this->data['orderhistory']=array();
		}
		
		$this->data['highprice']=$this->homes->get_high_price($intid);
		//$this->data['dailychange']=$this->homes->get_dailychange($intid);
	//	$this->data['range']=$this->homes->get_range($intid);
		$this->data['dailyvolume']=$this->homes->get_dailyvolume($intid);
		 $this->data['avg_sell']=$this->homes->set_price_sell($intid);
		 $this->data['avg_buy']=$this->homes->set_price_buy($intid);
		
		$this->data['userposts']=$this->homes->userposts();
		$this->data['exchangedata']=$exchnage;
		$this->data['exchanges']=$this->homes->get_exchanges();
	    $this->data['menu']=$this->load->view('menu',$this->data,true);
		$this->data['header']=$this->load->view('header',$this->data,true);
		//gets list of the buy orders
		$this->data['buyorderlist']=$this->homes->get_buyorders($intid);
		$this->db->last_query();
		$this->data['totalbuy']=$this->homes->get_totalbuy($intid);
		$this->data['totalsell']=$this->homes->get_totalsell($intid);
		$this->data['sellorderlist']=$this->homes->get_sellorders($intid);
		}
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
				 $currency=$this->input->post('currency');
				 $feestext=$this->common->get_fees();
				if($feescalculationtext=='')
				{ 
				if($feestext=='')
					{
				  $feestext=$this->common->get_fees_default();
					}
				$feescalculationtext=(($feestext*$buyamount)/100);
				}
				  $interfaceexid=$this->input->post('interfaceexid');
				 $main_price=$this->set_main_price($interfaceexid);
				 if(($this->session->userdata('interfaceid')!=''))
				 {
					$interface=$this->session->userdata('interfaceid');
				 }
				 else
				 {
					 $interface=0;
				 }
				if($this->homes->buycurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency))
				{
					
					$main_price=$this->homes->set_main_price($interfaceexid);	
				    $this->homes->update_price($interfaceexid,$main_price);
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
	
		public function buycurrencystandard()
	{
		
		 if( $this->input->is_ajax_request())
		 {
				$base_price=$this->homes->get_last_order_price('buy');
				$buyamount=$this->input->post('buyamount');
				$buytotaltext=$this->input->post('buytotaltext');
				$feescalculationtext=$this->input->post('feescalculationtext');
				$buybasecurrency=$this->input->post('buybasecurrency');
				$interfaceexid=$this->input->post('interfaceexid');
				$main_price=$this->set_main_price($interfaceexid);
					 $currency=$this->input->post('currency');
				if($feescalculationtext=='')
				{ 
				if($feestext=='')
					{
				  $feestext=$this->common->get_fees_default();
					}
				$feescalculationtext=(($feestext*$buyamount)/100);
				}
				 if(($this->session->userdata('interfaceid')!=''))
				 {
					$interface=$this->session->userdata('interfaceid');
				 }
				 else
				 {
					 $interface=0;
				 }
				if($this->homes->buycurrencystd($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency))
				{
					
					$main_price=$this->homes->set_main_price($interfaceexid);	
				    $this->homes->update_price($interfaceexid,$main_price);
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
			   		 $base_price=$this->input->post('base_price');
				     $buyamount=$this->input->post('buyamount');
				  	 $buytotaltext=$this->input->post('buytotaltext');
				  	 $feescalculationtext=$this->input->post('feescalculationtext');
				     $buybasecurrency=$this->input->post('buybasecurrency');
					 	 $currency=$this->input->post('currency');
				   if(($this->session->userdata('interfaceid')!=''))
				 {
					$interface=$this->session->userdata('interfaceid');
				 }
				 else
				 {
					 $interface=0;
				 }
				if($this->homes->sellcurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency))
				{
						$main_price=$this->homes->set_main_price($interfaceexid);	
						
						$this->homes->update_price($interfaceexid,$main_price);
						
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
	public function sellcurrencystandard()
	{
		 $interfaceexid=$this->input->post('interfaceexid');
		
		 if($interfaceexid!='')
		 {
			   		 $base_price=$this->homes->get_last_order_price('sell');
					 //$base_price=$this->input->post('base_price');
				     $buyamount=$this->input->post('buyamount');
				  	 $buytotaltext=$this->input->post('buytotaltext');
				  	 $feescalculationtext=$this->input->post('feescalculationtext');
				     $buybasecurrency=$this->input->post('buybasecurrency');
					 	 $currency=$this->input->post('currency');
				   if(($this->session->userdata('interfaceid')!=''))
				 {
					$interface=$this->session->userdata('interfaceid');
				 }
				 else
				 {
					 $interface=0;
				 }
				if($this->homes->sellcurrencystd($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency))
				{
						$main_price=$this->homes->set_main_price($interfaceexid);	
						
						$this->homes->update_price($interfaceexid,$main_price);
						
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
//validates OTP CODE
public function checkotpcode()
{
	$code=$this->input->post('code');
	if($code!='')
	{
		$id = $this->session->userdata['cc_user']['userid'];
		$codedata=$this->homes->check_otpcode($code,$id);
		echo $codedata;
	}
}
//sending email
public function sent_otpcode()
{
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
				$logoimage = base_url().$this->config->item('interfacelogo_upload_path').$logo[0]['interfacelogo'];
				if(strlen($logo[0]['interfacelogo']<4))
				{
				$logoimage = base_url().$this->config->item('interfacelogo_upload_path').$logo[0]['interfacelogo'];
				}
			}
			 
			 $id = $this->session->userdata['cc_user']['userid'];
			 $this->load->model('users');
				
			 $code=rand();
			 $this->users->setoptcode($id,$code);
			 $this->data['otpcode']=$code;
			 $user = $this->users->get_user_byid($id);
			
			if(count($user)>0)
			{
				$email=$user[0]['email'];
				$username=$user[0]['username'];
				$password=$user[0]['password'];
				$loginsecretkey=$user[0]['loginsecretkey'];
			}
					$site_name = $this->common->get_setting_value(1);
					$site_url = $this->common->get_setting_value(2);
					$site_mail = $this->common->get_setting_value(5);
								
							//Loading E-mail library
					$this->load->library('email');
								
							//Loading E-mail config file
							$this->config->load('email',TRUE);
							$this->cnfemail = $this->config->item('email');
							$this->email->initialize($this->cnfemail);
							$this->email->from($site_mail,$site_name);
							$this->email->to($email);	
							$this->email->subject('Transaction OTP CODE');
							$site_logo = "<a href='".$site_url." ' title='".$site_name."' ><img src='".$logoimage."' border='0' alt='".$site_name."'></a>";
					
												$mail_body=( '<p>
	Dear&nbsp; '.$username.',</p>
<p>
	Please use following OTP code for changing password <a href="'.$site_url.'" title="'.$site_name.'">'.$site_name.'</a> .</p>
<p>
	-------------------------------------------------------------------</p>
<p>
	CODE ID&nbsp; &nbsp;&nbsp; :&nbsp; '.$code.'</p>
<p>
	
<p>
	-------------------------------------------------------------------</p>
<p>
	<a href="'.$site_url.'" title="'.$site_name.'">'.$site_url.'</a></p>
<br />
<p>
	Regards,<br />
	The '.$site_name.' Team.</p>
');
							$this->email->message("<table cellpadding='0' cellspacing='0'><tr><td>".$site_logo."</td></tr><tr><td>".$mail_body."</td></tr></table>");
							
								//Sending mail to user
								$this->email->send();
}
public function set_price_buy($interfaceid)
{
	$this->homes->set_price_buy($interfaceid);
	
}

public function set_price_sell($interfaceid)
{
	$this->homes->set_price_sell($interfaceid);	
	
}
public function set_main_price($interfaceid)
{
	$this->homes->set_main_price($interfaceid);	
	
}

public function addpost()
{
	if($this->input->post('message')!='')
	{
		$message=$this->input->post('message');
		$vals=$this->homes->add_post($message);
		
	}
	
}
function qrcode($url='test',$userid='1')
{
	
	echo '<img src="https://chart.googleapis.com/chart?chs=160x160&cht=qr&chl=mauliksuthar&choe=UTF-8" />';
}


}

/* End of file page.php */
/* Location: ./application/controllers/page.php */