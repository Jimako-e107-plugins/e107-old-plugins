<?php
if (!defined('e107_INIT'))
{
    exit;
}

$e_event->register("postuserset", "newslink_postuserset");

function newslink_postuserset($data)
{
    global $tp, $sql;
    if (!empty($data['username']))
    {
        // make sure we have a user name
        if ($sql->db_Select("user", "user_id", "where user_name = '" . $tp->toDB($data['username']) . "'", "nowhere", false))
        {
            // if we find the user in the user table then get their details
            $row = $sql->db_Fetch();
            if ($row['user_id'] > 0)
            {
                // if the user id is greater than 0 then update the posters details
                $newname = $row['user_id'] . "." . $data['username'];
                $sql->db_Update("newslink_newslink", "newslink_author ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(newslink_author,'.',1)='" . $row['user_id'] . "'", false);
            }
        }
    }
}

?>