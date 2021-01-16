<?php
/*
+---------------------------------------------------------------+
|	Google Translate
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "googletranslate_menu/languages/" . e_LANGUAGE . ".php");
if (!defined('e107_INIT'))
{
    exit;
}

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = GTM_LAN_M01;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_readme']['text'] = GTM_LAN_M02;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = GTM_LAN_M03;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(GTM_LAN_P01, $action, $var);

?>