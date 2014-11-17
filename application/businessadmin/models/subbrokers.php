<?php

class Subbrokers extends CI_Model
{
	
 	function allbroker($data)
 	{
   	   	return $this->db->insert('youg_broker',$data);
 	}	
 	function data_allmarketer()
 	{
   	   	return $this->db->get_where('youg_broker',array('subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id,'type'=>'marketer'))->result_array();
 	}
 	function data_allagent()
 	{
   	   	return $this->db->get_where('youg_broker',array('subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id,'type'=>'agent'))->result_array();
 	}
 	function elitemembers()
 	{
   	   	return $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.brokerid and yb.subbrokerid = yc.subbrokerid and yb.marketerid = yc.marketerid and yb.type = yc.brokertype','left')
		->get()
		->result_array();			
 	}	
}
?>
