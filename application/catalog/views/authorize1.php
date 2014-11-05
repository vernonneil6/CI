<?php echo $header; ?>

<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea"> <?php echo $menu; ?>
      
      <div class="dir_title" style="margin-top:20px;">
        <h1 style="font-size:24px !important;">Claim Business</h1>
      </div>
      
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
      <?php echo form_open('authorize/update',array('class'=>'formBox','id'=>'frmaddcompany')); ?>
      <table class="data_table" align="left" width="100%" border="0">
        <tbody>
          <tr>
            <td colspan="5" class="company_content_title">THIS INFORMATION WILL BE DISPLAYED ACROSS ALL SITES AND WILL BE THE INFORMATION PUBLISHED</td>
          </tr>
          <tr>
            <td class="box_label"><label for="name">Company Name</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'name','id'=>'name','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td><div id="nameerror" class="error">Name is required.</div>
              <div id="nametknerror" class="error">This compnay name is already exists.</div></td>
          </tr>
          <tr>
            <td class="box_label"><label for="streetaddress">Street Address</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'streetaddress','id'=>'streetaddress','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="2"><div id="streetaddresserror" class="error">Street Address is required.</div></td>
          </tr>
          <tr>
            <td class="box_label"><label for="city">City</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'city','id'=>'city','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
            <td></td>
            <td class="box_label"><label for="state">State</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'state','id'=>'state','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
          </tr>
          <tr>
            <td></td>
            <td width="320px"><div id="cityerror" class="error">City is required.</div></td>
            <td></td>
            <td></td>
            <td width="320px"><div id="stateerror" class="error">State is required.</div></td>
          </tr>
          <tr>
            <td class="box_label"><label for="country">Country</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'country','id'=>'country','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
            <td></td>
            <td class="box_label"><label for="phone">Zipcode</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'zip','id'=>'zip','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
          </tr>
          <tr>
            <td></td>
            <td width="320px"><div id="countryerror" class="error">Country is required.</div></td>
            <td></td>
            <td></td>
            <td><div id="ziperror" class="error">Zip Code is required.</div>
              <div id="zipverror" class="error">Enter digits only valid format 123456</div></td>
          </tr>
          <tr>
            <td class="box_label"><label for="phone">Phone</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'phone','id'=>'phone','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
            <td class="box_label"><label for="phone">Email</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
          </tr>
          <tr>
            <td></td>
            <td><div id="phoneerror" class="error">Phone is required.</div>
              <div id="phoneverror" class="error">Enter Valid format.0741852963</div></td>
            <td></td>
            <td></td>
            <td><div id="emailerror" class="error">Enter valid Emailid.</div></td>
          </tr>
          <tr>
            <td class="box_label"><label for="website">Website</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'website','id'=>'website','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td><div id="websiteerror" class="error">Website is required.</div></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="box_label"><label for="cat">Category</label></td>
            <td colspan="4"><div id="" style="overflow-y: scroll; height:180px;border: 1px solid #D9D9D9;">
                <?php for($i=0;$i<count($categories);$i++) { ?>
                <?php  $option = array( 'name'=>'cat[]', 'id'=>'cat[]', 'value'=>$categories[$i]['id'] );
        	    echo form_checkbox( $option ); ?>
                &nbsp; <span style="color:#666666;"> <?php echo stripslashes($categories[$i]['category'])."<br/>";?> </span>
                <?php } ?>
              </div></td>
          </tr>
          <tr>
            <td></td>
            <td colspan="4" class="company_content_title">The following information will not be posted on any of our websites and is used for administration purposes only </td>
          </tr>
          <tr>
            <td class="box_label"><label for="fname">First Name</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'fname','id'=>'fname','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
            <td></td>
            <td class="box_label"><label for="state">Last Name</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'lname','id'=>'lname','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
          </tr>
          <tr>
            <td></td>
            <td width="320px"><div id="fnameerror" class="error">First Name is required.</div></td>
            <td></td>
            <td></td>
            <td width="320px"><div id="lnameerror" class="error">Last Name is required.</div></td>
          </tr>
          <tr>
            <td class="box_label"><label for="ccnumber">Credit Card Number</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'ccnumber','id'=>'ccnumber','class'=>'box_txtbox','type'=>'text' ) ) ; ?></td>
            <td></td>
            <td class="box_label"><label for="expirationdate">Expiration Date</label>
              <span class="error-sign">*</span></td>
            <td><select id="expirationdatey" name="expirationdatey">
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
              </select></td>
          </tr>
          <tr>
            <td></td>
            <td width="320px"><div id="ccnumbererror" class="error">Credit Card Number is required.</div></td>
            <td></td>
            <td></td>
            <td width="320px"><div id="expirationdateerror" class="error">Select Expiration Date.</div></td>
          </tr>
          <tr>
            <td class="box_label"><label for="contact">Contact Name </label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'cname','id'=>'cname','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td><div id="cnameerror" class="error">contact name is required.</div></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="box_label"><label for="phonenum">Contact Phone</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'cphone','id'=>'cphone','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td><div id="cphoneerror" class="error">Contactphone is required.</div>
              <div id="cphoneverror" class="error">Enter Valid format.0741852963</div></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="box_label"><label for="contactemail">Contact Email</label>
              <span class="error-sign">*</span></td>
            <td><?php echo form_input( array( 'name'=>'cemail','id'=>'cemail','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td><div id="cemailerror" class="error">Enter valid Emailid.</div></td>
            <td></td>
            <td></td>
          </tr>
          <?php /*?><tr>
            <td class="box_label"><label for="discountcode">Discount Code</label></td>
            <td><?php echo form_input( array( 'name'=>'discountcode','id'=>'discountcode','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
          </tr><?php */?>
          <tr>
            <td></td>
            <td><!-- Submit form --> 
              <?php echo form_input(array('name'=>'btnaddcompany','id'=>'btnaddcompany','class'=>'dir-searchbtn','type'=>'submit','value'=>'Continue to Checkout','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;')); ?></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <?php echo form_close(); ?>
      <?php 
	   ?>
    </div>
    </div>
  </section>
</section>
<?php echo $footer; ?> 