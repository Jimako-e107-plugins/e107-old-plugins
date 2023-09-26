<?php

/*
#######################################
#     e107 website system plguin      #
#     Product Listing                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/



$eplug_name = "AACGC Product Listing";
$eplug_version = "1.5";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Displays product codes and price option from other sorces like Commission Junction and arranges into catagories, sub-categories, and pages.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "product_listing";

$eplug_menu_name   = "AACGC_Product_Listing";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "logo.png";
$eplug_icon        = e_PLUGIN."product_listing/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."product_listing/images/icon_16.png";
$eplug_caption     = "AACGC Product Listing";  

$eplug_table_names = array("product_listing,product_listing_cat,product_listing_subcat");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."product_listing(product_id int(11) NOT NULL auto_increment,product_code text NOT NULL,product_price text NOT NULL,product_cat int(10) unsigned NOT NULL,PRIMARY KEY  (product_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."product_listing_cat(product_cat_id int(11) NOT NULL auto_increment,product_cat_name text NOT NULL,PRIMARY KEY  (product_cat_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."product_listing_subcat(product_subcat_id int(11) NOT NULL auto_increment,product_subcat_name text NOT NULL,product_cat int(10) unsigned NOT NULL,PRIMARY KEY  (product_subcat_id)) ENGINE=MyISAM;");


$eplug_link      = TRUE;
$eplug_link_name = "Product Listing";
$eplug_link_url  = e_PLUGIN."product_listing/Product_Categories.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = array(

"CREATE TABLE ".MPREFIX."product_listing_subcat(product_subcat_id int(11) NOT NULL auto_increment,product_subcat_name text NOT NULL,product_cat int(10) unsigned NOT NULL,PRIMARY KEY  (product_subcat_id)) ENGINE=MyISAM;");

$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
