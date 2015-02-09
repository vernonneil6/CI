<?php
Class Mainbrokers extends CI_Model
{
	function get_all_brokersetting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('seo');
		
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function allbroker($data)
 	{
   	   	return $this->db->insert('youg_broker',$data);
 	}
 	function subbroker()
 	{
   	   	return $this->db->get_where('youg_broker', array('type' => 'subbroker'))->result_array();
 	}	
 	function elitemembers()
 	{
   	   	return $this->db->get('youg_broker')->result_array();
 	}	
 	function brokerids($id)
 	{
   	   	return $this->db->get_where('youg_broker',array('id' => $id))->row_array();
 	}	
 	function subbroker_company($id)
 	{
   	   	return $this->db->get_where('youg_company',array('brokerid' => $id, 'brokertype' => 'subbroker'))->row_array();
 	}
 	function brokers()
 	{
		return $this->db->get_where('youg_broker',array('type'=>'broker'))->result_array();
	}
 	function subbrokers()
 	{
		return $this->db->get_where('youg_broker',array('type'=>'subbroker'))->result_array();
	}
 	function marketers()
 	{
		return $this->db->get_where('youg_broker',array('type'=>'marketer'))->result_array();
	}
	
 	function agents()
 	{
		return $this->db->get_where('youg_broker',array('type'=>'agent'))->result_array();
	}
	
 	function view_details($id)
 	{
		
	  $query1 = $this->db->get_where('youg_broker', array('id' => $id))->result_array();
   	   	   
   	    if($query1[0]['type'] =='broker' and $query1[0]['id']==$id)
   	    {
   	     $query = $this->db
			->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid,yc.brokerid ycbrokerid,(SELECT count(*) FROM `youg_company` where brokerid='.$id.' or mainbrokerid='.$id.') as totalelite ')
			->from('youg_broker yb')
			->join('youg_company yc','yb.id = yc.brokerid and yc.brokertype = yb.type','left')
			->where('yc.brokerid',$id)
			->or_where('yc.mainbrokerid',$id)
			->group_by('yb.id')
			->order_by('yb.id',"desc")
			->get()
			->result_array();
		}
   	    if($query1[0]['type'] =='subbroker' and $query1[0]['id']==$id)
   	    {
   	     $query = $this->db
			->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid,yc.brokerid ycbrokerid,(SELECT count(*) FROM `youg_company` where brokerid='.$id.' or subbrokerid='.$id.') as totalelite ')
			->from('youg_broker yb')
			->join('youg_company yc','yb.id = yc.brokerid and yc.brokertype = yb.type','left')
			->where('yc.brokerid',$id)
			->or_where('yc.subbrokerid',$id)
			->group_by('yb.id')
			->get()
			->result_array();
		}
		if($query1[0]['type'] =='marketer' and $query1[0]['id']==$id)
   	    {
   	     $query = $this->db
			->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid,yc.brokerid ycbrokerid,(SELECT count(*) FROM `youg_company` where brokerid='.$id.' or marketerid='.$id.') as totalelite ')
			->from('youg_broker yb')
			->join('youg_company yc','yb.id = yc.brokerid and yc.brokertype = yb.type','left')
			->where('yc.brokerid',$id)
			->or_where('yc.marketerid',$id)
			->group_by('yb.id')
			->get()
			->result_array();
			
			//echo $this->db->last_query();
			//echo '<pre>';print_r($query);die;
		}
		if($query1[0]['type'] =='agent' and $query1[0]['id']==$id)
   	    {
   	     $query = $this->db
			->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid,yc.brokerid ycbrokerid,(SELECT count(*) FROM `youg_company` where brokerid='.$id.' or subbrokerid='.$id.') as totalelite ')
			->from('youg_broker yb')
			->join('youg_company yc','yb.id = yc.brokerid and yc.brokertype = yb.type','left')
			->where('yc.brokerid',$id)
			->group_by('yb.id')
			->get()
			->result_array();
		}		
			$totalelite='';
			foreach ($query as $key => $row)
			{	
				$ybid=$row['ybid'];
				$individualsale = $this->db->query('select count(*) as individualsale from youg_company where brokerid='.$ybid.'')->result_array();
				$query[$key]['count'] = $individualsale[0]['individualsale'];
				$total = $query[$key]['totalelite'];
				
				if($total != $totalelite){
									
					$query[$key]['totalelites'] = $total;
					$totalelite = $query[$key]['totalelite'];
				}
			}	
			
			
		return $query;	
		
		
	}
	function view_detailss($id)
 	{
	 $query = $this->db
			->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid,yc.brokerid ycbrokerid')
			->from('youg_broker yb')
			->join('youg_company yc','yb.id = yc.brokerid and yc.brokertype = yb.type','left')
			->where('yc.brokerid',$id)
			->get()
			->result_array();	

		return $query;	
	}	
	function deletebroker($id)
	{
		if($this->db->delete('youg_broker',array('id'=>$id))){
			return true;
		}else{
			return false;
		}
	}
	function updatebroker($id,$value){
		$this->db->where('id', $id);
		if( $this->db->update('youg_broker', $value) ){
			return true;
		}else{
			return false;
		}
	}
	
	function broker_name_check($name)
	{
		return $this->db->get_where('youg_broker', array('name' => $name))->row_array();
	}
	function subbroker_name_check($name)
	{
		return $this->db->get_where('youg_broker', array('name' => $name))->row_array();
	}
	function marketer_name_check($name)
	{
		return $this->db->get_where('youg_broker', array('name' => $name))->row_array();
	}
	function agent_name_check($name)
	{
		return $this->db->get_where('youg_broker', array('name' => $name))->row_array();
	}
	function emailcheck($email)
	{
		return $this->db->get_where('youg_broker', array('emailaddress' => $email))->row_array();
	}
	function myelitecsv($id,$type)
	{
		if($type=="subbroker")
	 	{
	 	 $where = "(`brokerid` = '".$id ."' OR `subbrokerid` = '".$id."')";
	     
	    } else if($type=="broker") {
			
			$where = "(`brokerid` = '".$id ."' OR `mainbrokerid` = '".$id."')";
			
	     } else if($type=="marketer") {
			
			$where = "(`brokerid` = '".$id ."' OR `marketerid` = '".$id."')";
		
		} else { 
			 
			$where = "(`brokerid` = '".$id ."' OR `brokertype` = '".$type."')"; 
			
		 }	
			
	 	$query=$this->db->select('yc.contactname yccname,yc.company yccompany,yc.contactphonenumber ycphone,yc.email ycemail,yc.registerdate ycreg,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yc.brokerid ycbrokerid,ys.subscr_id yssubscr_id,ys.payment_date yspay,ys.expires ysexp,yc.status ycstatus')
						   ->from('youg_company yc') 
						   ->join('youg_subscription ys', 'ys.company_id=yc.id', 'left')
						   ->where($where)
						   	->get()
							->result_array(); 
							
        $i=0;
        foreach($query as $q)
        {
		  if($q['yssubscr_id']!= null)
			{	
				$countquery = $this->db->query('select count(*) as payment_count from youg_silent where subscription_id="'.$q['yssubscr_id'].'"')->result_array();	
				if(count($countquery) > 0)
				{
				 $query[$i]['pcount']=$countquery[0]['payment_count'];
			    }
			}
			else
			{
				$query[$i]['pcount']='-'; 
				$query[$i]['ycstatus']='Disable';
			}
			unset($query[$i]['yssubscr_id']);
			$query[$i]['ycreg']=date('m/d/Y',strtotime($q['ycreg']));
			$query[$i]['yspay']=date('m/d/Y',strtotime($q['yspay']));
			$query[$i]['ysexp']=date('m/d/Y',strtotime($q['ysexp']));
			if(isset($q['ycsubbrokerid']))
			{
				$subname=$this->db->query('select name from youg_broker where id='.$q['ycsubbrokerid'].'')->result_array();
				$query[$i]['ycsubbrokerid']=$subname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycsubbrokerid']=$q['ycsubbrokerid'];
			}
			 
			if($q['ycmarketerid'] != null)
			{
    			$mname=$this->db->query('select name from youg_broker where id='.$q['ycmarketerid'].'')->result_array();
				$query[$i]['ycmarketerid']=$mname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycmarketerid']='-';
			}
			if($q['ycbrokerid'] != null)
			{
				$aname=$this->db->query('select name from youg_broker where id='.$q['ycbrokerid'].' and type="agent"')->result_array();
				$query[$i]['ycbrokerid']=$aname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycbrokerid']='-';
			}
			
		    $query[$i]['dummyid']='ABC#';
			$i++;
		 
		}
		
	   return $query;	
		
	}
	function getmymainbroker($subid)
	{
		
		$query=$this->db->select('mainbrokerid')
		                ->from('youg_broker')
		                ->where(array('id' => $subid,'type'=>'subbroker'))
		                ->get()
		                ->result_array();
		
		return $query;
		
		
	}
	function getmybrokers($markid)
	{
		$query=$this->db->select('mainbrokerid,subbrokerid')
		                ->from('youg_broker')
		                ->where(array('id' => $markid,'type'=>'marketer'))
		                ->get()
		                ->result_array();
		
		return $query;

	}
	
}
?>
