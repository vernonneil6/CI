<!DOCTYPE HTML>
<html>
<base href="<?php echo base_url();?>"/>
<head>
<noscript>
 For full functionality of this site it is necessary to enable JavaScript.
 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
 instructions how to enable JavaScript in your web browser</a>.
</noscript>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="keywords" content="<?php echo $keywords;?>">
<meta name="description" content="<?php echo $description;?>">
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>

<link href="SphinxAutocompleteExample/css/bootstrap.css" rel="stylesheet">

<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/rwd_style.css" type="text/css">
<link rel="stylesheet" href="css/new.css" type="text/css">
<link rel="stylesheet" href="css/font-awesome.css" type="text/css">
<link rel="stylesheet" href="css/slicknav.css">

<link rel="stylesheet" href="css/flexslider.css" type="text/css">

<script src="js/jquery.raty.min.js"></script>
<script src="js/jquery.easy-ticker.js"></script>

<script src="js/jquery.flexslider-min.js"></script>
<script src="js/mobile_nav/jquery.slicknav.js"></script>

<style>
.isa_info, .isa_success, .isa_warning, .isa_error {
	margin: 10px 0px;
	padding:12px;
	text-align:left;
	font-family: MyriadPro-Regular;
}
.isa_info {
	color: #00529B;
	background-color: #BDE5F8;
}
.isa_success {
	color: #4F8A10;
	background-color: #DFF2BF;	
}
.isa_warning {
	color: #9F6000;
	background-color: #FEEFB3;
}
.isa_error {
	background-color: #EBEBEB;
}
.bold-text {
    font-weight: bold;
}
</style>
<?php if($_SERVER['SERVER_NAME'] == 'www.yougotrated.com' || $_SERVER['SERVER_NAME'] == 'yougotrated.com'){ ?>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-47417513-1', 'auto');
	  ga('send', 'pageview');

	</script>
<?php } ?>
</head><body>
</script>
<script type="text/javascript">
		$(window).load(function() {
			$('.flexslider').flexslider();
		});
	</script>
<header class="noscroll-head">
  <div class="container">
    <div class="head_bg">
      <div class="yougot_logo"><a href="<?php echo base_url();?>" title="<?php echo $site_name;?>"><img src="images/ygr_logos.png" alt="<?php echo $site_name;?>-logo" title="<?php echo $site_name;?>"></a></div>
      <div class="head_right">
        <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
        <div class="head_right_lnk">
		<span id="headerusername" class="headerusername">Welcome <?php echo $name = $this->session->userdata['youg_user']['name'];?>&nbsp;</span>
		<div class="headerdashboard"><a href="<?php echo site_url('user');?>" title="Dashboard">Dashboard</a></div>
		<div class="headerlogout"><a href="<?php echo site_url('user/logout');?>" title="Logout">Logout</a></div>
 	</div>
        <?php } else{?>
        <div class="head_right_lnk">
		<div class="headersignup"><a href="<?php echo site_url('go/register');?>" title="Signup">Sign&nbsp;&nbsp;up</a></div>
		<div class="headerlogin"><a href="<?php echo site_url('login');?>" title="Login">Log&nbsp;&nbsp;in</a></div>
		<div class="headerbusiness"><a href="http://business.yougotrated.com" title="Become A Verified Business" style="cursor:pointer;" >Become A Verified Business</a></div>
		<!--<div class="headerfb"><a onclick="FBLogin();" title="Login with facebook" style="cursor:pointer;" >Login WITH FACEBOOK</a></div>-->
	</div>
        <?php }?>
        <?php $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>
       
      </div>
    </div>
   
    <div class="menu" id="menu">
      <ul>
         <!--<li><a href="<?php echo base_url();?>" title="Home">Home<span><span></a> </li>-->
        <li><a href="#" title="Categories">Categories</a>
<ul>
<?php $catlist = $this->common->get_all_categorys_menu('1','category','ASC'); 
foreach($catlist as $row=> $result)
{
					//lower case everything
					$categoryname = strtolower($result['category']);
					//make alphaunermic
					$categoryname = preg_replace("/[^a-z0-9\s-]/", "", $categoryname);
					//Clean multiple dashes or whitespaces
					$categoryname = preg_replace("/[\s-]+/", " ", $categoryname);
					//Convert whitespaces to dash
					$categoryname = preg_replace("/[\s]/", "-", $categoryname);
	
	?>
<li><a href="<?php echo site_url('businessdirectory/category/')."/".$categoryname."/".$result['id'];?>"><?php echo $result['category'];?></a></li>
<?php } ?>
</ul></li>
        <li><a href="<?php echo site_url('businessdirectory');?>" title="Directory">Directory</a></li>
        <li><a href="<?php echo site_url('review');?>" title="Review">Reviews</a></li>
        <li><a href="<?php echo site_url('pressrelease');?>" title="Press Releases">Press Releases</a></li>
        <li><a href="<?php echo site_url('complaint');?>" title="Complaints">Complaints</a></li>
        <li><a href="<?php echo site_url('coupon');?>" title="Coupons deals & Steals">Coupons deals & Steals</a></li>
        <li><a href="http://business.yougotrated.com" title="Business Solutions">Business Solutions</a></li>
      </ul>
    </div>
 
  </div>
