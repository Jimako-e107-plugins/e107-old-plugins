<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/admin/admin_menu.php
|	
|        	For the e107 website system
|        	Steve Dunstan
|        	http://e107.org
|        	jalist@e107.org
|
|        	Released under the terms and conditions of the
|        	GNU General Public License (http://gnu.org).
|				
+---------------------------------------------------------------+
*/
$lan_file=e_PLUGIN."4xa_wm/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN."4xa_wm/languages/German.php");
// ++++++++ ADMIN MENU CONFIGURATION +++++++++++++++++++++++++++++++++++++++++++
    $menutitle = LAN_4xA_SPORTTIPPS_100;

    $butname1[] = LAN_4xA_SPORTTIPPS_101;
    $butlink1[] = "admin_groups.php";
		$pageid_list[] = "1";

    $butname1[] = LAN_4xA_SPORTTIPPS_102;
    $butlink1[] = "admin_teams.php";
		$pageid_list[] = "2";
		
		$butname1[] = LAN_4xA_SPORTTIPPS_103;
    $butlink1[] = "admin_stadions.php";
		$pageid_list[] = "3";

    $butname1[] = LAN_4xA_SPORTTIPPS_104;
    $butlink1[] = "admin_rounds.php";
		$pageid_list[] = "4";


    $butname1[] = LAN_4xA_SPORTTIPPS_105;
    $butlink1[] = "admin_games.php";
		$pageid_list[] = "5";


    $butname1[] = LAN_4xA_SPORTTIPPS_106;
    $butlink1[] = "admin_prefsconfig.php";
		$pageid_list[] = "prefs";

///++++++++++++++++++++++++++++++++++++
global $pageid;
	for ($i=0; $i<count($butname1); $i++) {
        $var[$pageid_list[$i]]['text'] = $butname1[$i];
		$var[$pageid_list[$i]]['link'] = $butlink1[$i];
	};

    show_admin_menu($menutitle,$pageid, $var );

	for ($i=0; $i<count($butname2); $i++) {
        $var2[$pageid_list2[$i]]['text'] = $butname2[$i];
		$var2[$pageid_list2[$i]]['link'] = $butlink2[$i];
	};
		show_admin_menu($menutitle2,$pageid, $var2 );
?>
