<?php




$SCROLLER_title .= "".$pref['arcadeaddon_scoresmenutitle']."";



if ($pref['arcadeaddin_enable_gold'] == "1"){
$gold_obj = new gold();}



//SCROLLER

$SCROLLER_text .= "
<table style='width:100%' class='fcaption'><tr><td>
<marquee width='100%' onMouseover='this.scrollAmount=".$pref['arcadeaddonscore_onscroll']."' onMouseout='this.scrollAmount=".$pref['arcadeaddonscore_offscroll']."'>
<font size='3'>
";

$csql = new db();
$sql->mySQLresult = @mysql_query("SELECT s.game_id, g.game_title, g.game_category, u.user_id, u.user_name, s.score, s.date_scored FROM ".MPREFIX."arcade_scores s, ".MPREFIX."user u, ".MPREFIX."arcade_games g WHERE u.user_id = s.user_id and g.game_id = s.game_id and g.game_enable = '1' ".$rest." ORDER BY s.date_scored DESC LIMIT 0,".$pref['arcadeaddon_scoresmenucount'].";");
$rows = $sql->db_Rows();
for ($i=0; $i < $rows; $i++) {
$result = $sql->db_fetch();
$datescored = date("d M Y",$result['date_scored']);

if ($pref['arcadeaddin_enable_gold'] == "1"){
$userorb = "".$gold_obj->show_orb($result['user_id'])."";}
else
{$userorb = "".$result['user_name']."";}


$SCROLLER_text .= "
".$userorb." scored <b>".$result['score']."</b> in 
<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$result['game_category']."&gameid=".$result['game_id']."'><b>".$result['game_title']."</b></a> 
    ,    ";}

$SCROLLER_text .= "</font></marquee></td></tr></table>";

// END OF SCROLLER






$ns -> tablerender($SCROLLER_title, $SCROLLER_text);




?>






