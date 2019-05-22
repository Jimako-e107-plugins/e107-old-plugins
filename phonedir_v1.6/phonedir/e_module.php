<?php
if (!defined('e107_INIT'))
{
    exit;
}
$e_event->register("postuserset", "phonedir_postuserset");

function phonedir_postuserset($data)
{
    global $tp, $sql;
    $sql->db_Select("user","user_id","where user_name = '".$tp->toDB($data['username'])."'","nowhere",false);
    $row=$sql->db_Fetch();
    $newname = $row['user_id'] . "." . $data['username'];
    $sql->db_Update("pd_directory", "pd_updatedby ='" . $newname . "' where SUBSTRING_INDEX(pd_updatedby,'.',1)='" . $row['user_id'] . "'", false);
    $sql->db_Update("pd_categories", "pd_cat_updateby ='" . $newname . "' where SUBSTRING_INDEX(pd_cat_updateby,'.',1)='" . $row['user_id'] . "'", false);
    $sql->db_Update("pd_department", "pd_dept_updateby ='" . $newname . "' where SUBSTRING_INDEX(pd_dept_updateby,'.',1)='" . $row['user_id'] . "'", false);
    $sql->db_Update("pd_jobtitle", "pd_job_updatedby ='" . $newname . "' where SUBSTRING_INDEX(pd_job_updatedby,'.',1)='" . $row['user_id'] . "'", false);
    $sql->db_Update("pd_sites", "pd_site_updatedby ='" . $newname . "' where SUBSTRING_INDEX(pd_site_updatedby,'.',1)='" . $row['user_id'] . "'", false);
}

?>