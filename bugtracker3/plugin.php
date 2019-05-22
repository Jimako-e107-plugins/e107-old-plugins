<?php
/*
+---------------------------------------------------------------+
| Bugtracker3 by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/bugtracker3/plugin.php,v $
| $Revision: 1.1.2.8 $
| $Date: 2006/12/09 19:37:29 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Plugin info ---------------------------------------------------------------
$eplug_name          = "Bugtracker3";
$eplug_version       = "1.0_rc6";
$eplug_author        = "bugrain";
$eplug_logo          = $eplug_folder."/images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = "Bugtracker plugin allows users of your applications to posts bugs and allows admin to set bug options etc.";
$eplug_compatible    = "e107v0.7+";
$eplug_readme        = "readme.php";

// Name of the plugin's folder -----------------------------------------------
$eplug_folder        = "bugtracker3";

// Mane of menu item for plugin ----------------------------------------------
$eplug_menu_name     = "";

// Name of the admin configuration file --------------------------------------
$eplug_conffile      = "admin_prefs.php";

// Icon image and caption text -----------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       =  "Configure Bugtracker3";

// List of preferences -------------------------------------------------------
$eplug_prefs = array(
	"bugtracker3_pagetitle"                => "Bugtracker3",
	"bugtracker3_separator"                => "::",
	"bugtracker3_globalclass"              => 0,
	"bugtracker3_adminedit"                => 1,
	"bugtracker3_emoticons"                => 1,
	"bugtracker3_bbcodes"                  => 1,
	"bugtracker3_tooltips"                 => 1,
	"bugtracker3_ajax"                     => 0,
	"bugtracker3_global_template"          => "default",
	"bugtracker3_appsorder"                => " order by bugtracker3_apps_id asc",
	"bugtracker3_appspage"                 => 20,
	"bugtracker3_bugspage"                 => 20,
	"bugtracker3_menu_summary_title"       => "Bugtracker Summary",
	"bugtracker3_menu_application_title"   => "Application Summary",
	"bugtracker3_notify_owner_new"         => 0,
	"bugtracker3_notify_owner_edit"        => 0,
	"bugtracker3_notify_owner_comment"     => 0,
	"bugtracker3_notify_owner_dev_comment" => 0,
	"bugtracker3_notify_poster_new"        => 0,
	"bugtracker3_notify_poster_edit"       => 0,
	"bugtracker3_notify_poster_comment"    => 0,
	"bugtracker3_notify_poster_dev_comment"=> 0,
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder."/bugtracker3_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------------------
$eplug_link = TRUE;
$eplug_link_name = "Bugtracker3";
$eplug_link_url = e_PLUGIN.$eplug_folder."/bugtracker3.php";

// Text to display after plugin successfully installed -----------------------
$eplug_done = "Installation of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";

// ************************************************************************************************
// upgrading ...
// ************************************************************************************************
$upgrade_add_prefs      = array();
$upgrade_remove_prefs   = array();
$upgrade_alter_tables   = array();
$eplug_upgrade_done     = "Upgrade of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";;

?>