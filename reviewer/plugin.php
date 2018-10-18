<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Reviewer";
$eplug_version = "1.7";
$eplug_author = "Father Barry";
$eplug_logo = "/images/reviewer_32.png";
$eplug_url = "http://keal.me.uk";
$eplug_email = "";
$eplug_description = REVIEWER_A002;
$eplug_compatible = "e107 v7+";
$eplug_readme = "admin_readme.php"; // leave blank if no readme file
$eplug_compliant = true;
$eplug_status = true;
$eplug_latest = true;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "reviewer";
// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "";
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder . "/images/reviewer_32.png";
$eplug_icon_small = $eplug_folder . "/images/reviewer_16.png";
$eplug_caption = REVIEWER_A122;
// List of preferences -----------------------------------------------------------------------------------------------
// now done in class
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
$eplug_link = true;
$eplug_link_name = REVIEWER_A003;
$eplug_link_url = e_PLUGIN . "reviewer/reviewer.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = REVIEWER_A004;
// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
// version 1.4.3 to 1.4.4

/*
$upgrade_alter_tables = array(
'ALTER TABLE ' . MPREFIX . 'reviewer_category CHANGE COLUMN reviewer_category_description reviewer_category_description text ;',
'ALTER TABLE ' . MPREFIX . 'reviewer_items ADD INDEX reviewer_items_catid (reviewer_items_catid) ;',
'ALTER TABLE ' . MPREFIX . 'reviewer_items ADD INDEX reviewer_items_name (reviewer_items_name) ;',
'ALTER TABLE ' . MPREFIX . 'reviewer_reviewer ADD INDEX reviewer_itemid (reviewer_reviewer_itemid) ;',
'ALTER TABLE ' . MPREFIX . 'reviewer_category ADD INDEX reviewer_category_name (reviewer_category_name) ;');
*/
$eplug_upgrade_done = REVIEWER_A005;

if (substr($pref['plug_installed']['reviewer'],0,3) == '1.1')
{
    if (!is_object($reviewer_obj))
    {
        require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
        $reviewer_obj = new reviewer;
        $reviewer_obj->recalc_all();
    }
}
if (!function_exists("reviewer_uninstall"))
{
    function reviewer_uninstall()
    {
        global $sql;
        $sql->db_Delete("core", " e107_name='reviewer' ");
        $sql->db_Delete("comments", " comment_type='reviewer' ");
    }
}

?>