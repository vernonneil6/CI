<?php $fb = $this->common->get_semsetting_value(1);?>
<?php $tw = $this->common->get_semsetting_value(2);?>
<?php $pi = $this->common->get_semsetting_value(3);?>
<?php $go = $this->common->get_semsetting_value(4);?>
<script type="text/javascript" language="javascript">
                function elitelogin(){        
                          if( $("#user_name").val()=='' )
						  {
							 $("#user_name").val('').focus();
							 return false;
						  }
						  if( $("#user_pass").val()=='' )
						  {
							 $("#user_pass").val('').focus();
							 return false;
						  }
                            
                        $("#elitelogin").submit();
                        
				}
				
				function userlogin(){  
				
                          if( $("#loginemail").val()=='' )
						  {
							 $("#loginemail").val('').focus();
							 return false;
						  }
						  if( $("#loginpassword").val()=='' )
						  {
							 $("#loginpassword").val('').focus();
							 return false;
						  }
                            
                       	 $("#userflogin").submit();
                        
				}
				
            </script>
            <div align="center">
            <?php if(isset($bottomads)){ ?>
            <?php if(count($bottomads)){ ?>
      <div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="Adverstiment" target="_blank" rel="nofollow"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="Adverstiment" width="940" height="180" class="adimg"/></a> </div>
      <?php } ?>
      <?php } ?>
            </div>
