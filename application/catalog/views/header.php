<!DOCTYPE HTML>
<html>
<base href="<?php echo base_url();?>"/>
<head>
<noscript>
<meta HTTP-EQUIV="REFRESH" content="0; url=<?php echo base_url();?>noscript.php">
</noscript>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="<?php echo $keywords;?>">
<meta name="description" content="<?php echo $description;?>">
<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
<link rel="stylesheet" href="css/style.css" type="text/css">
<link rel="stylesheet" href="css/new.css" type="text/css">

<link rel="stylesheet" href="css/flexslider.css" type="text/css">

<script src="js/jquery.raty.min.js"></script>

<script src="js/jquery.flexslider-min.js"></script>

<!--<link rel="stylesheet" href="css/message.css" type="text/css">-->

<!--<script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->
<script>
 $(document).ready(function() {
 $('.data_table').delay(6000).fadeOut(600);
 });
</script>
<title><?php echo $title;?></title>
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
</style>

<!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
        	<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
	<![endif]-->
<!--[if IE]>
   		<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->
</head><body>
<header>
  <div class="container">
    <div class="head_bg">
      <div class="yougot_logo"><a href="<?php echo base_url();?>" title="<?php echo $site_name;?>"><img src="images/ygr_logos.png" alt="<?php echo $site_name;?>" title="<?php echo $site_name;?>"></a></div>
      <div class="head_right">
        <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
        <div class="head_right_lnk">
		<span class="headerusername">Welcome <?php echo $name = $this->session->userdata['youg_user']['name'];?>&nbsp;</span>
		<div class="headerdashboard"><a href="<?php echo site_url('user');?>" title="Dashboard">Dashboard</a></div>
		<div class="headerlogout"><a href="<?php echo site_url('user/logout');?>" title="Logout">Logout</a></div>
 	</div>
        <?php } else{?>
        <div class="head_right_lnk">
		<div class="headersignup"><a href="<?php echo site_url('go/register');?>" title="Signup">Signup</a></div>
		<div class="headerlogin"><a href="<?php echo site_url('login');?>" title="Login">Login</a></div>
		<div class="headerfb"><a onclick="FBLogin();" title="Login with facebook" style="cursor:pointer;" >Login WITH FACEBOOK</a></div>
	</div>
        <?php }?>
        <?php $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>
        <script>
			function PopupCenter(pageURL, title,w,h)
			 {
			  var left = (screen.width/2)-(w/2);
		  	  var top = (screen.height/2)-(h/2);
			  var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
  
}
			</script>
