<?php
/*
+ ----------------------------------------------------------------------------------------------------+
|        e107 website system 
|        Email: office@clabteam.com
|        Organization: Corllete® Lab Copyright 2007 Corllete ltd. - www.clabteam.com
|        $Id: plugin.php 715 2008-01-16 12:47:22Z secretr $
|        License: GNU GENERAL PUBLIC LICENSE - http://www.gnu.org/licenses/gpl.txt
+----------------------------------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }
$lan_file = e_PLUGIN."fbox/languages/".e_LANGUAGE.".php";
include_lan($lan_file);

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name =  'FBOX_LANADM';
$eplug_version = '1.0';
$eplug_author = FBOX_LANADM_0;
$eplug_url = FBOX_LANADM_1;
$eplug_email = FBOX_LANADM_2;
$eplug_description = FBOX_LANADM_3;
$eplug_compatible = 'e107v0.7.9+';
$eplug_readme = 'readme.txt';
$eplug_compliant = TRUE;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'fbox';
//Plugin logo
$eplug_logo = $eplug_folder.'/images/icon_32.png';

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = FALSE;

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder.'/images/icon_32.png';
$eplug_icon_small = $eplug_folder.'/images/icon_16.png';
$eplug_caption = FBOX_LANADM_4;


// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array( 
        'fbox_ver' => $eplug_version,
        'fbox_default_tmpl' => '',
        'fbox_js' => '0',
        'fbox_menutmpl' => '',
        'fbox_permission' => e_UC_PUBLIC
);


// List of table names & SQL
$eplug_table_names = array("fbox");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
    "CREATE TABLE ".MPREFIX."fbox (
    fbox_id INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    fbox_title VARCHAR( 250 ) NOT NULL ,
    fbox_text TEXT NOT NULL ,
    fbox_image TEXT NOT NULL ,
    fbox_default_tmpl VARCHAR( 250 ) NOT NULL ,
    fbox_page_match TEXT NOT NULL ,
    fbox_page_exactmatch VARCHAR( 255 ) NOT NULL ,
    fbox_permission VARCHAR( 3 ) NOT NULL
    ) ENGINE = MYISAM"
);
/*

*/

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = '';
$eplug_link_url = '';
$eplug_link_perms = ''; // Optional: Guest, Member, Admin, Everyone


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = FBOX_LANADM_5;


// upgrading ... //
$upgrade_add_prefs =  array('fbox_ver' => $eplug_version);

//ALTER TABLE 
$upgrade_alter_tables = array();

$upgrade_remove_prefs = array(); //array
$upgrade_alter_tables = '';
$eplug_upgrade_done = ''; //msg

?>