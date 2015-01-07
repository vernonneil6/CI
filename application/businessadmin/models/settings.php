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
		   $sub_id=$this->db->get_where('subscription', array('company_id' => $id))->row_array();
		   $query= $this->db->select('*')
							->from('subscription sb')
							->join('silent si', 'sb.subscr_id = si.subscription_id', 'left')
							->where(array('sb.subscr_id'=>$sub_id['subscr_id'],'sb.company_id'=>$id))
							->get()
							->row_array();
		 }
	    $eid=$query['subscr_id'];
		$individual= $this->db->query('select count(subscription_paynumber) as count from youg_silent where subscription_id="'.$eid.'" and subscription_paynumber=1')->row_array();
		$startdate=$this->db->get_where('company', array('id' => $id))->result_array();
		$query['startdate']=$startdate['registerdate'];
		$query['sub_amt']=$subscription_amount['value'];
		$query['totalpayment']=$individual['count'];
		
		return $query;	
			
	}
	function cancel_elitemembership_bycompnayid($id,$companyid)
 	{
		$data = array('status' =>'Disable' );
		
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
		$data = array('status' =>'Disable' );
		
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
	function update_subscription($subscriptionId,$companyid,$amt,$tx,$sig,$time,$expires,$payer_id,$paymentmethod,$emailflag)
	{
	    $date = date("Y-m-d H:i:s");
		$payment_ip = $_SERVER['REMOTE_ADDR'];
		$data = array(
					'amount'  		=> $amt,
					'txn_id'		=> $tx,
					'payment_date'	=> $date,
					'payment_ip'	=> $payment_ip,
					'expires'		=> $expires,
					'sign'			=> $sig,
					'payer_id'		=> $payer_id,
					'paymentmethod'	=> $paymentmethod,
		);
		$this->db->where(array('subscr_id'=>$subscriptionId,'company_id'=>$companyid));
		$this->db->update('subscription',$data);
		if ($this->db->update('subscription',$data))
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
	
	

}
?>
