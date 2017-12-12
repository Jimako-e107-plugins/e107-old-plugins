<?php
/*
+---------------------------------------------------------------+
|	Job Search Plugin for e107
|
|	Copyright (C) Fathr Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
$e_event->register("postuserset", "job_search_postuserset");

function job_search_postuserset($data)
{
    global $tp, $sql;
    if (!empty($data['username']))
    {
        // make sure we have a user name
        global $tp, $sql;
        if ($sql->db_Select("user", "user_id", "where user_name = '" . $tp->toDB($data['username']) . "'", "nowhere", false))
        {
            // if we find the user in the user table then get their details
            $row = $sql->db_Fetch();
            if ($row['user_id'] > 0)
            {
                // if the user id is greater than 0 then update the posters details
                $newname = $row['user_id'] . "." . $data['username'];
                $sql->db_Update("jobsch_ads", "jobsch_submittedby ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(jobsch_submittedby,'.',1)='" . $row['user_id'] . "'", false);
            }
        }
    }
}

?>