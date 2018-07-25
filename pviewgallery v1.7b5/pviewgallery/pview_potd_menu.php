<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        http://e107.org
|
|        PView Gallery by R.F. Carter
|        ronald.fuchs@hhweb.de
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
// Include plugin language file, check first for site's preferred language
if (file_exists(e_PLUGIN . "pviewgallery/languages/" . e_LANGUAGE . ".php")){
	include_once(e_PLUGIN."pviewgallery/languages/".e_LANGUAGE.".php");
} else {
	include_once(e_PLUGIN . "pviewgallery/languages/German.php");
}
include_once(e_PLUGIN."pviewgallery/templates/menu_template.php");
$Menu = new Menu;

$potd = $Menu -> getMenuPOTD();

if (!$potd) {
	$ns->tablerender(LAN_MENU_28, LAN_MENU_4,'pview');
} else {
	$ns->tablerender(LAN_MENU_28, $potd,'pview');
}

?>