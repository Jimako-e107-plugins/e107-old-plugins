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
$place = $_POST['place'];
$cat = $_POST['place_cat'];
$user = $_POST['user'];

$sql->db_Insert("aacgc_bt_place", "NULL,'".$cat."', '".$place."', '".$user."'");



$txt = "<center>User added to Bracket<center>";
$ns -> tablerender("", $txt);}

//-----------------------------------------------------------------------------------------------------------+


//-----------------------------------------------------------------------------------------------------------------------------


$text = "
<form method='POST' action='admin_standings.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:60%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>Member:</td>
		<td style='width:70%' class='forumheader3'>
		<select name='user' size='1' class='tbox' style='width:100%'>";

	        $sql->db_Select("aacgc_bt_members", "*", "","");
    		while($row = $sql->db_Fetch()){
                $sql2 = new db;
	        $sql2->db_Select("user", "*", "WHERE user_id='".$row['user_id']."'","");
    		$row2 = $sql2->db_Fetch();
                $sql3 = new db;
                $sql3->db_Select("aacgc_bt_teams", "*", "WHERE team_id='".$row['user_team']."'","");
                $row3 = $sql3->db_Fetch();
    		    $usern = $row2[user_name];
    		    $userid = $row[user_id];
                    $userteam = $row3[team_name];
		    $text .= "<option name='user_id' value='".$userid."'>".$usern." (".$userteam.")</option>";}

        $text .= "
		</td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Place:</td>
        <td class='forumheader'>
        <select name='place' size='1' class='tbox' style='width:100%'>
        <option name='place' value='1'>Row 2 - Slot 1</option>
        <option name='place' value='2'>Row 2 - Slot 2</option>
        <option name='place' value='3'>Row 2 - Slot 3</option>
        <option name='place' value='4'>Row 2 - Slot 4</option>
        <option name='place' value='5'>Row 2 - Slot 5</option>
        <option name='place' value='6'>Row 2 - Slot 6</option>
        <option name='place' value='7'>Row 2 - Slot 7</option>
        <option name='place' value='8'>Row 2 - Slot 8</option>
        <option name='place' value='9'>Row 3 - Slot 1</option>
        <option name='place' value='10'>Row 3 - Slot 2</option>
        <option name='place' value='11'>Row 3 - Slot 3</option>
        <option name='place' value='12'>Row 3 - Slot 4</option>
        <option name='place' value='13'>Row 4 - Slot 1</option>
        <option name='place' value='14'>Row 4 - Slot 2</option>
        <option name='place' value='15'>Row 5 - Slot 1</option>
        </td>
	</tr>       
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>Category:</td>
        <td style='width:70%' class='forumheader3'>
		<select name='place_cat' size='1' class='tbox' style='width:100%'>";
		$sql->db_Select("aacgc_bt_cat", "*", "ORDER BY cat_id ASC","");
                while($row = $sql->db_Fetch()){
                $cat = $row[cat_name];
                $catid = $row[cat_id];
		
$text .= "<option name='place_cat' value='".$catid."'>".$cat."</option>";}
        

    

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
	      $ns -> tablerender("AACGC Bracket Tracker (Bracket Adjustment)", $text);


//-----------------------------------------------------------------------------------------------------------------------------
	      require_once(e_ADMIN."footer.php");
?>
