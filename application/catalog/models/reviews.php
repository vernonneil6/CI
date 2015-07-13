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
	
	function update_fields(){
		
			$this->db->select('r.*, cm.company,cm.logo,cm.aboutus,cm.companyseokeyword,,u.firstname,u.username,u.lastname,u.avatarbig,u.gender,u.state');
			$this->db->from('youg_reviews as r');
			$this->db->join('youg_company as cm','r.companyid=cm.id','left');
			$this->db->join('youg_user as u','r.reviewby=u.id','left');		
			$query = $this->db->get();
			$result = $query->result();
			foreach($result as $res){
			//print_r($res);die;	
			$reviewcompanies = preg_replace('/[^a-zA-Z0-9-.]/', '-', trim(strtolower($res->company)));			
			$reviewtitles = preg_replace('/[^a-zA-Z0-9_.]/', '_', trim(strtolower($res->reviewtitle)));
			
			if($reviewcompanies != ""){
				$review_view_url = "reviews/".$reviewcompanies."/".$reviewtitles."/".$res->id; 
			}else{
				$review_view_url = "reviews/anonymous/".$reviewtitles."/".$res->id; 
			}	
			
			$data = array('seoslug' => $review_view_url);

			$where = "id = ".$res->id;

			$str = $this->db->update('youg_reviews', $data, $where); 
			//die;
			

			}	
	}
	function updateCompanySlug(){
		
		
			$this->db->select('c.seoslug,c.id,c.city,c.state,c.company');
			$this->db->from('youg_company as c');		
			$query = $this->db->get()->result();
			
			foreach($query as $res){
			//print_r($res);die;	
			
			$company_name = preg_split("/[\s,]+/", strtolower($res->company));
			if(count($elitemem_status)==0){
				
				$company_seoslug = "company/not-verified/".trim(ucfirst(strtolower($res->city)))."-".trim($res->state)."/".$company_name."/".$res->id;
				
			}else{
				$company_seoslug = "company/elite-members/".trim(ucfirst(strtolower($res->city)))."-".trim($res->state)."/".preg_replace('/[^a-zA-Z0-9-.]/', '', trim(strtolower($company_name)))."/".$res->id;
			}
			
			$data = array('c.seoslug' => $company_seoslug);
			

			$where = "id = ".$res->id;	
				

			$this->db->update('youg_company', $data, $where); 
			die('1');	

			}
		
	}
	
	
}
?>
