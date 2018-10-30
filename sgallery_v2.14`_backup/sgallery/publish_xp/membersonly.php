<?php
require_once('../../../class2.php');
require_once(e_PLUGIN.'sgallery/init.php');

include_lan(SGAL_LAN.'_publishxp.php');
include_lan(SGAL_LAN.'.php'); //LANMNG used only - TO DO - move them into separate lan file

require_once(SGAL_INCPATH.'sgal_publish_class.php');
$sgalpbl = new sgal_publish_class($sgalobj);

// Permissions ------------------------>
if(!USER) {
	require_once(SGAL_PUBLISH.'h.php');
	echo '<div style="float: right;">'.$tp -> parseTemplate('{LANGUAGELINKS}', true).'</div>';
	echo '<div style="clear: both; text-align: center; padding-top: 10px">'.$sgalpbl -> renderLoginForm().'</div>';
	require_once(SGAL_PUBLISH.'f.php');
	exit;
}

header("Location: ".SGAL_PUBLISH_ABS."publish.php");
exit;
?>