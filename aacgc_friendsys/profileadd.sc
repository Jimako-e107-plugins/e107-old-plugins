if ($pref['fl_enable_profile'] == "1"){
if (USER){

global $sql,$sql2,$user; 

$suser = "";
$proid = "";

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
	if ($suser[1] == 'php?id') {
	$suser = $suser[2];
	}


$proid = $suser;
$userid = "".USERID."";
$addicon = "<img src='".e_PLUGIN."aacgc_friendsys/images/addme.png' alt='Add To Friends List' align=right></img>";

if($userid == "{$proid}"){}
else
{

$sql->db_Select("aacgc_friend_sys", "*", "user_id='".USERID."'");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_friend_sys", "*", "user_id='".intval($proid)."'");    
$row2 = $sql2->db_Fetch();

$frienda = $row['user_friends'];
$friendb = $row2['user_friends'];

if($frienda == "{$proid}" OR $friendb == "".USERID."")
{$friendbutton = "";}
else
{$friendbutton = "<a href='".e_PLUGIN."aacgc_friendsys/AddMe.php?det.".$proid."'>".$addicon."</a>";}

return "".$friendbutton."";

}


}}