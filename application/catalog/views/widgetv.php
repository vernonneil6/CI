<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title><?php echo ( !empty($name) ) ? $name : $site_name; ?></title>
<script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>
</head>

<body>
<style>
div.box
{
cursor:pointer;
}
div.box div.overlay
{
    display:none;
	width:auto;
	cursor:pointer;
}
div.overlay a:hover
{
color:#575656;
width:auto;
cursor:pointer;
}
</style>
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
	width:255px;
	max-width:255px;
}
.box .title {
	text-align:center;
	background:url("../../../images/wdg_title.png") #047AD3 repeat-x;
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
	font-size:16px;
	font-weight:bold;
	
}
#colorcode
{
color : #0573BF;
}
#widdiv
{
height:355px;
overflow-y:auto;
}

</style>
<script>
$(function(){
    $("#widdiv").hover(function(){
      $(this).find(".overlay").fadeIn();
    }
                    ,function(){
                        $(this).find(".overlay").fadeOut();
                    }
                   );        
});
</script>
<?php if( !empty($name) ) { ?>
<div id="widdiv">
<div class="box">
  <div class="title"><a href="<?php echo $site_url; ?>" title="<?php echo $site_name; ?>" target="_blank"><?php echo $site_name; ?></a></div>
  <?php if( !empty($name) ) { ?>
  <div class="business"> <a href="<?php echo $url; ?>" title="<?php echo $name; ?>" target="_blank" id="colorcode"><?php echo ucfirst($name); ?></a>&nbsp;<?php echo img(array('src'=>'images/stars/'.$rating.'.png', 'alt'=>$rating.' stars', 'title'=>$rating.' stars')); ?><br>
    Rating:&nbsp;<?php echo $rating; ?>&nbsp;/&nbsp;5 <br>
    <?php echo $total; ?> User Reviews. <br>
    <!--<a href="<?php //echo $site_url; ?>" target="_blank" title="<?php //echo $site_name; ?>">-->
    <div align="center">
      <?php /*?>   <img src="<?php if( $verifiedlogo ) { echo $this->common->get_setting_value('2').$this->config->item('verifiedlogo_thumb_upload_path');?><?php echo stripslashes($verifiedlogo); } else { echo $this->common->get_setting_value('2').$this->config->item('verifiedlogo_thumb_upload_path')."no_image.png"; } ?>" alt="Verified Logo" />
<?php */?>
      <a target="_blank" onClick="window.open('<?php echo $site_url; ?>verified','YougotratedVerification','width=500,height=400,dependent=yes,resizable=yes,scrollbars=yes,menubar=no,toolbar=no,status=no,directories=no,location=yes'); return false;" style="cursor: pointer;" title="Yougotrated Verification"> <img src="<?php if( $verifiedlogo ) { echo base_url().$this->config->item('verifiedlogo_thumb_upload_path');?><?php echo stripslashes($verifiedlogo); } ?>" alt="Verified Logo" width="230" height="120"/> </a> </div>
    </a> </div>
  <?php } ?>
</div>
<div class="box" align="center"> <img src="<?php echo base_url();?>images/verified_logonew.png" alt="Verified Logo" width="230" height="120" />
  <div class="overlay">
    <?php for($j=0;$j<count($sites);$j++)
	{
	?>
    <?php /*?><a href="javascript:;" title="<?php echo strtolower($sites[$j]['title']);?>" onClick="window.open('<?php echo $sites[$j]['siteurl'];?>company/<?php echo $companyseo;?>/reviews/coupons/complaints')"><?php echo ucfirst(strtolower($sites[$j]['title']));?></a><?php */?>
    <a title="<?php echo strtolower($sites[$j]['title']);?>" href="<?php echo $sites[$j]['siteurl'];?>company/<?php echo $companyseo;?>/reviews/coupons/complaints" target="_blank"><?php echo ucfirst(strtolower($sites[$j]['title']));?></a> <br/>
    <?php 
	}
	?>
  </div>
</div>
</div>
<?php } ?>
</body>
</html>