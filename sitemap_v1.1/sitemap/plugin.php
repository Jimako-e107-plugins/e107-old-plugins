<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }

include_lan(e_PLUGIN."sitemap/languages/".e_LANGUAGE.".php");

// Plugin info ----------------------------------------------------------------
$eplug_name				= "SITEMAP_MENU_TITLE";
$eplug_version			= "1.1";
$eplug_author			= "Mohamed Anouar";
$eplug_url				= "http://naja7host.com";
$eplug_email			= "support@naja7host.com";
$eplug_description		= SITEMAP_MENU_DESC;
$eplug_compatible		= "e107v1+";
$eplug_readme			= "";		//leave blank if no readme file
$eplug_latest			= FALSE;	//Show reported threads in admin (use latest.php)
$eplug_status			= FALSE;	//Show post count in admin (use status.php)

// Name of the plugin's folder ------------------------------------------------
$eplug_folder			= "sitemap";

// Name of menu item for plugin -----------------------------------------------
$eplug_menu_name		= "sitemap_menu";

// Name of the admin configuration file ---------------------------------------
$eplug_conffile			= "admin_conf.php";

// Icon image and caption text ------------------------------------------------
$eplug_icon				= $eplug_folder."/images/sitemap_32.png";
$eplug_icon_small		= $eplug_folder."/images/sitemap_16.png";
$eplug_logo				= $eplug_folder."/images/sitemap_32.png";
$eplug_caption			= SITEMAP_MENU_CONFIGURE;

// List of preferences --------------------------------------------------------
$eplug_prefs			= array("");

// List of table names --------------------------------------------------------
$eplug_table_names		= array("");

// List of sql requests to create tables --------------------------------------
$eplug_tables = "";

// Create a link in main menu (yes=TRUE, no=FALSE) ----------------------------
$eplug_link				= FALSE;
$eplug_link_name		= '';
$eplug_link_url			= '';


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = SITEMAP_MENU_INSTALL;

// Upgrading -----------------------------------------------------------------------------------
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = SITEMAP_MENU_UPGRADE;


//sitemap Uninstall
if(!function_exists("sitemap_uninstall")) {
	//Remove prefs entries during uninstall
	function sitemap_uninstall() {
		global $sql;
		$sql->db_Delete("core", "e107_name = 'sitemap_prefs'");		
	}
}
?>
