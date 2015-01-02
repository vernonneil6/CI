<?php
Class Sems extends CI_Model
{
	function get_all_sem($id,$siteid)
 	{
		if($siteid!='all')
		{
			$this->db->where('companyid', $id);
			$this->db->where('websiteid', $siteid);
			//Executing Query
			$query = $this->db->get('companysem');
			
			if( $query->num_rows() > 0 )
			{
				return $query->result_array();
			}
			else
			{
				return array();
			}
 		}
		else
		{
			$this->db->limit('5');
			$this->db->order_by('id', 'ASC');
			$this->db->where('companyid', $id);
			//Executing Query
			$query = $this->db->get('companysem');
			
			if( $query->num_rows() > 0 )
			{
				return $query->result_array();
			}
			else
			{
				return array();
			}


		}
}
	
		
	//Updating Record
	function update($id,$title,$url,$imagename,$type)
 	{
		$siteid = $this->session->userdata['siteid'];
		if($siteid!='all')
		{
		$data = array(
						'title' 	=> $title,
						'url' 		=> $url,
						'mainimg' 	=> $imagename,
						'thumbimg' 	=> $imagename
					);
		//echo"<pre>";
		//print_r($data);
		//die();
		$this->db->where('id', $id);
		if( $this->db->update('companysem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		}
		else
		{
			$data = array(
						'title' 	=> $title,
						'url' 		=> $url,
						'mainimg' 	=> $imagename,
						'thumbimg' 	=> $imagename
					);
		//echo"<pre>";
		//print_r($data);
		//die();
		$this->db->where('type', $type);
		if( $this->db->update('companysem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		}
 	}
	
	//Updating Record
	function update_noimage($id,$title,$url,$type)
 	{
		$siteid = $this->session->userdata['siteid'];
		if($siteid!='all')
		{
			
		$data = array(
						'title' 	=> $title,
						'url' 		=> $url,
					);
		//echo"<pre>";
		//print_r($data);
		//die();
		$this->db->where('id', $id);
		if( $this->db->update('companysem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		}
		else
		{
			
			
		$data = array(
						'title' 	=> $title,
						'url' 		=> $url,
					);
		//echo"<pre>";
		//print_r($data);
		//die();
		$this->db->where('type', $type);
		if( $this->db->update('companysem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		
		}
	}
	
	//Getting SEM value for editing
	function get_sems_byid($id)
 	{
		$query = $this->db->get_where('companysem', array('id' => $id));
		
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
		
	//Changing Status to "Disable"
	function disable_sem_byid($id)
	{
		$data = array(
							'status'	=> 'Disable'
						);
		$this->db->where('id', $id);
		if( $this->db->update('companysem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_sem_byid($id)
	{
		$data = array(
							'status'	=> 'Enable'
						);
		$this->db->where('id', $id);
		if( $this->db->update('companysem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
}
?>