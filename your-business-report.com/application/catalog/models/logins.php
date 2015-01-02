<?php
Class Logins extends CI_Model
{
	function logincheck($email, $password)
 	{
		$query = $this->db->get_where('user',  array( 'email' => $email,'password'=>$password));
		if ($query->num_rows() > 0)
		{	
			$user = $query->result_array();	
			if( $user[0]['status']=="Enable" )
			 {
			//echo '<pre>';print_r($user); die();
			$result = array(
						'userid' => $user[0]['id'],
						'name' => ucfirst($user[0]['firstname']).' '.ucfirst($user[0]['lastname']),
						'emailid' => $user[0]['email'],
						//'password' => $user[0]['password']
			);	
			return $result; 
			 }
			 else
			{
				return "noallow";
			}
		}
		else
		{
			$result = 'notfound';
			return $result;
		}

	}
	
	function set_user_password($emailid,$varpassword)
	{	
	    $date_edit = date('Y-m-d');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
				'password'   => $varpassword,
				'editdate' 	=> $date_edit,
				'editip' 	=> $vareditip
			);

		$this->db->where( array('email'=>$emailid) );
		
		if( $this->db->update('user', $data) )
		{
			return "updated";
		}
		else
		{
			return "false";
		}

	}
	
	
	function get_user_byemail($email)
 	{	
		$query = $this->db->get_where('user',  array( 'email' => $email));
	
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