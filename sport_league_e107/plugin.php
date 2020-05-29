<?php
/*

+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/plugin.php $
|		$Revision: 0.84 $
|		$Date: 2010/02/04 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/form_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/form_lan.php");
require_once("constants.php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = LAN_LEAGUE_PLUGIN_1;
$eplug_version = LAN_LEAGUE_VERSION;
$eplug_author = "***RuSsE***";
$eplug_logo = LAN_LEAGUE_PLUGIN_3;
$eplug_url = "http://www.e107.4xa.de";
$eplug_email = "e107@4xa.de";
$eplug_description = LAN_LEAGUE_PLUGIN_4;
$eplug_compatible = LAN_LEAGUE_PLUGIN_5;
//$eplug_readme = "readme/".e_LANGUAGE.".txt"; 
$eplug_compliant = TRUE;
$eplug_folder = "sport_league_e107";
$eplug_menu_name = LAN_LEAGUE_PLUGIN_1;
$eplug_conffile = "admin/admin_league_config.php"; 
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption =  "?!?!";


$ecalSQL = new db;
$ecalSQL->db_Select("plugin", "plugin_version", "plugin_path='".$eplug_name."' AND plugin_installflag > 0");
list($ecalVer) = $ecalSQL->db_Fetch();
$ecalVer = preg_replace("/[a-zA-z\s]/", '', $ecalVer);

  $eplug_prefs = array(
  "league_sport"   => 1,     
  "league_tab_zebra" => "0",
  "sport_league_last_games" =>2,
  "sport_league_next_games" =>1,
  "sport_league_gamesmenu_scroll" =>"0",
  "sport_league_menu_scorer_first" =>"0",
  "sport_league_L_N_logo_menu" =>3,
  "sport_league_L_N_logo_h_menu" =>"30",
  "sport_league_logo_h_menu" =>"30",
  "sport_league_Menu_wat_logo" =>1
  );
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("league_stadions", "league_teams", "league_players", "league_players_extended_struct", "league_players_extended", "league_saison", "league_leagues", "league_leagueteams", "league_roster", "league_games", "league_points_value", "league_points", "league_anw", "league_ligas_arhiv", "league_player_points");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."league_stadions (
  `stadions_id` 					int(10) unsigned 	NOT NULL auto_increment,
  `stadions_name` 				varchar(100)		 	NOT NULL default '',
  `stadions_ort` 					varchar(100)		 	NOT NULL default '',
  `stadions_plz` 					varchar(10)			 	NOT NULL default '',
  `stadions_street` 			varchar(100)		 	NOT NULL default '',
  `stadions_tel` 					varchar(100)		 	NOT NULL default '',
  `stadions_fax` 					varchar(100)		 	NOT NULL default '',
  `stadions_contakt`			varchar(200)			NOT NULL default '',  
  `stadions_url` 					varchar(200)			NOT NULL default '',
  `stadions_image` 				varchar(200) 			NOT NULL 	default '',
  `stadions_description` 	text 							NOT NULL,
  PRIMARY KEY  (stadions_id)) ENGINE=MyISAM",
///--------------------------------------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_teams (
  `team_id` 					int(10) unsigned 	NOT NULL auto_increment,
  `team_name` 				varchar(100)		 	NOT NULL default '',
  `team_kurzname` 		varchar(15)				NOT NULL default '',
  `team_admin_id` 		int(10) unsigned 	NOT NULL default '0',  
  `team_url` 					varchar(200)			NOT NULL default '',
  `team_icon` 				varchar(200) 			NOT NULL default '',
  `team_description` 	text 							NOT NULL default '',
  `team_stadion_id` 	int(10) unsigned 	NOT NULL default '0',
  PRIMARY KEY  (team_id)) ENGINE=MyISAM",
///--------------------------------------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_players (
  `players_id` 					int(10) unsigned 	NOT NULL 	auto_increment,
  `players_name` 				varchar(100) 		NOT NULL 	default '',
  `players_pass` 				varchar(100) 		NOT NULL 	default '',
  `players_user_id` 			int(10) unsigned 	NOT NULL 	default '0',
  `players_admin_id` 			int(10) unsigned 	NOT NULL 	default '0',
  `players_image` 				varchar(200) 		NOT NULL 	default '',
  `players_burthday` 			varchar(12) 						default NULL,
  `players_description` 		text 					NOT NULL 	default '',
  PRIMARY KEY  (players_id)) ENGINE=MyISAM",
///----------------------------------------------------Player Erweitete Felder Struktur-------------------------------------------
"CREATE TABLE ".MPREFIX."league_players_extended_struct (
  `players_extended_struct_id` int(10) unsigned NOT NULL auto_increment,
  `players_extended_struct_name` varchar(255) NOT NULL default '',
  `players_extended_struct_text` varchar(255) NOT NULL default '',
  `players_extended_struct_type` tinyint(3) unsigned NOT NULL default '0',
  `players_extended_struct_parms` varchar(255) NOT NULL default '',
  `players_extended_struct_values` text NOT NULL,
  `players_extended_struct_default` varchar(255) NOT NULL default '',
  `players_extended_struct_read` tinyint(3) unsigned NOT NULL default '0',
  `players_extended_struct_write` tinyint(3) unsigned NOT NULL default '0',
  `players_extended_struct_required` tinyint(3) unsigned NOT NULL default '0',
  `players_extended_struct_signup` tinyint(3) unsigned NOT NULL default '0',
  `players_extended_struct_applicable` tinyint(3) unsigned NOT NULL default '0',
  `players_extended_struct_order` int(10) unsigned NOT NULL default '0',
  `players_extended_struct_parent` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (players_extended_struct_id)) ENGINE=MyISAM",
///----------------------------------------------------  
"INSERT INTO ".MPREFIX."league_players_extended_struct VALUES (1, 'weigt','Gewicht', 1, '', '*kg', '', '252', '252', '2', '', '252', 1, 0);",
"INSERT INTO ".MPREFIX."league_players_extended_struct VALUES (2, 'higt','Größe', 1, '', '*cm', '', '252', '252', '2', '', '252', 2, 0);",
///----------------------------------------------------Player Erweitete Felder Tabelle Skeleton ------------------------------------------
"CREATE TABLE ".MPREFIX."league_players_extended (
  `players_extended_id` int(10) unsigned NOT NULL auto_increment,
  `players_extended_player_id` int(10) unsigned NOT NULL default '0',
  `players_hidden_fields` text NOT NULL,
  PRIMARY KEY  (players_extended_id)) ENGINE=MyISAM", 
///------------------------------------  Saisonliste   (Praktisch die Liste der Jahren)-----------------------------------------------
"CREATE TABLE ".MPREFIX."league_saison (
  `saison_id` 				int(10) unsigned 	NOT NULL 	auto_increment,
  `saison_name` 			varchar(100) 		NOT NULL 	default '',
  `saison_beginn` 			varchar(12) 						default NULL,
  `saison_end`				varchar(12) 						default NULL,
  `saison_description` 	text 					NOT NULL 	default '',
  `saison_order` int(10) unsigned 	NOT NULL default '0',
  PRIMARY KEY  (saison_id)) ENGINE=MyISAM",  
///---------------------------------------  Ligen  (es werden jedes Jahr neue Ligen erstellt) ----------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_leagues (
  `league_id` 					int(10) unsigned 	NOT NULL 	auto_increment,
  `league_name` 				varchar(100) 			NOT NULL 	default '',
  `league_saison_id` 		int(10) unsigned 	NOT NULL 	default '0',
  `league_description` 	text 							NOT NULL 	default '',
  `league_pref1` 				varchar(100) 			NOT NULL 	default '',
  `league_pref2` 				varchar(100) 			NOT NULL 	default '',
  `league_pref3` 				varchar(100) 			NOT NULL 	default '',
  `league_pref4` 				varchar(100) 			NOT NULL 	default '',
  PRIMARY KEY  (league_id)) ENGINE=MyISAM", 
///------------------------------------------Zusammenstellung der Ligen. Die Mannschaften werden mit den Ligen veknüpft. --------------------------------------------
"CREATE TABLE ".MPREFIX."league_leagueteams (
  `leagueteam_id` 				int(10) unsigned 	NOT NULL auto_increment,
  `leagueteam_league_id` 	int(10) unsigned 	NOT NULL default '0',
  `leagueteam_team_id` 		int(10) unsigned 	NOT NULL default '0',
  `leagueteam_my_team` 			varchar(100) 			NOT NULL 	default '',
  `leagueteam_pref2` 				varchar(100) 			NOT NULL 	default '',
  `leagueteam_pref3` 				varchar(100) 			NOT NULL 	default '',
  `leagueteam_pref4` 				varchar(100) 			NOT NULL 	default '',
  PRIMARY KEY  (leagueteam_id),
  FOREIGN KEY(leagueteam_league_id) REFERENCES ".MPREFIX."league_leagues(league_id),
  FOREIGN KEY(leagueteam_team_id) 	REFERENCES ".MPREFIX."league_teams(team_id)) ENGINE=MyISAM",  
///------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_roster (
  `roster_id` 				int(10) unsigned 	NOT NULL auto_increment,
  `roster_name` 			varchar(100) 		NOT NULL default '',
  `roster_league_id` 		int(10) unsigned 	NOT NULL default '0',
  `roster_player_id` 		int(10) unsigned 	NOT NULL default '0',
  `roster_team_id` 		int(10) unsigned 	NOT NULL default '0',
  `roster_status` 			int(10) unsigned 	NOT NULL default '0',
  `roster_jersy` 			int(10) unsigned 	NOT NULL default '999',
  `roster_imfeld` 			tinyint(1) 			NOT NULL default '1',
  `roster_position` 		int(10) unsigned 	NOT NULL default '0',
  `roster_description` 	text 					NOT NULL default '',
  `roster_pref1` 			varchar(100) 		NOT NULL 	default '',
  `roster_pref2` 			varchar(100) 		NOT NULL 	default '',
  `roster_pref3` 			varchar(100) 		NOT NULL 	default '',
  `roster_image` varchar(200) 		NOT NULL 	default '',
  PRIMARY KEY  (roster_id),
  FOREIGN KEY(roster_league_id) REFERENCES ".MPREFIX."league_leagues(league_id),
  FOREIGN KEY(roster_player_id) REFERENCES ".MPREFIX."league_players(players_id),
  FOREIGN KEY(roster_team_id) 	REFERENCES ".MPREFIX."league_teams(leagueteam_id)) ENGINE=MyISAM",
///------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_games (
  `game_id` 				int(10) unsigned 		NOT NULL 	auto_increment,
  `game_league_id` 	int(10) unsigned 		NOT NULL 	default '0',
  `game_week` 			int(10) unsigned 		NOT NULL 	default '0',
  `game_date` 			varchar(12) 							default NULL,
  `game_time` 			varchar(12) 							default NULL,
  `game_home_id` 		int(10) unsigned 		NOT NULL 	default '0',
  `game_gast_id` 		int(10) unsigned 		NOT NULL 	default '0',
  `game_goals_home` 	int(10) unsigned 		NOT NULL 	default '0',
  `game_goals_gast` 	int(10) unsigned 		NOT NULL 	default '0',
  `game_un` 				tinyint(1) 				NOT NULL 	default '0',
  `game_enable` 		tinyint(1) 				NOT NULL 	default '0',
  `game_news_id` 		int(10) unsigned 		NOT NULL 	default '0',
  `game_description` 	text 						NOT NULL 	default '',
  `game_pref1` 			varchar(100) 			NOT NULL 	default '',
  `game_pref2` 			varchar(100) 			NOT NULL 	default '',
  `game_pref3` 			varchar(100) 			NOT NULL 	default '',
  `game_pref4` 			varchar(100) 			NOT NULL 	default '',
  `game_pref5` 			varchar(100) 			NOT NULL 	default '',
  `game_pref6` 			varchar(100) 			NOT NULL 	default '',
  PRIMARY KEY  (game_id),
  FOREIGN KEY(game_league_id) REFERENCES ".MPREFIX."league_leagues(league_id),
  FOREIGN KEY(game_home_id)	 REFERENCES ".MPREFIX."league_leagueteams(leagueteam_id),
  FOREIGN KEY(game_gast_id)	 REFERENCES ".MPREFIX."league_leagueteams(leagueteam_id)) ENGINE=MyISAM",
///--------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_points_value (
  `points_value_id` 				int(10) unsigned 	NOT NULL auto_increment,
  `points_value_name` 				varchar(100) 		NOT NULL default '',
  `points_value_typ` 				int(10) unsigned	NOT NULL default '0',
  `points_value_mat` 				int(10) 			 	NOT NULL default '0',
  `points_value_description` 	text 					NOT NULL 	default '',
  PRIMARY KEY  (points_value_id)) ENGINE=MyISAM",
///----------------------------------------------------------------------------------------------
"INSERT INTO ".MPREFIX."league_points_value VALUES (1, 'Tor', 1, 1, 'Tore werden in der Statistik je 1xPunkt gerechnet');",
"INSERT INTO ".MPREFIX."league_points_value VALUES (2, 'Assis', 1, 1, 'Punkte werden in der Statistik je 1xPunkt gerechnet');",
///----------------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_points (
  `points_id` 				int(10) unsigned NOT NULL auto_increment,
  `points_value` 			int(10) unsigned NOT NULL default '0',
  `points_saison_id` 		int(10) unsigned NOT NULL default '0',
  `points_game_id` 		int(10) unsigned NOT NULL default '0',
  `points_player_id` 		int(10) unsigned NOT NULL default '0',
  `points_team_id` 		int(10) unsigned NOT NULL default '0',
  `points_time` 			varchar(12) 					default NULL,
  PRIMARY KEY  (points_id),
  FOREIGN KEY(points_value) 		REFERENCES ".MPREFIX."league_points_value(points_value_id),
  FOREIGN KEY(points_saison_id) REFERENCES ".MPREFIX."league_leagues(league_id),
  FOREIGN KEY(points_game_id) 	REFERENCES ".MPREFIX."league_games(game_id),
  FOREIGN KEY(points_player_id) REFERENCES ".MPREFIX."league_players(players_id),
  FOREIGN KEY(points_team_id) 	REFERENCES ".MPREFIX."league_leagueteams(leagueteam_id)) ENGINE=MyISAM",
///--------------------------------------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_anw (
  `anw_id` 					int(10) unsigned 	NOT NULL auto_increment,
  `anw_saison_id` 			int(10) unsigned 	NOT NULL default '0',
  `anw_game_id` 			int(10) unsigned 	NOT NULL default '0',
  `anw_player_id` 			int(10) unsigned 	NOT NULL default '0',
  `anw_team_id` 			int(10) unsigned 	NOT NULL default '0',
  PRIMARY KEY  (anw_id),
  FOREIGN KEY(anw_saison_id) REFERENCES ".MPREFIX."league_saison(saison_id),
  FOREIGN KEY(anw_game_id) 	REFERENCES ".MPREFIX."league_games(game_id),
  FOREIGN KEY(anw_player_id) REFERENCES ".MPREFIX."league_players(players_id),
  FOREIGN KEY(anw_team_id) 	REFERENCES ".MPREFIX."league_teams(team_id)) ENGINE=MyISAM",
///--------------------------------------------------------------------------------------------------------------------
"CREATE TABLE ".MPREFIX."league_ligas_arhiv (
  `ligas_arhiv_id` 					int(10) unsigned 	NOT NULL auto_increment,
  `ligas_arhiv_saison_id` 	int(10) unsigned 	NOT NULL default '0',
  `ligas_arhiv_league_id` 	int(10) unsigned 	NOT NULL default '0',
  `ligas_arhiv_team_id` 		int(10) unsigned 	NOT NULL default '0',
  `ligas_arhiv_games` 			int(10) NOT NULL default '0',
  `ligas_arhiv_winn` 				int(10) NOT NULL default '0',
  `ligas_arhiv_lost` 				int(10) NOT NULL default '0',
  `ligas_arhiv_un` 					int(10) NOT NULL default '0',
  `ligas_arhiv_points` 			int(10) NOT NULL default '0',
  `ligas_arhiv_et` 					int(10) NOT NULL default '0',
  `ligas_arhiv_gt` 					int(10) NOT NULL default '0',
  PRIMARY KEY  (ligas_arhiv_id)) ENGINE=MyISAM",
///--------------------------------------------------------------------------------------------------------------------  
"CREATE TABLE ".MPREFIX."league_player_points (
  `player_points_id` 				int(10) unsigned NOT NULL auto_increment,
  `player_points_saison_id` 		int(10) unsigned NOT NULL default '0',
  `player_points_team_id` 		int(10) unsigned NOT NULL default '0',
  `player_points_roster_id` 		int(10) unsigned NOT NULL default '0',
  `player_points_1` 		int(10) unsigned NOT NULL default '0',
  `player_points_2` 		int(10) unsigned NOT NULL default '0',
  `player_points_3` 		int(10) unsigned NOT NULL default '0',
  `player_points_4` 		int(10) unsigned NOT NULL default '0',
  `player_points_5` 		int(10) unsigned NOT NULL default '0',
  `player_points_6` 		int(10) unsigned NOT NULL default '0',
  `player_points_7` 		int(10) unsigned NOT NULL default '0',
  `player_points_8` 		int(10) unsigned NOT NULL default '0',
  `player_points_9` 		int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (player_points_id)) ENGINE=MyISAM");
///--------------------------------------------------------------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = LAN_LEAGUE_PLUGIN_6;
$eplug_link_url = e_PLUGIN.$eplug_folder."/league_teams.php";
$eplug_done = $eplug_name." is successfully installed.";
// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";

//////++++++++++++++++++++++++++++++++++++++++++++++++++

if ($ecalVer < 0.78)
{
///To version 0.78
$upgrade_alter_tables = array(
	"CREATE TABLE ".MPREFIX."league_player_points (
  `player_points_id` 				int(10) unsigned NOT NULL auto_increment,
  `player_points_saison_id` 		int(10) unsigned NOT NULL default '0',
  `player_points_team_id` 			int(10) unsigned NOT NULL default '0',
  `player_points_roster_id` 		int(10) unsigned NOT NULL default '0',
  `player_points_1` 				int(10) unsigned NOT NULL default '0',
  `player_points_2` 				int(10) unsigned NOT NULL default '0',
  `player_points_3` 				int(10) unsigned NOT NULL default '0',
  `player_points_4` 				int(10) unsigned NOT NULL default '0',
  `player_points_5` 				int(10) unsigned NOT NULL default '0',
  `player_points_6` 				int(10) unsigned NOT NULL default '0',
  `player_points_7` 				int(10) unsigned NOT NULL default '0',
  `player_points_8` 				int(10) unsigned NOT NULL default '0',
  `player_points_9` 				int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (player_points_id)) ENGINE=MyISAM"
  );
}
//////++++++++++++++++++++++++++++++++++++++++++++++++++
if ($ecalVer < 0.79)
{
/// To version 0.79
$upgrade_alter_tables = array(
	"ALTER TABLE ".MPREFIX."league_saison ADD `saison_order` int(10) unsigned 	NOT NULL default '0';", 
	"ALTER TABLE ".MPREFIX."league_roster ADD `roster_image` varchar(200) 		NOT NULL 	default '';"
	);
}
//////++++++++++++++++++++++++++++++++++++++++++++++++++
$eplug_upgrade_done = "Aktualisierung des ".$eplug_name." auf ".$eplug_version." war erfolgreich.";
?>