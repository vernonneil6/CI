<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/widget_css.css'; ?>" type="text/css">
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/wid.js'; ?>" ></script>

<div class = "company_review_tab fancybox" href="#review_popup"></div>
<div id="review_popup" class = "popupwidth">
	<iframe id="container_frame" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']. '/widget/content/'.$companyid; ?>" style="width:100%;height:100%;position:relative;" ></iframe></div> 
</div>



