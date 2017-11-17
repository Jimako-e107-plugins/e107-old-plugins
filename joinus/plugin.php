<?php
/*
+ -----------------------------------------------------------------+
| e107: Join Us 1.01                                                |
| ===========================                                      |
|                                                                  |
| Copyright (c) 2011 Untergang                                     |
| http://www.udesigns.be/                                          |
|                                                                  |
| This file may not be redistributed in whole or significant part. |
+------------------------------------------------------------------+
*/


if (!defined('e107_INIT')) { exit; }

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'Join Us';
$eplug_version = '1.01';
$eplug_author = 'Untergang';
$eplug_url = 'http://www.udesigns.be';
$eplug_email = '';
$eplug_description = 'Users can fill in an application for your clan.';
$eplug_compatible = 'e107v0.7+';
$eplug_readme = '';

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "joinus";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "joinus";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/joinus_32.png";
$eplug_icon_small = $eplug_folder."/images/joinus_16.png";
$eplug_caption = 'Clan Applications';

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(

 );

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("clan_applications",
							"clan_joinus_config");	

// List of sql requests to create tables -----------------------------------------------------------------------------

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."clan_applications (
	aid INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	username VARCHAR( 25 ) NOT NULL ,
	email VARCHAR( 50 ) NOT NULL ,
	xfire VARCHAR (50) NOT NULL,
	steam VARCHAR (50) NOT NULL,
	msn VARCHAR( 50 ) NOT NULL ,
	age INT( 3 ) NOT NULL ,
	clans VARCHAR( 30 ) NOT NULL ,
	location VARCHAR( 50 ) NOT NULL ,
	apply VARCHAR( 25 ) NOT NULL ,
	conn VARCHAR( 25 ) NOT NULL ,
	micro INT( 1 ) NOT NULL ,
	extra TEXT NOT NULL,
	date INT( 15 ) NOT NULL)",
"CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_joinus_config (
	  version varchar(10) NOT NULL,
	  mailto varchar(25) DEFAULT NULL,
	  sendmail tinyint(1) NOT NULL DEFAULT '0',
	  mustregister tinyint(1) NOT NULL DEFAULT '1',
	  linkmembers tinyint(1) NOT NULL DEFAULT '0',
	  postthread tinyint(1) NOT NULL DEFAULT '0',
	  postin int(11) NOT NULL,
	  threadtitle varchar(50) NOT NULL DEFAULT '(username) Application',
	  jointext text NOT NULL)",
"INSERT INTO ".MPREFIX."clan_joinus_config (version) VALUES ('1.01')");	
	
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Join Us";
$eplug_link_url = e_PLUGIN.'joinus/joinus.php';

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = 'Your join us form is now installed';

$eplug_upgrade_done = 'Join Us successfully upgraded, now using version: '.$eplug_version;

$upgrade_alter_tables = array(
"ALTER TABLE ".MPREFIX."clan_joinus_config ADD postthread TINYINT (1) NOT NULL DEFAULT '0' AFTER linkmembers ,
 ADD postin INT (11) NOT NULL AFTER postthread ,
 ADD threadtitle VARCHAR (50) NOT NULL DEFAULT '(username) Application' AFTER postin",
 "UPDATE ".MPREFIX."clan_joinus_config SET version='1.01'"
);

/*if (!function_exists('clanwars_uninstall')) {
	function forum_uninstall() {
		global $sql;
		$sql -> db_Update("user", "user_forums='0'");
	}
}

if (!function_exists('forum_install')) {
	function forum_install() {
		global $sql;
		$sql -> db_Update("user", "user_forums='0'");
	}
}*/

?>