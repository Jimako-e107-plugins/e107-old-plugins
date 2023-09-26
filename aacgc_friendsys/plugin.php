<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Friend System             #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



$eplug_name = "AACGC Friend System";
$eplug_version = "1.5";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Friend System that allows users to add each other as friends. Comes with scrolling menu with list of users friends with options to edit friends and view requests. User friend list shows in profiles with user name and avatars, add to friends button shows in profiles and forum posts. Friends menu shows friends with user name , avatars, quick PM icon & online status. Automated PM sent to users for friend approval and when user accept friends. Users can delete friends, recieved requests, and sent requests. Supports the Gold Orbs Plugin for usernames. 
";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = FALSE;
$eplug_latest = FALSE;


$eplug_folder      = "aacgc_friendsys";

$eplug_menu_name   = "User_Friends_menu";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_friendsys/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_friendsys/images/icon_16.png";
$eplug_icon_custom = e_PLUGIN."aacgc_friendsys/images/icon_64.png";

$eplug_caption     = "AACGC Friend System";  

$eplug_prefs = array(
"fl_menu_title" => "My Friends",
"fl_menu_height" => "200",
"fl_profilelist_height" => "200",
"fl_profile_avatarsize" => "50",
"fl_menu_avatarsize" => "25",
"fl_usersperrow" => "5",
"fl_enable_forum" => "1",
"fl_enable_profile" => "1",
"fl_enable_profilelist" => "1",
"fl_enable_profileavatar" => "1",
"fl_enable_profileonline" => "1",
"fl_enable_profilepm" => "1",
"fl_enable_menuavatar" => "1",
"fl_enable_theme" => "1",
"fl_enable_memlist" => "1",
"fl_enable_menuonline" => "1",
"fl_enable_menupm" => "1",
"fl_enable_gold" => "0",
);

$eplug_table_names = array("aacgc_friend_sys", "aacgc_friend_sys_requests");

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."aacgc_friend_sys(sys_id int(11) NOT NULL auto_increment,user_id int(5) NOT NULL,user_friends varchar(255) NOT NULL, PRIMARY KEY  (sys_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."aacgc_friend_sys_request(req_id int(11) NOT NULL auto_increment,user_id int(5) NOT NULL,user_friends_request varchar(255) NOT NULL, PRIMARY KEY  (req_id)) ENGINE=MyISAM;",
);

$eplug_link      = FALSE;
$eplug_link_name = "";
$eplug_link_url  = "";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = "";
$upgrade_remove_prefs = "";

$upgrade_add_prefs = array(
"fl_menu_title" => "My Friends",
"fl_menu_height" => "200",
"fl_profilelist_height" => "200",
"fl_profile_avatarsize" => "50",
"fl_menu_avatarsize" => "25",
"fl_usersperrow" => "5",
"fl_enable_forum" => "1",
"fl_enable_profile" => "1",
"fl_enable_profilelist" => "1",
"fl_enable_profileavatar" => "1",
"fl_enable_profileonline" => "1",
"fl_enable_profilepm" => "1",
"fl_enable_menuavatar" => "1",
"fl_enable_theme" => "1",
"fl_enable_memlist" => "1",
"fl_enable_menuonline" => "1",
"fl_enable_menupm" => "1",
"fl_enable_gold" => "0",
);

?>
