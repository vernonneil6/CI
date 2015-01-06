<?php
Class Sems extends CI_Model
{
	function get_all_sem($siteid,$sortby = 'title',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('sem');
		
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
	function update($id,$title,$url,$imagename)
 	{
		$data = array(
						'title' 	=> $title,
						'url' 		=> $url,
						'mainimg' 	=> $imagename,
						'thumbimg' 	=> $imagename
					);
		$this->db->where('intid', $id);
		if( $this->db->update('sem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Updating Record
	function update_noimage($id,$title,$url)
 	{
		$data = array(
						'title' 	=> $title,
						'url' 		=> $url,
					);
		
		$this->db->where('intid', $id);
		if( $this->db->update('sem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Getting SEM value for editing
	function get_sems_byid($id)
 	{
		$query = $this->db->get_where('sem', array('intid' => $id));
		
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
		
	//Changing Status to "Disable"
	function disable_sem_byid($id)
	{
		$data = array(
							'status'	=> 'Disable'
						);
		$this->db->where('intid', $id);
		if( $this->db->update('sem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_sem_byid($id)
	{
		$data = array(
							'status'	=> 'Enable'
						);
		$this->db->where('intid', $id);
		if( $this->db->update('sem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for searching
	function search_sem($keyword,$siteid,$sortby = 'title',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	$this->db->select('*');
	  	$this->db->from('sem');
	  	$this->db->where('websiteid',$siteid);
		$this->db->like('title',$keyword);
		
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