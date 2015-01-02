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
}
?>