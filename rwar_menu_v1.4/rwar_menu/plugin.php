<?php

  /*
  -----------------------------------------------------------------------------------------------------------+
  |
  |	e107 website system
  |	RWAR PLUGIN
  |
  |	©Richard Perry 2004
  |	http://www.greycube.com
  |
  |	Released under the terms and conditions of the
  |	GNU General Public License (http://gnu.org).
  |
  +----------------------------------------------------------------------------------------------------------+
  */

  //---------------------------------------------------------------------------------------------------------+

  // Plugin info --------------------------------------------------------------------------------------------+

  $eplug_name = "RWar";
  $eplug_version = "1.4";
  $eplug_author = "Richard Perry";
  $eplug_logo = "images/icon.png";
  $eplug_url = "http://www.greycube.com";
  $eplug_email = "code@greycube.com";
  $eplug_description = "RWar Plugin";
  $eplug_compatible = "e107v6";
  $eplug_readme = "readme.txt";
  $eplug_compliant = TRUE;

  // Name of the plugin's folder ----------------------------------------------------------------------------+

  $eplug_folder = "rwar_menu";

  // Name of menu item for plugin ---------------------------------------------------------------------------+

  $eplug_menu_name = "rwar_menu";

  // Name of the admin configuration file -------------------------------------------------------------------+
 
  $eplug_conffile = "rwar_admin.php";

  // Icon image and caption text ----------------------------------------------------------------------------+

  $eplug_icon = $eplug_folder."/images/icon.png";
  $eplug_caption = "RWar";

  // List of preferences ------------------------------------------------------------------------------------+

  $eplug_prefs = array(
	"rwar_default_gamename"		=>	"Counter-Strike Source",
	"rwar_default_gametype"		=>	"Team Deathmatch",
	"rwar_default_league"		=>	"Other",
	"rwar_default_rules"		=>	"5v5, FF Off, League Rules",
	"rwar_default_website"		=>	"http://",
	"rwar_default_irc"		=>	"irc://",
	"rwar_default_server"		=>	"255.255.255.255:27015",
	"rwar_default_serverpass"	=>	"clanwar",
	"rwar_date_format"		=>	"d-m-y H:i",
	"rwar_email"			=>	"code@greycube.com",
	"rwar_email_pending"		=>	"0",
	"rwar_email_chosen"		=>	"1",
	"rwar_challenge"		=>	"1",
	"rwar_challenge_show"		=>	"1",
	"rwar_challenge_user"		=>	"0",
	"rwar_addtocalendar"		=>	"0",
	"rwar_calendartype"		=>	"0",
	"rwar_menu_stats"		=>	"0",
	"rwar_menu_pending"		=>	"2",
	"rwar_menu_previous"		=>	"5",
	"rwar_squads"			=>	"a:1:{i:1;a:2:{s:3:\"tag\";s:3:\"TAG\";s:4:\"name\";s:10:\"SQUAD NAME\";}}",
	"rwar_sides"			=>	"a:2:{i:0;s:17:\"Counter-Terrorist\";i:1;s:9:\"Terrorist\";}"
	);

  // List of table names ------------------------------------------------------------------------------------+

  $eplug_table_names = array("rwar");

  // List of sql requests to create tables ------------------------------------------------------------------+

  $eplug_tables = array(
	"CREATE TABLE ".MPREFIX."rwar (
  
  `id`          int(11)      NOT NULL auto_increment,
  
  `gamename`    varchar(128) NOT NULL default '',
  `gametype`    varchar(128) NOT NULL default '',
  `league`      varchar(128) NOT NULL default '',

  `tag1`        varchar(128) NOT NULL default '',
  `tag2`        varchar(128) NOT NULL default '',

  `team1`       varchar(128) NOT NULL default '',
  `team2`       varchar(128) NOT NULL default '',
  
  `maps`        text         NOT NULL default '',
  `sides`       text         NOT NULL default '',
  `scores1`     text         NOT NULL default '',
  `scores2`     text         NOT NULL default '',
  `result`      varchar(128) NOT NULL default '',
  
  `players1`    text         NOT NULL default '',
  `players2`    text         NOT NULL default '',
 
  `server`      varchar(128) NOT NULL default '',
  `serverpass`  varchar(128) NOT NULL default '',

  `contact`     varchar(128) NOT NULL default '',
  `website`     varchar(128) NOT NULL default '',
  `irc`         varchar(128) NOT NULL default '',
  `rules`       text         NOT NULL default '',

  `info`        text         NOT NULL default '',
  `screenshots` text         NOT NULL default '',
  `demos`       text         NOT NULL default '',
  
  `calendar`    varchar(128) NOT NULL default '',
  `timestamp`   int(11)      NOT NULL default '0',

   PRIMARY KEY  (`id`)
  ) TYPE=MyISAM;");

  // Create a link in main menu (yes=TRUE, no=FALSE) --------------------------------------------------------+

  $eplug_link = TRUE;
  $eplug_link_name = "RWar";
  $eplug_link_url = e_PLUGIN."rwar_menu/";

  // Text to display after plugin successfully installed ----------------------------------------------------+

  $eplug_done = "Now look at the configuration area for RWar.";

  // upgrading ... //

  $upgrade_add_prefs    = "";
  $upgrade_remove_prefs = "";
  $upgrade_alter_tables = "";
  $eplug_upgrade_done   = "Upgrade Complete";

  // --------------------------------------------------------------------------------------------------------+

?>	