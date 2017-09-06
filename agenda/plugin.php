<?php
/*
+---------------------------------------------------------------+
| Agenda by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/agenda/plugin.php,v $
| $Revision: 1.33 $
| $Date: 2006/11/29 01:17:03 $
| $Author: Neil $
+---------------------------------------------------------------+
*/
require_once(e_PLUGIN."agenda/agenda_variables.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name          = AGENDA_LAN_NAME;
$eplug_version       = AGENDA_LAN_VER;
$eplug_author        = "bugrain";
$eplug_folder        = "agenda";
$eplug_logo          = $eplug_folder."images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "agenda@bugrain.plus.com";
$eplug_description   = "Calendar, appointment and event organiser.";
$eplug_compatible    = "e107v0.617+";
$eplug_readme        = "admin_readme.php";
$eplug_compliant     = false;

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name     = "agenda";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile      = "admin_prefs.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       = "Configure Agenda";

$eplug_module        = true;

// Does not work - output from variables gets in the way of the XML
$eplug_rss['agenda'] = array(
	"id" => "agenda",
	"author" => "agn_author",
	"link" => $eplug_folder."/agenda.php?#",
	"linkid" => "agn_id",
	"title" => "agn_title",
	"description" => "agn_description",
	"query" => "SELECT * FROM #agenda ORDER BY agn_id DESC LIMIT 0, 9",
	"category" => "1",
	"datestamp" => "agn_start",
	"enc_url" => "0",
	"enc_leng" => "0",
	"enc_type" => "0"
);

$eplug_prefs = array (
   "agenda_view_pages"              => "0",
   "agenda_add_entry"               => "253",
   "agenda_add_category"            => "254",
   "agenda_week_start"              => "1",
   "agenda_icon_dir"                => "user_icons",
   "agenda_default_view"            => "0",
   "agenda_debug"                   => "0",
   "agenda_page_title"              => AGENDA_LAN_NAME,
   "agenda_nav_menu_title"          => AGENDA_LAN_NAME,
   "agenda_subs_menu_title"         => AGENDA_LAN_110,
   "agenda_nav_on_main"             => "Y",
   "agenda_header_css"              => "forumheader",
   "agenda_day_css"                 => "forumheader2",
   "agenda_today_css"               => "forumheader3",
   "agenda_day_with_entries_css"    => "indent",
   "agenda_dayname_length"          => "3",
   "agenda_compress_day"            => "",
   "agenda_compress_week"           => "",
   "agenda_compress_month1"         => "",
   "agenda_short_title_length"      => "15",
   "agenda_icons_in_compact_views"  => "Y",
   "agenda_time_in_compact_views"   => "Y",
   "agenda_month_links"             => "",
   "agenda_allow_subscriptions"     => "Y",
   "agenda_subs_from_name"          => $pref['siteadmin'],
   "agenda_subs_from_email"         => $pref['siteadminemail'],
   "agenda_subs_subject_prefix"     => "",
   "agenda_detailed_tooltips"       => "",
   "agenda_locallink_in_new_window" => "",
   "agenda_weblink_in_new_window"   => "",
   "agenda_icons_in_menu"           => "",
   "agenda_recent_adds_limit"       => "15",
   "agenda_upcoming_events_title"   => "Upcoming Events",
   "agenda_upcoming_events_limit"   => "10",
   "agenda_private_calendar"        => "",
   "agenda_multiple_weeks"          => "4",
   "agenda_next_weeks"              => "4",
   "agenda_comments"                => "",
   "agenda_ratings"                 => "",
   "agenda_link_to_google_maps"     => "",
);

// List of table names
$eplug_sql           = file_get_contents(e_PLUGIN.$eplug_folder."/agenda_sql.php");
$ret                 = preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables
$eplug_tables        = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}

// Get rid of last (empty) entry
array_pop($eplug_tables);


