<?php
if (!defined('e107_INIT'))
{
    exit;
}
$e_event->register("postuserset", "helpdesk3_menu_postuserset");

function helpdesk3_menu_postuserset($data)
{
    global $tp;

    $hdu_db = new DB;

    if (!empty($data['username']))
    {
        // make sure we have a user name
        if ($hdu_db->db_Select("user", "user_id", "where user_name = '" . $tp->toDB($data['username']) . "'", "nowhere", false))
        {
            // if we find the user in the user table then get their details
            $row = $hdu_db->db_Fetch();
            if ($row['user_id'] > 0)
            {
                // if the user id is greater than 0 then update the posters details
                $newname = $row['user_id'] . "." . $data['username'];
                $hdu_db->db_Update("hdunit", "hdu_poster ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(hdu_poster,'.',1)='" . $row['user_id'] . "'", false);
            }
        }
    }
}

?>