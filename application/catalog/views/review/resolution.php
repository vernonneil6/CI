<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea">
     <?php if($this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'resolution') { ?>
		  
		  <div class="main_bd_srchwrp">
			  <div class="bdsrch_wrp">
				<h2>Carrier</h2>
				<div class="bd_srchwrp">
				  <input type="text" required="" maxlength="100" name="carrier" class="bdsrch_txtbx">
				</div>
			  </div>
			  <div class="bdsrch_wrp">
				<h2>Tracking Number</h2>
				<div class="bd_srchwrp">
				  <input type="text" required="" maxlength="100" name="trackingno" class="bdsrch_txtbx">
				</div>
			  </div>
			  <div class="bdsrch_wrp">
				<h2>Date Shipped</h2>
				<div class="bd_srchwrp">
				  <input type="text" required="" maxlength="100" name="dateshipped" class="bdsrch_txtbx">
				</div>
			  </div>
			  <div class="bdsrch_wrp">
				<div class="bd_srchwrp">
				  <input type="submit" value="" name="submit" value = "submit">
				</div>
			  </div>
        </div>
	<?php } ?>
	</div>
  </section>
</section>
<?php echo $footer; ?>
