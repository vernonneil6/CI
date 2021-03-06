<?php
Class Categorys extends CI_Model
{
	function get_all_categorys($siteid,$limit ='',$offset='',$sortby = 'category',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'category' : $sortby = 'category';break;
			default 	    : $sortby = 'category';break;
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
		$query = $this->db->get('category');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	function categoriesSearch($keyword, $siteid, $limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('category','status');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : '';
		
		
		// results query
		$q = $this->db->select('*')
			->from('category')		
			->where('websiteid',$siteid);		
		
		// limit query
		if(!empty($limit)){
			$q->limit($limit, $offset);		
		}
		
		if(!empty($sort_by) && !empty($sort_order)){
			$q->order_by($sort_by, $sort_order);
		}
		
		// search query
		if (strlen($keyword)) {
			$q->where('(category LIKE \'%'.$keyword.'%\')', NULL, FALSE);
		}
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('category')
			->where('websiteid',$siteid);
		
		// search query
		if (strlen($keyword)) {
			$q->where('(category LIKE \'%'.$keyword.'%\')', NULL, FALSE);
		}
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
 	
	
	//Inserting Record
	function insert($category,$siteid,$image)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'websiteid'		=> $siteid,
							'category' 		=> $category,
							'status' 		=> 'Enable',
							'insertip' 		=> $varipaddress,
							'insertdate'	=> $date,
							'image'			=> $image
						);

		if( $this->db->insert('category', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_category_byid($id)
 	{
		$query = $this->db->get_where('category', array('id' => $id));
		
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
	function update($id,$category,$image)
 	{
		$data = array('category' 	=> $category,
					  'image'		=> $image);
		$this->db->where('id', $id);
		if( $this->db->update('category', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	//Changing Status to "Disable"
	function disable_category_byid($id)
	{
		$data = array(	'status'		=> 'Disable' );
		$this->db->where('id', $id);
		if( $this->db->update('category', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_category_byid($id)
	{
		$data = array(	'status'	=> 'Enable'	);
		$this->db->where('id', $id);
		if( $this->db->update('category', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_category_byid($id)
	{
		if( $this->db->delete('category', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for searching
	function search_category($keyword,$siteid,$limit ='',$offset='',$sortby = 'category',$orderby = 'ASC')
 	{
	  	//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
	  
	  	$this->db->select('*');
	  	$this->db->from('category');
	  	$this->db->where('websiteid',$siteid);
		$this->db->where('(category LIKE \'%'.$keyword.'%\')', NULL, FALSE);
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
