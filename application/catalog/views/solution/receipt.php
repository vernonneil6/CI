<?php echo $header;?>

<?php print_r($register_data); ?>

<section class="container">
  <section class="main_contentarea">
	
	<div>
		<table>
			<tr><td>Company Name</td><td><?php echo $register_data['name']; ?></td></tr>
			<tr><td>Website</td><td><?php echo $register_data['website']; ?></td></tr>
			<tr><td>Category</td><td><?php echo $register_data['category']; ?></td></tr>
			<tr><td>E-Mail</td><td><?php echo $register_data['email']; ?></td></tr>
			<tr><td>Address</td><td><?php echo $register_data['streetaddress1']; ?></td></tr>
			<tr><td>Country</td><td><?php echo $register_data['country1']; ?></td></tr>
			<tr><td>State</td><td><?php echo $register_data['state1']; ?></td></tr>
			<tr><td>City</td><td><?php echo $register_data['city1']; ?></td></tr>
			<tr><td>Zip Code</td><td><?php echo $register_data['zip1']; ?></td></tr>
			<tr><td>Phone</td><td><?php echo $register_data['phone']; ?></td></tr>
			<?php if($register_data['discountcode']!='') { ?>
				<tr><td>Discount Code</td><td><?php echo $register_data['discountcode']; ?></td></tr>
			<?php } ?>
		</table>

 	</div>

	<div>
		<table>
			<tr><td>Contact Name</td><td><?php echo $register_data['cname']; ?></td></tr>
			<tr><td>Contact Phone</td><td><?php echo $register_data['cphone']; ?></td></tr>
			<tr><td>Contact Email</td><td><?php echo $register_data['cemail']; ?></td></tr>
		</table>
	</div>

	<div>
		<table>
			<tr><td>Company Name</td><td><?php echo $register_data['fname']; ?></td></tr>
			<tr><td>Website</td><td><?php echo $register_data['lname']; ?></td></tr>
			<tr><td>Category</td><td><?php echo $register_data['streetaddress']; ?></td></tr>
			<tr><td>E-Mail</td><td><?php echo $register_data['country']; ?></td></tr>
			<tr><td>Address</td><td><?php echo $register_data['state']; ?></td></tr>
			<tr><td>Country</td><td><?php echo $register_data['city']; ?></td></tr>
			<tr><td>State</td><td><?php echo $register_data['zip']; ?></td></tr>
		</table>
	</div>

	<div>
		<table>
			<tr><td>Card Number</td><td><?php echo $register_data['ccnumber']; ?></td></tr>
			<tr><td>Expiration Date</td><td><?php echo $register_data['expirationdatem'].'/'.$register_data['expirationdatey']; ?></td></tr>
			<tr><td></td><td><input type = "submit" value = "Pay"></td></tr>
		</table>
	</div>


  </section>
</section>

<?php echo $footer;?>
