<?php
/*
+---------------------------------------------------------------+
|       	4xA-Sporttipps  v.0.9.5 - by ***RuSsE*** (www.e107.4xA.de)
|	released 14.07.2011
|	sorce: ../../4xa_wm/settings_rounds.php
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
// ++++++++ ADMIN TABLE PAGE CONFIGURATION +++++++++++++++++++++++++++++++
    $configtitle = LAN_4xA_SPORTTIPPS_145;
		$pageid="4";
    $tablename = "4xa_wm_rounds";
    $primaryid = "round_id";
		$sortfild = "round_order"; 	
// Field 1   - first field after the primary one.
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_146;
    $fieldname[] = "round_name";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_148;
    $fieldname[] = "round_order";
    $fieldtype[] = "text";
    $fieldvalu[] = "";
    
    $fieldcapt[] = LAN_4xA_SPORTTIPPS_219;
    $fieldname[] = "round_typ";
    $fieldtype[] = "dropdown";
    $fieldvalu[] = "150,1:".LAN_4xA_SPORTTIPPS_220.",2:".LAN_4xA_SPORTTIPPS_221."";
    
    

// ++++++++ HELP FILE CONFIGURATION +++++++++++++++++++++++++++++++++++++
    $helptitle = LAN_4xA_SPORTTIPPS_145;
// Help Text 1.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_146;
    $helptext[] = LAN_4xA_SPORTTIPPS_147;
// Help Text 1.
    $helpcapt[] = LAN_4xA_SPORTTIPPS_148;
    $helptext[] = LAN_4xA_SPORTTIPPS_149;
?>
