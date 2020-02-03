<?php

/*
#######################################
#     AACGC Download Tracker          #                
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

global $tp;

require_once("../../class2.php");
require_once(HEADERF);

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if ($pref['dltracker_enable_gold'] == "1"){$gold_obj = new gold();}

//---------------------------------------------------------------------------------
$title .= "".$pref['dltracker_pagetitle'].""; 
//---------------------------------------------------------------------------------


$text .= "<center>[ <a href='".e_PLUGIN."aacgc_dltracker/DLTracker_List.php'>Back to Download List</a> ]</center>";


$text .= "<br><center><table style='width:100%' class=''>";


        $sql ->db_Select("download", "*", "download_id = '".intval($sub_action)."'");
        $row = $sql->db_Fetch();


$text .= "
<tr>
<td class='forumheader3' colspan=2><center><font size='3'>".$tp->toHTML($row['download_name'], TRUE)."</font></center></td>
</tr>";

$text .= "
<tr><td class='forumheader3'>Author:</td><td class='forumheader3'>".$row['download_author']."</td></tr>
<tr><td class='forumheader3'>Author Email:</td><td class='forumheader3'>".$row['download_author_email']."</td></tr>
<tr><td class='forumheader3'>Author Website:</td><td class='forumheader3'>".$row['download_author_website']."</td></tr>
<tr><td class='forumheader3'>Total Downloads:</td><td class='forumheader3'>".$row['download_requested']."</td></tr>
<tr><td class='forumheader3'>Description:</td><td class='forumheader3'>".$tp->toHTML($row['download_description'], TRUE)."</td></tr>

";


$text .= "</table>";





$text .= "<br><center><div style='width:auto; height:400px; overflow:auto'><table style='width:100%' class=''>";
$text .= "
<tr>
<td class='forumheader3'><u>Downloaded by:</u></td>
<td class='forumheader3'><center><u>Date:</u></center></td>
<td class='forumheader3'><u>Time Ago:</u></td>
</tr>";
        $sql2 = new db;
        $sql2 ->db_Select("download_requests", "*", "download_request_download_id='".intval($row['download_id'])."' ORDER BY download_request_datestamp DESC");
        while($row2 = $sql2->db_Fetch()){
        $sql3 = new db;
        $sql3 ->db_Select("user", "*", "user_id='".intval($row2['download_request_userid'])."'");
        $row3 = $sql3->db_Fetch();

        if ($pref['dltracker_enable_gold'] == "1"){
        $username = "".$gold_obj->show_orb($row3['user_id'])."";}
        else
        {$username = "".$row3['user_name']."";}
        if ($pref['dltracker_enable_avatar'] == "1"){
        if ($row3['user_image'] == "")
        {$avatar = "";}
        else
        {$useravatar = $row3[user_image];
        require_once(e_HANDLER."avatar_handler.php");
        $useravatar = avatar($useravatar);
        $avatar = "<img src='".$useravatar."' width=".$pref['dltracker_avatar_size']."px></img>";}}
        $gen = new convert;
        $updated = $gen -> computeLapse($row2['download_request_datestamp'], false, false, true, 'short');
        $when = ($updated ? $updated : "1 ".LANDT_09)." ".LANDT_AGO; 
        $date = date("M d, Y",$row2['download_request_datestamp']);


$text .= "
<tr>
<td class='indent' style='text-align:left'><a href='".e_BASE."user.php?id.".$row3['user_id']."'>".$avatar." ".$username."</a></td>
<td class='indent'>".$date."</td>
<td class='indent' style='text-align:left'>".$when."</td>
</tr>";}


$text .= "</table></div>";

//---------------------------------------------------------------------------------





//----#AACGC Plugin Copyright&reg; - DO NOT REMOVE BELOW THIS LINE! - #-------+
require(e_PLUGIN . 'aacgc_dltracker/plugin.php');
$text .= "<br><br><br><br><br><br><br>
<a href='http://www.aacgc.com' target='_blank'>
<font color='808080' size='1'>".$eplug_name." V".$eplug_version."  &reg;</font>
</a>";
//------------------------------------------------------------------------+




$ns -> tablerender($title, $text);



//----------------------------------------------------------------------------------

require_once(FOOTERF);


