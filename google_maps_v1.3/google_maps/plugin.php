<?php
/*

===============================================================
   GOOGLE Maps - v1.3 - by keithschm
   www.keithschmitt.com
keithschm AT GMAIL DOT COM

Map Class from   www.phpinsider.com  ported for use on E107
===============================================================
+---------------------------------------------------------------+
|        e107 website system
|        YourPlugin v3.0 by CaMer0n (www.e107coders.org)
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/

$lan_file = e_PLUGIN."google_maps/languages/admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."google_maps/languages/admin/English.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name =  "Google Maps";
$eplug_version = "1.3";
$eplug_author = "Keith Schmitt";
$eplug_logo = "button.png";
$eplug_url = "http://www.keithschmitt.com";
$eplug_email = "keithschm@gmail.com";
$eplug_description =  "Show locations of your users with Google Maps";
$eplug_compatible = "e107v0.7";
$eplug_readme = "readme.txt";        // leave blank if no readme file
$eplug_compliant = TRUE;
// Name of the plugins folder -------------------------------------------------------------------------------------
$eplug_folder = "google_maps";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "Google Maps";  // _menu is no longer required in 0.7.

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";  // use admin_ for all admin files.

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption =  "Configure your plugin";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		// this stores a default value in the preferences.0 = off , 1= On
);



// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("google_maps,google_maps_geo");


// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("
CREATE TABLE ".MPREFIX."google_maps (
  map_id int(10) unsigned NOT NULL ,
  map_api varchar(100) NULL default '',
  map_class tinyint(2) NOT NULL default '0',
  map_control tinyint(1) default '0',
  map_control_type tinyint(1)  default '0',
  map_type_control tinyint(1)  default '0',
  map_type_default varchar(100) NULL default '',
  map_scale_control tinyint(1) NOT NULL default '0',
  map_overview_control tinyint(1) NOT NULL default '0',
  map_zoom tinyint(3) NOT NULL default '0',
  map_width varchar(100) NULL default '',
  map_height varchar(100) NULL default '',
  map_sidebar tinyint(1) NOT NULL default '0',
  map_infowindow tinyint(1) NOT NULL default '0',
  map_directions tinyint(1) NOT NULL default '0',
  map_email tinyint(1) NOT NULL default '0',
  map_posts tinyint(1) NOT NULL default '0',
  map_member_since tinyint(1) NOT NULL default '0',
  map_lastseen tinyint(1) NOT NULL default '0',
  map_avatar tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (map_id)
) TYPE=MyISAM;",
"INSERT INTO ".MPREFIX."google_maps VALUES (1, 'Your api key',1,1,1,1,1,1,1,16,'500px','500px',1,1,1,1,1,1,1,1);",

"CREATE TABLE ".MPREFIX."google_maps_geo (
 address varchar(255) NOT NULL default '',
  lon float default NULL,
  lat float default NULL,
  PRIMARY KEY  (address)
) TYPE=MyISAM;"
);


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Google Maps";
$eplug_link_url = "e107_plugins/google_maps/google_maps.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Installation Successful..";







?>
