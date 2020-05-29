<?php
/*
+---------------------------------------------------------------+
|        e107 website system

|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/

$lan_file = e_PLUGIN."e107_league_tipp/languages/admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/admin/German.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name =  LAN_ADM_LEAGUE_TIP;
$eplug_version = LAN_ADM_LEAGUE_TIP_VERS;
$eplug_author = LAN_ADM_LEAGUE_TIP_0;
$eplug_logo = "button.png";
$eplug_url = LAN_ADM_LEAGUE_TIP_11;
$eplug_email = LAN_ADM_LEAGUE_TIP_12;
$eplug_description = LAN_ADM_LEAGUE_TIP_13;
$eplug_compatible = "e107v0.7+";
$eplug_readme = LAN_ADM_LEAGUE_TIP_4;
$eplug_compliant = TRUE;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "e107_league_tipp";
// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = LAN_ADM_LEAGUE_TIP;
// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_prefs.php";
// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption =  LAN_ADM_LEAGUE_TIP_5;
// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		"lique_tip_saison" => 0 // this stores a default value in the preferences.0 = off , 1= On
);
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("league_tipp_users", "league_tipp_tab");
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("
CREATE TABLE ".MPREFIX."league_tipp_users (
  lique_users_id int(10) unsigned NOT NULL auto_increment,
  lique_users_user_id int(10) unsigned NOT NULL default '0',
  lique_users_date varchar(12) default NULL,
  lique_users_status int(10) unsigned NOT NULL,
  PRIMARY KEY  (lique_users_id)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."league_tipp_tab (
  league_tipp_id int(10) unsigned NOT NULL auto_increment,
  league_tipp_user_id int(10) unsigned NOT NULL default '0',
  league_tipp_game_id int(10) unsigned NOT NULL default '0',
  league_tipp_HT int(10) unsigned NOT NULL default '0',
  league_tipp_GT int(10) unsigned NOT NULL default '0',
  league_tipp_date varchar(12) default NULL,
  PRIMARY KEY  (league_tipp_id)
) TYPE=MyISAM;");
// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = TRUE;
$eplug_link_name = LAN_ADM_LEAGUE_TIP;
$eplug_link_url = "e107_plugins/e107_league_tipp/league_tipp_login.php";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = LAN_ADM_LEAGUE_TIP_7;
// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";
?>
