<?php echo $header; ?>

<?php $a = $this->session->userdata['youg_admin']['id'];
              $com = $this->settings->get_company_byid($a);
             if(count($com) >0 )
             {
				 $companyname=$com[0]['company'];
				 $companyseo=$com[0]['companyseokeyword'];
				 
			 } 
             
        ?>
<div id="content">

  <div class="breadcrumbs">
    <ul>
      <li class="home"><a href="<?php echo site_url('dashboard');?>" title="Dashboard">Dashboard</a></li>
      <li><a href="<?php echo site_url('buyer');?>" title="<?php echo $section_title; ?>"><?php echo $section_title; ?></a></li>
    </ul>
  </div>


<div class="box">
    <div class="headlines">
      <h2><span><?php echo $section_title; ?></span></h2>
    </div>
    
    <!--Embed into Emails-->
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
      
      <tr class="odd">
        <td style="vertical-align: top">
	<h2>SEAL FOR YOUR EMAILS</h2>
	<p>&nbsp;</p> 
	Embeddable Buyer Protection Code: Embed into Emails Only
	</td>
        <td>
        <p>To embed this code into your email, simply copy this code into your outgoing email's code.</p>
        <textarea cols='90' rows='10'>
			<a id="buyer-seals" class="disablerightclick" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/complaint/add/'.$this->session->userdata['youg_admin']['id'];?>" target="_blank" title="<?php echo $companyname;?> is a verified merchant with YouGotrated and their online transactions are backed by the YouGotrated Buyers Protection Program. Once you have completed your online purchase with <?php echo $companyname;?> you will be emailed your Buyers Protection ID Number should you need to file a Claim with YouGotRated.">
				<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/BuyersProtection_Badge.png'; ?>" class="logo_btm" alt="Yougotrated">
			</a>
			
			<span class="badge_font">
				Your online purchase is protected by the YouGotRated Buyers Protection program.
				Transaction ID: <?php echo $this->session->userdata['youg_admin']['id'];?> 
				To file a complaint -<a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/complaint/add/'.$this->session->userdata['youg_admin']['id'];?>" target="_blank">Click Here</a>
			</span>
			<script type="text/javascript" src="<?php echo base_url(); ?>js/buyer-badge.js"></script>				
		</textarea>
        </td>
     </tr>


     <tr class="odd">
        <td>Sample Image</td>
        <td>			
			<a id="sample-buyer-seals" class="disablerightclick" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/complaint/add/'.$this->session->userdata['youg_admin']['id'];?>" target="_blank" title="<?php echo $companyname;?> is a verified merchant with YouGotrated and their online transactions are backed by the YouGotrated Buyers Protection Program.  Once you have completed your online purchase with <?php echo $companyname;?> you will be emailed your Buyers Protection ID Number should you need to file a Claim with YouGotRated.">
				<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/BuyersProtection_Badge.png'; ?>" class="logo_btm" alt="Yougotrated">
			</a>
			<br>
			<span class="badge_font">
				Your online purchase is protected by the <br> YouGotRated Buyers Protection program.<br>
				Transaction ID: <?php echo $this->session->userdata['youg_admin']['id'];?> <br> 
				To file a complaint -<a href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/complaint/add/'.$this->session->userdata['youg_admin']['id'];?>" target="_blank">Click Here</a>
			</span>
        </td>
      </tr>
    
    </tbody>
    </table>
    
    
    <!--Embed into Websites-->	
    <table class="tab tab-drag">
     <tbody><tr class="top nodrop nodrag"> </tr>       
     
      <tr class="odd">
        <td style="vertical-align: top">
	<h2>SEAL FOR YOUR WEBSITE</h2>
	<p>&nbsp;</p> Embeddable Buyer Protection Code: Embed into Websites Only</td>
        
        <td>
			<p>To embed this code into your website, simply copy this code into your Footer code.</p>
			<textarea cols='90' rows='10'>
				<a id="buyer-seals1"  class="disablerightclick" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/company/'.$companyseo.'/reviews/coupons/complaints';?>" target="_blank" title="<?php echo $companyname;?> is a verified merchant with YouGotrated and their online transactions are backed by the YouGotrated Buyers Protection Program.  Once you have completed your online purchase with <?php echo $companyname;?> you will be emailed your Buyers Protection ID Number should you need to file a Claim with YouGotRated.">
					<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/BuyersProtection_Badge.png'; ?>" class="logo_btmz" alt="Yougotrated">
				</a>	
				<script type="text/javascript" src="<?php echo base_url(); ?>js/buyer-badge.js"></script>			
			</textarea>
        
        </td>
     </tr>


     <tr class="odd">
        <td>Sample Image</td>
        <td>
			<a id="sample-buyer-seals1" class="disablerightclick" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/company/'.$companyseo.'/reviews/coupons/complaints';?>" target="_blank" title="<?php echo $companyname;?> is a verified merchant with YouGotrated and their online transactions are backed by the YouGotrated Buyers Protection Program.  Once you have completed your online purchase with <?php echo $companyname;?> you will be emailed your Buyers Protection ID Number should you need to file a Claim with YouGotRated.">
				<img src="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/images/BuyersProtection_Badge.png'; ?>" class="logo_btm" alt="Yougotrated">
			</a>			
        </td>
      </tr>
    
    </tbody>
    </table>	
   
</div>
</div>


<?php include('leftmenu.php'); ?>
<?php echo $footer; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/buyer.js"></script>
