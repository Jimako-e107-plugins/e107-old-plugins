<?php
if (!defined('e107_INIT'))
{
    exit;
}
include_lan(e_PLUGIN . "creative_writer/languages/" . e_LANGUAGE . ".php");
if (check_class($pref['cwriter_read']))
{
    $return_fields = 'b.cw_book_id,b.cw_book_title,b.cw_book_summary,b.cw_book_characters,b.cw_book_author,b.cw_book_created,g.cw_genre_name,c.cw_category_name,d.cw_chapter_title,d.cw_chapter_body,c.cw_category_id,g.cw_genre_id,d.cw_chapter_id';
    $search_fields = array('b.cw_book_title', 'b.cw_book_summary', "b.cw_book_characters", "b.cw_book_author", "g.cw_genre_name", "c.cw_category_name", "cw_chapter_title", "cw_chapter_body");
    $weights = array('2.5', '2.0', '1.0', '0.5', '0.5', '0.5', '2.0', '2.5');
    $no_results = LAN_198;

    $where = "find_in_set(c.cw_category_class,'" . USERCLASS_LIST . "') and b.cw_book_approved > 0  and b.cw_book_visible > 0 and ";
    $order = array('b.cw_book_title' => DESC);
    $table = "cw_book as b
left join #cw_chapters as d on d.cw_chapter_book=b.cw_book_id
left join #cw_category as c on c.cw_category_id= b.cw_book_category
left join #cw_genre as g on g.cw_genre_id = b.cw_book_genre
";

    $ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_cwriter', $no_results, $where, $order);
    $text .= $ps['text'];
    $results = $ps['results'];
}
function search_cwriter($row)
{
    global $con;

    $datestamp = $con->convert_date($row['cw_book_created'], "short");
    $title = $row['cw_book_title'];
    $cwriter_temp = explode(".", $row['cw_book_author'], 2);
    $cwriter_author = $cwriter_temp[1];
    $link_id = $row['cw_book_id'];
    // $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "creative_writer/cwriter.php?0.precis." . $row['cw_book_id'];
    $res['pre_title'] = $title ?CWRITER_320 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = CWRITER_318 . ": " . substr($row['cw_book_title'], 0, 30) . " &mdash; " . CWRITER_319 . ": " . substr($cwriter_author, 0, 30);
    $res['detail'] = CWRITER_317 . ": " . substr($row['cw_category_name'], 0, 60) . " &mdash; " . CWRITER_A9 . ": " . substr($row['cw_genre_name'], 0, 30) . ": &mdash; " . $datestamp;
    return $res;
}

?>