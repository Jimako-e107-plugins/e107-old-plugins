<?php
/*
+---------------------------------------------------------------+
| Trigger by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/trigger/plugin.php,v $
| $Revision: 1.4 $
| $Date: 2008/06/28 09:40:29 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
include_lan(e_PLUGIN."trigger/languages/English.php", true);
require_once(e_PLUGIN."trigger/constants.php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name          = TRIGGERC_NAME;
$eplug_version       = TRIGGERC_VERSION;
$eplug_author        = "bugrain";
$eplug_folder        = "trigger";
$eplug_logo          = $eplug_folder."images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "e107plugins@bugrain.plus.com";
$eplug_description   = "Calendar, appointment and event organiser.";
$eplug_compatible    = "e107v0.7+";
$eplug_readme        = "admin_prefs.php?99";
$eplug_compliant     = false;
$eplug_menu_name     = "";
$eplug_conffile      = "admin_prefs.php";
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       = "Configure Trigger";
$eplug_module        = true;
$eplug_link          = false;
$eplug_link_name     = "";
$eplug_link_url      = "";
$eplug_done          = TRIGGER_LAN_100;
$eplug_upgrade_done  = TRIGGER_LAN_101;

$eplug_prefs = array (
   "trigger_separator"                 => " > ",
   // News post to forum
   "trigger_n2f_enabled"               => 0,
   "trigger_n2f_autopost"              => 0,
   "trigger_n2f_text"                  => TRIGGER_LAN_N2F_01,
   "trigger_n2f_forum_id"              => 0,
   "trigger_n2f_link"                  => TRIGGER_LAN_N2F_02,
   "trigger_n2f_inc_summary"           => 0,
   "trigger_n2f_inc_data"              => "",
   "trigger_n2f_inc_data_more"         => "...",
   "trigger_n2f_inc_extended"          => "",
   "trigger_n2f_inc_extended_more"     => "...",
   // News auto approve
   "trigger_naa_enabled"               => "0",
   "trigger_naa_submit_class"          => "255",
   "trigger_naa_view_class"            => "1",
   "trigger_naa_append_text"           => "",
   "trigger_naa_append_poster"         => "0",
   "trigger_naa_allow_comments"        => "0",
   "trigger_naa_delete_submitted"      => "0",
   "trigger_naa_autoapproved_message"  => "",

   // File upload
   "trigger_fup_enabled"               => 0,
   "trigger_fup_auto_approve"          => 255,
   "trigger_fup_remove"                => 0,
   // end
   "trigger_end"                       => ""
);

// List of table names
$eplug_sql           = file_get_contents(e_PLUGIN.$eplug_folder."/trigger_sql.php");
$ret                 = preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables
$eplug_tables        = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}

// Get rid of last (empty) entry
array_pop($eplug_tables);

// Upgrade stuff
$upgrade_add_prefs         = "";
$upgrade_remove_prefs      = "";
$upgrade_alter_tables      = "";
?>