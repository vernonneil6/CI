<?php
class Complaints extends CI_Model
{
	function get_all_complaints($limit ='',$offset='')
 	{
		$siteid = $this->session->userdata('siteid');
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		$sites = array(1,$siteid);
		//Executing Query
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('complaints as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->where('c.status','Enable');
		$this->db->where_in('c.websiteid',$sites);
		$this->db->order_by('c.complaindate','DESC');
		
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
	
	
	//Inserting Record
	function insert($type,$companyid,$userid,$damagesinamt,$whendate,$location,$detail,$username,$emailid,$statusdisable)
	{
		$siteid = $this->session->userdata('siteid');
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		if(array_key_exists('youg_user',$this->session->userdata) )
			{
		$userid = $this->session->userdata['youg_user']['userid'];
			}
		else
		{
		$userid = 0;
		}
		$detail = strtolower($detail);
		if($statusdisable=='yes')
		{
		$data = array(
							'type' 			=> $type,
							'companyid' 	=> $companyid,
							'userid' 		=> $userid,
							'damagesinamt'	=> $damagesinamt,
							'whendate' 		=> $whendate,
							'location'		=> $location,
					    	'detail'		=> $detail,
							'username'		=> $username,
							'emailid'		=> $emailid,
							'status' 		=> 'Disable',
							'complaindate'	=> $date,
							'complainip'	=> $varipaddress,
							'websiteid'		=> $siteid
						);
		}
		else
		{
			$data = array(
							'type' 			=> $type,
							'companyid' 	=> $companyid,
							'userid' 		=> $userid,
							'damagesinamt'	=> $damagesinamt,
							'whendate' 		=> $whendate,
							'location'		=> $location,
					    	'detail'		=> $detail,
							'username'		=> $username,
							'emailid'		=> $emailid,
							'status' 		=> 'Enable',
							'complaindate'	=> $date,
							'complainip'	=> $varipaddress,
							'websiteid'		=> $siteid
						);
		
		}
		if( $this->db->insert('complaints', $data) )
		{
			$comid = $this->db->insert_id();
			$query = $this->db->get_where('company', array('id' => $companyid));
			$company = $query->result_array();
			//echo "<pre>";
			//print_r($company);
			
		//	$companyname = str_replace(' ','-',$company[0]['company']);
		
			//lower case everything
			$companyname = strtolower($company[0]['company']);
			//make alphaunermic
			$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
			//Clean multiple dashes or whitespaces
			$companyname = preg_replace("/[\s-]+/", " ", $companyname);
			//Convert whitespaces to dash
			$companyname = preg_replace("/[\s]/", "-", $companyname);

			//$companyname = str_replace('.','',$company[0]['company']);
			$seokeyword = $companyname.'-complaint-'.$comid;
			$link = 'complaint/browse/'.$seokeyword;	
			$this->db->where('id', $comid);
			$this->db->update('complaints',array('comseokeyword' => $seokeyword, 'link'=>$link));
			
			return $seokeyword;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_complaint_byid($id)
 	{
		//$this->db->select('c.*, cm.company,cm.logo,u.firstname,u.lastname,u.avatarbig,u.gender');
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('complaints as c');
		$this->db->join('company as cm','c.companyid=cm.id');
//		$this->db->join('user as u','c.userid=u.id');
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
	
	function get_complaint_byseokeyword($word)
 	{
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('complaints as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->where('c.comseokeyword',$word);
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
	function get_complaint_byciduid($cid,$uid)
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		$this->db->where('companyid',$cid);
		$this->db->where('userid',$uid);
		$this->db->where('status','Enable');
		$this->db->where_in('websiteid',$sites);
		
		$query = $this->db->get('complaints');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Querying to Check E-mail or complaint name is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'email' 		: $varfield = 'email';break;
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
		$query = $this->db->get_where('complaints', $option);
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
	
	function get_complaint_bycompanyid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword');
		$this->db->from('complaints as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->where('c.status','Enable');
		$this->db->where_in('c.websiteid',$sites);
		$this->db->where('cm.id',$id);
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
	
	//Inserting Record
	function insert_company($company,$city,$state,$zip,$email,$siteurl,$phone,$category)
	{
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company' 		=> $company,
							'city'			=> $city,
							'state'			=> $state,
							'zip'			=> $zip,
							'email'			=> $email,
							'siteurl'		=> $siteurl,
							'phone'			=> $phone,
							'categoryid'	=> $category,
							'registerdate'	=> $date,
							'registerip' 	=> $varipaddress,
							'status' 		=> 'Enable',
									);

		if( $this->db->insert('company', $data) )
		{
			return 'added';
		}
		else
		{
			return false;
		}
	}
	
	function insert_companyseo($companyid,$company)
	{
			$companyname = strtolower($company);
			//make alphaunermic
			$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
			//Clean multiple dashes or whitespaces
			$companyname = preg_replace("/[\s-]+/", " ", $companyname);
			//Convert whitespaces to dash
			$companyname = preg_replace("/[\s]/", "-", $companyname);

		
		$seokeyword = $companyname.'-'.$companyid;
		
		$this->db->where('id', $companyid);
		if( $this->db->update('company',array('companyseokeyword' => $seokeyword)))
		{
			return true;
		}
		else
		{
			return false;
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
	
	//Getting value for searching
	function search_complaint($keyword,$limit ='',$offset='')
 	{
		$siteid = $this->session->userdata('siteid');
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}

			/*$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.firstname,u.lastname,u.avatarbig,u.gender');
			$this->db->from('complaints as c');
			$this->db->join('company as cm','c.companyid=cm.id');
			$this->db->join('user as u','c.userid=u.id');
			$this->db->or_like(array('c.detail'=>$keyword,'c.location'=>$keyword,'c.username'=>$keyword,'cm.company'=>$keyword,'u.firstname'=>$keyword,'u.lastname'=>$keyword,'c.damagesinamt'=>$keyword,'c.comseokeyword'=>$keyword,'cm.companyseokeyword'=>$keyword));
			$this->db->where('c.status','Enable');
			$this->db->where('c.websiteid',$siteid);

			echo "<pre>";
			print_r($this->db->last_query());
			
			*/
			$sites = array(1,$siteid);
			$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.firstname,u.lastname,u.avatarbig,u.gender');
			$this->db->from('complaints as c');
			$this->db->join('company as cm','c.companyid=cm.id');
			$this->db->join('user as u','c.userid=u.id');
	   		$this->db->where('c.status','Enable');
			$this->db->where_in('c.websiteid',$sites);
			$this->db->where('(c.detail LIKE \'%'.$keyword.'%\' OR c.location LIKE \'%'.$keyword.'%\' OR c.username LIKE \'%'.$keyword.'%\' OR cm.company LIKE \'%'.$keyword.'%\' OR c.damagesinamt LIKE \'%'.$keyword.'%\' OR c.comseokeyword LIKE \'%'.$keyword.'%\' OR cm.companyseokeyword LIKE \'%'.$keyword.'%\')', NULL, FALSE);
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
	
	function get_eliteship_bycompanyid($companyid)
 	{
		$query = $this->db->get_where('elite', array('company_id' => $companyid,'status'=>'Enable'));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Inserting Elite Membership Transaction Details for Company
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
	
	function insert_transaction_details($complaintid,$payment_amount,$payment_currency,$transactionid,$payment_date)
	{
		$siteid = $this->session->userdata('siteid');
		$data = array(
							'cancel_amount'		=> $payment_amount.' '.$payment_currency,
							'transactionid'		=> $transactionid,
							'transaction_date'	=> $payment_date,
							'status'			=> 'Disable'
						);
		$this->db->where('id', $complaintid);
		$this->db->where('websiteid', $siteid);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//get disable complaint by id
	function get_removed_complaint($complaintid)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('complaints', array('id' => $complaintid,'status'=>'Disable','websiteid' => $siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//get last week complaints
	function get_all_last_weekcomplaints($limit ='',$offset='')
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		//Executing Query
			$query = $this->db->query("SELECT * FROM `youg_complaints` WHERE `youg_complaints`.`status` = 'Enable' AND `youg_complaints`.`websiteid` IN '$sites' AND `youg_complaints`.`complaindate` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY  `youg_complaints`.`complaindate` DESC LIMIT ".$offset.",".$limit);
			
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//get last week complaints count
	function get_all_last_weekcomplaints_count()
 	{
			$siteid = $this->session->userdata('siteid');
			$sites = array(1,$siteid);
			$query = $this->db->query("SELECT * FROM `youg_complaints` WHERE `youg_complaints`.`status` = 'Enable' AND `youg_complaints`.`websiteid` IN '$sites' AND `youg_complaints`.`complaindate` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
			
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function search_filter($type,$frmsubdate,$tosubdate,$frmoccdate,$tooccdate)
	{
		$siteid = $this->session->userdata('siteid');
		//$sites = array(1,$siteid);
		//echo count($type);
		if(count($type)==1)
		{
			$type1=$type[0];
			$type2='';
			$type3='';
		}
		elseif(count($type)==2)
		{
			$type1=$type[0];
			$type2=$type[1];
			$type3='';
		}
		elseif(count($type)==3)
		{
			$type1=$type[0];
			$type2=$type[1];
			$type3=$type[2];
		}
		
		if( $frmsubdate!='' )
		{
			$fsdate = date('Y-m-d',strtotime($frmsubdate));
		}
		if( $tosubdate!='' )
		{
			$tsdate = date('Y-m-d',strtotime($tosubdate));
		}
		if( $frmoccdate!='' )
		{
			$fodate = date('Y-m-d',strtotime($frmoccdate));
		}
		if( $tooccdate!='' )
		{
			$todate = date('Y-m-d',strtotime($tooccdate));
		}
				
		$query = $this->db->query("select * from `youg_complaints` where (`type`='$type1' or `type`='$type2' or`type`='$type2' ) AND (`whendate` >='$fodate' and `whendate`<='$todate') AND (`complaindate`>='$fsdate' and `complaindate`<='$tsdate') AND (`youg_complaints`.`status` = 'Enable' ) AND (`youg_complaints`.`websiteid` IN (1,".$siteid.") ) ORDER BY `complaindate`");
		
		//echo $this->db->last_query();
		//echo "<pre>";
		//print_r( $query->result_array());
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
	
	function insert_business($name,$streetaddress,$city,$state,$country,$zip,$phone,$email,$website,$paypalid,$logo,$category,$aboutus)
	{
		
		$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$data = array( 'company' 		=> $name ,
					   'streetaddress'	=> $streetaddress,
					   'city'			=> $city,
					   'state'			=> $state,
					   'country'		=> $country,
					   'zip'			=> $zip,
					   'phone'			=> $phone,
					   'email'			=> $email,
					   'siteurl'		=> $website,
					   'paypalid'		=> $paypalid,
					   'logo'			=> $logo,
					   'categoryid'		=> $category,
					   'status'			=> 'Enable',
					   'registerip' 	=> $varipaddress,
					   'registerdate'	=> $date,
					   'aboutus'		=> $aboutus
 					   ); 
 		
		if ($this->db->insert('company',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Querying to Check E-mail is already exists
	function chkfield1($id,$field,$fieldvalue)
 	{
		
		switch($field)
		{
			case 'email' 	: $varfield = 'email';break;
			case 'company'	: $varfield = 'company';break;
			
		}
		if($id != 0)
		{
			$option = array( 'id !=' => $id, $varfield => $fieldvalue );
		}
		else
		{
			$option = array( $varfield => $fieldvalue );
		}
		$query = $this->db->get_where('company', $option);
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
		}
 	}
	function get_coupon_bycompanyid($id)
 	{
		
		$siteid = $this->session->userdata('siteid');
		//Executing Query
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,ct.category');
		$this->db->from('coupon as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->join('category as ct','c.categoryid=ct.id');
		$this->db->where('c.status','Enable');
		$this->db->where('c.status','Enable');
		$this->db->where('cm.id',$id);
		$this->db->order_by('c.enddate','ASC');
		
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
	
	function get_gallery_bycompanyid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('gallery',array('companyid'=>$id,'status'=>'Enable','websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function get_photos_bygalleryid($id)
 	{
		$query = $this->db->get_where('photos',array('galleryid'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
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
	
	function get_companyreviews_bycompanyid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('companyreviews',array('status'=>'Enable','companyid'=>$id,'websiteid'=>$siteid));
		
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
	
	function disable_complaint_byid($id)
 	{
		$data = array(	'status' 	=> 'Disable');
		$this->db->where('id', $id);
		if ($this->db->update('complaints',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function find_company($company)
 	{
		//Executing Query
		$this->db->select('*');
		$this->db->from('company');
		$this->db->where('company',$company);
	
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
	function insert_contactdetails($companyid,$cname,$cphone,$cemail)
	{
		$this->db->where('id', $companyid);
		if( $this->db->update('company',array('contactname' 		=> $cname,
											  'contactphonenumber' 	=> $cphone,
											  'contactemail' 		=> $cemail)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_category_byid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$this->db->where('id',$id);
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('category');
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_companypdfs_bycompanyid($id)
 	{
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('pdf',array('status'=>'Enable','companyid'=>$id,'websiteid'=>$siteid));
		
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
	/*function search_complaint1($keyword)
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		//complaint table
		$this->db->select('c.link as clink,c.detail as cdetail,c.damagesinamt as damagesinamt,c.complaindate as complaindate,c.status as status');
		$this->db->from('complaints as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->where('c.status','Enable');
		$this->db->where_in('c.websiteid',$sites);
		$this->db->where('(c.detail LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$query = $this->db->get();
		
		//review table
		$this->db->select('r.link as clink,r.comment as cdetail,r.rate as damagesinamt,r.reviewdate as complaindate,');
		$this->db->from('reviews as r');
		$this->db->join('company as cm','r.companyid=cm.id');
		$this->db->where('r.status','Enable');
		$this->db->where('r.websiteid',$siteid);
		$this->db->where('(r.comment LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$query1 = $this->db->get();
			
		//coupon table
		$this->db->select('cou.link as clink,cou.title as cdetail,cou.promocode as damagesinamt,cou.enddate as complaindate,');
		$this->db->from('coupon as cou');
		$this->db->join('company as cm','cou.companyid=cm.id');
		$this->db->where('cou.status','Enable');
		$this->db->where('cou.websiteid',$siteid);
		$this->db->where('(cou.title LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$query2 = $this->db->get();
		
		//press release
		$this->db->select('press.link as clink,press.title as cdetail,press.subtitle as damagesinamt,press.insertdate as complaindate,');
		$this->db->from('pressrelease as press');
		$this->db->join('company as cm','press.companyid=cm.id');
		$this->db->where('press.status','Enable');
		$this->db->where('press.websiteid',$siteid);
		$this->db->where('(press.sortdesc LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$query3 = $this->db->get();
		
		if ($query->num_rows() > 0 || $query1->num_rows() > 0 || $query2->num_rows() > 0 || $query3->num_rows() > 0)
		{
			//echo "<pre>";
			$a = $query->result_array();
			$b = $query1->result_array();
			$c = $query2->result_array();
			$d = $query3->result_array();
			
			$merge =array_merge($a,$b,$c,$d);
			return $merge;
					
		}
		else
		{
			return array();
		}
 	
	}*/
	
	public function insert_test($text)
	{
		$data = array(
					'name' 	=> $text,
					
					
		);
		
		if ($this->db->insert('test',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	function disable_elitemeber_byid($id)
 	{
		$data = array(	'status' 	=> 'Disable');
		$this->db->where('company_id', $id);
		if ($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Getting value for searching
	function topsearch_complaint($keyword)
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		
		//complaint table
		$this->db->select('c.link as clink,c.detail as cdetail,c.damagesinamt as damagesinamt,c.complaindate as complaindate,c.status as status,
						  r.link as rclink,r.comment as rcdetail,r.rate as rdamagesinamt,r.reviewdate as rcomplaindate,
						  cou.link as couclink,cou.title as coucdetail,cou.promocode as coudamagesinamt,cou.enddate as coucomplaindate,
						  press.link as pressclink,press.title as presscdetail,press.subtitle as pressdamagesinamt,press.insertdate as presscomplaindate,
						  ');
		$this->db->from('company as cm');
		$this->db->join('reviews as r','cm.id=r.companyid','left');
		$this->db->join('coupon as cou','cm.id=cou.companyid','left');
		$this->db->join('coupon as cp','cm.id=cp.companyid','left');
		$this->db->join('pressrelease as press','cm.id=press.companyid','left');
		$this->db->where('cm.status','Enable');
		$this->db->where('r.status','Enable');
		$this->db->where('r.websiteid',$siteid);
		$this->db->where('cou.status','Enable');
		$this->db->where('cou.websiteid',$siteid);
		$this->db->where_in('c.websiteid',$sites);
		$this->db->where('press.status','Enable');
		$this->db->where('press.websiteid',$siteid);
		
		$this->db->where('(c.detail LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$this->db->where('(r.comment LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$this->db->where('(cou.title LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$this->db->where('(press.sortdesc LIKE \'%'.$keyword.'%\' OR LOWER(cm.company) LIKE \'%'.strtolower($keyword).'%\')', NULL, FALSE);
		$query3 = $this->db->get();
		
		if ($query->num_rows() > 0 || $query1->num_rows() > 0 || $query2->num_rows() > 0 || $query3->num_rows() > 0)
		{
			//echo "<pre>";
			$a = $query->result_array();
			$b = $query1->result_array();
			$c = $query2->result_array();
			$d = $query3->result_array();
			
			$merge =array_merge($a,$b,$c,$d);
			return $merge;
			
			
		}
		else
		{
			return array();
		}
 	
	}
	
		function search_complaint1($keyword,$limit='',$offset='')
 		{
		   $keyword = base64_decode($keyword);	
		   $keyword = str_replace('-',' ',$keyword);
		   $this->db->select('id');
		   $this->db->from('company');
		   $this->db->where(array('LOWER(company)'=>strtolower($keyword)));
		   $query1 = $this->db->get();
		   if($query1->num_rows() > 0)
		  {
			$companyarray =$query1->result_array();
			//echo "<pre>";
			//print_r($companyarray);
			$companyid = $companyarray[0]['id'];
		   }
		  else
		  {
		 	$companyid = '';
		  }
	
		   $siteid = $this->session->userdata('siteid');
		   $sites = array(1,$siteid);
			
		   if($companyid==''){
			 
		   $query = "(SELECT link, detail,damagesinamt,complaindate FROM youg_complaints WHERE detail LIKE '%" . 
           $keyword . "%' OR damagesinamt LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid IN (1,".$siteid.")) ) 
           UNION
           (SELECT link,comment,rate,reviewdate FROM youg_reviews WHERE comment LIKE '%" . 
           $keyword . "%' OR rate LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid=".$siteid.") ) 
           UNION
           (SELECT link,title,promocode,enddate FROM youg_coupon WHERE title LIKE '%" . 
           $keyword . "%' OR promocode LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid=".$siteid.") ) 
		   UNION
           (SELECT link,title,subtitle,insertdate FROM youg_pressrelease WHERE presscontent LIKE '%" . 
           $keyword . "%' OR sortdesc LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid=".$siteid.") ) LIMIT ".$offset." , ".$limit."
            ";
			$query = $this->db->query($query);
		   }else
		   {
			
			$query = "(SELECT link, detail,damagesinamt,complaindate FROM youg_complaints WHERE companyid='" . $companyid ."' AND (status='Enable') AND (websiteid IN (1,".$siteid.")) ) 
           UNION
           (SELECT link,comment,rate,reviewdate FROM youg_reviews WHERE companyid='" . 
           $companyid . "' AND (status='Enable') AND (websiteid=".$siteid.") ) 
           UNION
           (SELECT link,title,promocode,enddate FROM youg_coupon WHERE companyid='" . 
           $companyid . "' AND (status='Enable') AND (websiteid=".$siteid.") ) 
		   UNION
           (SELECT link,title,subtitle,insertdate FROM youg_pressrelease WHERE companyid='" . 
           $companyid . "' AND (status='Enable') AND (websiteid=".$siteid.") ) 
            LIMIT ".$offset." , ".$limit." ";
			$query = $this->db->query($query);
		   
			}
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
		function search_complaint1_count($keyword)
 		{
		   $keyword = base64_decode($keyword);	
		   $keyword = str_replace('-',' ',$keyword);
		   $this->db->select('id');
		   $this->db->from('company');
		   $this->db->where(array('LOWER(company)'=>strtolower($keyword)));
		   $query1 = $this->db->get();
		   if($query1->num_rows() > 0)
		  {
			$companyarray =$query1->result_array();
			//echo "<pre>";
			//print_r($companyarray);
			$companyid = $companyarray[0]['id'];
		   }
		  else
		  {
		 	$companyid = '';
		  }
	
		   $siteid = $this->session->userdata('siteid');
		   $sites = array(1,$siteid);
			
		   if($companyid==''){
			 
		   $query = "(SELECT link, detail,damagesinamt,complaindate FROM youg_complaints WHERE detail LIKE '%" . 
           $keyword . "%' OR damagesinamt LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid IN (1,".$siteid.")) ) 
           UNION
           (SELECT link,comment,rate,reviewdate FROM youg_reviews WHERE comment LIKE '%" . 
           $keyword . "%' OR rate LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid=".$siteid.") ) 
           UNION
           (SELECT link,title,promocode,enddate FROM youg_coupon WHERE title LIKE '%" . 
           $keyword . "%' OR promocode LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid=".$siteid.") ) 
		   UNION
           (SELECT link,title,subtitle,insertdate FROM youg_pressrelease WHERE presscontent LIKE '%" . 
           $keyword . "%' OR sortdesc LIKE '%" . $keyword ."%' AND (status='Enable') AND (websiteid=".$siteid.") ) ";
			$query = mysql_query($query);
			return mysql_num_rows($query);
		   
		   }else
		   {
			
			$query = "(SELECT link, detail,damagesinamt,complaindate FROM youg_complaints WHERE companyid='" . $companyid ."' AND (status='Enable') AND (websiteid IN (1,".$siteid.")) ) 
           UNION
           (SELECT link,comment,rate,reviewdate FROM youg_reviews WHERE companyid='" . 
           $companyid . "' AND (status='Enable') AND (websiteid=".$siteid.") ) 
           UNION
           (SELECT link,title,promocode,enddate FROM youg_coupon WHERE companyid='" . 
           $companyid . "' AND (status='Enable') AND (websiteid=".$siteid.") ) 
		   UNION
           (SELECT link,title,subtitle,insertdate FROM youg_pressrelease WHERE companyid='" . 
           $companyid . "' AND (status='Enable') AND (websiteid=".$siteid.") ) 
            ";
			$query = mysql_query($query);
			return mysql_num_rows($query);
		   
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