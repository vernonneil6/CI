<?php
Class Homes1 extends CI_Model
{
	//this will list all exchanges
	function get_exchanges()
	{
		 $this->db->select();
		 $this->db->from('interface_exchanges');
		 $this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');
		 $this->db->group_by('exchanges.exchangeid');
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
	//function gets get_low_price
	function get_low_price($id)
	{

		
	  $query=$this->db->query("SELECT MIN(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and order_status=0 order by order_id desc");
	
	$d=$query->result_array();
	return $d[0]['newprice'];
	
	}
		//function gets get_Max_price
	function get_high_price($id)
	{

		
	  $query=$this->db->query("SELECT MAX(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."'  and order_status=0 order by order_id desc");
	
	
	$d=$query->result_array();
	return $d[0]['newprice'];
	
	}
	
	
		//function gets get_Max_price
	function get_dailyvolume($id)
	{

	
	  $query=$this->db->query("SELECT SUM(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."'  and order_status=0 and DATE(createddate) = DATE(NOW()) order by order_id desc");
	
	$d=$query->result_array();
	return $d[0]['newprice'];
	
	}
	function get_first_exchanges()
	{
		$this->db->select();
		 $this->db->from('interface_exchanges');
		 $this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');
		 $this->db->limit(1);
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
	//get_exchange_price
	function get_exchange_price($intid)
	{
		  $this->db->select();
		 $this->db->from('interface_exchanges');
		 $this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');
		$this->db->where('interface_exchanges.interfaceexid',$intid);
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
	//for buy currency
	function buycurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid)
	{

		$data=array(
		'userid'=>1,
		'base_price'=>$base_price,
		'orderamount'=>$buyamount,
		'ordertotal'=>$buytotaltext,
		'feeschargedtotal'=>$feescalculationtext,
		'baseprice'=>$buybasecurrency,
		'interfaceexid'=>$interfaceexid,
		'createddate'=>date('Y-m-d H:i:s'),
		'ordertype'=>'Buy',
		'createdip'=>$_SERVER['REMOTE_ADDR']
		);
		if($this->db->insert('user_orders',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	function sellcurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid)
	{
		
		$data=array(
		'userid'=>1,
		'base_price'=>$base_price,
		'orderamount'=>$buyamount,
		'ordertotal'=>$buytotaltext,
		'feeschargedtotal'=>$feescalculationtext,
		'baseprice'=>$buybasecurrency,
		'interfaceexid'=>$interfaceexid,
		'createddate'=>date('Y-m-d H:i:s'),
		'ordertype'=>'Sell',
		'createdip'=>$_SERVER['REMOTE_ADDR']
		);
		if($this->db->insert('user_orders',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	//get list of buy orders
function get_buyorders($id)
{
	$where=array('interfaceexid'=>$id,
			'ordertype'=>'Buy');
	$this->db->select('base_price,orderamount,ordertotal');
	$this->db->from('user_orders');
	$this->db->where($where);
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
//for getting sum of totaL buy
function get_totalbuy($id)
{
	$sql="SELECT CAST( sum( `orderamount` ) AS DECIMAL(10,4) ) AS totalbuy
FROM user_orders where interfaceexid='".$id."' and ordertype='Buy' and order_status=0";
	$query=$this->db->query($sql);
	
	if ($query->num_rows() > 0)
		{
			 $arr=$query->result_array();
			 return $arr[0]['totalbuy'];
		}
		else
		{
			return array();
		}
}
//for getting sum of totaL sell
function get_totalsell($id)
{
	$sql="SELECT CAST( sum( `orderamount` ) AS DECIMAL(10,4) ) AS totalsell
FROM user_orders where interfaceexid='".$id."' and ordertype='Sell' and order_status=0";
	$query=$this->db->query($sql);
	if ($query->num_rows() > 0)
		{
			 $arr=$query->result_array();
			 return $arr[0]['totalsell'];
		}
		else
		{
			return array();
		}
}
	//for getting currency name
	function get_currency_name($intid)
	{
		 $this->db->select();
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
	//set average price

public function set_price_buy($id)
{
	$this->db->select();
	$count_where=array('interfaceexid'=>$id,'ordertype'=>'Buy');
	$this->db->from('user_orders');
	$this->db->where($count_where);
	
	$count=$this->db->count_all_results();
	
	if($count<40)
	{
		
	  $query=$this->db->query("SELECT avg(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and `ordertype`='Buy'");
	}
	else
	{
		
	  $query=$this->db->query("SELECT avg(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and `ordertype`='Buy' order by order_id desc limit 40");
	}
	$d=$query->result_array();
	return $d[0]['newprice'];

}
public function set_price_sell($id)
{
	$this->db->select();
	$count_where=array('interfaceexid'=>$id,'ordertype'=>'Buy');
	$this->db->from('user_orders');
	$this->db->where($count_where);
	
	$count=$this->db->count_all_results();
	
	if($count<40)
	{
		
	  $query=$this->db->query("SELECT avg(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and `ordertype`='Sell' and order_status=0");
	}
	else
	{
		
	  $query=$this->db->query("SELECT avg(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and `ordertype`='Sell' and order_status=0 order by order_id desc limit 40");
	}
	$d=$query->result_array();
	return $d[0]['newprice'];

}
function set_main_price($id)
{
	  $query=$this->db->query("SELECT avg(CAST( `base_price` AS UNSIGNED )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and order_status=0");
$d=$query->result_array();
	return $d[0]['newprice'];
	
	
}
//check subdomin 
function validatesubdomain($domainname)
{
	 $this->db->select();
	 $where=array('subdomainname'=>$domainname);
	 
	 $this->db->where($where);
	 $this->db->from('users');
	 $query=$this->db->get();
	 if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return "no";
		}
	 
}
	
function update_price($id,$price)
{
	$update=array('currentprice'=>$price);
	$this->db->where('interfaceexid',$id);
	$this->db->update('interface_exchanges',$update);

}
	//Querying to Check URL Keyword is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		
		
		switch($field)
		{
			case 'link' 		: $varfield = 'uniquename';break;
		}
		if($id != 0)
		{
			$option = array( 'cmspageid !=' => $id, $varfield => $fieldvalue );
		}
		else
		{
			$option = array( $varfield => $fieldvalue );
		}
		$query = $this->db->get_where('cmspage', $option);
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