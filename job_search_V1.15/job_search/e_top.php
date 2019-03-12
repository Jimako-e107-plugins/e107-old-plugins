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
require_once(e_PLUGIN . "job_search/includes/jobsearch_class.php");
if (!is_object($jobsch_obj))
{
    $jobsch_obj = new job_search;
}
if ($jobsch_obj->jobsch_reader)
{
    // $TOP_PLUGIN_SECTIONS[]=array(,);
    // top items by views
    // data in the order item name, poster (ID.name),category,date posted,link,additional info
    // .
    // Top ads by views
    unset($TOP_VIEWS);
    global $sql, $top_tc;
    global $TOP_PREFS, $top_limitname, $top_limitmode;
    $jobsch_arg = "select * from #jobsch_ads where jobsch_approved>0 and (jobsch_closedate=0 or jobsch_closedate>" . time() . ") order by jobsch_views desc limit 0," . $top_tc->limit();
    $sql->db_Select_gen($jobsch_arg, false);
    while ($jobsch_row = $sql->db_Fetch())
    {
        $TOP_VIEWS[] = array($jobsch_row['jobsch_vacancy'],
            $jobsch_row['jobsch_submittedby'],
            "",
            $jobsch_row['jobsch_postdate'],
            e_PLUGIN . "job_search/index.php?0.item.0.0." . $jobsch_row['jobsch_cid'],
            JOBSCH_T02 . " " . $jobsch_row['jobsch_views']);
    } // while
    // Top Poster
    unset($TOP_POSTER);
    $jobsch_arg = "select *,count(jobsch_submittedby) as numpost from #jobsch_ads where jobsch_approved>0 and (jobsch_closedate=0 or jobsch_closedate>" . time() . ")  group by jobsch_submittedby order by numpost  desc limit 0," . $top_tc->limit();
    $sql->db_Select_gen($jobsch_arg, false);

    while ($jobsch_row = $sql->db_Fetch())
    {
        $TOP_POSTER[] = array(JOBSCH_T04 . " " . $jobsch_row['numpost'],
            $jobsch_row['jobsch_submittedby'],
            "",
            "",
            "",
            ""
            );
    } // while
    // top categories by jobs
    unset($TOP_CATJOB);
    if ($jobsch_obj->jobsch_subcats)
    {
        $jobsch_arg = "select jobsch_catname,count(jobsch_catid) as numpost from #jobsch_ads
left join #jobsch_subcats on jobsch_category=jobsch_subid
left join #jobsch_cats on jobsch_catid=jobsch_categoryid
where jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate> " . time() . ") group by jobsch_catid order by numpost desc limit 0," . $top_tc->limit();
    }
    else
    {
        $jobsch_arg = "select jobsch_catname,count(jobsch_catid) as numpost from #jobsch_ads
left join #jobsch_cats on jobsch_catid=jobsch_category
where jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate> " . time() . ") group by jobsch_catid order by numpost desc limit 0," . $top_tc->limit();
    }
    $sql->db_Select_gen($jobsch_arg, false);
    while ($jobsch_row = $sql->db_Fetch())
    {
        $TOP_CATJOB[] = array($jobsch_row['jobsch_catname'],
            "",
            "",
            "",
            e_PLUGIN . "job_search/index.php?0.cat." . $jobsch_row['jobsch_catid'],
            JOBSCH_T06 . " " . $jobsch_row['numpost']);
    } // while
    // top categories by views
    unset($TOP_CATVIEW);
    if ($jobsch_obj->jobsch_subcats)
    {
        $jobsch_arg = "select jobsch_catname,sum(jobsch_views) as numpost from #jobsch_ads
left join #jobsch_subcats on jobsch_category=jobsch_subid
left join #jobsch_cats on jobsch_catid=jobsch_categoryid
where jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate> " . time() . ") group by jobsch_catid order by numpost desc limit 0," . $top_tc->limit();
    }
    else
    {
        $jobsch_arg = "select jobsch_catname,sum(jobsch_views) as numpost from #jobsch_ads
left join #jobsch_cats on jobsch_catid=jobsch_category
where jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate> " . time() . ") group by jobsch_catid order by numpost desc limit 0," . $top_tc->limit();
    }
    $sql->db_Select_gen($jobsch_arg, false);
    while ($jobsch_row = $sql->db_Fetch())
    {
        $TOP_CATVIEW[] = array($jobsch_row['jobsch_catname'],
            "",
            "",
            "",
            e_PLUGIN . "job_search/index.php?0.cat." . $jobsch_row['jobsch_catid'],
            JOBSCH_T08 . " " . $jobsch_row['numpost']);
    } // while
    $TOP_MENU_DATA[] = array(
        JOBSCH_T01 => $TOP_VIEWS,
        JOBSCH_T03 => $TOP_POSTER,
        JOBSCH_T05 => $TOP_CATJOB,
        JOBSCH_T07 => $TOP_CATVIEW);
}

?>