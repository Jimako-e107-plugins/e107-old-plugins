<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
$e_event->register('postuserset', 'e_classifieds_postuserset');

function e_classifieds_postuserset($data)
{
    global $tp, $sql;

    if (!empty($data['username']))
    {
        // make sure we have a user name
        global $tp, $sql;
        if ($sql->db_Select('user', 'user_id', 'where user_name = "' . $tp->toDB($data['username']) . '"', 'nowhere', false))
        {
            // if we find the user in the user table then get their details
            $row = $sql->db_Fetch();
            if ($row['user_id'] > 0)
            {
                // if the user id is greater than 0 then update the posters details
                $newname = $row['user_id'] . '.' . $data['username'];
                $sql->db_Update('eclassf_ads', "eclassf_user ='" . $tp->toDB($newname) . "' where SUBSTRING_INDEX(eclassf_user,'.',1)='" . $row['user_id'] . "'", false);
            }
        }
    }
}

?>