<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/settings_grouplist.php
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
    $configtitle = LAN_4xA_SPORTTIPPS_138;
		$pageid="1";
 
    $tablename = "4xa_wm_groups";   // becomes e107_user2 or yourprefix_user2.
    $primaryid = "group_id";   // first column of your table.
   	$sortfild = "group_order"; 	
// Field 1   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_139;
    $fieldname[] = "group_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";

		$fieldcapt[] = LAN_4xA_SPORTTIPPS_140;
    $fieldname[] = "group_round_id";
    $fieldtype[] = "table";
    $fieldvalu[] = "4xa_wm_rounds,round_id,round_name,round_order";
    
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_141;
    $fieldname[] = "group_order";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
// ++++++++ HELP FILE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $helptitle = LAN_4xA_SPORTTIPPS_138;
// Help Text 1.
    
    $helpcapt[] = LAN_4xA_SPORTTIPPS_139;
    $helptext[] = LAN_4xA_SPORTTIPPS_142;

    $helpcapt[] = LAN_4xA_SPORTTIPPS_140;
    $helptext[] = LAN_4xA_SPORTTIPPS_143;
    
    $helpcapt[] = LAN_4xA_SPORTTIPPS_141;
    $helptext[] = LAN_4xA_SPORTTIPPS_144;
    
?>
