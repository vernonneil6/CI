<?php

class Agentdashboards extends CI_Model
{

function get_agent($subbrokerid)
{
	return $query = $this->db->get_where('youg_broker',array('subbrokerid'=>$subbrokerid,'type'=>'agentaccount'))->result();
	 
}

}
?>