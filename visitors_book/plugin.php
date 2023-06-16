<?php
/*
*************************************
*        Visitors Book				*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."visitors_book/languages/".e_LANGUAGE."/admin.php");
// Plugin info  
$eplug_name    = "Visitors Book";
$eplug_version = "1.0";
$eplug_author  = "Oyabunstyle";
$eplug_url = "http://oyabunstyle.de";
$eplug_email = "info@oyabunstyle.de";

$eplug_description = "A new and functionable guestbook for e107.";
$eplug_compatible  = "e107 v0.7+";
$eplug_readme      = "admin.php";
$eplug_status = TRUE;

// Name of the plugin's folder
$eplug_folder = "visitors_book";

// Name of menu item for plugin  
$eplug_menu_name	= "Visitors Book";

// Name of the admin configuration file  
$eplug_conffile = "admin.php";

// Icon image and caption text
$eplug_icon = $eplug_folder."/stuff/32.png";
$eplug_icon_small = $eplug_folder."/stuff/16.png";
$eplug_logo = $eplug_folder."/stuff/32.png";
$eplug_caption = "Visitors Book";

// Create a link in main menu (yes=TRUE, no=FALSE) 
$eplug_link = TRUE;
$eplug_link_url		= e_PLUGIN.'visitors_book/visitors_book.php';
$eplug_link_name    = VIBO_LAN_14;

// Text to display after plugin successfully installed 
$eplug_done           = "Installation Successful..";
$eplug_uninstall_done = "Uninstalled Successfully..";

// List of sql requests to create tables 
$eplug_tables = array(
"CREATE TABLE IF NOT EXISTS ".MPREFIX."visitors_book_prefs (
	admin			varchar(255)	DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",
"CREATE TABLE IF NOT EXISTS ".MPREFIX."visitors_book (
	id				int(10)			UNSIGNED NOT NULL auto_increment,
	text			text			DEFAULT NULL,
	name			varchar(255)	DEFAULT  '".VIBO_LAN_15."',
	ip				varchar(255)	DEFAULT NULL,
	mail			varchar(255)	DEFAULT NULL,
	homepage		varchar(255)	DEFAULT NULL,
	is_comment		int(10)			DEFAULT '0',
	date			varchar(255)	DEFAULT NULL,
	checked			varchar(255)	DEFAULT '0',
	PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;",
"INSERT INTO ".MPREFIX."visitors_book_prefs (admin) VALUES ('250')",
);

?>