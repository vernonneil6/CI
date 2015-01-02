<?php
class Coupons extends CI_Model
{
	function get_all_coupons($siteid,$limit ='',$offset='',$sortby = 'title',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'title': $sortby = 'title';break;
			default 	     : $sortby = 'title';break;
		}
		
		//Ordering Data
		$this->db->where('websiteid',$siteid);
		$this->db->where('type','admin');
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('coupon');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	
	
	//Getting value for editing
	function get_coupon_byid($id)
 	{
		$query = $this->db->get_where('coupon', array('id' => $id));
		
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
	function insert($selcompany,$title,$enddate,$couponimage,$categoryid,$couponcode,$url)
	{
		$siteid = $this->session->userdata('siteid');
		
		//$promocode = uniqid();
		$data = array(
							'companyid' 	=> $selcompany,
							'title' 		=> $title,
							'enddate' 		=> $enddate,
							'image' 		=> $couponimage,
							'status' 		=> 'Enable',
							'categoryid'	=> $categoryid,
							'websiteid'		=> $siteid,
							'promocode'		=> $couponcode,
							'type'			=> 'admin',
							'url'			=> $url
					);

		if( $this->db->insert('coupon', $data) )
		{
			$query3 = $this->db->get_where('company',array('id'=>$selcompany));
			$company = $query3->result_array();
			
			//lower case everything
			$companyname = strtolower($company[0]['company']);
			//make alphaunermic
			$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
			//Clean multiple dashes or whitespaces
			$companyname = preg_replace("/[\s-]+/", " ", $companyname);
			//Convert whitespaces to dash
			$companyname = preg_replace("/[\s]/", "-", $companyname);
			
			$id = $this->db->insert_id();
			//lower case everything
			$title123 = strtolower($title);
			//make alphaunermic
			$title123 = preg_replace("/[^a-z0-9\s-]/", "", $title123);
			//Clean multiple dashes or whitespaces
			$title123 = preg_replace("/[\s-]+/", " ", $title123);
			//Convert whitespaces to dash
			$title123 = preg_replace("/[\s]/", "-", $title123);

			//$companyname = str_replace('.','',$company[0]['company']);
			$seokeyword = $companyname.'-'.$title123.'-coupon-'.$id;
			
			$link = 'coupon/browse/'.$seokeyword;
			
			$data = array('link' 	=> $link,'seokeyword'=>$seokeyword
					);	
			$this->db->where('id', $id);
			$this->db->update('coupon', $data);
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Updating Record
	function update($id,$selcompany,$title,$enddate,$couponimage,$categoryid,$couponcode,$url)
 	{
		$data = array(
							'companyid' 	=> $selcompany,
							'title' 		=> $title,
							'enddate' 		=> $enddate,
							'image' 		=> $couponimage,
							'categoryid'	=> $categoryid,
							'promocode'		=> $couponcode,
							'url'			=> $url
					);
		$this->db->where('id', $id);
		if( $this->db->update('coupon', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
		
	//Changing Status to "Disable"
	function disable_coupon_byid($id)
	{
		$data = array(
						'status'	=> 'Disable'
								);
		$this->db->where('id', $id);
		if( $this->db->update('coupon', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_coupon_byid($id)
	{
		$data = array(
							'status'	=> 'Enable'
								);
		$this->db->where('id', $id);
		if( $this->db->update('coupon', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_coupon_byid($id)
	{
		if( $this->db->delete('coupon', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
		function search_coupon($keyword,$limit ='',$offset='',$sortby = 'title',$orderby = 'ASC')
 		{
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		$siteid = $this->session->userdata('siteid');
		//Executing Query
		$this->db->select('c.*, com.*');
		$this->db->from('coupon as com');
		$this->db->join('company as c','com.companyid=c.id');
		$this->db->where('com.websiteid',$siteid);
		$this->db->where('type','admin');
		$this->db->where('(company LIKE \'%'.$keyword.'%\' OR streetaddress LIKE \'%'.$keyword.'%\' OR email LIKE \'%'.$keyword.'%\' OR siteurl LIKE \'%'.$keyword.'%\' OR aboutus LIKE \'%'.$keyword.'%\' OR title LIKE \'%'.$keyword.'%\' OR promocode LIKE \'%'.$keyword.'%\')', NULL, FALSE);
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
	
	function get_all_categorys($siteid)
 	{
		$this->db->where('websiteid',$siteid);
				
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
	
	function chkfield($id,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'promocode' 				: $varfield = 'promocode';break;
		}
		if($id != 0)
		{
			$option = array('id !=' => $id,$varfield => $fieldvalue);
		}
		else
		{
			$option = array($varfield => $fieldvalue);
		}
		$query = $this->db->get_where('coupon', $option);
		
		//echo $this->db->last_query();
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
		}

 	}
	
	//Getting value for searching
	function searchcompany($field,$fieldvalue)
 	{
	  
	  $this->db->select('id,company');
	  $this->db->from('company');
	  $this->db->like('company',$fieldvalue,'after');

	  $query = $this->db->get();
	 // echo $this->db->last_query();

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