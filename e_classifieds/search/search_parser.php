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
global $pref;
$month = date("n");
$day = date("j");
$year = date("Y");
$today = mktime(0,0, 0, $month, $day, $year);

$return_fields = 't.eclassf_cname,t.eclassf_cdesc,t.eclassf_cdetails,t.eclassf_price,t.eclassf_cpdate,t.eclassf_cid,t.eclassf_cuser,u.eclassf_catname,v.eclassf_subname,v.eclassf_ccatid,v.eclassf_subid,u.eclassf_catclass';
$search_fields = array('t.eclassf_cdetails', 't.eclassf_cname', 't.eclassf_cdesc', 't.eclassf_cuser', 'u.eclassf_catname', 'v.eclassf_subname');
$weights = array('1.5', '1.5', '1.5', '0.6', '0.5', '0.5');
$no_results = LAN_198;

$where = "find_in_set(u.eclassf_catclass,'" . USERCLASS_LIST . "') ".
($pref['eclassf_approval']>0?" and t.eclassf_capproved > 0":"" )." and (t.eclassf_cpdate >= " . $today . " or t.eclassf_cpdate=0 ) and ";
$order = array('t.eclassf_cname' => DESC);
$table = "eclassf_ads as t left join #eclassf_subcats as v on v.eclassf_subid = t.eclassf_ccat left join #eclassf_cats as u on v.eclassf_ccatid = u.eclassf_catid";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_eclassf', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_eclassf($row)
{
    global $con;
    if ($row['eclassf_cpdate'] > 0)
    {
        $datestamp = $con->convert_date($row['eclassf_cpdate'], "short");
    }
    else
    {
        $datestamp = ECLASSF_75;
    }
    $title = $row['eclassf_cname'];

    $link_id = $row['eclassf_cid'];
    // $dept = $row['dept_id'];
    $res['link'] = e_PLUGIN . "e_classifieds/classifieds.php?0.item.".$row['eclassf_ccatid'].".".$row['eclassf_subid']."." . $link_id . "";
    $res['pre_title'] = $title ?ECLASSF_69 . " " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = ECLASSF_70 . ": " . substr($row['eclassf_catname'], 0, 30) . " &mdash; " . ECLASSF_73 . ": " . substr($row['eclassf_subname'], 0, 30) . "";
    $res['detail'] = ECLASSF_71 . ": " . substr($row['eclassf_cdesc'], 0, 60) . "<br  />" .
    ECLASSF_74 . ": " . $row['eclassf_price'] . "<br />" . ECLASSF_72 . ": " . $datestamp;
    return $res;
}

?>