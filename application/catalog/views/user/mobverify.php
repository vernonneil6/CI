<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="<?php echo $keywords?>">
<meta name="description" content="<?php echo $description?>">
<base href="<?php echo base_url();?>" />
<title>Mobile Verification</title>

<!-- Core CSS - Include with every page -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- SB Admin CSS - Include with every page -->
<link href="css/crypto_currency.css" rel="stylesheet">
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/moment.js"></script>
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
  <div id="wrapper">
    <?php if( $this->session->flashdata('success') ) { ?>
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
        <h2 class="fund_head">Mobile Verification</h2>
        <!--We have send you an OTP code to your email.Enter OTP code and new password here-->
        <fieldset>
          <div class="alert alert-danger col-sm-6 errormsg" id="otpcodeerror">OTP code is required.</div>
          <div class="alert alert-danger col-sm-6 errormsg" id="wrongotpcodeerror">OTP code is Wrong.</div>
        </fieldset>
       <?php if($user[0]['mobnumverified']=='No'){?>
        <form action="user/update" id="frmnewpass" method="post">
          <fieldset>
            <label>OTP code</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your OTP code" class="" id="otpcode" name="otpcode" maxlength="100">
          </fieldset>
          <fieldset>
            <div class="btn_panel" style="float:none !important;margin-left:350px;width:400px;">
              <button type="button" name="SendCodebtn" id="SendCodebtn" class="subscribe_btn" value="Send Code" title="Send Code" tabindex="3" style="float:none !important;" onClick="sendcode();">Send Code</button>
              <button type="submit" name="Verifybtn" id="Verifybtn" class="subscribe_btn" value="Verify" title="Verify" tabindex="3" style="float:none !important;">Verify</button>
            </div>
          </fieldset>
        </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
          function sendcode()
          {
              $.ajax({
               type 				: "POST",
               url 				: "<?php echo site_url('user/send'); ?>",
               data				:	{},
               dataType 			: "json",
               cache			    : false,
               success			: function(data){
                              		alert("");
									alert(data);
									alert("We have send you an OTP code to your registered mobile number and verify your mobile");
							   		//return false;
                                                                                                      }
                  });
              }
       </script> <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#Verifybtn").click(function () {
              
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
					 					
					$("#frmnewpass").submit();
                          
                  });
              

              });
          </script>
<?php echo $footer;?>
</body>
</html>
