<?php
/*
+---------------------------------------------------------------+
| ePlayer by bugrain (www.bugrain.plus.com)
|
| A plugin for the e107 Website System (http://e107.org)
|
| Released under the terms and conditions of the
| GNU General Public License (http://gnu.org).
|
| $Source: e:\_repository\e107_plugins/eplayer/plugin.php,v $
| $Revision: 1.27 $
| $Date: 2007/01/23 23:52:38 $
| $Author: Neil $
+---------------------------------------------------------------+
*/

require_once(e_PLUGIN."eplayer/eplayer_variables.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name          = EPLAYER_LAN_NAME;
$eplug_version       = EPLAYER_LAN_VER;
$eplug_author        = "bugrain";
$eplug_logo          = $eplug_folder."images/icon_32.png";
$eplug_url           = "http://www.bugrain.plus.com";
$eplug_email         = "eplayer@bugrain.plus.com";
$eplug_description   = EPLAYER_LAN_DESC;
$eplug_compatible    = "e107v0.617";
$eplug_readme        = "admin_readme.php";
$eplug_compliant     = FALSE;
$eplug_status        = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder        = "eplayer";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name     = "eplayer";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile      = "admin_media_local.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon          = $eplug_folder."/images/icon_32.png";
$eplug_icon_small    = $eplug_folder."/images/icon_16.png";
$eplug_caption       = "Configure ePlayer";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
   "eplayer_title"                  => "ePlayer",
   "eplayer_media_dir"              => "downloads",
   "eplayer_icon_dir"               => "download_icons",
   "eplayer_image_dir"              => "",
   "eplayer_display_order"          => EPLAYER_LAN_ADMIN_PREF_03_2,
   "eplayer_clips_per_page"         => "10",
   "eplayer_default_width"          => "352",
   "eplayer_default_height"         => "288",
   "eplayer_show_clip_details"      => EPLAYER_LAN_ADMIN_PREF_06_2,
   "eplayer_max_width"              => "",
   "eplayer_use_exif"               => "1",
   "eplayer_view_class"             => "0",
   "eplayer_upload_class"           => "0",
   "eplayer_download_class"         => "0",
   "eplayer_user_gallery_class"     => "0",
   "eplayer_user_gallery_icon"      => "",
   "eplayer_email_notification"     => "255",
   "eplayer_allow_rating"           => "1",
   "eplayer_view_show_non_visible"  => "0",
   "eplayer_view_hidden_text"       => "",
   "eplayer_view_show_clip_details" => EPLAYER_LAN_ADMIN_VPREF_03_5,
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("eplayer","eplayer_category");

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
   "CREATE TABLE ".MPREFIX."eplayer_category (
      cat_id                int(10) unsigned    NOT NULL auto_increment,
      cat_name              varchar(100)        NOT NULL default '',
      cat_description       varchar(250)        NOT NULL default '',
      cat_icon              varchar(100)        NOT NULL default '',
      cat_display_order     int(10) unsigned    NOT NULL default 0,
      cat_parent_category   int(10) unsigned    NOT NULL default 0,
      cat_visibility        tinyint(3) unsigned NOT NULL default 0,
      PRIMARY KEY (cat_id)
   ) TYPE=MyISAM",
   "CREATE TABLE ".MPREFIX."eplayer (
      id                   int(10) unsigned     NOT NULL auto_increment,
      filename             varchar(200)         NOT NULL default '',
      title                varchar(100)         NOT NULL default '',
      category             int(10) unsigned     NOT NULL default 0,
      datestamp            int(10) unsigned     NOT NULL default 0,
      description          text                 NOT NULL,
      icon                 varchar(100)         NOT NULL default '',
      width                int(10) unsigned     NOT NULL default 0,
      height               int(10) unsigned     NOT NULL default 0,
      author               varchar(100)         NOT NULL default '',
      comment              tinyint(3)           NOT NULL default 1,
      timestamp            int(19) unsigned     NOT NULL default 0,
      lastview             int(10) unsigned     NOT NULL default 0,
      viewcount            int(10) unsigned     NOT NULL default 0,
      approved             char(1)              NOT NULL default 0,
      PRIMARY KEY (id)
   ) TYPE=MyISAM;",
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link             = TRUE;
$eplug_link_name        = "ePlayer";
$eplug_link_url         = e_PLUGIN."eplayer/eplayer.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done             = "Installation Successful...";

// upgrading ...
$ep_sql = new db();
if($ep_sql->db_Select("plugin", "plugin_version", "plugin_name='ePlayer'")) {
   $ep_row = $ep_sql->db_Fetch();
} else {
   $ep_row = array("plugin_version" => "0");
}

$upgrade_add_prefs = array ();
if($ep_row["plugin_version"] == "1.7") {
   $ep_temp = array (
      "eplayer_view_class"          => "0",
      "eplayer_upload_class"        => "0",
      "eplayer_download_class"      => "0",
      "eplayer_email_notification"  => "",
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ep_temp);
}

if($ep_row["plugin_version"] == "1.8") {
   $ep_temp = array (
      "eplayer_allow_rating"        => "1",
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ep_temp);
}
$upgrade_remove_prefs   = array ();

if($ep_row["plugin_version"] == "1.9") {
   $ep_temp = array (
      "eplayer_user_gallery_class"     => "255",
      "eplayer_user_gallery_icon"      => "",
      "eplayer_view_show_non_visible"  => "0",
      "eplayer_view_hidden_text"       => "",
      "eplayer_view_show_clip_details" => EPLAYER_LAN_ADMIN_VPREF_03_5,
   );
   $upgrade_add_prefs = array_merge($upgrade_add_prefs, $ep_temp);
}
$upgrade_remove_prefs   = array ();

$upgrade_alter_tables   = array ();
if($ep_row["plugin_version"] == "1.6") {
   array_push($upgrade_alter_tables, "ALTER TABLE ".MPREFIX."eplayer ADD lastview  int(10) unsigned NOT NULL default 0 AFTER timestamp");
   array_push($upgrade_alter_tables, "ALTER TABLE ".MPREFIX."eplayer ADD viewcount int(10) unsigned NOT NULL default 0 AFTER lastview");
   array_push($upgrade_alter_tables, "ALTER TABLE ".MPREFIX."eplayer ADD approved char(1) NOT NULL default 0 AFTER viewcount");
}
if($ep_row["plugin_version"] == "1.7") {
   array_push($upgrade_alter_tables, "ALTER TABLE ".MPREFIX."eplayer_category ADD cat_visibility tinyint(3) unsigned NOT NULL default 0 AFTER cat_parent_category");
}
if($ep_row["plugin_version"] == "1.8") {
   array_push($upgrade_alter_tables, "ALTER TABLE ".MPREFIX."eplayer_category ADD cat_uploders tinyint(3) unsigned NOT NULL default '0' AFTER cat_visibility");
   array_push($upgrade_alter_tables, "ALTER TABLE ".MPREFIX."eplayer ADD owner int(10) unsigned NOT NULL default '0' AFTER height");
}

$eplug_upgrade_done     = "Upgrade successful...";
?>