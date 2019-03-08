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

$jobsch_from = intval(e_QUERY);

if (isset($_REQUEST['jobsch_dosubs']))
{
    foreach($_POST['jobsch_sub'] as $key => $row)
    {
        if ($row == 1)
        {
            $sql->db_Delete("jobsch_subs", " jobsch_subuserid=$key", false);
            $sql->db_Insert("jobsch_subs", "0,$key,'" . md5($key . time()) . "'", false);
        }
        else
        {
            $sql->db_Delete("jobsch_subs", " jobsch_subuserid=$key", false);
        }
    }
}

$jobsch_count = $sql->db_Count("user", "(*)");
$jobsch_npaction = "$jobsch_from";
$jobsch_npparms = $jobsch_count . "," . 25 . "," . $jobsch_from . "," . e_SELF . '?' . "[FROM]." . $jobsch_npaction;
$jobsch_nextprev = $tp->parseTemplate("{NEXTPREV={$jobsch_npparms}}") . "";
$jobsch_text .= "
<form id=jobsch_news' method='post' action='" . e_SELF . "' >
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='3' >" . JOBSCH_A187 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:10%;' >" . JOBSCH_A179 . "</td>
			<td class='forumheader2' style='width:60%;' >" . JOBSCH_A180 . "</td>
			<td class='forumheader2' style='text-align:center;'>" . JOBSCH_A181 . "</td>
		</tr>";
if (isset($_POST['jobsch_gouser']) && !empty($_POST['jobsch_gouser']))
{
    $jobsch_where = " where user_name='" . $tp->toDB($_POST['jobsch_gouser']) . "'";
}
if ($sql->db_Select_gen("select user_id,user_name,jobsch_subuserid from #user left join #jobsch_subs on jobsch_subuserid=user_id $jobsch_where order by user_id limit $jobsch_from,25", false))
{
    while ($row = $sql->db_Fetch())
    {
        extract($row);
        $jobsch_text .= "
		<tr>
			<td class='forumheader3'>{$user_id}</td>
			<td class='forumheader3'>" . $tp->toHTML($user_name) . "</td>
			<td class='forumheader3' style='text-align:center;'>
				" . JOBSCH_A185 . " <input type='radio'  value='0' name='jobsch_sub[{$user_id}]' " . ($jobsch_subuserid == 0?"checked='checked'":"") . " />&nbsp;&nbsp;
				" . JOBSCH_A186 . "<input type='radio'  value='1' name='jobsch_sub[{$user_id}]' " . ($jobsch_subuserid > 0?"checked='checked'":"") . " />
				</td>
		</tr>";
    } // while
}
$jobsch_text .= "
		<tr>
			<td class='forumheader2' style='text-align:center;' colspan='3'>" . JOBSCH_A182 . " <input class='tbox' type='text' name='jobsch_gouser' value='' /> <input class='button' type='submit' name='jobsch_filter' value='" . JOBSCH_A184 . "' /></td>
		</tr>
		<tr>
			<td class='forumheader2' style='text-align:center;' colspan='3'>" . $jobsch_nextprev . "&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='3'>
				<input class='button' type='submit' name='jobsch_dosubs' value='" . JOBSCH_A183 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='3'>&nbsp;</td>
		</tr>
	</table>
</form>";

$ns->tablerender(JOBSCH_A1, $jobsch_text);
require_once(e_ADMIN . "footer.php");

?>