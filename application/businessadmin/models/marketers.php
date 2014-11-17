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

}
?>
