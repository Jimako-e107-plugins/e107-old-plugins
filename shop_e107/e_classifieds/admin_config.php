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
    header("location:" . e_BASE . "index.php");
    exit;
}

require_once(e_HANDLER.'userclass_class.php');
$e_wysiwyg = "eclassf_terms";
if ($ECLASSF_PREF['wysiwyg']) {
    $WYSIWYG = true;
}
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

require_once(e_HANDLER . "userclass_class.php");
require_once(e_HANDLER . "ren_help.php");
if (!is_readable(e_ADMIN . 'filetypes.php')) {
    $eclassf_msgtext .= '<li>' . ECLASSF_A138 . "</li>";
}
$eclassf_fp = fopen("./images/classifieds/index.htm", "w");
if (!$eclassf_fp) {
    $eclassf_msgtext .= '<li>' . ECLASSF_A139 . "</li>";
}
fclose($eclassf_fp);
if (e_QUERY == "update") {
    // Update rest
    if ($ECLASSF_PREF['eclassf_useseo'] != $_POST['eclassf_useseo']) {
        if ($_POST['eclassf_useseo'] == 1) {
            $result = $eclassf_obj->regen_htaccess('on');
        } else {
            $result = $eclassf_obj->regen_htaccess('off');
        }
        $eclassf_msgtype = 'warning';
        switch ($result) {
            case 1:
                // can't create .htaccess
                $eclassf_msgtext .= '<li>' . RCPEMENU_A149 . '</li>' ;
                break;
            case 2:
                $eclassf_msgtext .= '<li>' . RCPEMENU_A150 . '</li>' ;
                break;
            case 3:
                $eclassf_msgtext .= '<li>' . RCPEMENU_A151 . '</li>' ;
                break;
            case 4:
                $eclassf_msgtext .= '<li>' . RCPEMENU_A152 . '</li>';
                break;
            case 5:
                $eclassf_msgtext .= '<li>' . RCPEMENU_A152 . '</li>';
                break;
            default:
                $eclassf_msgtype = 'success';
                $eclassf_msgtext .= '<li>' . RCPEMENU_A153 . '</li>' ;
        } // switch
    }
    $ECLASSF_PREF['eclassf_useseo'] = intval($_POST['eclassf_useseo']);
    $ECLASSF_PREF['eclassf_email'] = intval($_POST['eclassf_email']);
    $ECLASSF_PREF['eclassf_approval'] = intval($_POST['eclassf_approval']);
    $ECLASSF_PREF['eclassf_valid'] = $tp->toDB($_POST['eclassf_valid']);
    $ECLASSF_PREF['eclassf_read'] = intval($_POST['eclassf_read']);
    $ECLASSF_PREF['eclassf_create'] = intval($_POST['eclassf_create']);
    $ECLASSF_PREF['eclassf_admin'] = intval($_POST['eclassf_admin']);
    $ECLASSF_PREF['eclassf_useremail'] = $tp->toDB($_POST['eclassf_useremail']);
    $ECLASSF_PREF['eclassf_terms'] = $tp->toDB($_POST['eclassf_terms']);
    $ECLASSF_PREF['eclassf_perpage'] = intval($_POST['eclassf_perpage']);
    $ECLASSF_PREF['eclassf_pich'] = $tp->toDB($_POST['eclassf_pich']);
    $ECLASSF_PREF['eclassf_picw'] = $tp->toDB($_POST['eclassf_picw']);
    // $ECLASSF_PREF['eclassf_currency'] = $tp->toDB($_POST['eclassf_currency']);
    $ECLASSF_PREF['eclassf_metad'] = $tp->toDB($_POST['eclassf_metad']);
    $ECLASSF_PREF['eclassf_metak'] = $tp->toDB($_POST['eclassf_metak']);
    $ECLASSF_PREF['eclassf_leadz'] = intval($_POST['eclassf_leadz']);
    $ECLASSF_PREF['eclassf_thumbs'] = $tp->toDB($_POST['eclassf_thumbs']);
    $ECLASSF_PREF['eclassf_icons'] = $tp->toDB($_POST['eclassf_icons']);
    $ECLASSF_PREF['eclassf_counter'] = $tp->toDB($_POST['eclassf_counter']);
    $ECLASSF_PREF['eclassf_thumbheight'] = $tp->toDB($_POST['eclassf_thumbheight']);
    $ECLASSF_PREF['eclassf_subdrop'] = $tp->toDB($_POST['eclassf_subdrop']);
    $ECLASSF_PREF['eclassf_dformat'] = $tp->toDB($_POST['eclassf_dformat']);
    $ECLASSF_PREF['eclassf_userating'] = $tp->toDB($_POST['eclassf_userating']);
    $ECLASSF_PREF['eclassf_maxpic'] = intval($_POST['eclassf_maxpic']);
    $ECLASSF_PREF['eclassf_allowedpic'] = $tp->toDB($_POST['eclassf_allowedpic']);
    $ECLASSF_PREF['eclassf_watermark'] = $tp->toDB($_POST['eclassf_watermark']);
    $eclassf_obj->save_prefs();
    $eclassf_msgtype = 'success';
    $eclassf_msgtext .= '<li>' . ECLASSF_A14 . '</li>';
}
$eclassf_msgtext .= '</ul>';
$eclassf_text = "
<form id='dataform' method='post' action='" . e_SELF . "?update'>
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . ECLASSF_A2 . "</td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>" . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . "</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3'>" . ECLASSF_A152 . "</td>
			<td class='forumheader3'>
				<input type='radio' value='0' class='tbox' style='border:0px;' id='eclassf_useseono' name='eclassf_useseo' " . ($ECLASSF_PREF['eclassf_useseo'] == "0"?"checked='checked'":'') . " /><label for='eclassf_useseono'> " . ECLASSF_A143 . "</label><br />
				<input type='radio' value='1' class='tbox' style='border:0px;' id='eclassf_useseoyes' name='eclassf_useseo' " . ($ECLASSF_PREF['eclassf_useseo'] == "1"?"checked='checked'":'') . " /><label for='eclassf_useseoyes'> " . ECLASSF_A144 . "</label>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3'>" . ECLASSF_A7 . "</td>
			<td class='forumheader3'>
				<input type='radio' value='0' class='tbox' style='border:0px;' id='eclassf_approvalno' name='eclassf_approval' " . ($ECLASSF_PREF['eclassf_approval'] == "0"?"checked='checked'":'') . " /><label for='eclassf_approvalno'> " . ECLASSF_A143 . "</label><br />
				<input type='radio' value='1' class='tbox' style='border:0px;' id='eclassf_approvalyes' name='eclassf_approval' " . ($ECLASSF_PREF['eclassf_approval'] == "1"?"checked='checked'":'') . " /><label for='eclassf_approvalyes'> " . ECLASSF_A144 . "</label>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3'>" . ECLASSF_A10 . "</td><td class='forumheader3'>
				<input type='text' name='eclassf_valid' class='tbox' value='" . $ECLASSF_PREF['eclassf_valid'] . "' /><br /><i>" . ECLASSF_A11 . "</i>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A37 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("eclassf_read", $ECLASSF_PREF['eclassf_read'], "off", 'public,guest, nobody, member,main, admin, classes') . "</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A38 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("eclassf_admin", $ECLASSF_PREF['eclassf_admin'], "off", 'nobody, member, main, admin, classes') . "</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A53 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("eclassf_create", $ECLASSF_PREF['eclassf_create'], "off", 'nobody, member,main, admin, classes') . "</td>
		</tr>";
