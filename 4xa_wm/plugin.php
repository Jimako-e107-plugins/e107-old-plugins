<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/plugin.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name             = LAN_4xA_SPORTTIPPS_NAME;
$eplug_version          = LAN_4xA_SPORTTIPPS_VERS;
$eplug_author           = "***RuSsE***";
$eplug_logo             = "/images/logo.gif";
$eplug_url              = "";
$eplug_email            = "";
$eplug_description      = LAN_4xA_SPORTTIPPS_DESCR;
$eplug_compatible       = "e107v7+";
$eplug_readme           = "";
$eplug_folder           = "4xa_wm";
$eplug_menu_name        = LAN_4xA_SPORTTIPPS_NAME;
$eplug_conffile         = "admin/admin_groups.php";
$eplug_icon             = $eplug_folder."/images/logo_32.png";
$eplug_icon_small       = $eplug_folder."/images/logo_16.png";
$eplug_caption          = $eplug_name." Konfigurieren";


// Find current version for upgrade stuff
include_once("../../class2.php");
$MSL_SQL = new db;
$MSL_SQL->db_Select("plugin", "plugin_version", "plugin_name='".$eplug_name."' AND plugin_installflag > 0");
if(list($PluginVers) = $MSL_SQL->db_Fetch()) {
	$PluginVers = preg_replace("/[a-zA-z\s]/", '', $PluginVers);
} else {
	$PluginVers = 0;
}

// List of preferences -----------------------------------------------------------------------------------------------

