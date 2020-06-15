<?php
/*
+---------------------------------------------------------------+
| Election by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/election/plugin.php,v $
| $Revision: 1.5 $
| $Date: 2008/02/10 15:16:02 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
// Plugin info ---------------------------------------------------------------
$eplug_name          = "Election";
$eplug_version       = "2.0";
$eplug_folder        = "election";
$eplug_author        = "bugrain";
$eplug_logo          = $eplug_folder."/images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = "Election plugin for holding online elections";
$eplug_compatible    = "2.3";
$eplug_readme        = "readme.php";

// Mane of menu item for plugin ----------------------------------------------
$eplug_menu_name     = "";

// Name of the admin configuration file --------------------------------------
$eplug_conffile      = "admin_prefs.php";

// Icon image and caption text -----------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       =  "Configure Election";

// List of preferences -------------------------------------------------------
$eplug_prefs = array(
	"election_pagetitle"                => "Election",
	"election_separator"                => " :: ",
	"election_view_class"               => 0,
	"election_tooltips"                 => 1,
	"election_global_template"          => "default",
	"election_elections_order"          => " order by election_id asc",
	"election_elections_per_page"       => 20,
	"election_candidates_per_page"      => 20,
	"election_notify_owner_vote"         => 0,
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder."/election_sql.php");
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
$eplug_link_name = "Election";
$eplug_link_url = e_PLUGIN.$eplug_folder."/election.php";

// Text to display after plugin successfully installed -----------------------
$eplug_done = "Installation of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";

// ************************************************************************************************
// upgrading ...
// ************************************************************************************************
$upgrade_add_prefs      = array();
$upgrade_remove_prefs   = array();
$upgrade_alter_tables   = array();
$eplug_upgrade_done     = "Upgrade of <b>$eplug_name</b> version <b>$eplug_version</b> was successful...";;

