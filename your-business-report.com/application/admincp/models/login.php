<?php
Class Login extends CI_Model
{
	function logincheck($username,$password)
 	{
   	    $admin_username = $this->settings->get_setting_value(7);
		$admin_pass = $this->settings->get_setting_value(8);
		
		if( $admin_username == $username && $admin_pass == $password )
		{
			$result = array(
								'id' => 0,
								'username' => $username,
								'type'=> 'admin'
							);
			return $result;
		}
		else
		{
			return false;
		}
 	}
	
}
?>