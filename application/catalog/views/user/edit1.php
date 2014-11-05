<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="<?php echo $keywords?>">
<meta name="description" content="<?php echo $description?>">
<base href="<?php echo base_url();?>" />
<title><?php echo $title?></title>

<!-- Core CSS - Include with every page -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
<!-- SB Admin CSS - Include with every page -->
<link href="css/crypto_currency.css" rel="stylesheet">
<link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
<script>!window.jQuery && document.write(unescape('%3Cscript src="js/minified/jquery-1.9.1.min.js"%3E%3C/script%3E'))</script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
	  $(function() {
		var nowDate = new Date();
		//alert(nowDate);
		//var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
		var y = nowDate.getFullYear();
		var m = nowDate.getMonth();
		var d = nowDate.getDate();
		
		$('#datetimepicker4').datetimepicker({
    	maxDate: new Date((y-18),m,d),
		pickTime: false,
		
		});
		
	});
	</script>

<!-- allowed only numbers-->
<script>
$(document).ready(function () {
   $(".numbers").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
	  {
     	return false;
      }
   });
   
   $(".charactors").keypress(function (e) {
     //alert(e.which);
	 if (e.which < 64 || e.which < 91)
	  {
     	return false;
      }
   });
});    
</script>
<!-- allowed only charactors-->

