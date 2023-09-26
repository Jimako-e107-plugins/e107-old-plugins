<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Payment Tracker           #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



$eplug_name = "AACGC Payment Tracker";
$eplug_version = "1.2";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = FALSE;


$eplug_folder      = "aacgc_paytrack";

$eplug_menu_name   = "AACGC_PayTrack_menu";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_paytrack/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_paytrack/images/icon_16.png";
$eplug_icon_large  = e_PLUGIN."aacgc_paytrack/images/icon_64.png";
$eplug_caption     = "AACGC Payment Tracker";  

$eplug_table_names = array("aacgc_paytrack_cat", "aacgc_paytrack_members");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_paytrack_cat(
	cat_id int(11) NOT NULL auto_increment,
	cat_title varchar(50) NOT NULL,
	cat_det text NOT NULL,
	cat_order text NOT NULL,
  PRIMARY KEY  (cat_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_paytrack_members(
	pay_id int(11) NOT NULL auto_increment,
	user_id varchar(11) NOT NULL,
	user_camount text NOT NULL,
	user_damount text NOT NULL,
	user_tamount text NOT NULL,
	user_cdate text NOT NULL,
	user_ddate text NOT NULL,
	user_status text NOT NULL,
	user_cat text NOT NULL,
 PRIMARY KEY  (pay_id)) ENGINE=MyISAM;",

);

$eplug_link      = TRUE;
$eplug_link_name = "Payments";
$eplug_link_url  = e_PLUGIN."aacgc_paytrack/PayTrack.php";

$eplug_prefs = array(
"aacgcpt_pagetitle" => "Payment Tracker",
"aacgcpt_header" => "Header Section",
"aacgcpt_intro" => "Intro Section",
"aacgcpt_dformat" => "M d, Y",
"aacgcpt_toffset" => "+2",
"aacgcpt_addclass" => "none",
"aacgcpt_viewclass" => "all",
"aacgcpt_csymbol" => "$",
"aacgcpt_enable_theme" => "1",
);

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";


//---# Upgrade #----------+

$upgrade_table_names = "";
$upgrade_alter_tables =  "";
$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
