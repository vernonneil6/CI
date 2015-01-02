<?php
Class Emails extends CI_Model
{
	function get_all_emails($sortby = 'title',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$query = $this->db->get('emails');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting Email value for editing
	function get_email_byid($id)
 	{
		$query = $this->db->get_where('emails', array('id' => $id));
		
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
	function update($id,$title,$subject,$mailformat)
 	{
		$editdate = date('Y-m-d');
		$editip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'title' 		=> $title,
							'subject' 	=> $subject,
							'mailformat'=> $mailformat,
							'editdate' 	=> $editdate,
							'editip' 		=> $editip
						);
			
		$this->db->where('id', $id);
		if( $this->db->update('emails', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Getting value for searching
	function search_email($keyword,$sortby = 'title',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	$this->db->select('*');
	  	$this->db->from('emails');
	  	$this->db->or_like(array('title'=> $keyword , 'subject'=> $keyword ,'mailformat'=> $keyword) );

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