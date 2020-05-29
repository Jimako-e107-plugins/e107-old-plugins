<?php
/*
+---------------------------------------------------------------+
|        EMS v1.0 - by iNfLuX (influx604@gmail.com)
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

// Plugin info -------------------------------------------------------------------------------------------------------
$lan_file = e_PLUGIN."ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."ems/English.php");
$eplug_name = EMS_PLUGNAME;
$eplug_version = EMS_VERS;
$eplug_author = EMS_AUTOR;
$eplug_url = EMS_URL;
$eplug_email = EMS_MAIL;
$eplug_description = EMS_DESC;
$eplug_compatible = "e107v7+";
$eplug_readme = "";
// leave blank if no readme file
$eplug_compliant = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "ems";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "ems_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/ems_32.png";
$eplug_icon_small = $eplug_folder."/images/ems_16.png";
$eplug_caption = PAGE_NAME_EMS_P1;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
"ems_srchfrm" => 1,
"ems_usr" => 1,
"ems_loc" => 1,
"ems_gend" => 1,
"ems_photo" => 1,
"ems_locfn" => "location",
"ems_gendfn" => "gender",
"ems_dat" => 1,
"ems_datum1" => "my_data1",
"ems_datum2" => "my_data2",
"ems_datumMin" => 1980,
"ems_datumMax" => 2009,
"ems_datumMax" => 2009,
"ems_cols" => 3,
"ems_rows" => 15,
"ems_cOr" => 1,
"ems_email" => 1
);

// List of table names -----------------------------------------------------------------------------------------------
//$eplug_table_names = array();


// List of sql requests to create tables -----------------------------------------------------------------------------
//$eplug_tables = array();


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = PAGE_NAME_EMS_P1;
$eplug_link_url = e_PLUGIN."ems/ems.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = EMS_INSTALL_DONE_P2;


// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>