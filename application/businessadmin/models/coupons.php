<?php
class Coupons extends CI_Model
{
	function get_all_coupons($siteid,$limit ='',$offset='',$sortby,$orderby)
 	{
		switch($sortby)
		{
			case 	'enddate'    : $sortby = 'enddate';break;
			case 	'promocode'  : $sortby = 'promocode';break;
			case 	'company'	 : $sortby = 'companyid';break;
			default 	   		 : $sortby = 'title';break;
		}
		$companyid = $this->session->userdata['youg_admin']['id'];
		//Ordering Data
		if($siteid!='all')
		{
		$this->db->where('websiteid',$siteid);
		}
		$this->db->where('companyid',$companyid);
		$this->db->where('type','elite');
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
	function insert($title,$enddate,$couponimage,$categoryid,$couponcode,$url)
	{
		$companyid = $this->session->userdata['youg_admin']['id'];
		$siteid = $this->session->userdata('siteid');
		
		if($siteid!='all')
		{
		//$promocode = uniqid();
		$data = array(
							'companyid' 	=> $companyid,
							'title' 		=> $title,
							'enddate' 		=> $enddate,
							'image' 		=> $couponimage,
							'status' 		=> 'Enable',
							'categoryid'	=> $categoryid,
							'websiteid'		=> $siteid,
							'promocode'		=> $couponcode,
							'type'			=> 'elite',
							'url'			=> $url
					);

		if( $this->db->insert('coupon', $data) )
		{
			$query3 = $this->db->get_where('company',array('id'=>$companyid));
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
			
			$data = array('link' 	=> $link,'seokeyword' 	=> $seokeyword
					);	
			$this->db->where('id', $id);
			$this->db->update('coupon', $data);
			
			return true;
		
		}
		else
		{
			return false;
		}
	}else
	{
		/*for($i=1;$i<17;$i++)
			{
				$data = array(
							'companyid' 	=> $companyid,
							'title' 		=> $title,
							'enddate' 		=> $enddate,
							'image' 		=> $couponimage,
							'status' 		=> 'Enable',
							'categoryid'	=> $categoryid,
							'websiteid'		=> $i,
							'promocode'		=> $couponcode,
							'type'			=> 'elite',
							'url'			=> $url
					);

		if( $this->db->insert('coupon', $data) )
		{
			$query3 = $this->db->get_where('company',array('id'=>$companyid));
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
			
			$data = array('link' 	=> $link,'seokeyword' 	=> $seokeyword
					);	
			$this->db->where('id', $id);
			$this->db->update('coupon', $data);
			
			
		
		}
		else
		{}
			}
	return true;*/
	$data = array(
							'companyid' 	=> $companyid,
							'title' 		=> $title,
							'enddate' 		=> $enddate,
							'image' 		=> $couponimage,
							'status' 		=> 'Enable',
							'categoryid'	=> $categoryid,
							'websiteid'		=> 1,
							'promocode'		=> $couponcode,
							'type'			=> 'elite',
							'url'			=> $url
					);

		if( $this->db->insert('coupon', $data) )
		{
			$query3 = $this->db->get_where('company',array('id'=>$companyid));
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
			
			$data = array('link' 	=> $link,'seokeyword' 	=> $seokeyword
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
}
	
	//Updating Record
	function update($id,$title,$enddate,$couponimage,$categoryid,$couponcode,$url)
 	{
		$data = array(
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
	
		function search_coupon($keyword,$limit ='',$offset='',$sortby = 'company',$orderby = 'ASC')
 		{
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$companyid = $this->session->userdata['youg_admin']['id'];
		$siteid = $this->session->userdata('siteid');
		
			$this->db->select('c.*, com.*');
			$this->db->from('coupon as com');
			$this->db->join('company as c','com.companyid=c.id');
			if($siteid!='all'){
			$this->db->where('websiteid',$siteid);
			}
			$this->db->where('com.companyid',$companyid);
			$this->db->where('(c.company LIKE \'%'.$keyword.'%\' OR com.title LIKE \'%'.$keyword.'%\' OR com.promocode LIKE \'%'.$keyword.'%\')', NULL, FALSE);
			
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
		if($siteid!='all')
		{
			$this->db->where('websiteid',$siteid);
			//Executing Query
			$query = $this->db->get('category');
		}
		else
		{
			$this->db->group_by('category');
			//Executing Query
			$query = $this->db->get('category');	
		}
				
		
		
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
	
	//Getting value for editing
	function get_company_byid($id)
 	{
		$query = $this->db->get_where('company', array('id' => $id));
		
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
