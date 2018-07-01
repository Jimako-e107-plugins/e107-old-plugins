<?php
/*
#######################################
#     e107 website system plguin      #
#     Advanced Medal System V1.2      #
#     by Marc Peppler                 #
#     http://www.marc-peppler.at      #
#     mail@marc-peppler.at            #
#    Updated version 1.3, 1.4 by garyt  #
#######################################
*/
$lan_file = e_PLUGIN."advmedsys/languages/".e_LANGUAGE.".php";
require_once(file_exists($lan_file) ? $lan_file :  e_PLUGIN."advmedsys/languages/English.php");
//-----------------------------------------------------------
//-----------------------------------------------------------
$title = AMS_MENU_S1;
$text = "";
$c = 0;
$sql->db_Select("advmedsys_awarded", "*", "WHERE awarded_user_id='".USERID."'", "");
	while($row = $sql->db_Fetch()){
	$c++;
	}
$medalnames = array();
$medalid = array();
$sql->db_Select("advmedsys_medals", "*", "ORDER BY medal_name", "");
	while($row = $sql->db_Fetch()){
	$medalnames[] = $row['medal_name'];
	$medalid[] = $row['medal_id'];
	$medalpic[] = $row['medal_pic'];
	}
if ($c==0){
$text .= AMS_MENU_S5;
}
else
{
	$text .= AMS_MENU_S2.": <b>".$c."</b><br>";
	$text .= "
        	<div style='text-align:center'>
	        <table style='width:100%' class='fborder' cellspacing='0' cellpadding='0'>
	        <tr>
	        <td style='width:25%' class='forumheader3'>".AMS_MENU_S3."</td>
	        <td style='width:75%' class='forumheader3'>".AMS_MENU_S4."</td>
			</tr>";
	for($i=0; $i < count($medalnames); $i++)
		{
			$sql->db_Select("advmedsys_awarded", "*", "awarded_medal_id like ".$medalid[$i]." AND awarded_user_id like ".USERID, true);
				$counter1 = 0;
				while($row = $sql->db_Fetch()){
				$counter1++;
				}
			if ($counter1 > 0) {
			$text .= "
			<tr>
			<td style='width:25%' class='forumheader3'>".$counter1."x</td>
			<td style='width:75%' class='forumheader3'>
			<img src='" . e_PLUGIN . "advmedsys/medalimg/".$medalpic[$i]."' width='48' height='16' align='top' alt = ''>&nbsp</img> ".$medalnames[$i]."</td>";
		}
		}
        $text .= "
		</tr>
</table></div>";
}
	$ns -> tablerender($title, $text);
?>