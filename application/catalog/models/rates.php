<?php
Class Rates extends CI_Model
{	function get_all_rateexchange($limit ='',$offset='',$sortby = 'interface_exchanges.exchange id',$orderby = 'DESC')
 	{
		switch($sortby)
		{
			case 'exchangename' : $sortby = 'exchangename';break;
			case 'Code' 		: $sortby = 'Code';break;
			default 			: $sortby = 'interface_exchanges.exchangeid';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
			$this->db->select();
			$this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');
			$this->db->join('users','interface_exchanges.userid=users.userid');
			if(base64_decode($this->session->userdata['cry_admin']['roleid'])!=2)
			{
			$this->db->where('userid',base64_decode($this->session->userdata['cry_admin']['userid']));
			}
			$this->db->from('interface_exchanges');
	
			$query = $this->db->get();
		
		if( $limit=='')
		{
			return count($query->result_array());
		}
		else{
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
	
	//Getting Page value for editing
	function get_interface_byid($intid)
 	{
			$this->db->select();
			$this->db->from('interface_exchanges');
			$this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');
			$query = $this->db->where('interfaceexid',$intid);
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
	function get_currency_name($intid)
	{
		 $this->db->select('currencyname');
			$this->db->from('currencydata');
			$query = $this->db->where('currencyid',$intid);
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
	//get exchagnes by interface
function get_interface_exchange()
{
			$userid   = base64_decode($this->session->userdata['cry_admin']['userid']);	
	 		$this->db->select();
			$this->db->from('interface_exhanges');
			$query = $this->db->where('userid',$userid);
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
	
	//for filling dropdown with  currency
function get_currency_from()
{
			$this->db->select();
			$this->db->from('currencydata');
			$query = $this->db->where('status','Enable');
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
function gettodata($id)
{
	
			$this->db->select();
			$this->db->from('currencydata');
			$query = $this->db->where('status','Enable');
			$query = $this->db->where_not_in('currencyid',$id);
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

	
	//insert new Record
	//$intid,$fromcurrency,$tocurrency,$baseprice,$status,$currentprice,$startdate,$enddate,$fees
	
	function update($intid,$interface,$baseprice,$currentprice,$startdate,$enddate,$fees,$memberid='')
 	{
		
		//$createdby   = base64_decode($this->session->userdata['cry_admin']['userid']);
		
		$createdby   = $memberid;//base64_decode($this->session->userdata['cry_admin']['userid']);	
		
		$date = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		$data = array(		
					
							'initial_price' 			=> $baseprice,
							'currentprice'			=>$currentprice,
							'startdatetime'=>date('Y-m-d H:i:s',strtotime($startdate)), 
							'enddatetime'=>date('Y-m-d H:i:s',strtotime($enddate)),
							'fees'=>$fees,
							'updateddate'=>date('Y-m-d H:i:s'),
							'userid'=>$createdby, 
							'updatedip'=>$ip 
						
							//'status'			=>$status 
							
					);
		
		$this->db->where('interfaceexid',$interface);
		if( $this->db->update('interface_exchanges', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
	
 	}
	
	//insert new Record
	//$fromcurrency,$tocurrency,$baseprice,$status,$currentprice,$startdate,$enddate,$fees
	function insert($intid,$interface,$baseprice,$currentprice,$startdate,$enddate,$fees)
 	{
		$createdby   = base64_decode($this->session->rate_exchanges['cry_admin']['userid']);
		$date = date('Y-m-d H:i:s');
		$ip = $_SERVER['REMOTE_ADDR'];
		
		$data = array(		
							'interfaceexid' 		=> $intid,
							'initial_price' 			=> $baseprice,
							'currentprice'			=>$currentprice,
							'startdatetime'=>date('Y-m-d H:i:s',strtotime($startdate)), 
							'enddatetime'=>date('Y-m-d H:i:s',strtotime($enddate)),
							'fees'=>$fees,
							'createddate'=>date('Y-m-d H:i:s'),
							'user_id'=>$createdby 
						
							//'status'			=>$status 
							
					);
	
		
		if( $this->db->insert('exchanges_rates', $data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//delete record
	function delete($intid)
 	{
		$this->db->where('exchangeid', $intid);
		if( $this->db->delete('rate_exchanges'))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	//Changing Status to "Disable"
	function disable_exchange_byid($id)
	{
		$data = array(	'status'	=> 'De-Active' );
		
		$this->db->where('exchangeid', $id);
		if( $this->db->update('rate_exchanges', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_exchange_byid($id)
	{
		$data = array('status'	=> 'Active' );
		$this->db->where('exchangeid', $id);
		if( $this->db->update('rate_exchanges', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//search exchange
	function search_exchange($keyword,$limit='',$offset='',$sortby = 'exchangename',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
	
			$this->db->select();
			$this->db->from('rate_exchanges');
		
			$this->db->where('(exchangename LIKE \'%'.$keyword.'%\') or (exchangecode LIKE \'%'.$keyword.'%\')', NULL, FALSE);
			$query = $this->db->get();	
					
		
		
		if( $limit=='')
		{
			return count($query->result_array());
		}
		else{
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
	
	//Querying to Check E-mail or exchange name is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'exchangecode' 		: $varfield = 'exchangecode';break;
			case 'exchangename' 		: $varfield = 'exchangename';break;
		}
		if($id != 0)
		{
			$option = array( 'exchangeid !=' => $id, $varfield => $fieldvalue );
		}
		else
		{
			$option = array( $varfield => $fieldvalue );
		}
		$query = $this->db->get_where('rate_exchanges', $option);
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
		}
 	}
}
?>