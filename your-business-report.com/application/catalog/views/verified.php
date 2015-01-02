<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <title><?php echo ucwords($title); ?></title>
    
  </head>
<body>

<style type="text/css">
.box {
	background-color: #ffffff;
	border: 1px solid #ccc;
	border: 1px solid rgba(0, 0, 0, 0.2);
 *border-right-width: 2px;
 *border-bottom-width: 2px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-webkit-background-clip: padding-box;
	-moz-background-clip: padding;
	background-clip: padding-box;
	width:470px;
}
.box .title {
	text-align:center;
	background:url("../images/wdg_title.png") #047AD3 repeat-x;
	padding:5px;
	border-top-left-radius:6px;
	border-top-right-radius:6px;
	-moz-border-radius-topleft:6px;
	-moz-border-radius-topright:6px;
	-webkit-border-top-right-radius:6px;
	-webkit-border-top-left-radius:6px;
	margin-bottom:5px;
}
a,a:hover,a:active {
	text-decoration:none;
}
.box .title a {
	text-decoration:none;
	color:#FFF;
	font-size:18px;
	font-weight:bold;
}
img
{
	border:0px none;
	vertical-align:middle;
}
.business {
	text-align:left;
	padding:5px;
}
.business a {
	display:inline-block;
	color:#0573BF;
	font-size:16px;
	font-weight:bold;
}
</style>
<?php
 //current url of site
 
 $pageURL = '';
 
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }

//site name
//$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
//echo "The current page name is ".$curPageName;
?>


<div class="box">
	<div class="title">
    <a href="<?php echo $site_url; ?>" title="<?php echo $site_name; ?>" target="_blank">This<?php //echo $pageURL; ?> is verified by <?php echo $site_name; ?></a></div>
  
  <div class="business">
  <div align="right">
  <span style="margin-right:50px;" class="colorcode"><?php echo ucwords($varheading);?></span>
  <a style="cursor: pointer;" href="<?php echo $site_url; ?>">
<img src="<?php if( $verifiedlogo ) { echo $this->common->get_setting_value('2').$this->config->item('verifiedlogo_thumb_upload_path');?><?php echo stripslashes($verifiedlogo); } else { echo $this->common->get_setting_value('2').$this->config->item('verifiedlogo_thumb_upload_path')."no_image.png"; } ?>" alt="Verified Logo" width="120px;"/>
</a>
</div>
<?php echo $content; ?>   
	</div>

</div>

</body>
</html>
