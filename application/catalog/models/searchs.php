<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Searchs extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
	
    }

    public function get_autocomplete($search_data)
    {
		$siteid = $this->session->userdata('siteid');
        $this->db->select('category')->from('category');
        $where='websiteid="1" AND status="Enable"';
       $this->db->where('status','Enable');
		$this->db->where_in('websiteid',1);
      
        $this->db->like('category', $search_data);
		$query = $this->db->get();
        if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		
    }
}

?>
