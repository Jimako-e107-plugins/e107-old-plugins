<?php

/*
#######################################
#     e107 website system plguin      
#     AACGC Attendance List
#     by M@CH!N3 
#     http://www.AACGC.com       
#######################################
*/



$eplug_name = "AACGC Attendance List";
$eplug_version = "3.1";
$eplug_author = "M@CH!N3";
$eplug_url = "http://www.aacgc.com";
$eplug_email = "admin@aacgc.com";
$eplug_description = "Attendance List that shows Events with option for Date, Host, Cost, Location, and an external link that users can post that they are, are not, or might attend. User can edit or delete their responce, option to set autoaccepted userclass and users who can add events.";
$eplug_compatible = "";
$eplug_readme = "";
$eplug_compliant = FALSE;
$eplug_module = FALSE;
$eplug_status = TRUE;
$eplug_latest = TRUE;


$eplug_folder      = "aacgc_event_listing";

$eplug_menu_name   = "AACGC_Attendance_List";

$eplug_conffile    = "admin_main.php";

$eplug_logo        = "";
$eplug_icon        = e_PLUGIN."aacgc_event_listing/images/icon_32.png";
$eplug_icon_small  = e_PLUGIN."aacgc_event_listing/images/icon_16.png";
$eplug_caption     = "AACGC Attendance List";  

$eplug_table_names = array("aacgc_event_listing", "aacgc_event_listing_members", "aacgc_event_listing_request");

$eplug_tables = array(

"CREATE TABLE ".MPREFIX."aacgc_event_listing(event_id int(11) NOT NULL auto_increment,event_name varchar(50) NOT NULL,event_host text NOT NULL,event_locatiom text NOT NULL,event_cost text NOT NULL,event_date text NOT NULL,event_details text NOT NULL,event_link text NOT NULL,event_linktext text NOT NULL,event_open text NOT NULL,  PRIMARY KEY  (event_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_event_listing_members(eventmem_id int(11) NOT NULL auto_increment,event_id int(11) NOT NULL,user_id varchar(11) NOT NULL,user_choice varchar(120) NOT NULL,user_info text NOT NULL, PRIMARY KEY  (eventmem_id)) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."aacgc_event_listing_request(eventreq_id int(11) NOT NULL auto_increment,eventlist_id int(11) NOT NULL,user_id varchar(11) NOT NULL,user_choice varchar(120) NOT NULL,user_info text NOT NULL, PRIMARY KEY  (eventreq_id)) ENGINE=MyISAM;");

$eplug_link      = TRUE;
$eplug_link_name = "Events";
$eplug_link_url  = e_PLUGIN."aacgc_event_listing/Events.php";

$eplug_done = "Install Complete";
$eplug_upgrade_done = "Upgrade Complete";


$upgrade_table_names = "";

$upgrade_alter_tables =  "";


$upgrade_remove_prefs = "";
$upgrade_add_prefs = "";

?>
