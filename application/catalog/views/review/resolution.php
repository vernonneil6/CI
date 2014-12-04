<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea">
     <?php if($this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'resolution') { ?>
		  <form action = "/review/resolution/<?php echo $reviewid; ?>" method = "post">
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
			  <div class = "bdsrch_wrp reviewmail_text">
				  <input type="submit" name="submit" value = "submit">
			  </div>
        </div>
        </form>
	<?php } ?>
	<?php if($this->uri->segment(1) == 'review' && $this->uri->segment(2) == 'proof') { ?>
		<form action = "/review/closecase/<?php echo $reviewmail['review_id']; ?>" method = "post">
		  <div class="main_bd_srchwrp reviewmail">
			  <div class="bdsrch_wrp reviewmail_text">
				<h2 class = "reviewmail_carrier">Proof</h2>
				<div class="reviewmail_outline">
					<img src="uploads/proof/<?php echo $reviewmail['proof'];?>" width = "110" height = "110">
				</div>
			  </div>
		  </div>
		  <div class="bdsrch_wrp reviewmail_text" style ="margin: 40px 0 0 310px;">
				<input type="submit" name="submit" value = "Click here to close the case">
		  </div>
		</form>
	<?php } ?>
	</div>
  </section>
</section>
<?php echo $footer; ?>
