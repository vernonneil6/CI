<?php
class Reviews extends CI_Model
{
	function get_all_reviews($limit ='',$offset='',$sortby ,$orderby)
 	{
		switch($sortby)
		{
			case 'ip' 			: $sortby = 'reviewip';break;
			case 'by' 			: $sortby = 'firstname';break;
			case 'to' 			: $sortby = 'company';break;
			case 'review' 		: $sortby = 'comment';break;
			case 'reviewdate' 	: $sortby = 'reviewdate';break;
			default 			: $sortby = 'company';break;
		}
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$this->db->select('r.*,c.company,c.logo,u.avatarbig,u.firstname,u.lastname');
		$this->db->from('reviews as r');
		$this->db->join('company as c','r.companyid=c.id');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$query = $this->db->get();
		
		$query->result_array();
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	function reviewsSearch($keyword, $limit, $offset = 0, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('reviewip', 'firstname','company','comment','reviewdate');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : '';
		
		// results query
		$q = $this->db->select('r.*,c.company,c.logo,u.avatarbig,u.firstname,u.lastname')
			->from('reviews as r')
			->join('company as c','r.companyid=c.id','left')
			->join('user as u','r.reviewby=u.id','left');
			
		// limit query
		if(!empty($limit)){
			$q->limit($limit, $offset);		
		}
		
		if(!empty($sort_by) && !empty($sort_order)){
			$q->order_by($sort_by, $sort_order);
		}	
		
		// search query
		if (strlen($keyword)) {							
			$q->or_like(array('u.firstname'=> $keyword , 'u.lastname'=> $keyword , 'r.comment' => $keyword , 'c.company'=> $keyword , 'c.streetaddress' => $keyword , 'c.aboutus' => $keyword, "CONCAT(u.firstname, ' ', u.lastname)" => $keyword ) );							
		}
		
		
		$ret['rows'] = $q->get()->result();
			
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)	 
			->from('reviews as r')
			->join('company as c','r.companyid=c.id','left')
			->join('user as u','r.reviewby=u.id','left');	
		
		// search query
		if (strlen($keyword)) {							
			
			$q->or_like(array('u.firstname'=> $keyword , 'u.lastname'=> $keyword , 'r.comment' => $keyword , 'c.company'=> $keyword , 'c.streetaddress' => $keyword , 'c.aboutus' => $keyword, "CONCAT(u.firstname, ' ', u.lastname)" => $keyword ) );
		}
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
 	
 	
 	//search user
	function search_review($keyword,$limit='',$offset='',$sortby = 'reviewdate',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		//$siteid = $this->session->userdata('siteid');
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
				
		$this->db->select('r.*,c.company,c.logo,u.avatarbig,u.firstname,u.lastname');
		$this->db->from('reviews as r');
		$this->db->join('company as c','r.companyid=c.id');
		$this->db->join('user as u','r.reviewby=u.id','left');
		//$this->db->where('r.websiteid',$siteid);
		$this->db->where('(r.comment LIKE \'%'.$keyword.'%\' OR u.firstname LIKE \'%'.$keyword.'%\' OR u.lastname LIKE \'%'.$keyword.'%\' OR c.company LIKE \'%'.$keyword.'%\' OR c.streetaddress LIKE \'%'.$keyword.'%\' OR c.aboutus LIKE \'%'.$keyword.'%\')', NULL, FALSE);
		//$this->db->where('(email LIKE \'%'.$email.'%\')', NULL, FALSE);
		$query = $this->db->get();
		
		$query->result_array();
		//echo "<pre>";
		//print_r($query->result_array());
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
	
	//Getting review value for editing
	function get_review_byid($id)
 	{
		$query = $this->db->get_where('reviews', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	function select_review_date($companyid, $userid, $reviewid)
	{
		$query = $this->db->get_where('youg_review_date',array('company_id'=>$companyid,'user_id'=>$userid, 'review_id'=>$reviewid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
    function select_removal_review_date($companyid, $userid, $reviewid,$orderby)
	{
		$query = $this->db->order_by('id', $orderby)->get_where('youg_review_date',array('company_id'=>$companyid,'user_id'=>$userid, 'review_id'=>$reviewid));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	//Getting review value for editing
	function get_comment_byid($id)
 	{
		$query = $this->db->get_where('comments', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Changing Status to "Disable"
	function disable_review_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'		=> 'Disable',
						'reviewip' 	=> $vareditip,
						 		);
		$this->db->where('id', $id);
		if( $this->db->update('reviews', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_review_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'		=> 'Enable',
							'reviewip' 	=> $vareditip,
							
						);
		$this->db->where('id', $id);
		if( $this->db->update('reviews', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_all_comments($id,$limit ='',$offset='',$sortby = 'commentdate',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		
		$query = $this->db->get_where('comments',array('reviewid'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
		//Changing Status to "Disable"
	function disable_comment_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'			=> 'Disable',
						'commentip' 	=> $vareditip,
						 		);
		$this->db->where('id', $id);
		if( $this->db->update('comments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_comment_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'			=> 'Enable',
							'commentip' 	=> $vareditip,
							
						);
		$this->db->where('id', $id);
		if( $this->db->update('comments', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//search user count
	function search_review_count($keyword)
 	{
		//Ordering Data
		//$siteid = $this->session->userdata('siteid');
				
		$this->db->select('r.*,c.company,c.logo,u.avatarbig,u.firstname,u.lastname');
		$this->db->from('reviews as r');
		$this->db->join('company as c','r.companyid=c.id');
		$this->db->join('user as u','r.reviewby=u.id','left');
		//$this->db->where('r.websiteid',$siteid);
		$this->db->where('(r.comment LIKE \'%'.$keyword.'%\' OR u.firstname LIKE \'%'.$keyword.'%\' OR u.lastname LIKE \'%'.$keyword.'%\' OR c.company LIKE \'%'.$keyword.'%\' OR c.streetaddress LIKE \'%'.$keyword.'%\' OR c.aboutus LIKE \'%'.$keyword.'%\')', NULL, FALSE);
		//$this->db->where('(email LIKE \'%'.$email.'%\')', NULL, FALSE);
		return $this->db->count_all_results();
		
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
	
	function multiple_function($type,$foo)
	{
		if($type=='Delete')
		{
			
			if( $this->db->delete('reviews', $this->db->where_in('reviews.id',$foo)) )
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
							
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('reviews', $data) )
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
							
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('reviews', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	}
	
	function removed_review($sortby,$orderby)
	{
		switch($sortby)
		{
			case 'title' 			: $sortby = 'comment';break;
			case 'reviewby' 		: $sortby = 'reviewby';break;
			case 'reviewdate' 		: $sortby = 'reviewdate';break;
			default 			: $sortby = 'comment';break;
		}
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		$this->db->select('r.*,u.firstname,u.lastname');
		$this->db->from('reviews as r');
		//$this->db->join('company as c','r.companyid=c.id');
		$this->db->join('user as u','r.reviewby=u.id');
		$this->db->where('r.status','Disable');
			
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
	function removedReviewsSearch($keyword, $limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('comment','reviewby','reviewdate','reviewremoveddate');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : '';
		
		if($sort_by == 'reviewby'){
			$sort_by = 'reviewuser';
		}
		
		// results query
		$q = $this->db->select("r.id,r.companyid,r.reviewdate,r.reviewremoveddate,r.status,r.reviewby,r.comment,u.firstname,u.lastname,u.username, (case when (u.username != '') then u.username else r.reviewby end) as reviewuser", FALSE)
			->from('reviews as r')
			->join('user as u','r.reviewby=u.id','left')
			->join('company as c','r.companyid=c.id','left')
			->where('r.status','Disable');			
		
		// limit query
		if(!empty($limit)){
			$q->limit($limit, $offset);		
		}
		
		if(!empty($sort_by) && !empty($sort_order)){			
			$q->order_by($sort_by, $sort_order);		
		}
		
		// search query
		if (strlen($keyword)) {	
			$q->where('(r.comment LIKE \'%'.$keyword.'%\' OR u.username LIKE \'%'.$keyword.'%\' OR r.reviewby LIKE \'%'.$keyword.'%\' OR u.firstname LIKE \'%'.$keyword.'%\' OR u.lastname LIKE \'%'.$keyword.'%\' OR c.company LIKE \'%'.$keyword.'%\')', NULL, FALSE);									
		}
		
		$ret['rows'] = $q->get()->result();
		
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)	 
			->from('reviews as r')
			->join('user as u','r.reviewby=u.id','left')
			->join('company as c','r.companyid=c.id','left')
			->where('r.status','Disable');		
		
		// search query
		if (strlen($keyword)) {							
			$q->where('(r.comment LIKE \'%'.$keyword.'%\' OR u.username LIKE \'%'.$keyword.'%\' OR r.reviewby LIKE \'%'.$keyword.'%\' OR u.firstname LIKE \'%'.$keyword.'%\' OR u.lastname LIKE \'%'.$keyword.'%\' OR c.company LIKE \'%'.$keyword.'%\')', NULL, FALSE);
		}
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	function review_mail($reviewid, $companyid)
	{
		return $this->db->get_where('youg_reviewmail',array('company_id' => $companyid, 'review_id' => $reviewid))->row_array();
	}
	function reviews_status($reviewid, $companyid)
	{
		return $this->db->get_where('youg_reviews',array('companyid' => $companyid, 'id' => $reviewid))->row_array();
	}
	function get_review_bysingleid($reviewid)
 	{
		return $this->db->get_where('youg_reviews',array('id' => $reviewid))->row_array();
	}
}

?>
