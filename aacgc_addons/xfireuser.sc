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


//----------------------------------------------------------------

if ($pref['addon_enable_xfireim'] == "1"){


$sql->db_Select("user_extended", "*", "WHERE user_extended_id='".$SUSER_ID."'", "");
$extp = $sql->db_Fetch();


$xfire = "<tr><td colspan=2 class='forumheader3'><a href='http://profile.xfire.com/".$extp['user_xfire']."'><img src='http://miniprofile.xfire.com/bg/bg/type/3/".$extp['user_xfire'].".png' width='149' height='29'></img></a></td></tr>";}}


return "".$xfire."";