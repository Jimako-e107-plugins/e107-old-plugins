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
    header('location:' . e_BASE . 'index.php');
    exit;
}
$eplug_js = e_PLUGIN . 'e_classifieds/includes/e_classifieds.js';
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH')) {
    define(ADMIN_WIDTH, 'width:100%;');
}
require_once(e_HANDLER . 'userclass_class.php');

if (!is_object($eclassf_obj)) {
require_once(e_PLUGIN . 'e_classifieds/includes/eclassifieds_class.php');
    $eclassf_obj = new classifieds;
}

$eclassf_msgtype = 'blank';
$eclassf_msgtext = '<ul>';

$eclassf_action = varset($_POST['eclassf_action'], '');
$eclassf_edit = false;
$eclassf_text = '';

if (isset($_POST['one_class_submit']) && ($_POST['single_cat_action'] == "set_single_cat")) { // Update the "single category" values
    if ($ECLASSF_PREF['eclassf_force_main_cat'] != intval($_POST['eclassf_onecat'])) {
        $ECLASSF_PREF['eclassf_force_main_cat'] = intval($_POST['eclassf_onecat']);
        // if ($ECLASSF_PREF['eclassf_force_main_cat'] == 0) $ECLASSF_PREF['eclassf_force_sub_cat'] = 0;		// Zero subcat if no single main cat
        $ECLASSF_PREF['eclassf_force_sub_cat'] = 0; // Zero subcat if main cat changed - it"ll have to be different
        $eclassf_obj->save_prefs();
    	$eclassf_msgtype = 'success';
    	$eclassf_msgtext .= '<li>' . ECLASSF_A129 . '</li>';
    }
}
// * If we are updating then update or insert the record
if ($eclassf_action == 'update') {
    if (empty($_POST['eclassf_catname'])) {
        $eclassf_msgtype = 'validation';
        $eclassf_msgtext .= '<li>' . ECLASSF_A156 . '</li>';
    	$eclassf_action = 'dothings';
    	$_POST['eclassf_selcat']=intval($_POST['eclassf_id']);
    } else {
        $eclassf_id = $_POST['eclassf_id'];
        if ($eclassf_id == 0) {
            // New record so add it
            $eclassf_args = '
		"0",
		"' . $tp->toDB($_POST['eclassf_catname']) . '",
		"' . $tp->toDB($_POST['eclassf_catdesc']) . '",
		"' . $tp->toDB($_POST['eclassf_catclass']) . '",
		"' . $tp->toDB($_POST['eclassf_caticon']) . '"';
            if ($sql->db_Insert('eclassf_cats', $eclassf_args, false)) {
                $eclassf_msgtype = 'success';
                $eclassf_msgtext .= '<li>' . ECLASSF_A28 . '</li>';
            } else {
                $eclassf_msgtype = 'error';
                $eclassf_msgtext .= '<li>' . ECLASSF_A141 . '</li>';
            }
        } else {
            // Update existing
            $eclassf_args = '
		eclassf_catname="' . $tp->toDB($_POST['eclassf_catname']) . '",
		eclassf_catdesc="' . $tp->toDB($_POST['eclassf_catdesc']) . '",
		eclassf_catclass="' . $tp->toDB($_POST['eclassf_catclass']) . '",
		eclassf_caticon="' . $tp->toDB($_POST['eclassf_caticon']) . '"
		where eclassf_catid="' . $eclassf_id . '"';
            if ($sql->db_Update('eclassf_cats', $eclassf_args, false)) {
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
    $eclassf_do = $_POST['eclassf_recdel'];
    $eclassf_dodel = false;
    switch ($eclassf_do) {
        case '1': { // Edit existing record
                // We edit the record
                $sql->db_Select('eclassf_cats', '*', 'where eclassf_catid="' . intval($eclassf_id) . '"','nowhere',false);
                $eclassf_row = $sql->db_Fetch() ;
                extract($eclassf_row);
                $eclassf_edit = true;
                break;
            }
        case '2': { // New category
                // Create new record
                $eclassf_id = 0;
                // set all fields to zero/blank
                $eclassf_edit = true;
                break;
            }
        case '3': {
                // delete the record
                if ($_POST['eclassf_okdel'] == '1') {
                    if ($sql->db_Select('eclassf_subcats', 'eclassf_subid', ' where eclassf_categoryid="' . $eclassf_id . '"', 'nowhere')) {
                    	$eclassf_msgtype = 'warning';
                    	$eclassf_msgtext .= '<li>' . ECLASSF_A29 . '</li>';
                    } else {
                        if ($sql->db_Delete('eclassf_cats', ' eclassf_catid="' . $eclassf_id . '"')) {
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

    if (!$eclassf_dodel) {
        $eclassf_iconlist = '<select name="eclassf_caticon" class="tbox">';
        if ($handle = opendir('./images/icons')) {
            $eclassf_iconlist .= '<option value=""> </option>';
            while (false !== ($file = readdir($handle))) {
                if ($file != '.' && $file != '..') {
                    $eclassf_iconlist .= '<option value="' . $file . '" ' .
                    ($file == $eclassf_caticon ? ' selected="selected" ' : ' ') . '>' . $file . '</option>';
                }
            }

            closedir($handle);
        }
        $eclassf_iconlist .= '</select>';
    	$eclassf_msgtext .= '</ul>';
        $eclassf_text .= '
<form id="myclassupdate" method="post" action="' . e_SELF . '" onsubmit="return eclassf_checkcat()" >
	<div>
		<input type="hidden" value="' . $eclassf_id . '" name="eclassf_id" />
		<input type="hidden" value="update" name="eclassf_action" />
		<input type="hidden" value="'.intval($_POST['eclassf_recdel']).'" name="eclassf_recdel" />
	</div>
	<table style="' . ADMIN_WIDTH . '" class="fborder">
		<tr>
			<td colspan="2" class="fcaption">' . ECLASSF_A17 . '</td>
		</tr>
		<tr>
			<td colspan="2" class="forumheader2">' . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . '</td>
		</tr>
		<tr>
			<td style="width:20%;vertical-align:top;" class="forumheader3">' . ECLASSF_A25 . '</td>
			<td  class="forumheader3"><input type="text" class="tbox" style="width:50%;" maxlength="50" id="eclassf_catname" name="eclassf_catname" value="' . $tp->toFORM($eclassf_catname) . '" /></td>
		</tr>
		<tr>
			<td style="width:20%;vertical-align:top;" class="forumheader3">' . ECLASSF_A26 . '</td>
			<td  class="forumheader3"><textarea rows="6" cols="50" class="tbox" name="eclassf_catdesc" >' . $tp->toFORM($eclassf_catdesc) . '</textarea><br /></td>
		</tr>
		<tr>
			<td style="width:20%;vertical-align:top;" class="forumheader3">' . ECLASSF_A27 . '</td>
			<td style="width:70%" class="forumheader3">' . r_userclass('eclassf_catclass', $eclassf_catclass, 'off', 'public, nobody, member, admin, classes') . '</td>
		</tr>
		<tr>
			<td style="width:20%;vertical-align:top;" class="forumheader3">' . ECLASSF_95 . '</td>
			<td  class="forumheader3">' . $eclassf_iconlist . '</td>
		</tr>
		<tr>
			<td colspan="2" class="forumheader2">
				<input type="submit" name="submits" value="' . ECLASSF_A24 . '" class="button" />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="fcaption">&nbsp;</td>
		</tr>
	</table>
</form>';
    }
}
if (!$eclassf_edit) {
    // Get the category names to display in combo box
    // then display actions available
    $eclassf_yes = false;
    $eclassf_opts = array();
    if ($sql2->db_Select('eclassf_cats', 'eclassf_catid,eclassf_catname', ' order by eclassf_catname', 'nowhere')) {
        $eclassf_yes = true;
        while ($eclassf_row = $sql2->db_Fetch()) {
            $eclassf_opts[$eclassf_row['eclassf_catid']] = $eclassf_row['eclassf_catname'];
        }
    }

    function gen_class_array($optlist, $curval = '', $dropname = 'eclassf_selcat', $addnone = false)
    {
        $ret = '<select name="' . $dropname . '" class="tbox">';
        if ($addnone) {
            $selected = $curval ? ' selected="selected"' : '';
            $ret .= '<option value="0"' . $selected . '>' . ECLASSF_A125 . '</option>';
        }
        if (count($optlist)) {
            foreach ($optlist as $k => $v) {
                $selected = $curval == $k ? ' selected="selected"' : '';
                $ret .= '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
            }
        } else {
            $ret .= '<option value="0">' . ECLASSF_A18 . '</option>';
        }
        $ret .= "</select>";
        return $ret;
    }
	$eclassf_msgtext .= '</ul>';
    $eclassf_text .= '
<form id="myclassform" method="post" action="' . e_SELF . '">
	<div>
		<input type="hidden" value="dothings" name="eclassf_action" />
	</div>
	<table style="' . ADMIN_WIDTH . '" class="fborder">
		<tr>
			<td colspan="2" class="fcaption">' . ECLASSF_A3 . '	</td>
		</tr>
		<tr>
			<td colspan="2" class="forumheader2">' . $prototype_obj->message_box($eclassf_msgtype, $eclassf_msgtext) . '</td>
		</tr>
		<tr>
			<td style="width:20%;" class="forumheader3">' . ECLASSF_A3 . '</td>
			<td  class="forumheader3">' . gen_class_array($eclassf_opts, $eclassf_row['eclassf_catid'], "eclassf_selcat") . '</td>
		</tr>
		<tr>
			<td style="width:20%;" class="forumheader3">' . ECLASSF_A19 . '</td>
			<td  class="forumheader3">
				<input type="radio" name="eclassf_recdel" value="1" ' . ($eclassf_yes?'checked="checked"':'disabled="disabled"') . ' /> ' . ECLASSF_A20 . '<br />
				<input type="radio" name="eclassf_recdel" value="2" ' . (!$eclassf_yes?'checked="checked"':'') . '/> ' . ECLASSF_A21 . '<br />
				<input type="radio" name="eclassf_recdel" value="3" /> ' . ECLASSF_A22 . '
				<input type="checkbox" name="eclassf_okdel" value="1" />' . ECLASSF_A23 . '
			</td>
		</tr>
		<tr>
			<td colspan="2" class="forumheader2" style="text-align:left">
				<input type="submit" name="submits" value="' . ECLASSF_A24 . '" class="button" />
			</td>
		</tr>
				<tr>
			<td colspan="2" class="fcaption" style="text-align:center">
			&nbsp;
			</td>
		</tr>
	</table>
</form>';
    if ($eclassf_yes) { // Allow setting of single category
        $eclassf_text .= '<br /><br />
<form id="singleclassform" method="post" action="' . e_SELF . '">
	<div>
		<input type="hidden" value="set_single_cat" name="single_cat_action" />
	</div>
	<table style="' . ADMIN_WIDTH . '" class="fborder">
		<tr>
			<td colspan="2" class="fcaption">' . ECLASSF_A124 . '	</td>
		</tr>
		<tr>
			<td style="width:20%;" class="forumheader3">' . ECLASSF_A126 . '</td>
			<td  class="forumheader3">' . gen_class_array($eclassf_opts, varset($ECLASSF_PREF['eclassf_force_main_cat'], 0), "eclassf_onecat", true) . '<br /><span class="smalltext"><em>' . ECLASSF_A127 . '</em></span></td>
		</tr>
		<tr>
			<td colspan="2" class="forumheader2" style="text-align:left">
				<input type="submit" name="one_class_submit" value="' . ECLASSF_A128 . '" class="button" />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="fcaption" style="text-align:center">
				&nbsp;
			</td>
		</tr>
	</table>
</form>';
    }
}

$ns->tablerender(ECLASSF_A1, $eclassf_text);
require_once(e_ADMIN . 'footer.php');

?>