<?php

/*
#######################################
#     AACGC HOS                       #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


                                     ##################
//-----------------------------------#Main Page Config#------------------------------------------------------
                                     ##################


require_once("../../class2.php");
require_once(HEADERF);
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}


//------------------------------------------------------------------------------------------------------------

$text .= "<center><table style='width:90%' class='indent' cellspacing='' cellpadding=''>";


$sql->db_Select("aacgc_hos", "*", "hos_id = '".intval($sub_action)."'");
$row = $sql->db_Fetch();


$text .= "<tr><td colspan=2 class=''><center><img src='".e_PLUGIN."/aacgc_hos/images/cheater.png'></img></td></tr>
          <tr><td class='forumheader3'><b>Name</b>:</td><td class='forumheader3'>".$row['game_name']."</center></td></tr>
          <tr><td class='forumheader3'><b>Date</b>:</td><td class='forumheader3'>".$row['date']."</td></tr>
          <tr><td class='forumheader3'><b>Reason</b>:</td><td class='forumheader3'>".$row['reason']."</td></tr>
          <tr><td class='forumheader3'><b>IP Address</b>:</td><td class='forumheader3'>".$row['ip']."</td></tr>
          <tr><td class='forumheader3'><b>Extra Info</b>:</td><td class='forumheader3'>".$row['info']."</td></tr>";

if ($pref['hos_enable_extlink'] == "1"){
$text .= "<tr><td class='forumheader3'><b>Link</b>:</td><td class='forumheader3'><a href='".$row['ext_link']."' target='_blank'>More Info</a></td></tr>";}


if ($pref['hos_enable_imagesec'] == "1"){
if ($pref['hos_enable_image'] == "1"){
$text .= "<tr><td colspan=2><br><center><img width='".$pref['hos_imgsize']."' src='".$row['img_link']."'></img></td></tr>";}
else
{$text .= "<tr><td class='forumheader3' colspan=2>[ <a href='".$row['img_link']."' target='_blank'>Click to view Image</a> ]</td></tr>";}}





$text .= "</table>";

$next = intval($sub_action);
$next++;
$prev = intval($sub_action);
$prev--;

$text .= "<br><table style='width:100%'><tr>
<td><a href='".e_PLUGIN."aacgc_hos/HOS_Details.php?det.".$prev."'><img width='25px' src='".e_PLUGIN."aacgc_hos/images/redleft.png'></img></a></td>
<td><center>[<a href='".e_PLUGIN."aacgc_hos/HOS.php'> Back To HOS </a>]</center></td>
<td><a href='".e_PLUGIN."aacgc_hos/HOS_Details.php?det.".$next."'><img width='25px' src='".e_PLUGIN."aacgc_hos/images/redright.png' align='right'></img></a></td>
</tr></table></center>";


     
     
  $ns -> tablerender("Details", $text);


  require_once(FOOTERF);



?>
