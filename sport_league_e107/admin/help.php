<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|        GNU General Public License (http://gnu.org).
|		 Suitable only for e107 v0.7
|		$Revision: 0.87 $
|		$Date: 29.09.2011 13:32$
+---------------------------------------------------------------+
*/
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/help_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/help_lan.php");

//---------------------------------------------------------------
//              BEGIN CONFIGURATION AREA
//---------------------------------------------------------------

	$helptitle = LAN_LEAGUE_PLUGIN_HELP_1;//"Instructions";

// Help Text 1.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_2;//
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_3;//
// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_4;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_5;//"";	
// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_6;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_7;//"";	
	// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_8;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_9;//"";	
	// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_10;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_11;//"";	
	// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_12;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_13;//"";	
	// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_14;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_15;//"";	
	// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_16;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_17;//"";
	// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_18;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_19;//"";
	// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_20;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_21;//"";
		// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_22;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_23;//"";	
		// Help Text 2.
	$helpcapt[] = LAN_LEAGUE_PLUGIN_HELP_24;//"";
	$helptext[] = LAN_LEAGUE_PLUGIN_HELP_25;//"";	
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
