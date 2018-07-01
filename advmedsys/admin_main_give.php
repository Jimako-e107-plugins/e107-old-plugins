<?php

/*
#######################################
#     e107 website system plguin     	 #
#     Advanced Medal System V1.2     	 #
#     by Marc Peppler                 	#
#     http://www.marc-peppler.at 	#
#     mail@marc-peppler.at            	#
#    Updated version 1.3, 1.4 by garyt  #
#######################################
*/
require_once("../../class2.php");
if(!getperms("P")) {
echo AMS_ADMIN_S1;
exit;
}
require_once(e_ADMIN."auth.php");
require_once(e_HANDLER."form_handler.php"); 
require_once(e_HANDLER."file_class.php");
$lan_file = e_PLUGIN."advmedsys/languages/Admin/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/Admin/English.php");
require_once(e_PLUGIN."advmedsys/advmedsys_ver.php");

$pageid = "admin_menu_04";
//-----------------------------------------------------------------------------------------------------------+


if ($_POST['medaltodb'] == "1") {
$medid = $_POST['medal'];
$uid = $_POST['user'];
$count = $_POST['count'];
$awddate = $_POST[awdmonth] . '.' . $_POST[awdday] . '.' . $_POST[awdyear];
$sql->db_Select("user", "*", "WHERE user_id = '".$uid."'","");
while($row = $sql->db_Fetch()){
    		    $usern2 = $row[user_name];
        	}
$i = 1;
while ($i <= $count):
$sql->db_Insert("advmedsys_awarded", "NULL,'".$medid."' , '".$uid."', '".$awddate."'");
$i++;
endwhile;
$txt = "<center><b>".AMS_ADMIN_S35." ".$count." ".AMS_ADMIN_S34." ".$usern2."!</b><center>";
$ns -> tablerender("", $txt);
}


//-----------------------------------------------------------------------------------------------------------+
$text = "
<form method='POST' action='admin_main_give.php'>
<br>
<center>
<div style='width:100%'>
<table style='width:60%' class='fborder' cellspacing='0' cellpadding='0'>
	<tr>
		<td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S2.":</td>
		<td style='width:70%' class='forumheader3'>
		<select name='user' size='1' class='tbox' style='width:100%'>";
	        $sql->db_Select("user", "user_id, user_name", "ORDER BY user_name ASC","");
    		    while($row = $sql->db_Fetch()){
    		    $usern = $row[user_name];
    		    $userid = $row[user_id];
		        $text .= "<option name='user' value='".$userid."'>".$usern."</option>";
        	}
        $text .= "
		</td>
        </tr>
        <tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S32.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='medal' size='1' class='tbox' style='width:100%'>";
		$sql->db_Select("advmedsys_medals", "medal_id, medal_name", "ORDER BY medal_name ASC","");
        while($row = $sql->db_Fetch()){
         $text .= "<option name='medal' value='".$row['medal_id']."'>".$row['medal_name']."</option>";
        }
        $text .= "
		</td>
		</tr>
		<tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S33.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='count' size='1' class='tbox' style='width:100%'>
		<option name='count' value='1'>1</option>
		<option name='count' value='2'>2</option>
		<option name='count' value='3'>3</option>
		<option name='count' value='4'>4</option>
		<option name='count' value='5'>5</option>
        </td>
		</tr>";
		
		$text .= "
		<tr>
        <td style='width:30%; text-align:right' class='forumheader3'>".AMS_ADMIN_S8.":</td>
        <td style='width:70%' class='forumheader3'>
		<select name='awdmonth' size='1' class='tbox' style='width:20%'>";
		$m = intval(date("m"));
		for ($i = 1; $i <= 12; $i++) {
			if ($i == $m) {
			$text .= "
		<option SELECTED value='".sprintf ("%02d",$m)."'>$m</option>";
			}
			else {		
		$text .= "
		<option value='". sprintf ("%02d",$i)."'>$i</option>\n";
			}
		}
		$text .= "
        </select>
		
		<select name='awdday' size='1' class='tbox' style='width:20%'>";
		$d = intval(date("d"));
		for ($i = 1; $i <= 31; $i++) {
			if ($i == $d) {
			$text .= "
		<option SELECTED value='".sprintf ("%02d",$d)."'>$d</option>";
			}
			else {		
		$text .= "
		<option value='". sprintf ("%02d",$i)."'>$i</option>\n";
			}
		}
		$text .= "
        </select>
		
		<select name='awdyear' size='1' class='tbox' style='width:30%'>";
		$y = intval(date("Y"));
		for ($i = $y-1; $i <= $y + 1; $i++) {
			if ($i == $y) {
			$text .= "
		<option SELECTED value='$y'>$y</option>";
			}
			else {
		$text .= "
		<option value='".$i."'>$i</option>\n";
			}
		};
		
		$awddate = $_POST[awdmonth] . '.' . $_POST[awdday] . '.' . $_POST[awdyear];
		
		$text .= "
        </select>
		</td>
		</tr>
		
        <tr>
        <td colspan='2' style='text-align:center' class='forumheader'>
		<input type='hidden' name='medaltodb' value='1'>
		<input class='button' type='submit' value='".AMS_ADMIN_S15."' style='width:150px'>
		</td>
        </tr>
        </table>
        </div>";
	      $ns -> tablerender(AMS_PLGIN_S1." v".AMS_VER_S1.": ".AMS_ADMIM_S7, $text);
	      require_once(e_ADMIN."footer.php");
?>