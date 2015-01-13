<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * reCaptcha File Config
 *
 * File     : recaptcha.php

 */
if($_SERVER['SERVER_NAME']=="www.yougotrated.writerbin.com"){
	
$config['public_key']   = '6LeaYwATAAAAAIIt3d5CbgQKWgu6JDQNH1IsAkWL';
$config['private_key']  = '6LeaYwATAAAAAN1U22SbAfY3b_73FHuA4WsYFMui';

}
else
{
 
$config['public_key']   = '6LeOXQATAAAAAIqhP1H-UvRPuPid0DrI0jSJ86L_';
$config['private_key']  = '6LeOXQATAAAAAFTNVXOPFraRhMyH90JUhI-vkzyX'; 
 
 }


// Set Recaptcha options
// Reference at https://developers.google.com/recaptcha/docs/customization
$config['recaptcha_options']  = array(
    'theme'=>'red', // red/white/blackglass/clean
    'lang' => 'en' // en/nl/fl/de/pt/ru/es/tr
    //  'custom_translations' - Use this to specify custom translations of reCAPTCHA strings.
    //  'custom_theme_widget' - When using custom theming, this is a div element which contains the widget. See the custom theming section for how to use this.
    //  'tabindex' - Sets a tabindex for the reCAPTCHA text box. If other elements in the form use a tabindex, this should be set so that navigation is easier for the user
);

?>
