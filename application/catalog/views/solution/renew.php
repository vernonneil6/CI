<?php echo $header;?>
<script type="text/javascript" src="js/eliteform.js"></script>

<section class="container">
  <section class="main_contentarea">
    
    <div class="container">
      <div class="reg_step_edit_claim" style="display:none;"></div>
      <div class="reg_frm_wrap">
	      
        <form class="reg_frm" action="solution/renew_update/<?php echo $renewelite[0]['id'];?>" id="frmaddcompany" method="post" enctype="multipart/form-data">
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
