<?php echo $header;?>

<?php 
if(isset($company_avail)){
	$showdata=$company_avail;
} else { 
	 $showdata=null;
} 

/**
 * Replaces all but the last for digits with x's in the given credit card number
 * @param int|string $cc The credit card number to mask
 * @return string The masked credit card number
 */
function MaskCreditCard($cc){
	// Get the cc Length
	$cc_length = strlen($cc);
	// Replace all characters of credit card except the last four and dashes
	for($i=0; $i<$cc_length-4; $i++){
		if($cc[$i] == '-'){continue;}
		$cc[$i] = 'X';
	}
	// Return the masked Credit Card #
	return $cc;
}
/**
 * Add dashes to a credit card number.
 * @param int|string $cc The credit card number to format with dashes.
 * @return string The credit card with dashes.
 */
function FormatCreditCard($cc)
{
	// Clean out extra data that might be in the cc
	$cc = str_replace(array('-',' '),'',$cc);
	// Get the CC Length
	$cc_length = strlen($cc);
	// Initialize the new credit card to contian the last four digits
	$newCreditCard = substr($cc,-4);
	// Walk backwards through the credit card number and add a dash after every fourth digit
	for($i=$cc_length-5;$i>=0;$i--){
		// If on the fourth character add a dash
		if((($i+1)-$cc_length)%4 == 0){
			$newCreditCard = '-'.$newCreditCard;
		}
		// Add the current character to the new credit card
		$newCreditCard = $cc[$i].$newCreditCard;
	}
	// Return the formatted credit card number
	return $newCreditCard;
}
?>


	
<?php  if($register_data['elitemem'] !="") {?>
	<form action="index.php/solution/upgrades/<?php echo $register_data['elitemem'];?>" id="frmaddcompany" method="post" enctype="multipart/form-data">
	
<?php } else { ?>
	<form action="solution/update" id="frmaddcompany" method="post" enctype="multipart/form-data">
<?php } ?>
<script type="text/javascript" src="/js/formsubmit.js"></script>	
<section class="container">
  <section class="main_contentarea">
<input type = "hidden" value = "<?php echo $register_data['name']; ?>" name = "name">
<input type = "hidden" value = "<?php echo $register_data['elitemem']; ?>" name = "elitemem">
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
<input type = "hidden" value = "<?php echo $register_data['discount-code-type']; ?>" name = "discount-code-type">
<input type = "hidden" value = "<?php echo $register_data['discounted-price']; ?>" name = "discounted-price">
<input type = "hidden" value = "<?php echo $register_data['subscriptionprice']; ?>" name = "subscriptionprice">
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
<input type = "hidden" value = "<?php echo $register_data['cvv']; ?>" name = "cvv">
<input type = "hidden" value = "<?php echo $register_data['expirationdatey']; ?>" name = "expirationdatey">
<?php if(!empty($broker_info)){ ?>
<input type = "hidden" value = "<?php if($broker_info['id']==''){ echo "0"; }else{ echo $broker_info['id']; }?>" name = "brokerid">
<input type = "hidden" value = "<?php if($broker_info['mainbrokerid']==''){ echo "0"; }else{ echo $broker_info['mainbrokerid']; } ?>" name = "mainbrokerid">
<input type = "hidden" value = "<?php if($broker_info['subbrokerid']==''){ echo "0"; }else{ echo $broker_info['subbrokerid']; }?>" name = "subbrokerid">
<input type = "hidden" value = "<?php if($broker_info['marketerid']==''){ echo "0"; }else{ echo $broker_info['marketerid']; }?>" name = "marketerid">
<input type = "hidden" value = "<?php if($broker_info['type']==''){ echo "0"; }else{ echo $broker_info['type'];} ?>" name = "brokertype">
<?php } ?>
	
