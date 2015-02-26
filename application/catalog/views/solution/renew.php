<?php echo $header;?>

<script type="text/javascript" src="js/renewform.js"></script>
<section class="container">
  <section class="main_contentarea">
    
    <div class="container">
      <div class="reg_step_edit_claim" style="display:none;"></div>
      <div class="reg_frm_wrap">
	      
        <form class="reg_frm" action="index.php/solution/receipt" id="frmaddcompany" method="post" enctype="multipart/form-data">
          <div class="reg-row">
            <label>RENEW YOUR SUBSCRIPTION HERE</label>
            <div class="reg_fld">PLEASE RENEW YOUR ELITEMEMBERSHIP SUBSCRIPTION HERE FOR ACTIVATING IT.</div>
            <?php //print_r($renewelite[0]);?>
            <input type="hidden" class="reg_txt_box" placeholder="companyid" id="companyid" name="companyid"  maxlength="30" value="<?php echo $renewelite[0]['id'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="companyid" id="renewid" name="renewid"  maxlength="30" value="<?php echo $renewelite[0]['id'];?>" />
            <input type="text" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30" value="<?php echo $renewelite[0]['company'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150" value="<?php echo $renewelite[0]['siteurl'];?>" />
                                                                                 <?php $category=$this->complaints->get_categories_byid($renewelite[0]['categoryid']);?>
            <input type="hidden" class="reg_txt_box-lg" placeholder="category" name="categorylist" id="category" maxlength="50" value="<?php echo $category[0]['categoryname'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" value="<?php echo $renewelite[0]['email'];?>" />
            <input type="hidden" class="reg_txt_box"  id="streetaddress1" name="streetaddress1"  maxlength="250" value="<?php echo $renewelite[0]['companystreet'];?>" />
            <input type="hidden" class="reg_txt_box"  id="country1" name="countryname1"  maxlength="250" value="<?php echo $renewelite[0]['companycountry'];?>" />
            <input type="hidden" class="reg_txt_box"  id="state1" name="state1"  maxlength="250" value="<?php echo $renewelite[0]['companystate'];?>" />
            <input type="hidden" class="reg_txt_box"  id="city1" name="city1"  maxlength="250" value="<?php echo $renewelite[0]['companycity'];?>" />
            <input type="hidden" class="reg_txt_box"  id="zip1" name="zip1"  maxlength="250" value="<?php echo $renewelite[0]['companyzip'];?>" />
            <input type="hidden" class="reg_txt_box"  id="phone" name="phone"  maxlength="250" value="<?php echo $renewelite[0]['phone'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cname" name="cname" id="cname" maxlength="50" value="<?php echo $renewelite[0]['contactname'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cphone" name="cphone" id="cphone" maxlength="50" value="<?php echo $renewelite[0]['contactphonenumber'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cemail" name="cemail" id="cemail" maxlength="50" value="<?php echo $renewelite[0]['contactemail'];?>" />
          </div>
         <!-- payment details -->
          <div class="reg-row" style="margin-top:55px;">
            <label>BUSINESS PAYMENT INFORMATION</label>
            
            <div class="reg_fld">FIRST NAME</div>
            
            <input type="text" class="reg_txt_box" placeholder="FIRST NAME" id="fname" name="fname" maxlength="30" /><div id="fnameerror" class="error">First Name is required.</div>
          </div>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">LAST NAME</div>
            <input type="text" class="reg_txt_box" placeholder="LAST NAME" id="lname" name="lname" maxlength="30" /><div id="lnameerror" class="error">Last Name is required.</div>
              
          </div>
          <div class="reg-row" style="margin-top:-1px;">
            <div class="reg_fld">WHAT IS YOUR BILLING ADDRESS?</div>
            <input type="text" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50" />
            <br/>
            <style>
			.seldrop
			{   background: none repeat scroll 0 0 #FFFFFF;
				border: 1px solid #000000;
				margin-top: 8px;
				width: 249px;
			}
			</style>
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
          </div>
           <script type="text/javascript"> // initialise variable to save cc input string 
     		var cc_number_saved = ""; 
        	</script>
          <div class="reg-row" style="margin-top:10px !important;">
            <div class="reg_fld">CREDIT CARD NUMBER</div>
            <!--<input type="text" class="reg_txt_box" placeholder="CREDIT CARD NUMBER" id="ccnumber" name="ccnumber" maxlength="20" onkeypress="return number(event)" onblur="return checkcard()"/><div id="ccnumbererror" class="error">Credit Card Number is required.</div>-->
            <input type="text" class="reg_txt_box" placeholder="CREDIT CARD NUMBER" id="ccnumber" name="ccnumber" maxlength="20"  onblur="cc_number_saved = this.value; this.value = this.value.replace(/[^\d]/g, ''); return checkcard();" onfocus="if(this.value != cc_number_saved) this.value = cc_number_saved;  " /><div id="ccnumbererror" class="error">Credit Card Number is required.</div>
            <div id="carderror" class="carderror"></div>
            <div id="cardsuccess" class="cardsuccess"></div>   
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
        <div class="reg-row" style="margin-top:27px;">
            <label>RENEW YOUR ACCOUNT</label>
            <div class="reg_fld"></div>
            <button type="submit" class="lgn_btn" style="margin-top:32px;" title="CONTINUE TO CHECKOUT" id="btnaddcompany" name="btnaddcompany">RENEW ELITEMEMBERSHIP</button>
          </div>
        </form>
        <div class="lgn_btnlogo" > <a href="<?php echo base_url();?>" title="<?php echo $site_name;?>" ><img src="images/ygr_logos.png" class="logo_btm" alt="Yougotrated" title="Yougotrated"></a> </div>
      </div>
    </div>
  </section>
</section>
<script>
$(document).ready(function(){
	
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
