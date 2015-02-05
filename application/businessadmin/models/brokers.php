<?php

class Brokers extends CI_Model
{
	
 	function allbroker($data)
 	{
   	   	return $this->db->insert('youg_broker',$data);
 	}	
 	function data_allsubbroker()
 	{
   	   	return $this->db->get_where('youg_broker',array('mainbrokerid'=>$this->session->userdata['broker_data'][0]->id,'type'=>'subbroker'))->result_array();
 	}
 	function elitemembers($id)
 	{
   	   	return $query= $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.mainbrokerid','left')
		->where('yc.mainbrokerid',$id)
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
		
	function subbrokerupdates($type,$name,$password,$signup,$mainbrokerid,$id)
	{
		$data=array(
			'type'=> $type,
			'name'=>$name,
			'password'=>$password,
			'signup'=>$signup,
			'mainbrokerid'=>$mainbrokerid
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
