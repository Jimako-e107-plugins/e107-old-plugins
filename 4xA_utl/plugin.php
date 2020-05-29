<?php
/*
+---------------------------------------------------------------+
|        4xA-UTL (Users-Team-List or Website-Crew) v0.5 - by ***RuSsE*** (www.e107.4xA.de) 29.09.2009
|					sorce: ../../4xA_utl/plugin.php
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
$lan_file = e_PLUGIN."4xA_utl/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_ems/languages/German.php");
$eplug_name = "4xA-UTL";
$eplug_version = "0.8";
$eplug_author = "***RuSsE***";
$eplug_url = "http://www.e107.4xa.de";
$eplug_email = "e107@4xa.de";
$eplug_description = "Ein Plugin, um die Benutzer die an der Hompage arbeiten ( so genannte Hompage-Crew ) anzuzeigen.";
$eplug_compatible = "e107v7+";
$eplug_readme = "admin_readme.php";
// leave blank if no readme file
$eplug_compliant = TRUE;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "4xA_utl";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/utl_32.png";
$eplug_icon_small = $eplug_folder."/images/utl_16.png";
$eplug_caption = e4xA_UTL_SITE_CAPTION;


$ecalSQL = new db;
$ecalSQL->db_Select("plugin", "plugin_version", "plugin_path='".$eplug_name."' AND plugin_installflag > 0");
list($ecalVer) = $ecalSQL->db_Fetch();
$ecalVer = preg_replace("/[a-zA-z\s]/", '', $ecalVer);


// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
"4xA_utl_acces_class" => 255,
"4xA_utl_colls" => 1,
"4xA_utl_colls" => "fcaption"
);
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("e4xA_utl_data", "e4xA_utl_param");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE ".MPREFIX."e4xA_utl_data (
  e4xA_utl_id int(10) unsigned NOT NULL auto_increment,
  e4xA_utl_user_id  int(10) unsigned NOT NULL,
  e4xA_utl_status int(10) unsigned NOT NULL,
  e4xA_utl_enable tinyint(1) NOT NULL default '1',
  e4xA_utl_para varchar(100) NOT NULL default '',
  e4xA_utl_text text NOT NULL default '',
  e4xA_utl_sort int(10) unsigned NOT NULL,
  PRIMARY KEY  (e4xA_utl_id)
) TYPE=MyISAM",
"CREATE TABLE ".MPREFIX."e4xA_utl_param (
  e4xA_param_id int(10) unsigned NOT NULL auto_increment,
  e4xA_param_name varchar(100) NOT NULL default '',
  e4xA_param_sort int(10) unsigned NOT NULL,
	e4xA_param_img varchar(200) NOT NULL default '',
  PRIMARY KEY  (e4xA_param_id)
) TYPE=MyISAM"
);
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = e4xA_AD_MENU_1;
$eplug_link_url = e_PLUGIN."4xA_utl/site_team.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = e4xA_UTL_INSTALL_DONE;
// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";
//////++++++++++++++++++++++++++++++++++++++++++++++++++
if ($ecalVer < 0.8)
{
/// To version 0.8
$upgrade_alter_tables = array(
	"ALTER TABLE ".MPREFIX."e4xA_utl_param ADD `e4xA_param_img` varchar(200) 		NOT NULL 	default '';"
	);
$upgrade_add_prefs = array(
	"4xA_utl_show" => 1,
	"4xA_utl_show_main" => 1
);	
}

//////++++++++++++++++++++++++++++++++++++++++++++++++++
$eplug_upgrade_done = "Aktualisierung des ".$eplug_name." auf ".$eplug_version." war erfolgreich.";
?>