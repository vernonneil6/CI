<?php 
include_once "db_connection.php";
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

	xmlhttp.open("GET","http://www.yougotrated.writerbin.com/sm/search_sitemap_gen.php?page_no="+i,true);
	xmlhttp.send();
}

</script>
<div id="myDiv">Sitemap Generating ...</div>
<?php 
}
?>
