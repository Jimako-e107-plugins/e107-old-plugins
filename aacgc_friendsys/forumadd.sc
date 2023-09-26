if ($pref['fl_enable_forum'] == "1"){
if (USER){
global $post_info, $sql;

$postowner  = $post_info['user_id'];
$userid = "".USERID."";
$addicon = "<img src='".e_PLUGIN."aacgc_friendsys/images/addme.png' alt='Add To Friends List' align=right></img>";

if($userid == "{$postowner}"){}
else
{
$sql->db_Select("aacgc_friend_sys", "*", "user_id='".USERID."'");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_friend_sys", "*", "user_id='".intval($postowner)."'");    
$row2 = $sql2->db_Fetch();

$frienda = $row['user_friends'];
$friendb = $row2['user_friends'];


if($row['user_friends'] == $postowner OR $friendb == "".USERID."")
{$friendbutton = "";}
else
{$friendbutton = "<a href='".e_PLUGIN."aacgc_friendsys/AddMe.php?det.".$postowner."'><img src='".e_PLUGIN."aacgc_friendsys/images/addme.png' alt='Add To Friends List'></img></a>";}


return "".$friendbutton."";
}



}}

