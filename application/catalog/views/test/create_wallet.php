<?php
 if(isset($_POST['submit']))
 {
	 $apicode='';
	 $password=$_POST['password'];
	 
	 $json_url = "https://blockchain.info/api/v2/create_wallet?password=$password";

$json_data = file_get_contents($json_url);

$json_feed = json_decode($json_data);
print_r ($json_feed);
 }
?>
<html>
<head>
<title>
Create Wallet
</title>
</head>
<body>
<div>
<h2>Create New Wallet At BlockChain</h2>
</div>
<form action="https://blockchain.info/api/v2/create_wallet" method="post">
<label>Password:</label>
<input type="password" name="password" id="password"  />
<button type="submit" name="submit" id="submit">Create</button>
</form>
</body>
</html>