<?php
/*
+---------------------------------------------------------------+
|        Portfolio manager for e107 v7xx - by Father Barry
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
global $portfolio_obj;
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
if($portfolio_obj->portfolio_user)
{
// $TOP_PLUGIN_SECTIONS[]=array(,);
// top items by views
// data in the order item name, poster (ID.name),category,date posted,link,additional info
// .
// Top portfolios by views
unset($TOP_VIEWS);
global $sql, $top_tc;
global $TOP_PREFS, $top_limitname, $top_limitmode;
$portfolio_arg = "select * from #portfolio_person  order by portfolio_person_views desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($portfolio_arg, false);
while ($portfolio_row = $sql->db_Fetch())
{
    $TOP_VIEWS[] = array($portfolio_row['portfolio_person_name'],
        $portfolio_row['portfolio_person_poster'],
        "",
        $portfolio_row['portfolio_person_updated'],
        e_PLUGIN . "portfolio/portfolio.php?0.show." . $portfolio_row['portfolio_person_id'],
        PORTFOLIO_TOP_02 . " " . $portfolio_row['portfolio_person_views']);
} // while
// Top by rating
if ($portfolio_obj->portfolio_rate)
{
    unset($TOP_RATE);
    $portfolio_arg = "select r.*,m.* from #rate as r
left join #portfolio_person as m on rate_itemid=portfolio_person_id
where rate_table='portfolio'
order by rate_rating desc
limit 0," . $top_tc->limit();
    $sql->db_Select_gen($portfolio_arg, false);
    while ($portfolio_row = $sql->db_Fetch())
    {
        $TOP_RATE[] = array($portfolio_row['portfolio_person_name'],
            $portfolio_row['portfolio_person_poster'],
            "",
            $portfolio_row['portfolio_person_updated'],
            e_PLUGIN . "portfolio/portfolio.php?0.show." . $portfolio_row['portfolio_person_id'],
            PORTFOLIO_TOP_04 . " " . number_format($portfolio_row['rate_rating'] / $portfolio_row['rate_votes'], 2) . " " . PORTFOLIO_TOP_05 . " " . $portfolio_row['rate_votes'] . " " . PORTFOLIO_TOP_06);
    } // while
}
// Top Poster
unset($TOP_POSTER);
$portfolio_arg = "select *,count(portfolio_person_poster) as numpost from #portfolio_person  group by portfolio_person_poster order by numpost  desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($portfolio_arg, false);

while ($portfolio_row = $sql->db_Fetch())
{
    $TOP_POSTER[] = array(PORTFOLIO_TOP_08 . " " . $portfolio_row['numpost'],
        $portfolio_row['portfolio_person_poster'],
        "",
        "",
        "",
        ""
        );
} // while
unset($TOP_COMMENT);
$portfolio_arg = "select count(c.comment_item_id) as numpost,m.* from #comments as c
left join #portfolio_person as m on comment_item_id =portfolio_person_id
where comment_type='portfolio' group by comment_item_id order by numpost desc limit 0," . $top_tc->limit();

$sql->db_Select_gen($portfolio_arg, false);
while ($portfolio_row = $sql->db_Fetch())
{
    $TOP_COMMENT[] = array($portfolio_row['portfolio_person_name'],
        $portfolio_row['portfolio_person_poster'],
        "",
        $portfolio_row['portfolio_person_updated'],
         e_PLUGIN . "portfolio/portfolio.php?0.show." . $portfolio_row['portfolio_person_id'],
        PORTFOLIO_TOP_10 . " " . $portfolio_row['numpost']);
} // while
$TOP_MENU_DATA[] = array(
    PORTFOLIO_TOP_01 => $TOP_VIEWS,
    PORTFOLIO_TOP_03 => $TOP_RATE,
    PORTFOLIO_TOP_07 => $TOP_POSTER,
    PORTFOLIO_TOP_09 => $TOP_COMMENT);
}
?>