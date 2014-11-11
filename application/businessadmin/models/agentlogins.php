<?php
Class Agentlogins extends CI_Model
{
	function logincheck($username,$password)
 	{
   	   	return $this->db->get_where('youg_agent',  array( 'name' => $username,'password'=>$password ))->result();
	}
}
?>
