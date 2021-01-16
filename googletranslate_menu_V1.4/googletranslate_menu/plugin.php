<?php

if (!defined('e107_INIT'))
{
    exit;
}
// Plugin info
include_lan(e_PLUGIN . "googletranslate_menu/languages/" . e_LANGUAGE . ".php");
$eplug_name = "Google Translate";
$eplug_version = "1.4";
$eplug_author = "Father Barry";
$eplug_description = GTM_LAN_P04;
$eplug_compatible = "e107 v0.7";
$eplug_readme = "admin_readme.php";
$eplug_compliant = true;
$eplug_status = false;
$eplug_latest = false;
// Name of the plugin's folder
$eplug_folder = "googletranslate_menu";
$eplug_icon = $eplug_folder . "/images/gtran_32.png";
$eplug_caption = "";
$eplug_icon_small = $eplug_folder . "/images/gtran_16.png";


// Mane of menu item for plugin
$eplug_menu_name = "googletranslate";
// Name of the admin configuration file
$eplug_conffile = "admin_config.php";
// List of preferences
$eplug_prefs = "";
$eplug_module = false;
$eplug_table_names = "";
// Create a link in main menu (yes=TRUE, no=FALSE)
$eplug_link = false;
$eplug_link_name = "";
$eplug_link_perms = "";
// Text to display after plugin successfully installed
$eplug_done = GTM_LAN_P02;
$eplug_uninstall_done = GTM_LAN_P03;

if (!function_exists('googletranslate_menu_uninstall'))
{
    function googletranslate_menu_uninstall()
    {
        global $sql;
        $sql->db_Delete('core', 'e107_name="google_trans"');
    }
}
?>