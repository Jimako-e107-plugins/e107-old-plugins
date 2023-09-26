<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

require_once("../../class2.php");
require_once(HEADERF);
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if (USER){


if($pref['favdls_enable_theme'] == "1")
{$themea = "indent";}
else
{$themea = "";}

if ($pref['favdls_enable_gold'] == "1")
{$gold_obj = new gold();}

//----------------------------------------------

$sql->db_Select("aacgc_favdls", "*", "user_id = '".intval($sub_action)."' ");
$row = $sql->db_Fetch();

$sql2 = new db;
$sql2->db_Select("user", "*", "WHERE user_id = '".intval($row['user_id'])."' ");
$row2 = $sql2->db_Fetch();

if($pref['favdls_enable_pageavatar'] == "1"){
if ($row2['user_image'] == "")
{$favdlspageavatar = "<img src='".e_PLUGIN."aacgc_favdls/images/default.png' width=".$pref['favdls_page_avatarsize']."px></img>";}
else
{$useravatar = $row2[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$favdlspageavatar = "<img src='".$useravatar."' width=".$pref['favdls_page_avatarsize']."px></img>";}}

if ($pref['favdls_enable_gold'] == "1")
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$gold_obj->show_orb($row2['user_id'])."</a>";}
else
{$userorb = "<a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$row2['user_name']."</a>";}

//----------------------------------------------

$text .= "<div class=''>".$favdlspageavatar."".$userorb."'s Favorite Downloads:</div><br>";
$text .= "<table style='width:100%' class=''>";

//----------------------------------------------

$sql3 = new db;
$sql3->db_Select("aacgc_favdls", "*", "user_id = '".intval($sub_action)."' ");
while($row3 = $sql3->db_Fetch()){

$sql4 = new db;
$sql4->db_Select("download", "*", "download_id = '".intval($row3['user_favdls'])."' ");
$row4 = $sql4->db_Fetch();

//----------------------------------------------

$text .= "<tr><td class='".$themea."'><a href='".e_BASE."download.php?view.".$row4['download_id']."'>".$row4['download_name']."</a></td></tr>";}

//----------------------------------------------

$text .= "</table>";

//---------------------------------------------------------------------------
}

else

{$text .= "<i>You must login or register to view user favorites!</i>";}






//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_favdls/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+







$ns -> tablerender("Favorite Downloads", $text);


require_once(FOOTERF);



?>