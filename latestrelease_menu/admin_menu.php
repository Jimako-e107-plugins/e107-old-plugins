<?php
/*
+---------------------------------------------------------------+
|        Latest Release Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
// **************************************************************************
// *
// *  Latest Release Menu for e107 v7xx
// *
// **************************************************************************
// GET LANG FILE
include_lan(e_PLUGIN . "latestrelease_menu/languages/" . e_LANGUAGE . ".php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = LATESTRELEASE_MENU_LAN_34;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_readme']['text'] = LATESTRELEASE_MENU_LAN_38;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = LATESTRELEASE_MENU_LAN_35;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(LATESTRELEASE_MENU_LAN_36, $action, $var);

