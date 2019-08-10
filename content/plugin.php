<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $URL: https://e107.svn.sourceforge.net/svnroot/e107/trunk/e107_0.7/e107_plugins/content/plugin.php $
|     $Revision: 12178 $
|     $Id: plugin.php 12178 2011-05-02 20:45:40Z e107steved $
|     $Author: e107steved $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

global $PLUGINS_DIRECTORY;
include_lan(e_PLUGIN.'content/languages/'.e_LANGUAGE.'/lan_content_admin.php');

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "CONTENT_PLUGIN_LAN_1";
$eplug_version = "1.24";
$eplug_author = "Eric Vanderfeesten (lisa)";
$eplug_logo = "";
$eplug_url = "http://eindhovenseschool.net";
$eplug_email = "lisa@eindhovenseschool.net";
$eplug_description = CONTENT_PLUGIN_LAN_2;
$eplug_compatible = "e107v0.7+";
$eplug_readme = "";        // leave blank if no readme file
$eplug_latest = TRUE; //Show reported threads in admin (use latest.php)
$eplug_status = TRUE; //Show post count in admin (use status.php)

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "content";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_content_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/content_32.png";
$eplug_icon_small = $eplug_folder."/images/content_16.png";
$eplug_caption = CONTENT_PLUGIN_LAN_3;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array();


// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
	"pcontent"
);

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
	"CREATE TABLE ".MPREFIX."pcontent (
	content_id int(10) unsigned NOT NULL auto_increment,
	content_heading varchar(255) NOT NULL default '',
	content_subheading varchar(255) NOT NULL default '',
	content_summary text NOT NULL,
	content_text longtext NOT NULL,
	content_author varchar(255) NOT NULL default '',
	content_icon varchar(255) NOT NULL default '',
	content_file text NOT NULL,
	content_image text NOT NULL,
	content_parent varchar(50) NOT NULL default '',
	content_comment tinyint(1) unsigned NOT NULL default '0',
	content_rate tinyint(1) unsigned NOT NULL default '0',
	content_pe tinyint(1) unsigned NOT NULL default '0',
	content_refer text NOT NULL,
	content_datestamp int(10) unsigned NOT NULL default '0',
	content_enddate int(10) unsigned NOT NULL default '0',
	content_class varchar(255) NOT NULL default '',
	content_pref text NOT NULL,
	content_order varchar(10) NOT NULL default '0',
	content_score tinyint(3) unsigned NOT NULL default '0',
	content_meta text NOT NULL,
	content_layout varchar(255) NOT NULL default '',
	PRIMARY KEY  (content_id)
	) ENGINE=MyISAM;",
	"INSERT INTO ".MPREFIX."pcontent VALUES (1, 'content', '', '', '', '1', '', '', '', '0', '0', '0', '0', '', '".time()."', '0', '0', '', '1', '0', '', '')",
	"INSERT INTO ".MPREFIX."pcontent VALUES (2, 'article', '', '', '', '1', '', '', '', '0', '0', '0', '0', '', '".time()."', '0', '0', '', '2', '0', '', '')",
	"INSERT INTO ".MPREFIX."pcontent VALUES (3, 'review', '', '', '', '1', '', '', '', '0', '0', '0', '0', '', '".time()."', '0', '0', '', '3', '0', '', '')"
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = CONTENT_PLUGIN_LAN_5;
$eplug_link_url = $PLUGINS_DIRECTORY.'content/content.php';
$eplug_link_icon = "";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = CONTENT_PLUGIN_LAN_4;

// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";

$upgrade_alter_tables = array(
"ALTER TABLE ".MPREFIX."pcontent ADD content_score TINYINT ( 3 ) UNSIGNED NOT NULL DEFAULT '0';",
"ALTER TABLE ".MPREFIX."pcontent ADD content_meta TEXT NOT NULL;",
"ALTER TABLE ".MPREFIX."pcontent ADD content_layout VARCHAR ( 255 ) NOT NULL DEFAULT '';",
);
$eplug_upgrade_done = CONTENT_PLUGIN_LAN_6;

?>