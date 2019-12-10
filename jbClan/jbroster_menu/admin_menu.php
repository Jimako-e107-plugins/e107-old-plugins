<?php
/*
+--------------------------------------------------------------------------------+
|   jbRoster - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
|
|   Plugin Support Site: www.jbwebware.com
|
|   A plugin designed for the e107 Website System
|   http://e107.org
|
|   For more plugins visit:
|   http://plugins.e107.org
|   http://www.e107coders.org
|
|   Released under the terms and conditions of the
|   GNU General Public License (http://gnu.org).
|
+--------------------------------------------------------------------------------+
*/

if(file_exists(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbroster_menu/languages/".e_LANGUAGE.".php");
}

$menutitle  = LAN_JBROSTER_ADMIN_MENU_TITLE;

$butname[]  = LAN_JBROSTER_GENERAL_ORG_PREFS;
$butlink[]  = "admin_config.php";
$butid[]    = "admin_menu_01";

$butname[]  = LAN_JBROSTER_GENERAL_MANAGE_ROSTER;
$butlink[]  = "admin_manage_roster.php";
$butid[]    = "admin_menu_02";

$butname[]  = LAN_JBROSTER_ADMIN_MENU_MANAGE_TEAMS;
$butlink[]  = "admin_manage_teams.php";
$butid[]    = "admin_menu_03";

$butname[]  = LAN_JBROSTER_GENERAL_CREATE_TEAMS;
$butlink[]  = "admin_create_teams.php";
$butid[]    = "admin_menu_04";

$butname[]  = LAN_JBROSTER_GENERAL_OPEN_APPS;
$butlink[]  = "admin_open_apps.php";
$butid[]    = "admin_menu_05";

$butname[]  = LAN_JBROSTER_GENERAL_ACTIVE_MEMBERS;
$butlink[]  = "admin_active.php";
$butid[]    = "admin_menu_06";

$butname[]  = LAN_JBROSTER_GENERAL_INACTIVE_MEMBERS;
$butlink[]  = "admin_inactive.php";
$butid[]    = "admin_menu_07";

$butname[]  = LAN_JBROSTER_GENERAL_CLOSED_APPS;
$butlink[]  = "admin_closed_apps.php";
$butid[]    = "admin_menu_08";

$butname[]  = LAN_JBROSTER_ADMIN_MENU_CUSTOM_CONTENT;
$butlink[]  = "admin_custom_content.php";
$butid[]    = "admin_menu_09";

$butname[]  = LAN_JBROSTER_GENERAL_DISPLAY_OPTIONS;
$butlink[]  = "admin_display_options.php";
$butid[]    = "admin_menu_10";

$butname[]  = LAN_JBROSTER_ADMIN_MENU_README;
$butlink[]  = "admin_readme.php";
$butid[]    = "admin_menu_11";

global $pageid;
for ($i=0; $i<count($butname); $i++) {
    $var[$butid[$i]]['text'] = $butname[$i];
    $var[$butid[$i]]['link'] = $butlink[$i];
};

show_admin_menu($menutitle, $pageid, $var);
?>
