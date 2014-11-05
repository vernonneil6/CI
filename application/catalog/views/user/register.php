<?php echo $header;?>
<?php require('recaptchalib.php');?>
<script type="text/javascript">
          function trim(stringToTrim) {
              return stringToTrim.replace(/^\s+|\s+$/g,"");
          }
          function chkmail(email)
          {
             var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              if( trim(email) != '' && filter.test(trim(email)) )
              {
                  $("#emailerror").hide();
                  $.ajax({
                      type 				: "POST",
                      url 				: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$user[0]['id'].", "; ?>'email' : email },
                      dataType 		: "json",
                      cache				: false,
                      success			: function(data){
                                                      if( data.result == 'old')
                                                      {
                                                          $("#emailerror").hide();
                                                          $("#emailtknerror").show();
                                                          $("#email").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                          $("#emailtknerror").hide();
                                                      }
                                                  }
                  });
              }
              else
              {
                  $("#emailtknerror").hide();
                  $("#emailerror").show();
                  $("#email").val('').focus();
                  return false;
              }
          }
		  
		  function chkuser(username)
          {
              var filter  = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
              if( trim(username) != '' && filter.test(trim(username)) )
              {
                  $("#unameerror").hide();
				  $("#unameverror").hide();
				  $("#utknerror").hide();
                  $.ajax({
                      type 				: "POST",
                      url 				: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$user[0]['id'].", "; ?>'username' 		: username },
                      dataType 			: "json",
                      cache				: false,
                      success			: function(data){
                     if( data.result == 'old')
                                                      {
                                                          $("#unameerror").hide();
                                                          $("#utknerror").show();
                                                          $("#username").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                          $("#utknerror").hide();
                                                      }
                                                  }
                  });
              }
              else
              {
                  $("#unameerror").hide();
				  $("#unameverror").show();
				  $("#utknerror").hide();
                  $("#username").val('').focus();
                  return false;
              }
          }
      </script>