$eplug_prefs = array(
   "4xa_wm_cap" =>"Fußball-Weltmeisterschaft der Frauen 2011",
   "4xa_wm_acces_class" =>252,
   "4xa_wm_top_points" =>3,
   "4xa_wm_div_points" =>2,
   "4xa_wm_tendenz_points" =>1,
   "4xa_wm_niete_points" =>0,
   "4xa_wm_games_count" =>10,
   "4xa_wm_sportart" =>"Fußball",
   "4xa_wm_gametime" =>90,
   "4xa_wm_timer" =>5,
   "4xa_wm_top_points_color" =>"00FF66",
   "4xa_wm_div_points_color" =>"FFFF66",
   "4xa_wm_tendenz_color" =>"FF6633",
   "4xa_wm_niete_points_color" =>"CCCCCC",
   "4xa_wm_kA_field_color" =>"CCCCFF",
   "4xa_wm_xx_field_color" =>"66FFFF",
   "4xa_wm_verdeckt_field_color" =>"FF6666",
   "4xa_wm_menu_timer" =>4,
   "4xa_wm_menu_timer_value" =>2,
   "4xa_wm_tablestyle1" => "forumheader",
	 "4xa_wm_tablestyle2" => "forumheader3",
	 "4xa_wm_tablestyle3" => "forumheader3",
	 "4xa_wm_tablestyle4" => "forumheader2",
	 "4xa_wm_tablestyle5" => "forumheader3",
	 "4xa_wm_tablestyle6" => "forumheader",
	 "4xa_wm_tablestyle7" => "fcaption",
	 "4xa_wm_tablestyle8" => "forumheader3",
	 "4xa_wm_tablestyle9" => "forumheader",
	 "4xa_wm_tablestyle10" => "fcaption",
	 "4xa_wm_tablestyle11" => "forumheader",
	 "4xa_wm_tablestyle12" => "forumheader",
	 "4xa_wm_tablestyle13" => "forumheader2",
	 "4xa_wm_tablestyle14" => "forumheader",
	 "4xa_wm_tablestyle15" => "forumheader2",
	 "4xa_wm_tablestyle16" => "forumheader3"
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("4xa_wm_teams", "4xa_wm_rounds", "4xa_wm_groups", "4xa_wm_teams_in_groups", "4xa_wm_stadions", "4xa_wm_games", "4xa_wm_tipp");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
	"CREATE TABLE ".MPREFIX."4xa_wm_teams (
  team_id int(10) unsigned NOT NULL auto_increment,
	team_name char(50) NOT NULL default '',
	team_icon char(50) NOT NULL default '',
  PRIMARY KEY  (team_id)
	)TYPE=MyISAM;",
	
	"CREATE TABLE ".MPREFIX."4xa_wm_rounds (
  round_id int(10) unsigned NOT NULL auto_increment,
	round_name char(50) NOT NULL default '',
	round_order int(2) unsigned NOT NULL,
	round_typ int(2) unsigned NOT NULL,
  PRIMARY KEY  (round_id)
	)TYPE=MyISAM;",

	"CREATE TABLE ".MPREFIX."4xa_wm_groups (
  group_id int(10) unsigned NOT NULL auto_increment,
	group_name char(50) NOT NULL default '',
	group_round_id int(10) unsigned NOT NULL default '0',
	group_order int(2) unsigned NOT NULL,
  PRIMARY KEY  (group_id)
	)TYPE=MyISAM;",

	"CREATE TABLE ".MPREFIX."4xa_wm_teams_in_groups (
  teams_in_groups_id int(10) unsigned NOT NULL auto_increment,
	teams_virtual_name char(50) NOT NULL default '',  
  team_id int(10) unsigned NOT NULL default '0',
  group_id int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (teams_in_groups_id)
	)TYPE=MyISAM;",

	"CREATE TABLE ".MPREFIX."4xa_wm_stadions (
  stadion_id int(10) unsigned NOT NULL auto_increment,
 	stadion_ort char(50) NOT NULL default '',
	stadion_name char(50) NOT NULL default '',
	stadion_icon char(50) NOT NULL default '',
	stadion_kapatitat int(10) unsigned NOT NULL,
  PRIMARY KEY  (stadion_id)
	)TYPE=MyISAM;",

	"CREATE TABLE ".MPREFIX."4xa_wm_games (
  game_id int(10) unsigned NOT NULL auto_increment,
  rounde int(10) unsigned 		NOT NULL 	default '0',
  group_pre int(10) unsigned 		NOT NULL 	default '0',
  timeof_game	varchar(12)	default NULL,
  home int(10) unsigned 		NOT NULL 	default '0',
  guest int(10) unsigned 		NOT NULL 	default '0',
  goals_home int(10) unsigned 		NOT NULL 	default '0',
  goals_guest int(10) unsigned 		NOT NULL 	default '0',
  mode int(10) unsigned 		NOT NULL 	default '0',
  stadion int(10) unsigned 		NOT NULL 	default '0',
	PRIMARY KEY  (game_id)
	) TYPE=MyISAM;",

	"CREATE TABLE ".MPREFIX."4xa_wm_tipp (
	t_id int(10) unsigned NOT NULL auto_increment,
	t_game int(11) unsigned NOT NULL default '0',
	t_userid int(11) unsigned NOT NULL default '0',
	t_tipps text NOT NULL,
	PRIMARY KEY  (t_id)
	) TYPE=MyISAM;"
);


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Tipps abgeben";
$eplug_link_url = e_PLUGIN."4xa_wm/gamelist.php";
//

$eplug_link = true;
$eplug_link_name = "Meisterschafts- Tabellen";
$eplug_link_url = e_PLUGIN."4xa_wm/groups.php";
//
$eplug_link = true;
$eplug_link_name = "Tipper- tabelle";
$eplug_link_url = e_PLUGIN."4xa_wm/tipps.php";

//

// upgrading ... //

if ($PluginVers < "0.9.6") {
	// example for add. values:
  $upgrade_alter_tables = array();
   $gbtemp = array(
   	  "ALTER TABLE ".MPREFIX."4xa_wm_rounds ADD round_typ int(2) unsigned NOT NULL AFTER round_order;"
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $gbtemp);
}
$eplug_done = "OK!";

?>
