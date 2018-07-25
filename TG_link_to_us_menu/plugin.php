<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     Creative Commons License (http://creativecommons.org/licenses/by-nc-nd/2.5/).
|
|     Original Scripts By;
|     Steve Dunstan - http://e107.org - sitebutton_menu
|     doorsoft - http://www.doorsoft.es -  Link Me v1.0
|     
|     Edited and Compiled by;
|     Frederick McAninch - http://e107themersguild.org - TG Link To Us v2.0 CVS
+----------------------------------------------------------------------------+
*/
	
@include_once(e_PLUGIN."TG_link_to_us_menu/languages/admin/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."TG_link_to_us_menu/languages/admin/English.php");
	
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = TGLINKTOUS_MENU_ADTG0;
$eplug_version = "2.0";
$eplug_author = "Frederick McAninch";
$eplug_url = "http://e107themersguild.org";
$eplug_email = "admin@e107themersguild.org";
$eplug_description = TGLINKTOUS_MENU_ADTG1; //"This plugin is a fully featured Link To Us System.";
$eplug_compatible = "e107v7+";
$eplug_readme = "readme.txt";
$eplug_compliant = TRUE;
	
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "TG_link_to_us_menu";
	
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "TG Link To Us";
	
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/img/icon_32.png";
$eplug_icon_small = $eplug_folder."/img/icon_16.png";
$eplug_caption = TGLINKTOUS_MENU_ADTG2;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		"TGLINKTOUS_1" => 1
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("tglinktous");


// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("
CREATE TABLE ".MPREFIX."tglinktous (
  tglinktous_id int(10) unsigned NOT NULL auto_increment,
  tglinktous_inst varchar(100) NOT NULL default '',
  PRIMARY KEY  (tglinktous_id),
  UNIQUE KEY tglinktous_inst (tglinktous_inst)
) TYPE=MyISAM;",
"INSERT INTO ".MPREFIX."tglinktous VALUES (1, 'Installed');");
	
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Link To Us";
$eplug_link_url = "e107_plugins/TG_link_to_us_menu/tglinktous.php";
	
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = TGLINKTOUS_MENU_ADTG3; 
	
?>