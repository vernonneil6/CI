<?php
class Videos extends CI_Model
{
	function get_all_videos($id,$siteid)
 	{
		
		if($siteid!='all')
		{
			$this->db->where('websiteid', $siteid);	
			$this->db->where('companyid', $id);
		
			$query = $this->db->get('video');
		
			if ($query->num_rows() > 0)
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
			$this->db->limit(1);
			$this->db->where('companyid', $id);
			$this->db->where('videono', 'video1');
			$query1 = $this->db->get('video');
			
			$a = $query1->result_array();
			
			$this->db->limit(1);	
			$this->db->where('companyid', $id);
			$this->db->where('videono', 'video2');
			$query2 = $this->db->get('video');
			
			$b = $query2->result_array();
			
			if(count($a)>0 || count($b)>0)
			{
				return array_merge($a,$b);
			}
			else
			{
				return array();
			}
		}
		}
		
 	
	
	//Getting value for editing
	function get_video_byid($id)
 	{
		$query = $this->db->get_where('video', array('id' => $id));
		
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
	function update($id,$title,$videourl,$videono)
 	{
		$data = array(	'title'			=> $title,
							'videourl' 		=> $videourl,
								);
		
		$siteid = $this->session->userdata('siteid');
		
		$companyid=$this->session->userdata['youg_admin']['id'];
		
		if($siteid!='all')
		{
			$this->db->where('id', $id);	
		}
		else
		{
			$this->db->where('companyid', $companyid);
			$this->db->where('videono', $videono);
			
		}
		
		if( $this->db->update('video', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Changing Status to "Disable"
	function disable_video_byid($id)
	{
		$data = array(	'status'	=> 'Disable');
		$this->db->where('id', $id);
		if( $this->db->update('video', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_video_byid($id)
	{
		$data = array(
							'status'	=> 'Enable'
								);
		$this->db->where('id', $id);
		if( $this->db->update('video', $data) )
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