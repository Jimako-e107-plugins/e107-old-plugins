<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."e107_league_tipp/languages/admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."e107_league_tipp/languages/admin/English.php");

//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

	$helptitle = LAN_ADM_LEAGUE_TIP_8;//"Instructions";

// Help Text 1.
	$helpcapt[] = LAN_ADM_LEAGUE_TIP_9;//
	$helptext[] = LAN_ADM_LEAGUE_TIP_10;//


// Help Text 2.
	$helpcapt[] = LAN_ADM_LEAGUE_TIP_11;//"";
	$helptext[] = LAN_ADM_LEAGUE_TIP_12;//"";
	
    $helpcapt[] = LAN_ADM_LEAGUE_TIP_95; //
    $helptext[] = LAN_ADM_LEAGUE_TIP_96; //

//---------------------------------------------------------------
//              END OF CONFIGURATION AREA
//---------------------------------------------------------------

	$text2 = "";
	for ($i=0; $i<count($helpcapt); $i++) {
		$text2 .="<b>".$helpcapt[$i]."</b><br />";
	$text2 .=$helptext[$i]."<br /><br />";
	};

$ns -> tablerender($helptitle, $text2);
?>
