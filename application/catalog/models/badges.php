<?php
Class Badges extends CI_Model
{	
function badgeid($id)
{
     $query=$this->db->get_where('youg_company',array('md5(id)'=>$id));
     return $query->row_array();
}
function badgeadd($name,$rating,$titles,$review,$fromid,$id)
{
     $data=array('name'=>$name,'rating'=>$rating,'titles'=>$titles,'review'=>$review,'fromid'=>$fromid,'toid'=>$id);
     $this->db->insert('youg_badge',$data);
}
function badgedetail($id)
{
		return $this->db->get_where('youg_badge',array('md5(toid)'=>$id))->result();
}
}
?>