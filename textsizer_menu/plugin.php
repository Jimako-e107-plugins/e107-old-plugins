<?php
/*
 * e107 website system
 *
 * Copyright (C) 2001-2009 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Plugin - Texesizer
 *
 * $Source: 
 * $Revision: 1.2 $
 * $Date: 2010/11/29 22:04:41 $
 * $Author: stafex $
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
*/

if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."textsizer_menu/languages/".e_LANGUAGE.".php");
 
 // Plugin info  
 $eplug_name    = "Textsizer";
 $eplug_version = "1.2";
 $eplug_author  = "stafex";
 $eplug_url     = "http://e107.bg";
 $eplug_readme  = "README.txt";
 $eplug_description = TEXTSIZER_LAN_892;
 $eplug_compatible  = "UTF8 e107 v0.7+";      
 
 // Name of the plugin's folder
 $eplug_folder = "textsizer_menu";
 
 // Name of menu item for plugin  
 $eplug_menu_name = "textsizer";
 
 // Name of the admin configuration file  
 $eplug_conffile = "";

// Icon image and caption text------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon32.png";
$eplug_icon_small = $eplug_folder."/images/icon16.png";
$eplug_caption = TEXTSIZER_LAN_888;
 
 // List of preferences 
 $eplug_prefs       = "";
 $eplug_table_names = ""; 
 
 // Create a link in main menu (yes=TRUE, no=FALSE) 
 $eplug_link = FALSE;
 $eplug_link_name  = "";
 $eplug_link_perms = "";
 
 // Text to display after plugin successfully installed 
 $eplug_done           = TEXTSIZER_LAN_893;
 $eplug_uninstall_done = TEXTSIZER_LAN_894;
 $eplug_module = TRUE;
?>