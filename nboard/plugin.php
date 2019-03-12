<?php
//============================= Notice-Board v4.0 ===============================
//	author: ComPolyS team, http://e107.compolys.ru, sunout@compolys.ru		
//	coders: Sunout, Geo						
//	language officer Georgy Pyankov
//	license GNU GPL									
//================================== Deсember 2011 =============================
if (!defined('e107_INIT')) { exit; }
//----------------------------------
	$month = date("m");
	$day = date("d");
	$year = date("y");
	$today = mktime(0,0,0,$month,$day,$year);
	$today30 = mktime(0,0,0,$month,$day+30,$year);
// ----------------------------------------Plugin info------------------------------
$lan_file = e_PLUGIN."nboard/languages/".e_LANGUAGE.".php";
include_once((file_exists($lan_file) ? $lan_file : e_PLUGIN."nboard/languages/English.php"));
$eplug_name = NB_INFO;					// Name Plugin
$eplug_version = "v4.0";				// Version plugin
$eplug_author = "ComPolyS team";			// Author
$eplug_url = NB_AUTHOR_SITE;				// Web address author and supprot
$eplug_email = NB_AUTHOR_MAIL;				// Mail author
$eplug_description = NB_ABOUT;				// About plugin
$eplug_compatible = "v7";				// Version e107
$eplug_readme = "doc/readme.pdf";			// Leave blank if no readme file
$eplug_folder = "nboard";				// Name of the plugin's folder
$eplug_menu_name = NB_INFO; 				// Mane of menu item for plugin
$eplug_conffile = "admin_config.php"; 			// Name of the admin configuration file
$eplug_logo = "theme/icon_32.png";			// Logo plugin
$eplug_icon = $eplug_folder."/theme/icon_32.png";	// Icon image and caption text
$eplug_icon_small = $eplug_folder."/theme/icon_16.png"; // Logo plugin
$eplug_caption = NB_EDIT;				// Create a link in edit menu
$eplug_link = True;					// Create a link in main menu (yes=TRUE, no=FALSE)
$eplug_link_name = NB_INFO;				// Link name
$eplug_link_url = e_PLUGIN."nboard/nboard.php";		// Start file of plugin
$eplug_done = NB_INSTALL; 				// Text to display after plugin successfully installed
$eplug_prefs = array(); 				// List of preferences
$eplug_table_names = array("nb_gnl","nb_cat","nb_ban"); // List of table names
$eplug_prefs = array(
    "nb_folder" => "nboard",
    "nb_admail" => "user@e-mail",
    "nb_days" => "30",
    "nb_prolong" => "15",
    "nb_dateformat" => "%d.%m.%Y",
    "nb_sizepicbig" => "600",
    "nb_sizepicsmall" => "200",
    "nb_showcols" => "2",
    "nb_showrows" => "40",
    "nb_check_que" => NB_EX_CONF_01,
    "nb_check_ans" => NB_EX_CONF_02,
    "nb_comments" => NB_SEL_YES
    );
$eplug_tables = array( // List of sql requests to create tables
//=============== table Notice-Board General =====================//
"create table ".MPREFIX."nb_gnl (
gnl_id int auto_increment not null,
gnl_scatid varchar(10),
gnl_name varchar(100),
gnl_city varchar(100),
gnl_pic1 varchar(250),
gnl_pic2 varchar(250),
gnl_pic3 varchar(250),
gnl_pic4 varchar(250),
gnl_detail blob,
gnl_price varchar(10),
gnl_user varchar(50),
gnl_phone varchar(30),
gnl_email varchar(40),
gnl_date_start varchar(250),
gnl_date_end varchar(250),
gnl_counter varchar(40),
primary key(gnl_id)
) TYPE=MyISAM;",
//=============== table Notice-Board Category ====================//
"create table ".MPREFIX."nb_cat (
cat_id int auto_increment not null,
cat_sub_id varchar(50),
cat_name varchar(100),
cat_desc varchar(100),
cat_icon varchar(50),
primary key(cat_id)
) TYPE=MyISAM;",
//=============== table Notice-Board Banners ======================//
"create table ".MPREFIX."nb_ban (
ban_id int auto_increment not null,
ban_catid varchar(10),
ban_org varchar(100),
ban_url varchar(100),
ban_datebegin varchar(50),
ban_dateend varchar(50),
ban_images varchar(100),
primary key(ban_id)
) TYPE=MyISAM;"

,
//=============== table Notice-Board Example ======================//
"INSERT INTO ".MPREFIX."nb_cat VALUES (1,'0','".NB_EX_CAT_01."','".NB_EX_CATDESC_01."','auto.gif')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (2,'0','".NB_EX_CAT_02."','".NB_EX_CATDESC_02."','building.gif')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (3,'0','".NB_EX_CAT_03."','".NB_EX_CATDESC_03."','comp.gif')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (4,'0','".NB_EX_CAT_04."','".NB_EX_CATDESC_04."','people.gif')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (5,'1','".NB_EX_CAT_05."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (6,'1','".NB_EX_CAT_06."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (7,'1','".NB_EX_CAT_07."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (8,'1','".NB_EX_CAT_08."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (9,'2','".NB_EX_CAT_05."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (10,'2','".NB_EX_CAT_06."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (11,'2','".NB_EX_CAT_07."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (12,'2','".NB_EX_CAT_08."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (13,'3','".NB_EX_CAT_05."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (14,'3','".NB_EX_CAT_06."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (15,'3','".NB_EX_CAT_07."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (16,'3','".NB_EX_CAT_08."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (17,'4','".NB_EX_CAT_09."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (18,'4','".NB_EX_CAT_10."','','users.png')",
"INSERT INTO ".MPREFIX."nb_cat VALUES (19,'4','".NB_EX_CAT_11."','','users.png')",
"INSERT INTO ".MPREFIX."nb_ban VALUES (1,'all_pages','ComPolyS','http://e107.compolys.ru','$today','$today30','banner_e107_compolys.png')"

);

// upgrading ...
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
//array("ALTER TABLE `".MPREFIX."mycconf` ADD `adlength` VARCHAR(250);", "ALTER TABLE `".MPREFIX."mycads` ADD `pdate` VARCHAR(250);");
//-----------new fields
// conf_daysprolong
// gnl_counter
$eplug_upgrade_done = "";
?>