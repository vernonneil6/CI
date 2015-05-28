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
 	
 	function get_country_byidss($id)
 	{
		$query = $this->db->get_where('country',array('country_id'=>$id));
	
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Inserting Record
	function insert($companyid,$detail,$username,$emailid,$statusdisable,$city,$state,$zip,$company ,$reasondispute,$merchantresolution,$streetaddress,$phone,$caseid,$transactionid,$transaction_date,$transactionamt,$complaintdate,$userid,$companyemail,$complaintdate,$image)
	{
		$siteid = $this->session->userdata('siteid');
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
							
							'companyid' 	=> $companyid,
					    	'detail'		=> $detail,
							'username'		=> $username,
							'emailid'		=> $emailid,
							'status' 		=> 'Disable',
							'complaindate'	=> $date,
							'complainip'	=> $varipaddress,
							'websiteid'		=> $siteid,
							'city'          =>$city,
							'state'         =>$state,
							'zip'           =>$zip,
							'phone'         =>$phone,
							'address'       =>$streetaddress,
							'reasondispute' =>$reasondispute,
							'merchantresolution'=>$merchantresolution,
							'caseid'        =>$caseid,
							'transactionid' =>$transactionid,
							'transaction_date'=>$transaction_date,
							'transaction_amt'=>$transactionamt,
							'whendate'       =>$date,
							'complaindate'   =>$complaintdate,
							'userid'         =>$userid,
							'companyemail'   =>$companyemail,
							'complaindate'   =>$complaintdate,
							'image'          =>$image

						);
		}
		else
		{
			$data = array(
							'companyid' 	=> $companyid,
					    	'detail'		=> $detail,
							'username'		=> $username,
							'emailid'		=> $emailid,
							'status' 		=> 'Enable',
							'complaindate'	=> $date,
							'complainip'	=> $varipaddress,
							'websiteid'		=> $siteid,
							'city'          =>$city,
							'state'         =>$state,
							'zip'           =>$zip,
							'phone'         =>$phone,
							'address'       =>$streetaddress,
							'reasondispute' =>$reasondispute,
							'merchantresolution'=>$merchantresolution,
							'caseid'        =>$caseid,
							'transactionid' =>$transactionid,
							'transaction_date'=>$transaction_date,
							'transaction_amt'=>$transactionamt,
							'whendate'      =>$date,
							'complaindate'  =>$complaintdate,
							'userid'        =>$userid,
							'companyemail'  =>$companyemail,
							'complaindate'  =>$complaintdate,
							'image'         =>$image
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
	
	function get_company_bysubscriptionid($companyid)
	{
		$query = $this->db->get_where('youg_subscription',array('company_id'=>$companyid));
		if($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
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
	
	function get_complaint_bycompanyid($id,$oldcmid='')
 	{
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.username,u.avatarbig,u.avatarthum,u.gender');
		$this->db->from('complaints as c');
		$this->db->join('company as cm','c.companyid=cm.id');
		$this->db->join('user u','c.userid=u.id');
		$this->db->where('c.status','Enable');
		$this->db->where_in('c.websiteid',$sites);
		if($oldcmid!=''){
		$this->db->where('c.id !=',$oldcmid);
			}
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
	function insert_company($company,$city,$country,$state,$zip,$email,$siteurl,$phone,$category,$streetaddress='')
	{
		//$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company' 		=> $company,
							'streetaddress'			=> $streetaddress,
							'city'			=> $city,
							'state'			=> $state,
							'country'			=> $country,
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
		$sites =  "1,".$siteid;
		//Executing Query
			$query = $this->db->query("SELECT * FROM `youg_complaints` WHERE `youg_complaints`.`status` = 'Enable' AND `youg_complaints`.`websiteid` IN (".$sites.") AND `youg_complaints`.`complaindate` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY  `youg_complaints`.`complaindate` DESC LIMIT ".$offset.",".$limit);
			
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
			$sites =  "1,".$siteid;
			$query = $this->db->query("SELECT * FROM `youg_complaints` WHERE `youg_complaints`.`status` = 'Enable' AND `youg_complaints`.`websiteid` IN (".$sites.") AND `youg_complaints`.`complaindate` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
			
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
	
	function insert_business($name,$streetaddress,$city,$state,$country,$zip,$streetaddress1,$city1,$state1,$country1,$zip1,$phone,$email,$website,$paypalid,$logo,$category,$aboutus,$brokerid,$mainbrokerid,$subbrokerid,$marketerid,$brokertype)
	{
		
		//$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$data = array( 'company' 		=> $name ,
					   'streetaddress'	=> $streetaddress,
					   'city'			=> $city,
					   'state'			=> $state,
					   'country'		=> $country,
					   'zip'			=> $zip,
					   'companystreet'	=> $streetaddress1,
					   'companycity'	=> $city1,
					   'companystate'	=> $state1,
					   'companycountry'	=> $country1,
					   'companyzip'		=> $zip1,
					   'phone'			=> $phone,
					   'email'			=> $email,
					   'siteurl'		=> $website,
					   'paypalid'		=> $paypalid,
					   'logo'			=> $logo,
					   'categoryid'		=> $category,
					   'status'			=> 'Enable',
					   'registerip' 	=> $varipaddress,
					   'registerdate'	=> $date,
					   'aboutus'		=> $aboutus,
					   'brokerid'		=> $brokerid,
					   'mainbrokerid'	=> $mainbrokerid,
					   'subbrokerid'	=> $subbrokerid,
					   'marketerid'		=> $marketerid,
					   'brokertype'		=> $brokertype
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
	function insert_businesses($name,$streetaddress,$city,$state,$country,$zip,$phone,$email,$website,$paypalid,$logo,$category,$aboutus)
	{
		
		//$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$data = array( 'company' 		=> $name ,
					   'streetaddress'	=> $streetaddress,
					   'city'	        => $city,
					   'state'	        => $state,
					   'country'	    => $country,
					   'zip'	        => $zip,
					   'companystreet'	=> $streetaddress,
					   'companycity'	=> $city,
					   'companystate'	=> $state,
					   'companycountry'	=> $country,
					   'companyzip'		=> $zip,
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
	function insert_business_broker($name,$streetaddress,$city,$state,$country,$zip,$streetaddress1,$city1,$state1,$country1,$zip1,$phone,$email,$website,$paypalid,$logo,$category,$aboutus,$brokerid,$brokertype,$marketerid,$subbrokerid,$mainbrokerid,$actype,$notes)
	{
		
		//$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$data = array( 'company' 		=> $name ,
					   'streetaddress'	=> $streetaddress,
					   'city'			=> $city,
					   'state'			=> $state,
					   'country'		=> $country,
					   'zip'			=> $zip,
					   'companystreet'	=> $streetaddress1,
					   'companycity'	=> $city1,
					   'companystate'	=> $state1,
					   'companycountry'	=> $country1,
					   'companyzip'		=> $zip1,
					   'phone'			=> $phone,
					   'email'			=> $email,
					   'siteurl'		=> $website,
					   'paypalid'		=> $paypalid,
					   'logo'			=> $logo,
					   'categoryid'		=> $category,
					   'status'			=> 'Enable',
					   'registerip' 	=> $varipaddress,
					   'registerdate'	=> $date,
					   'aboutus'		=> $aboutus,
					   'brokerid'		=> $brokerid,
					   'brokertype'		=> $brokertype,
					   'subbrokerid'	=> $subbrokerid,
					   'mainbrokerid'	=> $mainbrokerid,
					   'marketerid'		=> $marketerid,
					   'acquisitiontype'=> $actype,
					   'notes'			=> $notes
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
	
	//function insert_subscription($companyid,$amt,$ccnumber,$cardexpire,$fname,$lname,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscr_id)
	function insert_subscription($companyid,$amt,$ccnumber,$cvv,$cardexpire,$fname,$lname,$tx,$expires,$sig,$payer_id,$paymentmethod,$subscr_id,$auth_transaction_id,$auth_type,$disc,$disccode_type,$disccode_price,$disccode_use)
 	{
		$date = date("Y-m-d H:i:s");
		$disccode_usedate = date("Y-m-d H:i:s");
		$payment_ip = $_SERVER['REMOTE_ADDR'];
		$data = array(
					'company_id' 	=> $companyid,
					'amount'  		=> $amt,
					'ccnumber'  	=> $ccnumber,
					'cvv'			=> $cvv,
					'ccexpiredate'  => $cardexpire,
					'firstname	'  	=> $fname,
					'lastname	'  	=> $lname,
					'txn_id'		=> $tx,
					'payment_date'	=> $date,
					'payment_ip'	=> $payment_ip,
					'expires'		=> $expires,
					'sign'			=> $sig,
					'payer_id'		=> $payer_id,
					'paymentmethod'	=> $paymentmethod,
					'subscr_id'		=> $subscr_id,
                                        'auth_transreponse_key' =>$auth_transaction_id,
                                        'auth_type' =>$auth_type, 
					'discountcode' => $disc,
					'discountcodetype' => $disccode_type, 
					'discountprice' => $disccode_price,
					'discountusedate' => $disccode_usedate,
					'discountusecount' => $disccode_use,
                                        
					
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
	function find_elitecompany_for_check($company)
 	{
		//Executing Query
		$this->db->select('id,company');
		$this->db->from('company');
		$this->db->where('company',$company);
	
		$query = $this->db->get();
                        
                $this->db->select('company_id');
                $this->db->from('elite');
                $elitecheck=$query->row_array();
	       $eliteid="";	
               if(count($elitecheck) > 0)
                 { $eliteid=$elitecheck['id']; }
                 $this->db->where(array('company_id'=>$eliteid,'status'=>'Enable'));
                $name=$this->db->get();
                              
		if ($name->num_rows() > 0)
		{
			return $name->row_array();
		}
		else
		{
			return array();
		}
 	}
	function find_company_for_check($company)
 	{
		//Executing Query
		$this->db->select('id,company');
		$this->db->from('company');
		$this->db->where('company',$company);
	
		$query = $this->db->get();
                                             
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
 	}
	function find_company_by_email($email)
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
	
	/*function insert_discountcode($companyid,$disc)
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
 	}*/
	function insert_discountcode($companyid,$disc,$disccode_type,$disccode_price,$disccode_use)
 	{
		$disccode_usedate=date('Y-m-d H:i:s');
		$data = array(
		              'discountcode' => $disc,
		              'discountcodetype' => $disccode_type, 
		              'discountprice' => $disccode_price,
		              'discountusedate' => $disccode_usedate,
		              'discountusecount' => $disccode_use,
		             );
		
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
 	function update_discount_used($discid)
 	{
		
		$discuse=1;
		$data = array('apply' => $discuse);
		$this->db->where('id',$discid);
	
		if ($this->db->update('discount',$data))
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
        function get_companyemail_by_emailid($email)
 	{
		//Executing Query
		$this->db->select('email');
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
        function get_companyelite_by_emailid($email)
 	{
            
		//Executing Query
		$this->db->select('id,email');
		$this->db->from('company');
		$this->db->where('email',$email);
	
		$query = $this->db->get();
	          
                $this->db->select('company_id');
                $this->db->from('elite');
                $elitecheck=$query->row_array();
	        $eliteid="";	
                if(count($elitecheck) > 0)
                 { $eliteid=$elitecheck['id']; }
                 $this->db->where('company_id',$eliteid);
                 $email=$this->db->get();
                             
		if ($email->num_rows() > 0)
		{
			return $email->row_array();
		}
		else
		{
			return array();
		}
 	} 
	function insert_contactdetails($companyid,$cname,$cphone,$cemail,$ctitle)
	{
		$this->db->where('id', $companyid);
		if( $this->db->update('company',array('contactname' 		=> $cname,
											  'contactphonenumber' 	=> $cphone,
											  'contactemail' 		=> $cemail,
											  'title' 		        => $ctitle)))
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
 	//Getting value for editing
	function get_categories_byid($id)
 	{
		$categoryid=explode(",",$id);
		$siteid = $this->session->userdata('siteid');
		$this->db->select('GROUP_CONCAT(category SEPARATOR ",") as categoryname',false);
		$this->db->where_in('id',$categoryid);
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
	
	//get pressreleases
	function get_companypressreleases_bycompanyid($id,$limit ='',$offset='')
 	{
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		$siteid = $this->session->userdata('siteid');
		//$this->db->limit(5);
		$query = $this->db->get_where('pressrelease',array('status'=>'Enable','companyid'=>$id,'websiteid'=>$siteid));
		
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
		   //$keyword = str_replace('-',' ',$keyword);
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
		   //$keyword = str_replace('-',' ',$keyword);
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
	
	//get_pressreleases_bycompanyid
	function get_pressreleases_bycompanyid($cid,$limit='',$offset='')
	{
		$siteid = $this->session->userdata('siteid');
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->select('pressrelease.*,c.companyseokeyword,c.company');
		$this->db->from('pressrelease');
		$this->db->join('company c','pressrelease.companyid=c.id');
		$this->db->where('pressrelease.status','Enable');
		$this->db->where('companyid',$cid);
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
	
	//get_company_timings
	function get_company_timings($cid)
	{
		//Executing Query
		$this->db->select('*');
		$this->db->from('timings');
		$this->db->where('companyid',$cid);
		$this->db->order_by('id','ASC');
		
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
	
	function get_company_onetimings($cid)
	{
		$days=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
		$singledate = strtolower(jddayofweek($days,1));
		
		//Executing Query
		$this->db->select('*');
		$this->db->from('timings');
		$this->db->where('companyid',$cid);
		$this->db->where('daytype',$singledate);
		$this->db->order_by('id','ASC');
		
		$query = $this->db->get();
		//echo $this->db->last_query();
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
 	
	
	}
	
	//get totals
	
	function get_to_reviews_cid($cid)
	{
		$this->db->select('rate');
		$this->db->where(array('companyid'=>$cid, 'status'=>'Enable'));	
		$query = $this->db->get('reviews');	
		$a = count($query->result_array());
		return $a;
	}
	
	function get_to_complaints_cid($cid)
	{
		$this->db->select('id');
		$this->db->where('companyid',$cid);
		$this->db->where('status','Enable');
		$query1 = $this->db->get('complaints');		
		$a = count($query1->result_array());		
		return $a;
	}
	
	function get_to_damages_cid($cid)
	{
		$this->db->select_sum('damagesinamt');
		$this->db->where('companyid',$cid);
		$query1 = $this->db->get('complaints');	
		
		$a = ($query1->result_array());
		return $a[0]['damagesinamt'];
	}
	
	function set_timing($websiteid,$companyid,$daytype,$off,$start,$end)
	{
		$data = array(		'websiteid' => $websiteid,
							'companyid' => $companyid,
							'daytype'	=> $daytype,
							'off' 		=> $off,
							'start'		=> $start,
					    	'end'		=> $end,
							
						);
		
		if( $this->db->insert('timings', $data) )
		{
			
			return true;
		}
		else
		{
			return false;
		}
	}
	function retrieve_company($cmid)
	{
		
		$query4=$this->db->get_where('youg_company',array('id'=>$cmid));
		return $query4->row_array();
		//return $this->db->getwhere('youg_company',array('id'=>$id))->row_array();
	   
	}
	function insert_dispute($companyname,$companyid,$companyemail,$userid,$username,$useremail,$status,$ondate,$msglink,$transactionid,$transactionamt,$transactiondate,$reasondispute,$merchantresolution)
	{
		$data = array(
	              'companyname'=>$companyname,
	              'companyid'=>$companyid,
	              'companyemail'=>$companyemail,
	              'userid'=>$userid,
	              'username'=>$username,
	              'useremail'=>$useremail,
	              'dispute'=>$reasondispute,
				  'status'=>$status,
	              'ondate'=>$ondate,
	              'msglink'=>$msglink,
	              'transaction_id'=>$transactionid,
	              'transaction_amount'=>$transactionamt,
	              'transaction_date'=>$transactiondate,
	              'resolutionexpect'=>$merchantresolution
	              
	            );
	    $this->db->insert('youg_dispute',$data);
	    //$data['lastid'] = $this->db->insert_id();
	    $lastid = $this->db->insert_id();
        $this->db->trans_complete();
 	    return  $lastid;
			  
	}
	function companygetid($id)
	{
		$query = $this->db->get_where('youg_company',array('id'=>$id));
		return $query->row_array();
	}
	function brokerid($id)
	{
		$query = $this->db->get_where('youg_broker',array('id'=>$id));
		return $query->row_array();
	}
	function get_country_by_countryid($cid)
	{
		$query = $this->db->get_where('youg_country',array('country_id'=>$cid));
		return $query->row_array();
		
	}
	function elitecrondetails()
	{
		//$checkdate=date('Y-m-d');
		$checkdate=date('Y-m-d', strtotime($date .' -1 day'));
		$query=$this->db->select('*')
						->from('youg_subscription as s')
						->join('youg_elite as e','e.company_id = s.company_id','left')
						->where("(`s`.`transactionstatus` = '0' and `s`.`paymentmethod` = 'authorize' and `s`.`subscr_id` != '' and `s`.`emailflag` = '0' and `s`.`expireflag` = '2') OR 
						(`e`.`cancel_flag`='1')")
						->like('s.expires',$checkdate)
						->get()
			            ->result_array();
		//echo $this->db->last_query();	 die;
		return $query;
		
	}
	
	function expirecrons()
	{
		$checkdate=date('Y-m-d');
		$query=$this->db->select('*')
						->from('youg_subscription')
						->where(array('transactionstatus'=>'0','paymentmethod'=>'authorize','subscr_id !='=>'','emailflag'=>'0','expireflag'=>'1'))
						->like('expires',$checkdate)
						->get()
			            ->result_array();
		return $query;
		
	}
	
	function expirecronupdate($companyid)
	{
		$query = $this->db->where('company_id',$companyid)->update('youg_subscription',array('expireflag'=>'2'));
	}
	function disable_cancelflag($companyid)
	{
		$query = $this->db->where(array('company_id'=>$companyid,'cancel_flag'=>'1'))->update('youg_elite',array('cancel_flag'=>'2'));
	}
	
	function ccexpire_email()
	{
		$ccexpiredate=date('Y-m',strtotime("+1 Month"));
		$query=$this->db->select('*')
							->from('youg_subscription')
							->where(array('transactionstatus'=>'0','paymentmethod'=>'authorize','subscr_id !='=>'','emailflag'=>'0'))
							->like('ccexpiredate',$ccexpiredate) 
							->get()
							->result_array();
		
					
		foreach($query as $q){
		
		    $split=explode('-',$q['ccexpiredate']);
			$year=$split[0];
			$month=$split[1];
			$from_unix_time = mktime(0, 0, 0,$month, 0, $year);
			$day_before = strtotime("-15 days", $from_unix_time);
			$fifteendays_days_ago =date('Y-m-d', $day_before);
                           $date1= strtotime(date("Y-m-d"));
                           //$date1= strtotime(date("2015-03-16"));
			$date2  	= strtotime($fifteendays_days_ago);
			if($date1 == $date2){
				return $query;
			} 
		}
	}
	function disable_elitemembership($company_id)
	{
		$data=array(
		        'status' =>'Disable',
		        'cancel_flag'=>'2'
		);
		$query=$this->db->where('company_id',$company_id) 
		               ->update('youg_elite',$data);
		return $query;	
		
	}
	function get_subscriptionid($sid)
	{
		$query = $this->db->get_where('youg_subscription',array('company_id'=>$sid));
		return $query->row_array();
				         
	}
	function get_elitesubscription_detailsbycompanyid($emailcompany)
	{
		
		$query = $this->db->get_where('youg_company',array('id'=>$emailcompany));
		return $query->row_array();
		
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
	function update_subscription($subscriptionId,$companyid,$amt,$ccnumber,$cvv,$cardexpire,$fname,$lname,$tx,$sig,$time,$expires,$payer_id,$paymentmethod,$emailflag)
	{
           
	    $date = date("Y-m-d H:i:s");
		$payment_ip = $_SERVER['REMOTE_ADDR'];
		$data = array(
					'amount'  		=> $amt,
					'ccnumber'  	=> $ccnumber,
                                        'cvv'           =>$cvv,
					'ccexpiredate'  => $cardexpire,
					'firstname	'  	=> $fname,
					'lastname	'  	=> $lname,
					'txn_id'		=> $tx,
					'payment_date'	=> $date,
					'payment_ip'	=> $payment_ip,
					'expires'		=> $expires,
					'sign'			=> $sig,
					'payer_id'		=> $payer_id,
					'paymentmethod'	=> $paymentmethod,
                                        'subscr_id '    => $subscriptionId         
		);
		$this->db->where('company_id',$companyid);
		if($this->db->update('subscription',$data))
		{
			return true;
		}
		else
		{
			return false;
		}	
		
		
	}
	function update_elite($companyid,$payment_amount,$payment_currency,$transactionid,$payment_date)
	{
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$emailflag='1';
		  $date = date("Y-m-d H:i:s");
		$data = array(   
							'payment_amount'	=> $payment_amount,
							'payment_currency'	=> $payment_currency,
							'transactionid'		=> $transactionid,
							'payment_date' 		=> $payment_date,
							'payment_ip'		=> $varipaddress,
							'renew_emailflag'   => $emailflag,
							'status'			=> 'Enable',
							'cancel_flag'		=> '0',
							'dateofrenew'		=>$date
						);
		$this->db->where('company_id',$companyid);				
		$this->db->update('elite', $data); 
		
	}
	function getexpired_payment()
	{
		
	    $checkdate=date('Y-m-d');
		$query=$this->db->select('*')
						->from('youg_subscription')
						->where(array('transactionstatus'=>'0','paymentmethod'=>'authorize','subscr_id !='=>''))
						->like('expires',$checkdate)
						->get()
			            ->result_array();
		//echo $this->db->last_query();	
		return $query;	
		
		
	}
	function getsuccess_payment()
	{
		
		$checkdate=date('Y-m-d');
		$query=$this->db->select('*')
						->from('youg_subscription')
						->where(array('transactionstatus'=>'1','paymentmethod'=>'authorize','subscr_id !='=>''))
						->like('payment_date',$checkdate)
						->get()
			            ->result_array();
		//echo $this->db->last_query();	
		return $query;	
		
		
	}
	function company_available_by_id($id)
	{
		$query=$this->db->select('id,company,siteurl,categoryid,email,streetaddress,city,state,country,zip,phone,contactname,contactphonenumber,contactemail')
		                 ->from('company')
		                 ->where('id',$id)
		                 ->get();
		if($query)
		{
			return $query->row_array();
			
		}
		else
		{
			return false;
			
		}
		                 
		
	}
	
	function get_company_bysingleid($id)
 	{
		$query = $this->db->get_where('company', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
 	}
 	function get_discount_enabled($discountcode)
 	{
		$query = $this->db->select('discountprice,percentage,discountcodetype')
		                  ->from('discount')
		                  ->where(array('status'=>'Enable','code'=>$discountcode))
		                  ->get();
	
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
		
	}
	function get_discount_method($disccode_user)
	{
	  	$query = $this->db->select('*')
		                  ->from('discount')
		                  ->where(array('status'=>'Enable','code'=>$disccode_user))
		                  ->get();
	  	
	  	if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
		
		
	}
	function get_companyelite_byid($id)
	{
		$query = $this->db->select('payment_amount,discountcodetype,discountcode')
		                  ->from('elite')
		                  ->where(array('company_id'=>$id))
		                  ->get();
	  	
	  	if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
			
	}
	
	function get_broker_by_id($id)
	{
		$query = $this->db->get_where('youg_broker',array('id'=>$id));
	  	
	  	if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
			
	}
    function update_businessdetails($companyid,$name, $address,$city,$state,$country,$zip,$address1,$city1,$state1,$country1,$zip1,$phone,$email,$website,$category)
	{
		
		//$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$data = array(
		           'company' 		=> $name , 
		           'streetaddress'	=> $address,
				   'city'		    => $city,
				   'state'		    => $state,
				   'country'	    => $country,
				   'zip'		    => $zip,
			       'companystreet'	=> $address1,
				   'companycity'	=> $city1,
				   'companystate'	=> $state1,
				   'companycountry'	=> $country1,
				   'companyzip'		=> $zip1,
				   'phone'			=> $phone,
				   'email'			=> $email,
				   'siteurl'		=> $website,
				   'categoryid'		=> $category,
				   'status'			=> 'Enable',
				   'registerip' 	=> $varipaddress,
				   'registerdate'	=> $date
				   
        ); 
 		$updation=$this->db->where('id', $companyid)
                           ->update('company',$data);
		if ($updation)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

        function update_business($companyid,$name,$streetaddress,$city,$state,$country,$zip,$streetaddress1,$city1,$state1,$country1,$zip1,$phone,$email,$website,$paypalid,$logo,$category,$aboutus,$brokerid,$mainbrokerid,$subbrokerid,$marketerid,$brokertype)
	{
		
		//$date = date_default_timezone_set('Asia/Kolkata');
		$date = date('Y-m-d H:i:s');
		
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		
		$data = array( 'company' 		=> $name ,
					   'streetaddress'	=> $streetaddress,
					   'city'			=> $city,
					   'state'			=> $state,
					   'country'		=> $country,
					   'zip'			=> $zip,
					   'companystreet'	=> $streetaddress1,
					   'companycity'	=> $city1,
					   'companystate'	=> $state1,
					   'companycountry'	=> $country1,
					   'companyzip'		=> $zip1,
					   'phone'			=> $phone,
					   'email'			=> $email,
					   'siteurl'		=> $website,
					   'paypalid'		=> $paypalid,
					   'logo'			=> $logo,
					   'categoryid'		=> $category,
					   'status'			=> 'Enable',
					   'registerip' 	=> $varipaddress,
					   'registerdate'	=> $date,
					   'aboutus'		=> $aboutus,
					   'brokerid'		=> $brokerid,
					   'mainbrokerid'	=> $mainbrokerid,
					   'subbrokerid'	=> $subbrokerid,
					   'marketerid'		=> $marketerid,
					   'brokertype'		=> $brokertype
 					   ); 
 		
		$updations=$this->db->where('id', $companyid)
                                   ->update('company',$data);
		if ($updations)
		{
			return true;
		}
		else
		{
			return false;
                 }

	}
	function emailvalid($email)
	{
		$query = $this->db->get_where('youg_user', array('email'=>$email));
		if($query->num_rows() > 0)
		{
			return '1';
		}
		else
		{
			return '0';
		}
	}
	
	function namevalid($name)
	{
		$query = $this->db->get_where('youg_user', array('username'=>$name));
		if($query->num_rows() > 0)
		{
			return '1';
		}
		else
		{
			return '0';

		}
	}
	
	function companystreetvalid($company, $street)
	{
		$query = $this->db->select('id,company,streetaddress')
		                  ->get_where('youg_company', array('company'=>$company, 'streetaddress'=>$street))
		                  ->row_array();
		if(count($query) > 0)
		{
		 $elitecheckerflag=$this->db->select('id,company_id,status')
			                       ->get_where('youg_elite', array('company_id'=>$query['id'], 'status'=>'Enable'))
			                       ->row_array(); 
		
				if(count($elitecheckerflag) > 0){
					$elitecheckerflag=1;
				}	                       
		}
		else
		{
			$elitecheckerflag=0;
		}
		
			
		if($elitecheckerflag == 1){
			return '1';
		} else {
			return '0';
		}
	}
	
	function companystreetvalid1($company, $street)
	{
		$query = $this->db->select('id,company,companystreet')
		                  ->get_where('youg_company', array('company'=>$company, 'companystreet'=>$street))
		                  ->row_array();
      		                  
		if(count($query) > 0)
		{
		 $elitecheckerflag=$this->db->select('id,company_id,status')
			                       ->get_where('youg_elite', array('company_id'=>$query['id'], 'status'=>'Enable'))
			                       ->row_array(); 
		
				if(count($elitecheckerflag) > 0){
					$elitecheckerflag=1;
				}	                       
		}
		else
		{
			$elitecheckerflag=0;
		}
		
			
		if($elitecheckerflag == 1){
			return '1';
		} else {
			return '0';
		}
	}
	function delete_previous_elite($companyid)
	{
	  
	  $query=$this->db->delete('youg_elite', array('company_id' => $companyid)); 
	  
	  if($query)
	  {
		return true;  
	  }
	  else
	  {
		return false;  
	  }
	}
	function delete_previous_subscription($companyid)
	{
	  
	  $query=$this->db->delete('youg_subscription', array('company_id' => $companyid)); 
	  
	  if($query)
	  {
		return true;  
	  }
	  else
	  {
		return false;  
	  }
	}
	function get_aff_broker_details($affid)
	{
		$query=$this->db->select('name')
		                ->from('youg_broker')
		                ->where('id',$affid)
		                ->get();
		
			return $query->row_array();

	}

	function jamcodeupdate($companyid,$jamcode)
	{
		$query = $this->db->where('company_id',$companyid)->update('youg_subscription',array('jamcode'=>$jamcode));
		return true;
	}
}
?>
