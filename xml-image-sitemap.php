<?php

/**

Example code for the XML Image & Video Sitemap Creator class 

Copyright (c) 2010 JF Nutbroek <jfnutbroek@gmail.com>
Visit http://www.mywebmymail.com for more information 

Permission to use, copy, modify, and/or distribute this software for any
purpose without fee is hereby granted, provided that the above
copyright notice and this permission notice appear in all copies.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES
WITH REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR
ANY SPECIAL, DIRECT, INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES
WHATSOEVER RESULTING FROM LOSS OF USE, DATA OR PROFITS, WHETHER IN AN
ACTION OF CONTRACT, NEGLIGENCE OR OTHER TORTIOUS ACTION, ARISING OUT OF
OR IN CONNECTION WITH THE USE OR PERFORMANCE OF THIS SOFTWARE.

*/
error_reporting(0);
function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
    
  );
}
$siteurl=url();

// Large websites might require more time
set_time_limit(0);

// Create a new instance of the class
include_once('xml_image_and_video_sitemap_creator.class.php');
$xml = new xmlsitemap;

// Configuration options
   $xml -> XMLURL          = $siteurl;                // Specify the base URL to the root instead of auto-determining it
   $xml -> Excludedir      = array('_thumbs','tutorial','proof','ckeditor','images','js','blog','category','slider','message','sem','companysem','thumb','ad','topsellerratings.com','merchant-informer.com', 'safe-merchants.com');                  // Exclude specific directories
// $xml -> Excludehtaccess = true;                                         // Exclude directories with .htaccess files
   $xml -> XMLimages       = array('gif', 'png', 'jpg', 'jpeg', 'ico');    // Index these specific images (extensions) only
// $xml -> XMLvideos       = array('vob', 'wmv');                          // Index these specific movies (extensions) only
// $xml -> XMLothers       = array('htm', 'html');                         // Index these other non image & video file extensions also
// $xml -> XMLlandingpages = array('index.html','index.htm','index.php');  // Use these landing pages when found with the indexed files
// $xml -> Mainlandingpage = 'index.asp';	                           // Set the main landing page if no other landing page can be found
// Create the sitemap from current working directory (you can specify a path optionally)
$filecontent = $xml -> createsitemap($xmldir,$siteurl);

// Remove old XML sitemap file 
$file = "GMI_scripts/sitemap/image-sitemap.xml";
unlink($file);

// Write the XML sitemap code to file as UTF-8
if ($fp = fopen('GMI_scripts/sitemap/image-sitemap.xml', 'wb')) {
	fwrite($fp, utf8_encode($filecontent));
	fclose($fp);
	echo "XML image sitemap file has been created!<p>&nbsp;</p>";
}


// Show the indexing results
$result = $xml -> results();
//echo "Indexed " . $result["videos"]. " videos.<br />";
echo "Indexed " . $result["images"]. " images.<br />";
//echo "Indexed " . $result["others"]. " other files.<br />";

?>
