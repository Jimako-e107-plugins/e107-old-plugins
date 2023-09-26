<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



$eplug_name = "AACGC Favorite Downloads";
$eplug_version = "1.2";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Favorite Downloads plugin allows users to add downloads to a favorite list that shows in their profiles. Comes with two menus, a scrolling menu with list of users who have favorites and how many and a menu for users to view a list of their favorites for quick access. Once installed it automatically adds a favorites button to the download detail pages.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = FALSE;
$eplug_latest = FALSE;


$eplug_folder      = "aacgc_favdls";

$eplug_menu_name   = "Download_Favorites_menu";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_favdls/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_favdls/images/icon_16.png";
$eplug_icon_custom = e_PLUGIN."aacgc_favdls/images/icon_64.png";

$eplug_caption     = "AACGC Favorite Downloads";  

$eplug_prefs = array(
"favdls_menu_title" => "Favorite Downloads",
"favdls_menu_height" => "200",
"favdls_menumax" => "0",
"favdls_usermaxfav" => "10",
"favdls_menu_avatarsize" => "25",
"favdls_usermenu_title" => "My Favorite Downloads",
"favdls_usermenu_height" => "200",
"favdls_profilelist_height" => "200",
"favdls_page_avatarsize" => "25",
"favdls_enable_forumcount" => "1",
"favdls_enable_profilelist" => "1",
"favdls_enable_theme" => "1",
"favdls_enable_dlpage" => "1",
"favdls_enable_dlpagecount" => "1",
"favdls_enable_menuavatar" => "1",
"favdls_enable_pageavatar" => "1",
"favdls_enable_gold" => "0",
);

$eplug_table_names = array("aacgc_favdls");

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."aacgc_favdls(fav_id int(11) NOT NULL auto_increment,user_id int(5) NOT NULL,user_favdls varchar(255) NOT NULL, PRIMARY KEY  (fav_id)) TYPE=MyISAM;",
);

$eplug_link      = FALSE;
$eplug_link_name = "";
$eplug_link_url  = "";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = "";
$upgrade_remove_prefs = "";

$upgrade_add_prefs = array(
"favdls_menu_title" => "Favorite Downloads",
"favdls_menu_height" => "200",
"favdls_menumax" => "0",
"favdls_usermaxfav" => "10",
"favdls_menu_avatarsize" => "25",
"favdls_usermenu_title" => "My Favorite Downloads",
"favdls_usermenu_height" => "200",
"favdls_profilelist_height" => "200",
"favdls_page_avatarsize" => "25",
"favdls_enable_forumcount" => "1",
"favdls_enable_profilelist" => "1",
"favdls_enable_theme" => "1",
"favdls_enable_dlpage" => "1",
"favdls_enable_dlpagecount" => "1",
"favdls_enable_menuavatar" => "1",
"favdls_enable_pageavatar" => "1",
"favdls_enable_gold" => "0",
);



?>
