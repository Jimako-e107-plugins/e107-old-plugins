<?php
/*
+------------------------------------------------------------------------------+
| Auto Post on Signup v1.0
| Plugin by Martinj - www.martinj.co.uk
| July 2009
|  e107 Website System - e107.org
| Plugin skeleton by nlstart
+------------------------------------------------------------------------------+
*/

if( ! defined('e107_INIT')){ exit(); }

$eplug_folder = "apos";
include_lan(e_PLUGIN.'apos/languages/'.e_LANGUAGE.'.php');
$eplug_name = 'Auto Post On Signup';
$eplug_version = "1.0";
$eplug_author = "Martinj";
$eplug_url = "http://www.martinj.co.uk/";
$eplug_email = "martinleeds@gmail.com";
$eplug_description = APOS_PREF_04;
$eplug_compatible = "e107v0.7+";
$eplug_readme = "readme.txt";

$eplug_menu_name = "";
$eplug_conffile = "admin_config.php";
$eplug_icon = $eplug_folder."/images/apos_32.png";
$eplug_icon_small = $eplug_folder."/images/apos_16.png";
$eplug_caption = APOS_PREF_05;

// List of preferences ---------------------------------------------------------
// this stores a default value(s) in the preferences. 0 = Off , 1= On
// Preferences are saved with plugin folder name as prefix to make preferences unique and recognisable
$eplug_prefs = array(
	$eplug_folder."_name" => "apos",
    $eplug_folder."_image_path" => "images/",
    $eplug_folder."_forum" => "",
    $eplug_folder."_title" => APOS_PREF_01,
    $eplug_folder."_text" => APOS_PREF_02,
	$eplug_folder."_sender" => APOS_PREF_03,
	$eplug_folder."_userid" => 1
);


// Create a link in main menu (yes=TRUE, no=FALSE) ---------------------------
$eplug_link = FALSE;

// To keep link multilangual: store the constant name in the links table
$eplug_link_name = 'APOS_LINK_NAME';
// $plugins_directory can be named differently than the default e107_plugins in the e107_config
$eplug_link_url = e_PLUGIN."apos/apos.php";
$eplug_done = APOS_PLUG_08;

// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";


$eplug_upgrade_done = APOS_PLUG_09." v".$eplug_version.".";
?>