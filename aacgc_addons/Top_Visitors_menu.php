<?php

/*
##########################
# AACGC Addons           #
# M@CH!N3                #
# www.aacgc.com          #
# admin@aacgc.com        #
##########################
*/


if ($pref['forumaddon_enable_gold'] == "1")
{$gold_obj = new gold();}



	
$v_title = "".$pref['menu_topvtitle'].""; 


		$v_text .= "
			<div style='text-align:center'>
			<table style='width:95%' class=''>
			<tr>
			<td style='width:5%' class=''></td>
			<td style='width:85%' class=''><u>User</u></td>
			<td style='width:10%' class=''><u>Visits</u></td>
			</tr>";

$n = "0";
$sql ->db_Select("user", "*", "ORDER BY user_visits DESC LIMIT 0,".$pref['menu_topvcount']."","");
while($row = $sql ->db_Fetch()){
$n++;

if ($pref['forumaddon_enable_gold'] == "1")
{$userorb = "<font color='#00FF00'>".$gold_obj->show_orb($row['user_id'])."</font>";}
else
{$userorb = "".$row['user_name']."";}



		$v_text .= "<tr>
			  <td style='width:5%' class=''>".$n.".</a></td>
			  <td style='width:85%' class=''><a href='".e_BASE."user.php?id.".$row['user_id']."'>".$userorb."</a></td>
			  <td style='width:10%' class=''><center>".$row['user_visits']."</center></td>
			  </tr>";}
			 

		$v_text .= "</table>\n</div>";



$ns->tablerender($v_title, $v_text);


?>
