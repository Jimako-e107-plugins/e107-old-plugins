<?php

/*
+---------------------------------------------------------------+
   AACGC Gold Addons
   M@CH!N3
   admin@aacgc.com
   www.aacgc.com
+---------------------------------------------------------------+
*/

if (!defined('e107_INIT'))
{exit;}

if ($pref['goldaddon_enable_orbs'] == "1")
{$gold_obj = new gold();}



//------------------------Top Asset Member---------------------------



$assets2_text .= "<table style='width:95%' class=''>";



$sql->mySQLresult = @mysql_query("select gasset_user_id, count(gasset_asset) as assets from ".MPREFIX."gold_asset group by gasset_user_id order by assets desc limit 0,1;");
while($as = $sql->db_fetch()){
$user = @mysql_query("select * from ".MPREFIX."user where user_id='".$as['gasset_user_id']."'");
$user = mysql_fetch_array($user);

if ($pref['goldaddon_enable_avatar'] == "1"){
if ($user['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $user[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['goldaddon_avatarsize']."px></img>";}}

if ($pref['goldaddon_enable_orbs'] == "1")
{$mem = "".$gold_obj->show_orb($as['gasset_user_id'])."";}
else
{$mem = "".$user['user_name']."";}




$assets = "".$as['assets']."";



$assets2_text .= "<tr>
                <td style='width:50%'><center><br><a href='".e_BASE."user.php?id.".$as['gasset_user_id']."'>".$mem."<br>".$avatar."</a><br>
                With ".$assets." Assets!<br><br>
                <img width='".$pref['goldaddon_assetimg']."px' src='".e_PLUGIN."aacgc_gold_addons/images/gold_asset_64.png'></img><br><br>
                </tr>";}
          
 

$assets2_text .= "</table>
                ";



$assets2_title = "Member With Most Assets";

$ns -> tablerender($assets2_title, $assets2_text);
?>




