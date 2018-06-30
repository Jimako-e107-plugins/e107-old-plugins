<?php
/*
*************************************
*        Signup Secure				*
*									*
*        (C)Oyabunstyle.de			*
*        http://oyabunstyle.de		*
*        info@oyabunstyle.de		*
*************************************
*/
if (!defined('e107_INIT')) { exit; }
include_lan(e_PLUGIN."signup_secure/languages/".e_LANGUAGE.".php");
 
// Plugin info  
$eplug_name    = "Signup Secure";
$eplug_version = "1.2";
$eplug_author  = "Oyabunstyle";
$eplug_url = "http://oyabunstyle.de";
$eplug_email = "info@oyabunstyle.de";

$eplug_description = "This Plugin hides the submit button on signup.php as long as the calculation captia is not solved.";
$eplug_compatible  = "e107 v0.7+";
$eplug_readme      = "readme.php";

// Name of the admin configuration file  
$eplug_conffile = "readme.php";

// Name of the plugin's folder
$eplug_folder = "signup_secure";

// Name of menu item for plugin  
$eplug_menu_name = "Signup Secure";

// Icon image and caption text
$eplug_icon = $eplug_folder."/images/32.png";
$eplug_icon_small = $eplug_folder."/images/16.png";
$eplug_logo = $eplug_folder."/images/32.png";
$eplug_caption = "Signup Secure";

// List of preferences 
$eplug_prefs       = "";
$eplug_table_names = ""; 

// Create a link in main menu (yes=TRUE, no=FALSE) 
$eplug_link = TRUE;

// Text to display after plugin successfully installed 
$eplug_done           = "Installation Successful..";
$eplug_uninstall_done = "Uninstalled Successfully..";

?>