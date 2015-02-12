<?php
include_once "db.php";
$sql = "SELECT id,company_id FROM youg_elite";
$page_no = $_REQUEST['page_no'];
$filename ='coapany_details_';
$foldername = 'sitemap';
if(empty($page_no)){
	$page_no = 0;
}
$start_id = $page_no * $rowcount; 
$sql = "SELECT * FROM `youg_company` LIMIT $start_id , $row_count";
$result = $conn->query($sql);
$conn->close();

if ($result->num_rows > 0) {
	$response ='<?xml version="1.0" encoding="UTF-8"?>';
	$response .='<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		while($row = $result->fetch_assoc()) {
			$response .='<url>';
			$response .='<loc>http://yougotrated.com/company/'.htmlentities($row["companyseokeyword"]).'/reviews/coupons/complaints</loc>'; 
			$response .='</url>';
		}
	$response .='</urlset>';
	file_put_contents($foldername."/".$filename.$page_no.".xml", $response);	 
}

?> 
