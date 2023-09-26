<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Favorite Downloads        #
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/



                                     ##################
//-----------------------------------#Main Page Config#------------------------------------------------------
                                     ##################


require_once("../../class2.php");
require_once(HEADERF);
if (e_QUERY) {
        $tmp = explode('.', e_QUERY);
        $action = $tmp[0];
        $sub_action = $tmp[1];
        $id = $tmp[2];
        unset($tmp);
}

if (USER){

$sql->db_Select("aacgc_favdls", "*", "user_id = '".USERID."'");
$row = $sql->db_Fetch();

$sql->mySQLresult = @mysql_query("select user_id, count(user_favdls) as favs from ".MPREFIX."aacgc_favdls where user_id='".USERID."';");
$result = $sql->db_fetch();

if ($result['favs'] == "".$pref['favdls_usermaxfav']."" OR $result['favs'] > "".$pref['favdls_usermaxfav']."")
{$text .= "<i>You cannot have any more favorites!</i>";}
else
{

$sql2 = new db;
$sql2->db_Select("download", "*", "download_id = '".intval($sub_action)."' ");
$row2 = $sql2->db_Fetch();

//----------------------------------------------


if ($_POST['add_fav'] == '1') {

$newfav = intval($_POST['user_favdls']);
$user = intval($_POST['user_id']);


$sql->db_Insert("aacgc_favdls", "NULL, '".$user."', '".$newfav."'") or die(mysql_error());

$ns->tablerender("", "<center><b>Download Added To Your Favorites List.</b><br><br>[ <a href='".e_BASE."download.php?view.".$row2['download_id']."'>Back To Download Page</a> ]</center>");
require_once(FOOTERF);}


//---------------------------------------------------------------------------

$text .= "<center>
<form method='POST' action='AddFav.php?det.".$row2['download_id']."'>
<table style='' class='indent'><tr>
<td>
<input type='hidden' name='user_favdls' value='".$row2['download_id']."'>
<input type='hidden' name='user_id' value='".USERID."'>
</td>
</tr>
<tr>
<td>
<i>Are You Sure You Want To Add</i> <b>".$row2['download_name']."</b> <i>To Your Favorites List?</i>
</td></tr></table>
<br>
<input type='hidden' name='add_fav' value='1'>
<input class='button' type='submit' value='Yes'>
</form>
<br><br>[ <a href='".e_BASE."download.php?view.".$row2['download_id']."'>Back To Download Page</a> ]
</center>";}


//---------------------------------------------------------------------------
}

else

{$text .= "<i>You must login or register to add downloads to favorites!</i>";}

$ns -> tablerender("Add To Favorites", $text);


require_once(FOOTERF);



?>