<?php echo $header;?>

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
</section>

<?php echo $footer;?>
