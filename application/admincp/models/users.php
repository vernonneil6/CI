<?php
Class Users extends CI_Model
{
	function get_all_users($limit ='',$offset='',$sortby, $orderby)
 	{
		//echo $sortby;echo $orderby;die;
		switch($sortby)
		{
			case 'name' 		: $sortby = 'firstname';break;
			case 'email' 		: $sortby = 'email';break;
			case 'date' 		: $sortby = 'registerdate';break;
			default 			: $sortby = 'status';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('user');
		
		$lastquery = $this->db->last_query();
		
		$userQuery = $this->db->query("SELECT * FROM ( $lastquery ) AS T1 ORDER BY $sortby $orderby");
		
	
		//print_r($userQuery->result_array());		die;
		if ($userQuery->num_rows() > 0)
		{
			return $userQuery->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	
	function usersSearch($keyword, $limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('email', 'status','registerdate');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'firstname';
		
		
		// results query
		$q = $this->db->select('*')
			->from('user')
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		if (strlen($keyword)) {
			$q->or_like(array('firstname'=> $keyword , 'lastname'=> $keyword , 'email'=> $keyword , 'phoneno'=> $keyword , 'street'=> $keyword , 'city'=> $keyword , 'state'=> $keyword , 'zipcode'=> $keyword, "CONCAT(firstname, ' ', lastname)" => $keyword ) );
		}
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('user');
		
		if (strlen($keyword)) {
			$q->or_like(array('firstname'=> $keyword , 'lastname'=> $keyword , 'email'=> $keyword , 'phoneno'=> $keyword , 'street'=> $keyword , 'city'=> $keyword , 'state'=> $keyword , 'zipcode'=> $keyword, "CONCAT(firstname, ' ', lastname)" => $keyword ));
		}
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	
	//Inserting Record 
	function insert($firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$avatarthum,$avatarbig)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'firstname' 	=> $firstname,
							'lastname' 		=> $lastname,
							'email' 		=> $email,
							'password' 		=> $password,
							'gender' 		=> $gender,
							'street'		=> $street,
							'city'			=> $city,
							'state'			=> $state,
							'zipcode'		=> $zipcode,
							'phoneno'		=> $phoneno,
							'avatarthum'	=> $avatarthum,
							'avatarbig'		=> $avatarbig,
							'status' 		=> 'Enable',
							'registerip' 	=> $varipaddress,
							'registerdate'	=> $date
						);

		if( $this->db->insert('user', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Getting value for editing
	function get_user_byid($id)
 	{
		$query = $this->db->get_where('user', array('id' => $id));
		
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
	function update($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$avatarthum,$avatarbig)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'firstname' 	=> $firstname,
							'lastname' 		=> $lastname,
							'email' 		=> $email,
							'password' 		=> $password,
							'gender' 		=> $gender,
							'street'		=> $street,
							'city'			=> $city,
							'state'			=> $state,
							'zipcode'		=> $zipcode,
							'phoneno'		=> $phoneno,
							'avatarthum'	=> $avatarthum,
							'avatarbig'		=> $avatarbig,
							'status' 		=> 'Enable',
							'editip' 		=> $varipaddress,
							'editdate'		=> $date
						);
		$this->db->where('id', $id);
		if( $this->db->update('user', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	function update_noimage($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'firstname' 	=> $firstname,
							'lastname' 		=> $lastname,
							'email' 		=> $email,
							'password' 		=> $password,
							'gender' 		=> $gender,
							'street'		=> $street,
							'city'			=> $city,
							'state'			=> $state,
							'zipcode'		=> $zipcode,
							'phoneno'		=> $phoneno,
							'editip' 		=> $varipaddress,
							'editdate'		=> $date
						);
		//echo "<pre>";
		//print_r($data);
		//die();
		$this->db->where('id', $id);
		if( $this->db->update('user', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
	
	//Changing Status to "Disable"
	function disable_user_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'	=> 'Disable',
						'editip' 	=> $vareditip,
						'editdate'	=> $date_edit
					);
		$this->db->where('id', $id);
		if( $this->db->update('user', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_user_byid($id)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'	=> 'Enable',
							'editip' 	=> $vareditip,
							'editdate'	=> $date_edit
						);
		$this->db->where('id', $id);
		if( $this->db->update('user', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Function for Deleting Record
	function delete_user_byid($id)
	{
		if( $this->db->delete('user', array('id' => $id)) )
		{
			$this->db->delete('comments', array('commentby' => $id));
			$this->db->delete('complaints', array('userid' => $id));
			$this->db->delete('reviews', array('reviewby' => $id));
			$this->db->delete('couponcomments', array('commentby' => $id));
			$this->db->delete('relation', array('userid' => $id));
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Querying to Check E-mail or User name is already exists
	function chkfield($id,$field,$fieldvalue)
 	{
		switch($field)
		{
			case 'email' 		: $varfield = 'email';break;
			case 'username'	: $varfield = 'username';break;
		}
		if($id != 0)
		{
			$option = array( 'id !=' => $id, $varfield => $fieldvalue );
		}
		else
		{
			$option = array( $varfield => $fieldvalue );
		}
		$query = $this->db->get_where('user', $option);
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
	function search_user($keyword,$limit ='',$offset='',$sortby = 'firstname',$orderby = 'ASC')
	{
	 	$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
	 	
	  $this->db->select('*');
	  $this->db->from('user');	  
	  $this->db->or_like(array('firstname'=> $keyword , 'lastname'=> $keyword , 'email'=> $keyword , 'phoneno'=> $keyword , 'street'=> $keyword , 'city'=> $keyword , 'state'=> $keyword , 'zipcode'=> $keyword,"CONCAT(firstname, ' ', lastname)" => $keyword ) );

	  $query = $this->db->get();
	//echo $this->db->last_query();die;

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
