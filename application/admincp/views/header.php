<?php ini_set('memory_limit', '9999M');?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<base href="<?php echo base_url(); ?>">
<noscript>
 For full functionality of this site it is necessary to enable JavaScript.
 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
 instructions how to enable JavaScript in your web browser</a>.
</noscript>

<title><?php echo $title; ?></title>
<link href="<?php echo base_url();?>css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/stylesheet.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/blue.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/visualize.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/slider.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/jquery-ui.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dimensions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/init.js"></script>
<!-- Fancy box JS and CSS-->
<script type="text/javascript" src="<?php echo base_url();?>js/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Fancy box JS and CSS-->

<!-- // File upload // -->
<script src="<?php echo base_url();?>js/jquery.filestyle.js" type="text/javascript"></script>
<script type="text/javascript">
			function setsiteid(siteid) {
					//alert(siteid);
					//return false;
					
					$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('dashboard/setsite'); ?>",
				data				:	{ 'siteid' : siteid },
				dataType 			: "html",
				cache				: false,
				success				: function(data){
												window.location.reload(true);
									  	}
			});
			
			
			}
			$(document).ready(function() {
				$(".fancybox").fancybox();
			});
			
</script>
</head>

<body>
<div id="main">
<!-- #header -->
<div id="header"> 
  <!-- #logo -->
  <div>
  
  </div>
  <div id="logo"> <a href="<?php echo site_url(); ?>" title="<?php echo $site_name; ?>">
  <span>
  <img src="<?php echo base_url('../images/YGR_Logo_TranspBG.png'); ?>" /> Admin Management</span>
  </a> </div>
<?php date_default_timezone_set("EST");?>
<?php date("Y-m-d H:i:s");?>
  <!-- /#logo --> 
  <!-- #user -->
  
				  <div id="user" align="right">
  (admin)
    <a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a> - <a href="<?php echo site_url('dashboard/logout');?>" title="Logout">Logout</a> </div>
				<div style="color: #C6C6C6;
    position: absolute;
    right: 25px;
    top: 37px;" align="right"> <?php echo form_open('',array('class'=>'formBox')); ?>
				<div class="con" style="height:25px;">
                <?php 
				$selsiteid = $this->session->userdata('siteid');
				$js='class="select" id="site" onchange="setsiteid(this.value)" style="padding-top:1px;"'; 
            	echo form_dropdown('site',$selsite,$selsiteid,$js); ?>	
                
              </div>
        

      <?php echo form_close(); ?> </div>


   
  <!-- /#user --> 
</div>
<!-- /header -->
