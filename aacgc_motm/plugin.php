<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Member Of the Month       #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



$eplug_name = "AACGC MOTM";
$eplug_version = "2.9";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Select a member of your clan/community as Member of the month and it will be displayed on a menu. Page included that shows all previouse members of the month. Gold Orbs supported";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "aacgc_motm";

$eplug_menu_name   = "AACGC_MOTM";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "logo.png";
$eplug_icon        = e_PLUGIN."aacgc_motm/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_motm/images/icon_16.png";
$eplug_caption     = "AACGC MOTM";  

$eplug_table_names = array("aacgc_motm");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_motm(motm_id int(11) NOT NULL auto_increment,motm_user varchar(50) NOT NULL,month text NOT NULL,year text NOT NULL,PRIMARY KEY  (motm_id)) TYPE=MyISAM;");


$eplug_link      = TRUE;
$eplug_link_name = "MOTM List";
$eplug_link_url  = e_PLUGIN."aacgc_motm/MOTM_List.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";

$upgrade_alter_tables = "";
$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
