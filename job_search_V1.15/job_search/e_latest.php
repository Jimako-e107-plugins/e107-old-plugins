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
include_lan(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php");
$jobsch_approve = $sql->db_Count('jobsch_ads', '(*)', "WHERE jobsch_approved='0'");
$text .= "<div style='padding-bottom: 2px;'>
<img src='" . e_PLUGIN . "job_search/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> ";
if (empty($jobsch_approve))
{
    $jobsch_approve = 0;
}
if ($jobsch_approve)
{
    $text .= "<a href='" . e_PLUGIN . "job_search/admin_submit.php'>" . JOBSCH_A51 . ": " . $jobsch_approve . "</a>";
}
else
{
    $text .= JOBSCH_A51 . ': ' . $jobsch_approve;
}

$text .= '</div>';

?>