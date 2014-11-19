<?php
class Reports extends CI_Model
{
	function get_all_elitemembersforreport()
 	{
		$query = $this->db->query("SELECT  e.*, s.*,c.*,e.payment_date as joindate,e.status as elitestatus FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}

	function get_all_enabledmembers()
 	{
		$query = $this->db->query("SELECT c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Enable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_disabledmembers()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_elitemembers()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id ");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_enabledmemberswithcode()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Enable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_disabledmemberswithcode()
 	{
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.contactname,c.contactphonenumber,c.contactemail,e.payment_date,s.expires,e.status,e.discountcode FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function get_all_callcenter_elite()
 	{
		$query = $this->db->query("SELECT c.email,c.company,CONCAT(c.streetaddress,c.city,c.state,c.country,c.zip),e.transactionid,c.id as id,e.status,c.editdate FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_removed_reviews()
 	{
		$query = $this->db->query("SELECT u.username,u.email,CONCAT(u.firstname,u.lastname),CONCAT(u.street,u.city,u.state,u.zipcode),r.reviewdate,r.reviewremoveddate,c.company,CONCAT(c.streetaddress,c.city,c.state,c.country,c.zip) FROM youg_reviews r JOIN youg_company c ON c.id = r.companyid JOIN youg_user u ON r.reviewby = u.id where r.status='Disable' AND r.type='ygr'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	function get_all_removed_complaints()
 	{
		$query = $this->db->query("SELECT u.username,u.email,CONCAT(u.firstname,u.lastname),CONCAT(u.street,u.city,u.state,u.zipcode),com.whendate,com.transaction_date,c.company,CONCAT(c.streetaddress,c.city,c.state,c.country,c.zip) FROM youg_complaints com JOIN youg_company c ON c.id = com.companyid JOIN youg_user u ON com.userid = u.id where com.status='Disable'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	
	/*function search_insert($keyword,$searchtype,$searchdate)
	{
	  
	  $data = array(
			   'keyword' => $keyword,
			   'searchby' => $searchtype,
			   'searchdate' => $searchdate
			);
	  $this->db->insert('youg_reportsearch', $data); 	
		
		
		
	}*/
	function search_data($keyword)
	{
	     	
	  $this->db->select('*');
	  $this->db->like('company', $keyword);
	  $this->db->or_like('contactname',$keyword);

	  $query = $this->db->get('youg_company');
	  
	  
	  if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		else
		{
			return array();
		}
	}
	                           // FOR CSV PROCESS
	                           
	                           
	function get_subbrokerdetails()
	{
		
		$query=$this->db->query("SELECT id,name,type FROM youg_broker where type='subbroker'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}                                 
	function get_marketerdetails($subid)
	{
		
		$query=$this->db->query('SELECT id,name,type FROM youg_broker where type="marketer" and subbrokerid='.$subid.'');
		
		$this->db->last_query();
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}                                 
	function get_agentdetails($mid)
	{
		
		$query=$this->db->query('SELECT id,name,type FROM youg_broker where type="agent" and marketerid='.$mid.'');
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}                                 
	function get_subbrokerdetails_byid($id)
	{	
		
		// get subbroker details ->respective marketers -> agent and total elites sales count.
		//fieldsshown-Name -Marketers_allowed -Agents_allowed -Marketers_name- Agents_name- Total_Elite_sales
	    $query = $this->db->query("select name,marketer as no_of_marketers,agent as no_of_agents,signup,(select group_concat(name SEPARATOR ', ') from youg_broker where subbrokerid =".$id." and type='marketer') as marketer_names ,(select group_concat(name SEPARATOR ', ') from youg_broker where subbrokerid =".$id." and type='agent') as agent_names ,(select count(*) from youg_company where subbrokerid =".$id." ) as total_elites from youg_broker where id=".$id);		
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}                                 
	function get_marketers_byid($id)
	{
		//checkit
		$query=$this->db->query("SELECT name,type FROM youg_broker where type='subbroker'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}                                 
	function get_agents_byid($id)
	{
		//checkit
		$query=$this->db->query("SELECT name,type FROM youg_broker where type='subbroker'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}                                 
	function get_signupdates_byid($id)
	{
		//checkit
		$query=$this->db->query("SELECT name,type FROM youg_broker where type='subbroker'");
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}                                 
                             
                             
                             
                             
                             
                             
                             
                             
                             
                             
                              //END FOR CSV PROCESS	
	/*function brokersearch($keyword,$option,$from,$end,$singledate)
	{	
	 	if($option=='broker')
	 	{
			$this->db->select('*');
			$this->db->where('type', 'subbroker');
			$this->db->like('name', $keyword);		
			$query = $this->db->get('youg_broker');
			$check='';
			if($query->num_rows() > 0)
			{
				$check=$query->result_array();
			}
			return $check;
			
	    }
	 	
	 	if($option=='signupdate' && $singledate != '')
	 	{
		   	$this->db->select('*');
			$this->db->from('youg_broker');
			$this->db->where('signup =', $singledate);
		
			$query = $this->db->get();
            $check1='';
			if($query->num_rows() > 0)
			{
				$check1=$query->result_array();
			}
				
			return $check1;
	    }
	 	if($option=='signupdate') 
	 	{	   
			$this->db->select('*')
			        ->from('youg_broker')
					->where('signup >=', $from)
					->where('signup <=', $end);
				
            
			$query = $this->db->get();
			$this->db->last_query();
            $check11='';
            
			if($query->num_rows() > 0)
			{
				$check11=$query->result_array();
			}
			
			return $check11;
	    }
	 	
	 	if($option=='marketer')
	 	{
			$this->db->select('*');
			$this->db->where('type', 'marketer');
			$this->db->like('name', $keyword);		
			$query = $this->db->get('youg_broker');
            $check2='';
			if($query->num_rows() > 0)
			{
				$check2=$query->result_array();
			}
			
			return $check2;
	    }
	 	
	 	if($option=='agent')
	 	{
			$this->db->select('*');
			$this->db->where('type', 'agent');
			$this->db->like('name', $keyword);		
			$query = $this->db->get('youg_broker');
            $check2='';
			if($query->num_rows() > 0)
			{
				$check2=$query->result_array();
			}
			
			return $check2;
	    }
	}*/
	
	public function brokersearches($search_broker,$search_marketer,$search_agent,$from,$end)
	{
		
		if($search_broker != '' and $search_marketer =='' and $search_agent =='')
		{
			
			$this->db->select('*')
			         ->where(array('id'=>$search_broker,'type'=>'subbroker'));
			$query = $this->db->get('youg_broker');
			$check='';
			if($query->num_rows() > 0)
			{
				$check=$query->result_array();
			}
			return $check;
			
			
		}
		if($search_broker != '' and $search_marketer !='' and $search_agent =='')
		{
			
			$this->db->select('*')
			         ->where(array('id'=>$search_marketer,'type'=>'marketer','subbrokerid'=>$search_broker));
			$query = $this->db->get('youg_broker');
			$checks='';
			if($query->num_rows() > 0)
			{
				$checks=$query->result_array();
			}
			return $checks;
		
		}
		if($search_broker != '' and $search_marketer !='' and $search_agent !='')
		{
			
			$this->db->select('*')
			         ->where(array('id'=>$search_agent,'type'=>'agent','subbrokerid'=>$search_broker,'marketerid'=>$search_marketer));
			$query = $this->db->get('youg_broker');
			$checkss='';
			if($query->num_rows() > 0)
			{
				$checkss=$query->result_array();
			}
			return $checkss;
		
		}
		if($from != '' and $end == '')
		{
			$this->db->select('*')
			         ->where('registerdate =',$from);
		    $query = $this->db->get('youg_company');
		    $dates='';
		    if($query->num_rows() > 0)
		    {
				$dates=$query->result_array();
			}
			return $dates;
		}
		if($from != '' and $end != '')
		{
			$this->db->select('*')
			         ->where('registerdate >=',$from)
			         ->where('registerdate <=',$end);
		    $query = $this->db->get('youg_company');
		    $range='';
		    if($query->num_rows() > 0)
		    {
				$range=$query->result_array();
			}
			return $range;
		}
		
	}
		
	//Getting value for searching
	function brokersearch_count($keyword,$limit,$offset)
 	{
	  $query=$this->db->select('id')
                      ->from('youg_broker')
					  ->count_all_results();
	 			  
	  return $query;
 	}
 	/*
	function brokersearch_count($limit ='',$offset='',$sortby = 'id',$orderby = 'DESC')
 	{
	  switch($sortby)
		{
			case 'name' 	: $sortby = 'name';break;
			case 'id' 	: $sortby = 'id';break;
			default 		: $sortby = 'name';break;
		}
		
		//Ordering Data
		$this->db->order_by($sortby,$orderby);
		
		//Setting Limit for Paging
		if( $limit != '' && $offset == 0)
		{ $this->db->limit($limit); }
		else if( $limit != '' && $offset != 0)
		{	$this->db->limit($limit, $offset);	}
		
		//Executing Query
		$query = $this->db->get('youg_broker');
		$this->db->last_query();	
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 	}*/
 	
 	function get_subbroker_byid($id)
 	{
		//$query = $this->db->get_where('youg_subbroker', array('id' => $id));
		$query = $this->db->get_where('youg_broker', array('type'=>'subbroker','id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	
	}
 	function get_marketer_byid($id)
 	{
		
	    $query = $this->db->select('youg_broker.*, youg_company.brokerid, youg_company.brokertype, youg_company.marketerid, youg_company.subbrokerid')
                                                        ->from('youg_broker')
                                                        ->join('youg_company', 'youg_broker.id = youg_company.brokerid', 'left')
                                                        ->where(array('youg_company.brokertype'=>'marketer','youg_company.subbrokerid'=>$id))
                                                        ->get()                                
                                                        ->result_array();
          $marketer = array();
          $name ="";
          foreach($query as $q)
          {
			if($q['name'] != $name){
				$countquery = $this->db->query('select count(*) as brokercount from youg_company where brokerid='.$q['id'].'')->result_array();
				
				$marketer[$q['name']] = $countquery[0]['brokercount'];				
				$name = $q['name'];
			}
          }
          
        
          return $marketer;
		
	}
 	function get_marketerlist_byid($id)
 	{
		 $query = $this->db->get_where('youg_broker', array('type'=>'marketer','subbrokerid' => $id));
		 
		 if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
 
	}
 	function get_agent_byid($id)
 	{
		$query = $this->db->select('youg_broker.*, youg_company.brokerid, youg_company.brokertype, youg_company.marketerid, youg_company.subbrokerid')
							->from('youg_broker')
							->join('youg_company', 'youg_broker.id = youg_company.brokerid', 'left')
							->where(array('youg_company.brokertype'=>'agent','youg_company.subbrokerid'=>$id))
							->get()                                
							->result_array();
		                                             
         $agent = array();
         $name ="";
          foreach($query as $q)
          {
			if($q['name'] != $name){
				$countquery = $this->db->query('select count(*) as brokercount from youg_company where brokerid='.$q['id'].'')->result_array();
				
				$agent [$q['name']] = $countquery[0]['brokercount'];				
				$name = $q['name'];
			}
          }
          
        
          return $agent;
	
	}
 	
 	function get_agentlist_byid($id)
 	{
		 $query = $this->db->get_where('youg_broker', array('type'=>'agent','subbrokerid' => $id));
		 
		 if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
  
		
	
	}
 	
 	function get_elitecount_subbroker_byid($id)
 	{
		$query = $this->db->get_where('youg_company', array('brokertype'=>'subbroker','brokerid' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	
	}
 	
 	function get_elitecount_marketer_byid($id)
 	{
		
		$query = $this->db->get_where('youg_company', array('brokertype'=>'marketer','subbrokerid' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	
	}
 	
 	function get_elitecount_agent_byid($id)
 	{
		$query = $this->db->get_where('youg_company', array('brokertype'=>'agent','subbrokerid' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
	
	}
	
	function get_subbrokertree($id)
	{
		$query = $this->db->get_where('youg_broker', array('type'=>'subbroker','id' => $id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function get_subbrokersales($id)
	{
		$query = $this->db->get_where('youg_company', array('brokertype'=>'subbroker','brokerid' => $id,'subbrokerid'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function get_total_elite_sales($id)
	{
		$query = $this->db->get_where('youg_company', array('subbrokerid'=>$id));
		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function get_marketertree()
	{
		
		
		/*result expected      
		        
		 
		 adrian                  2            4
		    ---mason             2
		
		 adam                    1            5
		    ---martin            4 
		 
		*/
		
		/* return $query = $this->db->select('yob.*,yoc.brokerid, yoc.brokertype, yoc.company, yoc.marketerid, yoc.subbrokerid')
                                                        ->from('youg_broker yob')
                                                        ->join('youg_company yoc','yob.id = yoc.brokerid', 'left')
                                                        ->get()                                
                                                        ->result_array();
          //echo $this->db->last_query();
		 //echo "<pre>";print_r($query);*/
		
		//Now checked
		return $query=$this->db->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid')
								->from('youg_broker yb')
								->join('youg_company yc','yb.id = yc.brokerid and yc.brokertype = yb.type','left')
								//->group_by('yb.name')
								->order_by('yb.id','asc')
								->get()
								->result_array();
		
		
		
		
		
	}
 	
 	
 	/*function brokersearch($keyword,$option)
 	{
		
		if(trim($option)=='signupdate')
		{
			$this->db->select('*');
			$this->db->like('signup',$keyword);		
			$query = $this->db->get('youg_subbroker');

			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			else
			{
				return array();
			}
			
	    }
		if(trim($option)=='broker')
		{
			$this->db->select('*');
			$this->db->like('name',$keyword);		
			$query = $this->db->get('youg_subbroker');

			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			else
			{
				return array();
			}
			
	    }
		if(trim($option)=='marketer')
		{
			$this->db->select('*');
			$this->db->like('marketer',$keyword);		
			$query = $this->db->get('youg_subbroker');

			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			else
			{
				return array();
			}
			
	    }
		if(trim($option)=='agent')
		{
			$this->db->select('*');
			$this->db->like('agent',$keyword);		
			$query = $this->db->get('youg_subbroker');

			if ($query->num_rows() > 0)
			{
				return $query->result_array();
			}
			else
			{
				return array();
			}
			
	    }
		
	
	}*/
			
	function elitemembers()
 	{
   	   	return $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.brokerid and yb.type = yc.brokertype','left')
		->get()
		->result_array();		
 	}
 	function agentelitemembers()
 	{
   	   	return $this->db
   	   	->select('yb.name ybname,yb.id ybid,yc.company yccompany,yc.email ycemail,yc.phone ycphone,yc.brokertype yctype,yb.type ybtype,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yb.marketerid ybmarketerid')
		->from('youg_broker yb')
		->join('youg_company yc','yb.id = yc.brokerid and yb.type = yc.brokertype and yb.subbrokerid = yc.subbrokerid and yb.marketerid = yc.marketerid','left')
		->get()
		->result_array();		
 	}
		
	
}
?>
