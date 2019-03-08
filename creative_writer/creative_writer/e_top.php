<?php
// $TOP_PLUGIN_SECTIONS[]=array(,);
// top items by views
// data in the order item name, poster (ID.name),category,date posted,link,additional info
// .
// Top adverts by views
unset($TOP_VIEWS);
global $sql, $top_tc;
global $TOP_PREFS, $top_limitname, $top_limitmode;
$eclassf_arg = "select * from #cw_book left join #cw_category on cw_book_category=cw_category_id where find_in_set(cw_category_class,'" . USERCLASS_LIST . "') and cw_book_visible> 0 and cw_book_approved>0 order by cw_book_views desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_VIEWS[] = array($eclassf_row['cw_book_title'],
        $eclassf_row['cw_book_author'],
        $eclassf_row['cw_category_name'],
        $eclassf_row['cw_book_created'],
        e_PLUGIN . "creative_writer/cwriter.php?0.precis." . $eclassf_row['cw_book_id'] ,
        CWRITER_T01 . " " . $eclassf_row['cw_book_views']);
} // while
// Top by rating
unset($TOP_RATE);
$eclassf_arg = "select *, rate_rating/rate_votes as rateed from #rate
left join #cw_book on rate_itemid=cw_book_id
left join #cw_category on cw_book_category=cw_category_id
where rate_table='cwbook' and find_in_set(cw_category_class,'" . USERCLASS_LIST . "') and cw_book_visible> 0 and cw_book_approved>0
order by rateed desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);

while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_RATE[] = array($eclassf_row['cw_book_title'],
        $eclassf_row['cw_book_author'],
        $eclassf_row['cw_category_name'],
        $eclassf_row['cw_book_created'],
        e_PLUGIN . "creative_writer/cwriter.php?0.precis." . $eclassf_row['cw_book_id'] ,
        CWRITER_T02 . " " . number_format($eclassf_row['rate_rating'] / $eclassf_row['rate_votes'], 2) . " " . CWRITER_T03 . " " . $eclassf_row['rate_votes'] . " " . CWRITER_T04);
} // while
// Top Poster
unset($TOP_POSTER);
$eclassf_arg = "select *,count(cw_book_author) as numpost from #cw_book left join #cw_category on cw_book_category=cw_category_id where find_in_set(cw_category_class,'" . USERCLASS_LIST . "') and cw_book_visible> 0 and cw_book_approved>0 group by cw_book_author order by numpost  desc limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);

while ($eclassf_row = $sql->db_Fetch())
{
    $eclassf_tmp = explode(".", $eclassf_row['cw_book_author'], 2);
    $TOP_POSTER[] = array(CWRITER_T05 . " " . $eclassf_row['numpost'],
        "",
        "",
        "",
        "",
        "Poster <a href='" . SITEURL . "user.php?id." . $eclassf_tmp[0] . "'>" . $eclassf_tmp[1] . "</a>"
        );
} // while
unset($TOP_CAT_VIEWS);
$eclassf_arg = "select *,sum(cw_book_views) as numpost from #cw_category
left join #cw_book on cw_book_category=cw_category_id
where find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
group by cw_category_id
order by numpost desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_CAT_VIEWS[] = array($eclassf_row['cw_category_name'],
        "",
        "",
        "",
        e_PLUGIN . "creative_writer/cwriter.php",
        CWRITER_T01 . " " . $eclassf_row['numpost']);
} // while
unset($TOP_CAT_BOOKS);
$eclassf_arg = "select *,count(cw_book_id) as numpost from #cw_category
left join #cw_book on cw_book_category=cw_category_id
where find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
group by cw_category_id
order by numpost desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_CAT_BOOKS[] = array($eclassf_row['cw_category_name'],
        "",
        "",
        "",
        e_PLUGIN . "creative_writer/cwriter.php",
        CWRITER_T13 . " " . $eclassf_row['numpost']);
} // while
unset($TOP_GENRE_VIEWS);
$eclassf_arg = "select *,sum(cw_book_views) as numpost from #cw_genre
left join #cw_book on cw_book_genre=cw_genre_id
left join #cw_category on cw_book_category=cw_category_id
where find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
group by cw_genre_id
order by numpost desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_GENRE_VIEWS[] = array($eclassf_row['cw_genre_name'],
        "",
        "",
        "",
        e_PLUGIN . "creative_writer/cwriter.php",
        CWRITER_T01 . " " . $eclassf_row['numpost']);
} // while
unset($TOP_GENRE_BOOKS);
$eclassf_arg = "select *,count(cw_book_id) as numpost from #cw_genre
left join #cw_book on cw_book_genre=cw_genre_id
left join #cw_category on cw_book_category=cw_category_id
where find_in_set(cw_category_class,'" . USERCLASS_LIST . "')
group by cw_genre_id
order by numpost desc
limit 0," . $top_tc->limit();
$sql->db_Select_gen($eclassf_arg, false);
while ($eclassf_row = $sql->db_Fetch())
{
    $TOP_GENRE_BOOKS[] = array($eclassf_row['cw_genre_name'],
        "",
        "",
        "",
        e_PLUGIN . "creative_writer/cwriter.php",
        CWRITER_T13 . " " . $eclassf_row['numpost']);
} // while
$TOP_MENU_DATA[] = array(CWRITER_T06 => $TOP_VIEWS,
    CWRITER_T07 => $TOP_RATE,
    CWRITER_T08 => $TOP_POSTER,
    CWRITER_T11 => $TOP_CAT_BOOKS,
    CWRITER_T09 => $TOP_CAT_VIEWS,
    CWRITER_T12 => $TOP_GENRE_BOOKS,
    CWRITER_T10 => $TOP_GENRE_VIEWS

    );

?>