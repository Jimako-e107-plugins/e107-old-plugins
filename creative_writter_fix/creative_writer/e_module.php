<?php
if (!defined('e107_INIT'))
{
    exit;
}  
   
$e_event->register("postuserset", "creative_writer_postuserset");

function creative_writer_postuserset($data)
{
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
                $sql->db_Update("cw_book", "cw_book_author ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(cw_book_author,'.',1)='" . $row['user_id'] . "'", false);
                $sql->db_Update("cw_chapters", "cw_chapter_author ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(cw_chapter_author,'.',1)='" . $row['user_id'] . "'", false);
                $sql->db_Update("cw_review", "cw_reviewer ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(cw_reviewer,'.',1)='" . $row['user_id'] . "'", false);
            }
        }
    }
}      

?>