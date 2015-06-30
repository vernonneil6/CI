<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Searchs extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
	
    }

    public function get_autocompletes($name,$city)
    {
		$this->db->distinct();
        $this->db->select('company')->from('company');
        $this->db->where('status','Enable');
        $this->db->like('city', $city);
        $this->db->where('company', $name);
        $this->db->or_where('streetaddress', $name);
        $this->db->or_where('city', $name);
        //$this->db->like('company', $name,'after');//after=a% before=%a
        //$this->db->like('city', $city);
        $this->db->limit(20);
		$query = $this->db->get();
        if ($query->num_rows() > 0)
		{
			  $querys=$query->result();
			  echo "<ul>";
			
			  foreach ($querys as $row => $result)
				{
					$vals=$result->company;
					$val1=str_replace('"'," ",$vals);
					$val=str_replace("'"," ",$val1);
					
					?><li onclick='fill("<?php echo $val;?>")'><?php echo $val;?></li>
					
					<?php //$vals[]=$value;
				}
				echo "</ul>";
				//print_r($val);
				die();
				//$val=str_replace('"'," ",$vals);
				//$val=str_replace("'"," ",$vals);
				//return 	json_encode($val);
				//return 	$val;
		
		}
		else
		{
			$this->db->distinct();
			$this->db->select('company')->from('company');
			$this->db->where('status','Enable');
			$this->db->like('city', $city);
			$this->db->or_like('company', $name);
			$this->db->or_like('streetaddress', $name);
			$this->db->or_like('city', $name);
			$this->db->limit(20);
			$query = $this->db->get();
			$querys=$query->result();
			foreach ($querys as $row => $result)
			{
				$vals=$result->company;
				$val1=str_replace('"'," ",$vals);
				$value=str_replace("'"," ",$val1);
				$suggestions[]=$value;
			}
			
			$misspelled=$search_data;
			
			 // Firstly order an array based on levenshtein
			$levenshtein_ordered = array();
			foreach ( $suggestions as $suggestion )
			{
				$levenshtein_ordered[$suggestion] = levenshtein($misspelled,$suggestion);
			}
				asort($levenshtein_ordered, SORT_NUMERIC );
				 echo "<ul>";
				 
				 echo "<li style='cursor:none;'><b>Did You mean ?</b></li>";
				while($element = current($levenshtein_ordered)) 
				{
					?><li onclick='fill("<?php echo key($levenshtein_ordered);?>")'><?php echo key($levenshtein_ordered);?></li>
					
					<?php 
					//$val.="<li>". key($levenshtein_ordered)."</li>";
					next($levenshtein_ordered);
				}
				echo "</ul>";
				print_r($val);
				die();
				//$val=str_replace('"',"",$vals);
				//$val=str_replace("'"," ",$vals);
				
				//$atr=array_slice($val, 0, 3);
				//print_r($atr);
				
				return 	json_encode($atr);
				
			
		}
		
	}
    
    
}

?>
