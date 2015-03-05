<?php
Class Common extends CI_Model
{
	//Getting setting value By id
	function get_setting_value($id)
 	{
		$siteid = $this->session->userdata('siteid');
		
		$query = $this->db->get_where('youg_setting', array('id' => $id,'websiteid' => $siteid));
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
	
	function get_homesetting_value($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('settinghome', array('id' => $id,'websiteid' => $siteid));
		
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
	
	function get_semsetting_value($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('sem', array('id' => $id,'websiteid' => $siteid));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return stripslashes($result[0]['url']);
		}
		else
		{
			return false;
		}
 	}
	
	//Getting SEO value By id
	function get_seosetting_value($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('seo', array('id' => $id,'websiteid' => $siteid));
		
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
	
	//Getting All SEM
	function get_all_sems()
 	{
		//Ordering data
		$siteid = $this->session->userdata('siteid');
		$this->db->order_by('id','ASC');
		
		$query = $this->db->get_where('sem', array('status' => 'Enable','websiteid' => $siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting Email value
	function get_email_byid($id)
 	{
		$query = $this->db->get_where('youg_emails', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting all FAQ
	function get_all_faqs($sortby = 'question',$orderby = 'ASC')
 	{
		$siteid = $this->session->userdata('siteid');
		switch($sortby)
		{
			case 'question': $sortby = 'question';break;
			default 	     : $sortby = 'question';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$query = $this->db->get_where('youg_faq',array('status'=>'Enable','websiteid' => $siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting page value by id
	function get_pages_by_id($intid,$siteid)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('pages', array('id' => $intid,'websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_all_complaints_totaldamage($siteid)
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		//Executing Query
		
		$query=$this->db->query("SELECT sum(`damagesinamt`) as total FROM `youg_complaints` where (websiteid='$siteid' OR websiteid='1')AND status='disable'");
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_all_solutions()
 	{
		$siteid = $this->session->userdata('siteid');
		$this->db->order_by('insertdate','DESC');
		//Executing Query
		$query = $this->db->get_where('solutions',array('status'=>'Enable','websiteid'=>$siteid));
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function all_complaints()
	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		$this->db->select('*');
		$this->db->from('complaints');
		$this->db->join('company', 'company.id = complaints.companyid');
		$this->db->where_in('complaints.websiteid',$sites);

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
	function get_all_companies($limit ='',$offset='')
 	{
		$siteid = $this->session->userdata('siteid');
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('complaints as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->where('c.status','Enable');
		$this->db->where('c.websiteid',$siteid);
		$this->db->order_by('c.complaindate','DESC');
		
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
	
	//Getting SEO value By id
	function get_companyseosetting_value($companyid,$field)
	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('companyseo', array('companyid' => $companyid,'fieldname'=>$field,'websiteid' => $siteid));
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
	
	function get_all_categorys($siteid,$sortby = 'category',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'category' : $sortby = 'category';break;
			default 	    : $sortby = 'category';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$query = $this->db->get_where('category',array('status'=>'Enable','websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function get_relation_byciduid($companyid,$userid)
	{
		$query = $this->db->get_where('youg_relation',array('companyid'=> $companyid,'userid' => $userid));
		
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
	
	function insert_relation($companyid,$userid,$status)
 	{
		$data = array('companyid' => $companyid,
					  'userid'	  => $userid,
					  'status'	  => $status);
		
		if ($this->db->insert('relation',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function enable_all_complaints_by_ciduid($companyid,$userid)
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		$data = array('status' => 'Enable');
		$this->db->where('companyid',$companyid);
		$this->db->where('userid',$userid);
		$this->db->where('transactionid =', '');
		$this->db->where('cancel_amount =', '');
		$this->db->where_in('websiteid',$sites);
		 	
		if ($this->db->update('complaints',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function disable_all_complaints_by_ciduid($companyid,$userid)
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		$data = array('status' => 'Disable');
		$this->db->where('companyid',$companyid);
		$this->db->where('userid',$userid);
		$this->db->where('transactionid =', '');
		$this->db->where('cancel_amount =', '');
		$this->db->where_in('websiteid',$sites);
		 	
		if ($this->db->update('complaints',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function get_all_reviews_by_cid($companyid)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('reviews', array('companyid' => $companyid ,'websiteid' => $siteid ));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function enable_all_comments_by_riduid($reviewid,$userid)
 	{
		$siteid = $this->session->userdata('siteid');
		$data = array('status' => 'Enable');
		$this->db->where('reviewid',$reviewid);
		$this->db->where('commentby',$userid);
		$this->db->where('websiteid',$siteid);
		 	
		if ($this->db->update('comments',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function disable_all_comments_by_riduid($reviewid,$userid)
 	{
		$siteid = $this->session->userdata('siteid');
		$data = array('status' => 'Disable');
		$this->db->where('reviewid',$reviewid);
		$this->db->where('commentby',$userid);
		$this->db->where('websiteid',$siteid);
		 	
		if ($this->db->update('comments',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	function get_all_ads($zone,$page,$siteid)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->query("SELECT * from youg_ads where status='Enable' and zone='$zone' and page='$page' and websiteid='$siteid' order by RAND() limit 1");
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting setting value By id
	function get_site_by_domain_name($name)
 	{
		$query = $this->db->get_where('url', array('url' => $name));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
 	}
	
	//Getting setting value By id
	function get_sitename_byid($id)
 	{
		$query = $this->db->get_where('url', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return nl2br(stripslashes($result[0]['title']));
		}
		else
		{
			return false;
		}
 	}
	//Getting setting value By id
	function get_siteurl_byid($id)
 	{
		$query = $this->db->get_where('url', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return nl2br(stripslashes($result[0]['siteurl']));
		}
		else
		{
			return false;
		}
 	}
	
	//Getting setting value By id
	function get_discount_by_code($code)
 	{
		$query = $this->db->get_where('discount',array('code' => $code,'status'=>'Enable'));
		
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
	function get_all_companies1()
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
	
	//Getting value for searching
	function searchcompany($field,$fieldvalue)
 	{
	  
	  $this->db->select('id,company');
	  $this->db->from('company');
	  $this->db->like('company',$fieldvalue,'after');

	  $query = $this->db->get();
	 // echo $this->db->last_query();

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function enable_all_review_by_ciduid($companyid,$userid)
	{
		$siteid = $this->session->userdata('siteid');
		$data = array('status' => 'Enable');
		$this->db->where('reviewby',$userid);
		$this->db->where('companyid',$companyid);
		$this->db->where('websiteid',$siteid);
	
		if ($this->db->update('reviews',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function disable_all_review_by_ciduid($companyid,$userid)
	{
		$siteid = $this->session->userdata('siteid');
		$data = array('status' => 'Disable');
		$this->db->where('reviewby',$userid);
		$this->db->where('companyid',$companyid);
		$this->db->where('websiteid',$siteid);
	
		if ($this->db->update('reviews',$data))
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	
	function get_user_byemail($email)
 	{	
		$query = $this->db->get_where('user',  array( 'email' => $email));
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		} 	
 	}
	
	//get avg rating for company
	function get_avg_ratings_bycmid($companyid)
 	{	
		$this->db->select_avg('rate');
		$this->db->where(array('companyid'=>$companyid, 'status'=>'Enable'));
		$query1 = $this->db->get('reviews');	
		
		$a = $query1->result_array();
		$c = ($a[0]['rate']);
		return round($c);
	}
	
	function get_eliteship_bycompanyid($companyid)
 	{
		$this->db->select('*');
		$this->db->where("(company_id = '$companyid' AND status = 'Enable' OR company_id = '$companyid' AND status = 'Disable' AND cancel_flag = '1')");
		$query = $this->db->get('elite');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_votes($reviewid,$vote)
 	{
		$query = $this->db->get_where('votes', array('reviewid' => $reviewid,'vote' => $vote));
		
		if ($query->num_rows() > 0)
		{
			return count($query->result_array());
		}
		else
		{
			return 0;
		}
 	}
	
	function get_home_category()
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->order_by("category", "asc")->get_where('category', array('websiteid' => $siteid,'status' => 'Enable'));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function search_company_catid($catid,$limit ='',$offset='')
 	{
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->select('c.*');
		$this->db->from('company as c');
		$this->db->where('c.status','Enable');
		$this->db->where('c.categoryid',$catid);
				
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
	
	function search_company_catid_count($catid)
 	{
		//Executing Query
		$this->db->select('c.*');
		$this->db->from('company as c');
		$this->db->where('c.status','Enable');
		$this->db->where('c.categoryid',$catid);
				
		return $this->db->count_all_results();
		
 	}
	
	function get_solution($urlkey='')
	{
		//Executing Query
		$this->db->select('*');
		$this->db->from('solutions');
		if($urlkey=='')
		{
			$this->db->limit(1);	
		}
		else
		{
		$this->db->where('urlkey',$urlkey);
		}
		$this->db->where('status','Enable');
		$this->db->order_by('insertdate','DESC');		
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
	
	function get_all_countrys()
	{
		//Executing Query
		$this->db->select('country_id,name');
		$this->db->from('country');
						
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
	function get_all_states_by_cid($country_id)
	{
		//Executing Query
		$this->db->select('country_id,name');
		$this->db->from('state');
		$this->db->where('country_id',$country_id);
						
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
	function get_country_name($country_id)
	{
		//Executing Query
		$this->db->select('name');
		$this->db->from('country');
		$this->db->where('country_id',$country_id);
						
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
	function get_country_by_countryid($cid)
	{
		$query = $this->db->get_where('youg_country',array('country_id'=>$cid));
		return $query->row_array();
		
	}
	function get_company_by_emailid($email)
 	{
		//Executing Query
		$this->db->select('*');
		$this->db->from('company');
		$this->db->where('email',$email);
	
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
 	function insert_subscription($companyid,$amt,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscr_id)
 	{
		$date = date("Y-m-d H:i:s");
		$payment_ip = $_SERVER['REMOTE_ADDR'];
		$data = array(
					'company_id' 	=> $companyid,
					'amount'  		=> $amt,
					'txn_id'		=> $tx,
					'payment_date'	=> $date,
					'payment_ip'	=> $payment_ip,
					'expires'		=> $expires,
					'sign'			=> $sig,
					'payer_id'		=> $payer_id,
					'paymentmethod'	=> $paymentmethod,
					'subscr_id'		=> $subscr_id
					
		);
		
		if ($this->db->insert('subscription',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
 	function get_videos_bycompanyid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('video',array('status'=>'Enable','companyid'=>$id,'websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	function get_companysem_bycompanyid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('companysem',array('status'=>'Enable','companyid'=>$id,'websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	function get_companyseo_bycompanyid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('companyseo',array('status'=>'Enable','companyid'=>$id,'websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	function set_password($companyid,$password)
	{
		$data = array(	'password' 	=> $password );

		$this->db->where('id', $companyid);
		if( $this->db->update('company', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function set_sem($companyid,$title,$url,$mainimg,$thumbimg,$siteid,$semtype)
	{
		$data = array(	'companyid' => $companyid,
						'title' 	=> $title,
						'url'		=> $url,
						'mainimg'	=> $mainimg,
						'thumbimg'	=> $thumbimg,
						'status'	=> 'Enable',
						'websiteid'	=> $siteid,
						'type'		=> $semtype
						 );

		if( $this->db->insert('companysem', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function set_seo($companyid,$fieldname,$value,$siteid)
	{
		$data = array(	'companyid'		=>$companyid,
						'value' 		=> $value,
						'fieldname'		=> $fieldname,
						'status'		=>'Enable',
						'websiteid'	 	=> $siteid
						 );

		if( $this->db->insert('companyseo', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function set_video($companyid,$title,$videourl,$siteid,$videono)
	{
		$data = array(	'companyid'	 => $companyid,
						'title' 	 => $title,
						'videourl'	 => $videourl,
						'status'	 => 'Enable',
						'websiteid'	 => $siteid,
						'videono'	 => $videono
						 );

		if( $this->db->insert('video', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function add_transaction($company_id,$payment_amount,$payment_currency,$transactionid,$payment_date)
	{
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company_id' 		=> $company_id,
							'payment_amount'	=> $payment_amount,
							'payment_currency'	=> $payment_currency,
							'transactionid'		=> $transactionid,
							'payment_date' 		=> $payment_date,
							'payment_ip'		=> $varipaddress,
							'status'			=> 'Enable'
						);
		if( $this->db->insert('elite', $data) )
		{
			return true;
		}
		else
		{
			return false;
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
 	function insert_discountcode($companyid,$disc)
 	{
		$data = array('discountcode' => $disc);
		
		$this->db->where('company_id',$companyid);
	
		if ($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
 	function update_company($address,$city,$state,$country,$zip,$companyid)
	{
	 	$data = array(
					'streetaddress'=>$address,
					'city'=>$city,
					'state'=>$state,
					'country'=>$country,
					'zip'=>$zip
		);
		$query=$this->db->where('id',$companyid)
		                ->update('company',$data);
		
		
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}	
		
		
	}	
		
	function get_company_list($compnay_name){
		$query = $this->db->select('id,company')->from('company')->order_by('company','asc')->like('company ',$compnay_name)->where('status','Enable')->limit(15)->get();
		if ($query->num_rows() > 0){			
			return $query->result_array();
		}else{
			return array();
		}
	}
	
	function get_footerlink_byid($id)
	{
		$query = $this->db->order_by("position", "asc")->get_where('youg_pages', array('id' => $id, 'status' => 'Enable'));
		
		if ($query->num_rows() > 0)
		{			
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	function get_footerlink_byintid($intid)
	{
		$query = $this->db->get_where('youg_pages', array('intid' => $intid));
		if ($query->num_rows() > 0)
		{			
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
}
?>