<script type="text/javascript">
		$(window).load(function() {
			$('.flexslider').flexslider();
		});
	</script>
        <!--<div class="social_icn">
          <ul>
          
            <li>
                <div class="addthis_toolbox addthis_default_style "><a class="addthis_counter addthis_pill_style share" style="cursor:pointer;"></a><a><div style="margin:-6px 0 0 0;cursor:pointer;">Share</div></a> </div>
                <?php /*?><script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script><?php */?> 
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5139b09b14707fbc"></script> 
              </li>
			<?php /*?><li> <a onclick="PopupCenter('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo "";?>&amp;p[url]=<?php echo $actual_link; ?>&amp;&p[images][0]=', 'sharer','test','800','500');" title="Share" class="share" style="cursor:pointer;"><span>share</span></a> </li><?php */?>
            <li> <a onclick="PopupCenter('http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo "";?>&amp;p[url]=<?php echo $actual_link; ?>&amp;&p[images][0]=', 'sharer','test','800','500');" title="Post" class="post" style="cursor:pointer;"><span>post</span></a> </li>
            </li>
            <li> <a data-pin-do="buttonPin" data-pin-config="above" onclick="PopupCenter('http://www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.flickr.com%2Fphotos%2Fkentbrew%2F6851755809%2F&media=<? echo urlencode($actual_link) ;?>&description=<?php echo $title;?>','test','800','500');" class="pin" title="pin" style="cursor:pointer;"><span>pin</span></a> </li>
            <li><a onclick="PopupCenter('http://twitter.com/share?text=&lang=pt&url=<? echo urlencode($actual_link) ;?>','test','800','500');" class="tweet" style="cursor:pointer;"><span>tweet</span></a></li>
          </ul>
        </div>-->
      </div>
    </div>
      <!--<div class="innr_wrap">
      <div class="main_demage">
        <div class="demage_count"><span>$<?php echo $total;?></span> <i>In Reported Damages Resolved.</i></div>
        <?php /*?><div class="main_searchbox"> <?php echo form_open('complaint/searchresult',array('class'=>'formBox','name'=>'frmsearch','id'=>'frmsearch')); ?>
          <?php if( $this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='search') { $serkeyword=base64_decode($this->uri->segment(3));} else { $serkeyword =''; } ?>
          <input type="text" class="search_txtbox" placeholder="search for a business..." name="search" id="search" value="<?php echo $serkeyword;?>" required maxlength="30">
          <input type="submit" class="srch_btn" title="Search" value="" name="btnsearch">
          <?php echo form_close();?> </div><?php */?>
          <div class="main_searchbox"> <?php echo form_open('businessdirectory/search',array('class'=>'formBox','name'=>'frmsearch','id'=>'frmsearch')); ?>
          <?php if( $this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='search') { $serkeyword=base64_decode($this->uri->segment(3));} else { $serkeyword =''; } ?>
          <input type="text" class="search_txtbox" placeholder="search for a business..." name="searchcomp" id="search" value="<?php echo $serkeyword;?>" required maxlength="30">
          <input type="submit" class="srch_btn" title="Search" value="" name="btnsearch">
          <?php echo form_close();?> </div>
      </div>
    </div>-->
    <div class="menu">
      <ul>
        <li><a href="<?php echo base_url();?>" title="Home">Home<span>:<span></a> </li>
        <li><a href="<?php echo site_url('businessdirectory');?>" title="Business Directory">Business Directory<span>:<span></a></li>
        <li><a href="<?php echo site_url('review');?>" title="Business Review">Business Review<span>:<span></a></li>
        <li><a href="<?php echo site_url('pressrelease');?>" title="Press Releases">Press Releases<span>:<span></a></li>
        <li><a href="<?php echo site_url('complaint');?>" title="Complaints">Complaints<span>:<span></a></li>
        <li><a href="<?php echo site_url('coupon');?>" title="Coupons deals & Steals">Coupons deals & Steals<span>:<span></a></li>
        <li><a href="<?php echo site_url('solution');?>" title="Elite Membership">Elite Membership</a></li>
      </ul>
    </div>
    <div class='headersearch'>
	  <?php echo form_open('businessdirectory/search',array('class'=>'formBox','name'=>'frmsearch','id'=>'frmsearch')); ?>
          <?php if( $this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='search') { $serkeyword=base64_decode($this->uri->segment(3));} else { $serkeyword =''; } ?>
		<input type='text'  class='headersearchbar' placeholder="Search for a Business..." name="searchcomp"  id="search" value="<?php echo $serkeyword;?>" required maxlength="30">
		<input type="submit" class="headersearchbtn" value="SEARCH" name="btnsearch">
	 <?php echo form_close();?> 
    </div>

    <div style="margin-left:5px;margin-top:10px !important;">
      <?php if($this->uri->segment(1)=='coupon' && $this->uri->segment(2)==''){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Coupons deals & Steals">Coupons deals & Steals</a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='coupon' && $this->uri->segment(2)=='browse'){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a href="<?php echo site_url('coupon');?>" title="Coupons deals & Steals">Coupons deals & Steals</a>&nbsp;&raquo; <a title="<?php echo $this->uri->segment(3);?>"><?php echo ucfirst($this->uri->segment(3));?></a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='complaint' && $this->uri->segment(2)==''){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Complaints">Complaints</a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='browse'){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a href="<?php echo site_url('complaint');?>" title="Complaints">Complaints</a>&nbsp;&raquo; <a title="<?php echo $this->uri->segment(3);?>"><?php echo ucfirst($this->uri->segment(3));?></a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='pressrelease' && $this->uri->segment(2)==''){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Pressreleases">Pressreleases</a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='pressrelease' && $this->uri->segment(2)=='browse'){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a href="<?php echo site_url('pressrelease');?>" title="Pressreleasess">Pressreleasess</a>&nbsp;&raquo; <a title="<?php echo $this->uri->segment(3);?>"><?php echo ucfirst($this->uri->segment(3));?></a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='review' && $this->uri->segment(2)==''){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Reviews">Reviews</a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='review' && $this->uri->segment(2)=='browse'){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a href="<?php echo site_url('review');?>" title="Reviews">Reviews</a>&nbsp;&raquo; <a title="<?php echo $this->uri->segment(3);?>"><?php echo ucfirst($this->uri->segment(3));?></a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='businessdirectory' && $this->uri->segment(2)==''){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Business Directory">Business Directory</a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='login' && $this->uri->segment(2)==''){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Login">Login</a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='login' && $this->uri->segment(2)=='forgot'){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Forgot Password">Forgot Password</a>
      <?php } ?>
      <?php if($this->uri->segment(1)=='go' && $this->uri->segment(2)=='register'){?>
      <a href="<?php echo base_url();?>" title="Home">Home</a>&nbsp;&raquo; <a title="Register">Register</a>
      <?php } ?>
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
<div align="center"><a href="<?php echo $topads[0]['url'];?>" title="Adverstiment" target="_blank" rel="nofollow"><img src="<?php if( $topads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($topads[0]['image']); } ?>" alt="Adverstiment" width="940" height="180" class="adimg"/></a> </div>
<?php } ?>
<?php } ?>
<?php $fb_appId = $this->common->get_setting_value(20);?>
<script>
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

</script>
<style>
.addthis_counter.addthis_pill_style.addthis_nonzero a.addthis_button_expanded
{
display:none !important;
}
.addthis_counter .atc_s, .addthis_counter .addthis_button_expanded
{
background:none !important;
}
</style>
