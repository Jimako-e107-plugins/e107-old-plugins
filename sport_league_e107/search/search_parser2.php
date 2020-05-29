<?php
/*
+ ----------------------------------------------------------------------------+
|     e107 website system
|
|     ©Steve Dunstan 2001-2002
|     http://e107.org
|     jalist@e107.org
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
|     $Source: /cvsroot/e107/e107_0.7/e107_plugins/links_page/search/search_parser.php,v $
|     $Revision: 1.2 $
|     $Date: 2005/12/14 19:28:44 $
|     $Author: sweetas $
+----------------------------------------------------------------------------+
*/

if (!defined('e107_INIT')) { exit; }

// advanced 
$advanced_where = "";
if (isset($_GET['cat']) && is_numeric($_GET['cat'])) {
	$advanced_where .= " l.game_league_id='".$_GET['cat']."'";
}

if (isset($_GET['match']) && $_GET['match']) {
	$search_fields = array('hn.team_name', 'gn.team_name');
} else {
	$search_fields = array('hn.team_name', 'gn.team_name');
}

// basic        leagueteam_team_id
$return_fields = 'l.game_id, l.game_date, l.game_home_id, l.game_gast_id, l.game_goals_home, l.game_goals_gast, l.game_enable, hn.team_name, gn.team_name';
$weights = array('1.2', '0.6');
$no_results = LAN_198;
$where = "hn.team_name IN (".USERCLASS_LIST.") AND".$advanced_where;
$order = "";
$table = "league_games AS l LEFT JOIN #league_leagueteams AS ht ON ht.leagueteam_id = l.game_home_id
														LEFT JOIN #league_leagueteams AS gt ON gt.leagueteam_id = l.game_gast_id
														LEFT JOIN #league_teams AS hn ON hn.team_id = ht.leagueteam_team_id
														LEFT JOIN #league_teams AS gn ON gn.team_id = gt.leagueteam_team_id
														LEFT JOIN #league_leagues AS ll ON ll.league_id = ht.leagueteam_league_id
														LEFT JOIN #league_saison AS s ON s.saison_id = ll.league_saison_id
														";


$ps = $sch -> parsesearch($table, $return_fields, $search_fields, $weights, 'search_links', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_links($row) {
	$res['link'] = e_PLUGIN."sport_league_e107/???.php?".$row['players_id'];
	$res['pre_title'] = $row['team_name']." | ";
	$res['title'] = $row['players_name'];
	$res['summary'] = "".strftime("am %a %d %b %Y um %H:%M",$row['game_date'])." game   ".$row['hn.team_name']." : ".$row['gn.team_name']."";
	$res['detail'] = "Spieler Profil: <a href='".e_PLUGIN."sport_league_e107/profil.php?player_id=".$row['roster_id']."'>".$row['players_name']."</a> ansehen.";
	return $res;
}

?>