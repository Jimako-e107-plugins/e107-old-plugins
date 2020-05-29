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
    $configtitle = LAN_4xA_SPORTTIPPS_150;
		$pageid="3";
    $tablename = "4xa_wm_stadions";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "stadion_id";   // first column of your table.
// Field 1   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_151;
    $fieldname[] = "stadion_ort";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 2   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_153;
    $fieldname[] = "stadion_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// Field 3
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_155;
    $fieldname[] = "stadion_icon";
    $fieldtype[] = "image";
    $fieldvalu[] = e_PLUGIN."4xa_wm/img_stations/";
// Field 4   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_157;
    $fieldname[] = "stadion_kapatitat";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// ++++++++ HELP FILE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $helptitle = LAN_4xA_SPORTTIPPS_150;
// Help Text 1.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_151;
    $helptext[] = LAN_4xA_SPORTTIPPS_152;
// Help Text 2.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_153;
    $helptext[] = LAN_4xA_SPORTTIPPS_154;
// Help Text 1.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_155;
    $helptext[] = LAN_4xA_SPORTTIPPS_156;
// Help Text 2.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_157;
    $helptext[] = LAN_4xA_SPORTTIPPS_158;
?>
