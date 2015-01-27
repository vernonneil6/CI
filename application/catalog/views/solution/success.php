<?php echo $header;?>

<h3>Your Elite Membership purchase was successful!</h3>

<table>
<tr>
	<td>
		<label>Transaction ID</label>
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
		<?php echo $company['email']; ?>
	</td>
</tr>
<tr>
	<td>
		<label>Password</label>
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
		<?php echo 'http'.(empty($_SERVER['HTTPS'])?'':'s').'://'.$_SERVER['SERVER_NAME'].'/businessadmin'; ?>
	</td>
</tr>
</table>

<h5>Note you will receive an email with this information for reference.</h5>

<h5>Thank you for working with YouGotRated!</h5>

<?php echo $footer;?>
