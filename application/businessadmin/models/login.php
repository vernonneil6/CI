<?php
Class Login extends CI_Model
{
	function logincheck($username,$password)
 	{
   	   	$query = $this->db->get_where('company',  array( 'contactemail' => $username,'password'=>$password));
	    
		
		if ($query->num_rows() > 0)
		{	
			$company = $query->result_array();
			$id = $company[0]['id'];
			$this->db->select('*');
			$this->db->where("(company_id = '$id' AND status = 'Enable' OR company_id = '$id' AND status = 'Disable' AND cancel_flag = '1')");
			$query1 = $this->db->get('elite');
						
			if ($query1->num_rows() > 0)
			{
				$result = array( 'id' => $id,'username' => $username,'companyname'=>$company[0]['company']);
				return $result;
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return false;
		}
 	}
	
	function get_eliteuser($username)
 	{
   	   	$query = $this->db->get_where('company',  array( 'contactemail' => $username));
	    
		
		if ($query->num_rows() > 0)
		{	
			$company = $query->result_array();
			$id = $company[0]['id'];
			$this->db->select('*');
			$this->db->where("(company_id = '$id' AND status = 'Enable' OR company_id = '$id' AND status = 'Disable' AND cancel_flag = '1')");
			$query1 = $this->db->get('elite');
			
			if ($query1->num_rows() > 0)
			{
				$result = array( 'company'=>$company[0]['company'],'id' => $id,'username' => $company[0]['contactemail'],'password'=>$company[0]['password']);
				return $result;
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return false;
		}
 	}
 	function disablelogincheck($username,$password)
 	{
   	   	$query = $this->db->get_where('company',  array( 'contactemail' => $username,'password'=>$password));
	    
		
		if ($query->num_rows() > 0)
		{	
			$company = $query->result_array();
			$id = $company[0]['id'];
			$query1 = $this->db->get_where('elite',  array( 'company_id' => $id,'status'=>'Disable','cancel_flag' => '2'));
			
			if ($query1->num_rows() > 0)
			{
				$result = array( 'id' => $id,'username' => $username,'companyname'=>$company[0]['company']);
				return $result;
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return false;
		}
 	}
	
	
	
}
?>
