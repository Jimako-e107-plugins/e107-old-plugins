<?php
// ***************************************************************
// *
// *		Title		:	Portfolio
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	10 March 2008
// *
// *		Version		:	1.1
// *
// *		Description	: 	An Portfolio
// *
// *		Revisions	:	10 March 2008 Initial Design
// *		Support at	:	www.keal.me.uk
// *
// ***************************************************************
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
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

include_lan(e_PLUGIN . 'portfolio/languages/' . e_LANGUAGE . '.php');
$eplug_name = 'Portfolio';
$eplug_version = '1.1.9';
$eplug_author = 'Father Barry';
$eplug_url = 'http://www.keal.me.uk';
$eplug_email = '';
$eplug_description = PORTFOLIO_PLUG1;
$eplug_compatible = 'e107 v7.11+';
$eplug_readme = 'admin_readme.php'; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'portfolio';
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = '';
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . '/images/pallette_32.png';
$eplug_icon_small = $eplug_folder . '/images/pallette_16.png';
$eplug_caption = PORTFOLIO_A120;
// List of preferences -----------------------------------------------------------------------------------------------
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/portfolio_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names = $matches[1];
// create tables -----------------------------------------------------------------------------------------------
$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE ' . MPREFIX, $eplug_sql));
for ($i = 0; $i < count($eplug_tables); $i++)
{
    $eplug_tables[$i] .= ';';
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = PORTFOLIO_PLUG2;
$eplug_link_url = e_PLUGIN . 'portfolio/portfolio.php';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = PORTFOLIO_A118;
// upgrading ... //
$upgrade_add_prefs = '';

$upgrade_remove_prefs = '';

$eplug_upgrade_done = PORTFOLIO_A119;

if (!function_exists('portfolio_uninstall'))
{
    function portfolio_uninstall()
    {
        global $sql;
        $sql->db_Delete('rate', ' rate_table="portfolio" ');
        $sql->db_Delete('comments', ' comment_type="portfolio" ');
        $sql->db_Delete('core', ' e107_name="portfolio" ');
    }
}
?>