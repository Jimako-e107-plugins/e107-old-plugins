if ($pref['gamelist_enable_profile'] == "1"){

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

$gamelistprofile .= "<tr><td colspan=2 class='forumheader3'>";

$sql->db_Select("aacgc_gamelist_members", "*", "user_id='".intval($SUSER_ID)."' LIMIT 0,".$pref['numgamesprofile']."");
while($row = $sql->db_Fetch()){

if ($row['chosen_game_id'] == ""){}

else

{$sql2 = new db;
$sql2->db_Select("aacgc_gamelist", "*", "game_id='".intval($row['chosen_game_id'])."'");
while($row2 = $sql2->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gamelist_profileiconpath'] == "")
{$profileiconpath = "icons";}
else
{$profileiconpath = "".$pref['gamelist_profileiconpath']."";}
//---------------------------------------+

$gamelistprofile .= "<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row2['game_id']."'><img width='".$pref['gamelist_profile_img']."' src='".e_PLUGIN."aacgc_gamelist/".$profileiconpath."/".$row2['game_pic']."' alt='".$row2['game_name']."'></img>";}}}}


$gamelistprofile .= "</td></tr>";







return "<br>".$gamelistprofile ."<br>";
}