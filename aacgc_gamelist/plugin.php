<?php

/*
#######################################
#     e107 website system plguin      
#     AACGC Game List
#     by M@CH!N3
#     http://www.AACGC.com       
#######################################
*/



$eplug_name = "AACGC Game List";
$eplug_version = "3.6";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Game List that allows admin to input games and information with icons that users can pick from that they play.Icons show in forum posts and game list detail pages when user joins the list. Users can remove their name from the list and Admins can remove users in admin panel or on Game List Page. Comes with a scrolling menu of all games listed. Admin options to adjust font sizes, menu and page title, icon sizes, and number of game icons shown on forum posts. Only some icons are icluded, download over 400+ game icons for this plugin here - <a href='http://www.aacgc.com/SSGC/download.php?view.330' target='_blank'>Game Icon Pack</a>";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = FALSE;


$eplug_folder      = "aacgc_gamelist";

$eplug_menu_name   = "AACGC_Game_List";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_gamelist/images/icon_32.jpg";
$eplug_icon_small  = e_PLUGIN."aacgc_gamelist/images/icon_16.jpg";
$eplug_icon_custom = e_PLUGIN."aacgc_gamelist/images/icon_64.jpg";

$eplug_caption     = "AACGC Game List";  


// Preferences --------------
$eplug_prefs = array(
"gamelist_pagetitle" => "Game List",
"gamelist_detailstitle" => "Game List",
"gamelist_detailstitlefs" => "4",
"gamelist_details" => "",
"gamelist_detailsfs" => "2",
"gamelist_catftsize" => "3",
"gamelist_catdetftsize" => "1",
"gamelist_iconsize" => "120",
"gamelist_namefs" => "3",
"gamelist_detfs" => "2",
"gamelist_alttheme_rows" => "3",
"gamelist_cat_minisize" => "50",
"gamelist_gamesperpage" => "25",
"gamelistdet_namefs" => "4",
"gamelistdet_detfs" => "2",
"gamelist_avatar_size" => "25",
"gamecatlist_menutitle" => "Game List",
"gamecatlistmenu_catftsize" => "3",
"gamecatlist_menu_order" => "ASC",
"gamecatlist_menu_ordertype" => "Name",
"gamelist_cat_order" => "ASC",
"gamelist_cat_ordertype" => "Name",
"gamecatlistmenu_cat_minisize" => "50",
"gamelist_menutitle" => "Game List",
"gamelist_menuheight" => "200",
"gamelistmenu_speed" => "2",
"gamelistmenu_mouseoverspeed" => "0",
"gamelistmenu_mouseoutspeed" => "2",
"gamelistmenu_img" => "120",
"gamelist_menu_direction" => "up",
"gamelist_menu_order" => "ASC",
"gamelist_menu_limit" => "0",
"gamelist_menu_catexclude" => "",
"gameuser_menutitle" => "Gamers",
"gameuser_menuheight" => "200",
"gameusermenu_speed" => "2",
"gameusermenu_mouseoverspeed" => "0",
"gameusermenu_mouseoutspeed" => "2",
"gameusermenu_img" => "25",
"gamelist_forum_img" => "25",
"numgames" => "5",
"gamelist_profile_img" => "75",
"numgamesprofile" => "50",
"gamelist_comheight" => "3",
"gamelist_comwidth" => "100",
"alt_gamelist_theme" => "1",
"gamelist_show_mini" => "1",
"gamelist_show_incat" => "1",
"gamecatlistmenu_show_mini" => "1",
"gamelistmenu_enable_scroll" => "1",
"gameuserlistmenu_enable_scroll" => "1",
"gamelist_show_popup" => "0",
"gamelist_show_usermini" => "0",
"gamelist_enable_userjoin" => "1",
"gamelist_enable_gold" => "0",
"gamelist_enable_forum" => "1",
"gamelist_enable_profile" => "1",
"gamelist_enable_avatar" => "1",
"gamelist_enable_theme" => "1",
"gamelist_enable_friends" => "0",
"gamelist_enable_comments" => "1",
"gamelist_enable_rating" => "1",
"gamelist_enable_catmenutotals" => "1",
"gamelist_showcasetitle" => "Game Showcase",
"gamelist_showcaselogo" => "http://",
"gamelist_showcaselogoheight" => "0",
"gamelist_showcaselogowidth" => "0",
"gamelist_showcaselogotype" => "Image",
"gamelist_showcaseicon" => "100",
"gamelist_showcasemenu_order" => "Random",
"gamelist_showcasemenu_direction" => "left",
"gamelist_showcasemenu_speed" => "2",
"gamelist_showcasemenu_mouseoverspeed" => "15",
"gamelist_showcasemenu_arrow" => "Set 10",
"gamelist_showcase_catexclude" => "",
"gamelist_showcase_newest" => "0",
"gamelist_showcasenewesticon" => "50",
"gamelist_showcasemaxgames" => "25",
"gamelist_showcasecatcol" => "2",
"gamelist_enable_showcaselogo" => "0",
"gamelist_enable_showcasecontrols" => "1",
"gamelist_enable_showcasegametotal" => "1",
"gamelist_enable_showcaseclantotal" => "0",
"gamelist_enable_showcaseservertotal" => "0",
"gamelist_enable_showcaseproducttotal" => "0",
"gamelist_enable_showcasescroll" => "1",
"gamelist_enable_showcasepopup" => "0",
"gamelist_enable_showcasecatlist" => "1",
"gamelist_enable_showcasenewest" => "0",
"gamelist_enable_showcasecaution" => "1",
);


