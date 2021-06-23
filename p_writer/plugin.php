<?php
if (!defined('e107_INIT')) { exit; }

// Name of the plugin's folder
$eplug_folder = "p_writer";
include_lan(e_PLUGIN."/".$eplug_folder."/languages/".e_LANGUAGE.".php");

// Plug info
$eplug_name = "P_writer";
$eplug_version = "0.5b";
$eplug_author = "Paul Kater";
$eplug_description = PWRITER_L2;
$eplug_compatible = "e107 v0.7+";
$eplug_readme = "";
$eplug_url = "http://www.nlpagan.net";
$eplug_email = "paul@nlpagan.net";

// Icon image and caption text
$eplug_icon = $eplug_folder."/images/pwriter.jpg";
$eplug_icon_small = $eplug_folder."/images/pwiter.png";
$eplug_caption = PWRITER_L1;

// Name of menu item for plugin
$eplug_menu_name = "p_writer_menu";
 
// Name of the admin configuration file  
$eplug_conffile = "admin_pwconf.php";
 
// List of preferences
$eplug_prefs = array(
   "pw_use_groups" => "1",
   "pw_nr_chapters" => "1"
);
 
// Create a link in main menu (yes=TRUE, no=FALSE) 
$eplug_link = TRUE;
$eplug_link_name  = "P_writer";
$eplug_link_perms = "Members";

// Database bits and pieces
$eplug_table_names = array("pw_stories", "pw_genre", "pw_chapter");

// List of table names ------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder.'/'.$eplug_folder.'_sql.php');
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables -------------------------------------------------
// Apply create instructions for every table you defined in locator_sql.php --------------
// MPREFIX must be used because database prefix can be customized instead of default e107_
$eplug_tables = explode(';', str_replace('CREATE TABLE ', 'CREATE TABLE '.MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ';';
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Text to display after plugin successfully installed 
$eplug_done           = PWRITER_L3;
$eplug_uninstall_done = PWRITER_L4;
 
?>
