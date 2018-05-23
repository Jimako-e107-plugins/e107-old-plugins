<?php
if(file_exists(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."kroozearcade_menu/language/English.php");
}

require_once(e_PLUGIN."kroozearcade_menu/arcade_class.php");

global $arcade_prefs;

//-----------------------Popular Games----------------------------------------------



$pop_text .= "
<table style='width:100%' class=''><tr>
<td style='width:95%'><u>Game</u></td>";

if ($pref['arcadeaddin_enable_xplayed'] == "1"){
$pop_text .= "
<td style='width:5%'><u>Played</u></td>";}

$pop_text .= "
</tr><tr>
";




$sql->mySQLresult = @mysql_query("SELECT game_id, game_filename, game_title, game_category, game_description, date_added, times_played, round((times_played / ((".(time())." - date_added)/86400)),2) as popularity FROM ".MPREFIX."arcade_games WHERE game_enable=1".$rest." ORDER BY times_played DESC LIMIT 0,".$pref['arcadeaddin_popgamecount']."");
$rows = $sql->db_Rows();



$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();

$pop_text .= "
<td style='width:95%; text-align:left' class=''>
<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$row['game_category']."&gameid=".$row['game_id']."'>
<img width='20' height='20' src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'>    
<font size='1'><b>".$row['game_title']."</b></font></a>
</td>";

if ($pref['arcadeaddin_enable_xplayed'] == "1"){
$pop_text .= "
<td style='width:5%' class=''>
<center>".$row['times_played']."
</td>
";}


if ($pcol == 1) 
{$pop_text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}



$pop_text .= "
</table>
";


//-----------------------Popular Games End----------------------------------------------


$pop_title = "Top ".$pref['arcadeaddin_popgamecount']." Arcade Games";
$ns -> tablerender($pop_title, $pop_text);

?>



