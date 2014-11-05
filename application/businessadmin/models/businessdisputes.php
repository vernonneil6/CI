<?php
Class Businessdisputes extends CI_Model
{

	function disputedetail()
	{
		return $this->db->get_where('youg_dispute',array('status'=>'open','companyid'=>$this->session->userdata['youg_admin']['id']))->result();
	}
	function updateissue($id)
	{
		//return $this->db->get_where('youg_dispute',array('companyid'=>$this->session->userdata['youg_admin']['id']))->result();
	    
	    $data = array(
	              'status'=>$this->input->post('statusclose'),
	              'issuestatus'=>$this->input->post('issue'),
	              'closeddate'=>$this->input->post('closedate'),
	              'companyreview'=>$this->input->post('review')
	              );
	  return   $this->db->where('id',$id)->update('youg_dispute',$data);
	
	}
	function reviewbusinessdispute($id)
	{
		return $this->db->get_where('youg_dispute',array('id'=>$id))->row_array();
	}
	function getdetails($msglink)
	{
		
		return $this->db->get_where('youg_dispute',array('msglink'=>$msglink,'companyid'=>$this->session->userdata['youg_admin']['id']))->row_array();
		
	}	
	function getmessages($msglink)
	{
		
		return $this->db->get_where('youg_message',array('msglink'=>$msglink,'companyid'=>$this->session->userdata['youg_admin']['id']))->result();
		
	}
	function message_insert($companyname,$companyid,$toid,$fromid,$username,$userid,$dispute,$disputeid,$messages,$status,$date,$msglink,$imageupload)
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
	              'upload'      =>$imageupload,
	              'messages'    =>$messages,
	              'status'      =>$status,
	              'date'        =>$date,
	              'msglink'     =>$msglink
	            );
	  
	  return $this->db->insert('youg_message',$data);	
		
	}
	function resolution_details($disputeid)
	{
		
		return $this->db->get_where('youg_dispute',array('id'=>$disputeid,'companyid'=>$this->session->userdata['youg_admin']['id']))->row_array();
		
		
	}
	function resolutionupdate($disputeid,$imgdata,$resolutionoption,$notes,$resolutiondate,$emailflag,$carrier,$tracking,$dateshipped)
	{
		
		
	     if($imgdata != '')
        {	  
			 $data = array(
	              'resolution_type'=>$resolutionoption,
	              'resolution_note'=>$notes,
	              'resolution_upload'=>$imgdata,
	              'resolution_date'=>$resolutiondate,
	              'emailcheck'=>$emailflag,
	              'carrier'=>$carrier,
	              'tracking'=>$tracking,
	              'dateshipped'=>$dateshipped
	              );
	     return  $this->db->where('id',$disputeid)->update('youg_dispute',$data);
		}
		else
		{
			$data = array(
	              'resolution_type'=>$resolutionoption,
	              'resolution_note'=>$notes,
	              'resolution_date'=>$resolutiondate
	              );
	     return  $this->db->where('id',$disputeid)->update('youg_dispute',$data);
		 	
				
		}		
	}
    function get_merchant($id)
    {
		
		
		return $this->db->get_where('youg_company',array('id'=>$id))->row_array();
		
		
	}
	function emailflag($disputeid)
	{
		
		$query['emailcheck']=$this->db->get_where('youg_dispute',array('id'=>$disputeid))->row_array();
		
		$five_days_ago = date('Y-m-d', strtotime('-5 days', strtotime(date('Y-m-d'))));
		$dates['five']= $this->db->get_where('youg_dispute',array('ondate ='=>$five_days_ago ,'emailcheck'=> '0','status'=>'open'))->result(); 
		
	
		
		$seven_days_ago = date('Y-m-d', strtotime('-2 days', strtotime(date('Y-m-d'))));
		$dates['seven']= $this->db->get_where('youg_dispute',array('ondate ='=>$seven_days_ago ,'emailcheck'=> '0','status'=>'open'))->result(); 
		
		
		$fifteendays_days_ago = date('Y-m-d', strtotime('-15 days', strtotime(date('Y-m-d'))));
		$dates['fifteen']= $this->db->get_where('youg_dispute',array('ondate ='=>$fifteendays_days_ago,'emailcheck'=> '0','status'=>'open'))->result(); 
		
		
		return $dates;
		
		if($query['emailcheck'] == 0)
		{
			
			echo "alert";
			
		}
		else
		{
			
			echo "seen";
			
		}
			
		
	}
	
			
}
?>
