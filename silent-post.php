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
	$check_jamcode = "SELECT * FROM `youg_subscription` WHERE `subscr_id` = '".$sub_id."'";
	$result = mysql_query($check_jamcode,$con);
	$jamcode_arr = mysql_fetch_assoc($result);
	if(!empty($jamcode_arr['jamcode']) && $paynumber > 1 && $paynumber != ''){
		$getdata = file_get_contents('http://www.yougotrated.com/affiliates/sale/amount/' . trim($amt) . '/trans_id/' . trim($transaction_id) . '/tracking_code/' . $jamcode_arr['jamcode'].'/program_id/2');
	} elseif(!empty($jamcode_arr['jamcode']) && $paynumber <= 1 && $paynumber != ''){
		$getdata = file_get_contents('http://www.yougotrated.com/affiliates/sale/amount/' . trim($amt) . '/trans_id/' . trim($transaction_id) . '/tracking_code/' . $jamcode_arr['jamcode'].'/program_id/1');
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

