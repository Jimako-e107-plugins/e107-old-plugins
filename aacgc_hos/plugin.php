<?php

/*
#######################################
#     e107 website system plguin      
#     AACGC HOS
#     by M@CH!N3 
#     http://www.AACGC.com       
#######################################
*/



$eplug_name = "AACGC Hall of Shame";
$eplug_version = "1.8";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "aacgc_hos";

$eplug_menu_name   = "AACGC_HOS";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_hos/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_hos/images/icon_16.png";
$eplug_caption     = "AACGC Hall of Shame";  

$eplug_table_names = array("aacgc_hos");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_hos(hos_id int(11) NOT NULL auto_increment,game_name varchar(50) NOT NULL,ip text NOT NULL,info text NOT NULL,reason text NOT NULL,date text NOT NULL,img_link text NOT NULL,ext_link text NOT NULL, PRIMARY KEY  (hos_id)) ENGINE=MyISAM;");


$eplug_link      = TRUE;
$eplug_link_name = "Hall of Shame";
$eplug_link_url  = e_PLUGIN."aacgc_hos/HOS.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";


$upgrade_table_names = "";
$upgrade_alter_tables =  "";
$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
