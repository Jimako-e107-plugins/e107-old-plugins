<?php
/*
+ -----------------------------------------------------------------+
| e107: Challenge Us 1.0                                           |
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
$eplug_name = 'Challenge Us';
$eplug_version = '1.0';
$eplug_author = 'Untergang';
$eplug_url = 'http://www.udesigns.be';
$eplug_email = '';
$eplug_description = 'Users can challenge your clan using this form.';
$eplug_compatible = 'e107v0.7+';
$eplug_readme = '';

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "challengeus";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "challengeus";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/challengeus_32.png";
$eplug_icon_small = $eplug_folder."/images/challengeus_16.png";
$eplug_caption = 'Clan Challenges';

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(

 );

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("clan_challenges",
"clan_challenge_config");	

// List of sql requests to create tables -----------------------------------------------------------------------------

$eplug_tables = array(
"CREATE TABLE ".MPREFIX."clan_challenges (
	cid INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	username VARCHAR( 25 ) NOT NULL ,
	email VARCHAR( 50 ) NOT NULL ,
	msn VARCHAR( 50 ) NOT NULL ,
	xfire VARCHAR( 50 ) NOT NULL ,
	clantag VARCHAR( 15 ) NOT NULL ,
	clanname VARCHAR( 30 ) NOT NULL ,
	clansite VARCHAR( 50 ) NOT NULL ,
	country VARCHAR( 30 ) NOT NULL ,
	chdate INT ( 15 ) NOT NULL ,
	game VARCHAR( 25 ) NOT NULL ,
	map VARCHAR( 25 ) NOT NULL ,
	players INT( 2 ) NOT NULL ,
	ip VARCHAR( 25 ) NOT NULL ,
	pw VARCHAR( 25 ) NOT NULL ,
	extra TEXT NOT NULL ,
date VARCHAR( 10 ) NOT NULL)",
"CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_challenge_config (
	version varchar(10) NOT NULL,
	mailto varchar(25) DEFAULT NULL,
	sendmail tinyint(1) NOT NULL DEFAULT '0',
	mustregister tinyint(1) NOT NULL DEFAULT '1',
	linkwars tinyint(1) NOT NULL DEFAULT '0',
	dateformat VARCHAR (10) NOT NULL DEFAULT 'yyyy/mm/dd')",
"INSERT INTO ".MPREFIX."clan_challenge_config (version) VALUES ('1.0')");	
	
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Challenge Us";
$eplug_link_url = e_PLUGIN.'challengeus/challengeus.php';

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = 'Your join us form is now installed';

/*$eplug_upgrade_done = 'Clan Wars successfully upgraded, now using version: '.$eplug_version;

$upgrade_alter_tables = array(
"ALTER TABLE ".MPREFIX."forum ADD forum_postclass TINYINT( 3 ) UNSIGNED DEFAULT '0' NOT NULL ;"
);
*/
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