if ($pref['fl_enable_profilelist'] == "1"){
if (USER){

include_lan(e_PLUGIN."aacgc_friendsys/languages/".e_LANGUAGE.".php");

global $sql,$sql2,$user; 

$suser = "";
$USER_ID = "";

$url = $_SERVER["REQUEST_URI"];
$suser = explode(".", $url);
	if ($suser[1] == 'php?id') {
	$suser = $suser[2];
	}
$SUSER_ID = $suser;

if ($pref['fl_enable_gold'] == "1")
{$gold_obj = new gold();}

if($pref['fl_enable_theme'] == "1")
{$themea = "indent";}
else
{$themea = "";}

if($SUSER_ID == "".USERID."")
{$editbutton = "<a href='".e_PLUGIN."aacgc_friendsys/Friend_Requests.php'><img src='".e_PLUGIN."aacgc_friendsys/images/viewreqs.png' align=right></img></a><a href='".e_PLUGIN."aacgc_friendsys/Edit_Friends.php'><img src='".e_PLUGIN."aacgc_friendsys/images/editfriends.png' align=right></img></a>";}

//----------------------------------------------------------+

$sql3 = new db;
$sql3->db_Select("user", "*", "user_id='".intval($SUSER_ID)."'");
$row3 = $sql3->db_Fetch();

$sql->mySQLresult = @mysql_query("select user_id, count(user_friends) as friends from ".MPREFIX."aacgc_friend_sys where user_id='".intval($row3['user_id'])."';");
$result = $sql->db_fetch();

if ($pref['fl_enable_gold'] == "1")
{$userorbb = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$gold_obj->show_orb($row3['user_id'])."</a>";}
else
{$userorbb = "<a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$row3['user_name']."</a>";}

$flistprofile .= "<div class=''><b>".$userorbb." ".FSYS_33." ".$result['friends']." ".FSYS_34."</b> ".$editbutton."<br><br></div>";
$flistprofile .= "<div style='width:100%; height:".$pref['fl_profilelist_height']."px; overflow:auto'>
		  <table style='width:100%' class=''><tr>";

//----------------------------------------------------------+

$sql->db_Select("aacgc_friend_sys", "*", "user_id='".intval($SUSER_ID)."'");
$rows = $sql->db_Rows();
$pcol = 1;
for ($i = 0; $i < $rows; $i++){
while($row = $sql->db_Fetch()){

$sql2 = new db;
$sql2->db_Select("user", "*", "user_id='".intval($row['user_friends'])."'");
$row2 = $sql2->db_Fetch();


if($SUSER_ID == "".USERID.""){
if($pref['fl_enable_profileonline'] == "1"){
$sql3 = new db;
$script="SELECT ".MPREFIX."user.*,".MPREFIX."online.*  FROM ".MPREFIX."online LEFT JOIN ".MPREFIX."user ON ".MPREFIX."online.online_user_id= CONCAT(".MPREFIX."user.user_id,'.',".MPREFIX."user.user_name) WHERE ".MPREFIX."online.online_user_id=".$row['user_friends']."";
$sql3->db_Select_gen($script);    
$row3 = $sql3->db_Fetch();

$fid = $row3['user_id'];
$foid = $row['user_friends'];

if ($fid == "{$foid}")
{$onicon = "<img src='".e_PLUGIN."aacgc_friendsys/images/online.png' alt='Online'></img>";}
else
{$onicon = "<img src='".e_PLUGIN."aacgc_friendsys/images/offline.png' alt='Offline'></img>";}}}

if($pref['fl_enable_profileavatar'] == "1"){
if ($row2['user_image'] == "")
{$flavatar = "<img src='".e_PLUGIN."aacgc_friendsys/images/default.png' width='".$pref['fl_profile_avatarsize']."px', height='".$pref['fl_profile_avatarsize']."px'></img>";}
else
{$useravatar = $row2[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$flavatar = "<img src='".$useravatar."' width='".$pref['fl_profile_avatarsize']."px', height='".$pref['fl_profile_avatarsize']."px'></img>";}}

if ($pref['fl_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$gold_obj->show_orb($row2['user_id'])."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$row2['user_name']."</a>";}


if($SUSER_ID == "".USERID.""){
if($pref['fl_enable_profilepm'] == "1"){
$pmicon = "<a href='".e_PLUGIN."pm/pm.php?send.".$row2['user_id']."'><img src='".e_PLUGIN."aacgc_friendsys/images/pm.png'></img></a>";}}

//----------------------------------------------------------+

$flistprofile .= "<td style='width:150px' class='".$themea."'><center>".$flavatar."<br>".$userorb."<br>".$onicon." ".$pmicon."</center></td>";

//----------------------------------------------------------+

if ($pcol == $pref['fl_usersperrow']) 
{$flistprofile .= "</tr><tr>";
$pcol = 1;}
else
{$pcol++;}}}

//----------------------------------------------------------+

$flistprofile .= "</table></div>";

//----------------------------------------------------------+


return "<tr><td colspan=2 class='forumheader3'>".$flistprofile."</td></tr>";

}}