<?php
include_lan(e_PLUGIN . 'faq/languages/admin/' . e_LANGUAGE . '.php');
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = 'FAQ';
$eplug_version = '4.9';
$eplug_author = 'Father Barry - Based on the original FAQ Plugin by Cameron';
$eplug_url = 'http://www.keal.me.uk';
$eplug_email = '';
$eplug_description = FAQ_PLUG_01;
$eplug_compatible = 'e107 v0.7 11';
$eplug_readme = 'admin_readme.php'; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;
// Name of the plugin"s folder -------------------------------------------------------------------------------------
$eplug_folder = 'faq';
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = '';
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . '/images/faq_32.gif';
$eplug_caption = FAQ_PLUG_02;
$eplug_icon_small = $eplug_folder . '/images/faq_16.gif';
// List of preferences -----------------------------------------------------------------------------------------------
// prefs now handled in class
// List of table names -----------------------------------------------------------------------------------------------
// $eplug_table_names = array('faq_info', 'faq');
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . $eplug_folder . '/faq_sql.php');
preg_match_all('/CREATE TABLE (.*?)\(/i', $eplug_sql, $matches);
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
$eplug_link_name = FAQ_ADLAN_LINK;
$eplug_link_url = e_PLUGIN . 'faq/faq.php';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = FAQ_PLUG_03;

$eplug_upgrade_done = FAQ_PLUG_04;
#$upgrade_alter_tables = array(
#    "ALTER TABLE " . MPREFIX . "faq ADD INDEX faq_parent (faq_parent);",
#    "ALTER TABLE " . MPREFIX . "faq_info ADD INDEX (faq_info_parent); (faq_info_parent);",
#	"ALTER TABLE ".MPREFIX."faq  ADD COLUMN faq_updated int(11) unsigned NOT NULL DEFAULT 0 ;",
#	"ALTER TABLE ".MPREFIX."faq CHANGE COLUMN faq_answer faq_answer longtext NULL ;");

if (!function_exists('faq_uninstall'))
{
    function faq_uninstall()
    {
        global $sql;
        $sql->db_Delete('rate', ' rate_table="faq" ');
        $sql->db_Delete('comments', ' comment_type="faqfb" ');
        $sql->db_Delete('core', ' e107_name="faq" ');
    }
}

