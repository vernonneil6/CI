<?php
Class Companys extends CI_Model
{
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
	
	//Updating Record
	function update($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$paypalid,$logo,$phone,$about,$category,$creditcard1,$creditcard2,$price_range,$accept_credit_cards,$accept_paypal)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company' 			=> $company,
							'streetaddress' 	=> $streetaddress,
							'city' 				=> $city,
							'state' 			=> $state,
							'country' 			=> $country,
							'zip' 				=> $zip,
							'email'				=> $email,
							'siteurl' 			=> $siteurl,
							'paypalid'			=> $paypalid,
							'logo' 				=> $logo,
							'phone'				=> $phone,
							'aboutus'			=> $about,
							'categoryid'		=> $category,
							'status' 			=> 'Enable',
							'editip' 			=> $varipaddress,
							'editdate'			=> $date,
							'creditcard1'		=> $creditcard1,
							'creditcard2'		=> $creditcard2,
							'price_range'		=> $price_range,
							'accept_credit_cards'=>$accept_credit_cards,
							'accept_paypal'		=>$accept_paypal
							
						);
		$this->db->where('id', $id);
		if( $this->db->update('company', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function update_noimage($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$phone,$about,$category,$creditcard1,$creditcard2,$price_range,$accept_credit_cards,$accept_paypal)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company' 			=> $company,
							'streetaddress' 	=> $streetaddress,
							'city' 				=> $city,
							'state' 			=> $state,
							'country' 			=> $country,
							'zip' 				=> $zip,
							'email' 			=> $email,
							'siteurl' 			=> $siteurl,
							'phone'				=> $phone,
							'aboutus'			=> $about,
							'categoryid'		=> $category,
							'status' 			=> 'Enable',
							'editip' 			=> $varipaddress,
							'editdate'			=> $date,
							'creditcard1'		=> $creditcard1,
							'creditcard2'		=> $creditcard2,
							'price_range'		=> $price_range,
							'accept_credit_cards'=>$accept_credit_cards,
							'accept_paypal'		=>$accept_paypal
					);
		$this->db->where('id', $id);
		if( $this->db->update('company', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Querying to Check E-mail or company name is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'email' 		: $varfield = 'email';break;
			case 'company'		: $varfield = 'company';break;
			case 'companyseokeyword'	: $varfield = 'companyseokeyword';break;
			 	
		}
		if($id != 0)
		{
			$option = array('id !=' => $id,$varfield => $fieldvalue);
		}
		else
		{
			$option = array($varfield => $fieldvalue);
		}
		$query = $this->db->get_where('company', $option);
		
		//echo $this->db->last_query();
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
		}

 	}
	
	//Updating Password
	function update_password($id,$newpassword)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'password'	=> $newpassword,
						'editip' 	=> $varipaddress,
						'editdate'	=> $date
					);

		$this->db->where('id', $id);
		if( $this->db->update('company', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function get_all_categorys($siteid,$sortby = 'category',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'category' : $sortby = 'category';break;
			default 	    : $sortby = 'category';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		if($siteid!='all')
		{
			$query = $this->db->get_where('category',array('websiteid'=>$siteid));
		}
		else
		{
			$this->db->group_by('category');
			$query = $this->db->get_where('category');
		}
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
	function get_category_byid($id)
 	{
		$query = $this->db->get_where('category', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function country_name($countryid)
 	{
		
		$query = $this->db->get_where('youg_country', array('country_id'=>$countryid));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	
}
?>
