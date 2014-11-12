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
 	
}
?>
