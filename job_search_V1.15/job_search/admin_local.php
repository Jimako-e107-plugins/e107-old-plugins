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
if ($jobsch_action == 'update')
{
    $jobsch_id = $_POST['jobsch_id'];
    if ($jobsch_id == 0)
    {
        // New record so add it
        $jobsch_args = "
		'0',
		'" . $tp->toDB($_POST['jobsch_localname']) . "',
		'" . $tp->toDB($_POST['jobsch_localflag']) . "'";
        if ($sql->db_Insert("jobsch_locals", $jobsch_args))
        {
            $jobsch_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . JOBSCH_A28 . "</strong></td></tr>";
        }
    }
    else
    {
        // Update existing
        $jobsch_args = "
		jobsch_localname='" . $tp->toDB($_POST['jobsch_localname']) . "',
		jobsch_localflag='" . $tp->toDB($_POST['jobsch_localflag']) . "'
		where jobsch_localid='$jobsch_id'";
        if ($sql->db_Update("jobsch_locals", $jobsch_args))
        {
            // Changes saved
            $jobsch_msg .= "<tr><td class='forumheader3' colspan='2'><b>" . JOBSCH_A28 . "</b></td></tr>";
        }
    }
}
// We are creating, editing or deleting a record
if ($jobsch_action == 'dothings')
{
    $jobsch_id = $_POST['jobsch_selcat'];
    $jobsch_do = $_POST['jobsch_recdel'];
    $jobsch_dodel = false;

    switch ($jobsch_do)
    {
        case '1': // Edit existing record
            {
                // We edit the record
                $sql->db_Select("jobsch_locals", "*", "jobsch_localid='$jobsch_id'");
                $jobsch_row = $sql->db_Fetch() ;
                extract($jobsch_row);
                $jobsch_edit = true;
                break;
            }
        case '2': // New category
            {
                // Create new record
                $jobsch_id = 0;
                // set all fields to zero/blank
                $jobsch_edit = true;
                break;
            }
        case '3':
            {
                // delete the record
                if ($_POST['jobsch_okdel'] == '1')
                {
                    if ($sql->db_Select("jobsch_ads", "jobsch_cid", " where jobsch_locality='$jobsch_id'", "nowhere"))
                    {
                        $jobsch_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . JOBSCH_A124 . "</strong></td></tr>";
                    }
                    else
                    {
                        if ($sql->db_Delete("jobsch_locals", " jobsch_localid='$jobsch_id'"))
                        {
                            $jobsch_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . JOBSCH_A125 . "</strong></td></tr>";
                        }
                        else
                        {
                            $jobsch_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . JOBSCH_A126 . "</strong></td></tr>";
                        }
                    }
                }
                else
                {
                    $jobsch_msg .= "<tr><td class='forumheader3' colspan='2'><strong>" . JOBSCH_A32 . "</strong></td></tr>";
                }

                $jobsch_dodel = true;
                $jobsch_edit = false;
            }
    }

    if (!$jobsch_dodel)
    {
        $jobsch_iconlist = "<select name='jobsch_localflag' class='tbox'>";
        if ($handle = opendir("./images/icons"))
        {
            $jobsch_iconlist .= "<option value=\"\"> </option>";
            while (false !== ($file = readdir($handle)))
            {
                if ($file <> "." && $file <> "..")
                {
                    $jobsch_iconlist .= "<option value=\"" . $file . "\" " .
                    ($file == $jobsch_localflag ? " selected " : " ") . ">" . $file . "</option>";
                }
            }

            closedir($handle);
        }
        $jobsch_iconlist .= "</select>";
        $jobsch_text .= "
		<form id='myclassupdate' method='post' action='" . e_SELF . "'>
<div>
<input type='hidden' value='$jobsch_id' name='jobsch_id' />
		<input type='hidden' value='update' name='jobsch_action' />
</div>
		<table style='".ADMIN_WIDTH."' class='fborder'>
		<tr><td colspan='2' class='fcaption'>" . JOBSCH_A130 . "</td></tr>
		$jobsch_msg
		<tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . JOBSCH_A123 . "</td><td  class='forumheader3'><input type='text' class='tbox' name='jobsch_localname' style='width:40%' value='$jobsch_localname' /></td></tr>";
        # <tr><td style='width:20%;vertical-align:top;' class='forumheader3'>" . JOBSCH_95 . "</td><td  class='forumheader3'>" . $jobsch_iconlist . "</td></tr>
        $jobsch_text .= "<tr><td colspan='2' class='forumheader2'><input type='submit' name='submits' value='" . JOBSCH_A24 . "' class='button' /></td></tr>
				<tr><td colspan='2' class='fcaption'>&nbsp;</td></tr>
		</table></form>";
    }
}
if (!$jobsch_edit)
{
    // Get the category names to display in combo box
    // then display actions available
    $jobsch_yes = false;
    if ($sql2->db_Select("jobsch_locals", "jobsch_localid,jobsch_localname", " order by jobsch_localname", "nowhere"))
    {
        $jobsch_yes = true;
        while ($jobsch_row = $sql2->db_Fetch())
        {
            # extract($jobsch_row);
            $jobsch_catopt .= "<option value='" . $jobsch_row['jobsch_localid'] . "'" .
            ($jobsch_id == $jobsch_row['jobsch_localid']?" selected='selected'":"") . ">" . $jobsch_row['jobsch_localname'] . "</option>";
        }
    }
    else
    {
        $jobsch_catopt .= "<option value='0'>" . JOBSCH_A122 . "</option>";
    }

    $jobsch_text .= "
<form id='jobschform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='dothings' name='jobsch_action' />
	</div>
	<table style='".ADMIN_WIDTH."' class='fborder'>
	<tr><td colspan='2' class='fcaption'>" . JOBSCH_A130 . "	</td></tr>
	$jobsch_msg
	<tr><td style='width:20%;' class='forumheader3'>" . JOBSCH_A173 . "</td><td  class='forumheader3'>
	<select name='jobsch_selcat' class='tbox'>$jobsch_catopt</select></td></tr>
	<tr><td style='width:20%;' class='forumheader3'>" . JOBSCH_A19 . "</td><td  class='forumheader3'>
	<input type='radio' name='jobsch_recdel' value='1' " . ($jobsch_yes?"checked='checked'":"disabled='disabled'") . " /> " . JOBSCH_A20 . "<br />
	<input type='radio' name='jobsch_recdel' value='2' " . (!$jobsch_yes?"checked='checked'":"") . "/> " . JOBSCH_A21 . "<br />
	<input type='radio' name='jobsch_recdel' value='3' /> " . JOBSCH_A22 . "
	<input type='checkbox' name='jobsch_okdel' value='1' />" . JOBSCH_A23 . "</td></tr>
	<tr><td colspan='2' class='forumheader2'>
	<input type='submit' name='submits' value='" . JOBSCH_A24 . "' class='button' /></td></tr>
		<tr><td colspan='2' class='fcaption'>&nbsp;</td></tr>

	</table></form>";
}

$ns->tablerender(JOBSCH_A1, $jobsch_text);

require_once(e_ADMIN . "footer.php");

?>