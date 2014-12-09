<?php echo $header;?>
<script type="text/javascript" language="javascript">
              function trim(stringToTrim) {
                  return stringToTrim.replace(/^\s+|\s+$/g,"");
              }
              $(document).ready(function() {
                  $("#btnaddcompany").click(function () {
					  
					  if( trim($("#name").val()) == "" )
					  {
						  $("#nameerror").show();
						  $("#name").val('').focus();
						  return false;
					  }
					  else
					  {						  
						  $("#nameerror").hide();
						
					  }
					  
					   if( trim($("#website").val()) == "" )
					  {
						  $("#websiteerror").show();
						  $("#website").focus();
						  return false;
					  }
					  else
					  {
						  $("#websiteerror").hide();
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
					  
					  if( trim($("#streetaddress").val()) == "" )
					  {
						  $("#streetaddresserror").show();
						  $("#streetaddress").val('').focus();
						  return false;
					  }
					  else
					  {
						  $("#streetaddresserror").hide();
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
					  
					  if( trim($("#zip").val()) == "" )
					  {
						  $("#ziperror").show();
						  $("#zipverror").hide();
						  $("#zip").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#zip").val())))
						  {
							  $("#ziperror").hide();
						  	  $("#zipverror").show();
							  $("#zip").focus();
							  return false;
						  }
						  else
						  {
							  $("#ziperror").hide();
							  $("#zipverror").hide();
						  }
					  }
					  
					  if( trim($("#phone").val()) == "" )
					  {
						  $("#phoneerror").show();
						  $("#phoneverror").hide();
						  $("#phone").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#phone").val())) || $("#phone").val().length < 10)
						  {
							  $("#phoneerror").hide();
						  	  $("#phoneverror").show();
							  $("#phone").focus();
							  return false;
						  }
						  else
						  {
							  $("#phoneerror").hide();
							  $("#phoneverror").hide();
						  }
					  }
					  
					 
					  
					 
					  
					  if( trim($("#cname").val()) == "" )
					  {
						  $("#cnameerror").show();
						  $("#cname").focus();
						  return false;
					  }
					  else
					  {
						  $("#cnameerror").hide();
					  }
					  
					  if( trim($("#cphone").val()) == "" )
					  {
						  $("#cphoneerror").show();
						  $("#cphoneverror").hide();
						  $("#cphone").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( isNaN(trim($("#cphone").val())) || $("#cphone").val().length < 10)
						  {
							  $("#cphoneerror").hide();
						  	  $("#cphoneverror").show();
							  $("#cphone").focus();
							  return false;
						  }
						  else
						  {
							  $("#cphoneerror").hide();
							  $("#cphoneverror").hide();
						  }
					  }
					  
					  var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					  if( trim($("#cemail").val()) == "" )
					  {
						  $("#cemailerror").show();
						  $("#cemail").val('').focus();
						  return false;
					  }
					  else
					  {
						  if( !filter.test(trim($("#cemail").val())) )
						  {
							  $("#cemailerror").show();
							  $("#cemail").val('').focus();
							  return false;
						  }
						  else
						  {
							  $("#cemailerror").hide();
						  }
					  }
					  
					  $("#frmaddcompany").submit();
                  });
              });
          </script>

<section class="container">
  <section class="main_contentarea">
    <div class="banner_wrp"> <img src="images/YouGotRated_HeaderGraphics_SignUpPage.png" alt="Register" title="Register" style="width:966px;height:100%;"> </div>
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"> REGISTRATION: <a title="New Business">NEW BUSINESS</a> </div>
        
      </div>
    </div>
    
    <div class="container">
	
      <div class="reg_step_edit_add"></div>
      <div class="reg_frm_wrap free_elite">
		
          
        <form class="reg_frm" action="solution/update" id="frmaddcompany" method="post" enctype="multipart/form-data">
		  		
          <div class="reg-row bname">
            <label>INTRODUCE YOUR BUSINESS</label>
            <div class="reg_fld">WHAT IS YOUR BUSINESS'S NAME?</div>
            <input type="text" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30">
            <div id="nameerror" class="error">Name is required.</div>
            <div id="nametknerror" class="error">This compnay name is already exists.</div>
          </div>
          
          <div class="reg-row website" style="margin-top: 10px;">
            <div class="reg_fld">WHAT IS YOUR BUSINESS'S WEBSITE?</div>
            <input type="text" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150">
            <div id="websiteerror" class="error">Website is required.</div>
          </div>
          
         <div class="reg-row_free"> 
             <div class="free_elite_box">
				<div class="free_click">Or <a href="<?php echo base_url();?>solution">CLICK HERE</a> to become an Elite Member</div>
                   <div class="quotetext">Elite Members receive the following benefits:</div>
				<ul class="elist">
					<li>Access to our Buyer Protection program</li>
					<li>YGR Seal with rating information</li>
					<li>Ability to manage reviews</li>
					<li>Much more!</li>
                </ul>
              </div>
            <div id="websiteerror" class="error">Website is required.</div>
          </div>
          
          
          <div class="reg-row" style="margin-top:10px;">
            <div class="reg_fld">CATEGORY</div>
            <div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;width:100%;">
				<?php for($i=0;$i<count($categories);$i++) { ?>
                <?php  $option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'],'class'=>'checkboxLabel' );
        	    echo form_checkbox( $option ); ?>
                &nbsp; <span style="color: #999999;font-family: 'myriadpro-regular';"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
                <?php } ?>
              </div>
            <div id="websiteerror" class="error">Website is required.</div>
          </div>
          
          
          
          <div class="reg-row">
            <label>YOUR EMAIL ADDRESS</label>
            <div class="reg_fld">WHERE DO YOU RECEIVE YOUR E-MAIL?</div>
            <input type="email" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);">
            <div id="emailerror" class="error">Enter valid Emailid.</div>
            <div id="emailtknerror" class="error">This Emailid already taken.</div>
          </div>
          <div class="reg-row">
            <label>YOUR BUSINESS ADDRESS</label>
            <div class="reg_fld">WHAT IS YOUR ADDRESS?</div>
            <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50">
            <input type="text" class="reg_txt_box-md" placeholder="CITY" id="city" name="city" maxlength="50" />
            <input type="text" class="reg_txt_box-md" placeholder="STATE" id="state" name="state" maxlength="50" />
            <!--<select class="reg_txt_box-md" id="state" name="state" maxlength="50"/>
               <option>SELECT STATE</option>
               <option>ALASKA</option>
               <option>CALIFORNIA</option>
               <option>NEWYORK</option>
            </select>-->
            <input type="text" class="reg_txt_box-md" placeholder="COUNTRY" id="country" name="country" maxlength="50" />
            <input type="text" class="reg_txt_box-md" placeholder="ZIP CODE" id="zip" name="zip" maxlength="10" />
            <div id="streetaddresserror" class="error">Street Address is required.</div>
            <div id="cityerror" class="error">City is required.</div>
            <div id="stateerror" class="error">State is required.</div>
            <div id="countryerror" class="error">Country is required.</div>
            <div id="ziperror" class="error">Zip Code is required.</div>
            <div id="zipverror" class="error">Enter digits only valid format 123456</div>
            <div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR PHONE NUMBER?</div>
            <div>
              <input type="text" class="reg_txt_box-md" placeholder="(XXX) XXX - XXXX" name="phone" maxlength="12" id="phone">
              <div id="phoneerror" class="error">Phone is required.</div>
              <div id="phoneverror" class="error">Enter Valid format.0741852963</div>
            </div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="cityerror" class="error">City is required.</div>
            <div id="stateerror" class="error">State is required.</div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="zipcodeerror" class="error">Enter digits only.</div>
          </div>
          <div id="phonenoerror" class="error">Enter Phone number.</div>
          <div class="reg-row" style="margin-top:55px;">
            <label>YOUR PROFILE PHOTO</label>
           <?php /*?> <div class="reg_fld">PAYPAL ID</div>
            
            <input type="text" class="reg_txt_box" placeholder="PAYPAL ACCOUNT ID" id="paypalid" name="paypalid" maxlength="50" /><div id="paypaliderror" class="error">Paypalid is required.</div>
          </div><?php */?>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">UPLOAD A LOGO FOR YOUR COMPANY</div>
            <input type="file" class="filupload" id="logo" name="logo" />
              <div id="logoerror" class="error">Logo is required.</div>
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">ABOUT US</div>
            <textarea class="txt_box" placeholder="TELL US ABOUT YOUR BUSINESS" id="aboutcompany" name="aboutcompany" style="height:100px;"></textarea>
              
          </div>
          
          <div class="reg-row" style="margin-top:27px;">
            <label>CREATE YOUR BUSINESS ACCOUNT</label>
            <div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="CREATE ACCOUNT" id="btnaddcompany" name="btnaddcompany">CREATE ACCOUNT</button>
          </div>
        </form>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?>
