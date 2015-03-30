<?php
/*Live Affliate*/
$url = 'http://www.yougotrated.com/affiliates'; //NO TRAILING SLASH 
$access_key = 'c51ce410c124a10e0db5e4b97fc2af39'; 
$access_id = '182be0c5cdcd5072bb1864cdee4d3d6e';
$aff_cookie = 'jamcom';
$emailid = !empty($_GET['email']) ? urldecode($_GET['email']) : '';
$fname = !empty($_GET['fname']) ? preg_replace("![^a-z0-9]+!i", "",urldecode($_GET['fname'])) : '';
$program_id = !empty($_GET['program_id']) ? $_GET['program_id'] : '';
$jrox_amount = !empty($_GET['jrox_amount']) ? $_GET['jrox_amount'] : '';
$jrox_transid = !empty($_GET['jrox_transid']) ? $_GET['jrox_transid'] : '';
$affiliate = !empty($_GET['affiliate']) ? preg_replace("![^a-z0-9]+!i","",urldecode($_GET['affiliate'])) : '';
//$register = file_get_contents('http://yougotrated.writerbin.com/GMI_scripts/jrox_autologin.php?email=rayan1@grossmaninteractive.com&fname=rayanpaul1&program_id=1&type=register');
//$tracking = file_get_contents('http://yougotrated.writerbin.com/GMI_scripts/jrox_autologin.php?affiliate=rayanpaul1&type=set_tracking_cookie');

$sdata = array(
			   'access_key' => $access_key,
			   'access_id' => $access_id,
			   'ip' => $_SERVER['REMOTE_ADDR'],
			   'user_agent' => $_SERVER['HTTP_USER_AGENT'],
			   'email' => $emailid,
			   //'password' => 'testing',
			   //'password' => 'dc724af18fbdd4e59189f5fe768a5f8311527050',
			   'bypass_pwd' => 1,
			   'encrypted' => false,
			   );

$fields = "";
foreach( $sdata as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";
	
$resp = connect_curl($_GET['type'], $fields);

$result = json_decode( $resp);

$jam_cookie = $result->msg;

if(empty($result) || !isset($result)){ 

/*  Registration Method Starts   */
	$sdata = array(
			   'access_key' => $access_key,
			   'access_id' => $access_id,
			   
			   'email' => $emailid,
			   'fname' => $fname,
			   //'affiliate_group' => '2',
			   //'password' => 'dc724af18fbdd4e59189f5fe768a5f8311527050',
			   //'encrypted' => true
			   'program_id' => $program_id,
			   'sponsor' => '', // !empty($_COOKIE[$aff_cookie]) ? $_COOKIE[$aff_cookie] : ''
			   );

	$fields = "";
	foreach( $sdata as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";

	$resp = connect_curl('register', $fields);

	$result = json_decode( $resp);

/*  Registration Method Ends   */

}

/*  Set tracking cookie starts   */

$sdata = array(
		   'access_key' => $access_key,
		   'access_id' => $access_id,
		   'ip' => $_SERVER['REMOTE_ADDR'],
		   'user_agent' => $_SERVER['HTTP_USER_AGENT'],
		   'subdomain' => $affiliate, //affiliate username
		   );

$fields = "";
foreach( $sdata as $key => $value ) $fields .= "$key=" . urlencode( $value ) . "&";
	
$resp = connect_curl('set_tracking_cookie', $fields);

$result = json_decode( $resp);

$jam_cookie = $result->msg;

if(!empty($result->msg) && $result->result == 1){ 
/* Added by Rayan */

	$curl = curl_init();

	curl_setopt_array($curl, array(      
		 CURLOPT_RETURNTRANSFER => 1,      
		 CURLOPT_URL => 'http://www.yougotrated.com/affiliates/sale/amount/'.$jrox_amount.'/trans_id/'.$jrox_transid.'/tracking_code/' . $jam_cookie->value,
		 CURLOPT_USERAGENT => 'Affiliate Software Tracking Request'  ,
	)); 
		 
	$resp = curl_exec($curl);  
	curl_close($curl);

	/* End Here  */
		
	if (setcookie(
				$jam_cookie->name,
				$jam_cookie->value,
				$jam_cookie->expire,
				$jam_cookie->path,
				$jam_cookie->domain,
				0
				))
	{
		echo 'SUCCESS: tracking_cookie_set and affliate added';	
	}
}
/*  Set tracking Cookie Ends   */

function connect_curl($type = '', $fields = '')
{
	global $url;
	
	$ch = curl_init($url . '/automate/' . $type);
	
	curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, '50');

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
	$resp = curl_exec($ch); //execute post and get results
	curl_close ($ch);
	return $resp;		
}
?>
