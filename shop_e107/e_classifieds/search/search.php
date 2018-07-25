<?php
if (!defined('e107_INIT')) {
    exit;
}
include_lan(e_PLUGIN . 'e_classifieds/languages/' . e_LANGUAGE . '.php');

require_once(e_HANDLER . "userclass_class.php");

require_once(e_HANDLER . "date_handler.php");

global $pref, $ECLASSF_PREF, $eclassf_obj;
if (!is_object($eclassf_obj)) {
    require_once(e_PLUGIN . "e_classifieds/includes/eclassifieds_class.php");

    $eclassf_obj = new classifieds;
}
$month = date('n');
$day = date('j');
$year = date('Y');
$today = mktime(0, 0, 0, $month, $day, $year);

$return_fields = 't.eclassf_id,t.eclassf_desc,t.eclassf_details,t.eclassf_price,t.elcassf_posted,t.eclassf_id,t.eclassf_user,u.eclassf_catname,v.eclassf_subname,v.eclassf_categoryid,v.eclassf_subid';
$search_fields = array('t.eclassf_name' , 't.eclassf_desc', 't.eclassf_details', 't.eclassf_user', 'u.eclassf_catname', 'v.eclassf_subname');
$weights = array('2.0', '1.5', '1.5', '0.6', '0.5', '0.5');
$no_results = LAN_198;

$where = "find_in_set(eclassf_catclass,'" . USERCLASS_LIST . "') " .
($ECLASSF_PREF['eclassf_approval'] == 1?" and t.eclassf_approved > 0":'') . " and (t.eclassf_expires > " . $today . " or t.eclassf_expires=0 ) and ";
$order = array('t.eclassf_id' => DESC);
$table = "eclassf_ads as t left join #eclassf_subcats as v on v.eclassf_subid = t.eclassf_category left join #eclassf_cats as u on v.eclassf_categoryid = u.eclassf_catid";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_eclassf', $no_results, $where, $order);
$text = $ps['text'];
$results = $ps['results'];

function search_eclassf($row)
{
    global $con;
    if ($row['elcassf_posted'] > 0) {
        $datestamp = $con->convert_date($row['elcassf_posted'], 'short');
    }else {
        $datestamp = ECLASSF_75;
    }
    $title = $row['eclassf_id'];

    $link_id = $row['eclassf_id'];
    // $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . 'e_classifieds/classifieds.php?0.item.' . $row['eclassf_categoryid'] . '.' . $row['eclassf_subid'] . '.' . $link_id ;
    $res['pre_title'] = $title ?ECLASSF_69 . ' ' : '';
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = ECLASSF_70 . ': ' . substr($row['eclassf_catname'], 0, 30) . ' &mdash; ' . ECLASSF_73 . ': ' . substr($row['eclassf_subname'], 0, 30) ;
    $res['detail'] = ECLASSF_71 . ': ' . substr($row['eclassf_desc'], 0, 60) . '<br  />' .
    ECLASSF_74 . ': ' . $row['eclassf_price'] . '<br />' . ECLASSF_72 . ': ' . $datestamp;
    return $res;
}

?>