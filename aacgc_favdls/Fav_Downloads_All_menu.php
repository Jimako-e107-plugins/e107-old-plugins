<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

if($pref['favdls_enable_theme'] == "1")
{$themea = "indent";}
else
{$themea = "";}

if ($pref['favdls_enable_gold'] == "1")
{$gold_obj = new gold();}

//----------------------------------------------------------------------------------------------------

$favdlsmenu_title .= "".$pref['favdls_menu_title']."";

//----------------------------------------------------------------------------------------------------

if (USER){


$favdlsmenu_text .= "<div style='width:100%; height:".$pref['favdls_menu_height']."px; overflow:auto'>
		     <table style='width:100%'>";

//---------------------+

if($pref['favdls_menumax'] == "" OR "0")
{$limit = "";}
else
{$limit = "LIMIT 0,".$pref['favdls_menumax']."";}

$sql->mySQLresult = @mysql_query("select user_id, count(user_favdls) as favs from ".MPREFIX."aacgc_favdls GROUP BY user_id ORDER BY favs DESC $limit;");
while($favdls = $sql->db_fetch()){

$sql2 = new db;
$sql2->db_Select("user", "*", "user_id='".intval($favdls['user_id'])."'");    
$row2 = $sql2->db_Fetch();

if($pref['favdls_enable_menuavatar'] == "1"){
if ($row2['user_image'] == "")
{$avatar = "<img src='".e_PLUGIN."aacgc_favdls/images/default.png' width=".$pref['favdls_menu_avatarsize']."px></img>";}
else
{$useravatar = $row2[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$favdlsmenuavatar = "<img src='".$useravatar."' width=".$pref['favdls_menu_avatarsize']."px></img>";}}

if ($pref['favdls_enable_gold'] == "1")
{$userorb = "<a href='".e_PLUGIN."aacgc_favdls/User_Favorites.php?id.".$row2['user_id']."'>".$gold_obj->show_orb($row2['user_id'])."</a>";}
else
{$userorb = "<a href='".e_PLUGIN."aacgc_favdls/User_Favorites.php?id.".$row2['user_id']."'>".$row2['user_name']."</a>";}

//---------------------+


$favdlsmenu_text .= "<tr>";
$favdlsmenu_text .= "<td class='".$themea."' style='width:100%'>".$favdlsmenuavatar."".$userorb."";


/*
$favdlsmenu_text .= "<div id='".$row2['user_id']."' style='display:none'>";

$sql3 = new db;
$sql3->db_Select("downloads", "*", "download_id='".intval($favdls['user_favdls'])."'");    
while($row3 = $sql3->db_Fetch()){

$favdlsmenu_text .= "".$row3['download_name']."<br>";}

$favdlsmenu_text .= "</div>";
*/


$favdlsmenu_text .= "</td>";
$favdlsmenu_text .= "<td class='".$themea."' style='width:100%'>".$favdls['favs']."</td>";
$favuserdlsmenu_text .= "</tr>";}


$favdlsmenu_text .= "</table></div>";}

//----------------------+

else

{$favdlsmenu_text .= "<i>You must login or register to view favorite downloads.</i>";}

//------------------------------------------------------------------------------------------------+

$ns -> tablerender($favdlsmenu_title, $favdlsmenu_text);

?>