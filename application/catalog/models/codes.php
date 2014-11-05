<?php class Codes extends CI_Model
{
	//Inserting Record
	function insert($userid,$accounttype,$accountaddress,$privatekey)
	{
		$createddate = date('Y-m-d H:i:s');
		$createdip 	 = $_SERVER['REMOTE_ADDR'];
		$data 		 = array(
							'userid' 	    => $userid,
							'accounttype' 	=> $accounttype,
							'accountaddress'=> $accountaddress,
							'createddate'	=> $createddate,
							'createdip'		=> $createdip,
							'privatekey'	=> $privatekey
							
							);

		if( $this->db->insert('user_crypto_account', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	//get old code to check
	function get_old_code($userid,$accounttype,$privatekey)
 	{
		$query = $this->db->get_where('user_crypto_account', array('userid' => $userid,'accounttype' => $accounttype));
		
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