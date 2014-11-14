<?php
Class Disputes extends CI_Model
{
	function get_all_disputesetting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
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
 	
 	function listdisputes()
	{
		return $this->db->get('youg_dispute')->result();
	}
 	
 	function reviewdispute($id)
	{
		return $this->db->get_where('youg_dispute',array('id'=>$id))->row_array();
	}
 	function listdispute($limit ='',$offset='')
 	{
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('youg_dispute');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
 	}
 	public function dispute_count()
	{
		$query = $this->db->count_all('youg_dispute');
		return $query;
	}
 	
 	
}
?>
