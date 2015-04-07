<?php echo $header;?>
<?php
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
<!--Jrox affliate integration code-->
<?php
if(!empty($_COOKIE['jamcom']) && !empty($subscription['auth_transreponse_key'])){
	$getdata = file_get_contents('http://www.yougotrated.com/affiliates/sale/amount/' . trim($subscription['amount']) . '/trans_id/' . trim($subscription['auth_transreponse_key']) . '/tracking_code/' . $_COOKIE['jamcom']);
	$update_jamcode = $this->complaints->jamcodeupdate($company['id'],$_COOKIE['jamcom']);
}
?>
<section class="container">
<div class = "success_receipt">	
<h2>Your Elite Membership purchase was successful!</h2> 

<table>
<tr>
	<td>
		<label>Transaction ID</label>
	</td>
	<td>
	:
	</td>
	<td>
		<?php echo $company['id']; ?>
	</td>
</tr>
<tr>
	<td>
		<label>Your username to log in is</label>
	</td>
	<td>
	:
	</td>
	<td>
		<?php echo $company['contactemail']; ?>
	</td>
</tr>
<tr>
	<td>
		<label>Password</label>
	</td>
	<td>
	:
	</td>
	<td>
		<?php echo $company['password']; ?>
	</td>
</tr>
<tr>
	<td>
		<label>Elite Member Login URL</label>
	</td>
	<td>
	:
	</td>
	<td>
		<a target = "_blank" href="<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/businessadmin'; ?>"><?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/businessadmin'; ?></a>
	</td>
</tr>
</table>

<h4>Note you will receive an email with this information for reference.</h4>

<h4>Thank you for Signing-up with YouGotRated!</h4>
</div>



<div class = "ygr_receipt">
	
	<div class = "receipt_tab_1">
		
		<div class = "receipt_tab_1_1">
			<table>
				<th colspan="2">Company Information</th>
				<tr><td>Company Name</td><td class = "receipt_data"><?php echo $company['company']; ?></td></tr>
				<tr><td>Website</td><td class = "receipt_data"><?php echo $company['siteurl']; ?></td></tr>
				<tr><td>Category</td><td class = "receipt_data"><?php $cat = $this->complaints->get_categories_byid($company['categoryid']); echo $cat[0]['categoryname']; ?></td></tr>
				<tr><td>E-Mail</td><td class = "receipt_data"><?php echo $company['email']; ?></td></tr>
				<tr><td>Address</td><td class = "receipt_data"><?php echo $company['companystreet']; ?></td></tr>
				<tr><td>Country</td><td class = "receipt_data"><?php $country = $this->complaints->get_country_byidss($company['companycountry']); if($country){echo $country['name']; } else { echo $company['companycountry'];}  ?></td></tr>
				<tr><td>State</td><td class = "receipt_data"><?php echo $company['companystate']; ?></td></tr>
				<tr><td>City</td><td class = "receipt_data"><?php echo $company['companycity']; ?></td></tr>
				<tr><td>Zip Code</td><td class = "receipt_data"><?php echo $company['companyzip']; ?></td></tr>
				<tr><td>Phone</td><td class = "receipt_data"><?php echo $company['phone']; ?></td></tr>
				<?php if($subscription['discountcode']!='') { ?>
					<tr><td>Discount Code</td><td class = "receipt_data"><?php echo $subscription['discountcode']; ?></td></tr>
					<tr><td>Discount Type</td><td class = "receipt_data"><?php echo $subscription['discountcodetype']; ?></td></tr>
					<tr><td>Amount Discounted</td><td class = "receipt_data"><?php echo '$'.$subscription['discountprice']; ?></td></tr>
				<?php } ?>
			</table>

		</div>
		
		<div class = "receipt_tab_1_2">
			<table>
				<th colspan="2">Contact Information</th>
				<tr><td>Contact Name</td><td class = "receipt_data"><?php echo $company['contactname']; ?></td></tr>
				<tr><td>Contact Phone</td><td class = "receipt_data"><?php echo $company['contactphonenumber']; ?></td></tr>
				<tr><td>Contact Email</td><td class = "receipt_data"><?php echo $company['contactemail']; ?></td></tr>
				<tr><td>Title / Position</td><td class = "receipt_data"><?php echo $company['title']; ?></td></tr>
			</table>
		</div>
		
	</div>

	
	<div class = "receipt_tab_2">
		
		<div class = "receipt_tab_2_1">
			<table>
				<th colspan="2">Billing Information</th>
				<tr><td>First Name</td><td class = "receipt_data"><?php echo $subscription['firstname']; ?></td></tr>
				<tr><td>Last Name</td><td class = "receipt_data"><?php echo $subscription['lastname']; ?></td></tr>
				<tr><td>Category</td><td class = "receipt_data"><?php $cat = $this->complaints->get_categories_byid($company['categoryid']); echo $cat[0]['categoryname']; ?></td></tr>
				<tr><td>E-Mail</td><td class = "receipt_data"><?php echo $company['contactemail']; ?></td></tr>
				<tr><td>Address</td><td class = "receipt_data"><?php echo $company['streetaddress']; ?></td></tr>
				<tr><td>Country</td><td class = "receipt_data"><?php $country = $this->complaints->get_country_byidss($company['country']); if($country){echo $country['name']; } else { echo $company['country'];} ?></td></tr>
				<tr><td>State</td><td class = "receipt_data"><?php echo $company['state']; ?></td></tr>
				<tr><td>City</td><td class = "receipt_data"><?php echo $company['city']; ?></td></tr>
				<tr><td>Zip Code</td><td class = "receipt_data"><?php echo $company['zip']; ?></td></tr>
			</table>
		</div>

		<div class = "receipt_tab_2_2">
			<table>
				<th colspan="2">Credit Card Information</th>
				<tr><td>Card Number</td><td class = "receipt_data"><?php echo FormatCreditCard(MaskCreditCard($subscription['ccnumber'])); ?></td></tr>
				<tr><td>Expiration Date</td><td class = "receipt_data"><?php echo $subscription['ccexpiredate']; ?></td></tr>
				
				<?php if(empty($subscription['discountprice'])) { ?>
				<tr><td>Amount Per Month</td><td class = "receipt_data">$<?php echo $defaultprice=$this->common->get_setting_value(19);?></td></tr>
				<?php } else { ?>

				<tr><td>Amount Per Month</td><td class = "receipt_data">$<?php echo $subscription['discountprice'];?></td></tr>
				<?php } ?>			
					
			</table>
		</div>
		
	</div>
	
</div>


</section>

<script> 
	$(document).ready(function(){
		eraseCookie('affiliateId');
	});
</script>

<?php echo $footer;?>
