<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "portfolio/languages/" . e_LANGUAGE . ".php");

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = PORTFOLIO_M1;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_cat']['text'] = PORTFOLIO_M2;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_ordercat']['text'] = PORTFOLIO_M3;
$var['admin_ordercat']['link'] = "admin_ordercat.php";


$var['admin_readme']['text'] = PORTFOLIO_M7;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = PORTFOLIO_M8;
$var['admin_vupdate']['link'] = "admin_vupdate.php";
show_admin_menu(PORTFOLIO_M9, $action, $var);

?>
