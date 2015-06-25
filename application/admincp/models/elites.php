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
 	
 	function get_all_elitememberss($limit ='',$offset='',$sortby,$orderby)
 	{
		switch($sortby)
		{
			case 'paymentdate'  : $sortby = 'payment_date';break;
			case 'createddate'  : $sortby = 'registerdate';break;
			case 'paymentamt' 	: $sortby = 'payment_amount';break;
			case 'privateemail' : $sortby = 'contactemail';break;
			case 'publicemail' 	: $sortby = 'email';break;
			case 'name' 		: $sortby = 'contactname';break;
			default 			: $sortby = 'company';break;
		}
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
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
 	
 	function elitesSearch($keyword, $limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('company','contactname', 'email','contactemail','payment_amount','status','registerdate','payment_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : '';
		
		// results query
		$q = $this->db->select('e.id,e.company_id,e.payment_amount,e.status,s.payment_date, c.company,c.contactname,c.email,c.contactemail,c.registerdate')
				->from('elite as e')
				->join('company as c','e.company_id=c.id','left')
				->join('subscription as s','s.company_id=e.company_id')				
				->where('c.company is NOT NULL')
				->where('c.contactemail != ""');								
				
				
				
		// limit query
		if(!empty($limit)){
			$q->limit($limit, $offset);		
		}
		
		if(!empty($sort_by) && !empty($sort_order)){
			$q->order_by($sort_by, $sort_order);
		}
		
		// search query		
		if (strlen($keyword)) {			
			$q->or_like(array('c.city'=> $keyword , 'c.state'=> $keyword , 'c.country'=> $keyword , 'c.zip'=> $keyword , 'c.company'=> $keyword , 'c.email'=> $keyword , 'c.contactemail'=> $keyword, 'c.contactname'=> $keyword,  'c.companyseokeyword'=> $keyword ) );
			
		}					
		
		$ret['rows'] = $q->get()->result();
		
		
		// count query
		$q = $this->db->select('COUNT( * ) as count', FALSE)	 
			->from('elite as e')
			->join('company as c','e.company_id=c.id','left')
			->join('subscription as s','s.company_id=e.company_id')			
			->where('c.company is NOT NULL')
			->where('c.contactemail != ""');
															
		// search query			
		if (strlen($keyword)) {			
			$q->or_like(array('c.city'=> $keyword , 'c.state'=> $keyword , 'c.country'=> $keyword , 'c.zip'=> $keyword , 'c.company'=> $keyword , 'c.email'=> $keyword , 'c.contactname'=> $keyword,  'c.companyseokeyword'=> $keyword ) );			
		}	
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		
		return $ret;
	}
	
	function elitemembersSearch($keyword, $limit, $offset, $sort_by, $sort_order) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('company','status','registerdate','payment_date');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : '';
		
		// results query
		$q = $this->db->select('e.*, c.company')
				->from('elite as e')
				->join('company as c','e.company_id=c.id','left')				
				->where('c.company is NOT NULL')
				->where('c.contactemail != ""');								
				
				
		// limit query
		if(!empty($limit)){
			$q->limit($limit, $offset);		
		}
		
		if(!empty($sort_by) && !empty($sort_order)){
			$q->order_by($sort_by, $sort_order);
		}
		
		// search query		
		if (strlen($keyword)) {			
			$q->or_like(array('c.city'=> $keyword , 'c.state'=> $keyword , 'c.country'=> $keyword , 'c.zip'=> $keyword , 'c.company'=> $keyword , 'c.email'=> $keyword , 'c.contactemail'=> $keyword, 'c.contactname'=> $keyword,  'c.companyseokeyword'=> $keyword ) );
			
		}					
		
		$ret['rows'] = $q->get()->result();
		
		
		// count query
		$q = $this->db->select('COUNT( * ) as count', FALSE)	 
			->from('elite as e')
			->join('company as c','e.company_id=c.id','left')			
			->where('c.company is NOT NULL')
			->where('c.contactemail != ""');
															
		// search query			
		if (strlen($keyword)) {			
			$q->or_like(array('c.city'=> $keyword , 'c.state'=> $keyword , 'c.country'=> $keyword , 'c.zip'=> $keyword , 'c.company'=> $keyword , 'c.email'=> $keyword , 'c.contactname'=> $keyword,  'c.companyseokeyword'=> $keyword ) );			
		}	
		
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		
		return $ret;
	}
	
	
	function getEliteMembersDetails($id){
		
		
		$q = $this->db->select('e.*, c.company')
				->from('elite as e')
				->join('company as c','c.id = e.company_id','left')								
				->where(array('e.id'=>$id), NULL, FALSE);
				
				
		$ret['rows'] = $q->get()->result();		
		
		return $ret['rows'];
			
				
	}
	
	function updateEliteMembersDetails($data){				
					
		$this->db->where(array('elite.id'=>$data['id']));	
		if($this->db->update('elite',$data)){
			return true;
		}else{
			return false;
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
		//$this->db->or_like(array('streetaddress'=> $keyword,'city'=>$keyword,'state'=>$keyword,'country'=>$keyword,'zip'=>$keyword,'LOWER(company)'=>strtolower($keyword),'companyseokeyword'=>$keyword));
		$this->db->or_like('c.city',$keyword,'after');
	    $this->db->or_like('c.state',$keyword,'after');
	    $this->db->or_like('c.country',$keyword,'after');
	    $this->db->or_like('c.zip',$keyword,'after');
	    $this->db->or_like('c.company',strtolower($keyword),'after');
	    $this->db->or_like('c.email',$keyword,'after');
	    $this->db->or_like('c.contactname',$keyword,'after');
	    $this->db->or_like('c.companyseokeyword',$keyword,'after');
		
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
		 
		 //echo '<pre>';print_r($query);
		 $startdate=$this->db->get_where('company', array('id' => $id))->row_array();
		 $query['startdate']=$startdate['registerdate'];
		 $query['sub_amt']=$subscription_amount['value'];
		 $query['status']=$enablecheck['status'];
		
		 return $query;	
			
	}
	
	function getElitePaymentDetails($id){
	
		// results query
		$elites = $this->db->get_where('elite', array('company_id' => $id))->row_array();
		$subscription_amount = $this->db->get_where('setting', array('id' => '19'))->row_array();
		if(trim($elites['status'])=='Enable')
		 {
		   $sub_id=$this->db->get_where('subscription', array('company_id' => $id))->row_array();
		   $query= $this->db->select('*')
							->from('subscription sb')
							->join('silent si', 'sb.subscr_id = si.subscription_id', 'left')
							->where(array('sb.subscr_id'=>$sub_id['subscr_id'],'sb.company_id'=>$id))
							->get()
							->row_array();							
		 }
		 
		 
		 $companies =$this->db->get_where('company', array('id' => $id))->row_array();		 
		 $query['company']=$companies['company'];
		 $query['registerdate']=$companies['registerdate'];
		 $query['sub_amt']=$subscription_amount['value'];
		 $query['status']=$elites['status'];		 
		 $query['payment_amount']=$elites['payment_amount'];
		 $query['subscription_paynumber'] = $subscription_amount['subscription_paynumber'];	 
		 return $query;
	}
}

?>
