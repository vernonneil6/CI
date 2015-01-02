<?php echo $header; ?>

<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea"> <?php echo $menu; ?>
      <div class="dir_title" style="margin-top:20px;width:auto;"><?php echo $varheading; ?></div>
      <?php if( $this->uri->segment(1) && $this->uri->segment(1)=='contactus')
			{ ?>
      <div class="contactform"> 
        <script type="text/javascript" language="javascript">
                function trim(stringToTrim) {
                    return stringToTrim.replace(/^\s+|\s+$/g,"");
                }
                $(document).ready(function() {
                            
        		$("#frmcontact .close-red").click(function () {
						$("#frmcontact #message-red").fadeOut("slow");
				});
	
                    $("#btnsubmit").click(function () {
                        
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
												
						var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        if( trim($("#email").val()) == "" )
                        {
							$("#emailerror").hide();
                            $("#emailrqerror").show();
                            $("#email").val('').focus();
                            return false;
                        }
                        else
                        {
							$("#emailrqerror").hide();
                            if( !filter.test(trim($("#email").val())) )
                            {
                                $("#emailerror").show();
                                $("#email").val('').focus();
                                return false;
                            }
                            else
                            {
                                $("#emailerror").hide();
                            }
                        }
                        
                        if( trim($("#subject").val()) == "" )
                        {
                            $("#subjecterror").show();
                            $("#subject").val('').focus();
                            return false;
                        }
                        else
                        {
                            $("#subjecterror").hide();
                        }
												
												if( trim($("#message").val()) == "" )
                        {
                            $("#messageerror").show();
                            $("#message").val('').focus();
                            return false;
                        }
                        else
                        {
                            $("#messageerror").hide();
                        }
                            
                        $("#frmcontact").submit();
                        
                });

								});
            </script> 
        
        <!-- box --> 
        <?php echo form_open('contactus/update',array('class'=>'formBox','id'=>'frmcontact')); ?>
        <table class="data_table" cellspacing="0" cellpadding="0">
          <tbody>
            <!-- Correct form message -->
            <?php if( $this->session->flashdata('success') ) { ?>
          <div id="message-green">
            <tr>
              <td class="green-left"><?php echo $this->session->flashdata('success'); ?></td>
              <td class="green-right"><a class="close-green"><img src="<?php echo base_url(); ?>images/messages/icon_close_green.gif" alt="Close"/></a></td>
            </tr>
          </div>
          <?php } ?>
          <!-- Error form message --> 
          <!--  start message-red -->
          <?php if( $this->session->flashdata('error') ) { ?>
          <div id="message-red">
            <tr>
              <td class="red-left"><?php echo $this->session->flashdata('error'); ?></td>
              <td class="red-right"><a class="close-red"><img src="<?php echo base_url(); ?>images/messages/icon_close_red.gif" alt="Close"/></a></td>
            </tr>
          </div>
          <?php } ?>
            </tbody>
          
        </table>
        <!--  end message-red -->
        <table align="left" style="margin-top:20px;">
          <tbody>
            <tr>
              <td class="box_label" width="200px">Your Name<span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'name','id'=>'name','class'=>'box_txtbox','type'=>'text','style'=>'float:none;','placeholder'=>'Whats your name?' ) ); ?></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="nameerror" class="error">Name is required.</div></td>
            </tr>
            <tr>
              <td class="box_label" width="200px">Email Id<span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'email','id'=>'email','class'=>'box_txtbox','type'=>'text','style'=>'float:none;','placeholder'=>'Your email address...' ) ); ?></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="emailrqerror" class="error">Emailid is required.</div>
                <div id="emailerror" class="error">Enter valid Emailid.</div></td>
            </tr>
            <tr>
              <td class="box_label" width="200px">Subject<span class="error-sign">*</span></td>
              <td><?php echo form_input( array( 'name'=>'subject','id'=>'subject','class'=>'box_txtbox','type'=>'text','style'=>'float:none;','placeholder'=>'Subject...' ) ); ?></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="subjecterror" class="error">Subject is required.</div></td>
            </tr>
            <tr>
              <td class="box_label" valign="top">Your Message<span class="error-sign">*</span></td>
              <td><?php echo form_textarea( array( 'name'=>'message','id'=>'message','class'=>'complain_txtboxc','rows'=>'9','cols'=>'5','style'=>'height:95%;','placeholder'=>'Your message...' ) ); ?></td>
            </tr>
            <tr>
              <td></td>
              <td><div id="messageerror" class="error">Message is required.</div></td>
            </tr>
            <tr>
              <td></td>
              <td><?php echo form_input(array('name'=>'btnsubmit','id'=>'btnsubmit','class'=>'dir-searchbtn','type'=>'Submit','value'=>'Submit','style'=>'float:none;color:#fff; padding: 3px 16px;font-size:16px;text-shadow:none;')); ?></td>
            </tr>
          </tbody>
        </table>
        <?php echo form_close(); ?> </div>
      <div class="contactdata">
        <table border="0" width="100%">
          <tr>
            <td style="font-size:14px;line-height:17px;"><?php echo $content; ?></td>
          </tr>
        </table>
      </div>
      <!-- /#content --> 
      
      <!-- table -->
      
      <?php } else { ?>
      <table border="0" width="100%">
        <tr>
          <td style="font-size:14px;line-height:17px;"><?php echo $content; ?></td>
        </tr>
      </table>
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
            <div style="margin-top:10px;" class="my"> <?php echo form_checkbox(array('name'=>'readterms','type'=>'checkbox','id'=>'readterms','value'=>'Yes')); ?>&nbsp;I have read the <a href="<?php echo site_url('removeterms');?>" target="_blank" class="colorcode">Terms and Conditions</a><br/>
              <?php echo form_checkbox(array('name'=>'terms','type'=>'checkbox','id'=>'terms','value'=>'Yes')); ?>&nbsp;I agree to the terms and conditions </div>
            <div style="margin-top:10px;" class="my" align="center"> <a><?php echo form_input(array('name'=>'submit','id'=>'submit','class'=>'complaint_btn','type'=>'submit','value'=>'Continue To Remove Complaint','style'=>'padding:5px 20px;cursor: pointer;float:none;')); ?></a> </div>
            <?php echo form_close(); ?></td>
        </tr>
      </table>
      <?php } }?>
      <?php if($bottomads){ ?>
       <div class="ad_bottom"><a href="<?php echo $topads[0]['url'];?>" title="" target="_blank"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="topads" width="940" height="180" class="adimg"/></a> </div>
     
		  <?php } ?>
      
      </div>
    </div>
    <div>
    </div>
  </section>
</section>
<?php echo $footer; ?> 