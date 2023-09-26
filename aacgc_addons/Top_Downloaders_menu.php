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


	
		$down_text .= "
			<table style='width:95%' class=''>
			<tr>
			<td style='width:5%' class=''></td>
			<td style='width:85%' class=''><u>User</u></td>
			<td style='width:10%' class=''><u>Downloads</u></td>
			</tr>";



$n = "0";
$sql->mySQLresult = @mysql_query("select download_request_userid, count(download_request_userid) as dls from ".MPREFIX."download_requests group by download_request_userid order by dls desc limit 0,".$pref['addon_dlcount'].";");
while($dl = $sql->db_fetch()){
$sql2 = new db;
$sql2 -> db_Select("user", "*", "WHERE user_id=".$dl['download_request_userid']."", "");
$user = $sql2->db_Fetch();

if ($pref['forumaddon_enable_gold'] == "1")
{$userorb = "<font color='#00ff00'>".$gold_obj->show_orb($dl['download_request_userid'])."</font>";}
else
{$userorb = "".$user['user_name']."";}

$n++;


		$down_text .= "
			<tr>
                        <td style='width:5%' class=''>".$n.".</td>
			<td style='width:85%' class=''>".$userorb."</td>
			<td style='width:10%' class=''><center>".$dl['dls']."</td>
			</tr>";}



		$down_text .= "</table>";



$ns->tablerender("Top ".$pref['addon_dlcount']." Downloaders", $down_text);


?>

