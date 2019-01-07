<?php

if (!defined('e107_INIT')) { exit; }


$eplug_name = "Forum Thanks";
$eplug_version = "0.5";
$eplug_author = "Jezza101";
$eplug_folder = "forumthanks";

$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";

$eplug_url = "http://www.jezza101.co.uk";
$eplug_email = "jezza101@gmail.com";
$eplug_description = "Forum Thanks";
$eplug_compatible = "e107v0.7+";
$eplug_readme = "admin_readme.php";
$eplug_compliant = FALSE;
$eplug_menu_name = "ForumThanks";
$eplug_caption = "ForumThanks";
$eplug_status = TRUE;

$eplug_conffile = "admin_config.php";

$eplug_caption = "Configure Forum Thanks";
$eplug_done = "Installation Successful...";
$eplug_upgrade_done = "Upgrade successful...";

// List of comment_type ids used by this plugin. -----------------------------
//$eplug_comment_ids = array("tagcloud");

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
    	'thanks_showuser'             => 1,
	'thanks_replaceposts'         => 1,
	'thanks_credit'               => 1,
	'thanks_thanklist'            => 1,
	'thanks_statlink'             => 1,
	'thanks_limit'                => 0,
	'thanks_start'                => 0,
        'thanks_icon'                 => 0
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

