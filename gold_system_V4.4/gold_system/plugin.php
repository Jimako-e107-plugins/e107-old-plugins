<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');
$eplug_name = 'Gold System';
$eplug_version = '4.4';
$eplug_author = 'Father Barry';
$eplug_folder = 'gold_system';
$eplug_icon = $eplug_folder . '/images/gold_32.gif';
$eplug_icon_small = $eplug_folder . '/images/gold_16.gif';
$eplug_url = 'www.keal.me.uk';
$eplug_email = '';
$eplug_description = ADLAN_GS_PM_02;
$eplug_compatible = 'e107v0.7.11+';
$eplug_compliant = true;
$eplug_menu_name = 'gold_system_menu';
$eplug_conffile = 'admin_config.php';
$eplug_caption = ADLAN_GS_PM_01;
$eplug_done = ADLAN_GS_PM_03;
$eplug_upgrade_done = ADLAN_GS_PM_04;
// prefs created in class
// create tables -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN . "{$eplug_folder}/gold_system_sql.php");
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

// upgrade from version 3.04

if (substr($pref['plug_installed']['gold_system'], 0, 1) == 3)
{
    $upgrade_alter_tables = array ("ALTER TABLE " . MPREFIX . "gold_system CHANGE COLUMN id gold_id int(11) unsigned NOT NULL DEFAULT '0' NULL, ADD PRIMARY KEY (gold_id), DROP PRIMARY KEY ;",
        "ALTER TABLE " . MPREFIX . "gold_system CHANGE COLUMN gold gold_balance decimal(10,2) NOT NULL DEFAULT '0' ;",
        "ALTER TABLE " . MPREFIX . "gold_system CHANGE COLUMN spent gold_spent decimal(10,2) NOT NULL DEFAULT '0' ;",
        "ALTER TABLE " . MPREFIX . "gold_system CHANGE COLUMN inv gold_inv text NULL ;",
        "ALTER TABLE " . MPREFIX . "gold_system CHANGE COLUMN orb gold_orb text NULL ;",
        "ALTER TABLE " . MPREFIX . "gold_system ADD COLUMN gold_credit decimal(10,2) NOT NULL DEFAULT 0 AFTER gold_spent;",
        "ALTER TABLE " . MPREFIX . "gold_system ADD COLUMN gold_additional text NULL AFTER gold_orb;",
        "ALTER TABLE " . MPREFIX . "gold_system_history CHANGE COLUMN id gold_hist_id bigint(11) unsigned NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (gold_hist_id), DROP PRIMARY KEY ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history CHANGE COLUMN user_id gold_hist_user_id  int(11) unsigned NOT NULL DEFAULT '0'  ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history CHANGE COLUMN date gold_hist_date int(11) unsigned NOT NULL DEFAULT '0'  ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history CHANGE COLUMN type gold_hist_type text  NULL ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history CHANGE COLUMN amount gold_hist_amount decimal(10,2) NOT NULL DEFAULT '0'  ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history CHANGE COLUMN who gold_hist_who int(11) UNSIGNED NOT NULL DEFAULT '0'  ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history CHANGE COLUMN comment gold_hist_comment text  NULL ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history ADD COLUMN gold_hist_plugin varchar(100) NULL DEFAULT NULL AFTER gold_hist_comment ;",
        "ALTER TABLE " . MPREFIX . "gold_system_history ADD COLUMN gold_hist_forum_post int(11) unsigned NOT NULL DEFAULT 0 AFTER gold_hist_plugin;"
        );
}
// Deleting plugin ...//
if (!function_exists('gold_system_uninstall'))
{
    function gold_system_uninstall()
    {
        // get rid of the things we created
        global $sql;
        $sql->db_Delete('core', ' e107_name="gold" ');
    }
}

?>