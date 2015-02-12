<?php 
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
$row_count = 25000;
$no_of_rows = 0;
?>
