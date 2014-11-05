<?php
class Complaints extends CI_Model
{
	function get_all_complaints($siteid,$limit ='',$offset='',$sortby = 'complaindate',$orderby = 'DESC')
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
		$query = $this->db->get('complaints');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_all_removedcomplaints($siteid,$limit ='',$offset='',$sortby = 'id',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get_where('complaints',array('status'=>'Disable','transactionid !='=>'','websiteid'=>$siteid));
		
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
	function get_complaint_byid($id)
 	{
		$query = $this->db->get_where('complaints', array('id' => $id));
		
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
	function update($intid,$complainttype,$damagesinamt,$whendate,$location,$detail,$comseokeyword)
 	{
		$editdate = date('Y-m-d');
		$complainip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'type'					=> $complainttype,
							'damagesinamt'	=> $damagesinamt,
							'whendate' 			=> $whendate,
							'location' 			=> $location,
							'detail' 				=> $detail,
							'complaindate'	=> $editdate,
							'complainip' 		=> $complainip,
							'comseokeyword'	=> $comseokeyword,
						);
			//echo "<pre>";
			//print_r($data);
			//die();
		$this->db->where('id', $intid);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Function for Deleting Record
	
	function delete_complaint_byid($id)
	{
		if( $this->db->delete('complaints', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Disable"
	function disable_complaint_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'			=> 'Disable',
						'complainip' 	=> $vareditip,
						 		);
		$this->db->where('id', $id);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_complaint_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'			=> 'Enable',
							'complainip' 	=> $vareditip,
							
						);
		$this->db->where('id', $id);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Querying to Check Seokeyword is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		if($id != 0)
		{
			$option = array( 'id !=' => $id, $field => $fieldvalue );
		}
		else
		{
			$option = array( $field => $fieldvalue );
		}
		$query = $this->db->get_where('complaints', $option);
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
	function search_complaint($keyword,$siteid,$limit ='',$offset='',$sortby = 'id',$orderby = 'DESC')
 	{
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
			$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.firstname,u.lastname,u.avatarbig,u.gender');
			$this->db->from('complaints as c');
			$this->db->join('company as cm','c.companyid=cm.id');
			$this->db->join('user as u','c.userid=u.id');
			$this->db->where('c.websiteid',$siteid);
			$this->db->where('(c.detail LIKE \'%'.$keyword.'%\' OR c.location LIKE \'%'.$keyword.'%\' OR c.username LIKE \'%'.$keyword.'%\' OR cm.company LIKE \'%'.$keyword.'%\' OR c.damagesinamt LIKE \'%'.$keyword.'%\' OR c.comseokeyword LIKE \'%'.$keyword.'%\' OR cm.companyseokeyword LIKE \'%'.$keyword.'%\')', NULL, FALSE);
			$query = $this->db->get();
			//echo "<pre>";
			//echo $this->db->last_query();
			//die();

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
			
			if( $this->db->delete('complaints', $this->db->where_in('complaints.id',$foo)) )
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
							'complainip' 	=> $vareditip,
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('complaints', $data) )
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
							'complainip' 	=> $vareditip,
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('complaints', $data) )
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
