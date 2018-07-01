<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
@include_once(e_PLUGIN."messenger_status_menu/languages/".e_LANGUAGE.".php");
@include_once(e_PLUGIN."messenger_status_menu/languages/English.php");

// Plugin info -------------------------------------------------------------------------------------------------------
$eplug_name = "Messenger Status";
$eplug_version = "3.10";
$eplug_author = "Jedi (Based on messenger_status_menu_v3.0)";
$eplug_logo = "./images/logo.gif";
$eplug_url = "http://www.langenbach-service.com";
$eplug_email = "webmaster@langenbach-service.com";
$eplug_description = MSTAT_14;
$eplug_compatible = "e107v7+";
$eplug_readme = "";        // leave blank if no readme file

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "messenger_status_menu";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "messenger_status_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/logo.png";
$eplug_caption =  MSTAT_15;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
        "messenger_status_caption"=>"Messenger Status",
        "messenger_status_server"=>"http://osi.techno-st.net:8000/",
        "messenger_status_yahoo"=>"",
		    "messenger_status_msn"=>"",
		    "messenger_status_icq"=>"",
		    "messenger_status_aim"=>"",
		    "messenger_status_skype"=>"",
		    "messenger_status_jabber"=>""
		);

// List of table names -----------------------------------------------------------------------------------------------
$eplug_table_names = "";

// List of sql requests to create tables -----------------------------------------------------------------------------
$eplug_tables = "";


// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = FALSE;
$eplug_link_name = "";
$ec_dir = e_PLUGIN."";
$eplug_link_url = "";


// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = MSTAT_13;


// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>
