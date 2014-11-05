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
        </div>
        
          <td><?php
	   		if(count($company)>0)
			{
				if( count($elite)==0 ) { ?>
            <div style="margin-top:10px;" align="center" title="Click to subscribe for Elite Membership"> <span class="company_content_title">Click to subscribe for Elite Membership</span>
             <?php	if($_SERVER['HTTP_HOST']=="localhost") { ?>
              <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="membership">
              <?php } else { ?>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="membership">
                <?php } ?>
                <!--<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="membership">-->
                <!-- Identify your business so that you can collect the payments. -->
                <?php $paypalid = $this->common->get_setting_value(12);?>
                <input type="hidden" name="business" value="<?php echo $paypalid;?>">
                <!-- Specify a Subscribe button. -->
                <input type="hidden" name="cmd" value="_xclick-subscriptions">
                <!-- Identify the subscription. -->
                <input type="hidden" name="item_name" value="Elite Membership ">
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
      </table>
    </div>
    </div>
  </section>
</section>
