<?php
class Coupons extends CI_Model
{
	function get_all_coupons($limit ='',$offset='')
 	{
		$siteid = $this->session->userdata('siteid');
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,ct.category');
		$this->db->from('coupon as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->join('category as ct','c.categoryid=ct.id');
		$this->db->where('c.status','Enable');
		$this->db->where('c.websiteid',$siteid);
		$this->db->order_by('c.enddate','DESC');
		
		$query = $this->db->get();
	
		
		
		if ($query->num_rows() > 0)
		{
			//echo "<pre>";
			//print_r($query->result_array());
			//die();
			return  $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_all_companies()
 	{
		$query = $this->db->get_where('company',array('status'=>'Enable'));
	
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
	function get_coupon_byid($id)
 	{
		//$this->db->select('c.*, cm.company,cm.logo,u.firstname,u.lastname,u.avatarbig,u.gender');
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,ct.category');
		$this->db->from('coupon as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->join('category as ct','c.categoryid=ct.id');
		$this->db->where('c.id',$id);
		$this->db->where('c.status','Enable');
		
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
	
		//Getting value for editing
	function get_company_byseokeyword($word)
 	{
		$query = $this->db->get_where('company', array('companyseokeyword' => $word));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	function get_company_bycouponseokeyword($word)
 	{
		$query = $this->db->get_where('coupon', array('seoslug' => $word));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
 	}
 	
	
	function get_coupon_bycompanyid($id,$couponid='')
 	{
		$siteid = $this->session->userdata('siteid');
		
		if($couponid=='')
		{
			$query = $this->db->get_where('coupon', array('companyid' => $id,'websiteid' => $siteid));
		}
		else
		{
			$query = $this->db->get_where('coupon', array('companyid' => $id,'websiteid' => $siteid,'id !=' => $couponid));
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
	
		
	function get_all_searchs($siteid)
 	{
		$siteid = $this->session->userdata('siteid');
		//Executing Query
		$query = $this->db->get_where('searches',array('status'=>'Enable','websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//get comments by reviewid
	function get_comments_bycouponid($couponid,$limit='',$offset='',$sortby='commentdate',$orderby='DESC')
 	{
		$siteid = $this->session->userdata('siteid');
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		
		$query = $this->db->get_where('couponcomments',array('couponid'=>$couponid,'status'=>'Enable','websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{	
			return $query->result_array();
		}
		else
		{
			return array();
		}

	}
	
	function get_comment_byid($id)
 	{
		//Executing Query
		$query = $this->db->get_where('couponcomments',array('status'=>'Enable','id'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function insert_comment($couponid,$userid,$comment)
 	{
		$siteid = $this->session->userdata('siteid');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		//Executing Query
		$data = array(	'couponid'		=>$couponid,
						'comment'		=>$comment,
						'status'		=>'Enable',
						'commentby'		=>$userid,
						'commentdate'	=>$date,
						'commentip'		=>$varipaddress,
						'websiteid'		=>$siteid);
		if ($this->db->insert('couponcomments',$data))
		{
			return "added";
		}
		else
		{
			return false;
		}
 	}
	
	
	function update_comment($id,$comment)
 	{
		//Executing Query
		$data = array('comment'=>$comment);
		$this->db->where('id',$id);
		if ($this->db->update('couponcomments',$data))
		{
			return "updated";
		}
		else
		{
			return false;
		}
 	}

	function delete_comment($id)
 	{
		$this->db->where('id',$id);
		if ($this->db->delete('couponcomments'))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Getting value for editing
	function get_coupon_byseokeyword($word)
 	{
		//$this->db->select('c.*, cm.company,cm.logo,u.firstname,u.lastname,u.avatarbig,u.gender');
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,ct.category');
		$this->db->from('coupon as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->join('category as ct','c.categoryid=ct.id');
		$this->db->where('c.seokeyword',$word);
		$this->db->where('c.status','Enable');
		
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
	function get_coupon_by_seoslug($word)
 	{
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,ct.category');
		$this->db->from('coupon as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->join('category as ct','c.categoryid=ct.id');
		$this->db->where('c.seoslug',$word);
		$this->db->where('c.status','Enable');
		
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
	function user_image()
	{
		return $this->db->get('youg_company')->result();
	}
	
	}
?>
