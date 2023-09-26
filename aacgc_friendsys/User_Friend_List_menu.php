<?php

include_lan(e_PLUGIN."aacgc_friendsys/languages/".e_LANGUAGE.".php");

/*
#######################################
#     e107 website system plguin      #
#     AACGC Friend System             #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#######################################
*/

if ($pref['fl_enable_gold'] == "1")
{$gold_obj = new gold();}

if($pref['fl_enable_theme'] == "1")
{$themea = "indent";}
else
{$themea = "";}

//----------------------------------------------------------------------------------------------------

$flmenu_title .= "".$pref['fl_menu_title']."";

//----------------------------------------------------------------------------------------------------

if (USER){

$sql->mySQLresult = @mysql_query("select user_id, count(user_friends) as friends from ".MPREFIX."aacgc_friend_sys where user_id='".USERID."';");
$result = $sql->db_fetch();

$edit = "<a href='".e_PLUGIN."aacgc_friendsys/Edit_Friends.php'><img src='".e_PLUGIN."aacgc_friendsys/images/editfriends.png' alt='".FSYS_36."' align='right' /></a>";
$view = "<a href='".e_PLUGIN."aacgc_friendsys/Friend_Requests.php'><img src='".e_PLUGIN."aacgc_friendsys/images/viewreqs.png' alt='".FSYS_37."' align='right' /></a>";

$flmenu_text .= "<table style='width:100%' class=''>
                 <tr>
 		 <td style='width:100%' class='".$themea."'>".FSYS_35." ".$result['friends']."</td>
		 <td style='width:0%' class='".$themea."'>".$view."</td>
		 <td style='width:0%' class='".$themea."'>".$edit."</td>
                 </tr>
                 </table>
		 <div style='width:100%; height:".$pref['fl_menu_height']."px; overflow:auto'>
		 <table style='width:100%'>";


//---------------------+

$sql->db_Select("aacgc_friend_sys", "*", "user_id='".USERID."'");    
while($row = $sql->db_Fetch()){

$sql2 = new db;
$sql2->db_Select("user", "*", "user_id='".intval($row['user_friends'])."'");    
$row2 = $sql2->db_Fetch();


$sql3 = new db;
$script="SELECT ".MPREFIX."user.*,".MPREFIX."online.*  FROM ".MPREFIX."online LEFT JOIN ".MPREFIX."user ON ".MPREFIX."online.online_user_id= CONCAT(".MPREFIX."user.user_id,'.',".MPREFIX."user.user_name) WHERE ".MPREFIX."online.online_user_id=".$row['user_friends']."";
$sql3->db_Select_gen($script);    
$row3 = $sql3->db_Fetch();

$fid = $row3['user_id'];
$foid = $row['user_friends'];

if ($fid == "{$foid}")
{$onicon = "<img src='".e_PLUGIN."aacgc_friendsys/images/online.png' alt='Online'></img>";}
else
{$onicon = "<img src='".e_PLUGIN."aacgc_friendsys/images/offline.png' alt='Offline'></img>";}

//---------------------+

if($pref['fl_enable_menuavatar'] == "1"){
if ($row2['user_image'] == "")
{$flmenuavatar = "<img src='".e_PLUGIN."aacgc_friendsys/images/default.png' width='".$pref['fl_menu_avatarsize']."px', height='".$pref['fl_menu_avatarsize']."px'></img>";}
else
{$useravatar = $row2[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$flmenuavatar = "<img src='".$useravatar."' width='".$pref['fl_menu_avatarsize']."px', height='".$pref['fl_menu_avatarsize']."px'></img>";}}

if ($pref['fl_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$gold_obj->show_orb($row2['user_id'])."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$row2['user_name']."</a>";}

$pmicon = "<a href='".e_PLUGIN."pm/pm.php?send.".$row2['user_id']."'><img src='".e_PLUGIN."aacgc_friendsys/images/pm.png'></img></a>";

//---------------------+

$flmenu_text .= "<tr>";

$flmenu_text .= "<td class='".$themea."' style='width:100%'>".$flmenuavatar."".$userorb."</td>";

if($pref['fl_enable_menuonline'] == "1"){
$flmenu_text .= "<td class='".$themea."' style='width:0%'>".$onicon."</td>";}

if($pref['fl_enable_menupm'] == "1"){
$flmenu_text .= "<td class='".$themea."' style='width:0%'>".$pmicon."</td>";}

$flmenu_text .= "</tr>";}


$flmenu_text .= "</table></div>";}

//----------------------+

else

{$flmenu_text .= "".FSYS_38."";}

//------------------------------------------------------------------------------------------------+

$ns -> tablerender($flmenu_title, $flmenu_text);

?>