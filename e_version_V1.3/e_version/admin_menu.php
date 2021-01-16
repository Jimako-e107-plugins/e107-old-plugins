<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."e_version/languages/".e_LANGUAGE.".php");
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = EVERSION_A21;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_plugin']['text'] = EVERSION_A22;
$var['admin_plugin']['link'] = "admin_plugin.php";

$var['admin_getall']['text'] = EVERSION_A69;
$var['admin_getall']['link'] = "admin_getall.php";

$var['admin_readme']['text'] = EVERSION_A68;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = EVERSION_A23;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(EVERSION_A20, $action, $var);
?>
