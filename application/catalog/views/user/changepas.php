<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>Create New Password</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
    <!-- SB Admin CSS - Include with every page -->
    <link href="css/crypto_currency.css" rel="stylesheet">
    <script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
	
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.js"></script> 
	   <script language="javascript" src="js/jquery.passstrength.js"></script>
    <script>
$(document).ready(function()
{
  $('#password').passStrengthify({
      minimum: 4,
      labels: {
        tooShort: 'Too short',
      
    }});
	
	
		 
});


</script>

<script type="text/javascript" language="javascript">
              	  $(document).ready(function() {
				  alert("<?php echo $msgflashdata;?>");
				  }
</script>


<style>
.passStrengthify
{
float: left;
height: 30px;
margin-left: 359px;
}
</style>
    
    
    <script>
		(function($){
			$(window).load(function(){
				
				
				/* custom scrollbar fn call */
				$(".content_2").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
				})
				
			});
		})(jQuery);
	</script>
    
    

</head>

	<body>
<?php echo $header;?>

<!-- /.header-top-links -->
<div class="menu_wrapper">
      <div id="wrapper">
    <div class="menu">
          <div class="navbar-default" role="navigation">
        <ul class="nav" id="side-menu">
              <li> <a href="<?php echo base_url();?>" title="home">Home</a> </li>
              <li> <a href="#" title="trade">Trade</a> </li>
              <li> <a href="page/About-Us" title="about us">About us</a> </li>
              <li> <a href="page/Support" title="support ">support </a> </li>
              <li> <a href="faq" title="faq">faq</a> </li>
            </ul>
      </div>
        </div>
  </div>
    </div>
<div class="section_wrapper">
      <div id="wrapper"> <?php if( $this->session->flashdata('success') ) { ?>
        <div class="alert alert-success col-sm-6" style=" margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 88%;"> <?php echo $this->session->flashdata('success'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
        <?php if( $this->session->flashdata('error') ) { ?>
        <div class="alert alert-danger col-sm-6" style=" margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 88%;"> <?php echo $this->session->flashdata('error'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
    <!-- /.row -->
    <div class="signup_part">
          <div class="user">
        <h2 class="fund_head">New password</h2>
    
     <script type="text/javascript">
          function chkOTPcode(code)
          {
              var otp = $("#otp_val").val();
			  if(otp!=code)
			  {
			 	  $("#wrongotpcodeerror").show();
				  $("#otpcodeerror").hide();
                  $("#otpcode").val('').focus();
                  return false;
			  }
			  else
			  {
			  	  $("#wrongotpcodeerror").hide();
				  $("#otpcodeerror").hide();
			  }
             
          }
		  
		  
      </script>
 
<script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#newpassbtn").click(function () {
              
				 	  if( trim($("#otpcode").val()) == "" )
					  {
						  $("#otpcodeerror").show();
						  $("#otpcode").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#otpcodeerror").hide();
					  }
					  
					  var pfilter = /^(?=.*\d).{8,18}$/;
                      if( trim($("#password").val()) == "" )
                      {
                          $("#passerror").show();
						  $("#passverror").hide();
                          $("#password").val('').focus();
                          return false;
                      }
                      else
                      {
                         if( !pfilter.test(trim($("#password").val())) )
						  {
							  $("#passerror").hide();
							  $("#passverror").show();
							  $("#password").focus();
							  return false;
						  }
						  else
						  {
							  $("#passverror").hide();
							  $("#passerror").hide();
						  }
                      }
                      
                      if( trim($("#repassword").val()) == "")
                      {
                          $("#repasserror").show();
                          $("#repassword").val('').focus();
                          return false;
                      }
                      else
                      {
                          if($("#repassword").val()!=$("#password").val())
                          {
                              $("#repasserror").show();
                              $("#repassword").val('').focus();
                              return false;
                          }
                          else
                          {
                              $("#repasserror").hide();
                          }
                      }
					  
					  chkOTPcode($("#otpcode").val());
					  $("#frmnewpass").submit();
                          
                  });
              
              });
          </script>
          <script>
		  
		  
         alert("<?php echo $msgflashdata;?>");</script>
          <fieldset>
        <div class="alert alert-danger col-sm-6 errormsg" id="otpcodeerror">OTP code is required.</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="wrongotpcodeerror">OTP code is Wrong.</div>
        
        <div class="alert alert-danger col-sm-6 errormsg" id="passerror"> Password required.</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="repasserror"> Password and Confirm Password does not match. </div>
        <div class="alert alert-danger col-sm-6 errormsg" id="passverror">Password must be between 8 and 18 digits long and include at least one numeric digit.</div>
        
        
        </fieldset>
     <form action="user/update" id="frmnewpass" method="post">
        
        <fieldset>
              <label>OTP code<span class="required_star">*</span></label>
              <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your OTP code" class="" id="otpcode" name="otpcode" maxlength="100" onChange="chkOTPcode(this.value);">
            </fieldset>
        <fieldset>
              <label>New Password<span class="required_star">*</span></label>
              <input type="password" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your New Password" class="password_id" id="password" name="password" maxlength="30">
            </fieldset>
            <fieldset>
              <label>Confirm Password<span class="required_star">*</span></label>
              <input type="password" autofocus="" autocomplete="off" tabindex="1" placeholder="Confirm your Password" class="password_id" id="repassword" name="repassword" maxlength="30">
            </fieldset>
        <fieldset>
              <div class="btn_panel">
            <button type="submit" name="newpassbtn" id="newpassbtn" class="subscribe_btn" value="Update" title="Update" tabindex="3">Update</button>
          </div>
            </fieldset>
            <input type="hidden" id="newpassfrm" name="newpassfrm" value="newpassfrm" />
			<input type="hidden" id="otp_val" name="otp_val" value="<?php  echo $otpcode;?>" />
	     </form>
      </div>
        </div>
  </div>
    </div>
<?php echo $footer;?>

</body>
</html>
