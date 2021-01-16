<?php

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "e_version2";
$eplug_version = "1.1.0";
$eplug_author = "Barry";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = "Current Version Checker for Plugins";
$eplug_compatible = "e107 v0.7 only";
$eplug_readme = "readme.pdf"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "e_version";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "e_version";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon.gif";
$eplug_caption = "Configure e Version";
$eplug_icon_small = $eplug_folder . "/images/icon_16.gif";
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array("eversion_url" => "your url",
"eversion_read"=>254,
"eversion_inmenu"=>5,
"eversion_noplug"=>10,
"eversion_usedownloads"=>1,
"eversion_usebugs"=>1,
"eversion_useforums"=>1,
"eversion_dformat"=>"d-m-Y");
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("eversion");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("CREATE TABLE " . MPREFIX . "eversion (
  eversion_id int(10) unsigned NOT NULL auto_increment,
  eversion_name varchar(50) default '',
  eversion_title varchar(100) default '',
  eversion_major int(10) unsigned not null default '0',
  eversion_minor int(10) unsigned not null default '0',
  eversion_beta int(10) unsigned not null default '0',
  eversion_date int(10) unsigned not null default '0',
  eversion_author varchar(100) default '',
  eversion_revisions text NOT NULL,
  eversion_comments text not null,
  eversion_dlpath varchar(200) default '',
  eversion_updated int(10) unsigned not null default '0',
  eversion_category int(10) unsigned not null default '0',
  eversion_support varchar(200) default '',
  eversion_icon varchar(50) default '',
  eversion_bugtrack varchar(200) default '',
  PRIMARY KEY  (eversion_id)
) TYPE=MyISAM;");
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Plugin Updates";
$eplug_link_url = e_PLUGIN . "e_version/eversion.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "The e_Version plugin is installed. Now Configure it.";

$eplug_upgrade_done = "";
$upgrade_alter_tables = "";

?>