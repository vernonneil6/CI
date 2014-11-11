<?php
Class Subbrokerlogins extends CI_Model
{
	function logincheck($username,$password)
 	{
   	   	return $this->db->get_where('youg_subbroker',  array( 'name' => $username,'password'=>$password ))->result();
	 }
}
?>
