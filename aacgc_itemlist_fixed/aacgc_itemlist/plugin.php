<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Item List                 #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Item List";
$eplug_version = "1.5";
$eplug_author = "M@CHIN3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Item List plugin that allows admin to list items with image, name, details, and optional price in different categories and sub-categories.";
$eplug_compatible = "e107v7";
$eplug_readme = ""; 
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

//-----------------------

$eplug_folder = "aacgc_itemlist";

//-----------------------

$eplug_menu_name = "";

//-----------------------

$eplug_conffile = "admin_main.php";

//-----------------------

$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_icon_custom = e_PLUGIN."aacgc_itemlist/images/icon_64.png";
$eplug_caption = "AACGC Item List";

//-----------------------

$eplug_table_names = array("aacgc_itemlist","aacgc_itemlist_cat","aacgc_item_subcat");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_itemlist(
item_id int(11) NOT NULL auto_increment,
item_cat int(10) unsigned NOT NULL,
item_subcat int(10) unsigned NOT NULL,
item_name text NOT NULL,
item_image varchar(120) NOT NULL,
item_detail text NOT Null,
item_link text NOT Null,
item_price text NOT NULL,
PRIMARY KEY  (item_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_itemlist_cat(
item_cat_id int(11) NOT NULL auto_increment,
item_cat_name text NOT NULL,
item_cat_details text NOT NULL,
PRIMARY KEY  (item_cat_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_itemlist_subcat(
item_subcat_id int(11) NOT NULL auto_increment,
item_subcat_cat int(10) unsigned NOT NULL,
item_subcat_name text NOT NULL,
item_subcat_details text NOT NULL,
PRIMARY KEY  (item_subcat_id)) ENGINE=MyISAM;"

);

//-----------------------

$eplug_link = true;
$eplug_link_name = "Item List";
$eplug_link_url = "".e_PLUGIN."aacgc_itemlist/Item_Categories.php";

//-----------------------
$eplug_done = "Install Complete";



// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";

$upgrade_alter_tables = array (

"ALTER TABLE " . MPREFIX . "aacgc_itemlist ADD COLUMN item_subcat int(10) unsigned NOT NULL AFTER item_cat;",

"ALTER TABLE " . MPREFIX . "aacgc_itemlist_cat ADD COLUMN item_cat_details text NOT NULL AFTER item_cat_name;",

"CREATE TABLE ".MPREFIX."aacgc_itemlist_subcat(
item_subcat_id int(11) NOT NULL auto_increment,
item_subcat_cat int(10) unsigned NOT NULL,
item_subcat_name text NOT NULL,
item_subcat_details text NOT NULL,
PRIMARY KEY  (item_subcat_id)) ENGINE=MyISAM;"

);


$eplug_upgrade_done = "Upgrade Complete!";

?>
