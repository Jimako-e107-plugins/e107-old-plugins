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
$eclassf_msgtype = 'blank';
$eclassf_msgtext = '<ul>';
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH')) {
    define(ADMIN_WIDTH, "width:100%;");
}
if (!is_object($eclassf_obj)) {
    require_once(e_PLUGIN . "e_classifieds/includes/eclassifieds_class.php");
    $eclassf_obj = new classifieds;
}
// FALSE for normal operation. TRUE shows all ads.
$show_all = true;
$show_all = false;

$eclassf_gen = new convert;
$eclassf_text = '';
require_once(e_HANDLER . "file_class.php");
$eclassf_file = new e_file;
if (isset($_POST['eclassf_action']) && ($_POST['eclassf_action'] == "eclassf_app")) {
    $eclassf_newexpire = time() + ($ECLASSF_PREF['eclassf_valid'] * 86400);
    $eclassf_apparray = $_POST['eclassf_app'];
    $eclassf_msgtype = 'success';
    foreach($eclassf_apparray as $eclassf_element) {
if( $sql->db_Update("eclassf_ads", "eclassf_expires='$eclassf_newexpire' where eclassf_id='$eclassf_element' ")){
	 $eclassf_msgtext .= '<li>' . ECLASSF_A147 . ' ' . $eclassf_element . ' ' . ECLASSF_A151 . '</li>';
}else{
	$eclassf_msgtype = 'warning';
	$eclassf_msgtext .= '<li>' . ECLASSF_A149 . ' ' . $eclassf_element . '</li>';
}
    }
    $eclassf_delarray = $_POST['eclassf_del'];

    foreach($eclassf_delarray as $eclassf_element) {
        $eclassf_element = intval($eclassf_element);

        $eclassf_prefix = "^pic_" . $eclassf_element . "_" . ".";
        // print $eclassf_prefix . " prefix";
        $eclassf_list = $eclassf_file->get_files(e_PLUGIN . "e_classifieds/images/classifieds/" , $eclassf_prefix, "standard", 1);
        $eclassf_numrecs = count($eclassf_list);
        if ($eclassf_numrecs > 0) {
            foreach($eclassf_list as $eclassf_pic) {
                // if there are pics then delete them
                // print $eclassf_pic['fname']. "Deleted <br>";
                unlink("./images/classifieds/" . $eclassf_pic['fname']);
                // $eclassf_thumb = str_replace("pic_", "thumb_", $eclassf_pic['fname']);
                // unlink("./images/classifieds/" . $eclassf_thumb);
                // print $eclassf_thumb. "Deleted <br>";
            }
        }
        // delete advert
        if ($sql->db_Delete("eclassf_ads", "eclassf_cid='$eclassf_element' ")) {
            $eclassf_msgtext .= '<li>' . ECLASSF_A147 . ' ' . $eclassf_element . ' ' . ECLASSF_A146 . '</li>';
        } else {
            $eclassf_msgtype = 'warning';
            $eclassf_msgtext .= '<li>' . ECLASSF_A149 . ' ' . $eclassf_element . '</li>';
        }
        // delete ratings for this advert
        $sql->db_Delete("rate", "rate_table='classifieds' and rate_itemid=$eclassf_element");
        // delete comments for this advert
        $sql->db_Delete("comments", "comment_type='classifieds' and comment_item_id=$eclassf_element");
    }

}

$eclassf_text .= "
<form id='eclassf_qap' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='eclassf_action' value='eclassf_app' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='6'>" . ECLASSF_A101 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='6'>" . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . "</td>
		</tr>
		<tr>
			<td class='forumheader2' style='width:10%;text-align:right;'>" . ECLASSF_A150 . "</td>
			<td class='forumheader2' style='width:30%;'>" . ECLASSF_A85 . "</td>
			<td class='forumheader2' style='width:30%;'>" . ECLASSF_A86 . "</td>
			<td class='forumheader2' style='width:10%;'>" . ECLASSF_A73 . "</td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/approve.png' alt='" . ECLASSF_A83 . "' title='" . ECLASSF_A83 . "' /></td>
			<td class='forumheader2' style='width:10%;text-align:center;'><img src='./images/delete.png' alt='" . ECLASSF_A84 . "' title='" . ECLASSF_A84 . "' /></td>
		</tr>";
$eclassf_today = mktime(0, 0, 0, date("n", time()), date("j", time()), date("Y", time()));

if ($sql->db_Select("eclassf_ads", "*",
        $show_all ? "ORDER BY eclassf_cpdate" : "where eclassf_expires<" . $eclassf_today, "nowhere")) {
    while ($eclassf_row = $sql->db_Fetch()) {
        extract($eclassf_row);
        if ($show_all) $eclassf_cname .= " ({$eclassf_ccat})";
        $eclassf_postname = substr($eclassf_cuser, strpos($eclassf_cuser, ".") + 1);
        $eclassf_expiresdate = $eclassf_gen->convert_date($eclassf_expires, "short");
        $eclassf_text .= "
		<tr>
			<td class='forumheader3' style='text-align:right;'>" . $tp->toHTML($eclassf_id) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($eclassf_name) . "</td>
			<td class='forumheader3'>" . $tp->toHTML($eclassf_desc) . "</td>
			<td class='forumheader3'>" . $eclassf_expiresdate . "&nbsp;</td>
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
			<td class='forumheader3' colspan='6'>" . ECLASSF_A102 . "</td>
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

?>