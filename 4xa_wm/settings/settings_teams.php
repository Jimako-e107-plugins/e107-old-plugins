<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/settings_stadions.php
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
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $configtitle = LAN_4xA_SPORTTIPPS_159;
	$pageid="2";
    $tablename = "4xa_wm_teams";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "team_id";   // first column of your table.
// Field 1   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_160;
    $fieldname[] = "team_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 3
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_162;
    $fieldname[] = "team_icon";
    $fieldtype[] = "image";
    $fieldvalu[] = e_PLUGIN."4xa_wm/img_teams/";
// ++++++++ HELP FILE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $helptitle = LAN_4xA_SPORTTIPPS_159;
// Help Text 1.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_160;
    $helptext[] = LAN_4xA_SPORTTIPPS_161;
// Help Text 2.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_162;
    $helptext[] = LAN_4xA_SPORTTIPPS_163;
// Help Text 3.
?>
