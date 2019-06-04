<?php

  /*
  -----------------------------------------------------------------------------------------------------------+
  |
  |	e107 website system
  |	CUPS PLUGIN
  |
  |	©Crytiqal.Aero 2010
  |	http://www.team-aero.co.nr
  |
  |	Released under the terms and conditions of the
  |	GNU General Public License (http://gnu.org).
  |
  +----------------------------------------------------------------------------------------------------------+
  */

  //---------------------------------------------------------------------------------------------------------+

  // Plugin info --------------------------------------------------------------------------------------------+

  $eplug_name = "Cups";
  $eplug_version = "1.2";
  $eplug_author = "Crytiqal.Aero";
  $eplug_logo = "images/icon.gif";
  $eplug_url = "http://www.team-aero.co.nr";
  $eplug_email = "code@team-aero.co.nr";
  $eplug_description = "Cups Plugin";
  $eplug_compatible = "e107v0.7+";
  $eplug_readme = "readme.txt";
  $eplug_compliant = TRUE;

  // Name of the plugin's folder ----------------------------------------------------------------------------+

  $eplug_folder = "cups_menu";

  // Name of menu item for plugin ---------------------------------------------------------------------------+

  $eplug_menu_name = "cups_menu";

  // Name of the admin configuration file -------------------------------------------------------------------+
 
  $eplug_conffile = "cups_admin.php";

  // Icon image and caption text ----------------------------------------------------------------------------+

  $eplug_icon = $eplug_folder."/images/icon.gif";
  $eplug_caption = "Cups";

  // List of preferences ------------------------------------------------------------------------------------+

  $eplug_prefs = array(
	"cups_default_gamename"	=>	"Counter-Strike Source",
	"cups_default_gametype"	=>	"Team Deathmatch",
	"cups_default_league"		=>	"Other",
	"cups_default_event"		=>	"Name of event",
	"cups_default_rules"		=>	"4v4, FF On, League Rules",

	"cups_date_format"			=>	"d-m-y",
	"cups_email"				=>	"cupinfo@localhost.com",
	"cups_email_all"		=>	"0",
	"cups_email_chosen"			=>	"1",
	"cups_challenge"			=>	"1",
	"cups_challenge_show"		=>	"1",
	"cups_challenge_user"		=>	"0",
	"cups_addtocalendar"		=>	"0",
	"cups_calendartype"			=>	"0",
	"cups_menu_stats"			=>	"0",
	"cups_menu_previous"		=>	"5",
	"cups_squads"				=>	"a:1:{i:1;a:2:{s:3:\"tag\";s:3:\"TAG\";s:4:\"name\";s:10:\"SQUAD NAME\";}}",
	);

  // List of table names ------------------------------------------------------------------------------------+

  $eplug_table_names = array("cups");

  // List of sql requests to create tables ------------------------------------------------------------------+

  $eplug_tables = array(
	"CREATE TABLE ".MPREFIX."cups (
  
  `id`          int(11)      NOT NULL auto_increment,
  
  `gamename`    varchar(128) NOT NULL default '',
  `gametype`    varchar(128) NOT NULL default '',
  `league`      varchar(128) NOT NULL default '',
  `event`       text         NOT NULL default '',
  `rules`       text         NOT NULL default '',

  `tag1`        varchar(128) NOT NULL default '',
  `team1`       varchar(128) NOT NULL default '',
  
  `result`      varchar(128) NOT NULL default '',
  
  `players1`    text         NOT NULL default '',
 
  `info`        text         NOT NULL default '',
  `screenshots` text         NOT NULL default '',
  `demos`       text         NOT NULL default '',
  
  `calendar`    varchar(128) NOT NULL default '',
  `timestamp`   int(11)      NOT NULL default '0',

   PRIMARY KEY  (`id`)
  ) TYPE=MyISAM;");

  // Create a link in main menu (yes=TRUE, no=FALSE) --------------------------------------------------------+

  $eplug_link = TRUE;
  $eplug_link_name = "Cups";
  $eplug_link_url = e_PLUGIN."cups_menu/";

  // Text to display after plugin successfully installed ----------------------------------------------------+

  $eplug_done = "Now look at the configuration area for Cups.";

  // upgrading ... //

  $upgrade_add_prefs    = "";
  $upgrade_remove_prefs = "";
  $upgrade_alter_tables = "";
  $eplug_upgrade_done   = "Upgrade Complete";

  // --------------------------------------------------------------------------------------------------------+

?>	