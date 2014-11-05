<?php
Class Badges extends CI_Model
{

	function badgedetail()
	{
		return $this->db->get_where('youg_badge',array('toid'=>$this->session->userdata['youg_admin']['id']))->result();
	}
	
}
?>