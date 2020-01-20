<?php
/*
+---------------------------------------------------------------+
|        YouTube Gallery v4.01 - by Erich Radstake
|        http://www.erichradstake.nl
|        info@erichradstake.nl
|
|        This is a module for the e107 .7+ website system
|        Copyright Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

$lan_file = e_PLUGIN."ytm_gallery/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."ytm_gallery/languages/English.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name =  LAN_YTM_PLUGIN;
$eplug_version = "4.01";
$eplug_author = LAN_YTM_PLUGIN_0;
$eplug_logo = "button.png";
$eplug_url = LAN_YTM_PLUGIN_1;
$eplug_email = LAN_YTM_PLUGIN_2;
$eplug_description = LAN_YTM_PLUGIN_3;
$eplug_compatible = "e107v0.8";
$eplug_readme = LAN_YTM_PLUGIN_4;
$eplug_compliant = FALSE; //Not checked
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "ytm_gallery";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "ytm_gallery";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";  // use admin_ for all admin files.

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.gif";
$eplug_icon_small = $eplug_folder."/images/icon_16.gif";
$eplug_caption =  LAN_YTM_PLUGIN_5;//"Configure your plugin";


$eplug_prefs = array(
"ytm_gallery" => 0
);

$eplug_table_names = array("er_ytm_gallery","er_ytm_gallery_movies","er_ytm_gallery_category","er_ytm_gallery_rating");

// List of sql requests to create tables
$eplug_tables = array("
CREATE TABLE ".MPREFIX."er_ytm_gallery (
      id                tinyint(11)  NOT NULL auto_increment,
      username          varchar(100) NOT NULL,
      title_gallery     varchar(200) NOT NULL,
      title_form        varchar(200) NOT NULL,
      title_menu        varchar(200) NOT NULL,
      title_rating      varchar(200) NOT NULL,
      title_tp          varchar(200) NOT NULL,
      submit_class      varchar(200) NOT NULL,
      submit_text       text         NOT NULL,
      random_menu       tinyint(5)   NOT NULL,
      static_menu       varchar(200) NOT NULL,
      movie_colum       tinyint(3)   NOT NULL,
      movie_row         tinyint(3)   NOT NULL,
      menu_width        varchar(3)   NOT NULL,
      menu_height       varchar(3)   NOT NULL,
      bb_class          varchar(200) NOT NULL,
      gal_order         tinyint(1)   NOT NULL,
      version           varchar(100) NOT NULL,
      disp_title        TINYINT(3)   NOT NULL DEFAULT '1',
      ap_submit         TINYINT(3)   NOT NULL DEFAULT '1',
      disp_search       TINYINT(3)   NOT NULL DEFAULT '1',
      disp_download     TINYINT(3)   NOT NULL DEFAULT '1',
      short_title       TINYINT(3)   NOT NULL DEFAULT '0',
      short_title_count TINYINT(3)   NOT NULL,
      ytm_rate_class    varchar(200) NOT NULL,
      disp_rate         TINYINT(3)   NOT NULL DEFAULT '1',
      PRIMARY KEY (id)
   ) TYPE=MyISAM;","

CREATE TABLE ".MPREFIX."er_ytm_gallery_category (
   cat_id           int(11)   NOT NULL auto_increment,
   cat_name         varchar(200) NOT NULL,
   cat_auth         varchar(200) NOT NULL,
   PRIMARY KEY  (cat_id)
 ) TYPE=MyISAM;","
 
CREATE TABLE ".MPREFIX."er_ytm_gallery_movies (
   movie_id        bigint(11)    NOT NULL auto_increment,
   movie_title     varchar(200)  NOT NULL,
   movie_code      varchar(200)  NOT NULL,
   movie_category  bigint(8)     NOT NULL,
   active          bigint(1)     NULL      default '1',
   input_user      varchar(200)  NOT NULL,
   input_email     varchar(200)  NOT NULL,
   input_comment   text          NOT NULL,
   input_way       bigint(3)     NOT NULL,
   input_status    bigint(3)     NOT NULL,
   timestamp       timestamp     NULL      default CURRENT_TIMESTAMP,
   PRIMARY KEY  (movie_id),
   FULLTEXT KEY SEARCH (movie_title,input_comment)
) TYPE=MyISAM;","

CREATE TABLE ".MPREFIX."er_ytm_gallery_rating (
  id              varchar(200)   NOT NULL,
  total_votes     bigint(11)     NOT NULL default '0',
  total_value     bigint(11)     NOT NULL default '0',
  used_ips        longtext,
  PRIMARY KEY  (id)
) TYPE=MyISAM;",

"INSERT INTO ".MPREFIX."er_ytm_gallery (title_gallery, title_form, title_menu, title_rating, title_tp, submit_class, submit_text, random_menu, movie_colum, movie_row, menu_width, menu_height, bb_class, gal_order, version, disp_title, ap_submit, disp_search, disp_download, short_title, short_title_count, ytm_rate_class, disp_rate) VALUES ('" . LAN_YTM_PLUGIN_9 . "', '" . LAN_YTM_PLUGIN_10 . "', '" . LAN_YTM_PLUGIN_11 . "', '". LAN_YTM_PLUGIN_13 . "', '". LAN_YTM_PLUGIN_14 . "', '0', '" . LAN_YTM_PLUGIN_12 . "', '1', '3', '4', '200', '200', '0', '1', '$eplug_version', '0', '1', '1', '1', '0', '20', '0', '1');",
"INSERT INTO ".MPREFIX."er_ytm_gallery_category (cat_name, cat_auth) VALUES ('". LAN_YTM_PLUGIN_8 . "', '0');",
"INSERT INTO ".MPREFIX."er_ytm_gallery_movies (movie_title, movie_code, movie_category, active, input_user, input_email, input_way, input_status) VALUES ('" . LAN_YTM_PLUGIN_7 . "', 'OtfMIiinJso', '1', '1', '" . LAN_YTM_PLUGIN_0 . "', '" . LAN_YTM_PLUGIN_1 . "', '1', '1');");


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = LAN_YTM_PLUGIN;
$eplug_link_url = "" . e_PLUGIN . "ytm_gallery/ytm.php";

$eplug_latest = TRUE;

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = LAN_YTM_PLUGIN_6;//"Installation Successful..";


$upgrade_alter_tables = array(
"CREATE TABLE ".MPREFIX."er_ytm_gallery_rating (
  id              varchar(200)   NOT NULL,
  total_votes     bigint(11)     NOT NULL default '0',
  total_value     bigint(11)     NOT NULL default '0',
  used_ips        longtext,
  PRIMARY KEY  (id)
) TYPE=MyISAM;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD title_rating varchar(200) NOT NULL AFTER title_menu;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD title_tp varchar(200) NOT NULL AFTER title_rating;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD ap_submit TINYINT(3) NOT NULL AFTER version;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD disp_title TINYINT(3) NOT NULL AFTER ap_submit;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD disp_search TINYINT(3) NOT NULL AFTER disp_title;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD disp_download TINYINT(3) NOT NULL AFTER disp_search;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD short_title TINYINT(3) NOT NULL AFTER disp_download;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD short_title_count TINYINT(3) NOT NULL AFTER short_title;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD ytm_rate_class varchar(200) NOT NULL AFTER short_title_count;",
"ALTER TABLE ".MPREFIX."er_ytm_gallery ADD disp_rate TINYINT(3) NOT NULL AFTER ytm_rate_class;",
"UPDATE ".MPREFIX."er_ytm_gallery SET version = '$eplug_version', title_rating = '". LAN_YTM_PLUGIN_13 . "', title_tp = '". LAN_YTM_PLUGIN_14 . "', ap_submit = '1', disp_title = '0', disp_search = '1', disp_download = '1', short_title = '0', short_title_count = '20', ytm_rate_class = '0', disp_rate = '1' WHERE id ='1';"
);
?>
