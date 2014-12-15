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
			function number(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function checkcard(){
	 
	 
  var result = "unknown";
  var card=document.getElementById('ccnumber').value;
  var success=document.getElementById('cardsuccess');
  var fail=document.getElementById('carderror'); 
     
   if(card)
   { 
	fail.innerHTML="";   
    if (/^5[1-5]/.test(card))
	  {
		success.innerHTML="mastercard";
	  }
	 else if (/^4[0-9]{6,}/.test(card))
	  {
	   success.innerHTML="visa";
	  }
      else if (/^3[47]/.test(card))
	  {
	   success.innerHTML="American Express";
	  }
	  else if(/^(?:6(?:011|5[0-9][0-9])[0-9]{12})$/.test(card))
	  {
	   success.innerHTML="discover"; 
	  }
	  else if(/^(?:3(?:0[0-5]|[68][0-9])[0-9]{11})$/.test(card))
	  {
	   success.innerHTML="diner"; 
	  }
	  else if(/^(?:(?:2131|1800|35\d{3})\d{11})$/.test(card))
	  {
		success.innerHTML="jcb";   
	  }
	  else if(/^((?:6334|6767)\d{12}(?:\d\d)?\d?)$/.test(card))
	  {
		 success.innerHTML="solo";  
	  }
	  else if(/^(?:(?:(?:4903|4905|4911|4936|6333|6759)\d{12})|(?:(?:564182|633110)\d{10})(\d\d)?\d?)$/.test(card))
	  {
		success.innerHTML="switch";
	  }
	  else if(/^(5019)\d+$/.test(card))
	  {
		success.innerHTML="dankort";  
	  }
	  else if(/^((?:5020|5038|6304|6579|6761)\d{12}(?:\d\d)?)$/.test(card))
	  {
		success.innerHTML="maestro";  
	  }
	  else
	  {
	   success.innerHTML="";
	   fail.innerHTML="not a valid card. Please Enter the valid !";   
	  }
    }
    else
    {
		success.innerHTML="";
		fail.innerHTML="Please Enter the card information!";
	
	}
    return false;
	  
  }  
</script>
<section class="container">
  <section class="main_contentarea">
    
    <div class="container">
      <div class="reg_step_edit_claim" style="display:none;"></div>
      <div class="reg_frm_wrap">
	      
        <form class="reg_frm" action="index.php/solution/renew_update/<?php echo $renewelite[0]['id'];?>" id="frmaddcompany" method="post" enctype="multipart/form-data">
          <div class="reg-row">
            <label>RENEW YOUR SUBSCRIPTION HERE</label>
            <div class="reg_fld">PLEASE RENEW YOUR ELITEMEMBERSHIP SUBSCRIPTION HERE FOR ACTIVATING IT.</div>
            <?php //print_r($renewelite[0]);?>
            <input type="hidden" class="reg_txt_box" placeholder="companyid" id="companyid" name="companyid"  maxlength="30" value="<?php echo $renewelite[0]['id'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30" value="<?php echo $renewelite[0]['company'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150" value="<?php echo $renewelite[0]['siteurl'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" value="<?php echo $renewelite[0]['email'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="Country" id="country" name="country"  maxlength="250" value="<?php echo $renewelite[0]['country'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="State" id="state" name="state"  maxlength="250" value="<?php echo $renewelite[0]['state'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="City" id="city" name="city"  maxlength="250" value="<?php echo $renewelite[0]['city'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="Zip" id="zip" name="zip"  maxlength="250" value="<?php echo $renewelite[0]['zip'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50" value="<?php echo $renewelite[0]['streetaddress'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cname" name="cname" id="cname" maxlength="50" value="<?php echo $renewelite[0]['contactname'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cphone" name="cphone" id="cphone" maxlength="50" value="<?php echo $renewelite[0]['contactphonenumber'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cemail" name="cemail" id="cemail" maxlength="50" value="<?php echo $renewelite[0]['contactemail'];?>" />
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
            <input type="text" class="reg_txt_box" placeholder="CREDIT CARD NUMBER" id="ccnumber" name="ccnumber" maxlength="20" onkeypress="return number(event)" onblur="return checkcard()"/><div id="ccnumbererror" class="error">Credit Card Number is required.</div>
            <div id="carderror" class="carderror"></div>
            <div id="cardsuccess" class="cardsuccess"></div>   
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">EXPIRATION DATE</div>
            <select id="expirationdatey" name="expirationdatey">
                <option value="">--Select--</option>
                <?php for($k=0;$k<10;$k++) {?>
                <?php $a = date('Y')+$k;?>
                <option value="<?php echo $a;?>"><?php echo $a;?></option>
                <?php } ?>
              </select>
              &nbsp;
              <select id="expirationdatem" name="expirationdatem">
                <option value="">--Select--</option>
                <?php for($i=1;$i<13;$i++) {?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                <?php } ?>
              </select>
              <div id="ccnumbererror" class="error">Credit Card Number is required.</div><div id="expirationdateerror" class="error">Select Expiration Date.</div>
              <div id="ccnumbererror" class="error">Credit Card Number is required.</div>
              
          </div>
          <!-- payment details -->
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
