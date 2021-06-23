<?php
/*
+---------------------------------------------------------------+
|        Latest Release Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2009
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "latestrelease_menu/languages/" . e_LANGUAGE . ".php");
// Plugin info -------------------------------------------------------------------------------------------------------
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "latestrelease_menu";
$eplug_name = "Latest Release Menu";
$eplug_version = "2.8";
$eplug_author = "Barry";
$eplug_logo = $eplug_folder . "/images/lrelease_32.png";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = LATESTRELEASE_MENU_LAN_39;
$eplug_compatible = "e107 v7";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "latestrelease_menu.php";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/lrelease_32.png";
$eplug_icon_small = $eplug_folder . "/images/lrelease_16.png";
$eplug_caption = LATESTRELEASE_MENU_LAN_41;
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array("latedl_limitdown" => 0);
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = "";
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_url = "";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = LATESTRELEASE_MENU_LAN_40;
// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = "Upgraded";

if (!function_exists('latestrelease_menu_uninstall'))
{
    function latestrelease_menu_uninstall()
    {
        // get rid of the things we created
        global $sql;

        $sql->db_Delete('core', ' e107_name="latestrelease" ');
    }
}