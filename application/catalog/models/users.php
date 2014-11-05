<?php class Users extends CI_Model
{
	//Inserting Record
	function insert($uniqueid,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$avatarthum,$avatarbig,$terms,$username)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'uniqueid' 	    => $uniqueid,
							'firstname' 	=> $firstname,
							'lastname' 		=> $lastname,
							'email' 		=> $email,
							'password' 		=> $password,
					   		'gender'		=> $gender,
							'street'		=> $street,
							'city'			=> $city,
							'state'			=> $state,
							'zipcode'		=> $zipcode,
							'phoneno'		=> $phoneno,
							'avatarthum'	=> $avatarthum,
							'avatarbig'		=> $avatarbig,
							'terms'			=> $terms,
							'status' 		=> 'Disable',
							'registerip' 	=> $varipaddress,
							'registerdate'	=> $date,
							'username'		=> $username
						);

		if( $this->db->insert('user', $data) )
		{
			return 'added';
		}
		else
		{
			return false;
		}
		
	}
	
	//Inserting Record
	function insert_noimage($uniqueid,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$terms,$username)
	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'uniqueid' 	    => $uniqueid,
							'firstname' 	=> $firstname,
							'lastname' 		=> $lastname,
							'email' 		=> $email,
							'password' 		=> $password,
					   		'gender'		=> $gender,
							'street'		=> $street,
							'city'			=> $city,
							'state'			=> $state,
							'zipcode'		=> $zipcode,
							'phoneno'		=> $phoneno,
							'terms'			=> $terms,
							'status' 		=> 'Disable',
							'registerip' 	=> $varipaddress,
							'registerdate'	=> $date,
							'username'		=> $username
						);

		if( $this->db->insert('user', $data) )
		{
			return 'added';
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
	function update($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$avatarthum,$avatarbig,$username)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'firstname' 	=> $firstname,
							'lastname' 		=> $lastname,
							'email' 		=> $email,
							'password' 		=> $password,
					    	'gender'		=> $gender,
							'street'		=> $street,
							'city'			=> $city,
							'state'			=> $state,
							'zipcode'		=> $zipcode,
							'phoneno'		=> $phoneno,
							'avatarthum'	=> $avatarthum,
							'avatarbig'		=> $avatarbig,
							'editip' 		=> $varipaddress,
							'editdate'		=> $date,
							'username'		=> $username
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
	
	function update_noimage($id,$firstname,$lastname,$email,$password,$gender,$street,$city,$state,$zipcode,$phoneno,$username)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'firstname' 	=> $firstname,
							'lastname' 		=> $lastname,
							'email' 		=> $email,
							'password' 		=> $password,
					    	'gender'		=> $gender,
							'street'		=> $street,
							'city'			=> $city,
							'state'			=> $state,
							'zipcode'		=> $zipcode,
							'phoneno'		=> $phoneno,
							'editip' 		=> $varipaddress,
							'editdate'		=> $date,
							'username'		=> $username
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
	
	//Updating Password
	function update_password($id,$newpassword)
 	{
		$date = date('Y-m-d H:i:s');
		$varipaddress = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'password'	=> $newpassword,
						'editip' 	=> $varipaddress,
						'editdate'	=> $date
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
	function enable_user_byuniqueid($uniqueid)
	{
		$date_edit = date('Y-m-d H:i:s');
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'	=> 'Enable',
							'editip' 	=> $vareditip,
							'editdate'	=> $date_edit
						);
		$this->db->where('uniqueid', $uniqueid);
		if( $this->db->update('user', $data) )
		{
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
			case 'username' 	: $varfield = 'username';break;
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
	
	function get_all_complaintsby_userid($id)
 	{
		//Executing Query
		$siteid = $this->session->userdata('siteid');
		$sites = array(1,$siteid);
		
		$this->db->where_in('websiteid',$sites);
		$this->db->where('status','Enable');
		$this->db->where('userid',$id);
		$query=$this->db->get('complaints');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_all_commentsby_userid($id)
 	{
		//Executing Query
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('comments',array('status'=>'Enable','commentby'=>$id,'websiteid'=>$siteid));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	function get_all_disputesby_userid($id)
 	{
		//Executing Query
		$siteid = $this->session->userdata('siteid');
		$query = $this->db->get_where('youg_dispute',array('status'=>'open','userid'=>$id));
		
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
	
	//fb login and signup
	
	function insertfbuser($first_name,$last_name,$gender,$username,$email,$uid,$fbpassword,$fbdate,$isverified)
{
			if($gen == 'male'){ $gender = 'Male';}
			if($gen == 'female'){ $gender = 'Female';}
			$data = array(
			'email'  			=> $email,
			'password'  		=> $fbpassword,
			'firstname' 		=> $first_name,
			'lastname'  		=> $last_name,
			'gender'  			=> $gender,
			'status' 			=> 'Enable',
			'fbid'  			=> $uid,
			'fbverified'  		=> $isverified,
			'fbupdated_time' 	=> $fbdate,
			'registerdate' 		=> date('Y-m-d H:i:s'),
			);
			
			if( $this->db->insert('user', $data) )
			{
				$id=$this->db->insert_id();
				$result = array(
				'userid'  => $id,
				'emailid'   => $email,
				'name'	 => stripslashes($first_name." ".$last_name),
				'password'     => $fbpassword,
			
			
			);
			
			return $result;
			}
			else
			{
			return false;
			}
			}


function set_user_fbid($email,$uid,$fbdate,$isverified)
	{
		$this->db->where( array('email' => $email) );
		$query = $this->db->get('user');
		
		if ($query->num_rows() > 0)
		{
			$date_edit = date('Y-m-d');
			
			$data = array(
					  	'fbid' 			 => $uid,
						'fbverified'	 => $isverified,
						'fbupdated_time' => $fbdate,
				  );
			$this->db->where( array('email'=>$email) );
			
			if( $this->db->update('user', $data) )
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
			return "notfound";
		}
		
	}
	
	
}
?>
