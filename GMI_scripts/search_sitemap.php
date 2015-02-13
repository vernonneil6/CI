<?php 
include_once "db.php";
$sql = "SELECT count(*) FROM youg_company";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$no_of_rows = $row['count(*)'];
	$limit = intval($no_of_rows / $row_count) + 1;	 
?>
<script>
var limit = <?php echo $limit; ?>;
for(var i= 0;i<limit;i++){
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
    }
}

	xmlhttp.open("GET","http://<?php echo $_SERVER['SERVER_NAME']; ?>/GMI_scripts/search_sitemap_gen.php?page_no="+i,true);
	xmlhttp.send();
}

</script>
<div id="myDiv">Sitemap Generating ...</div>
<?php 


$response ='<?xml version="1.0" encoding="UTF-8"?>';
$response .='<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
for($i=0;$i<$limit;$i++){
	$response .='<sitemap>';
	$response .="<loc>http://".$_SERVER['SERVER_NAME']."/GMI_scripts/".$gzfoldername.'/'.$company_filename.$i.".xml.gz</loc>";
	$response .='<lastmod>'.date('Y-m-d').'</lastmod>';
	$response .='</sitemap>';
}
$response .='</sitemapindex>';
file_put_contents($bulkfoldername."/".$company_filename."_".date('Y-m-d').".xml", $response);
}
echo "<br>Please Add Bellow URL to Sitemap <br>GMI_scripts/".$bulkfoldername."/".$company_filename."_".date('Y-m-d').".xml"."<br>";
?> 
