<?php
if (!defined('e107_INIT'))
{
    exit;
}
$e_event->register("postuserset", "recipe_menu_postuserset");

function recipe_menu_postuserset($data)
{
    global $tp, $sql;
    $sql->db_Select("user","user_id","where user_name = '".$tp->toDB($data['username'])."'","nowhere",false);
    $row=$sql->db_Fetch();
    $newname = $row['user_id'] . "." . $data['username'];
    $sql->db_Update("recipemenu_recipes", "recipe_author ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(recipe_author,'.',1)='" . $row['user_id'] . "'", false);
}

?>