<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        YourPlugin v3.0 by CaMer0n (www.e107coders.org)
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Ratings";
$eplug_version = "3.0";
$eplug_author = "aSeptik";
$eplug_url = "http://ask.altervista.org";
$eplug_email = "aseptik@gmail.com";
$eplug_description = "(Unobtusive) AJAX Rating Bars for e107";
$eplug_compatible = "e107v7";
$eplug_readme = "readme.php";        // leave blank if no readme file
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "ratings";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";  // _menu is no longer required in 0.7.

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";  // use admin_ for all admin files.

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/logo_32.png";
$eplug_icon_small = $eplug_folder."/images/logo_16.png";
$eplug_caption =  'ratings';



// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("ratings");


// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("
CREATE TABLE `".MPREFIX."ratings` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `rate_id` varchar(11) NOT NULL default '',
  `total_votes` int(11) NOT NULL default '0',
  `total_value` int(11) NOT NULL default '0',
  `total_cat` varchar(255) NOT NULL default '',
  `used_ips` longtext,
  `user_rid` longtext NOT NULL,
  `rate_this` decimal(1,0) NOT NULL default '0',
  PRIMARY KEY  (`id`,`rate_id`),
  UNIQUE KEY (`rate_id`,`total_cat`)
) ENGINE=MyISAM; ");




$eplug_prefs = array(
  "ratings_display_per_page"  =>  20,
  "ratings_class" => 0,
  "ratings_message_responce" => 'true',
  );

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "Ratings";
$eplug_link_url = e_PLUGIN."ratings";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Successful Installed!";


// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";


?>