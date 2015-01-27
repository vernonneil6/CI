<?php
Class Widgets extends CI_Model
{
	function get_reviews_bycompanyid($id,$limit='',$offset='')
 	{
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$siteid = $this->session->userdata('siteid');
		$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,u.firstname,u.lastname,u.username,u.avatarbig,u.gender');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$this->db->where('r.companyid',$id);
		//$this->db->where('r.status','Enable');
		//$this->db->where('r.websiteid',$siteid);
		$this->db->order_by('r.reviewdate','DESC');
		
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