<!-- Script by hscripts.com -->

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
    <!-- /.row -->
    
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
    
    <div class="signup_part">
      <div class="user">
        <h2 class="fund_head">Edit Profie</h2>
        <script type="text/javascript">
          function trim(stringToTrim) {
              return stringToTrim.replace(/^\s+|\s+$/g,"");
          }
          function chkmail(email)
          {
              //alert(email);
              var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              if( trim(email) != '' && filter.test(trim(email)) )
              {
                  $("#emailerror").hide();
                  //Return from conroller in php code : echo json_encode(array("result"=>"exist"));
                  $.ajax({
                      type 				: "POST",
                      url 					: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ 'email' : email },
                      dataType 			: "json",
                      cache			   : false,
                      success			 : function(data){
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
		  
		  
      </script> 
        <script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#editbtn").click(function () {
              
				 	 if( trim($("#firstname").val()) == "" )
					  {
						  $("#firstnameerror").show();
						  $("#firstname").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#firstnameerror").hide();
					  }
					  
					  if( trim($("#lastname").val()) == "" )
					  {
						  $("#lastnameerror").show();
						  $("#lastname").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#lastnameerror").hide();
					  }
					  
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
						  }
					  }
                      
					  if( trim($("#alternateemail").val()) != "" )
					  {
						  if( !filter.test(trim($("#alternateemail").val())) )
						  {
							  $("#emailerror").show();
							  $("#sameemailerror").hide();
							  $("#alternateemail").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#emailerror").hide();
							  $("#sameemailerror").hide();
						  }
					  }
					  
					  if( trim($("#email").val()) ==  trim($("#alternateemail").val()) )
					  {
						 	  $("#sameemailerror").show();
							  $("#alternateemail").val('').focus();
							  return false;
					  }
					 else
					 {
							  $("#sameemailerror").hide();
							  
					 }
					                       
					  if( trim($("#dob").val()) == "" )
					  {
						  $("#doberror").show();
						  $("#dob").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#doberror").hide();
					  }
					  
					     if( trim($("#address").val()) == "" )
					  {
						  $("#addresserror").show();
						  $("#address").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#addresserror").hide();
					  }
					  
					     if( trim($("#country").val()) == "" )
					  {
						  $("#countryerror").show();
						  $("#country").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#countryerror").hide();
					  }
					     if( trim($("#state").val()) == "" )
					  {
						  $("#stateerror").show();
						  $("#state").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#stateerror").hide();
					  }
					     if( trim($("#city").val()) == "" )
					  {
						  $("#cityerror").show();
						  $("#city").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#cityerror").hide();
					  }
					  if( trim($("#zipcode").val()) == "" )
					  {
						  $("#zipcodeerror").show();
						  $("#zipcode").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#zipcodeerror").hide();
					  }
					  if( trim($("#contactnumber").val()) != "" )
					  {
						  if($("#contactnumber").val().length < 10)
						  {
						  	$("#contactnumbererror").show();
						  	$("#contactnumber").focus();
						  	return false;
						  }
					  		else
					  {
						  $("#contactnumbererror").hide();
					  }
					  }
					  
					  
					  
					  $("#frmedit").submit();
                          
                  });
              
              });
          </script>
        <fieldset>
          <div class="alert alert-danger col-sm-6 errormsg" id="firstnameerror">Firstname is required. </div>
          <div class="alert alert-danger col-sm-6 errormsg" id="lastnameerror">Lastname is required. </div>
          <div id="emailerror" class="alert alert-danger col-sm-6 errormsg">Enter valid Email.</div>
          <div id="emailtknerror" class="alert alert-danger col-sm-6 errormsg">This Emailid already taken.</div>
          <div id="addresserror" class="alert alert-danger col-sm-6 errormsg">Address is required.</div>
          <div id="countryerror" class="alert alert-danger col-sm-6 errormsg">Country is required.</div>
          <div id="stateerror" class="alert alert-danger col-sm-6 errormsg">State is required.</div>
          <div id="cityerror" class="alert alert-danger col-sm-6 errormsg">City is required.</div>
          <div id="zipcodeerror" class="alert alert-danger col-sm-6 errormsg">Zipcode is required.</div>
          <div id="sameemailerror" class="alert alert-danger col-sm-6 errormsg">Primary Email and Alternate Email must be not same .</div>
          <div id="contactnumbererror" class="alert alert-danger col-sm-6 errormsg">Enter valid Contact number ex. 0123456789</div>
        </fieldset>
        <form action="user/update" id="frmedit" method="post" enctype="multipart/form-data">
          <fieldset>
            <label>Firstname</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your Firstname" class="charactors" id="firstname" name="firstname" maxlength="30" value="<?php echo $user[0]['firstname'];?>">
          </fieldset>
          <fieldset>
            <label>Lastname</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your Lastname" class="charactors" id="lastname" name="lastname" maxlength="30" value="<?php echo $user[0]['lastname'];?>">
          </fieldset>
          <fieldset>
            <label>Email</label>
            <input type="email" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your Email-ID" class="mail_id" id="email" name="email" maxlength="100" onChange="chkmail(this.value);" value="<?php echo $user[0]['email'];?>">
          </fieldset>
          <fieldset>
            <label>Alternate Email</label>
            <input type="email" autofocus="" autocomplete="off" tabindex="" placeholder="Enter your Alternate Email-ID" class="mail_id" id="alternateemail" name="alternateemail" maxlength="100" value="<?php echo $user[0]['alternateemail'];?>">
          </fieldset>
          <fieldset>
            <?php $date = (date('Y')-18).'/'.date('m').'/'.date('d');?>
            <label>Date of Birth</label>
            <div class="input-group date" id="datetimepicker4" data-date-format="YYYY/MM/DD">
              <input type="text" id="dob" name="dob" readonly value="<?php echo date("Y/m/d",strtotime($user[0]['dob']));?>">
              <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span> </span> </div>
          </fieldset>
          <fieldset>
            <label>Address</label>
            <textarea placeholder="Enter your address" id="address" name="address" maxlength="50"><?php echo $user[0]['address'];?></textarea>
          </fieldset>
          <fieldset>
            <label>Country</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your country" class="country" id="country" name="country" maxlength="30" value="<?php echo $user[0]['countryid'];?>"/>
          </fieldset>
          <fieldset>
            <label>State</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your state" class="state" id="state" name="state" maxlength="30" value="<?php echo $user[0]['stateid'];?>"/>
          </fieldset>
          <fieldset>
            <label>City</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your city" class="city" id="city" name="city" maxlength="30" value="<?php echo $user[0]['cityid'];?>"/>
          </fieldset>
          <fieldset>
            <label>Zipcode</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your zipcode" class="numbers" id="zipcode" name="zipcode" maxlength="7" value="<?php echo $user[0]['zipcodeid'];?>"/>
          </fieldset>
          <fieldset>
            <label>Gender</label>
            <div class="gender">
              <?php if($user[0]['gender']=='Male'){
				  ?>
              <div class="male">
                <input id="gender" type="radio" value="Male" name="gender" class="selgender" checked>
                Male </div>
              <div class="male">
                <input id="gender" type="radio" value="Female" class="male selgender" name="gender">
                Female </div>
              <?php
				  }else{
					  ?>
              <div class="male">
                <input id="gender" type="radio" value="Male" name="gender" class="selgender">
                Male </div>
              <div class="male">
                <input id="gender" type="radio" value="Female" class="male selgender" name="gender" checked>
                Female </div>
              <?php
					  }?>
            </div>
          </fieldset>
          <fieldset>
            <label>Company name</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your company name" class="companyname" id="companyname" name="companyname" maxlength="50" value="<?php echo $user[0]['companyname'];?>"/>
          </fieldset>
          <fieldset>
            <label>Contact number</label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your mobile number with country code" class="numbers" id="contactnumber" name="contactnumber" maxlength="12" value="<?php echo $user[0]['contactno'];?>"/>
            <input type="hidden" name="hidmobnumber" value="<?php echo $user[0]['contactno'];?>" /><strong></strong>
          </fieldset>
           <fieldset>
          <div class="alert alert-info col-sm-6" style="margin-left: 45%;margin-right:49%;width:55%;">
            <b>Allowed Types:</b>.jpeg,.jpg,.gif,.png<br/>
            <b>Max Dimension(H x W):</b><?php echo $this->config->item('avatar_max_height')."px"." X ".$this->config->item('avatar_max_width')."px";?><br/>
            <b>Max Allowed Size:</b> 2MB
  			</div>
		</fieldset>
            <fieldset>
            <label>Avatar</label>
                  <input type="file" name="avatar"  /><strong></strong>
          </fieldset>
          <fieldset>
            <label>&nbsp;</label>
                  <?php if($user[0]['avatar']!='')
				  {?>
                  <img src="<?php echo $this->config->item('avatar_upload_path').$user[0]['avatar'];?>">
                  <?php }?>
          </fieldset>
          <fieldset>
            <div class="btn_panel">
              <button type="submit" name="editbtn" id="editbtn" class="subscribe_btn" value="Update" title="Update" tabindex="3">Update</button>
            </div>
          </fieldset>
          <input type="hidden" id="edituser" name="edituser" value="edituser" />
        </form>
      </div>
    </div>
    
    <div class="signup_part"> 
          <div class="user">
        <h2 class="fund_head">Change Password</h2>
    <script>
