<?php
/*
+---------------------------------------------------------------+
|	Timed Userclass Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2008
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
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_PLUGIN . "timed_userclass/includes/timed_userclass_class.php");
if (!is_object($tclass_obj))
{
    $tclass_obj = new timed_userclass;
}

include_lan(e_PLUGIN . "timed_userclass/languages/admin/" . e_LANGUAGE . ".php");
#print_a($pref);
if (e_QUERY == "update")
{
    // Update rest
    $TCLASS_PREF['tclass_css'] = intval($_POST['tclass_css']);
    $TCLASS_PREF['tclass_emailname'] = $tp->toDB($_POST['tclass_emailname']);
    $TCLASS_PREF['tclass_emailfrom'] = $tp->toDB($_POST['tclass_emailfrom']);
    $TCLASS_PREF['tclass_dateform'] = $tp->toDB($_POST['tclass_dateform']);
    $TCLASS_PREF['tclass_pmfrom'] = intval($_POST['tclass_pmfrom']);
    $TCLASS_PREF['tclass_active'] = intval($_POST['tclass_active']);
    $TCLASS_PREF['tclass_doall'] = intval($_POST['tclass_doall']);
    $TCLASS_PREF['tclass_lastcheck'] = 0;
    $tclass_obj->save_prefs();
    $tclass_msgtext = TCLASS_A34 ;
}

$tclass_text .= "
<form method='post' action='" . e_SELF . "?update' id='dataform'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . TCLASS_A29 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><b>" . $tclass_msgtext . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . TCLASS_A35 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='checkbox' class='tbox' value='1' name='tclass_active' " . ($TCLASS_PREF['tclass_active'] > 0?"checked='checked'":"") . "' />
			</td>
		</tr>";
$tclass_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . TCLASS_A37 . "</td>
			<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='tclass_doall' " . ($TCLASS_PREF['tclass_doall'] > 0?"checked='checked'":"") . "' /></td>
		</tr>";
$tclass_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . TCLASS_A30 . "</td>
			<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='tclass_css' " . ($TCLASS_PREF['tclass_css'] > 0?"checked='checked'":"") . "' /></td>
		</tr>";
$tclass_text .= "
		<tr>
			<td class='forumheader3'>" . TCLASS_A41 . "</td>
			<td class='forumheader3'>
				<select class='tbox' name='tclass_dateform'>
					<option value='d-m-Y-H-M' " . ($tp->toFORM($TCLASS_PREF['tclass_dateform']) == "d-m-Y-H-M" ?"selected='selected'":"") . ">d-m-Y-H-M</option>
					<option value='m-d-Y-H-M' " . ($tp->toFORM($TCLASS_PREF['tclass_dateform']) == "m-d-Y-H-M" ?"selected='selected'":"") . ">m-d-Y-H-M</option>
					<option value='Y-m-d-H-M' " . ($tp->toFORM($TCLASS_PREF['tclass_dateform']) == "Y-m-d-H-M" ?"selected='selected'":"") . ">Y-m-d-H-M</option>
				</select>
			</td>
		</tr>";


$tclass_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . TCLASS_A31 . "</td>
			<td style='width:70%' class='forumheader3'><input type='text' class='tbox' style='width:40%' name='tclass_emailname' value='" . $tp->toFORM($TCLASS_PREF['tclass_emailname']) . "' /></td>
		</tr>";
$tclass_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . TCLASS_A32 . "</td>
			<td style='width:70%' class='forumheader3'><input type='text' class='tbox' style='width:40%' name='tclass_emailfrom' value='" . $tp->toFORM($TCLASS_PREF['tclass_emailfrom']) . "' /></td>
		</tr>";
// Who to send PM as
$tclass_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . TCLASS_A33 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select class='tbox' name='tclass_pmfrom'>";
// Sort out admin/main admin class in selection
if ($sql->db_Select("user", "user_id,user_name", "nowhere", false))
{
    while ($tclass_row = $sql->db_Fetch())
    {
        extract($tclass_row);
        $tclass_text .= "<option value='$user_id' " . ($user_id == $TCLASS_PREF['tclass_pmfrom']?"selected='selected'":"") . ">" . $tp->toFORM($user_name) . "</option>";
    } // while
}
else
{
    $tclass_text .= "<option value='0' >Select admin class and save first</option>";
}
$tclass_text .= "
				</select>
			</td>
		</tr>";
// Submit button
$tclass_text .= "
		<tr>
			<td colspan='2' class='forumheader' style='text-align: left;'><input type='submit' name='update' value='" . TCLASS_A9 . "' class='button' /></td>
		</tr>
	</table>
</form>";

$ns->tablerender(TCLASS_A1, $tclass_text);

require_once(e_ADMIN . "footer.php");

?>