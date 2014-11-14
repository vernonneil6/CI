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
 	function subbroker_elitemember()
 	{
   	   	return $this->db
   	   	->select('yb.id ybid,yc.id ycid,yc.company yccompany,yc.phone ycphone,yc.email ycemail,yc.brokertype ycbrokertype')
		->from('youg_broker yb')
		->join('youg_company yc','yc.brokerid = yb.id and yc.brokertype = "subbroker"','left')
		->where('yb.id',$this->session->userdata['subbroker_data'][0]->id)
		->get()
		->result_array();				
 	}
 	function marketer_elitemember()
 	{
   	    return $this->db
   	   	->select('yb.id ybid,yc.id ycid,yc.company yccompany,yc.phone ycphone,yc.email ycemail,yc.brokertype ycbrokertype,yc.subbrokerid ycsubbrokerid,yb.subbrokerid  ybsubbrokerid,yb.name ybname,yc.marketerid ycmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc',' yc.brokertype = yb.type and yc.subbrokerid = yb.subbrokerid and yb.id = yc.brokerid','left')
		->where(array('yb.subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id,'yb.type'=>'marketer'))
		->get()
		->result_array();	
		echo $this->db->last_query();			
 	}
 	function agent_elitemember()
 	{
   	   	return $this->db
   	   	->select('yb.id ybid,yc.id ycid,yc.company yccompany,yc.phone ycphone,yc.email ycemail,yc.brokertype ycbrokertype,yc.marketerid ycmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc',' yc.brokertype = yb.type and yc.subbrokerid = yb.subbrokerid and yc.marketerid = yb.marketerid and yc.brokerid = yb.id','left')
		->where(array('yb.subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id,'yb.type'=>'agent'))
		->get()
		->result_array();				
 	}
 	function elitemembers()
 	{
   	   	return $this->db
   	   	->select('yc1.brokerid yc1brokerid,yc2.brokerid yc2brokerid,yc3.brokerid yc3brokerid,yc1.subbrokerid yc1subbrokerid,yc2.subbrokerid yc2subbrokerid,yc3.subbrokerid yc3subbrokerid,yc1.marketerid yc1marketerid,yc2.marketerid yc2marketerid,yc3.marketerid yc3marketerid,yb1.name yb1name,yb2.name yb2name,yb3.name yb3name,yb1.id yb1id,yb2.id yb2id,yb3.id yb3id,yc1.company yc1company,yc2.company yc2company,yc3.company yc3company,yc1.phone yc1phone,yc2.phone yc2phone,yc3.phone yc3phone,yc1.email yc1email,yc2.email yc2email,yc3.email yc3email,yc1.brokertype yc1brokertype,yc2.brokertype yc2brokertype,yc3.brokertype yc3brokertype')
		->from('youg_broker yb1,youg_broker yb2,youg_broker yb3')
		->join('youg_company yc1','yb1.type = yc1.brokertype  and  yb1.id = yc1.brokerid','left')
		->join('youg_company yc2','yb2.type = yc2.brokertype  and  yb2.id = yc2.brokerid and yb2.subbrokerid = yc2.subbrokerid','left')
		->join('youg_company yc3','yb3.type = yc3.brokertype  and  yb3.id = yc3.brokerid and yb3.subbrokerid = yc3.subbrokerid and yb3.marketerid = yc3.marketerid','left')
		->where(array('yb1.id'=>$this->session->userdata['subbroker_data'][0]->id,'yb1.type'=>'subbroker','yb1.subbrokerid'=>'','yb1.marketerid'=>''))
		->where(array('yb2.subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id,'yb2.type'=>'marketer'))
		->where(array('yb3.subbrokerid'=>$this->session->userdata['subbroker_data'][0]->id,'yb3.type'=>'agent'))
		->get()
		->result_array();	
		//echo $this->db->last_query();	die;			
 	}
 	
}
?>
