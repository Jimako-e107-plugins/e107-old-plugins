<?php
/*
+---------------------------------------------------------------+
|        On This Day Menu for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "onthisday_menu/languages/" . e_LANGUAGE . ".php");
$eplug_name = "On This Day";
$eplug_version = "1.5";
$eplug_author = "Father Barry";
$eplug_logo = "images/otd_32.png";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = OTD_P02;
$eplug_compatible = "e107v7+";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin's folder:
$eplug_folder = "onthisday_menu";
// Name of menu item for plugin:
$eplug_menu_name = "On This Day";
// Name of the table configuration file:
$eplug_conffile = "admin_config.php";
// Icon image and caption text:
$eplug_icon = $eplug_folder . "/images/otd_32.png";
$eplug_icon_small = $eplug_folder . "/images/otd_16.png";
$eplug_caption = OTD_P01;
// List of preferences:

// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/onthisday_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names = $matches[1];
// List of sql requests to create tables -----------------------------------------------------------------------------
// Apply create instructions for every table you defined in locator_sql.php --------------------------------------
// MPREFIX must be used because database prefix can be customized instead of default e107_
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE " . MPREFIX, $eplug_sql));
for ($i = 0; $i < count($eplug_tables); $i++)
{
    $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE):
$eplug_link = true;
$eplug_link_name = OTD_P04;
$eplug_link_url = e_PLUGIN . "onthisday_menu/onthisday.php";
// Text to display after plugin successfully installed:
$eplug_done = OTD_P03;
// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = array('alter table '.MPREFIX.'onthisday add column otd_poster int(11)  unsigned not null default "0" after otd_full');
$eplug_upgrade_done = "";
if (!function_exists('onthisday_menu_uninstall'))
{
    function onthisday_menu_uninstall()
    {
        // get rid of the things we created
        global $sql;

        $sql->db_Delete('core', ' e107_name="onthisday" ');
    }
}
