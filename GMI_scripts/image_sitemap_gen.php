<?php
include_once "db.php";

// default header(don't delete)

//header("Content-Type: text/xml;charset=utf-8");

//header("Content-Type: text/xml;charset=utf-8");
//header('Content-disposition: attachment; filename="images.xml"');


    $filecontent.= '<?xml version="1.0" encoding="UTF-8"?>

 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
    

// mytable = my content table name

$sql = 'select image from youg_slider';
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
	{
		//  = content url
		$url = "http://".$_SERVER['HTTP_HOST'];
		// [time] = content date
		//$date = date("Y-m-d", $row['addeddate']);
		// [img] = image url
		$img = "http://".$_SERVER['HTTP_HOST']."/uploads/slider/".$row['image'];
		if($row['image']!='')
		{
			$filecontent.=

			'<url>
				<loc>' . $url .'</loc>
				<image:image>
					<image:loc>' . $img .'</image:loc>
				</image:image>
			</url>
			';
		}

	}
/*************** User Images ********************/

$sql = 'select avatarbig  from youg_user';
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
	//  = content url
	$url = "http://".$_SERVER['HTTP_HOST'];
	// [img] = image url
	if($row['avatarbig']!='')
		{
			$img = "http://".$_SERVER['HTTP_HOST']."/uploads/user/main/".$row['avatarbig'];

			$filecontent.=

			'<url>
				<loc>' . $url .'</loc>
				<image:image>
					<image:loc>' . $img .'</image:loc>
				</image:image>
			</url>
			';
		}

}


/*************** Company Logo Images ********************/

$sql = 'select logo  from youg_company';
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
	//  = content url
	$url = "http://".$_SERVER['HTTP_HOST'];
	// [img] = image url
	if($row['logo']!='')
		{
			$img = "http://".$_SERVER['HTTP_HOST']."/uploads/company/main/".$row['logo'];

			$filecontent.=

			'<url>
				<loc>' . $url .'</loc>
				<image:image>
					<image:loc>' . $img .'</image:loc>
				</image:image>
			</url>
			';
		}

}


/*************** Gallery Images ********************/

$sql = 'select photo  from youg_photos';
$result = $conn->query($sql);
while($row = $result->fetch_assoc())
{
	//  = content url
	$url = "http://".$_SERVER['HTTP_HOST'];
	// [img] = image url
	if($row['photo']!='')
		{
			$img = "http://".$_SERVER['HTTP_HOST']."/uploads/gallery/main/".$row['photo'];

			$filecontent.=

			'<url>
				<loc>' . $url .'</loc>
				<image:image>
					<image:loc>' . $img .'</image:loc>
				</image:image>
			</url>
			';
		}

}

$filecontent.= '</urlset>';


// Remove old XML sitemap file 
$file = "image-sitemap-new.xml";
if (file_exists($file)) 
{
	unlink($file);
}
// Write the XML sitemap code to file as UTF-8
if ($fp = fopen('image-sitemap-new.xml', 'wb')) {
	fwrite($fp, utf8_encode($filecontent));
	fclose($fp);
	echo "XML image sitemap file has been created on ! ".date("d/m/Y H:i");
}
?>
