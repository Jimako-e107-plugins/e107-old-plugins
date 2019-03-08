<?php
if (!defined('e107_INIT')) { exit; }
if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php"))
{
    include_once(e_PLUGIN . "e_classifieds/languages/" . e_LANGUAGE . ".php");
}
else
{
    include_once(e_PLUGIN . "e_classifieds/languages/English.php");
}
$month = date(month);
$day = date(day);
$year = date(year);
$today = mktime(0, 0, 0, $month, $day, $year);

$return_fields = 't.cwriter_cname,t.cwriter_cdesc,t.cwriter_cdetails,t.cwriter_price,t.cwriter_cpdate,t.cwriter_cid,t.cwriter_cuser,u.cwriter_catname,v.cwriter_subname,v.cwriter_ccatid,v.cwriter_subid';
$search_fields = array('t.cwriter_cname', 't.cwriter_cdesc', "t.cwriter_cdetails", "t.cwriter_cuser", "u.cwriter_catname", "v.cwriter_subname");
$weights = array('1.5', '1.5', '1.5', '0.6', '0.5', '0.5');
$no_results = LAN_198;

$where = "find_in_set(cwriter_catclass,'" . USERCLASS_LIST . "') ".
($pref['cwriter_approval']==1?" and cwriter_capproved > 0":"" )." and (cwriter_cpdate > " . $today . " or cwriter_cpdate=0 ) and ";
$order = array('t.cwriter_cname' => DESC);
$table = "cwriter_ads as t left join #cwriter_subcats as v on v.cwriter_subid = t.cwriter_ccat left join #cwriter_cats as u on v.cwriter_ccatid = u.cwriter_catid";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_eclassf', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_eclassf($row)
{
    global $con;
    if ($row['cwriter_cpdate'] > 0)
    {
        $datestamp = $con->convert_date($row['cwriter_cpdate'], "short");
    }
    else
    {
        $datestamp = ECLASSF_75;
    }
    $title = $row['cwriter_cname'];

    $link_id = $row['cwriter_cid'];
    // $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "e_classifieds/classifieds.php?0.item.".$row['cwriter_ccatid'].".".$row['cwriter_subid']."." . $link_id . "";
    $res['pre_title'] = $title ?ECLASSF_69 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = ECLASSF_70 . ": " . substr($row['cwriter_catname'], 0, 30) . " &mdash; " . ECLASSF_73 . ": " . substr($row['cwriter_subname'], 0, 30) . "";
    $res['detail'] = ECLASSF_71 . ": " . substr($row['cwriter_cdesc'], 0, 60) . "<br  />" .
    ECLASSF_74 . ": " . $row['cwriter_price'] . "<br />" . ECLASSF_72 . ": " . $datestamp;
    return $res;
}

?>