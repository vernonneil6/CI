<?php 
//echo '<pre>';
//print_r($_POST);
$captured=$_POST;
$valuereturn=serialize($captured);


//Added to db for later check
$sub_id=$captured['x_subscription_id'];
$amt=$captured['x_amount'];	
$name=$captured['x_first_name'];
$transaction_id=$captured['x_trans_id'];
$transaction_status=$captured['x_response_reason_text'];
$paynumber=$captured['x_subscription_paynum'];
$date=date('Y-m-d H:i:s'); 
if(trim($transaction_status) =='This transaction has been approved.'){
				$tn_status=1;
			} else {
				$tn_status=0;
			}
//$con = mysql_connect('localhost','root','testenv');
//$con = mysql_connect('localhost','mxiind_hitesh','vS^T+ymX)~)P');
$con = mysql_connect('localhost','root','ygrmysql');
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 
//mysql_select_db("youg", $con);
mysql_select_db("mxiind_yougotrated", $con);


$sql="INSERT INTO youg_silent (subscription_id, amount,name,transaction_id,transaction_status,subscription_paynumber,dateofreturn,serialized_data) 
                                               VALUES('$sub_id','$amt','$name','$transaction_id','$tn_status','$paynumber','$date','$valuereturn')";
 //VALUES($sub_id,$amt,$name,$transaction_id,$transaction_status,$paynumber,$date)";
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

if($sql!='')
{
 if($tn_status==1 && $sub_id != ''){
	 $tn_status=1;
	 $expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
	 $query="UPDATE youg_subscription SET `payment_date`='$date',`expires`='$expires',`datereturn`='$date' , `transactionstatus`='$tn_status' , `transactionresponse`='$transaction_status' WHERE subscr_id='$sub_id'";
	 $jamcode_arr = array();
	$check_jamcode = "SELECT * FROM `youg_subscription` LEFT JOIN `youg_company` on `youg_company`.`id` = `youg_subscription`.`company_id` WHERE `youg_subscription`.`subscr_id` = '".$sub_id."'";
	$result = mysql_query($check_jamcode,$con);
	$jamcode_arr = mysql_fetch_assoc($result);
	if(!empty($jamcode_arr['jamcode']) && $paynumber > 1 && $paynumber != ''){
		$jamcode = $jamcode_arr['jamcode'];
		$explode_result = explode('-',$jamcode);
		if(!empty($explode_result[2])){
			$query_result = '';
			$query = mysql_query("SELECT `member_id` FROM `jam_members` WHERE `username` = '".$explode_result[2]."' LIMIT 1",$con);
			$query_result = mysql_fetch_assoc($query);

			if(!empty($query_result)){
				$group_query_result = '';
				$groupid = '';
				$group_query = mysql_query("SELECT * FROM `jam_members_groups` WHERE `member_id` = '".$query_result['member_id']."' LIMIT 1",$con);
				$group_query_result = mysql_fetch_assoc($group_query);
				
				if(!empty($group_query_result)){
					$groupid = $group_query_result['group_id'] + 1;
					$update_group_query = mysql_query("UPDATE `jam_members_groups` SET `group_id` = '".$groupid."' WHERE `member_id` = '".$query_result['member_id']."'",$con);

					$getdata = file_get_contents('http://www.yougotrated.com/affiliates/sale/amount/' . trim($amt) . '/trans_id/' . trim($transaction_id) . '/tracking_code/' . $jamcode_arr['jamcode'] . '/customer_name/' . trim(urlencode($jamcode_arr['company'])));
					
					$groupid = $groupid - 1;
					$update_group_query = mysql_query("UPDATE `jam_members_groups` SET `group_id` = '".$groupid."' WHERE `member_id` = '".$query_result['member_id']."'",$con);
				}
			}

		}		
	} elseif(!empty($jamcode_arr['jamcode']) && $paynumber <= 1 && $paynumber != ''){
		$getdata = file_get_contents('http://www.yougotrated.com/affiliates/sale/amount/' . trim($amt) . '/trans_id/' . trim($transaction_id) . '/tracking_code/' . $jamcode_arr['jamcode'] . '/customer_name/' . trim(urlencode($jamcode_arr['company'])));
	}
 } else {
	 $tn_status=0;
	 $query="UPDATE youg_subscription SET `expires`='$date',`expireflag`='1',`datereturn`='$date' , `transactionstatus`='$tn_status' ,`transactionresponse`='$transaction_status' WHERE subscr_id='$sub_id'";	  
   }
}

if (!mysql_query($query,$con)){
  die('Error: ' . mysql_error());
  }
 
mysql_close($con)
?>

