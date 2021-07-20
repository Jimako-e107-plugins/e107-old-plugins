<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Donation Listing          #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/


$eplug_name = "AACGC Donation Listing";
$eplug_version = "1.8";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Displays Names & Ammount in Year and Month Categories.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "donation_listing";

$eplug_menu_name   = "Donation_Listing";

$eplug_conffile    = "admin_readme.php";

$eplug_logo        = "logo.png";
$eplug_icon        = e_PLUGIN."donation_listing/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."donation_listing/images/icon_16.png";
$eplug_caption     = "";  

$eplug_table_names = array("donation_listing,donation_listing_year,donation_listing_month");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."donation_listing(don_id int(11) NOT NULL auto_increment,user_id varchar(11) NOT NULL,user_amount text NOT NULL,user_day text NOT NULL,year int(10) unsigned NOT NULL,month int(12) unsigned NOT NULL,PRIMARY KEY  (don_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."donation_listing_month(month_id int(11) NOT NULL auto_increment,month_name text NOT NULL,year int(10) unsigned NOT NULL,PRIMARY KEY  (month_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."donation_listing_year(year_id int(11) NOT NULL auto_increment,year_name text NOT NULL,PRIMARY KEY  (year_id)) ENGINE=MyISAM;");


$eplug_link      = TRUE;
$eplug_link_name = "Donation Listing";
$eplug_link_url  = e_PLUGIN."donation_listing/Donation_List.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = "";
$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
