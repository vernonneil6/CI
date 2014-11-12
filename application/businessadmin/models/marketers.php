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
	function data_elitemember()
 	{
   	   	return $this->db->get_where('youg_company',array('brokerid'=>$this->session->userdata['marketer_data'][0]->id,'brokertype'=>'marketer'))->result_array();
 	}

}
?>
