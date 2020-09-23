<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Members 1.0                                           |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/

// Ensure this program is loaded in admin theme before calling class2
$eplug_admin = true;

// class2.php is the heart of e107, always include it first to give access to e107 constants and variables
require_once('../../class2.php');
// Check to see if the current user has admin permissions for this plugin
if ( ! getperms('P')) { header('location:'.e_BASE.'index.php'); exit(); }

// Include auth.php rather than header.php ensures an admin user is logged in
require_once(e_ADMIN.'auth.php');

// Get language file (assume that the English language file is always present)
include_lan(e_PLUGIN.'clanmembers/languages/'.e_LANGUAGE.'/clanmembers_admin.php');
include_lan(e_PLUGIN.'clanmembers/languages/'.e_LANGUAGE.'/clanmembers_common.php');
// set the pageid for the menu as global variable (first pageid is set by admin_config.php)
global $action;

	// ##### Display options ---------------------------------------------------------------------------------------------------------
	$var['Config']['text'] = _CONFIG;
	$var['Config']['link'] = e_SELF."?Config";
	$var['Members']['text'] = _CMMEMBERS;
	$var['Members']['link'] = e_SELF."?Members";
	$var['Userlist']['text'] = _ADDMEMBERS;
	$var['Userlist']['link'] = e_SELF."?Userlist";
	$var['Games']['text'] = _INFOGames;
	$var['Games']['link'] = e_SELF."?Games";
	$var['Teams']['text'] = _INFOTeams;
	$var['Teams']['link'] = e_SELF."?Teams";
	$var['Ranks']['text'] = _INFORanks;
	$var['Ranks']['link'] = e_SELF."?Ranks";
	$var['Awards']['text'] = _AWARDS;
	$var['Awards']['link'] = e_SELF."?Awards";

	show_admin_menu(_CLANMEMBERS, $action, $var);
