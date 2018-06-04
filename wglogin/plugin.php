<?php

if (!defined('e107_INIT')) { exit; }
require_once('languages/'.e_LANGUAGE.'.php');
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = WGLAN_100;
$eplug_version = "0.32";
$eplug_author = "okota_harinezumi";

$eplug_url = "http://tblsk-clan.ru/";
$eplug_email = "artsdc2007@yandex.ru";
$eplug_description = WGLAN_99;
$eplug_compatible = "e107 v0.7+";
$eplug_readme = e_LANGUAGE."_README.txt";        // leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "wglogin";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = TRUE;

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_logo = $eplug_folder."/images/icon.png";

$eplug_caption =  WGLAN_99;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_module = TRUE;
$eplug_table_names = array("wglogin_users", "wglogin_userclass");


// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE IF NOT EXISTS `".MPREFIX."wglogin_users` (
  `id` int(11) NOT NULL,
  `token` text NOT NULL,
  `expires_at` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;",

"CREATE TABLE IF NOT EXISTS `".MPREFIX."wglogin_userclasses` (
  `clid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `name_i18n` varchar(50) NOT NULL,
  `userclass_id` tinyint(4) NOT NULL,
  PRIMARY KEY (`clid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;",

"INSERT INTO `".MPREFIX."wglogin_userclasses` (`clid`, `name`, `name_i18n`, `userclass_id`) VALUES
(1, 'commander', '".WGSQL_1."', 3),
(2, 'executive_officer', '".WGSQL_2."', 3),
(3, 'personnel_officer', '".WGSQL_3."', 4),
(4, 'combat_officer', '".WGSQL_4."', 4),
(5, 'intelligence_officer', '".WGSQL_5."', 4),
(6, 'quartermaster', '".WGSQL_6."', 4),
(7, 'recruitment_officer', '".WGSQL_7."', 4),
(8, 'junior_officer', '".WGSQL_8."', 4),
(9, 'private', '".WGSQL_9."', 4),
(10, 'recruit', '".WGSQL_10."', 4),
(11, 'reservist', '".WGSQL_11."', 4);"
);


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = WGLNK_1;
$eplug_link_url = e_PLUGIN."wglogin/mywg.php?page=news";
$eplug_link_perms = "Member";


// Text to display after plugin successfully installed ------------------------------------------------------------------

$eplug_done = WGLAN_98;
$eplug_uninstall_done = WGLAN_97;

// upgrading ... //

//$upgrade_alter_tables = '
//ALTER TABLE `'.MPREFIX.'wglogin_users`
//  DROP `clan_id`;
//';

$eplug_upgrade_done = WGLAN_96;
?>