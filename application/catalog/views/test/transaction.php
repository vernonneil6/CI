<?php
	if(isset($_POST['submit']))
	{
	
		$guid="d2b17b55-666c-4143-a5c6-27790d19b076";
		$main_password="kishan123456";
		$amount = ($_POST['btc_amt'])*(100000000);
		$from = "13N4jbH4Yd775dtAbjsjtr7hxcQQ1fad5q";
		$to=$_POST['btc_addr'];
		
		$json_url = "https://blockchain.info/merchant/$guid/payment?password=$main_password&to=$to&amount=$amount&from=$from";
		
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
<html>
<head>
<title>BTC Transaction</title>
</head>
<body>
<div>
<h2>BTC Transaction</h2>
</div>
<div>
<form action="" method="post">
<label>Enter Address:</label>
<input type="text" name="btc_addr" id="btc_addr" placeholder="Enter BTC Address" />
<label>Enter Amount:</label>
<input type="text" name="btc_amt" id="btc_amt" placeholder="Enter Amount In BTC" />
<button type="submit" name="submit" id="submit">Send</button>
</form> 
</div>
</body>
</html>