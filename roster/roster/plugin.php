<?php

// Plugin info ---------------------------------------------------------------
$eplug_name          = "Roster by Carl Taylor";
$eplug_version       = "1.1.2";
$eplug_author        = "Carl Taylor";
$eplug_logo          = $eplug_folder."/images/icon_32.png";
$eplug_url           = "None";
$eplug_email         = "cajtaylor@googlemail.com";
$eplug_description   = "Designed for Clans to have a fully functional roster system";
$eplug_compatible    = "e107v0.7+";
$eplug_readme        = "readme.txt";

// Name of the plugin's folder -----------------------------------------------
$eplug_folder        = "roster";

// Name of menu item for plugin ----------------------------------------------
$eplug_menu_name     = "";

// Name of the admin configuration file --------------------------------------
$eplug_conffile      = "admin_main.php";

// Icon image and caption text -----------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       =  "Roster by Carl Taylor";

// List of preferences -------------------------------------------------------
$eplug_prefs = array();

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder."/roster_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(|INSERT INTO (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names = array_merge($matches[1],$matches[2]);

// List of sql requests to insert values -----------------------------------------------------------------------------
$tempstring = str_replace("INSERT INTO ", "INSERT INTO ".MPREFIX, $eplug_sql);
$tempstring = str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $tempstring);
$eplug_tables = explode(";",$tempstring);
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------------------
$eplug_link = TRUE;
$eplug_link_name = "Unit Roster";
$eplug_link_url = e_PLUGIN."roster/roster.php";

// Text to display after plugin successfully installed -----------------------
$eplug_done = "Installation of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";

// ************************************************************************************************
// upgrading ...
// ************************************************************************************************
$upgrade_add_prefs      = array();
$upgrade_remove_prefs   = array();
$upgrade_alter_tables   = array();
$eplug_upgrade_done     = "Upgrade of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";;