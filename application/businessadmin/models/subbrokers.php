<?php
Class Subbrokers extends CI_Model
{
	function brokeradd($name,$type,$password,$subbrokerid,$marketername,$marketerid,$brokerid)
	{
		$data=array(
			'username' => $name,
			'type' => $type,
			'password' => $password,
			'subbrokerid'=>$subbrokerid,
			'marketername'=>$marketername,
			'marketerid'=>$marketerid,
			'brokerid'=>$brokerid
		);
		$this->db->insert('youg_broker',$data);
	}
	function agentview($subbrokerid,$marketerid)
	{
		return $this->db->get_where('youg_broker',array('subbrokerid'=>$subbrokerid,'marketerid'=>$marketerid,'type'=>'agentaccount'))->result();
	}
	function marketerview($id)
	{
		return $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>'marketeraccount'))->result();
	}
	function get_marketercount($id)
	{
		return $query = $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>''))->row_array(); 
	} 
	function count_agent($id)
	{
	 	$query = $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>'agentaccount'));
	 	return $query->num_rows();
	}
	function count_marketer($id)
	{
	 	$query = $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>'marketeraccount'));
	 	return $query->num_rows();
	}
	function get_count($id)
	{
		return $query = $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>''))->row_array(); 
	}   
	function marketerid($name)
	{
		return $this->db->get_where('youg_broker',array('username'=>$name))->row_array();
	}
	function brokersid($id)
	{
		return $this->db->get_where('youg_broker',array('subbrokerid'=>$id,'type'=>''))->row_array();
	}
	
}
?>