<script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
				  
				  
             //$(".recaptcha_r2_c2").css({"background":"'url(http://www.google.com/recaptcha/api/img/white/sprite.png) no-repeat scroll -27px 0 rgba(0, 0, 0, 0) !important;'"});
			 
              <?php if( $this->uri->segment(2) =='register' ) { ?>
                  $("#btnsubmit").click(function () {
              <?php } ?>
              <?php if( $this->uri->segment(2) == 'edit' ) { ?>
                  $("#btnupdate").click(function () {
              <?php } ?>
              
					 var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( trim($("#email").val()) == "" )
					  {
						  $("#emailtknerror").hide();
						  $("#emailerror").show();
						  $("#email").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(trim($("#email").val())) )
						  {
							  $("#emailtknerror").hide();
							  $("#emailerror").show();
							  $("#email").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#emailerror").hide();
							  email = $("#email").val();  
              //alert(email);
              var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              if( trim(email) != '' && filter.test(trim(email)) )
              {
                  $("#emailerror").hide();
                  //Return from conroller in php code : echo json_encode(array("result"=>"exist"));
                  $.ajax({
                      type 				: "POST",
                      url 				: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ <?php if($this->uri->segment(2) == 'edit' ) echo "'id' : ".$user[0]['id'].", "; ?>'email' : email },
                      dataType 		: "json",
                      cache				: false,
                      success			: function(data){
                                                      //alert(data.result); return false;
                                                      if( data.result == 'old')
                                                      {
                                                          $("#emailerror").hide();
                                                          $("#emailtknerror").show();
                                                          $("#email").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                          $("#emailtknerror").hide();
                                                      }
                                                  }
                  });
              }
              else
              {
                  $("#emailtknerror").hide();
                  $("#emailerror").show();
                  $("#email").val('').focus();
                  return false;
              }
          
						  }
					  }
					 
					  var ffilter = /^[a-zA-Z- ]+$/; 
					  if( trim($("#firstname").val()) == "" )
					  {
						  $("#fnameerror").show();
						  $("#fnameverror").hide();
						  $("#firstname").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !ffilter.test(trim($("#firstname").val())) )
						  {
							  $("#fnameerror").hide();
							  $("#fnameverror").show();
							  $("#firstname").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#fnameverror").hide();
							  $("#fnameerror").hide();
						  }
					  }
					  
					  if( trim($("#lastname").val()) == "" )
					  {
						  $("#lnameerror").show();
						  $("#lnameverror").hide();
						  $("#lastname").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !ffilter.test(trim($("#lastname").val())) )
						  {
							  $("#lnameerror").hide();
							  $("#lnameverror").show();
							  $("#lastname").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#lnameverror").hide();
							  $("#lnameerror").hide();
						  }
					  }
                      
					  if(trim($("#street").val()) == "")
					{	
						$("#streeterror").show();
						$("#street").val('').focus();
						return false;
					 } 
					else
			   		{ 
						$("#streeterror").hide();
					}
					
					 if(trim($("#city").val()) == "")
					 {	
						$("#cityerror").show();
						$("#city").val('').focus();
						return false;
					 } 
					else
			   		 {
						$("#cityerror").hide();
					 }
					 
					 if(trim($("#state").val()) == "")
					 {	
						$("#stateerror").show();
						$("#state").val('').focus();
						return false;
					 } 
					else
			   		 {
						$("#stateerror").hide();
					 }
					
					if(trim($("#zipcode").val()) == "")
							{
								$("#zipcodeerror").show();
								$("#zipcode").val('').focus();
								return false;
							}
							else
							{
								if( isNaN(trim($("#zipcode").val())) )
								{
									$("#zipcodeerror").show();
									$("#zipcode").val('').focus();
									return false;
								}
								else
								{
													$("#zipcodeerror").hide();
								}
					}
					  
					if(($("#phoneno1").val()) == "" || ($("#phoneno2").val()) == "" || ($("#phoneno3").val()) == "")
							{
								$("#phonenoerror").show();
								$("#phonenoerror").focus();
								return false;
							}
							else
							{
								var pn = $("#phoneno1").val()+$("#phoneno2").val()+$("#phoneno3").val();
								if( isNaN((pn)) )
								{
									$("#phonenoerror").show();
									$("#phonenoerror").focus();
									return false;
								}
								else
								{
									$("#phonenoerror").hide();
						}
					}	

	var filter1  = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
					  if( trim($("#username").val()) == "" )
					  {
						  $("#unameerror").show();
						  $("#unameverror").hide();
						  $("#username").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter1.test(trim($("#username").val())) )
						  {
							  $("#unameerror").hide();
							  $("#unameverror").show();
							  $("#username").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#unameerror").hide();
							  $("#unameverror").hide();
						  }
					  }
					 
					 
                      
                      <?php if($this->uri->segment(2) == 'register') { ?>
					  var pfilter = /^([a-zA-Z0-9-_+^&*%$#@!|?]{6,16})$/;
                      if( trim($("#password").val()) == "" )
                      {
                          $("#passerror").show();
                          $("#password").val('').focus();
                          return false;
                      }
                      else
                      {
                         if( !pfilter.test(trim($("#password").val())) )
						  {
							  $("#passerror").hide();
							  $("#passverror").show();
							  $("#password").val('').focus();
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
                      <?php } ?>
							
							
                      <?php if( $this->uri->segment(2) == 'register' ) { ?>
                      if(!$("#am_2").is(":checked") )
                      {
                          $("#termserror").show();
                          $("#termserror").focus();
                          return false;
                      }
                      else
                      {
                          $("#termserror").hide();
                      }
                      <?php } ?>
                      
					  
					  $("#frmuser").submit();
                          
                  });
              
              });
          </script>

