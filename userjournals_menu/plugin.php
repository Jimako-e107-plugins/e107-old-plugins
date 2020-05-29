<?php
/*
+---------------------------------------------------------------+
|        UserJournals plugin for e107 website system
|
|        ©Del Rudolph 2003
|        http://www.downinit.com/
|        del@downinit.com
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (file_exists(e_PLUGIN."userjournals_menu/languages/admin/".e_LANGUAGE.".php")){
   include_once(e_PLUGIN."userjournals_menu/languages/admin/".e_LANGUAGE.".php");
} else {
   include_once(e_PLUGIN."userjournals_menu/languages/admin/English.php");
}

if (file_exists(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php")){
   include_once(e_PLUGIN."userjournals_menu/languages/".e_LANGUAGE.".php");
} else {
   include_once(e_PLUGIN."userjournals_menu/languages/English.php");
}

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name          = JOURNAL_A0;
$eplug_version       = JOURNAL_VERSION;
$eplug_author        = "Del Rudolph, SKiTZ716, bkwon, bugrain";
$eplug_logo          = "images/userjournals.png";
$eplug_url           = "http://www.bugrain.plus.com/";
$eplug_email         = "bugrain@bugrain.plus.com";
$eplug_description   = "Allows members of '".SITENAME."' to maintain their own journals.";
$eplug_compatible    = "e107v6+ and e107v7";
$eplug_readme        = "admin_readme.php";
$eplug_compliant     = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder        = "userjournals_menu";

// Nane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name     = JOURNAL_A0;

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile      = "admin_conf.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon          = $eplug_folder."/images/userjournals.png";
$eplug_icon_small    = $eplug_folder."/images/userjournals_16.png";
$eplug_caption       = JOURNAL_A8;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
   "userjournals_active"            => 0,
   "userjournals_page_title"        => UJ1,
   "userjournals_menu_title"        => UJ1,
   "userjournals_cat_menu_title"    => UJ94,
   "userjournals_writers"           => 0,
   "userjournals_readers"           => 0,
   "userjournals_allowcomments"     => 0,
   "userjournals_allowratings"      => 0,
   "userjournals_len_subject"       => 30,
   "userjournals_len_preview"       => 400,
   "userjournals_recent_entries"    => 5,
   "userjournals_show_rss"          => 0,
   "userjournals_show_playing"      => 1,
   "userjournals_show_mood"         => 1,
   "userjournals_show_cats"         => 0,
   "userjournals_template"          => "",
   "userjournals_bloggers_menu_max" => "0",
   "userjournals_bloggers_per_page" => 0,
   "userjournals_blogs_per_page"    => 0,
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_sql = file_get_contents(e_PLUGIN.$eplug_folder."/userjournals_menu_sql.php");
preg_match_all("/CREATE TABLE (.*?)\(/i", $eplug_sql, $matches);
$eplug_table_names   = $matches[1];

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = explode(";", str_replace("CREATE TABLE ", "CREATE TABLE ".MPREFIX, $eplug_sql));
for ($i=0; $i<count($eplug_tables); $i++) {
   $eplug_tables[$i] .= ";";
}
array_pop($eplug_tables); // Get rid of last (empty) entry

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link       = true;
$eplug_link_name  = JOURNAL_A0;
$eplug_link_url   = e_PLUGIN."userjournals_menu/userjournals.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done       = JOURNAL_A9;

// upgrading ... //
$ujsql = new db();
if($ujsql->db_Select("plugin", "plugin_version", "plugin_name='".JOURNAL_A0."'")) {
   $ujrow = $ujsql->db_Fetch();
   $ujpluginVersion = $ujrow["plugin_version"];
} else {
   $ujpluginVersion = 0;
}

// These are all new for version 0.4 so no need for version check
if ($ujpluginVersion == "0.31") {
   $ujtemp = array(
      "userjournals_page_title"     => UJ1,
      "userjournals_menu_title"     => UJ1,
      "userjournals_writers"        => 0,
      "userjournals_readers"        => 0,
      "userjournals_allowcomments"  => 0,
      "userjournals_editcomments"   => 0,
      "userjournals_allowratings"   => 0,
      "userjournals_len_subject"    => 30,
      "userjournals_len_preview"    => 400,
      "userjournals_recent_entries" => 5,
      );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ujtemp);
}

if ($ujpluginVersion == "v0.4") {
   $ujtemp = array(
      "userjournals_show_rss"       => 0,
      "userjournals_show_playing"   => 1,
      "userjournals_show_mood"      => 1,
      "userjournals_cat_menu_title" => UJ94,
      "userjournals_show_cats"      => 0,
      "userjournals_template"       => "",
      "userjournals_bloggers_menu_max" => "0",
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ujtemp);
}

if ($ujpluginVersion == "0.5") {
   $ujtemp = array(
      "userjournals_show_playing"   => 1,
      "userjournals_show_mood"      => 1,
      "userjournals_cat_menu_title" => UJ94,
      "userjournals_show_cats"      => 0,
      "userjournals_template"       => "",
      "userjournals_bloggers_menu_max" => "0",
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ujtemp);
}

if ($ujpluginVersion == "0.6") {
   $ujtemp = array(
      "userjournals_cat_menu_title" => UJ94,
      "userjournals_show_cats"      => 0,
      "userjournals_template"       => "",
      "userjournals_bloggers_menu_max" => "0",
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ujtemp);
}

if ($ujpluginVersion == "0.7") {
   $ujtemp = array(
      "userjournals_bloggers_menu_max" => "0",
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ujtemp);
}

if ($ujpluginVersion == "0.8") {
   $ujtemp = array(
      "userjournals_bloggers_per_page" => 0,
      "userjournals_blogs_per_page"    => 0,
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ujtemp);
}

$upgrade_remove_prefs = array(
   "userjournals_anon",
   "userjournals_comments",
   "userjournals_editcomments",
);

$upgrade_alter_tables = array();
if ($ujpluginVersion == "0.3" || $ujpluginVersion == "v0.3") {
   $ujtemp = array(
      "ALTER TABLE ".MPREFIX."userjournals ADD userjournals_playing varchar(50) NOT NULL default '' AFTER userjournals_subject;",
      "ALTER TABLE ".MPREFIX."userjournals ADD userjournals_mood enum('happy', 'sad', 'alienated', 'beat_up', 'angry', 'annoyed', 'chicken', 'confused', 'crying', 'doh', 'evil', 'funny', 'greedy', 'hungry', 'puzzled', 'innocent', 'shocked', 'sick', 'sleepy', 'very_happy') NOT NULL default 'happy' AFTER userjournals_playing;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $ujtemp);
}
if ($ujpluginVersion == "0.31") {
   $ujtemp = array(
      "ALTER TABLE ".MPREFIX."userjournals ADD userjournals_is_blog_desc int(1) NOT NULL default '0' AFTER userjournals_comment_parent;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $ujtemp);
}
if ($ujpluginVersion == "v0.4") {
   $ujtemp = array(
      "ALTER TABLE ".MPREFIX."userjournals ADD userjournals_is_published int(1) NOT NULL default '0' AFTER userjournals_is_blog_desc;",
      "ALTER TABLE ".MPREFIX."userjournals CHANGE userjournals_mood userjournals_mood ENUM('', 'happy', 'sad', 'alienated', 'beat_up', 'angry', 'annoyed', 'chicken', 'confused', 'crying', 'doh', 'evil', 'funny', 'greedy', 'hungry', 'puzzled', 'innocent', 'shocked', 'sick', 'sleepy', 'very_happy' ) DEFAULT 'happy' NOT NULL;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $ujtemp);
}
if ($ujpluginVersion == "0.6") {
   $ujtemp = array(
      "CREATE TABLE ".MPREFIX."userjournals_categories (
         userjournals_cat_id         int(10) unsigned NOT NULL auto_increment,
         userjournals_cat_name       varchar(100) NOT NULL default '',
         userjournals_cat_icon       varchar(100) NOT NULL default '',
         userjournals_cat_parent_id  int(10) unsigned NOT NULL default 0,
         PRIMARY KEY  (userjournals_cat_id)
      ) TYPE=MyISAM;",
      "ALTER TABLE ".MPREFIX."userjournals ADD userjournals_categories varchar(100) NOT NULL default '' AFTER userjournals_subject;",
      "ALTER TABLE ".MPREFIX."userjournals DROP userjournals_username;",
   );
   $upgrade_alter_tables = array_merge($upgrade_alter_tables, $ujtemp);
}

$eplug_upgrade_done = JOURNAL_A10;

unset($ujpluginVersion);
unset($ujsql);
unset($ujtemp);

if (!function_exists("userjournals_menu_install")) {
   function userjournals_menu_install() {
   }
}

if (!function_exists("userjournals_menu_uninstall")) {
   function userjournals_menu_uninstall() {
      global $sql;
      $sql->db_Delete("comments", "comment_type='userjourna'");
   }
}
?>
