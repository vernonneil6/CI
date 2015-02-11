<?php
Class Settings extends CI_Model
{
	//Function for getting all Settings
	function get_all_setting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'title' : $sortby = 'fieldname';break;
			case 'value' : $sortby = 'value';break;
			default : $sortby = 'id';break;
		}
		
		//Ordering Data
		
		$this->db->order_by($sortby,$orderby);
		$this->db->where('websiteid',$siteid);
		//Executing Query
		$query = $this->db->get('setting');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting setting field name By id
	function get_setting_fieldname($id)
 	{
		$query = $this->db->get_where('setting', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			return stripslashes($result[0]['fieldname']);
		}
		else
		{
			return false;
		}
 	}
	
	//Getting setting value for editing By id
	function get_setting_value($id)
 	{
		if($this->session->userdata('youg_admin'))
		{
			$siteid = $this->session->userdata('siteid');
		}
		else
		{
			$url = 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  			$pieces = parse_url($url);
			$domain = isset($pieces['host']) ? $pieces['host'] : '';
			
			if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs))
			 {
			    $site = $regs['domain'];
			 }
		 
		 		$query11 = $this->db->get_where('url', array('url' => $site));
		
				if ($query11->num_rows() > 0)
				{
					$result = $query11->result_array();
					$siteid = $result[0]['id'];
				}
				else
				{
					$siteid = 1;	
				}
		
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
	
	//Getting setting value for editing By id
	function get_setting_byid($id,$siteid)
 	{
		$query = $this->db->get_where('setting', array('intid' => $id,'websiteid' => $siteid));
		
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
	function update($id,$value)
 	{
		$data = array( 'value' => $value );
		
		$this->db->where('intid', $id);
		if( $this->db->update('setting', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function get_all_elitemembers($limit ='',$offset='',$sortby = 'payment_date',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
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
	
	//Getting value for searching
	function search_setting($keyword,$siteid,$sortby = 'fieldname',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	$this->db->select('*');
	  	$this->db->from('setting');
		$this->db->where('websiteid',$siteid);
	  	$this->db->like(array('value'=> $keyword ) );

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
	
	function get_all_subscriptions($limit ='',$offset='',$sortby = 'payment_date',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('subscription');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_all_elitemembersforreport()
 	{
		$query = $this->db->query("SELECT  e.*, s.*,c.*,e.payment_date as joindate,e.status as elitestatus FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_urls()
 	{
		$query = $this->db->get('url');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function get_elite_status_of_companyid($company_id)
 	{
		$this->db->select('company_id');
		$this->db->from('elite');
		$this->db->where('company_id',$company_id);
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
	function broker_view($ids)
	{
		return  $this->db->get_where('youg_broker',array('subbrokerid'=>$ids))->result();
	}
		//Changing Status to "Disable"
	function disable_tutorial_byid($id)
	{
		$data = array(
						'status'		=> 'Disable',
		
		
					);
		$this->db->where('id', $id);
		if($this->db->update('tutorial', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_tutorial_byid($id)
	{
		$data = array(
							'status'	=> 'Enable',
					);
		$this->db->where('id', $id);
		if( $this->db->update('tutorial', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function update_get_eliteprice_by_settingid($id)
	{
		$siteid = $this->session->userdata('siteid');
		
	  	$this->db->select('*');
	  	$this->db->from('setting');
		$this->db->where('websiteid',$siteid);
		$this->db->where('intid',$id);
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
	
}
?>