// date format
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A122 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select class='tbox' name='eclassf_dformat'>
					<option value='d-m-Y' " . ($ECLASSF_PREF['eclassf_dformat'] == "d-m-Y"?"selected='selected'":"") . ">d-m-Y</option>
					<option value='m-d-Y' " . ($ECLASSF_PREF['eclassf_dformat'] == "m-d-Y"?"selected='selected'":"") . ">m-d-Y</option>
					<option value='Y-m-d' " . ($ECLASSF_PREF['eclassf_dformat'] == "Y-m-d"?"selected='selected'":"") . ">Y-m-d</option>
				</select>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A123 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='radio' value='0' class='tbox' style='border:0px;' id='eclassf_useratingno' name='eclassf_userating' " . ($ECLASSF_PREF['eclassf_userating'] == "0"?"checked='checked'":'') . " /><label for='eclassf_useratingno'> " . ECLASSF_A143 . "</label><br />
				<input type='radio' value='1' class='tbox' style='border:0px;' id='eclassf_useratingyes' name='eclassf_userating' " . ($ECLASSF_PREF['eclassf_userating'] == "1"?"checked='checked'":'') . " /><label for='eclassf_useratingyes'> " . ECLASSF_A144 . "</label>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A39 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='radio' value='0' class='tbox' style='border:0px;' id='eclassf_useremailno' name='eclassf_useremail' " . ($ECLASSF_PREF['eclassf_useremail'] == "0"?"checked='checked'":'') . " /><label for='eclassf_useremailno'> " . ECLASSF_A143 . "</label><br />
				<input type='radio' value='1' class='tbox' style='border:0px;' id='eclassf_useremailyes' name='eclassf_useremail' " . ($ECLASSF_PREF['eclassf_useremail'] == "1"?"checked='checked'":'') . " /><label for='eclassf_useremailyes'> " . ECLASSF_A144 . "</label>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A113 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='radio' value='0' class='tbox' style='border:0px;' id='eclassf_iconsno' name='eclassf_icons' " . ($ECLASSF_PREF['eclassf_icons'] == "0"?"checked='checked'":'') . " /><label for='eclassf_iconsno'> " . ECLASSF_A143 . "</label><br />
				<input type='radio' value='1' class='tbox' style='border:0px;' id='eclassf_iconsyes' name='eclassf_icons' " . ($ECLASSF_PREF['eclassf_icons'] == "1"?"checked='checked'":'') . " /><label for='eclassf_iconsyes'> " . ECLASSF_A144 . "</label>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A120 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='radio' value='0' class='tbox' style='border:0px;' id='eclassf_subdropno' name='eclassf_subdrop' " . ($ECLASSF_PREF['eclassf_subdrop'] == "0"?"checked='checked'":'') . " /><label for='eclassf_subdropno'> " . ECLASSF_A143 . "</label><br />
				<input type='radio' value='1' class='tbox' style='border:0px;' id='eclassf_subdropyes' name='eclassf_subdrop' " . ($ECLASSF_PREF['eclassf_subdrop'] == "1"?"checked='checked'":'') . " /><label for='eclassf_subdropyes'> " . ECLASSF_A144 . "</label>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . ECLASSF_A114 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='radio' value='0' class='tbox' style='border:0px;' id='eclassf_thumbsno' name='eclassf_thumbs' " . ($ECLASSF_PREF['eclassf_thumbs'] == "0"?"checked='checked'":'') . " /><label for='eclassf_thumbsno'> " . ECLASSF_A143 . "</label><br />
				<input type='radio' value='1' class='tbox' style='border:0px;' id='eclassf_thumbsyes' name='eclassf_thumbs' " . ($ECLASSF_PREF['eclassf_thumbs'] == "1"?"checked='checked'":'') . " /><label for='eclassf_thumbsyes'> " . ECLASSF_A144 . "</label>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . ECLASSF_A115 . "</td>
			<td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='eclassf_thumbheight' value='" . $ECLASSF_PREF['eclassf_thumbheight'] . "' />
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . ECLASSF_A94 . "</td>
			<td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='eclassf_pich' value='" . $ECLASSF_PREF['eclassf_pich'] . "' />
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . ECLASSF_A153 . "</td>
			<td class='forumheader3'>
				<input class='tbox' style='width:50%;' type='text' name='eclassf_watermark' value='" . $ECLASSF_PREF['eclassf_watermark'] . "' />
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . ECLASSF_A42 . "</td>
			<td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='eclassf_perpage' value='" . $ECLASSF_PREF['eclassf_perpage'] . "' />
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . ECLASSF_A109 . "</td>
			<td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='eclassf_leadz' value='" . $ECLASSF_PREF['eclassf_leadz'] . "' />
			</td>
		</tr>";

