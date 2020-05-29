<?php
/*
+---------------------------------------------------------------+
|        4xA-EMS v0.7 - by ***RuSsE*** (www.e107.4xA.de) 29.10.2009
|	 sorce: ../../4xA_ems/plugin.php
| 	 Original- Idee stamm von EMS-Plugin version 1.0 trunk of iNfLuX (influx604@gmail.com)
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

// Plugin info -------------------------------------------------------------------------------------------------------
$lan_file = e_PLUGIN."4xA_ems/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_ems/languages/German.php");
$eplug_name = "4xA-EMS";
$eplug_version = "0.7";
$eplug_author = "***RuSsE***";
$eplug_url = "";
$eplug_email = "e107@4xa.de";
$eplug_description = e4xA_EMS_DESC;
$eplug_compatible = "e107v7+";
$eplug_readme = "admin_readme.php";
// leave blank if no readme file
$eplug_compliant = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "4xA_ems";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "4xA_ems_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/ems_32.png";
$eplug_icon_small = $eplug_folder."/images/ems_16.png";
$eplug_caption = PAGE_NAME_EMS_P1;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
"4xA_ems_UL" => 1,
"4xA_ems_BN" => 1,
"4xA_ems_UI" => 1,
"4xA_ems_UF" => 1,
"4xA_ems_OS" => 1,
"4xA_ems_UL_S" => 1,
"4xA_ems_BN_S" => 2,
"4xA_ems_UI_S" => 3,
"4xA_ems_UF_S" => 4,
"4xA_ems_UF_S" => 5,
"4xA_ems_UL_N" => "",
"4xA_ems_BN_N" => "",
"4xA_ems_UI_N" => "",
"4xA_ems_UF_N" => "",
"4xA_ems_UF_N" => "",
"4xA_ems_ausgabe"=>1,
"4xA_ems_rows"=>10,
"4xA_ems_cels"=>2,
"4xA_ems_acces_class"=>255,
"4xA_ems_burt_field" => "",
"4xA_ems_gen_field" => ""
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("e4xA_ems_fields");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE ".MPREFIX."e4xA_ems_fields (
  e4xA_ems_id int(10) unsigned NOT NULL auto_increment,
  e4xA_ems_field_name varchar(100) NOT NULL default '',
  e4xA_ems_field_text varchar(100) NOT NULL default '',
  e4xA_ems_enable tinyint(1) NOT NULL default '1',
  e4xA_ems_para varchar(100) NOT NULL default '',
  e4xA_ems_sort int(10) unsigned NOT NULL,
  PRIMARY KEY  (e4xA_ems_id)
) TYPE=MyISAM");

// List of sql requests to create tables -----------------------------------------------------------------------------
//$eplug_tables = array();


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = e4xA_PAGE_LINK_NAME;
$eplug_link_url = e_PLUGIN."4xA_ems/ems.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = e4xA_EMS_INSTALL_DONE;


// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>