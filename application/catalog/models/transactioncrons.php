<?php
Class Transactioncrons extends CI_Model
{
	
	function get_buyorders($id)
{
	$where=array('interfaceexid'=>$id,
			'ordertype'=>'Buy');
	$this->db->select('base_price,orderamount,ordertotal');
	$this->db->from('user_orders');
	$this->db->where($where);
	 if(($this->session->userdata('interfaceid')!=''))
		 {
		 $this->db->where('interfaceid',$this->session->userdata('interfaceid'));
		 }
	 $this->db->order_by('createddate','desc');
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

function gettotalorders()
{
	
	$this->db->select();
	$this->db->from('user_orders');
	$this->db->where('order_status',0);
	$this->db->where( 'orderamount >',0);
	$this->db->order_by('createddate','desc');
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
//gets sell orders list
function get_sellorders($id)
{		$where=array('interfaceexid'=>$id,
			'ordertype'=>'Sell');
	$this->db->select('base_price,orderamount,ordertotal');
	$this->db->from('user_orders');
	$this->db->where($where);
	 if(($this->session->userdata('interfaceid')!=''))
		 {
		 $this->db->where('interfaceid',$this->session->userdata('interfaceid'));
		 }
	$this->db->order_by('createddate','desc');
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

	//settings value
	function mark_sell_transactions($trnasactionamount,$amount,$transid) 
	{
		$this->db->select();
		$where=array('base_price'=>$trnasactionamount,
					'ordertype'=>'buy',
					'orderamount'=>$amount
		);
		$this->db->where($where);
		 if(($this->session->userdata('interfaceid')!=''))
		 {
		 $this->db->where('interfaceid',$this->session->userdata('interfaceid'));
		 }
		 $this->db->from('user_orders');
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
	
	//settings value
	function get_setting_value($id)
	{
		$this->db->select('value');
		$this->db->from('setting');
		$this->db->where('id',$id);
		
		//Executing Query
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return $result[0]['value'];
		}
		else
		{
			return array();
		}
	}
	
	//get all lastest bids
	function get_all_lastest_bids()
	{
		$this->db->select('id,bidby,categoryid,productid,price,
						   quantity,transaction_quantity');
		$this->db->from('bid');
		$this->db->where('status','Open');
		
		//Executing Query
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
	
	//find all suitble offers for similar bids
	function find_all_suitble_offers($categoryid,$productid,$price)
	{
		$this->db->select('id,offerby,categoryid,productid,
						   price,quantity,transaction_quantity');
		$this->db->from('offer');
		$this->db->where('offerstart <',date("Y-m-d H:i:s"));
		$this->db->where('offerend >',date("Y-m-d H:i:s"));
		$this->db->where('productid ',$productid);
		$this->db->where('categoryid ',$categoryid);
		$this->db->where('price ',$price);
		$this->db->order_by('offerend','DESC');
		$this->db->where('status','Open');
		
		//Executing Query
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
	
	function add_transaction($bidid,$bid_commission,$price,$quantity,$offerid,$offer_commission,$unique_id)
	{
		$data = array('bidid'			=>	$bidid,
					  'bid_commission'	=>	$bid_commission,
					  'price'			=>	$price,
					  'quantity'		=>	$quantity,
					  'offerid'			=>	$offerid,
					  'offer_commission'=>	$offer_commission,
					  'transaction_id'=>	$unique_id,
					  'transdate'		=> date("Y-m-d H:i:s")
		);
		
		//Executing Query
		if ($this->db->insert('transaction',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//update bid
	function update_bid($bidid,$transaction_quantity,$status)
	{
		
		
		$data = array('transaction_quantity'	=>	$transaction_quantity,
					  'status'					=>	$status,
					  		);
		
		//Executing Query
		$this->db->where('id',$bidid);
		if ($this->db->update('bid',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//update offer
	function update_offer($offerid,$transaction_quantity,$status)
	{
		$data = array('transaction_quantity'	=>	$transaction_quantity,
					  'status'					=>	$status,
					  		);
		
		//Executing Query
		$this->db->where('id',$offerid);
		if ($this->db->update('offer',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//update offer
	function update_member($userid,$total,$case)
	{
		if($case=='bid')
		{
			$this->db->query("update tp_member set ewallet = ewallet - ".$total." where id='".$userid."' ");
		}
		else
		{
			$this->db->query("update tp_member set ewallet = ewallet + ".$total." where id='".$userid."' ");
		}
	}
	
	//get user
	function get_member($userid)
	{
		$this->db->select('firstname,lastname,email');
		$this->db->from('member');
		$this->db->where('id',$userid);
		$this->db->where('status','Enable');
		
		//Executing Query
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	//get email format
	function get_email_byid($id)
	{
		$this->db->select('*');
		$this->db->from('email');
		$this->db->where('id',$id);
				
		//Executing Query
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
		
	
	}
	
	//bid history
	function add_bid_history($bidid,$quantity)
	{
		$data = array('bidid'		=>	$bidid,
					  'quantity'	=>	$quantity,
					  'date'		=> date("Y-m-d H:i:s")
		);
		
		//Executing Query
		if ($this->db->insert('bid_history',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//offer history
	function add_offer_history($offerid,$quantity)
	{
		$data = array('offerid'		=>	$offerid,
					  'quantity'	=>	$quantity,
					  'date'		=> date("Y-m-d H:i:s")
		);
		
		//Executing Query
		if ($this->db->insert('offer_history',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//get category
	function get_category($categoryid)
	{
		$this->db->select('category');
		$this->db->from('category');
		$this->db->where('id',$categoryid);
				
		//Executing Query
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	//get product
	function get_product($productid)
	{
		$this->db->select('product_name');
		$this->db->from('product');
		$this->db->where('id',$productid);
				
		//Executing Query
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	//get lastest bids which have same transaction_quantity and	quantity
	function get_bids()
	{
		//Executing Query
		$query = $this->db->query("select id,transaction_quantity from tp_bid where quantity=transaction_quantity");		
		
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	//get lastest offers which have same transaction_quantity and	quantity
	function get_offers()
	{
		//Executing Query
		$query = $this->db->query("select id,transaction_quantity from tp_offer where quantity=transaction_quantity");		
		
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
	}
	function get_suitable_transaction_sell($baseprice,$orderamount,$transactionid)
	{
		$this->db->select();
		$where=array('base_price'=>$baseprice,
					 'orderamount >'=>0,
					 'ordertype'=>'Sell',
					 'order_status'=>0
					);
		$this->db->where($where);
		$query=$this->db->get('user_orders');
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_suitable_transaction_buy($baseprice,$orderamount,$transactionid)
	{
	
		$this->db->select();
	$where=array('base_price'=>$baseprice,
					 'orderamount >'=>0,
					 'ordertype'=>'Buy',
					 'order_status'=>0
					);
		$this->db->where($where);
				
		$query=$this->db->get('user_orders');
		if ($query->num_rows() > 0)
		{
			return $result = $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function update_currenttrans($price,$quantity,$ini_qty,$dedudected_qty,$offerid,$bidby,$ordertype,$status,$fees)
	{
		$totalfees=(($fees*$quantity)/100);
		$order_total=($price*$quantity);
		$where=array('base_price'=>$price,
					 'orderamount'=>$quantity,
					 //'ordertype'=>$ordertype,
					 'order_status'=>$status,
					 'updateddate'=>date('Y-m-d H:i:s'),
					 'initial_qty'=>$ini_qty,
					 'dedudected_qty'=>$dedudected_qty,
					 'offer_id'=>$offerid,
					 'ordertotal'=>$order_total,
					 'feeschargedtotal'=>$totalfees,
					
					);
	
		$this->db->where('order_id',$bidby);
		if($this->db->update('user_orders',$where))
		{
			return true;
		}
		else
		{
			return false;
		}
		
		
	
			
	}
	function update_suitabletrans($price,$suitable_quantity,$ini_qty,$dedudected_qty,$offerid,$offerby,$suitable_ordertype,$status,$fees)
	{
		$totalfees=(($fees*$suitable_quantity)/100);
		$order_total=($price*$suitable_quantity);
		$where=array('base_price'=>$price,
					 'orderamount'=>$suitable_quantity,
					// 'ordertype'=>$suitable_ordertype,
					 'order_status'=>$status,
					 'initial_qty'=>$ini_qty,
					 'dedudected_qty'=>$dedudected_qty,
					 'offer_id'=>$offerid,
					 'updateddate'=>date('Y-m-d H:i:s'),
					  'ordertotal'=>$order_total,
					 'feeschargedtotal'=>$totalfees,
					
					);
	
		$this->db->where('order_id',$offerby);
		if($query=$this->db->update('user_orders',$where))
		
		{
			
		
			return true;
		}
		else
		{
			return false;
		}
		
			
	}
	
	function get_user_byid($intid)
 	{
			$this->db->select('users.userid,users.roleid,username,users.loginsecretkey,users.password,email,users.alternateemail,firstname,lastname,contactno,address,dob,usersprofile.companyname,users.status,users.domainname,users.isdomain,users.interfacelogo,users.interfacename');
			$this->db->from('users');
			$this->db->join('usersprofile','users.userid=usersprofile.userid','left');
			$query = $this->db->where('users.userid',$intid);
			$query = $this->db->get();
			
		//$query=$this->db->query("CALL user_selectbyuserid('".$intid."')");
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

	//update user main balance
	function update_user_main_balances($userid,$currencycode,$amount,$case)
	{
		if($case=='add')
		{
			$this->db->select();
			$this->db->from('user_balance_main');
			$this->db->where('user_balance_main.userid',$userid);
			$this->db->where('user_balance_main.currencycode',$currencycode);
			$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$main_array = $query->result_array();
			
			$old_balance = $main_array[0]['total_balance'];
			
			$new_balance = $old_balance+$amount;
			
			//update record
			$array = array('total_balance'=>$new_balance );
			$this->db->where('balanceid',$main_array[0]['balanceid']);
			
			if($query=$this->db->update('user_balance_main',$array))
			{
				echo $this->db->last_query();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
 	
	}
		
		if($case=='ded')
		{
			$this->db->select();
			$this->db->from('user_balance_main');
			$this->db->where('user_balance_main.userid',$userid);
			$this->db->where('user_balance_main.currencycode',$currencycode);
			$query = $this->db->get();
			
		if ($query->num_rows() > 0)
		{
			$main_array = $query->result_array();
			
			$old_balance = $main_array[0]['total_balance'];
			
			$new_balance = $old_balance-$amount;
			
			//update record
			$array = array('total_balance'=>$new_balance );
			$this->db->where('balanceid',$main_array[0]['balanceid']);
			
			if($query=$this->db->update('user_balance_main',$array))
			{
				echo $this->db->last_query();
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
 	
	}	
//function for getting total refferral commission
}	
function get_user_commission($userid)
{
			$this->db->select_sum('commission');
			$this->db->select('userid');
			$this->db->from('user_commissions');
			$this->db->where('registerid',$userid);
						$this->db->join('usersprofile','usersprofile.userid=user_commissions.registerid','left');
			$this->db->where('usersprofile.mobnumverified','Yes');

			$query=$this->db->get();
			if ($query->num_rows() > 0)
				{
				$data=$query->result_array();
				if($data[0]['commission']!='')
				{
					return $data[0]['commission'];
				}
				else
				{
					return 0.00;
				}
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
				}
			else
				{
			return array();
			}

	
	}
	function get_user_commissionval($userid)
{
			//$this->db->select_sum('commission');
			$this->db->select('user_commissions.commission,user_commissions.userid,user_commissions.registerid');
			$this->db->from('user_commissions');
			$this->db->join('usersprofile','usersprofile.userid=user_commissions.registerid','left');
			$this->db->where('usersprofile.mobnumverified','Yes');
			$this->db->where('registerid',$userid);
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
			

	function insert_fees($orderid,$userid,$fees,$interfaceid='')		
	{
		$data=array('orderid'=>$orderid,'userid'=>$userid,'interfaceid'=>$interfaceid,'insertip'=>$_SERVER['REMOTE_ADDR'],'fees'=>$fees);
		$this->db->insert('admin_fees_history',$data);
	}
	
	function insert_refferral($orderid,$A_earnedcommission,$bidcommissionamount,$userid,$byuserid)
	{
		$data=array('orderid'=>$orderid,'earnedcommission'=>$A_earnedcommission,'commissionamount'=>$bidcommissionamount,'insertip'=>$_SERVER['REMOTE_ADDR'],'userid'=>$userid,'earnedbyuser'=>$byuserid);
		$this->db->insert('user_commissions_history',$data);
	
	}
	
	function get_fees_user($userid)
{
	//$userid=$this->session->userdata['cc_user']['userid'];
	$where=array('userid'=>$userid);
	$this->db->select();
	$this->db->where($where);
	$this->db->from('users');
	$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
			$data=$query->result_array();
			return $data[0]['Fees'];
			
			//$query->next_result(); // Dump the extra resultset.
  			//$query->free_result(); // Does what it says.
		}
		else
		{
			return array();
		} 
}

//function for the update_balance
function update_balance($userid,$currency,$amount)
{
	$balance=$this->get_balance__byuser($userid,$currency);
	$total=$balance+$amount;
	$where=array('userid'=>$userid,'currencycode'=>$currency);
	$this->db->where($where);
	$this->db->update('user_balance_main',array('total_balance'=>$total,'last_balance'=>$balance));
}

function get_balance__byuser($userid,$currency)
{
	$this->db->select('total_balance');
	$this->db->where('currencycode',$currency);
	$this->db->where('userid',$userid);
	$this->db->from('user_balance_main');
	
	$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$data=$query->result_array();
			if(count($data>0))
			return $totalbal=$data[0]['total_balance'];
			
		}
		else
		{
			return $totalbal= 0;
		}

}

function get_orderbyid($id)
{
	$this->db->select();
	$this->db->from('user_orders');
	$this->db->where('order_id',$id);
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
}
?>