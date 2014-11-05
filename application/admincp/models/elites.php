<?php
class Elites extends CI_Model
{
	function get_all_elitemembers($limit ='',$offset='',$sortby = 'payment_date',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('elite');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function search_elitemember($keyword,$limit ='',$offset='',$sortby = 'company',$orderby = 'ASC')
 	{
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->select('e.*, c.*');
		$this->db->from('elite as e');
		$this->db->join('company as c','e.company_id=c.id');
		$this->db->or_like(array('company'=> $keyword , 'streetaddress'=> $keyword , 'email'=> $keyword , 'siteurl'=> $keyword , 'aboutus' => $keyword));
		
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
	
	function get_subscription_by_id($id)
 	{
		$query = $this->db->get_where('subscription',array('id'=>$id));
		
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
		if($type=='Disable')
		{
			$vareditip = $_SERVER['REMOTE_ADDR'];
			$data = array(
							'status'		=> 'Disable',
							
							
						);
		$this->db->where_in('company_id', $foo);
		if( $this->db->update('elite', $data) )
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
