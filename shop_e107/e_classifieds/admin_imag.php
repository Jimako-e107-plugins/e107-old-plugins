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
require_once('../../class2.php');
if (!defined('e107_INIT')) {
    exit;
}
if (!getperms('P')) {
    header('location:' . e_HTTP . 'index.php');
    exit;
}
$eplug_js = e_PLUGIN . 'e_classifieds/includes/e_classifieds.js';
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH')) {
    define(ADMIN_WIDTH, 'width:100%;');
}
if (!is_object($eclassf_obj)) {
    require_once(e_PLUGIN . 'e_classifieds/includes/eclassifieds_class.php');
    $eclassf_obj = new classifieds;
}

$eclassf_msgtype = 'blank';
$eclassf_msgtext = '<ul>';
if ($_POST['eclassf_action'] == 'eclassf_app') {
    $eclassf_msgtype = 'success';
    $eclassf_delarray = $_POST['eclassf_del'];
    foreach($eclassf_delarray as $eclassf_element) {
        if (file_exists('./images/classifieds/' . $eclassf_element)) {
            if (unlink('./images/classifieds/' . $eclassf_element)) {
                $eclassf_msgtext .= '<li>' . $eclassf_element . ' ' . ECLASSF_A146 . '</li>';
            } else {
                $eclassf_msgtype = 'warning';
                $eclassf_msgtext .= '<li>' . ECLASSF_A154 . ' ' . $eclassf_element . '</li>';
            }
        }else {
            $eclassf_msgtype = 'warning';
            $eclassf_msgtext .= '<li>' . $eclassf_element . ' ' . ECLASSF_A155 . '</li>';
        }
    }
    $eclassf_msgtext .= '</ul>';
}
// $eclassf_aj = new textparse();
$eclassf_text .= "
<form id='eclassf_qap' action='" . e_SELF . "' method='post'>
	<div>
		<input type='hidden' name='eclassf_action' value='eclassf_app' />
	</div>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2'>" . ECLASSF_A103 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2'>" . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . "</td>
		</tr>
		";
$eclassf_text .= "
		<tr>
			<td class='forumheader2' style='width:90%;'>" . ECLASSF_A104 . "</td>
			<td class='forumheader2' style='width:10%;text-align:center;'>
				<img src='./images/image_remove.png' alt='" . ECLASSF_A84 . "' title='" . ECLASSF_A84 . "' /></td>
		</tr>";
// make an array containing all the IDs of adverts
$sql->db_Select("eclassf_ads", "eclassf_id", "order by eclassf_id", "nowhere", false);
while ($eclassf_rows = $sql->db_Fetch()) {
    $eclassf_listid[] = $eclassf_rows['eclassf_id'];
} // while
// Get a list of files in directory and see if they are associated with an advert.  If not display in list.
$dir = e_PLUGIN . 'e_classifieds/images/classifieds/';
$eclassf_img = 0;
require_once(e_HANDLER . "file_class.php");
$eclassf_file = new e_file;
$eclassf_prefix = "^pic_.|^thumb_.|^9*.";
$eclassf_list = $eclassf_file->get_files($dir, $eclassf_prefix, "standard", 1);
$eclassf_count = 0;
$eclassf_numrecs = count($eclassf_list);
// print_a($eclassf_list);
if ($eclassf_numrecs > 0) {
    foreach($eclassf_list as $eclassf_row => $key) {
        // print_a($key);
        $fred = explode("_", $key['fname'], 2);
        // print $fred[1]." here<br>";
        if ($fred[0] == 'Thumbs.db' || $fred[0] == 'index.htm' || in_array($fred[1], $eclassf_listid) || in_array($fred[0], $eclassf_listid)) {
        } else {
            $eclassf_img++;
            $eclassf_text .= "
		<tr>
			<td class='forumheader3'>" . $key['fname'] . "</td>
			<td class='forumheader3' style='text-align:center;'>
				<input type='checkbox' class='tbox' style='border:0;' name='eclassf_del[]' id='delit' value='" . $key['fname'] . "' />
			</td>
		</tr>";
        }
    }
}
if ($eclassf_img > 0) {
    $eclassf_text .= "
		<tr>
			<td class='forumheader3' style='text-align:center;'>&nbsp;</td>
			<td class='forumheader3' style='text-align:center;'>
				<input class='button' type='button' name='CheckAll' value='" . ECLASSF_A90 . "'
onclick=\"eclassf_checkAll('delit');\"  /></td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='5'>
				<input class='button' type='submit' name='eclassfub_app' value='" . ECLASSF_A88 . "' />
			</td>
		</tr>
";
}

if ($eclassf_img == 0) {
    $eclassf_text .= "
		<tr>
			<td class='forumheader3' colspan='5'>" . ECLASSF_A105 . "</td>
		</tr>";
}
$eclassf_text .= "
		<tr>
			<td class='fcaption' colspan='5'>&nbsp;</td>
		</tr>
	</table>
</form>";
$ns->tablerender(ECLASSF_A1, $eclassf_text);
require_once(e_ADMIN . "footer.php");