<?php
Class Homesettings extends CI_Model
{
	//Function for getting all Settings
	function get_all_homesetting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'title' : $sortby = 'fieldname';break;
			case 'value' : $sortby = 'value';break;
			default : $sortby = 'id';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		$this->db->where('websiteid',$siteid);
		
		//Executing Query
		$query = $this->db->get('settinghome');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting setting field name By id
	function get_homesetting_fieldname($id)
 	{
		$query = $this->db->get_where('settinghome', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return stripslashes($result[0]['fieldname']);
		}
		else
		{
			return false;
		}
 	}
	
	
	//Getting setting value for editing By id
	function get_homesetting_value($id)
 	{
		$query = $this->db->get_where('settinghome', array('intid' => $id));
		
		if ($query->num_rows() > 0)
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
	function get_homesetting_byid($id)
 	{
		$query = $this->db->get_where('settinghome', array('intid' => $id));
		
		if ($query->num_rows() > 0)
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
		if( $this->db->update('settinghome', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Getting value for searching
	function search_homesetting($keyword,$siteid,$sortby = 'fieldname',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	$this->db->select('*');
	  	$this->db->from('settinghome');
		$this->db->where('websiteid',$siteid);
	  	$this->db->like(array('fieldname'=> $keyword , 'value'=> $keyword ) );
		$this->db->where('(fieldname LIKE \'%'.$keyword.'%\' OR value LIKE \'%'.$keyword.'%\')', NULL, FALSE);
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