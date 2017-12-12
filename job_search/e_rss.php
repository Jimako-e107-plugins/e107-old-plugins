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

global $pref, $jobsch_obj;
require_once(e_PLUGIN . "job_search/includes/jobsearch_class.php");
if (!is_object($jobsch_obj))
{
    $jobsch_obj = new job_search;
}
// ##### e_rss.php ---------------------------------------------
$feed['name'] = JOBSCH_RSS_1;
$feed['url'] = 'job_search';
$feed['topic_id'] = '';
$feed['path'] = 'job_search';
$feed['text'] = JOBSCH_RSS_2 ;
$feed['class'] = '0';
$feed['limit'] = '9';
$eplug_rss_feed[] = $feed;
// ##### --------------------------------------------------------
// ##### create rss data, return as array $eplug_rss_data -------
$rss = array();
// get unexpired adds which are approved and are visible to this class
if ($jobsch_obj->jobsch_subcats)
{
    $jobsch_args = "
		select a.jobsch_vacancy,a.jobsch_salary,a.jobsch_submittedby,a.jobsch_vacancydetails,a.jobsch_cid,c.jobsch_catname,s.jobsch_subname,s.jobsch_categoryid,s.jobsch_subid from #jobsch_ads as a
		left join #jobsch_subcats as s
		on s.jobsch_subid = a.jobsch_category
		left join #jobsch_cats as c
		on s.jobsch_categoryid = c.jobsch_catid
		where find_in_set(jobsch_catclass,'" . USERCLASS_LIST . "')
		and jobsch_approved > 0
		and (jobsch_closedate>'" . time() . "' or jobsch_closedate=0)
		order by jobsch_postdate desc
		LIMIT 0," . $this->limit;
}
else
{
    $jobsch_args = "
		select a.jobsch_vacancy,a.jobsch_salary,a.jobsch_postdate,a.jobsch_submittedby,a.jobsch_vacancydetails,a.jobsch_cid,c.jobsch_catname from #jobsch_ads as a
		left join #jobsch_cats as c
		on a.jobsch_category = c.jobsch_catid
		where find_in_set(jobsch_catclass,'" . USERCLASS_LIST . "')
		and jobsch_approved > 0
		and (jobsch_closedate>'" . time() . "' or jobsch_closedate=0)
		order by jobsch_postdate desc
		LIMIT 0," . $this->limit;
}
if ($items = $sql->db_Select_gen($jobsch_args))
{
    $i = 0;
    // found some so return the rss data
    while ($rowrss = $sql->db_Fetch())
    {
        $tmp = explode(".", $rowrss['jobsch_submittedby'], 2);
        $rss[$i]['author'] = "" . $tmp[1] ;
        $rss[$i]['author_email'] = '';
        $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "job_search/index.php?0.item." . $rowrss['jobsch_categoryid'] . "." . $rowrss['jobsch_subid'] . "." . $rowrss['jobsch_cid'] ;
        $rss[$i]['linkid'] = $rowrss['jobsch_cid'];
        $rss[$i]['title'] = $rowrss['jobsch_vacancy'];
        $rss[$i]['description'] = $rowrss['jobsch_vacancydetails'];

        $rss[$i]['category_name'] = "";
        $rss[$i]['category_link'] = "";
        $rss[$i]['datestamp'] = $rowrss['jobsch_postdate'];
        $rss[$i]['enc_url'] = "";
        $rss[$i]['enc_leng'] = "";
        $rss[$i]['enc_type'] = "";
        $i++;
    }
}
else
{
    // return no postings found to be displed
    $rss[$i]['author'] = "" . $tmp[1];
    $rss[$i]['author_email'] = '';
    $rss[$i]['link'] = $e107->base_path . $PLUGINS_DIRECTORY . "job_search/index.php";
    $rss[$i]['linkid'] = '';
    $rss[$i]['title'] = JOBSCH_RSS_5;
    $rss[$i]['description'] = JOBSCH_RSS_6;
    $rss[$i]['category_name'] = "";
    $rss[$i]['category_link'] = '';
    $rss[$i]['datestamp'] = "";
    $rss[$i]['enc_url'] = "";
    $rss[$i]['enc_leng'] = "";
    $rss[$i]['enc_type'] = "";
}

$eplug_rss_data[] = $rss;

?>