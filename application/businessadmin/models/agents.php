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
}
?>
