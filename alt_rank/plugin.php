<?php

if (!defined('e107_INIT')) { exit; }

include_lan ( e_PLUGIN."alt_rank/languages/".e_LANGUAGE.".php" );
require_once( e_PLUGIN."alt_rank/alt_rank_ver.php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name =  ALTRANK_00;
$eplug_version = ALTRANK_VER;
$eplug_author = ALTRANK_AUTOR;
$eplug_url = 'http://www.e107.bg';
$eplug_email = 'nickypn@e107.bg';
$eplug_description = ALTRANK_DESC;
$eplug_compatible = 'e107v1.0';
$eplug_readme = '';
$eplug_compliant = TRUE;
$eplug_module = FALSE;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'alt_rank';
//Plugin logo
$eplug_logo = '';//$eplug_folder.'/images/icon_32.png';

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = FALSE;

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';//"admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder.'/images/icon_32.png';
$eplug_icon_small = $eplug_folder.'/images/icon_16.png';
$eplug_caption = ALTRANK_00;


// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array();


// List of table names & SQL
$eplug_table_names = array();

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array();

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = '';
$eplug_link_url = '';
$eplug_link_perms = 'Admin'; // Optional: Guest, Member, Admin, Everyone


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = ALTRANK_DONE;


// upgrading ... //
$upgrade_add_prefs =  array();

//ALTER TABLE 
$upgrade_alter_tables = array();

$upgrade_remove_prefs = array(); //array
$upgrade_alter_tables = '';
$eplug_upgrade_done = ALTRANK_UPG_DONE; //msg

?>