<div class = "ygr_receipt">
	
	<div class = "receipt_tab_1">
		
		<div class = "receipt_tab_1_1">
			<table>
				<th colspan="2">Company Information</th>
				<tr><td>Company Name</td><td class = "receipt_data"><?php echo $register_data['name']; ?></td></tr>
				<tr><td>Website</td><td class = "receipt_data"><?php echo $register_data['website']; ?></td></tr>
				<tr><td>Category</td><td class = "receipt_data"><?php echo $register_data['categorylist']; ?></td></tr>
				<tr><td>E-Mail</td><td class = "receipt_data"><?php echo $register_data['email']; ?></td></tr>
				<tr><td>Address</td><td class = "receipt_data"><?php echo $register_data['streetaddress1']; ?></td></tr>
				<tr><td>Country</td><td class = "receipt_data"><?php echo $register_data['country1']; ?></td></tr>
				<tr><td>State</td><td class = "receipt_data"><?php echo $register_data['state1']; ?></td></tr>
				<tr><td>City</td><td class = "receipt_data"><?php echo $register_data['city1']; ?></td></tr>
				<tr><td>Zip Code</td><td class = "receipt_data"><?php echo $register_data['zip1']; ?></td></tr>
				<tr><td>Phone</td><td class = "receipt_data"><?php echo $register_data['phone']; ?></td></tr>
				<?php if($register_data['discountcode']!='') { ?>
					<tr><td>Discount Code</td><td class = "receipt_data"><?php echo $register_data['discountcode']; ?></td></tr>
					<tr><td>Discount Type</td><td class = "receipt_data"><?php echo $register_data['discount-code-type']; ?></td></tr>
					<tr><td>Amount Discounted</td><td class = "receipt_data"><?php echo '$'.$register_data['discounted-price']; ?></td></tr>
				<?php } ?>
			</table>

		</div>
		
		<div class = "receipt_tab_1_2">
			<table>
				<th colspan="2">Contact Information</th>
				<tr><td>Contact Name</td><td class = "receipt_data"><?php echo $register_data['cname']; ?></td></tr>
				<tr><td>Contact Phone</td><td class = "receipt_data"><?php echo $register_data['cphone']; ?></td></tr>
				<tr><td>Contact Email</td><td class = "receipt_data"><?php echo $register_data['cemail']; ?></td></tr>
			</table>
		</div>
		
	</div>

	
	<div class = "receipt_tab_2">
		
		<div class = "receipt_tab_2_1">
			<table>
				<th colspan="2">Billing Information</th>
				<tr><td>First Name</td><td class = "receipt_data"><?php echo $register_data['fname']; ?></td></tr>
				<tr><td>Last Name</td><td class = "receipt_data"><?php echo $register_data['lname']; ?></td></tr>
				<tr><td>Category</td><td class = "receipt_data"><?php echo $register_data['categorylist']; ?></td></tr>
				<tr><td>E-Mail</td><td class = "receipt_data"><?php echo $register_data['cemail']; ?></td></tr>
				<tr><td>Address</td><td class = "receipt_data"><?php echo $register_data['streetaddress']; ?></td></tr>
				<tr><td>Country</td><td class = "receipt_data"><?php echo $register_data['country']; ?></td></tr>
				<tr><td>State</td><td class = "receipt_data"><?php echo $register_data['state']; ?></td></tr>
				<tr><td>City</td><td class = "receipt_data"><?php echo $register_data['city']; ?></td></tr>
				<tr><td>Zip Code</td><td class = "receipt_data"><?php echo $register_data['zip']; ?></td></tr>
			</table>
		</div>

		<div class = "receipt_tab_2_2">
			<table>
				<th colspan="2">Credit Card Information</th>
				<tr><td>Card Number</td><td class = "receipt_data"><?php echo FormatCreditCard(MaskCreditCard($register_data['ccnumber'])); ?></td></tr>
				<tr><td>Expiration Date</td><td class = "receipt_data"><?php echo $register_data['expirationdatey'].'/'.$register_data['expirationdatem']; ?></td></tr>
				
<?php if(empty($register_data['discounted-price'])) { ?>
<tr><td>Amount Per Month</td><td class = "receipt_data">$<?php echo $defaultprice=$this->common->get_setting_value(19);?></td></tr>
<?php } else { ?>

<tr><td>Amount Per Month</td><td class = "receipt_data">$<?php echo $register_data['discounted-price'];?></td></tr>
<?php } ?>				
				<tr><td colspan='2'>
					<div id="termscondn">
						<input type="checkbox" id="terms-conditions" />
				I agree to the Terms and Conditions and the recuring monthly membership
					<p id="terms-error" style='display:none;color:#ff0000;'>Please indicate that you accept the Terms and Conditions</p>
				</div>
				</td></tr>
				<tr><td colspan='2' class = "receipt_data"style='padding:0'><input class = "receipt_button"  id="submitorder" type = "submit" value = "Submit Order"></td></tr>
			</table>
		</div>
		
	</div>
	
</div>

  </section>
</section>

</form>
<?php echo $footer;?>
