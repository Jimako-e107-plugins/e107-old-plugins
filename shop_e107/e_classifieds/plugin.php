<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|	With additional mods by steved
+---------------------------------------------------------------+
*/
// Plugin info -------------------------------------------------------------------------------------------------------
include_lan(e_PLUGIN . 'e_classifieds/languages/' . e_LANGUAGE . '.php');
$eplug_name = 'e_Classifieds';
$eplug_version = '2.24';
$eplug_author = 'Father Barry';

$eplug_url = 'http://www.keal.me.uk/';
$eplug_email = '';
$eplug_description = ECLASSF_P01;
$eplug_compatible = 'e107v7';
$eplug_readme = 'admin_readme.php'; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = 'e_classifieds';
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = '';
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = 'admin_config.php';
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . '/images/icon_32.png';
$eplug_icon_small = $eplug_folder . '/images/icon_16.png';
$eplug_caption = ECLASSF_P02;
// List of preferences -----------------------------------------------------------------------------------------------
// preferences now handled in class
// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/classifieds_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
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
$eplug_link = true;
$eplug_link_name = 'Classifieds';
$eplug_link_url = e_PLUGIN . 'e_classifieds/classifieds.php';
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = ECLASSF_P03;
// upgrading ...
$upgrade_add_prefs = '';

$upgrade_remove_prefs = '';
// Upgrading to version 2.xx
#$upgrade_alter_tables = array('ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cid eclassf_id int(11) NULL AUTO_INCREMENT;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cname eclassf_name varchar(50) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cdesc eclassf_desc varchar(100) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_ccat eclassf_category int(10) unsigned not null default 0;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cpic eclassf_thumbnail varchar(100) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cdetails eclassf_details text NULL;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_capproved eclassf_approved int(10) unsigned not null default 0;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cuser eclassf_user varchar(100) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cph eclassf_phone varchar(30) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cemail eclassf_email varchar(100) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_ccdate eclassf_expires  int(10) unsigned not null default 0;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_cpdate elcassf_posted  int(10) unsigned not null default 0;',
#    'ALTER TABLE #eclassf_ads CHANGE COLUMN eclassf_last eclassf_lastupdated  int(10) unsigned not null default 0;',
#    'ALTER TABLE #eclassf_ads ADD INDEX  name (eclassf_name );',
#    'ALTER TABLE #eclassf_ads ADD INDEX  descript (eclassf_desc );',
#    'ALTER TABLE #e107_eclassf_ads  ADD INDEX category (eclassf_category)',
#    'ALTER TABLE #eclassf_cats CHANGE COLUMN eclassf_catname eclassf_catname varchar(50) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_cats CHANGE COLUMN eclassf_catdesc eclassf_catdesc varchar(100) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_cats ADD INDEX  catname (eclassf_catname );',
#    'ALTER TABLE #eclassf_subcats CHANGE COLUMN  eclassf_subname eclassf_subname varchar(50) NULL DEFAULT NULL;',
#    'ALTER TABLE #eclassf_subcats ADD INDEX subname (eclassf_subname );',
#    'ALTER TABLE #eclassf_subcats CHANGE COLUMN eclassf_ccatid eclassf_categoryid  int(10) unsigned not null default 0;'
#    );

$eplug_upgrade_done = ECLASSF_P04;
if (!function_exists('e_classifieds_uninstall'))
{
    function e_classifieds_uninstall()
    {
        global $sql;
        $sql->db_Delete('rate', 'rate_table="classifieds"');
        $sql->db_Delete('core', 'e107_name="classifieds"');
    }
}

?>