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

if ($pref['addon_enable_aimim'] == "1"){


$sql->db_Select("user_extended", "*", "WHERE user_extended_id='".$SUSER_ID."'", "");
$extp = $sql->db_Fetch();


$aim = "<tr><td colspan=2 class='forumheader3'><a href='aim:goim?screenname=".$extp['user_aim']."'><img src='http://technoserv.no-ip.org:8080/aim/".$extp['user_aim']."'></img></a></td></tr>";}}


return "".$aim."";
