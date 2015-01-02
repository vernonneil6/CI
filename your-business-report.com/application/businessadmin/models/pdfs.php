<?php
Class pdfs extends CI_Model
{
	function get_all_pdfs($id,$siteid)
 	{
		if($siteid!='all')
		{
			$this->db->where('companyid', $id);
			$this->db->where('websiteid', $siteid);
		}
		else
		{
			$this->db->where('companyid', $id);
		}
		//Executing Query
		$query = $this->db->get('pdf');
		
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
	function insert($companyid,$title,$pdf,$siteid)
	{
		if($siteid!='all')
		{
			$data = array(		'companyid' 	=> $companyid,
								'title'			=>	$title,
								'pdf'			=> $pdf,
								'status' 		=> 'Enable',
								'websiteid'		=> $siteid
											);
		
			if( $this->db->insert('pdf', $data) )
			{
					return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			for($i=1;$i<17;$i++)
			{
				$data = array(		'companyid' 	=> $companyid,
									'title'			=>	$title,
									'pdf'			=> $pdf,
									'status' 		=> 'Enable',
									'websiteid'		=> $i
											);
		
			$this->db->insert('pdf', $data);
			return true;
			}
		}
	}
	
	//Getting value for editing
	function get_pdf_byid($id)
 	{
		$query = $this->db->get_where('pdf', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Changing Status to "Disable"
	function disable_pdf_byid($id)
	{
		$data = array(
						'status'		=> 'Disable',
		
		
					);
		$this->db->where('id', $id);
		if( $this->db->update('pdf', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_pdf_byid($id)
	{
		$data = array(
							'status'	=> 'Enable',
					);
		$this->db->where('id', $id);
		if( $this->db->update('pdf', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_pdf_byid($id)
	{
		if( $this->db->delete('pdf', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//Updating Record
	function update($id,$title,$pdf)
 	{
		$data = array(		'title' 			=> $title,
							'pdf' 				=> $pdf
					);
		$this->db->where('id', $id);
		if( $this->db->update('pdf', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function update_nopdf($id,$title)
 	{
		$data = array(
							'title' 			=> $title,
					);
		$this->db->where('id', $id);
		if( $this->db->update('pdf', $data) )
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