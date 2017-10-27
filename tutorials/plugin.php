<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        Plugin: Tutorial Archiver
|        Version: 2.0
|        Original plugin by: Jordan 'Glasseater' Mellow, 2007
|
|        Modded and Revised by: e107 Italia in 2013
|        Email: info@e107italia.org
|        Website: www.e107italia.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+----------------------------------------------------------------------------------------------------+
*/


if (!defined('e107_INIT')) { exit; }
 
 // Plugin info  
 $eplug_name    = "Archivio Tutorial";
 $eplug_version = "2.0";
 $eplug_author  = "_.Glasseater._ / mods by e107 Italia";
 
 $eplug_description = "Un semplice Archivio di tutorial.";
 $eplug_compatible  = "e107 v0.7+";
 $eplug_readme      = "readme.txt";        
 
 // Name of the plugin's folder
 $eplug_folder = "tutorials";
 
 $eplug_icon = $eplug_folder."/images/tuts_32x32.gif";
 $eplug_icon_small = $eplug_folder."/images/tuts_16x16.gif";
 
 $eplug_url = "http://www.e107italia.org";
 
 $eplug_email = "info@e107italia.org";
 
 // Name of the admin configuration file  
 $eplug_conffile = "admin_tuts.php";
 
 $eplug_caption = "Gestisci il plugin Archivio Tutorial";
 // List of preferences 
 $eplug_prefs       = array(
	"tuts_ordercby" => "id",
	"tuts_ordercdir" => "Desc",
	"tuts_ordertby" => "id",
	"tuts_ordertdir" => "Desc",
	"tuts_menulist" => "newest",
	"tuts_menunum" => "10",
	"tuts_allowusersub" => true,
	"tuts_allownotify" => true,
	"tuts_allowrating" => true,
 );
 $eplug_table_names = array(
 	"tutsplugin_cats",
 	"tutsplugin_tutorial",
	"tutsplugin_antispam",
 ); 
 $eplug_tables = array(
"CREATE TABLE `".MPREFIX."tutsplugin_cats` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `desc` longtext NOT NULL,
  `icon` varchar(250) NOT NULL default '',
  `indexed` int(18) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;",
   /*
   	*	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
   	*	!!!REMEMBER TO ADD A TUTORIAL ON MANAGING TUTORIALS HERE!!!
	*	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	*/
"CREATE TABLE `".MPREFIX."tutsplugin_tutorial` (
  `id` int(11) NOT NULL auto_increment,
  `catID` int(11) NOT NULL default '0',
  `name` varchar(150) NOT NULL default 'NO NAME',
  `shortdesc` longtext NOT NULL,
  `longdesc` longtext NOT NULL,
  `icon` varchar(100) NOT NULL default '',
  `date` int(36) default '0',
  `views` int(18) default '0',
  `poster_id` int(18) NOT NULL default '0',
  `accepted` int(8) default '0',
  `accept_date` int(36) default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;",

"CREATE TABLE ".MPREFIX."tutsplugin_antispam (
	`id` int (11) NOT NULL auto_increment,
	`user_id` int(11) NOT NULL default '9999999',
	`ip` varchar(34) NOT NULL default '0.0.0.0',
	`timestamp` varchar(34) NOT NULL default '0',
	`spam_attempts` int(11) NOT NULL default '0',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM;",
);
 
 // Create a link in main menu (yes=TRUE, no=FALSE) 
 $eplug_link = TRUE;
 $eplug_link_name  = "Tutorial";
 $eplug_link_url = e_PLUGIN.$eplug_folder."/tutorials.php";
 $eplug_link_perms = "Everyone";
 
 // Text to display after plugin successfully installed 
 $eplug_done           = "Installazione completata...<br />Ora puoi inserire i tuoi Tutorial...";
 $eplug_uninstall_done = "Disinstallato con successo...";
?>