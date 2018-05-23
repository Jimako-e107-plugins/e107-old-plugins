<?php

//-----------------------------------------------------------------------------------------------------------+
/*
#######################################
#     AACGC Arcade Addins             #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/
//-----------------------------------------------------------------------------------------------------------+




if (!defined('e107_INIT'))
{exit;}


// Plugin info -------------------------------------------------------------------------------------------------------

$eplug_name = "AACGC Arcade Addins";
$eplug_version = "3.0";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Includes: Popular Games Menu, Random Games Menu, Latest Games Menu (can set number of games shown on each), Arcade Champion Menu, Arcade Tournament Champion Menu, Arcade Challenge Champion Menu,Gold System and Gold Orb Support if enabled. Requests for more addins accepted at www.aacgc.com ";
$eplug_compatible = "e107v7";
$eplug_readme = "";
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "aacgc_arcade_addins";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_readme.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon_32.gif";
$eplug_icon_small = $eplug_folder . "/images/icon_16.gif";
$eplug_caption = "AACGC Arcade Addins";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = "";

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = "";

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_url = "";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Install Complete";

// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "Upgrade Complete";


?>
