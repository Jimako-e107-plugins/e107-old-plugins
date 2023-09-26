<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
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


if ($pref['gamelist_enable_gold'] == "1")
{$gold_obj = new gold();}

if ($pref['gamelist_enable_theme'] == "1")
{$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}
//------------------------------------------------------------------------+
$text .= "<br>
          <center>
          [<a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'> View Game Category List </a>]
          </center>
          <br><br>";



        
        $sql->db_Select("user", "*", "ORDER BY user_id ASC", "");
        while($row = $sql->db_Fetch()){
        $sql2 = new db;
        $sql2->db_Select("aacgc_gamelist_members", "*", "user_id='".intval($row['user_id'])."'");
        while($row2 = $sql2->db_Fetch()){
        $sql77 = new db;
        $sql77 ->db_Select("user_extended", "*", "user_extended_id='".intval($row['user_id'])."'");
        $row77 = $sql77->db_Fetch();


if(USER){
//-----------# User GameTracker #-----------
if($pref['gamelist_enable_playergtlist'] == "1"){
        if ($row77['user_gtn'] == "")
        {$playergt = "";}         
        else
        {$playergt = "<td class='".$themeb."' style='width:0%'><a href='http://www.gametracker.com/".$row77['user_gtn']."' target='_blank'><img src='http://www.gametracker.com/profile/".$row77['user_gtn']."/b_460x42_C000000-323957-202743-FFFFFF-F19A15-FFCC00.png' border='0' align=right /></a></td>";}}       
//------------------------------------------
//-----------# User Xfire #-----------------
if($pref['gamelist_enable_xfirelist'] == "1"){
if($row77['user_xfire'] == ""){$xfireskin = "";}
else{
if ($pref['xf_skin'] == "Xfire Default"){
$xfireskin = "<td class='".$themeb."' style='width:0%'><a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row['user_id']."'><img src='http://miniprofile.xfire.com/bg/bg/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a></td>";}
if ($pref['xf_skin'] == "Sci-fi"){
$xfireskin = "<td class='".$themeb."' style='width:0%'><a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row['user_id']."'><img src='http://miniprofile.xfire.com/bg/sf/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a></td>";}
if ($pref['xf_skin'] == "Shadow"){
$xfireskin = "<td class='".$themeb."' style='width:0%'><a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row['user_id']."'><img src='http://miniprofile.xfire.com/bg/sh/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a></td>";}
if ($pref['xf_skin'] == "Combat"){
$xfireskin = "<td class='".$themeb."' style='width:0%'><a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row['user_id']."'><img src='http://miniprofile.xfire.com/bg/co/type/3/".$row77['user_xfire'].".png' width='149' height='29' /></a></td>";}
if ($pref['xf_skin'] == "Fantasy"){
$xfireskin = "<td class='".$themeb."' style='width:0%'><a href='".e_PLUGIN."aacgc_xfirestats/Xfire_History.php?det.".$row['user_id']."'><img src='http://miniprofile.xfire.com/bg/os/type/3/".$row77['user_xfire'].".png' width='149' height='29'  /></a></td>";}}}
//------------------------------------------
//-----------# User GSC #-----------
if($pref['gamelist_enable_playergsclist'] == "1"){
        if ($row77['user_gsc'] == "")
        {$playergsc = "";}         
        else
        {$playergsc = "<td class='".$themeb."' style='width:0%'><a href='http://www.getgsc.com/' target='_blank'>
<img src='http://www.getgsc.com/images/status/xsmall/000000/D6E2F0/".$row77['user_gsc'].".png' alt='GSC' /></td>";}}       
//------------------------------------------
}

if ($pref['gamelist_enable_avatar'] == "1"){
if ($row['user_image'] == "")
{$avatar = "<img src='".e_PLUGIN."aacgc_gamelist/images/default.png' width=".$pref['gamelist_avatar_size']."px></img>";}
else
{$useravatar = $row[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['gamelist_avatar_size']."px></img>";}}
if ($pref['gamelist_enable_gold'] == "1")
{$userorb = "".$gold_obj->show_orb($row2['user_id'])."";}
else
{$userorb = "".$row['user_name']."";}

if ($pref['gamelist_enable_friends'] == "1"){
$addfriend = "<a href='http://www.aacgc.com/SSGC/e107_plugins/alternate_profiles/newuser.php?id=".$row2['user_id']."&add'><img width='16px' src='".e_PLUGIN."aacgc_gamelist/images/add.png'></img></a>";}

$text .= "<table style='width:100%' class=''>";

$text .= "<tr><td style='width:100%' class='".$themea."'>".$addfriend." ".$avatar." <a href='".e_BASE."user.php?id.".$row['user_id']."'>".$userorb."</a>";

if(USER){
if($pref['gamelist_enable_xfirelist'] == "1"){
        $text .= "".$xfireskin."";}

if($pref['gamelist_enable_playergsclist'] == "1"){
        $text .= "".$playergsc."";}

if($pref['gamelist_enable_playergtlist'] == "1"){
        $text .= "".$playergt."";}}

        $text .= "</tr>";

$text .= "<tr><td class='".$themeb."' colspan=4>";

        $sql2 = new db;
        $sql2->db_Select("aacgc_gamelist_members", "*", "user_id='".intval($row['user_id'])."'");
        while($row2 = $sql2->db_Fetch()){
        $sql3 = new db;
        $sql3->db_Select("aacgc_gamelist", "*", "game_id='".intval($row2['chosen_game_id'])."' ORDER BY game_name ASC");
        while($row3 = $sql3->db_Fetch()){

//-----------# Icon Path #---------------+
if($pref['gamelist_userpageiconpath'] == "")
{$usericonpath = "icons";}
else
{$usericonpath = "".$pref['gamelist_userpageiconpath']."";}
//---------------------------------------+

$text .= "
<a href='".e_PLUGIN."aacgc_gamelist/Game_Details.php?det.".$row3['game_id']."'><img width='50px' src='".e_PLUGIN."aacgc_gamelist/".$usericonpath."/".$row3['game_pic']."' alt='".$row3['game_name']."'></img></a>";}}

$text .= "</td></tr>";



$text .= "</table><br>";}}









//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_gamelist/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+


$ns -> tablerender($title, $text);


//----------------------------------------------------------------------------------

require_once(FOOTERF);



?>
