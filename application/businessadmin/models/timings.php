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
	function update($id,$daytype,$off,$start,$end)
 	{
		$data = array(	'off'		=> $off,
						'start' 	=> $start,
						'end'		=> $end
								);
		
		$this->db->where('daytype', $daytype);
		$this->db->where('id', $id);
		
		if( $this->db->update('timings', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
 	
 	//get_company_timings
	function get_company_timings($cid)
	{
		//Executing Query
		$this->db->select('*');
		$this->db->from('timings');
		$this->db->where('companyid',$cid);
		$this->db->order_by('id','ASC');
		
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
	
	function set_timing($websiteid,$companyid,$daytype,$off,$start,$end)
	{
		$data = array(		'websiteid' => $websiteid,
							'companyid' => $companyid,
							'daytype'	=> $daytype,
							'off' 		=> $off,
							'start'		=> $start,
					    	'end'		=> $end,
							
						);
		
		if( $this->db->insert('timings', $data) )
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
