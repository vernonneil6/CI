<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea"> <?php echo $menu; ?>
      
      <?php 
	  if( $this->uri->segment(2)=='claimbusiness' )
	  { ?>
      <div class="dir_title" style="margin-top:20px;"><h1 style="font-size:24px !important;">Claim Business</h1></div>
      <?php }
      else { ?>
      <div class="dir_title" style="margin-top:20px;width:auto;"><h1 style="font-size:24px !important;"><?php echo $section_title;?></h1>
        <?php if( $this->uri->segment(1)=='solution' && $this->uri->segment(2)=='') { ?>
        <div style="margin-top:10px;" align="center" id="claimdiv"> <span style="font-family: aller;" class="colorcode">Click to subscribe for Elite Membership</span> <br/>
          <a href="<?php echo site_url('solution/claimbusiness');?>" title="Claim Your Business">
          <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_GB/i/btn/btn_subscribeCC_LG.gif" alt="PayPal - The safer, easier way to pay online" style="height:60px;width:180px;">
          <img alt="paypal" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" ></a> </div>
        <?php } ?>
      </div>
      <?php } ?>
      
      <?php 
	  if( $this->uri->segment(2)=='claimbusiness' )
	  { ?>
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
      <?php echo form_open('solution/update',array('class'=>'formBox','id'=>'frmaddcompany')); ?>
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
          <tr>
            <td class="box_label"><label for="discountcode">Discount Code</label></td>
            <td><?php echo form_input( array( 'name'=>'discountcode','id'=>'discountcode','class'=>'box_txtbox','type'=>'text' ) ); ?></td>
            <td></td>
          </tr>
          <tr>
            <td></td>
            <td><!-- Submit form --> 
              <?php echo form_input(array('name'=>'btnaddcompany','id'=>'btnaddcompany','class'=>'dir-searchbtn','type'=>'submit','value'=>'Continue to Checkout','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:15px;text-shadow:none;')); ?></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <?php echo form_close(); ?>
      <?php } else {
	  ?>
      
      <?php if( count($solutions) > 0 ) { ?>
      
      <!-- table -->
      <table border="0" width="100%">
        <?php for($i=0;$i<count($solutions);$i++) { ?>
        <tr>
          <table width="100%" style="border-bottom: 1px solid #CCCCCC;" border="0">
            <tr>
              <td></td>
            </tr>
            <tr>
              <td class="login_box_title" style="font-size:20px;"><?php echo stripslashes($solutions[$i]['title']);?></td>
            </tr>
            <tr>
              <td style="line-height:17px;"><?php echo stripslashes($solutions[$i]['detail']);?></td>
            </tr>
          </table>
        </tr>
        <?php } 
       ?>
        <style>
		.box_txtbox11{
		background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #D9D9D9;
    box-shadow: 0 0 10px #CCCCCC inset;
    color: #666666;
    font-family: ubuntu;
    font-size: 16px;
    height: 30px;
    padding: 5px;
    width: 150px;
		}
		#discode
		{
		display:none;
		}
		</style>
        <?php 
			  	$currencycode = $this->common->get_setting_value(16);
		  		$subscription = $this->common->get_setting_value(18);
          	    $subscriptionprice = $this->common->get_setting_value(19);
       		    $elite = $this->complaints->get_eliteship_bycompanyid($this->uri->segment(3));
			    $company = $this->complaints->get_company_byid($this->uri->segment(3));?>
        <!--<script type="text/javascript" language="javascript">
               $(document).ready(function() {
                    $("#dislink").click(function () {
                        $("#discode").toggle();
                    });
                });
            </script>-->
        <?php if( $this->uri->segment(2)=='claimdisc' || $this->uri->segment(2)=='claim'){?>
        <div style="margin-top:10px;" align="center" title="Subscribe Time"> <span class="company_content_title">Subscribe Time : <?php echo $subscription;?> Month</span> <br/>
          <span class="company_content_title">Subscribe Price :
          <?php 
		   if( $this->uri->segment(2)=='claimdisc' && $this->uri->segment(3)!='' && $this->uri->segment(4)!=''){
					if( $dispercentage==100 )
					{
						echo "Free for the first month";
					}
					else
					{
	echo ( $totalprice = $subscriptionprice - ($subscriptionprice * $dispercentage)/100).' '.$currencycode.' '.'( '.$dispercentage." % off )";		
					}
				} else {
			
		   echo $totalprice = $subscriptionprice.' '.$currencycode; }?>
          </span> <br/>
          <?php if( $this->uri->segment(2)=='claim' && $this->uri->segment(3)!='' ) { ?>
          <!--<span class="company_content_title" id="dislink" style="cursor:pointer;">Click to add discount code:</span>-->
          <?php /*?><div id="discode"> <?php echo form_open('solution/getdiscount',array('id'=>'frmdis')); ?>
              <input type="hidden" name="company_id" value="<?php echo $this->uri->segment(3);?>">
              <input type="text" class="box_txtbox11" name="discountcode" id="discountcode" />
              <?php echo form_input(array('name'=>'btndissubmit','id'=>'btndissubmit','class'=>'dir-searchbtn','type'=>'submit','value'=>'Add','style'=>'float:none;color:#fff; padding: 3px 10px;font-size:16px;text-shadow:none;')); ?> <?php echo form_close(); ?> </div><?php */?>
          <?php } ?>
        </div>
        
          <td><?php
	   		if(count($company)>0)
			{
				if( count($elite)==0 ) { ?>
            <div style="margin-top:10px;" align="center" title="Click to subscribe for Elite Membership"> <span class="company_content_title">Click to subscribe for Elite Membership</span>
              <?php	if($_SERVER['HTTP_HOST']=="localhost") { ?>
              <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
              <?php } else { ?>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <?php } ?>
                <!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">-->
                <!-- Identify your business so that you can collect the payments. -->
                <?php $paypalid = $this->common->get_setting_value(12);?>
                <input type="hidden" name="business" value="<?php echo $paypalid;?>">
                <!--<input type="hidden" name="business" value="info@capleswebdev.com">-->
                <?php /*?><input type="hidden" name="business" value="<?php echo $paypalid;?>"><?php */?>
                <!-- Specify a Subscribe button. -->
                <input type="hidden" name="cmd" value="_xclick-subscriptions">
                <!-- Identify the subscription. -->
                <input type="hidden" name="item_name" value="Elite Membership">
                <input type="hidden" name="item_number" value="<?php echo $this->uri->segment(3);?>">
                <!-- Set the terms of the regular subscription. -->
                <input type="hidden" name="currency_code" value="<?php echo $currencycode;?>">
                <input type="hidden" name="notify_url" value="<?php echo base_url();?>complaint/update_claim/<?php echo $this->uri->segment(4);?>">
                <input type="hidden" name="return" value="<?php echo base_url();?>complaint/update_claim/<?php echo $this->uri->segment(4);?>">
                <input type="hidden" name="cancel_return" value="<?php echo base_url();?>complaint/update_claim/<?php echo $this->uri->segment(4);?>">
                <?php if( $this->uri->segment(2)=='claimdisc' && $this->uri->segment(3)!='' && $this->uri->segment(4)!=''){ 
				if( $dispercentage==100 ){
				?>
                <input type="hidden" name="a3" value="<?php echo $subscriptionprice;?>">
                <?php } else { ?>
                <input type="hidden" name="a3" value="<?php echo $totalprice;?>">
                <?php } ?>
                <?php } else { ?>
                <input type="hidden" name="a3" value="<?php echo $subscriptionprice;?>">
                <?php } ?>
                <input type="hidden" name="p3" value="<?php echo $subscription;?>">
                <input type="hidden" name="t3" value="M">
                <input type="hidden" name="src" value="1">
                <!-- recurring=yes -->
                <input type="hidden" name="sra" value="1">
                <!-- Display the payment button. -->
                <?php            
                	   if( $this->uri->segment(2)=='claimdisc' && $this->uri->segment(3)!='' && $this->uri->segment(4)!=''){
					if( $dispercentage==100 ) {?>
                <input type="hidden" name="a1" value="0.00">
                <input type="hidden" name="p1" value="1">
                <input type="hidden" name="t1" value="M">
                <input type="hidden" name="on0" value="pranay">
                <?php } }?>
                <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_GB/i/btn/btn_subscribeCC_LG.gif" alt="PayPal - The safer, easier way to pay online">
                <img alt="paypal" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" >
              </form>
              <?php }?>
            </div>
            <?php
			 }?></td>
          <?php } ?>
        </tr>
        <tr>
        <td><?php if( $this->uri->segment(1)=='solution' && $this->uri->segment(2)=='') { ?>
        <div style="margin-top:10px;" align="center" id="claimdiv"> <span style="font-family: aller;" class="colorcode">Click to subscribe for Elite Membership</span> <br/>
          <a href="<?php echo site_url('solution/claimbusiness');?>" title="Claim Your Business">
          <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_GB/i/btn/btn_subscribeCC_LG.gif" alt="PayPal - The safer, easier way to pay online" style="height:60px;width:180px;">
          <img alt="paypal" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" ></a> </div>
        <?php } ?></td>
        
        </tr>
      </table>
      <!-- table -->
      <?php } else { ?>
	  <div class="form-message warning">
                        <p>No Records found.</p>
                      </div>
	  <?php  }?>
      <?php 
	   ?>
    </div>
    </div>
  </section>
</section>

<?php } echo $footer; ?>
