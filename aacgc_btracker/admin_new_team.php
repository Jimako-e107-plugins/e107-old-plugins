<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Bracket Tracker           #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
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
if ($_POST['add_team'] == '1') {
$newteamname = $_POST['team_name'];
$newteamcolor = $_POST['team_color'];
$reason = "";
$newok = "";

if (($newteamname == "")){
	$newok = "0";
	$reason = "No Name";
} else {
	$newok = "1";
}

If ($newok == "0"){
 	$newtext = "
 	<center>
	<b><br><br> ".$reason."
	</center>
 	</b>
	";
	$ns->tablerender("", $newtext);}

If ($newok == "1"){
$sql->db_Insert("aacgc_bt_teams", "NULL, '".$newteamname."', '".$newteamcolor."'") or die(mysql_error());
$ns->tablerender("", "<center><b>Team Added</b></center>");
}}

//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_new_team.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:80%' class='fborder' cellspacing='0' cellpadding='0'>";

$text .= "
        <tr>
        <td style='width:20%; text-align:right' class='forumheader3'>Team Name:</td>
        <td style='width:80%' class='forumheader3'>
        <input class='tbox' type='text' name='team_name' size='100'>
        </td>
        </tr>";

$text .= "</div>
        </td>
	</tr>
	<tr>
		<td style='width:30%' class='forumheader3'>Team Color:</td>
                <td style='width:' class=''>
                <select name='team_color' size='1' class='tbox' style='width:50%'>
                <option name='team_color' value='White'>White</option>
                <option name='team_color' value='Red'>Red</option>
                <option name='team_color' value='Blue'>Blue</option>
                <option name='team_color' value='Green'>Green</option>
                <option name='team_color' value='Yellow'>Yellow</option>
                <option name='team_color' value='Orange'>Orange</option>
                <option name='team_color' value='Purple'>Purple</option>

                </td>
	<tr>







		
        <tr style='vertical-align:top'>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='add_team' value='1'>
		<input class='button' type='submit' value='Add Team'>
		</td>
        </tr>
</table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Bracket Tracker (Create Team)", $text);
	      require_once(e_ADMIN."footer.php");
?>