$eclassf_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . ECLASSF_A140 . "</td>
			<td class='forumheader3'>
				<input class='tbox' style='width:10%;' type='text' name='eclassf_maxpic' value='" . $ECLASSF_PREF['eclassf_maxpic'] . "' />
			</td>
		</tr>";

$eclassf_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . ECLASSF_A117 . "</td>
			<td class='forumheader3'>
				<select class='tbox' name='eclassf_counter'>
					<option value='NONE' " . ($ECLASSF_PREF['eclassf_counter'] == 'NONE'?"selected='selected'":"") . ">" . ECLASSF_A118 . "</option>
					<option value='ALL' " . ($ECLASSF_PREF['eclassf_counter'] == 'ALL'?"selected='selected'":"") . ">" . ECLASSF_A119 . "</option>
					<option value='cb' " . ($ECLASSF_PREF['eclassf_counter'] == 'cb'?"selected='selected'":"") . ">Coloured Blocks</option>
					<option value='crt' " . ($ECLASSF_PREF['eclassf_counter'] == 'crt'?"selected='selected'":"") . ">CRTs</option>
					<option value='flame' " . ($ECLASSF_PREF['eclassf_counter'] == 'flame'?"selected='selected'":"") . ">Flames</option>
					<option value='floppy' " . ($ECLASSF_PREF['eclassf_counter'] == 'floppy'?"selected='selected'":"") . ">Floppy Disks</option>
					<option value='heart' " . ($ECLASSF_PREF['eclassf_counter'] == 'heart'?"selected='selected'":"") . ">Hearts</option>
					<option value='jelly' " . ($ECLASSF_PREF['eclassf_counter'] == 'jelly'?"selected='selected'":"") . ">Jelly</option>
					<option value='lcd' " . ($ECLASSF_PREF['eclassf_counter'] == 'lcd'?"selected='selected'":"") . ">LCD HP Calculator</option>
					<option value='lcdg' " . ($ECLASSF_PREF['eclassf_counter'] == 'lcdg'?"selected='selected'":"") . ">LED Green</option>
					<option value='purple' " . ($ECLASSF_PREF['eclassf_counter'] == 'purple'?"selected='selected'":"") . ">Purple</option>
					<option value='slant' " . ($ECLASSF_PREF['eclassf_counter'] == 'slant'?"selected='selected'":"") . ">Slant</option>
					<option value='snowm' " . ($ECLASSF_PREF['eclassf_counter'] == 'snowm'?"selected='selected'":"") . ">Snowman</option>
					<option value='text' " . ($ECLASSF_PREF['eclassf_counter'] == 'text'?"selected='selected'":"") . ">Text</option>
					<option value='tree' " . ($ECLASSF_PREF['eclassf_counter'] == 'tree'?"selected='selected'":"") . ">Christmas Tree</option>
					<option value='turf' " . ($ECLASSF_PREF['eclassf_counter'] == 'turf'?"selected='selected'":"") . ">Turf</option>
				</select>
			</td>
		</tr>";
