<?php
include_lan(e_PLUGIN . "faq/languages/" . e_LANGUAGE . ".php");
// $TOP_PLUGIN_SECTIONS[]=array(,);
// top items by views
// data in the order item name, poster (ID.name),category,date posted,link,additional info
// .
// Top faq by views
unset($TOP_VIEWS);
global $sql, $top_tc;
global $TOP_PREFS, $top_limitname, $top_limitmode;
$faq_arg = "select * from #faq left join #faq_info on faq_parent=faq_info_id where faq_approved>0 order by faq_views  desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $TOP_VIEWS[] = array($faq_row['faq_question'],
        $faq_row['faq_author'],
        $faq_row['faq_info_title'],
        $faq_row['faq_datestamp'],
        e_PLUGIN . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "." . $faq_row['faq_id'],
        FAQLAN_141 . " " . $faq_row['faq_views'] . " Unique (" . $faq_row['faq_unique'] . ")");
} // while
// Top by rating
unset($TOP_RATE);
$faq_arg = "select r.*,m.*, r.rate_rating/rate_votes as rating from #rate as r
left join #faq as m on rate_itemid=faq_id
left join #faq_info on faq_parent=faq_info_id
where rate_table='faq' and faq_approved > 0
order by rating desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $TOP_RATE[] = array($faq_row['faq_question'],
        $faq_row['faq_author'],
        $faq_row['faq_info_title'],
        $faq_row['faq_datestamp'],
        e_PLUGIN . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "." . $faq_row['faq_id'],
        FAQLAN_142 . " " . number_format($faq_row['rate_rating'] / $faq_row['rate_votes'], 2) . " " . FAQLAN_143 . " " . $faq_row['rate_votes'] . " " . FAQLAN_144);
} // while
// Top Poster
unset($TOP_POSTER);
$faq_arg = "select *,count(faq_author) as numpost from #faq where faq_approved>0 group by faq_author order by numpost  desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($faq_arg, false);

while ($faq_row = $sql->db_Fetch())
{
    $TOP_POSTER[] = array(FAQLAN_145 . " " . $faq_row['numpost'],
        $faq_row['faq_author'],
        "",
        "",
        "",
        ""
        );
} // while
unset($TOP_COMMENT);
$faq_arg = "select count(c.comment_item_id) as numpost,m.* from #comments as c
left join #faq as m on comment_item_id =faq_id
left join #faq_info on faq_parent=faq_info_id
where faq_approved > 0 and comment_type='3'
group by comment_item_id order by numpost desc limit 0," . $top_tc->limit();

$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $TOP_COMMENT[] = array($faq_row['faq_question'],
        $faq_row['faq_author'],
        $faq_row['faq_info_title'],
        $faq_row['faq_datestamp'],
        e_PLUGIN . "faq/faq.php?0.cat." . $faq_row['faq_parent'] . "." . $faq_row['faq_id'],
        FAQLAN_146 . " " . $faq_row['numpost']);
} // while
unset($TOP_CAT_FAQ);

$faq_arg = "select COUNT(faq_id) as numpost,c.*,r.* from #faq_info as c
left join #faq as r on faq_info_id=faq_parent
where faq_approved > 0
group by faq_info_id
order by numpost desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $TOP_CAT_FAQ[] = array($faq_row['faq_info_title'],
        "",
        "",
        "",
        e_PLUGIN . "faq/faq.php?0.cat." . $faq_row['faq_info_id'] . ".0",
        FAQLAN_145 . " " . $faq_row['numpost']);
} // while
unset($TOP_CAT_VIEWS);
$faq_arg = "select sum(r.faq_views) as numpost,c.*,r.* from #faq_info as c
left join #faq as r on faq_info_id=faq_parent
where faq_approved>0 and faq_views>0
group by faq_info_id
order by numpost desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($faq_arg, false);
while ($faq_row = $sql->db_Fetch())
{
    $TOP_CAT_VIEWS[] = array($faq_row['faq_info_title'],
        "",
        "",
        "",
        e_PLUGIN . "faq/faq.php?0.cat." . $faq_row['faq_info_id'] . ".0",
        FAQLAN_141 . " " . $faq_row['numpost']);
} // while
$TOP_MENU_DATA[] = array(
    FAQLAN_120 => $TOP_VIEWS,
    FAQLAN_128 => $TOP_RATE,
    FAQLAN_125 => $TOP_POSTER,
    FAQLAN_129 => $TOP_COMMENT,
    FAQLAN_133 => $TOP_CAT_FAQ,
    FAQLAN_134 => $TOP_CAT_VIEWS);

?>