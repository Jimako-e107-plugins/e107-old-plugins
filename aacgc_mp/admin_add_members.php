<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Meeting Planner           #
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
include_lan(e_PLUGIN."aacgc_mp/languages/".e_LANGUAGE.".php");
//-----------------------------------------------------------------------------------------------------------+

if ($_POST['add_user'] == '1') {

$newuser = $_POST['user_id'];
$newmeet = $_POST['user_meet'];
$newchoice = $_POST['user_choice'];
$newdet = $_POST['user_det'];
$sql->db_Insert("aacgc_mp_members", "NULL, '".$newuser."', '".$newmeet."', '".$newchoice."', '".$newdet."'") or die(mysql_error());


$ns->tablerender("", "<center><b>".AMP_86."</b></center>");}


//-----------------------------------------------------------------------------------------------------------+


$sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
while($row = $sql->db_Fetch()){
$usern = $row[user_name];
$userid = $row[user_id];
$options .= "<option name='user_id' value='".$userid."'>".$usern."</option>";}

$sql2 = new db;
$sql2->db_Select("aacgc_mp_meetings", "*", "ORDER BY meet_id ASC","");
while($row2 = $sql2->db_Fetch()){
$meetid = $row2['meet_id'];
$meettitle = $row2['meet_title'];
$dformat = $pref['aacgcmp_dformat'];
$msdate = date($dformat, $row2['meet_sdate']);
$medate = date($dformat, $row2['meet_edate']);
 
$options2 .= "<option name='meet_id' value='".$meetid."'>(".$meetid.") ".$meettitle." (".$msdate." / ".$medate.")</option>";}



$text = "<form method='POST' action='admin_add_members.php'>
	<table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
	<td style='width:30%; text-align:right' class='forumheader3'>".AMP_80.":</td>
	<td style='width:70%' class='forumheader3'>
		<select name='user_id' size='1' class='tbox' style='width:75%'>
		".$options."
	</td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMP_81.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='user_meet' size='1' class='tbox' style='width:75%'>
		".$options2."
	</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:right' class='forumheader'>".AMP_82.":</td>
	<td class='forumheader'>
		<select name='user_choice' size='1' class='tbox' style='width:75%'>
		<option name='user_choice' value='1'>".MP_24."</option>
		<option name='user_choice' value='2'>".MP_25."</option>
		<option name='user_choice' value='3'>".MP_26."</option>
	</td>
	</tr>
	<tr>
	<td style='width:30%; text-align:right' class='forumheader'>".AMP_83.":</td>
	<td class='forumheader'>
		<textarea class='tbox' rows='2' cols='75' name='user_det'></textarea>
	</td>
	</tr>



		
        <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_user' value='1'>
		<input class='button' type='submit' value='".AMP_87."' style='width:150px'>
	</td>
        </tr>
        </table>
	</form>
        ";
	      $ns -> tablerender("AACGC Meeting Planner (".AMP_88.")", $text);


//-----------------------------------------------------------------------------------------------------------------------------
	      require_once(e_ADMIN."footer.php");
?>