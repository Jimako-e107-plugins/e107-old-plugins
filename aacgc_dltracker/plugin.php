<?php

if (!defined('e107_INIT'))
{exit;}

/*
#######################################
#     e107 website system plguin      #
#     AACGC Download Tracker          #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Download Tracker";
$eplug_version = "1.3";
$eplug_author = "M@CHIN3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Download Tracker plugin that shows all downloads on a page with number of times downloaded, click each download to view who and when they download it";
$eplug_compatible = "e107v7";
$eplug_readme = ""; 
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "aacgc_dltracker";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_main.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_caption = "AACGC Download Tracker";

$eplug_table_names = "";

$eplug_tables = "";


$eplug_prefs = array(
"dltracker_enable_avatar" => "1",
"dltracker_enable_gold" => "0",
"dltracker_enable_profile" => "1",
"dltracker_pagetitle" => "Download Tracker",
"dltracker_avatar_size" => "25",
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "DL Tracker";
$eplug_link_url = "".e_PLUGIN."aacgc_dltracker/DLTracker_List.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Install Complete";

// upgrading ... //
$upgrade_add_prefs = array(
"dltracker_enable_avatar" => "1",
"dltracker_enable_gold" => "0",
"dltracker_enable_profile" => "1",
"dltracker_pagetitle" => "Download Tracker",
"dltracker_avatar_size" => "25",
);

$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "Upgrade Complete";

?>
