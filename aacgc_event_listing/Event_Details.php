<?php

/*
#######################################
#     AACGC Event Listing V1.0        #                
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

$text .= "<table style='width:100%' class='' cellspacing='' cellpadding=''>";


$sql->db_Select("aacgc_event_listing", "*", "event_id = '".intval($sub_action)."'");
$row = $sql->db_Fetch();


if ($row['event_link'] == "")
{$link = "";}
else
{$link = "[<a href='".$row['event_link']."'> ".$row['event_linktext']." </a>]";}

if ($row['event_cost'] == "")
{$cost = "";}
else
{$cost = "<tr>
          <td style='width:20%' class='indent'><font size='".$pref['el_eventdetfsize']."'><b>Cost:</b></td>
          <td style='width:80%' class='indent'><font size='".$pref['el_eventdetfsize']."'>".$row['event_cost']."</td>
          </tr>";}


$text .= "<tr>
          <td style='width:100%' class='' colspan=2><center>
          <font size='".$pref['el_eventtitlefsize']."'>".$row['event_name']."</font>
          <br><br></center></td>
          </tr><tr>
          <td style='width:20%' class='indent'><font size='".$pref['el_eventdetfsize']."'><b>Date:</b></td>
          <td style='width:80%' class='indent'><font size='".$pref['el_eventdetfsize']."'>".$row['event_date']."</td>
          </tr><tr>
          <td style='width:20%' class='indent'><font size='".$pref['el_eventdetfsize']."'><b>Location:</b></td>
          <td style='width:80%' class='indent'><font size='".$pref['el_eventdetfsize']."'>".$row['event_locatiom']."</td>
          </tr><tr>
          <td style='width:20%' class='indent'><font size='".$pref['el_eventdetfsize']."'><b>Host:</b></td>
          <td style='width:80%' class='indent'><font size='".$pref['el_eventdetfsize']."'>".$row['event_host']."</td>
          </tr>";

$text .= "".$cost."";

$text .= "<tr>
          <td style='width:20%' class='indent'><font size='".$pref['el_eventdetfsize']."'><b>Details:</b></td>
          <td style='width:80%' class='indent'><font size='".$pref['el_eventdetfsize']."'>".$row['event_details']."</td>
          </tr><tr>
          <td style='width:100%' colspan=2 class='indent'>
          ".$link."
          </td>
          </tr>
          ";


$text .= "</table>";


        $text .= "
        <br></br>
        <table style='width:100%' class='' cellspacing='' cellpadding=''>
        <tr>
        <td style='width:0%'></td>
        <td style='width:20%'><u><b>Participants</b></u></td>
        <td style='width:10%'><u><b>Choice</b></u></td>
        <td style='width:70%'><u><b>Reason</b></u></td>
        <td style='width:0%'></td>
        </tr>";

        $n = "0";
        $sql3 = new db;
        $sql3->db_Select("aacgc_event_listing_members", "*", "event_id='".intval($row['event_id'])."'");
        while($row3 = $sql3->db_Fetch()){

        if ($row3['user_choice'] == "1"){
        $choice = "Yes";}
        if ($row3['user_choice'] == "2"){
        $choice = "No";}
        if ($row3['user_choice'] == "3"){
        $choice = "Maybe";}

        $sql2->db_Select("user", "*", "user_id='".intval($row3['user_id'])."'");
        $row2 = $sql2->db_Fetch();
        $event = $row3['eventmem_id'];
        $user = $row2['user_name'];
        $info = $row3['user_info'];
        $userid = $row3['user_id'];

        if ($userid == "".USERID.""){
        $edit = "
        <form  method='POST' action='Event_UserEdit_Request.php?det.".$event."'>
        <input type='image' value='Edit' src='".e_PLUGIN."aacgc_event_listing/images/Edit.jpg' alt='Edit Entry'>
        </form>";}
        else
        {$edit = "";}


        if ($userid == "".USERID.""){
        if ($_POST['main_delete']) {
        $delete_id = array_keys($_POST['main_delete']);
        $sql2 = new db;
        $sql2->db_Delete("aacgc_event_listing_members", "eventmem_id='".intval($delete_id[0])."'");}
        $del = "
        <form method='POST' action='".e_SELF."?det.".$row['event_id']."'>
        <input type='image' value='Delete' name='main_delete[{$event}]' src='".e_PLUGIN."aacgc_event_listing/images/Delete.png' alt='Delete Entry' onclick=\"return jsconfirm('".LAN_CONFIRMDEL." [ID: {$event} ]')\"'>
        </form>";}
        else
        {$del = "";}

        $n++;

        $text .= "<tr>
                 <td class=''>".$n.".</td>
                 <td class='indent'>".$user."</td>
                 <td class='indent'>".$choice."</td>
                 <td class='indent'>".$info."</td>
                 <td class=''>".$edit." ".$del."</td>
                 </tr>";}


       $text .= "</table>";

    


$text .= "<br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_event_listing/Join_Event.php?det.".$row['event_id']."'> Join Event </a>]
          <br><br>
          [<a href='".e_PLUGIN."aacgc_event_listing/Events.php'> Back To Events List </a>]
          </center>
          <br>";


     
     
  $ns -> tablerender("Details", $text);


  require_once(FOOTERF);



?>
