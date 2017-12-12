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
if (!defined('e107_INIT')) { exit; }
require_once(e_PLUGIN . "job_search/includes/jobsearch_class.php");
if (!is_object($jobsch_obj))
{
    $jobsch_obj = new job_search;
}
$config_category = JOBSCH_A43;
$config_events = array('jobshack' => JOBSCH_A44);

if (!function_exists('notify_jobshack'))
{
    function notify_jobshack($data)
    {
        global $nt;

        if ($data['action'] = "update")
        {
            $message = "<strong>" . JOBSCH_A49 . ': </strong>' . $data['user'] . '<br />';
        }
        else
        {
            $message = "<strong>" . JOBSCH_A45 . ': </strong>' . $data['user'] . '<br />';
        }
        $message .= "<strong>" . JOBSCH_A46 . ':</strong> ' . $data['itemtitle'] . "<br /><br />" . JOBSCH_A48 ;
        $message .= " " . JOBSCH_A47 . " " . $data['catid'] . "<br /><br />";
        $nt->send('jobshack', JOBSCH_A44, $message);
    }
}

?>