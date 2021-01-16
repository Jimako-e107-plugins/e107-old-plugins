<?php
/*
+---------------------------------------------------------------+
|        Prune Inactive Users for e107 v7xx - by Father Barry
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
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
include_lan(e_PLUGIN . "prune_users/languages/admin/" . e_LANGUAGE . ".php");
global $pref;
$prune_time = time() + ($pref['time_offset'] * 3600);
// Find out when midnight was
$prune_today = mktime(0, 0, 0, date('n', $prune_time), date('d', $prune_time), date('Y', $prune_time));
$prune_joinbefore = ($pref['prune_days'] * 86400) + $prune_today;
$prune_lastvisit = $pref['prune_days'];
$prune_fromdate = $prune_today - ($pref['prune_threshold'] * 86400);
$prune_where = "where user_id>0 ";
if ($pref['prune_class'] != 255)
{
    $prune_where .= " and find_in_set('" . $pref['prune_class'] . "',user_class) ";
}
if ($pref['prune_exadmin'] == 1)
{
    $prune_where .= " and user_admin !=1 ";
}
if ($pref['prune_joinbefore'] > 0)
{
    $prune_where .= " and user_join < {$pref['prune_joinbefore']}";
}
if ($pref['prune_days'] > 0)
{
    $prune_where .= " and user_currentvisit < {$prune_lastvisit}";
}
switch ($pref['prune_type'])
{
    case 0:
        // Last Login date
        $prune_where .= " ";
        $prune_count = $sql->db_Count('user', '(*)', "$prune_where " , false);
        // $prune_sql = "select * from #user as u
        // $prune_where order by user_currentvisit limit $prune_from,50";
        break;
    case 1:
        // last forum post
        $prune_where .= " and (user_lastpost =0 or user_lastpost < {$prune_fromdate} )";
        $prune_count = $sql->db_Count('user', '(*)', "$prune_where " , false);
        // $prune_sql = "select * from #user as u
        // $prune_where order by user_lastpost limit $prune_from,50";
        break;
    case 2:
        // Minimum forum posts
        $prune_where .= " and user_forums < " . $pref['prune_threshold'];
        $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
        // $prune_sql = "select * from #user as u
        // $prune_where order by user_forums asc limit $prune_from,50";
        break;
    case 3:
        // Minimum chatbox
        $prune_where .= " and user_chats < " . $pref['prune_threshold'];
        $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
        // $prune_sql = "select * from #user as u
        // $prune_where order by user_chats asc limit $prune_from,50";
        break;
    case 4:
        // minimum comments
        $prune_where .= " and user_comments < " . $pref['prune_threshold'];
        $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
        // $prune_sql = "select * from #user as u
        // $prune_where order by user_comments asc limit $prune_from,50";
        break;
    case 5:
        // minimum visits
        $prune_where .= " and user_visits < " . $pref['prune_threshold'];
        $prune_count = $sql->db_Count('user', '(*)', "$prune_where" , false);
        // $prune_sql = "select * from #user as u
        // $prune_where order by user_visits asc limit $prune_from,50";
        break;
    case 6:
        // minimum visits
        $prune_where .= " and allsum < " . $pref['prune_threshold'];
        $prune_sql2 = "
            select * from
			(
				select baz.*,sum(user_forums)+sum(user_chats)+sum(user_comments) as allsum from #user as baz
				group by user_id) as u
				$prune_where ";
        // $prune_sql = $prune_sql2 . " order by user_visits asc limit 0,50";
        $prune_count = $sql->db_Select_gen($prune_sql2 , false);
        break;
    default: ;
} // switch
 // if ($prune_count)
{
    $text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "prune_users/images/prune_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /><a href='" . e_PLUGIN . "prune_users/admin_prune.php'> " . PRUNE_A45 . ": " . $prune_count . "</a></div>";
}

?>