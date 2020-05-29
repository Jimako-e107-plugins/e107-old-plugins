<?php
/*
+---------------------------------------------------------------+
|        e107 website system
|       
|        ©Steve Dunstan 2001-2002
|        http://e107.org
|        jalist@e107.org
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
|		$Source: ../e107_plugins/sport_league_e107/admin/set_time.php $
|		$Revision: 0.87 $
|		$Date: 2011/09/26 $
|		$Author: ***RuSsE*** $
+---------------------------------------------------------------+
*/
require_once("../../../class2.php");
if(!getperms("P")){ header("location:".e_BASE."index.php"); exit; }
$lan_file = e_PLUGIN."sport_league_e107/languages/".e_LANGUAGE."/admin_game_config_lan.php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."sport_league_e107/languages/German/admin_game_config_lan.php");
require_once("../functionen.php");
require_once(e_ADMIN."auth.php");
if (e_QUERY) {
	list($action, $GAM, $T) = explode(".", e_QUERY);
	$GAM = intval($GAM);
	$T= intval($T);
	unset($tmp);
}



$decr[0]="Durchlafend 0-".($pref["sport_league_periods"]*$pref["sport_league_times"])."";
$decr[1]="pro Spielabschnitt 0-".($pref["sport_league_times"])."";
$decr[2]="Rükwärts durchlafend ".($pref["sport_league_periods"]*$pref["sport_league_times"])."-0";
$decr[3]="Rükwärts pro Spielabschnitt ".($pref["sport_league_times"])."-0";



$text="<table style='width:96%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td class='forumheader'>
			<form action='admin_game_config.php?list.".$GAM.".1' method='post' id='vor'>
				<input class='button' style='width:300px;text-align:left;' type='submit' id='vor' name='vor' value='".$decr[0]."'/></form>
			</form>
		</td>
	</tr>
	<tr>
		<td class='forumheader'>
			<form action='admin_game_config.php?list.".$GAM.".2' method='post' id='vor'>
				<input class='button' style='width:300px;text-align:left;' type='submit' id='vor' name='vor' value='".$decr[1]."'/></form>
			</form>
		</td>
	</tr>
	<tr>
		<td class='forumheader'>
			<form action='admin_game_config.php?list.".$GAM.".3' method='post' id='vor'>
				<input class='button' style='width:300px;text-align:left;' type='submit' id='vor' name='vor' value='".$decr[2]."'/></form>
			</form>
		</td>
	</tr>
		<tr>
		<td class='forumheader'>
			<form action='admin_game_config.php?list.".$GAM.".4' method='post' id='vor'>
				<input class='button' style='width:300px;text-align:left;' type='submit' id='vor' name='vor' value='".$decr[3]."'/></form>
			</form>
		</td>
	</tr>
</table>
<br/>
<br/>
<div style='text-align:center;'>
<form action='admin_games_config.php?list.".$GAM."' method='post' id='back'>
<input class='button' type='submit' id='back' name='back' value='".LAN_LEAGUE_GAME_ADMIN_15."'/></form>
</form>
</div>
";


$ns -> tablerender($configtitle, $text);
require_once(e_ADMIN."footer.php");