// # html area for t&CC
$eclassf_text .= "
		<tr>
			<td class='forumheader3'>" . ECLASSF_A41 . "</td>
			<td class='forumheader3'>";
// <textarea name='eclassf_terms' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $ECLASSF_PREF['eclassf_terms'] . "</textarea></td></tr>";
$insertjs = (!$ECLASSF_PREF['wysiwyg'])?"rows='10' onselect='storeCaret(this);' onclick='storeCaret(this);' onkeyup='storeCaret(this);'":
"rows='20' style='width:100%' ";
$eclassf_terms = $tp->toForm($ECLASSF_PREF['eclassf_terms']);
$eclassf_text .= "<textarea class='tbox' id='eclassf_terms' name='eclassf_terms' cols='80'  style='width:95%' $insertjs>" . (strstr($eclassf_terms, "[img]http") ? $eclassf_terms : str_replace("[img]../", "[img]", $eclassf_terms)) . "</textarea>";
if (!$ECLASSF_PREF['wysiwyg']) {
    $eclassf_text .= "<input id='helpb' class='helpbox' type='text' name='helpb' size='100' style='width:95%'/>
			<br />" . display_help("helpb");
}
// #end html
$eclassf_text .= "
			</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . ECLASSF_A96 . "</td><td class='forumheader3'>
				<textarea name='eclassf_metad' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $ECLASSF_PREF['eclassf_metad'] . "</textarea>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader3'>" . ECLASSF_A97 . "</td>
			<td class='forumheader3'>
				<textarea name='eclassf_metak' style='width:85%;vertical-align:top;' cols = '100' rows='6' class='tbox' >" . $ECLASSF_PREF['eclassf_metak'] . "</textarea>
			</td>
		</tr>";
$eclassf_text .= "
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . ECLASSF_A15 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>
	</table>
</form>";
$ns->tablerender(ECLASSF_A12, $eclassf_text);
require_once(e_ADMIN . "footer.php");

?>