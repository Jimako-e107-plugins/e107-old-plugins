<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        MacGuru BLOG v2.1.3 by MacGuru (http://macguru.uw.hu)
|        Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (file_exists(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php")) {
	require_once(e_PLUGIN."macgurublog_menu/languages/".e_LANGUAGE.".php");
} else {
	require_once(e_PLUGIN."macgurublog_menu/languages/English.php");
}
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "BLOG Engine";
$eplug_version = "2.2";
$eplug_author = "MacGuru";
$eplug_logo = "/images/icon_32.png";
$eplug_url = "http://macguru.uw.hu";
$eplug_email = "macguru.x@gmail.com";
$eplug_description = "With this plugin users can write their own blog.";
$eplug_compatible = "e107 v0.7.x";
$eplug_readme = "readme.txt";        // leave blank if no readme file
$eplug_compliant = TRUE;
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "macgurublog_menu";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "macgurublog_menu";  // _menu is no longer required in 0.7.

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";  // use admin_ for all admin files.

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption =  "Configure BLOG Engine";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		"macgurublog_1" => 3,
		"macgurublog_2" => false,
		"macgurublog_3" => false,
		"macgurublog_4" => true,
		"macgurublog_5" => 'utf-8',
		"macgurublog_6" => 1,
		"macgurublog_7" => 1,
		"macgurublog_8" => false,
		"macgurublog_9" => false,
		"macgurublog_10" => true,
		"macgurublog_11" => MACGURUBLOG_MENU_0,
		"macgurublog_12" => true,
		"macgurublog_13" => true,
		"macgurublog_14" => true
);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array("macgurublog_main", "macgurublog_rec", "macgurublog_com", "macgurublog_tag");


// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array("
CREATE TABLE ".MPREFIX."macgurublog_main (
  blog_uid int(10) unsigned NOT NULL default '0',
  blog_title varchar(100) NOT NULL default '',
  blog_enable tinyint(1),
  PRIMARY KEY  (blog_uid),
  UNIQUE KEY blog_uid (blog_uid)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."macgurublog_rec (
  blogrec_id int(10) unsigned NOT NULL auto_increment,
  blogrec_uid int(10) unsigned NOT NULL default '0',
  blogrec_date int(12) NOT NULL default '0',
  blogrec_title varchar(100) NOT NULL default '',
  blogrec_text longtext NOT NULL,
  blogrec_tag int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (blogrec_id),
  UNIQUE KEY blogrec_id (blogrec_id)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."macgurublog_com (
  blogcom_id int(10) unsigned NOT NULL auto_increment,
  blogcom_rid int(10) unsigned NOT NULL default '0',
  blogcom_date int(12) NOT NULL default '0',
  blogcom_uid int(10) NOT NULL default '0',
  blogcom_text longtext NOT NULL,
  PRIMARY KEY  (blogcom_id),
  UNIQUE KEY blogcom_id (blogcom_id)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."macgurublog_tag (
  blogtag_id int(10) unsigned NOT NULL auto_increment,
  blogtag_uid int(10) unsigned NOT NULL default '0',
  blogtag_text varchar(100) NOT NULL default '',
  PRIMARY KEY  (blogtag_id),
  UNIQUE KEY blogtag_id (blogtag_id)
) TYPE=MyISAM;"
);


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "BLOGs";
$eplug_link_url = "e107_plugins/macgurublog_menu/macgurublog.php";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "Installation Successful...";


// upgrading ... //
$usql = new db();
if($usql->db_Select("plugin", "plugin_version", "plugin_name='BLOG Engine'")) {
	$urow = $usql->db_Fetch();
	$ppv = $urow["plugin_version"];
} else {
	$ppv = 0;
}
$upgrade_add_prefs = array();
$upgrade_remove_prefs = array();
$upgrade_alter_tables = array();
if (substr($ppv,0,3) == "2.0" || $ppv == "2.1.1") { //2.0.x to 2.1.2, 2.1.1 to 2.1.2
	$tmp_add_prefs = array(
		"macgurublog_11" => MACGURUBLOG_MENU_0,
		"macgurublog_12" => true
		);
	$tmp_remove_prefs = "";
	$tmp_alter_tables = array("CREATE TABLE ".MPREFIX."macgurublog_tag (
	  blogtag_id int(10) unsigned NOT NULL auto_increment,
	  blogtag_uid int(10) unsigned NOT NULL default '0',
	  blogtag_text varchar(100) NOT NULL default '',
	  PRIMARY KEY  (blogtag_id),
	  UNIQUE KEY blogtag_id (blogtag_id)
	) TYPE=MyISAM;",
	"ALTER TABLE ".MPREFIX."macgurublog_rec ADD blogrec_tag int(10) unsigned NOT NULL default '0';");
	$upgrade_add_prefs = array_merge($upgrade_add_prefs, $tmp_add_prefs);
	$upgrade_remove_prefs = array_merge($upgrade_remove_prefs, $tmp_remove_prefs);
	$upgrade_alter_tables = array_merge($upgrade_alter_tables, $tmp_alter_tables);
}
if (substr($ppv,0,3) == "2.0" || substr($ppv,0,3) == "2.1") { //2.x to 2.2
	$tmp_add_prefs = array(
		"macgurublog_13" => true,
		"macgurublog_14" => true
		);
	$tmp_remove_prefs = "";
	$tmp_alter_tables = array();
	$upgrade_add_prefs = array_merge($upgrade_add_prefs, $tmp_add_prefs);
	$upgrade_remove_prefs = array_merge($upgrade_remove_prefs, $tmp_remove_prefs);
	$upgrade_alter_tables = array_merge($upgrade_alter_tables, $tmp_alter_tables);
}
$eplug_upgrade_done = "Plugin updated successful...";

if (!function_exists('macgurublog_menu_install')) {
	function macgurublog_menu_install() {
		@mkdir(e_IMAGE."blog/");
	}
	function macgurublog_menu_uninstall() {
		global $sql;
		$sql -> db_Delete("rate", "rate_table='macgurublog'");
	}
}
?>