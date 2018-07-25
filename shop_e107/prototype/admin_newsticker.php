<?php
/*
   +---------------------------------------------------------------+
   |	Prototype and Scriptaculous Plugin for e107
   |
   |	Copyright (C) Fathr Barry Keal 2003 - 2010
   |	http://www.keal.me.uk
   |
   |	Released under the terms and conditions of the
   |	GNU General Public License (http://gnu.org).
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
include_lan(e_PLUGIN . "prototype/languages/" . e_LANGUAGE . "_prototype.php");

if (!is_object($prototype_obj)) {
    require_once(e_PLUGIN . "prototype/includes/prototype_class.php");
    $prototype_obj = new prototype;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH")) {
    define(ADMIN_WIDTH, "width:100%;");
}
if (isset($_POST['savesettings'])) {
    $PROTOTYPE_PREF['prototype_newsactive'] = intval($_POST['prototype_newsactive']);
    $PROTOTYPE_PREF['prototype_newsrandom'] = intval($_POST['prototype_newsrandom']);
    $PROTOTYPE_PREF['prototype_newsdelay'] = intval($_POST['prototype_newsdelay']);
    $PROTOTYPE_PREF['prototype_newsnumnews'] = intval($_POST['prototype_newsnumnews']);
    $PROTOTYPE_PREF['prototype_newsfeed'] = intval($_POST['prototype_newsfeed']);
    $PROTOTYPE_PREF['prototype_newsnumfeed'] = intval($_POST['prototype_newsnumfeed']);
    $PROTOTYPE_PREF['prototype_static_content'] = $tp->toDB($_POST['prototype_static_content']);
    if ($PROTOTYPE_PREF['prototype_newsdelay'] < 5) {
        $PROTOTYPE_PREF['prototype_newsdelay'] = 5;
    }
    $PROTOTYPE_PREF['prototype_newscontent'] = intval($_POST['prototype_newscontent']);
    // $PROTOTYPE_PREF['prototype_minicombi'] = intval($_POST['prototype_minicombi']);
    $prototype_obj->save_prefs();
    $prototype_msg_type .= 'success' ;
    $prototype_msg_text .= PROTOTYPE_C05 ;
}
// get list of news feeds
$sql->db_Select('newsfeed', 'newsfeed_id,newsfeed_name', 'order by newsfeed_name', 'nowhere', false);
$prototype_newsfeedlist = '<select class="tbox" name="prototype_newsfeed">';
while ($row = $sql->db_Fetch()) {
    $prototype_newsfeedlist .= "<option value='{$row['newsfeed_id']}' " . ($row['newsfeed_id'] == $PROTOTYPE_PREF['prototype_newsfeed']?'selected="selected"':'') . ">" . $tp->toFORM($row['newsfeed_name']) . '</option>';
}
$prototype_newsfeedlist .= '</select>';
$prototype_text = "
<form id='dataform' method='post' action='" . e_SELF . "'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >";
$prototype_text .= "
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . PROTOTYPE_C02 . "</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader3' colspan='2' style='text-align:left'>" . $prototype_obj->message_box($prototype_msg_type, $prototype_msg_text) . "</td>
		</tr>";

$prototype_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PROTOTYPE_C03 . "</td><td class='forumheader3'>
				<input type='checkbox' name='prototype_newsactive' class='tbox' value='1' " . ($PROTOTYPE_PREF['prototype_newsactive'] == 1?'checked="checked"':'') . "' />
			</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PROTOTYPE_C18 . "</td><td class='forumheader3'>
				<input type='checkbox' name='prototype_newsrandom' class='tbox' value='1' " . ($PROTOTYPE_PREF['prototype_newsrandom'] == 1?'checked="checked"':'') . "' />
			</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PROTOTYPE_C14 . "</td><td class='forumheader3'>
				<input type='text' style='width:40px;' name='prototype_newsdelay' class='tbox' value='" . $PROTOTYPE_PREF['prototype_newsdelay'] . "' /> " . PROTOTYPE_C15 . "
			</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PROTOTYPE_C13 . "</td>
			<td class='forumheader3'>
				<input type='radio' name='prototype_newscontent' id='prototype_newscontent0' class='tbox' value='0' " . ($PROTOTYPE_PREF['prototype_newscontent'] == 0?'checked="checked"':'') . "' style='border:0px;' /><label for='prototype_newscontent0' > " . PROTOTYPE_C10 . "</label><br />
				<input type='radio' name='prototype_newscontent' id='prototype_newscontent1' class='tbox' value='1' " . ($PROTOTYPE_PREF['prototype_newscontent'] == 1?'checked="checked"':'') . "' style='border:0px;' /><label for='prototype_newscontent1' > " . PROTOTYPE_C11 . "</label><br />
				<input type='radio' name='prototype_newscontent' id='prototype_newscontent2' class='tbox' value='2' " . ($PROTOTYPE_PREF['prototype_newscontent'] == 2?'checked="checked"':'') . "' style='border:0px;' /><label for='prototype_newscontent2' > " . PROTOTYPE_C12 . "</label>
			</td>
		</tr>";
if ($PROTOTYPE_PREF['prototype_newscontent'] == 1) {
    // newsfeed
    $prototype_show_news = 'none';
    $prototype_show_newsfeed = 'inline';
    $prototype_show_static = 'none';
} elseif ($PROTOTYPE_PREF['prototype_newscontent'] == 2) {
    // static
    $prototype_show_news = 'none';
    $prototype_show_newsfeed = 'none';
    $prototype_show_static = 'inline';
} else {
    // sitenews
    $prototype_show_news = 'inline';
    $prototype_show_newsfeed = 'none';
    $prototype_show_static = 'none';
}
$prototype_text .= "
		<tr>
			<td class='forumheader3' style='width:30%;'>" . PROTOTYPE_C13 . "</td>
			<td class='forumheader3'>
				<div id='prototype_news' style='display:" . $prototype_show_news . ";'>
					<input type='text' class='tbox' name='prototype_newsnumnews' value='" . $PROTOTYPE_PREF['prototype_newsnumnews'] . "' /> " . PROTOTYPE_C17 . " </div>
				<div id='prototype_newsfeed'  style='display:" . $prototype_show_newsfeed . ";'>$prototype_newsfeedlist " . PROTOTYPE_C16 . "<br /><input type='text' class='tbox' name='prototype_newsnumfeed' value='" . $PROTOTYPE_PREF['prototype_newsnumfeed'] . "' /> " . PROTOTYPE_C17 . " </div>
				<div id='prototype_static'  style='display:" . $prototype_show_static . ";'>
					<textarea class='tbox' rows='6' cols='50' style='width:95%' name='prototype_static_content' >" . $PROTOTYPE_PREF['prototype_static_content'] . "</textarea>
				</div>
			</td>
		</tr>";
$prototype_text .= "
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left;vertical-align:top;'>
				<input class='button' name='savesettings' type='submit' value='" . PROTOTYPE_C04 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left;vertical-align:top;'>&nbsp;</td>
		</tr>";
$prototype_text .= "
	</table>
</form>";
$ns->tablerender(PROTOTYPE_C01, $prototype_text);
require_once(e_ADMIN . "footer.php");