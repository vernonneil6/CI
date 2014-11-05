<?php 

class Sliders extends CI_Model
{
	function homepageslider()
	{
		return $this->db->get('youg_slider')->result();
	}
}
?>