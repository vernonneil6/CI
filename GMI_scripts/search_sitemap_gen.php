<?php
include_once "db.php";
$sql = "SELECT id,company_id FROM youg_elite";
$page_no = $_REQUEST['page_no'];


if(empty($page_no)){
	$page_no = 0;
}
$start_id = $page_no * $row_count; 
$sql = "SELECT * FROM `youg_company` order by id asc LIMIT $start_id , $row_count ";
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
	file_put_contents($foldername."/".$company_filename.$page_no.".xml", $response);
	
	$file = "http://".$_SERVER['SERVER_NAME']."/GMI_scripts/".$foldername."/".$company_filename.$page_no.".xml";	
	
	// Name of the gz file we're creating
	$gzfile = $gzfoldername."/".$company_filename.$page_no.".xml".".gz";
	
	// Open the gz file (w9 is the highest compression)
	$fp = gzopen ($gzfile, 'w9');
	
	// Compress the file
	gzwrite ($fp, file_get_contents($file));
	
	// Close the gz file and we're done
	gzclose($fp);

	 
}
echo "done";
?> 
