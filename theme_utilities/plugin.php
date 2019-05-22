<?php
/*
+---------------------------------------------------------------+
| Theme Utilities by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/theme_utilities/plugin.php,v $
| $Revision: 1.3 $
| $Date: 2006/12/09 19:47:16 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Plugin info ---------------------------------------------------------------
$eplug_name          = "Theme Utilities";
$eplug_version       = "1.0_rc1";
$eplug_author        = "bugrain";
$eplug_logo          = $eplug_folder."/images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = "Theme Utilities plugin for configuring themes";
$eplug_compatible    = "e107v0.7+";
$eplug_readme        = "readme.php";

// Name of the plugin's folder -----------------------------------------------
$eplug_folder        = "theme_utilities";

// Mane of menu item for plugin ----------------------------------------------
$eplug_menu_name     = "";

// Name of the admin configuration file --------------------------------------
$eplug_conffile      = "admin_prefs.php";

// Icon image and caption text -----------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       =  "Configure Theme Utilities";

// List of preferences -------------------------------------------------------
$eplug_prefs = array();

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names   = "";

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables[$i] = "";

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";

// Text to display after plugin successfully installed -----------------------
$eplug_done = "Installation of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";

// ************************************************************************************************
// upgrading ...
// ************************************************************************************************
$upgrade_add_prefs      = array();
$upgrade_remove_prefs   = array();
$upgrade_alter_tables   = array();
$eplug_upgrade_done     = "Upgrade of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";;

?>