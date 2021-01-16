<?php
/*
+---------------------------------------------------------------+
|        MyLevel Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "mylevel_menu/languages/" . e_LANGUAGE . ".php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = MYLEVEL_A1;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_levels']['text'] = MYLEVEL_A9;
$var['admin_levels']['link'] = "admin_levels.php";

$var['admin_readme']['text'] = MYLEVEL_A11;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = MYLEVEL_A12;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(MYLEVEL_A2, $action, $var);

?>
