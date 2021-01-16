<?php
/*
+---------------------------------------------------------------+
|        e_Version for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "e_version";
$eplug_version = "1.3";
$eplug_author = "Barry";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = "Current Version Checker for Plugins";
$eplug_compatible = "e107 v0.7 only";
$eplug_readme = "admin_readmen.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "e_version";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "e_version";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/icon.gif";
$eplug_caption = "Configure e Version";
$eplug_icon_small = $eplug_folder . "/images/icon_16.gif";
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array("eversion_url" => "your url",
    "eversion_read" => 254,
    "eversion_inmenu" => 5,
    "eversion_noplug" => 10,
    "eversion_usedownloads" => 1,
    "eversion_usebugs" => 1,
    "eversion_useforums" => 1,
    "eversion_dformat" => "d-m-Y");
// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . $eplug_folder . '/e_version_sql.php');
preg_match_all('/CREATE TABLE (.*?)\(/i', $eplug_sql, $matches);
$eplug_table_names = $matches[1];
// List of sql requests to create tables -----------------------------------------------------------------------------
// Apply create instructions for every table you defined in locator_sql.php --------------------------------------
// MPREFIX must be used because database prefix can be customized instead of default e107_
$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE ' . MPREFIX, $eplug_sql));
for ($i = 0; $i < count($eplug_tables); $i++)
{
    $eplug_tables[$i] .= ';';
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = "Plugin Updates";
$eplug_link_url = e_PLUGIN . "e_version/eversion.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "The e_Version plugin is installed. Now Configure it.";

$eplug_upgrade_done = "";
$upgrade_alter_tables = "";

?>