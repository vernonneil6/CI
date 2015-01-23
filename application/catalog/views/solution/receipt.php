<?php echo $header;?>

<section class="container">
  <section class="main_contentarea">
	
<div class = "ygr_receipt">
	
	<div class = "receipt_tab_1">
		
		<div class = "receipt_tab_1_1">
			<table>
				<tr><td>Company Name</td><td class = "receipt_data"><?php echo $register_data['name']; ?></td></tr>
				<tr><td>Website</td><td class = "receipt_data"><?php echo $register_data['website']; ?></td></tr>
				<tr><td>Category</td><td class = "receipt_data"><?php echo $register_data['category']; ?></td></tr>
				<tr><td>E-Mail</td><td class = "receipt_data"><?php echo $register_data['email']; ?></td></tr>
				<tr><td>Address</td><td class = "receipt_data"><?php echo $register_data['streetaddress1']; ?></td></tr>
				<tr><td>Country</td><td class = "receipt_data"><?php echo $register_data['country1']; ?></td></tr>
				<tr><td>State</td><td class = "receipt_data"><?php echo $register_data['state1']; ?></td></tr>
				<tr><td>City</td><td class = "receipt_data"><?php echo $register_data['city1']; ?></td></tr>
				<tr><td>Zip Code</td><td class = "receipt_data"><?php echo $register_data['zip1']; ?></td></tr>
				<tr><td>Phone</td><td class = "receipt_data"><?php echo $register_data['phone']; ?></td></tr>
				<?php if($register_data['discountcode']!='') { ?>
					<tr><td>Discount Code</td><td class = "receipt_data"><?php echo $register_data['discountcode']; ?></td></tr>
				<?php } ?>
			</table>

		</div>
		
		<div class = "receipt_tab_1_1">
			<table>
				<tr><td>Contact Name</td><td class = "receipt_data"><?php echo $register_data['cname']; ?></td></tr>
				<tr><td>Contact Phone</td><td class = "receipt_data"><?php echo $register_data['cphone']; ?></td></tr>
				<tr><td>Contact Email</td><td class = "receipt_data"><?php echo $register_data['cemail']; ?></td></tr>
			</table>
		</div>
		
	</div>

	
	<div class = "receipt_tab_2">
		
		<div class = "receipt_tab_2_2">
			<table>
				<tr><td>Company Name</td><td class = "receipt_data"><?php echo $register_data['fname']; ?></td></tr>
				<tr><td>Website</td><td class = "receipt_data"><?php echo $register_data['lname']; ?></td></tr>
				<tr><td>Category</td><td class = "receipt_data"><?php echo $register_data['streetaddress']; ?></td></tr>
				<tr><td>E-Mail</td><td class = "receipt_data"><?php echo $register_data['country']; ?></td></tr>
				<tr><td>Address</td><td class = "receipt_data"><?php echo $register_data['state']; ?></td></tr>
				<tr><td>Country</td><td class = "receipt_data"><?php echo $register_data['city']; ?></td></tr>
				<tr><td>State</td><td class = "receipt_data"><?php echo $register_data['zip']; ?></td></tr>
			</table>
		</div>

		<div class = "receipt_tab_2_3">
			<table>
				<tr><td>Card Number</td><td class = "receipt_data"><?php echo $register_data['ccnumber']; ?></td></tr>
				<tr><td>Expiration Date</td><td class = "receipt_data"><?php echo $register_data['expirationdatem'].'/'.$register_data['expirationdatey']; ?></td></tr>
				<tr><td></td><td class = "receipt_data"><input type = "submit" value = "Pay"></td></tr>
			</table>
		</div>
		
	</div>
	
</div>

  </section>
</section>

<?php echo $footer;?>
