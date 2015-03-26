<?php
Class Settings extends CI_Model
{
	//Getting setting value for editing By id
	function get_setting_value($id)
 	{
		$siteid = $this->session->userdata('siteid');
		if($siteid=='')
		{
		$siteid=1;
		}
		$query = $this->db->get_where('setting', array('id' => $id,'websiteid' => $siteid));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return nl2br(stripslashes($result[0]['value']));
		}
		else
		{
			return false;
		}
 	}
 	function get_country_by_countryid($cid)
	{
		$query = $this->db->get_where('youg_country',array('country_id'=>$cid));
		return $query->row_array();
		
	}
 	function get_all_countrys()
	{
		//Executing Query
		$this->db->select('country_id,name');
		$this->db->from('country');
						
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	function update_billingaddress($address,$city,$state,$country,$zip,$id)
	{
		
		$data = array(
					'streetaddress' => $address,
					'city'		    => $city,
					'state'	        => $state,
					'country'	    => $country,
					'zip'		    => $zip
					
		);
		$query=$this->db->update('youg_company', $data, array('id' => $id));
	  
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}	
			
	}
	function get_all_states_by_cid($country_id)
	{
		//Executing Query
		$this->db->select('country_id,name');
		$this->db->from('state');
		$this->db->where('country_id',$country_id);
						
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	//Getting Email value
	function get_email_byid($id)
 	{
		$query = $this->db->get_where('emails', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting value for editing
	function get_company_byid($id)
 	{
		$query = $this->db->get_where('company', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}

	//Getting value for editing
	function get_user_byid($id)
 	{
		$query = $this->db->get_where('user', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}

	
	function get_elitecompany_byid($id)
 	{
		$query = $this->db->get_where('elite', array('company_id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	function get_elitepayment_byid($id)
	{
		$enablecheck=$this->db->get_where('elite', array('company_id' => $id))->row_array();
		$subscription_amount = $this->db->get_where('setting', array('id' => '19'))->row_array();
		if(trim($enablecheck['status'])=='Enable')
		 {
		   $query=$this->db->select('company_id,amount,payment_date,expires,subscr_id')
		                ->get_where('subscription', array('company_id' => $id))->row_array();
	     }
	
		return $query;	
			
	}
	
	function get_all_company()
	{
		return $this->db->get('youg_elite')->result_array();
	}
	
	function cancel_elitemembership_bycompnayid($id,$companyid)
 	{
		$data = array('cancel_date' => date('Y-m-d'),'cancel_flag' => '1');
		
		$this->db->where('id', $id);
		$this->db->where('company_id', $companyid);
		if ($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
 	
 	function enable_elitemembership_bycompanyid($id,$companyid)
 	{
		$data = array('cancel_flag' => '0');
		
		$this->db->where('id', $id);
		$this->db->where('company_id', $companyid);
		if ($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
 	
 	function get_elitecancel_email_byid($companyid)
 	{
		$query = $this->db->select('id, company, email, contactemail')
						  ->from('company')
						  ->where('id',$companyid)
    					  ->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_all_unclickedreviewstatus()
 	{
		$query = $this->db->get_where('reviewstatus', array('status' => 'sent','click'=>'No'));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function update_reviewstatus($id)
 	{
		$data = array('click' =>'Yes' );
		
		$this->db->where('id', $id);
		if ($this->db->update('reviewstatus',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	function get_all_urls()
 	{
		$query = $this->db->get('url');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function get_url_by_id($id)
 	{
		$query = $this->db->get_where('url',array('id'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	//insert wining amount as per calculation
	function insert_test_user($name)
 	{
		$data = array('name' => $name);
		
		if( $this->db->insert('test', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		}
	
	
	function get_all_Subscribtionofcompany()
	{
		$date = date("Y-m-d H:i:s");
		$query = $this->db->where('expires <', $date);
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function disable_elitemember($id)
	{
		$data = array('status' =>'Disable' );
		
		$this->db->where('company_id', $id);
		if ($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}
	
	function get_subscribtion_bycompanyid($id)
	{
		$query = $this->db->get_where('subscription',array('company_id'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	
	}
	
	function cancel_elitemembership_bycompnayid1($companyid)
 	{
		$data = array('status' =>'Disable');
		
		$this->db->where('company_id', $companyid);
		if($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function brokerlimitview($idea)
	{
		return  $this->db->get_where('youg_broker',array('subbrokerid'=>$idea,'type'=>''))->row_array();
	}
	function get_subscriptionid($sid)
	{
		$query = $this->db->get_where('youg_subscription',array('company_id'=>$sid));
		return $query->row_array();
				         
	}
	function get_elitesubscription_detailsbycompanyid($emailcompany)
	{
		
		$query = $this->db->get_where('youg_company',array('id'=>$emailcompany));
		return $query->row_array();
		
	}
	function update_subscription($subscriptionId,$companyid,$amt,$ccnumber,$cvv,$cardexpire,$fname,$lname,$tx,$sig,$time,$expires,$payer_id,$paymentmethod,$emailflag)
	{
	    $date = date("Y-m-d H:i:s");
		$payment_ip = $_SERVER['REMOTE_ADDR'];
		$data = array(
					'amount'  		=> $amt,
					'ccnumber'  	=> $ccnumber,
					'cvv'  		    => $cvv,
					'ccexpiredate'  => $cardexpire,
					'firstname	'  	=> $fname,
					'lastname	'  	=> $lname,
					
					'txn_id'		=> $tx,
					'payment_date'	=> $date,
					'payment_ip'	=> $payment_ip,
					'expires'		=> $expires,
					'sign'			=> $sig,
					'payer_id'		=> $payer_id,
					'paymentmethod'	=> $paymentmethod,
		);
		$query=$this->db->where(array('subscr_id'=>$subscriptionId,'company_id'=>$companyid))
		                ->update('subscription',$data);
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}	
		
		
	}
	function update_elite($companyid,$payment_amount,$payment_currency,$transactionid,$payment_date)
	{
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$emailflag='1';
		  $date = date("Y-m-d H:i:s");
		$data = array(   
							'payment_amount'	=> $payment_amount,
							'payment_currency'	=> $payment_currency,
							'transactionid'		=> $transactionid,
							'payment_date' 		=> $payment_date,
							'payment_ip'		=> $varipaddress,
							'renew_emailflag'   => $emailflag,
							'dateofrenew'		=>$date
						);
		$this->db->where('company_id',$companyid);				
		$this->db->update('elite', $data); 
		
	}
	function list_all_tutorials()
	{
		
	  $query = $this->db->get_where('youg_tutorial',array('status'=>'Enable'));
	  return $query->result_array();
		
		
	}
	function list_all_faq()
	{
	  $siteid = $this->session->userdata('siteid');
		if($siteid==''){
		   $siteid=1;
		}	
	  $query = $this->db->get_where('youg_faq',array('status'=>'Enable','websiteid'=>$siteid));
	  return $query->result_array();
		
		
	}
	//Getting value for editing
	function get_faq_byid($id)
 	{
		$query = $this->db->get_where('faq', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
		function get_companyelite_byid($id)
	{
		$query = $this->db->select('payment_amount,discountcodetype,discountcode')
		                  ->from('elite')
		                  ->where(array('company_id'=>$id))
		                  ->get();
	  	
	  	if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
			
	}
	function get_social_status_by_id($id)
	{
		
		$siteid = $this->session->userdata('siteid');
		if($siteid=='')
		{
		$siteid=1;
		}
		$query=$this->db->select('*')
		                ->from('youg_companysem')
		                ->where(array('companyid'=>$id,'websiteid'=>$siteid,'status'=>'Enable'))
		                ->get();
		                
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}                
		                  
	}
	
	
	
	

}
?>
