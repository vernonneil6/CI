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
    <script type="text/javascript">
		$(function(){
		  $('#loginform').submit(function(e){
			//return false;
		  });
		  
		  $('#modaltrigger').leanModal({ top: 110, overlay: 0.45, closeButton: ".hidemodal" });
		});
	</script>
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
<style>
.passStrengthify
{
float: left;
height: 30px;
margin-left: 359px;
}
</style>
</head>

	<body>
<?php echo $menu;?>


<!-- /.header-top-links -->

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
        <h2 class="fund_head">Sign up</h2>
    
    <script type="text/javascript">
         
          function chkmail(email)
          {
              //alert(email);
              var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              if( (email) != '' && filter.test((email)) )
              {
                  $("#emailerror").hide();
                  //Return from conroller in php code : echo json_encode(array("result"=>"exist"));
                  $.ajax({
                      type 				: "POST",
                      url 					: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ 'email' : email },
                      dataType 			: "json",
                      cache			   	: false,
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
		  
		  
      </script> 
<script type="text/javascript">
         
          function checkusername(username)
          {
             
             var userfilter = /^[a-zA-Z-0-9]+$/; 
              if( (username) != '' && userfilter.test((username)) )
              {
                  $("#unameerror").hide();
                  $.ajax({
                      type 				: "POST",
                      url 					: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ 'username' : username },
                      dataType 			: "json",
                      cache			    : false,
                      success			: function(data){
                                                      if( data.result == 'old')
                                                      {
                                                         $("#unameerror").hide();
													  	 $("#unameverror").hide();
                                                         $("#unametakenerror").show();                                                         $("#username").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                          $("#unametakenerror").hide();
														  $("#unameerror").hide();
														  $("#unameverror").hide();
                                                      }
                                                  }
                  });
              }
              else
              {
                   $("#unameerror").hide();
			       $("#unameverror").show();
                   $("#unametakenerror").hide()
				   $("#username").val('').focus();
                  return false;
              }
          }
		  
		  
      </script> 
      
      
      <script type="text/javascript">
         
          function checkmobno(contactnumber)
          {
             
             var userfilter = /^[a-zA-Z-0-9]+$/; 
              if( (contactnumber) != '' && userfilter.test((contactnumber)) )
              {
                  $("#mobxerror").hide();
                  $.ajax({
                      type 				: "POST",
                      url 					: "<?php echo site_url('user/fieldcheck'); ?>",
                      data				:	{ 'mobno' : contactnumber },
                      dataType 			: "json",
                      cache			    : false,
                      success			: function(data){
                                                      if( data.result == 'old')
                                                      {
                                                      
													  	 $("#contactnumbererror").hide();
                                                          $("#mobxerror").show();                                                  $("#username").val('').focus();
                                                          return false;
                                                      }
                                                      else
                                                      {
                                                           	 $("#contactnumbererror").hide();
                                                          $("#mobxerror").hide();            
                                                      }
                                                  }
                  });
              }
              else
              {
                	 $("#contactnumbererror").show();
                      $("#mobxerror").hide(); 
				   $("#contactno").val('').focus();
                  return false;
              }
          }
		  
		  
      </script> 
<script type="text/javascript" language="javascript">
           
              	  $(document).ready(function() {
                  
				  $("#registerbtn").click(function () {
             
				 	var userfilter =/((^[a-z]+[0-9]+)|(^[a-z]+))+[a-z0-9]+$/;
					    if( ($("#username").val()) == "" )
					  {
						  $("#unameerror").show();
			       		  $("#unameverror").hide();
			              $("#unametakenerror").hide();
				   		  $("#username").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !userfilter.test(($("#username").val())) )
						  {
							  $("#unameerror").hide();
				       		  $("#unameverror").show();
				              $("#unametakenerror").hide();
							  $("#username").val('').focus();
							  return false;
						  }
						  else
						  {
							  if( ($("#username").val().length >21))
						  {
							  $("#unameerror").hide();
				       		  $("#unameverror").hide();
				              $("#unametakenerror").hide();
							  $("#unamelenerror").show();
							  return false;
							  
						  }
						  else
							  {
								  $("#unameerror").hide();
								  $("#unameverror").hide();
								  $("#unametakenerror").hide();
								  $("#unamelenerror").hide();
		
							  }
					  }
					  }
					 
					   var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( ($("#email").val()) == "" )
					  {
						  $("#emailtknerror").hide();
						  $("#emailerror").show();
						  $("#email").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(($("#email").val())) )
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
                      
					
					  var pfilter = /^(?=.*\d).{8,18}$/;
                     
					  if( ($("#password").val()) == "" )
                      {
                          $("#passerror").show();
						  $("#passverror").hide();
                          $("#password").val('').focus();
                          return false;
                      }
                      else
                      {
                         if( !pfilter.test(($("#password").val())) )
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
                      
                      if( ($("#repassword").val()) == "")
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
					  
					   if( ($("#dob").val()) == "" )
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
					  
					  if( trim($("#ccode").val()) == 0 )
					  {
						  $("#ccodeerror").show();
						  $("#ccode").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#ccodeerror").hide();
					  }
					 
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
					  
					  
					  
					  
					  if( $(".selgender:checked").length ==0 )
					  {
						  $("#gendererror").show();
						  return false;
					  }
					  else
					  {
						  $("#gendererror").hide();
					  }
					 
					  //return false;
					  $("#frmjoin").submit();
                          
                  });
              
              });
          </script><script type="text/javascript">
	$(document).ready(function() {	
	 $(".checkno").on("keypress keyup blur",function (event) {

    if(event.which == 8 || event.which == 0){
        return true;
    }
    if(event.which < 46 || event.which > 59) {
        return false;
        //event.preventDefault();
    } // prevent if not number/dot
    
    if(event.which == 46 && $(this).val().indexOf('.') != -1) {
        return false;
        //event.preventDefault();
    } // prevent if already dot
});});

	</script>
          <fieldset>
        <div class="alert alert-danger col-sm-6 errormsg" id="unameerror">User Name is required.</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="unametakenerror">User Name is already in use.</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="unameverror">Enter Valid User Name(Only characters and 0-9 allowed).</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="doberror"> Select Date of Birth. </div>
        <div class="alert alert-danger col-sm-6 errormsg" id="gendererror">Select Gender.</div>
        
        <div class="alert alert-danger col-sm-6 errormsg" id="passerror"> Password required.</div>
        <div class="alert alert-danger col-sm-6 errormsg" id="repasserror"> Password and Confirm Password does not match. </div>
        <div class="alert alert-danger col-sm-6 errormsg" id="passverror">Password must be between 8 and 18 digits long and include at least one numeric digit.</div>
        <div id="emailerror" class="alert alert-danger col-sm-6 errormsg">Enter valid Email.</div>
        
        <div id="ccodeerror" class="alert alert-danger col-sm-6 errormsg">Select Country Code</div>
        <div id="emailtknerror" class="alert alert-danger col-sm-6 errormsg">This Emailid already taken.</div>
        <div id="unamelenerror" class="alert alert-danger col-sm-6 errormsg">User name characters max(20).</div>
          <div id="addresserror" class="alert alert-danger col-sm-6 errormsg">Address is required.</div>
          <div id="countryerror" class="alert alert-danger col-sm-6 errormsg">Country is required.</div>
          <div id="stateerror" class="alert alert-danger col-sm-6 errormsg">State is required.</div>
          <div id="cityerror" class="alert alert-danger col-sm-6 errormsg">City is required.</div>
          <div id="zipcodeerror" class="alert alert-danger col-sm-6 errormsg">Zipcode is required.</div>
          <div id="contactnumbererror" class="alert alert-danger col-sm-6 errormsg">Enter valid Contact number ex. 0123456789</div>
          <div id="mobxerror" class="alert alert-danger col-sm-6 errormsg">Contact number Already Registered</div>
        
        </fieldset>
     <form action="user/update/<?php if(($this->uri->segment(3)!='')) echo $referalcode=$this->uri->segment(3);?>" id="frmjoin" method="post">
        <fieldset>
              <label>User Name <span class="required_star">*</span></label>
              <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter User Name" class="user_id" id="username" name="username" maxlength="20" onChange="checkusername(this.value);">
            </fieldset>
        <fieldset>
              <label>Email <span class="required_star">*</span></label>
              <input type="email" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your Email-ID" class="mail_id" id="email" name="email" maxlength="100" onChange="chkmail(this.value);">
            </fieldset>
        <fieldset>
              <label>Password <span class="required_star">*</span></label>
              <input type="password" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your Password" class="password_id" id="password" name="password" maxlength="30">
            </fieldset>
            <fieldset>
              <label>Confirm Password <span class="required_star">*</span></label>
              <input type="password" autofocus="" autocomplete="off" tabindex="1" placeholder="Confirm your Password" class="password_id" id="repassword" name="repassword" maxlength="30">
            </fieldset>
        <fieldset><?php $date = (date('Y')-18).'/'.date('m').'/'.date('d');?>
                        <label>Date of Birth</label>
                    	<div class="input-group date" id="datetimepicker4" data-date-format="YYYY/MM/DD">
                            <input type="text" id="dob" name="dob" readonly value="<?php echo $date;?>">
                            <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span>
                            </span>
                        </div>
                    </fieldset><fieldset>
            <label>Address<span class="required_star">*</span></label>
            <textarea placeholder="Enter your address" id="address" name="address" maxlength="50" tabindex="1"></textarea>
          </fieldset>
         <fieldset>
            <label>Country<span class="required_star">*</span></label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your country" class="country" id="country" name="country" maxlength="30"/>
          </fieldset>
          <fieldset>
            <label>State<span class="required_star">*</span></label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your state" class="state" id="state" name="state" maxlength="30"/>
          </fieldset>
          <fieldset>
            <label>City<span class="required_star">*</span></label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your city" class="city" id="city" name="city" maxlength="30"/>
          </fieldset>
          <fieldset>
            <label>Zipcode<span class="required_star">*</span></label>
            <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your zipcode" class="numbers checkno" id="zipcode" name="zipcode" maxlength="7"/>
          </fieldset>
        
     <fieldset>
            <label>Contact number<span class="required_star">*</span></label><div class="tys">
    <?php echo form_dropdown('ccode',$selcountrycodes,'','id="ccode"');?>
                <input type="text" autofocus="" autocomplete="off" tabindex="1" placeholder="Enter your mobile number" class="numbers checkno" id="contactnumber" name="contactnumber" onChange="checkmobno(this.value);" maxlength="12" value=""/></div>

          </fieldset><fieldset>
              <label>Gender <span class="required_star">*</span></label>
              <div class="gender">
            <div class="male">
                  <input id="gender" type="radio" value="Male" name="gender" class="selgender">
                  Male </div>
            <div class="male">
                  <input id="gender" type="radio" value="Female" class="male selgender" name="gender">
                  Female </div>
          </div>
            </fieldset>
        <fieldset>
              <div class="btn_panel">
            <button type="submit" name="registerbtn" id="registerbtn" class="subscribe_btn" value="Register" title="Register" tabindex="3">Register</button>
          </div>
            </fieldset>
            <input type="hidden" id="newuser" name="newuser" value="newuser" />
     </form>
      </div>
        </div>
  </div>
    </div>
<?php echo $footer;?>

</body>
</html>
