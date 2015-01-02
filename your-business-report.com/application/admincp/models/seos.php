<?php
Class Seos extends CI_Model
{
	function get_all_seosetting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
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
	
	//Getting setting value for editing By id
	function get_seosetting_value($id)
 	{
		$query = $this->db->get_where('seo', array('intid' => $id));
		
		if( $query->num_rows() > 0 )
		{
			$result = $query->result_array();
			return nl2br(stripslashes($result[0]['value']));
		}
		else
		{
			return false;
		}
 	}
	
	//Getting setting value for editing By id
	function get_seosetting_byid($id)
 	{
		$query = $this->db->get_where('seo', array('intid' => $id));
		
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Updating Record
	function update($id,$value)
 	{
		$data = array( 'value' => $value );
		$this->db->where('intid', $id);
		if( $this->db->update('seo', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Getting value for searching
	function search_seo($keyword,$siteid,$sortby = 'fieldname',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
	  	$this->db->select('*');
	  	$this->db->from('seo');
		$this->db->where('websiteid',$siteid);
		$this->db->like('value',$keyword );
		
	  	$query = $this->db->get();
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}	
}
?>