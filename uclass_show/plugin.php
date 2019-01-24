<?php
/*
+---------------------------------------------------------------+
|	e107 website system
|
|	©Steve Dunstan 2001-2005
|	http://e107.org
|	jalist@e107.org
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
|
|
|   uclass_show plugin  ver. 1.02 - 20 nov 2012 rev. 12 nov 2012 09.42
|   by Alf - http://www.e107works.org
|   Released under the terms and conditions of the
|   Creative Commons "Attribution-Noncommercial-Share Alike 3.0"
|   http://creativecommons.org/licenses/by-nc-sa/3.0/
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."uclass_show/languages/".e_LANGUAGE.".php");

// Plugin info
$eplug_name = "uclass_show";
$eplug_version = "1.02";
$eplug_author = "Alf";
$eplug_url = "http://www.e107works.org";
$eplug_email = "info@e107works.org";
$eplug_description = UC_SHOW_01;
$eplug_compatible = "e107v1.0+";
$eplug_readme = "admin_readme.php";
$eplug_compliant = true;

// Plugin's folder
$eplug_folder = "uclass_show";

// Admin configuration file
$eplug_conffile = "admin_config.php";

//Plugin menu
//$eplug_menu_name = "uclass_show_menu";

// Icon image and caption text
$eplug_icon = $eplug_folder."/images/uclass_show_32.png";
$eplug_icon_small = $eplug_folder."/images/uclass_show_16.png";
$eplug_caption = UC_SHOW_02;

// Preferences
$eplug_prefs = array(
	'uclass_show_active' => '0',
      'uclass_show_forum' => '0',
      'uclass_show_comment' => '0',
      'uclass_show_profile' => '0',
	'uclass_show_max_images' => '5',
	'uclass_show_hide_guest' => '0',
      'uclass_show_desc' => '0'	
);

//upgrade 1.01 12 nov 12
$upgrade_add_prefs = array (
   "uclass_show_use_custom" => '',
   "uclass_show_use_custom_forum" => '',
   "uclass_show_use_custom_comment" => '',
   "uclass_show_use_custom_user" => ''
   
);

// Table name
$eplug_table_names = array("uclass_show");

// Sql requests to create tables
$eplug_tables = array("

CREATE TABLE ".MPREFIX."uclass_show (
  uc_show_id int(10) unsigned NOT NULL,
  uc_show_name varchar(100) NOT NULL default '',
  uc_show_img varchar(100) NOT NULL default '',
  PRIMARY KEY (uc_show_id)
) ENGINE=MyISAM;"

);

// Main menu link 
$eplug_link = FALSE;

// Plugin successfully installed
$eplug_done = "<img src='".e_PLUGIN."uclass_show/images/installed.png' style='vertical-align:middle' alt=''/>&nbsp;<span style='font-size:16px;'>".UC_SHOW_03."</span>";

// Plugin successfully upgraded
$eplug_upgrade_done = "<img src='".e_PLUGIN."uclass_show/images/installed.png' style='vertical-align:middle' alt=''/>&nbsp;<span style='font-size:16px;'>".UC_SHOW_04."</span>";

?>