<?php class Users extends CI_Model
{
	//Inserting Record
	function insert($uniqueid,$username,$email,$password,$dob,$state,$gender,$referalcode)
	{
		//$password = strrev($password);
		$password = strrev(base64_encode($password));
		
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'uniqueid'		=> $uniqueid,
							'roleid'		=> 0,
							'username' 	    => $username,
							'password' 		=> $password,
							'email' 		=> $email,
							'gender'		=> $gender,
							'createddate'	=> $date,
							'createdip'		=> $varipaddress,
							'referalcode'=>$referalcode, 
							'status'		=> 'De-Active',
							);

		if( $this->db->insert('users', $data) )
		{
			$data1 = array(
							'userid' 	    => $this->db->insert_id(),
							'dob' 			=> $dob,
							'stateid'		=> $state,
							'createddate'	=> $date,
							'createdip'		=> $varipaddress,
							'status'		=> 'Enable',
							);
			$this->db->insert('usersprofile', $data1) ;
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//upload document
	
	
	function user_documents($userid,$title,$doc,$interfaceid,$doctype)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'userid' 	    		=> $userid,
						'title' 				=> $title,
						'userdocumentfiletitle' => $doc,
						'isvarified' 			=> "No",
						'createddate'			=> $date,
						'createdip'				=> $varipaddress,
						'doctype'				=> $doctype,
						'interface'				=> $interfaceid,	
							
							);

		if( $this->db->insert('userdocuments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//Getting value for editing
	function get_user_byid($id)
 	{
		$this->db->select('u.username,u.password,u.email,
						   u.alternateemail,u.gender,u.domainname,
						   u.subdomainname,u.interfacename,
						   u.interfacelogo,u.isdomain,
						   u.otpcode,u.loginsecretkey,u.status,
						   us.firstname,us.lastname,us.contactno,
						   us.address,us.dob,us.countryid,
						   us.stateid,us.cityid,
						   us.zipcodeid,us.companyname,us.contactno,
						   us.mobnumverified
						   ');
		$this->db->from('users u');
		$this->db->join('usersprofile us','u.userid=us.userid');
		$this->db->where('u.userid',$id);
		$this->db->where('u.status','Active');
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
	
	//Get doc to download
	function get_doc_byid($userid,$userdocumentid)
 	{
		$this->db->select('userdocumentfiletitle,doctype,title,createddate');
		$this->db->from('userdocuments u');
		$this->db->where('u.userid',$userid);
		$this->db->where('u.userdocumentid',$userdocumentid);
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
	
	//Updating Record
	function update($id,$firstname,$lastname,$email,$alternateemail,$dob,$address,$country,$state,$city,$zipcode,$gender,$companyname,$contactnumber)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'email' 		=> $email,
							'alternateemail'=> $alternateemail,
							'gender'		=> $gender,
							'modifieddate'	=> $date,
							'modifiedip'		=> $varipaddress,
					 );

		$this->db->where('userid', $id);
		if( $this->db->update('users', $data) )
		{
			$data1 = array(
							'firstname' 	=> $firstname,
							'lastname'		=> $lastname,
							'address'		=> $address,
							'dob'			=> $dob,
							'countryid'		=> $country,
							'stateid'		=> $state,
							'cityid'		=> $city,
							'zipcodeid'		=> $zipcode,
							'companyname'	=> $companyname,
							'contactno'		=> $contactnumber,
 							'modifieddate'	=> $date,
							'modifiedip'		=> $varipaddress,
					 );

		$this->db->where('userid', $id);
		$this->db->update('usersprofile', $data1) ;
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Updating Password
	function update_password($id,$newpassword)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'password'		=> $newpassword,
						'modifiedip' 	=> $varipaddress,
						'modifieddate'	=> $date
					);

		$this->db->where('userid', $id);
		if( $this->db->update('users', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Changing Status to "Enable"
	function enable_user_byuniqueid($uniqueid)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'	=> 'Active',
							'modifiedip' 	=> $vareditip,
							'modifieddate'	=> $date_edit
						);
		$this->db->where('uniqueid', $uniqueid);
		if( $this->db->update('users', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Querying to Check E-mail or User name is already exists
	function chkfield($userid,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'email' 		: $varfield = 'email';break;
			case 'username' 	: $varfield = 'username';break;
		}
		if($userid != 0)
		{
			$option = array( 'userid !=' => $userid, $varfield => $fieldvalue );
		}
		else
		{
			$option = array( $varfield => $fieldvalue );
		}
		$query = $this->db->get_where('users', $option);
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
		}
 	}
	
	function setoptcode($id,$code)
	{
		$date = date('Y-m-d H:i:s');
		$data = array(		'otpcode'    => $code,
							'user_id'    => $id,
							'createddate'=>$date
			);
		if($this->db->insert('user_otpcode_history',$data) )
		{
			return true;
		}
		else
		{
			return false;
			
		}
	}
	
	function get_userdocuments_byuserid($id)
 	{
		$this->db->select('userdocumentid,createddate,userid,
							title,userdocumentfiletitle,
								isvarified,doctype,interface,remindermail');
		$this->db->from('userdocuments');
		$this->db->where('userid',$id);
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
	//will insert referal codes 
	
	function insert_referals($user_refid,$registerid,$refcode,$commissionfees)
	{
		$where=array('userid'=>$user_refid,'registerid'=>$registerid,'referalcode'=>$refcode,
		'createddate'=>date('Y-m-d H:i:s'),'commission'=>$commissionfees,'status'=>0
		);
		if($this->db->insert('user_commissions',$where))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//will get user id last inserted
	function get_userid($id)
	{
		$this->db->select();
		$this->db->where('userprofileid', $id);
		$this->db->from('usersprofile');
		$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
			$arr=$query->result_array();
			return $arr[0]['userid'];
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	//function for getting list of refferals 
	function get_referrals()
	{
		 $this->db->select();
		 $this->db->where('user_commissions.userid',$this->session->userdata['cc_user']['userid']);
		 $this->db->join('users','users.userid=user_commissions.registerid','left');
		 $this->db->from('user_commissions');
		 $query=$this->db->get();
		 if ($query->num_rows() > 0)
		{
	
			return $query->result_array();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	
	//
	function get_currency()
	{
		$this->db->select();
		$this->db->where('status','Enable');
		$query=$this->db->get('currencydata');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	//forn inserting balance 
	function insert_currency_balance($registerid,$currencyid,$currencycode)
	{
			$data=array('currencyid'=>$currencyid,'currencycode'=>$currencycode,'userid'=>$registerid,'total_balance'=>0,'last_balance'=>0);

				$this->db->insert('user_balance_main',$data);
				
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
	}
	
	function user_getbalance()
	{
		$this->db->select();
		$this->db->where('userid',$this->session->userdata['cc_user']['userid']);
		$this->db->from('user_balance_main');
		$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function get_totaltrans_orders($currencyid)
	{
	 
		$this->db->select_sum('user_orders.ordertotal');
		$this->db->from('user_orders');
		$this->db->join('interface_exchanges','user_orders.interfaceexid=interface_exchanges.interfaceexid');
		$this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');	
		$this->db->where('exchanges.fromcurrencyid',$currencyid);
		$this->db->where('user_orders.ordertype','Buy');
		$this->db->where('user_orders.userid',$this->session->userdata['cc_user']['userid']);
		$query=$this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$data=$query->result_array();
			$datasum=$data[0]['ordertotal'];
		}
		
		$this->db->select_sum('user_orders.ordertotal');
		$this->db->from('user_orders');
		$this->db->join('interface_exchanges','user_orders.interfaceexid=interface_exchanges.interfaceexid');
		$this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');	
		$this->db->where('exchanges.tocurrencyid',$currencyid);
		$this->db->where('user_orders.ordertype','Buy');
		$this->db->where('user_orders.userid',$this->session->userdata['cc_user']['userid']);
		$query=$this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$data1=$query->result_array();
			$datasum1=$data1[0]['ordertotal'];
		}
		$sum=floatval($datasum1+$datasum);
		if($sum>0)
		{
		return floatval($datasum1+$datasum);
		}
		else
		{
		return "0.00000";
		}
		
	}
	function withdrawal($balid,$amount,$lastamt)
		{
			$where=array(
			'total_balance'=>$amount,
			'last_balance'=>$lastamt
			);
			 
			$this->db->where('balanceid',$balid);
			if($this->db->update('user_balance_main',$where))
			{
				return true;
			}
			else
			{
				return false;
			}
			
	}
		
		function withdrawal_history($balanceid,$total_avail,$eaddress)
		{
			$where=array(
				'balanceid'=>$balanceid,
				'withdrawalamount'=>$total_avail,
				'userid'=>$this->session->userdata['cc_user']['userid'],
				'eaddress'=>$eaddress
			);
		if($this->db->insert('user_withdrawal_history',$where))
		{
				return true;
			}
			else
			{
				return false;
			}
		}
	function send_message($messagebody,$userid=0)
	{
		$where=array('from_user'=>$this->session->userdata['cc_user']['userid'],'to_user'=>$userid,'mcreateddate'=>date('Y-m-d H:i:s'),'message_body'=>$messagebody);
		if($this->db->insert('user_chat',$where))
		{
			return true;
		}
		else
		{
			return false;
		}
		
		
		
	}
	
	function get_all_messages()
	{
	$userid=$this->session->userdata['cc_user']['userid'];
	$where=array('to_user'=>$userid);
	$this->db->select();
	$this->db->where($where);
	$this->db->from('user_chat');
	$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
			
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	function adddeposit($depamt,$balid,$lastbal)
	{
		
		   
			$userid=$this->session->userdata['cc_user']['userid'];
			$final=$lastbal+$depamt;		
			$where=array(
			'total_balance'=>$final,
			);
			 
			$this->db->where('balanceid',$balid);
			if($this->db->update('user_balance_main',$where))
			{
				
				$where2=array("userid"=>$userid,"amount"=>$final,"balanceid"=>$balid);
				$this->db->insert('user_deposit_history',$where2);
				return true;
			}
			else
			{
				return false;
			}
			
	}
	function markasread($chatid)
	{
		$where=array(
			'chat_status'=>1,
			);
			 
			$this->db->where('balanceid',$chatid);
			if($this->db->update('user_chat',$where))
			{
				return true;
			}
			else
			{
				return false;
			}
	}
	function get_count_unread()
	{
	$userid=$this->session->userdata['cc_user']['userid'];
	$where=array('to_user'=>$userid);
	$this->db->select();
	$this->db->where($where);
	$this->db->from('user_chat');
	$query = $this->db->get();
	return $rowcount = $query->num_rows();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		


	}
	
	//update doc
	function update_doc($userdocumentid)
 	{
		$data = array(
						'remindermail'		=> 'Yes',
						
					);

		$this->db->where('userdocumentid', $userdocumentid);
		if( $this->db->update('userdocuments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function get_lastest_otp_code()
	{
		$userid=$this->session->userdata['cc_user']['userid'];
		$where=array('user_id'=>$userid);
		$this->db->limit(1);
		$this->db->select('otpcode');
		$this->db->where($where);
		$this->db->from('user_otpcode_history');
		$this->db->order_by('createddate','DESC');
		
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
	function update_verify_mobtstatus($uid)
 	{
		$data = array(
						'mobnumverified'		=> 'Yes',
						
					);

		$this->db->where('userid', $uid);
		if( $this->db->update('usersprofile', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function user_ordersactive()
	{
		 $this->db->select();
		 $this->db->where('userid',$this->session->userdata['cc_user']['userid']);
		 $this->db->where('order_status',1);
		 $this->db->from('user_orders');
		 $query=$this->db->get();
		 if ($query->num_rows() > 0)
		{
	
			return $query->result_array();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	function user_orders()
	{
		 $this->db->select();
		 $this->db->where('userid',$this->session->userdata['cc_user']['userid']);
		 $this->db->where('order_status',0);
		 $this->db->from('user_orders');
		 $query=$this->db->get();
		 if ($query->num_rows() > 0)
		{
	
			return $query->result_array();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	function user_ordersbuy()
	{
		 $this->db->select();
		 $this->db->where('userid',$this->session->userdata['cc_user']['userid']);
		 $this->db->where('order_status',0);
		 $this->db->where('ordertype','buy');
		 $this->db->from('user_orders');
		 $query=$this->db->get();
		 if ($query->num_rows() > 0)
		{
	
			return $query->result_array();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	function user_orderssell()
	{
		 $this->db->select();
		 $this->db->where('userid',$this->session->userdata['cc_user']['userid']);
		 $this->db->where('order_status',0);
		 $this->db->where('ordertype','sell');
		 $this->db->from('user_orders');
		 $query=$this->db->get();
		 if ($query->num_rows() > 0)
		{
	
			return $query->result_array();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	
	function user_deposits()
	{
		// $this->db->select('user_deposit_history.dcreateddate,user_deposit_history.amount as newamt,user_balance_main.total_balance,user_balance_main.currencycode');
		 $this->db->select();
		 $this->db->where('user_balance_main.userid',$this->session->userdata['cc_user']['userid']);
		 $this->db->join('user_balance_main','user_balance_main.balanceid=user_deposit_history.balanceid','left');
		 $this->db->from('user_deposit_history');
		 $query=$this->db->get();
		 if ($query->num_rows() > 0)
		{
	
			return $query->result_array();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}
	
	function user_withdrawal()
	{
		 $this->db->select();
		 $this->db->where('user_balance_main.userid',$this->session->userdata['cc_user']['userid']);
		 $this->db->join('user_balance_main','user_balance_main.balanceid=user_withdrawal_history.balanceid','left');
		 $this->db->from('user_withdrawal_history');
		 $query=$this->db->get();
		 if ($query->num_rows() > 0)
		{
	
			return $query->result_array();
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		}
	}

	
}
