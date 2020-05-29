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
    $configtitle = LAN_4xA_SPORTTIPPS_165;
		$pageid="3";
    $tablename = "4xa_wm_teams_in_groups";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "teams_in_groups_id";   // first column of your table.   
// ++++++++ HELP FILE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $helptitle = LAN_4xA_SPORTTIPPS_165;
// Help Text 1.
    
    $helpcapt[] = LAN_4xA_SPORTTIPPS_166;
    $helptext[] = LAN_4xA_SPORTTIPPS_167;

    $helpcapt[] = LAN_4xA_SPORTTIPPS_168;
    $helptext[] = LAN_4xA_SPORTTIPPS_169;
    
   	$helpcapt[] = LAN_4xA_SPORTTIPPS_170;
    $helptext[] = LAN_4xA_SPORTTIPPS_171;
    
    
?>
