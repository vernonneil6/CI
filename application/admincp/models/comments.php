<?php
class Comments extends CI_Model
{
	function get_all_comments($limit ='',$offset='',$sortby ,$orderby)
 	{
		switch($sortby)
		{
			case 'commentby' 	: $sortby = 'commentby';break;
			case 'comment' 		: $sortby = 'comment';break;
			case 'commentdate' 	: $sortby = 'commentdate';break;
			default 			: $sortby = 'commentby';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('comments');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function commentsSearch($limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('commentby', 'comment','commentdate');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'commentby';
		
		// results query
		$q = $this->db->select('*')
			->from('comments')			
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)	 
			->from('comments');			
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	
	//Getting Page value for editing
	function get_comment_byid($id)
 	{
		$query = $this->db->get_where('comments', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Changing Status to "Disable"
	function disable_comment_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'			=> 'Disable',
						'commentip' 	=> $vareditip,
						 		);
		$this->db->where('id', $id);
		if( $this->db->update('comments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_comment_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'			=> 'Enable',
							'commentip' 	=> $vareditip,
						);
		$this->db->where('id', $id);
		if( $this->db->update('comments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function search_comment($keyword,$limit ='',$offset='',$sortby = 'commentdate',$orderby = 'DESC')
 	{
	  $siteid = $this->session->userdata('siteid');
	  	//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
	  
		//Executing Query
		$this->db->select('c.*, r.*,u.*, c.id as cid');
		$this->db->from('comments as c');
		$this->db->join('reviews as r','c.reviewid=r.id');
		$this->db->join('user as u','c.commentby=u.id');
		$this->db->where('r.websiteid',$siteid);
		$this->db->where('(c.comment LIKE \'%'.$keyword.'%\' OR u.firstname LIKE \'%'.$keyword.'%\' OR u.lastname LIKE \'%'.$keyword.'%\')', NULL, FALSE);
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
	
	function multiple_function($type,$foo)
	{
		if($type=='Delete')
		{
			
			if( $this->db->delete('comments', $this->db->where_in('comments.id',$foo)) )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		if($type=='Enable')
		{
			$vareditip = $_SERVER['REMOTE_ADDR'];
			$data = array(
							'status'		=> 'Enable',
							
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('comments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
		if($type=='Disable')
		{
			$vareditip = $_SERVER['REMOTE_ADDR'];
			$data = array(
							'status'		=> 'Disable',
							
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('comments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	}
	
	function get_user_bysingleid($id)
 	{
		$query = $this->db->get_where('user', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
 	}
}

?>
