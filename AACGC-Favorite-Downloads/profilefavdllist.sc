if ($pref['favdls_enable_profilelist'] == "1"){
if (USER){

global $sql,$sql2,$user; 

$suser = "";
$USER_ID = "";

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
	if ($suser[1] == 'php?id') {
	$suser = $suser[2];
	}
$SUSER_ID = $suser;


if($pref['favdls_enable_theme'] == "1")
{$themea = "indent";}
else
{$themea = "";}

if($SUSER_ID == "".USERID."")
{$editbutton = "<a href='".e_PLUGIN."aacgc_favdls/EditFav.php'><img src='".e_PLUGIN."aacgc_favdls/images/edit.png' align=right></img></a>";}

//----------------------------------------------------------+

$favlistprofile .= "<div class=''><b><u>Favorite Downloads</u>:</b> ".$editbutton."<br><br></div>";
$favlistprofile .= "<div style='width:100%; height:".$pref['favdls_profilelist_height']."px; overflow:auto'>
		    <table style='width:100%' class=''>";

//----------------------------------------------------------+

$sql->db_Select("aacgc_favdls", "*", "user_id='".intval($SUSER_ID)."'");
while($row = $sql->db_Fetch()){

$sqldl = new db;
$sqldl->db_Select("download", "*", "download_id='".intval($row['user_favdls'])."'");
$rowdl = $sqldl->db_Fetch();

//----------------------------------------------------------+

$favlistprofile .= "<tr><td class='".$themea."'><a href='".e_BASE."download.php?view.".$rowdl['download_id']."'>".$rowdl['download_name']."</a></td></tr>";}

//----------------------------------------------------------+

$favlistprofile .= "</table></div>";

//----------------------------------------------------------+


return "<tr><td colspan=2 class='forumheader3'>".$favlistprofile."</td></tr>";

}}