<section class="container">
  <section class="main_contentarea">
    <div class="banner_wrp"> <img src="images/YouGotRated_HeaderGraphics_SignUpPage.png" class="containerimg" alt="Register" title="Register"> </div>
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"> REGISTRATION: <a title="New User">NEW USER</a> </div>
        <div class="reg_buslnk">ARE YOU REGISTERING A BUSINESS? <a href="businessdirectory/add" title="Please Click Here">PLEASE CLICK HERE</a></div>
      </div>
    </div>
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"> ONCE YOU REGISTER ,YOU CAN SUBMIT A COMPLAINT. </div>
      </div>
    </div>
    <div class="container">
      <div class="reg_step"></div>
      <div class="reg_frm_wrap">
        <?php if( array_key_exists('olddata',$this->session->userdata))
					{
					//echo "<pre>";
					//print_r($this->session->userdata('olddata'));
					//die();
					
				   ?>
        
        <form class="reg_frm" action="user/update" id="frmuser" method="post" enctype="multipart/form-data">
          <div class="reg-row">
            <label>YOUR E-MAIL ADDRESS</label>
            <div class="reg_fld">WHERE DO YOU RECEIVE YOUR E-MAIL?</div>
            <input type="email" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);" value="<?php echo $this->session->userdata['olddata']['email'];?>">
            <div id="emailerror" class="error">Enter valid Emailid.</div>
            <div id="emailtknerror" class="error">This Emailid already taken.</div>
          </div>
          <div class="reg-row">
            <label>INTRODUCE YOURSELF</label>
            <div class="reg_fld">WHAT IS YOUR NAME?</div>
            <input type="text" class="reg_txt_box" placeholder="FIRST NAME" id="firstname" name="firstname"  maxlength="30" value="<?php echo $this->session->userdata['olddata']['firstname'];?>">
            <input type="text" class="reg_txt_box pull-right" placeholder="LAST NAME" id="lastname" name="lastname" maxlength="30" value="<?php echo $this->session->userdata['olddata']['lastname'];?>">
            <div id="fnameerror" class="error">First Name is required.</div>
            <div id="fnameverror" class="error">Enter Valid First Name(Only characters).</div>
            <div id="lnameerror" class="error">Last Name is required.</div>
            <div id="lnameverror" class="error">Enter Valid Last Name(Only characters).</div>
            <div class="reg_fld" style="margin-top:35px;"> PLEASE SELECT YOUR GENDER.</div>
            <fieldset id="gender" class="gender">
              <div class="gdr_male">
                <input type="radio" checked="checked" name="gender" id="male" value="Male">
                <label for="male">Male</label>
              </div>
              <div class="gdr_female">
                <input type="radio" name="gender" id="female" value="Female">
                <label for="female">Female</label>
              </div>
            </fieldset>
          </div>
          <div class="reg-row">
            <label>YOUR CONTACT INFORMATION</label>
            <div class="reg_fld">WHAT IS YOUR ADDRESS?</div>
            <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE 1" name="street[]" id="street"  maxlength="50" value="<?php echo $this->session->userdata['olddata']['street'][0];?>">
            <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE 2" name="street[]" maxlength="50" value="<?php echo $this->session->userdata['olddata']['street'][1];?>" />
            <input type="text" class="reg_txt_box-md" placeholder="CITY" id="city" name="city" maxlength="50" value="<?php echo $this->session->userdata['olddata']['city'];?>">
            <input type="text" class="reg_txt_box-xsml" placeholder="STATE" id="state" name="state" maxlength="50" value="<?php echo $this->session->userdata['olddata']['state'];?>">
            <input type="text" class="reg_txt_box-xsml" placeholder="ZIP CODE" id="zipcode" name="zipcode" maxlength="10" value="<?php echo $this->session->userdata['olddata']['zipcode'];?>">
            <div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR PHONE NUMBER?</div>
            <div> (&nbsp;
              <input type="text" class="reg_mb_box-sm" placeholder="XXX" name="phoneno[]" maxlength="3" id="phoneno1" value="<?php echo $this->session->userdata['olddata']['phoneno'][0];?>">
              &nbsp;)&nbsp;&nbsp;
              <input type="text" class="reg_mb_box-sm" placeholder="XXX" name="phoneno[]" maxlength="4" id="phoneno2" value="<?php echo $this->session->userdata['olddata']['phoneno'][1];?>">
              &nbsp; -
              &nbsp;
              <input type="text" class="reg_mb_box-xsm" placeholder="XXXX" name="phoneno[]" maxlength="4" id="phoneno3" value="<?php echo $this->session->userdata['olddata']['phoneno'][2];?>">
            </div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="cityerror" class="error">City is required.</div>
            <div id="stateerror" class="error">State is required.</div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="zipcodeerror" class="error">Enter digits only.</div>
          </div>
          <div id="phonenoerror" class="error">Enter Phone number.</div>
          <div class="reg-row" style="margin-top:55px;">
            <label>YOUR USERNAME AND PASSWORD</label>
            <div class="reg_fld">CREATE A USERNAME.</div>
            <input type="text" class="reg_txt_box" placeholder="USERNAME" id="username" name="username" maxlength="30" onchange="chkuser(this.value);" value="<?php echo $this->session->userdata['olddata']['username'];?>">
            <div id="unameerror" class="error">User Name is required.</div>
            <div id="unameverror" class="error">Enter Valid User Name(Only characters and numbers).</div>
            <div id="utknerror" class="error">This Username is already taken.</div>
            <div>
              <div class="reg_fld" style="margin-top:36px;">CHOOSE YOUR PASSWORD.</div>
              <input type="password" class="reg_txt_box" placeholder="PASSWORD" id="password" name="password" value="<?php echo $this->session->userdata['olddata']['password'];?>">
              <input type="password" class="reg_txt_box pull-right" placeholder="CONFIRM PASSWORD" id="repassword" name="repassword" value="<?php echo $this->session->userdata['olddata']['password'];?>">
              <div id="passerror" class="error">Password is required.</div>
              <div id="passverror" class="error">Enter valid password.(Mininum length 6)</div>
              <div id="repasserror" class="error">Password and Confirm Password dont match.</div>
            </div>
          </div>
          <div class="reg-row">
            <label>YOUR PROFILE PHOTO</label>
            <div class="reg_fld">UPLOAD A PHOTO FOR YOUR PROFILE</div>
            <input type="file" class="filupload" name="avatarbig">
          </div>
          <div class="reg-row">
            <label>TERMS, CONDITIONS, AND A CAPTCHA</label>
            <div class="reg_fld">PLEASE COMPLETE THESE FINAL STEPS TO CREATE YOUR NEW ACCOUNT.</div>
            <div class="term_tag" dir="seltdterms">
              <input type="checkbox" class="checkboxLabel" id="am_2" value="1" name="terms"/>
              <label for="am_2">I HAVE READ AND AGREE TO THE YOUGOTRATED <a href="<?php echo site_url('terms');?>" title="TERMS AND CONDITIONS" target="_blank">TERMS AND CONDITIONS</a>.</label>
            </div>
            <div id="termserror" class="error">Please Agree to TERMS AND CONDITIONS</div>
            <div class="reg_fld" style="margin-top:35px;">DEPICT THE CAPTCHA.</div>
            <div class="captcha">
              <?php
