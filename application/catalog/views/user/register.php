<?php echo $header;?>
<?php require('recaptchalib.php');?>
<link rel="stylesheet" href = "<?php echo base_url().'css/font-awesome.css';?>">
<style>
	@font-face {
	  font-family: 'FontAwesome';
	  src: url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.eot');
	  src: url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.eot?#iefix') format('embedded-opentype'),
		   url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.woff') format('woff'),
		   url('<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME']; ?>/font/Font-Awesome/fontawesome-webfont.ttf') format('truetype');
	  font-weight: normal;
	  font-style: normal;
	}
	.error
	{
		margin: 0 0 5px;
	}
</style> 
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
                                                          $("#emailtknerror").css('display', 'table');
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
                  $("#emailerror").css('display', 'table');
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
                                                          $("#utknerror").css('display', 'table');
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
				  $("#unameverror").css('display', 'table');
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
				  
			  $('#emailshow').click(function(e){
					e.preventDefault();
					$('.emailpage').slideToggle("slow");
				
				});
				  
             //$(".recaptcha_r2_c2").css({"background":"'url(http://www.google.com/recaptcha/api/img/white/sprite.png) no-repeat scroll -27px 0 rgba(0, 0, 0, 0) !important;'"});
			 
              <?php if( $this->uri->segment(2) =='register' ) { ?>
                  $("#btnsubmit").click(function () {
              <?php } ?>
              <?php if( $this->uri->segment(2) == 'edit' ) { ?>
                  $("#btnupdate").click(function () {
              <?php } ?>
              
					 
					 
					  var ffilter = /^[a-zA-Z- ]+$/; 
					  if( trim($("#firstname").val()) == "" )
					  {
						  $("#fnameerror").css('display', 'table');
						  $("#fnameverror").hide();
						  $("#firstname").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !ffilter.test(trim($("#firstname").val())) )
						  {
							  $("#fnameerror").hide();
							  $("#fnameverror").css('display', 'table');
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
						  $("#lnameerror").css('display', 'table');
						  $("#lnameverror").hide();
						  $("#lastname").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !ffilter.test(trim($("#lastname").val())) )
						  {
							  $("#lnameerror").hide();
							  $("#lnameverror").css('display', 'table');
							  $("#lastname").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#lnameverror").hide();
							  $("#lnameerror").hide();
						  }
					  }
                      
                      var filter1  = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
					  if( trim($("#username").val()) == "" )
					  {
						  $("#unameerror").css('display', 'table');
						  $("#unameverror").hide();
						  $("#username").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter1.test(trim($("#username").val())) )
						  {
							  $("#unameerror").hide();
							  $("#unameverror").css('display', 'table');
							  $("#username").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#unameerror").hide();
							  $("#unameverror").hide();
						  }
					  }
                      
                      var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( trim($("#email").val()) == "" )
					  {
						  $("#emailtknerror").hide();
						  $("#emailerror").css('display', 'table');
						  $("#email").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(trim($("#email").val())) )
						  {
							  $("#emailtknerror").hide();
							  $("#emailerror").css('display', 'table');
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
																		  $("#emailtknerror").css('display', 'table');
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
								  $("#emailerror").css('display', 'table');
								  $("#email").val('').focus();
								  return false;
							  }        
						  }
					  }
					  				  
					   <?php if($this->uri->segment(2) == 'register') { ?>
					  var pfilter = /^([a-zA-Z0-9-_+^&*%$#@!|?]{6,16})$/;
                      if( trim($("#password").val()) == "" )
                      {
                          $("#passerror").css('display', 'table');
                          $("#password").val('').focus();
                          return false;
                      }
                      else
                      {
                         if( !pfilter.test(trim($("#password").val())) )
						  {
							  $("#passerror").hide();
							  $("#passverror").css('display', 'table');
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
                          $("#repasserror").css('display', 'table');
                          $("#repassword").val('').focus();
                          return false;
                      }
                      else
                      {
                          if($("#repassword").val()!=$("#password").val())
                          {
                              $("#repasserror").css('display', 'table');
                              $("#repassword").val('').focus();
                              return false;
                          }
                          else
                          {
                              $("#repasserror").hide();
                          }
                      }
                      <?php } ?>
                      
                      
                      if(!$('.checkboxLabels').is(':checked'))
					  {
						  $('#termerror').show();
						  return false;
					  }
					  else
					  {
						  $('#termerror').hide();
					  }
			  
			  
					  if(trim($("#street").val()) == "")
						{	
							$("#streeterror").css('display', 'table');
							$("#street").val('').focus();
							return false;
						 } 
						else
						{ 
							$("#streeterror").hide();
						}
					
					 if(trim($("#city").val()) == "")
					 {	
						$("#cityerror").css('display', 'table');
						$("#city").val('').focus();
						return false;
					 } 
					else
			   		 {
						$("#cityerror").hide();
					 }
					 
					 if(trim($("#state").val()) == "")
					 {	
						$("#stateerror").css('display', 'table');
						$("#state").val('').focus();
						return false;
					 } 
					else
			   		 {
						$("#stateerror").hide();
					 }
					
					if(trim($("#zipcode").val()) == "")
							{
								$("#zipcodeerror").css('display', 'table');
								$("#zipcode").val('').focus();
								return false;
							}
							else
							{
								if( isNaN(trim($("#zipcode").val())) )
								{
									$("#zipcodeerror").css('display', 'table');
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
								$("#phonenoerror").css('display', 'table');
								$("#phonenoerror").focus();
								return false;
							}
							else
							{
								var pn = $("#phoneno1").val()+$("#phoneno2").val()+$("#phoneno3").val();
								if( isNaN((pn)) )
								{
									$("#phonenoerror").css('display', 'table');
									$("#phonenoerror").focus();
									return false;
								}
								else
								{
									$("#phonenoerror").hide();
						}
					}	

	
					 
					 
                      
                     
							
							
                      <?php if( $this->uri->segment(2) == 'register' ) { ?>
                      if(!$("#am_2").is(":checked") )
                      {
                          $("#termserror").css('display', 'table');
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
 <?php if( array_key_exists('olddata',$this->session->userdata))
					{
					//echo "<pre>";
					//print_r($this->session->userdata('olddata'));
					//die();
					
				   ?>
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
       
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </div>
    </div>
  </section>
</section>
 <?php } else  {?>
<div class = "account">
	<h3>Sign up on Yougotrated with</h3>    
	<div class = "account_option">	
		<div class="option facebookcolor" onclick="FBLogin();"><i class="fa fa-facebook facebookboder"></i><span>Create an account with Facebook</span></div>
		<a href="<?php echo site_url('go/register');?>" id="emailshow" class="option emailcolor"><i class="fa fa-envelope-o emailboder"></i><span>Create an account with Email</span></a>
	</div>
	    
     <div class="account_register" >
	   <form action="/go/update" id="frmuser" method="post" enctype="multipart/form-data" class="emailpage" style="display:none">
        <div class="account_container">
			
			<input type="text" class="textboxs" placeholder="FIRST NAME" id="firstname" name="firstname"  maxlength="50">
			<div id="fnameerror" class="error">First Name is required.</div>
            <div id="fnameverror" class="error">Enter Valid First Name(Only characters).</div>
			
            <input type="text" class="textboxs" placeholder="LAST NAME" id="lastname" name="lastname" maxlength="50">
            <div id="lnameerror" class="error">Last Name is required.</div>
            <div id="lnameverror" class="error">Enter Valid Last Name(Only characters).</div>
            
            
            <input type="text" class="textboxs" placeholder="USERNAME" id="username" name="username" maxlength="50" onchange="chkuser(this.value);" /> 
            <div id="unameerror" class="error">User Name is required.</div>
            <div id="unameverror" class="error">Enter Valid User Name(Only characters and numbers).</div>
            <div id="utknerror" class="error">This Username is already taken.</div>
            
            
            <input type="email" class="textboxs" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);"><span class="error" id="fnameerror">Email is required</span>                               
            <div id="emailerror" class="error">Enter valid Emailid.</div>
            <div id="emailtknerror" class="error">This Emailid already taken.</div>

            
            <input type="password" class="textboxs" placeholder="PASSWORD" id="password" name="password" />
            <div id="passerror" class="error">Password is required.</div>
            <div id="passverror" class="error">Enter valid password.(Mininum length 6)</div>
                 
            <input type="password" class="textboxs" placeholder="CONFIRM PASSWORD" id="repassword" name="repassword" />
            <div id="repasserror" class="error">Password and Confirm Password dont match.</div>
			
            <div>
				<input type="checkbox" class="checkboxLabels" value="1" name="terms"/>
				<label class="register_terms">I have read and agree to the Yougotrated <br>
				<a href="<?php echo site_url('footerpage/index/185');?>" title="TERMS AND CONDITIONS" target="_blank">TERMS AND CONDITIONS</a> and <a href="<?php echo site_url('footerpage/index/102');?>" title="PRIVACY POLICY" target="_blank">PRIVACY POLICY</a>
				</label>
				<div class="error" id="termerror">Check terms and conditions</div>
			</div>
            <button type="submit" class="login_buttons" style="margin-top:32px;" title="CREATE ACCOUNT" id="btnsubmit" name="btnsubmit">Register</button>
       </div>
      </form>
	</div>

	<div class="lgn_btnlogo"> <a><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
</div>
        
<?php  }?>
<?php echo $footer;?>
