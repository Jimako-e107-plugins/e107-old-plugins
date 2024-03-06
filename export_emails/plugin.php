<?php
include_lan(e_PLUGIN . 'export_emails/languages/' . e_LANGUAGE . '.php');
if (!defined('e107_INIT')) { exit; }
$eplug_name = EE_PLUGIN_01;
$eplug_version = "1.0";
$eplug_author = "Lóna Lore";
$eplug_url = "http://lonalore.try.hu";
$eplug_email = "lonalore@freemail.hu";
$eplug_description = EE_PLUGIN_02;
$eplug_compatible = "e107 v0.7.x";
$eplug_readme = "admin/admin_readme.php";
$eplug_folder = "export_emails";
$eplug_menu_name = EE_PLUGIN_01;
$eplug_conffile = "admin/admin_export.php";
$eplug_icon = $eplug_folder . "/images/icon_32x32.gif";
$eplug_icon_small = $eplug_folder . "/images/icon_16x16.gif";
$eplug_logo = $eplug_folder . "/images/icon_32x32.gif";
$eplug_caption =  EE_PLUGIN_01;
$eplug_prefs = "";
$eplug_table_names = array("ee_config");
$eplug_tables = array(
"CREATE TABLE " . MPREFIX . "ee_config (
  ee_id					int(11)			NOT NULL auto_increment,
  ee_export_last		int(10)			unsigned NOT NULL default '0',
  ee_export_type		tinyint(1)		default 0,
  ee_csv_field_end		varchar(10)		default '',
  ee_csv_field_close	varchar(10)		default '',
  ee_csv_field_escape	varchar(10)		default '',
  ee_csv_add_un			tinyint(1)		default 0,
  PRIMARY KEY  (ee_id)
) TYPE=MyISAM;",
"INSERT INTO " . MPREFIX . "ee_config VALUES(1, 0, 2, ';', '&quot;', '&#92;', 0)"
);
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";
$eplug_done = EE_PLUGIN_03;
$eplug_uninstall_done = EE_PLUGIN_04;
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";
?>