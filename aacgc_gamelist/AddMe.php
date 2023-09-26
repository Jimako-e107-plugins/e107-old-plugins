<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Game List                 #
#     by M@CH!N3                      #
#     http://www.aacgc.com            #
#     admin@aacgc.com                 #
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

$sql->db_Select("aacgc_gamelist", "*", "game_id = '".intval($sub_action)."' ");
$row = $sql->db_Fetch();
$sql2 = new db;
$sql2->db_Select("aacgc_gamelist_members", "*", "chosen_game_id = '".intval($row['game_id'])."' ");
$row2 = $sql2->db_Fetch();
$userid = "".$row2['user_id']."";
$onlineuserid = "".USERID."";

if ($userid == "{$onlineuserid}")
{$text .= "<i>You Have Already Been Added To The List!</i>";}

else
{

//----------------------------------------------
if (USER){


if ($_POST['add_me'] == '1') {
$newgame = $tp->toDB($_POST['chosen_game_id']);
$newname = $tp->toDB($_POST['user_id']);

$sql->db_Insert("aacgc_gamelist_members", "NULL, '".$newgame."', '".$newname."'") or die(mysql_error());
$ns->tablerender("", "<center><b>You are now in the Game List.</b><br><br>[<a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'> Return To Game Categories </a>]</center>");
require_once(FOOTERF);}





//---------------------------------------------------------------------------

$text .= "<br><br><center>

<form method='POST' action='AddMe.php'>
<table style='' class='indent'><tr>
<td colspan=2>
<input type='hidden' name='user_id' value='".USERID."'>
</td>
</tr>
<tr>
<td colspan=2>
<input type='hidden' name='chosen_game_id' value='".$row['game_id']."'>
</td>
<td colspan=2>
<i>Are You Sure You Want To Be Added To The <b>".$row['game_name']."<b> List?</i>
</td>
</tr>";


$text .= "
</table>
<br><br>
<input type='hidden' name='add_me' value='1'>
<input class='button' type='submit' value='Yes Add Me'>
</form>
";}

else

{$text .= "<center><br><br><b><i>You Must Register To Join Game List</i></b><br><br></center>";}}


$text .= "<br><br>   
          <center>
          [<a href='".e_PLUGIN."aacgc_gamelist/Game_Categories.php'> Return To Game Categories </a>]
          </center>
          <br>";

//---------------------------------------------------------------------------



$ns -> tablerender("Add Me Form For: ".$row['game_name']."", $text);


require_once(FOOTERF);



?>