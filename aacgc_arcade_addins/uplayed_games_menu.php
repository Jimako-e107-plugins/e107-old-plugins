<?php






//----------------------Unplayed Games----------------------------------------------



$unplayed_text .= "
<table style='width:100%' class=''><tr>
<td style='width:90%'><u>Game</u></td></tr>";



$sql->mySQLresult = @mysql_query("SELECT game_id, game_filename, game_title, game_category, game_description, date_added, times_played, round((times_played / ((".(time())." - date_added)/86400)),2) as popularity FROM ".MPREFIX."arcade_games WHERE game_enable=1".$rest." ORDER BY times_played ASC LIMIT 0,".$pref['arcadeaddon_unplayedcount'].";");
while($row = $sql->db_Fetch()){

if ($row['times_played'] == "0"){

$unplayed_text .= "
<tr><td style='width:90%' class=''>
<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$row['game_category']."&gameid=".$row['game_id']."'>
<img width='20' height='20' src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'>    
<font size='1'<b>".$row['game_title']."</b></font></a></td></tr>";}}



$unplayed_text .= "
</table>
";



//----------------------Unplayed Games End-----------------------------------------


$unplayed_title = "Random Unplayed Games";

$ns -> tablerender($unplayed_title, $unplayed_text);

?>


