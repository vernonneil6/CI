<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title><?php echo $title; ?></title><noscript>
 For full functionality of this site it is necessary to enable JavaScript.
 Here are the <a href="http://www.enable-javascript.com/" target="_blank">
 instructions how to enable JavaScript in your web browser</a>.
</noscript>
<link href="<?php echo base_url();?>css/login.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/login-blue.css" rel="stylesheet" type="text/css" />
<!-- color skin: blue / red / green / dark -->

<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.4.2.min.js"></script>  
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.js"></script>
<link rel="stylesheet" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/';?>css/fancybox.css" type="text/css">
<script type="text/javascript" src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/';?>js/fancybox.js"></script>
<script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
		
		
		$("#btnsubmit").click(function () {
			
			if( trim($("#user_name").val()) == "" )
			{
				$("#unameerror").show();
				$("#user_name").css("border", "1px solid #CD0B1C");
				$("#user_name").css("border-radius", "5px");
				$("#user_name").val('').focus();
				return false;
			}
			else
			{
				$("#user_name").css("border", "none");
				$("#unameerror").hide();
			}
			if( trim($("#user_pass").val()) == "" )
			{
				$("#passerror").show();
				$("#user_pass").css("border", "1px solid #CD0B1C");
				$("#user_pass").css("border-radius", "5px");
				$("#user_pass").val('').focus();
				return false;
			}
			else
			{
				$("#user_name").css("border", "none");
				$("#passerror").hide();
			}
			
			if( $("#form-login").submit() )
			{
				$("#error").attr('style','display:none;');
			}
					
		});
	
	});
	
function popup()
{
	$.fancybox.open('#popup_box');
}
</script>
<script type="text/javascript">
	$(function(){
		$(".close-red").click(function () {
				$("#message-red").fadeOut("slow");
		});
	});
</script>
</head>

<?php if($this->uri->segment(3) == 'popup')
{
?> 
	<script type='text/javascript'> 
		$(document).ready(function()
		{  
			popup(); 
		}); 
	</script>
<?php	
} ?>
<div id = "popup_box" style = "display : none; height: 15px; padding: 20px; width: 555px;  margin: 0 auto;">
	<div>
		<?php 
		$url =  'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/solution/renew/'.$this->uri->segment(4);
		echo 'Your account is currently disabled. Please <a href='.$url.' style="text-decoration:none;">CLICK HERE</a> to make a payment to re-enable your account.'; 
		?>
	</div>
</div>

<body>

<div id="main">
	<div class="business_yougot_logo">
	<a href="<?php echo base_url();?>" title="<?php echo $site_name;?>"><img src="/images/YGR_whiteLogo.png" alt="<?php echo $site_name;?>" title="<?php echo $site_name;?>"></a>
</div>
  <div id="content">
    <div id="login">
      <div id="logo"><span>Elite Member Login</span></div>
     
      <!-- Error form message -->
      <?php if( $this->session->flashdata('error') ) { ?>    
<div class="form-message error" id="message-red">
<?php echo $this->session->flashdata('error'); ?>
                <a class="close-red"><img src="<?php echo base_url(); ?>images/error.gif" alt="Close"/></a>

            </div>
      <?php } ?>
      
     <?php if( $this->session->flashdata('success') ) { ?>
    <div class="form-message correct" style="background:#E4FFD4 !important;">
      <p><?php echo $this->session->flashdata('success'); ?></p>
    </div>
    <?php } ?>
      
      <?php echo form_open('adminlogin/index/',array('class'=>'formBox','id'=>'form-login')); ?> 
      
      <fieldset>
      
        <div class="form-col">
          <label for="user_name" class="lab">Username</label>
          <?php echo form_input(array('name'=>'user_name','id'=>'user_name','class'=>"input-medium focused input",'type'=>'text')); ?>
          <div id="unameerror" class="error-note">Username is required.</div>
 
        </div>
        
        <div class="form-col form-col-right">
          <label for="user_pass" class="lab">Password</label>
          <?php echo form_input(array('name'=>'user_pass','id'=>'user_pass','class'=>"input-medium focused input",'type'=>'password'));?> 
          <div id="passerror" class="error-note">Password is required.</div>       
        </div>
        <div class="form-col">
          <label class="lab"><a href="adminlogin/forgotpassword" title="Forgot Password?" style="color:#FFF;text-decoration:none;">Forgot Password?</a></label>
          <label class="lab"><a href="adminlogin/forgotusername" title="Forgot Username?" style="color:#FFF;text-decoration:none;">Forgot Username?</a></label>
 
        </div>
        
        <div class="form-col form-col-right">
		<?php echo form_input(array('name'=> 'btnsubmit','id'=>'btnsubmit','class'=> 'submit','type'=>'submit','value'=>'Login')); ?> 
        </div>
        
        
      </fieldset>
      
      <?php echo form_close();?>
      </div>
  </div>
  <!-- /content --> 
  
</div>
<!-- /main -->

</body>
</html>
<style>
.fancybox-overlay
{
	background: rgba(0, 0, 0, 0.5);
}
.fancybox-inner
{
	height:auto!important;
	width:auto!important;
}
.fancybox-skin
{
	padding:unset!important;
}
</style>
