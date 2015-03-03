<?php echo $header;?>
<script type="text/javascript" src="js/formsubmit.js"></script>
<section class="container">
  <section class="main_contentarea">
    <div class="banner_wrp"> <img class="containerimg" src="images/YouGotRated_HeaderGraphics_SignUpPage.png" alt="Register" title="Register"> </div>
    <div class="regr_lnk">
      <div class="innr_wrap">
        <div class="new_usr"> Elite Member Registration: <a title="New Business">New Business Monthly Cost:<span id="discpricebanner">$<?php echo $defaultprice=$this->common->get_setting_value(19);?>.00</span> </a> </div>
        
      </div>
    </div>
    <div class="container">
      <div class="reg_step_edit_claim1"></div>
      <div class="reg_frm_wrap" style="width:100%;">
		<?php 
		 
		    if(isset($company_avail)){
				$showdata=$company_avail;
			} else { 
			     $showdata=null;
			} 
		?>
		<form class="reg_frm" action="index.php/solution/receipt" id="frmaddcompany" method="post" enctype="multipart/form-data">


			<input type="hidden" name="affiliatedId" id="affiliatedId"/>
		  <div class="reg-row">
				<div>
					<span class="form-col-1">
						<span class="form-circle">1</span>
					</span>
					<span class="form-col-2">
						<label>INTRODUCE YOUR BUSINESS</label>
            

						<div class="reg_fld">THIS INFORMATION WILL BE PUBLISHED ON YOUGOTRATED'S BUSINESS DATABASE</div>
						
						<div class="reg_fld">WHAT IS YOUR COMPANY NAME?</div>
						
						
						<input type="text" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30" value="<?php echo $showdata['company']; ?>">
						<div id="nameerror" class="error">Name is required.</div>
						<div id="nametknerror" class="error">This company name is already exists.</div>
                                                <input id="namecheck" type="hidden">
                                                <input name="elitemem" id="elitemem" type="hidden" value="<?php echo $showdata['id'];?>">
					</span>
				</div>            
          </div>
          <div class="reg-row" style="margin-top:10px;">
			  <div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">WHAT IS YOUR COMPANY WEBSITE?</div>
						<input type="text" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150" value="<?php echo $showdata['siteurl']; ?>" onchange="chkwebsite(this.value);">            
						<div id="websiteerror" class="error">Website is required.</div>
						<div id="websitevaliderror" class="error">Enter valid Website.</div> 
						<div id="websitevalidsuccess" class="cardsuccess" style="display:none">Its a valid website.</div> 
					</span>
          </div>
          <div class="reg-row" style="margin-top:10px;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">CATEGORY:</div>
						<div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;width:100%;">
							<?php for($i=0;$i<count($categories);$i++) { ?>
							<?php  $option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'],'class'=>'checkboxLabel' );
							echo form_checkbox( $option ); ?>
							&nbsp; <span style="color:#666666;"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
							<?php } ?>
						  </div>
							<input type="hidden" name="categorylist" id="categorylist"/> 						
					</span>
				</div>                  
          </div>
          <div class="reg-row">
				<div>
					<span class="form-col-1">
						<span class="form-circle">2</span>
					</span>
					<span class="form-col-2">
						<label>BUSINESS EMAIL ADDRESS: </label>
						<div class="reg_fld">This email will be visible in your Profile Information and displayed on YouGotRated.</div>
						<input type="email" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" value="<?php echo $showdata['email']; ?>">
						<div id="emailerror" class="error">Enter valid Emailid.</div>
						<div id="emailtknerror" class="error">This Emailid already taken.</div>
                                                <input id="emailcheck" type="hidden">
					</span>
				</div>
            
            
          </div>
          <div class="reg-row">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<label>BUSINESS ADDRESS INFORMATION: </label>
					<div class="reg_fld">WHAT IS YOUR COMPANY ADDRESS?</div>
					<input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress1" id="streetaddress1" maxlength="50" />
					<br/>           
				  <div style="float:left;">
				   <?php echo form_dropdown('country1',$selcon,'','id="country1" class="seldrop" onchange=getstates(this.value,"state1","#selstatediv1");');?>
				   <input type="hidden" name="countryname1" id="countryname1"/>
				   </div>
				   <?php 
				  $selstate=array(''=>'--Select State--');
				  ?>
				  <div id="selstatediv1" style="float:right;margin-right:127px;">
				  <?php echo form_dropdown('state1',$selstate,'','id="state1" class="seldrop"');?></div>
				  <br/>
					<input type="text" class="reg_txt_box-md" placeholder="CITY" id="city1" name="city1" maxlength="50" />
					<?php /*?><input type="text" class="reg_txt_box-md" placeholder="STATE" id="state" name="state" maxlength="50" /><?php */?>
					<?php /*?><input type="text" class="reg_txt_box-md" placeholder="COUNTRY" id="country" name="country" maxlength="50" /><?php */?>
					  
					<input type="text" class="reg_txt_box-md" placeholder="ZIP CODE" id="zip1" name="zip1" maxlength="10" />
					<div id="streetaddresserror" class="error">Street Address is required.</div>
					<div id="cityerror" class="error">City is required.</div>
					<div id="stateerror" class="error">State is required.</div>
					<div id="countryerror" class="error">Country is required.</div>
					<div id="ziperror" class="error">Zip Code is required.</div>
					<div id="zipverror" class="error">Enter digits only valid format 123456</div>
					<div style="margin-top:36px;" class="reg_fld">WHAT IS YOUR Business PHONE NUMBER you want published on YouGotRated?</div>
					<div>
					  <input type="text" class="reg_txt_box-md" placeholder="XXX-XXX-XXXX" name="phone" maxlength="12" id="phone" value="<?php echo $showdata['phone']; ?>">
					  <div id="phoneerror" class="error">Phone is required.</div>
					  <div id="phoneverror" class="error">Enter valid Phone number.</div>
					</div>
					</span>
				</div>
            
          </div>
          <div id="phonenoerror" class="error">Enter Phone number.</div>
          <div class="reg-row" style="margin-top:55px;">
				<div>
					<span class="form-col-1">
						<span class="form-circle">3</span>
					</span>
					<span class="form-col-2">
						<label>BUSINESS CONTACT INFORMATION: </label>
						<div class="reg_fld"><?php echo strtoupper('The following information will not be published on YouGotRated and is used for administration purposes only. &#160;&#160;This information is where you will receive emails, and receipts from YouGotRated.com');?></div>
						<div class="reg_fld">CONTACT NAME:</div>
						
						<input type="text" class="reg_txt_box" placeholder="CONTACT NAME" id="cname" name="cname" maxlength="30" value="<?php echo $showdata['contactname']; ?>" /><div id="cnameerror" class="error">contact name is required.</div>
					</span>
				</div>
            
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">CONTACT NUMBER: </div>
						<input type="text" class="reg_txt_box" placeholder="XXX-XXX-XXXX" id="cphone" name="cphone" maxlength="12" value="<?php echo $showdata['contactphonenumber']; ?>" /><div id="cphoneerror" class="error">Contactphone is required.</div>
						  <div id="cphoneverror" class="error">Enter valid format - i.e. XXX-XXX-XXXX</div>
					</span>
				</div>
            
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">CONTACT EMAIL: </div>
						<input type="text" class="reg_txt_box" placeholder="CONTACT EMAIL" id="cemail" name="cemail" maxlength="200" value="<?php echo $showdata['contactemail']; ?>" /><div id="cemailerror" class="error">Enter valid Emailid.</div>             
					</span>
				</div>
            
          </div>
          
          <?php
          $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];         
		  if (strpos($url,'affid') !== false) 
		  {
		  ?>
		  <div class="reg-row" style="margin-top:10px !important;">
				 <div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						 <div class="reg_fld">ACQUISITION TYPE</div>
						   <select id="actype" name="actype">
							 <option value="select">Select</option>
							 <option value="phone">Phone</option>
							 <option value="internet">Internet</option>
							<option value="facetoface">Face to face</option>
						  </select>
						</div>
					</span>
				</div>
		  </div>	
		  <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
					  <div class="reg_fld">NOTES</div>
					  <input type="text" class="reg_txt_box" placeholder="NOTES" id="notes" name="notes" maxlength="50" />
					</span>
				</div>
          </div>
		  <?php
		  } 
          ?>
          
          <!-- payment details -->
          <div class="reg-row" style="margin-top:55px;">
				<div>
					<span class="form-col-1">
						<span class="form-circle">4</span>
					</span>
					<span class="form-col-2">
						<label>BUSINESS PAYMENT INFORMATION</label>
            
            <div class="reg_fld">FIRST NAME: </div>
            
            <input type="text" class="reg_txt_box" placeholder="FIRST NAME" id="fname" name="fname" maxlength="30" /><div id="fnameerror" class="error">First Name is required.</div>
					</span>
				</div>
            
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">LAST NAME: </div>
						<input type="text" class="reg_txt_box" placeholder="LAST NAME" id="lname" name="lname" maxlength="30" /><div id="lnameerror" class="error">Last Name is required.</div>
					</span>
				</div>
            
              
          </div>
          <div class="reg-row" style="margin-top:-1px;">
			  <div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">WHAT IS YOUR BILLING ADDRESS?</div>
						<input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50" />
						<br/>            
					  <div style="float:left;">
					   <?php echo form_dropdown('country',$selcon,'','id="country" class="seldrop" onchange=getstates(this.value,"state","#selstatediv");');?>
					   <input type="hidden" name="countryname" id="countryname"/>
					   </div>
					   <?php 
					  $selstate=array(''=>'--Select State--');
					  ?>
					  <div id="selstatediv" style="float:right;margin-right:127px;">
					  <?php echo form_dropdown('state',$selstate,'','id="state" class="seldrop"');?></div>
					  <br/>
						<input type="text" class="reg_txt_box-md" placeholder="CITY" id="city" name="city" maxlength="50" />
						<input type="text" class="reg_txt_box-md" placeholder="ZIP CODE" id="zip" name="zip" maxlength="10" />
						<div id="b_streetaddresserror" class="error">Street Address is required.</div>
						<div id="b_cityerror" class="error">City is required.</div>
						<div id="b_stateerror" class="error">State is required.</div>
						<div id="b_countryerror" class="error">Country is required.</div>
						<div id="b_ziperror" class="error">Zip Code is required.</div>
						<div id="b_zipverror" class="error">Enter digits only valid format 123456</div>
						<div id="b_streeterror" class="error">Street Address is required.</div>
						<div id="b_cityerror" class="error">City is required.</div>
						<div id="b_stateerror" class="error">State is required.</div>
						<div id="b_streeterror" class="error">Street Address is required.</div>
						<div id="b_zipcodeerror" class="error">Enter digits only.</div>
					</span>
				</div>
            
          </div>
          
          <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">CREDIT CARD TYPE:</div>
						<select id="card_type" name="card_type">
							<option value="VI">Visa</option>
							<option value="MC">Mastercard</option>
							<option value="AE">American Express</option>
							<option value="DI">Discover</option>				
						</select>
						
						
						<div id="cardtypeerror" class="cardtypeerror"></div>
						<div id="cardtypesuccess" class="cardtypesuccess"></div>
					</span>
				</div>
				
          </div>
          <script type="text/javascript"> // initialise variable to save cc input string 

		var cc_number_saved = ""; 

	</script>
          <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">CREDIT CARD NUMBER:</div>
						<input type="text" class="reg_txt_box" placeholder="CREDIT CARD NUMBER" id="ccnumber" name="ccnumber" maxlength="20"  onblur="cc_number_saved = this.value; this.value = this.value.replace(/[^\d]/g, ''); return checkcard();" onfocus="if(this.value != cc_number_saved) this.value = cc_number_saved;  " /><div id="ccnumbererror" class="error">Credit Card Number is required.</div>
						<div id="carderror" class="carderror"></div>
						<div id="cardsuccess" class="cardsuccess"></div>
					</span>
				</div>
				
          </div>
          
          
           <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">CVV Code:</div>
         
              
					  <input type="text" name="cvv" value="" id="cvv" class="input" placeholder="CVV Code">			       
					  
					   <a class="cvvpop" href="http://yougotrated.com/businessadmin/">What is this? 
							<img src="images/cvvpop1.jpg" id="cvvhover" style="display: none;">
					   </a>   
					</span>
				</div>
			   
                         
        </div>
          <div style="clear: both;"></div>
         
          <div class="reg-row" style="margin-top:10px !important;">
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">EXPIRATION DATE: </div>
						<select id="expirationdatem" name="expirationdatem">
							<option value="">--Month--</option>
							<?php for($i=1;$i<13;$i++) {?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php } ?>
						  </select>
						  &nbsp;
						  <select id="expirationdatey" name="expirationdatey">
							<option value="">--Year--</option>
							<?php for($k=0;$k<10;$k++) {?>
							<?php $a = date('Y')+$k;?>
							<option value="<?php echo $a;?>"><?php echo $a;?></option>
							<?php } ?>
						  </select>
						  <div id="ccnumbererror" class="error">Credit Card Number is required.</div><div id="expirationdateerror" class="error">Select Expiration Date.</div>
						  <div id="ccnumbererror" class="error">Credit Card Number is required.</div>
					</span>
				</div>
            
              
          </div>
          <!-- payment details -->
          <div class="reg-row" style="margin-top:55px;">

				<div>
					<span class="form-col-1">
						<span class="form-circle">5</span>
					</span>
					<span class="form-col-2">
						<label>HAVE DISCOUNT CODE?</label>
						<div class="reg_fld">ENTER DISCOUNT CODE: </div>
						<input type="text" class="reg_txt_box" placeholder="DISCOUNT CODE" id="discountcode" name="discountcode" maxlength="50" />
						<input type="button" id="applydisc" value="Apply code">
						<div id="discsuccess" class="error">Its is Valid code</div>
						<div id="discnorerror" class="error">Its is not Available</div>
						<div id="discallrerror" class="error">please enter code</div>
						<input type="hidden" id="discount-code-type" name="discount-code-type" />
                                                <input type="hidden" id="discounted-price" name="discounted-price" />  


					</span>
				</div>
          </div>
          <div class="reg-row" style="margin-top:27px;">   
				<div>
					<span class="form-col-1">
						&nbsp;
					</span>
					<span class="form-col-2">
						<div class="reg_fld">PLEASE VERIFY THAT ALL INFORMATION ENTERED ABOVE IS CORRECT.</div>
            <div class="reg_fld">MONTHLY COST: <span id="discprice">$<?php echo $defaultprice=$this->common->get_setting_value(19);?>.00</span></div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="CONTINUE TO CHECKOUT" id="btnaddcompany" name="btnaddcompany">CONTINUE TO CHECKOUT</button>
					</span>
				</div>
            
          </div>
        </form>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </div>
    </div>
  </section>
