<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
@include_once(e_PLUGIN.'custom_theme/languages/'.e_LANGUAGE.'.php');
@include_once(e_PLUGIN.'custom_theme/languages/English.php');

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Custom Theme";
$eplug_version = "1.1";
$eplug_author = "Eric Vanderfeesten (lisa)";
$eplug_logo = "";
$eplug_url = "http://evanderfeesten.nl";
$eplug_email = "lisa@evanderfeesten.nl";
$eplug_description = CUSTOMTHEME_PLUGIN_LAN_1;
$eplug_compatible = "e107v0.7";
$eplug_readme = "";        // leave blank if no readme file

$eplug_module = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "custom_theme";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_custom_theme_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/plugintheme_32.png";
$eplug_icon_small = $eplug_folder."/images/plugintheme_16.png";
$eplug_caption =  CUSTOMTHEME_PLUGIN_LAN_2;

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = "";

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = CUSTOMTHEME_PLUGIN_LAN_3;

// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>