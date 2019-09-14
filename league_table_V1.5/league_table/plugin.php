<?php
/*
+---------------------------------------------------------------+
|	League Table Plugin for e107
|
|	(C) 2007 Father Barry
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
include_lan(e_PLUGIN . "league_table/languages/" . e_LANGUAGE . ".php");
$eplug_name = "League Table";
$eplug_version = "1.5";
$eplug_author = "Father Barry";

$eplug_url = "http://www.keal.me.uk/";
$eplug_email = "";
$eplug_description = LEAGUE_P02;
$eplug_compatible = "e107v7";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "league_table";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/league_32.png";
$eplug_icon_small = $eplug_folder . "/images/league_16.png";
$eplug_caption = LEAGUE_P03;
// List of preferences -----------------------------------------------------------------------------------------------
// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/league_table_sql.php");
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


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = LEAGUE_P01;
$eplug_link_url = e_PLUGIN . "league_table/table.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = LEAGUE_P04;
// upgrading ...
$upgrade_add_prefs = "";
$upgrade_alter_tables = '';
$upgrade_remove_prefs = "";

$eplug_upgrade_done = LEAGUE_P05;
if (!function_exists("league_table_uninstall"))
{
    function league_table_uninstall()
    {
        // get rid of the things we created
        global $sql;

        $sql->db_Delete("core", " e107_name='league_table' ");
    }
}
?>