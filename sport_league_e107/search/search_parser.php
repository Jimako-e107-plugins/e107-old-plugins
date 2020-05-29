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
	$advanced_where .= " l.players_user_id='".$_GET['cat']."' AND";
}

if (isset($_GET['match']) && $_GET['match']) {
	$search_fields = array('l.players_name');
} else {
	$search_fields = array('l.players_name', 'l.players_description');
}

// basic        leagueteam_team_id
$return_fields = 'l.players_id, l.players_name, l.players_description, l.players_user_id, t.team_name, c.roster_id, ll.league_name, s.saison_name';
$weights = array('1.2', '0.6');
$no_results = LAN_198;
$where = "l.players_name IN (".USERCLASS_LIST.") AND".$advanced_where;
$order = "";
$table = "league_players AS l LEFT JOIN #league_roster AS c ON l.players_id = c.roster_player_id
															LEFT JOIN #league_leagueteams AS lt ON lt.leagueteam_id = c.roster_team_id
															LEFT JOIN #league_teams AS t ON t.team_id = lt.leagueteam_team_id
															LEFT JOIN #league_leagues AS ll ON ll.league_id = lt.leagueteam_league_id
															LEFT JOIN #league_saison AS s ON s.saison_id = ll.league_saison_id
															";

$ps = $sch -> parsesearch($table, $return_fields, $search_fields, $weights, 'search_links', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_links($row) {
	$res['link'] = e_PLUGIN."sport_league_e107/???.php?".$row['players_id'];
	$res['pre_title'] = $row['league_name']." | ";
	$res['title'] = $row['players_name'];
	$res['summary'] = "in Kader von: <b>".$row['team_name']."<b/>\n in Liga: <b>".$row['league_name']."<b/><br/> Saison: <b>".$row['saison_name']."<b/>";
	$res['detail'] = "Spieler Profil: <a href='".e_PLUGIN."sport_league_e107/profil.php?player_id=".$row['roster_id']."'>".$row['players_name']."</a> ansehen.";
	return $res;
}

?>