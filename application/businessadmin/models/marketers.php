<?php

class Marketers extends CI_Model
{
	
 	function allbroker($data)
 	{
   	   	return $this->db->insert('youg_broker',$data);
 	}	
 	
 	function data_allagent()
 	{
   	   	return $this->db->get_where('youg_broker',array('marketerid'=>$this->session->userdata['marketer_data'][0]->id,'type'=>'agent'))->result_array();
 	}
 	
 	function elitemembers()
 	{
   	   	return $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.marketerid ycmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.brokerid','left')
		->get()
		->result_array();			
 	}	
 	
 	function agentdeletes($id)
 	{
		$this->db->delete('youg_broker', array('id' => $id));
	}
	
	function agentupdates($name, $password, $id)
 	{
		 $data = array(	
						'name'		=> $name,
						'password'		=> $password
								
					     );
		$this->db->where('id',$id)->update('youg_broker', $data);
	}
	
	function agentedits($id)
 	{
		return $this->db->get_where('youg_broker', array('id' => $id))->row_array();
	}
	
	function userprofileupdate($new,$id)
	{
		$data=array(
			'password'=>$new
		);
				
		$this->db->where('id' , $id)->update('youg_broker', $data);
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
	function myelitecsvs($id,$type)
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
			
	 	$query=$this->db->select('yc.contactname yccname,yc.company yccompany,yc.brokertype ycbrokertype,yc.contactphonenumber ycphone,yc.email ycemail,yc.registerdate ycreg,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yc.brokerid ycbrokerid,ys.subscr_id yssubscr_id,ys.payment_date yspay,ys.expires ysexp,yc.status ycstatus')
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
	function brokerids($id)
 	{
   	   	return $this->db->get_where('youg_broker',array('id' => $id))->row_array();
 	}
	

}
?>
