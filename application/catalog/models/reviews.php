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
		$this->db->select('r.*, cm.company,cm.logo,u.firstname,u.username,u.lastname,u.avatarbig,u.gender');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id','left');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$this->db->where('r.status','Enable');
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
	
	function get_latest_reviews($limit ='',$offset='')
 	{
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$siteid = $this->session->userdata('siteid');
		//Executing Query
		$this->db->select('r.*, cm.company,cm.logo,u.firstname,u.username,u.lastname,u.avatarbig,u.gender,u.avatarthum');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id','left');
		$this->db->join('user as u','r.reviewby=u.id','left');
		$this->db->where('r.status','Enable');
		$this->db->where('u.avatarthum <>','');
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
	function insert($companyid,$userid,$rating,$review,$reviewtitle,$autopost)
	{
		$siteid = $this->session->userdata('siteid');
		//$date = date_default_timezone_set('Asia/Kolkata');
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
							'autopost'		=> $autopost,
							'type'			=> 'ygr'
						);

		if( $this->db->insert('reviews', $data) )
		{
			$id = $this->db->insert_id();
			
			$company1 = $this->db->get_where('company', array('id' => $companyid));
			$company = $company1->result_array();
			
			/*SEO slug*/	
			
			$reviewtitles = preg_replace('/[^a-zA-Z0-9_.]/', '_', trim(strtolower($reviewtitle)));		
			
			if(count($company)>0)
			{
				$reviewcompanies = preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company[0]['company'])));
			}
			else
			{
				$reviewcompanies = 'anonymous';	
			}														
			
			$seoslug = "reviews/".$reviewcompanies."/".$reviewtitles."/".$id; 
			
			//echo $seoslug;die;
			$update_data = array(
					'seoslug' => $seoslug
			);
			
			$this->db->where('id', $id);
			$this->db->update('reviews', $update_data); 
				
			/*SEO slug*/	
			
			return 'added';
		}
		else
		{
			return false;
		}
		
	}
	
	function insert1($companyid,$userid,$rating,$review,$reviewtitle,$autopost)
	{
		$siteid = $this->session->userdata('siteid');
		//$date = date_default_timezone_set('Asia/Kolkata');
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
							'autopost'		=> $autopost,
							'type'			=> 'ygr'
						);

		if( $this->db->insert('reviews', $data) )
		{
			$id = $this->db->insert_id();
			
			$company1 = $this->db->get_where('company', array('id' => $companyid));
			$company = $company1->result_array();
			/*SEO slug*/	
			
			$reviewtitles = preg_replace('/[^a-zA-Z0-9_.]/', '_', trim(strtolower($reviewtitle)));		
			
			if(count($company)>0)
			{
				$reviewcompanies = preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company[0]['company'])));
			}
			else
			{
				$reviewcompanies = 'anonymous';	
			}														
			
			$seoslug = "reviews/".$reviewcompanies."/".$reviewtitles."/".$id; 
			
			$update_data = array(
					'seoslug' => $seoslug
			);
			
			$this->db->where('id', $id);
			$this->db->update('reviews', $update_data); 
				
			/*SEO slug*/	
			
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
		//$siteid = $this->session->userdata('siteid');
		$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,cm.companyseokeyword,,u.firstname,u.username,u.lastname,u.avatarbig,u.gender,u.state');
		$this->db->from('youg_reviews as r');
		$this->db->join('youg_company as cm','r.companyid=cm.id','left');
		$this->db->join('youg_user as u','r.reviewby=u.id','left');
		$this->db->where('r.id',$id);
		$this->db->where('r.status','Enable');
		
		$query = $this->db->get();
		//print_r($query);die;
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
		//$siteid = $this->session->userdata('siteid');
		$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,u.firstname,u.lastname,u.avatarbig,u.gender');
		$this->db->from('youg_reviews as r');
		$this->db->join('youg_company as cm','r.companyid=cm.id');
		$this->db->join('youg_user as u','r.reviewby=u.id','left');
		$this->db->where('r.id',$id);
		//$this->db->where('r.websiteid',$siteid);
	
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
	function update($id,$companyid,$userid,$rating,$review,$reviewtitle,$autopost,$seoslug)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'reviewtitle'	=> $reviewtitle,
							'companyid' 	=> $companyid,
							'rate' 			=> $rating,
					    	'comment'		=> $review,
					    	'autopost'		=> $autopost,
							'reviewby' 		=> $userid,
							'seoslug' 		=> $seoslug
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
 	
	
	function get_all_reviewmail()
 	{
		return $this->db->get('youg_reviewmail')->result_array();
	}
	function get_all_reviewscron()
 	{
		return $this->db->get('youg_reviews')->result_array();
	}
	
	function get_review_bysingleid($reviewid)
 	{
		return $this->db->get_where('youg_reviews',array('id' => $reviewid))->row_array();
	}
	
	function get_reviewmail_bysingleid($id)
 	{
		return $this->db->get_where('youg_reviewmail', array('id' => $id))->row_array();
	}
	
	function get_reviewmail_bysinglereviewid($reviewid)
 	{
		return $this->db->get_where('youg_reviewmail', array('review_id' => $reviewid))->row_array();
	}
	
	function reviewmail_update($data, $id)
	{
		$this->db->where('review_id', $id)->update('youg_reviewmail', $data);
	}
	
	function get_update_review_status($reviewid)
	{
		$data = array(
			'status' => 'Enable'
		);
		$this->db->where(array('id' => $reviewid ))->update('youg_reviews',$data);
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
	
	function insert_reviewmail_check($companyid, $userid, $reviewid)
	{
		return $this->db->get_where('youg_reviewmail', array('company_id' => $companyid, 'user_id' => $userid, 'review_id'=>$reviewid))->result_array();
	}
	
	//Getting value for searching
	function search_company($keyword,$limit ='',$offset='')
 	{
		//Ordering Data
		$sortby = 'company';
		$orderby = 'ASC';
		$this->db->order_by($sortby,$orderby);
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$this->db->select('*');
		$this->db->from('company');
		//$this->db->or_like(array('streetaddress'=> $keyword,'city'=>$keyword,'state'=>$keyword,'country'=>$keyword,'zip'=>$keyword,'LOWER(company)'=>strtolower($keyword),'companyseokeyword'=>$keyword));
		$this->db->or_like('city',$keyword,'after');
	    $this->db->or_like('state',$keyword,'after');
	    $this->db->or_like('country',$keyword,'after');
	    $this->db->or_like('zip',$keyword,'after');
	    $this->db->or_like('company',strtolower($keyword),'after');
	    $this->db->or_like('companyseokeyword',$keyword,'after');
		
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
		//$this->db->or_like(array('streetaddress'=> $keyword,'city'=>$keyword,'state'=>$keyword,'country'=>$keyword,'zip'=>$keyword,'LOWER(company)'=>strtolower($keyword),'companyseokeyword'=>$keyword));
		$this->db->or_like('city',$keyword,'after');
		$this->db->or_like('state',$keyword,'after');
	    $this->db->or_like('country',$keyword,'after');
	    $this->db->or_like('zip',$keyword,'after');
	    $this->db->or_like('company',strtolower($keyword),'after');
	    $this->db->or_like('companyseokeyword',$keyword,'after');
		
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
		
		
		$query = $this->db->get_where('youg_comments',array('reviewid'=>$reviewid,'status'=>'Enable','websiteid'=>$siteid));
		
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
	function insert_comment($reviewid,$userid,$comment,$statusdisable,$rating)
	{
		$siteid = $this->session->userdata('siteid');
		//$date = date_default_timezone_set('Asia/Kolkata');
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
							'websiteid'		=> $siteid,
							'rating'		=> $rating
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
							'websiteid'		=> $siteid,
							'rating'		=> $rating
						);

		}

		if( $this->db->insert('youg_comments', $data) )
		{
			return 'added';
		}
		else
		{
			return false;
		}	
	}
	
	//Updating Record
	function update_comment($id,$reviewid,$userid,$comment,$rating)
 	{
		//$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];

		$data = array(
							'comment'		=> $comment,
							'commentdate'	=> $date,
							'commentip'		=> $varipaddress,
							'rating'		=> $rating
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
	
	function delete_reviewmail($reviewid)
 	{
		$this->db->where('review_id', $reviewid);
		if( $this->db->delete('youg_reviewmail'))
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
		$query = $this->db->get_where('youg_elite', array('company_id' => $id));
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
	function insert_elite_review($companyid,$userid,$rating,$review,$reviewtitle,$autopost)
	{
		$siteid = $this->session->userdata('siteid');
		//$date = date_default_timezone_set('Asia/Kolkata');
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
							'status' 		=> 'Enable',
							'websiteid'		=> $siteid,
							'autopost'		=> $autopost,
							'type'			=> 'ygr'
						);
		if( $this->db->insert('reviews', $data) )
		{
			
			
			$id = $this->db->insert_id();
			
			$company1 = $this->db->get_where('company', array('id' => $companyid));
			$company = $company1->result_array();
			/*SEO slug*/	
			
			$reviewtitles = preg_replace('/[^a-zA-Z0-9_.]/', '_', trim(strtolower($reviewtitle)));		
			
			if(count($company)>0)
			{
				$reviewcompanies = preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company[0]['company'])));
			}
			else
			{
				$reviewcompanies = 'anonymous';	
			}														
			
			$seoslug = "reviews/".$reviewcompanies."/".$reviewtitles."/".$id; 
			
			$update_data = array(
					'seoslug' => $seoslug
			);
			
			$this->db->where('id', $id);
			$this->db->update('reviews', $update_data); 
				
			/*SEO slug*/	
			
			return $id;
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
	
	//delete review by id elite
	function disable_reviewcomments_byid($id)
 	{	
	  
		if(!empty($id)){
		
			
			$sql = "UPDATE youg_reviews r SET r.status='Disable' WHERE r.id = ?";	
			if($this->db->query($sql,array($id)))
			{	
				$commentssql = "UPDATE youg_comments c SET c.status='Disable' WHERE c.reviewid = ?";
				if($this->db->query($commentssql,array($id))){
					return true;
				}else{
					return false;
				}				
			}
			else
			{
				return false;
			}
		}
 	}
	
	
	//get disable review of elite
	function get_disreview_byid($id)
 	{
		$query = $this->db->get_where('youg_reviews',array('id'=>$id,'status'=>'Disable'));
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
		//echo $siteid;die;
		$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,u.firstname,u.username,u.lastname,u.avatarbig,u.gender,cm.companyseokeyword');
		$this->db->from('youg_reviews as r');
		$this->db->join('youg_company as cm','r.companyid=cm.id','left');
		$this->db->join('youg_user as u','r.reviewby=u.id','left');
		$this->db->like('r.seokeyword', $word); 		
		$this->db->where('r.status','Enable');
		//$this->db->where('r.websiteid',$siteid);
		
		$query = $this->db->get();
		//print_r($query);die;
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
 	
 	function update_reviewsflag($reviewid)
 	{
		$data = array ('flag' => '2');
		$query = $this->db->where(array('id' => $reviewid))->update('youg_reviews', $data);
		
		if ($query)
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function review_date($companyid,$userid,$reviewid,$date,$status)
	{
		$data = array(
					'company_id' 	=> $companyid,
					'user_id'		=> $userid,
					'review_id' 	=> $reviewid,
					'date'			=> $date,
					'status'		=> $status
				);

		if( $this->db->insert('youg_review_date', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	function find_reviewpromocode($promo)
	{
		$query = $this->db->get_where('youg_reviewpromo',array('code'=>$promo,'status'=>'Enable'));
	    
	    if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
		
	}
	
	function find_reviewpromocode_company($promo,$companyid)
	{
		$query = $this->db->get_where('youg_reviewpromo',array('code'=>$promo,'status'=>'Enable','companyid'=>$companyid));
	    
	    if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
		
	}
	function find_reviewpromocodeid($promo)
	{
		$query = $this->db->get_where('youg_reviewpromo',array('id'=>$promo,'status'=>'Enable'));
	    
	    if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
		
	}
	
	function get_email_details($id)
	{
		$query = $this->db->get_where('youg_user',array('id'=>$id,'status'=>'Enable'));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
		
	}
	/* Find review promocode available for company */
	function find_reviewpromocode_forcompany($companyid)
	{
		$query = $this->db->get_where('youg_reviewpromo',array('companyid'=>$companyid,'status'=>'Enable'));
	    
	    if ($query->num_rows() > 0)
		{
			//return $query->result_array();
			return $value='1';
		}
		else
		{
			return $value='0';
		}
		
	}
	
	function updateReviewsSlug(){
		
			$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,cm.companyseokeyword,,u.firstname,u.username,u.lastname,u.avatarbig,u.gender,u.state');
			$this->db->from('youg_reviews as r');
			$this->db->join('youg_company as cm','r.companyid=cm.id','left');
			$this->db->join('youg_user as u','r.reviewby=u.id','left');		
			$query = $this->db->get();
			$result = $query->result();
			foreach($result as $res){
			//print_r($res);die;
			
			if($res->company != ''){				
				$company_name = preg_replace("/\.$/","",$res->company);				
				$reviewcompanies = trim(preg_replace('/-+/', '-',preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company_name)))), '-');
			}
			else
			{
				$reviewcompanies = 'anonymous';	
			}
			
			$reviewtitles = trim(preg_replace('/_+/', '_',preg_replace('/[^a-zA-Z0-9_.]/', '_', trim(strtolower($res->reviewtitle)))), '_');
			
			$review_seoslug = "reviews/".$reviewcompanies."/".$reviewtitles."/".$res->id; 
			
			echo $review_seoslug."<br/>";
			$data = array('seoslug' => $review_seoslug);

			$where = "id = ".$res->id;

			$str = $this->db->update('youg_reviews', $data, $where); 
				

			}	
	}
	
	
	function updatePressReleasesSlug(){
		
			$this->db->select('p.*, cm.company');
			$this->db->from('youg_pressrelease as p');
			$this->db->join('youg_company as cm','p.companyid=cm.id','left');
							
			$query = $this->db->get();
			$result = $query->result();
			foreach($result as $res){
			//print_r($res);die;
			
			if($res->company != ''){				
				$company_name = preg_replace("/\.$/","",$res->company);				
				$presscompanies = trim(preg_replace('/-+/', '-',preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company_name)))), '-');
			}
			else
			{
				$presscompanies = 'anonymous';	
			}
			
						
			if($res->subtitle != ''){
				if(!is_numeric($res->subtitle)){
					$presscontent = implode(' ', array_slice(str_word_count($res->subtitle, 2), 0, 4));
					$presscontents = preg_replace('/[^a-zA-Z0-9-.]/',"_" ,trim(strtolower($presscontent)));	
				}else{
					$presscontents = preg_replace('/[^a-zA-Z0-9-.]/',"_" ,trim(strtolower($res->subtitle)));	
				}
			}
			else
			{
				$presscontents = "no_subtitle";		
			}
			
			$seoslug = "pressrelease/".$presscompanies."/".$presscontents."/".$res->id; 		
			
			echo $seoslug."<br/>";
			$data = array('seoslug' => $seoslug);

			$where = "id = ".$res->id;

			$str = $this->db->update('youg_pressrelease', $data, $where); 
				

			}	
	}
	
	function updateCompaniesSlug(){
		
		
			$this->db->select('c.id,c.city,c.state,c.company');
			$this->db->from('youg_company as c');		
			$this->db->limit(100000,700000);	
			$query = $this->db->get()->result();
			
			foreach($query as $res){
			//print_r($res);die;
				
			$this->load->model('Common');
			
			$elitemem_status = $this->Common->get_eliteship_bycompanyid($res->id);
			
			
			if($res->company != ''){
				$company_name = preg_replace("/\.$/","",$res->company);
				$company_name = trim(preg_replace('/-+/', '-',preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company_name)))), '-');
			}else{
				$company_name = "anonymous";
			}
			
			$city_state = ucfirst(strtolower($res->city))."-".trim($res->state);
			$city_state = preg_replace('/[^a-zA-Z0-9-.]/', '', trim($city_state));
			
			if(count($elitemem_status)==0){
				
				$company_seoslug = "company/not-verified/".$city_state."/".$company_name."/".$res->id;
				
			}else{
				$company_seoslug = "company/elite-members/".$city_state."/".$company_name."/".$res->id;
			}
			
			$data = array('seoslug' => $company_seoslug);
			
			echo $company_seoslug.PHP_EOL;
			$where = "id = ".$res->id;	
				

			$this->db->update('youg_company', $data, $where); 
			//die('1');	

			}
		
	}
	function updateComplaintsSlug(){
		
			
			$this->db->select('c.*,cm.company');
			$this->db->from('youg_complaints as c');
			$this->db->join('youg_company as cm','c.companyid=cm.id','left');				
			$query = $this->db->get()->result();
			
			foreach($query as $res){
			//print_r($res);die;			
			
			if($res->company != ''){
				$company_name = preg_replace("/\.$/","",$res->company);
				$reviewcompanies = trim(preg_replace('/-+/', '-',preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company_name)))), '-');				
			}
			else
			{
				$reviewcompanies = 'anonymous';	
			}
			
			if($res->detail != ''){
				if(!is_numeric($res->detail)){
					$detail = implode(' ', array_slice(str_word_count($res->detail, 2), 0, 4));	
				}else{
					$detail = $res->detail;
				}
			}
			else
			{
				$detail = "no_detail";		
			}
			
																 
			$details = preg_replace('/[^a-zA-Z0-9-.]/',"_" ,trim(strtolower($detail)));
			if (strlen($details) > 20){
				$details = substr($details, 0, 20);
			}
			$details = trim(preg_replace('/-+/', '-', $details), '-');	

			$seoslug = "complaints/".$reviewcompanies."/".$details."/".$res->id; 
			echo $seoslug."<br/>";
			
			$data = array('seoslug' => $seoslug);
			

			$where = "id = ".$res->id;	
				

			$this->db->update('youg_complaints as c', $data, $where); 
			

			}	
			
	}
	
	function updateCouponsSlug(){
		
		
		
			$this->db->select('c.*,cm.company');
			$this->db->from('youg_coupon as c');
			$this->db->join('youg_company as cm','c.companyid=cm.id','left');				
			$query = $this->db->get()->result();
			
			foreach($query as $res){
			//print_r($res);die;			
			
			if($res->company != ''){
				$company_name = preg_replace("/\.$/","",$res->company);
				$reviewcompanies = trim(preg_replace('/-+/', '-',preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($company_name)))), '-');
			}
			else
			{
				$reviewcompanies = 'anonymous';	
			}
			
			if($res->title != ""){		
				$coupontitle = preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($res->title)));
				$coupontitle = trim(preg_replace('/-+/', '-', $coupontitle), '-');													 
			}else{
				$coupontitle = "no-title";
			}
			
			$seoslug = "coupons/".$reviewcompanies."/".$coupontitle."/".$res->id; 
			echo $seoslug."<br/>";
			
			$data = array('seoslug' => $seoslug);
			

			$where = "id = ".$res->id;	
				

			$this->db->update('youg_coupon as c', $data, $where); 
			//die('1');	

			}
	
			
			
	}
	
	
	
}
?>
