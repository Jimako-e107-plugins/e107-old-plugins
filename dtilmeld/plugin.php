<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: http://www.dtilmeld.com $
|     
|     All Support entries should be asked directly to DTilmeld.com at our website: https://www.dtilmeld.com
|     All support questions will be answered within 24 hours.
|     
|     $Author: DTilmeld $
+----------------------------------------------------------------------------+
*/


if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."dtilmeld/languages/".e_LANGUAGE.".php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'DTENR_01';
$eplug_version = "1.0";
$eplug_author = "Mathias Gajhede (MAG)";
$eplug_url = "http://www.dtilmeld.com/Support/PublicDownloads/3/";
$eplug_email = "support@dtilmeld.dk";
$eplug_description = DTENR_02;
$eplug_compatible = "e107v0.7+";
$eplug_readme = "";

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "dtilmeld";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";


// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/dtilmeld_32.png";
$eplug_icon_small = $eplug_folder."/images/dtilmeld_16.png";
$eplug_caption = DTENR_03;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array("dt_active" => 1);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("dtilmeld");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."dte_events (
  `LocalEventID` smallint(5) NOT NULL AUTO_INCREMENT,
  `DTEventID` smallint(5) NOT NULL,
  `api_key` varchar(64) NOT NULL,
  `md5key` varchar(32) NOT NULL,
  `Success` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`LocalEventID`)
) ENGINE=InnoDB;");

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Event Registration";
$eplug_link_url = e_PLUGIN.'dtilmeld/dtilmeld.php';

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = DTENR_04; // "To activate please go to your menus screen and select the pm_menu into one of your menu areas.";

?>