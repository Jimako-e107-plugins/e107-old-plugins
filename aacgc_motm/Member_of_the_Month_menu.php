<?php

/*
#######################################
#     e107 website system plguin      #
#     Member Of the Month             #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/






$potm_title = "".$pref['motm_menutitle']."";


if ($pref['motm_enable_gold'] == "1"){
global $GOLD_PREF, $sql2, $gold_obj, $grpg_obj, $tp,$PLUGINS_DIRECTORY;
$gold_obj = new gold();}


 $sql->db_Select("aacgc_motm", "*", "ORDER BY motm_id DESC","");
 $row = $sql->db_Fetch();
 $sql2 = new db;
 $sql2->db_Select("user", "*", "user_id='".intval($row['motm_user'])."'");
 $row2 = $sql2->db_Fetch();

if ($pref['motm_enable_customtrophy'] == "1"){
$trophy = "<img width='".$pref['motm_trophysize']."px' src='".$pref['motm_customtrophy_path']."'></img><br>";}
else
{$trophy = "<img width='".$pref['motm_trophysize']."px' src='".e_PLUGIN."aacgc_motm/images/MOM.png'></img><br>";}

if ($pref['motm_enable_gold'] == "1"){
$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($row2['user_id'])."</font>";}
else
{$userorb = "".$row2['user_name']."";}

if ($pref['motm_enable_avatar'] == "1"){
if ($row2['user_image'] == "")
{$avatar = "";}
else
{$useravatar = $row2[user_image];
require_once(e_HANDLER."avatar_handler.php");
$useravatar = avatar($useravatar);
$avatar = "<img src='".$useravatar."' width=".$pref['motm_avatar_size']."px></img>";}}




$potm_text .= "<center><table style='width:100%' class=''>
          <tr><td class='forumheader3'><center>
          ".$trophy."
          <font color='".$pref['motm_monthfcolor']."' size='".$pref['motm_monthfsize']."'><b>".$row['month']."</b></font>
          <br>
          <font color='".$pref['motm_yearfcolor']."' size='".$pref['motm_yearfsize']."'><b>".$row['year']."</b></font>
          </td></tr><tr><td class='indent'><center>
          <a href='".e_BASE."user.php?id.".$row2['user_id']."'>".$avatar." ".$userorb."</a>
          </center></td></tr>";


$potm_text .= "</table>";




if ($pref['motm_enable_hoflink'] == "1"){
$potm_text .= "<table style='' class='forumheader3'><tr>
               <td><center>
               <a href='".e_PLUGIN."aacgc_motm/MOTM_List.php'><font color='#FFFF00'>(View Previous Months)</font></a>
               </center></td>
               </tr></table></center>";}




$ns -> tablerender($potm_title, $potm_text);



?>

