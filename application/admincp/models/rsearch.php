<?php
Class Rsearch extends CI_Model
{
	
	function get_search() {
	  $match = $this->input->post('search');
	  $this->db->like('name',$match);
	 /* $this->db->or_like('author',$match);
	  $this->db->or_like('characters',$match);
	  $this->db->or_like('synopsis',$match);*/
	  $query = $this->db->get('broker');
	  return $query->result();
	}	
}
?>
