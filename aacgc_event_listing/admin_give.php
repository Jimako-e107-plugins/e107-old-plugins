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


require_once("../../class2.php");
if(!getperms("P")) {
echo "";
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$rs = new form;
$fl = new e_file;

//-----------------------------------------------------------------------------------------------------------+

if ($_POST['add_user'] == '1') {

$newevent = $_POST['event_id'];
$newname = $_POST['user_id'];
$newchoice = $_POST['user_choice'];
$newreason = $_POST['user_info'];
$sql->db_Insert("aacgc_event_listing_members", "NULL, '".$newevent."', '".$newname."', '".$newchoice."', '".$newreason."'") or die(mysql_error());


$ns->tablerender("", "<center><b>User Added</b></center>");}


//-----------------------------------------------------------------------------------------------------------+


//-----------------------------------------------------------------------------------------------------------------------------


$text = "
<form method='POST' action='admin_give.php'>
<br>
<center>
<table style='width:60%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>Member:</td>
		<td style='width:70%' class='forumheader3'>
		<select name='user_id' size='1' class='tbox' style='width:100%'>";
	        $sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
    		    while($row = $sql->db_Fetch()){
    		    $usern = $row[user_name];
    		    $userid = $row[user_id];
		    $text .= "<option name='user_id' value='".$userid."'>".$usern."</option>";}
        
$text .= "
	</td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Event:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='event_id' size='1' class='tbox' style='width:100%'>";
		$sql->db_Select("aacgc_event_listing", "*", "ORDER BY event_id ASC","");
                while($row = $sql->db_Fetch()){
                $event = $row[event_name];
                $eventid = $row[event_id];
		
$text .= "<option name='event_id' value='".$eventid."'>".$event."</option>";}
        

$text .= "
</td>
</tr>
<tr>
<td style='width:30%; text-align:right' class='forumheader'>Will Attend:</td>
<td class='forumheader'>
<select name='user_choice' size='1' class='tbox' style='width:100%'>
<option name='user_choice' value='1'>Yes</option>
<option name='user_choice' value='2'>No</option>
<option name='user_choice' value='3'>Maybe</option>
</td>
</tr>
<tr>
<td style='width:30%; text-align:right' class='forumheader'>Reason Why or Why not:</td>
<td class='forumheader'>
<textarea class='tbox' rows='3' cols='50' name='user_info'></textarea>
</td></tr>




		
        <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_user' value='1'>
		<input class='button' type='submit' value='Add User' style='width:150px'>
		</td>
        </tr>
        </table>
        ";
	      $ns -> tablerender("AACGC Attendance List (Add Member)", $text);


//-----------------------------------------------------------------------------------------------------------------------------
	      require_once(e_ADMIN."footer.php");
?>