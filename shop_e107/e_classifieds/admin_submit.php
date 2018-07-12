<?php
/*
+---------------------------------------------------------------+
|        e_Classifieds Classified advert manager for e107 v7xx - by Father Barry
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
if (!defined('e107_INIT')) {
    exit;
}
if (!getperms("P")) {
    header("location:" . e_HTTP . "index.php");
    exit;
}
$eplug_js = e_PLUGIN . 'e_classifieds/includes/e_classifieds.js';
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH')) {
    define(ADMIN_WIDTH, "width:100%;");
}
if (!is_object($eclassf_obj)) {
    require_once(e_PLUGIN . "e_classifieds/includes/eclassifieds_class.php");

    $eclassf_obj = new classifieds;
}
$eclassf_msgtype = 'blank';
$eclassf_msgtext = '<ul>';
if ($_POST['eclassf_action'] == "eclassf_app") {
    $eclassf_apparray = $_POST['eclassf_app'];
    $eclassf_msgtype = 'success';
    foreach($eclassf_apparray as $eclassf_element) {
        if ($sql->db_Update("eclassf_ads", "eclassf_approved='1' where eclassf_id='$eclassf_element' ")) {
            $eclassf_msgtext .= '<li>' . ECLASSF_A147 . ' ' . $eclassf_element . ' ' . ECLASSF_A145 . ' </li>';
        } else {
            $eclassf_msgtype = 'warning';
            $eclassf_msgtext .= '<li>' . ECLASSF_A148 . ' ' . $eclassf_element . ' </li>';
        }
    }
    $eclassf_delarray = $_POST['eclassf_del'];
    foreach($eclassf_delarray as $eclassf_element) {
        if ($sql->db_Delete("eclassf_ads", "eclassf_id='$eclassf_element' ")) {
            $eclassf_msgtext .= '<li>' . ECLASSF_A147 . ' ' . $eclassf_element . ' ' . ECLASSF_A146 . ' </li>';
        } else {
            $eclassf_msgtype = 'warning';
            $eclassf_msgtext .= '<li>' . ECLASSF_A149 . ' ' . $eclassf_element . ' </li>';
        }
    }
}
$eclassf_msgtext .= '</ul>';
$eclassf_text .= "
<form id='eclassf_qap' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='eclassf_action' value='eclassf_app' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='6'>" . ECLASSF_A82 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='6'>" . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . "</td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:10%;text-align:right;'>" . ECLASSF_A150 . "</td>
			<td class='forumheader2' style='width:30%;'>" . ECLASSF_A85 . "</td>
			<td class='forumheader2' style='width:30%;'>" . ECLASSF_A86 . "</td>
			<td class='forumheader2' style='width:10%;'>" . ECLASSF_A87 . "</td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/approve.png' alt='" . ECLASSF_A83 . "' title='" . ECLASSF_A83 . "' /></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.png' alt='" . ECLASSF_A84 . "' title='" . ECLASSF_A84 . "' /></td>
		</tr>";

if ($sql->db_Select("eclassf_ads", "*", "where eclassf_approved='0'", "nowhere")) {
    while ($eclassf_row = $sql->db_Fetch()) {
        extract($eclassf_row);
        $eclassf_tmp = explode('.', $tp->toFORM($eclassf_user), 2);
        $eclassf_postname = $eclassf_tmp[1];
        $eclassf_text .= "
		<tr>
			<td class='forumheader3' style='text-align:right;'>" . $tp->toHTML($eclassf_id) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($eclassf_name) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($eclassf_desc) . "</td>
			<td class='forumheader3'>$eclassf_postname&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='eclassf_app[]' id='app' value='$eclassf_id' /></td>
			<td class='forumheader3' style='text-align:center;'><input type='checkbox' class='tbox' style='border:0;' name='eclassf_del[]' id='delit' value='$eclassf_id' /></td>
		</tr>";
    } // while
    $eclassf_text .= "
		<tr>
			<td class='forumheader3' colspan='4' style='text-align:center;'>&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAlls' value='" . ECLASSF_A90 . "'onclick=\"eclassf_checkAll('app');\" />
			</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAll' value='" . ECLASSF_A90 . "'onclick=\"eclassf_checkAll('delit');\"  />
			</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='6'><input class='button' type='submit' name='eclassfub_app' value='" . ECLASSF_A88 . "' /></td>
		</tr>
		<tr>
			<td class='fcaption' colspan='6'>&nbsp;</td>
		</tr>		";
} else {
    $eclassf_text .= "
		<tr>
			<td class='forumheader3' colspan='6'>" . ECLASSF_A89 . "</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='6'>&nbsp;</td>
		</tr>";
}
$eclassf_text .= "
	</table>
</form>";

$ns->tablerender(ECLASSF_A1, $eclassf_text);
require_once(e_ADMIN . "footer.php");
