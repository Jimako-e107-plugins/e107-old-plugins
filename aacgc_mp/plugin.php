<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Meeting Planner           #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



$eplug_name = "AACGC Meeting Planner";
$eplug_version = "1.4";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Create meetings or events for users to attend and allow userclasses to signup for planned meetings or events.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = FALSE;


$eplug_folder      = "aacgc_mp";

$eplug_menu_name   = "AACGC_Meeting_Planner";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_mp/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_mp/images/icon_16.png";
$eplug_icon_large  = e_PLUGIN."aacgc_mp/images/icon_64.png";
$eplug_caption     = "AACGC Meeting Planner";  

$eplug_table_names = array("aacgc_mp_meetings", "aacgc_mp_cat", "aacgc_mp_members");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_mp_meetings(
	meet_id int(11) NOT NULL auto_increment,
	meet_title varchar(50) NOT NULL,
	meet_det text NOT NULL,
	meet_subj text NOT NULL,
	meet_sdate text NOT NULL,
	meet_edate text NOT NULL,
	meet_status text NOT NULL,
	meet_repeat text NOT NULL,
	meet_class text NOT NULL,
	meet_cat text NOT NULL,
  PRIMARY KEY  (meet_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_mp_cat(
	cat_id int(11) NOT NULL auto_increment,
	cat_title varchar(50) NOT NULL,
	cat_det text NOT NULL,
	cat_order text NOT NULL,
  PRIMARY KEY  (cat_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_mp_members(
	id int(11) NOT NULL auto_increment,
	user_id varchar(11) NOT NULL,
	user_meet text NOT NULL,
	user_choice text NOT NULL,
	user_det text NOT NULL,
 PRIMARY KEY  (id)) ENGINE=MyISAM;",

);

$eplug_link      = TRUE;
$eplug_link_name = "Planner";
$eplug_link_url  = e_PLUGIN."aacgc_mp/Planner.php";

$eplug_prefs = array(
"aacgcmp_pagetitle" => "Meeting Planner",
"aacgcmp_header" => "Header",
"aacgcmp_intro" => "Intro",
"aacgcmp_dformat" => "M d, h:ia",
"aacgcmp_toffset" => "+2",
"aacgcmp_addclass" => "none",
"aacgcmp_closetime" => "1",
"aacgcmp_hoursperweek" => "167",
"aacgcmp_hourspermonth" => "743",
"aacgcmp_enable_theme" => "1",
"aacgcmp_enable_staticon" => "1",
"aacgcmp_enable_menustats" => "1",
"aacgcmp_menutitle" => "Meeting Planner",
"aacgcmp_menuheight" => "auto",
"aacgcmp_menulimit" => "0",
);

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";


//---# Upgrade #----------+

$upgrade_table_names = "";
$upgrade_alter_tables =  "";
$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
