<?php
/*
+---------------------------------------------------------------+
|        Birthday Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "bday_menu/languages/" . e_LANGUAGE . "_birthday_mnu.php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = BDAY_ADMIN_A13;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_readme']['text'] = BDAY_ADMIN_A49;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = BDAY_ADMIN_A48;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(BDAY_ADMIN_A20, $action, $var);
