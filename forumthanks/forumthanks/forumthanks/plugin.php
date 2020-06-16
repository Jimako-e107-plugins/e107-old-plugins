<?php

if (!defined('e107_INIT')) { exit; }

include_lan(e_PLUGIN.'forumthanks/languages/'.e_LANGUAGE.'/lan_admin_thanks.php');

$eplug_name = LAN_AT24;
$eplug_version = LAN_AT26;
$eplug_author = LAN_AT25;
$eplug_folder = "forumthanks";

$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";

$eplug_url = "http://www.e107.ir";
$eplug_email = "sonixax@yahoo.com";
$eplug_description = LAN_AT27;
$eplug_compatible = "e107v0.7+";
$eplug_readme = "admin_readme.php";
$eplug_compliant = FALSE;
$eplug_menu_name = "ForumThanks";
$eplug_caption = "ForumThanks";
$eplug_status = TRUE;

$eplug_conffile = "admin_config.php";

$eplug_caption = LAN_AT28;
$eplug_done = LAN_AT29;
$eplug_upgrade_done = LAN_AT30;

// List of comment_type ids used by this plugin. -----------------------------
//$eplug_comment_ids = array("tagcloud");

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
    'thanks_showuser'             => 1,
	'thanks_replaceposts'         => 1,
	'thanks_loading_icon'		  => "default.gif",
	'thanks_statlink'             => 1,
	'thanks_limit'                => 0,
	'thanks_start'                => 0,
	'allow_remove_thanks'         => 1,
	'thanks_show_date' 	          => 1,
    'thanks_icon'                 => "thanks.png"
);

// List of table names -----------------------------------------------------------------------------------------------

$eplug_table_names = array(
"forum_thanks"
);

$eplug_tables = array("
CREATE TABLE ".MPREFIX."forum_thanks (
  `Thanks_ID`         int(10) NOT NULL auto_increment,
  `Thanks_ToUserID`   int(10) NOT NULL,
  `Thanks_FromUserID` int(10) NOT NULL,
  `Thanks_PostID`     int(10) NOT NULL,
  `Thanks_datestamp`  int(10) NOT NULL,
  PRIMARY KEY  (`Thanks_ID`),
  KEY `Thanks_ToUserID` (`Thanks_ToUserID`),
  KEY `Thanks_FromUserID` (`Thanks_FromUserID`),
  KEY `Thanks_PostID` (`Thanks_PostID`)
) ENGINE=MyISAM ;
"
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;

//myplugin_install()

//myplugin_upgrade()

//myplugin_uninstall()


?>

