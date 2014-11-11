<?php

class Agents extends CI_Model
{

function get_companynames($name)
{
	    $this->db->select('company');
	    $this->db->like('company', $name);
	    $query = $this->db->get('youg_company');
	    if($query->num_rows > 0){
	      foreach ($query->result_array() as $row){
	        $row_set[] = htmlentities(stripslashes($row['company']));
	      }
	      echo json_encode($row_set); 
	    }
}

}
?>
