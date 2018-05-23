<?php


if ($pref['arcadeaddin_enable_gold'] == "1")
{$gold_obj = new gold();}



//------
$MainArcade_title .= "".$pref['altarcade_menutitle']."";
//------



//-------
$MainArcade_text .= "<table style='width:100%'>";
//-------


//-------
if ($pref['altarcade_enable_logo'] == "1"){

if ($pref['altarcade_logotype'] == "image"){
$MainArcade_text .= "<tr><td><center><img width='".$pref['altarcade_logosize']."', height='".$pref['altarcade_logosizeh']."' src='".$pref['altarcade_logopath']."'></img></td></tr>";}

if ($pref['altarcade_logotype'] == "flash"){
$MainArcade_text .= "<tr><td><center><embed width='".$pref['altarcade_logosize']."', height='".$pref['altarcade_logosizeh']."' src='".$pref['altarcade_logopath']."'></embed></td></tr>";}

}
//-------



//-------
if ($pref['altarcade_enable_totalcount'] == "1"){
$result = mysql_query("select game_title from ".MPREFIX."arcade_games ORDER BY game_title ASC");
$gamecount = mysql_num_rows($result);
$MainArcade_text .= "<tr><td><center>We Currently Have <b>".$gamecount."</b> Games Availible To Play!</td></tr>";
}
//-------            



//-------
if ($pref['altarcade_enable_playlist'] == "1"){   
$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."arcade_games WHERE game_enable=1".$rest." ORDER BY game_title ASC");
$rows = $sql->db_Rows();
$result = mysql_query("select game_title from ".MPREFIX."arcade_games ORDER BY game_title ASC");
$gamecount = mysql_num_rows($result);
for ($i=0; $i < $rows; $i++) 
{$option = $sql->db_Fetch();
$options .= "<option value='".$option['game_id']."'>".substr($option['game_title'],0,20)."</option>";}
  
$MainArcade_text .= "<tr><td><center>
                 <form action='".e_PLUGIN."kroozearcade_menu/play.php' method='POST'>
                 <select name='gameid' onChange=\"go()\">".$options."</select>  <input type=submit class=button name=submit value='Play Game'></form>
                 </td></tr>";
}
//-------


//-------
$MainArcade_text .= "</table>";
//--------





//----------------------------------Top 3 Winners--------------------------------

