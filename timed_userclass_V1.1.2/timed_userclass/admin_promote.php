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
require_once(e_HANDLER . "userclass_class.php");

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

$sql->db_Select("userclass_classes", "userclass_id,userclass_name", "order by userclass_name", "nowhere", false);
while ($tclass_row = $sql->db_Fetch())
{
    $tclass_objlist[$tclass_row['userclass_id']] = $tclass_row['userclass_name'];
} // while



if (isset($_POST['dopromo']))
{
$tclass_text = "
<form method='post' action='" . e_SELF . "' id='dataform'>
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='fcaption' style='width:100%' colspan='5'>" . TCLASS_A16 . "</td>
		</tr>
		<tr>
			<td class='fcaption'  style='width:20%;'>" . TCLASS_A3 . "</td>
			<td class='fcaption'  style='width:15%;'>" . TCLASS_A4 . "</td>
			<td class='fcaption'  style='width:25%;'>" . TCLASS_A5 . "</td>
			<td class='fcaption'  style='width:25%;'>" . TCLASS_A6 . "</td>
			<td class='fcaption'  style='width:15%;'>" . TCLASS_A17 . "</td>
		</tr>

			" . $tclass_obj->do_promote() . "

		<tr>
			<td class='fcaption' style='width:100%' colspan='5' >
				&nbsp;
			</td>
		</tr>

	</table>
</form>";
}
else
{
    $tclass_text = "
<form method='post' action='" . e_SELF . "' id='dataform'>
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='fcaption' style='width:100%' colspan='5'>" . TCLASS_A15 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:100%' colspan='5' >" . TCLASS_A25 . "</td>
		</tr>
		<tr>
			<td class='fcaption'  style='width:20%;'>" . TCLASS_A3 . "</td>
			<td class='fcaption'  style='width:15%;'>" . TCLASS_A4 . "</td>
			<td class='fcaption'  style='width:25%;'>" . TCLASS_A5 . "</td>
			<td class='fcaption'  style='width:25%;'>" . TCLASS_A6 . "</td>
			<td class='fcaption'  style='width:15%;'>" . TCLASS_A17 . "</td>
		</tr>

			" . $tclass_obj->auto_preview() . "

		<tr>
			<td class='fcaption' style='width:100%' colspan='5' >
				<input class='button' type='submit' name='dopromo' value='" . TCLASS_A15 . "' />
			</td>
		</tr>

	</table>
</form>";
}
$ns->tablerender(TCLASS_A1, $tclass_text);
require_once(e_ADMIN . "footer.php");

?>