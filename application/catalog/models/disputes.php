<?php
Class Disputes extends CI_Model
{	
	function get_details($disputeid)
	{
		 return $this->db->get_where('youg_dispute',array('msglink'=>$disputeid))->row_array();
		  
	}
	function insert_message($companyname,$companyid,$toid,$fromid,$username,$userid,$dispute,$disputeid,$messages,$status,$date,$msglink,$fileupload)
	{
		$data = array(
	              'companyname' =>$companyname,
	              'companyid'   =>$companyid,
	              'toid'        =>$toid,
	              'fromid' 		=>$fromid,
	              'username'    =>$username,
	              'userid'      =>$userid,
	              'dispute'     =>$dispute,
	              'disputeid'   =>$disputeid,
	              'upload'      =>$fileupload,
	              'messages'    =>$messages,
	              'status'      =>$status,
	              'date'        =>$date,
	              'msglink'     =>$msglink
	            );
	  
	  return $this->db->insert('youg_message',$data);
		
	}
	function get_messages($msg)
	{    
		 return $this->db->get_where('youg_message',array('msglink'=>$msg))->result();
	}
	
}
?>
