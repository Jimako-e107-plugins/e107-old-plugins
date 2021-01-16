<?php
// ***************************************************************
// *
// *		Title		:	Delete Me
// *
// *		Author		:	Barry Keal (C) 2004-2008
// *
// *		Date		:	10 September 2004
// *
// *		Version		:	1.6
// *
// *		Description	: 	Utility to allow users to delete their own account
// *
// *		Revisions	:	15 Sep 2004 Added useclass check
// *									Email confirmation
// *									Changed setting for security code
// *									Added feedback why leaving
// *					:	03 Oct 2004 Consistent admin interface
// *					:	10 Jly 2006 Converted to e107 v7xx
// *					:	19 Dec 2007 Added email address in history
// *					:	24 Jun 2008 Added IP address in history
// *
// ***************************************************************
// **************************************************************************
// *
// *  Delete Username
// *
// **************************************************************************
/*
+---------------------------------------------------------------+
|       Delete Me for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "deleteme/languages/admin/" . e_LANGUAGE . ".php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Delete Me";
$eplug_version = "1.7";
$eplug_author = "Father Barry";
$eplug_logo = "/images/deleteme.png";
$eplug_url = "www.keal.me.uk";
$eplug_email = "";
$eplug_description = DELETEME_A3;
$eplug_compatible = "e107v7";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "deleteme";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/deleteme.png";
$eplug_icon_small = $eplug_folder."/images/deleteme_16.png";
$eplug_caption = DELETEME_A2;
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs =  array(
    "deleteme_userclass" => 253,
    "deleteme_useseccode" => 1,
    "deleteme_confirmemail" => 1,
    "deleteme_survey" => 1,
	"deleteme_perpage" => 10);

// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/deleteme_sql.php");
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
$eplug_link_name = DELETEME_A1;
$eplug_link_url = e_PLUGIN . "deleteme/deleteme.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = DELETEME_A4;
// upgrading ... //
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = array("ALTER TABLE ".MPREFIX."deleteme_why ADD deleteme_ipaddress varchar(20) NOT NULL default '' AFTER deleteme_dateleft ;");

$eplug_upgrade_done = "";

?>