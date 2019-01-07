<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Event Countdowns          #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


$eplug_name = "AACGC Event Countdowns";
$eplug_version = "1.4";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Countdown timers to events of your choice..";
$eplug_compatible = "e107 v7+";
$eplug_readme = "";
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

$eplug_folder = "aacgc_eventcountdowns";

$eplug_menu_name = "AACGC Event Countdowns";

$eplug_conffile = "admin_main.php";

$eplug_icon = $eplug_folder . "/images/icon_32.png";
$eplug_icon_small = $eplug_folder . "/images/icon_16.png";
$eplug_icon_large = "".e_PLUGIN."aacgc_eventcountdowns/images/icon_64.png";

$eplug_caption = "AACGC Event Countdowns";

$eplug_prefs = array(
"ecds_menutitle" => "Event Countdowns",
"ecds_pagetitle" => "Event Countdowns",
"ecds_theme" => "1",
"ecds_header" => "",
"ecds_menuheight" => "auto",
"ecds_maxevents" => "3",
"ecds_dateoffset" => "0",
"ecds_dateformat" => "l, F dS, Y - g:ia",
"ecds_showfuturemenu" => "1",
"ecds_showfuturepage" => "1",
"ecds_countersize" => "12",
"ecds_countercolor" => "white",
);

$eplug_table_names = array("aacgc_eventcountdowns");

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."aacgc_eventcountdowns(ecds_id int(11) NOT NULL auto_increment,ecds_title text NOT NULL,ecds_detail text NOT NULL,ecds_date int(128) NOT NULL,ecds_tzone text NOT NULL, PRIMARY KEY  (ecds_id)) ENGINE=MyISAM;",
);

$eplug_link = true;
$eplug_link_name = "Events";
$eplug_link_url = e_PLUGIN."aacgc_eventcountdowns/Events.php";

$eplug_done = "The plugin is now installed.";

$upgrade_alter_tables = "";
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$eplug_upgrade_done = "Upgrade Complete";


?>	

