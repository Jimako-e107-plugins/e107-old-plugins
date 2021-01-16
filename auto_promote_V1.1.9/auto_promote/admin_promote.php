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
require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define
    (ADMIN_WIDTH, "width:100%;");
}

require_once(e_PLUGIN . "auto_promote/includes/auto_promote_class.php");
if (!is_object($aprom_obj))
{
    $aprom_obj = new auto_promote;
}

include_lan(e_PLUGIN . "auto_promote/languages/admin/" . e_LANGUAGE . ".php");
$sql->db_Select("userclass_classes", "userclass_id,userclass_name", "order by userclass_name", "nowhere", false);
while ($aprom_row = $sql->db_Fetch())
{
    $aprom_objlist[$aprom_row['userclass_id']] = $aprom_row['userclass_name'];
} // while
if (isset($_POST['dopromo']))
{
    $aprom_text = "
<form method='post' action='" . e_SELF . "' id='dataform'>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' style='width:100%' colspan='6'>" . APROM_A16 . "</td>
		</tr>
		<tr>
			<td class='forumheader2'  style='width:20%;'>" . APROM_A3 . "</td>
			<td class='forumheader2'  style='width:15%;'>" . APROM_A39 . "</td>
			<td class='forumheader2'  style='width:15%;'>" . APROM_A4 . "</td>
			<td class='forumheader2'  style='width:25%;'>" . APROM_A5 . "</td>
			<td class='forumheader2'  style='width:25%;'>" . APROM_A6 . "</td>
			<td class='forumheader2'  style='width:15%;' >" . APROM_A17 . "</td>
		</tr>

			" . $aprom_obj->do_promote() . "

		<tr>
			<td class='fcaption' style='width:100%' colspan='6' >
				&nbsp;
			</td>
		</tr>

	</table>
</form>";
}
else
{
    $aprom_text = "
<form method='post' action='" . e_SELF . "' id='dataform'>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' style='width:100%' colspan='6'>" . APROM_A15 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:100%' colspan='6' >" . APROM_A25 . "</td>
		</tr>
		<tr>
			<td class='forumheader2'  style='width:20%;'><b>" . APROM_A3 . "</b></td>
			<td class='forumheader2'  style='width:10%;text-align:center;'><b>" . APROM_A39 . "</b></td>
			<td class='forumheader2'  style='width:10%;text-align:right;'><b>" . APROM_A4 . "</b></td>
			<td class='forumheader2'  style='width:20%;'><b>" . APROM_A5 . "</b></td>
			<td class='forumheader2'  style='width:20%;'><b>" . APROM_A6 . "</b></td>
			<td class='forumheader2'  style='width:20%;text-align:right;' ><b>" . APROM_A17 . "</b></td>
		</tr>

			" . $aprom_obj->auto_preview() . "

		<tr>
			<td class='forumheader2' style='width:100%' colspan='6' >
				<input class='button' type='submit' name='dopromo' value='" . APROM_A15 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' style='width:100%' colspan='6' >&nbsp;</td>
		</tr>
	</table>
</form>";
}
$ns->tablerender(APROM_A1, $aprom_text,'aprop_prom');
require_once(e_ADMIN . "footer.php");
