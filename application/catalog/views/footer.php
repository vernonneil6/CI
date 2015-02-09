<?php $fb = $this->common->get_semsetting_value(1);?>
<?php $tw = $this->common->get_semsetting_value(2);?>
<?php $pi = $this->common->get_semsetting_value(3);?>
<?php $go = $this->common->get_semsetting_value(4);?>
<?php $li= $this->common->get_semsetting_value(5);?>
<script type="text/javascript" language="javascript">
function elitelogin()
{        
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

function userlogin()
{  
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
	<?php if(isset($bottomads) && count($bottomads)){ ?>       
	<div class="ad_bottom"><a href="<?php echo $bottomads[0]['url'];?>" title="Adverstiment" target="_blank" rel="nofollow"><img src="<?php if( $bottomads[0]['image'] ) { echo $this->common->get_setting_value('2').$this->config->item('ad_main_upload_path');?><?php echo stripslashes($bottomads[0]['image']); } ?>" alt="Adverstiment" width="940" height="180" class="adimg"/></a> </div>
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
                <?php 
				$footerpart1 = $this->common->get_footerlink_byid(1); 
				if($footerpart1 != '')
				{
				foreach($footerpart1 as $part1) 
				{ 
				?>
					<li><a  target="_blank" href="<?php echo 'footerpage/index/'.$part1['intid'];?>" title="<?php echo $part1['title'];?>"><?php echo $part1['title'];?></a></li>
				<?php 
				}
				}
				?>
              </ul>
            </div>
            
            <div class="footer_block">
              <ul>
                <li class="ftitle">COMPLAINT REPORTS</li>
                <li><a href="<?php echo site_url('complaint/add');?>" title="Report a Complaint">File Complaint</a></li> 
                <li><a href="<?php echo site_url('complaint');?>" title="Browse Complaints">BROWSE COMPLAINTS</a></li>
                <li><a href="<?php echo site_url('businessdirectory');?>" title="Browse Companies">BROWSE COMPANIES</a></li>
                <?php 
				$footerpart2 = $this->common->get_footerlink_byid(2); 
				if($footerpart2 != '')
				{
				foreach($footerpart2 as $part2) 
				{ 
				?>
					<li><a target="_blank" href="<?php echo 'footerpage/index/'.$part2['intid'];?>" title="<?php echo $part2['title'];?>"><?php echo $part2['title'];?></a></li>
				<?php 
				}
				}
				?>
              </ul>

			  <ul class='blockdown'>
                <li class="ftitle">MERCHANT INFORMATION</li>
                <li><a href="<?php echo site_url('solution');?>" title="Business Solution">BUSINESS SOLUTIONS</a></li>
                <li><a href="<?php echo site_url('review');?>" title="Reviews">reviews</a></li>
                <li><a href="<?php echo site_url('pressrelease');?>" title="Press Releases">press releases</a></li>
                <?php 
				$url = str_replace( 'http://', 'https://',site_url('solution/claimbusiness'));
				?>
                <li><a href="<?php echo site_url('solution/claimbusiness'); ?>" title="Merchant Signup">merchant sign up</a></li>
                <?php 
				$footerpart3 = $this->common->get_footerlink_byid(3); 
				if($footerpart3 != '')
				{
				foreach($footerpart3 as $part3) 
				{ 
				?>
					<li><a target="_blank" href="<?php echo 'footerpage/index/'.$part3['intid'];?>" title="<?php echo $part3['title'];?>"><?php echo $part3['title'];?></a></li>
				<?php 
				}
				}
				?>
              </ul>
            </div>
          
			<div class="footerblock">	
			  <ul>
				<li class="ftitle">JOIN THE CONVERSATION</li>
				<li class="twitter"><a href="<?php echo $tw;?>" title="Twitter"><img src="../images/img/socialicon/twitter.jpg" /></a></li>
				<li class="facebook"><a href="<?php echo $fb;?>" title="Facebook"><img src="../images/img/socialicon/facebook.jpg" /></a></li>
				<li class="google"><a href="<?php echo $go;?>" title="Google"></a><img src="../images/img/socialicon/googleplus.jpg" /></a></li>
				<li class="pinterest"><a href="<?php echo $pi;?>" title="Pinterest"><img src="../images/img/socialicon/pinterest.jpg" /></a></li>
				<li class="linkedin"><a href="<?php echo $li;?>" title="linkedin"><img src="../images/img/socialicon/LinkedIn_icon.jpg" /></a></li>
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
		<div class="footerbottomlink">
			<span>© Copyright <?php echo date("Y");?>  <?php echo $site_name;?></span>
			<span>All Right Reserved.</span>
			<span>
				<?php 
				
				$footerpart4 = $this->common->get_footerlink_byid(4); 
				if($footerpart4 != '')
				{
				foreach($footerpart4 as $part4) 
				{ 
				?>
					<a target="_blank" href="<?php echo 'footerpage/index/'.$part4['intid'];?>" title="<?php echo $part4['title'];?>"><?php echo $part4['title'];?></a>
				<?php 
				}
				}
				?>
		    </span>
		</div>
	</div>   
  </div>
</div>
</footer>
<script type="text/javascript" src="js/use.js"></script>
</body>
</html>
