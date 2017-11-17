<?php
/*
+---------------------------------------------------------------+
|        Tournaments plugin for e107 v0.7
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        ©Stratos Geroulis
|        http://www.stratosector.net/
|        stratosg@stratosector.net
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Tournaments";
$eplug_version = "1.2";
$eplug_author = "stratosg";
$eplug_logo = e_PLUGIN."tournaments/images/icon.png";
$eplug_url = "http://www.stratosector.net/";
$eplug_email = "stratosg@stratosector.net";
$eplug_description = "A plugin to organize tournaments on flash games.";
$eplug_compatible = "e107v7+";
$eplug_readme = "readme.txt";        // leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "tournaments";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = e_PLUGIN."tournaments/images/icon.png";
$eplug_caption =  "Configure Tournaments";

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("tournaments_games", "tournaments_tournaments");

$eplug_tables = array("
CREATE TABLE ".MPREFIX."tournaments_games (
  game_id int(10) unsigned NOT NULL auto_increment,
  game_filename varchar(100) NOT NULL default '',
  game_title varchar(64) NOT NULL,
  display_width int(10) unsigned NOT NULL default '480',
  display_height int(10) unsigned NOT NULL default '640',
  PRIMARY KEY (game_id)
);",
"CREATE TABLE ".MPREFIX."tournaments_tournaments (
  tournament_id int(10) unsigned NOT NULL auto_increment,
  game_id int(10) NOT NULL,
  tournament_desc text NOT NULL,
  tournament_prize varchar(100) NOT NULL,
  tournament_start int(10) NOT NULL,
  tournament_end int(10) NOT NULL,
  PRIMARY KEY(tournament_id)
);",
"CREATE TABLE ".MPREFIX."tournaments_plays (
  play_id int(10) unsigned NOT NULL auto_increment,
  player_id int(10) NOT NULL,
  tournament_id int(10) NOT NULL,
  score varchar(10) NOT NULL,
  PRIMARY KEY(play_id)
);");

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = "Tournaments";
$eplug_link_url = "e107_plugins/tournaments/index.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Installation completed successfuly. Have some nice competitions!!!<br>I would really appreciate it if you visit my site and leave a comment or a post on the forum about how you like it and where you use it.";


?>