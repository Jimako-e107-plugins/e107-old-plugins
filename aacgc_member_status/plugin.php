<?php

if (!defined('e107_INIT'))
{exit;}

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Status             #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Member Status";
$eplug_version = "1.4";
$eplug_author = "M@CHIN3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Member Status plugin that allows members to enter a custom status that shows in forum posts and in a member status scrolling menu that shows all members status and allows them to enter or delete their status.";
$eplug_compatible = "e107v7";
$eplug_readme = ""; 
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "aacgc_member_status";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_main.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_icon_large = e_PLUGIN."aacgc_member_status/images/icon_64.png";
$eplug_caption = "AACGC Member Status";

$eplug_prefs = array(
"msmenu_height" => "200",
"msmenu_speed" => "2",
"msmenu_mouseoverspeed" => "0",
"msmenu_mouseoutspeed" => "2",
"msmenu_avatar_size" => "25",
"ms_inputheight" => "25",
"ms_inputwidth" => "150",
"mspage_inputheight" => "25",
"mspage_inputwidth" => "400",
"mspage_avatar_size" => "25",
"ms_enable_autoscroll" => "0",
"ms_enable_forum" => "1",
"ms_enable_profile" => "1",
"msmenu_enable_avatar" => "1",
"mspage_enable_avatar" => "1",
"msmenu_enable_members" => "1",
"ms_enable_bbcode" => "1",
"ms_enable_gold" => "0",
"ms_enable_theme" => "1",
);

$eplug_table_names = array("aacgc_member_status");

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."aacgc_member_status(status_id int(11) NOT NULL auto_increment,status_user varchar(50) NOT NULL,status_text text NOT NULL,status_date int(10) unsigned NOT NULL,PRIMARY KEY  (status_id)) TYPE=MyISAM;");


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Member Status";
$eplug_link_url = e_PLUGIN."aacgc_member_status/Member_Status_List.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Install Complete";

// upgrading ... //

$upgrade_add_prefs = array(
"msmenu_height" => "200",
"msmenu_speed" => "2",
"msmenu_mouseoverspeed" => "0",
"msmenu_mouseoutspeed" => "2",
"msmenu_avatar_size" => "25",
"ms_inputheight" => "25",
"ms_inputwidth" => "150",
"mspage_inputheight" => "25",
"mspage_inputwidth" => "400",
"mspage_avatar_size" => "25",
"ms_enable_autoscroll" => "0",
"ms_enable_forum" => "1",
"ms_enable_profile" => "1",
"msmenu_enable_avatar" => "1",
"mspage_enable_avatar" => "1",
"msmenu_enable_members" => "1",
"ms_enable_bbcode" => "1",
"ms_enable_gold" => "0",
"ms_enable_theme" => "1",
);

$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>
