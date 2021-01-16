<?php
/*
+---------------------------------------------------------------+
|	Timed Userclass Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN . "timed_userclass/languages/admin/" . e_LANGUAGE . ".php");


$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = TCLASS_A13;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_users']['text'] = TCLASS_A28;
$var['admin_users']['link'] = "admin_users.php";

#$var['admin_promote']['text'] = TCLASS_A15;
#$var['admin_promote']['link'] = "admin_promote.php";

$var['admin_readme']['text'] = TCLASS_A36;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = TCLASS_A10;
$var['admin_vupdate']['link'] = "admin_vupdate.php";


show_admin_menu(TCLASS_A1, $action, $var);
?>
