<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Event Listing             #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
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
if (USER){
$sql->db_Select("aacgc_event_listing", "*", "event_id = '".intval($sub_action)."'");
$row = $sql->db_Fetch();
$sql2 = new db;
$sql2->db_Select("aacgc_event_listing_members", "*", "event_id='".intval($row['event_id'])."'");
$row2 = $sql2->db_Fetch();
$userid = "".$row2['user_id']."";
$onlineuserid = "".USERID."";
$open = "".$row['event_open']."";

if ($open == "No")
{$text .= "<i>This Event is Closed</i>";
$text .= "<br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_event_listing/Events.php'> Back To Events List </a>]
          </center>
          <br>";}
else
{

if ($userid == "{$onlineuserid}")
{$text .= "<i>You Have Already Posted For This Event, Please Delete or Edit Your Post On The Event Details Page!</i>";}
else
{

//----------------------------------------------
if (USER){

if ( check_class($pref['el_autoaddclass']) ){
if ($_POST['add_request'] == '1') {
$newevent = $_POST['event_id'];
$newname = $_POST['user_id'];
$newchoice = $_POST['user_choice'];
$newreason = $_POST['user_info'];
$sql->db_Insert("aacgc_event_listing_members", "NULL, '".$newevent."', '".$newname."', '".$newchoice."', '".$newreason."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Request Auto Approved.</b><br>[<a href='".e_PLUGIN."aacgc_event_listing/Events.php'> Return To Categories </a>]</center>");
require_once(FOOTERF);}}

else

{if ($_POST['add_request'] == '1') {
$newevent = $_POST['event_id'];
$newname = $_POST['user_id'];
$newchoice = $_POST['user_choice'];
$newreason = $_POST['user_info'];
$sql->db_Insert("aacgc_event_listing_request", "NULL, '".$newevent."', '".$newname."', '".$newchoice."', '".$newreason."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Request Sent, Waiting For Admin Approval.</b><br>[<a href='".e_PLUGIN."aacgc_event_listing/Events.php'> Return To Categories </a>]</center>");
require_once(FOOTERF);}}



//---------------------------------------------------------------------------

$text .= "<br><br><center>

<form method='POST' action='Join_Event.php'>
<table style='' class='indent'><tr>
<td colspan=2>
<input type='hidden' name='user_id' value='".USERID."'>
</td>
</tr>
<tr>
<td colspan=2>
<input type='hidden' name='event_id' value='".$row['event_id']."'>
</td>
</tr>";

$text .= "
</td>
</tr>
<tr>
<td class='indent'>Will You Attend:</td>
<td class='indent'>
<select name='user_choice' size='1' class='tbox' style='width:100%'>
<option name='user_choice' value='1'>Yes</option>
<option name='user_choice' value='2'>No</option>
<option name='user_choice' value='3'>Maybe</option>
</td>
</tr>
<tr>
<td class='indent'>Reason Why or Why not:</td>
<td class='indent'>
<textarea class='tbox' rows='3' cols='50' name='user_info'></textarea>
</td>
</tr></table>
<br><br>
<input type='hidden' name='add_request' value='1'>
<input class='button' type='submit' value='Submit'>
</form>
";}

else

{$text .= "<center><br><br><b><i>You Must Register To Join Events</i></b><br><br></center>";}}


$text .= "<br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_event_listing/Events.php'> Back To Events List </a>]
          </center>
          <br>";

//---------------------------------------------------------------------------
}}
else
{$text .= "<center><br><br><b><i>You Must Register To Join Events</i></b><br><br></center>";}


$ns -> tablerender("Join Request Form For: ".$row['event_name']."", $text);


require_once(FOOTERF);



?>