<?php
/*
+---------------------------------------------------------------+
|	Job Search Plugin for e107
|
|	Copyright (C) Fathr Barry Keal 2003 - 2008
|	http://www.keal.me.uk
|
|	Released under the terms and conditions of the
|	GNU General Public License (http://gnu.org).
+---------------------------------------------------------------+
*/
if (!defined('e107_INIT'))
{
    exit;
}
function print_item($id)
{
    global $sql,$tp;


    global $pref;
    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "job_search/languages/English.php");
    }
    $jobsch_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
    $jobsch_arg = $jobsch_arg = "select * from #jobsch_ads as r
left join #jobsch_subcats as t on r.jobsch_category=jobsch_subid
left join #jobsch_cats on jobsch_categoryid=jobsch_catid
where r.jobsch_cid=$id and find_in_set(jobsch_catclass,'" . USERCLASS_LIST . "') and jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate='' or jobsch_closedate is null or jobsch_closedate>$jobsch_today) ";;
    $sql->db_Select_gen($jobsch_arg);
    $jobsch_row = $sql->db_Fetch();
    extract($jobsch_row);
    $jobsch_vacancy = $tp->toHTML($jobsch_vacancy);
    $jobsch_companyinfoname = $tp->toHTML($jobsch_companyinfoname);
    $jobsch_vacancydetails = $tp->toHTML($jobsch_vacancydetails);
    $jobsch_subname = $tp->toHTML($jobsch_subname);
    $jobsch_catname = $tp->toHTML($jobsch_catname);

    $jobsch_companyphone = $tp->toHTML($jobsch_companyphone);
    $jobsch_email = $tp->toHTML($jobsch_email);
    $jobsch_catname = $tp->toHTML($jobsch_catname);
    $jobsch_salary = $tp->toHTML($jobsch_salary);
    $a_name = $tp->toHTML(explode(".", $jobsch_submittedby,1));
    // $jobsch_closedate = $con->convert_date($jobsch_closedate, "long");
    $jobsch_text = "<span style=\"font-size: 16px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<b>" . $jobsch_vacancy . "</b></span>";

    $jobsch_text .= "<span style=\"font-size: 12px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\"><br /><br />";
    $jobsch_text .= "
	<b>" . JOBSCH_24 . "</b>
	<br />$jobsch_catname 	<br /><br />";
    $jobsch_text .= "
	<b>" . JOBSCH_73 . "</b>
	<br />$jobsch_subname 	<br /><br />";

    $jobsch_text .= "
	<b>" . JOBSCH_26 . "</b>
	<br />$jobsch_vacancy 	<br /><br />";
    $jobsch_text .= "
    <b>" . JOBSCH_8 . "</b>
	<br />$jobsch_companyinfoname  <br /><br />";
    $jobsch_text .= "
    <b>" . JOBSCH_28 . "</b>
	<br />$jobsch_vacancydetails  <br /><br />";
    if ($jobsch_salary > 0)
    {
        $jobsch_text .= "
    <b>" . JOBSCH_60 . "</b>
	<br />$jobsch_salary  <br /><br />";
    }
    $jobsch_text .= "
    <b>" . JOBSCH_12 . "</b>
	<br />$jobsch_companyphone  <br /><br />";
    $jobsch_addr = explode("@", $jobsch_email);
    $jobsch_text .= "
    <b>" . JOBSCH_13 . "</b>
	<br />" . $jobsch_addr[0] . " at " . $jobsch_addr[1] . "  <br /><br />";

    require_once(e_HANDLER . 'date_handler.php');
    $rd = new convert;
    $jobsch_date = $rd->convert_date($jobsch_closedate);
    $jobsch_text .= "
<br /></span>
<span style=\"font-size: 10px; color: black; font-family: Tahoma, Verdana, Arial, Helvetica; text-decoration: none\">
	<em><b>" . JOBSCH_79 . "</b><br />" . JOBSCH_11 . " " . $a_name ;
    if ($jobsch_row['jobsch_closedate'] > 0)
    {
        $jobsch_text .= " - " . JOBSCH_72 . " " . $jobsch_date . "</em>";
    }
    $jobsch_text .= "<br /><br /><hr />" . LAN_306 . SITENAME . "
	<br />
	( http://" . $_SERVER[HTTP_HOST] . e_HTTP . e_PLUGIN . "job_search/index.php?0.item." . $jobsch_cid . ".$jobsch_category.$jobsch_cid )
	</span>";

    require_once(e_HANDLER . 'bbcode_handler.php');
    $e_bb->e_bb = new e_bbcode;
    $jobsch_text = $e_bb->e_bb->parseBBCodes($jobsch_text, '');
    return $jobsch_text;
}

function email_item($id)
{
    global $sql,$tp;
    if (e_LANGUAGE != "English" && file_exists(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php"))
    {
        include_once(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php");
    }
    else
    {
        include_once(e_PLUGIN . "job_search/languages/English.php");
    }
    $jobsch_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
    $jobsch_arg = "select * from #jobsch_ads as r
left join #jobsch_subcats as t on r.jobsch_category=jobsch_subid
left join #jobsch_cats on jobsch_categoryid=jobsch_catid
where r.jobsch_cid=$id and find_in_set(jobsch_catclass,'" . USERCLASS_LIST . "') and jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate='' or jobsch_closedate is null or jobsch_closedate>$jobsch_today) ";;
    $sql->db_Select_gen($jobsch_arg);
    $jobsch_row = $sql->db_Fetch();

    $message .= JOBSCH_80 . " " . SITEURL . e_PLUGIN . "job_search/classifieds.php?0.item." . $id . "." . $jobsch_row['jobsch_category'] . "." . $id . "\n\n";
    $message .= JOBSCH_26 . " - " . $tp->toHTML($jobsch_row['jobsch_vacancy']) . "\n\n";
    $message .= JOBSCH_3 . " - " . $tp->toHTML($jobsch_row['jobsch_companyinfoname']) . "\n\n";

    $message .= JOBSCH_2 . "\n" . $tp->toHTML($jobsch_row['jobsch_catname']) . " - " . $tp->toHTML($jobsch_row['jobsch_subname']) . "\n\n";
    $jobsch_author = substr($jobsch_row['jobsch_submittedby'], $jobsch_row['jobsch_submittedby'], ".")+1 ;
    require_once(e_HANDLER . 'date_handler.php');
    $rd = new convert;
    $jobsch_date = $rd->convert_date($jobsch_row['jobsch_closedate']);
    $message .= JOBSCH_11 . " " . $jobsch_author . ". ";
    if ($jobsch_row['jobsch_closedate'] > 0)
    {
        $message .= " - " . JOBSCH_72 . " " . $jobsch_date . "\n";
    }
    else
    {
        $message .= "\n";
    }
    return $message;
}

?>