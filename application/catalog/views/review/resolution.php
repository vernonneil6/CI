<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea">
     <?php if($this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'resolution') { ?>
		  
		  <div class="main_bd_srchwrp reviewmail">
			  <div class="bdsrch_wrp reviewmail_text">
				<h2 class = "reviewmail_carrier">Carrier</h2>
				<div class="bd_srchwrp reviewmail_outline">
				  <input type="text" required="" maxlength="100" name="carrier" class="bdsrch_txtbx reviewmail_textbox">
				</div>
			  </div>
			  <div class="bdsrch_wrp reviewmail_text">
				<h2 class = "reviewmail_trackingno">Tracking Number</h2>
				<div class="bd_srchwrp reviewmail_outline">
				  <input type="text" required="" maxlength="100" name="trackingno" class="bdsrch_txtbx reviewmail_textbox">
				</div>
			  </div>
			  <div class="bdsrch_wrp reviewmail_text">
				<h2 class = "reviewmail_dateshipped">Date Shipped</h2>
				<div class="bd_srchwrp reviewmail_outline">
				  <input type="text" required="" maxlength="100" name="dateshipped" class="bdsrch_txtbx reviewmail_textbox">
				</div>
			  </div>  
			  <div>
				  <input type="submit" name="submit" value = "submit">
			  </div>
        </div>
	<?php } ?>
	</div>
  </section>
</section>
<?php echo $footer; ?>
