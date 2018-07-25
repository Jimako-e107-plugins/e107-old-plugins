<?php
if (!defined('e107_INIT'))
{
    exit;
}
$e_event->register("postuserset", "e_classifieds_postuserset");

function e_classifieds_postuserset($data)
{
    global $tp, $sql;
    $sql->db_Select("user","user_id","where user_name = '".$tp->toDB($data['username'])."'","nowhere",false);
    $row=$sql->db_Fetch();
    $newname = $row['user_id'] . "." . $data['username'];
    $sql->db_Update("eclassf_ads", "eclassf_cuser ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(eclassf_cuser,'.',1)='" . $row['user_id'] . "'", false);
}

?>