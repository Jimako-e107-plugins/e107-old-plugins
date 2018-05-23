<?php


require_once("../../class2.php");
require_once(e_PLUGIN."kroozearcade_menu/arcade_class.php");

require_once(HEADERF);


if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);}

if ($arcade_prefs['guestview'] == No) {
	if(!USER) { 
	$ns -> tablerender("Error", "".KROOZEARCADE_158.""); 
	require_once(FOOTERF); 
	exit; 
	} 
}
if ($arcade_prefs['plushours'] != '') {
$offset = $arcade_prefs['plushours'];
} else {
$offset = +0; //No of hours to add or subtract on the time
}
$now = time()  + ($offset * 60 * 60);

$sql->db_Select("arcade_banlist", "*", "user_id=".USERID." AND ban_arcade=1 AND ban_end_date > ".$now."");
$rows = $sql->db_Rows();
if ($rows > 0) {
$row = $sql->db_Fetch();
$date = date("d M Y - H:i", $row['ban_end_date']);
$text .= "".KROOZEARCADE_210." ".$date."<br/><br/><i>".KROOZEARCADE_228.":</i><br/>".$tp->toHTML($row['ban_reason'], true)."";
$ns->tablerender("", $text);
require_once(FOOTERF);
exit;
}

$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."arcade_categories WHERE cat_id = $sub_action");
$catname = $sql->db_Fetch();

$text .= "
<table style='width:100%' class='indent'><tr>
          <td colspan=5 class='forumheader3'><center><font color='' size='5'>".$catname['category_name']."</font></center></td>
          </tr><tr>";

//--------------# Multipage Script #---------------------------
$catid = $catname['cat_id'];
if ($arcade_prefs['gamesperpage'] == "") 
{$rowsPerPage = "";} 
else 
{$rowsPerPage = $arcade_prefs['gamesperpage'];} 
if(isset($_GET['rowspp']))
{$rowsPerPage = intval($_GET['rowspp']);}
$pageNum = 1;
if(isset($_GET['page']))
{$pageNum = intval($_GET['page']);}
$offset = ($pageNum - 1) * $rowsPerPage;
$query = @mysql_query("SELECT game_id FROM ".MPREFIX."arcade_games WHERE game_enable=1 AND game_category=".$catid."");
$numrows = mysql_num_rows($query);
if(isset($_POST['page'])) 
{$rowsPerPage = intval($_POST['page']);}
$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'];
$nav  = '';
for($page = 1; $page <= $maxPage; $page++) {
if ($page == $pageNum) 
{$nav .= " $page ";} 
else 
{$nav .= " <a href=\"$self?page=".$page."&rowspp=".$rowsPerPage."&det.".$catid."\">$page</a> ";}}
if ($pageNum > 1) 
{$page  = $pageNum - 1;
$prev  = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">Previous</a> ";} 
else 
{$prev  = "";}
if ($pageNum < $maxPage) 
{$page = $pageNum + 1;
$next = " <a href=\"$self?page=$page&rowspp=$rowsPerPage&det.$catid\">Next Page</a> ";} 
else 
{$next = "";}

$limit = "LIMIT ".$offset.", ".$rowsPerPage."";
//---------------------------------------------------------------

$sql->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."arcade_games WHERE game_category = $sub_action ORDER BY game_title ASC ".$limit."");
$rows = $sql->db_Rows();


$pcol = 1;
for ($i = 0; $i < $rows; $i++){
$row = $sql->db_Fetch();

$sql2->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."arcade_champs WHERE game_id=".$row['game_id']." ORDER BY score DESC LIMIT 0,1;");
$row2 = $sql2->db_Fetch();
$sql3 = new db;
$sql3->mySQLresult = @mysql_query("SELECT * FROM ".MPREFIX."users WHERE user_id=".$row2['user_id']."");
$row3 = $sql3->db_Fetch();

if ($pref['arcadeaddin_enable_gold'] == "1"){
$username = "".$gold_obj->show_orb($row2['user_id'])."";}
else
{$username = "".$row3['user_name']."";}

$score = "".$row2['score']."";


if ($row2['user_id'] == "")

{$champ = "<td class='indent' colspan=2>No Champion Yet!</td>";}
else
{$champ = "<td style='width:50%' class='indent'>Champion:</td>
           <td style='width:50%' class='indent'>".$username."</td>
           </tr><tr>
           <td style='width:50%' class='indent'>Score:</td>
           <td style='width:50%' class='indent'>".$score."</td>";}



$text .= "
<td style='width:25%' class='forumheader3'><center>
<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$row['game_category']."&gameid=".$row['game_id']."'>
<img width='60' height='60' src='".e_PLUGIN."kroozearcade_menu/games/".$row['game_filename'].".gif'> 
<br>   
<font size='3'>".$row['game_title']."</font></a>
<br><br>
<table style='width:100%' class='forumheader3'>
<tr>
<td style='width:50%' class='indent'><font size='1'>X Played:</td>
<td style='width:50%' class='indent'>".$row['times_played']."</font></td>
</tr><tr>
".$champ."
</tr>
</table>";

if ($pcol == 4) 
{$text .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}


$text .= "
</tr></table><br><br>
";







$ns -> tablerender($title, $text."<br><br>".$prev.$nav.$next);
require_once(FOOTERF);
?>


