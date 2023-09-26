<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Friend System             #
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

include_lan(e_PLUGIN."aacgc_friendsys/languages/".e_LANGUAGE.".php");

if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if (USER){

$sql->db_Select("aacgc_friend_sys", "*", "user_id = '".USERID."'");
$row = $sql->db_Fetch();


$sql2 = new db;
$sql2->db_Select("user", "*", "user_id = '".intval($sub_action)."'");
$row2 = $sql2->db_Fetch();

//----------------------------------------------


if ($_POST['add_me'] == '1') {

$newfriend = $_POST['user_friends_request'];
$user = $_POST['user_id'];


$newpmfrom = $_POST['pm_from'];
$newpmto = $_POST['pm_to'];
$newpmsent = $_POST['pm_sent'];
$newpmread = $_POST['pm_read'];
$newpmsubject = $_POST['pm_subject'];
$newpmtext = $_POST['pm_text'];
$newpmsenddel = $_POST['pm_send_del'];
$newpmreaddel = $_POST['pm_read_del'];
$newpmatt = $_POST['pm_attachments'];
$newpmoption = $_POST['pm_option'];
$newpmsize = $_POST['pm_size'];

$sql->db_Insert("aacgc_friend_sys_request", "NULL, '".$user."', '".$newfriend."'") or die(mysql_error());
$sql2->db_Insert("private_msg", "NULL, '".$newpmfrom."', '".$newpmto."', '".$newpmsent."', '".$newpmread."', '".$newpmsubject."', '".$newpmtext."', '".$newpmsenddel."', '".$newpmreaddel."', '".$newpmatt."', '".$newpmoption."', '".$newpmsize."'") or die(mysql_error());

$ns->tablerender("", "<center><b>Friend Request Sent To ".$row2['user_name'].", Once Accepted They Will Be Added To Your Friends List.</b></center>");
require_once(FOOTERF);}


//---------------------------------------------------------------------------

$text .= "<center>
<form method='POST' action='AddMe.php?det.".$row2['user_id']."'>
<table style='' class='indent'><tr>
<td>
<input type='hidden' name='user_friends_request' value='".USERID."'>
<input type='hidden' name='user_id' value='".$row2['user_id']."'>
</td>
</tr>
<tr>
<td>
".FSYS_01." <b>".$row2['user_name']."</b> ".FSYS_02."
";


//-----------------------# Auto PM Section #------------------------+

$subject = "".FSYS_03."";
$message = "<b>".USERNAME."</b> ".FSYS_04."<br><br><a href=".e_PLUGIN."aacgc_friendsys/Friend_Requests.php>".FSYS_05."</a>";
$to = "".$row2['user_id']."";
$from = "".USERID."";
$offset = +0;
$time = time()  + ($offset * 60 * 60);
$sent = $time;

$text .= "
        <input type='hidden' name='pm_from' value='".$from."'>
        <input type='hidden' name='pm_to' value='".$to."'>
        <input type='hidden' name='pm_sent' value='".$sent."'>
        <input type='hidden' name='pm_read' value='0'>
        <input type='hidden' name='pm_subject' value='".$subject."'>
        <input type='hidden' name='pm_text' value='".$message."'>
        <input type='hidden' name='pm_send_del' value='0'>
        <input type='hidden' name='pm_read_del' value='0'>
        <input type='hidden' name='pm_attachments' value=''>
        <input type='hidden' name='pm_option' value=''>
        <input type='hidden' name='pm_size' value='0'>
";

//------------------------------------------------------------------+


$text .= "</td></tr></table>
<br>
<input type='hidden' name='add_me' value='1'>
<input class='button' type='submit' value='".FSYS_06."'>
</form>
</center>";


//---------------------------------------------------------------------------
}

else

{$text .= "".FSYS_07."";}

$ns -> tablerender("".FSYS_08."", $text);


require_once(FOOTERF);



?>