<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Clan Listing              #  
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

$eplug_name = "AACGC Clan Listing";
$eplug_version = "2.5";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Displays Clan Names, Website, Information, and Game Server Banner, arranges into catagories and pages.BBcode & HTML supported.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "clan_listing";

$eplug_menu_name   = "Clan_Listing";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "logo.png";
$eplug_icon        = e_PLUGIN."clan_listing/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."clan_listing/images/icon_16.png";
$eplug_icon_large  = e_PLUGIN."clan_listing/images/icon_64.png";
$eplug_caption     = "AACGC Clan Listing";  

$eplug_prefs = array(
"clanlist_catpagetitle" => "Clan/Game Categories",
"clanlist_catpagefsize" => "3",
"clanlist_catpageiconsize" => "50",
"clanlist_listpagecatfsize" => "5",
"clanlist_listpageclanfsize" => "1",
"clanlist_detpageclanfsize" => "5",
"clanlist_menutitle" => "Clan/Game Categories",
"clanlist_menuheight" => "200",
"clanlist_menuspeeds" => "2",
"clanlist_menuspeedon" => "1",
"clanlist_menuspeedout" => "2",
"clanlist_menugamefsize" => "1",
"clanlist_menuclanfsize" => "1",
"clanlist_menuiconsize" => "25",
"clanlist_enable_clantotal" => "1",
"clanlist_enable_clansubmit" => "1",
"clanlist_enable_showclans" => "1",
"clanlist_enable_scroll" => "0",
);

$eplug_table_names = array("clan_listing","clan_listing_cat","clan_listing_submission");

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."clan_listing(clan_id int(11) NOT NULL auto_increment,clan_owner text NOT NULL,clan_name text NOT NULL,clan_tag text NOT NULL,clan_website text NOT NULL,clan_tsip text NOT NULL,clan_tsport text NOT NULL,clan_banner text NOT NULL,clan_game_banner text NOT NULL,clan_cat int(10) unsigned NOT NULL,PRIMARY KEY  (clan_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."clan_listing_cat(clan_cat_id int(11) NOT NULL auto_increment,clan_cat_name text NOT NULL,clan_cat_icon varchar(120) NOT NULL,clan_cat_order text NOT NULL,PRIMARY KEY  (clan_cat_id)) ENGINE=MyISAM;",
"CREATE TABLE ".MPREFIX."clan_listing_submission(submit_id int(11) NOT NULL auto_increment,clan_owner text NOT NULL,clan_name text NOT NULL,clan_tag text NOT NULL,clan_website text NOT NULL,clan_tsip text NOT NULL,clan_tsport text NOT NULL,clan_banner text NOT NULL,clan_game_banner text NOT NULL,clan_cat int(10) unsigned NOT NULL,PRIMARY KEY  (submit_id)) ENGINE=MyISAM;",
);

$eplug_link      = TRUE;
$eplug_link_name = "Clan List";
$eplug_link_url  = e_PLUGIN."clan_listing/Clan_Categories.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = array (
"ALTER TABLE " . MPREFIX . "clan_listing_cat ADD COLUMN clan_cat_order text NOT NULL AFTER clan_cat_icon;",
"ALTER TABLE " . MPREFIX . "clan_listing ADD COLUMN clan_owner text NOT NULL AFTER clan_id;",
"ALTER TABLE " . MPREFIX . "clan_listing ADD COLUMN clan_tsip text NOT NULL AFTER clan_website;",
"ALTER TABLE " . MPREFIX . "clan_listing ADD COLUMN clan_tsport text NOT NULL AFTER clan_tsip;",
"ALTER TABLE " . MPREFIX . "clan_listing_submission ADD COLUMN clan_owner text NOT NULL AFTER submit_id;",
"ALTER TABLE " . MPREFIX . "clan_listing_submission ADD COLUMN clan_tsip text NOT NULL AFTER clan_website;",
"ALTER TABLE " . MPREFIX . "clan_listing_submission ADD COLUMN clan_tsport text NOT NULL AFTER clan_tsip;",
);

$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
