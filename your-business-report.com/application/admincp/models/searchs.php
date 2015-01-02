<?php
Class Searchs extends CI_Model
{
	function get_all_searchs($siteid,$limit ='',$offset='',$sortby = 'keyword',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'keyword' 	: $sortby = 'keyword';break;
			default 		: $sortby = 'keyword';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('searches');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Inserting Record
	function insert($keyword,$siteid)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'websiteid'		=> $siteid,
							'keyword' 		=> $keyword,
							'status' 		=> 'Enable',
							'searchesip' 	=> $varipaddress,
							'searchesdate'	=> $date
						);

		if( $this->db->insert('searches', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_search_byid($id)
 	{
		$query = $this->db->get_where('searches', array('id' => $id));
		
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
	function update($id,$keyword)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'keyword' 		=> $keyword
						);
		$this->db->where('id', $id);
		if( $this->db->update('searches', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	//Changing Status to "Disable"
	function disable_search_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'	=> 'Disable'
					);
		$this->db->where('id', $id);
		if( $this->db->update('searches', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_search_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'	=> 'Enable'
						);
		$this->db->where('id', $id);
		if( $this->db->update('searches', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_search_byid($id)
	{
		if( $this->db->delete('searches', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for searching
	function search_search($keyword,$siteid,$sortby = 'keyword',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	$this->db->select('*');
	  	$this->db->from('searches');
	  	$this->db->where('websiteid',$siteid);
		$this->db->like(array('keyword'=> $keyword ) );

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