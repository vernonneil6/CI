<?php
Class Pages extends CI_Model
{
	function get_all_pages($siteid,$sortby = 'id',$orderby = 'ASC')
 	{

		$this->db->order_by($sortby,$orderby);
		$this->db->order_by('position', 'asc');
		$this->db->where('websiteid', $siteid);
		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting Page value for editing
	function get_page_byid($id)
 	{
		$query = $this->db->get_where('pages', array('intid' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	//Getting Page value for editing
	function get_page_bycategory($category, $position)
 	{
		$query = $this->db->get_where('pages', array('id' => $category, 'position'=> $position));
		
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
	function update($id,$title,$heading,$varmetakey,$varmetades,$varpagecont,$footercategory,$footerposition)
 	{
		$editdate = date('Y-m-d');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'title' 			=> $title,
							'heading' 			=> $heading,
							'metakeywords'		=> $varmetakey,
							'metadescription'	=> $varmetades,
							'pagecontent' 	 	=> $varpagecont,
							'editdate' 			=> $editdate,
							'deviceip' 			=> $vareditip,
							'id' 				=> $footercategory,
							'position' 			=> $footerposition
						);

		$this->db->where('intid', $id);
		if( $this->db->update('pages', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Changing Status to "Disable"
	function disable_page_byid($id)
	{
		$editdate = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'		=> 'Disable',
						'deviceip' 	=> $vareditip,
						'editdate'	=> $editdate
					);
		$this->db->where('intid', $id);
		if( $this->db->update('pages', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_page_byid($id)
	{
		$editdate = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'		=> 'Enable',
							'deviceip' 	=> $vareditip,
							'editdate'	=> $editdate
						);
		$this->db->where('intid', $id);
		if( $this->db->update('pages', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//Getting value for searching
	function search_page($keyword,$siteid,$sortby = 'id',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	$this->db->select('*');
	  	$this->db->from('pages');
	  	$this->db->where('websiteid',$siteid);
		$this->db->where('(title LIKE \'%'.$keyword.'%\' OR heading LIKE \'%'.$keyword.'%\' OR metakeywords LIKE \'%'.$keyword.'%\' OR metadescription LIKE \'%'.$keyword.'%\' OR pagecontent LIKE \'%'.$keyword.'%\')', NULL, FALSE);
	  	$query = $this->db->get();
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	function pageadd($data)
 	{
		if($this->db->insert('youg_pages', $data))
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
