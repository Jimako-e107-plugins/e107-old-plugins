if ($pref['favdls_enable_dlpage'] == "1"){
if (USER){
global $dl;

$dlfav = "";
$dlfav_id = "";

$url = $_SERVER["REQUEST_URI"];
$dlfav = explode(".", $url);
if ($dlfav[1] == 'php?view') 
{$dlfav = $dlfav[2];}
$favdl_id = $dlfav;


$sql->mySQLresult = @mysql_query("select user_id, count(user_favdls) as favs from ".MPREFIX."aacgc_favdls where user_id='".USERID."';");
$result = $sql->db_fetch();

if ($result['favs'] == "".$pref['favdls_usermaxfav']."" OR $result['favs'] > "".$pref['favdls_usermaxfav'].""){
$addfavbutton = "<i>You Cannot Have Any More Favorites</i>";}

else

{
$sql->db_Select("aacgc_favdls", "*", "user_id='".USERID."'");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("aacgc_favdls", "*", "user_favdls='".intval($favdl_id)."'");
$row2 = $sql2->db_Fetch();

$favid = $row['user_favdls'];
$dlid = $row2['user_id'];
$userid = "".USERID."";

if($favdl_id == "{$favid}" OR $userid == "{$dlid}"){
$addfavbutton = "<i>This Download Is In Your Favorites</i>";}

else

{$addfavicon = "<img src='".e_PLUGIN."aacgc_favdls/images/add.png'></img> Add to Favorites";
$addfavbutton = "<a href='".e_PLUGIN."aacgc_favdls/AddFav.php?det.".$favdl_id."'>".$addfavicon."</a>";}}}

else

{$addfavbutton = "<i>You Must Login or Register to Add Downloads to Favorites.</i>";}

return "<tr><td style='width:20%' class='forumheader3'>Favorite Download</td><td style='width:20%' class='forumheader3'>".$addfavbutton."</td></tr>";

}