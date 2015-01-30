<?php
Class Discounts extends CI_Model
{
	function get_all_discounts($limit ='',$offset='',$sortby = 'percentage',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			default 	    : $sortby = 'addeddate';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('discount');
		
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
	function insert($title,$percentage,$discounttype,$discountprice)
	{
		
		$notused=2;
		if($percentage==101 || $percentage==102){
			
			  if($percentage==101){
					$percentage="30 Days Free Trial"; 
				 } else { 
				$percentage="30 Days Free Trial+ Low Price";  
			  }
		}
		$date=date('Y-m-d H:i:s');
		$code = uniqid();
		$data = array(		'title' 		     => $title,
							'status' 		     => 'Enable',
							'percentage' 	     => $percentage,
							'code'			     => $code,
							'discountcodetype'	 => $discounttype,
							'discountprice'	     => $discountprice,
							'apply'	             => $notused,
							'addeddate'	         => $date,
					);

		if( $this->db->insert('discount', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_discount_byid($id)
 	{
		$query = $this->db->get_where('discount', array('id' => $id));
		
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
	function update($id,$title,$percentage,$discounttype,$discountprice)
 	{
		
		$editdate=date('Y-m-d H:i:s');
		if($percentage==101 || $percentage==102){
			
			  if($percentage==101){
					$percentage="30 Days Free Trial"; 
				 } else { 
				$percentage="30 Days Free Trial+ Low Price";  
			  }
		}
		$data = array('title' 		 => $title,
		              'percentage'   => $percentage,
		              'discountcodetype' => $discounttype, 
		              'discountprice' => $discountprice, 
		              'modifieddate' =>$editdate, 
		              );
		$this->db->where('id', $id);
		if( $this->db->update('discount', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	//Changing Status to "Disable"
	function disable_discount_byid($id)
	{
		$data = array(	'status'		=> 'Disable' );
		$this->db->where('id', $id);
		if( $this->db->update('discount', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_discount_byid($id)
	{
		$data = array(	'status'	=> 'Enable'	);
		$this->db->where('id', $id);
		if( $this->db->update('discount', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_discount_byid($id)
	{
		if( $this->db->delete('discount', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for searching
	function search_discount($keyword,$limit ='',$offset='',$sortby = 'percentage',$orderby = 'ASC')
 	{
	  	//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
	  
	  	$this->db->select('*');
	  	$this->db->from('discount');
	  	$this->db->or_like(array('percentage'=> $keyword,'title'=> $keyword ) );

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
