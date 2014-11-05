<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Pay extends CI_Controller {

	public $data;
	public $data1;
	
	public function __construct()
 	 {
  	parent::__construct();
		// Your own constructor code
		//Loading Model File
	  	$this->load->model('users');
		
		include('include.php');
		
		
	}
	
	public function transcation($url='')
	{
		if($url=='')
		{
		redirect('', 'refresh');
		}
			$url = $url1;
			$url = strrev($url);
			$url = base64_decode($url);
			$url = explode("+",$url);
			
			if(count($url)==5)
			{
				$amount = $url[0];
				$balanceid = $url[1];
				$currencyid = $url[2];
				$eaddress = $url[3];
				$uid = $url[4];
				
			}
			else
			{
				$this->session->set_flashdata('error', 'Something went wrong.');
				redirect('', 'refresh');
			}
			
			if($uid != $this->session->userdata['cc_user']['userid'])
			{
				$this->session->set_flashdata('error', 'Something went wrong.');
				redirect('', 'refresh');
			}
			
			
		
			if( array_key_exists('cc_user',$this->session->userdata) )
	  		{
		 		//get user main btc address
				$mainbtcaddr = $this->users->get_btc_add_by_userid($userid);
				if(strlen($frommainbtcaddr)>0)
				{
					$frommainbtcaddr = $mainbtcaddr[0]['accountaddress'];
					$fromprivatekey = $mainbtcaddr[0]['privatekey'];
				}
				else
				{
					$this->session->set_flashdata('error', 'Something went wrong.');
					redirect('', 'refresh');
				}
				
				//convert amount in santoshi
				$mainamount		= $amount;
				$amount			= $amount*10000000;
				$sender_addr	= $frommainbtcaddr;
				$reciver_addr	= $eaddress;
				$privet_key		= $fromprivatekey;
	
				$json_url = "https://blockchain.info/merchant/$privet_key/payment?to=$reciver_addr&amount=$amount&from=$sender_addr";
		
				$json_data = file_get_contents($json_url);
		
				$json_feed = json_decode($json_data);
				if($json_feed->error)
				{
					//echo 'Error: '.$json_feed->error;
					$this->session->set_flashdata('error', $json_feed->error);
					redirect('user/finance', 'refresh');
				}
			else
			{
				$message = $json_feed->message;
				$txid = $json_feed->tx_hash;
				$this->session->set_flashdata('success','Message: '.$message.'Transaction Id: '.$txid);
				
				//update btc balance
				$this->users->update_btc_bal($uid,$mainamount);
				
				
				redirect('user/finance', 'refresh');
			}
		}
			else
			{
				$this->session->set_userdata('last_url','pay/transcation/'.$url1);
				$this->session->set_flashdata('error', 'Please login to contiune.');
				redirect('', 'refresh');
		}
	}
	//gets finance data
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */