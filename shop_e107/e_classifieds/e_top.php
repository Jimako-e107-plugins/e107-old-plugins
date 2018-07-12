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

require_once(e_HANDLER . 'userclass_class.php');
require_once(e_HANDLER . 'date_handler.php');
require_once(e_HANDLER . 'rate_class.php');
include_lan(e_PLUGIN . 'e_classifieds/languages/' . e_LANGUAGE . '.php');
unset($TOP_VIEWS);
global $sql, $top_tc;
global $TOP_PREFS, $top_limitname, $top_limitmode;
$eclassf_arg = "select * from #eclassf_ads left join #eclassf_subcats on eclassf_category=eclassf_subid where eclassf_approved>0 order by eclassf_views desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_VIEWS[] = array($eclassf_row['eclassf_id'],
        $eclassf_row['eclassf_user'],
        $eclassf_row['eclassf_subname'],
        $eclassf_row['eclassf_expires'],
        e_PLUGIN . 'e_classifieds/classifieds.php?0.item.' . $eclassf_row['eclassf_id'] . '.' . $eclassf_row['eclassf_id'],
        ECLASSF_T05 . $eclassf_row['eclassf_views']);
} // while
// Top by rating
unset($TOP_RATE);
$eclassf_arg = "select r.*,m.*, rate_rating/rate_votes as rateed from #rate as r
left join #user as m on rate_itemid=user_id
where rate_table='classifieds'
order by rateed desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_RATE[] = array($eclassf_row['user_name'],
        '',
        '',
        '',
        SITEURL . "user.php?id." . $eclassf_row['user_id'],
        ECLASSF_T06 . number_format($eclassf_row['rate_rating'] / $eclassf_row['rate_votes'], 2) . " from " . $eclassf_row['rate_votes'] . " votes");
} // while
// Top Poster
unset($TOP_POSTER);
$eclassf_arg = "select *,count(eclassf_user) as numpost from #eclassf_ads left join #eclassf_subcats on eclassf_category=eclassf_subid where eclassf_approved > 0 group by eclassf_user order by numpost  desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);

while ($eclassf_row = $sql->db_Fetch())
{
    $eclassf_tmp = explode(".", $eclassf_row['eclassf_user'], 2);
    $TOP_POSTER[] = array("Ads posted " . $eclassf_row['numpost'],
        '',
        '',
        '',
        '',
        ECLASSF_T07." <a href='" . SITEURL . "user.php?id." . $eclassf_tmp[0] . "'>" . $eclassf_tmp[1] . "</a>"
        );
} // while
unset($TOP_CAT_VIEWS);
$eclassf_arg = "select sum(eclassf_views) as numpost,c.*,r.* from #eclassf_subcats as c
left join #eclassf_ads as r on eclassf_subid=eclassf_category
group by eclassf_subid
order by numpost desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_CAT_VIEWS[] = array($eclassf_row['eclassf_subname'],
        '',
        '',
        '',
        e_PLUGIN . 'e_classifieds/classifieds.php?0.list.0.' . $eclassf_row['eclassf_subid'],
        ECLASSF_T05 . $eclassf_row['numpost']);
} // while
$TOP_MENU_DATA[] = array(ECLASSF_T01 => $TOP_VIEWS,
    ECLASSF_T02 => $TOP_RATE,
    ECLASSF_T03 => $TOP_POSTER,
    ECLASSF_T04 => $TOP_CAT_VIEWS);

?>