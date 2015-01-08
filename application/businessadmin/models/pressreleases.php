<?php
Class Pressreleases extends CI_Model
{
	function get_all_pressreleases($id,$siteid,$limit ='',$offset='')
 	{
		
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		if($siteid!='all')
		{
			$this->db->where('websiteid', $siteid);
			$this->db->where('companyid', $id);
		}
		else
		{
			$this->db->where('companyid', $id);
		}
		//Executing Query
		$query = $this->db->get('pressrelease');
		
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
	function insert($companyid,$title,$subtitle,$sortdesc,$metakeywords,$metadescription,$presscontent,$siteid)
	{
		$seokeyword = strtolower($title);
		$seokeyword = str_replace(' ','-',$seokeyword);
		$date = date("Y-m-d H:i:s");

		if($siteid!='all')
		{
			$data = array(		
							'companyid' 		=> $companyid,
							'title' 			=> $title,
							'subtitle' 			=> $subtitle,
							'sortdesc'			=> $sortdesc,
							'metakeywords'		=> $metakeywords,
							'metadescription'	=> $metadescription,
							'presscontent'  	=> $presscontent,
							'status' 			=> 'Enable',
							'insertdate'		=> $date,
							'websiteid'			=> $siteid
											);

		if( $this->db->insert('pressrelease', $data) )
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
				
			$data = array(		
							'companyid' 		=> $companyid,
							'title' 			=> $title,
							'subtitle' 			=> $subtitle,
							'sortdesc'			=> $sortdesc,
							'metakeywords'		=> $metakeywords,
							'metadescription'	=> $metadescription,
							'presscontent'  	=> $presscontent,
							'status' 			=> 'Enable',
							'insertdate'		=> $date,
							'websiteid'			=> $i
											);

			$this->db->insert('pressrelease', $data);
			}
			return true;
		}
}
	
	function update_seokeyword($id,$seokeyword)
	{
		$link = 'pressrelease/browse/'.$seokeyword;
		$data = array(		
							'seokeyword' 		=> $seokeyword,
							'link'				=> $link,
					);		
		$this->db->where('id', $id);
		if( $this->db->update('pressrelease', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	//Getting value for editing
	function get_pressrelease_byid($id)
 	{
		$query = $this->db->get_where('pressrelease', array('id' => $id));
		
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
	function update($id,$companyid,$title,$subtitle,$sortdesc,$metakeywords,$metadescription,$presscontent,$seokeyword,$siteid)
 	{
		$data = array(		
							'companyid' 		=> $companyid,
							'title' 			=> $title,
							'subtitle' 			=> $subtitle,
							'sortdesc'			=> $sortdesc,
							'metakeywords'		=> $metakeywords,
							'metadescription'	=> $metadescription,
							'presscontent'  	=> $presscontent,
							'seokeyword'		=> $seokeyword,
							'websiteid'  		=> $siteid
					);
		$this->db->where('id', $id);
		if( $this->db->update('pressrelease', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	
	//Changing Status to "Disable"
	function disable_pressrelease_byid($id)
	{
		$data = array('status'		=> 'Disable');
		$this->db->where('id', $id);
		if( $this->db->update('pressrelease', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_pressrelease_byid($id)
	{
		$data = array( 'status'	=> 'Enable' );
		$this->db->where('id', $id);
		if( $this->db->update('pressrelease', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_pressrelease_byid($id)
	{
		if( $this->db->delete('pressrelease', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function chkfield($id,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'title' 		: $varfield = 'title';break;
			case 'subtitle'		: $varfield = 'subtitle';break;
			 	
		}
		if($id != 0)
		{
			$option = array('id !=' => $id,$varfield => $fieldvalue);
		}
		else
		{
			$option = array($varfield => $fieldvalue);
		}
		$query = $this->db->get_where('pressrelease', $option);
		
		//echo $this->db->last_query();
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
		}

 	}
	
	function get_url_byid($id)
 	{
		$option = array('id' => $id);
		$query = $this->db->get_where('url', $option);
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}

 	}
	
	function get_company_byid($id)
 	{
		$query = $this->db->get_where('company', array('id' => $id));
		
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