</header>
<div class="data_table" align="center" style="width:60.7%;margin:0 auto;"> 
  
  <!-- Correct form message -->
  <?php if( $this->session->flashdata('success') ) { ?>
  <div class="isa_success"> <?php echo $this->session->flashdata('success'); ?> </div>
  <?php } ?>
  <!-- Error form message --> 
  <!--  start message-red -->
  <?php if( $this->session->flashdata('error') ) { ?>
  <div class="isa_error"> <?php echo $this->session->flashdata('error'); ?> </div>
  <?php } ?>
</div>
<?php if(isset($topads)){ ?>
<?php if(count($topads)){ ?>
<div class="container">	
<div align="center" class="addvert" id="add-banner"><a href="<?php echo $topads[0]['url'];?>" title="Adverstiment" target="_blank" rel="nofollow"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="YGR-Top-Adverstiment" width="" height="" class="adimg"/></a> </div>
</div>
<?php } ?>
<?php } ?>
<?php $fb_appId = $this->common->get_setting_value(20);?>
<script type="text/javascript">
	
	$(document).ready(function() {
		$('.data_table').delay(6000).fadeOut(600);
		$('#menu').slicknav({
			
			init: function(){
				
				$("#slick-nav-welcome").html($('#headerusername').html());
			}
				
		});
	});
	window.onorientationchange = function() { location.reload() };	
	
	function PopupCenter(pageURL, title,w,h){
		  var left = (screen.width/2)-(w/2);
		  var top = (screen.height/2)-(h/2);
		  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

	}
	
	/*FB */
window.fbAsyncInit = function() {
FB.init({
appId      : '<?php echo $fb_appId;?>',
status     : true, 
cookie     : true,
xfbml      : true,
oauth      : true
});

FB.Event.subscribe('auth.login', function(response) {
if (response.status === 'connected') {
top.location.href ='<?php echo site_url('welcome/fblogin'); ?>';
}
});
FB.Event.subscribe('auth.logout', function(response) {
if (response.status === 'connected') {
}
else
{
top.location.href ='<?php echo site_url('welcome/logout'); ?>';
}
});

 };
(function(d){
var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
js = d.createElement('script'); js.id = id; js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
d.getElementsByTagName('head')[0].appendChild(js);
}(document));
function FBLogin(){
    FB.login(function(response){
        if(response.authResponse){
            window.location.href = "<?php echo site_url('welcome/fblogin'); ?>";
        }
    }, {scope: 'email'});
}


function fill(Value)
{
$('#search').val(Value);
$('#display').hide();
}
jQuery(function($) {
 var currentRequest = null;
 var data ='';
$('#search').on('keyup', function() {
//$( "#search" ).autocomplete();
$("#display").hide();
var req1 = $('#search').val();
var req2 ='New York';// $('#ccity').val();
var req='name:'+req1+',ccity:'+req2;
if (req.length > 0) {
	$('#loading').show();
	$('#loading').html('<img src="images/spin.gif" height="20px">');
	currentRequest=$.ajax({
		
		url: "<?php echo base_url(); ?>search/autocomplete", //Controller where search is performed
		type: 'POST',
		data: {'name':req1,'ccity':req2},	
		beforeSend : function()
			{           
				if(currentRequest != null)
				{		
					currentRequest.abort();	
					data = '';	
					html = '';		
					$("#display").hide();
					
				}
			},		
		success: function(html){
			$("#display").html(html).show();
			$('#loading').html('').hide();
			html ='';
			data = '';  
			//console.log(data);       
		}			
	});
	
}
});
});


/*side banner script*/
$(window).load(function() {
	var className = $('#add-banner').attr('class');
	if($(window).width() >= 770) {
	if(className == 'addvert')
	{
			$(".main_contentarea").css({ 'padding-top': '0' });  
			$("#main_contentarea").css({ 'padding-top': '0' }); 
			$(".account").css({ 'padding-top': '0' });  
	}
	else{
			$(".main_contentarea").css({ 'padding-top': '8.5em' });  
			$("#main_contentarea").css({ 'padding-top': '8.5em' }); 
			$(".account").css({ 'padding-top': '8.5em' }); 
		}
	}
	 $('#leftclosead').click( function(){ 
		  $(this).parents('.ad_left').hide(); 
	 });
	 $('#rightclosead').click( function(){ 
		 $(this).parents('.ad_right').hide(); 
	 });

});

</script>

<link rel="stylesheet" href="css/autocss.css" type="text/css">
    
<script src="<?php echo site_url('js/jquery-ui-1.10.3.js');?>"></script>

<div class="side_banners">
	
<?php if(isset($leftads) && count($leftads)){ ?> 
	<div class="ad_left side_ads">
	<div id="leftclosead"><img src="<?php echo $this->common->get_setting_value('2');?>/images/close-icon.png" alt="YGR-Adclose"></div>
	<a target="_blank" href="<?php echo $leftads[0]['url'];?>" title="Left Ads"  rel="Left Ads"><img src="<?php if( $leftads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($leftads[0]['image']); } ?>" alt="YGR-Left-Adverstiment" width="100%" /></a> </div>
<?php } ?>

<?php if(isset($rightads) && count($rightads)){ ?>       
	<div class="ad_right side_ads">
	<div id="rightclosead"><img src="<?php echo $this->common->get_setting_value('2');?>/images/close-icon.png" alt="YGR-Adclose"></div>
	<a target="_blank" href="<?php echo $rightads[0]['url'];?>" title="Right Ads"  rel="Right Ads"><img src="<?php if( $rightads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($rightads[0]['image']); } ?>" alt="YGR-Right-Adverstiment" width="100%" /></a> </div>
<?php } ?>

</div>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55799ef149e6e251" async="async"></script>
