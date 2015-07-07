<?php
class Reviewpromos extends CI_Model
{
	function get_all_reviewpromos($siteid,$limit ='',$offset='',$sortby,$orderby)
 	{
		switch($sortby)
		{
			case 'date'	: $sortby = 'datecreated';break;
			case 'code'	: $sortby = 'code';break;
			default 	    : $sortby = 'name';break;
		}
		$companyid = $this->session->userdata['youg_admin']['id'];
		//Ordering Data
		if($siteid!='all')
		{
		$this->db->where('websiteid',$siteid);
		}
		$this->db->where('companyid',$companyid);
		//$this->db->where('type','elite');
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('reviewpromo');
		
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
	function get_reviewpromo_byid($id)
 	{
		$query = $this->db->get_where('reviewpromo', array('id' => $id));
		
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
	
	function insert($title,$datecreated,$reviewpromoimage,$status,$reviewpromocode,$summary)
	{
		$companyid = $this->session->userdata['youg_admin']['id'];
		$siteid = $this->session->userdata('siteid');
		
		if($siteid!='all')
		{
		//$promocode = uniqid();
		$data = array(
							'companyid' 	=> $companyid,
							'name' 		    => $title,
							'datecreated' 	=> $datecreated,
							'image' 		=> $reviewpromoimage,
							'status' 		=> $status,
							'websiteid'		=> $siteid,
							'code'		    => $reviewpromocode,
							'text'			=> $summary
					);

		if( $this->db->insert('reviewpromo', $data) )
		{
			
			/*$query3 = $this->db->get_where('company',array('id'=>$companyid));
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
			$seokeyword = $companyname.'-'.$title123.'-reviewpromo-'.$id;
			
			$link = 'reviewpromo/browse/'.$seokeyword;
			
			$data = array('link' 	=> $link,'seokeyword' 	=> $seokeyword
					);	
			$this->db->where('id', $id);
			$this->db->update('reviewpromo', $data);*/
			
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
							'image' 		=> $reviewpromoimage,
							'status' 		=> 'Enable',
							'categoryid'	=> $categoryid,
							'websiteid'		=> $i,
							'promocode'		=> $reviewpromocode,
							'type'			=> 'elite',
							'url'			=> $url
					);

		if( $this->db->insert('reviewpromo', $data) )
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
			$seokeyword = $companyname.'-'.$title123.'-reviewpromo-'.$id;
			
			$link = 'reviewpromo/browse/'.$seokeyword;
			
			$data = array('link' 	=> $link,'seokeyword' 	=> $seokeyword
					);	
			$this->db->where('id', $id);
			$this->db->update('reviewpromo', $data);
			
			
		
		}
		else
		{}
			}
	return true;*/
	$data = array(
							'companyid' 	=> $companyid,
							'name' 		    => $title,
							'datecreated' 	=> $datecreated,
							'image' 		=> $reviewpromoimage,
							'status' 		=> $status,
							'websiteid'		=> $siteid,
							'code'		    => $reviewpromocode,
							'text'			=> $summary
					);

		if( $this->db->insert('reviewpromo', $data) )
		{
			
			/*$query3 = $this->db->get_where('company',array('id'=>$companyid));
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
			$seokeyword = $companyname.'-'.$title123.'-reviewpromo-'.$id;
			
			$link = 'reviewpromo/browse/'.$seokeyword;
			
			$data = array('link' 	=> $link,'seokeyword' 	=> $seokeyword
					);	
			$this->db->where('id', $id);
			$this->db->update('reviewpromo', $data);*/
			
			return true;
		
		}
		else
		{
			return false;
		}
	
	
	
	
	}
}
	
	//Updating Record
	function update($id,$title,$datecreated,$reviewpromoimage,$status,$reviewpromocode,$summary)
 	{
		$data = array(
							'name' 		   => $title,
							'datecreated'  => $datecreated,
							'image' 	   => $reviewpromoimage,
							'status'	   => $status,
							'code'		   => $reviewpromocode,
							'text'		   => $summary
					);
		$this->db->where('id', $id);
		if( $this->db->update('reviewpromo', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
		
	//Changing Status to "Disable"
	function disable_reviewpromo_byid($id)
	{
		$data = array(
						'status'	=> 'Disable'
								);
		$this->db->where('id', $id);
		if( $this->db->update('reviewpromo', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_reviewpromo_byid($id)
	{
		$data = array(
							'status'	=> 'Enable'
								);
		$this->db->where('id', $id);
		if( $this->db->update('reviewpromo', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_reviewpromo_byid($id)
	{
		if( $this->db->delete('reviewpromo', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
		function search_reviewpromo($keyword,$limit ='',$offset='',$sortby = 'name',$orderby = 'ASC')
 		{
		
		//Ordering Data
		//$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$companyid = $this->session->userdata['youg_admin']['id'];
		$siteid = $this->session->userdata('siteid');
		
			$this->db->select('c.*, com.*');
			$this->db->from('reviewpromo as com');
			$this->db->join('company as c','com.companyid=c.id');
			if($siteid!='all'){
			$this->db->where('websiteid',$siteid);
			}
			$this->db->where('companyid',$companyid);
			$this->db->where('(c.company LIKE \'%'.$keyword.'%\' OR c.streetaddress LIKE \'%'.$keyword.'%\' OR c.email LIKE \'%'.$keyword.'%\' OR c.siteurl LIKE \'%'.$keyword.'%\' OR c.aboutus LIKE \'%'.$keyword.'%\' OR com.name LIKE \'%'.$keyword.'%\' OR com.code LIKE \'%'.$keyword.'%\')', NULL, FALSE);
			
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
			case 'code' 				: $varfield = 'code';break;
		}
		if($id != 0)
		{
			$option = array('id !=' => $id,$varfield => $fieldvalue);
		}
		else
		{
			$option = array($varfield => $fieldvalue);
		}
		$query = $this->db->get_where('reviewpromo', $option);
		
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
