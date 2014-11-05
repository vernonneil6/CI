<?php
Class Homesliders extends CI_Model
{
	function get_all_slidersetting($siteid,$sortby = 'fieldname',$orderby = 'ASC')
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
	function slider()
	{
		return $this->db->get('youg_slider')->result();
	}
	function addimage($title,$image)
	{
		$data = array(	
						'title'		=> $title,
						'image' 	=> $image		
					     );

		if( $this->db->insert('youg_slider', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}

	}
	function deleteslider($id)
	{
		if($this->db->delete('youg_slider',array('id'=>$id)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
        function updateslider($id,$title,$image)
        {
                $data = array(	
						'title'		=> $title,
						'image'		=> $image
								
					     );
                $this->db->where('id',$id)->update('youg_slider',$data);
        }
        function updatefield($id)
        {
               return $this->db->get_where('youg_slider',array('id'=>$id))->row_array();
        }
}
?>