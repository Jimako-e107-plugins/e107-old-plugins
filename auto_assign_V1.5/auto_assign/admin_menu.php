<?php
/*
+---------------------------------------------------------------+
|	Auto Assign Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'auto_assign/languages/admin/' . e_LANGUAGE . '.php');

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_config']['text'] = AUTOASSIGN_A11;
$var['admin_config']['link'] = 'admin_config.php';

$var['admin_readme']['text'] = AUTOASSIGN_A12;
$var['admin_readme']['link'] = 'admin_readme.php';

$var['admin_vupdate']['text'] = AUTOASSIGN_A10;
$var['admin_vupdate']['link'] = 'admin_vupdate.php';

show_admin_menu(AUTOASSIGN_A09, $action, $var);

?>