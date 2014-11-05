<?php

class Marketeradds extends CI_Model
{

function agentadd($data)
{
	return  $this->db->insert('youg_broker',$data);
}
function count_marketer($id)
{
 	$query = $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>'agentaccount'));
 	return $query->num_rows();
}
function get_marketercount($id)
{
	return $query = $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>''))->row_array(); 
}  

}
?>