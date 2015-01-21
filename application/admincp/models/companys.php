<?php
Class Companys extends CI_Model
{
	function get_all_companys($limit ='',$offset='',$sortby = 'registerdate',$orderby = 'DESC')
 	{
		switch($sortby)
		{
			case 'company' 	: $sortby = 'company';break;
			case 'email' 	: $sortby = 'email';break;
			default 		: $sortby = 'company';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('company');
		
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
	function insert($company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$paypalid,$logo,$phone,$companyseokeyword,$about,$category,$price_range,$accept_credit_cards,$accept_paypal)
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
							'paypalid'			=> $paypalid,
							'logo' 				=> $logo,
							'phone'				=> $phone,
							'companyseokeyword' => $companyseokeyword,
							'aboutus'			=> $about,
							'categoryid'		=> $category,
							'status' 			=> 'Enable',
							'registerip' 		=> $varipaddress,
							'registerdate'		=> $date,
							'price_range'		=> $price_range,
							'accept_credit_cards'=> $accept_credit_cards,
							'accept_paypal'		=> $accept_paypal
							
						);

		if( $this->db->insert('company', $data) )
		{
			return true;
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
	
	//Updating Record
	function update($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$paypalid,$logo,$phone,$companyseokeyword,$about,$category,$price_range,$accept_credit_cards,$accept_paypal)
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
							'companyseokeyword'=>$companyseokeyword,
							'aboutus'			=> $about,
							'categoryid'		=> $category,
							'status' 			=> 'Enable',
							'editip' 			=> $varipaddress,
							'editdate'		=> $date,
							'price_range'		=> $price_range,
							'accept_credit_cards'=> $accept_credit_cards,
							'accept_paypal'		=> $accept_paypal
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
	
	function update_noimage($id,$company,$streetaddress,$city,$state,$country,$zip,$email,$siteurl,$phone,$companyseokeyword,$about,$category,$price_range,$accept_credit_cards,$accept_paypal)
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
							'companyseokeyword'	=> $companyseokeyword,
							'aboutus'			=> $about,
							'categoryid'		=> $category,
							'status' 			=> 'Enable',
							'editip' 			=> $varipaddress,
							'editdate'			=> $date,
							'price_range'		=> $price_range,
							'accept_credit_cards'=> $accept_credit_cards,
							'accept_paypal'		=> $accept_paypal
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
	
	//Changing Status to "Disable"
	function disable_company_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'	=> 'Disable',
						'editip' 	=> $vareditip,
						'editdate'	=> $date_edit
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
	
	//Changing Status to "Enable"
	function enable_company_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'	=> 'Enable',
							'editip' 	=> $vareditip,
							'editdate'	=> $date_edit
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
	
	//Function for Deleting Record
	function delete_company_byid($id)
	{
		if( $this->db->delete('company', array('id' => $id)) )
		{
			$this->db->delete('complaints', array('companyid' => $id));
			$this->db->delete('elite', array('company_id' => $id));
			$this->db->delete('reviews', array('companyid' => $id));
			$this->db->delete('companyreviews', array('companyid' => $id));
			$this->db->delete('companysem', array('companyid' => $id));
			$this->db->delete('companyseo', array('companyid' => $id));
			$this->db->delete('coupon', array('companyid' => $id));
			$this->db->delete('gallery', array('companyid' => $id));
			$this->db->delete('pressrelease', array('companyid' => $id));
			$this->db->delete('relation', array('companyid' => $id));
			$this->db->delete('reviewstatus', array('companyid' => $id));
			$this->db->delete('subscription', array('company_id' => $id));
			$this->db->delete('video', array('companyid' => $id));
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
	
	//Getting value for searching
	function search_company($keyword,$limit ='',$offset='',$sortby = 'company',$orderby = 'ASC')
 	{
	  //echo $keyword;
	  $keyword = str_replace('-',' ', $keyword);
	  $this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
	  $this->db->select('*');
	  $this->db->from('company');
	  $this->db->or_like(array('company'=> $keyword , 'streetaddress'=> $keyword , 'email'=> $keyword , 'siteurl'=> $keyword , 'aboutus' => $keyword ) );

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
	
	//Inserting Record
	function insertcsv($company,$siteurl,$cat,$streetaddress,$contact,$phone,$custm,$hushours,$fax) 
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company' 			=> $company,
							'streetaddress' 	=> $streetaddress,
							'status' 			=> 'Enable',
							'registerip' 		=> $varipaddress,
							'registerdate'		=> $date,
							'siteurl'			=> $siteurl,
							'categoryid'		=> $cat,
							'phone'				=> $phone,
							'customersupport'	=> $custm,
							'businesshours'		=> $hushours,
							'fax'				=> $fax,
							'price_range'		=> 0,
							'accept_credit_cards'=>'No',
							'accept_paypal'		=>'No'
							
							
						);

		if( $this->db->insert('company', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Inserting Record
	public function insert1($company,$siteurl,$streetaddress,$email,$phone,$custsupport,$bushm,$fax,$companyseokeyword)
	
	{
		$word = str_replace(' ','',$$companyseokeyword);
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company' 			=> $company,
							'streetaddress' 	=> $streetaddress,
							'email' 			=> $email,
							'siteurl' 			=> $siteurl,
							'phone'				=> $phone,
							'companyseokeyword' => $word,
							'categoryid'		=> 1,
							'status' 			=> 'Enable',
							'registerip' 		=> $varipaddress,
							'registerdate'		=> $date,
							'customersupport'	=> $custsupport,
							'businesshours'		=> $bushm,
							'fax'				=> $fax,
							'price_range'		=> 0,
							'accept_credit_cards'=>'No',
							'accept_paypal'		=>'No'
						);

		if( $this->db->insert('company', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/*code added by oldteam $company,$email,$contactname,$streetaddress,$city,$state,$zip,$country,$phone,$fax,$siteurl,$aboutus,$companyseokeyword */
	public function insert2($company,$email,$streetaddress,$city,$state,$zip,$country,$phone,$siteurl,$aboutus,$companyseokeyword)
	
	{
		$word = str_replace(' ','',$companyseokeyword);
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'company' 		=> $company,
							'email' 		=> $email,
							'companystreet' => $streetaddress,
							'companycity'	=> $city,
							'companystate' 	=> $state,
							'companyzip'	=> $zip,
							'companycountry'=> 'country',
							'phone' 		=> $phone,
							'registerdate'	=> $date,
							'siteurl'		=> $siteurl,
							'aboutus'		=> $aboutus,
							'companyseokeyword'=> $companyseokeyword,
							'status'		=> 'Enable',
							'categoryid'	=> '1',
							'price_range'		=> 0,
							'accept_credit_cards'=>'No',
							'accept_paypal'		=>'No'
						);

		if( $this->db->insert('company', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function get_all_companys_count()
	{
		$query = $this->db->count_all('company');
		return $query;
	}

	//Getting value for searching
	function search_company_count($keyword)
 	{
	  //echo $keyword;
	  $keyword = str_replace('-',' ', $keyword);
	  $this->db->or_like(array('company'=> $keyword , 'streetaddress'=> $keyword , 'email'=> $keyword , 'siteurl'=> $keyword , 'aboutus' => $keyword ) );
	  $query = $this->db->count_all('company');
	  return $query;
 	}

}
?>
