<?php

class Marketers extends CI_Model
{

function get_marketer($subbrokerid,$marketerid)
{
	return $query = $this->db->get_where('youg_broker',array('subbrokerid'=>$subbrokerid,'marketerid'=>$marketerid))->result();
	 
}

}
?>