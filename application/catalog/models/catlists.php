<?php
Class Catlists extends CI_Model
{
function get_all_tempcategorys_menu($siteid,$sortby = 'category',$orderby = 'ASC')
 	{
		switch($sortby)
		{
			case 'category' : $sortby = 'category';break;
			default 	    : $sortby = 'category';break;
		}
		
		//Ordering Data
		//$this->db->order_by($sortby,$orderby);
		
		//Executing Query
		$query = $this->db->get_where('category',array('status'=>'Enable','websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result_array();
			function sortByOrder($result, $b) {
				return strcmp( $result['category'], $b['category']);
			}
			usort($result, 'sortByOrder');
			return $result;
		}
		else
		{
			return array();
		}
 	}
 	
}
?>
