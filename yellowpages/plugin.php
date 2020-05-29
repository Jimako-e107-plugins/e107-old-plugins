<?php
/*
+---------------------------------------------------------------+
| Yellow Pages by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/yellowpages/plugin.php,v $
| $Revision: 1.5.2.2 $
| $Date: 2007/02/07 00:28:59 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

// Include the variables file
require_once(e_PLUGIN."yellowpages/yellowpagesVariables.php");

// Plugin info ---------------------------------------------------------------
$eplug_name          = YELL_NAME;
$eplug_version       = YELL_VER;
$eplug_folder        = "yellowpages";
$eplug_author        = "bugrain";
$eplug_logo          = $eplug_folder."images/yellow_pages_icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = YELL_DESC;
$eplug_compatible    = "e107v0.7.7";
$eplug_readme        = "admin_readme.php";
$eplug_compliant     = FALSE;
$eplug_menu_name     = YELL_NAME;
$eplug_conffile      = "admin_prefs.php";
$eplug_icon          = $eplug_folder."/images/yellow_pages_icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/yellow_pages_icon_16.png";
$eplug_caption       = YELL_01;

// List of preferences
$eplug_prefs = array(
   "yellowpages_page_title"               => YELL_NAME,
   "yellowpages_menu_title"               => YELL_NAME,
   "yellowpages_visibility"               => "0",
   "yellowpages_logo_dir"                 => e_FILES,
   "yellowpages_logo_max_width"           => "100",
   "yellowpages_allow_comments"           => "255",
   "yellowpages_allow_ratings"            => "255",
   "yellowpages_separator"                => " > ",
   "yellowpages_subcategory_limit"        => "",
   "yellowpages_subcategory_limit_post"   => " ...",
   "yellowpages_welcome_text"             => "",
);

// List of table names
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder."/yellowpages_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE)
$eplug_link             = TRUE;
$eplug_link_name        = YELL_NAME;
$eplug_link_url         = e_PLUGIN.$eplug_folder."/yellowpages.php";

// Text to display after plugin successfully installed
$eplug_done             = YELL_00;

// upgrading ...
$upgrade_add_prefs      = array();
$upgrade_remove_prefs   = array();
$upgrade_alter_tables   = "";
$eplug_upgrade_done     = YELL_02;
?>