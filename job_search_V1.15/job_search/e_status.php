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
include_lan(e_PLUGIN . "job_search/languages/" . e_LANGUAGE . ".php");
$jobsch_posts = $sql->db_Count("jobsch_ads", "(*)");
if (empty($jobsch_posts))
{
    $jobsch_posts = 0;
}
$text .= "<div style='padding-bottom: 2px;'><img src='" . e_PLUGIN . "job_search/images/icon_16.png' style='width: 16px; height: 16px; vertical-align: bottom;border:0;' alt='' /> " . JOBSCH_A159 . ": " . $jobsch_posts . "</div>";

?>