<?php

class Subbrokers extends CI_Model
{
	
	function data_marketer($data)
 	{
   	   	return $this->db->insert('youg_marketer',$data);
 	}	
 	function data_agent($data)
 	{
   	   	return $this->db->insert('youg_agent',$data);
 	}	
 	function data_allmarketer()
 	{
   	   	return $this->db->get_where('youg_marketer',array('subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id))->result_array();
 	}
 	function data_allagent()
 	{
   	   	return $this->db->get_where('youg_agent',array('subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id))->result_array();
 	}
 	
 	

}
?>
