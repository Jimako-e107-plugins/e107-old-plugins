<?php
/*
+--------------------------------------------------------------------------------+
|   jbApp - by Jesse Burns aka jburns131 aka Jakle (jburns131@jbwebware.com)
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

if(file_exists(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php")) {
    include_lan(e_PLUGIN."jbapp/languages/".e_LANGUAGE.".php");
}

$sql->db_Select("plugin", "*");
while($rows = $sql->db_Fetch()){
    if (($rows['plugin_name'] == "jbRoster") && ($rows['plugin_installflag'] == "1")) {
        $installed_jbroster = 1;
    }
}

$menutitle  = LAN_JBAPP_ADMIN_MENU_TITLE;

$butname[]  = LAN_JBAPP_ADMIN_MENU_LINK_1;
$butlink[]  = "admin_config.php";
$butid[]    = "admin_menu_01";

$butname[]  = LAN_JBAPP_ADMIN_MENU_LINK_2;
$butlink[]  = "admin_display_options.php";
$butid[]    = "admin_menu_02";


if (!$installed_jbroster) {
    $butname[]  = LAN_JBAPP_ADMIN_MENU_LINK_3;
    $butlink[]  = "admin_custom_content.php";
    $butid[]    = "admin_menu_03";
}

$butname[]  = LAN_JBAPP_ADMIN_MENU_LINK_4;
$butlink[]  = "admin_readme.php";
$butid[]    = "admin_menu_04";

global $pageid;
for ($i=0; $i < count($butname); $i++) {
    $var[$butid[$i]]['text'] = $butname[$i];
    $var[$butid[$i]]['link'] = $butlink[$i];
};

show_admin_menu($menutitle, $pageid, $var);
?>
