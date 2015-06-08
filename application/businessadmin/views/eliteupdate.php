<?php echo $heading; ?>
<!-- #content -->
<div id="content">
  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('elite/update');?>" title="<?php echo "Elite Update card"; ?>"><?php echo "Update Credit Card"; ?></a></li>
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

$(document).ready(function() {
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

  <div class="box">
    <div class="headlines">
      <h2><span>Update Credit Card</span></h2>
    </div>
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
     
     
		<div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab">
                <p style="width: 310px;margin-bottom:0px;">Enter Billing Address for your Debit/Credit Card</p>					
              </div>
              <div class="">            
              </div>
            </div>
          </div>
        </div>
         <div id="cc-error"><?php echo $this->session->flashdata('success_msg'); ?></div>
         <div class="form-cols" style="display:none;">
          <div class="col1" style="width:100%">
            <div class="clearfix">
				<table style="border:1px solid #ccc;width:80%;font-weight:bold;">
				<thead style="background-color:#D3F1FB">
				<tr>
				<th>Card Type</th>
				<th>Last 4 digits on card</th>
				<th>Expiration Date </th>
				<th>Billing Address</th>
				<th>Action</th>
				</tr>
				</thead>
				<tbody>
				<tr>
				<td style="padding-left: 10px;"> Visa</td>
				<td style="padding-left: 10px;"> 1234</td>
				<td style="padding-left: 10px;">05/2020</td>
				<td style="padding-left: 10px;"> NO 12/24 benz cross,</br>Suite 255,</br>Tampa Fl 3324</br>United States</br> (confirmed)</td>
				<td style="padding-left: 10px;"><a href="#">Edit</a> | <a href="#">Remove</a></td>
				</tr>
				</tbody>
				
				</table>
			</div>
		  </div>
		</div>
         
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>First Name:</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
					<?php echo form_input(array( 'name'=>'fname','id'=>'fname','class'=>'input','type'=>'text','placeholder'=>'Enter Your first name')); ?>
              </div>
            </div>
          </div>
        </div>
       
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>Last Name:</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
					<?php echo form_input(array( 'name'=>'lname','id'=>'lname','class'=>'input','type'=>'text','placeholder'=>'Enter Your last name')); ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>Street:</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php echo form_input(array( 'name'=>'streetaddress','id'=>'streetaddress','class'=>'input','type'=>'text','placeholder'=>'Enter Your street address')); ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>City:</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                 <?php echo form_input(array( 'name'=>'city','id'=>'city','class'=>'input','type'=>'text','placeholder'=>'Enter Your city')); ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="form-cols">
			<div class="col1" style="width:100%">
				<div class="clearfix">    
					<div class="lab" style="width: 8% !important;">
						<label>State:</label>
					</div>
					<div class="" style="float:left">
					<?php 
					  $selstate=array(''=>'--Select State--');
					?>
						<div id="selstatediv">
						  <?php echo form_dropdown('state',$selstate,'','id="state" class="seldrop"');?>
						 </div>
					</div>
				</div>
			</div>
		</div>       
		
		<div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
				
              <div class="lab" style="width: 8% !important;">
                <label>Country:</label>
              </div>
              <div class="" style="float:left">
                <?php echo form_dropdown('country',$selcon,'','id="country" class="seldrop" onchange=getstates(this.value,"state","#selstatediv");');?>
              </div>
              
             
              
            </div>
          </div>
        </div>
        
          <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>Zip:</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php echo form_input(array( 'name'=>'zip','id'=>'zip','class'=>'input','type'=>'text','placeholder'=>'Enter Your zip')); ?>
              </div>
            </div>
          </div>
        </div>
        
         <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab">
                <p style="width: 272px;">Enter Your New Credit Card Information</p>					
              </div>
              <div class="">            
              </div>
            </div>
          </div>
        </div>
        
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>CC Number:</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php echo form_input(array( 'name'=>'ccnumber','id'=>'ccnumber','class'=>'input','type'=>'text','placeholder'=>'Enter Your credit card number','onkeypress'=>'return number(event)','onblur'=>'return checkcard();','required'=>'required')); ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>CVV Code:</label>
              </div>
              <div class="con" style="width: 59% !important; float:left">
                <?php echo form_input(array( 'name'=>'cvv','id'=>'cvv','class'=>'input','type'=>'text','placeholder'=>'Enter Your CVV number')); ?>
			       
              </div>
               <a class="cvvpop" href="<?php echo base_url();?>">What is this? 
					<img src="images/cvvpop1.jpg" id="cvvhover" style="display:none;">
               </a> 
            </div>
          </div>
        </div>

		<div class="form-cols">
          <div class="col1" style="width:100%">
            <div class="clearfix">
              <div class="lab" style="width: 8% !important;">
                <label>Expiration date:<span class="errorsign">*</span></label>
              </div>
              <div class="" style="width: 59% !important; float:left">	 	  
				  
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
              </div>
            </div>
          </div>
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
