<?php
/*
   +---------------------------------------------------------------+
   |	Prototype and Scriptaculous Plugin for e107
   |
   |	Copyright (C) Fathr Barry Keal 2003 - 2010
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
include_lan(e_PLUGIN . "prototype/languages/" . e_LANGUAGE . "_prototype.php");

if (!is_object($prototype_obj))
{
	require_once(e_PLUGIN . "prototype/includes/prototype_class.php");
	$prototype_obj = new prototype;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
	define(ADMIN_WIDTH, "width:100%;");
}
if (isset($_POST['savesettings']))
{
	$PROTOTYPE_PREF['prototype_active'] = intval($_POST['prototype_active']);
	$PROTOTYPE_PREF['prototype_mini'] = intval($_POST['prototype_mini']);
//	$PROTOTYPE_PREF['prototype_minicombi'] = intval($_POST['prototype_minicombi']);
	$prototype_obj->save_prefs();
	$prototype_msg_type .= 'success' ;
	$prototype_msg_text .= PROTOTYPE_C05 ;
}
$prototype_text = "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
$prototype_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . PROTOTYPE_C02 . "</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>".$prototype_obj->message_box($prototype_msg_type,$prototype_msg_text)."</td>
		</tr>";

$prototype_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PROTOTYPE_C03 . "</td><td class='forumheader3'>
				<input type='checkbox' name='prototype_active' class='tbox' value='1' " . ($PROTOTYPE_PREF['prototype_active']==1?'checked="checked"':'') . "' />
			</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PROTOTYPE_C08 . "</td>
			<td class='forumheader3'>
				<input type='radio' name='prototype_mini' id='prototype_mini0' class='tbox' value='0' " . ($PROTOTYPE_PREF['prototype_mini']==0?'checked="checked"':'') . "' style='border:0px;' /><label for='prototype_mini0' > ".PROTOTYPE_C09."</label><br />
				<input type='radio' name='prototype_mini' id='prototype_mini1' class='tbox' value='1' " . ($PROTOTYPE_PREF['prototype_mini']==1?'checked="checked"':'') . "' style='border:0px;' /><label for='prototype_mini1' > ".PROTOTYPE_C06."</label><br />
				<input type='radio' name='prototype_mini' id='prototype_mini2' class='tbox' value='2' " . ($PROTOTYPE_PREF['prototype_mini']==2?'checked="checked"':'') . "' style='border:0px;' /><label for='prototype_mini2' > ".PROTOTYPE_C07."</label>
			</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . PROTOTYPE_C04 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>";
$prototype_text .= "
	</table>
</form>";
$ns->tablerender(PROTOTYPE_C01, $prototype_text);
require_once(e_ADMIN . "footer.php");