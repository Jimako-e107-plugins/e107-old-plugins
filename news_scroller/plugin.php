<?php
/*
+---------------------------------------------------------------+
|	For e107 website system
|	News scroller
|   Parts based on scrolling banner menu  By BaD_DuD (Roger Wallin)
|	© nlstart
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
// Plugin info --------------------------------------------------
$eplug_name = "News Scroller";
$eplug_version = "1.2";
$eplug_author = "nlstart";
$eplug_logo = "images/logo_32.png";
$eplug_url = "http://e107coders.org";
$eplug_email = "nlstart@webstartinternet.com";
$eplug_description = "Scrolling News Menu";
$eplug_compatible = "e107v7+";
$eplug_readme = "";	// leave blank if no readme file

// XHTML compliant ----------------------------------------------
$eplug_compliant = TRUE;

// Status and latest menu ---------------------------------------
$eplug_status = FALSE;
$eplug_latest = FALSE;

// Name of the plugin's folder ----------------------------------
$eplug_folder = "news_scroller";

// Name of menu item for plugin ---------------------------------
$eplug_menu_name = "News Scroller";

// Name of the admin configuration file -------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ----------------------------------
$eplug_icon = $eplug_folder."/images/logo_32.png";
$eplug_icon_small = $eplug_folder."/images/logo_16.png";
$eplug_caption =  "Scrolling News Menu";

// List of preferences ------------------------------------------
$eplug_prefs = array(
	"news_scroller_title"   => 'Promoted news',
	"news_scroller_urlsize" => '50',
	"news_scroller_font"    => 'Arial',
	"news_scroller_weigth"  => 'bold',
	"news_scroller_speed"   => '4',
	"news_scroller_delay"   => '1',
	"news_scroller_border"  => '0',
	"news_scroller_dir"     => 'up',
	"news_scroller_rand"    => '0',
	"news_scroller_shows"   => '5',
	"news_scroller_hrline"  => '0',
	"news_scroller_center"  => '1',
	"news_scroller_text"    => '250',
	"news_scroller_space"    => '5'
);

// List of table names -------------------------------------------
$eplug_table_names = "";

// List of sql requests to create tables -------------------------
$eplug_tables = "";

// Create a link in main menu (yes=TRUE, no=FALSE) ---------------
$eplug_link = FALSE;
$eplug_link_name = "";
$eplug_link_url = "";

// Create a userclass  -------------------------------------------
$eplug_userclass = "";
$eplug_userclass_description = "";

// Text to display after plugin successfully installed -----------
$eplug_done = $eplug_name." is successfully installed.";

// upgrading ... 
$upgrade_add_prefs = "";

$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "Upgrading ".$eplug_name." to ".$eplug_version." is successfully done.";
?>