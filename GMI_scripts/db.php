<?php 
if($_SERVER['SERVER_NAME'] == 'www.yougotrated.writerbin.com'){
	$servername = "localhost";
	$username = "mxiind_hitesh";
	$password = "vS^T+ymX)~)P";
	$dbname = "mxiind_yougotrated";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$row_count = 49000;
	$no_of_rows = 0;
}elseif($_SERVER['SERVER_NAME'] == 'www.yougotrated.com' || $_SERVER['SERVER_NAME'] == 'yougotrated.com'){
	$servername = "localhost";
	$username = "root";
	$password = "ygrmysql";
	$dbname = "mxiind_yougotrated";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$row_count = 49000;
	$no_of_rows = 0;
}else{
	echo "DB Connection Failed"
}
?>
