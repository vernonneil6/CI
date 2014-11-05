<?php
Class Solutions extends CI_Model
{
	function get_all_solutions($siteid,$limit ='',$offset='',$sortby = 'title',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'title' 	: $sortby = 'title';break;
			default 	    : $sortby = 'title';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		$this->db->where('websiteid',$siteid);
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('solutions');
		
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
	function insert($title,$detail,$siteid,$image)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$urlkey = strtolower($title);
		//make alphaunermic
		$urlkey = preg_replace("/[^a-z0-9\s-]/", "", $urlkey);
		//Clean multiple dashes or whitespaces
		$urlkey = preg_replace("/[\s-]+/", " ", $urlkey);
		//Convert whitespaces to dash
		$urlkey = preg_replace("/[\s]/", "-", $urlkey);

		$data = array(
							'websiteid'		=> $siteid,
							'title' 		=> $title,
							'detail' 		=> $detail,
							'urlkey' 		=> $urlkey,
							'image' 		=> $image,
							'status' 		=> 'Enable',
							'insertip' 		=> $varipaddress,
							'insertdate'	=> $date
						);

		if( $this->db->insert('solutions', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_solution_byid($id)
 	{
		$query = $this->db->get_where('solutions', array('id' => $id));
		
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
	function update($id,$title,$detail,$image)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$urlkey = strtolower($title);
		//make alphaunermic
		$urlkey = preg_replace("/[^a-z0-9\s-]/", "", $urlkey);
		//Clean multiple dashes or whitespaces
		$urlkey = preg_replace("/[\s-]+/", " ", $urlkey);
		//Convert whitespaces to dash
		$urlkey = preg_replace("/[\s]/", "-", $urlkey);
		
		$data = array(
							'title' 		=> $title,
							'detail' 		=> $detail,
							'image'			=> $image,
							'urlkey' 		=> $urlkey,
							'editdate'		=> $date,
							'editip'		=> $varipaddress
					 );
		$this->db->where('id', $id);
		if( $this->db->update('solutions', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	//Changing Status to "Disable"
	function disable_solution_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'		=> 'Disable',
						'editdate'	=> $date_edit,
						'editip'		=> $vareditip
					);
		$this->db->where('id', $id);
		if( $this->db->update('solutions', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_solution_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'	=> 'Enable',
							'editdate'=> $date_edit,
							'editip'	=> $vareditip
						);
		$this->db->where('id', $id);
		if( $this->db->update('solutions', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_solution_byid($id)
	{
		if( $this->db->delete('solutions', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for searching
	function search_solution($keyword,$siteid,$limit ='',$offset='',$sortby = 'title',$orderby = 'ASC')
 	{
	  	$siteid = $this->session->userdata('siteid');
	  	//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
	  
	  	$this->db->select('*');
	  	$this->db->from('solutions');
		$this->db->where('websiteid',$siteid);
	  	$this->db->like('detail',$keyword );
		$query = $this->db->get();
		//echo $this->db->last_query();

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