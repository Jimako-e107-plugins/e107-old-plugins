<?php
/**
*
* @version $Id$
* @copyright Barry Keal 2004 - 2009
* @author Barry Keal
*/
/*
   +---------------------------------------------------------------+
   |        Enhanced Custom Pages for e107 v7xx - by Father Barry
   |
   |        This module for the e107 .7+ website system
   |        Copyright Barry Keal 2004-2009
   |
   |        Released under the terms and conditions of the
   |        GNU General Public License (http://gnu.org).
   |
   +---------------------------------------------------------------+
*/
require_once("../../class2.php");
if (!defined('e107_INIT')) {
    exit;
}
if (!getperms("P")) {
    header("location:" . e_HTTP . "index.php");
    exit;
}

require_once(e_HANDLER . "userclass_class.php");
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH")) {
    define(ADMIN_WIDTH, "width:100%");
}

if (!is_object($cpage_obj)) {
    require_once("includes/cpage_class.php");
    $cpage_obj = new cpage;
}
$cpage_msg_type = 'blank';
$cpage_filedone = file_exists(e_BASE . 'cpage.php');
if (!$cpage_filedone) {
    $cpage_msgtext .= CPAGE_C12 . '<br />' ;
}
if (isset($_POST['cpageupdate'])) {
    // Update all config settings
    $cpage_msgtext = '<ul>';
    foreach($_POST['cpage_cat_name'] as $key => $value) {
        if ($_POST['cpage_del'][$key] == 1) {
            // delete record
            if ($sql->db_Delete('cpage_category', "cpage_cat_id={$key}", false)) {
                $cpage_msg_type = 'success';
                $cpage_msgtext .= '<li>' . CPAGE_CAT10 . ' ' . $_POST['cpage_cat_name'][$key] . ' ' . CPAGE_CAT11 . "<br />";
            } else {
                $cpage_msg_type = 'error';
                $cpage_msgtext .= '<li>' . CPAGE_CAT12 . ' ' . $_POST['cpage_cat_name'][$key] . "</li>";
            }
        } elseif ($key == 0 && !empty($_POST['cpage_cat_name'][0])) {
            // add new record
            if ($sql->db_Insert('cpage_category', "0,'" . $tp->toDB($_POST['cpage_cat_name'][0]) . "'," . $_POST['cpage_cat_order'][0] . ",0", false)) {
                $cpage_msg_type = 'success';
                $cpage_msgtext .= '<li>' . CPAGE_CAT13 . ' ' . $_POST['cpage_cat_name'][0] . "</li>";
            } else {
                $cpage_msg_type = 'error';
                $cpage_msgtext .= '<li>' . CPAGE_CAT14 . ' ' . $_POST['cpage_cat_name'][0] . "<br />";
            }
        } else {
            // update record
            if ($sql->db_Update('cpage_category', "cpage_cat_name='" . $tp->toDB($_POST['cpage_cat_name'][$key]) . "',cpage_cat_order=" . $_POST['cpage_cat_order'][$key] . " where cpage_cat_id={$key}", false)) {
                $cpage_msg_type = 'success';
                $cpage_msgtext .= '<li>' . CPAGE_CAT15 . ' ' . $_POST['cpage_cat_name'][$key] . "</li>";
            }
        }
    }
    $cpage_msgtext .= '</ul>';
}

$cpage_text .= "
<form method='post' action='" . e_SELF . "' id='cpageconf'>
	<table style='" . ADMIN_WIDTH . "'  class='fborder'>
		<tr>
			<td colspan='4' class='fcaption'>" . CPAGE_CAT02 . "</td>
		</tr>
		<tr>
			<td colspan='4' class='forumheader2'>" . $prototype_obj->message_box($cpage_msg_type, $cpage_msgtext) . " </td>
		</tr>
		<tr>
			<td style='width:15%;text-align:right;' class='forumheader3'><b>" . CPAGE_CAT03 . "</b></td>
			<td style='width:55%' class='forumheader3'><b>" . CPAGE_CAT04 . "</b></td>
			<td style='width:15%;text-align:right;' class='forumheader3'><b>" . CPAGE_CAT16 . "</b></td>
			<td style='width:15%;text-align:center;' class='forumheader3'><b>" . CPAGE_CAT05 . "</b></td>
		</tr>";
if ($cpage_numrecs = $sql->db_Select_gen('select cat.*, count(cpage_id) as numrecs from #cpage_category as cat left join #cpage_page on cpage_cat_id=cpage_category GROUP BY cpage_cat_id order by cpage_cat_order,cpage_cat_name', false)) {
    while ($row = $sql->db_Fetch()) {
        $cpage_text .= "
		<tr>
			<td style='text-align:right;' class='forumheader3'>" . $row['cpage_cat_id'] . "</td>
			<td style='' class='forumheader3'>
				<input type='text' class='tbox' style='width:55%' name='cpage_cat_name[" . $row['cpage_cat_id'] . "]' value='" . $tp->toFORM($row['cpage_cat_name']) . "' />
			</td>
			<td style='text-align:right;' class='forumheader3'>
				<select class='tbox'  name='cpage_cat_order[" . $row['cpage_cat_id'] . "]' >";
        for($i = 1;$i <= $cpage_numrecs;$i++) {
            $cpage_text .= "<option value='{$i}' " . ($row['cpage_cat_order'] == $i?'selected="selected"':'') . ">{$i}</option>";
        }
        $cpage_text .= "
				</select>
			</td>
			<td style='text-align:center;' class='forumheader3'>";
        if ($row['numrecs'] > 0) {
            $cpage_text .= CPAGE_CAT09;
        } else {
            $cpage_text .= "
				<input type='checkbox' class='tbox' name='cpage_del[" . $row['cpage_cat_id'] . "]' value='1' />";
        }
        $cpage_text .= "
			</td>
		</tr>";
    }
} else {
    $cpage_text .= "
		<tr>
			<td colspan='4' class='forumheader3'>" . CPAGE_CAT07 . "</td>

		</tr>";
}
// Submit button
$cpage_text .= "
		<tr>
			<td colspan='4' class='forumheader2'><b>" . CPAGE_CAT08 . "</b></td>

		</tr>
		<tr>
			<td style='text-align:right;' class='forumheader3'> </td>
			<td style='' class='forumheader3'>
				<input type='text' class='tbox' style='width:55%' name='cpage_cat_name[0]' value='' /></td>
			<td style='text-align:right;' class='forumheader3'>
			<select class='tbox'  name='cpage_cat_order[0]' >";
for($i = 1;$i <= $cpage_numrecs + 1;$i++) {
    $cpage_text .= "<option value='{$i}' " . (($cpage_numrecs + 1) == $i?'selected="selected"':'') . ">{$i}</option>";
}
$cpage_text .= "
				</select>
				</td>
			<td style='text-align:center;' class='forumheader3'> </td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='4' style='text-align: left;'>
				<input type='submit' name='cpageupdate' value='" . CPAGE_C03 . "' class='button' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='4' style='text-align: left;'>&nbsp;</td>
		</tr>
	</table>
</form>";

$ns->tablerender(CPAGE_CAT01, $cpage_text);

require_once(e_ADMIN . "footer.php");