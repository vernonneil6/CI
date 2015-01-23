<?php echo $header;?>

<?php 
if(isset($company_avail)){
	$showdata=$company_avail;
} else { 
	 $showdata=null;
} 
?>
		
<?php  if(isset($_GET['elitemem']) && $_GET['elitemem'] !="") {?>
	<form action="index.php/solution/upgrades/<?php echo $showdata['id'];?>" id="frmaddcompany" method="post" enctype="multipart/form-data">
	
<?php } else { ?>
	<form action="solution/update" id="frmaddcompany" method="post" enctype="multipart/form-data">
<?php } ?>
	
<section class="container">
  <section class="main_contentarea">

<input type = "hidden" value = "<?php echo $register_data['name']; ?>" name = "name">
<input type = "hidden" value = "<?php echo $register_data['website']; ?>" name = "website">
<input type = "hidden" value = "<?php echo $register_data['category']; ?>" name = "category">
<input type = "hidden" value = "<?php echo $register_data['email']; ?>" name = "email">
<input type = "hidden" value = "<?php echo $register_data['streetaddress1']; ?>" name = "streetaddress1">
<input type = "hidden" value = "<?php echo $register_data['country1']; ?>" name = "country1">
<input type = "hidden" value = "<?php echo $register_data['state1']; ?>" name = "state1">
<input type = "hidden" value = "<?php echo $register_data['city1']; ?>" name = "city1">
<input type = "hidden" value = "<?php echo $register_data['zip1']; ?>" name = "zip1">
<input type = "hidden" value = "<?php echo $register_data['phone']; ?>" name = "phone">
<input type = "hidden" value = "<?php echo $register_data['discountcode']; ?>" name = "discountcode">
<input type = "hidden" value = "<?php echo $register_data['cname']; ?>" name = "cname">
<input type = "hidden" value = "<?php echo $register_data['cphone']; ?>" name = "cphone">
<input type = "hidden" value = "<?php echo $register_data['cemail']; ?>" name = "cemail">
<input type = "hidden" value = "<?php echo $register_data['fname']; ?>" name = "fname">
<input type = "hidden" value = "<?php echo $register_data['lname']; ?>" name = "lname">
<input type = "hidden" value = "<?php echo $register_data['streetaddress']; ?>" name = "streetaddress">
<input type = "hidden" value = "<?php echo $register_data['country']; ?>" name = "country">
<input type = "hidden" value = "<?php echo $register_data['state']; ?>" name = "state">
<input type = "hidden" value = "<?php echo $register_data['city']; ?>" name = "city">
<input type = "hidden" value = "<?php echo $register_data['zip']; ?>" name = "zip">
<input type = "hidden" value = "<?php echo $register_data['ccnumber']; ?>" name = "ccnumber">
<input type = "hidden" value = "<?php echo $register_data['expirationdatem']; ?>" name = "expirationdatem">
<input type = "hidden" value = "<?php echo $register_data['expirationdatey']; ?>" name = "expirationdatey">
	
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
		
		<div class = "receipt_tab_1_2">
			<table>
				<tr><td>Contact Name</td><td class = "receipt_data"><?php echo $register_data['cname']; ?></td></tr>
				<tr><td>Contact Phone</td><td class = "receipt_data"><?php echo $register_data['cphone']; ?></td></tr>
				<tr><td>Contact Email</td><td class = "receipt_data"><?php echo $register_data['cemail']; ?></td></tr>
			</table>
		</div>
		
	</div>

	
	<div class = "receipt_tab_2">
		
		<div class = "receipt_tab_2_1">
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

		<div class = "receipt_tab_2_2">
			<table>
				<tr><td>Card Number</td><td class = "receipt_data"><?php echo $register_data['ccnumber']; ?></td></tr>
				<tr><td>Expiration Date</td><td class = "receipt_data"><?php echo $register_data['expirationdatem'].'/'.$register_data['expirationdatey']; ?></td></tr>
				<tr><td>Amount Per Month</td><td class = "receipt_data">$299</td></tr>
				<tr><td></td><td class = "receipt_data"><input class = "receipt_button" type = "submit" value = "Pay"></td></tr>
			</table>
		</div>
		
	</div>
	
</div>

  </section>
</section>

</form>
<?php echo $footer;?>