// sample types
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_type (typ_id, typ_name, typ_description, typ_timed, typ_floating, typ_recurring, typ_fields, typ_user, typ_admin) VALUES (1, 'Timed', 'Entry with a start and (possibly) end time', 1, 0, 0, '4,6,7,8,9,11,12,13', 253, 254);");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_type (typ_id, typ_name, typ_description, typ_timed, typ_floating, typ_recurring, typ_fields, typ_user, typ_admin) VALUES (2, 'Untimed', 'Entry without a specific start time', 0, 0, 0, '2,6,9,11,12,13', 253, 254);");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_type (typ_id, typ_name, typ_description, typ_timed, typ_floating, typ_recurring, typ_fields, typ_user, typ_admin) VALUES (4, 'Recurring (timed)', 'Entry that repeats periodically at the same time every day that it recurs.', 1, 0, 1, '4,14,6,7,8,9,11,12', 253, 254);");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_type (typ_id, typ_name, typ_description, typ_timed, typ_floating, typ_recurring, typ_fields, typ_user, typ_admin) VALUES (5, 'Work Shift', 'Work shift pattern', 1, 0, 0, '4,7,8,9', 253, 254);");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_type (typ_id, typ_name, typ_description, typ_timed, typ_floating, typ_recurring, typ_fields, typ_user, typ_admin) VALUES (6, 'Floating (untimed)', 'Floating event. Has a start date and is displayed on current day (i.e. today) until marked as complete.', 0, 1, 0, '6,7,8,9,12,13', 253, 254);");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_type (typ_id, typ_name, typ_description, typ_timed, typ_floating, typ_recurring, typ_fields, typ_user, typ_admin) VALUES (7, 'Floating (timed)', 'Floating event. Has a start date and time is displayed at that time on current day (i.e. today) until marked as complete.', 1, 1, 0, '6,7,8,9,12,13', 253, 254);");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_type (typ_id, typ_name, typ_description, typ_timed, typ_floating, typ_recurring, typ_fields, typ_user, typ_admin) VALUES (8, 'Recurring (untimed)', 'Entry that repeats periodically and is displayed every day that it recurs.', 0, 0, 1, '2,14,6,7,8,9,11,12', 253, 254);");
// sample categroies
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (1, 'Miscellaneous',    'Miscellaneous',        '');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (2, 'Birthday',         'Congratulations',      '../../e107_images/user_icons/user_birthday_lite.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (3, 'Shift - normal',   'Horrible work',        '../../e107_images/user_icons/user_aim.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (4, 'Shift - bank',     'Horrible work',        '../../e107_images/user_icons/user_aim.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (5, 'Shift - overtime', 'Horrible work',        '../../e107_images/user_icons/user_aim.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (6, 'Reminder',         'Do not forget this',   '../../e107_images/user_icons/user_location.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (7, 'Meeting',          'A meeting',            '../../e107_images/user_icons/user_msn.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (8, 'Gig',              'Boogie, man!',         '../../e107_images/user_icons/user_icq.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (9, 'Sport',            'Sporting stuff',       '../../e107_images/user_icons/user_star_dark.png');");
array_push($eplug_tables, "INSERT INTO ".MPREFIX."agenda_category (cat_id, cat_name, cat_description, cat_icon) VALUES (10, 'Social',          'Social stuff',         '../../e107_images/user_icons/user_star_lite.png');");

$eplug_link          = true;
$eplug_link_name     = AGENDA_LAN_NAME;
$eplug_link_url      = e_PLUGIN.$eplug_folder."/agenda.php";
$eplug_done          = AGENDA_LAN_100;
$eplug_upgrade_done  = AGENDA_LAN_101;

// Upgrade stuff
if (!class_exists("agendaPluginUpgradeHelper")) {
   class agendaPluginUpgradeHelper {
      var $sql;
      var $pluginVersion;
      function agendaPluginUpgradeHelper() {
         $this->sql = new e107HelperDB();
         if($this->sql->db_Select("plugin", "plugin_version", "plugin_name='Agenda'")) {
            $row = $this->sql->db_Fetch();
            $this->pluginVersion = $row["plugin_version"];
         } else {
            $this->pluginVersion = 0;
         }
      }

      function getUpgradeAlterTables() {
         global $pref;
         $pluginTables = array ();
         if ($this->pluginVersion <= 1.4) {
            array_push($pluginTables, "ALTER TABLE ".MPREFIX."agenda_category ADD cat_visibility    tinyint(3) unsigned NOT NULL default 0  AFTER cat_icon");
            array_push($pluginTables, "ALTER TABLE ".MPREFIX."agenda_user     ADD usr_personal_view text                NOT NULL default '' AFTER usr_filter");
         }
         if ($this->pluginVersion <= 1.5) {
            array_push($pluginTables, "ALTER TABLE ".MPREFIX."agenda CHANGE agn_end agn_end int(10) NOT NULL default -1");
         }
         if ($this->pluginVersion <= 1.6) {
            array_push($pluginTables, "ALTER TABLE ".MPREFIX."agenda CHANGE agn_details agn_details text NULL");
         }
         return $pluginTables;
      }

      function getUpgradeAddPrefs() {
         global $pref;
         $pluginPrefs = array ();
         $temp = array();
         if ($this->pluginVersion == "1.3") {
            $temp = array (
               "agenda_comments"                => "",
               "agenda_ratings"                 => "",
            );
         }
         $pluginPrefs = array_merge($pluginPrefs, $temp);
         $temp = array();
         if ($this->pluginVersion == "1.4") {
            $temp = array (
               "agenda_link_to_google_maps"     => "",
            );
         }
         $pluginPrefs = array_merge($pluginPrefs, $temp);
         return $pluginPrefs;
      }

      function getUpgradeRemovePrefs() {
         return "";
      }
   }
}

$agendaPluginUpgradeHelper = new agendaPluginUpgradeHelper();
$upgrade_add_prefs         = $agendaPluginUpgradeHelper->getUpgradeAddPrefs();
$upgrade_remove_prefs      = $agendaPluginUpgradeHelper->getUpgradeRemovePrefs();
$upgrade_alter_tables      = $agendaPluginUpgradeHelper->getUpgradeAlterTables();
?>