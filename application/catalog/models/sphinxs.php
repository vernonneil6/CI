<?php 

class Sphinxs extends CI_Model
{
	function search()
	{
		return $this->db->get('youg_slider')->result();
	}
}
?>