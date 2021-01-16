<?php
// ***************************************************************
// *
// *		Title		:	Prune Inactive Users
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	27 September 2004
// *
// *		Version		:	2.6
// *
// *		Description	: 	Prune inactive users
// *
// *		Revisions	:	27 Sep 2004 Initial Design
// *					:   23 Dec 2004 Fixes to compliance
// *					:				and emailing issues
// *					:   6 June 2006 Convert to e107 v7
// *					:   5 Feb 2007  Fixes
// *					:   5 Dec 2008  Enhancements
// *					:  12 Dec 2008  Further Enhancements
// *
// *		Support at	:	www.keal.me.uk
// *
// ***************************************************************
/*
+---------------------------------------------------------------+
|        Prune Inactive Users for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
include_lan(e_PLUGIN . "prune_users/languages/admin/" . e_LANGUAGE . ".php");
$eplug_name = "Prune Inactive Users";
$eplug_version = "3.1";
$eplug_author = "Father Barry";
$eplug_logo = "images/prune_32.png";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = PRUNE_A1;
$eplug_compatible = "e107v7";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = false;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "prune_users";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/prune_32.png";
$eplug_icon_small = $eplug_folder . "/images/prune_16.png";
$eplug_caption = PRUNE_A1;
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array("prune_days" => 0,
    "prune_type" => 0,
    "prune_auto" => 0,
    "prune_notify" => 1,
    "prune_action"=>0,
    "prune_class"=>0,
    "prune_threshold"=>0,
    "prune_class"=>255,
    "prune_exadmin"=>0,
    "prune_joinbefore"=>0,
    "prune_perpage"=>50,
    );

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = "";
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_url = "";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = PRUNE_A51;
// upgrading ... //
$upgrade_add_prefs = array("prune_perpage" => 50);

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "";

?>