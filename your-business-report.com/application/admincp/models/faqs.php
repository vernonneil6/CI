<?php
class Faqs extends CI_Model
{
	function get_all_faqs($siteid,$limit ='',$offset='',$sortby = 'question',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'question': $sortby = 'question';break;
			default 	     : $sortby = 'question';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$this->db->where('websiteid',$siteid);
		//Executing Query
		$query = $this->db->get('faq');
		
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
	function insert($question,$answer,$siteid)
	{
		$data = array(
							'websiteid'	=> $siteid,
							'question'	=> $question,
							'answer' 	=> $answer,
							'status'	=> 'Enable'
								);

		if( $this->db->insert('faq', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_faq_byid($id)
 	{
		$query = $this->db->get_where('faq', array('id' => $id));
		
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
	function update($id,$question,$answer)
 	{
			$data = array(
							'question'	=> $question,
							'answer' 	=> $answer,
								);
		$this->db->where('id', $id);
		if( $this->db->update('faq', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Changing Status to "Disable"
	function disable_faq_byid($id)
	{
		$data = array(
						'status'	=> 'Disable'
								);
		$this->db->where('id', $id);
		if( $this->db->update('faq', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_faq_byid($id)
	{
		$data = array(
							'status'	=> 'Enable'
								);
		$this->db->where('id', $id);
		if( $this->db->update('faq', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_faq_byid($id)
	{
		if( $this->db->delete('faq', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for searching
	function search_faq($keyword,$siteid,$sortby = 'question',$orderby = 'ASC')
	{
		  	//Executing Query
			$this->db->order_by($sortby,$orderby);
			$siteid = $this->session->userdata('siteid');
	  		$this->db->select('*');
			$this->db->from('faq');
			$this->db->where('websiteid',$siteid);
			$this->db->where('(question LIKE \'%'.$keyword.'%\' OR answer LIKE \'%'.$keyword.'%\')', NULL, FALSE);
			$query = $this->db->get();
			//echo "<pre>";
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