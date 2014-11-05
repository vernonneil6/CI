<footer>
  <div class="inner_main">
    <div class="main_footer">
      <div class="main_footer_block">
        <div class="footer_block">
          <ul>
            <li class="ftitle">SOCIAL MEDIA</li>
            <?php $fb = $this->common->get_semsetting_value(1);?>
            <?php $tw = $this->common->get_semsetting_value(2);?>
            <?php $pi = $this->common->get_semsetting_value(3);?>
            <?php $go = $this->common->get_semsetting_value(4);?>
            <li><a href="<?php echo $fb;?>" title="Facebook"> <img src="<?php echo base_url();?>images/fb_icon.png" alt="Facebook" width="30" height="29"><span> Facebook</span></a></li>
            <li><a href="<?php echo $tw;?>" title="Twitter"> <img src="<?php echo base_url();?>images/twitter_icn.png" alt="Twitter" width="29" height="29"><span> Twitter</span></a></li>
            <li><a href="<?php echo $go;?>" title="Google"> <img src="<?php echo base_url();?>images/google_icn.png" alt="Google" width="30" height="29"><span> Google</span></a></li>
            <li><a href="<?php echo $pi;?>" title="Pinterest"> <img src="<?php echo base_url();?>images/pint_icn.png" alt="Pinterest" width="28" height="27"><span> Pinterest</span></a></li>
          </ul>
        </div>
        <div class="footer_block">
          <ul>
            <li class="ftitle">COMPLAINT REPORTS</li>
            <li>
              <?php if( array_key_exists('youg_user',$this->session->userdata ) )
		{ ?>
              <a href="<?php echo site_url();?>" title="REPORT A COMPLAINT">REPORT A COMPLAINT</a>
              <?php } else { ?>
              <a href="<?php echo site_url();?>" title="REPORT A COMPLAINT">REPORT A COMPLAINT</a>
              <?php } ?>
            </li>
            <li><a href="<?php echo site_url('complaint');?>" title="BROWSE COMPLAINTS">BROWSE COMPLAINTS</a></li>
            <li><a href="<?php echo site_url('businessdirectory');?>" title="BROWSE COMPANIES">BROWSE COMPANIES</a></li>
          </ul>
        </div>
        <div class="footer_block">
          <ul>
            <li class="ftitle">YOUGOTRATED GUIDE</li>
            <li><a href="<?php echo site_url('faq');?>" title="FAQ">FAQ</a></li>
            <li>
              <?php if( array_key_exists('youg_user',$this->session->userdata ) )
		{ ?>
              <a href="<?php echo site_url();?>" title="WRITING A COMPLAINT">WRITING A COMPLAINT</a>
              <?php } else { ?>
              <a href="<?php echo site_url();?>" title="WRITING A COMPLAINT">WRITING A COMPLAINT</a>
              <?php } ?>
            </li>
            <li><a href="<?php echo site_url('overview');?>" title="OVERVIEW">OVERVIEW</a></li>
            <li><a href="<?php echo site_url('submission');?>" title="SUBMISSION">SUBMISSION</a></li>
            <li><a href="<?php echo site_url('additions');?>" title="ADDITIONS">ADDITIONS</a></li>
            <li><a href="<?php echo site_url('policy
');?>" title="ADDITIONS">PRIVACY POLICY</a></li>
<li><a href="<?php echo site_url('sitemap
');?>" title="SITEMAP">SITEMAP</a></li>
            <?php if( array_key_exists('youg_user',$this->session->userdata) ) { ?>
            <li><a href="<?php echo site_url('user');?>" title="DASHBOARD">DASHBOARD</a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="footer_block">
          <ul>
            <li class="ftitle">INFORMATIONAL</li>
            <li><a href="<?php echo site_url('terms');?>" title="TERMS & CONDITIONS">TERMS & CONDITIONS</a></li>
            <li><a href="<?php echo site_url('aboutus');?>" title="ABOUT US">ABOUT US</a></li>
            <li><a href="<?php echo site_url('contactus');?>" title="CONTACT US">CONTACT US</a></li>
          </ul>
        </div>
        <?php if(! array_key_exists('youg_user',$this->session->userdata) ) { ?>
        <div class="footer_block" id="last">
          <ul>
            <li class="ftitle">JOIN</li>
            <li><a href="<?php echo site_url('go/register');?>" title="SIGNUP">SIGNUP</a></li>
            <li><a href="<?php echo site_url('login');?>" title="LOGIN">LOGIN</a></li>
          </ul>
        </div>
        <?php } ?>
      </div>
      <div class="copy_link">All Rights Reserved, Copyright <?php echo date("Y"); ?> © <?php echo $site_name; ?></div>
    </div>
  </div>
</footer>
</body></html>