<?php

if (!defined("e107_INIT")) { exit; }

@include_lan(e_PLUGIN."what/languages/".e_LANGUAGE.".php");


// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "What";
$eplug_version = "0.2.1";
$eplug_author = "Patrick Weaver";
$eplug_url = "http://trickmod.com/";
$eplug_email = "patrickweaver@gmail.com";
$eplug_description = "Site activity menus (and more) package!";
$eplug_compatible = "e107 v1.0+";
$eplug_readme = "";

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "what";

// Name of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "fatty_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon.png";
$eplug_icon_small = $eplug_folder."/images/icon.png";
$eplug_caption = "What: Site Activity";

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
	"what_slim_viewaccess" => "",
	"what_fatty_viewaccess" => "",
	"what_twobyfour_viewacesss" => "",
	"what_fatty_timeframe" => 432000,
	"what_fatty_layer" => 0,
	"what_fatty_layerheight" => 250,
	"what_fatty_notify" => "date"
 );

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = array('what_twobyfour');

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = array(
	"CREATE TABLE ".MPREFIX."what_twobyfour (
	id int(10) unsigned NOT NULL auto_increment,
	user_id int(10) unsigned NOT NULL,
	user_name varchar(250) NOT NULL,
	page_name varchar(250) NOT NULL,
	visit_time varchar(250) NOT NULL,
	count int(10) unsigned NOT NULL default '0',
	PRIMARY KEY  (id)
	) ENGINE=MyISAM AUTO_INCREMENT=1;");

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "What has successfully been installed? Oh yeah, the What plugin has!";
$eplug_upgrade_done = "What has been updated? Oh yeah, the What plugin has!";

$upgrade_alter_tables = "";

?>