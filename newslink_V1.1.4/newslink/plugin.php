<?php
if (!defined('e107_INIT'))
{
    exit;
}
// ***************************************************************
// *
// *		Title		:	Newslinks Menu
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	30 Dec 2007
// *
// *		Version		:	1.1
// *
// *		Description	: 	Archive of Newslinks
// *
// *		Revisions	:	 30 Dec 2007 Initial Design

// *
// *		Support at	:	www.keal.me.uk
// *
// ***************************************************************
include_lan(e_PLUGIN . "newslink/languages/" . e_LANGUAGE . ".php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Newslinks";
$eplug_version = "1.1.4";
$eplug_author = "Father Barry";
$eplug_url = "http://keal.me.uk";
$eplug_email = "";
$eplug_description = NEWSLINK_A109;
$eplug_compatible = "e107v7";
$eplug_readme = "admin_readme.php";	// leave blank if no readme file
$eplug_compliant=TRUE;
$eplug_status = TRUE;
$eplug_latest = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "newslink";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "Newslinks Menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon_small = $eplug_folder."/images/newslink_16.png";
$eplug_icon = $eplug_folder."/images/newslink_32.png";
$eplug_caption =  NEWSLINK_A108;

// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/{$eplug_folder}_sql.php");
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
$eplug_link = TRUE;
$eplug_link_name = NEWSLINK_A107;
$eplug_link_url = e_PLUGIN."newslink/newslink.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = NEWSLINK_A105;


// upgrading ... //

$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";

$upgrade_alter_tables = "";

$eplug_upgrade_done = NEWSLINK_A106;

if (!function_exists("newslink_uninstall"))
{
    function newslink_uninstall()
    {
        global $sql;
        $sql->db_Delete("rate", " rate_table='newslinks' ");
        $sql->db_Delete("core", " e107_name='newslinks' ");
    }
}
?>