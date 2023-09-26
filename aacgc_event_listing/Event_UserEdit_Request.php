<?php

/*
#######################################
#     AACGC Event Listing             #                
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
//-----------------------------------------------------------------------------------------------------------+
if (isset($_POST['update_user'])) {
        $message = ($sql->db_Update("aacgc_event_listing_members", "event_id='".$_POST['event_id']."',user_id='".$_POST['user_id']."',user_choice='".$_POST['user_choice']."',user_info='".$_POST['user_info']."' WHERE eventmem_id='".$_POST['eventmem_id']."' ")) ? "Successful updated" : "Update failed";
}

if (isset($message)) {
        $ns->tablerender("", "<div style='text-align:center'><b>".$message."</b></div>");
}
//-----------------------------------------------------------------------------------------------------------+
if ($action == "det") {

        $sql->db_Select("aacgc_event_listing_members", "*", "eventmem_id='".intval($sub_action)."'");
        $row = $sql->db_Fetch();
        $sql2 = new db;
        $sql2->db_Select("user", "*", "user_id='".intval($row['user_id'])."'");
        $row2 = $sql2->db_Fetch();
        $sql3 = new db;
        $sql3->db_Select("aacgc_event_listing", "*", "event_id='".intval($row['event_id'])."'","");
        $row3 = $sql3->db_Fetch();

if ($row['user_choice'] == "1"){
$choice = "Yes";}
if ($row['user_choice'] == "2"){
$choice = "No";}
if ($row['user_choice'] == "3"){
$choice = "Maybe";}



        $width = "width:100%";

$text .= "<br><br><center>
<form method='POST' action='Event_UserEdit_Request.php'>
<table style='' class='indent'>
<tr>
<td style='width:'>Your Info:</td>
<td style='width:'><select name='user_id'><option name='user_id' value='".$row['user_id']."'>".$row2['user_name']."</option></td>
</tr>
<tr>
<td style='width:'>Will You Attend:</td>
<td style='width:' class=''>
<select name='user_choice' size='1' class='tbox' style='width:100%'>
<option name='user_choice' value='1'>Yes</option>
<option name='user_choice' value='2'>No</option>
<option name='user_choice' value='3'>Maybe</option>
</td>
</tr>
<tr>
<td style='width:' class=''>Event:</td>
<td style='width:70%' class=''>
<select name='event_id' size='1' class='tbox' style='width:100%'>";
$sql4 = new db;
$sql4->db_Select("aacgc_event_listing", "*", "event_id='".intval($row['event_id'])."'");
$row4 = $sql4->db_Fetch();
$event = $row4[event_name];

		
$text .= "<option name='event_id' value='".$row['event_id']."'>".$event."</option>";
$text .= "
</td>
</tr>
<tr>
<td style='width:50%'>Reason Why or Why not:</td>
<td style='width:60%' class='forumheader3'>
<textarea class='tbox' rows='3' cols='50' name='user_info'>".$row['user_info']."</textarea>
</td>
</tr>
<tr>
<td style='width:'>Request ID:</td>
<td style='width:'><select name='eventmem_id'><option name='eventmem_id' value='".$row['eventmem_id']."'>".$row['eventmem_id']."</option></td>
</tr>
</table>
<br><br>
<input type='hidden' name='update_user' value='1'>
<input class='button' type='submit' value='Submit'>
</form>
";




	      $ns -> tablerender("", $text);
  require_once(FOOTERF);
}
?>



