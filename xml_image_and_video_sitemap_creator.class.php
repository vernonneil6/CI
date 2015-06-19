<?php

/**

XML Image & Video Sitemap Creator class version 1.0.0 - PHP5
Sitemap creator for image, video and other content (Google valid XML)

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

class xmlsitemap {
	
	/**
	 * Directorynames to exclude from indexing
	 *
	 * @var array
	 */	
	public $Excludedir;	
	
	/**
	 * Exclude directories with a htaccess file
	 *
	 * @var boolean
	 */	
	public $Excludehtaccess;
	
	/**
	 * Valid video extensions
	 *
	 * @var array
	 */	
	public $XMLvideos;

	/**
	 * Valid image extensions
	 *
	 * @var array
	 */	
	public $XMLimages;

	/**
	 * Valid other extensions
	 *
	 * @var array
	 */	
	public $XMLothers;
	
	/**
	 * Valid landingpages in a directory
	 *
	 * @var array
	 */	
	public $XMLlandingpages;
	
	/**
	 * Main landingpage of website
	 *
	 * @var string
	 */	
	public $Mainlandingpage;

	/**
	 * XML header (override)
	 *
	 * @var string
	 */	
	public $XMLheader;

	/**
	 * The sitemap base/root XML URL (override)
	 *
	 * @var string
	 */	
	public $XMLURL;

	/**
	 * Main directory path on server
	 *
	 * @var string	 
	 */				
	private $xmldir;

	/**
	 * Directory structure
	 *
	 * @var array	 
	 */				
	private $dirstructure;

	/**
	 * Index with all videos
	 *
	 * @var array	 
	 */				
	private $xmlvideoindex;
	
	/**
	 * Index with all images
	 *
	 * @var array	 
	 */				
	private $xmlimageindex;	
	
	/**
	 * Index with all other files
	 *
	 * @var array	 
	 */				
	private $xmlotherindex;	

	/**
	 * Maximum images per <loc> tag
	 *
	 * @var int
	 */				
	private $maximages;	

	/**
	 * Total items submitted in XML document
	 *
	 * @var array
	 */				
	private $submitted;

	/**
	 * Class constructor
	 *
	 */	
	public function __construct() {
	
		$this -> XMLURL          = '';
		$this -> Excludedir      = array();
		$this -> XMLimages       = array('gif','png','jpg','jpeg','tif','tiff','bmp','psd','thm','yuv','pspimage');
		//$this -> XMLvideos       = array('3g2', '3gp', 'asf', 'asx', 'avi', 'flv', 'mov', 'mp4', 'mpg', 'rm', 'swf', 'vob', 'wmv');
		//$this -> XMLothers       = array('htm','html');
		$this -> XMLlandingpages = array('index.html','index.htm','index.php');
		$this -> Mainlandingpage = '';	
		$this -> XMLheader       = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" >';
		$this -> Excludehtaccess = true;
		$this -> xmldir          = '';	
		$this -> dirstructure    = array();
		$this -> xmlvideoindex   = array();
		$this -> xmlimageindex   = array();
		$this -> xmlotherindex   = array();
		$this -> maximages       = 999;
		$this -> submitted       = array("videos" => 0, "images" => 0, "others" => 0);
		
	}	
	
	/**
	 * Public funtion to create the XML sitemap
	 *
	 */	
	public function createsitemap($xmldir = '') {
	
		// Determine the full directory structure
		if ($xmldir != '') {$this -> xmldir = rtrim($xmldir, '/');} else {$this -> xmldir = getcwd();}
		$this -> structure();
			
		// Detect all files in directory structure for XML indexing
		if ($this -> Mainlandingpage == '') {$this -> Mainlandingpage = $this -> getmainpage();} 
		$this -> allfiles();

		// Create XML code
		if ($this -> XMLURL == '') {$this -> XMLURL = $this -> geturl();}
		$xml = $this -> XMLheader;
		$xml .= "\n";
		// Add video content
		/*foreach ($this -> xmlvideoindex as $content) {
			$xml .= "<url>\n";		
			$xml .= '<loc>' . htmlentities($this -> XMLURL . '/' . $content[0], ENT_QUOTES, 'UTF-8') . "</loc>\n";
			$xml .= '<video:video><video:title>' . substr(basename($content[1]),0,strrpos(basename($content[1]), '.')) . "</video:title><video:content_loc>" . htmlentities($this -> XMLURL . '/' . $content[1], ENT_QUOTES,'UTF-8') . "</video:content_loc></video:video>\n";
			$xml .= "</url>\n";
			$this -> submitted["videos"] += 1;
		}*/
		// Add image content, combine images in single <loc> tag where possible
		$newtag = true;
		$item_counter = 0;
		$xml .="<url>
<loc>http://www.devygr.com/uploads/index.php</loc>
<image:image><image:loc>http://www.devygr.com/images/badge.png</image:loc></image:image>
<image:image><image:loc>http://www.devygr.com/images/BuyersProtection_Badge.png</image:loc></image:image>
<image:image><image:loc>http://www.devygr.com/images/verified_img.png</image:loc></image:image>
<image:image><image:loc>http://www.devygr.com/images/ygr_logos.png</image:loc></image:image>
<image:image><image:loc>http://www.devygr.com/images/YouGotRated_BusinessProfile_NotVerified-ReviewsTag.png</image:loc></image:image>
</url>\n";

		foreach ($this -> xmlimageindex as $key => $content) {
			$expcepturl=$content[0];
			if ($newtag && $expcepturl!='uploads/index.php') {
				$xml .= "<url>\n";		
				$xml .= '<loc>' . htmlentities($this -> XMLURL . '/' . $content[0], ENT_QUOTES, 'UTF-8') . "</loc>\n";
			}
			$expceptimg=$content[1];
			if($expceptimg!='uploads/4.png' && $expceptimg!='uploads/arrows.png' && $expceptimg!='uploads/bg1.png' && $expceptimg!='uploads/bg.png' && $expceptimg!='uploads/btn_cards.gif'){
			$xml .= '<image:image><image:loc>' . htmlentities($this -> XMLURL . '/' . $content[1], ENT_QUOTES, 'UTF-8') . "</image:loc></image:image>\n";
			$item_counter += 1;
			$this -> submitted["images"] += 1;
		}
			if (key_exists($key+ 1, $this -> xmlimageindex) && $item_counter < $this -> maximages) {
				$next = $this -> xmlimageindex[$key +1];
				if ($next[0] == $content[0]) {$newtag = false;} else {$newtag = true;}
			} else {
				$newtag = true;
			}
			if ($newtag && $expcepturl!='uploads/index.php') {
				$xml .= "</url>\n";
				$item_counter = 0;
			}
		}		
		// Add other content
		/*foreach ($this -> xmlotherindex as $content) {
			$xml .= "<url>\n";		
			$xml .= '<loc>' . htmlentities($this -> XMLURL . '/' . $content, ENT_QUOTES, 'UTF-8') . "</loc>\n";
			$xml .= "</url>\n";
			$this -> submitted["others"] += 1;
		}	*/	
		$xml .= "</urlset>\n";

		return $xml;
		
	}

	/**
	 * Return results of XML indexing
	 *
	 */		
	public function results() {
		
		return $this -> submitted;
		
	}

	/**
	 * Determine root directory structure
	 *
	 */		
	private function structure() {

		if ($dir = opendir($this -> xmldir)) {
			while ($dirname = readdir($dir)) {
				if (substr($dirname, 0, 1) != '.' && is_dir($this -> xmldir . '/' . $dirname) && !in_array($dirname, $this -> Excludedir)) {
					if ($this -> Excludehtaccess) {
						if (!file_exists($this -> xmldir . '/' . $dirname . '/.htaccess')) {
							$this -> dirstructure[] = $dirname;
							$this -> searchdir($this -> xmldir . '/' . $dirname . '/');
						}
					} else {
						$this -> dirstructure[] = $dirname;
						$this -> searchdir($this -> xmldir . '/' . $dirname . '/');
					}
				}
			}
			closedir($dir);
		}
		
	}

	/**
	 * Determine subdirectory structure (recursive)
	 *
	 */		
	private function searchdir($path = '') {

		if ($dir = opendir($path)) {
			while ($dirname = readdir($dir)) {
				if (substr($dirname, 0, 1) != '.' && is_dir($path . $dirname) && !in_array($dirname, $this -> Excludedir)) {
					if ($this -> Excludehtaccess) {
						if (!file_exists($path . $dirname . '/.htaccess')) {				
							$this -> dirstructure[] = substr($path, strlen($this -> xmldir) + 1) . $dirname;
							$this -> searchdir($path . $dirname . '/');
						}
					} else {
						$this -> dirstructure[] = substr($path, strlen($this -> xmldir) + 1) . $dirname;
						$this -> searchdir($path . $dirname . '/');
					}						
				}
			}
			closedir($dir);
		}  

	}

	/**
	 * Retrieve all files for XML indexing
	 *
	 */		
	private function allfiles() {

		$this -> dirstructure[] = '';	// Add root directory for file indexing
		foreach ($this -> dirstructure as $content) {
			$landingpage = $this -> Mainlandingpage;
			foreach ($this -> XMLlandingpages as $location) {
				if (file_exists($this -> xmldir . '/' . $content . '/' . $location)) {
					$landingpage = trim($content . '/' . $location, '/');
					break;
				}
			}
			if ($dir = opendir($this -> xmldir . '/' . $content)) {
				while ($file = readdir($dir)) {
					if (substr($file, 0, 1) != '.' && !is_dir($this -> xmldir . '/' . $content . '/' . $file)) {
						$extension = strtolower(substr($file, strrpos($file, '.') + 1, strlen($file)));
						if (in_array($extension, $this -> XMLvideos)) {
							$this -> xmlvideoindex[]= array($landingpage, trim($content . '/' . $file, '/'));
						} else if (in_array($extension, $this -> XMLimages)) {
							$this -> xmlimageindex[]= array($landingpage, trim($content . '/' . $file, '/'));
						} else if (in_array($extension, $this -> XMLothers)) {
							$this -> xmlotherindex[]= trim($content . '/' . $file , '/');
						}
					}
				}
				closedir($dir);	
			}
		}
	
	}


	/**
	 * Determine base URL
	 *
	 */		
	private function geturl() {
		
		$url = 'http://';
		$uri = '';
		$name = '';
		$port = '80';
		if (isset($_SERVER["HTTPS"])) {if ($_SERVER["HTTPS"] == "on") {$url = "https://";}}
		if (isset($_SERVER["REQUEST_URI"])) {$uri = rtrim($_SERVER["REQUEST_URI"], basename($_SERVER["REQUEST_URI"]));}
		if (isset($_SERVER["SERVER_NAME"])) {$name = $_SERVER["SERVER_NAME"];}
		if (isset($_SERVER["SERVER_PORT"])) {$port = $_SERVER["SERVER_PORT"];}
		if ($port != "80") {
			$url .= $name . ":" . $port . $uri;
		} else {
			$url .= $name . $uri;
		}
		return trim($url, '/');
		
	}

	/**
	 * Determine main landing page
	 *
	 */		
	private function getmainpage() {
		
		$found = '';
		foreach ($this -> XMLlandingpages as $location) {
			if (file_exists($this -> xmldir . '/' . $location)) {
				$found = $location;
				break;
			}
		}
		return $found;
		
	}

}

?>
