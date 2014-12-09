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
						  var characterReg = /^\d{3}-\d{3}-\d{4}$/;
						  if(!characterReg.test($("#phone").val())) 
						  {
							  $("#phoneerror").hide();
						  	  $("#phoneverror").show();
							  $("#phone").focus();
							  return false;
						  }
						  
						  //if( isNaN(trim($("#phone").val())) || $("#phone").val().length < 10)
						  //{
							  //$("#phoneerror").hide();
						  	  //$("#phoneverror").show();
							  //$("#phone").focus();
							  //return false;
						  //}
						  else
						  {
							  $("#phoneerror").hide();
							  $("#phoneverror").hide();
						  }
					  }
					  
					  if( trim($("#fname").val()) == "" )
					  {
						  $("#fnameerror").show();
						  $("#fname").focus();
						  return false;
					  }
					  else
					  {
						  $("#fnameerror").hide();
					  }
					  
					  if( trim($("#lname").val()) == "" )
					  {
						  $("#lnameerror").show();
						  $("#lname").focus();
						  return false;
					  }
					  else
					  {
						  $("#lnameerror").hide();
					  }
					  
					  if( trim($("#ccnumber").val()) == "" )
					  {
						  $("#ccnumbererror").show();
						  $("#ccnumber").focus();
						  return false;
					  }
					  else
					  {
						  $("#ccnumbererror").hide();
					  }
					  
					  if( trim($("#expirationdatey").val()) == "")
					  {
						  $("#expirationdateerror").show();
						  $("#expirationdatey").focus();
						  return false;
					  }
					  else
					  {
						  $("#expirationdateerror").hide();
					  }
					  
					  if( trim($("#expirationdatem").val()) == "")
					  {
						  $("#expirationdateerror").show();
						  $("#expirationdatem").focus();
						  return false;
					  }
					  else
					  {
						  $("#expirationdateerror").hide();
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
          <script type="text/javascript">
			function getstates(id) {	//alert(id);
			if(id !='') {
			
		
					$.ajax({
				type 				: "POST",
				url 				: "<?php echo site_url('solution/getallstates'); ?>",
				data				:	{ 'cid' : id },
				dataType 			: "html",
				cache				: false,
				success				: function(data){
									//	console.log(data);
									//			alert(data);
									$('#selstatediv').empty();
									$('#selstatediv').append(data);
									  				}
						});
			}
			}
</script>

<section class="container">
  <section class="main_contentarea">
    <div class="banner_wrp"> <img class="containerimg" src="images/YouGotRated_HeaderGraphics_SignUpPage.png" alt="Register" title="Register"> </div>
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"> Elite Member Registration: <a title="New Business">New Business</a> </div>
        
      </div>
    </div>
    <div class="container">
      <div class="reg_step_edit_claim"></div>
      <div class="reg_frm_wrap">
		  <?php /*echo form_open('solution/freesign',array('class'=>'formBox','id'=>'frmaddcompany')); ?>
       <input type="text" name="name" value="" placeholder="Enter username">
       <input type="text" name="emailid" value="" placeholder="Enter email">
       <?php echo form_input(array('name'=>'btnadd','id'=>'btnadd','class'=>'dir-searchbtn','type'=>'submit','value'=>'Send email','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;')); ?></td>
       <?php echo form_close(); */?> 
       
        <form class="reg_frm" action="solution/update" id="frmaddcompany" method="post" enctype="multipart/form-data">
          <div class="reg-row">
            <label>INTRODUCE YOUR BUSINESS</label>
            
            <div class="reg_fld">THIS INFORMATION WILL BE PUBLISHED ON YOUGOTRATED'S BUSINESS DATABASE</div>
            
            <div class="reg_fld">WHAT IS YOUR COMPANY NAME?</div>
            
            
            <input type="text" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30">
            <div id="nameerror" class="error">Name is required.</div>
            <div id="nametknerror" class="error">This compnay name is already exists.</div>
          </div>
          <div class="reg-row" style="margin-top:10px;">
            <div class="reg_fld">WHAT IS YOUR COMPANY WEBSITE?</div>
            <input type="text" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150">
            <div id="websiteerror" class="error">Website is required.</div>
          </div>
          <div class="reg-row" style="margin-top:10px;">
            <div class="reg_fld">CATEGORY</div>
            <div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;width:100%;">
                <?php for($i=0;$i<count($categories);$i++) { ?>
                <?php  $option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'],'class'=>'checkboxLabel' );
        	    echo form_checkbox( $option ); ?>
                &nbsp; <span style="color:#666666;"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
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
            <label>YOUR ADDRESS INFORMATION</label>
            <div class="reg_fld">WHAT IS YOUR ADDRESS?</div>
            <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50" />
            <br/>
            <style>
			.seldrop
			{background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #000000;
    margin-top: 8px;
    width: 249px;
			}
			</style>
          <div style="float:left;">
           <?php echo form_dropdown('country',$selcon,'','id="country" class="seldrop" onchange="getstates(this.value);"');?>
           </div>
           <?php 
		  $selstate=array(''=>'--Select State--');
		  ?>
		  <div id="selstatediv" style="float:right;margin-right:127px;">
		  <?php echo form_dropdown('state',$selstate,'','id="state" class="seldrop"');?></div>
          <br/>
            <input type="text" class="reg_txt_box-md" placeholder="CITY" id="city" name="city" maxlength="50" />
            <?php /*?><input type="text" class="reg_txt_box-md" placeholder="STATE" id="state" name="state" maxlength="50" /><?php */?>
            <?php /*?><input type="text" class="reg_txt_box-md" placeholder="COUNTRY" id="country" name="country" maxlength="50" /><?php */?>
              
            <input type="text" class="reg_txt_box-md" placeholder="ZIP CODE" id="zip" name="zip" maxlength="10" />
            <div id="streetaddresserror" class="error">Street Address is required.</div>
            <div id="cityerror" class="error">City is required.</div>
            <div id="stateerror" class="error">State is required.</div>
            <div id="countryerror" class="error">Country is required.</div>
            <div id="ziperror" class="error">Zip Code is required.</div>
            <div id="zipverror" class="error">Enter digits only valid format 123456</div>
            <div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR PHONE NUMBER?</div>
            <div>
              <input type="text" class="reg_txt_box-md" placeholder="XXX-XXX-XXXX" name="phone" maxlength="12" id="phone">
              <div id="phoneerror" class="error">Phone is required.</div>
              <div id="phoneverror" class="error">Enter valid format - i.e. XXX-XXX-XXXX</div>
            </div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="cityerror" class="error">City is required.</div>
            <div id="stateerror" class="error">State is required.</div>
            <div id="streeterror" class="error">Street Address is required.</div>
            <div id="zipcodeerror" class="error">Enter digits only.</div>
          </div>
          <div id="phonenoerror" class="error">Enter Phone number.</div>
          <div class="reg-row" style="margin-top:55px;">
            <label>YOUR CONTACT INFORMATION</label>
            <div class="reg_fld"><?php echo strtoupper('The following information will not be published YouGotRated and is used for administration purposes only.This information is where you will receive emails,and receipts from YouGotRated.com');?></div>
            <div class="reg_fld">CONTACT NAME</div>
            
            <input type="text" class="reg_txt_box" placeholder="CONTACT NAME" id="cname" name="cname" maxlength="30" /><div id="cnameerror" class="error">contact name is required.</div>
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">CONTACT NUMBER</div>
            <input type="text" class="reg_txt_box" placeholder="XXX-XXX-XXXX" id="cphone" name="cphone" maxlength="12" /><div id="cphoneerror" class="error">Contactphone is required.</div>
              <div id="cphoneverror" class="error">Enter valid format - i.e. XXX-XXX-XXXX</div>
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">CONTACT EMAIL</div>
            <input type="text" class="reg_txt_box" placeholder="CONTACT EMAIL" id="cemail" name="cemail" maxlength="200" /><div id="cemailerror" class="error">Enter valid Emailid.</div>
              
          </div>
          <!-- payment details -->
          <div class="reg-row" style="margin-top:55px;">
            <label>YOUR PAYMENT INFORMATION</label>
            
            <div class="reg_fld">FIRST NAME</div>
            
            <input type="text" class="reg_txt_box" placeholder="FIRST NAME" id="fname" name="fname" maxlength="30" /><div id="fnameerror" class="error">First Name is required.</div>
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">LAST NAME</div>
            <input type="text" class="reg_txt_box" placeholder="LAST NAME" id="lname" name="lname" maxlength="30" /><div id="lnameerror" class="error">Last Name is required.</div>
              
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">CREDIT CARD NUMBER</div>
            <input type="text" class="reg_txt_box" placeholder="CREDIT CARD NUMBER" id="ccnumber" name="ccnumber" maxlength="20" /><div id="ccnumbererror" class="error">Credit Card Number is required.</div>
              
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">EXPIRATION DATE</div>
            <select id="expirationdatem" name="expirationdatem">
                <option value="">--Select--</option>
                <?php for($i=1;$i<13;$i++) {?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              &nbsp;
              <select id="expirationdatey" name="expirationdatey">
                <option value="">--Select--</option>
                <?php for($k=0;$k<10;$k++) {?>
                <?php $a = date('Y')+$k;?>
                <option value="<?php echo $a;?>"><?php echo $a;?></option>
                <?php } ?>
              </select>
              <div id="ccnumbererror" class="error">Credit Card Number is required.</div><div id="expirationdateerror" class="error">Select Expiration Date.</div>
              <div id="ccnumbererror" class="error">Credit Card Number is required.</div>
              
          </div>
          <!-- payment details -->
          <div class="reg-row" style="margin-top:55px;">
            <label>HAVE DISCOUNT CODE?</label>
            <div class="reg_fld">ENTER DISCOUNT CODE</div>
            <input type="text" class="reg_txt_box" placeholder="DISCOUNT CODE" id="discountcode" name="discountcode" maxlength="50" />
          </div>
          <div class="reg-row" style="margin-top:27px;">
            <label>CREATE YOUR ACCOUNT</label>
            <div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="CONTINUE TO CHECKOUT" id="btnaddcompany" name="btnaddcompany">CONTINUE TO CHECKOUT</button>
          </div>
        </form>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </div>
    </div>
  </section>
</section>
<?php echo $footer;?>
