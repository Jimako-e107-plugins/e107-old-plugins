if ($pref['favdls_enable_dlpagecount'] == "1"){
global $dl;

$dlfav = "";
$dlfav_id = "";

$url = $_SERVER["REQUEST_URI"];
$dlfav = explode(".", $url);
if ($dlfav[1] == 'php?view') 
{$dlfav = $dlfav[2];}
$favdl_id = $dlfav;

$sql->mySQLresult = @mysql_query("select user_favdls, count(user_id) as favusers from ".MPREFIX."aacgc_favdls where user_favdls='".intval($favdl_id)."';");
$results = $sql->db_fetch();

$favdlusercount = $results['favusers'];


return "<tr><td style='width:20%' class='forumheader3'>Favorite Downloaders</td><td style='width:20%' class='forumheader3'>".$favdlusercount." Users</td></tr>";

}

