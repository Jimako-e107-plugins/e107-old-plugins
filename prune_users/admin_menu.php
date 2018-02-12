<?php
/*
+---------------------------------------------------------------+
|        Prune Inactive Users for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . "prune_users/languages/admin/" . e_LANGUAGE . ".php");
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = PRUNE_A21;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_prune']['text'] = PRUNE_A20;
$var['admin_prune']['link'] = "admin_prune.php";

$var['admin_readme']['text'] = PRUNE_A50;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = PRUNE_A46;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(PRUNE_A20, $action, $var);
?>
