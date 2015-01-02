<?php
Class Settings extends CI_Model
{
	//Getting setting value for editing By id
	function get_setting_value($id)
 	{
		$siteid = $this->session->userdata('siteid');
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

	
	function get_elitecompany_byid($id)
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
	
	function cancel_elitemembership_bycompnayid($id,$companyid)
 	{
		$data = array('status' =>'Disable' );
		
		$this->db->where('id', $id);
		$this->db->where('company_id', $companyid);
		if ($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function get_all_unclickedreviewstatus()
 	{
		$query = $this->db->get_where('reviewstatus', array('status' => 'sent','click'=>'No'));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function update_reviewstatus($id)
 	{
		$data = array('click' =>'Yes' );
		
		$this->db->where('id', $id);
		if ($this->db->update('reviewstatus',$data))
		{
			return true;
		}
		else
		{
			return false;
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
	function get_url_by_id($id)
 	{
		$query = $this->db->get_where('url',array('id'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	//insert wining amount as per calculation
	function insert_test_user($name)
 	{
		$data = array('name' => $name);
		
		if( $this->db->insert('test', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		}
	
	
	function get_all_Subscribtionofcompany()
	{
		$date = date("Y-m-d H:i:s");
		$query = $this->db->where('expires <', $date);
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function disable_elitemember($id)
	{
		$data = array('status' =>'Disable' );
		
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
	
	function get_subscribtion_bycompanyid($id)
	{
		$query = $this->db->get_where('subscription',array('company_id'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	
	}
	
	function cancel_elitemembership_bycompnayid1($companyid)
 	{
		$data = array('status' =>'Disable' );
		
		$this->db->where('company_id', $companyid);
		if ($this->db->update('elite',$data))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	}

	
	
?>