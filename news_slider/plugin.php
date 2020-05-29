<?php
/*
+---------------------------------------------------------------+
|        News Slider
|				 Autor ***RuSsE***
|				 http://www.e107.4xa.de e107-Temlates.de
|					
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

// Plugin info -------------------------------------------------------------------------------------------------------
$lan_file = e_PLUGIN."news_slider/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."news_slider/languages/German.php");
$eplug_name = NEWSSLIDER_LAN_2;
$eplug_version = NEWSSLIDER_LAN_1;
$eplug_author = "***RuSsE***";
$eplug_url = "www.e107.4xa.de";
$eplug_email = "Admin@4xa.de";
$eplug_description = NEWSSLIDER_LAN_3;
$eplug_compatible = "e107v7+";
$eplug_readme = "";
// leave blank if no readme file
$eplug_compliant = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "news_slider";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "news_slider_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption = NEWSSLIDER_LAN_5;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
		"news_slider_news_list" => 1,
		"news_slider_count" => 5,
		"news_slider_time" => 7,
		"news_slider_news_list_count" => 10,
		"news_slider_news_list2" => 1,
		"news_slider_kategorien_show" => 0,
		"news_slider_kategorien_show_nfp_display" => 1,
		"news_slider_chars" => 400


);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = true;
$eplug_link_name = NEWSSLIDER_LAN_4;
$eplug_link_url = e_PLUGIN."news_slider/news_slider.php";

// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = "";


// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>