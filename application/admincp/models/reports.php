<?php
class Reports extends CI_Model
{
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

	function get_all_enabledmembers()
 	{
		$query = $this->db->query("SELECT c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Enable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_disabledmembers()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_elitemembers()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id ");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_enabledmemberswithcode()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Enable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_disabledmemberswithcode()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function get_all_callcenter_elite()
 	{
		$query = $this->db->query("SELECT c.email,c.company,CONCAT(c.streetaddress,c.city,c.state,c.country,c.zip),e.transactionid,c.id as id,e.status,c.editdate FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_removed_reviews()
 	{
		$query = $this->db->query("SELECT u.username,u.email,CONCAT(u.firstname,u.lastname),CONCAT(u.street,u.city,u.state,u.zipcode),r.reviewdate,r.reviewremoveddate,c.company,CONCAT(c.streetaddress,c.city,c.state,c.country,c.zip) FROM youg_reviews r JOIN youg_company c ON c.id = r.companyid JOIN youg_user u ON r.reviewby = u.id where r.status='Disable' AND r.type='ygr'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_removed_complaints()
 	{
		$query = $this->db->query("SELECT u.username,u.email,CONCAT(u.firstname,u.lastname),CONCAT(u.street,u.city,u.state,u.zipcode),com.whendate,com.transaction_date,c.company,CONCAT(c.streetaddress,c.city,c.state,c.country,c.zip) FROM youg_complaints com JOIN youg_company c ON c.id = com.companyid JOIN youg_user u ON com.userid = u.id where com.status='Disable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	/*function search_insert($keyword,$searchtype,$searchdate)
	{
	  
	  $data = array(
			   'keyword' => $keyword,
			   'searchby' => $searchtype,
			   'searchdate' => $searchdate
			);
	  $this->db->insert('youg_reportsearch', $data); 	
		
		
		
	}*/
	function search_data($keyword)
	{
	     	
	  $this->db->select('*');
	  $this->db->like('company', $keyword);
	  $this->db->or_like('contactname',$keyword);

	  $query = $this->db->get('youg_company');
	  
	  
	  if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	function brokersearch($keyword){
		
		$this->db->select('*');
		$this->db->like('subbroker', $keyword);		

		$query = $this->db->get('youg_broker');

		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	
	//Getting value for searching
	function brokersearch_count($keyword)
 	{
	  //echo $keyword;
	  $keyword = str_replace('-',' ', $keyword);
	  $this->db->like('subbroker',$keyword);
	  $this->db->from('youg_broker');
	  $query = $this->db->count_all_results();
	  return $query;
 	}
			
	
		
	
}
?>
