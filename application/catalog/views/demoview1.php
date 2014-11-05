<?php echo $header; ?>
<script type="text/javascript">// <![CDATA[
$(window).load(function() { $("#spinner").fadeOut("slow"); })
// ]]></script>
<div id="spinner"></div>

<script type="text/javascript" language="javascript">
              
              $(document).ready(function() {
					$("#membership").submit();
                    });
          </script>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea"> 
      <!-- table -->
      <table border="0" width="100%">
        
        <?php 
			  	$paypalid = $this->common->get_setting_value(12);
				$currencycode = $this->common->get_setting_value(16);
		  		$subscription = $this->common->get_setting_value(18);
          	    $subscriptionprice = $this->common->get_setting_value(19);
       		    $elite = $this->complaints->get_eliteship_bycompanyid($this->uri->segment(3));
			    $company = $this->complaints->get_company_byid($this->uri->segment(3));?>
     		   <?php /*?><form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="membership"><?php */?>
			   <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="membership">
               <input type="hidden" name="cmd" value="_xclick-subscriptions">
			   <input type="hidden" name="business" value="<?php echo $paypalid;?>">
			   <input type="hidden" name="item_name" value="buy elite membership">
               <input type="hidden" name="item_number" value="<?php echo $this->uri->segment(3);?>">
               <input type="hidden" name="image_url" value="https://www.yoursite.com/logo.gif">
               <!-- <input type="hidden" name="no_shipping" value="1">-->
               <input type="hidden" name="return" value="<?php echo base_url();?>complaint/update_claimnew">
               <input type="hidden" name="rm" value="2">
               <input type="hidden" name="cancel_return" value="<?php echo base_url();?>complaint/update_claimnew">
                 <!-- <input type="hidden" name="a1" value="0">
                  <input type="hidden" name="p1" value="1">
                  <input type="hidden" name="t1" value="W">
                  <input type="hidden" name="a2" value="5.00">
                  <input type="hidden" name="p2" value="2">
                  <input type="hidden" name="t2" value="M">-->
               <input type="hidden" name="a3" value="<?php echo  ( $subscriptionprice - ( $subscriptionprice* $dispercentage)/100);?>">
               <input type="hidden" name="p3" value="<?php echo $subscription;?>">
               <input type="hidden" name="t3" value="M">
               <input type="hidden" name="src" value="1">
               <input type="hidden" name="sra" value="1">
               <!--<input type="hidden" name="srt" value="5">-->
              <input type="hidden" name="no_note" value="1">
             <!-- <input type="hidden" name="custom" value="customcode">
              <input type="hidden" name="invoice" value="invoicenumber">-->
              <!--<input type="hidden" name="usr_manage" value="1">-->
              <input type="image"
                 src="http://images.paypal.com/images/x-click-but01.gif"
            border="0" name="submit"
            alt="Make payments with PayPal - it's fast, free and secure!">
            </form>
        </tr>
      </table>
    </div>
    </div>
  </section>
</section>
