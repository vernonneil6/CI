<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/widget.css';?>" type="text/css">
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/widget.js';?>" ></script> 	 
	
<div class="company_review_tab fancybox" href="#review_popup" onclick="showPopup()">&nbsp;</div>
<div class="review_cover" id="review_cover">	
	<div id="review_popup" class = "popupwidth">
		<div class='close_popup' onclick="closePopup()">&nbsp;</div>		
		<iframe id="container_frame" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']. '/widget/content/'.$companyid; ?>" style="width:100%;height:100%;position:relative;border:0 none;" ></iframe></div> 		
	</div>
</div>




