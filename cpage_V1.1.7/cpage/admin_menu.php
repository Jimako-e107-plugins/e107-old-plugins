<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'cpage/languages/' . e_LANGUAGE . '_cpage.php');
if (!defined("e107_INIT"))
{
    exit;
}
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = CPAGE_M02;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_page']['text'] = CPAGE_M03;
$var['admin_page']['link'] = "admin_page.php";

$var['admin_cat']['text'] = CPAGE_M07;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_import']['text'] = CPAGE_M04;
$var['admin_import']['link'] = "admin_import.php";

$var['admin_readme']['text'] = CPAGE_M05;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = CPAGE_M06;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(CPAGE_M01, $action, $var);