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
<script type="text/javascript" language="javascript">
	function trim(stringToTrim) {
		return stringToTrim.replace(/^\s+|\s+$/g,"");
	}
	$(document).ready(function() {
		
		$("#btnsubmit").click(function () {
			
			var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			if( trim($("#email").val()) == "" )
			{
				$("#emailerror").show();
				$("#email").val('').focus();
				return false;
			}
			else
			{
				if( !filter.test(trim($("#email").val())) )
				{
					$("#emailerror").show();
					$("#email").val('').focus();
					return false;

				}

			}
			
			if( $("#form-forgot").submit() )
			{
				$("#error").attr('style','display:none;');
			}
					
		});
	
	});
</script>
<script type="text/javascript">
	$(function(){
		$(".close-red").click(function () {
				$("#message-red").fadeOut("slow");
		});
	});
</script>
</head>

<body>
<div id="main">
  <div id="content">
    <div id="login">
      <div id="logo"><span>Business Admin</span></div>
     
      <!-- Error form message -->
      <?php if( $this->session->flashdata('error') ) { ?>    
<div class="form-message error" id="message-red">
<?php echo $this->session->flashdata('error'); ?>
                <a class="close-red"><img src="<?php echo base_url(); ?>images/error.gif" alt="Close"/></a>

            </div>
      <?php } ?>
      
      <?php echo form_open('adminlogin/update/',array('class'=>'formBox','id'=>'form-forgot')); ?> 
      
      <fieldset style="margin-left:87px !important;">
      
        <div class="form-col">
          <label for="user_name" class="lab">Email</label>
          <?php echo form_input(array('name'=>'email','id'=>'email','class'=>"input-medium focused input",'type'=>'text')); ?>
          <div id="emailerror" class="error-note">Enter valid email.</div>
 
        </div>
        <div class="form-col">
		<?php echo form_input(array('name'=> 'btnsubmit','id'=>'btnsubmit','class'=> 'submit','type'=>'submit','value'=>'Submit','style'=>'margin-left: 10px;
    margin-top: 19px;')); ?> 
        </div>
        <input type="hidden" name="forgottype" value="<?php echo $this->uri->segment(2);?>" />
       </fieldset>
      
      <?php echo form_close();?>
      </div>
  </div>
  <!-- /content --> 
  
</div>
<!-- /main -->

</body>
</html>