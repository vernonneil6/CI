<?php 
echo '<pre>';
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
 if($tn_status==1){
	 $tn_status=1;
	 $expires = date('Y-m-d H:i:s', strtotime("+$time Month"));
	 $paymentdate =date("Y-m-d H:i:s");
	 $query="UPDATE youg_subscription SET `payment_date`='$paymentdate',`expires`='$expires',`datereturn`='$date' , `transactionstatus`='$tn_status' , `transactionresponse`='$transaction_status' WHERE subscr_id='$sub_id'";
 } else {
	 $tn_status=0;
	 $query="UPDATE youg_subscription SET `datereturn`='$date' , `transactionstatus`='$tn_status' ,`transactionresponse`='$transaction_status' WHERE subscr_id='$sub_id'";	  
   }
}

if (!mysql_query($query,$con)){
  die('Error: ' . mysql_error());
  }
 
mysql_close($con)
?>

