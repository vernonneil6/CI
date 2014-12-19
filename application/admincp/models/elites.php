<?php
class Elites extends CI_Model
{
	function get_all_elitemembers($limit ='',$offset='',$sortby = 'payment_date',$orderby = 'DESC')
 	{
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('elite');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function search_elitemember($keyword,$limit ='',$offset='',$sortby = 'company',$orderby = 'ASC')
 	{
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
	  	//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$this->db->select('e.*, c.*');
		$this->db->from('elite as e');
		$this->db->join('company as c','e.company_id=c.id');
		$this->db->or_like(array('company'=> $keyword , 'streetaddress'=> $keyword , 'email'=> $keyword , 'siteurl'=> $keyword , 'aboutus' => $keyword));
		
		$query = $this->db->get();
	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}
	
	function get_subscription_by_id($id)
 	{
		$query = $this->db->get_where('subscription',array('id'=>$id));
		
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
		if($type=='Disable')
		{
			$vareditip = $_SERVER['REMOTE_ADDR'];
			$data = array(
							'status'		=> 'Disable',
							
							
						);
		$this->db->where_in('company_id', $foo);
		if( $this->db->update('elite', $data) )
		{
			return true;
		}
		else
		{
			return false;
		}
	 }
	}
	function get_elitepayment_byid($id)
	{
		$enablecheck=$this->db->get_where('elite', array('company_id' => $id))->row_array();
		$subscription_amount = $this->db->get_where('setting', array('id' => '19'))->row_array();
		if(trim($enablecheck['status'])=='Enable')
		 {
		   $sub_id=$this->db->get_where('subscription', array('company_id' => $id))->row_array();
		   $query= $this->db->select('*')
							->from('subscription sb')
							->join('silent si', 'sb.subscr_id = si.subscription_id', 'left')
							->where(array('sb.subscr_id'=>$sub_id['subscr_id'],'sb.company_id'=>$id))
							->get()
							->row_array();
		 }
		 //echo $this->db->last_query();				
		 //echo '<pre>';print_r($query);
		 $startdate=$this->db->get_where('company', array('id' => $id))->row_array();
		 $query['startdate']=$startdate['registerdate'];
		 $query['sub_amt']=$subscription_amount['value'];
		 $query['status']=$enablecheck['status'];
		 return $query;	
			
	}
}

?>
