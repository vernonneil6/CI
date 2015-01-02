<?php
Class Seos extends CI_Model
{
	function get_all_seosetting($id,$siteid)
 	{
		if($siteid!='all')
		{
			//Executing Query
			$this->db->where('websiteid',$siteid);
			$this->db->where('companyid', $id);
			$query = $this->db->get('companyseo');
			
			if( $query->num_rows() > 0 )
			{
				return $query->result_array();
			}
			else
			{
				return array();
			}
		}
		else
		{
			$this->db->limit(1);
			$this->db->where('companyid', $id);
			$this->db->where('fieldname', 'Google Analytic');
			$query1 = $this->db->get('companyseo');
			$a = $query1->result_array();
			
			$this->db->limit(1);
			$this->db->where('companyid', $id);
			$this->db->where('fieldname', 'Google Webmaster');
			$query1 = $this->db->get('companyseo');
			$b = $query1->result_array();
			
			$this->db->limit(1);
			$this->db->where('companyid', $id);
			$this->db->where('fieldname', 'General Meta Tag Keywords');
			$query1 = $this->db->get('companyseo');
			$c = $query1->result_array();
			
			$this->db->limit(1);
			$this->db->where('companyid', $id);
			$this->db->where('fieldname', 'General Meta Tag Description');
			$query1 = $this->db->get('companyseo');
			$d = $query1->result_array();
			
			if(count($a)>0 || count($b)>0 || count($c)>0 || count($d)>0)
			{
				return array_merge($a,$b,$c,$d);
			}
			else
			{
				return array();
			}
			
		}
 	}
	
	//Getting setting value for editing By id
	function get_seosetting_value($id)
 	{
		$query = $this->db->get_where('companyseo', array('id' => $id));
		
		if( $query->num_rows() > 0 )
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
	function get_seosetting_byid($id)
 	{
		$query = $this->db->get_where('companyseo', array('id' => $id));
		
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Updating Record
	function update($id,$value,$fieldname)
 	{
		$siteid = $this->session->userdata['siteid'];
		if($siteid!='all')
		{
			$data = array( 'value' => $value );
			
			$this->db->where('id', $id);
			if( $this->db->update('companyseo', $data) )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			$data = array( 'value' => $value );
			$companyid=$this->session->userdata['youg_admin']['id'];
			$this->db->where('companyid', $companyid);
			$this->db->where('fieldname', $fieldname);
			if( $this->db->update('companyseo', $data) )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		}
	
}
?>