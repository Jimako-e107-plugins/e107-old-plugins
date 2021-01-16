<?php
/*
+---------------------------------------------------------------+
|       Delete Me for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if(e_LANGUAGE != "English" && file_exists(e_PLUGIN."deleteme/languages/admin/".e_LANGUAGE.".php"))
{
	include_once(e_PLUGIN."deleteme/languages/admin/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."deleteme/languages/admin/English.php");
}

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = DELETEME_A5;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_viewhist']['text'] = DELETEME_A6;
$var['admin_viewhist']['link'] = "admin_viewhist.php";

$var['admin_readme']['text'] = DELETEME_A27;
$var['admin_readme']['link'] = "admin_readme.php";

$var['admin_vupdate']['text'] = DELETEME_A28;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(DELETEME_A2, $action, $var);


?>
