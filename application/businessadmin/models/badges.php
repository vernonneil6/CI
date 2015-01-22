<?php
Class Badges extends CI_Model
{

	function companydetail()
	{
		$query = $this->db->get_where('youg_company',array('id'=>$this->session->userdata['youg_admin']['id']));
		
		if($query->num_rows > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	
}
?>
