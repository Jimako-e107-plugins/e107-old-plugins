<?php
/*
+ -----------------------------------------------------------------+
| e107: Clan Wars 1.0                                              |
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
$eplug_name = 'Clan Wars';
$eplug_version = '1.0';
$eplug_author = 'Untergang';
$eplug_url = 'http://www.udesigns.be';
$eplug_email = '';
$eplug_description = 'This is a plugin for keeping track of your wars/matches that your have played or are about to play.';
$eplug_compatible = 'e107v0.7+';
$eplug_readme = '';

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "clanwars";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "clanwars";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/clanwars_32.png";
$eplug_icon_small = $eplug_folder."/images/clanwars_16.png";
$eplug_caption = 'Configure Clan Wars';

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(

 );

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("clan_wars",
					"clan_wars_comments",
					"clan_wars_config",
					"clan_wars_lineup",
					"clan_wars_mail",
					"clan_wars_maps",
					"clan_wars_screens");	

// List of sql requests to create tables -----------------------------------------------------------------------------

$eplug_tables = array("CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars (
	  wid int(11) NOT NULL AUTO_INCREMENT,
	  status int(1) NOT NULL DEFAULT '1',
	  game int(3) DEFAULT NULL,
	  wardate int(15) NOT NULL,
	  team int(11) NOT NULL DEFAULT '1',
	  opp_tag varchar(25) NOT NULL DEFAULT '',
	  opp_name varchar(50) DEFAULT '',
	  opp_url varchar(100) DEFAULT NULL,
	  opp_country varchar(50) DEFAULT NULL,
	  style varchar(20) DEFAULT NULL,
	  players int(2) DEFAULT NULL,
	  our_score int(4) DEFAULT '0',
	  opp_score int(4) DEFAULT '0',
	  serverip varchar(25) DEFAULT NULL,
	  serverpass varchar(25) DEFAULT NULL,
	  report text,
	  report_url varchar(100) DEFAULT NULL,
	  wholineup tinyint(1) NOT NULL DEFAULT '0',
	  active tinyint(1) NOT NULL DEFAULT '0',
	  lastupdate int(15) NOT NULL DEFAULT '0',
	  addedby varchar(25) NOT NULL,
	  PRIMARY KEY (wid))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars_comments (
	  cid int(11) NOT NULL AUTO_INCREMENT,
	  wid varchar(11) NOT NULL,
	  poster int(11) NOT NULL,
	  comment text NOT NULL,
	  postdate int(15) NOT NULL,
	  PRIMARY KEY (cid))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars_config (
	  version varchar(10) NOT NULL,
	  lastclean int(15) NOT NULL,
	  rowsperpage int(3) NOT NULL DEFAULT '30',
	  dateformat varchar(10) NOT NULL DEFAULT 'dd/mm/yyyy',
	  formatlist varchar(20) NOT NULL DEFAULT 'j M Y',
	  formatdetails varchar(20) NOT NULL DEFAULT 'j M Y H:i',
	  formatblock varchar(20) NOT NULL DEFAULT 'j/m',
	  enablecomments tinyint(1) NOT NULL DEFAULT '1',
	  guestcomments tinyint(1) NOT NULL DEFAULT '1',
	  screensperrow tinyint(2) NOT NULL DEFAULT '2',
	  screenmaxsize int(15) NOT NULL DEFAULT '512000',
	  resizescreens tinyint(1) NOT NULL DEFAULT '1',
	  createthumbs tinyint(1) NOT NULL DEFAULT '1',
	  resizedwidth int(4) NOT NULL DEFAULT '1024',
	  thumbwidth int(3) NOT NULL DEFAULT '165',
	  enablelineup tinyint(1) NOT NULL DEFAULT '1',
	  guestlineup tinyint(1) NOT NULL DEFAULT '1',
	  tablename varchar(100) NOT NULL DEFAULT 'user',
	  fieldname varchar(100) NOT NULL DEFAULT 'user_name',
	  colorbox tinyint(1) NOT NULL DEFAULT '1',
	  usesubs tinyint(1) NOT NULL DEFAULT '0',
	  sendmail tinyint(1) NOT NULL DEFAULT '0',
	  enablemail tinyint(1) NOT NULL DEFAULT '0',
	  allowsubscr tinyint(1) NOT NULL DEFAULT '1',
	  emailact tinyint(1) NOT NULL DEFAULT '1',
	  seperate tinyint(1) NOT NULL DEFAULT '0',
	  showip tinyint(1) NOT NULL DEFAULT '0',
	  stateserver tinyint(1) NOT NULL DEFAULT '1',
	  statereport tinyint(1) NOT NULL DEFAULT '1',
	  statemaps tinyint(1) NOT NULL DEFAULT '1',
	  statelineup tinyint(1) NOT NULL DEFAULT '1',
	  statescreens tinyint(1) NOT NULL DEFAULT '1',
	  statecomments tinyint(1) NOT NULL DEFAULT '0',
	  showteamflag tinyint(1) NOT NULL DEFAULT '0',
	  warssummary tinyint(1) NOT NULL DEFAULT '1',
	  addwarlist text NOT NULL,
	  caneditwar tinyint(1) NOT NULL DEFAULT '0',
	  requireapproval TINYINT (1) NOT NULL DEFAULT '1',
	  arrowcolor varchar(5) NOT NULL DEFAULT 'Black',
	  mapmustmatch TINYINT (1) NOT NULL DEFAULT '0',
	  scorepermap TINYINT (1) NOT NULL DEFAULT '0',
	  autocalcscore TINYINT (1) NOT NULL DEFAULT '0',
	  mapsperrow TINYINT (1) NOT NULL DEFAULT '2',
	  mapwidth INT (3) NOT NULL DEFAULT '180',
	  PRIMARY KEY (version))",
	  "INSERT INTO ".MPREFIX."clan_wars_config (version) VALUES ('1.0')",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars_lineup (
	  pid int(11) NOT NULL AUTO_INCREMENT,
	  member varchar(50) NOT NULL,
	  wid int(11) NOT NULL DEFAULT '0',
	  available int(1) NOT NULL DEFAULT '1',
	  PRIMARY KEY (pid))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars_mail (
	  mid int(11) NOT NULL AUTO_INCREMENT,
	  member varchar(25) NOT NULL,
	  email varchar(100) NOT NULL,
	  active tinyint(1) NOT NULL DEFAULT '0',
	  code varchar(25) DEFAULT NULL,
	  subscrtime int(15) NOT NULL DEFAULT '0',
	  PRIMARY KEY (mid),
	  UNIQUE KEY email (email),
	  UNIQUE KEY member (member))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars_maplink (
	  lid int(11) NOT NULL AUTO_INCREMENT,
	  wid int(11) NOT NULL DEFAULT '0',
	  mapname varchar(25) NOT NULL,
	  gametype varchar(25) DEFAULT NULL,
	  our_score INT (5) NOT NULL DEFAULT '0',
	  opp_score INT (5) NOT NULL DEFAULT '0',
	  PRIMARY KEY (lid))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars_maps (
	  mid INT (11) NOT NULL AUTO_INCREMENT,
	  gid INT (11) NOT NULL DEFAULT '0',
	  name VARCHAR (30) NULL,
	  image VARCHAR (50) NULL,
	  PRIMARY KEY (mid))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_wars_screens (
	  sid int(11) NOT NULL AUTO_INCREMENT,
	  url varchar(125) NOT NULL,
	  wid varchar(5) NOT NULL,
	  PRIMARY KEY (sid))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_games (
	  gid int(11) NOT NULL AUTO_INCREMENT,
	  abbr VARCHAR(20) NULL,
	  gname varchar(50) NOT NULL,
	  banner varchar(50) NULL,
	  icon varchar(50) NULL,
	  inmembers tinyint(1) NOT NULL DEFAULT '1',
	  inwars tinyint(1) NOT NULL DEFAULT '1',
	  position int(3) NOT NULL,
	  PRIMARY KEY (gid))",
	  "CREATE TABLE IF NOT EXISTS ".MPREFIX."clan_teams (
	  tid int(11) NOT NULL AUTO_INCREMENT,
	  team_tag varchar(25) NOT NULL,
	  team_name varchar(100) NOT NULL,
	  team_country varchar(50) NOT NULL DEFAULT 'Unknown',
	  banner varchar(50) NULL,
	  icon varchar(50) NULL,
	  inmembers tinyint(1) NOT NULL DEFAULT '1',
	  inwars tinyint(1) NOT NULL DEFAULT '1',
	  position int(3) NOT NULL,
	  PRIMARY KEY (tid))");	
	
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Clan Wars";
$eplug_link_url = e_PLUGIN.'clanwars/clanwars.php';

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = 'Your clan wars list is now installed';

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