// Get a key from https://www.google.com/recaptcha/admin/create
//$publickey = "6Lc6OeISAAAAAGVrvwrsSrQt9tD2g0pFUK3c4Psw";
//$privatekey = "6Lc6OeISAAAAAKYZfn5p5Jzcw73dUzCQInvSAJ_Z";
$publickey = "6LervvQSAAAAAN853Cz4_bSGZw_RecoxnWudpVfA";
$privatekey = "6LervvQSAAAAACoH9Voy49fMfMWyHgwbhO7qo6PW";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?

echo recaptcha_get_html($publickey, $error);
?>
            </div>
          </div>
          <div class="reg-row" style="margin-top:27px;">
            <label>CREATE YOUR ACCOUNT</label>
            <div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="CREATE ACCOUNT" id="btnsubmit" name="btnsubmit">CREATE ACCOUNT</button>
          </div>
        </form>
        <?php } else
				   {?>
        <form class="reg_frm" action="user/update" id="frmuser" method="post" enctype="multipart/form-data">
          <div class="reg-row">
            <label>YOUR E-MAIL ADDRESS</label>
            <div class="reg_fld">WHERE DO YOU RECEIVE YOUR E-MAIL?</div>
            <input type="email" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);">
            <div id="emailerror" class="error">Enter valid Emailid.</div>
            <div id="emailtknerror" class="error">This Emailid already taken.</div>
          </div>
          <div class="reg-row">
            <label>INTRODUCE YOURSELF</label>
            <div class="reg_fld">WHAT IS YOUR NAME?</div>
            <input type="text" class="reg_txt_box" placeholder="FIRST NAME" id="firstname" name="firstname"  maxlength="30">
            <input type="text" class="reg_txt_box pull-right" placeholder="LAST NAME" id="lastname" name="lastname" maxlength="30">
            <div id="fnameerror" class="error">First Name is required.</div>
            <div id="fnameverror" class="error">Enter Valid First Name(Only characters).</div>
            <div id="lnameerror" class="error">Last Name is required.</div>
            <div id="lnameverror" class="error">Enter Valid Last Name(Only characters).</div>
            <div class="reg_fld" style="margin-top:35px;"> PLEASE SELECT YOUR GENDER.</div>
            <fieldset id="gender" class="gender">
              <div class="gdr_male">
                <input type="radio" checked="checked" name="gender" id="male" value="Male">
                <label for="male">Male</label>
              </div>
              <div class="gdr_female">
                <input type="radio" name="gender" id="female" value="Female">
                <label for="female">Female</label>
              </div>
            </fieldset>
          </div>
          <div class="reg-row">
            <label>YOUR CONTACT INFORMATION</label>
            <div class="reg_fld">WHAT IS YOUR ADDRESS?</div>
            <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE 1" name="street[]" id="street"  maxlength="50">
            <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE 2" name="street[]" maxlength="50">
            <input type="text" class="reg_txt_box-md" placeholder="CITY" id="city" name="city" maxlength="50" />
            <input type="text" class="reg_txt_box-xsml" placeholder="STATE" id="state" name="state" maxlength="50" />
            <input type="text" class="reg_txt_box-xsml" placeholder="ZIP CODE" id="zipcode" name="zipcode" maxlength="10" />
            <div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR PHONE NUMBER?</div>
            <div> (&nbsp;
              <input type="text" class="reg_mb_box-sm" placeholder="XXX" name="phoneno[]" maxlength="3" id="phoneno1">
              &nbsp;)&nbsp;&nbsp;
              <input type="text" class="reg_mb_box-sm" placeholder="XXX" name="phoneno[]" maxlength="4" id="phoneno2">
              &nbsp; -
              &nbsp;
              <input type="text" class="reg_mb_box-xsm" placeholder="XXXX" name="phoneno[]" maxlength="4" id="phoneno3">
            </div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="cityerror" class="error">City is required.</div>
            <div id="stateerror" class="error">State is required.</div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="zipcodeerror" class="error">Enter digits only.</div>
          </div>
          <div id="phonenoerror" class="error">Enter Phone number.</div>
          <div class="reg-row" style="margin-top:55px;">
            <label>YOUR USERNAME AND PASSWORD</label>
            <div class="reg_fld">CREATE A USERNAME.</div>
            <input type="text" class="reg_txt_box" placeholder="USERNAME" id="username" name="username" maxlength="30" onchange="chkuser(this.value);" />
            <div id="unameerror" class="error">User Name is required.</div>
            <div id="unameverror" class="error">Enter Valid User Name(Only characters and numbers).</div>
            <div id="utknerror" class="error">This Username is already taken.</div>
            <div>
              <div class="reg_fld" style="margin-top:36px;">CHOOSE YOUR PASSWORD.</div>
              <input type="password" class="reg_txt_box" placeholder="PASSWORD" id="password" name="password" />
              <input type="password" class="reg_txt_box pull-right" placeholder="CONFIRM PASSWORD" id="repassword" name="repassword" />
              <div id="passerror" class="error">Password is required.</div>
              <div id="passverror" class="error">Enter valid password.(Mininum length 6)</div>
              <div id="repasserror" class="error">Password and Confirm Password dont match.</div>
            </div>
          </div>
          <div class="reg-row">
            <label>YOUR PROFILE PHOTO</label>
            <div class="reg_fld">UPLOAD A PHOTO FOR YOUR PROFILE</div>
            <input type="file" class="filupload" name="avatarbig">
          </div>
          <div class="reg-row">
            <label>TERMS, CONDITIONS, AND A CAPTCHA</label>
            <div class="reg_fld">PLEASE COMPLETE THESE FINAL STEPS TO CREATE YOUR NEW ACCOUNT.</div>
            <div class="term_tag" dir="seltdterms">
              <input type="checkbox" class="checkboxLabel" id="am_2" value="1" name="terms"/>
              <label for="am_2">I HAVE READ AND AGREE TO THE YOUGOTRATED <a href="<?php echo site_url('terms');?>" title="TERMS AND CONDITIONS" target="_blank">TERMS AND CONDITIONS</a>.</label>
            </div>
            <div id="termserror" class="error">Please Agree to TERMS AND CONDITIONS</div>
            <div class="reg_fld" style="margin-top:35px;">DEPICT THE CAPTCHA.</div>
            <div class="captcha">
              <?php
// Get a key from https://www.google.com/recaptcha/admin/create
//$publickey = "6Lc6OeISAAAAAGVrvwrsSrQt9tD2g0pFUK3c4Psw";
//$privatekey = "6Lc6OeISAAAAAKYZfn5p5Jzcw73dUzCQInvSAJ_Z";
$publickey = "6LervvQSAAAAAN853Cz4_bSGZw_RecoxnWudpVfA";
$privatekey = "6LervvQSAAAAACoH9Voy49fMfMWyHgwbhO7qo6PW";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?

echo recaptcha_get_html($publickey, $error);
?>
            </div>
          </div>
          <div class="reg-row" style="margin-top:27px;">
            <label>CREATE YOUR ACCOUNT</label>
            <div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="CREATE ACCOUNT" id="btnsubmit" name="btnsubmit">CREATE ACCOUNT</button>
          </div>
        </form>
        <?php
				   }?>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?>