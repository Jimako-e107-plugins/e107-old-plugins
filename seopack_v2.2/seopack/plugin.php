<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     Copyright (C) 2001-2002 Steve Dunstan (jalist@e107.org)
|     Copyright (C) 2008-2010 e107 Inc (e107.org)
|
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
+----------------------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit(); }

include_lan(e_PLUGIN."seopack/languages/".e_LANGUAGE.".php");

// Plugin info ----------------------------------------------------------------
$eplug_name				= SEOPACK_MENU_TITLE;
$eplug_version			= "2.2";
$eplug_author			= "Mohamed Anouar";
$eplug_url				= "http://naja7host.com";
$eplug_email			= "support@naja7host.com";
$eplug_description		= SEOPACK_MENU_DESC;
$eplug_compatible		= "e107v1+";
$eplug_readme			= "";		//leave blank if no readme file
$eplug_latest			= FALSE;	//Show reported threads in admin (use latest.php)
$eplug_status			= FALSE;	//Show post count in admin (use status.php)

// Name of the plugin's folder ------------------------------------------------
$eplug_folder			= "seopack";

// Name of menu item for plugin -----------------------------------------------
$eplug_menu_name		= "seopack_menu";

// Name of the admin configuration file ---------------------------------------
$eplug_conffile			= "admin_conf.php";

// Icon image and caption text ------------------------------------------------
$eplug_icon				= $eplug_folder."/images/seopack_32.png";
$eplug_icon_small		= $eplug_folder."/images/seopack_16.png";
$eplug_logo				= $eplug_folder."/images/seopack_32.png";
$eplug_caption			= SEOPACK_MENU_CONFIGURE;

// List of preferences --------------------------------------------------------
$eplug_prefs			= array("");

// List of table names --------------------------------------------------------
$eplug_table_names  = array('seo_spiderlog', 'seo_keywords');

// List of sql requests to create tables --------------------------------------
$eplug_tables = array(
        "CREATE TABLE ".MPREFIX."seo_spiderlog (
        spider_id int(11) unsigned NOT NULL auto_increment,
        spider_url varchar(255) NOT NULL default '',
        spider_date varchar(255) NOT NULL default '',
        spider_agent varchar(255) NOT NULL default '',
        spider_ip varchar(255) NOT NULL default '',
        PRIMARY KEY  (spider_id)
        ) ENGINE=MyISAM;",

		"CREATE TABLE ".MPREFIX."seo_keywords (
		keyword_id int(10) unsigned NOT NULL auto_increment,
		keyword_page int(10) unsigned NOT NULL ,
		keyword_type varchar(200) NOT NULL default '',
		keyword_keywords text NOT NULL,
		keyword_date int(10) unsigned NOT NULL default '0',
		keyword_engine varchar(200) NOT NULL default '',		
		PRIMARY KEY  (keyword_id)	
		) ENGINE=MyISAM " );


// Create a link in main menu (yes=TRUE, no=FALSE) ----------------------------
$eplug_link				= FALSE;
$eplug_link_name		= '';
$eplug_link_url			= '';


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = SEOPACK_MENU_INSTALL;

// Upgrading -----------------------------------------------------------------------------------
$eplug_upgrade_done = SEOPACK_MENU_UPGRADE;
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";

if ($pref['plug_installed']['seopack'] = 2 && $eplug_version = 2.2 ){
	$upgrade_alter_tables = array(
			"CREATE TABLE ".MPREFIX."seo_keywords (
			keyword_id int(10) unsigned NOT NULL auto_increment,
			keyword_page int(10) unsigned NOT NULL ,
			keyword_type varchar(200) NOT NULL default '',
			keyword_keywords text NOT NULL,
			keyword_date int(10) unsigned NOT NULL default '0',
			keyword_engine varchar(200) NOT NULL default '',
			PRIMARY KEY  (keyword_id)	
			) ENGINE=MyISAM ",
			
			"ALTER TABLE ".MPREFIX."spiderlog RENAME ".MPREFIX."seo_spiderlog  " ,
			"ALTER TABLE ".MPREFIX."seo_spiderlog CHANGE COLUMN url spider_url varchar(255) NOT NULL default ''",
			"ALTER TABLE ".MPREFIX."seo_spiderlog CHANGE COLUMN date spider_date varchar(255) NOT NULL default ''",
			"ALTER TABLE ".MPREFIX."seo_spiderlog CHANGE COLUMN agent spider_agent varchar(255) NOT NULL default ''",
			"ALTER TABLE ".MPREFIX."seo_spiderlog CHANGE COLUMN ip spider_ip varchar(255) NOT NULL default ''"			
			);			
} else if ($pref['plug_installed']['seopack'] < 2 ){
	$upgrade_alter_tables = array(
			"CREATE TABLE ".MPREFIX."spiderlog (
			spider_id int(11) unsigned NOT NULL auto_increment,
			url varchar(255) NOT NULL default '',
			date varchar(255) NOT NULL default '',
			agent varchar(255) NOT NULL default '',
			ip varchar(255) NOT NULL default '',
			PRIMARY KEY  (spider_id)
			) ENGINE=MyISAM;"
	);
	
} else {
	$upgrade_alter_tables = "";
}	

//SEO PACK Uninstall
if(!function_exists("seopack_uninstall")) {
	//Remove prefs entries during uninstall
	function SEOPACK_uninstall() {
		global $sql;
		$sql->db_Delete("core", "e107_name = 'seopack_prefs'");		
	}
}

//SEO PACK install
// if (!function_exists('seopack_install'))
// {
	// function forum_install()
	// {
		// $sql = new db();
		// $sql->db_Update('seopack', "");
	// }
// }
?>
