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
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_BASE . "index.php");
    exit;
}
require_once(e_PLUGIN . "job_search/includes/jobsearch_class.php");
if (!is_object($jobsch_obj))
{
    $jobsch_obj = new job_search;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}

$jobsch_conv = new convert;

if (isset($_REQUEST['jobsch_donews']))
{
    // get the list of subscribers
    // step through each one and get the vacancies they are allowed to see
    // send them the newsletter
    require_once(e_HANDLER . "mail.php");
    // Create message
    require_once(e_PLUGIN."job_search/includes/jobsearch_shortcodes.php");
    require_once(e_PLUGIN."job_search/newsletter/newsletter_template.php");
    $month = date("m");
    $day = date("j");
    $year = date("Y");
    $jobsch_today = mktime(0, 0, 0, $month, $day, $year);
    $jobsch_arg = "select j.*,u.user_loginname,u.user_email from #jobsch_subs as j
	left join #user as u on jobsch_subuserid=user_id where user_loginname is not null";
    if ($sql->db_Select_gen($jobsch_arg, false))
    {
        $jobsch_yescount = 0;
        $jobsch_nocount = 0;
        while ($jobsch_row = $sql->db_Fetch())
        {
            extract($jobsch_row);
            # print $user_email;
            $jobsch_arg2 = "select * from #jobsch_ads as r
                left join #jobsch_subcats as s on r.jobsch_category=s.jobsch_subid
                left join #jobsch_cats as c on s.jobsch_categoryid=c.jobsch_catid
                left join #jobsch_locals as l on r.jobsch_locality=l.jobsch_localid
                where
				(jobsch_lastnews = 0 or  jobsch_lastnews < '" . $JOBSCH_PREF['jobsch_lastnews'] . "')
				and find_in_set(jobsch_catclass, '" . USERCLASS_LIST . "')" .
            ($JOBSCH_PREF['jobsch_approval'] == 1?" and jobsch_approved > 0":"") . " and (jobsch_closedate = 0 or jobsch_closedate = '' or jobsch_closedate is null or jobsch_closedate > $jobsch_today)
                order by jobsch_postdate " . $tp->toFORM($JOBSCH_PREF['jobsch_sort']) ;
            $jobsch_counter = $sql2->db_Select_gen($jobsch_arg2, false);
            if ($jobsch_counter)
            {
                $message = $tp->parsetemplate($JOBSCH_NEWS_HEADER, false, $jobsearch_shortcodes);
                while ($jobsch_mrow = $sql2->db_Fetch())
                {
                    extract($jobsch_mrow);
                    $message .= $tp->parsetemplate($JOBSCH_NEWS_DETAIL, false, $jobsearch_shortcodes);
                } // while

                $message .= $tp->parsetemplate($JOBSCH_NEWS_FOOTER, false, $jobsearch_shortcodes);
               # print $user_email.' '.$JOBSCH_PREF['jobsch_sysemail'].' '.$user_loginname.' '.$JOBSCH_PREF['jobsch_sysfrom'];
                $jobsch_emalok = sendemail($user_email, JOBSCH_NEWSLETTER_TITLE, $message, $user_loginname, $JOBSCH_PREF['jobsch_sysemail'], $JOBSCH_PREF['jobsch_sysfrom']);
                if ($jobsch_emalok)
                {
                    $jobsch_yescount++;
                }
                else
                {
                    $jobsch_nocount++;
                }
            }

            // print "do mail $user_loginname<br>";
        }
        $jobsch_now = time();
        if ($sql->db_Update("jobsch_ads", "jobsch_lastnews='{$jobsch_now}'", false))
        {
            $jobsch_upok = JOBSCH_A149;
        }
        else
        {
            $jobsch_upok = JOBSCH_A150;
        }
        $JOBSCH_PREF['jobsch_lastnews'] = $jobsch_now;
        $jobsch_obj->save_prefs();
        // Send Emails
        $jobsch_text .= "
	<table class='fborder' style='".ADMIN_WIDTH."'>
        <tr>
			<td class='fcaption'>" . JOBSCH_A133 . "</td>
		</tr>
        <tr>
			<td class='forumheader3'>" . JOBSCH_A145 . " $jobsch_yescount " . JOBSCH_A146 . "<br />" . JOBSCH_A147 . " $jobsch_nocount " . JOBSCH_A148 . "<br /></td>
		</tr>
        <tr>
			<td class='forumheader3'>" . $jobsch_upok . "</td>
		</tr>
    </table>";
    } // ;
}
else
{
$jobsch_arg = "select count(jobsch_subid) as jobsch_count from #jobsch_subs as j
	left join #user as u on jobsch_subuserid=user_id where user_loginname is not null";
    $sql->db_Select_gen($jobsch_arg,false );
    extract($sql->db_Fetch());
    $jobsch_vacancies = $sql->db_Count("jobsch_ads", "(*)", "where jobsch_lastnews = 0 or jobsch_lastnews <'" . $JOBSCH_PREF['jobsch_lastnews'] . "'",false);
    $jobsch_text .= "
<form id=jobsch_news' method='post' action='" . e_SELF . "' >
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='fcaption'>" . JOBSCH_A133 . "</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . JOBSCH_A136 . " " . ($JOBSCH_PREF['jobsch_lastnews'] > 0?$jobsch_conv->convert_date($JOBSCH_PREF['jobsch_lastnews']):JOBSCH_A137) . "</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . JOBSCH_A134 . " $jobsch_count " . JOBSCH_A138 . " " .  JOBSCH_A139 . " " . $jobsch_vacancies . " " . JOBSCH_A140 . " </td>
		</tr>
		<tr>
			<td class='forumheader2'><input class='button' type='submit' name='jobsch_donews' value='" . JOBSCH_A135 . "' /></td>
		</tr>
		<tr>
			<td class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";
}
$ns->tablerender(JOBSCH_A1, $jobsch_text);
require_once(e_ADMIN . "footer.php");

?>