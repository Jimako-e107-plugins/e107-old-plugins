<?php
// if (check_class($pref['phonedir_userclass']))
// {
$return_fields = 't.pd_last_name ,t.pd_first_name, t.pd_id,t.pd_updated,t.pd_work_phone,c.pd_cat_viewclass';
$search_fields = array('t.pd_last_name', 't.pd_first_name', 't.pd_work_phone', 't.pd_comments', 't.pd_mobile');
$weights = array('3', '2', '0.2', '0.6', '0.2');
$no_results = LAN_198;
$where = " find_in_set(c.pd_cat_viewclass,'" . USERCLASS_LIST . "') and";
$order = array('t.pd_last_name' => DESC);
$table = "pd_directory AS t
left join #pd_categories as c on t.pd_dir_cat=c.pd_cat_id";
$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_phonedir', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];
// }
function search_phonedir($row)
{
    global $con;
    $datestamp = $con->convert_date($row['pd_updated'], "long");
    $title = $row['pd_last_name'] . ", " . $row['pd_first_name'];
    $link_id = $row['pd_id'];
    $poster = "";
    $res['link'] = e_PLUGIN . "phonedir/phonedir.php?0.view......2.." . $link_id . "";
    $res['pre_title'] = $title ? "Name found: " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = $row['pd_work_phone'];
    $res['detail'] = "Last updated " . $datestamp;
    return $res;
}

?>