$eplug_table_names = array("aacgc_gamelist", "aacgc_gamelist_cat", "aacgc_gamelist_members", "aacgc_gamelist_comments", "aacgc_gamelist_marks", "aacgc_gamelist_markedgames", "aacgc_gamelist_clanlist", "aacgc_gamelist_gameservers", "aacgc_gamelist_products");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_gamelist(game_id int(11) NOT NULL auto_increment,game_name varchar(50) NOT NULL,game_pic varchar(120) NOT NULL,game_cat int(10) unsigned NOT NULL,game_text text NOT NULL,linka text NOT NULL,linkaname text NOT NULL,linkb text NOT NULL,linkbname text NOT NULL,linkc text NOT NULL,linkcname text NOT NULL,video text NOT NULL, PRIMARY KEY  (game_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_cat(cat_id int(11) NOT NULL auto_increment,cat_name varchar(50) NOT NULL,cat_text text NOT NULL, PRIMARY KEY  (cat_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_members(chosen_id int(11) NOT NULL auto_increment,chosen_game_id int(11) NOT NULL,user_id varchar(11) NOT NULL, PRIMARY KEY  (chosen_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_comments(com_id int(11) NOT NULL auto_increment,com_game_id int(11) NOT NULL,user_id varchar(11) NOT NULL,user_com text NOT NULL, PRIMARY KEY  (com_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_marks(mark_id int(11) NOT NULL auto_increment,mark_name varchar(50) NOT NULL,mark_img varchar(120) NOT NULL, PRIMARY KEY  (mark_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_markedgames(marked_id int(11) NOT NULL auto_increment,game int(10) unsigned NOT NULL,mark int(10) unsigned NOT NULL, PRIMARY KEY  (marked_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_clanlist(link_id int(11) NOT NULL auto_increment,game int(10) NOT NULL,clancat int(10) NOT NULL, PRIMARY KEY  (link_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_gameservers(link_id int(11) NOT NULL auto_increment,game int(10) NOT NULL,servercat int(10) NOT NULL, PRIMARY KEY  (link_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_products(link_id int(11) NOT NULL auto_increment,game int(10) NOT NULL,productcat int(10) NOT NULL, PRIMARY KEY  (link_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_gamelist_cmms(link_id int(11) NOT NULL auto_increment,game int(10) NOT NULL,cmmscat int(10) NOT NULL, PRIMARY KEY  (link_id)) ENGINE=MyISAM;"
);

$eplug_link      = TRUE;
$eplug_link_name = "Game List";
$eplug_link_url  = e_PLUGIN."aacgc_gamelist/Game_Categories.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = "";

$upgrade_remove_prefs = "";

$upgrade_add_prefs = "";


?>
