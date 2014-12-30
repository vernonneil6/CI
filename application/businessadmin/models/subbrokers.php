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
 	function elitemembers()
 	{
   	   	return $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.brokerid and yb.type = yc.brokertype','left')
		->get()
		->result_array();		
 	}
 	function agentelitemembers()
 	{
   	   	return $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.brokerid and yb.type = yc.brokertype and yb.subbrokerid = yc.subbrokerid and yb.marketerid = yc.marketerid','left')
		->get()
		->result_array();		
 	}	
 	
 	function data_by_id($id)
 	{
		return $this->db->get_where('youg_broker', array('id' => $id))->row_array();
	}
	 	
 	function data_delete($id)
 	{
		$this->db->delete('youg_broker', array('id' => $id));
	}
		
	function marketerupdates($type,$name,$password,$signup,$subbrokerid,$id)
	{
		$data=array(
			'type'=> $type,
			'name'=>$name,
			'password'=>$password,
			'signup'=>$signup,
			'subbrokerid'=>$subbrokerid
		);
		
		$this->db->where('id' , $id)->update('youg_broker', $data);
	}
	
	function agentupdates($type,$name,$password,$signup,$marketerid,$subbrokerid,$id)
	{
		$data=array(
			'type'=> $type,
			'name'=>$name,
			'password'=>$password,
			'signup'=>$signup,
			'marketerid'=>$marketerid,
			'subbrokerid'=>$subbrokerid
		);
				
		$this->db->where('id' , $id)->update('youg_broker', $data);
	}
	
	function userprofileupdate($new,$id)
	{
		$data=array(
			'password'=>$new
		);
				
		$this->db->where('id' , $id)->update('youg_broker', $data);
	}
	
}
?>
