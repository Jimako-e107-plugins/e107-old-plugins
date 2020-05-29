<?php
/*
+---------------------------------------------------------------+
|	4xA-UED v0.1 - by ***Operator99*** (www.e107.4xA.de) 04.06.2013
|	sorce: ../../4xA_UED/plugin.php
|
|        For the e107 website system
|        ©Steve Dunstan
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT')) { exit; }

// Plugin info -------------------------------------------------------------------------------------------------------
$lan_file = e_PLUGIN."4xA_UED/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xA_UED/languages/German.php");
$eplug_name = LAN_4xA_UED_PLUGINNAME;
$eplug_version = "0.2";
$eplug_author = "***Operator99***";
$eplug_url = "";
$eplug_email = "e107@4xa.de";
$eplug_description = LAN_4xA_UED_PLUGINDESC;
$eplug_compatible = "e107v7+";
$eplug_readme = "";
// leave blank if no readme file
$eplug_compliant = TRUE;

// Name of the plugin's folder -------------------------------------------------------------------------------------
$eplug_folder = "4xA_UED";

// Mane of menu item for plugin ----------------------------------------------------------------------------------
$eplug_menu_name = "4xA_ued_menu";

// Name of the admin configuration file --------------------------------------------------------------------------
$eplug_conffile = "admin_config.php";

// Icon image and caption text ------------------------------------------------------------------------------------
$eplug_icon = $eplug_folder."/images/icon_32.png";
$eplug_icon_small = $eplug_folder."/images/icon_16.png";
$eplug_caption = LAN_4xA_UED_PLUGINTITLE;

// List of preferences -----------------------------------------------------------------------------------------------
$eplug_prefs = array(
"4xA_ued_1" => 1,
"4xA_ued_2" => "",
"4xA_ued_user_loginname" =>1,
"4xA_ued_user_customtitle" =>1,
"4xA_ued_user_password" =>0,
"4xA_ued_user_sess" =>0,
"4xA_ued_user_email" =>0,
"4xA_ued_user_signature" =>0,
"4xA_ued_user_image" =>0,
"4xA_ued_user_timezone" =>0,
"4xA_ued_user_hideemail" =>0,
"4xA_ued_user_join" =>1,
"4xA_ued_user_lastvisit" =>1,
"4xA_ued_user_lastpost" =>0,
"4xA_ued_user_chats" =>1,
"4xA_ued_user_comments" =>1,
"4xA_ued_user_forums" =>1,
"4xA_ued_user_ip" =>0,
"4xA_ued_user_ban" =>1,
"4xA_ued_user_prefs" =>0,
"4xA_ued_user_new" =>0,
"4xA_ued_user_viewed" =>0,
"4xA_ued_user_visits" =>1,
"4xA_ued_user_admin" =>1,
"4xA_ued_user_login" =>0,
"4xA_ued_user_class" =>0,
"4xA_ued_user_perms" =>0,
"4xA_ued_user_realm" =>0,
"4xA_ued_user_pwchange" =>0,
"4xA_ued_user_xup" =>0
);

// Create a link in main menu (yes=TRUE, no=FALSE) -------------------------------------------------------------
$eplug_link = false;
// Text to display after plugin successfully installed ------------------------------------------------------------------
$eplug_done = LAN_4xA_UED_INSTALL_DONE;
// upgrading ... //

$upgrade_add_prefs = "";
$upgrade_remove_prefs = "";
$upgrade_alter_tables = "";
$eplug_upgrade_done = "";

?>