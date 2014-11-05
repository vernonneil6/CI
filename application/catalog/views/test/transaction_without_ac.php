<html>
<head>
<title>BTC Transaction Without A/C</title>
</head>
<body>
<div>
<h2>Transaction Without A/C in BlockChain</h2>
</div>
<div>
<form action="" method="post">
<label>Enter Sender Address</label>
<input type="text" name="sender_addr" id="sender_addr" /><br/>
<label>Enter sender Privet key</label>
<input type="text" name="sender_key" id="sender_key" /><br/>

<label>Enter Receiver Address</label>
<input type="text" name="reciver_addr" id="reciver_addr" /><br/>

<label>Enter Amount To Transfer:</label>
<input type="text" name="amount" id="amount" /><br/>

<button type="submit" name="submit" id="submit">Send</button>
</form>
</div>
</body>
</html>

<?php
if(isset($_POST['submit']))
{	//convert amount in santoshi
	$amount=$_POST['amount']*10000000;
	$sender_addr=$_POST['sender_addr'];
	$reciver_addr=$_POST['reciver_addr'];
	$privet_key=$_POST['sender_key'];
	
	$json_url = "https://blockchain.info/merchant/$privet_key/payment?to=$reciver_addr&amount=$amount&from=$sender_addr";
		
		$json_data = file_get_contents($json_url);
		
		$json_feed = json_decode($json_data);
		if($json_feed->error)
		{
			echo 'Error: '.$json_feed->error;
		}
		else
		{
			$message = $json_feed->message;
			$txid = $json_feed->tx_hash;
			echo 'Message: '.$message;
			echo 'Transaction Id: '.$txid;
		}
}
?>