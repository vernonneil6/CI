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
 	function data_elitemember()
 	{
   	   	//return $this->db->get_where('youg_company',array('brokerid'=>$this->session->userdata['subbroker_data'][0]->id,'brokertype'=>'subbroker'))->result_array();
   	   	return $this->db
   	   	->select('yc1.company yc1company,yc1.phone yc1phone,yc1.email yc1email,yc1.brokertype yc1brokertype,yc2.company yc2company,yc2.phone yc2phone,yc2.email yc2email,yc2.brokertype yc2brokertype,yc3.company yc3company,yc3.phone yc3phone,yc3.email yc3email,yc3.brokertype yc3brokertype')
		->from('youg_broker yb')
		->join('youg_company yc1','yc1.brokerid = yb.id and yc1.brokertype = "subbroker"','left')
		->join('youg_company yc2','yc2.subbrokerid = yb.id and yc2.brokertype = "marketer"','left')
		->join('youg_company yc3','yc3.subbrokerid = yb.id and yc3.brokertype = "agent"','left')
		->where('yb.id',$this->session->userdata['subbroker_data'][0]->id)
		->get()
		->result_array();				
 	}
 	
}
?>
