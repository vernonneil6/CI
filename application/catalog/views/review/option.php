<style>
.removal_request
{
	font-size: 13px;
    font-weight: bold;
    padding: 0 18%;
    list-style: none;
}
.buyer_text
{
	font-size: 17px;
}
.buyer_space
{
	margin : 25px 0 0;
}
.buyer_form
{
	padding: 0 18%;
}
.buyer_bottom
{
	margin: 25px 0 10px;
}
.buyer_submit
{
	margin:25px 0 0;
}
.buyer_submit img
{
	height: 50px;
    width: 130px;
}
.sbtbtn
{
	background: url("../../../images/submit.jpg") repeat scroll 0 0 / cover rgba(0, 0, 0, 0);
    border: medium none;
    height: 48px;
    padding: 0;
    width: 140px;
}
</style>
<?php echo $header; ?>
<section class="content-wrap" style="margin-right:0">
  <section class="inner_main">
    <div class="main_contentarea">
    
	<label class = "buyer_form">Dear <?php echo $name; ?>:</label>
	<ul class="removal_request">	
		<li class = "buyer_space">By choosing one of the options below, you agree that once the Merchant provides us with proof of </li>
		<li>compliance, your review will be permanently deleted from YouGotRated. </li>

		<li class = "buyer_text buyer_space">Please understand that YouGotRated cannot force your merchant to comply, but </li>
		<li class = "buyer_text">since they are interested in getting the review removed, your chances for a </li>
		<li class = "buyer_text">resolution are very likely.</li>
		
		<li class = "buyer_space">The following are the options that will be emailed to the merchant on your behalf. </li>
		<li>Your merchant will have 5 business days to respond to the email. If for any reason, they choose </li>
		<li>not to respond, the review will be permanently posted on the site and this case will be closed.</li>

		<li>If the merchant responds within 5 business days, you will receive an email with their instructions </li>
		<li>so you to complete the process to reach a positive resolution. </li>
	</ul>

	<div class = "buyer_form">
		<form action="<?php echo base_url(); ?>review/reviewmail_insert/<?php echo $reviewid; ?>" method="post">
			<div class = "buyer_bottom"> What Resolution do you expect from the Merchant: </div>
			<?php 
				$data = array(
				'1' => 'Ship the Item and/or Provide Proof of Shipping',
				'2' => 'Would like a Full Refund',
				'3' => 'Would like a Replacement item',
				'4' => 'Would like the missing items to be shipped immediately',
				'5' => 'Would like a Partial Refund and/or Gift Card in compensation for the service received'
				);
			?>
			<?php echo form_dropdown('buyeroption', $data, 'Ship the Item and/or Provide Proof of Shipping'); ?>

			<div class = "buyer_bottom"> Send a message: </div>
			<?php
			$textarea_data = array(
				'name' => 'buyertextarea',
				'rows' => 8,
				'cols' => 18
				);
			?>
			<?php echo form_textarea('buyer_textarea'); ?>
			<div class = "buyer_submit">
				<input type="submit" class = "sbtbtn" value = "" name = "submit">
			</div>
		<?php echo form_close();?>
	</div>
	
	</div>
  </section>
</section>
<?php echo $footer; ?>

