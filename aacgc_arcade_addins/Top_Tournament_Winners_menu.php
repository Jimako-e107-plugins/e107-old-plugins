<?php
/*
+---------------------------------------------------------------+
|        KroozeArcade for e107 v0.7
|        Compatible with all games from www.ibparcade.com
|
|        A plugin for the e107 website system
|        http://www.e107.org/
|
|        &copy;Paul Blundell
|        www.boreded.co.uk
|        mail@boreded.co.uk
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if(file_exists(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."kroozearcade_menu/language/English.php");
}

require_once(e_PLUGIN."kroozearcade_menu/arcade_class.php");

global $arcade_prefs;

// Create an array of all the users who have played in tournaments
$users = Array();
$n = "0";
$sql->mySQLresult = @mysql_query("SELECT player_id FROM ".MPREFIX."arcade_tournaments_plays");
$rows = $sql->db_Rows();

for ($i=0;$i<$rows;$i++) {
$row = $sql->db_Fetch();

if (!in_array($row['player_id'], $users)) {
$users[] = $row['player_id'];
}

}


foreach ($users as $u) {
$statsone[$u] = 0;
$statstwo[$u] = 0;
$statsthree[$u] = 0;
}


// Run through all ended tournaments and add up totals for each user
$tsql = new db();
$tsql->mySQLresult = @mysql_query("SELECT tournament_id, tournament_prize, game_id FROM ".MPREFIX."arcade_tournaments WHERE tournament_ended='1' ORDER BY tournament_id DESC");
$rows = $tsql->db_Rows();
for ($i = 0; $i < $rows; $i++) {
$row = $tsql->db_Fetch();

// Get score order
$sql->db_select("arcade_games WHERE game_id='".$row['game_id']."'", "reverse_score_order");
$result = $sql->db_Fetch();
if ($result['reverse_score_order'] == 1) {
$scoreorder = 'ASC';
$dbscore = 'MIN(0+score)';
} else {
$scoreorder = 'DESC';
$dbscore = 'MAX(0+score)';
}

$sql->mySQLresult = @mysql_query("SELECT ".$dbscore." as sco, player_id FROM ".MPREFIX."arcade_tournaments_plays WHERE tournament_id=".$row['tournament_id']." GROUP BY play_id ORDER BY sco ".$scoreorder." LIMIT 0,3");
$winners = $sql->db_Rows();
  if ($winners > 0) {

	for ($w = 1; $w <= $winners; $w++) {
	$winnersdata = $sql->db_Fetch();
	$winner[$w] = $winnersdata['player_id'];
	}

	
	foreach ($users as $u) {

		if ($u == $winner[1]) {
		$statsone[$u] = $statsone[$u] + 1;
		} elseif ($u == $winner[2]) {
		$statstwo[$u] = $statstwo[$u] + 1;
		} elseif ($u == $winner[3]) {
		$statsthree[$u] = $statsthree[$u] + 1;
		}

	}
	
	
	$winner = Array();

   }

}


foreach ($users as $u) {
$points = ($statsone[$u] * $arcade_prefs['tournmenuone']) + ($statstwo[$u] * $arcade_prefs['tournmenutwo']) + ($statsthree[$u] * $arcade_prefs['tournmenuthree']);

$statsp[$u] = $points;
}



// Order by points and output
$text = "<table width='100%' class=''><tr>
<td></td>
<td><u>".KROOZEARCADE_MENU_1."</u></td>
<td><u>".KROOZEARCADE_MENU_8."</u></td>
<td><u>".KROOZEARCADE_MENU_9."</u></td>
<td><u>".KROOZEARCADE_MENU_10."</u></td>
<td><center><u>".KROOZEARCADE_MENU_5."</center></u></td>
</tr>";

arsort($statsp);
$count = 0;
foreach ($statsp as $user => $s) {

if ($count != $pref['arcadeaddin_topusertcount']) {
$name = get_user_data($user);


if ($pref['arcadeaddin_enable_gold'] == "1"){
$gold_obj = new gold();
$tourwin = "".$gold_obj->show_orb($name['user_id'])."";}
else
{$tourwin = "".$name['user_name']."";}
$n++;

$text .= "<tr>
<td class=''>".$n.".</td>
<td class=''><a href='".e_BASE."user.php?id.".$user."'>".$tourwin."</a></td>
<td class=''>".$statsone[$user]."</td>
<td class=''>".$statstwo[$user]."</td>
<td class=''>".$statsthree[$user]."</td>
<td class=''><center>".$s."</center></td>
</tr>";

$count++;
}

}

$text .= "</table>";

$title = "Top ".$pref['arcadeaddin_topusertcount']." Tournament Members";


$ns -> tablerender($title, $text);
?>


