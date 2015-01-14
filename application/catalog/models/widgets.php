<?php
Class Widgets extends CI_Model
{
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
	
	//Getting total review by comapany id
	function get_total_review($comapany_id=0)
 	{
		$this->db->select('rate');
		$this->db->from('reviews as r');
		$this->db->where('r.companyid',$comapany_id);
		$this->db->where('r.status','Enable');
		
		$query = $this->db->get();
		return $query->num_rows();
 	}
 	
	//Getting total review by comapany id
	function get_review_list_by_companyid($comapany_id=0)
 	{
		$this->db->select('reviewtitle,rate,comment,reviewby,reviewdate,link');
		$this->db->from('reviews as r');
		$this->db->where('r.companyid',$comapany_id);
		$this->db->where('r.status','Enable');
		
		$query = $this->db->get();
		return $query->result_array();
 	}
	
	//Getting average review by comapany id
	function get_average_review($comapany_id=0)
 	{
		$this->db->select('AVG(rate) AS total');
		$this->db->from('reviews as r');
		$this->db->where('r.companyid',$comapany_id);
		$this->db->where('r.status','Enable');
		
		$query = $this->db->get();
		//echo $this->db->last_query();die();
		if ($query->num_rows() > 0)
		{
			$review = $query->result_array();
			return round($review[0]['total'],2);
		}
		else
		{
			return 0;
		}
 	}
	
	function get_all_websites()
 	{
		$this->db->select('*');
		$this->db->from('url');
		//$this->db->where('status','Enable');
		
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
}
?>
