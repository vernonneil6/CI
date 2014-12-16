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
   	   	$this->db->insert('youg_broker',$data);
 	}
 	function subbroker()
 	{
   	   	return $this->db->get_where('youg_broker', array('type' => 'subbroker'))->result_array();
 	}	
 	function elitemembers()
 	{
   	   	return $this->db->get('youg_broker')->result_array();
 	}	
 	function elite_company($id)
 	{
   	   	return $this->db->get_where('youg_company',array('brokerid' => $id))->result_array();
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
			->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid,yc.brokerid ycbrokerid,(SELECT count(*) FROM `youg_company` where brokerid='.$id.' or subbrokerid='.$id.') as totalelite ')
			->from('youg_broker yb')
			->join('youg_company yc','yb.id = yc.brokerid and yc.brokertype = yb.type','left')
			->where('yc.brokerid',$id)
			->or_where('yc.marketerid',$id)
			->group_by('yb.id')
			->get()
			->result_array();
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
			
				$brokerquery = $this->db->query('select count(*) as count from youg_company where brokerid='.$row['ybid'].'')->result_array();
				$query[$key]['count'] = $brokerquery[0]['count'];
				$total = $query[$key]['totalelite'];
				if($total != $totalelite){
									
					$query[$key]['totalelites'] = $total;
					$totalelite = $query[$key]['totalelite'];
				}
			}	
			
			
		return $query;	
		
		
	}	
}
?>
