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

require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH')) {
    define(ADMIN_WIDTH, "width:100%;");
}
$eclassf_msgtype = 'blank';
$eclassf_msgtext = '<ul>';

if (!is_object($eclassf_obj)) {
    require_once(e_PLUGIN . "e_classifieds/includes/eclassifieds_class.php");
    $eclassf_obj = new classifieds;
}
$eclassf_action = varset($_POST['eclassf_action'], '');
$eclassf_edit = false;

$eclassf_text = '';

if (isset($_POST['one_class_submit']) && ($_POST['single_cat_action'] == 'set_single_cat')) {
    // Update the 'single category' values
    $ECLASSF_PREF['eclassf_force_sub_cat'] = intval($_POST['eclassf_onecat']);
    $eclassf_obj->save_prefs();
    $eclassf_msgtype = 'success';
    $eclassf_msgtext .= '<li>' . ECLASSF_A130 . '</li>';
}
// * If we are updating then update or insert the record
if ($eclassf_action == 'update') {
    $eclassf_id = $_POST['eclassf_id'];
    if (empty($_POST['eclassf_subname'])) {
    	$eclassf_msgtype = 'validation';
    	$eclassf_msgtext .= '<li>' . ECLASSF_A156 . '</li>';
    	$eclassf_action = 'dothings';
    	$_POST['eclassf_selcat']=intval($_POST['eclassf_id']);


    } else {
        if ($eclassf_id == 0) {
            // New record so add it
            $eclassf_args = "
		'0',
		'" . $tp->toDB($_POST['eclassf_categoryid']) . "',
		'" . $tp->toDB($_POST['eclassf_subname']) . "',
		'" . $tp->toDB($_POST['eclassf_subicon']) . "'";
            if ($sql->db_Insert("eclassf_subcats", $eclassf_args)) {
                $eclassf_msgtype = 'success';
                $eclassf_msgtext .= '<li>' . ECLASSF_A28 . '</li>';
            } else {
                $eclassf_msgtype = 'error';
                $eclassf_msgtext .= '<li>' . ECLASSF_A157 . '</li>';
            }
        } else {
            // Update existing
            $eclassf_args = "
		eclassf_categoryid='" . $tp->toDB($_POST['eclassf_categoryid']) . "',
		eclassf_subname='" . $tp->toDB($_POST['eclassf_subname']) . "',
		eclassf_subicon='" . $tp->toDB($_POST['eclassf_subicon']) . "'

		where eclassf_subid='$eclassf_id'";
            if ($sql->db_Update("eclassf_subcats", $eclassf_args)) {
                // Changes saved
                $eclassf_msgtype = 'success';
                $eclassf_msgtext .= '<li>' . ECLASSF_A28 . '</li>';
            } else {
                $eclassf_msgtype = 'warning';
                $eclassf_msgtext .= '<li>' . ECLASSF_A142 . '</li>';
            }
        }
    }
}
// We are creating, editing or deleting a record
if ($eclassf_action == 'dothings') {
    $eclassf_id = $_POST['eclassf_selcat'];
    $eclassf_id2 = $_POST['eclassf_maincat'];
    $eclassf_do = $_POST['eclassf_recdel'];
    $eclassf_dodel = false;
    switch ($eclassf_do) {
        case '1': { // Edit existing record
                // We edit the record
                $sql->db_Select("eclassf_subcats", "*", "eclassf_subid='$eclassf_id'");
                $eclassf_row = $sql->db_Fetch() ;
                extract($eclassf_row);
                $eclassf_edit = true;
                break;
            }
        case '2': { // New category
                // Create new record
                $eclassf_id = 0;
                // set all fields to zero/blank
                $eclassf_categoryid = $eclassf_id2;
                $eclassf_edit = true;
                break;
            }
        case '3': {
                // delete the record
                if ($_POST['eclassf_okdel'] == '1') {
                    if ($sql->db_Select("eclassf_ads", "eclassf_cid", " where eclassf_ccat='$eclassf_id'", "nowhere")) {
                        $eclassf_msgtype = 'warning';
                        $eclassf_msgtext .= '<li>' . ECLASSF_A29 . '</li>';
                    } else {
                        if ($sql->db_Delete("eclassf_subcats", " eclassf_subid='$eclassf_id'")) {
                            $eclassf_msgtype = 'success';
                            $eclassf_msgtext .= '<li>' . ECLASSF_A30 . '</li>';
                        } else {
                            $eclassf_msgtype = 'error';
                            $eclassf_msgtext .= '<li>' . ECLASSF_A31 . '</li>';
                        }
                    }
                } else {
                    $eclassf_msgtype = 'warning';
                    $eclassf_msgtext .= '<li>' . ECLASSF_A32 . '</li>';
                }

                $eclassf_dodel = true;
                $eclassf_edit = false;
            }
    }

    if (!$eclassf_dodel) { // Get a list of categories
        $sql2->db_Select("eclassf_cats", "eclassf_catid,eclassf_catname", " order by eclassf_catname", "nowhere");
        while ($eclassf_row = $sql2->db_Fetch()) {
            extract($eclassf_row);
            if ($eclassf_main_cat == 0) {
                $eclassf_main_cat = $eclassf_categoryid;
            }
            $eclassf_catopt1 .= "<option value='$eclassf_catid'" .
            ($eclassf_catid == $eclassf_categoryid?" selected='selected'":"") . ">$eclassf_catname</option>";
        }
        $eclassf_iconlist = "<select name='eclassf_subicon' class='tbox'>";
        if ($handle = opendir("./images/icons")) {
            $eclassf_iconlist .= "<option value=\"\"> </option>";
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..")
                    $eclassf_iconlist .= "<option value=\"" . $file . "\" " .
                    ($file == $eclassf_subicon ? " selected='selected' " : " ") . ">" . $file . "</option>";
            }

            closedir($handle);
        }
        $eclassf_iconlist .= "</select>";
        $eclassf_msgtext .= '</ul>';
        $eclassf_text .= "
<form id='eclassfupdate' method='post' action='" . e_SELF . "' onsubmit='return eclassf_checksubcat()'>
	<div>
		<input type='hidden' value='$eclassf_categoryid' name='eclassf_maincat' />
		<input type='hidden' value='$eclassf_id' name='eclassf_id' />
		<input type='hidden' value='update' name='eclassf_action' />
		<input type='hidden' value='".intval($_POST['eclassf_recdel'])."' name='eclassf_recdel' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . ECLASSF_A17 . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'>" . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . "</td>
		</tr>

		<tr>
			<td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_A36 . "</td>
			<td  class='forumheader3'>	<select name='eclassf_categoryid' class='tbox' >$eclassf_catopt1</select></td>
		</tr>
		<tr>
			<td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_A35 . "</td>
			<td  class='forumheader3'><input type='text' class='tbox' style='width:50%' maxlength='50' id='eclassf_subname'  name='eclassf_subname' value='$eclassf_subname' /><br /></td>
		</tr>
		<tr>
			<td style='width:20%;vertical-align:top;' class='forumheader3'>" . ECLASSF_95 . "</td>
			<td  class='forumheader3'>" . $eclassf_iconlist . "</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'><input type='submit' name='submits' value='" . ECLASSF_A24 . "' class='tbox' /></td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";
    }
}
if (!$eclassf_edit) {
    // Get the category names to display in combo box
    // then display actions available
    if ($ECLASSF_PREF['eclassf_force_main_cat']) {
        $eclassf_id2 = $ECLASSF_PREF['eclassf_force_main_cat'];
        $eclassf_main_cat = $ECLASSF_PREF['eclassf_force_main_cat'];
        $filter = " WHERE `eclassf_catid`='" . $eclassf_id2 . "' ";
    } else {
        $eclassf_id2 = varset($_POST['eclassf_maincat'], 0);
        $filter = '';
        if (!$_POST['eclassf_maincat'] > 0) {
            $eclassf_main_cat = 0;
        } else {
            $eclassf_main_cat = $_POST['eclassf_maincat'];
        }
    }
    // Get a list of categories in a drop-down
    $eclassf_catopt1 = '';
    if ($sql2->db_Select("eclassf_cats", "eclassf_catid,eclassf_catname", $filter . " order by eclassf_catname", "nowhere")) {
        while ($eclassf_row = $sql2->db_Fetch()) {
            extract($eclassf_row);
            if ($eclassf_main_cat == 0) {
                $eclassf_main_cat = $eclassf_catid;
            }
            $eclassf_catopt1 .= "<option value='{$eclassf_catid}'" .
            ($eclassf_id2 == $eclassf_catid ? " selected='selected'":"") . ">{$eclassf_catname}</option>";
        }
    } else {
        $eclassf_catopt1 .= "<option value='0'>" . ECLASSF_A18 . "</option>";
    }
    // Now get a list of sub categories in a dropdown
    $eclassf_yes = false;
    $eclassf_opts = array();
    if ($sql2->db_Select("eclassf_subcats", "eclassf_subid,eclassf_categoryid,eclassf_subname", " where eclassf_categoryid='" . $eclassf_main_cat . "' order by eclassf_subname", "nowhere", false)) {
        $eclassf_yes = true;
        while ($eclassf_row = $sql2->db_Fetch()) {
            $eclassf_opts[$eclassf_row['eclassf_subid']] = $eclassf_row['eclassf_subname'];
        }
    }
    function gen_class_array($optlist, $curval = '', $dropname = 'eclassf_selcat', $addnone = false)
    {
        $eclassf_selsubcat = "<select name='{$dropname}' class='tbox'>";
        if ($addnone) {
            $selected = $curval ? " selected='selected'" : "";
            $eclassf_selsubcat .= "<option value='0'{$selected}>" . ECLASSF_A125 . "</option>";
        }
        if (count($optlist)) {
            foreach ($optlist as $k => $v) {
                $selected = $curval == $k ? " selected='selected'" : "";
                $eclassf_selsubcat .= "<option value='{$k}'{$selected}>{$v}</option>";
            }
        } else {
            $eclassf_selsubcat .= "<option value='0'>" . ECLASSF_A18 . "</option>";
        }
        $eclassf_selsubcat .= "</select>";
        return $eclassf_selsubcat;
    }
    $eclassf_msgtext .= '</ul>';
    $eclassf_text .= "
<form id='eclassfform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' id='eclassf_action' value='donothings' name='eclassf_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . ECLASSF_A3 . "	</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'>" . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . "</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . ECLASSF_A3 . "</td>
			<td  class='forumheader3'>";
    if ($ECLASSF_PREF['eclassf_force_main_cat']) {
        $eclassf_text .= $eclassf_catname . "&nbsp;&nbsp;" . ECLASSF_A135; // Only one row will have been found in this mode
    } else {
        $eclassf_text .= "<select name='eclassf_maincat' class='tbox' onchange='this.form.submit()'>$eclassf_catopt1</select>";
    }
    $eclassf_text .= "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>" . ECLASSF_A33 . "</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . ECLASSF_A33 . "</td>
			<td  class='forumheader3'>" . gen_class_array($eclassf_opts, $eclassf_row['eclassf_catid'], 'eclassf_selcat') . "</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . ECLASSF_A19 . "</td>
			<td  class='forumheader3'>
				<input type='radio' name='eclassf_recdel' value='1' " . ($eclassf_yes?"checked='checked'":"disabled='disabled'") . " /> " . ECLASSF_A20 . "<br />
				<input type='radio' name='eclassf_recdel' value='2' " . (!$eclassf_yes?"checked='checked'":"") . "/> " . ECLASSF_A21 . "<br />
				<input type='radio' name='eclassf_recdel' value='3' /> " . ECLASSF_A22 . "
				<input type='checkbox' name='eclassf_okdel' value='1' />" . ECLASSF_A23 . "
			</td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2'>
				<input type='button' name='submits' value='" . ECLASSF_A24 . "' class='tbox' onclick=\"document.getElementById('eclassf_action').value='dothings';this.form.submit()\" />
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption'>&nbsp;</td>
		</tr>
	</table>
</form>";

    if ($eclassf_yes && $ECLASSF_PREF['eclassf_force_main_cat']) { // Allow setting of single sub category
        $eclassf_text .= "
<br /><br />
<form id='singleclassform' method='post' action='" . e_SELF . "'>
	<div>
		<input type='hidden' value='set_single_cat' name='single_cat_action' />
	</div>
	<table style='" . ADMIN_WIDTH . "' class='fborder'>
		<tr>
			<td colspan='2' class='fcaption'>" . ECLASSF_A131 . "</td>
		</tr>
		<tr>
			<td style='width:20%;' class='forumheader3'>" . ECLASSF_A132 . "</td>
			<td  class='forumheader3'>" . gen_class_array($eclassf_opts, varset($ECLASSF_PREF['eclassf_force_sub_cat'], 0), 'eclassf_onecat', true) . "<br /><span class='smalltext'><em>" . ECLASSF_A133 . "</em></span></td>
		</tr>
		<tr>
			<td colspan='2' class='forumheader2' style='text-align:left'>
				<input type='submit' name='one_class_submit' value='" . ECLASSF_A134 . "' class='tbox' />
			</td>
		</tr>
		<tr>
			<td colspan='2' class='fcaption' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>";
    }
}

$ns->tablerender(ECLASSF_A1, $eclassf_text);

require_once(e_ADMIN . "footer.php");