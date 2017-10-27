<?php
/*
+------------------------------------------------------------------------------+
| Locator - a plugin by nlstart
|
|	Plugin Support Site: e107.webstartinternet.com
|
|	For the e107 website system visit http://e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+------------------------------------------------------------------------------+
*/
// Ensure this program is loaded in admin theme before calling class2
$eplug_admin = true;

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once("../../class2.php");

// Include auth.php rather than header.php ensures an admin user is logged in
require_once(e_ADMIN."auth.php");

// Check to see if the current user has admin permissions for this plugin
if (!getperms("P")) {
	// No permissions set, redirect to site front page
	header("location:".e_BASE."index.php");
	exit;
}

// Include define tables info
require_once("includes/config.php");

// Get language file (assume that the English language file is always present)
$lan_file = e_PLUGIN."locator/languages/".e_LANGUAGE.".php";
include_lan($lan_file);
include_lan(e_PLUGIN."locator/languages/English.php");

// Set the pageid for the menu as global variable (first pageid is set by admin_config.php)
global $pageid;

$action = basename($_SERVER['PHP_SELF'], ".php");

$var['admin_menu_01']['text'] = LOCATOR_MENU_01;
$var['admin_menu_01']['link'] = "admin_config.php";

$var['admin_menu_02']['text'] = LOCATOR_MENU_02;
$var['admin_menu_02']['link'] = "admin_countries.php";

$var['admin_menu_03']['text'] = LOCATOR_MENU_03;
$var['admin_menu_03']['link'] = "admin_categories.php";

// Only show locations menu if there are active countries AND active categories
$number_country  = $sql -> db_Count(DB_TABLE_LOCATOR_COUNTRY, '(*)', 'WHERE locator_country_status="2"');
$number_category = $sql -> db_Count(DB_TABLE_LOCATOR_TABLE, '(*)', 'WHERE locator_catactive_status="2"');
if ($number_category > 0 and $number_country > 0) {
  $var['admin_menu_04']['text'] = LOCATOR_MENU_04;
  $var['admin_menu_04']['link'] = "admin_locations.php";
}

// Only show opening hours menu if there are active locations
$number_locations  = $sql -> db_Count(DB_TABLE_LOCATOR2_TABLE, '(*)', 'WHERE locator_active_status="2"');
if ($number_locations > 0) {
  $var['admin_menu_05']['text'] = LOCATOR_MENU_05;
  $var['admin_menu_05']['link'] = "admin_openhrs.php";
}

// Only show approve menu if there are records to be approved
$submitted_locations = $sql->db_Count('locator_sub_sites', '(*)', "WHERE locator_sub_verified IS NULL");
if ($submitted_locations > 0) {
  $var['admin_menu_06']['text'] = LOCATOR_MENU_06;
  $var['admin_menu_06']['link'] = "admin_locations.php?approve";
}

// Put the readme.txt at the end of the list
$var['admin_menu_09']['text'] = LOCATOR_MENU_09;
$var['admin_menu_09']['link'] = "admin_readme.php";

// Show the admin menu with a caption from the language file
$caption = LOCATOR_MENU_00;
show_admin_menu($caption, $pageid, $var);

$ns->tablerender(LOCATOR_MENU_10, "<a href='https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=nlstart%40webstartinternet%2ecom&item_name=NLSTART%20Plugins&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8'>".LOCATOR_MENU_11."</a>");
?>