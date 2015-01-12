<?php echo $heading; ?>
<!-- #content -->
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('elite/update');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>

<?php if($this->uri->segment(2)=='update')  {	  ?>
	  
<link rel="stylesheet" type="text/css" href="../businessadmin/css/demo.css">
<script src="../businessadmin/js/jquery-1.11.1.min.js"></script>
<script src="../businessadmin/js/jquery.validate.min.js"></script>
<script src="../businessadmin/js/additional-methods.min.js"></script>	  
<script src="../businessadmin/js/formsubmit.js"></script>	  
<script type="text/javascript">

 $(document).ready(function(){
$("#ccnumber").click(function(){
	if ($("#ccnumber").val()) {
		$("#ccnumber").removeClass('error');
		$("#ccnumber-error").removeClass('error');
		$("#ccnumber-error").hide('');
	} else {
		$("#ccnumber-error").removeClass('error');
	}
});
});	
 
function number(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function checkcard()
{
  $.validator.setDefaults({
  debug: true,
  success: "valid"
});
$("#frmelite").validate({
  rules: {
    ccnumber: {
      required: true,
      creditcard: true
    }
  },
submitHandler : function(form) {
    form.submit();
  }
  
});
}
</script>

  <div class="box">
    <div class="headlines">
      <h2><span>Elite Update</span></h2>
    </div>
    <?php // print_r($elite[0]);?>
        <div class="box-content"> 
			<?php echo form_open('elite/renew/'.$elite[0]['id'],array('class'=>'formBox','id'=>'frmelite')); ?>
			<?php //echo form_open('elite/update',array('class'=>'formBox','id'=>'frmelite')); ?>
			
      <fieldset>
		    <input type="hidden" class="reg_txt_box" placeholder="companyid" id="companyid" name="companyid"  maxlength="30" value="<?php echo $elite[0]['id'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="NAME" id="name" name="name"  maxlength="30" value="<?php echo $elite[0]['company'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="WEBSITE" id="website" name="website"  maxlength="150" value="<?php echo $elite[0]['siteurl'];?>" />
            <input type="hidden" class="reg_txt_box" placeholder="E-MAIL ADDRESS" id="email" name="email"  maxlength="250" value="<?php echo $elite[0]['email'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cname" name="cname" id="cname" maxlength="50" value="<?php echo $elite[0]['contactname'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cphone" name="cphone" id="cphone" maxlength="50" value="<?php echo $elite[0]['contactphonenumber'];?>" />
            <input type="hidden" class="reg_txt_box-lg" placeholder="cemail" name="cemail" id="cemail" maxlength="50" value="<?php echo $elite[0]['contactemail'];?>" />
       
        <div class="clearfix" style="width: 71%;padding-left: 10px;margin-top:15px">
				<div class="lab">
					 <p style="width: 272px;">Enter Your Billing Address Information</p>
					
				</div>	    
							
				<div class="con">
				   <?php echo form_input(array( 'name'=>'streetaddress','id'=>'streetaddress','class'=>'input','type'=>'text','placeholder'=>'Enter Your streetaddress')); ?>
                </div>
               
               <div class="con" style='margin-top:10px'> 
			     <div style="float:left;">
				   <?php echo form_dropdown('country',$selcon,'','id="country" class="seldrop" onchange=getstates(this.value,"state","#selstatediv");');?>
				   </div>
				   <?php 
				  $selstate=array(''=>'--Select State--');
				  ?>
				  <div id="selstatediv" style="float:right;margin-right:127px;">
				  <?php echo form_dropdown('state',$selstate,'','id="state" class="seldrop"');?></div>
				  <br/>
			   </div> 	    
               <div class="con" style='margin-top:10px'> 
			      <?php echo form_input(array( 'name'=>'city','id'=>'city','class'=>'input','type'=>'text','placeholder'=>'Enter Your city')); ?>
			   </div> 	    
               <div class="con" style='margin-top:10px'> 
			    <?php echo form_input(array( 'name'=>'zip','id'=>'zip','class'=>'input','type'=>'text','placeholder'=>'Enter Your zip')); ?>
			   </div>
			   	 	    
          
        </div>
        <div class="clearfix" style="width: 71%;padding-left: 10px;">
				<div class="lab">
					 <p style="width: 272px;">Enter Your New Credit Card Information</p>
					<label for="title">Credit Card<span class="errorsign">*</span></label>
				</div>
				  <div class="con">
					  <?php echo form_input(array( 'name'=>'ccnumber','id'=>'ccnumber','class'=>'input','type'=>'text','placeholder'=>'Enter Your credit card number','onkeypress'=>'return number(event)','onblur'=>'return checkcard();','required'=>'required')); ?>
				  </div>
				<div class="con" style='margin-top:10px'> 
			        <?php echo form_input(array( 'name'=>'cvv','id'=>'cvv','class'=>'input','type'=>'text','placeholder'=>'Enter Your CVV number')); ?>
			   </div>
			   <div class="con" style='margin-top:10px'>
					   <?php echo form_input(array( 'name'=>'fname','id'=>'fname','class'=>'input','type'=>'text','placeholder'=>'Enter Your first name')); ?>
					</div>
				   <div id="cc-error"><?php echo $this->session->flashdata('success_msg'); ?></div>
				   
				<div class="con" style='margin-top:10px'>
					<?php echo form_input(array( 'name'=>'lname','id'=>'lname','class'=>'input','type'=>'text','placeholder'=>'Enter Your last name')); ?>
				</div>
		</div>
		
		
        <div class="clearfix" style="width: 90%;padding-left: 10px;">
			  <div class="lab">
				<label for="videourl">Expiration date<span class="errorsign">*</span></label>
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
