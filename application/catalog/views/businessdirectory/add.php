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
					  
					challengeField = $("input#recaptcha_challenge_field").val();
					responseField = $("input#recaptcha_response_field").val();	 
					alert(challengeField);
					alert(responseField);
	
					
						  
					  $("#frmaddcompany").submit();
                  });
              });
          </script>

<section class="container">
  <section class="main_contentarea">
    <div class="banner_wrp"> <img src="images/YouGotRated_HeaderGraphics_SignUpPage.png" alt="Register" title="Register" style="width:966px;height:100%;"> </div>
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"> ADD BUSINESS TO YGR DIRECTORY</div>
        
      </div>
    </div>
    <div class="container">
      <div class="reg_step_edit_add"></div>
      <div class="reg_frm_wrap">
        <form class="reg_frm" action="businessdirectory/add" id="frmaddcompany" method="post" enctype="multipart/form-data"> 
          <div class="reg-row">
            <label>BUSINESS' NAME</label>           
            <input type="text" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30">
            <div id="nameerror" class="error">Name is required.</div>
            <div id="nametknerror" class="error">This compnay name is already exists.</div>
          </div>
          <div class="reg-row" style="margin-top:10px;">
            <div class="reg_fld">BUSINESS'S WEBSITE?</div>
            <input type="text" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150">
            <div id="websiteerror" class="error">Website is required.</div>
          </div>
          <div class="reg-row" style="margin-top:10px;">
            <div class="reg_fld">CATEGORY</div>
            <div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;width:100%;">
				<?php for($i=0;$i<count($categories);$i++) { ?>
                <?php  $option = array( 'name'=>'cat[]', 'id'=>'cat-'.$categories[$i]['id'], 'value'=>$categories[$i]['id'],'class'=>'checkboxLabel' );
        	    echo form_checkbox( $option ); ?>
                &nbsp; <span style="color: #999999;font-family: "nimbus-sans-condensed";"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
                <?php } ?>
              </div>
            <div id="websiteerror" class="error">Website is required.</div>
          </div>
          <div class="reg-row">
            <label>BUSINESS EMAIL ADDRESS</label>            
            <input type="email" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" onchange="chkmail(this.value);">
            <div id="emailerror" class="error">Enter valid Emailid.</div>
            <div id="emailtknerror" class="error">This Emailid already taken.</div>
          </div>
          <div class="reg-row">
            <label>BUSINESS ADDRESS</label>            
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
            <div style="margin-top:36px;" class="reg_fld">BUSINESS PHONE NUMBER</div>
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
          
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">ABOUT US</div>
            <textarea class="txt_box" placeholder="TELL US ABOUT YOUR BUSINESS" id="aboutcompany" name="aboutcompany" style="height:100px;"></textarea>
              
          </div>
          
          
          <div class="reg-row" style="margin-top:27px;">        
            <div style='clear:both'>
				
			
            <?php echo $recaptcha_html; ?>
            </div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="SUBMIT BUSINESS" id="btnaddcompany" name="btnaddcompany">Submit Business</button>
          </div>
          
          
        </form>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
        
        
      </div>
    </div>
  </section>
</section>

<?php echo $footer;?>
<script>
<?php
foreach($post_data as $k => $v){ ?>	
	$("#<?php echo $k; ?>").val('<?php $varname = $k; if(isset($post_data[$varname])){ echo $post_data[$varname];  }  ?>');
<?php	
}
?>
</script>
