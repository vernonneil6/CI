<?php
Class Marketerlogins extends CI_Model
{
	function logincheck($username,$password)
 	{
   	   	return $this->db->get_where('youg_marketer',  array( 'name' => $username,'password'=>$password))->result();
	}
}
?>
