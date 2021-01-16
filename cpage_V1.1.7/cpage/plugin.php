<?php
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . 'cpage/languages/' . e_LANGUAGE . '_cpage.php');
if (!defined("e107_INIT"))
{
    exit;
}
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'Custom Page Maker';
$eplug_version = '1.1.7';
$eplug_author = 'Father Barry';
$eplug_logo = '/images/cpage_32.png';
$eplug_url = 'http://keal.me.uk';
$eplug_email = '';
$eplug_description = CPAGE_P02;
$eplug_compatible = 'e107 v7';
$eplug_readme = 'admin_readme.php'; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = false;
$eplug_folder = 'cpage';
$eplug_conffile = 'admin_config.php';
$eplug_icon = $eplug_folder . '/images/cpage_32.png';
$eplug_icon_small = $eplug_folder . '/images/cpage_16.png';
$eplug_caption = CPAGE_P01;
$eplug_link = true;
$eplug_link_name = CPAGE_P01;
$eplug_link_url = 'cpage.php';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = CPAGE_P03;
// List of preferences -----------------------------------------------------------------------------------------------
// prefs now set in cpage class
// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . $eplug_folder.'/custom_page_sql.php');
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

// upgrading ... //
$upgrade_add_prefs = '';
$upgrade_remove_prefs = '';
$upgrade_alter_tables = '';
$eplug_upgrade_done = CPAGE_P04;
// Deleting plugin ...//
if (!function_exists('cpage_uninstall'))
{
    /**
     * cpage_uninstall()
     *
     * @return void
     */
    function cpage_uninstall()
    {
        // get rid of the things we created
        global $sql;
        $sql->db_Delete('rate', ' rate_table="cpage" ');
        $sql->db_Delete('comments', ' comment_type="cpage" ');
        $sql->db_Delete('core', ' e107_name="cpage" ');
    }
}

?>