<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|		$Revision: 0.87 $
|		$Date: 29.09.2011 10:34
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_menu_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/English/admin_menu_lan.php");



	$menutitle = LAN_LEAGUE_ADMIN_MENU_1; //Liga- Verwaltung

	$butname[] = LAN_LEAGUE_ADMIN_MENU_2;  // Saisons
	$butlink[] = "admin_saison_config.php";
	$butid[] = "admin_saison";

	$butname[] = LAN_LEAGUE_ADMIN_MENU_3;  // Ligen
	$butlink[] = "admin_league_config.php";
	$butid[] = "admin_leagueteams";


	$butname[] = LAN_LEAGUE_ADMIN_MENU_4;  // Stadionen
	$butlink[] = "admin_stadions_config.php";
	$butid[] = "admin_stadions";

	$butname[] = LAN_LEAGUE_ADMIN_MENU_8;  // Teams Verwalten
	$butlink[] = "admin_teams_config.php";
	$butid[] = "admin_teams";

	$butname[] = "".LAN_LEAGUE_ADMIN_MENU_9."";  // Spieler Verwalten
	$butlink[] = "admin_players.php";
	$butid[] = "admin_player";

	$butname[] = LAN_LEAGUE_ADMIN_MENU_16;  // Spieler Verwalten
	$butlink[] = "admin_tleague_archiv_config.php?list";
	$butid[] = "admin_league_arhiv";

	$menutitle2 = LAN_LEAGUE_ADMIN_MENU_10; //Liga- Einstellungen

	$butname2[] = LAN_LEAGUE_ADMIN_MENU_11;  // Voreinstellungen
	$butlink2[] = "admin_prefs.php";
	$butid2[] = "prefs";
	
	$butname2[] = LAN_LEAGUE_ADMIN_MENU_12;  // Menüs
	$butlink2[] = "admin_pref_menus.php";
	$butid2[] = "prefs2"; 

	$butname2[] = LAN_LEAGUE_ADMIN_MENU_14;  // Liga-Tabelle
	$butlink2[] = "admin_pref_ligatable.php";
	$butid2[] = "prefs4"; 
	
	$butname2[] = LAN_LEAGUE_ADMIN_MENU_15;  // Punkten- System
	$butlink2[] = "admin_pref_poinssystem.php";
	$butid2[] = "prefs3"; 

	//$butname2[] = LAN_LEAGUE_ADMIN_MENU_17;  // Punkten- System
	//$butlink2[] = "admin_test2_config.php";
	//$butid2[] = "filemanager"; 

	$butname2[] = LAN_LEAGUE_ADMIN_MENU_18;  // Punkten- System
	$butlink2[] = "admin_poins_value_config.php";
	$butid2[] = "poins_value"; 

	$butname2[] = LAN_LEAGUE_ADMIN_MENU_19;  // Punkten- System
	$butlink2[] = "admin_player_data_config.php";
	$butid2[] = "admin_player_data_config"; 
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
global $pageid;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};

    show_admin_menu($menutitle,$pageid, $var );

	for ($i=0; $i<count($butname2); $i++) {
        $var2[$butid2[$i]]['text'] = $butname2[$i];
		$var2[$butid2[$i]]['link'] = $butlink2[$i];
	};
		show_admin_menu($menutitle2,$pageid, $var2 );
		
// the code can be removed before release of your plugin.

if($pageid == "match"){
    $ns -> tablerender("plugin.php generator",plugin_selector());
}

?> 
