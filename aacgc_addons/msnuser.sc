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

if ($pref['addon_enable_msnim'] == "1"){


$sql->db_Select("user_extended", "*", "WHERE user_extended_id='".$SUSER_ID."'", "");
$extp = $sql->db_Fetch();


$msn = "<tr><td colspan=2 class='forumheader3'><a href='http://osi.techno-st.net:8000/message/msn/".$extp['user_msn']."'><img src='http://osi.techno-st.net:8000/msn/".$extp['user_msn']."'></img></a></td></tr>";}}


return "".$msn."";