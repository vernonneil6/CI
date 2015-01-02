<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<base href="<?php echo site_url(); ?>">
<title><?php echo $title; ?></title>
<link href="<?php echo base_url();?>css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/stylesheet.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/blue.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/visualize.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dimensions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/init.js"></script>
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
</script>
</head>

<body>
<div id="main">
<!-- #header -->
<div id="header"> 
  <!-- #logo -->
  <div id="logo"> <a href="<?php echo site_url(); ?>" title="Business Admin"><span>Business Admin</span></a> </div>
  <!-- /#logo --> 
  <!-- #user -->
  <div id="user" align="right">
    <?php $a = $this->session->userdata['youg_admin']['id'];?>
    <?php $com = $this->settings->get_company_byid($a);?>
    <?php if(count($com)>0) { echo "logged in as ".$com[0]['company'];} ?>
    <a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a> - <a href="<?php echo site_url('dashboard/logout');?>" title="Logout">Logout</a></div>
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