<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Bracket Tracker           #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
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
if ($_POST['usertodb'] == "1") {
$user = $_POST['user_id'];
$cat = $_POST['user_cat'];
$team = $_POST['user_team'];
$place = $_POST['user_place'];

$sql->db_Insert("aacgc_bt_members", "NULL,'".$user."', '".$cat."', '".$team."', '".$place."'");



$txt = "<center>User added to Bracket<center>";
$ns -> tablerender("", $txt);}

//-----------------------------------------------------------------------------------------------------------+


//-----------------------------------------------------------------------------------------------------------------------------


$text = "
<form method='POST' action='admin_give.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:60%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>Member:</td>
		<td style='width:70%' class='forumheader3'>
		<select name='user_id' size='1' class='tbox' style='width:100%'>";
		    //$text .= "<option name='user_id' value=''></option>";

	        $sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
    		    while($row = $sql->db_Fetch()){
    		    $usern = $row[user_name];
    		    $userid = $row[user_id];
		    $text .= "<option name='user_id' value='".$userid."'>".$usern."</option>";}

        $text .= "
		</td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Place:</td>
        <td class='forumheader'>
        <select name='user_place' size='1' class='tbox' style='width:100%'>
        <option name='user_place' value='1'>1</option>
        <option name='user_place' value='2'>2</option>
        <option name='user_place' value='3'>3</option>
        <option name='user_place' value='4'>4</option>
        <option name='user_place' value='5'>5</option>
        <option name='user_place' value='6'>6</option>
        <option name='user_place' value='7'>7</option>
        <option name='user_place' value='8'>8</option>
        <option name='user_place' value='9'>9</option>
        <option name='user_place' value='10'>10</option>
        <option name='user_place' value='11'>11</option>
        <option name='user_place' value='12'>12</option>
        <option name='user_place' value='13'>13</option>
        <option name='user_place' value='14'>14</option>
        <option name='user_place' value='15'>15</option>
        <option name='user_place' value='16'>16</option>
        </td>
	</tr>       
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='user_cat' size='1' class='tbox' style='width:100%'>";
		$sql->db_Select("aacgc_bt_cat", "*", "ORDER BY cat_id ASC","");
                while($row = $sql->db_Fetch()){
                $cat = $row[cat_name];
                $catid = $row[cat_id];
		
$text .= "<option name='user_cat' value='".$catid."'>".$cat."</option>";}
        

$text .= "
</td>
</tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Team:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='user_team' size='1' class='tbox' style='width:100%'>";
		$sql->db_Select("aacgc_bt_teams", "*", "ORDER BY team_id ASC","");
                while($row = $sql->db_Fetch()){
                $team = $row[team_name];
                $teamid = $row[team_id];
		
$text .= "<option name='user_team' value='".$teamid."'>".$team."</option>";}
        

$text .= "</td></tr>";



        $text .= "		
        <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='usertodb' value='1'>
		<input class='button' type='submit' value='Add User' style='width:150px'>
		</td>
        </tr>
        </table>
</div>
<br>
</form>";
	      $ns -> tablerender("AACGC Bracket Tracker (Add User)", $text);


//-----------------------------------------------------------------------------------------------------------------------------
	      require_once(e_ADMIN."footer.php");
?>