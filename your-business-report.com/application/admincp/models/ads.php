<?php
class Ads extends CI_Model
{
	function get_all_ads($siteid,$limit ='',$offset='',$sortby = 'insertdate',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('ads');
		
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
	function insert($zone,$url,$image,$siteid,$page,$categoryid)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(		'websiteid'		=> $siteid,
							'zone' 			=> $zone,
							'url' 			=> $url,
							'insertdate'	=> $date,
							'insertip'		=> $varipaddress,
							'image' 		=> $image,
							'status' 		=> 'Enable',
							'page'			=> $page,
							'categoryid'	=> $categoryid
					);

		if( $this->db->insert('ads', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Updating Record
	function update($id,$zone,$url,$image,$page,$categoryid)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'zone' 		=> $zone,
							'url' 		=> $url,
							'image' 	=> $image,
							'editdate' 	=> $date,
							'editip' 	=> $varipaddress,
							'page'		=> $page,
							'categoryid'=> $categoryid
					);
		$this->db->where('id', $id);
		if( $this->db->update('ads', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function update_noimage($id,$zone,$url,$page,$categoryid)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'zone' 		=> $zone,
							'url' 		=> $url,
							'editdate' 	=> $date,
							'editip' 	=> $varipaddress,
							'page'		=> $page,
							'categoryid'=> $categoryid
					);
		$this->db->where('id', $id);
		if( $this->db->update('ads', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	//Getting value for editing
	function get_ad_byid($id)
 	{
		$query = $this->db->get_where('ads', array('id' => $id));
		
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
	function disable_ad_byid($id)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'	=> 'Disable',
						'editdate'	=> $date,
						'editip'	=> $varipaddress
						
						
								);
		$this->db->where('id', $id);
		if( $this->db->update('ads', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_ad_byid($id)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$data = array(	'status'	=> 'Enable',
						'editdate'	=> $date,
						'editip'	=> $varipaddress
							);
		$this->db->where('id', $id);
		if( $this->db->update('ads', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_ad_byid($id)
	{
		if( $this->db->delete('ads', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for searching
	function search_ad($keyword,$siteid,$sortby = 'insertdate',$orderby = 'DESC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	$this->db->select('*');
	  	$this->db->from('ads');
		$this->db->where('websiteid',$siteid);
	  	$this->db->where('(url LIKE \'%'.$keyword.'%\' OR zone LIKE \'%'.$keyword.'%\' OR page LIKE \'%'.$keyword.'%\')', NULL, FALSE);
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
}
?>