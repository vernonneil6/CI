<?php 

class Sliders extends CI_Model
{
	function homepageslider()
	{
		return $this->db->get('youg_slider')->result();
	}
	function homebannertext()
	{
		return $this->db->get_where('youg_bannertext',array('status'=>'1'))->result();
	}
}
?>
