<?php
class Pressreleases extends CI_Model
{
	function get_all_pressreleases($limit ='',$offset='')
 	{
		$siteid = $this->session->userdata('siteid');
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->select('p.*,cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('pressrelease as p');
		$this->db->join('company as cm','p.companyid=cm.id');
		$this->db->where('p.status','Enable');
		$this->db->where('p.websiteid',$siteid);
		$this->db->order_by('insertdate', 'DESC');
		
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
	
	//Getting value for editing
	function get_pressrelease_bytitle($title)
 	{
		//Executing Query
		$this->db->select('p.*,cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('pressrelease as p');
		$this->db->join('company as cm','p.companyid=cm.id');
		$this->db->where('p.status','Enable');
		$this->db->where('p.seokeyword',$title);
		
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