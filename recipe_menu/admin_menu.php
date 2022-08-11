<?php
/*
+---------------------------------------------------------------+
|        Recipe Menu v2.00 - by Barry
|
|        v2.00 modifications foodisfunagain.com allergy support
|
|        This module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }
if(e_LANGUAGE !="English" && file_exists(e_PLUGIN."recipe_menu/languages/admin/".e_LANGUAGE.".php"))
{
	include_once(e_PLUGIN."recipe_menu/languages/admin/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."recipe_menu/languages/admin/English.php");
}
if(e_LANGUAGE !="English" && file_exists(e_PLUGIN."recipe_menu/languages/eversion/".e_LANGUAGE.".php"))
{
	include_once(e_PLUGIN."recipe_menu/languages/eversion/".e_LANGUAGE.".php");
}
else
{
	include_once(e_PLUGIN."recipe_menu/languages/eversion/English.php");
}
$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_config']['text'] = RCPEMENU_A1;
$var['admin_config']['link'] = "admin_config.php";

$var['admin_cat']['text'] = RCPEMENU_A3;
$var['admin_cat']['link'] = "admin_cat.php";

$var['admin_recipe']['text'] = RCPEMENU_A49;
$var['admin_recipe']['link'] = "admin_recipe.php";

$var['admin_submit']['text'] = RCPEMENU_A4;
$var['admin_submit']['link'] = "admin_submit.php";

$var['admin_imag']['text'] = RCPEMENU_A100;
$var['admin_imag']['link'] = "admin_imag.php";

$var['admin_vupdate']['text'] = EVERSION_U5;
$var['admin_vupdate']['link'] = "admin_vupdate.php";

show_admin_menu(RCPEMENU_A89, $action, $var);

?>
