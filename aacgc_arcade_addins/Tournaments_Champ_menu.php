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

$sql->mySQLresult = @mysql_query("SELECT player_id FROM ".MPREFIX."arcade_tournaments_plays");
$rows = $sql->db_Rows();

for ($i=0;$i<$rows;$i++){
$row = $sql->db_Fetch();

if (!in_array($row['player_id'], $users)) {
$users[] = $row['player_id'];}}


foreach ($users as $u) {
$statsone[$u] = 0;
$statstwo[$u] = 0;
$statsthree[$u] = 0;}


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
	$winner[$w] = $winnersdata['player_id'];}

	
	foreach ($users as $u) {

		if ($u == $winner[1]) {
		$statsone[$u] = $statsone[$u] + 1;
		} elseif ($u == $winner[2]) {
		$statstwo[$u] = $statstwo[$u] + 1;
		} elseif ($u == $winner[3]) {
		$statsthree[$u] = $statsthree[$u] + 1;
		}}
$winner = Array();}}


foreach ($users as $u) 
{$points = ($statsone[$u] * $arcade_prefs['tournmenuone']) + ($statstwo[$u] * $arcade_prefs['tournmenutwo']) + ($statsthree[$u] * $arcade_prefs['tournmenuthree']);
$statsp[$u] = $points;}



// Order by points and output
$text = "<table width='100%' class=''>";

arsort($statsp);
$count = 0;
foreach ($statsp as $user => $s){


//$name = getx_user_data($user);
$name = e107::user($user);
if ($pref['arcadeaddin_enable_gold'] == "1"){
$gold_obj = new gold();
$tourchamp = "".$gold_obj->show_orb($name['user_id'])."";}
else
{$tourchamp = "".$name['user_name']."";}

if ($pref['arcadeaddin_enable_avatar'] == "1"){
if ($name['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $name[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['arcadeaddin_avatar_size']."px></img>";}}

if ($count != 1){

$text .= "<tr>
<td><center><br><a href='".e_BASE."user.php?id.".$user."'>".$tourchamp."<br>".$avatar."</a>
<br>
With ".$s." Points!</td>
</tr><tr>
<td><center>
(".$statsone[$user].") 1st Place
<br>
(".$statstwo[$user].") 2nd Place
<br>
(".$statsthree[$user].") 3rd Place
</td>
</tr><tr>
<td><center><img src='".e_PLUGIN."aacgc_arcade_addins/images/trophyt.bmp'></img></td>";

$count++;}}

$text .= "</table>";

$title = "Current Tournaments Champion";


$ns -> tablerender($title, $text);
?>

