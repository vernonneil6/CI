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
		$this->db->select('p.*,cm.company,cm.logo,cm.country,cm.companyseokeyword');
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
	
	
	function get_count_for_pressreleases($cmpid)
 	{
		$siteid = $this->session->userdata('siteid');
		
		$this->db->where('status','Enable');
		$this->db->where('websiteid',$siteid);
		$this->db->where('companyid',$cmpid);
		
		$query = $this->db->count_all_results('pressrelease');
	
		return $query;
		
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
	
	function search_pressrelease($keyword,$limit ='',$offset='')
 	{
	  
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$siteid = $this->session->userdata('siteid');
	  //Executing Query
		$this->db->select('p.*,cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('pressrelease as p');
		$this->db->join('company as cm','p.companyid=cm.id and p.websiteid='.$siteid.'');
		$this->db->where('p.status','Enable');
		$this->db->like('p.title',$keyword);
		$this->db->or_like('cm.company',$keyword);
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
 	function get_my_pressreleases($companyid,$limit ='',$offset='')
 	{
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$siteid = $this->session->userdata('siteid');
		//Executing Query
		$this->db->select('p.*,cm.company,cm.logo,cm.country,cm.companyseokeyword');
		$this->db->from('pressrelease as p');
		$this->db->join('company as cm','p.companyid=cm.id and p.websiteid='.$siteid.'');
		$this->db->where(array('p.status'=>'Enable','cm.id'=>$companyid));
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
}
?>
