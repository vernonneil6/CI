<?php

class Agents extends CI_Model
{
	function elitemembers()
 	{
   	   	return $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.marketerid ycmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.brokerid','left')
		->get()
		->result_array();			
 	}
 	
 	function data_by_id($id)
 	{
		return $this->db->get_where('youg_broker', array('id' => $id))->row_array();
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
