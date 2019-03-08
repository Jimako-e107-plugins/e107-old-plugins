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
// If not a valid call to the script then leave it
if (!defined('e107_INIT'))
{
    exit;
}

if (!is_object($jobsch_obj))
{
    require_once(e_PLUGIN . "job_search/includes/jobsearch_class.php");
    $jobsch_obj = new job_search;
}
// check if we use the wysiwyg for text areas
$e_wysiwyg = "jobsch_vacancydetails";
if ($JOBSCH_PREF['wysiwyg'])
{
    $WYSIWYG = true;
}
require_once(e_PLUGIN . "job_search/includes/jobsearch_shortcodes.php");
if ($jobsch_obj->jobsch_vote && isset($pref['plug_installed']['vote']) && (file_exists(e_THEME . "vote_jobsearch_template.php") || file_exists(e_PLUGIN . "job_search/templates/vote_jobsearch_template.php")))
{
    if (file_exists(e_THEME . "vote_jobsearch_template.php"))
    {
        define(JOBSCH_TEMPLATE, e_THEME . "vote_jobsearch_template.php");
    }
    else
    {
        define(JOBSCH_TEMPLATE, e_PLUGIN . "job_search/templates/vote_jobsearch_template.php");
    }
}
else
{
    if (file_exists(e_THEME . "jobsearch_template.php"))
    {
        define(JOBSCH_TEMPLATE, e_THEME . "jobsearch_template.php");
    }
    else
    {
        define(JOBSCH_TEMPLATE, e_PLUGIN . "job_search/templates/jobsearch_template.php");
    }
}
if (file_exists(e_THEME . 'job_search_logo.png'))
{
    define(JOBSCH_LOGO, e_THEME . 'job_search_logo.png');
} elseif (file_exists('./images/job_search_logo.png'))
{
    define(JOBSCH_LOGO, e_PLUGIN . 'job_search/images/job_search_logo.png');
}

require_once(JOBSCH_TEMPLATE);
// Check that access is permitted to this plugin
if (!$jobsch_obj->jobsch_reader)
{
    require_once(HEADERF);
    $jobsch_text = $tp->toHTML(JOBSCH_40);
    $ns->tablerender(JOBSCH_1, $jobsch_text);
    require_once(FOOTERF);
    exit;
}

$jobsch_gen = new convert;

