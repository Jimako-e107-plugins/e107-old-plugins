<?php
/*
+---------------------------------------------------------------+
|	4xA-Formular v0.10 - by ***RuSsE*** (www.e107.4xA.de) 23.02.2011
+---------------------------------------------------------------+
*/
//		BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

if (!defined('e107_INIT')) {exit;}
require_once("constanten.php");
$lan_file = e_PLUGIN.e4xA_FORM_FOLDER."/languages/".e_LANGUAGE.".php";
include_once(file_exists($lan_file) ? $lan_file : e_PLUGIN.e4xA_FORM_FOLDER."/languages/German.php");

	$menutitle = LAN_4xA_FORM_05;//"Menu Title";

	$butname[] = LAN_4xA_FORM_121;
	$butlink[] = "admin_kategorien.php";
	$butid[] = "kat";

	$butname[] = LAN_4xA_FORM_23;
	$butlink[] = "admin_readme.php";
	$butid[] = "help";
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
global $pageid,$sql2;;
	for ($i=0; $i<count($butname); $i++) {
        $var[$butid[$i]]['text'] = $butname[$i];
		$var[$butid[$i]]['link'] = $butlink[$i];
	};
	
 show_admin_menu($menutitle,$pageid, $var);
//////////////////////////////////////////////////////
///////////////////////////////////
	$menutitle2 = LAN_4xA_FORM_121;//"Menu Title";
$sql -> db_Select("e4xA_form_kathegories", "*", "form_kat_id!=''");
while($row = $sql->db_Fetch()){
$butname2[] = $row['form_kat_name'];
$butlink2[] = "admin_optionen.php?list.0.".$row['form_kat_id'];
$butid2[] = "opt_".$row['form_kat_id'];
}
//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------
	for ($i=0; $i<count($butname2); $i++) {
        $var2[$butid2[$i]]['text'] = $butname2[$i];
		$var2[$butid2[$i]]['link'] = $butlink2[$i];
	};
	
 show_admin_menu($menutitle2,$pageid, $var2);

if($pageid == "match"){
    $ns -> tablerender(LAN_4xA_FORM_28,plugin_selector());
}

?>