if ($pref['altarcade_enable_topthree'] == "1"){

$sql->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs group by user_id order by trophies desc limit 0,1;");
$result = $sql->db_fetch();

$sql2 = new db;
$sql2->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs group by user_id order by trophies desc limit 1,2;");
$result2 = $sql2->db_fetch();

$sql3 = new db;
$sql3->mySQLresult = @mysql_query("select user_id, count(game_id) as trophies from ".MPREFIX."arcade_champs group by user_id order by trophies desc limit 2,3;");
$result3 = $sql3->db_fetch();

$sql4 = new db;
$sql4 ->db_Select("user", "*", "WHERE user_id=".$result['user_id']."","");
$row4 = $sql4 ->db_Fetch();
if ($pref['altarcade_enable_topthreeavatar'] == "1"){
$useravatar = $row4[user_image];
}
$sql5 = new db;
$sql5 ->db_Select("user", "*", "WHERE user_id=".$result2['user_id']."","");
$row5 = $sql5 ->db_Fetch();
if ($pref['altarcade_enable_topthreeavatar'] == "1"){
$useravatar2 = $row5[user_image];
}
$sql6 = new db;
$sql6 ->db_Select("user", "*", "WHERE user_id=".$result3['user_id']."","");
$row6 = $sql6 ->db_Fetch();
if ($pref['altarcade_enable_topthreeavatar'] == "1"){
$useravatar3 = $row6[user_image];
}

if ($pref['altarcade_enable_topthreeavatar'] == "1"){
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$useravatar2 = avatar($useravatar2);
$useravatar3 = avatar($useravatar3);
}


if ($pref['arcadeaddin_enable_gold'] == "1"){
$arcadechamp1 = "".$gold_obj->show_orb($result['user_id'])."<br>With ".$result['trophies']." Wins";
$arcadechamp2 = "".$gold_obj->show_orb($result2['user_id'])."<br>With ".$result2['trophies']." Wins";
$arcadechamp3 = "".$gold_obj->show_orb($result3['user_id'])."<br>With ".$result3['trophies']." Wins";
}
else{
$arcadechamp1 = "".$row4['user_name']."<br>With ".$result['trophies']." Wins";
$arcadechamp2 = "".$row5['user_name']."<br>With ".$result2['trophies']." Wins";
$arcadechamp3 = "".$row6['user_name']."<br>With ".$result3['trophies']." Wins";
}




$MainArcade_text .= "<br><br><table style='width:100%' class='indent'>

<tr>
<td colspan='3' class='forumheader3'><center><font size='3'><b>Top 3 Arcade Winners</b></font></td>
</tr>

<tr>
<td style='width:33%' class='forumheader3'><center><img src='".e_PLUGIN."aacgc_arcade_addins/images/1st.gif'></img>First Place</td>
<td style='width:34%' class='forumheader3'><center><img src='".e_PLUGIN."aacgc_arcade_addins/images/2nd.gif'></img>Second Place</td>
<td style='width:33%' class='forumheader3'><center><img src='".e_PLUGIN."aacgc_arcade_addins/images/3rd.gif'></img>Third Place</td>
</tr>
<tr>

<td style='width:33%' class='indent'><center>".$arcadechamp1."<br>";

if ($pref['altarcade_enable_topthreeavatar'] == "1"){
$MainArcade_text .= "<br><img src='".$useravatar."' width=75px></img></center></td>";}
else
{$MainArcade_text .= "</td>";}

$MainArcade_text .= "<td style='width:34%' class='indent'><center>".$arcadechamp2."<br>";
if ($pref['altarcade_enable_topthreeavatar'] == "1"){
$MainArcade_text .= "<br><img src='".$useravatar2."' width=75px></img></center></td>";}
else
{$MainArcade_text .= "</td>";}

$MainArcade_text .= "<td style='width:33%' class='indent'><center>".$arcadechamp3."<br>";
if ($pref['altarcade_enable_topthreeavatar'] == "1"){
$MainArcade_text .= "<br><img src='".$useravatar3."' width=75px></img></center></td>";}
else
{$MainArcade_text .= "</td>";}

$MainArcade_text .= "</tr>
</table>
";
}
//------------------------------------------------------------------------------------------------------------------------------------------




