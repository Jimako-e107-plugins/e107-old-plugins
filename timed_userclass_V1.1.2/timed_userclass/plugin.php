<?php
/*
+---------------------------------------------------------------+
|	Timed Userclass Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// ***************************************************************
// *
// *		Title		:	Time based change to members userclass
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	31 March 2008
// *
// *		Version		:	1.1
// *
// *		Description	: 	Time based change to members userclass
// *
// *		Revisions	:	31 March 2008
// *
// *		Support at	:	www.keal.me.uk
// *
// *		Copyright	:	B Keal 2003-2008
// *
// ***************************************************************
// Plugin info -------------------------------------------------------------------------------------------------------
include_lan(e_PLUGIN . "timed_userclass/languages/admin/" . e_LANGUAGE . ".php");
$eplug_name = "Timed Userclass";
$eplug_version = "1.1.2";
$eplug_author = "Father Barry ";
$eplug_logo = "images/tclass_32.png";
$eplug_url = "http://www.keal.me.uk";
$eplug_email = "";
$eplug_description = TCLASS_M01;
$eplug_compatible = "e107v7";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "timed_userclass";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/tclass_32.png";
$eplug_icon_small = $eplug_folder . "/images/tclass_16.png";
$eplug_caption = TCLASS_M02;
// List of preferences -----------------------------------------------------------------------------------------------
// done in class
// List of table names -----------------------------------------------------------------------------------------------
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/timed_userclass_sql.php");
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
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_url = "";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = TCLASS_M03;
// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = TCLASS_M04;

if (!function_exists("timed_userclass_uninstall"))
{
    function timed_userclass_uninstall()
    {
        global $sql;

        $sql->db_Delete("core", "e107_name='tuclass'");
    }
}

?>