</section>
<script>
function chkwebsite(website){
	$("#websitevaliderror").hide();
	var filter  = /^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/;
	if( trim(website) != '' && filter.test(trim(website)) )
	{
		$('#websitevalidsuccess').show(); 
		return true;
	}else{
		$("#websiteerror").hide();
		$("#websitevaliderror").show();
		$("#websitevaliderror").text('Please enter a valid URL. For example http://www.example.com or https://www.example.com');
		$("#website").focus();
		return false;
	}
}
$(document).ready(function(){
	
	var affid = "<?php echo $this->uri->segment('4');  ?>";
	
	
	if(affid !='')
	{
		var affiliateId = 'affiliateId';
		createCookie(affiliateId,affid,30);
		
		
	}
	
	var affiliateId = readCookie('affiliateId');

	if(affiliateId!= null){
		$('#affiliatedId').val(affiliateId);
		
	}
	
	
 $("#applydisc").click(function(){
  if($("#discountcode").val().length >= 4)
  {
  var requestData = {
		type: 'checkDiscountCode',
		discountcode: $("#discountcode").val()
	  };
  $.ajax({
   type: "POST",
   url: "/solution/ajaxRequest",
   data: requestData,
   dataType:"json",
   success: function(data){
	if(data.discstatus=="success")
    {
     $("#discsuccess").show();
     $("#discsuccess").html('Your code was successfully applied! Updated monthly fee:'+data.monthlycost);
     $("#discprice").html(data.monthlycost);
     $("#discpricebanner").html(data.monthlycost);
     $("#discount-code-type").val(data.discountcodetype);
     $("#discounted-price").val(data.monthlyprice);
     $("#subscriptionprice").val(data.subscriptionprice);
     $("#discnorerror").hide();
     $("#discallrerror").hide();
    }
    else
    {
     $("#discnorerror").show();
     $("#discnorerror").html('Your code was invalid. Please contact YouGotRated if you believe this is incorrect, or try your code again');
     $("#discprice").html(data.subscriptionprice);
     $("#discpricebanner").html(data.subscriptionprice);
     $("#discsuccess").hide();
     $("#discallrerror").hide();
    }
   }
  });
  }
 
 });



 $("#name").blur(function(){
 var elitememflag=$('#elitemem').val();
  if(elitememflag==''){
	  if($("#name").val().length >= 4)
	  {
	  var requestData = {
			type: 'checkCompanyname',
			name: $("#name").val()
		  };
	  $.ajax({
	   type: "POST",
	   url: "/solution/ajaxRequest",
	   data: requestData,
	   dataType:"json",
	   success: function(data){
		if(data.status=="success")
	    {
	      $('#nametknerror').hide();
	      $('#nameerror').hide();
	      $('#namecheck').val(data.checkname);
	      return true;
	    }
	    else
	    {
	      $('#nametknerror').show();
	      $('#namecheck').val(data.checkname);
	      return false;
	    }
	   }
	  });
	  }
 
 }
});


 $("#email").blur(function(){
var elitememflag=$('#elitemem').val();
 if(elitememflag==''){
  var requestData = {
		type: 'checkEmail',
		email: $("#email").val()
	  };
  $.ajax({
   type: "POST",
   url: "/solution/ajaxRequest",
   data: requestData,
   dataType:"json",
   success: function(data){
    if(data.status=="success")
    {
      $('#emailtknerror').hide();
      $('#emailerror').hide();
      $('#emailcheck').val(data.checkvalue);
           return true;
    }
    else
    {
      $('#emailtknerror').show();
      $('#emailcheck').val(data.checkvalue);
      return false;
    }
   }
  });

 
  }});

 
	$('#cvvhover','#cvvhover').hide();

	//When the Image is hovered upon, show the hidden div using Mouseover
	$('.cvvpop').mouseover(function() {
	$('#cvvhover').show();
	});
	$('.cvvpop').mouseout(function() {
	$('#cvvhover').hide();
	});
 
});
</script>
<?php echo $footer;?>
