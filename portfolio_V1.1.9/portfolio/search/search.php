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
require_once(e_PLUGIN . "portfolio/includes/portfolio_class.php");
if (!is_object($portfolio_obj))
{
    $portfolio_obj = new portfolio;
}
$portfolio_user = $portfolio_obj->portfolio_user;

if (!$portfolio_user)
{
    exit();
}

$return_fields = '
t.portfolio_person_name,
t.portfolio_person_poster,
t.portfolio_person_contact,
t.portfolio_person_biography,
t.portfolio_person_additional,
t.portfolio_person_affiliate1,
t.portfolio_person_affiliate2,
t.portfolio_person_affiliate3,
t.portfolio_person_updated,
t.portfolio_person_id';
$search_fields = array(
't.portfolio_person_name',
't.portfolio_person_poster',
't.portfolio_person_contact',
't.portfolio_person_biography',
't.portfolio_person_additional',
't.portfolio_person_affiliate1',
't.portfolio_person_affiliate2',
't.portfolio_person_affiliate3');
$weights = array('1.5', '0.8', '0.8', '1.2','1.2','0.8','0.8','0.8');
$no_results = LAN_198;
$where = "";
$order = array('t.portfolio_person_name' => DESC);
$table = "portfolio_person as t ";

$ps = $sch->parsesearch($table, $return_fields, $search_fields, $weights, 'search_portfolio', $no_results, $where, $order);
$text .= $ps['text'];
$results = $ps['results'];

function search_portfolio($row)
{
    global $con,$tp;
    $datestamp = $con->convert_date($row['portfolio_person_updated'], "long");
    $title = $row['portfolio_person_name'];

    $link_id = $row['portfolio_person_id'];
    $dept = 0;
    $res['link'] = e_PLUGIN . "portfolio/portfolio.php?0.show." . $link_id . "";
    $res['pre_title'] = $title ?PORTFOLIO_23." " : "";
    $res['title'] = $title ? $title : LAN_SEARCH_9;
    $res['summary'] = $tp->html_truncate($row['portfolio_person_biography'],50," ...");
    $res['detail'] = PORTFOLIO_24." " . $datestamp;
    return $res;
}

?>