<?php
/**
 * e107plugin_template by bugrain (www.bugrain.plus.com)
 *
 * A plugin for the e107 Website System (http://e107.org)
 *
 * Released under the terms and conditions of the
 * GNU General Public License (http://gnu.org).
 *
 * $Source: e:\_repository\e107_plugins/e107helpers/plugin.php,v $
 * $Revision: 1.3 $
 * $Date: 2007/08/01 23:36:32 $
 * $Author: Neil $
 * @package e107HelperAdmin
 * @access private
 */

/**
 * @package e107HelperAdmin
 * @access private
 */
if (file_exists(e_PLUGIN."e107helpers/languages/".e_LANGUAGE.".php")) {
   require_once(e_PLUGIN."e107helpers/languages/".e_LANGUAGE.".php");
} else {
   require_once(e_PLUGIN."e107helpers/languages/English.php");
}
require_once(e_PLUGIN."e107helpers/e107Helper_constants.php");

$eplug_name          = HELPER_TITLE;                           // Name of the plugin, as displayed in Plugin Manager
$eplug_version       = HELPER_VER;                             // Plugin version number
$eplug_author        = "bugrain";                              // What you want to be know as with respect to authoring this plugin
$eplug_logo          = "button.png";                           // ????
$eplug_url           = "http://www.bugrain.plus.com";          // Your website, will have a link in plugin manager
$eplug_email         = "bugrain@bugrain.plus.com";             // Your e-mail address, will have a mailto link in plugin manager
$eplug_description   = HELPER_LAN_02;                          // A short and meaningful description for your plugin, will be displayed in plugin manager
$eplug_compatible    = "e107v0.7";                             // Which version of e107 is ithis plugin compatible with, examples are e107v0.617, e107v0.617+, e107v0.7
$eplug_readme        = "admin_readme.php";                     // The name of an overview file (normally admin_readme.php), will have a link in plugin manager
$eplug_compliant     = false;                                  // Is this plugin W3C XHTML compliant, if not or you ar not sure, set to false (see XXXXXXXXX to check compatibility)
$eplug_folder        = "e107helpers";                          // The Name of the plugin's folder
$eplug_menu_name     = "e107helpers";                          // Nane of menu item for plugin
$eplug_conffile      = "admin_readme.php";                     // Name of the admin configuration file (prefix all admin preference/option/configuration files with admin_ so they pick up the admin theme in e107 0.7)
$eplug_icon          = $eplug_folder."/images/icon_32.png";    // Icon image files - usual size is 32x32
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";    // Icon image files - usual size is 16x16
$eplug_caption       = "Configure e107 Helper";                // ????
$eplug_link          = false;                                  // Creates a link in the standard e107 menu (i.e. sitelink) when true
$eplug_link_name     = "";                                     // Text for the site link (above) if created
$eplug_link_url      = "";                                     // Relative URL to the main plugin page for the site link (above) if created
$eplug_done          = HELPER_LAN_06;                          // Text to display after plugin successfully installed
$eplug_upgrade_done  = HELPER_LAN_07;                          // Text to display after plugin successfully upgraded

// Array of preferences for this plugin, with default values. These will be used when the plugin is installed for the first time
$eplug_prefs = array(
   "helper_logger_level"         => HELPER_LOGGER_OFF,
   "helper_debug"                => "",
   "helper_style_label_class"    => "forumheader3",
   "helper_style_prompt_class"   => "smalltext",
   "helper_style_help_class"     => "smalltext",
   "helper_style_message_class"  => "forumheader",
   "helper_style_error_class"    => "searchhighlight",
   "helper_style_submit_style"   => "text-align:center;",
);

// Array of database tables created/used by this plugin, names do NOT include e107 database table prefix
$eplug_table_names = array();

// SQL statements to be executed when the plugin is installed for the first time. Normally an array of strings to create database tables
// but can alos include, for example, SQL INCLUDE statements to pre-populate the tables with default values, sample data, etc.
$eplug_tables = array();

// Array of new preferences for this plugin, with default values, for upgrading.
$upgrade_add_prefs = array(
   "helper_debug"                => "",
);

// Array of preferences for this plugin to be removed when upgrading
$upgrade_remove_prefs = array();

// SQL statements to be executed when the plugin is upgraded
$upgrade_alter_tables = array();
?>