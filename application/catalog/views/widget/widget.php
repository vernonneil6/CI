<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/style.css'; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/widget.css'; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/fancybox.css'; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/tooltipster.css'; ?>" type="text/css">
<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/css/font-awesome.css'; ?>" type="text/css">
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

<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/fancybox.js'; ?>"></script>
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/jquery.tooltipster.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/js/jquery.raty.min.js'; ?>"></script>
 

<div class = "company_review_tab fancybox" href="#review_popup">
Reviews
</div>

<div id="review_popup" class = "popupwidth">

	<iframe id="container_frame" src="http://www.yougotrated.com/widget/content/<?php echo $companyid; ?>" style="width:100%;height:100%;position:relative;" ></iframe></div> 
    
</div>

<script>
	jQuery(document).ready(function() 
	{
		jQuery('.tooltip').tooltipster({
		
			theme: 'widget-tooltip',
			position: 'bottom',
			contentAsHTML: true
		
		});
		
		jQuery('.fancybox').fancybox();
		
		jQuery('.widget_close').click(function(){
			jQuery('.fancybox-overlay').hide();
		});
   });
	
	function countme(rid,vote)
	{
	  jQuery.ajax({
		  type 				: "POST",
		  url 				: "<?php echo site_url('review/countme');?>",
		  dataType 			: "json",
		  data				: {reviewid:rid,vote : vote},
		  cache				: false,
		  success			: function(data)
							  {	
								$('#'+vote+'_'+rid).html("<b>"+data.total+"</b>&nbsp;"+vote);
							
							  }
	   });
	}
	
	function check(ip,rid,vote)
	{
	  
	  jQuery.ajax({
		  type 				: "POST",
		  url 				: "<?php echo site_url('review/checkvote');?>",
		  dataType 			: "json",
		  data				: { ip:ip,reviewid:rid,vote : vote},
		  cache				: false,
		  success			: function(data)
							  {	
								if(data.message == 'deleted')
								{
								   $('#'+vote+'_'+rid).removeClass('vote-disable');
								   $('#'+vote+'_'+rid).addClass('vote');
								}
								if(data.message == 'added')
								{
								   $('#'+vote+'_'+rid).removeClass('vote');
								   $('#'+vote+'_'+rid).addClass('vote-disable');										   										  
								}
								countme(rid,vote);
							  }
		  

	   });
	  
	}

</script>