$jobsch_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));
// get the parameters passed into the script
// print e_QUERY;
session_start();
// print_a($_SESSION);
$jobsch_local = intval($_SESSION['jobsch_local']);
if (isset($_POST['jobsch_local']))
{
    $jobsch_local = intval($_POST['jobsch_local']);
}
if (e_QUERY)
{
    $jobsch_tmpy = explode(".", e_QUERY);
    $jobsch_from = intval($jobsch_tmpy[0]);
    $jobsch_action = $jobsch_tmpy[1];
    $jobsch_catid = intval($jobsch_tmpy[2]);
    $jobsch_subid = intval($jobsch_tmpy[3]);
    $jobsch_itemid = intval($jobsch_tmpy[4]);
    $jobsch_tmp = intval($jobsch_tmpy[5]);
    // $jobsch_local = intval($jobsch_tmpy[6]);
} elseif (isset($_REQUEST['jobsch_from']))
{
    $jobsch_from = intval($_REQUEST['jobsch_from']);
    $jobsch_action = $_REQUEST['jobsch_action'];
    $jobsch_catid = intval($_REQUEST['jobsch_catid']);
    $jobsch_itemid = intval($_REQUEST['jobsch_itemid']);
    $jobsch_tmp = intval($_REQUEST['jobsch_tmp']);

    if (is_array($_REQUEST['jobsch_subid']))
    {
        foreach($_REQUEST['jobsch_subid'] as $row)
        {
            if ($row > 0)
            {
                $jobsch_subid = intval($row);
                $jobsch_action = "list";
            }
        }
    }
    else
    {
        $jobsch_subid = intval($_REQUEST['jobsch_subid']);
    }
}
$_SESSION['jobsch_local'] = $jobsch_local;
// this is used if drop downs are used for sub categories to get the one that was selected
// If from not defined then make it zero
$jobsch_from = ($jobsch_from > 0?$jobsch_from: 0);
// If no per page pref set then default to 10 per page
$jobsch_obj->jobsch_perpage = ($jobsch_obj->jobsch_perpage > 0?$jobsch_obj->jobsch_perpage:10);
// Check if subscriptions being done
if ($jobsch_obj->jobsch_subscribe && isset($_POST['jobsch_subsub']))
{
    if ($_POST['jobsch_subme'] > 0)
    {
        // add to subscriptions list
        // check if they already are subscribed
        if (!$sql->db_Select("jobsch_subs", "jobsch_subid", "jobsch_subuserid='" . USERID . "'"))
        {
            // no they are not so add them
            $jobsch_unsub = md5(USERID + time());
            $sql->db_Insert("jobsch_subs", "0,'" . USERID . "','$jobsch_unsub'");
        }
    }
    else
    {
        // check if they already are subscribed
        if ($sql->db_Select("jobsch_subs", "jobsch_subid", "where jobsch_subuserid=" . USERID , 'nowhere', false))
        {
            // They are so delete them
            $sql->db_Delete("jobsch_subs", "jobsch_subuserid='" . USERID . "'");
        }
    }
}
// Do the action
// check class for creating editing ads
if (isset($_POST['jobsch_sendpm']) && $JOBSCH_PREF['jobsch_usepm'] == 1)
{
    $pm_prefs = $sysprefs->getArray("pm_prefs");
    // code lifted from PM .php
    if (!check_class($pm_prefs['pm_class']))
    {
        // not in PM class
        $msg = JOBSCH_PM15;
    }
    else
    {
        require_once(e_PLUGIN . 'pm/pm_class.php');

        $jobsch_pm = new private_message;
        $jobsch_vars['pm_message'] = $_POST['jobsch_message'];
        $jobsch_vars['pm_subject'] = $_POST['jobsch_subject'];
        $jobsch_vars['from_id'] = intval($_POST['jobsh_sender']);
        $jobsch_vars['to_info']['user_id'] = intval($_POST['jobsh_poster']);
        $totalsize = strlen($_POST['jobsch_message']);
        $maxsize = intval($pm_prefs['attach_size']) * 1024;
        foreach(array_keys($_FILES['file_userfile']['size']) as $fid)
        {
            if ($maxsize > 0 && $_FILES['file_userfile']['size'][$fid] > $maxsize)
            {
                $msg .= str_replace("{FILENAME}", $_FILES['file_userfile']['name'][$fid], JOBSCH_PM14) . "<br />";
                $_FILES['file_userfile']['size'][$fid] = 0;
            }
            $totalsize += $_FILES['file_userfile']['size'][$fid];
        }

        if (intval($pref['pm_limit']) > 0)
        {
            if ($pref['pm_limit'] == '1')
            {
                if ($pm_info['outbox']['total'] == $pm_info['outbox']['limit'])
                {
                    $msg = JOBSCH_PM12;
                    $jobsch_pmerror = true;
                }
            }
            else
            {
                if ($pm_info['outbox']['size'] + $totalsize > $pm_info['outbox']['limit'])
                {
                    $msg = JOBSCH_PM13;
                    $jobsch_pmerror = true;
                }
            }
        }

        if ($_FILES['file_userfile']['name'][0])
        {
            if (check_class($pm_prefs['attach_class']))
            {
                require_once(e_HANDLER . "upload_handler.php");
                $randnum = rand(1000, 9999);
                $jobsch_vars['uploaded'] = file_upload(e_PLUGIN . "pm/attachments", "attachment", $randnum . "_");
                if ($jobsch_vars['uploaded'] == false)
                {
                    unset($jobsch_vars['uploaded']);
                    $msg .= JOBSCH_PM10 . "<br />";
                }
            }
            else
            {
                $msg .= JOBSCH_PM11 . "<br />";
                unset($jobsch_vars['uploaded']);
            }
        }
        // $_POST['from_id'] = USERID;
        if (!$jobsch_pmerror)
        {
            $jobsch_pm->add($jobsch_vars);
        }
        // $jobsch_catid = intval($jobsch_tmpy[2]);
        // $jobsch_subid = intval($jobsch_tmpy[3]);
        $jobsch_itemid = intval($_POST['jobsh_job']);
        $jobsch_action = 'item';
    }
}
switch ($jobsch_action)
{
    case "pm":
        if ($JOBSCH_PREF['jobsch_usepm'] == 1)
        {
            $jobsch_tmpy = explode(".", e_QUERY);
            $jobsh_job = intval($jobsch_tmpy[0]);
            $jobsch_action = $jobsch_tmpy[1];
            $jobsh_sender = intval($jobsch_tmpy[2]);
            $jobsh_poster = intval($jobsch_tmpy[3]);
            $jobsch_uploads = "<div id='up_container' >
	<span id='upline' style='white-space:nowrap'>
	<input class='tbox' type='file' name='file_userfile[]' size='40' />
	</span>
	</div>
	<input type='button' class='button' value='" . JOBSCH_PM08 . "' onclick=\"duplicateHTML('upline','up_container');\"  />";

            $sql->db_Select('user', 'user_name', 'where user_id=' . $jobsh_poster, 'nowhere', false);
            extract($sql->db_Fetch());
            $sql->db_Select('jobsch_ads', 'jobsch_vacancy', 'where jobsch_cid=' . $jobsh_job, 'nowhere', false);
            extract($sql->db_Fetch());
            $jobsch_defsubject = JOBSCH_PM06;
            $jobsch_defmessage = JOBSCH_PM07 . $tp->toFORM($jobsch_vacancy, false) . "\n\n";
            $jobsch_text .= "
		<form method = 'post' action = '" . e_SELF . "' id = 'sendpm' enctype='multipart/form-data'>
			<div>
				<input type='hidden'  name='jobsch_action' value='sendpm' />
				<input type='hidden'  name='jobsh_job' value='$jobsh_job' />
				<input type='hidden'  name='jobsh_sender' value='$jobsh_sender' />
				<input type='hidden'  name='jobsh_poster' value='$jobsh_poster' />
			</div>
				";
            $jobsch_text .= $tp->parsetemplate($JOBSCH_PM_HEADER, true, $jobsearch_shortcodes);
            $jobsch_text .= "</form > ";
        }
        break;

    case "subs":
        $jobsch_text .= "<form method = 'post' action = '" . e_SELF . "' id = 'jobschsub' > ";
        $jobsch_text .= $tp->parsetemplate($JOBSCH_SUBS_HEADER, true, $jobsearch_shortcodes);
        $jobsch_text .= $tp->parsetemplate($JOBSCH_SUBS_DETAIL, true, $jobsearch_shortcodes);
        $jobsch_text .= $tp->parsetemplate($JOBSCH_SUBS_FOOTER, true, $jobsearch_shortcodes);
        $jobsch_text .= "</form > ";
        break;
    case "mge":
    case "new";
        require_once("add.php");
        exit;
        break;
    case "tnc":
        $jobsch_text .= $tp->parsetemplate($JOBSCH_TC_HEADER, true, $jobsearch_shortcodes);
        $jobsch_text .= $tp->parsetemplate($JOBSCH_TC_DETAIL, true, $jobsearch_shortcodes);
        $jobsch_text .= $tp->parsetemplate($JOBSCH_TC_FOOTER, true, $jobsearch_shortcodes);
        $jobsch_text .= jobsch_footer();
        $jobsch_page = JOBSCH_41;
        break;
    case "item":
        if (USER)
        {
            $jobsch_usercheck = USERID;
        }
        else
        {
            $jobsch_usercheck = $e107->getip();
        }
        $jobsch_viewers .= $jobsch_usercheck . ",";
        // update views and unique views
        $sql2->db_Update("jobsch_ads", "jobsch_views=jobsch_views+1 where jobsch_cid=$jobsch_itemid", false);
        $sql2->db_Update("jobsch_ads", "jobsch_unique = jobsch_unique + 1,jobsch_viewers ='" . $jobsch_viewers . "' where jobsch_cid='$jobsch_itemid' and (ISNULL(jobsch_viewers) or not find_in_set('$jobsch_usercheck',jobsch_viewers)) ", false);
        // needs to be this complex for security reasons!
        $jobsch_arg = "select * from #jobsch_ads as r
                left join #jobsch_subcats as t on r.jobsch_category=jobsch_subid
                left join #jobsch_cats on jobsch_categoryid=jobsch_catid
                left join #jobsch_locals on jobsch_locality=jobsch_localid
                where r.jobsch_cid = $jobsch_itemid and find_in_set(jobsch_catclass, '" . USERCLASS_LIST . "') and jobsch_approved > 0
                and (jobsch_closedate = 0 or jobsch_closedate = '' or jobsch_closedate is null or jobsch_closedate > $jobsch_today) ";
        if ($sql->db_Select_gen($jobsch_arg, false))
        {
            $jobsch_row = $sql->db_Fetch();
            extract($jobsch_row);
        }
        $jobsch_tmp = explode(".", $jobsch_submittedby, 2);
        $jobsch_recipient = $jobsch_tmp[0];
        $jobsch_submittedbyname = $jobsch_tmp[1];
        $jobsch_text .= $tp->parsetemplate($JOBSCH_ITEM_HEADER, true, $jobsearch_shortcodes);
        $jobsch_text .= $tp->parsetemplate(JOBSCH_ITEM_DETAIL($jobsch_cid, $jobsch_vacancy), true, $jobsearch_shortcodes);
        $jobsch_text .= $tp->parsetemplate($JOBSCH_ITEM_FOOTER, true, $jobsearch_shortcodes);
        $jobsch_text .= jobsch_footer();
        $jobsch_page = JOBSCH_131 . " : " . substr($tp->toFORM($jobsch_vacancy), 0, 20);
        break;
    case "list":
        // $jobsch_text = jobsch_header();
        $jobsch_text .= " <form id = 'subform3' method = 'post' action = '" . e_SELF . "' >
		<div>
			<input type = 'hidden' name = 'jobsch_from' value = '" . $jobsch_from . "' />
			<input type = 'hidden' name = 'jobsch_action' value = 'list' />
			<input type = 'hidden' name = 'jobsch_catid' value = '" . $jobsch_catid . "' />
			<input type = 'hidden' name = 'jobsch_subid' value = '" . $jobsch_subid . "' />
			<input type = 'hidden' name = 'jobsch_itemid' value = '" . $jobsch_itemid . "' />
			<input type = 'hidden' name = 'jobsch_tmp' value = '" . $jobsch_tmp . "' />
		</div>";
        // needs to be this complex for security reasons!
        // if there is a locality set then add the locality to the where clause
        $jobsch_where = ($jobsch_local > 0?" and r.jobsch_locality = '{$jobsch_local}' ":"");
        // Get the data
        if ($jobsch_obj->jobsch_subcats)
        {
            $jobsch_arg = "select * from #jobsch_ads as r
                left join #jobsch_subcats as t on r.jobsch_category=jobsch_subid
                left join #jobsch_cats on jobsch_categoryid=jobsch_catid
                where r.jobsch_category = $jobsch_subid $jobsch_where and find_in_set(jobsch_catclass, '" . USERCLASS_LIST . "') and jobsch_approved > 0  and (jobsch_closedate = 0 or jobsch_closedate = '' or jobsch_closedate is null or jobsch_closedate > $jobsch_today)
                order by jobsch_postdate  limit $jobsch_from, " . $jobsch_obj->jobsch_perpage;
        }
        else
        {
            $jobsch_subid = $jobsch_catid;
            $jobsch_arg = "select * from #jobsch_ads as r
                left join #jobsch_cats on jobsch_category=jobsch_catid
                where r.jobsch_category = $jobsch_subid $jobsch_where and find_in_set(jobsch_catclass, '" . USERCLASS_LIST . "') and jobsch_approved > 0  and (jobsch_closedate = 0 or jobsch_closedate = '' or jobsch_closedate is null or jobsch_closedate > $jobsch_today)
                order by jobsch_postdate  limit $jobsch_from, " . $jobsch_obj->jobsch_perpage;
        }
        $jobsch_listing = true;
        $jobsch_count = $sql2->db_Count("jobsch_ads", "(*)", "where jobsch_category = $jobsch_subid $jobsch_where and jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate = '' or jobsch_closedate is null or jobsch_closedate > $jobsch_today)");
        $sql2->db_Select_gen("select * from #jobsch_subcats left join #jobsch_cats on jobsch_categoryid=jobsch_catid where jobsch_subid=$jobsch_subid");
        $jobsch_scat = $sql2->db_Fetch();
        extract($jobsch_scat);
        $jobsch_text .= $tp->parsetemplate($JOBSCH_LIST_HEADER, true, $jobsearch_shortcodes);
        if ($sql->db_Select_gen($jobsch_arg, false))
        {
            while ($jobsch_row = $sql->db_Fetch())
            {
                extract($jobsch_row);
                $jobsch_tmp = explode(".", $jobsch_submittedby, 2);
                $jobsch_poster = $jobsch_tmp[1];
                $jobsch_text .= $tp->parsetemplate(JOBSCH_LIST_DETAIL($jobsch_cid, $jobsch_vacancy), true, $jobsearch_shortcodes);
            } // while
        }
        else
        {
            $jobsch_text .= " <tr > <td class = 'forumheader3' colspan = '5' > " . JOBSCH_52 . "</td></tr> ";
        }

        $jobsch_text .= $tp->parsetemplate($JOBSCH_LIST_FOOTER, true, $jobsearch_shortcodes);
        $jobsch_text .= " </form > ";

        $jobsch_page = JOBSCH_129 . " " . $jobsch_catname . " " . JOBSCH_130 . " " . $jobsch_subname;
        break;
    case "sub":
        // $jobsch_where = ($jobsch_local > 0?" and jobsch_locality = '{$jobsch_local}'":"");
        $jobsch_where = ($jobsch_local > 0?" and jobsch_locality = '{$jobsch_local}' ":"");
        // $jobsch_text = jobsch_header();
        $jobsch_text .= "
<form action = '" . e_SELF . "' method='post' id='jobschsub'>
	<div>
		<input type='hidden' name='jobsch_from' value='" . $jobsch_from . "' />
        <input type='hidden' name='jobsch_action' value='sub' />
        <input type='hidden' name='jobsch_catid' value='" . $jobsch_catid . "' />
        <input type='hidden' name='jobsch_itemid' value='" . $jobsch_itemid . "' />
        <input type='hidden' name='jobsch_tmp' value='" . $jobsch_tmp . "' />
	</div>";
        $jobsch_colspan = ($JOBSCH_PREF['jobsch_icons'] > 0?3:2);
        $jobsch_from = 0;
        // get the sub and cat names
        $sql->db_Select("jobsch_cats", "jobsch_catname", "jobsch_catid=$jobsch_catid");
        $jobsch_row = $sql->db_Fetch();
        extract($jobsch_row);
        // display the header
        if ($jobsch_obj->jobsch_icons)
        {
            $jobsch_text .= $tp->parsetemplate($JOBSCH_SUB_HEADER, true, $jobsearch_shortcodes);
            $jobsch_text .= "";
            $jobsch_arg = "select * from #jobsch_subcats left join #jobsch_cats on jobsch_categoryid=jobsch_catid where jobsch_categoryid=$jobsch_catid and find_in_set(jobsch_catclass,'" . USERCLASS_LIST . "')  order by jobsch_subname";
            if ($sql->db_Select_gen($jobsch_arg))
            {
                while ($jobsch_row = $sql->db_Fetch())
                {
                    extract($jobsch_row);
                    $jobsch_count = $sql2->db_Count("jobsch_ads", "(*)", "where jobsch_category=$jobsch_subid and (jobsch_closedate = 0 or jobsch_closedate='' or jobsch_closedate is null or jobsch_closedate>$jobsch_today) $jobsch_where
					 and jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate='' or jobsch_closedate is null or jobsch_closedate>$jobsch_today) ");
                    $jobsch_text .= $tp->parsetemplate($JOBSCH_SUB_DETAIL, true, $jobsearch_shortcodes);
                } // while
            }
            else
            {
                $jobsch_text .= "<tr><td class='forumheader3' colspan='$jobsch_colspan'>" . JOBSCH_51 . "</td></tr>";
            }

            $jobsch_text .= $tp->parsetemplate($JOBSCH_SUB_FOOTER, true, $jobsearch_shortcodes);
        }
        else
        {
            $jobsch_text .= $tp->parsetemplate($JOBSCH_SUBNOICON_HEADER, true, $jobsearch_shortcodes);
            $jobsch_text .= "";
            $jobsch_arg = "select * from #jobsch_subcats left join #jobsch_cats on jobsch_categoryid=jobsch_catid where jobsch_categoryid=$jobsch_catid and find_in_set(jobsch_catclass,'" . USERCLASS_LIST . "')  order by jobsch_subname";
            if ($sql->db_Select_gen($jobsch_arg))
            {
                while ($jobsch_row = $sql->db_Fetch())
                {
                    extract($jobsch_row);
                    $jobsch_count = $sql2->db_Count("jobsch_ads", "(*)", "where jobsch_category=$jobsch_subid and (jobsch_closedate = 0 or jobsch_closedate='' or jobsch_closedate is null or jobsch_closedate>$jobsch_today) $jobsch_where
					 and jobsch_approved > 0 and (jobsch_closedate = 0 or jobsch_closedate='' or jobsch_closedate is null or jobsch_closedate>$jobsch_today) ");
                    $jobsch_text .= $tp->parsetemplate($JOBSCH_SUBNOICON_DETAIL, true, $jobsearch_shortcodes);
                } // while
            }
            else
            {
                $jobsch_text .= "<tr><td class='forumheader3' colspan='$jobsch_colspan'>" . JOBSCH_51 . "</td></tr>";
            }

            $jobsch_text .= $tp->parsetemplate($JOBSCH_SUBNOICON_FOOTER, true, $jobsearch_shortcodes);
        }
        $jobsch_text .= "</form>";
        $jobsch_text .= jobsch_footer();
        $jobsch_page = JOBSCH_129 . " " . $jobsch_catname;
        break;
    case "cat":
    default:

        $jobsch_text .= "
<form id='subform2' method='post' action='" . e_SELF . "' >
	<div>
		<input type='hidden' name='jobsch_from' value='" . $jobsch_from . "' />
        <input type='hidden' name='jobsch_action' value='cat' />
        <input type='hidden' name='jobsch_catid' value='" . $jobsch_catid . "' />
        <input type='hidden' name='jobsch_itemid' value='" . $jobsch_itemid . "' />
        <input type='hidden' name='jobsch_tmp' value='" . $jobsch_tmp . "' />
	</div>";

        if ($jobsch_local > 0)
        {
            $jobsch_local_where = " and jobsch_locality={$jobsch_local}  ";
        }
        if (!$jobsch_obj->jobsch_maincat)
        {
            if ($jobsch_obj->jobsch_admin)
            {
                $jobsch_where = "";
            }
            else
            {
                $jobsch_where = "where find_in_set(jobsch_catclass,'" . USERCLASS_LIST . "')";
            }
            // we are doing categories (and sub categories)
            if ($jobsch_obj->jobsch_icons)
            {
                // we are using icons
                $jobsch_text .= $tp->parsetemplate($JOBSCH_CAT_HEADER, true, $jobsearch_shortcodes);
                if ($sql->db_Select("jobsch_cats", "*", " $jobsch_where order by jobsch_catname", "nowhere", false))
                {
                    while ($jobsch_row = $sql->db_Fetch())
                    {
                        extract($jobsch_row);
                        $jobsch_text .= $tp->parsetemplate($JOBSCH_CAT_DETAIL, true, $jobsearch_shortcodes);
                    } // while
                }
                $jobsch_text .= $tp->parsetemplate($JOBSCH_CAT_FOOTER, true, $jobsearch_shortcodes);
            }
            else
            {
                // not using icons
                $jobsch_text .= $tp->parsetemplate($JOBSCH_CATNOICON_HEADER, true, $jobsearch_shortcodes);
                if ($sql->db_Select("jobsch_cats", "*", "$jobsch_where order by jobsch_catname", "nowhere", false))
                {
                    while ($jobsch_row = $sql->db_Fetch())
                    {
                        extract($jobsch_row);
                        $jobsch_text .= $tp->parsetemplate($JOBSCH_CATNOICON_DETAIL, true, $jobsearch_shortcodes);
                    } // while
                }
                $jobsch_text .= $tp->parsetemplate($JOBSCH_CATNOICON_FOOTER, true, $jobsearch_shortcodes);
            }
        }
        else
        {
            $jobsch_arg = "select * from #jobsch_ads as r
                where jobsch_approved > 0 {$jobsch_local_where} and (jobsch_closedate = 0 or jobsch_closedate = '' or jobsch_closedate is null or jobsch_closedate > $jobsch_today)
                order by jobsch_postdate  limit $jobsch_from, " . $jobsch_obj->jobsch_perpage;
            $jobsch_text .= $tp->parsetemplate($JOBSCH_NCAT_HEADER, true, $jobsearch_shortcodes);
            if ($sql->db_Select_gen($jobsch_arg, false))
            {
                while ($jobsch_row = $sql->db_Fetch())
                {
                    extract($jobsch_row);
                    $jobsch_text .= $tp->parsetemplate($JOBSCH_NCAT_DETAIL, true, $jobsearch_shortcodes);
                } // while
            }
            $jobsch_text .= $tp->parsetemplate($JOBSCH_NCAT_FOOTER, true, $jobsearch_shortcodes);
        }
        $jobsch_text .= "</form>";
        $jobsch_page = JOBSCH_128;
        break;
}
// define the over ride meta tags
// define("PAGE_NAME", JOBSCH_1);
define("e_PAGETITLE", JOBSCH_1 . " : " . $jobsch_page);
if (!empty($JOBSCH_PREF['jobsch_metad']))
{
    define("META_DESCRIPTION", $JOBSCH_PREF['jobsch_metad']);
}
if (!empty($JOBSCH_PREF['jobsch_metak']))
{
    define("META_KEYWORDS", $JOBSCH_PREF['jobsch_metak']);
}
require_once(HEADERF);
$ns->tablerender(JOBSCH_1, $jobsch_text);
require_once(FOOTERF);
// .
// functions
// .
function jobsch_footer($jobsch_nextprev)
{
    global $JOBSCH_PREF, $jobsch_from, $jobsch_action, $jobsch_catid, $jobsch_subid, $jobsch_itemid;
    if (!empty($jobsch_nextprev))
    {
        $jobsch_retval .= JOBSCH_42;
    }
    $jobsch_retval .= "&nbsp;$jobsch_nextprev";
    return $jobsch_retval;
}

