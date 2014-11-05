<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="<?php echo $keywords?>">
	<meta name="description" content="<?php echo $description?>">
	<base href="<?php echo base_url();?>" />
	<title>Select OTP Method</title>


    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
    <!-- SB Admin CSS - Include with every page -->
    <link href="css/crypto_currency.css" rel="stylesheet">
    
    <script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
	
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.js"></script> 
	<!-- allowed only numbers-->

<!-- allowed only charactors-->


<!-- Script by hscripts.com -->
  
</head>

	<body><?php if( $this->session->flashdata('success') ) { ?>
        <div class="alert alert-success col-sm-6" style="margin-left:23%;
margin-right:23%;width:54%;"> <?php echo $this->session->flashdata('success'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
        <?php if( $this->session->flashdata('error') ) { ?>
        <div class="alert alert-danger col-sm-6" style="margin-left:23%;
margin-right:23%;width:54%;"> <?php echo $this->session->flashdata('error'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
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
    <!-- /.row --><?php if( $this->session->flashdata('success') ) { ?>
        <div class="alert alert-success col-sm-6" style=" margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 88%;"> <?php echo $this->session->flashdata('success'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
        <?php if( $this->session->flashdata('error') ) { ?>
        <div class="alert alert-danger col-sm-6" style=" margin-left: 7%;
    margin-right: 7%;margin-top:10px !important;
    width: 88%;"> <?php echo $this->session->flashdata('error'); ?> <a href="#" class="close" data-dismiss="alert">&times;</a> </div>
        <?php } ?>
    <div class="signup_part">
          <div class="user">
        <h2 class="fund_head">OTP Method</h2>
    
     
 

          
     <form action="user/update" id="frmedit" method="post">
            
            <fieldset>
              <label>Select Type<span class="required_star">*</span></label>
              <div class="gender">
            <div class="male">
                  <input id="otp" type="radio" value="SMS" name="otptype" class="selgender">
                  SMS </div>
            <div class="male">
                  <input id="otp" type="radio" value="EMAIL" class="male selgender" name="otptype" checked>
                  EMAIL </div>
          </div>
            </fieldset>
                    
        <fieldset>
              <div class="btn_panel">
            <button type="submit" name="changebtn" id="changebtn" class="subscribe_btn" value="Next" title="Next" tabindex="3">Next</button>
          </div>
            </fieldset>
            <input type="hidden" id="sendotp" name="sendotp" value="sendotp" />
     </form>
      </div>
        </div>
  </div>
    </div>
<?php echo $footer;?>

</body>
</html>
