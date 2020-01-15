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
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/trackback/plugin.php $
|     $Revision: 12092 $
|     $Id: plugin.php 12092 2011-03-11 18:49:56Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN."trackback/languages/".e_LANGUAGE.".php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Trackback";
$eplug_version = "1.1";
$eplug_author = "jalist";
$eplug_url = "http://e107.org";
$eplug_email = "jalist@e107.org";
$eplug_description = TRACKBACK_L2;
$eplug_compatible = "e107v0.7+";
$eplug_readme = "";
// leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "trackback";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/trackback_32.png";
$eplug_icon_small = $eplug_folder."/images/trackback_16.png";
$eplug_caption = TRACKBACK_L1;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
"trackbackEnabled" => 0,
"trackbackString" => "<span class='smalltext'><b>".TRACKBACK_L11."</b></span>"
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
"trackback");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."trackback (
  trackback_id int(10) unsigned NOT NULL auto_increment,
  trackback_pid int(10) unsigned NOT NULL default '0',
  trackback_title varchar(200) NOT NULL default '',
  trackback_excerpt varchar(250) NOT NULL default '',
  trackback_url varchar(150) NOT NULL default '',
  trackback_blogname varchar(150) NOT NULL default '',
  PRIMARY KEY  (trackback_id),
  KEY trackback_pid (trackback_pid)
) ENGINE=MyISAM;");

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$ec_dir = "";
$eplug_link_url = "";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = TRACKBACK_L3;
$upgrade_alter_tables	= array(
	"ALTER TABLE ".MPREFIX."trackback ADD INDEX (trackback_pid);"
);

?>
