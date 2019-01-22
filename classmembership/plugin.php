<?php
//***************************************************************
//*
//*		Plugin		:	Class Membership (e107 v7+)
//*
//*		Author		:	Barry Keal (c) 2003
//*
//*		Web site	:	www.keal.me.uk
//*
//*		Email		:	classes @ keal . me . uk
//*
//*		Description	:	Install plugin
//*
//*		Version		:	1.02
//*
//*		Date		:	23 Aug 2005
//*					:	07 Jun 2006
//*
//***************************************************************

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Class Membership";
$eplug_version = "1.02";
$eplug_author = "Barry";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = "Class membership";
$eplug_compatible = "e107v7";
$eplug_readme = "readme.rtf";	// leave blank if no readme file
$eplug_compliant = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "classmembership";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/classy_32.png";
$eplug_icon_small = $eplug_folder."/images/classy_16.png";
$eplug_caption =  "Configure Class Membership Plugin";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs =array("classy_userclass" => 254);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = "";

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Check Class Membership";
$eplug_link_url = e_PLUGIN . "classmembership/classy.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Go to the plugin configuration panel to configure and administer the class membership plugin.";

// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";
?>