global $sql,$sql2,$user; 

$suser = "";
$USER_ID = "";


$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
	if ($suser[1] == 'php?id') {
	$suser = $suser[2];
	}
$SUSER_ID = $suser;

if (USER){

$userarcadewins .= "<tr><td colspan=2 class='forumheader3'>";


$userarcadewins .= "<table width='100%'><tr>
<td class='fcaption' colspan=3><center>Current Champion of:</td></tr>
";
$userarcadewins .= "<tr>
          <td style='width:50%' class=''>Game</td>
          <td style='width:25%' class=''>Score</td>
          <td style='width:25%' class=''><center>Date</td>
          </tr><tr>";

$sql->mySQLresult = @mysql_query("SELECT user_name FROM ".MPREFIX."user WHERE user_id='".$SUSER_ID."' ");
$user = $sql->db_Fetch();
$sql->mySQLresult = @mysql_query("SELECT SUM(duration) as dur FROM ".MPREFIX."arcade_scores WHERE user_id='".$SUSER_ID."'");
$totaltime = $sql->db_Fetch();
$sql->mySQLresult = @mysql_query("SELECT g.game_id, g.game_title, g.game_category, c.date_scored, c.user_id, c.game_id, c.score FROM ".MPREFIX."arcade_champs c, ".MPREFIX."arcade_games g WHERE c.user_id='".$SUSER_ID."' AND g.game_id = c.game_id ORDER BY game_title ASC");
$rows = $sql->db_Rows();
for ($i = 0; $i < $rows; $i++) {
$row = $sql->db_Fetch();

$userarcadewins .= "<tr>
<td style='width:50%' class='indent'>
<a href='".e_PLUGIN."kroozearcade_menu/play.php?catid=".$row['cat_id']."&gameid=".$row['game_id']."' class='arcadelink'>".$row['game_title']."</a>
</td>
<td style='width:25%' class='indent'>".$row['score']."</td>
<td style='width:25%' class='indent'><center>".date("M d, Y - h:i", $row['date_scored'])."</td>
</tr>";}

$userarcadewins .= "</table>";


$userarcadewins .= "</td></tr>";



return "<br>".$userarcadewins."<br>";
}