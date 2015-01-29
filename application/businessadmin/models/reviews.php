<?php
class Reviews extends CI_Model
{
	function get_all_reviews($companyid,$siteid,$limit ='',$offset='',$sortby = 'id',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		if($siteid!='all')
		{
			$query = $this->db->get_where('reviews',array('companyid' => $companyid,'websiteid' => $siteid,'type'=>'csv'));
		}
		else
		{
			$query = $this->db->get_where('reviews',array('companyid' => $companyid,'type'=>'csv'));
		}
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_mainreviews($companyid,$siteid,$limit ='',$offset='',$sortby = 'id',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		//Executing Query
		if($siteid!='all')
		{
		$query = $this->db->get_where('reviews',array('companyid' => $companyid,'websiteid' => $siteid,'type'=>'ygr'));
		}
		else
		{
			$query = $this->db->get_where('reviews',array('companyid' => $companyid,'type'=>'ygr'));
		}
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	
	//Getting review value for editing
	function get_review_byid($id)
 	{
		$query = $this->db->get_where('reviews', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Getting review value for editing
	function get_mainreview_byid($id)
 	{
		$query = $this->db->get_where('reviews', array('id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	//Inserting Record
	function insert($companyid,$username,$rating,$review,$date,$siteid,$title)
	{
		$data = array(
							'companyid' 	=> $companyid,
							'reviewby' 		=> $username,
							'rate' 			=> $rating,
							'comment' 		=> $review,
							'reviewdate' 	=> $date,
							'status' 		=> 'Enable',
							'websiteid'		=> $siteid,
							'reviewtitle'	=> $title,
							'type'			=> 'csv'
							
						);

		if( $this->db->insert('reviews', $data) )
		{
			$id = $this->db->insert_id();
			
			$company1 = $this->db->get_where('company', array('id' => $companyid));
			$company = $company1->result_array();
			if(count($company)>0)
			{
				//$company = $company->result_array();
				//lower case everything
			$companyname = strtolower($company[0]['company']);
			//make alphaunermic
			$companyname = preg_replace("/[^a-z0-9\s-]/", "", $companyname);
			//Clean multiple dashes or whitespaces
			$companyname = preg_replace("/[\s-]+/", " ", $companyname);
			//Convert whitespaces to dash
			$companyname = preg_replace("/[\s]/", "-", $companyname);
			
			$seokeyword = $companyname.'-review-'.$id;
			}
			else
			{
				$seokeyword = 'review-'.$id;	
			}
			
			$link = 'review/browse/'.$seokeyword;
			$this->db->where('id', $id);
			$this->db->update('reviews',array('link'=>$link,'seokeyword'=>$seokeyword));
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Inserting Record
	function insert_review_status($companyid,$reviewid)
	{
		$date = date('Y-m-d H:i:s');
		$data = array(		'companyid' 	=> $companyid,
							'reviewid' 		=> $reviewid,
							'status' 		=> 'sent',
							'click'			=> 'No',
							'sentdate' 		=> $date,
					);

		if( $this->db->insert('reviewstatus', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function update_review_status($companyid,$reviewid)
	{
		$data = array('flag' => '1','status' => 'Disable');

		if( $this->db->where(array('id'=>$reviewid, 'companyid'=>$companyid))->update('reviews', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	//Inserting Record
	function update_checkdate($id,$companyid,$reviewid)
	{
		$query = $this->db->query("Update `youg_reviewstatus` set checkdate = DATE_ADD(sentdate,INTERVAL 5 DAY) where id='$id' and companyid='$companyid' and reviewid='$reviewid'");
		
		return true;
	}
	
	function get_reviewmail_byreviewid($id)
 	{
		return $this->db->get_where('youg_reviewmail', array('review_id' => $id))->row_array();
	}
	
	function review_mail($reviewid, $companyid)
	{
		return $this->db->get_where('youg_reviewmail',array('company_id' => $companyid, 'review_id' => $reviewid))->row_array();
	}
	function reviews_status($reviewid, $companyid)
	{
		return $this->db->get_where('youg_reviews',array('companyid' => $companyid, 'id' => $reviewid))->row_array();
	}
	
	function reviewmail_update($data, $id)
	{
		$this->db->where('id', $id)->update('youg_reviewmail', $data);
	}
	
	function delete_review_byid($id)
 	{	
	  $this->db->where('id',$id);
		
		if($this->db->delete('reviews'))
		{
			return true;
		}
		else
		{
			return false;
		}
 	}
 	
 	function delete_comment($reviewid)
 	{
		$this->db->where('reviewid', $reviewid);
		if( $this->db->delete('comments'))
		{
			return true;
		}
		else
		{
			return false;
		}	
 	}
 	
 	function delete_reviewmail($reviewid)
 	{
		$this->db->where('review_id', $reviewid);
		if( $this->db->delete('youg_reviewmail'))
		{
			return true;
		}
		else
		{
			return false;
		}	
 	}
	
	//Changing Status to "Disable"
	function disable_review_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
						'status'		=> 'Disable',
						'reviewip' 	=> $vareditip,
						 		);
		$this->db->where('id', $id);
		if( $this->db->update('reviews', $data) )
		{
			$this->db->where('reviewid', $id);
			$data1 = array('click'=>'Yes');
			if( $this->db->update('reviewstatus', $data1) )
			{		
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	
	//Changing Status to "Enable"
	function enable_review_byid($id)
	{
		$vareditip = $_SERVER['REMOTE_ADDR'];
		$data = array(
							'status'		=> 'Enable',
							'reviewip' 	=> $vareditip,
							
						);
		$this->db->where('id', $id);
		if( $this->db->update('reviews', $data) )
		{
			$this->db->where('reviewid', $id);
			$data1 = array('click'=>'Yes');
			if( $this->db->update('reviewstatus', $data1) )
			{		
				return true;
			}
		}
		else
		{
			return false;
		}
	}
	//Changing Status to "Enable"
	function get_reviewstatus_by_reviewid($id)
	{
		$query = $this->db->get_where('reviewstatus', array('reviewid' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	}
	
	function get_url_byid($id)
 	{
		$option = array('id' => $id);
		$query = $this->db->get_where('url', $option);
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}

 	}
	public function get_all_reviews_count($companyid,$siteid)
	{
		
		if($siteid!='all')
		{
		$this->db->where('websiteid', $siteid);
		$this->db->where('companyid', $companyid);
		}
		else
		{
		$this->db->where('companyid', $companyid);
		}
		$query = $this->db->count_all('reviews');
		return $query;
	}
	
	function review_date($companyid,$userid,$reviewid,$date,$status)
	{
		$data = array(
					'company_id' 	=> $companyid,
					'user_id'		=> $userid,
					'review_id' 	=> $reviewid,
					'date'			=> $date,
					'status'		=> $status
				);

		if( $this->db->insert('youg_review_date', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}	
	}
	
	function select_review_date($companyid, $userid)
	{
		$query = $this->db->get_where('youg_review_date',array('company_id'=>$companyid,'user_id'=>$userid));
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	
	function get_review_bysingleid($reviewid)
 	{
		return $this->db->get_where('youg_reviews',array('id' => $reviewid))->row_array();
	}
	function get_reviewmail_bysinglereviewid($reviewid)
	{
		return $this->db->get_where('youg_reviewmail',array('review_id' => $reviewid))->row_array();
	}
}

?>
