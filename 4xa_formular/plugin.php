<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
|		sorce: ../../e4xa_formular/plugin.php
|
|		For the e107 website system
|		©Steve Dunstan
|		http://e107.org
|		jalist@e107.org
|
|		Released under the terms and conditions of the
|		GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) {exit;}
require_once("constanten.php");
// Plugin info ----------------------------------------------------------------------------------------------------
$lan_file = e_PLUGIN.e4xA_FORM_FOLDER."/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.e4xA_FORM_FOLDER."/languages/German.php");
$eplug_name = LAN_4xA_FORM_01;
$eplug_version = e4xA_FORM_VERSION;
$eplug_author = "***RuSsE***";
$eplug_logo="";
$eplug_url = "";
$eplug_email = "e107@4xa.de";
$eplug_description = LAN_4xA_FORM_02;
$eplug_compatible = "e107v7+";
//$eplug_readme = "admin_readme.php";
// leave blank if no readme file
$eplug_compliant = TRUE;
$eplug_folder = "4xa_formular";
$eplug_menu_name = "4xa_formular";


$eplug_icon_small = $eplug_folder."/images/logo_32.png";
$eplug_caption =  "?!?!";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "4xa_formular";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_kategorien.php";
// Icon image and caption text -----------------------------------------------------------------------------------
$eplug_icon = e4xA_FORM_FOLDER."/images/logo_32.png";

// Find current version for upgrade stuff
include_once("../../class2.php");
$MSL_SQL = new db;
$MSL_SQL->db_Select("plugin", "plugin_version", "plugin_name='".$eplug_name."' AND plugin_installflag > 0");
if(list($PluginVers) = $MSL_SQL->db_Fetch()) {
	$PluginVers = preg_replace("/[a-zA-z\s]/", '', $PluginVers);
} else {
	$PluginVers = 0;
}

// List of preferences -------------------------------------------------------------------------------------------
$eplug_prefs = array(
"e4xA_form_caption" => "",
"e4xA_form_submit_user" => "",
"e4xA_form_emails_send" => "0",
"e4xA_form_emails_text" => "",
"e4xA_form_text" => ""
);
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("e4xA_form_opt", "e4xA_form_kathegories", "e4xA_form_auftrag", "e4xA_form_pos");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE ".MPREFIX."e4xA_form_opt (
  form_opt_id int(10) unsigned NOT NULL auto_increment,
  form_opt_kat_id int(10) unsigned NOT NULL,
  form_opt_iso_name varchar(100) NOT NULL default '',
  form_opt_name varchar(100) NOT NULL default '',
  form_opt_pflicht tinyint(1) NOT NULL default '1',
  form_opt_typ int(10) unsigned NOT NULL,
  form_opt_par text NOT NULL default '',
  form_opt_text text NOT NULL default '',
  form_opt_sort int(10) unsigned NOT NULL default '1',
  form_opt_enable tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (form_opt_id)
) TYPE=MyISAM",

"CREATE TABLE ".MPREFIX."e4xA_form_kathegories (
  form_kat_id int(10) unsigned NOT NULL auto_increment,
  form_kat_name varchar(100) NOT NULL default '',
  form_kat_caption varchar(200) NOT NULL default '',
  form_kat_enable tinyint(1) NOT NULL default '1',
  form_kat_desc text NOT NULL default '',
  form_kat_mail tinyint(1) NOT NULL default '1',
  form_kat_mail_adress varchar(255) NOT NULL default '',
  form_kat_mail_desc text NOT NULL default '',
  form_kat_submit_user int(10) unsigned NOT NULL,
  form_kat_certific tinyint(1) NOT NULL default '1',
  form_kat_admin tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (form_kat_id)
) TYPE=MyISAM",

"CREATE TABLE ".MPREFIX."e4xA_form_auftrag (
  form_auftrag_id int(10) unsigned NOT NULL auto_increment,
  form_auftrag_uid int(10) unsigned NOT NULL,
  form_auftrag_data varchar(12) default NULL,
  form_auftrag_akt_data varchar(12) default NULL,
  form_auftrag_kf1 tinyint(1) NOT NULL default '1',
  form_auftrag_kf2 tinyint(1) NOT NULL default '1',
  form_auftrag_kf3 tinyint(1) NOT NULL default '1',
  form_auftrag_kf4 tinyint(1) NOT NULL default '1',
  form_auftrag_enable tinyint(1) NOT NULL default '1',
  form_auftrag_form_id int(10) unsigned NOT NULL,
  PRIMARY KEY  (form_auftrag_id)
) TYPE=MyISAM",

"CREATE TABLE ".MPREFIX."e4xA_form_pos(
  form_pos_id int(10) unsigned NOT NULL auto_increment,
  form_pos_auftrag_id int(10) unsigned NOT NULL,
  form_pos_opt_id int(10) unsigned NOT NULL,
  form_pos_opt_value text NOT NULL default '',
  PRIMARY KEY  (form_pos_id)
) TYPE=MyISAM");

// List of sql requests to create tables ----------------------------------------------------------------------
//$eplug_tables = array();


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = LAN_4xA_FORM_01;
$eplug_link_url = e_PLUGIN.e4xA_FORM_FOLDER."/formular.php";


// Text to display after plugin successfully installed --------------------------------------------------------
$eplug_done = "Installation war erfolgreich";


// upgrading ... //

if ($PluginVers < 0.7) {
	// example for add. values:
  $upgrade_alter_tables = array();
   $gbtemp = array(
   	  "ALTER TABLE ".MPREFIX."e4xA_form_opt ADD form_opt_pflicht tinyint(1) NOT NULL default '1' AFTER form_opt_name;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $gbtemp);
}
if ($PluginVers < 0.9) {
	// example for add. values:
  $upgrade_alter_tables = array();
   $gbtemp = array(
   	  "ALTER TABLE ".MPREFIX."e4xA_form_kathegories ADD form_kat_mail_adress varchar(255) NOT NULL default '' AFTER form_kat_mail;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $gbtemp);
}

if ($PluginVers < "0.9d") {
	// example for add. values:
  $upgrade_alter_tables = array();
   $gbtemp = array(
   	  "ALTER TABLE ".MPREFIX."e4xA_form_kathegories ADD form_kat_certific tinyint(1) NOT NULL default '1' AFTER form_kat_submit_user;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $gbtemp);
}

if ($PluginVers < "0.9f") {
	// example for add. values:
  $upgrade_alter_tables = array();
   $gbtemp = array(
   	  "ALTER TABLE ".MPREFIX."e4xA_form_kathegories ADD form_kat_admin tinyint(1) NOT NULL default '1' AFTER form_kat_certific;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $gbtemp);
}
$eplug_upgrade_done = $eplug_name.LAN_INSTALL_3.$PluginVers.LAN_INSTALL_4.$eplug_version.LAN_INSTALL_5;

?>