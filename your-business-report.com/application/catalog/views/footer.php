<footer>
  <div class="inner_main">
    <div class="main_footer">
	
      <div class="main_footer_block">
	<div>
		<p class = "footer_text">View Press Releases</p>
	</div>
        <div class="footer_block">
          <ul>
            <?php $fb = $this->common->get_semsetting_value(1);?>
            <?php $tw = $this->common->get_semsetting_value(2);?>
            <?php $pi = $this->common->get_semsetting_value(3);?>
	    <?php $go = $this->common->get_semsetting_value(4);?>
            
            <li>
			<span><a href="#<?php /* echo $fb; */?>" title="Facebook"> <img src="<?php echo base_url();?>images/fb_icon.png"><span> Facebook</span></a></span>
			<span class = "footer_social1"><a href="#<?php/* echo $go; */?>" title="Google"> <img src="<?php echo base_url();?>images/google_icn.png"><span> Google</span></a></span>
	    </li>
            <li>
            		<span><a href="#<?php/* echo $tw; */?>" title="Twitter"> <img src="<?php echo base_url();?>images/twitter_icn.png"><span> Twitter</span></a></span>
			<span class = "footer_social2"><a href="#<?php/* echo $pi; */?>" title="Pinterest"> <img src="<?php echo base_url();?>images/pint_icn.png"><span> Pinterest</span></a></span>
	   </li>
          </ul>
        </div>
      </div>
      <div class="copy_link">All Rights Reserved, Copyright <?php echo date("Y"); ?> © <?php echo $site_name; ?></div>
    </div>
  </div>
</footer>
</body>
</html>