<footer>
  <div class="ft_cat_wrp">
    <div class="container">
      <div class="innr_wrap">
        <div class="main_footer">
          <div class="main_footer_block">
            <div class="footer_block" id="first">
              <ul>
                <li class="ftitle">YOU GOT RATED GUIDE</li>
                <li><a href="<?php echo site_url('faq');?>" title="Faq">FAQ</a></li>
                <li><a href="<?php echo site_url('complaint/add');?>" title="Writting a Complaint">WRITING A COMPLAINT</a></li>
                <li><a href="<?php echo site_url('overview');?>" title="Overview">OVERVIEW</a></li>
                <?php /*?><li><a href="<?php echo site_url('submission');?>" title="Submission">SUBMISSION</a></li><?php */?>
                <li><a href="<?php echo site_url('additions');?>" title="Additions">ADDITIONS</a></li>
                <li><a href="<?php echo site_url('policy');?>" title="Privacy Policy">PRIVACY POLICY</a></li>
                <li><a href="<?php echo site_url('sitemap');?>" title="Site Map">SITE MAP</a></li>
              </ul>
            </div>
            <div class="footer_block">
              <ul>
                <li class="ftitle">COMPLAINT REPORTS</li>
                <li><a href="<?php echo site_url('complaint/add');?>" title="Report a Complaint">REPORT A COMPLAINT</a></li>
                <li><a href="<?php echo site_url('complaint');?>" title="Browse Complaints">BROWSE COMPLAINTS</a></li>
                <li><a href="<?php echo site_url('businessdirectory');?>" title="Browse Companies">BROWSE COMPANIES</a></li>
              </ul>

		<ul class='blockdown'>
                <li class="ftitle">MERCHANT INFORMATION</li>
                <li><a href="<?php echo site_url('solution');?>" title="Business Solution">BUSINESS SOLUTIONS</a></li>
                <li><a href="<?php echo site_url('review');?>" title="Reviews">reviews</a></li>
                <!--<li><a href="#" title="Seo">seo</a></li>-->
                <li><a href="<?php echo site_url('pressrelease');?>" title="Press Releases">press releases</a></li>
                <?php /*?><li><a href="#" title="Total Protection">total protection</a></li>
                <li><a href="#" title="Verified merchant Seal">verified merchant seal</a></li>
                <li><a href="#" title="Questions & Answers">questions & answers</a></li><?php */?>
                <li><a href="<?php echo site_url('solution/claimbusiness');?>" title="Merchant Signup">merchant sign up</a></li>
              </ul>
            </div>
          
	    <div class="footerblock">
	
              <ul>
		<li class="ftitle">JOIN THE CONVERSATION</li>
		<li class="twitter"><a href="<?php echo $tw;?>" title="Twitter"><img src="../images/img/socialicon/twitter.jpg" /></a></li>
		 <li class="facebook"><a href="<?php echo $fb;?>" title="Facebook"><img src="../images/img/socialicon/facebook.jpg" /></a></li>
        	 <li class="google"><a href="<?php echo $go;?>" title="Google"></a><img src="../images/img/socialicon/googleplus.jpg" /></li>
        	 <li class="pinterest"><a href="<?php echo $pi;?>" title="Pinterest"><img src="../images/img/socialicon/pinterest.jpg" /></a></li>
     	   </ul>
		</div>
            <div class="footer_block">
              <ul>
                <?php if($this->uri->segment(1)!='login'){?>
               <?php if( !array_key_exists('youg_user',$this->session->userdata) ) { ?>
                <li class="ftitle">User LOGIN</li>
                <li>
                  <div class="user_login">
                  <form action="login" id="userflogin" name="" method="post">
                    <input type="email" class="usr_txtbox" placeholder="Username" name="loginemail" id="loginemail" required>
                    <input type="password" class="usr_txtbox" placeholder="Password" name="loginpassword" id="loginpassword" required>
                    <span><button type="button" title="Login" onclick="userlogin();">login</button></span> 
                    </form>
                    </div>
                </li>
                <?php } } ?>
                <li class="ftitle">MERCHANT LOGIN</li>
                <li>
                  <form action="<?php echo base_url();?>businessadmin/adminlogin" id="elitelogin" method="post">
                  <div class="user_login">
                    <input type="text" class="usr_txtbox" placeholder="Username" name="user_name" id="user_name" required>
                    <input type="password" class="usr_txtbox" placeholder="Password" name="user_pass" id="user_pass" required>
                    <span><button title="Login" onclick="elitelogin();" type="button">login</button></span> </div>
                    </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
	
     
   <div class="footerbottomlink"><span>© Copyright <?php echo date("Y");?>  <?php echo $site_name;?></span><span>All Right Reserved.</span><span><a href="aboutus" title="about-us">about <?php echo $site_name;?></a> </span> <a href="terms" title="Term and Conditons">terms and conditions</a></div>
 </div>   
 </div>
  </div>
  <!--<div class="ft_social_wrp">
    <div class="container">
      <div class="innr_wrap">
        <ul>
          <li class="facebook"><a href="<?php echo $fb;?>" title="Facebook"></a></li>
          <li class="google"><a href="<?php echo $go;?>" title="Google"></a></li>
          <li class="linkedin"><a href="<?php echo $pi;?>" title="Pinterest"><img src="images/pinterest.png" /></a></li>
          <li class="twitter"><a href="<?php echo $tw;?>" title="Twitter"></a></li>
        </ul>
        <div class="copy_link"><a href="contactus" title="Contact us">CONTACT US</a> • <a href="aboutus" title="About <?php echo strtoupper($site_name);?>">ABOUT <?php echo strtoupper($site_name);?></a> • <span> ALL RIGHTS RESERVED</span> • <span>COPYRIGHT <?php echo date("Y");?> © <?php echo strtoupper($site_name);?></span> • <a href="terms" title="Term and Conditons"> TERMS AND CONDITIONS</a></div>
      </div>
    </div>
  </div>-->
</footer>
<script type="text/javascript" src="js/use.js"></script>
<style>
.user_login button {
 background: url("../images/img/textbg.jpg") no-repeat scroll -2px -6px rgba(0, 0, 0, 0);
    border: medium none;
    color: white;
    cursor: pointer;
    font-family: nimbus-sans;
    font-size: 14px;
    font-style: normal;
    height: 20px;
   margin: 10px 0 20px;
    padding: 0 6px;
    text-align: left;
    text-transform: uppercase;
    width: 204px;
}
</style>
</body>
</html>
