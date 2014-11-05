<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Transactioncron extends CI_Controller {

	public $data;
	
	public function __construct()
  	{
  		parent::__construct();
		$this->load->model('common');
		$this->load->model('transactioncrons');
	}
	
	public function index()
	{
		//btc transcation
		$guid=$this->common->get_setting_value(9);
		$main_password=$this->common->get_setting_value(10);
		$from = $this->common->get_setting_value(11);
		
		$site_name = $this->common->get_setting_value(1);
		$site_url = $this->common->get_setting_value(2);
		$site_email = $this->common->get_setting_value(5);
		
		$transaction_quantity=0;
		$quantity=0;
							
					//get all lastest transactions
	
					$fees=$this->common->get_fees();
					if($fees=='')
					{
						$fees=$this->common->get_fees_default();
					}
					
					$tt=$this->transactioncrons->gettotalorders();
			if(isset($tt)){
			if(count($tt)>0)
			{
				for($i=0;$i<count($tt);$i++)
				{
					$json_url = "https://blockchain.info/rawaddr/".$from;
					$json_data = file_get_contents($json_url);
					$json_feed = json_decode($json_data);
					
				//get exchangeid
				$get_exchange = $this->transactioncrons->get_exchange_by_id($tt[$i]['interfaceexid']);
				
				if(count($get_exchange)>0)
				{
					if($json_feed->final_balance >= $tt[$i]['orderamount'] )	
					{
					
					$baseprice = $tt[$i]['base_price'];
					$orderamount = $tt[$i]['orderamount'];
					$feeschargedtotal = $tt[$i]['feeschargedtotal'];
					$ordertype = $tt[$i]['ordertype'];
					$ordertotal = $tt[$i]['ordertotal'];
					$transactionid = $tt[$i]['order_id'];
									
					//get all suitble offers for given bids
					
					if($tt[$i]['ordertype']=='Buy')
					{
						$get_suitable_transaction = $this->transactioncrons->get_suitable_transaction_sell($baseprice,$orderamount,$transactionid);
					}
					else 
					{
						$get_suitable_transaction = $this->transactioncrons->get_suitable_transaction_buy($baseprice,$orderamount,$transactionid);	
					}
					
				  	if(count($get_suitable_transaction)>0)
					{
						 $bidby = $tt[$i]['order_id'];
						
						 $offerby = $get_suitable_transaction[0]['order_id'];
						 $bidbyuser = $tt[$i]['userid'];
						 $offerbyuser = $get_suitable_transaction[0]['userid'];
						 $quantity = $tt[$i]['orderamount'];
						 $suitable_quantity=$get_suitable_transaction[0]['orderamount'];
						 $suitable_ordertype=$get_suitable_transaction[0]['ordertype'];
						 $unique_id = uniqid();
						 $suitable_orderid=$get_suitable_transaction[0]['order_id'];
						 $price = $tt[$i]['base_price'];
						 $userdatacurrent=$this->transactioncrons->get_user_byid($bidbyuser);
						
						$userdatasuitable=$this->transactioncrons->get_user_byid($offerbyuser); 
					
		if(($tt[$i]['orderamount']) ==( $get_suitable_transaction[0]['orderamount']))
		{
			    $quantity=0;
				//get user balance....

				$address = $this->transactioncrons->get_btc_address($offerbyuser);
				
				if(count($address)>0)
				{
					$json_url = "https://blockchain.info/rawaddr/".$address[0]['accountaddress'];
					$json_data = file_get_contents($json_url);
					$json_feed = json_decode($json_data);
					

				if($json_feed->final_balance >= $tt[$i]['orderamount'] )
				{
					if($this->transactioncrons->update_currenttrans($price,$quantity,$tt[$i]['orderamount'],$get_suitable_transaction[0]['orderamount'],$get_suitable_transaction[0]['order_id'],$bidby,$ordertype,1,$fees))
					{
					}
				
					if($this->transactioncrons->update_suitabletrans($price,$quantity,$get_suitable_transaction[0]['orderamount'],$get_suitable_transaction[0]['orderamount'],$tt[$i]['order_id'],$offerby,$suitable_ordertype,1,$fees))
					{
					}
				}
			    }
							
		}
		else
		{
		if(($tt[$i]['orderamount']) <( $get_suitable_transaction[0]['orderamount']) && $tt[$i]['orderamount']>0)
			{
			 $transaction_quantity = $get_suitable_transaction[0]['orderamount'] - $tt[$i]['orderamount'];
			 $quantity=0;
			 $status=1;
			 $s_status=0;
		
			
			//get user balance....

				$address = $this->transactioncrons->get_btc_address($offerbyuser);
				
				if(count($address)>0)
				{
					$json_url = "https://blockchain.info/rawaddr/".$address[0]['accountaddress'];
					$json_data = file_get_contents($json_url);
					$json_feed = json_decode($json_data);
					

				if($json_feed->final_balance >= $tt[$i]['orderamount'] )
				{
					//transfer btc amount
					
					$json_url = "https://blockchain.info/merchant/".$guid."/payment?password=".$main_password."&to=".$to."&amount=".$amount."&from=".$from."";
					
				
					if($this->transactioncrons->update_currenttrans($price,$quantity,$tt[$i]['orderamount'],$get_suitable_transaction[0]['orderamount'],$get_suitable_transaction[0]['order_id'],$bidby,$ordertype,1,$fees))
					{
		    		}
					if($this->transactioncrons->update_suitabletrans($price,$transaction_quantity,$get_suitable_transaction[0]['orderamount'],$get_suitable_transaction[0]['orderamount'],$tt[$i]['order_id'],$offerby,$suitable_ordertype,0,$fees))
					{}
				}
		
		}
				else
					{
						
				echo $quantityx = $tt[$i]['orderamount'] - $get_suitable_transaction[0]['orderamount'];
				 $transaction_quantity=0;
				 if($quantityx>0){
				 	echo "h";
				 }
				 	else
				 {
				    echo "g";
				 }
				 	echo $offerby;
				 	echo $bidby;
			  	}
						}
				
					}
				}
			}
					else
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
							$this->email->subject($this->common->get_setting_value(1)." : ".'Insufficient BTC coins to your wallet address');
							$site_logo = "<a href='".$site_url." ' title='".$site_name."' ><img src='".$logoimage."' border='0' alt='".$site_name."'></a>";
					
												$mail_body=( '<p>
	Dear&nbsp; Admin,</p>
<p>
	Please Deposit Some BTC coins to your Wallet Address '.$from.'</p>
<p>
	-------------------------------------------------------------------</p>
<p>
	Wallet Address '.$from.'</p>
<p>
	
<p>
	-------------------------------------------------------------------</p>
<p>
	Regards,<br />
	The '.$site_name.' Team.</p>
');
	$this->email->message("<table cellpadding='0' cellspacing='0'><tr><td>".$site_logo."</td></tr><tr><td>".$mail_body."</td></tr></table>");
							
	//admin mail to notify about btc address
	$this->email->send();
				}
				}
			  }
		    }
		}	
	}
}

/* End of file cron.php */
/* Location: ./application/controllers/welcome.php */
