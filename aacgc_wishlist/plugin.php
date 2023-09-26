<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Wish List                 #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Wish List";
$eplug_version = "1.3";
$eplug_author = "M@CHIN3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Wish List plugin that allows users to add up to 10 items to their own wish list with external links to the items they want.";
$eplug_compatible = "e107v7";
$eplug_readme = ""; 
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = true;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "aacgc_wishlist";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_main.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_icon_custom = e_PLUGIN."aacgc_wishlist/images/icon_64.png";
$eplug_caption = "AACGC Wish List";

$eplug_table_names = array("aacgc_wishlist", "aacgc_wishlist_views");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_wishlist(
list_id int(11) NOT NULL auto_increment,
list_user_id varchar(50) NOT NULL,
list_type varchar(120) NOT NULL,
list_date text NOT Null,
list_itema text NOT NULL,
list_itema_link text NOT NULL,
list_itemb text NOT NULL,
list_itemb_link text NOT NULL,
list_itemc text NOT NULL,
list_itemc_link text NOT NULL,
list_itemd text NOT NULL,
list_itemd_link text NOT NULL,
list_iteme text NOT NULL,
list_iteme_link text NOT NULL,
list_itemf text NOT NULL,
list_itemf_link text NOT NULL,
list_itemg text NOT NULL,
list_itemg_link text NOT NULL,
list_itemh text NOT NULL,
list_itemh_link text NOT NULL,
list_itemi text NOT NULL,
list_itemi_link text NOT NULL,
list_itemj text NOT NULL,
list_itemj_link text NOT NULL,
list_other text NOT NULL,
list_other_link text NOT NULL,
PRIMARY KEY  (list_id)) TYPE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_wishlist_views(countid int(11) NOT NULL auto_increment,counter int(11) NOT NULL default '1',page text default NULL,visitor varchar(30) default NULL, PRIMARY KEY  (countid)) TYPE=MyISAM;",


);


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Member Wish List";
$eplug_link_url = "".e_PLUGIN."aacgc_wishlist/Wish_List.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Install Complete";

// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = array(
"ALTER TABLE " . MPREFIX . "aacgc_wishlist ADD COLUMN list_other text NOT NULL AFTER list_itemj_link;",
"ALTER TABLE " . MPREFIX . "aacgc_wishlist ADD COLUMN list_other_link text NOT NULL AFTER list_other;",
"CREATE TABLE ".MPREFIX."aacgc_wishlist_views(countid int(11) NOT NULL auto_increment,counter int(11) NOT NULL default '1',page text default NULL,visitor varchar(30) default NULL, PRIMARY KEY  (countid)) TYPE=MyISAM;",
);


$eplug_upgrade_done = "";

?>
