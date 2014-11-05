<?php
Class oos extends CI_Model
{
	function get_all_gallerys($id,$siteid)
 	{
		$this->db->where('companyid', $id);
		$this->db->where('websiteid', $siteid);
		//Executing Query
		$query = $this->db->get('gallery');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Inserting Record
	function insert($companyid,$title,$siteid)
	{
		$data = array(		'companyid' 	=> $companyid,
							'title' 		=> $title,
							'status' 		=> 'Enable',
							'websiteid'		=> $siteid
											);

		if( $this->db->insert('gallery', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_gallery_byid($id)
 	{
		$query = $this->db->get_where('gallery', array('id' => $id));
		
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
	function get_photo_byid($id)
 	{
		$query = $this->db->get_where('photos', array('id' => $id));
		
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
	function update($id,$title)
 	{
		$data = array(
							'title' 		=> $title,
					 );
		$this->db->where('id', $id);
		if( $this->db->update('gallery', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	//Changing Status to "Disable"
	function disable_gallery_byid($id)
	{
		$data = array(
						'status'		=> 'Disable',
		
		
					);
		$this->db->where('id', $id);
		if( $this->db->update('gallery', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_gallery_byid($id)
	{
		$data = array(
							'status'	=> 'Enable',
					);
		$this->db->where('id', $id);
		if( $this->db->update('gallery', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_gallery_byid($id)
	{
		if( $this->db->delete('gallery', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Inserting Record
	function insertphoto($galleryid,$photo)
	{
		$data = array(		'galleryid' 	=> $galleryid,
							'photo' 		=> $photo,
											);

		if( $this->db->insert('photos', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	
	//Getting value for editing
	function get_photo_bygalleryid($id)
 	{
		$query = $this->db->get_where('photos', array('galleryid' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
		
	//Function for Deleting Record
	function delete_photo_byid($id)
	{
		if( $this->db->delete('photos', array('id' => $id)) )
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