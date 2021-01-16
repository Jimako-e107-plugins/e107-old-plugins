<?php
/*
+---------------------------------------------------------------+
|	Auto Promote Plugin for e107
|
|	Copyright (C) Father Barry Keal 2003 - 2009
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
if (!is_object($aprom_obj))
{
    require_once(e_PLUGIN . "auto_promote/includes/auto_promote_class.php");

    $aprom_obj = new auto_promote;
}

include_lan(e_PLUGIN . "auto_promote/languages/admin/" . e_LANGUAGE . ".php");

if (e_QUERY == "update")
{
    // Update rest
    $APROM_PREF['aprom_css'] = intval($_POST['aprom_css']);
    $APROM_PREF['aprom_emailname'] = $tp->toDB($_POST['aprom_emailname']);
    $APROM_PREF['aprom_emailfrom'] = $tp->toDB($_POST['aprom_emailfrom']);
    $APROM_PREF['aprom_pmfrom'] = intval($_POST['aprom_pmfrom']);
    $APROM_PREF['aprom_active'] = intval($_POST['aprom_active']);
    $APROM_PREF['aprom_cont'] = intval($_POST['aprom_cont']);
    $APROM_PREF['aprom_last'] = 0;
    $aprom_obj->save_prefs();
    $aprom_msgtext = APROM_A34 ;
}

$aprom_text .= "
<form method='post' action='" . e_SELF . "?update' id='dataform'>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr><td colspan='2' class='fcaption'>" . APROM_A29 . "</td></tr>
		<tr><td colspan='2' class='fcaption'><strong>" . $aprom_msgtext . "</strong>&nbsp;</td></tr>";
$aprom_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . APROM_A35 . "</td>
			<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='aprom_active' " . ($APROM_PREF['aprom_active'] > 0?"checked='checked'":"") . " /></td>
		</tr>";
$aprom_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . APROM_A30 . "</td>
			<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='aprom_css' " . ($APROM_PREF['aprom_css'] > 0?"checked='checked'":"") . " /></td>
		</tr>";
$aprom_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . APROM_A37 . "</td>
			<td style='width:70%' class='forumheader3'><input type='checkbox' class='tbox' value='1' name='aprom_cont' " . ($APROM_PREF['aprom_cont'] > 0?"checked='checked'":"") . " /></td>
		</tr>";
$aprom_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . APROM_A31 . "</td>
			<td style='width:70%' class='forumheader3'><input type='text' class='tbox' style='width:40%' name='aprom_emailname' value='" . $tp->toFORM($APROM_PREF['aprom_emailname']) . "' /></td>
		</tr>";
$aprom_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . APROM_A32 . "</td>
			<td style='width:70%' class='forumheader3'><input type='text' class='tbox' style='width:40%' name='aprom_emailfrom' value='" . $tp->toFORM($APROM_PREF['aprom_emailfrom']) . "' /></td>
		</tr>";
// Who to send PM as
$aprom_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . APROM_A33 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select class='tbox' name='aprom_pmfrom'>";
// Sort out admin/main admin class in selection
if ($sql->db_Select("user", "user_id,user_name", "nowhere", false))
{
    while ($aprom_row = $sql->db_Fetch())
    {
        extract($aprom_row);
        $aprom_text .= "<option value='$user_id' " . ($user_id == $APROM_PREF['aprom_pmfrom']?"selected='selected'":"") . ">" . $tp->toFORM($user_name) . "</option>";
    } // while
}
else
{
    $aprom_text .= "<option value='0' >Select admin class and save first</option>";
}
$aprom_text .= "</select>
			</td>
		</tr>";
// Submit button
$aprom_text .= "
		<tr>
			<td colspan='2' class='forumheader2' style='text-align: left;'><input type='submit' name='update' value='" . APROM_A9 . "' class='button' /></td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption' style='text-align: left;'>&nbsp;</td>
		</tr>
	</table>
</form>";

$ns->tablerender(APROM_A1, $aprom_text,'aprom_conf');

require_once(e_ADMIN . "footer.php");
