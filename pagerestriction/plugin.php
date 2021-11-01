<?php
/*
+ ----------------------------------------------------------------------------+
|    e107 website system
|
|    ©Steve Dunstan 2001-2002
|    http://e107.org
|    jalist@e107.org
|
|    Released under the terms and conditions of the
|    GNU General Public License (http://gnu.org).
|
|    $Source: /cvsroot/e107/e107_0.7/e107_plugins/pagerestriction/plugin.php,v $
|    $Revision: 1.0 $
|    $Date: 2006/07/23 08:03:58 $
|    $Author: lisa_ $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

@include_once(e_PLUGIN.'pagerestriction/languages/'.e_LANGUAGE.'.php');
@include_once(e_PLUGIN.'pagerestriction/languages/English.php');

// Plugin info ----------------------------------------------------------------
$eplug_name				= "Page Restriction";
$eplug_version			= "1.0";
$eplug_author			= "Eric Vanderfeesten (lisa)";
$eplug_logo				= "";
$eplug_url				= "http://evanderfeesten.nl";
$eplug_email			= "lisa@evanderfeesten.nl";
$eplug_description		= LAN_PAGERESTRICTION_PLUGIN_1;
$eplug_compatible		= "e107v0.7";
$eplug_readme			= "";

$eplug_module			= TRUE;

// Name of the plugin's folder ------------------------------------------------
$eplug_folder			= "pagerestriction";

// Name of menu item for plugin -----------------------------------------------
$eplug_menu_name		= "";

// Name of the admin configuration file ---------------------------------------
$eplug_conffile			= "admin_pagerestriction_config.php";

// Icon image and caption text ------------------------------------------------
$eplug_icon				= $eplug_folder."/images/pagerestriction_32.png";
$eplug_icon_small		= $eplug_folder."/images/pagerestriction_16.png";
$eplug_caption			=  LAN_PAGERESTRICTION_PLUGIN_2;

// List of table names --------------------------------------------------------
$eplug_table_names		= "";

// List of sql requests to create tables --------------------------------------
$eplug_tables			= "";

// Create a link in main menu (yes=TRUE, no=FALSE) ----------------------------
$eplug_link				= FALSE;
$eplug_link_name		= "";
$eplug_link_url			= "";

// Text to display after plugin successfully installed ------------------------
$eplug_done				= LAN_PAGERESTRICTION_PLUGIN_3;

// upgrading ------------------------------------------------------------------
$upgrade_add_prefs		= "";
$upgrade_remove_prefs	= "";
$upgrade_alter_tables	= "";
$eplug_upgrade_done		= "";

?>