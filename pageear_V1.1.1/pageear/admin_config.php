<?php
/*
+---------------------------------------------------------------+
|        Page Ear v1.1 - by Barry
|
|        v1.1
|
|        This module for the e107 .7+ website system
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/

require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
if (!defined('e107_INIT'))
{
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined("ADMIN_WIDTH"))
{
    define(ADMIN_WIDTH, "width:100%");
}
require_once(e_HANDLER . "userclass_class.php");
include_lan(e_PLUGIN . "pageear/languages/admin/" . e_LANGUAGE . ".php");
if (isset($_POST['update']))
{
    // Update rest
    $pref['pageear_large'] = $tp->toDB($_POST['pageear_large']);
    $pref['pageear_active'] = $tp->toDB($_POST['pageear_active']);
    $pref['pageear_dateform'] = $tp->toDB($_POST['pageear_dateform']);
    $pref['pageear_simplemode'] = intval($_POST['pageear_simplemode']);
    $pref['pageear_small'] = $tp->toDB($_POST['pageear_small']);
    $pref['pageear_link'] = $tp->toDB($_POST['pageear_link']);
    $pref['pageear_showpages'] = $tp->toDB($_POST['pageear_showpages']);
    $pref['pageear_show'] = $tp->toDB($_POST['pageear_show']);
    $pref['pageear_class'] = intval($_POST['pageear_class']);
    $pref['pageear_speed'] = intval($_POST['pageear_speed']);
    $pref['pageear_mirror'] = $tp->toDB($_POST['pageear_mirror']);
    $pref['pageear_colour'] = $tp->toDB($_POST['pageear_colour']);
    $pref['pageear_target'] = $tp->toDB($_POST['pageear_target']);
    $pref['pageear_direction'] = $tp->toDB($_POST['pageear_direction']);
    $pref['pageear_openonload'] = $tp->toDB($_POST['pageear_openonload']);
    $pref['pageear_closeonload'] = intval($_POST['pageear_closeonload']);
    $pref['pageear_fadein'] = intval($_POST['pageear_fadein']);
    save_prefs();
    $pageear_msgtext = PAGEEAR_A2 ;
}
// get file list
require_once(e_HANDLER . "file_class.php");
$pageear_fl = new e_file;

$pageear_list_large = $pageear_fl->get_files(e_PLUGIN . "pageear/large/", '');
$pageear_list_small = $pageear_fl->get_files(e_PLUGIN . "pageear/small/", '');

$pageear_text .= "
<script src='./includes/201a.js' type='text/javascript'></script>
<form method='post' action='" . e_SELF . "' id='dataform'>
	<table class='fborder' style='" . ADMIN_WIDTH . "' >
		<tr>
			<td class='fcaption' colspan='2'><strong>" . PAGEEAR_A3 . "</strong></td>
		</tr>
		<tr>
			<td class='forumheader3' colspan='2'><strong>" . $pageear_msgtext . "</strong>&nbsp;</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A49 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox'  style='border:0;' name='pageear_active' value='1' " . ($pref['pageear_active'] == 1?"checked=checked'":"") . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A22 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='checkbox'  style='border:0;' name='pageear_simplemode' value='1' " . ($pref['pageear_simplemode'] == 1?"checked=checked'":"") . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A53 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select name='pageear_speed' class='tbox' >
					<option value='1' " . ($pref['pageear_speed'] == 1?"selected='selected'":"") . ">1</option>
					<option value='2' " . ($pref['pageear_speed'] == 2?"selected='selected'":"") . ">2</option>
					<option value='3' " . ($pref['pageear_speed'] == 3?"selected='selected'":"") . ">3</option>
					<option value='4' " . ($pref['pageear_speed'] == 4?"selected='selected'":"") . ">4</option>
				</select><br /><em>" . PAGEEAR_A54 . "</em>
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A55 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select name='pageear_mirror' class='tbox' >
					<option value='true' " . ($pref['pageear_mirror'] == "true"?"selected='selected'":"") . ">" . PAGEEAR_A56 . "</option>
					<option value='false' " . ($pref['pageear_mirror'] == "false"?"selected='selected'":"") . ">" . PAGEEAR_A57 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A70 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='text' class='tbox' style='width:20%' id='pageear_colour' name='pageear_colour' value='" . $tp->toFORM($pref['pageear_colour']) . "' />
				<div id='colorpicker201' class='colorpicker201' style='width:530px;' ></div>
				<input type='text' style='background-color:" . $tp->toFORM($pref['pageear_colour']) . "' class='tbox' id='pageear_samplecolour' size='1' value='' />&nbsp;
				<img src='./images/sel.gif' onclick=\"showColorGrid2('pageear_colour','pageear_samplecolour');\" style='cursor:pointer;border:0' alt='select colour' title='select colour' />

			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A58 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select name='pageear_target' class='tbox' >
					<option value='new' " . ($pref['pageear_target'] == "new"?"selected='selected'":"") . ">" . PAGEEAR_A60 . "</option>
					<option value='self' " . ($pref['pageear_target'] == "self"?"selected='selected'":"") . ">" . PAGEEAR_A59 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A61 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select name='pageear_openonload' class='tbox' >
					<option value='false' " . ($pref['pageear_openonload'] == "false"?"selected='selected'":"") . ">" . PAGEEAR_A62 . "</option>
					<option value='1' " . ($pref['pageear_openonload'] == "1"?"selected='selected'":"") . ">1 " . PAGEEAR_A63 . "</option>
					<option value='2' " . ($pref['pageear_openonload'] == "2"?"selected='selected'":"") . ">2 " . PAGEEAR_A63 . "</option>
					<option value='3' " . ($pref['pageear_openonload'] == "3"?"selected='selected'":"") . ">3 " . PAGEEAR_A63 . "</option>
					<option value='4' " . ($pref['pageear_openonload'] == "4"?"selected='selected'":"") . ">4 " . PAGEEAR_A63 . "</option>
					<option value='5' " . ($pref['pageear_openonload'] == "5"?"selected='selected'":"") . ">5 " . PAGEEAR_A63 . "</option>
					<option value='10' " . ($pref['pageear_openonload'] == "10"?"selected='selected'":"") . ">10 " . PAGEEAR_A63 . "</option>
					<option value='15' " . ($pref['pageear_openonload'] == "15"?"selected='selected'":"") . ">15 " . PAGEEAR_A63 . "</option>
					<option value='20' " . ($pref['pageear_openonload'] == "20"?"selected='selected'":"") . ">20 " . PAGEEAR_A63 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A64 . "</td>
			<td style='width:70%' class='forumheader3'>
				<select name='pageear_closeonload' class='tbox' >
					<option value='1' " . ($pref['pageear_closeonload'] == "1"?"selected='selected'":"") . ">1 " . PAGEEAR_A63 . "</option>
					<option value='2' " . ($pref['pageear_closeonload'] == "2"?"selected='selected'":"") . ">2 " . PAGEEAR_A63 . "</option>
					<option value='3' " . ($pref['pageear_closeonload'] == "3"?"selected='selected'":"") . ">3 " . PAGEEAR_A63 . "</option>
					<option value='4' " . ($pref['pageear_closeonload'] == "4"?"selected='selected'":"") . ">4 " . PAGEEAR_A63 . "</option>
					<option value='5' " . ($pref['pageear_closeonload'] == "5"?"selected='selected'":"") . ">5 " . PAGEEAR_A63 . "</option>
					<option value='10' " . ($pref['pageear_closeonload'] == "10"?"selected='selected'":"") . ">10 " . PAGEEAR_A63 . "</option>
					<option value='15' " . ($pref['pageear_closeonload'] == "15"?"selected='selected'":"") . ">15 " . PAGEEAR_A63 . "</option>
					<option value='20' " . ($pref['pageear_closeonload'] == "20"?"selected='selected'":"") . ">20 " . PAGEEAR_A63 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . PAGEEAR_A65 . "</td>
			<td class='forumheader3'>
				<select class='tbox' name='pageear_direction'>
					<option value='rt' " . ($tp->toFORM($pref['pageear_direction']) == "rt" ?"selected='selected'":"") . ">" . PAGEEAR_A66 . "</option>
					<option value='lt' " . ($tp->toFORM($pref['pageear_direction']) == "lt" ?"selected='selected'":"") . ">" . PAGEEAR_A67 . "</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . PAGEEAR_A68 . "</td>
			<td class='forumheader3'>
				<select class='tbox' name='pageear_fadein'>
					<option value='0' " . ($pref['pageear_fadein'] == "0" ?"selected='selected'":"") . ">0</option>
					<option value='1' " . ($pref['pageear_fadein'] == "1" ?"selected='selected'":"") . ">1</option>
					<option value='2' " . ($pref['pageear_fadein'] == "2" ?"selected='selected'":"") . ">2</option>
					<option value='3' " . ($pref['pageear_fadein'] == "3" ?"selected='selected'":"") . ">3</option>
					<option value='4' " . ($pref['pageear_fadein'] == "4" ?"selected='selected'":"") . ">4</option>
					<option value='5' " . ($pref['pageear_fadein'] == "5" ?"selected='selected'":"") . ">5</option>
				</select><br /><em>" . PAGEEAR_A69 . "</em>
			</td>
		</tr>
		<tr>
			<td class='forumheader3'>" . PAGEEAR_A52 . "</td>
			<td class='forumheader3'>
				<select class='tbox' name='pageear_dateform'>
					<option value='d-m-Y' " . ($tp->toFORM($pref['pageear_dateform']) == "d-m-Y" ?"selected='selected'":"") . ">d-m-Y</option>
					<option value='m-d-Y' " . ($tp->toFORM($pref['pageear_dateform']) == "m-d-Y" ?"selected='selected'":"") . ">m-d-Y</option>
					<option value='Y-m-d' " . ($tp->toFORM($pref['pageear_dateform']) == "Y-m-d" ?"selected='selected'":"") . ">Y-m-d</option>
				</select>
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A4 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_large' name='pageear_large' size='60' value='" . $tp->toFORM($pref['pageear_large']) . "' maxlength='100' /><br />";
foreach($pageear_list_large as $pageear_large)
{
    $pageear_text .= "<a href=\"javascript:insertext('" . $pageear_large['fname'] . "','pageear_large','newsicn')\"><img src='" . $pageear_large['path'] . $pageear_large['fname'] . "' style='border:0;height:100px;width:100px;' alt='' /></a> ";
}

$pageear_text .= "
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A5 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text' id='pageear_small' name='pageear_small' size='60' value='" . $tp->toFORM($pref['pageear_small']) . "' maxlength='100' /><br />";
foreach($pageear_list_small as $pageear_small)
{
    $pageear_text .= "<a href=\"javascript:insertext('" . $pageear_small['fname'] . "','pageear_small','newsicn')\"><img src='" . $pageear_small['path'] . $pageear_small['fname'] . "' style='border:0;height:100px;width:100px;' alt='' /></a> ";
}

$pageear_text .= "
			</td>
		</tr>";
$pageear_text .= "
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A7 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input class='tbox' type='text'  size='80%' name='pageear_link' value='" . $tp->toFORM($pref['pageear_link']) . "' />
			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A15 . "</td>
			<td style='width:70%' class='forumheader3'>" . r_userclass("pageear_class", $pref['pageear_class'], "off", 'public,guest, nobody, member,main, admin, classes') . "

			</td>
		</tr>
		<tr>
			<td style='width:30%' class='forumheader3'>" . PAGEEAR_A16 . "</td>
			<td style='width:70%' class='forumheader3'>
				<input type='radio' name='pageear_show' value='0' " . ($pref['pageear_show'] != 1?"checked='checked'":"") . " style='border:0px;' class='tbox'/> " . PAGEEAR_A12 . "<br />
				<input type='radio' name='pageear_show' value='1' " . ($pref['pageear_show'] == 1?"checked='checked'":"") . " style='border:0px;' class='tbox'/> " . PAGEEAR_A13 . "<br />
				<textarea class='tbox' id='pageear_showpages' style='width:80%;' name='pageear_showpages' rows='6' cols='50' >" . $tp->toFORM($pref['pageear_showpages']) . "</textarea><br />" . PAGEEAR_A14 . "
			</td>
		</tr>

		<tr>
			<td colspan='2' class='fcaption' style='text-align: left;'>
				<input type='submit' name='update' value='" . PAGEEAR_A17 . "' class='button' />
			</td>
		</tr>
	</table>
</form>";

$ns->tablerender(PAGEEAR_A1, $pageear_text);

require_once(e_ADMIN . "footer.php");
