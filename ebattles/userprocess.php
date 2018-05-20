<?php
/**
* UserProcess.php
*
*/
require_once("../../class2.php");
require_once(e_PLUGIN."ebattles/include/main.php");

if (isset($_POST['edit_gamer']) && $_POST['edit_gamer']!="")
{
    $user_id = intval($_GET['userid']);
    $gamer_id = intval($_POST['edit_gamer']);
    $gamer_name = $_POST['gamername'.$gamer_id];
    $gamer_uniqueid = $_POST['gameruniqueid'.$gamer_id];

    if ($gamer_name != "")
    {
        update_gamer($gamer_id, $gamer_name, $gamer_uniqueid);
    }

    //dbg: echo "Update Gamer: $gamer_id, $gamer_name, $gamer_uniqueid";

    header("Location: userinfo.php?user=$user_id");
    exit;
}
exit;

/***************************************************************************************
Functions
***************************************************************************************/
function update_gamer($gamer_id, $gamer_name, $gamer_uniqueid)
{
    global $sql;
    global $tp;
    
    $gamer_name = $tp->toDB($gamer_name);
    $gamer_uniqueid = $tp->toDB($gamer_uniqueid);

    $q = "UPDATE ".TBL_GAMERS
    ." SET Name = '$gamer_name', UniqueGameID = '$gamer_uniqueid'"
    ." WHERE (GamerID = '$gamer_id')";
    $sql->db_Query($q);
}

?>
