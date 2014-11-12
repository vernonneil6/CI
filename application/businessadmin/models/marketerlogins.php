<?php
Class Marketerlogins extends CI_Model
{
	function logincheck($username,$password)
 	{
   	   	return $this->db->get_where('youg_broker',  array( 'name' => $username,'password'=>$password,'type'=>'marketer'))->result();
	}
}
?>
