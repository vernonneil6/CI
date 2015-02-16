<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/widget_css.css'; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/themes/widget-tooltip.css'; ?>" type="text/css">
 
<style>
@font-face {
  font-family: 'FontAwesome';
  src: url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.eot');
  src: url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.eot?#iefix') format('embedded-opentype'),
       url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.woff') format('woff'),
       url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.ttf') format('truetype');
  font-weight: normal;
  font-style: normal;
}
</style> 

<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/jquery-1.7.min.js'; ?>" ></script>
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/noconflict.js'; ?>" ></script>
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/fancybox.js'; ?>"></script>
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/jquery.tooltipster.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/jquery.raty.min.js'; ?>"></script>
 

<div class = "company_review_tab fancybox" href="#review_popup">
Reviews
</div>

<div id="review_popup" class = "popupwidth">

	<iframe id="container_frame" src="http://www.yougotrated.com/widget/content/<?php echo $companyid; ?>" style="width:100%;height:100%;position:relative;" ></iframe></div> 
    
</div>

<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/widget.js'; ?>"></script>

