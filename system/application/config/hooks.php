<?php

// switch from or to https if necessary
$hook['post_controller_constructor'][] = array(
	'class' => '',
	'function' => 'trigger_https',
	'filename' => 'https.php',
	'filepath' => 'hooks'
	);

?>
