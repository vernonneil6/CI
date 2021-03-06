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
		$query = $this->db->query("SELECT c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.siteurl,c.contactname,c.contactphonenumber,c.contactemail,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='subbroker' and youg_broker.type='subbroker') as subbroker,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='marketer' and youg_broker.type='marketer') as marketer,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='agent' and youg_broker.type='agent') as agent,c.acquisitiontype,e.payment_date,s.expires,e.status,'-',s.amount,e.discountcode,c.notes FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Enable'");
	
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
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.siteurl,c.contactname,c.contactphonenumber,c.contactemail,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='subbroker' and youg_broker.type='subbroker') as subbroker,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='marketer' and youg_broker.type='marketer') as marketer,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='agent' and youg_broker.type='agent') as agent,c.acquisitiontype,e.payment_date,s.expires,e.status,'-',s.amount,e.discountcode,c.notes FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
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
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.siteurl,c.contactname,c.contactphonenumber,c.contactemail,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='subbroker' and youg_broker.type='subbroker') as subbroker,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='marketer' and youg_broker.type='marketer') as marketer,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='agent' and youg_broker.type='agent') as agent,c.acquisitiontype,e.payment_date,s.expires,e.status,'-',s.amount,e.discountcode,c.notes FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id ");
		
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
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.siteurl,c.contactname,c.contactphonenumber,c.contactemail,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='subbroker' and youg_broker.type='subbroker') as subbroker,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='marketer' and youg_broker.type='marketer') as marketer,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='agent' and youg_broker.type='agent') as agent,c.acquisitiontype,e.payment_date,s.expires,e.status,'-',s.amount,e.discountcode,c.notes FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Enable'");
		
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
		$query = $this->db->query("SELECT  c.company,c.streetaddress,c.city,c.state,c.zip,c.phone,c.categoryid,c.siteurl,c.contactname,c.contactphonenumber,c.contactemail,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='subbroker' and youg_broker.type='subbroker') as subbroker,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='marketer' and youg_broker.type='marketer') as marketer,(select group_concat(name separator ', ')  from youg_broker where youg_broker.id=c.brokerid and c.brokertype='agent' and youg_broker.type='agent') as agent,c.acquisitiontype,e.payment_date,s.expires,e.status,'-',s.amount,e.discountcode,c.notes FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id where e.status='Disable'");
		
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
	function new_subbrokerdetails($id,$type)
	{
	 	if($type=="subbroker")
	 	{
	 	 $where = "(`brokerid` = '".$id ."' OR `subbrokerid` = '".$id."')";
	     
	    } else if($type=="marketer") {
			
			$where = "(`brokerid` = '".$id ."' OR `marketerid` = '".$id."')";
		
		} else { 
			 
			$where = "(`brokerid` = '".$id ."' OR `brokertype` = '".$type."')"; 
			
		 }	
			
	 	$query=$this->db->select('yc.contactname yccname,yc.company yccompany,yc.contactphonenumber ycphone,yc.email ycemail,yc.registerdate ycreg,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yc.brokerid ycbrokerid,ys.subscr_id yssubscr_id,ys.payment_date yspay,ys.expires ysexp,yc.status ycstatus')
						   ->from('youg_company yc') 
						   ->join('youg_subscription ys', 'ys.company_id=yc.id', 'left')
						   ->where($where)
						   	->get()
							->result_array(); 
        
        $i=0;
        foreach($query as $q)
        {
		  if($q['yssubscr_id']!= null)
			{	
				$countquery = $this->db->query('select count(*) as payment_count from youg_silent where subscription_id="'.$q['yssubscr_id'].'"')->result_array();	
				if(count($countquery) > 0)
				{
				 $query[$i]['pcount']=$countquery[0]['payment_count'];
			    }
			}
			else
			{
				$query[$i]['pcount']='-'; 
				$query[$i]['ycstatus']='Disable';
			}
			unset($query[$i]['yssubscr_id']);
			$query[$i]['ycreg']=date('m/d/Y',strtotime($q['ycreg']));
			$query[$i]['yspay']=date('m/d/Y',strtotime($q['yspay']));
			$query[$i]['ysexp']=date('m/d/Y',strtotime($q['ysexp']));
			if(isset($q['ycsubbrokerid']))
			{
				$subname=$this->db->query('select name from youg_broker where id='.$q['ycsubbrokerid'].'')->result_array();
				$query[$i]['ycsubbrokerid']=$subname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycsubbrokerid']=$q['ycsubbrokerid'];
			}
			 
			if($q['ycmarketerid'] != null)
			{
    			$mname=$this->db->query('select name from youg_broker where id='.$q['ycmarketerid'].'')->result_array();
				$query[$i]['ycmarketerid']=$mname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycmarketerid']='-';
			}
			if($q['ycbrokerid'] != null)
			{
				$aname=$this->db->query('select name from youg_broker where id='.$q['ycbrokerid'].' and type="agent"')->result_array();
				$query[$i]['ycbrokerid']=$aname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycbrokerid']='-';
			}
			
		    $query[$i]['dummyid']='ABC#';
			$i++;
		 
		}
		
	   return $query;	
		
	}
	
	
	function get_subbrokermarketerdetails_byid($id)
	{	
		
		$query = $this->db->query("select yb.name name,yb.type type,yb.marketer no_of_marketers,yb.agent no_of_agents,yb.signup signup,(select count(*) from youg_company yc where yc.brokertype='marketer' and yc.brokerid = yb.id and yc.subbrokerid =".$id." ) as individual_elites ,(select count(*) from youg_company yc where yc.brokertype='marketer' and yc.brokerid = yb.id and yc.subbrokerid =".$id." ) as total_elites ,yb.id as ybid from youg_broker yb left join youg_company yc on yc.brokerid = yb.id and yb.type = 'marketer' and yc.brokertype = 'marketer' where yb.subbrokerid=".$id." and yc.subbrokerid=".$id." group by yb.id");		
		if ($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return array();
		}
		
	}
	function get_subbrokeragentdetails_byid($id)
	{	
		
		$query = $this->db->query("select yb.name name,yb.type type,yb.marketer no_of_marketers,yb.agent no_of_agents,yb.signup signup,(select count(*) from youg_company yc where yc.brokertype='agent' and yc.marketerid = yb.marketerid and yc.brokerid = yb.id and yc.subbrokerid =".$id." ) as individual_elites ,(select count(*) from youg_company yc where yc.brokertype='agent' and yc.marketerid = yb.marketerid and yc.brokerid = yb.id and yc.subbrokerid =".$id." ) as total_elites,yc.marketerid  ycmarketerid from youg_broker yb left join youg_company yc on yc.brokerid = yb.id and yc.marketerid = yb.marketerid and yb.type = 'agent' and yc.brokertype = 'agent' where yb.subbrokerid=".$id." and yc.subbrokerid=".$id." group by yb.id");		
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
                             
  
	public function brokersearches($search_broker,$search_marketer,$search_agent,$from,$end,$limit='',$offset='')
	{
		if($search_broker != '' and $search_marketer =='' and $search_agent =='' and $from =='')
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
		if($search_broker != '' and $search_marketer !='' and $search_agent =='' and $from =='')
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
		if($search_broker != '' and $search_marketer !='' and $search_agent !='' and $from =='')
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
		if($from != '' and $end == '' and $search_broker ==0 and $search_marketer ==0 and $search_agent ==0 )
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
		if($from != '' and $end != '' and $search_broker ==0 and $search_marketer ==0 and $search_agent ==0)
		{
			//Setting Limit for Paging
			if( $limit != '' && $offset == 0)
			{ $this->db->limit($limit); }
			else if( $limit != '' && $offset != 0)
			{	$this->db->limit($limit, $offset);	}
		
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
	
	
		//single date search
		if($from != '' and $end =='')
		{		 	
		   if($search_broker !='')
		   {
		   	$where="(`brokerid` = ".$search_broker." OR `subbrokerid` = ".$search_broker." )";
		 	$this->db->select('*')
			         ->where($where)
			         ->where(array('registerdate ='=>$from));
			$query = $this->db->get('youg_company');
		    }
		    if($search_marketer !='')
		    {
			$where="(`brokerid` = ".$search_marketer." OR `marketerid` = ".$search_marketer." )";
		 	$this->db->select('*')
			         ->where($where)
			         ->where(array('registerdate ='=>$from));
			$query = $this->db->get('youg_company');	
			}
		    if($search_agent !='')
		    {
			$where="(`brokerid` = ".$search_agent." OR `brokertype` = 'agent' )";
		 	$this->db->select('*')
			         ->where($where)
			         ->where(array('registerdate ='=>$from));
			$query = $this->db->get('youg_company');	
			}
		    
		    $this->db->last_query();
		    $sub_date='';
		    if($query->num_rows() > 0)
		    {
				$sub_date=$query->result_array();
			}
			return $sub_date;
		}
			
		
		//multi date search
		if($from != '' and $end !='')
		{
		   
		   if($search_broker !='')
		   {
			
			$where="(`brokerid` = ".$search_broker." OR `subbrokerid` = ".$search_broker." )";   	
		 	$this->db->select('*')
			         ->where($where)
			         ->where('registerdate >=',$from)
			         ->where('registerdate <=',$end);
			$query = $this->db->get('youg_company');
			
		    }
		  else if($search_marketer !='')
		   {
			$where="(`brokerid` = ".$search_marketer." OR `marketerid` = ".$search_marketer." )";   		
		 	$this->db->select('*')
			         ->where($where)
			         ->where('registerdate >=',$from)
			         ->where('registerdate <=',$end);
			$query = $this->db->get('youg_company');
			
		    }
		   else if($search_agent !='')
		   {	
		 	$where="(`brokerid` = ".$search_agent." AND `brokertype` = 'agent' )";   		
		 	$this->db->select('*')
			         ->where($where)
			         ->where('registerdate >=',$from)
			         ->where('registerdate <=',$end);
			$query = $this->db->get('youg_company');
			
		    }
		    
		    
		    $totalsub_date='';
		    if($query->num_rows() > 0)
		    {
				$totalsub_date=$query->result_array();
			}
			return $totalsub_date;
		}
		
	}
		
	//Getting value for searching
	function brokersearch_count($keyword,$limit,$offset)
 	{

	  $keyword = str_replace('-',' ', $keyword);
	  $this->db->like('name',$keyword);
	  $this->db->from('youg_broker');
	  $query = $this->db->count_all_results();

	  return $query;
 	}
 	
 	function get_subbroker_byid($id)
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
 	function get_marketer_byid($id)
 	{
		
	    $query = $this->db->select('youg_broker.*, youg_company.brokerid, youg_company.brokertype, youg_company.marketerid, youg_company.subbrokerid')
                                                        ->from('youg_broker')
                                                        ->join('youg_company', 'youg_broker.id = youg_company.brokerid', 'left')
                                                        ->where(array('youg_company.brokertype'=>'marketer','youg_company.marketerid'=>$id))
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
	
	function signbtndate($from,$to,$mid,$type)
 	{
		
		if($to == $from){
			$where = "`registerdate` >= '".$from."'";
		}
		else{
			$where = "(`registerdate` >= '".$from ."' AND `registerdate` <= '".$to."')";
		}
		
		if($mid!="" && $type=="subbroker") 
		{
			$where .= " AND (`brokerid` ='".$mid."' or `subbrokerid`='".$mid."')"; 
		}
		
		else if($mid!="" && $type=="marketer") 
		{ 
			$where .= " AND (`brokerid` ='".$mid."' or `marketerid`='".$mid."')"; 
		}
		
		else if($mid!="" && $type=="agent")
		{ 
			$where .= " AND (`brokerid` ='".$mid."' or `brokertype`='".$type."')"; 
		}
		
		$query=$this->db->select('yc.contactname yccname,yc.company yccompany,yc.contactphonenumber ycphone,yc.email ycemail,yc.registerdate ycreg,yc.subbrokerid ycsubbrokerid,yc.marketerid ycmarketerid,yc.brokerid ycbrokerid,ys.subscr_id yssubscr_id,ys.payment_date yspay,ys.expires ysexp,yc.status ycstatus')
						   ->from('youg_company yc') 
						   ->join('youg_subscription ys', 'ys.company_id=yc.id', 'left')
						   ->where($where)
						   ->get()
						   ->result_array();
		$i=0;
        foreach($query as $q)
        {
		   if($q['yssubscr_id']!= null)
			{	
				$countquery = $this->db->query('select count(*) as payment_count from youg_silent where subscription_id="'.$q['yssubscr_id'].'"')->result_array();	
				if(count($countquery) > 0)
				{
				$query[$i]['pcount']=$countquery[0]['payment_count'];
			    }
			}
			else
			{
				$query[$i]['pcount']='-'; 
				$query[$i]['ycstatus']='Disable';
			}
			unset($query[$i]['yssubscr_id']);
			$query[$i]['ycreg']=date('m/d/Y',strtotime($q['ycreg']));
			$query[$i]['yspay']=date('m/d/Y',strtotime($q['yspay']));
			$query[$i]['ysexp']=date('m/d/Y',strtotime($q['ysexp']));
			if(isset($q['ycsubbrokerid']))
			{
				$subname=$this->db->query('select name from youg_broker where id='.$q['ycsubbrokerid'].'')->result_array();
				$query[$i]['ycsubbrokerid']=$subname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycsubbrokerid']=$q['ycsubbrokerid'];
			}
			 
			if($q['ycmarketerid'] != null)
			{
				$mname=$this->db->query('select name from youg_broker where id='.$q['ycmarketerid'].'')->result_array();
				$query[$i]['ycmarketerid']=$mname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycmarketerid']='-';
			}
			if($q['ycbrokerid'] != null)
			{
				$aname=$this->db->query('select name from youg_broker where id='.$q['ycbrokerid'].' and type="agent"')->result_array();
				$query[$i]['ycbrokerid']=$aname[0]['name'];
				
		    }
		    else
		    {
				$query[$i]['ycbrokerid']='-';
			}
			
		    $query[$i]['dummyid']='ABC#';
			$i++;
		 
		}
		
	return $query;		
		
	}
	function total_elite()
	{
		$query = $this->db->query("SELECT c.contactname yccname,c.company yccompany,c.contactphonenumber ycphone,c.email ycemail,c.registerdate ycreg,c.subbrokerid ycsubbrokerid,c.marketerid ycmarketerid,c.brokerid ycbrokerid,s.subscr_id yssubscr_id,s.payment_date yspay,s.expires ysexp,e.status ycstatus FROM youg_elite e LEFT JOIN youg_company c ON c.id = e.company_id LEFT JOIN youg_subscription s ON c.id = s.company_id")->result_array();			    
        $i=0;
        $total_elites = array(); 
        foreach($query as $query_data)  
        {
			$q=array_filter($query_data);
			
			if($q['yssubscr_id']!= null)
				{	
					$countquery = $this->db->query('select count(*) as payment_count from youg_silent where subscription_id="'.$q['yssubscr_id'].'"')->result_array();	
								
					if(count($countquery) > 0)
					{
						$total_elites[$i] = $query_data;	
						$total_elites[$i]['pcount']=$countquery[0]['payment_count'];
						$total_elites[$i]['dummyid']='ABC#';
						$total_elites[$i]['ycreg']=date('m/d/Y',strtotime($q['ycreg']));
						$total_elites[$i]['yspay']=date('m/d/Y',strtotime($q['yspay']));
						$total_elites[$i]['ysexp']=date('m/d/Y',strtotime($q['ysexp']));
					}
					
				}
			if(isset($q['ycsubbrokerid']))
			{
				$subname=$this->db->query('select name from youg_broker where id='.$q['ycsubbrokerid'].'')->result_array();
				$total_elites[$i]['ycsubbrokerid']=$subname[0]['name'];
				
		    }
		    
			 
			if($q['ycmarketerid'] != null)
			{
				$mname=$this->db->query('select name from youg_broker where id='.$q['ycmarketerid'].'')->result_array();
				$total_elites[$i]['ycmarketerid']=$mname[0]['name'];
				
		    }
		   
			if($q['ycbrokerid'] != null)
			{
				$aname=$this->db->query('select name from youg_broker where id='.$q['ycbrokerid'].' and type="agent"')->result_array();
				$total_elites[$i]['ycbrokerid']=$aname[0]['name'];
				
		    }
		   
				
			unset($total_elites[$i]['yssubscr_id']);
			$i++;
			
        }
      	
	   return $total_elites;	

	}
	
	public function report_count()
	{
	    $query=$this->db->select('*')
						->from('youg_company c')
						->join('youg_broker b', 'c.brokerid = b.id', 'left')
						->get()
						->num_rows();
	    return $query;    
		
	}
 	
}
?>
