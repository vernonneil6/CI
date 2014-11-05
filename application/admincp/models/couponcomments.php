<?php
class Couponcomments extends CI_Model
{
	function get_all_couponcomments($limit ='',$offset='',$sortby = 'commentdate',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('couponcomments');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting Page value for editing
	function get_couponcomment_byid($id)
 	{
		$query = $this->db->get_where('couponcomments', array('id' => $id));
		
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
	function disable_couponcomment_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'			=> 'Disable',
						'commentip' 	=> $vareditip,
						 		);
		$this->db->where('id', $id);
		if( $this->db->update('couponcomments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_couponcomment_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'			=> 'Enable',
							'commentip' 	=> $vareditip,
						);
		$this->db->where('id', $id);
		if( $this->db->update('couponcomments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function search_couponcomment($keyword,$limit ='',$offset='',$sortby = 'commentdate',$orderby = 'DESC')
 	{
	  	$siteid = $this->session->userdata('siteid');
	  	//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
	  
			$this->db->select('c.*, cou.*,u.*,');
			$this->db->from('couponcomments as c');
			$this->db->join('coupon as cou','c.couponid=cou.id');
			$this->db->join('user as u','c.commentby=u.id');
			$this->db->where('cou.websiteid',$siteid);
			$this->db->where('c.comment LIKE \'%'.$keyword.'%\' OR u.firstname LIKE \'%'.$keyword.'%\' OR u.lastname LIKE \'%'.$keyword.'%\' OR cou.title LIKE \'%'.$keyword.'%\' OR cou.promocode LIKE \'%'.$keyword.'%\'', NULL, FALSE);
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
			
			if( $this->db->delete('couponcomments', $this->db->where_in('couponcomments.id',$foo)) )
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
		if( $this->db->update('couponcomments', $data) )
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
		if( $this->db->update('couponcomments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	}
}

?>
