<?php
/*
+---------------------------------------------------------------+
| e107helpers_developer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/e107helpers_developer/plugin.php,v $
| $Revision: 1.1 $
| $Date: 2007/01/10 23:59:06 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
$eplug_name          = "e107Helper Developer";
$eplug_version       = "1.0rc1";
$eplug_folder        = "e107helpers_developer";
$eplug_author        = "bugrain";
$eplug_logo          = $eplug_folder."/images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = "A plugin which utilises and demonstartes The e107helper Helper plugin for developers.";
$eplug_compatible    = "e107v0.7.7+";
$eplug_readme        = "admin_prefs.php?99";
$eplug_compliant     = false;
$eplug_conffile      = "admin_prefs.php";
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       = "Configure e107helpers developer";
$eplug_link          = false;
$eplug_link_name     = "";
$eplug_link_url      = "";
$eplug_done          = "Installation complete";
$eplug_upgrade_done  = "Upgrade complete";
$eplug_prefs         = "";

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN."{$eplug_folder}/{$eplug_folder}_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Array of new preferences for this plugin, with default values, for upgrading.
$upgrade_add_prefs = array();

// Array of preferences for this plugin to be removed when upgrading
$upgrade_remove_prefs = array();

// SQL statements to be executed when the plugin is upgraded
$upgrade_alter_tables = array();
?>