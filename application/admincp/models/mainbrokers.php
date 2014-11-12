<?php
Class Mainbrokers extends CI_Model
{
	function get_all_brokersetting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('seo');
		
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function brokeradd($data)
	{
		$this->db->insert('youg_subbroker',$data);
	}
	
	function companyid($name)
	{
		return $this->db->get_where('youg_company',array('company'=>$name))->row_array();
	}
	function agentview($marketerid)
	{
		return $this->db->get_where('youg_broker',array('marketerid'=>$marketerid,'type'=>'agentaccount'))->result();
	}
	function marketerview($subbroker)
	{
		return $this->db->get_where('youg_broker',array('brokerid'=>$subbroker,'type'=>'marketeraccount'))->result();
	}
	
	function brokerview()
	{
		return $this->db->get('youg_broker')->result();
	}
}
?>
