<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	 4xA-LNM (Last- News- Menu) version 0.5.1 from ***RuSsE*** http://www.e107.4xa.de
|	released 28.06.2011
|	sorce: ../../last_news_menu/plugin.php
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
$lan_file=e_PLUGIN."last_news_menu/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."last_news_menu/languages/German.php");
// Plugin info --------------------------------------------------
$eplug_name = e4xA_LNM_001;
$eplug_version = e4xA_LNM_VERS;
$eplug_author = "***RuSsE***";
$eplug_logo = "images/logo_32.png";
$eplug_url = "http://e107coders.org";
$eplug_email = "admin@4xa.de";
$eplug_description = e4xA_LNM_002;
$eplug_compatible = "e107v7+";
$eplug_readme = "";	// leave blank if no readme file

// XHTML compliant ----------------------------------------------
$eplug_compliant = TRUE;

// Status and latest menu ---------------------------------------
$eplug_status = FALSE;
$eplug_latest = FALSE;

// Name of the plugin's folder ----------------------------------
$eplug_folder = "last_news_menu";

// Name of menu item for plugin ---------------------------------
$eplug_menu_name = e4xA_LNM_001;

// Name of the admin configuration file -------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ----------------------------------
$eplug_icon = $eplug_folder."/images/logo_32.png";
$eplug_icon_small = $eplug_folder."/images/logo_16.png";
$eplug_caption =  e4xA_LNM_001;

// List of preferences ------------------------------------------
$eplug_prefs = array(
	"last_news_title"	=> 'Letzte News',
	"last_news_show"	=> 4,
	"last_news_chars"	=> 200,
	"last_news_cols"	=> 2
);

// List of table names -------------------------------------------
$eplug_table_names = "";

// List of sql requests to create tables -------------------------
$eplug_tables = "";

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";

// Create a userclass  -------------------------------------------
$eplug_userclass = "";
$eplug_userclass_description = "";

// Text to display after plugin successfully installed -----------
$eplug_done = $eplug_name." is successfully installed.";

// upgrading ... 
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "Upgrading ".$eplug_name." to ".$eplug_version." is successfully done.";
?>