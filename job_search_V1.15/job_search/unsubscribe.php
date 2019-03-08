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

require_once(e_PLUGIN . "job_search/includes/jobsearch_class.php");
if (!is_object($jobsch_obj))
{
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
require_once(JOBSCH_TEMPLATE);

require_once(HEADERF);
$jobsch_unsubscribe = e_QUERY;
if ($sql->db_Delete("jobsch_subs", "jobsch_subemail='{$jobsch_unsubscribe}'", false))
{
    $jobsch_msg = JOBSCH_142;
}
else
{
    $jobsch_msg = JOBSCH_143;
}

$jobsch_text .= $tp->parsetemplate($JOBSCH_SUBS_UNSUB, true, $jobsearch_shortcodes);
$ns->tablerender(JOBSCH_1, $jobsch_text);
require_once(FOOTERF);

?>
