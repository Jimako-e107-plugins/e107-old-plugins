<?php

$menutitle  = LAN_MENUTITLE;

$butname[]  = LAN_INDEX;
$butlink[]  = "admin_config.php";
$butid[]    = "index";

$butname[]  = LAN_PREFERENCES;
$butlink[]  = "admin_prefs.php";
$butid[]    = "prefs";

global $pageid;

for($i=0; $i<count($butname); $i++) {

	$var[$butid[$i]]['text'] = $butname[$i];
	$var[$butid[$i]]['link'] = $butlink[$i];

}

show_admin_menu($menutitle, $pageid, $var);

?>
