if ($pref['gamelist_enable_forum'] == "1"){

global $post_info, $sql;

$postowner  = $post_info['user_id'];



$sql->db_Select("aacgc_gamelist_members", "*", "user_id='".intval($postowner)."' ORDER BY rand() LIMIT 0,".$pref['numgames']."");
while($row = $sql->db_Fetch()){

if ($row['chosen_game_id'] == ""){}

else

{$sql2 = new db;
$sql2->db_Select("aacgc_gamelist", "*", "game_id='".intval($row['chosen_game_id'])."'");
while($row2 = $sql2->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gamelist_forumiconpath'] == "")
{$forumiconpath = "icons";}
else
{$forumiconpath = "".$pref['gamelist_forumiconpath']."";}
//---------------------------------------+

$gamelistforum .= "<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row2['game_id']."'><img width='".$pref['gamelist_forum_img']."' src='".e_PLUGIN."aacgc_gamelist/".$forumiconpath."/".$row2['game_pic']."' alt='".$row2['game_name']."'></img></a>";}}}}







return "<br>Games I Play:<br>".$gamelistforum."<br>";




