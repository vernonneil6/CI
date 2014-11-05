<?php
Class Homes extends CI_Model
{
	//this will list all exchanges
	function get_exchanges()
	{
		 $this->db->select();
		 $this->db->from('interface_exchanges');
		 $this->db->join('exchanges','exchanges.exchangeid=interface_exchanges.exchangeid');
		 $this->db->where('status','Active');
		 $this->db->group_by('exchanges.exchangeid');
		 if(($this->session->userdata('interfaceid')!=''))
		 {
			 $this->db->where('userid',$this->session->userdata('interfaceid'));
		 }
		 else
		 {
			 $this->db->where('userid','0');	 
		 }
		 $this->db->where('currentprice !=','');
		 $this->db->order_by('interface_exchanges.interfaceexid','desc');
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
		 if(($this->session->userdata('interfaceid')!=''))
		 {
			   $query=$this->db->query("SELECT MIN(CAST( `base_price` AS decimal(6,3) )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and order_status=0 and interfaceid='".$this->session->userdata('interfaceid')."' order by order_id desc");
			
		 }
		 else
		 {
			
		  $query=$this->db->query("SELECT MIN(CAST( `base_price` AS decimal(6,3) )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."' and order_status=0 order by order_id desc"); 
		 }
		
	  
	
	$d=$query->result_array();
	if(!empty($d))
	{
	return $d[0]['newprice'];
	}
	
	}
		//function gets get_Max_price
	function get_high_price($id)
	{

		if(($this->session->userdata('interfaceid')!=''))
		 {
			 $query=$this->db->query("SELECT MAX(CAST( `base_price` AS decimal(6,3) )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."'  and order_status=0 and interfaceid='".$this->session->userdata('interfaceid')."' order by order_id desc");
			 
			
		 }
		 else
		 {
	  $query=$this->db->query("SELECT MAX(CAST( `base_price` AS decimal(6,3) )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."'  and order_status=0 order by order_id desc");
	
		 }
	$d=$query->result_array();
	if(!empty($d))
	{
	return $d[0]['newprice'];
	}
	
	}
	//get last price
	function get_last_price($id)
	{

		if(($this->session->userdata('interfaceid')!=''))
		 {
			   $this->session->userdata('interfaceid');
			 $query=$this->db->query("SELECT (CAST( `base_price` AS decimal(6,3) )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."'  and order_status=0 and interfaceid='".$this->session->userdata('interfaceid')."' order by createddate desc limit 1");
			 
			
		 }
		 else
		 {
		$query=$this->db->query("SELECT (CAST( `base_price` AS decimal(6,3) )
) AS newprice FROM `user_orders` where `interfaceexid`='".$id."'  and order_status=0  order by order_id desc limit 1");
		 }
	$d=$query->result_array();
	if(!empty($d))
	{
	return $d[0]['newprice'];
	}
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
		 $this->db->where('status','Active');
		 $this->db->where('userid',0);
		 $this->db->order_by('interfaceexid','desc');
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
	function buycurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency)
	{
		$id = $this->session->userdata['cc_user']['userid'];
		$data=array(
		'userid'=>$id,
		'base_price'=>$base_price,
		'orderamount'=>$buyamount,
		'ordertotal'=>$buytotaltext,
		'feeschargedtotal'=>$feescalculationtext,
		'baseprice'=>$buybasecurrency,
		'interfaceexid'=>$interfaceexid,
		'createddate'=>date('Y-m-d H:i:s'),
		'interfaceid'=>$interface,
		'ordertype'=>'Buy',
		'createdip'=>$_SERVER['REMOTE_ADDR'],
		'currencycode'=>$currency
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
	function sellcurrency($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency)
	{
		
		$id = $this->session->userdata['cc_user']['userid'];
		$data=array(
		'userid'=>$id,
		'base_price'=>$base_price,
		'orderamount'=>$buyamount,
		'ordertotal'=>$buytotaltext,
		'feeschargedtotal'=>$feescalculationtext,
		'baseprice'=>$buybasecurrency,
		'interfaceid'=>$interface,
		'interfaceexid'=>$interfaceexid,
		'createddate'=>date('Y-m-d H:i:s'),
		'ordertype'=>'Sell',
		'createdip'=>$_SERVER['REMOTE_ADDR'],
		'currencycode'=>$currency
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
	
		function buycurrencystd($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency)
	{
		$id = $this->session->userdata['cc_user']['userid'];
		$data=array(
		'userid'=>$id,
		'base_price'=>$base_price,
		'orderamount'=>$buyamount,
		'ordertotal'=>$buytotaltext,
		'feeschargedtotal'=>$feescalculationtext,
		'baseprice'=>$buybasecurrency,
		'interfaceexid'=>$interfaceexid,
		'createddate'=>date('Y-m-d H:i:s'),
		'interfaceid'=>$interface,
		'ordertype'=>'Buy',
		'createdip'=>$_SERVER['REMOTE_ADDR'],
		'currencycode'=>$currency
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
	function sellcurrencystd($base_price,$buyamount,$buytotaltext,$feescalculationtext,$buybasecurrency,$interfaceexid,$interface,$currency)
	{
		
		$id = $this->session->userdata['cc_user']['userid'];
		$data=array(
		'userid'=>$id,
		'base_price'=>$base_price,
		'orderamount'=>$buyamount,
		'ordertotal'=>$buytotaltext,
		'feeschargedtotal'=>$feescalculationtext,
		'baseprice'=>$buybasecurrency,
		'interfaceid'=>$interface,
		'interfaceexid'=>$interfaceexid,
		'createddate'=>date('Y-m-d H:i:s'),
		'ordertype'=>'Sell',
		'createdip'=>$_SERVER['REMOTE_ADDR'],
		'currencycode'=>$currency
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
			'ordertype'=>'Buy',
			'order_status'=>0);
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
//gets sell orders list
function get_sellorders($id)
{		$where=array('interfaceexid'=>$id,
			'ordertype'=>'Sell',
			'order_status'=>0);
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
//for getting sum of totaL buy
function get_totalbuy($id)
{
	 $sql="SELECT CAST( sum( `ordertotal` ) AS decimal(10,4) ) AS totalbuy
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
	  $query=$this->db->query("SELECT avg(( `base_price`)
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
			return "yes";
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
	//check_otpcode
		function check_otpcode($otp,$id)
	{
	$this->db->select();
	$this->db->from('user_otpcode_history');
	$where=array(
			'user_id'=>$id,
			'otpcode'=>$otp
	);
	$this->db->where($where);
	$query=$this->db->get();
		if ($query->num_rows() > 0)
		{
			return 'yes';
		}
		else
		{
			return 'no';
		}
	
	}
	//get lowest buy 
	function get_lowest_price($id)
{
	  $query=$this->db->query("SELECT min(base_price) as base_price  FROM `user_orders` where `interfaceexid`='".$id."' and order_status=0 and ordertype='buy' order by createddate desc");
$d=$query->result_array();
if(!empty($d))
return $d[0]['base_price'];
	
	
}
//get higest price
	function get_higest_price($id)
	{
	  $query=$this->db->query("SELECT max(base_price) as base_price  FROM `user_orders` where `interfaceexid`='".$id."' and order_status=0 and ordertype='sell' order by createddate desc");
$d=$query->result_array();
if(!empty($d))
return $d[0]['base_price'];
	}
	
	//get values for graphs
	
	function get_values_for_graphs_today($interfaceexid,$time)
	{
		//todays
		$timeto=$time+1;
		if($timeto<10)
		{
			$timeto='0'.$timeto;
		}
				
		$date = date("Y-m-d");
		$this->db->select_max('base_price');
		$this->db->from('user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		
		$this->db->where('createddate >',date("$date $time:00:00"));
		$this->db->where('createddate <',date("$date $timeto:30:00"));
		//$this->db->order_by('createddate','DESC');
		
		$query1=$this->db->get();
		//echo $this->db->last_query(); //die();
		//todays
		$this->db->select_min('base_price');
		$this->db->from('user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',date("$date $time:00:00"));
		$this->db->where('createddate <',date("$date $timeto:59:59"));
		//$this->db->order_by('createddate','DESC');
		
		$query2=$this->db->get();
		
		
		$this->db->select('initial_price,user_orders.base_price');
		$this->db->from('user_orders');
		$this->db->join('interface_exchanges','user_orders.interfaceexid=interface_exchanges.interfaceexid','left');
		$this->db->where('user_orders.interfaceexid',$interfaceexid);
		//$this->db->where('user_orders.createddate >',date("$date $time:00:00"));
		//$this->db->where('user_orders.createddate <',date("$date $timeto:59:59"));
		$this->db->group_by('user_orders.interfaceexid');
		$query3=$this->db->get();
		//echo "<pre>";
		//echo($this->db->last_query());
		//die();		
		$this->db->select_sum('orderamount');
		$this->db->from('user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',date("$date $time:00:00"));
		$this->db->where('createddate <',date("$date $timeto:59:59"));
		//$this->db->order_by('createddate','DESC');
		
		$query4=$this->db->get();
		//echo "f";
		if ($query1->num_rows() > 0 && $query2->num_rows() > 0 && $query3->num_rows() > 0 && $query4->num_rows() > 0 )
		{
			
			return $result = array_merge($query1->result_array(),$query2->result_array(),$query3->result_array(),$query4->result_array());
		}
		else
		{
			return array();
		}
	
	}
	
	function get_values_start_close($interfaceexid,$time)
	{
		//todays
		
		if($time!=0)
		{
			$timeto=$time-1;
		}
		if($timeto<10)
		{
			$timeto='0'.$timeto;
		}
				
		$date = date("Y-m-d");
		$this->db->select('base_price');
		$this->db->from('user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',date("$date $time:00:00"));
		$this->db->where('createddate <',date("$date $timeto:59:59"));
		$this->db->order_by('createddate','DESC');
		
		$query1=$this->db->get();
		//echo $this->db->last_query(); 
		if ($query1->num_rows() > 0 )
		{			
			return $result = $query1->result_array();
		}
		else
		{
			return array();
		}
	
	}
	
	function get_values_for_graphs_week($interfaceexid,$time)
	{
		//todays
		$date1 = date("Y-m-d 00:00:00", strtotime("-$time day"));
		$date2 = date("Y-m-d 23:59:59", strtotime("-$time day"));
		$time2=$time-1;
		$datel1 = date("Y-m-d 00:00:00", strtotime("-$time day"));
		$datel2 = date("Y-m-d 23:59:59", strtotime("-$time2 day"));


		$this->db->select_max('base_price');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',$date1);
		$this->db->where('createddate <',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query1=$this->db->get();
		
		$this->db->select_max('baseprice');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',$date1);
		$this->db->where('createddate <',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query2=$this->db->get();
		
		//todays
		$this->db->select_min('base_price');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',$date1);
		$this->db->where('createddate <',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query3=$this->db->get();
		
		$this->db->select_min('baseprice');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',$date1);
		$this->db->where('createddate <',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query4=$this->db->get();
		
		$this->db->select('initial_price,user_orders.base_price');
		$this->db->from('user_orders');
		$this->db->join('interface_exchanges','user_orders.interfaceexid=interface_exchanges.interfaceexid','left');
		$this->db->where('user_orders.interfaceexid',$interfaceexid);
		$this->db->group_by('user_orders.interfaceexid');
				
		$query5=$this->db->get();
		
		$this->db->select_sum('orderamount');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',$date1);
		$this->db->where('createddate <',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query6=$this->db->get();
		
		$this->db->select_max('base_price');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate <',$datel1);
		$this->db->where('createddate >',$datel2);
		$this->db->order_by('createddate','DESC');
		
		$query7=$this->db->get();
		if ($query1->num_rows() > 0 && $query2->num_rows() > 0 && $query3->num_rows() > 0 && $query4->num_rows() > 0 && $query5->num_rows() > 0 && $query6->num_rows() > 0 )
		{
			return $result = array_merge($query1->result_array(),$query2->result_array(),$query3->result_array(),$query4->result_array(),$query5->result_array(),$query6->result_array());
		}
		else
		{
			return array();
		}
	
	}
	
	function get_values_for_graphs_month($interfaceexid,$time)
	{
		//todays
		$time2=$time+1;
		 $date1 = date("Y-m-d 00:00:00", strtotime("-$time month"));
		 $date2 = date("Y-m-d 23:00:00", strtotime("-$time2 month"));
		
		$this->db->select_max('base_price');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate <',$date1);
		$this->db->where('createddate >',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query1=$this->db->get();
		
		$this->db->select_max('baseprice');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate <',$date1);
		$this->db->where('createddate >',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query2=$this->db->get();
		
		//todays
		$this->db->select_min('base_price');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate <',$date1);
		$this->db->where('createddate >',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query3=$this->db->get();
		
		$this->db->select_min('baseprice');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate <',$date1);
		$this->db->where('createddate >',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query4=$this->db->get();
		
		$this->db->select('initial_price,user_orders.base_price');
		$this->db->from('user_orders');
		$this->db->join('interface_exchanges','user_orders.interfaceexid=interface_exchanges.interfaceexid','left');
		$this->db->where('user_orders.interfaceexid',$interfaceexid);
		$this->db->group_by('user_orders.interfaceexid');
		
				
		$query5=$this->db->get();
		$this->db->select_sum('orderamount');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate >',$date1);
		$this->db->where('createddate <',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query6=$this->db->get();
		
		if ($query1->num_rows() > 0 && $query2->num_rows() > 0 && $query3->num_rows() > 0 && $query4->num_rows() > 0 && $query5->num_rows() > 0 && $query6->num_rows() > 0)
		{
			return $result = array_merge($query1->result_array(),$query2->result_array(),$query3->result_array(),$query4->result_array(),$query5->result_array(),$query6->result_array());
		}
		else
		{
			return array();
		}
	
	}
	
	function check_atleast_one_order($interfaceexid)
	{
	
			 $this->db->select('order_id');
			$this->db->from('user_orders');
			$query = $this->db->where('interfaceexid',$interfaceexid);
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
	
	//will get last transaxtion 
	
	function get_list_transaction($interfaceexid,$time)
	{
		if($time>0)
		{
		$timeto=$time-1;
		if($timeto<10)
		{
			$timeto='0'.$timeto;
		}
		if($time<10)
		{
			$time='0'.$time;
		}
		
				
		$date = date("Y-m-d");
		$this->db->select_max('base_price');
		$this->db->from('user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate <',date("$date $time:00:00"));
		$this->db->where('createddate >',date("$date $timeto:00:00"));
		$query1=$this->db->get();
		//echo $this->db->last_query(); 
		if ($query1->num_rows() > 0 )
		{			
			return $result = $query1->result_array();
		}
		else
		{
			return array();
		}
	 }
	}
	
		function get_last_transaciton_weekly($interfaceexid,$time)
	{
		if($time>0)
		{
		$timeto=$time-1;
		
		}
		
		//todays
		$date1 = date("Y-m-d 00:00:00", strtotime("-$time month"));
		$date2 = date("Y-m-d 23:59:59", strtotime("-$timeto month"));
		
		$this->db->select_sum('base_price');
		$this->db->from(' user_orders');
		$this->db->where('interfaceexid',$interfaceexid);
		$this->db->where('createddate <',$date1);
		$this->db->where('createddate >',$date2);
		$this->db->order_by('createddate','DESC');
		
		$query1=$this->db->get();
		
		
		if ($query1->num_rows() > 0 )
		{
			return $result =$query1->result_array();
		}
		else
		{
			return array();
		}
	
	}
	//function is used for getting user posts
	function userposts()
	{
		   $this->db->select('user_posts.message,user_posts.createddate,users.username,users.avatar');
		   $this->db->from('user_posts');
		   $this->db->join('users','user_posts.userid=users.userid','left');
		   $this->db->order_by('user_posts.createddate','desc');
		   $this->db->limit(15);
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
function add_post($message)
{
	$where=array('message'=>$message,'userid'=>$this->session->userdata['cc_user']['userid'],'createddate'=>date('y-m-d H:i:s'));
	$this->db->insert('user_posts',$where);
}

//this function will add activeorders
function activeorders($intid)
{
	$where=array('interfaceexid'=>$intid,
					'order_status'=>0,'userid'=>$this->session->userdata['cc_user']['userid']);
	$this->db->select('base_price,orderamount,ordertotal,ordertype,createddate');
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
//this function will add activeorders
function orderhistory($intid)
{
	$where=array('interfaceexid'=>$intid,
					'order_status'=>1,'userid'=>$this->session->userdata['cc_user']['userid']);
	$this->db->select('base_price,orderamount,ordertotal,ordertype,createddate');
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
function get_last_order_price($type)
{
	
	$this->db->select('base_price');
	$this->db->where('ordertype',$type);
	$this->db->order_by('createddate','desc');
	$this->db->limit(1);
	$this->db->from('user_orders');
	
	$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			$data=$query->result_array();
			return $data[0]['base_price'];
			
		}
		else
		{
			return array();
		}
	
	 
}
		}
?>