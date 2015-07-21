<?php
Class Homebannertexts extends CI_Model
{
	
	function get_allbannertext()
	{
		return $this->db->get('youg_bannertext')->result();
	}
	
	function addtext($position,$text)
	{
		$data = array(	
						'position' => $position,
						'text' 	=> $text		
					     );

		if( $this->db->insert('youg_bannertext', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	function updatetext($id,$position,$text)
	{
			$data = array(	
						'position' => $position,
						'text' 	=> $text		
					     );

			$this->db->where('id',$id)->update('youg_bannertext',$data);
	}
	function deletetext($id)
	{
		if($this->db->delete('youg_bannertext',array('id'=>$id)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	function updatefield($id)
	{
		   return $this->db->get_where('youg_bannertext',array('id'=>$id))->row_array();
	}
	
	//Changing Status to "Disable"
	function disable_homebannertexts_byid($id)
	{
		
		$data = array('status'	=> '0');
		$this->db->where('id', $id);
		if( $this->db->update('youg_bannertext', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_homebannertexts_byid($id)
	{
		$data = array('status'	=> '1');
		$this->db->where('id', $id);
		if( $this->db->update('youg_bannertext', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_homebannertexts_byid($id)
 	{
		$query = $this->db->get_where('youg_bannertext', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
}
?>
