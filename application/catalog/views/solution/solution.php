<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
    
    <?php if( count($solution) > 0 ) { ?>
			<?php if( strlen($solution[0]['image']) > 5 ) { ?>
			<div class="bs_banner" style="display:none">
			<img src="<?php echo base_url().$this->config->item('solution_main_upload_path').$solution[0]['image'];?>" alt="Business Solution" title="Business Solution" width="1050" height="540">
			<?php } ?>
			</div>
    <?php } ?>
    <div>
    
      
       
        <?php if( count($solution) > 0 ) { ?>
			<div class="solution_menu menu">
				 <ul>
					  <?php for($i=0;$i<count($solutions);$i++) { ?>	  
					<?php /*?><li><a href="solution" title="BUSINESS SOLUTIONS">BUSINESS SOLUTIONS</a></li>
							  <li><a href="pressrelease" title="PRESS RELEASES">PRESS RELEASES</a></li>
							  <li><a href="go/register" title="SIGN-UP">SIGN-UP</a></li>
					<?php */
					if($i==1)
					{
						$class = "";
						$i++;
					}
					else
					{
						$class = "";
					}
					if($i!=0)
					{ 
					?>          
					<li class = <?php echo $class; ?> ><a href="solution/detail/<?php echo stripslashes($solutions[$i]['urlkey']);?>" title="view"><?php echo ucwords(stripslashes($solutions[$i]['title']));?></a></li>
				    <?php } } ?>
        
				 </ul>
			</div>
        <?php } ?>
      
      <div class="innr_wrap">
        <div class="blnk_contarea">
          <div style="margin-top:10px;" align="center" id="claimdiv"> <span style="font-family:MyriadPro-Regular;" class="colorcode">To sign up for an Elite Membership - please click the link below:</span> <br/>
            <a href="<?php echo site_url('solution/claimbusiness');?>" title="Claim Your Business">
            <input type="image" class="sub_paypal" name="submit" border="0" src="../uploads/btn_cards.gif" alt="PayPal - The safer, easier way to pay online">
            <img alt="paypal" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" >
            <input type="submit" value="REGISTER" name="submit" title="PayPal - The safer, easier way to pay online!" class="headersub_btn">  </a>
           
              
             </div>
             
                  
          <?php if( count($solution) > 0 ) { ?>
          
          <!-- table -->
				 <table border="0" width="100%" class = "solution_margin">
					<?php for($i=0;$i<1;$i++) { ?>
					<tr>
					  <table width="100%" border="0">
						<tr>
						  <td></td>
						</tr>
						<tr>
						  <td class="login_box_title" style="font-size:20px;"><?php echo ucwords(stripslashes($solution[$i]['title']));?></td>
						</tr>
						<tr>
						  <td style="line-height:17px;"><?php echo stripslashes($solution[$i]['detail']);?></td>
						</tr>
					  </table>
					</tr>
					<?php } ?>      
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
              <?php if( $this->uri->segment(2)=='claim' && $this->uri->segment(3)!='' ) { ?>
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
             <?php /*  <td><?php if( $this->uri->segment(1)=='solution' && $this->uri->segment(2)=='') { ?>
                <div style="margin-top:10px;" align="center" id="claimdiv"> <span style="font-family: aller;" class="colorcode">Click to subscribe for Elite Membership</span> <br/>
                  <a href="<?php echo site_url('solution/claimbusiness');?>" title="Claim Your Business">
                  <input type="image" name="submit" border="0" src="https://www.paypalobjects.com/en_GB/i/btn/btn_subscribeCC_LG.gif" alt="PayPal - The safer, easier way to pay online" style="height:60px;width:180px;">
                  <img alt="paypal" border="0" width="1" height="1" src="https://www.paypal.com/en_US/i/scr/pixel.gif" ></a> </div>
                <?php } ?></td>*/ ?>
            </tr>
          </table>
          <!-- table -->
          <?php } /*else { ?>
          <div class="form-message warning">
            <p>No Records found.</p>
          </div>
          <?php  }*/?>
	</div>
	</div>
    </div>
  </section>
</section>
<?php echo $footer;?> 
