<?php
Class Urls extends CI_Model
{
	function get_all_urls()
 	{
		$query = $this->db->get('url');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting value for editing
	function get_url_byid($id)
 	{
		$query = $this->db->get_where('url', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Updating Record
	function update($id,$title,$url,$siteurl)
 	{
		$data = array(		'title' 		=> $title,
							'url' 			=> $url,
							'siteurl' 		=> $siteurl
					 );
							
		$this->db->where('id', $id);
		if( $this->db->update('url', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
}
?>