<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        GNU General Public License (http://gnu.org).
|		 
+---------------------------------------------------------------+
*/
//		BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

$lan_file = e_PLUGIN."e107_league_tipp/languages/".e_LANGUAGE."/liga_tipp_admin_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/German/liga_tipp_admin_menu_lan.php");

	$menutitle = LAN_LEAGUE_TIPP_ADMIN_MENU_1;//"Menu Title";

	$butname[] = LAN_LEAGUE_TIPP_ADMIN_MENU_2;//"Voreinstellungen"; 
	$butlink[] = "admin_prefs.php";
	$butid[] = "prefs";

	$butname[] = LAN_LEAGUE_TIPP_ADMIN_MENU_3;//"Benutzer";  
	$butlink[] = "admin_tip_users.php";  
	$butid[] = "tips_users"; 

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
global $pageid;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle,$pageid, $var);

if($pageid == "match"){
    $ns -> tablerender("",plugin_selector());
}

?>
