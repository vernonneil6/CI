<?php

class Agents extends CI_Model
{
	function data_elitemember()
 	{
   	   	return $this->db->get_where('youg_company',array('brokerid'=>$this->session->userdata['agent_data'][0]->id,'brokertype'=>'agent'))->result_array();
 	}
}
?>
