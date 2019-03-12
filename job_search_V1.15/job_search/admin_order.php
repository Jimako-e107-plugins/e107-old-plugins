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

$jobsch_action = $_POST['jobsch_action'];
$jobsch_edit = false;
// * If we are updating then update or insert the record
if (isset($_POST['jobsch_submits']))
{
    // Update existing
    foreach($_POST['jobsch_catorder'] as $key => $row)
    {
        $sql->db_Update("jobsch_cats", "jobsch_catorder=$row where jobsch_catid=$key", false);
    }
    if ($jobsch_obj->jobsch_subcats)
    {
        foreach($_POST['jobsch_suborder'] as $key => $row)
        {
            $sql->db_Update("jobsch_subcats", "jobsch_suborder=$row where jobsch_subid=$key", false);
        }
    }
}

if (!$jobsch_edit)
{
    $jobsch_text .= "
<form id='myjobschform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='jobsch_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='3' class='fcaption'>" . JOBSCH_A170 . "	</td>
		</tr>
		<tr>
			<td  class='forumheader' style='width:45%;'><b>" . JOBSCH_A167 . "</b></td>
			<td  class='forumheader' style='width:45%;'><b>" . ($jobsch_obj->jobsch_subcats?JOBSCH_A168:"&nbsp;") . "</b></td>
			<td  class='forumheader' style='text-align:center;'><b>" . JOBSCH_A169 . "</b></td>
		</tr>		";
    if ($jobsch_obj->jobsch_subcats)
    {
        $jobsch_arg = "select * from #jobsch_subcats
	left join #jobsch_cats on  jobsch_categoryid=jobsch_catid
	order by jobsch_catorder,jobsch_suborder";
    }
    else
    {
        $jobsch_arg = "select * from #jobsch_cats
	order by jobsch_catorder";
    }
    if ($sql2->db_Select_gen($jobsch_arg, false))
    {
        $jobsch_current = 0;
        while ($jobsch_row = $sql2->db_Fetch())
        {
            extract($jobsch_row);
            if ($jobsch_current != $jobsch_catid)
            {
                $jobsch_current = $jobsch_catid;
                $jobsch_text .= "
		<tr>
			<td class='forumheader2' >" . $tp->toHTML($jobsch_catname) . "</td>
			<td class='forumheader2'>&nbsp;</td>
			<td class='forumheader2' style='text-align:center;'><input class='tbox' style='width:20px;' name='jobsch_catorder[$jobsch_catid]' value='" . $jobsch_catorder . "' />	</td>
		</tr>";
            }
            if ($jobsch_obj->jobsch_subcats)
            {
                $jobsch_text .= "
		<tr>
			<td class='forumheader3' >&nbsp;</td>
			<td class='forumheader3'>" . $tp->toHTML($jobsch_subname) . "	</td>
			<td class='forumheader3' style='text-align:center;'><input class='tbox' style='width:20px;' name='jobsch_suborder[$jobsch_subid]' value='" . $jobsch_suborder . "' />	</td>
		</tr>";
            }
        }
    }
    else
    {
        $jobsch_catopt .= JOBSCH_A18 ;
    }

    $jobsch_text .= "
		<tr>
			<td colspan='3' class='forumheader2'>
				<input type='submit' name='jobsch_submits' value='" . JOBSCH_A24 . "' class='button' />
			</td>
		</tr>
		<tr>
			<td colspan='3' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";
}

$ns->tablerender(JOBSCH_A1, $jobsch_text);

require_once(e_ADMIN . "footer.php");

?>