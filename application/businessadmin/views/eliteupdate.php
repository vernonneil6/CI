<?php echo $heading; ?>
<!-- #content -->

<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('elite/update');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

  <?php if($this->uri->segment(2)=='update')  {
	  ?>
     <div class="box">
    <div class="headlines">
      <h2><span>Elite Update</span></h2>
    </div>
    <?php // print_r($elite[0]);?>
        <div class="box-content"> <?php echo form_open('elite/renew/'.$elite[0]['id'],array('class'=>'formBox','id'=>'frmvideo')); ?>
      <fieldset>
		    <input type="hidden" class="reg_txt_box" placeholder="companyid" id="companyid" name="companyid"  maxlength="30" value="<?php echo $elite[0]['id'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30" value="<?php echo $elite[0]['company'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150" value="<?php echo $elite[0]['siteurl'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" value="<?php echo $elite[0]['email'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="Country" id="country" name="country"  maxlength="250" value="<?php echo $elite[0]['country'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="State" id="state" name="state"  maxlength="250" value="<?php echo $elite[0]['state'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="City" id="city" name="city"  maxlength="250" value="<?php echo $elite[0]['city'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="Zip" id="zip" name="zip"  maxlength="250" value="<?php echo $elite[0]['zip'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="ADDRESS LINE" name="streetaddress" id="streetaddress" maxlength="50" value="<?php echo $elite[0]['streetaddress'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cname" name="cname" id="cname" maxlength="50" value="<?php echo $elite[0]['contactname'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cphone" name="cphone" id="cphone" maxlength="50" value="<?php echo $elite[0]['contactphonenumber'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cemail" name="cemail" id="cemail" maxlength="50" value="<?php echo $elite[0]['contactemail'];?>" />
        <div class="clearfix" style="width: 71%;padding-left: 10px;">
          <div class="lab">
             <p style="width: 272px;">Enter Your New Credit Card Information</p>
            <label for="title">Credit Card<span class="errorsign">*</span></label>
          </div>
          <div class="con">
      
            <?php echo form_input(array( 'name'=>'ccnumber','id'=>'ccnumber','class'=>'input','type'=>'text','placeholder'=>'Enter Your credit card number')); ?>
            </div>
             <div class="con" style='margin-top:10px'>
               <?php echo form_input(array( 'name'=>'fname','id'=>'fname','class'=>'input','type'=>'text','placeholder'=>'Enter Your first name')); ?>
            </div>
             <div class="con" style='margin-top:10px'>
            <?php echo form_input(array( 'name'=>'lname','id'=>'lname','class'=>'input','type'=>'text','placeholder'=>'Enter Your last name')); ?>
             </div> 
          <div id="titleerror" class="error" style="width:auto">title is required.</div>
        </div>
        <div class="clearfix" style="width: 71%;padding-left: 10px;">
          <div class="lab">
            <label for="videourl">Expiry date <span class="errorsign">*</span></label>
          </div>
          
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
           
         </div>
        <div class="btn-submit"> 
          <!-- Submit form -->
          
          <?php echo form_input(array('name'=>'btnupdate','id'=>'btnupdate','class'=>'button','type'=>'submit','value'=>'Update')); ?>
    
          </div>
      </fieldset>
      <?php echo form_close(); ?> </div>
  </div>
  <!-- /box-content -->
    <!-- Correct form message -->
    <?php if( $this->session->flashdata('success') ) { ?>
    <div class="form-message correct">
      <p><?php echo $this->session->flashdata('success'); ?></p>
    </div>
    <?php } ?>
    <!-- Error form message -->
    <?php if( $this->session->flashdata('error') ) { ?>
    <div class="form-message error1">
      <p><?php echo $this->session->flashdata('error'); ?></p>
    </div>
    <?php } ?>
   </div>
      <?php
	  
  }
?>
</div>
<!-- /#content -->
<?php  ?>
<!-- #sidebar -->

<?php include('leftmenu.php'); ?>
<!-- /#sidebar --> 
<!-- #footer --> 
<?php echo $footer; ?> 