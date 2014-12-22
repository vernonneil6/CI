<?php echo $header;?>
<script type="text/javascript" src="js/eliteform.js"></script>
<section class="container">
  <section class="main_contentarea">
    
    <div class="container">
      <div class="reg_step_edit_claim" style="display:none;"></div>
      <div class="reg_frm_wrap">
	        <?php //echo '<pre>';print_r($makeelite);?>
        <form class="reg_frm" action="index.php/company/makeelite" id="frmaddcompany" method="post" enctype="multipart/form-data">
          <div class="reg-row">
            <label>UPGRADE TO ELITE MEMBER HERE</label>
            <input type="hidden" class="reg_txt_box" placeholder="companyid" id="companyid" name="companyid"  maxlength="30" value="<?php echo $makeelite[0]['id']; ?>" />
            <input type="hidden" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" value="<?php echo $makeelite[0]['email']; ?>" />
            <input type="hidden" class="reg_txt_box" placeholder="Country" id="country" name="country"  maxlength="250" value="<?php echo $makeelite[0]['country']; ?>" />
            <input type="hidden" class="reg_txt_box" placeholder="State" id="state" name="state"  maxlength="250" value="<?php echo $makeelite[0]['state']; ?>" />
            <input type="hidden" class="reg_txt_box" placeholder="City" id="city" name="city"  maxlength="250" value="<?php echo $makeelite[0]['city']; ?>" />
            <input type="hidden" class="reg_txt_box" placeholder="Zip" id="zip" name="zip"  maxlength="250" value="<?php echo $makeelite[0]['zip']; ?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50" value="<?php echo $makeelite[0]['streetaddress']; ?>" />
            
          </div>
         <!-- payment details -->
          <div class="reg-row" style="margin-top:55px;">
            <label>YOUR PAYMENT INFORMATION</label>
            <div class="reg_fld">COMPANY</div>
                      <input type="text" class="reg_txt_box" placeholder="COMPANY" id="name" name="name" maxlength="30" value="<?php echo $makeelite[0]['company'];?>" />
            </div>
            <div class="reg-row" style="margin-top:10px !important;">
             <div class="reg_fld">LAST NAME</div>
              <input type="text" class="reg_txt_box" placeholder="FIRST NAME" id="fname" name="fname" maxlength="30" /><div id="fnameerror" class="error">First Name is required.</div>
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
