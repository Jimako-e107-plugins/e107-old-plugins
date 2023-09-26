<?php

if (!defined('e107_INIT'))
{exit;}

/*
#######################################
#     e107 website system plguin      #
#     AACGC Bracket Tracker           #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Bracket Tracker";
$eplug_version = "1.4";
$eplug_author = "M@CHIN3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Bracket Tracker plugin that shows Teams and users in bracket formation. Admin creates teams and adds users to bracket and teams.";
$eplug_compatible = "e107v7";
$eplug_readme = ""; 
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "aacgc_btracker";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_main.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon_32.jpg";
$eplug_icon_small = $eplug_folder . "/images/icon_16.jpg";
$eplug_caption = "AACGC Bracket Tracker";

$eplug_table_names = array("aacgc_bt_cat", "aacgc_bt_teams", "aacgc_bt_members", "aacgc_bt_place");


$eplug_tables = array(
"CREATE TABLE ".MPREFIX."aacgc_bt_cat(cat_id int(11) NOT NULL auto_increment,cat_name text NOT NULL, PRIMARY KEY  (cat_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_bt_teams(team_id int(11) NOT NULL auto_increment,team_name text NOT NULL,team_color text NOT NULL, PRIMARY KEY  (team_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_bt_place(place_id int(11) NOT NULL auto_increment,place_cat int(11) NOT NULL,place text NOT NULL, user int(11) NOT NULL, PRIMARY KEY  (place_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_bt_members(bt_id int(11) NOT NULL auto_increment,user_id int(11) NOT NULL,user_cat int(11) NOT NULL,user_team int(11) NOT NULL,user_place text NOT NULL, PRIMARY KEY  (bt_id)) ENGINE=MyISAM;");


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Bracket Tracker";
$eplug_link_url = "".e_PLUGIN."aacgc_btracker/Bracket_List.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Install Complete";

// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "";

?>
