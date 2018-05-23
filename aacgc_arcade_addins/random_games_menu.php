<?php
if(file_exists(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php")){
	require_once(e_PLUGIN."kroozearcade_menu/language/".e_LANGUAGE.".php");
}
else{
	require_once(e_PLUGIN."kroozearcade_menu/language/English.php");
}

require_once(e_PLUGIN."kroozearcade_menu/arcade_class.php");

global $arcade_prefs;






$late_text .= "
<table style='width:100%' class=''><tr>
<td style='width:95%'><u>Game</u></td>";

if ($pref['arcadeaddin_enable_xplayed'] == "1"){ 
$late_text .= "
<td style='width:5%'><u>Played</u></td>";}

$late_text .= "</tr><tr>";




$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."arcade_games WHERE game_enable=1".$rest." ORDER BY date_added DESC LIMIT 0,20");
$rows = $sql->db_Rows();
$sql->mySQLresult = @mysql_query("SELECT *, round((times_played / ((".(time())." - date_added)/86400)),2) as popularity FROM ".MPREFIX."arcade_games WHERE game_enable=1".$rest." ORDER BY rand() DESC LIMIT 0,".$pref['arcadeaddin_randgamecount']."");
$rows = $sql->db_Rows();

$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();


$late_text .= "
<td style='width:95%; text-align:left' class=''>
<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$row['game_category']."&gameid=".$row['game_id']."'>
<img width='20' height='20' src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'>    
<font size='1'><b>".$row['game_title']."</b></font></a>
</td>";

if ($pref['arcadeaddin_enable_xplayed'] == "1"){ 
$late_text .= "
<td style='width:5%'>
<center>".$row['times_played']."
</td>
";}


if ($pcol == 1) 
{$late_text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$late_text .= "
</table>
";


//-----------------------Latest Games End---------------------------------




$late_title = "".$pref['arcadeaddin_randgamecount']." Random Games";
$ns -> tablerender($late_title, $late_text);

?>




