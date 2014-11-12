<?php

class Marketers extends CI_Model
{
	
	function data_agent($data)
 	{
   	   	return $this->db->insert('youg_agent',$data);
 	}	
 	function allbroker($data)
 	{
   	   	return $this->db->insert('youg_broker',$data);
 	}	
 	function data_allagent()
 	{
   	   	return $this->db->get_where('youg_agent',array('marketerid'=>$this->session->userdata['marketer_data'][0]->id))->result_array();
 	}


}
?>
