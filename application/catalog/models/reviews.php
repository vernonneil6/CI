<?php
class Reviews extends CI_Model
{
	function get_all_reviews($limit ='',$offset='')
 	{
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$siteid = $this->session->userdata('siteid');
		//Executing Query
		$this->db->select('r.*, cm.company,cm.logo,u.firstname,u.username,u.lastname,u.avatarbig,u.gender
		');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id','left');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$this->db->where('r.status','Enable');
		//$this->db->where('r.websiteid',$siteid);
		$this->db->order_by('reviewdate', 'DESC');
		
		$query = $this->db->get();
	
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
	
	function get_all_companies($limit ='',$offset='')
 	{
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('company');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Inserting Record
	function insert($companyid,$userid,$rating,$review,$reviewtitle)
	{
		$siteid = $this->session->userdata('siteid');
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'companyid' 	=> $companyid,
							'rate'			=> $rating,
					    	'reviewtitle'	=> $reviewtitle,
							'comment'		=> $review,
							'reviewby' 		=> $userid,
							'reviewip' 		=> $varipaddress,
							'reviewdate'	=> $date,
							'status' 		=> 'Enable',
							'websiteid'		=> $siteid,
							'type'			=> 'ygr'
						);

		if( $this->db->insert('reviews', $data) )
		{
			$id = $this->db->insert_id();
			
			$company1 = $this->db->get_where('company', array('id' => $companyid));
			$company = $company1->result_array();
			if(count($company)>0)
			{
				//$company = $company->result_array();
				//lower case everything
			$companyname = strtolower($company[0]['company']);
			//make alphaunermic
			$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
			//Clean multiple dashes or whitespaces
			$companyname = preg_replace("/[\s-]+/", " ", $companyname);
			//Convert whitespaces to dash
			$companyname = preg_replace("/[\s]/", "-", $companyname);
			
			$seokeyword = $companyname.'-review-'.$id;
			}
			else
			{
				$seokeyword = 'review-'.$id;	
			}
			
			$link = 'review/browse/'.$seokeyword;
			$this->db->where('id', $id);
			$this->db->update('reviews',array('link'=>$link,'seokeyword'=>$seokeyword));
			
			return 'added';
		}
		else
		{
			return false;
		}
		
	}
	
	function insert1($companyid,$userid,$rating,$review,$reviewtitle)
	{
		$siteid = $this->session->userdata('siteid');
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'companyid' 	=> $companyid,
							'rate'			=> $rating,
					    	'reviewtitle'	=> $reviewtitle,
							'comment'		=> $review,
							'reviewby' 		=> $userid,
							'reviewip' 		=> $varipaddress,
							'reviewdate'	=> $date,
							'status' 		=> 'Disable',
							'websiteid'		=> $siteid,
							'type'			=> 'ygr'
						);

		if( $this->db->insert('reviews', $data) )
		{
			$id = $this->db->insert_id();
			
			$company1 = $this->db->get_where('company', array('id' => $companyid));
			$company = $company1->result_array();
			if(count($company)>0)
			{
				//lower case everything
			$companyname = strtolower($company[0]['company']);
			//make alphaunermic
			$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
			//Clean multiple dashes or whitespaces
			$companyname = preg_replace("/[\s-]+/", " ", $companyname);
			//Convert whitespaces to dash
			$companyname = preg_replace("/[\s]/", "-", $companyname);
			
			$seokeyword = $companyname.'-review-'.$id;
			}
			else
			{
				$seokeyword = 'review-'.$id;	
			}
			
			$link = 'review/browse/'.$seokeyword;
			$this->db->where('id', $id);
			$this->db->update('reviews',array('link'=>$link,'seokeyword'=>$seokeyword));
			
			return 'added';
		}
		else
		{
			return false;
		}
		
	}
	
