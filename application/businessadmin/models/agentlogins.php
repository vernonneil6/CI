<?php
Class Agentlogins extends CI_Model
{
	function logincheck($username,$password)
 	{
   	   	return $this->db->get_where('youg_broker',  array( 'name' => $username,'password'=>$password,'type'=>'agent' ))->result();
	}
}
?>
