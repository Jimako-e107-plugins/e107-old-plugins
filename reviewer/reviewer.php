<?php
/*
+---------------------------------------------------------------+
|        Reviewer Plugin for e107 v7xx - by Father Barry
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
include_lan(e_PLUGIN . "reviewer/languages/" . e_LANGUAGE . ".php");
require_once(e_HANDLER . "ren_help.php");
define("e_WYSIWYG", false);
require_once(e_PLUGIN . "reviewer/includes/reviewer_class.php");
if (!is_object($reviewer_obj)) {
    $reviewer_obj = new reviewer;
}
if (!is_object($reviewer_secimg)) {
    $reviewer_secimg = new secure_image;
}
global $tp, $sql, $e107cache, $REVIEWER_PREF;
// define(e_PAGETITLE, REVIEWER_PAGETITLE);
require_once(e_HANDLER . "comment_class.php");
$reviewer_cobj = new comment;
$reviewer_docomment = 0;
// require_once(HEADERF);
require_once(e_HANDLER . "cache_handler.php");
require_once(e_PLUGIN . "reviewer/includes/reviewer_shortcodes.php");
if (file_exists(e_THEME . "reviewer_template.php")) {
    define(REVIEWER_TEMPLATE, e_THEME . "reviewer_template.php");
} else {
    define(REVIEWER_TEMPLATE, "./templates/reviewer_template.php");
}
$reviewer_from = 0;
$reviewer_action = "list";
// print_a($_COOKIE);
$reviewer_cat = $_COOKIE['reviewer_cat'];
$reviewer_agreed = $_COOKIE['reviewer_agreed'];
// setcookie('reviewer_agreed', "0");
if ($reviewer_cat == 0) {
    $reviewer_cat = $REVIEWER_PREF['reviewer_defcat'];
}
if (isset($_POST['reviewer_cat'])) {
    $reviewer_cat = intval($_POST['reviewer_cat']);
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $reviewer_from = intval($_POST['reviewer_from']);
    $reviewer_action = $_POST['reviewer_action'];
    $reviewer_itemid = intval($_POST['reviewer_itemid']);
} elseif (e_QUERY) {
    $tmp = explode(".", e_QUERY);
    $reviewer_from = intval($tmp[0]);
    $reviewer_action = $tmp[1];
    $reviewer_itemid = intval($tmp[2]);
    $reviewer_cat = intval($tmp[3]);
    // $reviewer_cat = intval($tmp[3]);
}
if ($reviewer_cat == 0) {
    $reviewer_cat = $REVIEWER_PREF['reviewer_defcat'];
}
setcookie('reviewer_cat', $reviewer_cat);

if (isset($_POST['commentsubmit'])) {
    $tmp = explode(".", e_QUERY);
    $reviewer_from = intval($tmp[0]);
    $reviewer_itemid = intval($tmp[2]);
    $reviewer_cobj->enter_comment($_POST['author_name'], $_POST['comment'], "reviewer", $reviewer_itemid, $pid, $_POST['subject']);
    $reviewer_action = "view";
    unset($_POST['commentsubmit']);
    $reviewer_obj->clear_cache();
}
if (!USER) {
    // not a member so it is from the input field
    $reviewer_ip = str_replace(".", "~", $e107->getip());
    $reviewer_postername = $reviewer_ip . "." . $_POST['reviewer_reviewer_postername'] . " " . REVIEWER_V013;
} else {
    // A member
    $reviewer_postername = USERID . "." . USERNAME;
}
if ($reviewer_action == "agreed") {
    setcookie('reviewer_agreed', "1");
    $reviewer_agreed = 1;
    $reviewer_action = "list";
}
if ($REVIEWER_PREF['reviewer_disclaimer'] == 1 && $reviewer_agreed != 1) {
    require_once(REVIEWER_TEMPLATE);
    $reviewer_text .= $tp->parsetemplate($REVIEWER_TC, false, $reviewer_shortcodes);
    $reviewer_action = "agreed";
} elseif (empty($reviewer_action)) {
    $reviewer_action = "list";
}
if (isset($_POST['reviewer_upfile'])) {
    require_once(e_HANDLER . 'upload_handler.php');
    $uploaddir = e_PLUGIN . 'reviewer/images/itempics';
    $fileinfo = 'prefix+' . USERID . '_';
    $options['overwrite'] = true;
    $options['max_file_count'] = 1;
    $revieweer_error = process_uploaded_files($uploaddir, $fileinfo, $options);
    $reviewer_msg .= $revieweer_error[0]['message'];
    $reviewer_action = "reedit";
}

if (isset($_POST['reviewer_save'])) {
    if ($reviewer_obj->reviewer_admin) {
        // if admin then use checkbox setting
        $_POST['reviewer_items_approved'] = intval($_POST['reviewer_items_approved']);
    } elseif ($reviewer_obj->reviewer_auto) {
        // auto approve
        $_POST['reviewer_items_approved'] = 1;
        $reviewer_msg = REVIEWER_H023 . '. ';
    } elseif (!$reviewer_obj->reviewer_auto) {
        // not auto approve class
        $_POST['reviewer_items_approved'] = 0;
        $reviewer_msg = REVIEWER_H024 . '. ';
    }
    if (empty($_POST['reviewer_items_name']) || empty($_POST['reviewer_items_description'])) {
        $reviewer_msg = REVIEWER_AI038 . '. ';
        $reviewer_action = "reedit";
    } else {
        if ($reviewer_itemid == 0) {
            // if we are adding a record then check if same name exists
            if ($sql->db_Select("reviewer_items", "reviewer_items_name", "where reviewer_items_name='" . $tp->toDB($_POST['reviewer_items_name']) . "'", "nowhere", false)) {
                // yes so don't add just give error message
                $reviewer_msg = REVIEWER_AI017 . "<br />";
            } else {
                // no so add it
                // $sql->db_Insert("reviewer_items", "0,'" . $tp->toDB($_POST['newitem']) . "','',0," . $reviewer_current . ",'',0,0,0,0,0,0,0,0", true);
                $reviewer_msg .= REVIEWER_AI016 . "<br />";
                $reviewer_itemid = $sql->db_Insert("reviewer_items", "
		0,
		'" . $tp->toDB($_POST['reviewer_items_name']) . "',
		'" . $tp->toDB($_POST['reviewer_items_description']) . "',
		'" . time() . "',
		'" . intval($_POST['reviewer_items_catid']) . "',
		'" . $tp->toDB($_POST['reviewer_items_url']) . "',
		0,0,0,0,0,0,0,0,0,0,0,0,0,
		'" . $tp->toDB($_POST['reviewer_items_picture']) . "'," . intval($_POST['reviewer_items_approved']) . "," . USERID, false);
                $edata_cb['user'] = $_POST['reviewer_items_name'];
                $edata_cb['itemtitle'] = $_POST['reviewer_items_name'];
                $edata_cb['itemdesc'] = $_POST['reviewer_items_description'];
                $edata_cb['user'] = USERNAME;
                $e_event->trigger("reviewer_newitem", $edata_cb);
            }
        } else {
            // do an update
            $sql->db_Update("reviewer_items", "
		reviewer_items_name='" . $tp->toDB($_POST['reviewer_items_name']) . "',
		reviewer_items_description='" . $tp->toDB($_POST['reviewer_items_description']) . "',
		reviewer_items_updated=" . time() . ",
		reviewer_items_catid=" . intval($_POST['reviewer_items_catid']) . ",
		reviewer_items_url='" . $tp->toDB($_POST['reviewer_items_url']) . "',
		reviewer_items_approved='" . intval($_POST['reviewer_items_approved']) . "',
		reviewer_items_picture='" . $tp->toDB($_POST['reviewer_items_picture']) . "' where reviewer_items_id=$reviewer_itemid", false);
            $reviewer_msg .= REVIEWER_AI019;
            $edata_cb['itemtitle'] = $_POST['reviewer_items_name'];
            $edata_cb['itemdesc'] = $_POST['reviewer_items_description'];
            $edata_cb['user'] = USERNAME;
            $e_event->trigger("reviewer_edititem", $edata_cb);
        }
        $reviewer_action = "list";
    }

    $reviewer_obj->clear_cache();
}
// check if submitting a new review item
if ($reviewer_obj->reviewer_create && ($reviewer_action == 'create' || $reviewer_action == 'reedit' || $reviewer_action == 'edit')) {
    if ($reviewer_action == 'edit') {
        $sql->db_Select('reviewer_items', '*', 'where reviewer_items_id=' . $reviewer_itemid, 'nowhere', false);
        extract($sql->db_Fetch());
    }
    if ($reviewer_action == 'reedit') {
        $reviewer_items_name = $_POST['reviewer_items_name'];
        $reviewer_items_approved = $_POST['reviewer_items_approved'];
        $reviewer_items_url = $_POST['reviewer_items_url'];
        $reviewer_items_description = $_POST['reviewer_items_description'];
        $reviewer_items_picture = $_POST['reviewer_items_picture'];
    }
    require_once(REVIEWER_TEMPLATE);
    $reviewer_catlist = "<select class='tbox' name='reviewer_items_catid' >";
    $sql->db_Select("reviewer_category", "reviewer_category_id,reviewer_category_name", "order by reviewer_category_name", "nowhere", false);
    while ($reviewer_row = $sql->db_Fetch()) {
        $reviewer_catlist .= "<option value='" . $reviewer_row['reviewer_category_id'] . "' " . ($reviewer_row['reviewer_category_id'] == $reviewer_items_catid?"selected='selected'":"") . ">" . $tp->toFORM($reviewer_row['reviewer_category_name']) . "</option>";
    }
    $reviewer_catlist .= "</select>";
    $reviewer_piclist = "<select class='tbox' name='reviewer_items_picture'>";
    $reviewer_piclist .= "<option value=''>" . REVIEWER_AI021 . "</option>";
    foreach (glob("./images/itempics/*.*") as $filename) {
        $filename = basename($filename);
        $reviewer_piclist .= "<option value='" . $filename . "' " . ($reviewer_items_picture == $filename?"selected='selected'":"") . " >$filename</option>";
    }
    $reviewer_piclist .= "</select>";
    $reviewer_text .= "<form  enctype='multipart/form-data' method='post' action='" . e_SELF . "' id='dataform' >
	<div>
		<input type='hidden' name='reviewer_itemid' value='{$reviewer_itemid}' />
	</div>";
    $reviewer_text .= $tp->parsetemplate($REVIEWER_SUBMITNEW, true, $reviewer_shortcodes);
    $reviewer_text .= "</form>";
    $reviewer_action = "";
}
if (isset($_POST['reviewer_confirmdelete']) && $reviewer_obj->reviewer_admin) {
    // delete things
    $sql->db_Delete("reviewer_reviewer", "reviewer_reviewer_id=$reviewer_itemid", false);
    $sql->db_Delete("comments", "comment_item_id=$reviewer_itemid and comment_type='reviewer'", false);
    // go back to listing the item and remaining views
    $reviewer_obj->recalc_all();
    $reviewer_obj->clear_cache();
    $reviewer_action = "list";
    $reviewer_itemid = intval($_POST['reviewer_viewid']);
}
if (isset($_POST['reviewer_canceldelete']) && $reviewer_obj->reviewer_admin) {
    // we cancelled the deletion
    $reviewer_action = "view";
}
if ($reviewer_action == "deleterev" && $reviewer_obj->reviewer_admin) {
    // confirm delete
    $sql->db_Select("reviewer_reviewer", "reviewer_reviewer_itemid", "where reviewer_reviewer_id=$reviewer_itemid", "nowhere", false);
    extract($sql->db_Fetch());
    $reviewer_confirm_updir = "<a href='" . e_SELF . "?$reviewer_from.view.$reviewer_itemid' ><img src='images/updir.png' alt='" . REVIEWER_H020 . "' title='" . REVIEWER_H020 . "' /></a>";
    $reviewer_confirmdelete = "<input type='submit' class='button' name='reviewer_confirmdelete' value='" . REVIEWER_H016 . "' />";
    $reviewer_canceldelete = "<input type='submit' class='button' name='reviewer_canceldelete' value='" . REVIEWER_H017 . "' />";
    require_once(REVIEWER_TEMPLATE);
    $reviewer_text .= "<form method='post' action='" . e_SELF . "' id='reviewer_confirm' >
		<div>
		<input type='hidden' name='reviewer_itemid' value='" . $reviewer_itemid . "' />
		</div>";
    $reviewer_text .= $tp->parsetemplate($REVIEWER_CONFIRM_DELETE, false, $reviewer_shortcodes);
    $reviewer_text .= "</form>";
}
if (isset($_POST['submitrev']) && ($reviewer_obj->reviewer_creator || $reviewer_obj->reviewer_admin)) {
    $reviewer_reviewer_postername = $reviewer_postername;
    // check if user
    if (empty($_POST['reviewer_reviewer_review']) || (!USER && empty($_POST['reviewer_reviewer_postername']))) {
        $reviewer_invalid = REVIEWER_H009;
        // $reviewer_action = "add" ;
    } else {
        if ((!USER && $REVIEWER_PREF['reviewer_captcha'] > 0) && (!$reviewer_secimg->verify_code($_POST['reviewer_rand_num'], $_POST['reviewer_code_verify']))) {
            // invalid captcha
            $reviewer_invalid = REVIEWER_H008;
            $reviewer_action = "add" ;
        } else {
            if ($reviewer_action == "add") {
                if (!$sql->db_Select("reviewer_reviewer", "reviewer_reviewer_id", "where reviewer_reviewer_postername='$reviewer_reviewer_postername' and reviewer_reviewer_itemid=$reviewer_itemid", "nowhere", false)) {
                    // check for duplicate
                    $reviewer_itemsid = $sql->db_Insert("reviewer_reviewer", "
		0,
		'" . $tp->toDB($reviewer_reviewer_postername) . "',
		'" . intval($reviewer_itemid) . "',
		'" . time() . "',
		'" . $tp->toDB($_POST['reviewer_reviewer_review']) . "',
		'" . intval($_POST['reviewer_reviewer_rate1']) . "',
		'" . intval($_POST['reviewer_reviewer_rate2']) . "',
		'" . intval($_POST['reviewer_reviewer_rate3']) . "',
		'" . intval($_POST['reviewer_reviewer_rate4']) . "',
		'" . intval($_POST['reviewer_reviewer_rate5']) . "',
		'" . intval($_POST['reviewer_reviewer_rate6']) . "',
		'" . intval($_POST['reviewer_reviewer_rate7']) . "',
		'" . intval($_POST['reviewer_reviewer_rate8']) . "',
		'" . intval($_POST['reviewer_reviewer_rate9']) . "',
		'" . intval($_POST['reviewer_reviewer_rate10']) . "',
		'" . $tp->toDB($_POST['reviewer_reviewer_email']) . "'", false);
                    $reviewer_upid = $reviewer_itemid;
                    $reviewer_msg = REVIEWER_V010;
                    $reviewer_arg = "select reviewer_category_name,reviewer_items_name from #reviewer_items
            left join #reviewer_category on reviewer_items_catid=reviewer_category_id
            where reviewer_items_id={$reviewer_itemid}";
                    $sql->db_Select_gen($reviewer_arg, false);
                    $reviewer_row = $sql->db_Fetch();
                    $reviewer_tmp = explode(".", $reviewer_postername, 2);
                    $reviewer_data['user'] = $reviewer_tmp[1];
                    $reviewer_data['itemtitle'] = $tp->toDB($_POST['reviewer_reviewer_review']);
                    $reviewer_data['catname'] = $tp->toFORM($reviewer_row['reviewer_category_name']);
                    $reviewer_data['itemname'] = $tp->toFORM($reviewer_row['reviewer_items_name']);
                    $e_event->trigger("reviewer", $reviewer_data);
                } else {
                    $reviewer_msg = REVIEWER_V011;
                }
            } else {
                $sql->db_Update("reviewer_reviewer",
                    "reviewer_reviewer_review='" . $tp->toDB($_POST['reviewer_reviewer_review']) . "',
		reviewer_reviewer_rate1='" . intval($_POST['reviewer_reviewer_rate1']) . "',
		reviewer_reviewer_rate2='" . intval($_POST['reviewer_reviewer_rate2']) . "',
		reviewer_reviewer_rate3='" . intval($_POST['reviewer_reviewer_rate3']) . "',
		reviewer_reviewer_rate4='" . intval($_POST['reviewer_reviewer_rate4']) . "',
		reviewer_reviewer_rate5='" . intval($_POST['reviewer_reviewer_rate5']) . "',
		reviewer_reviewer_rate6='" . intval($_POST['reviewer_reviewer_rate6']) . "',
		reviewer_reviewer_rate7='" . intval($_POST['reviewer_reviewer_rate7']) . "',
		reviewer_reviewer_rate8='" . intval($_POST['reviewer_reviewer_rate8']) . "',
		reviewer_reviewer_rate9='" . intval($_POST['reviewer_reviewer_rate9']) . "',
		reviewer_reviewer_rate10='" . intval($_POST['reviewer_reviewer_rate10']) . "',
		reviewer_reviewer_email='" . $tp->toDB($_POST['reviewer_reviewer_email']) . "'
		where reviewer_reviewer_id=$reviewer_itemid", false);
                $reviewer_upid = intval($_POST['reviewer_reviewer_itemid']);
                $reviewer_msg .= REVIEWER_V007;
                $reviewer_arg = "select reviewer_category_name,reviewer_items_name from #reviewer_items
            left join #reviewer_category on reviewer_items_catid=reviewer_category_id
            where reviewer_items_id={$reviewer_upid}";
                $sql->db_Select_gen($reviewer_arg, false);
                $reviewer_row = $sql->db_Fetch();
                $reviewer_tmp = explode(".", $reviewer_postername, 2);
                $reviewer_data['user'] = $reviewer_tmp[1];
                $reviewer_data['itemtitle'] = $tp->toDB($_POST['reviewer_reviewer_review']);
                $reviewer_data['catname'] = $tp->toFORM($reviewer_row['reviewer_category_name']);
                $reviewer_data['itemname'] = $tp->toFORM($reviewer_row['reviewer_items_name']);
                $e_event->trigger("editreviewer", $reviewer_data);
                $reviewer_itemid = intval($_POST['reviewer_reviewer_itemid']);
            }

            if ($reviewer_upid > 0) {
                // added or saved to recalc the review totals
                $reviewer_obj->update_item($reviewer_upid);
            }
            $reviewer_obj->clear_cache();
        }
        $reviewer_action = "item";
    }
}
// if we are adding and we are a creator or admin
// or if we are editing and we are and admin or allow own is active
if (($reviewer_action == "add" && ($reviewer_obj->reviewer_creator || $reviewer_obj->reviewer_admin)) || ($reviewer_action == "editrev" && USER && ($reviewer_obj->reviewer_admin || $reviewer_obj->reviewer_editown))) {
    if ($reviewer_action == "add") {
        $reviewer_arg = "select * from #reviewer_items
    left join #reviewer_category on reviewer_items_catid=reviewer_category_id
where reviewer_items_id={$reviewer_itemid}";
        $sql->db_Select_gen($reviewer_arg, false);
        extract($sql->db_Fetch());
    } else {
        // editing
        $reviewer_arg = "select * from #reviewer_reviewer
    left join #reviewer_items on reviewer_reviewer_itemid = reviewer_items_id
    left join #reviewer_category on reviewer_items_catid=reviewer_category_id
where reviewer_reviewer_id={$reviewer_itemid}
order by reviewer_reviewer_posted";
        $sql->db_Select_gen($reviewer_arg, false);
        extract($sql->db_Fetch());
    }
    if ($REVIEWER_PREF['reviewer_usecat'] == 1) {
        $reviewer_use1 = $reviewer_category_use1;
        $reviewer_use2 = $reviewer_category_use2;
        $reviewer_use3 = $reviewer_category_use3;
        $reviewer_use4 = $reviewer_category_use4;
        $reviewer_use5 = $reviewer_category_use5;
        $reviewer_use6 = $reviewer_category_use6;
        $reviewer_use7 = $reviewer_category_use7;
        $reviewer_use8 = $reviewer_category_use8;
        $reviewer_use9 = $reviewer_category_use9;
        $reviewer_use10 = $reviewer_category_use10;
    } else {
        // not using category then get the settings from prefs
        $reviewer_use1 = $REVIEWER_PREF['reviewer_use1'];
        $reviewer_use2 = $REVIEWER_PREF['reviewer_use2'];
        $reviewer_use3 = $REVIEWER_PREF['reviewer_use3'];
        $reviewer_use4 = $REVIEWER_PREF['reviewer_use4'];
        $reviewer_use5 = $REVIEWER_PREF['reviewer_use5'];
        $reviewer_use6 = $REVIEWER_PREF['reviewer_use6'];
        $reviewer_use7 = $REVIEWER_PREF['reviewer_use7'];
        $reviewer_use8 = $REVIEWER_PREF['reviewer_use8'];
        $reviewer_use9 = $REVIEWER_PREF['reviewer_use9'];
        $reviewer_use10 = $REVIEWER_PREF['reviewer_use10'];
    }

    if ($reviewer_action == "add") {
        $reviewer_reviewer_review = "";
        $reviewer_reviewer_rate1 = 5;
        $reviewer_reviewer_rate2 = 5;
        $reviewer_reviewer_rate3 = 5;
        $reviewer_reviewer_rate4 = 5;
        $reviewer_reviewer_rate5 = 5;
        $reviewer_reviewer_rate6 = 5;
        $reviewer_reviewer_rate7 = 5;
        $reviewer_reviewer_rate8 = 5;
        $reviewer_reviewer_rate9 = 5;
        $reviewer_reviewer_rate10 = 5;
        $reviewer_reviewer_posted = time();
        $sql->db_Select("reviewer_items", "reviewer_items_name,reviewer_items_description", "where reviewer_items_id=$reviewer_itemid", "nowhere", false);
    } else {
        // get the item details for the header
        $sql->db_Select_gen("select  reviewer_items_name,reviewer_items_description from #reviewer_items
    left join #reviewer_reviewer on  reviewer_reviewer_itemid = reviewer_items_id
	where reviewer_reviewer_id=$reviewer_itemid", false);
    }
    extract($sql->db_Fetch());
    define(e_PAGETITLE, REVIEWER_P003 . $reviewer_items_name);
    // print $reviewer_action;
    if ($reviewer_action == "editrev") {
        // if we are editing then get the record. Only the admin can edit.
        $reviewer_arg = "select * from #reviewer_reviewer where reviewer_reviewer_id={$reviewer_itemid}";
        $sql->db_Select_gen($reviewer_arg, false);
        extract($sql->db_Fetch());
    } elseif (isset($_POST['submitrev'])) {
        $reviewer_reviewer_review = $_POST['reviewer_reviewer_review'];
        $reviewer_reviewer_rate1 = $_POST['reviewer_reviewer_rate1'];
        $reviewer_reviewer_rate2 = $_POST['reviewer_reviewer_rate2'];
        $reviewer_reviewer_rate3 = $_POST['reviewer_reviewer_rate3'];
        $reviewer_reviewer_rate4 = $_POST['reviewer_reviewer_rate4'];
        $reviewer_reviewer_rate5 = $_POST['reviewer_reviewer_rate5'];
        $reviewer_reviewer_rate6 = $_POST['reviewer_reviewer_rate6'];
        $reviewer_reviewer_rate7 = $_POST['reviewer_reviewer_rate7'];
        $reviewer_reviewer_rate8 = $_POST['reviewer_reviewer_rate8'];
        $reviewer_reviewer_rate9 = $_POST['reviewer_reviewer_rate9'];
        $reviewer_reviewer_rate10 = $_POST['reviewer_reviewer_rate10'];
        $reviewer_reviewer_email = $_POST['reviewer_reviewer_email'];
        $reviewer_edit_updir = "<a href='" . e_SELF . "?$reviewer_from.item.$reviewer_itemid' ><img src='images/updir.png' style='border:0px;' alt='" . REVIEWER_H020 . "' title='" . REVIEWER_H020 . "' /></a>";
    }
    if ($reviewer_action == "editrev") {
        $reviewer_edit_updir = "<a href='" . e_SELF . "?$reviewer_from.view.$reviewer_itemid' ><img src='images/updir.png' style='border:0px;' alt='" . REVIEWER_H020 . "' title='" . REVIEWER_H020 . "' /></a>";
    } else {
        $reviewer_edit_updir = "<a href='" . e_SELF . "?$reviewer_from.item.$reviewer_itemid' ><img src='images/updir.png' style='border:0px;' alt='" . REVIEWER_H020 . "' title='" . REVIEWER_H020 . "' /></a>";
    }
    $reviewer_colspan = $REVIEWER_PREF['reviewer_use1'] + $REVIEWER_PREF['reviewer_use2'] + $REVIEWER_PREF['reviewer_use3'] + $REVIEWER_PREF['reviewer_use4'] + $REVIEWER_PREF['reviewer_use5'] + 3;
    require_once(REVIEWER_TEMPLATE);
    $reviewer_text .= "
<form id='dataform' method='post' action='" . e_SELF . "' >
	<div>
		<input type='hidden' name='reviewer_action' value='$reviewer_action' />
		<input type='hidden' name='reviewer_itemid' value='$reviewer_itemid' />
		<input type='hidden' name='reviewer_reviewer_itemid' value='$reviewer_reviewer_itemid' />
		<input type='hidden' name='reviewer_rand_num' value='" . $reviewer_secimg->random_number . "' />
	</div>";
    $reviewer_text .= $tp->parsetemplate($REVIEWER_EDIT_HEADER, false, $reviewer_shortcodes);
    if (USER && $reviewer_action == "add") {
        $reviewer_reviewer_postername = USERNAME;
    } elseif (!USER && $reviewer_action == "add") {
        $reviewer_reviewer_postername = $_POST['reviewer_reviewer_postername'];
    } else {
        $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
        $reviewer_reviewer_postername = $reviewer_tmp[1];
    }
    $reviewer_rate1 = "<select name='reviewer_reviewer_rate1' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate1 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate1 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate1 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate1 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate1 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate1 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate1 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate1 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate1 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate1 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate1 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate2 = "<select name='reviewer_reviewer_rate2' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate2 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate2 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate2 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate2 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate2 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate2 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate2 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate2 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate2 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate2 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate2 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate3 = "<select name='reviewer_reviewer_rate3' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate3 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate3 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate3 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate3 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate3 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate3 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate3 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate3 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate3 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate3 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate3 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate4 = "<select name='reviewer_reviewer_rate4' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate4 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate4 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate4 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate4 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate4 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate4 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate4 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate4 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate4 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate4 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate4 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate5 = "<select name='reviewer_reviewer_rate5' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate5 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate5 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate5 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate5 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate5 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate5 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate5 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate5 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate5 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate5 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate5 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate6 = "<select name='reviewer_reviewer_rate6' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate6 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate6 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate6 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate6 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate6 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate6 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate6 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate6 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate6 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate6 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate6 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate7 = "<select name='reviewer_reviewer_rate7' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate7 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate7 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate7 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate7 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate7 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate7 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate7 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate7 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate7 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate7 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate7 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate8 = "<select name='reviewer_reviewer_rate8' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate8 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate8 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate8 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate8 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate8 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate8 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate8 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate8 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate8 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate8 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate8 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate9 = "<select name='reviewer_reviewer_rate9' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate9 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate9 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate9 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate9 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate9 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate9 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate9 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate9 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate9 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate9 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate9 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_rate10 = "<select name='reviewer_reviewer_rate10' class='tbox' >
		<option value='00' " . ($reviewer_reviewer_rate10 == 0?"selected='selected'":"") . ">&nbsp;0&nbsp;&nbsp;&nbsp;" . REVIEWER_R00 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='05' " . ($reviewer_reviewer_rate10 == 5?"selected='selected'":"") . ">&nbsp;&nbsp;&frac12;&nbsp;" . REVIEWER_R05 . "</option>":"") . "
		<option value='10' " . ($reviewer_reviewer_rate10 == 10?"selected='selected'":"") . ">&nbsp;1&nbsp;&nbsp;&nbsp;" . REVIEWER_R10 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='15' " . ($reviewer_reviewer_rate10 == 15?"selected='selected'":"") . ">&nbsp;1&nbsp;&frac12;&nbsp;" . REVIEWER_R15 . "</option>":"") . "
		<option value='20' " . ($reviewer_reviewer_rate10 == 20?"selected='selected'":"") . ">&nbsp;2&nbsp;&nbsp;&nbsp;" . REVIEWER_R20 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='25' " . ($reviewer_reviewer_rate10 == 25?"selected='selected'":"") . ">&nbsp;2&nbsp;&frac12;&nbsp;" . REVIEWER_R25 . "</option>":"") . "
		<option value='30' " . ($reviewer_reviewer_rate10 == 30?"selected='selected'":"") . ">&nbsp;3&nbsp;&nbsp;&nbsp;" . REVIEWER_R30 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='35' " . ($reviewer_reviewer_rate10 == 35?"selected='selected'":"") . ">&nbsp;3&nbsp;&frac12;&nbsp;" . REVIEWER_R35 . "</option>":"") . "
		<option value='40' " . ($reviewer_reviewer_rate10 == 40?"selected='selected'":"") . ">&nbsp;4&nbsp;&nbsp;&nbsp;" . REVIEWER_R40 . "</option>
		" . ($REVIEWER_PREF['reviewer_half'] == 1?"<option value='45' " . ($reviewer_reviewer_rate10 == 45?"selected='selected'":"") . ">&nbsp;4&nbsp;&frac12;&nbsp;" . REVIEWER_R45 . "</option>":"") . "
		<option value='50' " . ($reviewer_reviewer_rate10 == 50?"selected='selected'":"") . ">&nbsp;5&nbsp;&nbsp;&nbsp;" . REVIEWER_R50 . "</option>
		</select>";
    $reviewer_reviewer_review = "
	<textarea name='reviewer_reviewer_review' id='reviewer_reviewer_review' class='tbox' rows='6' cols='50' style='width:90%' onselect='storeCaret(this);'  onclick='storeCaret(this);' onkeyup='storeCaret(this);'>" . $tp->toFORM($reviewer_reviewer_review) . "</textarea>
<input id='helpr' class='helpbox' type='text' name='helpr' size='100' style='width:80%'/><br />" . display_help("helpr");
    $reviewer_text .= $tp->parsetemplate($REVIEWER_EDIT_DETAIL, true, $reviewer_shortcodes);
    $reviewer_text .= $tp->parsetemplate($REVIEWER_EDIT_FOOTER, false, $reviewer_shortcodes);
    $reviewer_text .= "</form>";
}
// ****************************************************************************************************
// *
// * reviewers List all reviewers
// *
// ****************************************************************************************************
if ($reviewer_action == "reviewers") {
	    require_once(REVIEWER_TEMPLATE);
    $reviewer_text .= $tp->parsetemplate($REVIEWER_RLIST_HEADER, true, $reviewer_shortcodes);

    $sql->db_Select_gen('select reviewer_reviewer_postername,count(reviewer_reviewer_postername) as numcounts,MAX(reviewer_reviewer_posted) AS lastpost from #reviewer_reviewer group by reviewer_reviewer_postername order by numcounts desc', false);
    while ($row = $sql->db_Fetch()) {
        $tmp = explode('.', $row['reviewer_reviewer_postername'], 2);
        $reviewer_posterid = $tmp[0];
        $reviewer_postername = $tmp[1];
        $reviewer_numcounts = $row['numcounts'];
    	$reviewer_lastpost=$row['lastpost'];
        $reviewer_text .= $tp->parsetemplate($REVIEWER_RLIST_DETAIL, false, $reviewer_shortcodes);
    }
    $reviewer_text .= $tp->parsetemplate($REVIEWER_RLIST_FOOTER, true, $reviewer_shortcodes);
}
// ****************************************************************************************************
// *
// * ULIST List a users reviews
// *
// ****************************************************************************************************
if ($reviewer_action == "ulist") {
    require_once(REVIEWER_TEMPLATE);
    $sql->db_Select('user', '*', 'where user_id=' . $reviewer_itemid, 'nowhere', false);
    extract($sql->db_Fetch());

    $reviewer_text .= $tp->parsetemplate($REVIEWER_ULIST_HEADER, false, $reviewer_shortcodes);
    $reviewer_arg = '
	select * from #reviewer_reviewer
	left join #reviewer_items as i on reviewer_reviewer_itemid= reviewer_items_id
	left join #reviewer_category on reviewer_category_id=reviewer_items_catid
	where reviewer_reviewer_postername regexp "^' . $reviewer_itemid . '[\.]"';
    if ($sql->db_Select_gen($reviewer_arg, false)) {
        // we did a successful query
        while ($reviewer_row = $sql->db_Fetch()) {
            $overall = 0;
            $reviewer_count = 0;
            extract($reviewer_row);
            // calc overall for this item for this user
            if ($REVIEWER_PREF['reviewer_usecat'] == 1) {
                $reviewer_use1 = $reviewer_category_use1;
                $reviewer_use2 = $reviewer_category_use2;
                $reviewer_use3 = $reviewer_category_use3;
                $reviewer_use4 = $reviewer_category_use4;
                $reviewer_use5 = $reviewer_category_use5;
                $reviewer_use6 = $reviewer_category_use6;
                $reviewer_use7 = $reviewer_category_use7;
                $reviewer_use8 = $reviewer_category_use8;
                $reviewer_use9 = $reviewer_category_use9;
                $reviewer_use10 = $reviewer_category_use10;
            } else {
                // not using category then get the settings from prefs
                $reviewer_use1 = $REVIEWER_PREF['reviewer_use1'];
                $reviewer_use2 = $REVIEWER_PREF['reviewer_use2'];
                $reviewer_use3 = $REVIEWER_PREF['reviewer_use3'];
                $reviewer_use4 = $REVIEWER_PREF['reviewer_use4'];
                $reviewer_use5 = $REVIEWER_PREF['reviewer_use5'];
                $reviewer_use6 = $REVIEWER_PREF['reviewer_use6'];
                $reviewer_use7 = $REVIEWER_PREF['reviewer_use7'];
                $reviewer_use8 = $REVIEWER_PREF['reviewer_use8'];
                $reviewer_use9 = $REVIEWER_PREF['reviewer_use9'];
                $reviewer_use10 = $REVIEWER_PREF['reviewer_use10'];
            }

            if ($reviewer_use1 == 1) {
                $overall = $overall + $reviewer_reviewer_rate1;
                $reviewer_count++;
            }
            if ($reviewer_use2 == 1) {
                $overall = $overall + $reviewer_reviewer_rate2;
                $reviewer_count++;
            }
            if ($reviewer_use3 == 1) {
                $overall = $overall + $reviewer_reviewer_rate3;
                $reviewer_count++;
            }
            if ($reviewer_use4 == 1) {
                $overall = $overall + $reviewer_reviewer_rate4;
                $reviewer_count++;
            }
            if ($reviewer_use5 == 1) {
                $overall = $overall + $reviewer_reviewer_rate5;
                $reviewer_count++;
            }
            if ($reviewer_use6 == 1) {
                $overall = $overall + $reviewer_reviewer_rate6;
                $reviewer_count++;
            }
            if ($reviewer_use7 == 1) {
                $overall = $overall + $reviewer_reviewer_rate7;
                $reviewer_count++;
            }
            if ($reviewer_use8 == 1) {
                $overall = $overall + $reviewer_reviewer_rate8;
                $reviewer_count++;
            }
            if ($reviewer_use9 == 1) {
                $overall = $overall + $reviewer_reviewer_rate9;
                $reviewer_count++;
            }
            if ($reviewer_use10 == 1) {
                $overall = $overall + $reviewer_reviewer_rate10;
                $reviewer_count++;
            }
            $overall = $overall / $reviewer_count;
            $overall_rate = $reviewer_obj->rate_image($overall);
            $reviewer_text .= $tp->parsetemplate($REVIEWER_ULIST_DETAIL, true, $reviewer_shortcodes);
        }
    }
    $reviewer_text .= $tp->parsetemplate($REVIEWER_ULIST_FOOTER, false, $reviewer_shortcodes);
}
// ****************************************************************************************************
// *
// * VIEW View a posted review
// *
// ****************************************************************************************************
if ($reviewer_action == "view") {
    // $sql->db_Select("reviewer_items", "reviewer_items_id,reviewer_items_name,reviewer_items_description", "where reviewer_items_id=$reviewer_itemid", "nowhere", false);
    // extract($sql->db_Fetch());
    $reviewer_colspan = $REVIEWER_PREF['reviewer_use1'] + $REVIEWER_PREF['reviewer_use2'] + $REVIEWER_PREF['reviewer_use3'] + $REVIEWER_PREF['reviewer_use4'] + $REVIEWER_PREF['reviewer_use5'] + 3;
    $reviewer_arg = "select * from #reviewer_reviewer
    left join #reviewer_items on reviewer_reviewer_itemid = reviewer_items_id
    left join #reviewer_category on reviewer_items_catid=reviewer_category_id
where reviewer_reviewer_id={$reviewer_itemid}
order by reviewer_reviewer_posted";
    if ($sql->db_Select_gen($reviewer_arg, false)) {
        extract($sql->db_Fetch());
        if ($REVIEWER_PREF['reviewer_usecat'] == 1) {
            $reviewer_use1 = $reviewer_category_use1;
            $reviewer_use2 = $reviewer_category_use2;
            $reviewer_use3 = $reviewer_category_use3;
            $reviewer_use4 = $reviewer_category_use4;
            $reviewer_use5 = $reviewer_category_use5;
            $reviewer_use6 = $reviewer_category_use6;
            $reviewer_use7 = $reviewer_category_use7;
            $reviewer_use8 = $reviewer_category_use8;
            $reviewer_use9 = $reviewer_category_use9;
            $reviewer_use10 = $reviewer_category_use10;
        } else {
            // not using category then get the settings from prefs
            $reviewer_use1 = $REVIEWER_PREF['reviewer_use1'];
            $reviewer_use2 = $REVIEWER_PREF['reviewer_use2'];
            $reviewer_use3 = $REVIEWER_PREF['reviewer_use3'];
            $reviewer_use4 = $REVIEWER_PREF['reviewer_use4'];
            $reviewer_use5 = $REVIEWER_PREF['reviewer_use5'];
            $reviewer_use6 = $REVIEWER_PREF['reviewer_use6'];
            $reviewer_use7 = $REVIEWER_PREF['reviewer_use7'];
            $reviewer_use8 = $REVIEWER_PREF['reviewer_use8'];
            $reviewer_use9 = $REVIEWER_PREF['reviewer_use9'];
            $reviewer_use10 = $REVIEWER_PREF['reviewer_use10'];
        }
        $reviewer_caticon = $reviewer_category_icon;
        $reviewer_logoexists = (file_exists(e_PLUGIN . "reviewer/images/caticons/" . $reviewer_caticon) && is_readable(e_PLUGIN . "reviewer/images/caticons/" . $reviewer_caticon));
        $reviewer_reviewer_ep = $reviewer_reviewer_id * - 1;
        if (!defined('META_DESCRIPTION')) {
            define(META_DESCRIPTION, "Review of item " . $tp->toFORM($reviewer_items_name) . "." . $tp->toFORM($reviewer_items_description) . ". In category " . $tp->toFORM($reviewer_category_name) . " " . $tp->toFORM($reviewer_category_description) . " " . $tp->toFORM($reviewer_reviewer_review));
        }
        if (!defined('META_KEYWORDS')) {
            define(META_KEYWORDS, $reviewer_obj->gen_keywords($tp->toFORM($reviewer_items_name) . " " . $tp->toFORM($reviewer_items_description) . " " . $tp->toFORM($reviewer_category_name) . " " . $tp->toFORM($reviewer_category_description) . " " . $tp->toFORM($reviewer_reviewer_review)));
        }
        define(e_PAGETITLE, REVIEWER_V026 . ' ' . $reviewer_items_name);
        require_once(REVIEWER_TEMPLATE);
        if (!defined('IMODE')) {
            define(IMODE, "lite");
        }
        $reviewer_text .= $tp->parsetemplate($REVIEWER_VIEW_HEADER, true, $reviewer_shortcodes);
        $reviewer_item_edit = "<a href='" . e_SELF . "?0.editrev.$reviewer_reviewer_id'><img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0px;'  alt='edit' /></a>";
        $reviewer_item_delete = "<a href='" . e_SELF . "?0.deleterev.$reviewer_reviewer_id'><img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0px;'  alt='edit' /></a>";
        $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
        $reviewer_reviewer_postername = $reviewer_tmp[1];
        $reviewer_reviewer_posterid = $reviewer_tmp[0];
        $reviewer_rate1 = $reviewer_obj->rate_image($reviewer_reviewer_rate1);
        $reviewer_rate2 = $reviewer_obj->rate_image($reviewer_reviewer_rate2);
        $reviewer_rate3 = $reviewer_obj->rate_image($reviewer_reviewer_rate3);
        $reviewer_rate4 = $reviewer_obj->rate_image($reviewer_reviewer_rate4);
        $reviewer_rate5 = $reviewer_obj->rate_image($reviewer_reviewer_rate5);
        $reviewer_rate6 = $reviewer_obj->rate_image($reviewer_reviewer_rate6);
        $reviewer_rate7 = $reviewer_obj->rate_image($reviewer_reviewer_rate7);
        $reviewer_rate8 = $reviewer_obj->rate_image($reviewer_reviewer_rate8);
        $reviewer_rate9 = $reviewer_obj->rate_image($reviewer_reviewer_rate9);
        $reviewer_rate10 = $reviewer_obj->rate_image($reviewer_reviewer_rate10);
        $reviewer_text .= $tp->parsetemplate($REVIEWER_VIEW_DETAIL, true, $reviewer_shortcodes);
        $reviewer_text .= $tp->parsetemplate($REVIEWER_VIEW_FOOTER, true, $reviewer_shortcodes);
    }
    $reviewer_docomments = 1;
}
// ***********************************************************************************************************************
// * REVIEWER ITEM
// ***********************************************************************************************************************
if ($reviewer_action == "item") {
    $reviewer_count = $sql->db_Select_gen("select * from #reviewer_items
	left join #reviewer_category on reviewer_items_catid= reviewer_category_id
	where reviewer_items_id=$reviewer_itemid", false);
    if ($reviewer_count > 0) {
        extract($sql->db_Fetch());

        if ($REVIEWER_PREF['reviewer_usecat'] == 1) {
            $reviewer_use1 = $reviewer_category_use1;
            $reviewer_use2 = $reviewer_category_use2;
            $reviewer_use3 = $reviewer_category_use3;
            $reviewer_use4 = $reviewer_category_use4;
            $reviewer_use5 = $reviewer_category_use5;
            $reviewer_use6 = $reviewer_category_use6;
            $reviewer_use7 = $reviewer_category_use7;
            $reviewer_use8 = $reviewer_category_use8;
            $reviewer_use9 = $reviewer_category_use9;
            $reviewer_use10 = $reviewer_category_use10;
        } else {
            // not using category then get the settings from prefs
            $reviewer_use1 = $REVIEWER_PREF['reviewer_use1'];
            $reviewer_use2 = $REVIEWER_PREF['reviewer_use2'];
            $reviewer_use3 = $REVIEWER_PREF['reviewer_use3'];
            $reviewer_use4 = $REVIEWER_PREF['reviewer_use4'];
            $reviewer_use5 = $REVIEWER_PREF['reviewer_use5'];
            $reviewer_use6 = $REVIEWER_PREF['reviewer_use6'];
            $reviewer_use7 = $REVIEWER_PREF['reviewer_use7'];
            $reviewer_use8 = $REVIEWER_PREF['reviewer_use8'];
            $reviewer_use9 = $REVIEWER_PREF['reviewer_use9'];
            $reviewer_use10 = $REVIEWER_PREF['reviewer_use10'];
        }
        $reviewer_caticon = $reviewer_category_icon;
        $reviewer_logoexists = is_readable(e_PLUGIN . "reviewer/images/caticons/" . $reviewer_caticon);
        if ($REVIEWER_PREF['reviewer_usecat'] == 1) {
            $reviewer_colspan = $reviewer_category_use1 + $reviewer_category_use2 + $reviewer_category_use3 + $reviewer_category_use4 + $reviewer_category_use5 + $reviewer_category_use6 + $reviewer_category_use7 + $reviewer_category_use8 + $reviewer_category_use9 + $reviewer_category_use10 + 3;
        } else {
            $reviewer_colspan = $REVIEWER_PREF['reviewer_use1'] + $REVIEWER_PREF['reviewer_use2'] + $REVIEWER_PREF['reviewer_use3'] + $REVIEWER_PREF['reviewer_use4'] + $REVIEWER_PREF['reviewer_use5'] + $REVIEWER_PREF['reviewer_use6'] + $REVIEWER_PREF['reviewer_use7'] + $REVIEWER_PREF['reviewer_use8'] + $REVIEWER_PREF['reviewer_use9'] + $REVIEWER_PREF['reviewer_use10'] + 3;
        }
        $reviewer_votes = $reviewer_items_votes;
        $reviewer_rate1 = $reviewer_obj->rate_image($reviewer_items_rate1);
        $reviewer_rate2 = $reviewer_obj->rate_image($reviewer_items_rate2);
        $reviewer_rate3 = $reviewer_obj->rate_image($reviewer_items_rate3);
        $reviewer_rate4 = $reviewer_obj->rate_image($reviewer_items_rate4);
        $reviewer_rate5 = $reviewer_obj->rate_image($reviewer_items_rate5);
        $reviewer_rate6 = $reviewer_obj->rate_image($reviewer_items_rate6);
        $reviewer_rate7 = $reviewer_obj->rate_image($reviewer_items_rate7);
        $reviewer_rate8 = $reviewer_obj->rate_image($reviewer_items_rate8);
        $reviewer_rate9 = $reviewer_obj->rate_image($reviewer_items_rate9);
        $reviewer_rate10 = $reviewer_obj->rate_image($reviewer_items_rate10);
        $reviewer_rateo = $reviewer_obj->rate_image($reviewer_items_rate);
        $reviewer_reviewer_ep = $reviewer_itemid;
        define(e_PAGETITLE, REVIEWER_P002 . ' ' . $reviewer_items_name);
        if (!defined('META_DESCRIPTION')) {
            define(META_DESCRIPTION, REVIEWER_H027 . ' ' . $tp->toTEXT($reviewer_items_name) . '.' . $tp->toTEXT($reviewer_items_description) . ' ' . REVIEWER_H029 . ' ' . $tp->toTEXT($reviewer_category_name) . " " . $tp->toTEXT($reviewer_category_description)) . REVIEWER_H028 . SITENAME . ' ';
        }
        if (!defined('META_KEYWORDS')) {
            define(META_KEYWORDS, $reviewer_obj->gen_keywords($tp->toTEXT($reviewer_items_name) . ' ' . $tp->toTEXT($reviewer_items_description) . " " . $tp->toTEXT($reviewer_category_name) . " " . $tp->toTEXT($reviewer_category_description)));
        }
        require_once(REVIEWER_TEMPLATE);
        $reviewer_count = $sql->db_Count("reviewer_reviewer", "(*)", "where reviewer_reviewer_itemid={$reviewer_itemid}", false);
        $reviewer_parms = $reviewer_count . "," . $REVIEWER_PREF['reviewer_reviewperpage'] . "," . $reviewer_from . "," . e_SELF . '?' . "[FROM]." . "item.{$reviewer_itemid}";
        $reviewer_nextprev = $tp->parseTemplate("{NEXTPREV={$reviewer_parms}}") . " ";
        $reviewer_text .= $tp->parsetemplate($REVIEWER_ITEM_HEADER, false, $reviewer_shortcodes);
        $reviewer_arg = "select * from #reviewer_reviewer
where reviewer_reviewer_itemid={$reviewer_itemid}
order by reviewer_reviewer_posted
limit $reviewer_from," . $REVIEWER_PREF['reviewer_reviewperpage'];
        $reviewer_allow_new = true;
        if ($sql->db_Select_gen($reviewer_arg, false)) {
            while ($reviewer_list = $sql->db_Fetch()) {
                extract($reviewer_list);
                $reviewer_a = explode(".", $reviewer_reviewer_postername);
                $reviewer_b = explode(".", $reviewer_postername);
                if ($reviewer_a[0] == $reviewer_b[0]) {
                    $reviewer_allow_new = false;
                }
                $reviewer_item_edit = "<a href='" . e_SELF . "?0.edit.$reviewer_reviewer_id'><img src='" . e_IMAGE . "admin_images/edit_16.png' style='border:0px;' alt='edit' /></a>";
                $reviewer_item_delete = "<a href='" . e_SELF . "?0.delete.$reviewer_reviewer_id'><img src='" . e_IMAGE . "admin_images/delete_16.png' style='border:0px;' alt='edit' /></a>";
                $reviewer_tmp = explode(".", $reviewer_reviewer_postername, 2);
                $reviewer_reviewer_postername = $reviewer_tmp[1];
                $reviewer_item_detail = "<a href='" . e_SELF . "?0.view.$reviewer_reviewer_id'>" . REVIEWER_H005 . "</a>";
                $reviewer_rate1 = $reviewer_obj->rate_image($reviewer_reviewer_rate1);
                $reviewer_rate2 = $reviewer_obj->rate_image($reviewer_reviewer_rate2);
                $reviewer_rate3 = $reviewer_obj->rate_image($reviewer_reviewer_rate3);
                $reviewer_rate4 = $reviewer_obj->rate_image($reviewer_reviewer_rate4);
                $reviewer_rate5 = $reviewer_obj->rate_image($reviewer_reviewer_rate5);
                $reviewer_rate6 = $reviewer_obj->rate_image($reviewer_reviewer_rate6);
                $reviewer_rate7 = $reviewer_obj->rate_image($reviewer_reviewer_rate7);
                $reviewer_rate8 = $reviewer_obj->rate_image($reviewer_reviewer_rate8);
                $reviewer_rate9 = $reviewer_obj->rate_image($reviewer_reviewer_rate9);
                $reviewer_rate10 = $reviewer_obj->rate_image($reviewer_reviewer_rate10);
                $reviewer_text .= $tp->parsetemplate($REVIEWER_ITEM_DETAIL, false, $reviewer_shortcodes);
            }
        } else {
            $reviewer_text .= $tp->parsetemplate($REVIEWER_ITEM_NOITEMS, false, $reviewer_shortcodes);
        }
        $reviewer_text .= $tp->parsetemplate($REVIEWER_ITEM_FOOTER, false, $reviewer_shortcodes);
    } else {
        require_once(REVIEWER_TEMPLATE);
        $reviewer_text .= $tp->parsetemplate($REVIEWER_ITEM_NOITEMS, false, $reviewer_shortcodes);
    }
}
if ($reviewer_action == "list") {
    // List all the items in this category
    // get the categories
    $reviewer_list = $sql->db_Select("reviewer_category", "reviewer_category_id,reviewer_category_name,reviewer_category_icon,reviewer_category_linkicon,reviewer_category_description", "order by reviewer_category_name", "nowhere", false);
    if ($reviewer_list > 1) {
        // more than one category so do a selector drop down
        $reviewer_selcat = "<select class='tbox' name='reviewer_cat' onchange=\"this.form.submit()\">";
        while ($reviewer_row = $sql->db_Fetch()) {
            $reviewer_selcat .= "<option value='" . $reviewer_row['reviewer_category_id'] . "' ";
            if ($reviewer_row['reviewer_category_id'] == $reviewer_cat) {
                $reviewer_selcat .= "selected='selected'";
                $reviewer_caticon = $tp->toFORM($reviewer_row['reviewer_category_icon']);
                $reviewer_pagename = $tp->toFORM($reviewer_row['reviewer_category_name']);
                $reviewer_catdesc = $tp->toFORM($reviewer_row['reviewer_category_description']);
            }
            $reviewer_selcat .= ">" . $tp->toFORM($reviewer_row['reviewer_category_name']) . "</option>";
            if (!empty($reviewer_row['reviewer_category_linkicon']) && file_exists(e_PLUGIN . 'reviewer/images/small/' . $reviewer_row['reviewer_category_linkicon'])) {
                $reviewer_iconlist .= '<a href="' . e_PLUGIN . 'reviewer/reviewer.php?0.list.0.' . $reviewer_row['reviewer_category_id'] . '" ><img src="' . e_PLUGIN . 'reviewer/images/small/' . $reviewer_row['reviewer_category_linkicon'] . '" title="' . REVIEWER_L26 . '" alt="' . REVIEWER_L26 . '" /></a>&nbsp;';
            }
        } // while
        $reviewer_selcat .= "</select>";
    } elseif ($reviewer_list == 1) {
        // otherwise display the category name of the one category
        $reviewer_row = $sql->db_Fetch();
        $reviewer_selcat = $tp->toFORM($reviewer_row['reviewer_category_name']);
        $reviewer_pagename = $reviewer_selcat;
        $reviewer_caticon = $tp->toFORM($reviewer_row['reviewer_category_icon']);
        $reviewer_catdesc = $tp->toFORM($reviewer_row['reviewer_category_description']);
    } else {
        // no categories defined yet
        $reviewer_selcat = REVIEWER_H002;
        $reviewer_pagename = $reviewer_selcat;
    }
    $reviewer_count = $sql->db_Count("reviewer_items", "(*)", "where reviewer_items_approved =1 and reviewer_items_catid={$reviewer_cat}", false);

    $reviewer_parms = $reviewer_count . "," . $REVIEWER_PREF['reviewer_catperpage'] . "," . $reviewer_from . "," . e_SELF . '?' . "[FROM]." . "list.0.$reviewer_cat";
    $reviewer_nextprev = $tp->parseTemplate("{NEXTPREV={$reviewer_parms}}") . " ";
    define(e_PAGETITLE, REVIEWER_P001 . $reviewer_pagename);
    // see if a logo exists for this category
    $reviewer_logoexists = is_readable(e_PLUGIN . "reviewer/images/caticons/" . $reviewer_caticon);
    $reviewer_text = "<form action='" . e_SELF . "' method='post' id='reviewerform'>";
    if (!defined('META_DESCRIPTION')) {
        define(META_DESCRIPTION, REVIEWER_V024 . ' ' . $tp->toFORM($reviewer_pagename) . " " . $tp->toFORM($reviewer_catdesc));
    }
    if (!defined('META_KEYWORDS')) {
        define(META_KEYWORDS, $reviewer_obj->gen_keywords($tp->toFORM($reviewer_pagename) . " " . $tp->toFORM($reviewer_catdesc)));
    }
    require_once(REVIEWER_TEMPLATE);
    // generate the top of the page
    $reviewer_text .= $tp->parsetemplate($REVIEWER_LIST_HEADER, false, $reviewer_shortcodes);
    $reviewer_args = "
	select reviewer_items_id,reviewer_items_picture,reviewer_items_name,reviewer_items_rate,reviewer_items_votes,max(reviewer_reviewer_posted) as reviewer_lastpost
 	from #reviewer_items
 	left join #reviewer_reviewer on reviewer_reviewer_itemid=reviewer_items_id
 	where reviewer_items_catid={$reviewer_cat} and reviewer_items_approved=1
 	group by reviewer_items_id
 	order by reviewer_items_order,reviewer_items_name limit $reviewer_from," . $REVIEWER_PREF['reviewer_catperpage'];
    $sql->db_Select_gen($reviewer_args, false);
    // Display all the items in this category
    while ($reviewer_line = $sql->db_Fetch()) {
        extract($reviewer_line);
        $reviewer_items_name = "<a href='" . e_SELF . "?0.item.$reviewer_items_id.$reviewer_cat' >" . $tp->toFORM($reviewer_items_name) . "</a>";
        $reviewer_items_stars = $reviewer_obj->rate_image($reviewer_items_rate);
        $reviewer_item_view = "<a href='" . e_SELF . "?0.item.$reviewer_items_id.$reviewer_cat'>" . REVIEWER_H005 . "</a>";
        if (file_exists(e_PLUGIN . "reviewer/images/itempics/" . $tp->toTEXT($reviewer_items_picture)) && !empty($reviewer_items_picture)) {
            $reviewer_item_image = "<a href='" . e_SELF . "?0.item.$reviewer_items_id.$reviewer_cat'><img src='" . e_PLUGIN . "reviewer/images/itempics/" . $tp->toTEXT($reviewer_items_picture) . "' alt='' title='' style='border:0px;height:32px;width:32px;' /> </a>";
        } else {
            $reviewer_item_image = "<a href='" . e_SELF . "?0.item.$reviewer_items_id.$reviewer_cat'><img src='" . e_PLUGIN . "reviewer/images/blank.png' alt='' title='' style='border:0px;height:32px;width:32px;' /> </a>";
        }
        $reviewer_text .= $tp->parsetemplate($REVIEWER_LIST_DETAIL, false, $reviewer_shortcodes);
    } // while
    // display the footer
    $reviewer_count = $sql->db_Count("reviewer_items", "(*)", "where reviewer_items_approved =1 and reviewer_items_catid={$reviewer_cat}", false);

    $reviewer_parms = $reviewer_count . "," . $REVIEWER_PREF['reviewer_catperpage'] . "," . $reviewer_from . "," . e_SELF . '?' . "[FROM]." . "list.0.$reviewer_cat";
    $reviewer_nextprev = $tp->parseTemplate("{NEXTPREV={$reviewer_parms}}") . " ";
    $reviewer_text .= $tp->parsetemplate($REVIEWER_LIST_FOOTER, false, $reviewer_shortcodes);
    $reviewer_text .= "</form>";
}
unset($e_wysiwyg);

require_once(HEADERF);
$reviewer_obj->tablerender(REVIEWER_A001, $reviewer_text);
if ($REVIEWER_PREF['reviewer_comments'] && $reviewer_docomments > 0) {
    $table = "reviewer";
    $subject = "Comment";
    print $reviewer_cobj->compose_comment($table, "comment", $reviewer_itemid, $width, $subject, false, false);
}
require_once(FOOTERF);