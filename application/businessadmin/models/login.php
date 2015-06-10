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
			/* User Log */
			$querylog = $this->db->get_where('userlog',  array( 'user_id' => $id,'useremail'=>$username));
			if ($querylog->num_rows() > 0)
			{
				$logresult = $querylog->result_array();
				$logcount = $logresult[0]['logcount'];
				$lastseen = $logresult[0]['lastseen'];
				$data = array(
								'lastseen' => date('Y-m-d H:i:s'),
								'logcount' => $logcount + 1
							);
						
						$this->db->where('user_id', $id);
						$this->db->update('userlog', $data); 
						$logcounts=$logcount+1;
						
			}else
			{
				$data = array(
							'user_id' => $id,
							'useremail' => $username ,
							'lastseen' => date('Y-m-d H:i:s'),
							'logcount' => '0'
							);

						$this->db->insert('userlog', $data); 
						$logcounts='0';
						$lastseen=date('Y-m-d H:i:s');
				
			}
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
