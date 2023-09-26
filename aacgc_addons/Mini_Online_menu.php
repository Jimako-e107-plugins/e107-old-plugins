<?php

//---------------------#who's Online------------------------------

if ($pref['forumaddon_enable_gold'] == "1")
{$gold_obj = new gold();}

$minionline_text .= "<table style='width:100%' class='forumheader3'><tr>
                     <td class=''>";

//----#SQL#----
$script="SELECT ".MPREFIX."user.*,".MPREFIX."online.*  FROM ".MPREFIX."online LEFT JOIN ".MPREFIX."user ON ".MPREFIX."online.online_user_id= CONCAT(".MPREFIX."user.user_id,'.',".MPREFIX."user.user_name) WHERE ".MPREFIX."online.online_user_id!='0' GROUP BY ".MPREFIX."user.user_id ORDER BY ".MPREFIX."user.user_name ASC";
$sql->db_Select_gen($script);
while ($row = $sql->db_Fetch()){
extract($row);
$isadmin = $row['user_admin'];
$user_id = $row['user_id'];
$user_name = $row['user_name'];
$online_location = $row['online_location'];
$user_image = $row['user_image'];
//----#Username#----
if ($pref['welcomemenu_enable_gold'] == "1")
{$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($user_id)."</font>";}
else
{$userorb = "".$user_name."";}
//----#Avatar#----
if ($user_image == ""){
$user_image =  e_PLUGIN.'aacgc_addons/images/default.png';
$AVATAR = "<img width='30px' src='".$user_image."'></img>";}
else
{$user_image = str_replace(" ", "%20", $user_image);
require_once(e_HANDLER."avatar_handler.php");  
$userimage = avatar($user_image);
$AVATAR = "<img width='25px' src='".$userimage."'></img>";}



$minionline_text .= "<a href='".e_BASE."user.php?id.".$user_id."'>".$AVATAR."".$userorb."</a> , ";}



$minionline_text .= "</tr></td></table>";


$minionline_title .= "Who's Online";


$ns -> tablerender($minionline_title, $minionline_text);




?>