if ($pref['fl_enable_memlist'] == "1"){
if (USER){

global $user_shortcodes, $pref, $user; 

$mid = $user['user_id'];
$userid = "".USERID."";
$addicon = "<img src='".e_PLUGIN."aacgc_friendsys/images/addme.png' alt='Add To Friends List' align=right></img>";

if($userid == "{$mid}"){}
else
{

$sql->db_Select("aacgc_friend_sys", "*", "user_id='".USERID."'");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_friend_sys", "*", "user_id='".intval($mid)."'");    
$row2 = $sql2->db_Fetch();

$frienda = $row['user_friends'];
$friendb = $row2['user_friends'];

if($frienda == "{$mid}" OR $friendb == "".USERID."")
{$friendbutton = "";}
else
{$friendbutton = "<a href='".e_PLUGIN."aacgc_friendsys/AddMe.php?det.".$mid."'>".$addicon."</a>";}

return "".$friendbutton."";

}


}}