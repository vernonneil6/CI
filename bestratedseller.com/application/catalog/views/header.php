<?php ob_start();?>
<?php error_reporting(0);?>
<?php //echo $a; ?>

<?php
ini_set('memory_limit', '99999M');
set_time_limit(300000);
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" version="XHTML+RDFa 1.0" xml:lang="en">
<head>
<noscript>
Please Enable Javascript in your browser
</noscript>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8"/>
<meta name="keywords" content="<?php echo $keywords; ?>">
<meta name="description" content="<?php echo $description; ?>">
<title><?php echo ucfirst($title); ?></title>
<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css">
<!--==================== layout =======================================-->
<link rel="stylesheet" href="<?php echo base_url();?>css/layout.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/message.css" type="text/css">
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.selectbox.js"></script>
<script type="text/javascript">
	$(function(){
		$(".close-green").click(function () {
				$("#message-green").fadeOut("slow");
		});
		$(".close-red").click(function () {
				$("#message-red").fadeOut("slow");
		});
		$(".close-blue").click(function () {
				$("#message-blue").fadeOut("slow");
		});
		$(".close-yellow").click(function () {
				$("#message-yellow").fadeOut("slow");
		});
	});
</script>
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
       
    
    
    
</head>
        <?php //$companies = $this->common->get_all_companies1();?>
        <?php //echo "<pre>";
			  //print_r($companies);
			  //die();?>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script> 
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
        <script type="text/javascript">
	function searchcompany1(company)
	{
		//alert(company);
		if (company.length > 3)
		{
			//alert(company.length);
			if( searchcompany != '' )
			{
			//$("#couponcodeerror").hide();
			//Return from conroller in php code : echo json_encode(array("result"=>"exist"));
			$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('welcome/searchcompany'); ?>",
				data				:	{ 'company' : company },
				dataType 			: "json",
				cache				: false,
				success				: function(data){
												//alert(data);
												//console.log(data);
												$('#search').autocomplete({ 
				source: data,
				
				select: function (event, ui) {}
			});
			$(".ui-autocomplete").css("max-height", "250px");
			$(".ui-autocomplete").css("overflow-y", "auto");
			$(".ui-autocomplete").css("left", "807px;");
												
											}
			});
		}
			else
			{
			
			return false;
			}
		}
		else
		{
			return false;
		}
	}
</script>
<?php
	$fb_appId = $this->common->get_setting_value(20);
	
	?>
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
		<script>
	 	  <?php /*?>var companydata = new Array();
		  var myvar1 = [];
		  <?php $jsArray = array();
		  foreach($companies as $array) {
			 $jsArray[] = array('id'=>$array['id'], 'company'=>$array['company']); 
		  } ?>
		  <?php 
		  for($i=0; $i<count($jsArray); $i++)
		  { ?>
			  myvar1.push({
				  "label":<?php echo json_encode($jsArray[$i]['company']); ?>,
				  "value":<?php echo json_encode($jsArray[$i]['company']); ?>
			  });
			  companydata = [{
			  value: <?php echo json_encode($jsArray[$i]['company']); ?>,
			  label: <?php echo json_encode($jsArray[$i]['company']); ?>
			  }];
		  <?php } ?><?php */?>
	      	
		 <?php /*?> $(document).ready(function(){
			$('#search').autocomplete({ 
				source: myvar1,
				minLength: 3,
				select: function (event, ui) {
								}
			});
			
			$(".ui-autocomplete").css("max-height", "250px");
			$(".ui-autocomplete").css("overflow-y", "auto");
			
		  });<?php */?>
		  </script>
			
<body>
<header>
  <div class="inner_main">
    <div class="head_bg">
      <div class="yougot_logo"> <a href="<?php echo $site_url; ?>" title="<?php echo $site_name; ?>"> <img src="<?php echo base_url();?>images/yougot_logo.png" alt="<?php echo $site_name; ?>" title="<?php echo $site_name; ?>"> </a> </div>
      <div class="head_right">
        <div class="head_right_lnk">
          <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
          <?php $name = $this->session->userdata['youg_user']['name']; ?>
          <span style="color:#FFFFFF;">Welcome</span><a href="<?php echo site_url('user');?>" title="Dashboard"><?php echo $name; ?></a> <a href="<?php echo site_url('user/logout');?>" title="Logout">Logout</a>
          <div style="margin-top:32px;"></div>
          <?php } else {?>
          <a href="#<?php/* echo site_url('login');*/?>" title="Login">Login</a>|<a href="#<?php /* echo site_url('go/register'); */?>" title="Signup">Signup</a><br/>
          <?php if($this->uri->segment(1)!='login'){ ?>
          <a onclick="<?php /* FBLogin(); */?>"><img src="<?php echo site_url(); ?>images/fb_signin_btn.png" alt="Signin with Facebook" title="Signin with Facebook"></a>
          <?php }else{?>
          <div style="margin-top:32px;"></div>
		  <?php } }?>
        </div>
        <div class="main_searchbox" style="margin:5px 0 0 !important;">
          <?php $this->load->helper('form'); ?>
          <script>$(document).ready(function(){
								$("#btnsearch").click(function () {
							    /* $("#frmsearch").submit();*/
							   return false;
						  });
						 });
						
						</script> 
          <?php echo form_open('',array('class'=>'formBox','name'=>'frmsearch','id'=>'frmsearch')); ?>
          <?php if( $this->uri->segment(1)=='complaint' && $this->uri->segment(2)=='search') { $serkeyword=base64_decode($this->uri->segment(3));} else { $serkeyword =''; } ?>
          
          <input name="search" placeholder="Search here..." class="search_box" type="text" value="<?php echo $serkeyword;?>" title="Search complaints" id="search">
          <input name="btnsearch" id="btnsearch" class="srch_btn" type="submit" value="">
          <?php echo form_close();?> </div>
      </div>
    </div>
  </div>
</header>
<section class="container">
  <section class="inner_main">
    <div class="main_contentarea">
      <div class="main_demage">
        <div class="demage_count">
          <?php /*?><img src="<?php echo site_url();?>images/demage_bg.png"> <?php */?>
          <span class="colorcode" style="font-weight:bold;">$</span>
          <?php if(count($total)>0){ ?>
          <?php $z=str_split($total);?>
          <?php for($i=0;$i<count($z);$i++) { ?>
          <span style="background-color:#333333;color:#FFFFFF;"><?php echo $z[$i];?></span>
          <?php } } else { ?>
          <span style="background-color:#333333;color:#FFFFFF;">1</span> <span style="background-color:#333333;color:#FFFFFF;">2</span> <span style="background-color:#333333;color:#FFFFFF;">3</span> <span style="background-color:#333333;color:#FFFFFF;">4</span> <span style="background-color:#333333;color:#FFFFFF;">5</span>
          <?php } ?>
          <span> Resolved in Reported Damages</span> </div>
<div class="addthis_div"><!-- AddThis Button BEGIN -->
          <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
          <script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script> 
          <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5139b09b14707fbc"></script> 
          <!-- AddThis Button END --> 
        </div>
      </div>
    </div>
  </section>
</section>
