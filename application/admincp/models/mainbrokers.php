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
	
	function allbroker($data)
 	{
   	   	$this->db->insert('youg_broker',$data);
 	}	
}
?>
