<?php
/*
+------------------------------------------------------------------------------+
|   EasyGallery - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
if(!defined('e107_INIT')){ exit; }
$eplug_admin = true;
require_once('../../class2.php');
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }
require_once(e_ADMIN.'auth.php');
include_lan(e_PLUGIN.'easygallery/languages/'.e_LANGUAGE.'.php');

// Set the pageid for the menu as global variable (first pageid is set by admin_config.php)
global $pageid;

$action = basename($_SERVER['PHP_SELF'], '.php');

$var['admin_menu_01']['text'] = EG_MENU_01;
$var['admin_menu_01']['link'] = 'admin_config.php';

$var['admin_menu_02']['text'] = EG_MENU_02;
$var['admin_menu_02']['link'] = 'admin_overview.php';

// Put the readme.txt at the end of the list
$var['admin_menu_09']['text'] = EG_MENU_09;
$var['admin_menu_09']['link'] = 'admin_readme.php';

// Show the admin menu with a caption from the language file
$caption = EG_MENU_00;
show_admin_menu($caption, $pageid, $var);

$ns->tablerender(EG_MENU_10, "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nlstart%40webstartinternet%2ecom&item_name=NLSTART%20Plugins&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8'>".EG_MENU_11."</a>");
?>