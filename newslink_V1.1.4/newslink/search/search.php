<?php
require_once(e_PLUGIN."newslink/includes/newslink_class.php");
if (!is_object($newslink_obj))
{
    $newslink_obj = new newslink;
}
if (!$newslink_obj->newslink_reader) {
exit;

}
$return_fields = 't.newslink_name,t.newslink_author,t.newslink_body,t.newslink_id,t.newslink_posted,x.newslink_category_name,x.newslink_category_description,x.newslink_category_id';
$search_fields = array('t.newslink_name', 't.newslink_author','t.newslink_body', 'x.newslink_category_name');
$weights = array('1.2','1.0', '1.6', '1.0');
$no_results = LAN_198;
$where = "newslink_approved>0 and find_in_set(newslink_category_read,'".USERCLASS_LIST."') and ";
$order = array('t.newslink_name' => DESC);
$table = "newslink_newslink as t left join #newslink_category as x on newslink_category=newslink_category_id ";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_newslink', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_newslink($row)
{
    global $con;
    $datestamp = $con->convert_date($row['newslink_posted'], "long");
    $title = $row['newslink_name'];

    $link_id = $row['newslink_id'];
    $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "newslink/newslink.php?0.view." .  $link_id . "";
    $res['pre_title'] = $title ?NEWSLINK_100." " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = NEWSLINK_95." ".substr($row['newslink_name'],0,30)."\n".NEWSLINK_96." ".substr($row['newslink_category_name'],0,30);
    $res['detail'] = NEWSLINK_101." " . $datestamp;
    return $res;
}

?>