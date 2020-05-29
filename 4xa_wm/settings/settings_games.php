<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/settings_games.php
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
$MY_LIST="";
for($i=0; $i<20;$i++)
	{
	$MY_LIST.="".$i."";
	if($i < 19){$MY_LIST.=",";}
	}
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_4xA_SPORTTIPPS_107;
		$pageid="2";
    $tablename = "4xa_wm_games";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "game_id";   // first column of your table.
// Field 0   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_108;
    $fieldname[] = "rounde";
    $fieldtype[] = "table";
    $fieldvalu[] = "4xa_wm_rounds,round_id,round_name,round_name";
// Field 1
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_109;
    $fieldname[] = "group_pre";
    $fieldtype[] = "table";
    $fieldvalu[] = "4xa_wm_groups,group_id,group_name,group_name";
// Field 2   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_110;
    $fieldname[] = "timeof_game";
    $fieldtype[] = "caleder";
    $fieldvalu[] = "%d.%m.%Y,%H:%M,1,1";
 // Field 3   - first field after the primary one.   
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_111;
    $fieldname[] = "home";
    $fieldtype[] = "dropdown";
    $fieldvalu[] = "";
// Field 4
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_112;
    $fieldname[] = "guest";
    $fieldtype[] = "dropdown";
    $fieldvalu[] = "";
// Field 5
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_113;
    $fieldname[] = "goals_home";
    $fieldtype[] = "dropdown";
    $fieldvalu[] = "50,".$MY_LIST;
// Field 6
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_114;
    $fieldname[] = "goals_guest";
    $fieldtype[] = "dropdown";
    $fieldvalu[] = "50,".$MY_LIST;
// Field 7
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_115;
    $fieldname[] = "mode";
    $fieldtype[] = "dropdown";
    $fieldvalu[] = "35,1,2,3";
// Field 8
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_119;
    $fieldname[] = "stadion";
    $fieldtype[] = "table";
    $fieldvalu[] = "4xa_wm_stadions,stadion_id,stadion_ort,stadion_ort";
// ++++++++ HELP FILE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $helptitle = LAN_4xA_SPORTTIPPS_120;
// Help Text 1.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_108;
    $helptext[] = LAN_4xA_SPORTTIPPS_121;
// Help Text 2.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_109;
    $helptext[] = LAN_4xA_SPORTTIPPS_122;
// Help Text 3.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_110;
    $helptext[] = LAN_4xA_SPORTTIPPS_123;
// Help Text 4.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_111;
    $helptext[] = LAN_4xA_SPORTTIPPS_124;
// Help Text 5.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_112;
    $helptext[] = LAN_4xA_SPORTTIPPS_125;
// Help Text 6.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_113;
    $helptext[] = LAN_4xA_SPORTTIPPS_126;
// Help Text 7.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_114;
    $helptext[] = LAN_4xA_SPORTTIPPS_127;
// Help Text 8.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_115;
    $helptext[] = LAN_4xA_SPORTTIPPS_128;
// Help Text 9.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_119;
    $helptext[] = LAN_4xA_SPORTTIPPS_129;
?>
