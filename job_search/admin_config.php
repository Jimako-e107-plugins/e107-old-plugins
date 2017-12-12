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
$e_wysiwyg = "jobsch_terms";
if ($JOBSCH_PREF['wysiwyg'])
{
    $WYSIWYG = true;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
if (e_QUERY == "update")
{
    $JOBSCH_PREF['jobsch_email'] = $tp->toDB($_POST['jobsch_email']);
    $JOBSCH_PREF['jobsch_approval'] = intval($_POST['jobsch_approval']);
    $JOBSCH_PREF['jobsch_valid'] = intval($_POST['jobsch_valid']);
    $JOBSCH_PREF['jobsch_read'] = intval($_POST['jobsch_read']);
    $JOBSCH_PREF['jobsch_create'] = intval($_POST['jobsch_create']);
    $JOBSCH_PREF['jobsch_admin'] = intval($_POST['jobsch_admin']);
    $JOBSCH_PREF['jobsch_useremail'] = intval($_POST['jobsch_useremail']);
    $JOBSCH_PREF['jobsch_pictype'] = $tp->toDB($_POST['jobsch_pictype']);
    $JOBSCH_PREF['jobsch_terms'] = $tp->toDB($_POST['jobsch_terms']);
    $JOBSCH_PREF['jobsch_perpage'] = intval($_POST['jobsch_perpage']);
    $JOBSCH_PREF['jobsch_pich'] = intval($_POST['jobsch_pich']);
    $JOBSCH_PREF['jobsch_picw'] = intval($_POST['jobsch_picw']);
    $JOBSCH_PREF['jobsch_currency'] = $tp->toDB($_POST['jobsch_currency']);
    $JOBSCH_PREF['jobsch_metad'] = $tp->toDB($_POST['jobsch_metad']);
    $JOBSCH_PREF['jobsch_metak'] = $tp->toDB($_POST['jobsch_metak']);
    $JOBSCH_PREF['jobsch_icons'] = $tp->toDB($_POST['jobsch_icons']);
    $JOBSCH_PREF['jobsch_thumbheight'] = intval($_POST['jobsch_thumbheight']);
    $JOBSCH_PREF['jobsch_subdrop'] = intval($_POST['jobsch_subdrop']);
    $JOBSCH_PREF['jobsch_subscribe'] = intval($_POST['jobsch_subscribe']);
    $JOBSCH_PREF['jobsch_sysemail'] = $tp->toDB($_POST['jobsch_sysemail']);
    $JOBSCH_PREF['jobsch_sysfrom'] = $tp->toDB($_POST['jobsch_sysfrom']);
    // $JOBSCH_PREF['jobsch_sort'] = $tp->toDB($_POST['jobsch_sort']);
    $JOBSCH_PREF['jobsch_usexp'] = intval($_POST['jobsch_usexp']);
    $JOBSCH_PREF['jobsch_dform'] = $tp->toDB($_POST['jobsch_dform']);
    $JOBSCH_PREF['jobsch_subcats'] = intval($_POST['jobsch_subcats']);
    $JOBSCH_PREF['jobsch_inmenu'] = intval($_POST['jobsch_inmenu']);
    $JOBSCH_PREF['jobsch_inrand'] = intval($_POST['jobsch_inrand']);
    $JOBSCH_PREF['jobsch_vote'] = intval($_POST['jobsch_vote']);
    $JOBSCH_PREF['jobsch_filemax'] = intval($_POST['jobsch_filemax']);

    $JOBSCH_PREF['jobsch_filetypes'] = $tp->toDB($_POST['jobsch_filetypes']);
    $JOBSCH_PREF['jobsch_topmessage'] = $tp->toDB($_POST['jobsch_topmessage']);
    $JOBSCH_PREF['jobsch_reqsalary'] = intval($_POST['jobsch_reqsalary']);
    $JOBSCH_PREF['jobsch_maincat'] = intval($_POST['jobsch_maincat']);
    $JOBSCH_PREF['jobsch_usepm'] = intval($_POST['jobsch_usepm']);
    $jobsch_obj->save_prefs();
    $jobsch_obj->cache_clear();
    $jobsch_msgtext .= JOBSCH_A14 ;
}
if (!$jobsch_obj->check_writable())
{
    $jobsch_msgtext .= "<br />" . JOBSCH_A165;
}
$jobsch_text = "
<form id='dataform' method='post' action='" . e_SELF . "?update'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
$jobsch_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . JOBSCH_A2 . "</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'><strong>$jobsch_msgtext</strong>&nbsp;</td>
		</tr>";

$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A38 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("jobsch_admin", $JOBSCH_PREF['jobsch_admin'], "off", 'nobody, member, main,admin, classes') . "</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A53 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("jobsch_create", $JOBSCH_PREF['jobsch_create'], "off", 'nobody, member,main, admin, classes') . "</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A37 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("jobsch_read", $JOBSCH_PREF['jobsch_read'], "off", 'public,guest, nobody, member, main,admin, classes') . "</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A7 . "</td>
			<td class='forumheader3'>" . r_userclass("jobsch_approval", $JOBSCH_PREF['jobsch_approval'], "off", 'public,guest, nobody, member, main,admin, classes') . "
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A10 . "</td><td class='forumheader3'>
				<input type='text' name='jobsch_valid' class='tbox' value='" . $JOBSCH_PREF['jobsch_valid'] . "' /><br /><i>" . JOBSCH_A11 . "</i>
			</td>
		</tr>";
if ($pref['plug_installed']['vote'] && (file_exists(e_THEME . "vote_jobsearch_template.php") || file_exists(e_PLUGIN . "job_search/templates/vote_jobsearch_template.php")))
{
    $jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A175 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' name='jobsch_vote' value='1'" .
    ($JOBSCH_PREF['jobsch_vote'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";
}
// else
// {
// $jobsch_text .= "
// <tr>
// <td style='width:30%' class='forumheader3'>" . JOBSCH_A175 . "</td>
// <td style='width:70%' class='forumheader3'>" . JOBSCH_A176 . "</td>
// </tr>";
// }
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A131 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("jobsch_subscribe", $JOBSCH_PREF['jobsch_subscribe'], "off", 'nobody, member,main, admin, classes') . "</td>
		</tr>";
 $jobsch_text .= "
 <tr>
 <td style='width:30%' class='forumheader3'>" . JOBSCH_A192 . "</td>
 <td style='width:70%' class='forumheader3'>
 <input type='checkbox' class='tbox' name='jobsch_usepm' value='1'" .
 ($JOBSCH_PREF['jobsch_usepm'] > 0?"checked='checked'":"") . " />
 </td>
 </tr>";
// $jobsch_text .= "
// <tr>
// <td style='width:30%' class='forumheader3'>" . JOBSCH_A154 . "</td>
// <td style='width:70%' class='forumheader3'>
// <input type='checkbox' class='tbox' name='jobsch_usexp' value='1'" .
// ($JOBSCH_PREF['jobsch_usexp'] > 0?"checked='checked'":"") . " />
// </td>
// </tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A39 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' name='jobsch_useremail' value='1'" .
($JOBSCH_PREF['jobsch_useremail'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A113 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' name='jobsch_icons' value='1'" .
($JOBSCH_PREF['jobsch_icons'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";

$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A190 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' name='jobsch_maincat' value='1'" .($JOBSCH_PREF['jobsch_maincat'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A166 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' name='jobsch_subcats' value='1'" .
($JOBSCH_PREF['jobsch_subcats'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A120 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' name='jobsch_subdrop' value='1'" .
($JOBSCH_PREF['jobsch_subdrop'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_148 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' name='jobsch_reqsalary' value='1'" .
($JOBSCH_PREF['jobsch_reqsalary'] > 0?"checked='checked'":"") . " />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . JOBSCH_A40 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select name='jobsch_pictype' class='tbox'>
					<option value='0' " . ($JOBSCH_PREF['jobsch_pictype'] == 0?"selected='selected'":"") . ">" . JOBSCH_A98 . "</option>
					<option value='1' " . ($JOBSCH_PREF['jobsch_pictype'] == 1?"selected='selected'":"") . ">" . JOBSCH_A99 . "</option>
					<option value='2' " . ($JOBSCH_PREF['jobsch_pictype'] == 2?"selected='selected'":"") . ">" . JOBSCH_A100 . "</option>
				</select>
			</td>
		</tr>";
// default sort order
// $jobsch_text .= "
// <tr>
// <td style='width:30%' class='forumheader3'>" . JOBSCH_A153 . "</td>
// <td style='width:70%' class='forumheader3'>
// <select name='jobsch_sort' class='tbox'>
// <option value='ASC' " . ($JOBSCH_PREF['jobsch_sort'] == "ASC"?"selected='selected'":"") . ">" . JOBSCH_A151 . "</option>
// <option value='DESC' " . ($JOBSCH_PREF['jobsch_sort'] == "DESC"?"selected='selected'":"") . ">" . JOBSCH_A152 . "</option>
// </select>
// </td>
// </tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_A95 . "</td><td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='jobsch_currency' value='" . $JOBSCH_PREF['jobsch_currency'] . "' />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_A42 . "</td><td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='jobsch_perpage' value='" . $JOBSCH_PREF['jobsch_perpage'] . "' />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_A109 . "</td><td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='jobsch_inmenu' value='" . $JOBSCH_PREF['jobsch_inmenu'] . "' />
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_A177 . "</td><td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='jobsch_inrand' value='" . $JOBSCH_PREF['jobsch_inrand'] . "' />
			</td>
		</tr>";

$jobsch_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_A188 . "</td><td class='forumheader3'>
				<input class='tbox' style='width:50%;' type='text' name='jobsch_filetypes' value='" . $tp->toFORM($JOBSCH_PREF['jobsch_filetypes']) . "' />
			</td>
		</tr>";

$jobsch_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . JOBSCH_A189 . "</td><td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='jobsch_filemax' value='" . $JOBSCH_PREF['jobsch_filemax'] . "' />
			</td>
		</tr>";

$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A156 . "</td><td class='forumheader3'>
				<select class='tbox' name='jobsch_dform'>
					<option value='d-m-Y' " . ($JOBSCH_PREF['jobsch_dform'] == "d-m-Y" ?"selected='selected'":"") . ">d-m-Y</option>
					<option value='m-d-Y' " . ($JOBSCH_PREF['jobsch_dform'] == "m-d-Y" ?"selected='selected'":"") . ">m-d-Y</option>
					<option value='Y-m-d' " . ($JOBSCH_PREF['jobsch_dform'] == "Y-m-d" ?"selected='selected'":"") . ">Y-m-d</option>
				</select>
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A144 . "</td><td class='forumheader3'>
				<input type='text' name='jobsch_sysemail' style='width:80%' class='tbox' value='" . $JOBSCH_PREF['jobsch_sysemail'] . "' />
			</td>
		</tr>";

$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A143 . "</td><td class='forumheader3'>
				<input type='text' name='jobsch_sysfrom' style='width:80%' class='tbox' value='" . $JOBSCH_PREF['jobsch_sysfrom'] . "' />
			</td>
		</tr>";
// # html area for t&CC
$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A41 . "</td><td class='forumheader3'>";
// <textarea name='jobsch_terms' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $JOBSCH_PREF['jobsch_terms'] . "</textarea></td></tr>";
$insertjs = (!$JOBSCH_PREF['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
"rows='20' style='width:100%' ";
$jobsch_terms = $tp->toForm($JOBSCH_PREF['jobsch_terms']);
$jobsch_text .= "<textarea class='tbox' id='jobsch_terms' name='jobsch_terms' cols='80'  style='width:95%' $insertjs>" . (strstr($jobsch_terms, "[img]http") ? $jobsch_terms : str_replace("[img]../", "[img]", $jobsch_terms)) . "</textarea>";

if (!$JOBSCH_PREF['wysiwyg'])
{
    $jobsch_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
}
// # html area for top message
$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A191 . "</td><td class='forumheader3'>";
// <textarea name='jobsch_terms' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $JOBSCH_PREF['jobsch_terms'] . "</textarea></td></tr>";
$insertjs = (!$JOBSCH_PREF['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
"rows='20' style='width:100%' ";
$jobsch_topmesg = $tp->toForm($JOBSCH_PREF['jobsch_topmessage']);
$jobsch_text .= "<textarea class='tbox' id='jobsch_topmessage' name='jobsch_topmessage' cols='80'  style='width:95%' $insertjs>" . (strstr($jobsch_topmesg, "[img]http") ? $jobsch_topmesg : str_replace("[img]../", "[img]", $jobsch_topmesg)) . "</textarea>";

if (!$JOBSCH_PREF['wysiwyg'])
{
    $jobsch_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
}
// #end html
$jobsch_text .= "
			</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . JOBSCH_A96 . "</td><td class='forumheader3'>
				<textarea name='jobsch_metad' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $JOBSCH_PREF['jobsch_metad'] . "</textarea>
			</td>
		</tr>";
$jobsch_text .= "
		<tr>
			<td class='forumheader3'>" . JOBSCH_A97 . "</td><td class='forumheader3'>
				<textarea name='jobsch_metak' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $JOBSCH_PREF['jobsch_metak'] . "</textarea>
			</td>
		</tr>";

$jobsch_text .= "
		<tr>
			<td class='forumheader' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . JOBSCH_A15 . "' />
			</td>
		</tr>";
$jobsch_text .= "
	</table>
</form>";
$ns->tablerender(JOBSCH_A12, $jobsch_text);
require_once(e_ADMIN . "footer.php");

?>