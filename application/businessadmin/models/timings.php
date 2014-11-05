<?php
class Timings extends CI_Model
{
	function get_all_timings($id,$siteid)
 	{
			$this->db->where('websiteid', 1);	
			$this->db->where('companyid', $id);
			$this->db->order_by('id','ASC');
		
			$query = $this->db->get('timings');
		
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
	function update($companyid,$daytype,$off,$start,$end)
 	{
		$data = array(	'off'		=> $off,
						'start' 	=> $start,
						'end'		=> $end
								);
		
		$this->db->where('daytype', $daytype);
		$this->db->where('companyid', $companyid);
		
		if( $this->db->update('timings', $data) )
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