$(document).ready(function () {
   $(".numbers").keypress(function (e) {
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
	  {
     	return false;
      }
   });
   
   $(".charactors").keypress(function (e) {
     //alert(e.which);
	 if (e.which < 64 || e.which < 91)
	  {
     	return false;
      }
   });
});    
</script>
     
 
<script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              	  $(document).ready(function() {
                  
				  $("#changebtn").click(function () {
              
				 	 if( trim($("#password").val()) == "" )
					  {
						  $("#passwordeerror").show();
						  $("#password").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#passwordeerror").hide();
					  }
					  
					  $("#frmedit").submit();
                          
                  });
              
              });
          </script>
          <fieldset>
        
        
        
        <div class="alert alert-danger col-sm-6 errormsg" id="passwordeerror">Current password is required. </div>
        </fieldset>
     <form action="user/update" id="frmedit" method="post">
            
            <fieldset>
              <label>Current password</label>
              <input type="password" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your current password" id="password" name="password" maxlength="30" />
            </fieldset>
                    
        <fieldset>
              <div class="btn_panel">
            <button type="submit" name="changebtn" id="changebtn" class="subscribe_btn" value="Next" title="Next" tabindex="3">Next</button>
          </div>
            </fieldset>
            <input type="hidden" id="checkuserpass" name="checkuserpass" value="checkuserpass" />
     </form>
      </div>
        </div>
  </div>
</div>
<?php echo $footer;?>
</body>
</html>