if ($pref['altarcade_enable_links'] == "1"){

$MainArcade_text .= "<table style='width:100%' class=''><tr>
                 <td style='width:25%' class='forumheader3'><center><a href='".e_PLUGIN."kroozearcade_menu/tournaments.php'>Tournaments</a></td>
                 <td style='width:25%' class='forumheader3'><center><a href='".e_PLUGIN."kroozearcade_menu/challenges.php'>Challenges</a></td>
                 <td style='width:25%' class='forumheader3'><center><a href='".e_PLUGIN."kroozearcade_menu/hof.php'>Hall Of Fame</a></td>
                 </tr></table>";}








//----------------------------------Categories-----------------------------------
if ($pref['altarcade_enable_cats'] == "1"){

$MainArcade_text .= "<table style='width:100%' class='indent'>
<tr>
<td colspan=".$pref['altarcade_catcolms']." class='forumheader3'><center><b><u>Game Categories</u></b></td>
</tr><tr>
";

$sql2 = new db();
$sql2->db_Select("arcade_categories", "*", "1 ORDER BY cat_id ASC");
$rows2 = $sql2->db_Rows();

$pcol = 1;
for ($i = 0; $i < $rows2; $i++) {
$row2 = $sql2->db_Fetch();
$result = mysql_query("select game_filename from ".MPREFIX."arcade_games where game_category='".$row2['cat_id']."';");
$catcount = mysql_num_rows($result);




$MainArcade_text .= "<td class='forumheader3' style='width:33%'><center><a href='".e_PLUGIN."aacgc_arcade_addins/Category.php?det.".$row2['cat_id']."'><font size='".$pref['altarcade_catfsize']."'>".$row2['category_name']."</font></a>";

if ($pref['altarcade_enable_catcount'] == "1"){
$MainArcade_text .= "(".$catcount.")</td>";}
else
{$MainArcade_text .= "</td>";}


if ($pcol == $pref['altarcade_catcolms']) 
{$MainArcade_text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$MainArcade_text .= "
</tr></table>
";
}


//--------------------------------------------------------------------------------------

if ($pref['altarcade_enable_tourscurrent'] == "1"){

$MainArcade_text .= "<table style='width:100%' class='indent'><tr>";


if ($arcade_prefs['plushours'] != '') 
{$offset = $arcade_prefs['plushours'];}
else
{$offset = +0; //No of hours to add or subtract on the time}
$time = time()  + ($offset * 60 * 60);

// Current Tournaments
$sql->mySQLresult = @mysql_query("SELECT t.game_id, t.tournament_id, t.tournament_start, t.tournament_end, g.game_title, g.game_filename FROM ".MPREFIX."arcade_tournaments t, ".MPREFIX."arcade_games g WHERE g.game_id = t.game_id AND tournament_start < ".$time." AND tournament_end > ".$time.";");
$rows = $sql->db_Rows();

$MainArcade_text .= "<td colspan=3 class='forumheader3'><b><u><center>Current Tournaments</u></b></td></tr>";

$MainArcade_text .= "<tr><td class='forumheader3'><u>Game</u></td><td class='forumheader3'><center><u>Current Champion</u></td><td class='forumheader3'><center><u>Score</u></td>";
$MainArcade_text .= "</tr>";

for($i=0; $i<$rows; $i++){
$row = $sql->db_Fetch();
	
// Get score order
$ordersql = new db();
$ordersql->db_select("arcade_games WHERE game_id='".$row['game_id']."'", "reverse_score_order");
$order = $ordersql->db_Fetch();

if ($order['reverse_score_order'] == 1) 
{$scoreorder = 'ASC';}
else
{$scoreorder = 'DESC';}
$result = mysql_query("SELECT t.player_id, t.score, u.user_name from ".MPREFIX."arcade_tournaments_plays t, ".MPREFIX."user u where t.tournament_id='".$row['tournament_id']."' AND t.player_id = u.user_id ORDER BY t.score ".$scoreorder."");
$champ = mysql_fetch_array($result);

if ($pref['arcadeaddin_enable_gold'] == "1"){
$userorb = $gold_obj->show_orb($champ['player_id']);}
else
{$userorb = "".$champ['user_name']."";}


$MainArcade_text .= "<tr>";
$MainArcade_text .= "<td style='width:34%' class='forumheader3'><b><a href='".e_PLUGIN."kroozearcade_menu/tournaments.php?t=".$row['tournament_id']."'><img width='20' height='20' src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'></img>  ".$row['game_title']."</a></b></td>";
$MainArcade_text .= "<td style='width:33%' class='forumheader3'><center><a href='/user.php?id.".$champ['player_id']."'>".$userorb."</a></td>";
$MainArcade_text .= "<td style='width:33%' class='forumheader3'><center>".$champ['score']."</td>";
$MainArcade_text .= "</tr>";
}

$MainArcade_text .= "</table>";}

}
//--------------------------------------------------------------------------------------------

if ($pref['altarcade_enable_toursupcoming'] == "1"){


// Upcoming Tournaments

$MainArcade_text .= "<table style='width:100%' class='indent'><tr>";
$MainArcade_text .= "<td colspan=5 class='forumheader3'><b><u><center>Upcoming Tournaments</u></b></td></tr>";


$sql->mySQLresult = @mysql_query("SELECT t.game_id, g.game_category, t.tournament_id, t.tournament_start, t.tournament_prize, g.game_title, g.game_filename FROM ".MPREFIX."arcade_tournaments t, ".MPREFIX."arcade_games g WHERE g.game_id = t.game_id AND tournament_start > ".$time.";");
$rows = $sql->db_Rows();

$MainArcade_text .= "<tr>
<td style='width:75%' class='forumheader3'><u>Game</u></td>
<td style='width:25%' class='forumheader3'><center><u>Start Date</u></td>
</tr>";

for($i=0; $i<$rows; $i++){
$row = $sql->db_Fetch();
$MainArcade_text .= "<tr>";
$MainArcade_text .= "
<td style='width:75%' class='forumheader3'><a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$row['game_category']."&gameid=".$row['game_id']."'>
<img width='20' height='20' src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'></img>  ".$row['game_title']."</a></td>
<td style='width:25%' class='forumheader3'><center>".date("m/d h:i a", $row['tournament_start'])."</td>
";
$MainArcade_text .= "</tr>";}

$MainArcade_text .= "</table>";

}


$ns -> tablerender($MainArcade_title, $MainArcade_text);




?>




