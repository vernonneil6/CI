<?php
Class Login extends CI_Model
{
	function logincheck($username,$password)
 	{
   	   	$query = $this->db->get_where('company',  array( 'email' => $username,'password'=>$password));
	    
		
		if ($query->num_rows() > 0)
		{	
			$company = $query->result_array();
			$id = $company[0]['id'];
			$query1 = $this->db->get_where('elite',  array( 'company_id' => $id,'status'=>'Enable'));
			
			if ($query1->num_rows() > 0)
			{
				$result = array( 'id' => $id,'username' => $username,'companyname'=>$company[0]['compnay']);
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