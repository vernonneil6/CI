<?php
class Complaints extends CI_Model
{
	function get_all_complaints($siteid,$limit ='',$offset='',$sortby, $orderby)
 	{
		switch($sortby)
		{
			case 'against' 		: $sortby = 'companyid';break;
			case 'by' 			: $sortby = 'userid';break;
			case 'complaint' 	: $sortby = 'detail';break;
			default 			: $sortby = 'complaindate';break;
		}
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->where('websiteid',$siteid);
		$query = $this->db->get('complaints');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	function complaintsSearch($keyword, $siteid, $limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('detail', 'companyid','userid','status','complaindate');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : '';
		
		if($sort_by == 'userid'){
			$sort_by = 'u.firstname';
		}
		if($sort_by == 'companyid'){
			$sort_by = 'cm.company';
		}
		
		// results query
		$q = $this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.firstname,u.lastname,u.username,u.avatarbig,u.gender')
				->from('complaints as c')
				->join('user as u','c.userid=u.id','left')
				->join('company as cm','cm.id=c.companyid','left')
				->where('websiteid',$siteid);
				
		// limit query
		if(!empty($limit)){
			$q->limit($limit, $offset);		
		}
		
		if(!empty($sort_by) && !empty($sort_order)){
			$q->order_by($sort_by, $sort_order);
		}
		
		// search query		
		if (strlen($keyword)) {
			$q->where('c.status','Disable');
			$q->or_like(array('u.firstname'=> $keyword , 'u.lastname'=> $keyword , 'c.detail'=> $keyword , 'c.username'=> $keyword , 'c.comseokeyword'=> $keyword , 'c.location'=> $keyword , 'c.damagesinamt'=> $keyword , 'cm.company'=> $keyword , 'cm.companyseokeyword'=> $keyword, "CONCAT(u.firstname, ' ', u.lastname)" => $keyword ) );
			
		}				
		
		$ret['rows'] = $q->get()->result();
		
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)	 
				->from('complaints as c')
				->join('user as u','c.userid=u.id','left')						
				->join('company as cm','cm.id=c.companyid','left')
				->where('websiteid',$siteid);
		
		// search query		
		if (strlen($keyword)) {
			$q->where('c.status','Disable');
			$q->or_like(array('u.firstname'=> $keyword , 'u.lastname'=> $keyword , 'c.detail'=> $keyword , 'c.username'=> $keyword , 'c.comseokeyword'=> $keyword , 'c.location'=> $keyword , 'c.damagesinamt'=> $keyword , 'cm.company'=> $keyword , 'cm.companyseokeyword'=> $keyword, "CONCAT(u.firstname, ' ', u.lastname)" => $keyword ) );
		}
				
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
 	
 	function removedComplaintsSearch($keyword, $siteid, $limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('detail', 'userid','companyid','whendate','transaction_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : '';
		
		if($sort_by == 'userid'){
			$sort_by = 'u.firstname';
		}
		if($sort_by == 'companyid'){
			$sort_by = 'cm.company';
		}
		// results query
		$q = $this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.firstname,u.lastname,u.avatarbig,u.gender')
				->from('complaints as c')
				->join('user as u','c.userid=u.id','left')
				->join('company as cm','cm.id=c.companyid','left')			
				->where(array('c.status'=>'Disable','c.transactionid !='=>'','c.websiteid'=>$siteid));
				
				
		// limit query
		if(!empty($limit)){
			$q->limit($limit, $offset);		
		}
		
		if(!empty($sort_by) && !empty($sort_order)){
			$q->order_by($sort_by, $sort_order);
		}
		
		// search query		
		if (strlen($keyword)) {			
			$q->or_like(array('u.firstname'=> $keyword , 'u.lastname'=> $keyword , 'c.detail'=> $keyword , 'c.username'=> $keyword , 'c.comseokeyword'=> $keyword , 'c.location'=> $keyword , 'c.damagesinamt'=> $keyword , 'cm.company'=> $keyword , 'cm.companyseokeyword'=> $keyword, "CONCAT(u.firstname, ' ', u.lastname)" => $keyword ) );
			
		}				
		
		$ret['rows'] = $q->get()->result();
		
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)	 
				->from('complaints as c')
				->join('user as u','c.userid=u.id','left')
				->join('company as cm','cm.id=c.companyid','left')										
				->where(array('c.status'=>'Disable','c.transactionid !='=>'','c.websiteid'=>$siteid));
				
		// search query		
		if (strlen($keyword)) {			
			$q->or_like(array('u.firstname'=> $keyword , 'u.lastname'=> $keyword , 'c.detail'=> $keyword , 'c.username'=> $keyword , 'c.comseokeyword'=> $keyword , 'c.location'=> $keyword , 'c.damagesinamt'=> $keyword , 'cm.company'=> $keyword , 'cm.companyseokeyword'=> $keyword, "CONCAT(u.firstname, ' ', u.lastname)" => $keyword ) );
		}
				
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
 	
	function search_removedcomplaint($keyword,$siteid,$limit ='',$offset='',$sortby = 'id',$orderby = 'DESC')
 	{
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
			$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.firstname,u.lastname,u.avatarbig,u.gender');
			$this->db->from('complaints as c');
			$this->db->join('company as cm','c.companyid=cm.id');
			$this->db->join('user as u','c.userid=u.id');
			$this->db->where('c.websiteid',$siteid);
			$this->db->where('c.status','Disable');
			$this->db->where('(c.detail LIKE \'%'.$keyword.'%\' OR c.location LIKE \'%'.$keyword.'%\' OR c.username LIKE \'%'.$keyword.'%\' OR cm.company LIKE \'%'.$keyword.'%\' OR c.damagesinamt LIKE \'%'.$keyword.'%\' OR c.comseokeyword LIKE \'%'.$keyword.'%\' OR cm.companyseokeyword LIKE \'%'.$keyword.'%\')', NULL, FALSE);
			$query = $this->db->get();
			//echo "<pre>";
			//echo $this->db->last_query();
			//die();

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function get_all_removedcomplaints($siteid,$limit ='',$offset='',$sortby,$orderby)
 	{
		switch($sortby)
		{
			case 'against' 			: $sortby = 'companyid';break;
			case 'complaint' 		: $sortby = 'detail';break;
			case 'complaintdate' 	: $sortby = 'whendate';break;
			case 'removaldate'		: $sortby = 'transaction_date';break;
			default					: $sortby = 'companyid';break;
		}
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get_where('complaints',array('status'=>'Disable','transactionid !='=>'','websiteid'=>$siteid));
		
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
	function get_complaint_byid($id)
 	{
		$query = $this->db->get_where('complaints', array('id' => $id));
		
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
	function get_historycomplaint_byid($id)
 	{
		$query = $this->db->get_where('complaints', array('id' => $id,'status'=>'Disable'));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function getComplaintHistory($id)
 	{
				
		if(!empty($id)){
			
			$q = $this->db->select('c.*')
				->from('complaints as c')
				->join('user as u','c.userid=u.id','left')
				->join('company as cm','cm.id=c.companyid','left')			
				->where(array('c.status'=>'Disable','c.id'=>$id));
			
			$ret['rows'] = $q->get()->result();				
				
			$q = $this->db->select('COUNT(*) as count', FALSE)
				->from('complaints as c')
				->join('user as u','c.userid=u.id','left')
				->join('company as cm','cm.id=c.companyid','left')			
				->where(array('c.status'=>'Disable','c.id'=>$id));	
				
				
			$tmp = $q->get()->result();
		
			$ret['num_rows'] = $tmp[0]->count;
		
			return $ret;					
		}
 	
	}
	
	//Updating Record
	function update($intid,$complainttype,$damagesinamt,$whendate,$location,$detail,$comseokeyword)
 	{
		$editdate = date('Y-m-d');
		$complainip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'type'					=> $complainttype,
							'damagesinamt'	=> $damagesinamt,
							'whendate' 			=> $whendate,
							'location' 			=> $location,
							'detail' 				=> $detail,
							'complaindate'	=> $editdate,
							'complainip' 		=> $complainip,
							'comseokeyword'	=> $comseokeyword,
						);
			//echo "<pre>";
			//print_r($data);
			//die();
		$this->db->where('id', $intid);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Function for Deleting Record
	
	function delete_complaint_byid($id)
	{
		if( $this->db->delete('complaints', array('id' => $id)) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Disable"
	function disable_complaint_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'			=> 'Disable',
						'complainip' 	=> $vareditip,
						'remove_date' => date('Y-m-d H:i:s')
						 		);
		$this->db->where('id', $id);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_complaint_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'			=> 'Enable',
							'complainip' 	=> $vareditip,
							
						);
		$this->db->where('id', $id);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Querying to Check Seokeyword is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		if($id != 0)
		{
			$option = array( 'id !=' => $id, $field => $fieldvalue );
		}
		else
		{
			$option = array( $field => $fieldvalue );
		}
		$query = $this->db->get_where('complaints', $option);
		if ($query->num_rows() > 0)
		{
			return 'old';
		}
		else
		{
			return 'new';
		}
 	}
	
	//Getting value for searching
	function search_complaint($keyword,$siteid,$limit ='',$offset='',$sortby = 'id',$orderby = 'DESC')
 	{
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
			$this->db->select('c.*, cm.company,cm.logo,cm.companyseokeyword,u.firstname,u.lastname,u.avatarbig,u.gender');
			$this->db->from('complaints as c');
			$this->db->join('company as cm','c.companyid=cm.id');
			$this->db->join('user as u','c.userid=u.id');
			$this->db->where('c.websiteid',$siteid);
			$this->db->where('(c.detail LIKE \'%'.$keyword.'%\' OR c.location LIKE \'%'.$keyword.'%\' OR c.username LIKE \'%'.$keyword.'%\' OR cm.company LIKE \'%'.$keyword.'%\' OR c.damagesinamt LIKE \'%'.$keyword.'%\' OR c.comseokeyword LIKE \'%'.$keyword.'%\' OR cm.companyseokeyword LIKE \'%'.$keyword.'%\')', NULL, FALSE);
			$query = $this->db->get();
			//echo "<pre>";
			//echo $this->db->last_query();
			//die();

		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function multiple_function($type,$foo)
	{
		if($type=='Delete')
		{
			
			if( $this->db->delete('complaints', $this->db->where_in('complaints.id',$foo)) )
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		if($type=='Enable')
		{
			$vareditip = $_SERVER['REMOTE_ADDR'];
			$data = array(
							'status'		=> 'Enable',
							'complainip' 	=> $vareditip,
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
		
		if($type=='Disable')
		{
			$vareditip = $_SERVER['REMOTE_ADDR'];
			$data = array(
							'status'		=> 'Disable',
							'complainip' 	=> $vareditip,
							
						);
		$this->db->where_in('id', $foo);
		if( $this->db->update('complaints', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	}
	
	
	function get_company_bysingleid($id)
 	{
		$query = $this->db->get_where('company', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
 	}
 	
 	
 	function get_user_bysingleid($id)
 	{
		$query = $this->db->get_where('user', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
 	}
}

?>
