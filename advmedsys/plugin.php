<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3, 1.4 by garyt  #
#######################################
*/

$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");
require_once(e_PLUGIN."advmedsys/advmedsys_ver.php");

$eplug_name = AMS_PLGIN_S1;
$eplug_version = AMS_VER_S1;
$eplug_author = AMS_VER_S2;
$eplug_url = AMS_VER_S3;
$eplug_email = AMS_VER_S4;
$eplug_description = AMS_PLGIN_S2;
$eplug_compatible = AMS_VER_S5;
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "advmedsys";

$eplug_menu_name   = AMS_PLGIN_S5;

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "logo.png";
$eplug_icon        = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small  = $eplug_folder . "/images/icon_16.png";
$eplug_caption     = AMS_PLGIN_S3;  

$eplug_table_names = array("advmedsys_medals", "advmedsys_awarded");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."advmedsys_medals(medal_id int(11) NOT NULL auto_increment,medal_name varchar(50) NOT NULL,medal_pic varchar(120) NOT NULL,medal_txt text NOT NULL,PRIMARY KEY  (medal_id)) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."advmedsys_awarded(awarded_id int(11) NOT NULL auto_increment,awarded_medal_id int(11) NOT NULL,awarded_user_id varchar(11) NOT NULL,awarded_date text NOT NULL,PRIMARY KEY  (awarded_id)) TYPE=MyISAM;");

$eplug_link      = TRUE;
$eplug_link_name = AMS_PLGIN_S6;
$eplug_link_url  = e_PLUGIN."advmedsys/advmedsys_view.php";

$eplug_done = AMS_PLGIN_S4;
$eplug_upgrade_done = AMS_PLGIN_S7;

$upgrade_alter_tables = "";
$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
