<?php
/*
+---------------------------------------------------------------+
|        User Settings Change Notification
|		 for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'user_changed/languages/admin/' . e_LANGUAGE . '.php');
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'User Changed';
$eplug_version = '1.2';
$eplug_author = 'Father Barry';
$eplug_url = 'http://www.keal.me.uk';
$eplug_email = '';
$eplug_description = UCHANGE_P01;
$eplug_compatible = 'e107 v0.7 only';
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'user_changed';
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . '/images/uchange_32.png';
$eplug_caption = UCHANGE_P04;
$eplug_icon_small = $eplug_folder . '/images/uchange_16.png';
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array('uchange_dummy' => ''   );
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = '';
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = '';
$eplug_link_url ='';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = UCHANGE_P02;

$eplug_upgrade_done = UCHANGE_P03;
$upgrade_alter_tables ='';
