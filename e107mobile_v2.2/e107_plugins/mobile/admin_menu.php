<?php

/*
+------------------------------------------------------------------------------+
|     e107 Mobile  v2.2 by Martinj
|	November 2010
|	Visit www.martinj.co.uk for help and support
+------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) {
    exit;
}

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = EMP_MENU_1;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_styles']['text'] = EMP_MENU_2;
$var['admin_styles']['link'] = "admin_styles.php";

$var['admin_slinks']['text'] = EMP_MENU_3;
$var['admin_slinks']['link'] = "admin_slinks.php";

$var['admin_linkj']['text'] = EMP_MENU_5;
$var['admin_linkj']['link'] = e_ADMIN."links.php";

$var['admin_about']['text'] = EMP_MENU_4;
$var['admin_about']['link'] = "admin_about.php";

show_admin_menu(EMP_MENU_7, $action, $var);

$caption = "Debug Info";
include(e_ADMIN."ver.php");
$text="e107Mobile: v".$pref['plug_installed']['mobile']."<br/>
	e107 Verion: ".$e107info['e107_version']."<br/>
	PHP Verion: ".phpversion()."<br/>";
	
// SHOW PLUGINS
$knownPlugs=array('mobile','rdonation_tracker','google_translate','forum','newforumposts_main','chatbox_menu','pm','pdf','integrity_check','tagcloud','log');
foreach($pref['plug_installed'] as $plugInst=>$key) {
	if(!in_array($plugInst,$knownPlugs)) {
		$text .=$plugInst." - ".$key."<br/>";
	}
}

$text .="module:".filesize('e_module.php')."<br/>";
$text .="theme:".filesize(e_THEME.'e107mobile/theme.php');
$text .="<br/>END";

$ns->tablerender($caption, $text);

?>