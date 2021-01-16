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
    define(ADMIN_WIDTH, "width:100%;");
}
require_once(e_PLUGIN . "auto_promote/includes/auto_promote_class.php");
if (!is_object($aprom_obj))
{
    $aprom_obj = new auto_promote;
}

include_lan(e_PLUGIN . "auto_promote/languages/admin/" . e_LANGUAGE . ".php");

// If adding
if (!empty($_POST['addnew']))
{
    $sql->db_Insert("aprom", "0,'=',0,0,0,0,0,0", false);
}

// if adding then save or save if saving
if (!empty($_POST['update']) || !empty($_POST['addnew']))
{
    foreach($_POST['aprom_id'] as $aprom_row)
    {
        $aprom_row = intval($aprom_row);
        // print $aprom_row . " row " . $_POST['aprom_basis'][$aprom_row] . " " . $_POST['aprom_level'][$aprom_row] . " " . $_POST['aprom_from'][$aprom_row] . " " . $_POST['aprom_to'][$aprom_row] . " " . $_POST['aprom_notify'][$aprom_row] . " " . $_POST['aprom_delete'][$aprom_row] . "<br />";
        if ($_POST['aprom_delete'][$aprom_row] == 1)
        {
            $sql->db_Delete("aprom", "aprom_id=$aprom_row", false);
        }
        else
        {
            $aprom_method = $tp->toDB($_POST['aprom_method'][$aprom_row]);
            $aprom_basis = intval($_POST['aprom_basis'][$aprom_row]);
            $aprom_level = intval($_POST['aprom_level'][$aprom_row]);
            $aprom_from = intval($_POST['aprom_from'][$aprom_row]);
            $aprom_to = intval($_POST['aprom_to'][$aprom_row]);
            $aprom_order = intval($_POST['aprom_order'][$aprom_row]);
            $aprom_notify = intval($_POST['aprom_notify'][$aprom_row]);
            $sql->db_Update("aprom", "aprom_method='$aprom_method',aprom_basis=$aprom_basis,aprom_level=$aprom_level, aprom_from=$aprom_from,aprom_to=$aprom_to, aprom_notify=$aprom_notify, aprom_order=$aprom_order where aprom_id=$aprom_row", false);
        }
    }
}
$aprom_text .= "
<form method='post' action='" . e_SELF . "?update' id='pruneuser'>
	<table class='fborder' style='".ADMIN_WIDTH."'>
		<tr>
			<td class='fcaption' colspan='8'>" . APROM_A41 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='8'>" . $aprom_msg . "&nbsp;</td>
		</tr>
		<tr>
			<td style='width:20%' class='forumheader2'><strong>" . APROM_A3 . "</strong></td>
			<td style='width:10%' class='forumheader2'><strong>" . APROM_A39 . "</td>
			<td style='width:10%' class='forumheader2'><strong>" . APROM_A4 . "</strong></td>
			<td style='width:15%' class='forumheader2'><strong>" . APROM_A5 . "</strong></td>
			<td style='width:15%' class='forumheader2'><strong>" . APROM_A6 . "</strong></td>
			<td style='width:10%' class='forumheader2'><strong>" . APROM_A2 . "</strong></td>
			<td style='width:10%' class='forumheader2'><strong>" . APROM_A40 . "</strong></td>
			<td style='width:10%' class='forumheader2'><strong>" . APROM_A12 . "</strong></td>
		</tr>";
// Get the existing records
if ($aprom_total=$sql2->db_Select("aprom", "*", "order by aprom_order", "nowhere", false))
{

    while ($aprom_row = $sql2->db_Fetch())
    {
        extract($aprom_row);
        $aprom_text .= "
<tr>
	<td class='forumheader3' >
	<input type='hidden' name='aprom_id[$aprom_id]' value='$aprom_id' />
		<select name='aprom_basis[$aprom_id]' class='tbox' >
			<option value='0' " . ($aprom_basis == 0?"selected='selected'":"") . ">" . APROM_P0 . "</option>
			<option value='1' " . ($aprom_basis == 1?"selected='selected'":"") . ">" . APROM_P1 . "</option>
			<option value='2' " . ($aprom_basis == 2?"selected='selected'":"") . ">" . APROM_P2 . "</option>
			<option value='3' " . ($aprom_basis == 3?"selected='selected'":"") . ">" . APROM_P3 . "</option>
			<option value='6' " . ($aprom_basis == 6?"selected='selected'":"") . ">" . APROM_P6 . "</option>
		</select>
	</td>
	<td class='forumheader3' >
		<select name='aprom_method[$aprom_id]' class='tbox' >
			<option value='&lt;' " . (htmlentities($aprom_method) == '&lt;'?"selected='selected'":"") . ">&lt;&nbsp;&nbsp;</option>
			<option value='&lt;=' " . (htmlentities($aprom_method) == '&lt;='?"selected='selected'":"") . ">&lt;=&nbsp;</option>
			<option value='=' " . (htmlentities($aprom_method) =='='?"selected='selected'":"") . ">=&nbsp;&nbsp;</option>
			<option value='!=' " . (htmlentities($aprom_method) =='!='?"selected='selected'":"") . ">!=&nbsp;</option>
			<option value='&gt;=' " . (htmlentities($aprom_method) == '&gt;='?"selected='selected'":"") . ">&gt;=&nbsp;</option>
			<option value='&gt;' " . (htmlentities($aprom_method) == '&gt;'?"selected='selected'":"") . ">&gt;&nbsp;&nbsp;</option>
		</select>
	</td>
	<td class='forumheader3' >
		<input type='text' class='tbox' name='aprom_level[$aprom_id]' style='width:80%;' value='" . $aprom_level . "' />
	</td>
	<td class='forumheader3' >" . r_userclass("aprom_from[$aprom_id]", $aprom_from, "off", "nobody,classes") . "</td>
	<td class='forumheader3' >" . r_userclass("aprom_to[$aprom_id]", $aprom_to, "off", "nobody,classes") . "</td>
	<td class='forumheader3' >
		<select name='aprom_notify[$aprom_id]' class='tbox' >
			<option value='0' " . ($aprom_notify == 0?"selected='selected'":"") . ">" . APROM_A8 . "</option>
			<option value='1' " . ($aprom_notify == 1?"selected='selected'":"") . ">" . APROM_A26 . "</option>
			<option value='2' " . ($aprom_notify == 2?"selected='selected'":"") . ">" . APROM_A27 . "</option>
		</select>
	</td>
	<td class='forumheader3' >" .$aprom_obj->ap_ordersel($aprom_order, $aprom_id, $aprom_total) . "</td>
	<td class='forumheader3' >
		<input type='checkbox' class='tbox' name='aprom_delete[$aprom_id]'  value='1' />
	</td>
</tr>";
    }
    // } // while
}
else
{
    $aprom_text .= "
		<tr>
			<td class='forumheader3' colspan='8' style='text-align: left;'>" . APROM_A14 . "</td>
		</tr>";
}
// Submit
$aprom_text .= "
		<tr>
			<td class='forumheader2' colspan='8' style='text-align: left;'>
				<input type='submit' name='update' value='" . APROM_A9 . "' class='button' />&nbsp;&nbsp;
				<input type='submit' name='addnew' value='" . APROM_A11 . "' class='button' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='8' style='text-align: left;'>&nbsp;</td>
		</tr>
	</table>
</form>";
$ns->tablerender(APROM_A1, $aprom_text,'aprom_criteria');
require_once(e_ADMIN . "footer.php");
