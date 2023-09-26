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


	
		$upload_text .= "
			<table style='width:95%' class=''>
			<tr>
                        <td style='width:5%' class=''></td>
			<td style='width:85%' class=''><u>User</u></td>
			<td style='width:10%' class=''><u>Uploads</u></td>
			</tr>";



$n = "0";
$sql->mySQLresult = @mysql_query("select upload_poster, count(upload_poster) as uls from ".MPREFIX."upload group by upload_poster order by uls desc limit 0,10;");
while($ul = $sql->db_fetch()){

if ($ul['upload_poster'] == "88.zebo"){
$id = "88";}
else
{$id = "".$ul['upload_poster']."";}

$sql2 = new db;
$sql2 -> db_Select("user", "*", "WHERE user_id=".$id."", "");
$user = $sql2->db_Fetch();

if ($pref['forumaddon_enable_gold'] == "1")
{$userorb = "<font color='#00ff00'>".$gold_obj->show_orb($user['user_id'])."</font>";}
else
{$userorb = "".$user['user_name']."";}
$n++;



		$upload_text .= "
			<tr>
                        <td style='width:5%' class=''>".$n.".</td>
			<td style='width:85%' class=''>".$userorb."</td>
			<td style='width:10%' class=''><center>".$ul['uls']."</td>
			</tr>";}



		$upload_text .= "</table>";



$ns->tablerender("Top ".$pref['addon_dlcount']." Uploaders", $upload_text);


?>


