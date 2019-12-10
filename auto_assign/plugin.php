<?php
// ***************************************************************
// *
// *		Title		:	Auto Assign
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	14 January 2007
// *
// *		Version		:	1.3
// *
// *		Description	: 	Auto Assign new users to classes
// *
// *		Revisions	:	14 Jan 2007
// *					:	22 Jan 2007 Fix for users already signed up to a class
// *					:	25 Jun 2008 Ensure no blank classes get through
// *
// *		Support at	:	www.keal.me.uk
// *
// ***************************************************************
/*
+---------------------------------------------------------------+
|	Auto Assign Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'auto_assign/languages/admin/' . e_LANGUAGE . '.php');
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'Auto Assign';
$eplug_version = '1.5';
$eplug_author = 'Father Barry';
$eplug_url = 'http://keal.me.uk';
$eplug_email = '';
$eplug_description = AUTOASSIGN_P04;
$eplug_compatible = 'e107v7';
$eplug_readme = 'admin_readme.php'; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'auto_assign';
// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = '';
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon_small = $eplug_folder . '/images/assign_16.png';
$eplug_icon = $eplug_folder . '/images/assign_32.png';
$eplug_caption = AUTOASSIGN_P01;
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
    'autoassign_class1' => 255,
    'autoassign_class2' => 255,
    'autoassign_class3' => 255,
    'autoassign_class4' => 255,
    'autoassign_class5' => 255,

    );
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = '';
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = '';
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = '';
$eplug_link_url = '';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = AUTOASSIGN_P02;
// upgrading ... //
$upgrade_add_prefs = '';

$upgrade_remove_prefs = '';

$upgrade_alter_tables = '';

$eplug_upgrade_done = AUTOASSIGN_P03;

?>