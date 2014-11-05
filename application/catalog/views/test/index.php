<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Crypto Demo</title>
</head>
<?php $guid='d2b17b55-666c-4143-a5c6-27790d19b076';
$main_password='kishan123456';
?>
<?php 
if(isset($_POST["submit"]))
{
	$bitcoin_address=$_POST['address'];
	
	header('Location:http://blockchain.info/address/'.$bitcoin_address.'?format=json');
}
?>
<body>
<div>
  <h2>Crypto Demo(Blockchain.info API)</h2>
</div>
<a href="<?php echo 'https://blockchain.info/merchant/'.$guid.'/new_address?password='.$main_password;?>">Generate Address</a> &nbsp;|&nbsp; <a href="<?php echo 'https://blockchain.info/merchant/'.$guid.'/balance?password='.$main_password;?>">Fetch wallet Balance</a> &nbsp;|&nbsp; <a href="<?php echo 'https://blockchain.info/merchant/'.$guid.'/list?password='.$main_password;?>">Listing Address</a> &nbsp;|&nbsp; <a href="test/transaction">Transaction With A/C in BlockChain</a>&nbsp;|&nbsp; <a href="test/transaction_without_ac">Make transaction without A/C in BlockChain</a>
</body>
</html>
