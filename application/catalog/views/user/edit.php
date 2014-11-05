<?php echo $header;?>
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
					  
					if(($("#phoneno").val()) == "")
							{
								$("#phonenoerror").show();
								$("#phonenoerror").focus();
								return false;
							}
							else
							{
								var pn = $("#phoneno").val();
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
					 
					 $("#frmuser").submit();
                          
                  });
              
              });
          </script> 
    
    <section class="container">
      <section class="main_contentarea">
      		
          <div class="regr_lnk">
          	<div class="innr_wrap">
	            <div class="new_usr">
            	EDIT PROFILE
            </div>
            	
            </div>
          </div>
          <div class="container">
          		<div class="reg_step_edit"></div>
              <div class="reg_frm_wrap">
              
                   <form class="reg_frm" action="user/update" id="frmuser" method="post" enctype="multipart/form-data">
                  	<div class="reg-row">
                    	<label>YOUR E-MAIL ADDRESS</label>
                      
                      <input type="email" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);" value="<?php echo $user[0]['email'];?>">
                     <div id="emailerror" class="error">Enter valid Emailid.</div>
                  <div id="emailtknerror" class="error">This Emailid already taken.</div> 
                    </div>
                    <div class="reg-row">
                    	<label>INTRODUCE YOURSELF</label>
                      
                      <input type="text" class="reg_txt_box" placeholder="FIRST NAME" id="firstname" name="firstname"  maxlength="30" value="<?php echo $user[0]['firstname'];?>">
                      <input type="text" class="reg_txt_box pull-right" placeholder="LAST NAME" id="lastname" name="lastname" maxlength="30" value="<?php echo $user[0]['lastname'];?>"><div id="fnameerror" class="error">First Name is required.</div>
                  <div id="fnameverror" class="error">Enter Valid First Name(Only characters).</div>
                  <div id="lnameerror" class="error">Last Name is required.</div>
                  <div id="lnameverror" class="error">Enter Valid Last Name(Only characters).</div>
                      <div class="reg_fld" style="margin-top:35px;"> YOUR GENDER.</div>
                      <fieldset id="gender" class="gender">
                         <div class="gdr_male">
                          <?php if($user[0]['gender']=='Male'){?>
                          <input type="radio" checked="checked" name="gender" id="male" value="Male">
						  <?php } else{
							  ?>
                              <input type="radio" name="gender" id="male" value="Male">
                              <?php
							  }?>
                            
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
                      <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS" name="street" id="street"  maxlength="50" value="<?php echo $user[0]['street'];?>">
                      <input type="text" class="reg_txt_box-md" placeholder="CITY" id="city" name="city" maxlength="50" value="<?php echo $user[0]['city'];?>"/>
                      <input type="text" class="reg_txt_box-xsml" placeholder="STATE" id="state" name="state" maxlength="50" value="<?php echo $user[0]['state'];?>"/>
                      <input type="text" class="reg_txt_box-xsml" placeholder="ZIP CODE" id="zipcode" name="zipcode" maxlength="10" value="<?php echo $user[0]['zipcode'];?>"><div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR PHONE NUMBER?</div>
                      <div>
                      <input type="text" class="reg_txt_box-md" placeholder="XXX" name="phoneno" maxlength="12" id="phoneno" value="<?php echo $user[0]['phoneno'];?>">
                      </div>
                      <div id="streeterror" class="error">Street Address is required.</div>
                      <div id="cityerror" class="error">City is required.</div>
                      <div id="stateerror" class="error">State is required.</div>
                      <div id="streeterror" class="error">Street Address is required.</div>
                      <div id="zipcodeerror" class="error">Enter digits only.</div>
                      
                    </div>
                    <div id="phonenoerror" class="error">Enter Phone number.</div>
                    <div class="reg-row" style="margin-top:55px;">
                    	<label>YOUR USERNAME </label>
                      
                      <input type="text" class="reg_txt_box" placeholder="USERNAME" id="username" name="username" maxlength="30" onchange="chkuser(this.value);" value="<?php echo $user[0]['username'];?>">
                      <div id="unameerror" class="error">User Name is required.</div>
                  <div id="unameverror" class="error">Enter Valid User Name(Only characters and numbers).</div>
                  <div id="utknerror" class="error">This Username is already taken.</div>
                      
                    </div>
                    <div class="reg-row">
                    	<label>YOUR PROFILE PHOTO</label>
                      <div class="reg_fld">UPLOAD A PHOTO FOR YOUR PROFILE</div>
                      <input type="file" class="filupload" name="avatarbig">
                    </div>
                    <div style="margin-top:10px;"><?php if($this->uri->segment(2) == 'edit') { ?>
                  <?php if(stripslashes($user[0]['avatarbig'])!='') { ?>
                  <?php 
                  $site = site_url();
                  $url = explode("/admincp",$site);
                  $path = $url[0];
                  ?>
                  <img src="<?php echo $path;?>uploads/user/thumb/<?php echo stripslashes($user[0]['avatarbig']); ?>" title="<?php echo stripslashes($user[0]['firstname']); ?>" alt="<?php echo stripslashes($user[0]['firstname']); ?>" style="max-height:100px;max-width:100px;" />
                  <?php } else { echo "No Image"; } ?>
                  <?php } ?>
                    </div>
                    <div class="reg-row" style="margin-top:10px;">
                    	
                      
                       <button type="submit" class="lgn_btn" style="margin-top:32px;" title="UPDATE ACCOUNT" id="btnsubmit" name="btnsubmit">UPDATE ACCOUNT</button>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $this->encrypt->encode($user[0]['id']);?>" />
                  </form>
                   <?php
				   ?>
                  <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>">
                        <img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a></div>
              </div>
          </div>
      </section>
    </section>
<?php echo $footer;?>
