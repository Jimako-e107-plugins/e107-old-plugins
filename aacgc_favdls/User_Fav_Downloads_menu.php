<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

if($pref['favdls_enable_theme'] == "1")
{$themea = "indent";}
else
{$themea = "";}

//----------------------------------------------------------------------------------------------------

$userfavdls_title .= "".$pref['favdls_usermenu_title']."";

if (USER){

//----------------------------------------------------------------------------------------------------

$sql->mySQLresult = @mysql_query("select user_id, count(user_favdls) as favs from ".MPREFIX."aacgc_favdls where user_id='".USERID."';");
$result = $sql->db_fetch();

$userfavdls_text .= "
<table style='width:100%' class=''>
<tr>
<td class='".$themea."'><center>Total Favorites: ".$result['favs']."</center></td>
</tr>
<td class='".$themea."'><center><a href='".e_PLUGIN."aacgc_favdls/EditFav.php'><img src='".e_PLUGIN."aacgc_favdls/images/edit.png'></img></a></center></td>
</tr>
</table>
<div style='width:100%; height:".$pref['favdls_usermenu_height']."px; overflow:auto'>
<table style='width:100%'>";

//---------------------+

$sql->db_Select("aacgc_favdls", "*", "user_id='".USERID."'");    
while($row = $sql->db_Fetch()){

$sql2 = new db;
$sql2->db_Select("download", "*", "download_id='".intval($row['user_favdls'])."'");    
$row2 = $sql2->db_Fetch();

//---------------------+

$userfavdls_text .= "<tr><td class='".$themea."'><a href='".e_BASE."download.php?view.".$row2['download_id']."'>".$row2['download_name']."</a></td></tr>";}

$userfavdls_text .= "</table></div>";


//----------------------------------------------------------------------------------------------------
}

else

{$userfavdls_text .= "<i>You must login or register to view your favorite downloads.</i>";}

//----------------------------------------------------------------------------------------------------

$ns -> tablerender($userfavdls_title, $userfavdls_text);

?>