	//Getting value for editing
	function get_review_byid($id)
 	{
	//	$siteid = $this->session->userdata('siteid');
		$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,cm.companyseokeyword,,u.firstname,u.username,u.lastname,u.avatarbig,u.gender,u.state');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id','left');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$this->db->where('r.id',$id);
		$this->db->where('r.status','Enable');
	//	$this->db->where('r.websiteid',$siteid);
		
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
	
	//Getting value for editing no status
	function get_review1_byid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,u.firstname,u.lastname,u.avatarbig,u.gender');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$this->db->where('r.id',$id);
		$this->db->where('r.websiteid',$siteid);
	
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
		$this->db->where('r.status','Enable');
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
	
	public function get_reviews_bycompanyid_count($id)
	{
		$this->db->where('companyid',$id);
		$this->db->from('reviews');
		$query = $this->db->count_all_results();
			
		return $query;
	}

	//Getting value for editing
	function get_reviews_byciduid($companyid,$userid)
 	{
		$siteid = $this->session->userdata('siteid');
		$this->db->where('companyid',$companyid);
		$this->db->where('reviewby',$userid);
		$this->db->where('status','Enable');
		//$this->db->where('websiteid',$siteid);
		
		$query = $this->db->get('reviews');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting review 
	function get_reviews1_byciduid($companyid,$userid)
 	{
		$siteid = $this->session->userdata('siteid');
		$this->db->where('companyid',$companyid);
		$this->db->where('reviewby',$userid);
	//	$this->db->where('websiteid',$siteid);
		
		$query = $this->db->get('reviews');
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
	function update($id,$companyid,$userid,$rating,$review,$reviewtitle)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'reviewtitle'	=> $reviewtitle,
							'companyid' 	=> $companyid,
							'rate' 			=> $rating,
					    	'comment'		=> $review,
							'reviewby' 		=> $userid
						);

		$this->db->where('id', $id);
		if( $this->db->update('reviews', $data) )
		{
			return 'updated';
		}
		else
		{
			return false;
		}
 	}
	
