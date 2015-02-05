<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<base href="<?php echo base_url(); ?>"><noscript>
 For full functionality of this site it is necessary to enable JavaScript.
 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
 instructions how to enable JavaScript in your web browser</a>.
</noscript>
<title><?php echo $title; ?></title>
<link href="<?php echo base_url();?>css/default.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/stylesheet.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/blue.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url();?>css/visualize.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dimensions.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/init.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.raty.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.filestyle.js" type="text/javascript"></script>
<link href="<?php echo base_url();?>css/jquery-ui.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui.js"></script>

</head>

<body>
<div id="main">
<div id="header"> 
  	<!-- #logo -->
  <div id="logo"> <a href="<?php echo site_url(); ?>" title="Business Admin"><span>
	   <img src="<?php echo base_url('../images/YGR_whiteLogo.png'); ?>" class="ebalogo" /> Broker Admin
	</span></a> </div>
  <!-- /#logo --> 
	<div id="user" align="right">
	    <?php echo "logged in as ".$this->session->userdata['broker_data'][0]->name; ?>
	    <a href="<?php echo site_url('broker');?>" title="Dashboard">Dashboard</a> - <a href="<?php echo site_url('broker/logout');?>" title="Logout">Logout</a>
	</div>
</div>
