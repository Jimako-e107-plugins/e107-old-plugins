<?php
/*
+---------------------------------------------------------------+
|        Category Links Menu Plugin by acidfire
|        e107 website system
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
$eLX_dir = e_PLUGIN."categorylink_menu/";
$lan_file = $eLX_dir."language/".e_LANGUAGE.".php";
include(file_exists($lan_file) ? $lan_file : $eLX_dir."language/English.php");
// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Category Link Menu";
$eplug_version = "1.0";
$eplug_author = "acidfire";
$eplug_url = "http://acidfire.fireson.com/";
$eplug_email = "acidfire@fireson.com";
$eplug_description = categorylink_ADPLG_1;
$eplug_compatible = "e107v0.7";
$eplug_readme = "admin_categorylinkreadme.php";        // leave blank if no readme file
$eplug_compliant = TRUE; // Have To check TRUE or FALSE
$eplug_status = FALSE; // Admin Status Section
$eplug_latest = FALSE; // Admin Latest Section
// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "categorylink_menu";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "categorylink_menu"; 

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_linkcategory.php";

// v.7Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/linkspage_32.png";
$eplug_icon_small = $eplug_folder."/images/linkspage_16.png";
$eplug_caption =  categorylink_ADPLG_2;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
	"menucategory_class" => 0,
	"categorylink_expandit" => categorylink_Option_2,
	"categorylink_images" => categorylink_Option_1,
	"ctable_class" => "fborder",
	"categorylink_title" => categorylink_ADPLG_2,
	"categorylink_display" => categorylink_Option_3,	
  );
// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array(
"linkcategory",
"categorylink"
);
// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
"CREATE TABLE ".MPREFIX."linkcategory (
linkcategory_id int(11) unsigned NOT NULL auto_increment,
linkcategory_name VARCHAR(150) NOT NULL default '',
linkcategory_pic VARCHAR(150) NOT NULL default '',
linkcategory_class int(11) NOT NULL default '0',
linkcategory_css varchar(150) NOT NULL default '',
PRIMARY KEY (linkcategory_id)
) TYPE=MyISAM;",
"CREATE TABLE ".MPREFIX."categorylink (
categorylink_id int(11) unsigned NOT NULL auto_increment,
categorylink_name VARCHAR(150) NOT NULL default '',
categorylink_link VARCHAR(150) NOT NULL default '',
categorylink_cat VARCHAR(150) NOT NULL default '',
categorylink_pic VARCHAR(150) NOT NULL default '',
categorylink_class int(11) NOT NULL default '0',
categorylink_open int(11) NOT NULL default '0',
categorylink_css varchar(150) NOT NULL default '',
PRIMARY KEY (categorylink_id)
) TYPE=MyISAM;");

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = e_PLUGIN."";
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = categorylink_ADPLG_3;
// upgrading ... //
$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";
?>
