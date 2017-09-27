<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = OTD_A02;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_import']['text'] = OTD_A20;
$var['admin_import']['link'] = "admin_import.php";

$var['admin_readme']['text'] = OTD_A54;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = OTD_A55;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(OTD_A01, $action, $var);

?>
