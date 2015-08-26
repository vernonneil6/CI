<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Searchs extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
	
    }

    public function get_autocompletes($name,$city)
    {
		$this->db->distinct();
        $this->db->select('id')->from('company');
        $this->db->where('status','Enable');
        //$this->db->like('city', $city);
        $this->db->like('company', $name);
       
		$query = $this->db->get();
        if ($query->num_rows() > 0)
		{
			 return $query->result();
				
		}
		
				
			
		
		
	}
    
    
}

?>
