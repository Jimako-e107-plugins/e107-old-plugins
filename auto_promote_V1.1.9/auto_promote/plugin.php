<?php
/*
+---------------------------------------------------------------+
|	Auto Promote Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2009
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// ***************************************************************
// *
// *		Title		:	Auto promote members to a userclass
// *
// *		Author		:	Barry Keal
// *
// *		Date		:	16 April 2007
// *
// *		Version		:	1.1.9
// *
// *		Description	: 	Auto assign members to a userclass
// *
// *		Revisions	:	16 April 2007
// *
// *		Support at	:	www.keal.me.uk
// *
// *		Copyright	:	B Keal 2007-2009
// *
// ***************************************************************
// Plugin info -------------------------------------------------------------------------------------------------------
include_lan(e_PLUGIN . 'auto_promote/languages/admin/' . e_LANGUAGE . '.php');
$eplug_name = 'Auto Promote';
$eplug_version = '1.1.9';
$eplug_author = 'Father Barry ';
$eplug_logo = 'images/aprom_32.png';
$eplug_url = 'http://www.keal.me.uk';
$eplug_email = '';
$eplug_description = APROM_M01;
$eplug_compatible = 'e107v7';
$eplug_readme = 'admin_readme.php'; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin"s folder -------------------------------------------------------------------------------------
$eplug_folder = 'auto_promote';
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = 'auto_promote';
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . '/images/aprom_32.png';
$eplug_icon_small = $eplug_folder . '/images/aprom_16.png';
$eplug_caption = APROM_M02;
// List of preferences -----------------------------------------------------------------------------------------------
// done in class
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array('aprom');
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . $eplug_folder.'/auto_promote_sql.php');
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
$eplug_link = false;
$eplug_link_name = '';
$eplug_link_url = '';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = APROM_M03;
// upgrading ... //
$upgrade_add_prefs = '';

$upgrade_remove_prefs = '';

$upgrade_alter_tables = array('ALTER TABLE '.MPREFIX.'aprom ADD COLUMN aprom_order int(11) unsigned NOT NULL DEFAULT 0 ;',
  'alter table '.MPREFIX.'aprom add column aprom_method char(10) default">=" after aprom_id');

$eplug_upgrade_done = APROM_M04;

if (!function_exists('auto_promote_uninstall'))
{
    function auto_promote_uninstall()
    {
        global $sql;

        $sql->db_Delete('core', 'e107_name="aprom"');
    }
}

?>