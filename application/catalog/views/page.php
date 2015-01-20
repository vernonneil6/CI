<?php echo $header; ?>

<section class="container">
  <section class="main_contentarea">
    <div class="innr_wrap">
      <?php //echo $menu; ?>
      <h1 class="bannertext font_size_banner"><?php echo $varheading; ?></h1>
      <?php if( $this->uri->segment(1) && $this->uri->segment(1)=='contactus')
			{ ?>
    
        <script type="text/javascript" language="javascript">
                function trim(stringToTrim) {
                    return stringToTrim.replace(/^\s+|\s+$/g,"");
                }
                $(document).ready(function() {
                            
        		   $("#contactbtnsubmit").click(function () {
                        
                        if( trim($("#contactname").val()) == "" )
                        {
                            $("#nameerror").show();
                            $("#contactname").val('').focus();
                            return false;
                        }
                        else
                        {
                            $("#contactnameerror").hide();
                        }
												
						var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if( trim($("#contactemail").val()) == "" )
                        {
							$("#emailerror").hide();
                            $("#emailerror").show();
                            $("#contactemail").val('').focus();
                            return false;
                        }
                        else
                        {
							$("#emailrqerror").hide();
                            if( !filter.test(trim($("#contactemail").val())) )
                            {
                                $("#emailerror").show();
                                $("#contactemail").val('').focus();
                                return false;
                            }
                            else
                            {
                                $("#emailerror").hide();
                            }
                        }
                        
                        if( trim($("#contactsubject").val()) == "" )
                        {
                            $("#subjecterror").show();
                            $("#contactsubject").val('').focus();
                            return false;
                        }
                        else
                        {
                            $("#subjecterror").hide();
                        }
												
						if( trim($("#contactmessage").val()) == "" )
                        {
                            $("#messageerror").show();
                            $("#contactmessage").val('').focus();
                            return false;
                        }
                        else
                        {
                            $("#messageerror").hide();
                        }
                            
                        $("#frmcontactfrm").submit();
                        
                });

								});
            </script> 
        
        <!-- box --> 
        
		<?php echo form_open('contactus/update',array('class'=>'form_wrap','id'=>'frmcontactfrm')); ?>
        <div class="login_lft">
          <div class="row">
            <h2 class="user_lbl">Name</h2>
            <input type="text" class="txt_box" placeholder="ENTER YOUR NAME" name="contactname" id="contactname" maxlength="30">
            <div id="nameerror" class="error">Name is required.</div>
          </div>
          <div class="row">
            <h2 class="user_lbl">Email</h2>
            <input type="text" class="txt_box" placeholder="ENTER YOUR EMAIL" name="contactemail" id="contactemail" maxlength="200">
            <div id="emailerror" class="error">Enter valid email.</div>
          </div>
          <div class="row">
            <h2 class="user_lbl">Subject</h2>
            <input type="text" class="txt_box" placeholder="ENTER SUBJECT" name="contactsubject" id="contactsubject" maxlength="100">
            <div id="subjecterror" class="error">Subject is required.</div>
          </div>
          <div class="row">
            <h2 class="user_lbl">Message</h2>
            <textarea class="txt_box" placeholder="ENTER MESSAGE" name="contactmessage" id="contactmessage" maxlength="500" style="height:100px;"></textarea>
            <div id="messageerror" class="error">Message is required.</div>
          </div>
          <div class="row">
            <button type="button" class="lgn_btn" title="Login" id="contactbtnsubmit" name="contactbtnsubmit">Submit</button>
          </div>
        </div>
        
      <div class="login_lft" style="margin-left:20px !important;width:400px !important;padding-right:10px !important; ">
         <?php echo $content; ?>
         </div>
        
      
      <?php } else { ?>
      <div style="min-height:150px;"><?php echo $content; ?></div>
      
      <?php if( $this->uri->segment(1)=='remove' && $this->uri->segment(2)=='complaint') { ?>
      <?php $removeamount=$this->common->get_setting_value(10); ?>
      <?php $currencycode=$this->common->get_setting_value(16); ?>
      <table>
        <tr>
          <td class="company_content_title">Cost :</td>
          <td><?php echo $currencycode.'  '.$removeamount;?></td>
        </tr>
      </table>
      <table align="center">
        <tr>
          <td><script>		 
						 $(document).ready(function(){
							
							$("#submit").click(function () {
							 
							     if(!$("#readterms").is(":checked") )
		                      	{
        			                 alert("Please read Terms and Conditions")
			                         return false;
            		          	}
																
								if(!$("#terms").is(":checked") )
		                      	{
        			                 
									 alert("Please Agree with Terms and Conditions")
									 return false;
            		          	}
								
						  });
						 });
						
						</script>
            <?php	if($_SERVER['HTTP_HOST']=="localhost")
							{
								echo form_open_multipart('https://www.sandbox.paypal.com/cgi-bin/webscr');
								echo form_hidden( array( 'business'=>'yritpartner@mxicoders.com' ) );
		}
						else
						{
			echo form_open_multipart('https://www.paypal.com/cgi-bin/webscr');
			echo form_hidden( array( 'business'=>$this->common->get_setting_value(12) ) );
		} ?>
            <?php echo form_hidden( array( 'cmd'=>'_xclick' ) ); ?> <?php echo form_hidden( array( 'item_name'=>'complaint' ) ); ?> <?php echo form_hidden( array( 'item_number'=>$this->uri->segment(3) ) ); ?> <?php echo form_hidden( array( 'amount'=>$removeamount ) ); ?> <?php echo form_hidden( array( 'currency_code'=>$currencycode ) ); ?> <?php echo form_hidden( array( 'rm'=>'2' ) ); ?> <?php echo form_hidden( array( 'charset'=>'utf-8' ) ); ?> <?php echo form_hidden( array( 'return'=>site_url('paypal/payment_return/'.$this->uri->segment(3).'/'.$this->uri->segment(4)))); ?> <?php echo form_hidden( array( 'notify_url'=>site_url('paypal/payment_notify/'.$this->uri->segment(3).'/'.$this->uri->segment(4)))); ?> <?php echo form_hidden( array( 'cancel_return'=>site_url('paypal/payment_cancel'))); ?>
            <div style="margin-top:10px;" class="my"> <?php echo form_checkbox(array('name'=>'readterms','type'=>'checkbox','id'=>'readterms','value'=>'Yes')); ?>&nbsp;I have read the <a href="<?php echo site_url('removeterms');?>" target="_blank" class="colorcode" title="Terms and Conditions">Terms and Conditions</a><br/>
              <?php echo form_checkbox(array('name'=>'terms','type'=>'checkbox','id'=>'terms','value'=>'Yes')); ?>&nbsp;I agree to the terms and conditions </div>
            <div style="margin-top:10px;" class="my" align="center"> <a title="Submit"><?php echo form_input(array('name'=>'submit','id'=>'submit','class'=>'lgn_btn','type'=>'submit','value'=>'Continue To Remove Complaint','style'=>'padding:5px 20px;cursor: pointer;float:none;')); ?></a> </div>
            <?php echo form_close(); ?></td>
        </tr>
      </table>
      <?php } }?>
    
    </div>
    </div>
    <div> </div>
  </section>
</section>
<?php echo $footer; ?> 
