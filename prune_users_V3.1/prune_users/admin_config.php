<?php
/*
+---------------------------------------------------------------+
|        Prune Inactive Users for e107 v7xx - by Father Barry
|
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once("../../class2.php");

if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "calendar/calendar_class.php");
$prune_cal = new DHTML_Calendar(true);
$prune_text .= $prune_cal->load_files();
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . "prune_users/languages/admin/" . e_LANGUAGE . ".php");
if (e_QUERY == "update")
{
    if ($_POST['prune_days'] > 0)
    {
        // Update rest
        if (intval($_POST['prune_perpage']) == 0)
        {
            $_POST['prune_perpage'] = 50;
        }
        $prune_tmp = explode('-', $_POST['prune_joinbefore']);
        $prune_joinbefore = mktime(0, 0, 0, $prune_tmp[1], $prune_tmp[2], $prune_tmp[0]);
        $prune_tmp = explode('-', $_POST['prune_days']);
        $prune_lastvisit = mktime(0, 0, 0, $prune_tmp[1], $prune_tmp[2], $prune_tmp[0]);
        $pref['prune_auto'] = $_POST['prune_auto']; // Auto not in use yet
        $pref['prune_notify'] = intval($_POST['prune_notify']);
        $pref['prune_days'] = intval($prune_lastvisit);
        $pref['prune_type'] = intval($_POST['prune_type']);
        $pref['prune_threshold'] = intval($_POST['prune_threshold']);
        $pref['prune_action'] = intval($_POST['prune_action']);
        $pref['prune_class'] = intval($_POST['prune_class']);
        $pref['prune_exadmin'] = intval($_POST['prune_exadmin']);
        $pref['prune_joinbefore'] = intval($prune_joinbefore);
        $pref['prune_perpage'] = intval($_POST['prune_perpage']);
        save_prefs();
        $prune_msg .= PRUNE_A22 ;
    }
    else
    {
        $prune_msg .= PRUNE_A11;
    }
}
// calendar options
$prune_cal_options['firstDay'] = 1;
$prune_cal_options['showsTime'] = false;
$prune_cal_options['showOthers'] = false;
$prune_cal_options['weekNumbers'] = false;
$prune_cal_df = '%Y-%m-%d'; //"%" . str_replace("-", "-%", $prune_PREF['articulate_dateform']);
$prune_cal_options['ifFormat'] = $prune_cal_df;
$prune_cal_attrib['class'] = "tbox";
$prune_cal_attrib['name'] = "prune_joinbefore";
$prune_cal_attrib['value'] = ($pref['prune_joinbefore'] > 0?date('Y-m-d', $pref['prune_joinbefore']):"");
$prune_desc = $prune_cal->make_input_field($prune_cal_options, $prune_cal_attrib);

$prune_cal_options['firstDay'] = 1;
$prune_cal_options['showsTime'] = false;
$prune_cal_options['showOthers'] = false;
$prune_cal_options['weekNumbers'] = false;
$prune_cal_df = '%Y-%m-%d'; //"%" . str_replace("-", "-%", $prune_PREF['articulate_dateform']);
$prune_cal_options['ifFormat'] = $prune_cal_df;
$prune_cal_attrib['class'] = "tbox";
$prune_cal_attrib['name'] = "prune_days";
$prune_cal_attrib['value'] = ($pref['prune_days'] > 0?date('Y-m-d', $pref['prune_days']):"");
$prune_last = $prune_cal->make_input_field($prune_cal_options, $prune_cal_attrib);

$prune_text .= "
<form method='post' action='" . e_SELF . "?update' id='pruneuser'>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" . PRUNE_A21 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2'><strong>" . $prune_msg . "</strong>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A64 . " :</td>
			<td class='forumheader3'>$prune_desc</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A2 . " :</td>
			<td class='forumheader3'>{$prune_last}</td>
		</tr>";
$prune_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A16 . " :</td>
			<td class='forumheader3'>
				<input type='radio' name='prune_type' value='0' " . ($pref['prune_type'] == 0?"checked='checked'":"") . " class='tbox' /> " . PRUNE_A17 . "<br />
				<input type='radio' name='prune_type' value='1' " . ($pref['prune_type'] == 1?"checked='checked'":"") . " class='tbox' /> " . PRUNE_A18 . "<br />
				<input type='radio' name='prune_type' value='2' " . ($pref['prune_type'] == 2?"checked='checked'":"") . " class='tbox' /> " . PRUNE_A52 . "<br />
				<input type='radio' name='prune_type' value='3' " . ($pref['prune_type'] == 3?"checked='checked'":"") . " class='tbox' /> " . PRUNE_A53 . "<br />
				<input type='radio' name='prune_type' value='4' " . ($pref['prune_type'] == 4?"checked='checked'":"") . " class='tbox' /> " . PRUNE_A54 . "<br />
				<input type='radio' name='prune_type' value='5' " . ($pref['prune_type'] == 5?"checked='checked'":"") . " class='tbox' /> " . PRUNE_A61 . "<br />
				<input type='radio' name='prune_type' value='6' " . ($pref['prune_type'] == 6?"checked='checked'":"") . " class='tbox' /> " . PRUNE_A65 . "<br />
			</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A55 . " :</td>
			<td class='forumheader3'>
				<input type='text'  class='tbox' name='prune_threshold' value='" . $pref['prune_threshold'] . "' />
			</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A62 . " :</td>
			<td class='forumheader3'>
				<input type='checkbox' class='tbox' name='prune_exadmin' value='1'" . ($pref['prune_exadmin'] == 1?"checked='checked'":"") . "' />
			</td>
		</tr>	";
// Notify by email when deleting
$prune_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A31 . " :</td>
			<td class='forumheader3'>
				<select class='tbox' name='prune_notify'>
					<option value='0' " . ($pref['prune_notify'] == 0?"selected='selected'":"") . " >" . PRUNE_A33 . "</option>
					<option value='1' " . ($pref['prune_notify'] == 1?"selected='selected'":"") . " >" . PRUNE_A32 . "</option>

				</select>
			</td>
		</tr>";
$prune_text .= "
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A25 . " :</td>
			<td class='forumheader3' >
				<select class='tbox' name='prune_action'>
					<option value='0' " . ($pref['prune_action'] == 0?"selected='selected'":"") . " >" . PRUNE_A26 . "</option>
					<option value='1' " . ($pref['prune_action'] == 1?"selected='selected'":"") . " >" . PRUNE_A27 . "</option>
					<option value='2' " . ($pref['prune_action'] == 2?"selected='selected'":"") . " >" . PRUNE_A47 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A49 . " :</td>
			<td class='forumheader3' >" . r_userclass("prune_class", $pref['prune_class'], "off", "nobody,classes") . "</td>
		</tr>
				<tr>
			<td style='width:40%' class='forumheader3'>" . PRUNE_A72 . " :</td>
			<td class='forumheader3'>
				<input type='text'  class='tbox' name='prune_perpage' value='" . $pref['prune_perpage'] . "' />
			</td>
		</tr>";
// Submit
$prune_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align: left;'><input type='submit' name='update' value='" . PRUNE_A38 . "' class='tbox' /></td>
		</tr>
	</table>
</form>";

$ns->tablerender(PRUNE_A1, $prune_text);

require_once(e_ADMIN . "footer.php");

?>