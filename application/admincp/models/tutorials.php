<?php
Class Tutorials extends CI_Model
{
	function get_all_tutorialsetting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('seo');
		
		if( $query->num_rows() > 0 )
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function tutorial()
	{
		return $this->db->get('youg_tutorial')->result();
	}
	function addtutorial($title,$type,$image)
	{   
		$status = 'Enable';
		$date=date('Y-m-d H:i:s'); 
		$data = array(	
						'title'	 => $title,
						'type'	 => $type,
						'file' 	 => $image,		
						'status' => $status,		
						'date' 	 => $date		
					     );

		if( $this->db->insert('youg_tutorial', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	function addvideotutorial($title,$type,$video)
	{
	
	    $status = 'Enable';
		$date=date('Y-m-d H:i:s'); 
		$editdate=date('Y-m-d H:i:s'); 
		$data = array(	
						'title'	 => $title,
						'type'	 => $type,
						'file' 	 => $video,		
						'status' => $status,		
						'date' 	 => $date,		
						'editdate' 	 => $editdate		
					     );

		if( $this->db->insert('youg_tutorial', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}	
		
		
		
	}
	function deletetutorial($id)
	{
		if($this->db->delete('youg_tutorial',array('id'=>$id)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
        function updatetutorial($id,$title,$type,$image)
        {
			$editdate=date('Y-m-d H:i:s'); 
			$data = array(	
						'title'		=> $title,
						'type'		=> $type,
						'file'		=> $image,
						'editdate'		=> $editdate
								
					     );
                $this->db->where('id',$id)->update('youg_tutorial',$data);
        }
        function updatevideotutorial($id,$title,$type,$video)
        {
               $editdate=date('Y-m-d H:i:s'); 
                $data = array(	
						'title'		=> $title,
						'type'		=> $type,
						'file'		=> $video,
						'editdate'  => $editdate		
					     );
                $this->db->where('id',$id)->update('youg_tutorial',$data);
        }
        function updatefield($id)
        {
               return $this->db->get_where('youg_tutorial',array('id'=>$id))->row_array();
        }
}
?>