	//Querying to Check E-mail or review name is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'email' 			: $varfield = 'email';break;
			case 'firstname'	: $varfield = 'firstname';break;
		}
		if($id != 0)
		{
			$option = array( 'id !=' => $id, $varfield => $fieldvalue );
		}
		else
		{
			$option = array( $varfield => $fieldvalue );
		}
		$query = $this->db->get_where('review', $option);
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
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
 	
 	function get_setting_value($id)
 	{
		$siteid = $this->session->userdata('siteid');
		if($siteid=='')
		{
		$siteid=1;
		}
		$query = $this->db->get_where('setting', array('id' => $id,'websiteid' => $siteid));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return nl2br(stripslashes($result[0]['value']));
		}
		else
		{
			return false;
		}
 	}
 	
 	function get_status_review($userid, $companyid)
 	{
		return $this->db->get_where('reviews',array('reviewby' => $userid, 'companyid' => $companyid))->row_array();
	}
	function get_status_reviewupdate($userid, $companyid)
	{
		$data = array(
			'status' => '2'
		);
		$this->db->where(array('user_id' => $userid, 'company_id' => $companyid ))->update('youg_reviewmail',$data);
	}
	function get_reviewmail($userid, $companyid)
 	{
		return $this->db->get_where('youg_reviewmail',array('user_id' => $userid, 'company_id' => $companyid))->row_array();
	}
	function get_all_reviewmail()
 	{
		return $this->db->get('youg_reviewmail')->result_array();
	}
	
	function insert_reviewmail($companyid, $userid, $review, $option, $textarea, $status)
	{
		$data = array(
			'company_id' => $companyid,
			'user_id'	 => $userid,
			'review_id'  => $review,
			'resolution' => $option,
			'comment' 	 => $textarea,
			'status' 	 => $status,
			'date'		 => date('Y:m:d H:i:s')
		);
		$this->db->insert('youg_reviewmail', $data);
	}
	
	//Getting value for searching
	function search_company($keyword,$limit ='',$offset='')
 	{
	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$this->db->select('*');
		$this->db->from('company');
		$this->db->or_like(array('streetaddress'=> $keyword,'city'=>$keyword,'state'=>$keyword,'country'=>$keyword,'zip'=>$keyword,'LOWER(company)'=>strtolower($keyword),'companyseokeyword'=>$keyword));
		$query = $this->db->get();
		//echo "<pre>";
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
	
	//Getting value for searching count
	function search_company_count($keyword)
 	{
		$this->db->select('*');
		$this->db->from('company');
		$this->db->or_like(array('streetaddress'=> $keyword,'city'=>$keyword,'state'=>$keyword,'country'=>$keyword,'zip'=>$keyword,'LOWER(company)'=>strtolower($keyword),'companyseokeyword'=>$keyword));
		$query = $this->db->count_all_results();
		return $query;
		
 	}
	//Inserting Record
	function insertvote($reviewid,$vote)
	{
		$siteid = $this->session->userdata('siteid');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];

		$data = array(		'reviewid' 	=> $reviewid,
							'vote'		=> $vote,
							'voteip' 	=> $varipaddress,
							'votedate'	=> $date,
							'websiteid' => $siteid
						);

		if( $this->db->insert('votes', $data) )
		{
			return 'added';
		}
		else
		{
			return false;
		}	
	}
	
	//get count
	function getcount($reviewid,$vote)
	{
		$siteid = $this->session->userdata('siteid');
		$this->db->select('*');
		$this->db->where('reviewid',$reviewid);
		$this->db->where('vote',$vote);
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('votes');
	
		if ($query->num_rows() > 0)
		{	
			$total = $query->num_rows();
			return $total;
		}
		else
		{
			return 0;
		}

	}
	
	//get count
	function get_yest_count($vote)
	{
		$siteid = $this->session->userdata('siteid');
		$this->db->select('*');
		$this->db->where('vote',$vote);
		$this->db->where('DATE(votedate) = CURDATE() - 1');
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('votes'); 
	    //echo $this->db->last_query();die();
		if ($query->num_rows() > 0)
		{	
			$total = $query->num_rows();
			return $total;
		}
		else
		{
			return 0;
		}

	}
	
	function check_vote($ip,$reviewid,$vote)
 	{	
		$siteid = $this->session->userdata('siteid');
		$this->db->select('*');
		$this->db->where('reviewid',$reviewid);
		$this->db->where('voteip',$ip);
		$this->db->where('vote',$vote);
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('votes');
       
		if ($query->num_rows() == 0)
		{
			return 'false';
		}
		else
		{
			return 'true';
		}
 	}
	
	function delete_vote($ip,$reviewid,$vote)
 	{	
	  	$siteid = $this->session->userdata('siteid');
		$this->db->where('reviewid',$reviewid);
		$this->db->where('voteip',$ip);
		$this->db->where('vote',$vote);
		$this->db->where('websiteid',$siteid);
		if($this->db->delete('votes'))
		{
			return 'true';
		}
		else
		{
			return 'false';
		}
		
 	}
	
	//get comments by reviewid
	function get_comments_byreviewid($reviewid,$limit='',$offset='',$sortby='commentdate',$orderby='DESC')
 	{
		$siteid = $this->session->userdata('siteid');
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		
		$query = $this->db->get_where('comments',array('reviewid'=>$reviewid,'status'=>'Enable','websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{	
			return $query->result_array();
		}
		else
		{
			return array();
		}

	}
	
	//Inserting comment on review
	function insert_comment($reviewid,$userid,$comment,$statusdisable)
	{
		$siteid = $this->session->userdata('siteid');
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];

		if($statusdisable=='yes')
		{
			$data = array(	'reviewid' 		=> $reviewid,
							'comment'		=> $comment,
							'status' 		=> 'Disable',
							'commentby'		=> $userid,
							'commentdate'	=> $date,
							'commentip'		=> $varipaddress,
							'websiteid'		=> $siteid
						);
		}
		else
		{
		$data = array(
							'reviewid' 		=> $reviewid,
							'comment'		=> $comment,
							'status' 		=> 'Enable',
							'commentby'		=> $userid,
							'commentdate'	=> $date,
							'commentip'		=> $varipaddress,
							'websiteid'		=> $siteid
						);

		}

		if( $this->db->insert('comments', $data) )
		{
			return 'added';
		}
		else
		{
			return false;
		}	
	}
	
	//Updating Record
	function update_comment($id,$reviewid,$userid,$comment)
 	{
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];

		$data = array(
							'comment'		=> $comment,
							'commentdate'	=> $date,
							'commentip'		=> $varipaddress,
						);

		
		$this->db->where('id', $id);
		if( $this->db->update('comments', $data) )
		{
			return 'updated';
		}
		else
		{
			return false;
		}	
 	}
	//Updating Record
	function delete_comment($id)
 	{
		$this->db->where('id', $id);
		if( $this->db->delete('comments'))
		{
			return true;
		}
		else
		{
			return false;
		}	
 	}
	
	//Getting value for editing
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
	
	//get company to check membership

	function elitemship($id)
 	{
		$query = $this->db->get_where('elite', array('company_id' => $id));
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Inserting Record which have etile membership
	function insert_elite_review($companyid,$userid,$rating,$review,$reviewtitle)
	{
		$siteid = $this->session->userdata('siteid');
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'reviewtitle'	=> $reviewtitle,
							'companyid' 	=> $companyid,
							'rate' 			=> $rating,
					    	'comment'		=> $review,
							'reviewby' 		=> $userid,
							'reviewip' 		=> $varipaddress,
							'reviewdate'	=> $date,
							'status' 		=> 'Disable',
							'websiteid'		=> $siteid,
							'type'			=> 'ygr'
						);
		if( $this->db->insert('reviews', $data) )
		{
			
			
			$id = $this->db->insert_id();
			
			$company1 = $this->db->get_where('company', array('id' => $companyid));
			$company = $company1->result_array();
			if(count($company)>0)
			{
				//lower case everything
			$companyname = strtolower($company[0]['company']);
			//make alphaunermic
			$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
			//Clean multiple dashes or whitespaces
			$companyname = preg_replace("/[\s-]+/", " ", $companyname);
			//Convert whitespaces to dash
			$companyname = preg_replace("/[\s]/", "-", $companyname);
			
			$seokeyword = $companyname.'-review-'.$id;
			}
			else
			{
				$seokeyword = 'review-'.$id;	
			}
			
			$link = 'review/browse/'.$seokeyword;
			$this->db->where('id', $id);
			$this->db->update('reviews',array('link'=>$link,'seokeyword'=>$seokeyword));
			
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
		//Changing Status to "Enable"
	function enable_review_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'	=> 'Enable',
							'reviewip' 	=> $vareditip,
							'reviewdate'	=> $date_edit
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
	//delete review by id elite
	function delete_review_byid($id)
 	{	
	  $this->db->where('id',$id);
		
		if($this->db->delete('reviews'))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//get disable review of elite
	function get_disreview_byid($id)
 	{
		$query = $this->db->get_where('reviews',array('id'=>$id,'status'=>'Disable'));
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function get_review_byseokeyword($word)
	{
		$siteid = $this->session->userdata('siteid');
		$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,u.firstname,u.username,u.lastname,u.avatarbig,u.gender,cm.companyseokeyword');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id','left');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$this->db->where('r.seokeyword',$word);
		$this->db->where('r.status','Enable');
		$this->db->where('r.websiteid',$siteid);
		
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
	function get_user_byid($id)
 	{
		$query = $this->db->get_where('user', array('id' => $id));
		
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
